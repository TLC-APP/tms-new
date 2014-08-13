<nav class="main-nav" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>          
        <div class="navbar-collapse collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li class=" nav-item">
                    <?php echo $this->Html->link('Trang chủ', array('controller' => 'dashboards', 'action' => 'home')); ?>
                </li>
                <li class=" nav-item">
                    <?php echo $this->Html->link('Khóa học đã hoàn thành', array('controller' => 'dashboards', 'action' => 'courses_completed')); ?>
                </li>
                <li class=" nav-item">
                    <?php echo $this->Html->link('Hướng dẫn sử dụng', array('controller' => 'dashboards', 'action' => 'help')); ?>
                <li class=" nav-item">
                    <?php echo $this->Html->link('Liên hệ', array('controller' => 'dashboards', 'action' => 'contact')); ?>
                </li>

            </ul>
            <?php if (!($this->Session->check('Auth.User.id'))): ?>
                <ul class="nav navbar-nav pull-right">
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown"data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Đăng nhập <i class="fa fa-angle-down"></i></a>
                        <div class="dropdown-menu col-lg-5">
                            <div class="panel panel-theme">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-lock"></i> Đăng nhập</h3>
                                </div>
                                <div class="panel-body">
                                    <form accept-charset="utf-8" method="post" id="login-nav" role="form" action="<?php echo Router::url('/', true) ?>users/login"><div style="display:none;"><input type="hidden" value="POST" name="_method"></div>                                <div class="form-group">
                                            <label for="exampleInputEmail2" class="sr-only">Username</label>
                                            <input type="text" maxlength="100" required="required" placeholder="Username" id="exampleInputEmail2" class="form-control" name="data[User][username]">                                </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword2" class="sr-only">Mật khẩu</label>
                                            <input type="password" id="UserPassword" placeholder="Mật khẩu" class="form-control" name="data[User][password]">                                </div>

                                        <div class="checkbox">
                                            <label>
                                                <input type="hidden" id="UserRemember_" name="data[User][remember]"><input type="checkbox" id="UserRemember" name="data[User][remember]">Ghi nhớ
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-success btn-block" type="submit">Thực hiện</button>                                    
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>

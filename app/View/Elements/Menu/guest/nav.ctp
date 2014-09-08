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
        <div class="navbar-collapse collapse pull-right" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li class=" nav-item">
                    <?php echo $this->Html->link('Trang chủ', array('controller' => 'dashboards', 'action' => 'home')); ?>
                </li>
                <li class=" nav-item">
                    <?php //echo $this->Html->link('Khóa học đã hoàn thành', array('controller' => 'dashboards', 'action' => 'courses_completed')); ?>
                </li>
                <li class=" nav-item">
                    <?php echo $this->Html->link('Hướng dẫn sử dụng', array('controller' => 'dashboards', 'action' => 'help')); ?>
                <li class=" nav-item">
                    <?php //echo $this->Html->link('Liên hệ', array('controller' => 'dashboards', 'action' => 'contact')); ?>
                </li>
                
                <?php if (isset($loginUser) && count($loginUser['Group']) > 1): ?>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Vai trò <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <?php foreach ($loginUser['Group'] as $group): ?>
                                <li>
                                    <?php
                                    if ($group['alias'] != $this->params['prefix'])
                                        echo $this->Html->link($group['name'], array(
                                            'controller' => 'dashboards',
                                            'action' => 'home', $group['alias'] => true));
                                    ?>                
                                </li>

                            <?php endforeach; ?>

                        </ul>
                    </li>
                <?php endif; ?>
                <?php if (AuthComponent::user('id')): ?>
                    <li class="nav-item dropdown">
                        <?php echo $this->Html->link('Chào '.AuthComponent::user('name').'<i class="fa fa-angle-down"></i>','#',array('class'=>"dropdown-toggle", 'data-toggle'=>"dropdown", 'data-hover'=>"dropdown", 'data-delay'=>"0", 'data-close-others'=>"false",'escape'=>false)); ?>
                        <ul class="dropdown-menu">
                            <li>
                                <?php echo $this->Html->link('Thoát',array('controller'=>'users','action'=>'logout'));?>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
            <?php if (!($this->Session->check('Auth.User.id'))): ?>
                <ul class="nav navbar-nav pull-right">
                    <li class="nav-item">
                        <?php echo $this->Html->link('Đăng nhập', array('controller' => 'users', 'action' => 'login')) ?>

                    </li>
                </ul>
            <?php endif; ?>

        </div>
    </div>
</nav>

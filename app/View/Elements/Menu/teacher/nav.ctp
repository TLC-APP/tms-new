<nav class="main-nav" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button><!--//nav-toggle-->
        </div><!--//navbar-header-->            
        <div class="navbar-collapse collapse pull-right" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li class=" nav-item">
                    <?php echo $this->Html->link('Trang chủ', array('controller' => 'dashboards', 'action' => 'teacher_home')); ?>
                </li>
                <li class=" nav-item">
                    <?php echo $this->Html->link('Khóa học sắp tổ chức', array('controller' => 'courses_rooms', 'action' => 'sap_to_chuc')); ?>
                </li>

                <li class=" nav-item">
                    <?php echo $this->Html->link('Khóa học đã tập huấn', array('controller' => 'courses_rooms', 'action' => 'da_tap_huan')); ?>
                </li>

                <?php if (count($loginUser['Group']) > 1): ?>
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
                        <?php echo $this->Html->link('Chào ' . AuthComponent::user('name') . '<i class="fa fa-angle-down"></i>', '#', array('class' => "dropdown-toggle", 'data-toggle' => "dropdown", 'data-hover' => "dropdown", 'data-delay' => "0", 'data-close-others' => "false", 'escape' => false)); ?>
                        <ul class="dropdown-menu">
                            <li>
                                <?php echo $this->Html->link('Thoát', array('controller' => 'users', 'action' => 'logout')); ?>
                            </li>
                            <li>
                                <?php echo $this->Html->link('Hồ sơ', array('controller' => 'users', 'action' => 'profile',AuthComponent::user('id'))); ?>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

            </ul><!--//nav-->
        </div><!--//navabr-collapse-->
    </div><!--//container-->
</nav>
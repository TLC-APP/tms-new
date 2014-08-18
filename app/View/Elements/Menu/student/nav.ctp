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
                <li class="nav-item">
                    <?php echo $this->Html->link('Trang chủ', array('controller' => 'dashboards', 'action' => 'student_home')); ?>
                </li>
                <li class="nav-item">
                    <?php echo $this->Html->link('Khóa học đang tham dự', array('controller' => 'attends', 'action' => 'courses_studying')); ?>
                </li>
                <li class="nav-item">
                    <?php echo $this->Html->link('Khóa học đã tham dự', array('controller' => 'attends', 'action' => 'attended')); ?>

                </li>
                <?php if(count($loginUser['Group'])>1):?>
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
                <?php endif;?>
            </ul>
        </div>
    </div>
</nav>
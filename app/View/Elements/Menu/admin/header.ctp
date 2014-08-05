<meta charset="UTF-8">
<title>Hệ thống quản lý Thông tin Tập huấn Giáo viên | Trang phục vụ quản lý lĩnh vực</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->css('select2-bootstrap'); ?>
<?php echo $this->Html->script('plugins/select2/select2'); ?>


<?php echo $this->Html->link('TMS', array('controller' => 'dashboards', 'action' => 'home','admin'=>false,'plugin'=>false), array('class' => 'logo')); ?>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>
    <div class="navbar-right">
        <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            
            <!-- Notifications: style can be found in dropdown.less -->

            <!-- Tasks: style can be found in dropdown.less -->

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i>
                    <span><?php echo AuthComponent::user('name') ?> <i class="caret"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header bg-light-blue">
                        <img src="<?php echo SUB_DIR;?>/files/user/avatar/<?php echo AuthComponent::user('avatar_path') . '/' . AuthComponent::user('avatar') ?>" class="img-circle" alt="User Image" />
                        <p>
                            <?php echo AuthComponent::user('name') ?>
                            <small><?php echo AuthComponent::user('email') ?></small>
                        </p>
                    </li>
                    <!-- Menu Body -->
                    
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="<?php echo SUB_DIR; ?>/admin/users/profile/<?php echo AuthComponent::user('id')?>" class="btn btn-default btn-flat">Hồ sơ</a>
                        </div>
                        <div class="pull-right">
                            <a href="<?php echo SUB_DIR; ?>/users/logout" class="btn btn-default btn-flat">Thoát</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
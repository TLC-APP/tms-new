<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
    <head>
        <?php echo $this->element('Common/header_tag'); ?>
    </head>

    <body class="home-page">
        <div class="wrapper">
            <!-- ******HEADER****** --> 
            <?php echo $this->element('Menu/teacher/header') ?>
            <!--//header-->

            <!-- ******NAV****** -->
             <?php echo $this->element('Menu/teacher/nav') ?>
            <!--//main-nav-->

            <!-- ******CONTENT****** --> 
            <div class="content container">
                <div class="row cols-wrapper">

                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->Session->flash('auth'); ?>
                    <?php echo $this->fetch('content'); ?> 

                </div><!--//cols-wrapper-->

            </div><!--//content-->
        </div><!--//wrapper-->

        <!-- ******FOOTER****** --> 
        <?php echo $this->element('Common/footer');?>



        <!-- Javascript -->          
        <?php echo $this->Html->script('/user/plugins/jquery-1.10.2.min'); ?>
        <?php echo $this->Html->script('/user/plugins/jquery-migrate-1.2.1.min'); ?>
        <?php echo $this->Html->script('/user/plugins/bootstrap/js/bootstrap.min'); ?>
        <?php echo $this->Html->script('/user/plugins/bootstrap-hover-dropdown.min'); ?>
        <?php echo $this->Html->script('/user/plugins/back-to-top'); ?>
        <?php echo $this->Html->script('/user/plugins/jquery-placeholder/jquery.placeholder'); ?>
        <?php echo $this->Html->script('/user/plugins/pretty-photo/js/jquery.prettyPhoto'); ?>
        <?php echo $this->Html->script('/user/plugins/flexslider/jquery.flexslider-min'); ?>
        <?php echo $this->Html->script('/user/plugins/jflickrfeed/jflickrfeed.min'); ?>
        <?php echo $this->Html->script('/user/js/main'); ?>       
    </body>
</html> 


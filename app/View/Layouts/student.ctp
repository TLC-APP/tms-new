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
            <!--//header-->
            <?php echo $this->element('Menu/student/header') ?>
            <!-- ******NAV****** -->
            <?php echo $this->element('Menu/student/nav') ?>
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




    </body>
</html> 


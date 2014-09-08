   <title><?php echo Configure::read('System.name') ?></title>
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="<?php echo Configure::read('System.name') ?>" content="">    
<link rel="shortcut icon" href="favicon.ico">  
<?php echo $this->Html->css('http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'); ?>
<!-- Global CSS -->
<?php echo $this->Html->css('bootstrap.min') ?>
<!-- Plugins CSS -->    
<?php echo $this->Html->css('font-awesome') ?>
<!-- Javascript -->          
<?php echo $this->Html->script('/user/plugins/jquery-1.10.2.min'); ?>
<?php echo $this->Html->script('/user/plugins/jquery-migrate-1.2.1.min'); ?>
<?php echo $this->Html->script('bootstrap.min'); ?>
<?php echo $this->Html->script('/user/plugins/bootstrap-hover-dropdown.min'); ?>
<?php echo $this->Html->script('/user/plugins/back-to-top'); ?>
<?php echo $this->Html->script('/user/js/main'); ?>
<?php echo $this->Html->script('plugins/fullcalendar/fullcalendar.min') ?>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->css('select2-bootstrap'); ?>
<?php echo $this->Html->script('plugins/select2/select2.min'); ?>
<!-- daterange picker -->
<?php echo $this->Html->css('daterangepicker/daterangepicker-bs3'); ?>
<?php echo $this->Html->script('plugins/daterangepicker/daterangepicker'); ?>
<?php echo $this->Html->script('moment.min'); ?>
<!-- Theme CSS -->  
<?php echo $this->Html->css('/user/css/styles') ?>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<?php
echo $this->element('Common/fancybox',array(),array('cache' => true));
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');

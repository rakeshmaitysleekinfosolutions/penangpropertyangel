<!DOCTYPE html>
<html>

<!-- Mirrored from dreamguys.co.in/smarthr/light/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 22 Mar 2018 04:11:25 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <?php echo $this->template->meta; ?>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url();?>assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/images/favicon-16x16.png">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png">
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/theme/light/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/theme/light/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/theme/light/plugins/morris/morris.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/theme/light/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/theme/light/js/sweetalert/sweetalert.css">
    <link rel="stylesheet" href="<?php echo base_url();?>dist/app.css">
    <?php echo $this->template->stylesheet; ?>
</head>
<body>
<div class="main-wrapper">
    <?php echo $this->template->content; ?>

</div>
<div class="sidebar-overlay" data-reff="#sidebar"></div>
<script type="text/javascript" src="<?php echo base_url();?>dist/app.js" ></script>
</body>

<!-- Mirrored from dreamguys.co.in/smarthr/light/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 22 Mar 2018 04:11:25 GMT -->
</html>
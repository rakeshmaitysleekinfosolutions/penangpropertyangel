<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <?php echo $this->template->meta; ?>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url();?>assets/images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/images/favicon-16x16.png">
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png">
        <title>Dashboard - Penang Property Angel</title>
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
            <div class="header">
                <div class="header-left">
                    <a href="<?php echo base_url();?>" class="logo">
						<img src="<?php echo base_url();?>assets/images/logo.png" width="64" height="44" alt="">
					</a>
                </div>
                <div class="page-title-box pull-left">
					<h3>Penang Property Angel</h3>
                </div>
				<a id="mobile_btn" class="mobile_btn pull-left" href="#sidebar"><i class="fa fa-bars" aria-hidden="true"></i></a>
				<ul class="nav navbar-nav navbar-right user-menu pull-right">
					<li class="dropdown">
						<a href="profile.html" class="dropdown-toggle user-link" data-toggle="dropdown" title="Admin">
							<span class="user-img"><img class="img-circle" src="<?php echo base_url();?>assets/theme/light/img/user.jpg" width="40" alt="Admin">
							<span class="status online"></span></span>
							<span>Admin</span>
							<i class="caret"></i>
						</a>
						<ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('resetpassword'); ?>">Reset Password</a></li>
                            <li><a href="<?php echo base_url('profile'); ?>">Edit Profile</a></li>
							<li><a href="<?php echo base_url('admin/logout'); ?>">Logout</a></li>
						</ul>
					</li>
				</ul>
            </div>
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul id="menu">
<!--                            <li class="submenu">-->
<!--                                <a href="#" ><i class="fa fa-user fw"></i><span>&nbsp;PROFILE</span> <span class="menu-arrow"></span></a>-->
<!--                                <ul class="list-unstyled" style="display: none;">-->
<!--                                    <li><a href="--><?php //echo url('profile');?><!--"><i class="fa fa-double-angle-right"></i>PROFILE</a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
                            <li class="submenu">
                                <a href="#" ><i class="fa fa-user fw"></i><span>&nbsp;ENQUIRY</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled" style="display: none;">
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i><span>ENQUIRY</span></a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#" ><i class="fa fa-user fw"></i><span>&nbsp;SELL/LEASE</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled" style="display: none;">
                                    <li><a href="#"><i class="fa fa-double-angle-right"></i>SELL/LEASE</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#" ><i class="fa fa-user fw"></i><span>&nbsp;INSPECTION</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled" style="display: none;">
                                    <li><a href="#"><i class="fa fa-double-angle-right"></i>INSPECTION ARRANGED</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#" ><i class="fa fa-user fw"></i><span>&nbsp;FOREIGNER'S</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled" style="display: none;">
                                    <li><a href="#"><i class="fa fa-double-angle-right"></i>FOREIGNER'S HANDBOOK</a></li>
                                </ul>
                            </li>
							<li class="submenu">
								<a href="#" ><i class="fa fa-user fw"></i><span>&nbsp;ITEM</span> <span class="menu-arrow"></span></a>
								<ul class="list-unstyled" style="display: none;">
									<li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i><span>ITEM</span></a></li>
									<li><a href="<?php echo url('category');?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i><span>CATEGORY</span></a></li>
									<li><a href="<?php echo url('project');?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i><span>PROJECT</span></a></li>
								</ul>
							</li>
                            <li class="submenu">
                                <a href="#" ><i class="fa fa-user fw"></i><span>&nbsp;AGENT</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled" style="display: none;">
                                    <li><a href="<?php echo url('agent');?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i><span>AGENT</span></a></li>
                                </ul>
                            </li>

							
							
						</ul>
					</div>
                </div>
            </div>
            <div class="page-wrapper">
					 <?php echo $this->template->content; ?>
			</div>
        </div>
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
		 <script type="text/javascript" src="<?php echo base_url();?>dist/app.js" ></script>
        <?php echo $this->template->javascript; ?>
        <script type="text/javascript" src="<?php echo base_url();?>assets/theme/light/js/sweetalert/sweetalert.js" ></script>
    </body>

<!-- Mirrored from dreamguys.co.in/smarthr/light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 22 Mar 2018 04:09:39 GMT -->
</html>
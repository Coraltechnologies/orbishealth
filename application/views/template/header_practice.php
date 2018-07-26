<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="<?php echo config_item('charset');?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title><?php if(isset($title)){  echo $title; } else { echo 'Orbis Health'; } ?></title>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!-- Bootstrap -->
<link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
<!-- iCheck -->
<link href="<?php echo base_url(); ?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Switchery -->
<link href="<?php echo base_url(); ?>assets/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/custom-theme.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/fileinput.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/drop-down.css" rel="stylesheet">
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />

<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>	 
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
</head>
<body class="nav-sm">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                         <a href="index.html" class="site_title"><i class="fa"><img src="<?php echo base_url(); ?>assets/img/logo-icon.png" alt="Orbis Health"></i> <span><img src="<?php echo base_url(); ?>assets/img/logo-text.png" alt="Orbis Health"></span></a>
                    </div>
                    <div class="clearfix"></div>
                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
						<?php
						if ($this->session->userdata('User') !== FALSE) {								
							$user_session_data = $this->session->userdata('User');								
							$header_data       = validate($user_session_data);					
						?>
                        <div class="profile_pic">
                            <!--<img src="images/img.jpg" alt="..." class="img-circle profile_img">-->
							 <?php
								if(!(@$header_data['img_name']) && !(@$header_data['img_path'])){
							?>	
								<img src="<?php echo base_url(); ?>assets/img/profile-image.png" class="img-circle profile_img" alt="Profile">
							<?php
								}else{
							?>
								<img src="<?php echo base_url().'assets/uploads/'.$header_data['img_path'].$header_data['img_name']; ?>" class="img-circle profile_img" alt="Profile">
							<?php } ?>
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo ucfirst($header_data['title'].' '.$header_data['owner_name']) ?></h2>
                        </div>
						<?php } ?>
                    </div>
                    <!-- /menu profile quick info -->
                    <br/>
                    <!-- sidebar menu -->
					<?php $leftmenu = $this->acl->hasMenuAccess(); ?>
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                                <li>
                                    <a><i class="fa fa-book"></i> Diary <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display:none;">
                                        <li><a href="diary.html">Submenu</a></li>
                                        <li><a href="diary.html">Submenu</a></li>
                                        <li><a href="diary.html">Submenu</a></li>
                                    </ul>
                                </li>
                                <li><a href="#"><i class="fa fa-calendar"></i> Appointments</a></li>
                                <!--<li><a href="#"><i class="fa fa-wheelchair-alt"></i> Patients</a></li>-->
								 <li>
									<a href="#"><i class="fa fa-wheelchair-alt"></i> Patients  <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu" style="display:none;">
                                        <li><a href="<?php  echo base_url(); ?>patient_setup/manage_patients">Manage Patient</a></li>
                                        <li><a href="<?php  echo base_url(); ?>patient_setup/">New Patient</a></li>
                                    </ul>
								</li>
                                <li><a href="#"><i class="fa fa-files-o"></i> Documents</a></li>
                                <li><a href="#"><i class="fa fa-bar-chart-o"></i> Reports</a></li>
                                <li><a href="#"><i class="fa fa-tasks"></i> Tasks</a></li>
								<li>
									<a href="#"><i class="fa fa-universal-access"></i> Admin  <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu" style="display:none;">
                                        <li><a href="<?php echo base_url() ?>team_setup">Create Team</a></li>
                                        <li><a href="<?php echo base_url() ?>team_setup/manage_team">Manage Team</a></li>
                                    </ul>
								</li>
                                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                                <li><a href="#"><i class="fa fa-user-plus"></i> Account</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>
            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <div class="nav-title" style="margin: 10px auto 5px;">
                            <h1>Practice Registration - (ID : 0001)</h1>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <!--<img src="images/img.jpg" alt="">Dr. John Doe-->
									<?php
										if(!(@$header_data['img_name']) && !(@$header_data['img_path'])){
									?>	<img src="<?php echo base_url(); ?>assets/img/profile-image.png" alt="Profile">
									<?php
										}else{
									?>	<img src="<?php echo base_url().'assets/uploads/'.$header_data['img_path'].$header_data['img_name']; ?>" alt="Profile">
									<?php } ?>
									<?php echo ucfirst($header_data['title'].' '.$header_data['owner_name']) ?>
                                    <span class=" fa fa-angle-down"></span>
                                    <span class="last-login">[Last Login 12 Feb 2017 @ 16:12]</span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li><a href="javascript:;"> Profile</a></li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li><a href="javascript:;">Help</a></li>
                                    <li><a href="<?php echo base_url().'page/logout'; ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>
                            </li>
                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                    <!--<li>
                                        <a>
                                            <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                            <span>
                                                <span>John Smith</span>
                                                <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were where...
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                            <span>
                                                <span>John Smith</span>
                                                <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were where...
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                            <span>
                                                <span>John Smith</span>
                                                <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were where...
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                            <span>
                                                <span>John Smith</span>
                                                <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were where...
                                            </span>
                                        </a>	
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong>See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>-->
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->
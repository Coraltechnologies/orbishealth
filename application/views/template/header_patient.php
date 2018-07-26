<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="<?php echo config_item('charset');?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title><?php if(isset($title)){  echo $title; } else { echo 'Orbis Health'; } ?></title>
<!-- css -->	
<link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/vendors/plugins/cubeportfolio/css/cubeportfolio.min.css">
<link href="<?php echo base_url(); ?>assets/css/nivo-lightbox.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/nivo-lightbox-theme/default/default.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/css/owl.carousel.css" rel="stylesheet" media="screen" />
<link href="<?php echo base_url(); ?>assets/css/owl.theme.css" rel="stylesheet" media="screen" />
<link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/drop-down.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/fileinput.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dashboard1.css">
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
<!-- boxed bg -->
<link id="bodybg" href="<?php echo base_url(); ?>assets/bodybg/bg1.css" rel="stylesheet" type="text/css" />
<!-- template skin -->
<link id="t-colors" href="<?php echo base_url(); ?>assets/vendors/color/default.css" rel="stylesheet">

<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>	 
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<style type="text/css">
    .btn:hover {
        color: #fff;
        background-color: #1f9f78;
        border-color: #1f9f78;
    }
    .btn:focus {
        color: #fff;
        background-color: #1f9f78;
        border-color: #1f9f78;
    }
    .actionBar {
        width: 100%;
        border-top: 1px solid #ddd;
        padding: 10px 5px;
        text-align: right;
        margin-top: 10px;
    }
    .upload_btn{
        position: absolute;
        font-size: 50px;
        opacity: 0;
        right: 0;
        top: 0;
    }
</style>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">

	<div id="">
	<section  class="home-section">
		<div class="container-fluid">
			<div class="row dashwrap">
				<aside class="width-full">
					<div id="sideNav">
						<div id="mySidenav" class="sidebar left">
							<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" style="background-color: #fff;">
								<div class="navbar-header page-scroll row dashlogowrap">
									<div class="text-center">
										<span class="closeside"><i class="fa fa-close" style="font-size:36px;color:#000;"></i></span>
									</div>
									<a class="navbar-brand" href="index.html">
										<img src="<?php echo base_url(); ?>assets/img/logo-text.png" alt="Orbis Health" width="230" height="52" class="largelogo" />
										<img src="<?php echo base_url(); ?>assets/img/logo-icon.png" alt="Orbis Health" width="50" height="52" class="smalllogo" />
									 </a>
								</div>
							</div>	<!-- <div class="pull-right" style="margin-top:-30px;"> </div> -->
							<?php $leftmenu = $this->acl->hasMenuAccess(); ?>
							<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" style="margin-top: 35px;">
								<div class="row">
									<ul class="list-sidebar">
										<li class="active"><a href="#" data-target-id="home"><i class="fa fa-dashboard"></i><span class="nav-label">Dashboard</span></a></li>
										<li><a href="#" data-target-id="Profile" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-fw"></i><span class="nav-label">My Profile</span> </a>
		
		
										</li>
										<li><a href="#" data-target-id="Activity" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar fa-fw"></i><span class="nav-label">Bookings</span> </a></li>	
										<li><a href="#" data-target-id="alerts"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color:red;"></i><span class="nav-label"> Alerts / Notifications</span></a></li>
										<li><a href="#" data-target-id="Prescriptions"><i class="fa fa-book fa-fw"></i><span class="nav-label"> My Prescriptions</span></a></li>
										<li><a href="#" data-target-id="Invoices"><i class="fa fa-info-circle fa-fw"></i> <span class="nav-label">Invoices</span></a></li>
		
										<li><a href="#" data-target-id="fami" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users fa-fw"></i><span class="nav-label"> Family</span></a></li>	
										<li><a href="#menu1" data-target-id="healt" class="dropdown-toggle" data-toggle="collapse"><i class="fa fa-heart fa-fw"></i><span class="nav-label"> Your Health</span> <span class="pull-right"><i class="fa fa-angle-down" aria-hidden="true"></i></span></a>
											<ul id="menu1" class="collapse">
												<li>
													<a href="#" data-target-id="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="nav-label"> Blood Pressure</span></a>
												</li>
												<li>
													<a href="#" data-target-id="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-long-arrow-up" aria-hidden="true"></i><span class="nav-label"> Height & Weight</span></a>
												</li>
												<li>
													<a href="#" data-target-id="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-glass" aria-hidden="true"></i><span class="nav-label"> Alcohol</span></a>
												</li>
												<li>
													<a href="#" data-target-id="smoking" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-magic" aria-hidden="true"></i><span class="nav-label"> Smoking</span></a>
												</li>
												<li>
													<a href="#" data-target-id="exercisecont" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-universal-access"></i> <span class="nav-label">Exercise</span></a>
												</li>
												<li>
													<a href="#" data-target-id="dietContent" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cutlery" aria-hidden="true"></i> <span class="nav-label">Diet</span></a>
												</li>
											</ul>
		
										</li>	
										<li><a href="#" data-target-id="gpdetail" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-md fa-fw"></i><span class="nav-label"> GP</span></a></li>		
										<li><a href="#" data-target-id="chemistdetail" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-medkit fa-fw"></i><span class="nav-label"> Chemist</span></a></li>	
										<li><a href="#" data-target-id="carerdetails" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cubes fa-fw"></i><span class="nav-label"> Carer</span></a></li>
										<li><a href="#" data-target-id="uploadsdoc" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-upload fa-fw"></i><span class="nav-label"> Uploads</span></a></li>	
		
										<li><a href="#" data-target-id="InstallationJobs"><i class="fa fa-credit-card fa-fw"></i><span class="nav-label"> Wallet </span></a></li>
		
										<li><a href="#" data-target-id="Settings"><i class="fa fa-cogs fa-fw"></i> <span class="nav-label">Settings</span></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</aside>
				<div class="dashboard-wrapper pl250">
				<nav class="navbar navbar-custom" role="navigation">
					<div class="container-fluid navigation">            
						<div class="navbar-header">
							<a href="#" class="button-left p15" style=""><span class="fa fa-fw fa-bars "></span></a>
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
									<i>MENU</i>
								</button>
						</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
						  <ul class="nav navbar-nav">
								<li class="active"><a href="index.html">Home</a></li>
								<li><a href="#">Patients</a></li>
								<li><a href="#">Professionals</a></li>                          
								<li><a href="#">Practice</a></li>
								<li class="btn btn-xs btn-success dropdown login-dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-lock"></span> My Account <span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><div class="mb5"><a href="#"><button class="btn-md btn-success login-menu btn-block">&nbsp; DASHBOARD &nbsp;</button></a></div></li>
										<li><div  class="mb5"><a href="#"><button class="btn-md btn-success login-menu btn-block">&nbsp; MY PROFILE  &nbsp;</button></a></div></li>
										<li><div class="mb5"><a href="<?php echo base_url().'page/logout'; ?>"><button class="btn-md btn-success login-menu btn-block">&nbsp; LOGOUT &nbsp;</button></a></div></li>
									</ul>
								</li>
							</ul>
						</div>
						<!-- /.navbar-collapse -->
					</div>
					<!-- /.container -->
				</nav>
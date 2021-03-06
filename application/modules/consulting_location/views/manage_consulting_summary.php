<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Orbis Health</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/switchery/dist/switchery.min.css" rel="stylesheet" />
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/custom-theme.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/fileinput.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/drop-down.css" rel="stylesheet" />
    <style>
        .accor_padding {
            padding: 5px 0px;
        }
        .sucess {
            color: green;
        }
    </style>
</head>
<body class="nav-sm">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa"><img src="images/logo-icon.png" alt="Think Doctor"></i> <span><img src="images/logo-text.png" alt="Think Doctor"></span></a>
                    </div>
                    <div class="clearfix"></div>
                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>John Doe</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->
                    <br />
                    <!-- sidebar menu -->
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
                                <li><a href="#"><i class="fa fa-wheelchair-alt"></i> Patients</a></li>
                                <li><a href="#"><i class="fa fa-files-o"></i> Documents</a></li>
                                <li><a href="#"><i class="fa fa-bar-chart-o"></i> Reports</a></li>
                                <li><a href="#"><i class="fa fa-tasks"></i> Tasks</a></li>
                                <li><a href="#"><i class="fa fa-universal-access"></i> Admin</a></li>
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
                            <h1>Consutling Location Summary</h1>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="#" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="images/img.jpg" alt="">Dr. John Doe
                                    <span class=" fa fa-angle-down"></span>
                                    <span class="last-login">[Last Login 12 Feb 2017 @ 16:12]</span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li><a href="javascript:;"> Profile</a></li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li><a href="javascript:;">Help</a></li>
                                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>
                            </li>
                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
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
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->
            <!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->
                <form class="form-horizontal form-label-left row custom_temp">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="x_panel" id="printableArea">
                            <div class="x_title">
                                <h2>Consutling Location Summary <span class="patient-status" data-toggle="tooltip" data-title="Active" data-original-title="" title="" aria-describedby="tooltip812493"><i class="fa fa-check-square"></i></span></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li> <input type="button" onclick="printDiv('printableArea')" class="btn btn-md btn-success" value="Print"></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title accor_padding">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><i class="fa fa-plus-circle" aria-hidden="true"></i> Apollo Hospital  - Guindy Chennai.</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="col-md-7 col-sm-6 col-xs-12 ">
                                                <p><b>Address</b> : No : 12, Race Course Road, Guindy, Chennai - 600083.</p>
                                                <p>
                                                    <b>Parking</b> : Parking - off road
                                                </p>
                                            </div>

                                            <div class="col-md-5 col-sm-6 col-xs-12 padding-null">
                                                <div class="col-md-6 col-sm-6 col-xs-12 padding-null">
                                                    <h2><a data-toggle="collapse" href="#" onclick="myFunction()" class="ConsultingRooms" style="font-size: 18px;color: #27ae60;font-weight: 600;"><img src="images/icons/consulting-room-icon.png" /> Consulting Rooms </a></h2>
                                                </div>


                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <h2><a href="#" onclick="my1Function()" class="viewTeam" style="font-size: 18px;color: #27ae60;font-weight: 600;"><img src="images/icons/view-team.png" /> View Team</a> </h2>
                                                </div>


                                            </div>
                                            <div>
                                                <div class="col-md-12 col-sm-6 col-xs-12 padding-null">
                                                    <div id="consuting-rooms" class="x_panel">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Consulting Rooms</th>
                                                                    <th>Status</th>
                                                                    <th>Assigned Team</th>
                                                                    <th style="width:7%;">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Consulting Room 1 </td>
                                                                    <td> Active <img src="images/icon_15/verified.png" /></td>
                                                                    <td>Dr Jhon Dee, Dr Abhinav,  Dr Jenny</td>
                                                                    <td>
                                                                        <div class="action-icon" align="center">
                                                                            <a href="#"><i class="fa  fa-pencil-square" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa   fa-trash" data-toggle="tooltip" data-title="Delete" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Consulting Room 2, Consulting Room 3 </td>
                                                                    <td> Active <img src="images/icon_15/verified.png" /></td>
                                                                    <td>Dr Jhon Dee</td>

                                                                    <td>
                                                                        <div class="action-icon" align="center">
                                                                            <a href="#"><i class="fa  fa-pencil-square" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa   fa-trash" data-toggle="tooltip" data-title="Delete" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Consulting Room 1, Consulting Room 3,</td>
                                                                    <td> Active <img src="images/icon_15/verified.png" /></td>
                                                                    <td>Consulting Room 3 </td>
                                                                    <td>
                                                                        <div class="action-icon" align="center">
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-6 col-xs-12 padding-null">
                                                    <div id="view-team" class="">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="x_panel" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08);">
                                                                    
                                                                    <div>
                                                                        <div class="row">
                                                                            <div class="padding-null one box-filter">
                                                                                <div>
                                                                                    <div class="container-fluid mg-team-header">
                                                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                                                            <div class="profile__header">
                                                                                                <h3 style="font-size:17px;">Mr.Karthik  Mcom <small>(CA)</small></h3>
                                                                                                <p></p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                                                            <div class="profile__header">
                                                                                                <h3 style="font-size:17px;">Accountant</h3>
                                                                                                <p></p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                                                            <div class="profile__header">
                                                                                                <h3 style="font-size:17px;">Status <i class="fa fa-check customer-details-active" data-toggle="tooltip" data-title="Active now" aria-hidden="true" data-original-title="" title=""></i></h3>
                                                                                                <p></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="x_panel">
                                                                                        <div class="col-md-4 col-sm-12 col-xs-12 padding-null">
                                                                                            <div class="profile__avatar-2 ">
                                                                                                <img src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/1.jpg" alt="...">
                                                                                            </div>
                                                                                            <div class="profile__header">
                                                                                                <h3 style="font-size:17px;"><small style="color:blue;"> Male</small></h3>
                                                                                                <p class="text-muted text-cus">
                                                                                                    <strong>Age:</strong> 23 &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <strong>DOB:</strong> 12/01/1998
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-2 col-sm-12 col-xs-12 ">
                                                                                            <div class="profile__header">
                                                                                                <h3 style="font-size:14px;"></h3>
                                                                                                <p class="text-muted text-cus">

                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-12 col-xs-12 padding-null">
                                                                                            <div class="col-md-5 col-sm-12 col-xs-12 padding-null">
                                                                                                <div class="profile__header">
                                                                                                    <h3 style="font-size:14px;">Start Date</h3>
                                                                                                    <h3 style="font-size:12px;">02/11/1990</h3>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-5 col-sm-12 col-xs-12 padding-null">
                                                                                                <div class="profile__header">
                                                                                                    <h3 style="font-size:14px;">End Date</h3>
                                                                                                    <h3 style="font-size:12px;">02/11/1995</h3>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-2 col-xs-12 action-icon reminder-action-icon padding-null">
                                                                                                <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""></i></a>
                                                                                                <a href="#"><i class="fa fa-chevron-circle-down" data-toggle="tooltip" data-title="View More" data-original-title="" title=""></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="padding-null two box-filter">
                                                                                <div>
                                                                                    <div class="container-fluid mg-team-header">
                                                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                                                            <div class="profile__header">
                                                                                                <h3 style="font-size:17px;">Dr.Bharathi  MBBS , FRCS</h3>
                                                                                                <p></p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                                                            <div class="profile__header">
                                                                                                <h3 style="font-size:17px;">General Practitioner</h3>
                                                                                                <p></p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                                                            <div class="profile__header">
                                                                                                <h3 style="font-size:17px;">Status <i class="fa fa-check customer-details-active" data-toggle="tooltip" data-title="Active now" aria-hidden="true" data-original-title="" title=""></i></h3>
                                                                                                <p></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="x_panel">
                                                                                        <div class="col-md-4 col-sm-12 col-xs-12 padding-null">
                                                                                            <div class="profile__avatar-2 ">
                                                                                                <img src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/4.jpg" alt="...">
                                                                                            </div>
                                                                                            <div class="profile__header">
                                                                                                <h3 style="font-size:17px;"><small style="color:blue;"> Female</small></h3>
                                                                                                <p class="text-muted text-cus">
                                                                                                    <strong>Age:</strong> 23 &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <strong>DOB:</strong> 12/01/1990
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-2 col-sm-12 col-xs-12 ">
                                                                                            <div class="profile__header">
                                                                                                <h3 style="font-size:14px;">Prof Reg No</h3>
                                                                                                <p class="text-muted text-cus">
                                                                                                    <strong>GMC0987654321 </strong><br><small style="color:red;"> (Expiry Date 19-08-2019)</small>
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-12 col-xs-12 padding-null">
                                                                                            <div class="col-md-5 col-sm-12 col-xs-12 padding-null">
                                                                                                <div class="profile__header">
                                                                                                    <h3 style="font-size:14px;">Start Date</h3>
                                                                                                    <h3 style="font-size:12px;">02/11/1990</h3>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-5 col-sm-12 col-xs-12 padding-null">
                                                                                                <div class="profile__header">
                                                                                                    <h3 style="font-size:14px;">End Date</h3>
                                                                                                    <h3 style="font-size:12px;">02/11/1995</h3>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-2 col-xs-12 action-icon reminder-action-icon padding-null">
                                                                                                <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""></i></a>
                                                                                                <a href="#"><i class="fa fa-chevron-circle-down" data-toggle="tooltip" data-title="View More" data-original-title="" title=""></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="padding-null three box-filter">
                                                                                <div>
                                                                                    <div class="container-fluid mg-team-header">
                                                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                                                            <div class="profile__header">
                                                                                                <h3 style="font-size:17px;">Miss.Krishna Veni  Bsc <small>(Nursing)</small></h3>
                                                                                                <p></p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                                                            <div class="profile__header">
                                                                                                <h3 style="font-size:17px;">Nurse</h3>
                                                                                                <p></p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                                                            <div class="profile__header">
                                                                                                <h3 style="font-size:17px;">Status <i class="fa fa-check customer-details-active" data-toggle="tooltip" data-title="Active now" aria-hidden="true" data-original-title="" title=""></i></h3>
                                                                                                <p></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="x_panel">
                                                                                        <div class="col-md-4 col-sm-12 col-xs-12 padding-null">
                                                                                            <div class="profile__avatar-2 ">
                                                                                                <img src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/6.jpg" alt="...">
                                                                                            </div>
                                                                                            <div class="profile__header">
                                                                                                <h3 style="font-size:17px;"><small style="color:blue;"> Female</small></h3>
                                                                                                <p class="text-muted text-cus">
                                                                                                    <strong>Age:</strong> 23 &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <strong>DOB:</strong> 12/01/1990
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-2 col-sm-12 col-xs-12 ">
                                                                                            <div class="profile__header">
                                                                                                <h3 style="font-size:14px;"></h3>
                                                                                                <p class="text-muted text-cus">

                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6 col-sm-12 col-xs-12 padding-null">
                                                                                            <div class="col-md-5 col-sm-12 col-xs-12 padding-null">
                                                                                                <div class="profile__header">
                                                                                                    <h3 style="font-size:14px;">Start Date</h3>
                                                                                                    <h3 style="font-size:12px;">02/11/1990</h3>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-5 col-sm-12 col-xs-12 padding-null">
                                                                                                <div class="profile__header">
                                                                                                    <h3 style="font-size:14px;">End Date</h3>
                                                                                                    <h3 style="font-size:12px;">02/11/1995</h3>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-2 col-xs-12 action-icon reminder-action-icon padding-null">
                                                                                                <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""></i></a>
                                                                                                <a href="#"><i class="fa fa-chevron-circle-down" data-toggle="tooltip" data-title="View More" data-original-title="" title=""></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <br />
                                            <div class="col-md-6 col-sm-6 col-xs-12" style="font-size: 12px;">
                                                <table class="table table-striped table-bordered">
                                                    <thead>

                                                        <tr>
                                                            <th>Weeks</th>
                                                            <th><i class="fa fa-coffee" aria-hidden="true"></i> Morning</th>
                                                            <th>
                                                                <i class="fa fa-sun-o" aria-hidden="true"></i>
                                                                Afternoon
                                                            </th>
                                                            <th><i class="fa fa-moon-o" aria-hidden="true"></i> Evening</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Monday</td>
                                                            <td>09:00 - 11:00 AM</td>
                                                            <td>01:00 - 03:00 PM</td>
                                                            <td>06:00 - 09:00 PM</td>

                                                        </tr>
                                                        <tr>
                                                            <td>Tuesday</td>
                                                            <td>09:00 - 11:00 AM</td>
                                                            <td>01:00 - 03:00 PM</td>
                                                            <td>06:00 - 09:00 PM</td>

                                                        </tr>
                                                        <tr>
                                                            <td>Wednesday</td>
                                                            <td>09:00 - 11:00 AM</td>
                                                            <td>01:00 - 03:00 PM</td>
                                                            <td>06:00 - 09:00 PM</td>

                                                        </tr>
                                                        <tr>
                                                            <td>Thurday</td>
                                                            <td colspan="3" class="sucess text-center"><b>---  24/7 Open ---</b></td>


                                                        </tr>
                                                        <tr>
                                                            <td>Friday</td>
                                                            <td colspan="3" class="text-center danger"><b>---  Closed  ---</b></td>


                                                        </tr>
                                                        <tr>
                                                            <td>Saturday</td>
                                                            <td colspan="3" class="sucess text-center"><b>---  24/7 Open ---</b></td>


                                                        </tr>
                                                        <tr>
                                                            <td>Sunday</td>
                                                            <td colspan="3" class="text-center danger"><b>---  Closed  ---</b></td>


                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <div class="holiday-wrapper">
                                                    Bank Holiday : 30 July 2017<br>
                                                    Easter Day : 15 August 2017
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="x_panel" style="height: 274px;">
                                                    <div class="x_title">
                                                        <h2>Services</h2>

                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <p class="service-list">
                                                            <b> ENT</b>
                                                        </p>
                                                        <p class="service-list">
                                                            <b> Xrays</b>
                                                        </p>
                                                        <p>
                                                            <b> Genral Practice</b>
                                                        </p>
                                                        <p class="service-list">
                                                            <b> Surgon</b>
                                                        </p>
                                                        <p class="service-list">
                                                            <b> Orthopetic</b>
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="preview col-md-3">
                                                <div class="x_title">
                                                    <h2>Photo's & Videos</h2>

                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="preview-pic tab-content">
                                                    <div class="tab-pane active" id="pic-1"><img src="images/colsulting_room_imges/1.jpg"></div>
                                                    <div class="tab-pane" id="pic-2"><img src="images/colsulting_room_imges/4.jpg"></div>
                                                    <div class="tab-pane" id="pic-3"><img src="images/colsulting_room_imges/2.jpg"></div>
                                                    <div class="tab-pane" id="pic-4"><img src="images/colsulting_room_imges/3.jpg"></div>
                                                    <div class="tab-pane" id="pic-5"><img src="images/colsulting_room_imges/4.jpg"></div>
                                                </div>
                                                <ul class="preview-thumbnail nav nav-tabs">
                                                    <li class="active"><a data-target="#pic-1" data-toggle="tab" aria-expanded="true"><img src="images/colsulting_room_imges/1.jpg"></a></li>
                                                    <li><a data-target="#pic-2" data-toggle="tab" aria-expanded="true"><img src="images/colsulting_room_imges/4.jpg"></a></li>
                                                    <li><a data-target="#pic-3" data-toggle="tab" aria-expanded="true"><img src="images/colsulting_room_imges/2.jpg"></a></li>
                                                    <li><a data-target="#pic-4" data-toggle="tab" aria-expanded="true"><img src="images/colsulting_room_imges/3.jpg"></a></li>
                                                    <li><a data-target="#pic-5" data-toggle="tab" aria-expanded="true"><img src="images/colsulting_room_imges/4.jpg"></a></li>
                                                </ul>

                                            </div>

                                            <div class="col-md-12 col-sm-6 col-xs-12" style="margin-top:20px;">
                                                <p style="font-size: 15px;">
                                                    <b>Assigned Doctor</b> : Dr. John Doe.
                                                    <br /><b>Address </b> : 123, Street name,
                                                    City name, State - 12345,<br />
                                                    <b>Tel </b> : +0123456789<br />
                                                    <b>Email </b> : johndoe@.com
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title accor_padding">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Apollo Hospital  - T.Nagar Chennai.</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">

                                            <p><b>Address</b>:No : 121/2, North Usman Road, T.Nagar Chennai - 600084.</p>
                                            <p>
                                                <b>Parking</b> : Parking - off road
                                            </p>
                                            <hr>
                                            <div class="col-md-6 col-sm-6 col-xs-12" style="font-size: 12px;">
                                                <table class="table table-striped table-bordered">
                                                    <thead>

                                                        <tr>
                                                            <th>Weeks</th>
                                                            <th><i class="fa fa-coffee" aria-hidden="true"></i> Morning</th>
                                                            <th>
                                                                <i class="fa fa-sun-o" aria-hidden="true"></i>
                                                                Afternoon
                                                            </th>
                                                            <th><i class="fa fa-moon-o" aria-hidden="true"></i> Evening</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Monday</td>
                                                            <td>09:00 - 11:00 AM</td>
                                                            <td>01:00 - 03:00 PM</td>
                                                            <td>06:00 - 09:00 PM</td>

                                                        </tr>
                                                        <tr>
                                                            <td>Tuesday</td>
                                                            <td>09:00 - 11:00 AM</td>
                                                            <td>01:00 - 03:00 PM</td>
                                                            <td>06:00 - 09:00 PM</td>

                                                        </tr>
                                                        <tr>
                                                            <td>Wednesday</td>
                                                            <td>09:00 - 11:00 AM</td>
                                                            <td>01:00 - 03:00 PM</td>
                                                            <td>06:00 - 09:00 PM</td>

                                                        </tr>
                                                        <tr>
                                                            <td>Thurday</td>
                                                            <td colspan="3" class="sucess text-center"><b>---  24/7 Open ---</b></td>


                                                        </tr>
                                                        <tr>
                                                            <td>Friday</td>
                                                            <td colspan="3" class="text-center danger"><b>---  Closed  ---</b></td>


                                                        </tr>
                                                        <tr>
                                                            <td>Saturday</td>
                                                            <td colspan="3" class="sucess text-center"><b>---  24/7 Open ---</b></td>


                                                        </tr>
                                                        <tr>
                                                            <td>Sunday</td>
                                                            <td colspan="3" class="text-center danger"><b>---  Closed  ---</b></td>


                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <div class="holiday-wrapper">
                                                    Bank Holiday : 30 July 2017<br>
                                                    Easter Day : 15 August 2017
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="x_panel" style="height: 274px;">
                                                    <div class="x_title">
                                                        <h2>Services</h2>

                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <p class="service-list">
                                                            <b> ENT</b>
                                                        </p>
                                                        <p class="service-list">
                                                            <b> Xrays</b>
                                                        </p>
                                                        <p>
                                                            <b> Genral Practice</b>
                                                        </p>
                                                        <p class="service-list">
                                                            <b> Surgon</b>
                                                        </p>
                                                        <p class="service-list">
                                                            <b> Orthopetic</b>
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="preview col-md-3">
                                                <div class="x_title">
                                                    <h2>Photo's & Videos</h2>

                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="preview-pic tab-content">
                                                    <div class="tab-pane active" id="pic-1"><img src="images/colsulting_room_imges/1.jpg"></div>
                                                    <div class="tab-pane" id="pic-2"><img src="images/colsulting_room_imges/4.jpg"></div>
                                                    <div class="tab-pane" id="pic-3"><img src="images/colsulting_room_imges/2.jpg"></div>
                                                    <div class="tab-pane" id="pic-4"><img src="images/colsulting_room_imges/3.jpg"></div>
                                                    <div class="tab-pane" id="pic-5"><img src="images/colsulting_room_imges/4.jpg"></div>
                                                </div>
                                                <ul class="preview-thumbnail nav nav-tabs">
                                                    <li class="active"><a data-target="#pic-1" data-toggle="tab" aria-expanded="true"><img src="images/colsulting_room_imges/1.jpg"></a></li>
                                                    <li><a data-target="#pic-2" data-toggle="tab" aria-expanded="true"><img src="images/colsulting_room_imges/4.jpg"></a></li>
                                                    <li><a data-target="#pic-3" data-toggle="tab" aria-expanded="true"><img src="images/colsulting_room_imges/2.jpg"></a></li>
                                                    <li><a data-target="#pic-4" data-toggle="tab" aria-expanded="true"><img src="images/colsulting_room_imges/3.jpg"></a></li>
                                                    <li><a data-target="#pic-5" data-toggle="tab" aria-expanded="true"><img src="images/colsulting_room_imges/4.jpg"></a></li>
                                                </ul>

                                            </div>
                                            <div class="col-md-12 col-sm-6 col-xs-12" style="margin-top:20px;">
                                                <p style="font-size: 15px;">
                                                    <b>Assigned Doctor</b> : Dr. John Doe.
                                                    <br><b>Tel </b> : +0123456789<br />
                                                    <b>Email </b> : johndoe@.com
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title accor_padding">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><i class="fa fa-plus-circle" aria-hidden="true"></i> Apollo Hospital  - Vadapalani Chennai.</a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">

                                            <p><b>Address</b>:No : 32, 1st Floor , 100 feet Road, Vadapalani, Chennai - 600085.</p>
                                            <p>
                                                <b>Parking</b> : Parking - off road
                                            </p>
                                            <hr>
                                            <div class="col-md-6 col-sm-8 col-xs-12" style="font-size: 12px;">
                                                <table class="table table-striped table-bordered">
                                                    <thead>

                                                        <tr>
                                                            <th>Weeks</th>
                                                            <th><i class="fa fa-coffee" aria-hidden="true"></i> Morning</th>
                                                            <th>
                                                                <i class="fa fa-sun-o" aria-hidden="true"></i>
                                                                Afternoon
                                                            </th>
                                                            <th><i class="fa fa-moon-o" aria-hidden="true"></i> Evening</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Monday</td>
                                                            <td>09:00 - 11:00 AM</td>
                                                            <td>01:00 - 03:00 PM</td>
                                                            <td>06:00 - 09:00 PM</td>

                                                        </tr>
                                                        <tr>
                                                            <td>Tuesday</td>
                                                            <td>09:00 - 11:00 AM</td>
                                                            <td>01:00 - 03:00 PM</td>
                                                            <td>06:00 - 09:00 PM</td>

                                                        </tr>
                                                        <tr>
                                                            <td>Wednesday</td>
                                                            <td>09:00 - 11:00 AM</td>
                                                            <td>01:00 - 03:00 PM</td>
                                                            <td>06:00 - 09:00 PM</td>

                                                        </tr>
                                                        <tr>
                                                            <td>Thurday</td>
                                                            <td colspan="3" class="sucess text-center"><b>---  24/7 Open ---</b></td>


                                                        </tr>
                                                        <tr>
                                                            <td>Friday</td>
                                                            <td colspan="3" class="text-center danger"><b>---  Closed  ---</b></td>


                                                        </tr>
                                                        <tr>
                                                            <td>Saturday</td>
                                                            <td colspan="3" class="sucess text-center"><b>---  24/7 Open ---</b></td>


                                                        </tr>
                                                        <tr>
                                                            <td>Sunday</td>
                                                            <td colspan="3" class="text-center danger"><b>---  Closed  ---</b></td>


                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <div class="holiday-wrapper">
                                                    Bank Holiday : 30 July 2017<br>
                                                    Easter Day : 15 August 2017
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="x_panel" style="height: 274px;">
                                                    <div class="x_title">
                                                        <h2>Services</h2>

                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <p class="service-list">
                                                            <b> ENT</b>
                                                        </p>
                                                        <p class="service-list">
                                                            <b> Xrays</b>
                                                        </p>
                                                        <p>
                                                            <b> Genral Practice</b>
                                                        </p>
                                                        <p class="service-list">
                                                            <b> Surgon</b>
                                                        </p>
                                                        <p class="service-list">
                                                            <b> Orthopetic</b>
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="preview col-md-3">
                                                <div class="x_title">
                                                    <h2>Photo's & Videos</h2>

                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="preview-pic tab-content">
                                                    <div class="tab-pane active" id="pic-1"><img src="images/colsulting_room_imges/1.jpg"></div>
                                                    <div class="tab-pane" id="pic-2"><img src="images/colsulting_room_imges/4.jpg"></div>
                                                    <div class="tab-pane" id="pic-3"><img src="images/colsulting_room_imges/2.jpg"></div>
                                                    <div class="tab-pane" id="pic-4"><img src="images/colsulting_room_imges/3.jpg"></div>
                                                    <div class="tab-pane" id="pic-5"><img src="images/colsulting_room_imges/4.jpg"></div>
                                                </div>
                                                <ul class="preview-thumbnail nav nav-tabs">
                                                    <li class="active"><a data-target="#pic-1" data-toggle="tab" aria-expanded="true"><img src="images/colsulting_room_imges/1.jpg"></a></li>
                                                    <li><a data-target="#pic-2" data-toggle="tab" aria-expanded="true"><img src="images/colsulting_room_imges/4.jpg"></a></li>
                                                    <li><a data-target="#pic-3" data-toggle="tab" aria-expanded="true"><img src="images/colsulting_room_imges/2.jpg"></a></li>
                                                    <li><a data-target="#pic-4" data-toggle="tab" aria-expanded="true"><img src="images/colsulting_room_imges/3.jpg"></a></li>
                                                    <li><a data-target="#pic-5" data-toggle="tab" aria-expanded="true"><img src="images/colsulting_room_imges/4.jpg"></a></li>
                                                </ul>

                                            </div>
                                            <div class="col-md-12 col-sm-6 col-xs-12" style="margin-top:20px;">
                                                <p style="font-size: 15px;">
                                                    <b>Assigned Doctor</b> : Dr. John Doe.
                                                    <br><b>Tel </b> : +0123456789<br />
                                                    <b>Email </b> : johndoe@.com
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Javascript file-->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
        $(document).ready(function () {
            $("#view-team").hide();
            $("#consuting-rooms").hide();
            //$(".ConsultingRooms").click(function () {
            //    $("#view-team").hide();
            //    $("#consuting-rooms").show();
            //});
            //$(".viewTeam").click(function () {
            //    $("#view-team").show();
            //    $("#consuting-rooms").hide();
            //});
        });
    </script>
    <script>
        function myFunction() {
            var x = document.getElementById("consuting-rooms");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
        function my1Function() {
            var x = document.getElementById("view-team");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
</body>
</html>
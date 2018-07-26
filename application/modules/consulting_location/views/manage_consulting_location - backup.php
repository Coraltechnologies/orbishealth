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
	<link href="<?php echo base_url(); ?>assets/css/listbox.css" rel="stylesheet">
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
                        <a href="index.html" class="site_title"><i class="fa"><img src="<?php echo base_url(); ?>assets/img/logo-icon.png" alt="Orbis Health"></i> <span><img src="<?php echo base_url(); ?>assets/img/logo-text.png" alt="Orbis Health"></span></a>
                    </div>
                    <div class="clearfix"></div>
                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="<?php echo base_url(); ?>assets/img/profile-image.png" alt="..." class="img-circle profile_img">
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
                                    <li>
									<a href="<?php echo base_url() ?>consulting_location/"  class="btn btn-md btn-success"><i class="fa fa-plus"></i> Add Location</a>
									<!--<input type="button" onclick="printDiv('printableArea')" class="btn btn-md btn-success" value="Print"></li>-->
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-group" id="accordion">
							
							
							
							<?php
							$row	=1;
								foreach($details as $d_key =>$d_val){
									$d_val			= (array)$d_val;
									$this->db->where('consulting_venue_id', $d_val['id']); 
									$documents			 = $this->db->get('consulting_venue_documents')->result_array();
									$this->db->where('consulting_venue_id', $d_val['id']);
								 	$services			 = $this->db->get('consulting_services_details')->result_array();
									$this->db->where('consulting_venue_id', $d_val['id']);
								 	$consulting_hours	 = $this->db->get('consulting_hours')->result_array();	
									
									//print_r($documents);
								//	print_r($services);
									//print_r($consulting_hours);
									
							?>
							
								<div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title accor_padding">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $row ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i>
											<?php echo $d_val['consulting_name'].' - '.$d_val['address'] ?>
										</a>
										<a class="pull-right" href="<?php echo  base_url() ?>consulting_location/index/<?php echo $this->encryptionfunction->enCrypt($d_val['id']); ?>">
											<i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""></i>
                                        </a>
										</h4>
                                    </div>
                                    <div id="collapse_<?php echo $row ?>" class="panel-collapse collapse in">
                                        <div class="panel-body">

                                            <p><b>Address</b> : <?php echo $d_val['address']  ?></p>
                                            <p>
                                               <b>Parking</b> : Parking - <?php echo $d_val['parking']  ?>
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
															<?php if($consulting_hours[0]['work_24_7'] && $consulting_hours[0]['work_24_7'] == 1 ){?>
																<td colspan="3" class="sucess text-center"><b>---  24/7 Open ---</b></td>
															<?php } else if(!$consulting_hours[0]['morn_start'] && !$consulting_hours[0]['morn_end'] && !$consulting_hours[0]['aftr_start']&& !$consulting_hours[0]['aftr_end']&& !$consulting_hours[0]['eve_start']&& !$consulting_hours[0]['eve_end']){
															?>
															    <td colspan="3" class="text-center"><b>---  Closed  ---</b></td>	
															<?php
															}else {
																if($consulting_hours[0]['morn_start'] && $consulting_hours[0]['morn_end']){
																	echo '<td>'.$consulting_hours[0]['morn_start'].' - '.$consulting_hours[0]['morn_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[0]['aftr_start'] && $consulting_hours[0]['aftr_end']){
																	echo '<td>'.$consulting_hours[0]['aftr_start'].' - '.$consulting_hours[0]['aftr_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[0]['eve_start'] && $consulting_hours[0]['eve_end']){
																	echo '<td>'.$consulting_hours[0]['eve_start'].' - '.$consulting_hours[0]['eve_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
															}  ?>
                                                         

                                                        </tr>
                                                        <tr>
                                                            <td>Tuesday</td>
                                                           <?php if($consulting_hours[1]['work_24_7'] && $consulting_hours[1]['work_24_7'] == 1 ){?>
																<td colspan="3" class="sucess text-center"><b>---  24/7 Open ---</b></td>
															<?php } else if(!$consulting_hours[1]['morn_start'] && !$consulting_hours[1]['morn_end'] && !$consulting_hours[1]['aftr_start']&& !$consulting_hours[1]['aftr_end']&& !$consulting_hours[1]['eve_start']&& !$consulting_hours[1]['eve_end']){
															?>
															    <td colspan="3" class="text-center"><b>---  Closed  ---</b></td>	
															<?php
															}else {
																if($consulting_hours[1]['morn_start'] && $consulting_hours[1]['morn_end']){
																	echo '<td>'.$consulting_hours[1]['morn_start'].' - '.$consulting_hours[1]['morn_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[1]['aftr_start'] && $consulting_hours[1]['aftr_end']){
																	echo '<td>'.$consulting_hours[1]['aftr_start'].' - '.$consulting_hours[1]['aftr_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[1]['eve_start'] && $consulting_hours[1]['eve_end']){
																	echo '<td>'.$consulting_hours[1]['eve_start'].' - '.$consulting_hours[1]['eve_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
															}  ?>

                                                        </tr>
                                                        <tr>
                                                            <td>Wednesday</td>
                                                          <?php if($consulting_hours[2]['work_24_7'] && $consulting_hours[2]['work_24_7'] == 1 ){?>
																<td colspan="3" class="sucess text-center"><b>---  24/7 Open ---</b></td>
															<?php } else if(!$consulting_hours[2]['morn_start'] && !$consulting_hours[2]['morn_end'] && !$consulting_hours[2]['aftr_start']&& !$consulting_hours[2]['aftr_end']&& !$consulting_hours[2]['eve_start']&& !$consulting_hours[2]['eve_end']){
															?>
															    <td colspan="3" class="text-center"><b>---  Closed  ---</b></td>	
															<?php
															}else {
																if($consulting_hours[2]['morn_start'] && $consulting_hours[2]['morn_end']){
																	echo '<td>'.$consulting_hours[2]['morn_start'].' - '.$consulting_hours[2]['morn_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[2]['aftr_start'] && $consulting_hours[2]['aftr_end']){
																	echo '<td>'.$consulting_hours[2]['aftr_start'].' - '.$consulting_hours[2]['aftr_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[2]['eve_start'] && $consulting_hours[2]['eve_end']){
																	echo '<td>'.$consulting_hours[2]['eve_start'].' - '.$consulting_hours[2]['eve_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
															}  ?>

                                                        </tr>
                                                        <tr>
                                                            <td>Thurday</td>
                                                            <?php if($consulting_hours[3]['work_24_7'] && $consulting_hours[3]['work_24_7'] == 1 ){?>
																<td colspan="3" class="sucess text-center"><b>---  24/7 Open ---</b></td>
															<?php } else if(!$consulting_hours[3]['morn_start'] && !$consulting_hours[3]['morn_end'] && !$consulting_hours[3]['aftr_start']&& !$consulting_hours[3]['aftr_end']&& !$consulting_hours[3]['eve_start']&& !$consulting_hours[3]['eve_end']){
															?>
															    <td colspan="3" class="text-center"><b>---  Closed  ---</b></td>	
															<?php
															}else {
																if($consulting_hours[3]['morn_start'] && $consulting_hours[3]['morn_end']){
																	echo '<td>'.$consulting_hours[3]['morn_start'].' - '.$consulting_hours[3]['morn_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[3]['aftr_start'] && $consulting_hours[3]['aftr_end']){
																	echo '<td>'.$consulting_hours[3]['aftr_start'].' - '.$consulting_hours[3]['aftr_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[3]['eve_start'] && $consulting_hours[3]['eve_end']){
																	echo '<td>'.$consulting_hours[3]['eve_start'].' - '.$consulting_hours[3]['eve_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
															}  ?>


                                                        </tr>
                                                        <tr>
                                                            <td>Friday</td>
                                                            <?php if($consulting_hours[4]['work_24_7'] && $consulting_hours[4]['work_24_7'] == 1 ){?>
																<td colspan="3" class="sucess text-center"><b>---  24/7 Open ---</b></td>
															<?php } else if(!$consulting_hours[4]['morn_start'] && !$consulting_hours[4]['morn_end'] && !$consulting_hours[4]['aftr_start']&& !$consulting_hours[4]['aftr_end']&& !$consulting_hours[4]['eve_start']&& !$consulting_hours[4]['eve_end']){
															?>
															    <td colspan="3" class="text-center"><b>---  Closed  ---</b></td>	
															<?php
															}else {
																if($consulting_hours[4]['morn_start'] && $consulting_hours[4]['morn_end']){
																	echo '<td>'.$consulting_hours[4]['morn_start'].' - '.$consulting_hours[4]['morn_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[4]['aftr_start'] && $consulting_hours[4]['aftr_end']){
																	echo '<td>'.$consulting_hours[4]['aftr_start'].' - '.$consulting_hours[4]['aftr_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[4]['eve_start'] && $consulting_hours[4]['eve_end']){
																	echo '<td>'.$consulting_hours[4]['eve_start'].' - '.$consulting_hours[4]['eve_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
															}  ?>


                                                        </tr>
                                                        <tr>
                                                            <td>Saturday</td>
                                                            <?php if($consulting_hours[5]['work_24_7'] && $consulting_hours[5]['work_24_7'] == 1 ){?>
																<td colspan="3" class="sucess text-center"><b>---  24/7 Open ---</b></td>
															<?php } else if(!$consulting_hours[5]['morn_start'] && !$consulting_hours[5]['morn_end'] && !$consulting_hours[5]['aftr_start']&& !$consulting_hours[5]['aftr_end']&& !$consulting_hours[5]['eve_start']&& !$consulting_hours[0]['eve_end']){
															?>
															    <td colspan="3" class="text-center"><b>---  Closed  ---</b></td>	
															<?php
															}else {
																if($consulting_hours[5]['morn_start'] && $consulting_hours[5]['morn_end']){
																	echo '<td>'.$consulting_hours[5]['morn_start'].' - '.$consulting_hours[5]['morn_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[5]['aftr_start'] && $consulting_hours[5]['aftr_end']){
																	echo '<td>'.$consulting_hours[5]['aftr_start'].' - '.$consulting_hours[5]['aftr_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[5]['eve_start'] && $consulting_hours[5]['eve_end']){
																	echo '<td>'.$consulting_hours[5]['eve_start'].' - '.$consulting_hours[5]['eve_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
															}  ?>


                                                        </tr>
                                                        <tr>
                                                            <td>Sunday</td>
                                                            <?php if($consulting_hours[6]['work_24_7'] && $consulting_hours[6]['work_24_7'] == 1 ){?>
																<td colspan="3" class="sucess text-center"><b>---  24/7 Open ---</b></td>
															<?php } else if(!$consulting_hours[6]['morn_start'] && !$consulting_hours[6]['morn_end'] && !$consulting_hours[6]['aftr_start']&& !$consulting_hours[6]['aftr_end']&& !$consulting_hours[6]['eve_start']&& !$consulting_hours[6]['eve_end']){
															?>
															    <td colspan="3" class="text-center "><b>---  Closed  ---</b></td>	
															<?php
															}else {
																if($consulting_hours[6]['morn_start'] && $consulting_hours[6]['morn_end']){
																	echo '<td>'.$consulting_hours[6]['morn_start'].' - '.$consulting_hours[6]['morn_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[6]['aftr_start'] && $consulting_hours[6]['aftr_end']){
																	echo '<td>'.$consulting_hours[6]['aftr_start'].' - '.$consulting_hours[6]['aftr_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[6]['eve_start'] && $consulting_hours[6]['eve_end']){
																	echo '<td>'.$consulting_hours[6]['eve_start'].' - '.$consulting_hours[6]['eve_end'].'</td>';
																}else{
																	echo '<td><b>---  Closed  ---</b></td>';
																}
															}  ?>


                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <!--<div class="holiday-wrapper">
                                                    Bank Holiday : 30 July 2017<br>
                                                    Easter Day : 15 August 2017
                                                </div>-->
                                            </div>
                                            <div class="col-md-3">
                                                <div class="x_panel" style="height: 274px;">
                                                    <div class="x_title">
                                                        <h2>Services</h2>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="col-md-12">
													<?php
														foreach($services as $s_key => $s_val){
														?>
														 <p class="service-list">
                                                            <b> <?php echo $services_name[$s_val['service_id']] ?></b>
                                                        </p>
														<?php
														}
													?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="preview col-md-3">
                                                <div class="x_title">
                                                    <h2>Photo's & Videos</h2>

                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="preview-pic tab-content">
												<?php
													$i=0;
													foreach($documents as $d_key => $d_val){
														if($d_val['file_type'] =='images'){
												?>
														<div class="tab-pane <?php if($i == 0){ echo "active";} ?> " >
															<a data-target="" data-toggle="tab" aria-expanded="true"><img src="<?php echo base_url()."assets/uploads/".$d_val['file_path'].'/'.$d_val['file_name'] ?>"></a>
														</div>
												<?php	$i++;
														}else if($d_val['file_type'] =='videos'){
												?>
														 <div class="tab-pane <?php if($i == 0){ echo "active";} ?> "> 
																<video  controls>
																	<source src="<?php echo base_url()."assets/uploads/".$d_val['file_path'].'/'.$d_val['file_name'] ?>" type="video/mp4">
																	<!--<source src="<?php echo base_url()."assets/uploads/".$d_val['file_path'].'/'.$d_val['file_name'] ?>" type="video/3gp">-->
																	<!--<source src="<?php echo base_url()."assets/uploads/".$d_val['file_path'].'/'.$d_val['file_name'] ?>" type="video/avi">-->
																</video>														
														</div>
												<?php			$i++;									
														}
														
													}
												?>
												</div>
                                                <ul class="preview-thumbnail nav nav-tabs">
												
												<?php
													foreach($documents as $d_key => $d_val){
														if($d_val['file_type'] =='images'){
												?>
														<li class="active">
															<a data-target="" data-toggle="tab" aria-expanded="true"><img src="<?php echo base_url()."assets/uploads/".$d_val['file_path'].'/'.$d_val['file_name'] ?>"></a>
														</li>
												<?php
														}else if($d_val['file_type'] =='videos'){
												?>
														<li class="active">
															<a data-target="#pic-1" data-toggle="tab" aria-expanded="true">
																<video style="width:50px" controls>
																	<source src="<?php echo base_url()."assets/uploads/".$d_val['file_path'].'/'.$d_val['file_name'] ?>" type="video/mp4">
																	<!--<source src="<?php echo base_url()."assets/uploads/".$d_val['file_path'].'/'.$d_val['file_name'] ?>" type="video/3gp">-->
																	<!--<source src="<?php echo base_url()."assets/uploads/".$d_val['file_path'].'/'.$d_val['file_name'] ?>" type="video/avi">-->
																</video>
															</a>																
														</li>
												<?php												
														}
													}
												?>
                                                </ul>

                                            </div>
                                            
                                            <!--<div class="col-md-12 col-sm-6 col-xs-12" style="margin-top:20px;">
                                                <p style="font-size: 15px;">
                                                    <b>Assigned Doctor</b> : Dr. John Doe.
                                                    <br /><b>Address </b> : 123, Street name,
                                                    City name, State - 12345,<br />
                                                    <b>Tel </b> : +0123456789<br />
                                                    <b>Email </b> : johndoe@.com
                                                </p>
                                            </div>-->

                                        </div>
                                    </div>
                                </div>
							<?php		
								$row++;
								}
								
							?>
                          <!--      <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title accor_padding">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><i class="fa fa-plus-circle" aria-hidden="true"></i> Apollo Hospital  - Guindy Chennai.</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">

                                            <p><b>Address</b> : No : 12, Race Course Road, Guindy, Chennai - 600083.</p>
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
                                </div>-->
                                <!--<div class="panel panel-default">
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
                                </div>-->
								
								
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

    </script>
</body>
</html>
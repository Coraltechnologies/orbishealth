      <!-- /top navigation -->
	 <style>
        .accor_padding {
            padding: 5px 0px;
        }
        .sucess {
            color: green;
        }
    </style>
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
									$consulting_room	 = $this->common->consulting_room_list($d_val['id']);	
									$clinincian_list	 = $this->common->clinician_list($d_val['id']);	
									
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
										
											<div class="col-md-7 col-sm-6 col-xs-12 ">
                                                <p><b>Address</b> : No : 12, Race Course Road, Guindy, Chennai - 600083.</p>
                                                <p>
                                                    <b>Parking</b> : Parking - off road
                                                </p>
                                            </div>
											<!--<div class="col-md-5 col-sm-6 col-xs-12 padding-null">
                                                <div class="col-md-6 col-sm-6 col-xs-12 padding-null">
                                                    <h2><a data-toggle="collapse" href="#" onclick="myFunction(<?php echo $d_val['id']; ?>)" class="ConsultingRooms" style="font-size: 18px;color: #27ae60;font-weight: 600;"><img src="<?php echo base_url()?>assets/img/icons/consulting_room_icon.png" /> Consulting Rooms </a></h2>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <h2><a data-toggle="collapse" href="#" onclick="my1Function(<?php echo $d_val['id']; ?>)" class="viewTeam" style="font-size: 18px;color: #27ae60;font-weight: 600;"><img src="<?php echo base_url()?>assets/img/icons/view-team.png" /> View Team</a> </h2>
                                                </div>
                                            </div>-->
											<div class="col-md-12 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
												<button type="button" class="btn btn-outline-primary" onclick="myFunction(<?php echo $d_val['id']; ?>)" style="font-weight: 600;"><i class="fa fa-hospital-o" aria-hidden="true"></i> Consulting Rooms</button>
												<button type="button" class="btn btn-outline-secondary" onclick="my1Function(<?php echo $d_val['id']; ?>)" style="font-weight: 600;"><i class="fa fa-users" aria-hidden="true"></i> View Team</button>
											</div>
											
											<div>
                                                <div class="col-md-12 col-sm-6 col-xs-12 padding-null consuting-rooms" id="consulting_list_<?php echo $d_val['id']; ?>">
                                                    <div id="consuting-rooms"   class="x_panel">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Consulting Rooms</th>
                                                                    <th>Status</th>
                                                                    <th>Assigned Team</th>
                                                                    <!--<th style="width:7%;">Actions</th>-->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
																<?php 
																	//print_r($consulting_room);
																	if($consulting_room['response'] == 'success'){
																		$i= 1;
																		foreach($consulting_room['response_data'] as $c_key => $c_val){ 
																			?>
																			<tr>
																				<td>
																					<?php echo  $c_val['consulting_room_title']; ?>
																				</td>
																				<td>
																					<?php echo  $c_val['status']; ?>
																				</td>
																				<td>
																					<?php echo (isset($c_val['clinician_name']) ? $c_val['clinician_name'] :''); ?>
																				</td>
																				 
																			</tr>
																<?php	
																			$i++;
																		}
																		 
																	}else{
																?>
																	<tr>
																		<td colspan="3">No records found.. </td>
																		 
																	</tr>
																<?php
																	}
																?>
																
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-6 col-xs-12 padding-null view-team" id="team_<?php echo $d_val['id']; ?>">
                                                    <div id="view-team">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="x_panel" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08);">
                                                                    
                                                                    <div>
                                                                        <div class="row">
																		<?php if($clinincian_list['response'] !='empty' && $clinincian_list['response'] !='failed'){
																			foreach($clinincian_list['response_data'] as $u_key => $u_val){
																			?>
																			
																			<div class="one box-filter" style="padding:5px;">
                                                                                <div>
                                                                                    <div class="container-fluid mg-team-header">
                                                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                                                            <div class="profile__header">
                                                                                                <h3 style="font-size:17px;"><?php echo  $u_val['name'] ?> <small> ( <?php echo $u_val['qualifications']; ?> ) </small></h3>
                                                                                                <p></p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                                                            <div class="profile__header">
                                                                                                <h3 style="font-size:17px;"><?php echo  $u_val['role']   ?></h3>
                                                                                                <p></p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                                                            <div class="profile__header">
																								<?php 
																								$color				='';
																								if($u_val['status'] == 'inactive'){
																									$color			= 'color:red';
																								}
																								?>
                                                                                                <h3 style="font-size:17px;">Status <i class="fa fa-check customer-details-active" style="<?php echo $color; ?>" data-toggle="tooltip" aria-hidden="true" data-original-title="" title=""></i></h3>
                                                                                                <p></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                   
                                                                                </div>
                                                                            </div>
																			
																		<?php
																			}																		
																		}else{ ?>
																			<div class=" one box-filter" style="padding:5px;">
																				<div>
                                                                                    <div class="container-fluid mg-team-header">
																						<div class="col-md-12 col-sm-12 col-xs-12">
																							<div class="profile__header">
																								<h3 style="font-size:17px;">
																									No Professionals assigned..
																								</h3>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		
																		<?php } ?>
                                                                           <!-- <div class="padding-null one box-filter">
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
                                                                            </div> -->
                                                                        </div>

                                                                    </div>  
																	
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											
											 <hr>
                                            <br/>
											
											
											
											
											
                                            <div class="col-md-6 col-sm-6 col-xs-12" style="font-size: 12px;">
                                                <table class="table table-striped table-bordered">
                                                    <thead>

                                                        <tr>
                                                            <th>Weeks</th>
                                                            <th class="text-center"><i class="fa fa-coffee" aria-hidden="true"></i> Morning</th>
                                                            <th class="text-center"><i class="fa fa-sun-o" aria-hidden="true"></i> Afternoon</th>
                                                            <th class="text-center"><i class="fa fa-moon-o" aria-hidden="true"></i> Evening</th>
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
																	echo '<td class="text-center">'.$consulting_hours[0]['morn_start'].' - '.$consulting_hours[0]['morn_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[0]['aftr_start'] && $consulting_hours[0]['aftr_end']){
																	echo '<td class="text-center">'.$consulting_hours[0]['aftr_start'].' - '.$consulting_hours[0]['aftr_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[0]['eve_start'] && $consulting_hours[0]['eve_end']){
																	echo '<td>'.$consulting_hours[0]['eve_start'].' - '.$consulting_hours[0]['eve_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
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
																	echo '<td class="text-center">'.$consulting_hours[1]['morn_start'].' - '.$consulting_hours[1]['morn_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[1]['aftr_start'] && $consulting_hours[1]['aftr_end']){
																	echo '<td class="text-center">'.$consulting_hours[1]['aftr_start'].' - '.$consulting_hours[1]['aftr_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[1]['eve_start'] && $consulting_hours[1]['eve_end']){
																	echo '<td class="text-center">'.$consulting_hours[1]['eve_start'].' - '.$consulting_hours[1]['eve_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
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
																	echo '<td class="text-center">'.$consulting_hours[2]['morn_start'].' - '.$consulting_hours[2]['morn_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[2]['aftr_start'] && $consulting_hours[2]['aftr_end']){
																	echo '<td class="text-center">'.$consulting_hours[2]['aftr_start'].' - '.$consulting_hours[2]['aftr_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[2]['eve_start'] && $consulting_hours[2]['eve_end']){
																	echo '<td class="text-center">'.$consulting_hours[2]['eve_start'].' - '.$consulting_hours[2]['eve_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
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
																	echo '<td class="text-center">'.$consulting_hours[3]['morn_start'].' - '.$consulting_hours[3]['morn_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[3]['aftr_start'] && $consulting_hours[3]['aftr_end']){
																	echo '<td class="text-center">'.$consulting_hours[3]['aftr_start'].' - '.$consulting_hours[3]['aftr_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[3]['eve_start'] && $consulting_hours[3]['eve_end']){
																	echo '<td class="text-center">'.$consulting_hours[3]['eve_start'].' - '.$consulting_hours[3]['eve_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
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
																	echo '<td class="text-center">'.$consulting_hours[4]['morn_start'].' - '.$consulting_hours[4]['morn_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[4]['aftr_start'] && $consulting_hours[4]['aftr_end']){
																	echo '<td class="text-center">'.$consulting_hours[4]['aftr_start'].' - '.$consulting_hours[4]['aftr_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[4]['eve_start'] && $consulting_hours[4]['eve_end']){
																	echo '<td class="text-center">'.$consulting_hours[4]['eve_start'].' - '.$consulting_hours[4]['eve_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
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
																	echo '<td class="text-center">'.$consulting_hours[5]['morn_start'].' - '.$consulting_hours[5]['morn_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[5]['aftr_start'] && $consulting_hours[5]['aftr_end']){
																	echo '<td class="text-center">'.$consulting_hours[5]['aftr_start'].' - '.$consulting_hours[5]['aftr_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[5]['eve_start'] && $consulting_hours[5]['eve_end']){
																	echo '<td class="text-center">'.$consulting_hours[5]['eve_start'].' - '.$consulting_hours[5]['eve_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
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
																	echo '<td class="text-center">'.$consulting_hours[6]['morn_start'].' - '.$consulting_hours[6]['morn_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[6]['aftr_start'] && $consulting_hours[6]['aftr_end']){
																	echo '<td class="text-center">'.$consulting_hours[6]['aftr_start'].' - '.$consulting_hours[6]['aftr_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
																}
																if($consulting_hours[6]['eve_start'] && $consulting_hours[6]['eve_end']){
																	echo '<td class="text-center">'.$consulting_hours[6]['eve_start'].' - '.$consulting_hours[6]['eve_end'].'</td>';
																}else{
																	echo '<td class="text-center"><b>---  Closed  ---</b></td>';
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
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Javascript file-->
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
            $(".view-team").hide();
            $(".consuting-rooms").hide();
        });
    </script>
    <script>
        function myFunction(a) {
            var x = document.getElementById("consulting_list_"+a);
			var y = document.getElementById("team_"+a);
            if(x.style.display === "none") {
                x.style.display = "block";
				y.style.display = "none";
            }else{
                x.style.display = "none";
			}
        }
        function my1Function(a) {
            var x = document.getElementById("team_"+a);
			var y = document.getElementById("consulting_list_"+a);
            if (x.style.display === "none") {
                x.style.display = "block";
				y.style.display = "none";
            } else {
				x.style.display = "none";
			}
        }
	</script>
 
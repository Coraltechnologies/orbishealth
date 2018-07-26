             <!-- JQVMap -->
			<link href="<?php echo base_url();?>assets/vendors/switch/on-off-switch.css" rel="stylesheet" />
			<style>
			#upload-file-selector{
				display:block !important;
			}
			</style>
            <div class="right_col" role="main">
                <!-- top tiles -->
                <div class="form-horizontal form-label-left row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <ul class="nav nav-tabs">
						   <li class="active">
                                <a data-toggle="tab" href="#menu3">
                                    Details  <input type="checkbox" id="pDcheck3" class="flat" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#menu5" id="service_hrs">
                                    Services & Hours <input type="checkbox" id="pDcheck6" class="flat" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </a>
                            </li>

                            <li>
                                <a data-toggle="tab" href="#menu6" id="service_document">
                                    Documents <input type="checkbox" id="pDcheck7" class="flat" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </a>
                            </li>
							 <li>
								<a href="javascript:void(0);" >
									<span id="response" style="color:green"></span>
								</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="menu3" class="tab-pane fade in active">
                                <div class="x_panel">
                                    <div class="row">
                                       <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="input_fields_wrap2">
												<form action="#" method="post" enctype="multipart/form-data" id="consulting_location" name ='Consultation'>
													<div class="row">
														<div class="col-md-6 col-sm-12 col-xs-12">
															<div class="panel panel-default">
															<input type="hidden" id="location_key" value="<?php echo (isset($details['id']) ? $details['id'] : '') ?>" />
																<div class="panel-heading">Details / Address Info</div>
																<div class="panel-body" style="min-height: 413px;">
																	<div class="col-md-12 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Consulting Location Name</label><span class="asterisk" style="color:red">*</span>
																			<input id="location_name" name="Consultation[name]" type="text" class="form-control" placeholder="Consulting Location Name" value="<?php echo (isset($details['consulting_name']) ? $details['consulting_name'] : '') ?>">
																		</div>
																	</div>
																	 <div class="col-md-6 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Country</label><span class="asterisk" style="color:red">*</span>
																			<?php
																				$attr	=array('class'=>'form-control','id'=>'country_id');
																				echo form_dropdown("Consultation[country_id]", $country['name'],(isset($details['country_id']) ? $details['country_id'] : ''),$attr);
																			?>
																		</div>
																	</div>
																	<div class="col-md-6 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Postcode</label><span class="asterisk" style="color:red">*</span>
																			<input type="text" class="form-control" name="Consultation[postcode]"  placeholder="Postcode" id="zipcode" onkeyup="fill_address();" value="<?php echo (isset($details['postcode']) ? $details['postcode'] : '') ?>">
																		</div>
																	</div>
																	<div class="col-md-6 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>City / Town</label><span class="asterisk" style="color:red">*</span>
																			<input type="text" class="form-control" name="Consultation[city_town]" placeholder="City / Town" id="city_town" value="<?php echo (isset($details['city_town']) ? $details['city_town'] : '') ?>">
																		</div>
																	</div>
																	<div class="col-md-6 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>State</label><span class="asterisk" style="color:red">*</span>
																			<input type="text" class="form-control" name="Consultation[state]" placeholder="State" id="state" value="<?php echo (isset($details['state']) ? $details['state'] : '') ?>">
																		</div>
																	</div>
																	<div class="col-md-12 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Address</label><span class="asterisk" style="color:red">*</span>
																			<input type="text" class="form-control" name="Consultation[address]" placeholder="Address" id="address" onkeypress="search_address();" value="<?php echo (isset($details['address']) ? $details['address'] : '') ?>">
																		</div>
																	</div>
																</div>
															</div>
														</div>

														<div class="col-md-6 col-sm-12 col-xs-12">
															<div class="panel panel-default">
																<div class="panel-heading">Contact Details<span class="pull-right"><i onclick="clearGP()" class="fa fa-eraser" data-toggle="tooltip" data-title="Clear all data" data-original-title="" title=""></i></span></div>
																<div class="panel-body">

																	<div class="col-md-6 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Tel 1</label><span class="asterisk" style="color:red">*</span>
																			<div class="input-group">
																				<span class="input-group-addon">
																					<input type="checkbox" >
																				</span>
																				<input type="text" class="form-control" name="Consultation[tel1]" placeholder="+123 4567 890" id="tel1" value="<?php echo (isset($details['tel1']) ? $details['tel1'] : '') ?>">
																			</div>

																		</div>
																	</div>

																	<div class="col-md-6 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Email 1</label><span class="asterisk" style="color:red">*</span>
																			<div class="form-group has-feedback">
																				<input type="text" class="form-control has-feedback-left" id="email1" placeholder="Email" name="Consultation[email1]" value="<?php echo (isset($details['email1']) ? $details['email1'] : '') ?>">
																				<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
																			</div>
																		</div>
																	</div>

																	<div class="col-md-6 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Tel 2</label>
																			<div class="input-group">
																				<span class="input-group-addon">
																					<input type="checkbox" >
																				</span>
																				<input type="text" class="form-control" name="Consultation[tel2]" placeholder="+123 4567 890" id="tel2" value="<?php echo (isset($details['tel2']) ? $details['tel2'] : '') ?>">
																			</div>
																		</div>
																	</div>

																	<div class="col-md-6 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Email 2</label>
																			<div class="form-group has-feedback">
																				<input type="text" class="form-control has-feedback-left" id="email2" placeholder="Email 2" name="Consultation[email2]" value="<?php echo (isset($details['email2']) ? $details['email2'] : '') ?>">
																				<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
																			</div>
																		</div>
																	</div>

																	<div class="col-md-12 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Disable Access</label>
																			<div class="form-group">
																				<div class="radio radio-inline">
																					<label class="">
																						<div class="iradio_flat-green" style="position: relative;">
																							<input type="radio" class="flat" name="iCheck" style="position: absolute; opacity: 0;" value="yes" <?php if( isset($details['disable_access']) && $details['disable_access'] == 1){echo "checked"; } ?> >
																							<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
																						</div> Yes
																					</label>
																				</div>
																				<div class="radio radio-inline">
																					<label class="">
																						<div class="iradio_flat-green" style="position: relative;">
																							<input type="radio" class="flat" name="iCheck" style="position: absolute; opacity: 0;" value="no" <?php if( isset($details['disable_access']) && $details['disable_access'] == 0){echo "checked";}else if(!isset($details)){echo "checked";} ?>>
																							<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
																						</div> No
																					</label>
																				</div>
																			</div>
																		</div>
																	</div>

																	<div class="col-md-12 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Parking</label>
																			<div class="form-group">
																				<div class="radio-inline">
																					<label class="">
																						<div class="iradio_flat-green" style="position: relative;">
																							<input type="radio" class="flat" name="iCheck1" style="position: absolute; opacity: 0;" value="none" <?php if( isset($details['parking']) && $details['parking'] == 'None'){echo "checked"; } ?>>
																							<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
																						</div> None
																					</label>
																				</div>
																				<div class="radio-inline">
																					<label class="">
																						<div class="iradio_flat-green" style="position: relative;">
																							<input type="radio" class="flat" name="iCheck1" style="position: absolute; opacity: 0;" value="On site" <?php if( isset($details['parking']) && $details['parking'] == 'On site'){echo "checked"; } ?>>
																							<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
																						</div> On site
																					</label>
																				</div>
																				<div class="radio-inline">
																					<label class="">
																						<div class="iradio_flat-green" style="position: relative;">
																							<input type="radio" class="flat" name="iCheck1" style="position: absolute; opacity: 0;" value="Off Road" <?php if( isset($details['parking']) && $details['parking'] == 'Off Road'){echo "checked"; }else if(!isset($details)){echo "checked";} ?>>
																							<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
																						</div> Off Road
																					</label>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-12 col-sm-12 col-xs-12" id="parking_div">
																		<div class="form-group">
																			<label>Parking / Directions</label>
																			<textarea class="form-control" rows="3" placeholder="Parking / Directions" id="parking" name="Consultation[parking_dir]"><?php echo (isset($details['parking_direction']) ? $details['parking_direction'] : '') ?></textarea>
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
									<div class="actionBar">
										<a href="javascript:void(0);" class="buttonNext btn btn-success"  onclick="save_details();" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Save and Continue <i class="fa fa-angle-right" aria-hidden="true"></i></a>
									</div>
                                </div>

                            </div>

                            <div id="menu5" class="tab-pane fade in">
                                <div class="x_panel">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="input_fields_wrap2">
                                                <div class="row">
													<form action="#" method="post" enctype="multipart/form-data" id="service_hours" name ='ServiceHours'>
														<div class="col-md-4 col-sm-12 col-xs-12">
															<div class="panel panel-default">
																<div class="panel-heading">Services Details<span class="pull-right"></span></div>
																<div class="panel-body">
																	<div class="col-md-12 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Services</label>
																			<!--<div class="ms-ctn form-control ms-ctn-focus" id="ms1-autoSelect"></div>-->
																			<?php
																				$attr	=array('class'=>'multiselect-ui form-control multiservicelist multiselect-native-select','style'=>'max-height:200px','multiple'=>'multiple','id'=>'services');
																				echo form_dropdown('Services[]',$services,(isset($user_services) ? $user_services : ''),$attr);
																			?>
																		</div>
																	</div>
																</div>
															</div>
															
															
															<div class="panel panel-default">
																<div class="panel-heading">Add Consulting Room<span class="pull-right" onclick="add_room();"><i class="fa fa-plus"></i></span></div>
																<input type="hidden" value="0" id="add_consulting" />
																<div class="panel-body">
																	<div class="col-md-12 col-sm-12 col-xs-12">
																		<div class="form-group" id="consulting_room">
																		  <?php
																			if(isset($consulting_room) && !empty($consulting_room)){
																				foreach($consulting_room as $c_key => $c_val){
																				?>
																					<div class="form-control" style="padding:5px;margin:10px 0px;" id="room_area_<?php echo $c_val['id'] ?>">
																						<span>
																							<?php echo  $c_val['consulting_room_title']; ?>
																						</span>
																						<span class="pull-right"> 
																							<i class="fa fa-check-circle" id="room_status_<?php echo $c_val['id']  ?>" onclick='change_status("<?php echo $c_val['consulting_venue_id'] ?>","<?php echo $c_val['id'] ?>");' style="<?php if($c_val['status'] && $c_val['status'] == 'active'){ echo "color:#146068";}else{echo "color:#f11d1d";} ?>"></i>
																							<i class="fa fa-edit" onclick="edit_room('<?php echo  $c_val['consulting_room_title']; ?>','<?php echo $c_val['id'] ?>','<?php echo $c_val['consulting_venue_id'] ?>');"></i>
																						</span>
																					</div>
																				<?php 
																				}
																			  
																			}
																		  ?>
																		</div>
																	</div>
																</div>
															</div>
															<!--<div class="panel panel-default">
																<div class="panel-heading">Clinicians<span class="pull-right"></span></div>
																<div class="panel-body">
																	<div class="col-md-12 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Clinicians</label>
																			<div class="ms-ctn form-control ms-ctn-focus" id="ms-autoSelect"></div>
																		</div>
																	</div>
																</div>
															</div>-->
														</div>
														<div class="col-md-8 col-sm-12 col-xs-12" >
															<div class="panel panel-default">
																<div class="panel-heading">Opening Hours (Consulting Hours) <span class="pull-right"><i onclick="clearGP()" class="fa fa-eraser" data-toggle="tooltip" data-title="Clear all data" data-original-title="" title=""></i></span></div>
																<div class="panel-body">
																	<div class="col-md-12 col-sm-12 col-xs-12 padding-null table-responsive">
																	<!--<div class="col-md-12 col-sm-12 col-xs-12">-->
																		<table class="table table-striped" id="mytb">
																			<thead style="background: #f5f5f5; color: #000;">
																				<tr>
																					<th width="7%"><h5><b>Weeks</b></h5></th>
																					<th width="13%"><h5><b>Open / Close</b></h5></th>
																					<th width="7%"><h5 style="text-align:center;"><b>24/7 </b><br/><input type="checkbox" onchange="week_days(this);" title="For Week days" /></h5></th>
																					<th width="16%" style="background: #ccc;"><h5 style="text-align:center;"><b><i class="fa fa-coffee" aria-hidden="true"></i> Morning</b></h5></th>
																					<th width="16%" style="background: #b3b3b3;"><h5 style="text-align:center;"><b><i class="fa fa-sun-o" aria-hidden="true"></i> Afternoon</b></h5></th>
																					<th width="16%" style="background: #ccc;"><h5 style="text-align:center;"><b><i class="fa fa-moon-o" aria-hidden="true"></i> Evening</b></h5></th>
																				</tr>
																			</thead>
																			<tbody>
																				<tr>
																					<td>Monday</td>
																					<td>
																						<input type="checkbox" class="custom-switch1"  name="ServiceHours[1][day]" id="close_1" onchange="moCheck(1)"  <?php if(isset($consulting_hours) && !$consulting_hours[0]['work_24_7'] && !$consulting_hours[0]['morn_start'] && !$consulting_hours[0]['morn_end']  && !$consulting_hours[0]['aftr_start'] && !$consulting_hours[0]['aftr_end'] && !$consulting_hours[0]['eve_start'] && !$consulting_hours[0]['eve_end']){}else if(isset($consulting_hours) &&(($consulting_hours[0]['morn_start'] && $consulting_hours[0]['morn_end']) || ($consulting_hours[0]['aftr_start'] && $consulting_hours[0]['eve_start']) || ($consulting_hours[0]['eve_start'] && $consulting_hours[0]['eve_end']))){ echo "checked";}else{echo "checked";} ?>>
																						<div id="sub_option_1"  class="col-md-12 padding-null" style="margin-top: 10px;<?php if(isset($consulting_hours) && !$consulting_hours[0]['morn_start'] && !$consulting_hours[0]['morn_end']  && !$consulting_hours[0]['aftr_start'] && !$consulting_hours[0]['aftr_end'] && !$consulting_hours[0]['eve_start'] && !$consulting_hours[0]['eve_end']){echo "display:none";} ?>">
																							<input type="checkbox" class="mor-switch1"  name="ServiceHours[1][mor_chk]" id="mon_close_1" onchange="change_stat(1,'mor')"  <?php if(isset($consulting_hours) &&$consulting_hours[0]['morn_start'] && $consulting_hours[0]['morn_end']){echo "checked";} else if(isset($consulting_hours) && !$consulting_hours[0]['morn_start'] && !$consulting_hours[0]['morn_end']){}else{ echo "checked";} ?> >
																							<input type="checkbox" class="aftr-switch1"  name="ServiceHours[1][aftr_chk]" id="aftr_close_1" onchange="change_stat(1,'aftr')" <?php if(isset($consulting_hours) &&$consulting_hours[0]['aftr_start'] && $consulting_hours[0]['aftr_end']){echo "checked";} else if(isset($consulting_hours) && !$consulting_hours[0]['aftr_start'] && !$consulting_hours[0]['aftr_end']){}else{ echo "checked";} ?> >
																							<input type="checkbox" class="eve-switch1"  name="ServiceHours[1][eve_chk]" id="eve_close_1" onchange="change_stat(1,'eve')" <?php if(isset($consulting_hours) &&$consulting_hours[0]['eve_start'] && $consulting_hours[0]['eve_end']){echo "checked";} else if(isset($consulting_hours) &&	 !$consulting_hours[0]['eve_start'] && !$consulting_hours[0]['eve_end']){}else{ echo "checked";} ?>>
																						</div>
																					</td>
																					<td class="mclose24"> <input class="open1" type="checkbox" name="ServiceHours[1][full]"  id="service_1" onchange="moCheck(1)" <?php if(isset($consulting_hours) && $consulting_hours[0]['work_24_7'] == 1){echo "checked";}  if(isset($consulting_hours) && !$consulting_hours[0]['work_24_7'] && !$consulting_hours[0]['morn_start'] && !$consulting_hours[0]['morn_end']  && !$consulting_hours[0]['aftr_start'] && !$consulting_hours[0]['aftr_end'] && !$consulting_hours[0]['eve_start'] && !$consulting_hours[0]['eve_end']){echo "disabled";} ?> > 24/7  </td>
																					<td class="mopen" id= "morn_start_1">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "morn_input_start_1" min="00:00" max="12:00" name="ServiceHours[1][mor][start]" value="<?php echo isset($consulting_hours[0]['morn_start']) ? $consulting_hours[0]['morn_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[0]['work_24_7'] == 1 || (!$consulting_hours[0]['morn_start'] && !$consulting_hours[0]['morn_end']))){echo "visibility:hidden;";} ?>"  />	
																							</div>
																						
																							<div class="form-group">
																								<input type="time" class="form-control" id= "morn_input_end_1"  min="00:00" max="12:00" name="ServiceHours[1][mor][end]" value="<?php echo isset($consulting_hours[0]['morn_end']) ? $consulting_hours[0]['morn_end'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[0]['work_24_7'] == 1 || (!$consulting_hours[0]['morn_start'] && !$consulting_hours[0]['morn_end']))){echo "visibility:hidden;";} ?>"  />	
																							</div>
																						</div>
																					</td>
																					<td class="mopen" id= "aftr_start_1">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "aftr_input_start_1" min="12:00" max="17:00" name="ServiceHours[1][aftr][start]" value="<?php echo isset($consulting_hours[0]['aftr_start']) ? $consulting_hours[0]['aftr_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[0]['work_24_7'] == 1 || (!$consulting_hours[0]['aftr_start'] && !$consulting_hours[0]['aftr_end']))){echo "visibility:hidden;";} ?>"  />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "aftr_input_end_1" min="12:00" max="17:00" name="ServiceHours[1][aftr][end]" value="<?php echo isset($consulting_hours[0]['aftr_end']) ? $consulting_hours[0]['aftr_end'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[0]['work_24_7'] == 1 || (!$consulting_hours[0]['aftr_start'] && !$consulting_hours[0]['aftr_end']))){echo "visibility:hidden;";} ?>"  />	
																							</div>
																						</div>
																					</td>
																					<td class="mopen" id= "eve_start_1">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "eve_input_start_1" min="17:00" max="23:59" name="ServiceHours[1][eve][start]" value="<?php echo isset($consulting_hours[0]['eve_start']) ? $consulting_hours[0]['eve_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[0]['work_24_7'] == 1 || (!$consulting_hours[0]['eve_start'] && !$consulting_hours[0]['eve_end']))){echo "visibility:hidden;";} ?>"  />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "eve_input_end_1"	min="17:00" max="23:59" name="ServiceHours[1][eve][end]" value="<?php echo isset($consulting_hours[0]['eve_end']) ? $consulting_hours[0]['eve_end'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[0]['work_24_7'] == 1 || (!$consulting_hours[0]['eve_start'] && !$consulting_hours[0]['eve_end']))){echo "visibility:hidden;";} ?>"  />	
																							</div>
																						</div>
																					</td>
																				</tr>
																				<tr>
																					<td>Tuesday </td>
																					<td>
																						<input type="checkbox" class="custom-switch2" name="ServiceHours[2][day]" id="close_2" onchange="moCheck(2)" <?php if(isset($consulting_hours) && !$consulting_hours[1]['work_24_7'] && !$consulting_hours[1]['morn_start'] && !$consulting_hours[1]['morn_end']  && !$consulting_hours[1]['aftr_start'] && !$consulting_hours[1]['aftr_end'] && !$consulting_hours[1]['eve_start'] && !$consulting_hours[1]['eve_end']){}else if(isset($consulting_hours) &&(($consulting_hours[1]['morn_start'] && $consulting_hours[1]['morn_end']) || ($consulting_hours[1]['aftr_start'] && $consulting_hours[1]['eve_start']) || ($consulting_hours[1]['eve_start'] && $consulting_hours[1]['eve_end']))){ echo "checked";}else{echo "checked";} ?>>
																						
																						<div id="sub_option_2" style="<?php if(isset($consulting_hours) && !$consulting_hours[1]['morn_start'] && !$consulting_hours[1]['morn_end']  && !$consulting_hours[1]['aftr_start'] && !$consulting_hours[1]['aftr_end'] && !$consulting_hours[1]['eve_start'] && !$consulting_hours[1]['eve_end']){echo "display:none";} ?>">
																							<input type="checkbox" class="mor-switch2"  name="ServiceHours[2][mor_chk]" id="mon_close_2" onchange="change_stat(2,'mor')" <?php if(isset($consulting_hours) &&$consulting_hours[1]['morn_start'] && $consulting_hours[1]['morn_end']){echo "checked";} else if(isset($consulting_hours) && !$consulting_hours[1]['morn_start'] && !$consulting_hours[1]['morn_end']){}else{ echo "checked";} ?> >
																							<input type="checkbox" class="aftr-switch2" name="ServiceHours[2][aftr_chk]" id="aftr_close_2" onchange="change_stat(2,'aftr')" <?php if(isset($consulting_hours) &&$consulting_hours[1]['aftr_start'] && $consulting_hours[1]['aftr_end']){echo "checked";} else if(isset($consulting_hours) && !$consulting_hours[1]['aftr_start'] && !$consulting_hours[1]['aftr_end']){}else{ echo "checked";} ?>>
																							<input type="checkbox" class="eve-switch2"  name="ServiceHours[2][eve_chk]" id="eve_close_2" onchange="change_stat(2,'eve')" <?php if(isset($consulting_hours) &&$consulting_hours[1]['eve_start'] && $consulting_hours[1]['eve_end']){echo "checked";} else if(isset($consulting_hours) &&	 !$consulting_hours[1]['eve_start'] && !$consulting_hours[1]['eve_end']){}else{ echo "checked";} ?>>
																						</div>
																					</td>
																					<td class="tuclose24"> 
																						<input type="checkbox" class="open1" name="ServiceHours[2][full]"  id="service_2" onchange="moCheck(2)" <?php if(isset($consulting_hours[1]['work_24_7']) && $consulting_hours[1]['work_24_7'] == 1){echo "checked";}  if(isset($consulting_hours) && !$consulting_hours[1]['work_24_7'] && !$consulting_hours[1]['morn_start'] && !$consulting_hours[1]['morn_end']  && !$consulting_hours[1]['aftr_start'] && !$consulting_hours[1]['aftr_end'] && !$consulting_hours[1]['eve_start'] && !$consulting_hours[1]['eve_end']){echo "disabled";} ?>> 24/7  </td>
																					<td class="tuopen" id= "morn_start_2">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control"  id= "morn_input_start_2"  min="00:00" max="12:00" name="ServiceHours[2][mor][start]" value="<?php echo isset($consulting_hours[1]['morn_start']) ? $consulting_hours[1]['morn_start'] : '' ?>"  style=" <?php if(isset($consulting_hours) && ($consulting_hours[1]['work_24_7'] == 1  || (!$consulting_hours[1]['morn_start'] && !$consulting_hours[1]['morn_end']))){echo "visibility:hidden;";} ?>"  />
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "morn_input_end_2"  min="00:00" max="12:00"  name="ServiceHours[2][mor][end]" value="<?php echo isset($consulting_hours[1]['morn_end']) ? $consulting_hours[1]['morn_end'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[1]['work_24_7'] == 1  || (!$consulting_hours[1]['morn_start'] && !$consulting_hours[1]['morn_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																						</div>
																					</td>

																					<td class="tuopen" id= "aftr_start_2"> 
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "aftr_input_start_2" min="12:00" max="17:00" name="ServiceHours[2][aftr][start]" value="<?php echo isset($consulting_hours[1]['aftr_start']) ? $consulting_hours[1]['aftr_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[1]['work_24_7'] == 1 || (!$consulting_hours[1]['aftr_start'] && !$consulting_hours[1]['aftr_end']))){echo "visibility:hidden;";} ?>"/>	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "aftr_input_end_2" min="12:00" max="17:00" name="ServiceHours[2][aftr][end]" value="<?php echo isset($consulting_hours[1]['aftr_end']) ? $consulting_hours[1]['aftr_end'] : '' ?>"  style=" <?php if(isset($consulting_hours) && ($consulting_hours[1]['work_24_7'] == 1 || (!$consulting_hours[1]['aftr_start'] && !$consulting_hours[1]['aftr_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																						</div>																					</td>
																					<td class="tuopen" id= "eve_start_2">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "eve_input_start_2" min="17:00" max="23:59" name="ServiceHours[2][eve][start]" value="<?php echo isset($consulting_hours[1]['eve_start']) ? $consulting_hours[1]['eve_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[1]['work_24_7'] == 1 || (!$consulting_hours[1]['eve_start'] && !$consulting_hours[1]['eve_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "eve_input_end_2" min="17:00" max="23:59" name="ServiceHours[2][eve][end]" value="<?php echo isset($consulting_hours[1]['eve_end']) ? $consulting_hours[1]['eve_end'] : '' ?>"  style=" <?php if(isset($consulting_hours) && ($consulting_hours[1]['work_24_7'] == 1 || (!$consulting_hours[1]['eve_start'] && !$consulting_hours[1]['eve_end']))){echo "visibility:hidden;";} ?>"  />	
																							</div>
																						</div>
																					</td>
																				</tr>
																				<tr>
																					<td>Wednesday </td>
																					<td>
																						<input type="checkbox" class="custom-switch3"  name="ServiceHours[3][day]" id="close_3" onchange="moCheck(3)"  <?php if(isset($consulting_hours) && !$consulting_hours[2]['work_24_7'] && !$consulting_hours[2]['morn_start'] && !$consulting_hours[2]['morn_end']  && !$consulting_hours[2]['aftr_start'] && !$consulting_hours[2]['aftr_end'] && !$consulting_hours[2]['eve_start'] && !$consulting_hours[2]['eve_end']){}else if(isset($consulting_hours) &&(($consulting_hours[2]['morn_start'] && $consulting_hours[2]['morn_end']) || ($consulting_hours[2]['aftr_start'] && $consulting_hours[2]['eve_start']) || ($consulting_hours[2]['eve_start'] && $consulting_hours[2]['eve_end']))){ echo "checked";}else{echo "checked";} ?>>
																						<div id="sub_option_3"  style="<?php if(isset($consulting_hours) && !$consulting_hours[2]['morn_start'] && !$consulting_hours[2]['morn_end']  && !$consulting_hours[2]['aftr_start'] && !$consulting_hours[2]['aftr_end'] && !$consulting_hours[2]['eve_start'] && !$consulting_hours[2]['eve_end']){echo "display:none";} ?>">
																							<input type="checkbox" class="mor-switch3" name="ServiceHours[3][mor_chk]" id="mon_close_3" onchange="change_stat(3,'mor')" <?php if(isset($consulting_hours) &&$consulting_hours[2]['morn_start'] && $consulting_hours[2]['morn_end']){echo "checked";} else if(isset($consulting_hours) && !$consulting_hours[2]['morn_start'] && !$consulting_hours[2]['morn_end']){}else{ echo "checked";} ?> >
																							<input type="checkbox" class="aftr-switch3" name="ServiceHours[3][aftr_chk]" id="aftr_close_3" onchange="change_stat(3,'aftr')" <?php if(isset($consulting_hours) &&$consulting_hours[2]['aftr_start'] && $consulting_hours[2]['aftr_end']){echo "checked";} else if(isset($consulting_hours) && !$consulting_hours[2]['aftr_start'] && !$consulting_hours[2]['aftr_end']){}else{ echo "checked";} ?>>
																							<input type="checkbox" class="eve-switch3" name="ServiceHours[3][eve_chk]" id="eve_close_3" onchange="change_stat(3,'eve')" <?php if(isset($consulting_hours) &&$consulting_hours[2]['eve_start'] && $consulting_hours[2]['eve_end']){echo "checked";} else if(isset($consulting_hours) &&	 !$consulting_hours[2]['eve_start'] && !$consulting_hours[2]['eve_end']){}else{ echo "checked";} ?>>
																						</div>
																					</td>
																					<td>
																						<input type="checkbox" class="open1"  id="service_3" name="ServiceHours[3][full]"  onchange="moCheck(3)" <?php if(isset($consulting_hours[2]['work_24_7']) && $consulting_hours[2]['work_24_7'] == 1){echo "checked";}    if(isset($consulting_hours) && !$consulting_hours[2]['work_24_7'] && !$consulting_hours[2]['morn_start'] && !$consulting_hours[2]['morn_end']  && !$consulting_hours[0]['aftr_start'] && !$consulting_hours[2]['aftr_end'] && !$consulting_hours[2]['eve_start'] && !$consulting_hours[2]['eve_end']){echo "disabled";} ?>> 24/7  </td>
																					<td  id= "morn_start_3">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "morn_input_start_3" min="00:00" max="12:00" name="ServiceHours[3][mor][start]"  value="<?php echo isset($consulting_hours[2]['morn_start']) ? $consulting_hours[2]['morn_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[2]['work_24_7'] == 1 || (!$consulting_hours[2]['morn_start'] && !$consulting_hours[2]['morn_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "morn_input_end_3" min="00:00" max="12:00" name="ServiceHours[3][mor][end]"  value="<?php echo isset($consulting_hours[2]['morn_end']) ? $consulting_hours[2]['morn_end'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[2]['work_24_7'] == 1 || (!$consulting_hours[2]['morn_start'] && !$consulting_hours[2]['morn_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																						</div>
																					</td>
																					<td id= "aftr_start_3">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "aftr_input_start_3"  min="12:00" max="17:00" name="ServiceHours[3][aftr][start]"  value="<?php echo isset($consulting_hours[2]['aftr_start']) ? $consulting_hours[2]['aftr_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[2]['work_24_7'] == 1 || (!$consulting_hours[2]['aftr_start'] && !$consulting_hours[2]['aftr_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "aftr_input_end_3"  min="12:00" max="17:00" name="ServiceHours[3][aftr][end]"  value="<?php echo isset($consulting_hours[2]['aftr_end']) ? $consulting_hours[2]['aftr_end'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[2]['work_24_7'] == 1 || (!$consulting_hours[2]['aftr_start'] && !$consulting_hours[2]['aftr_end']))){echo "visibility:hidden;";} ?>"  />	
																							</div>
																						</div>
																					</td>
																					<td id= "eve_start_3">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "eve_input_start_3" min="17:00" max="23:59" name="ServiceHours[3][eve][start]"  value="<?php echo isset($consulting_hours[2]['eve_start']) ? $consulting_hours[2]['eve_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[2]['work_24_7'] == 1 || (!$consulting_hours[2]['eve_start'] && !$consulting_hours[2]['eve_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "eve_input_end_3" min="17:00" max="23:59" name="ServiceHours[3][eve][end]"  value="<?php echo isset($consulting_hours[2]['eve_end']) ? $consulting_hours[2]['eve_end'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[2]['work_24_7'] == 1 || (!$consulting_hours[2]['eve_start'] && !$consulting_hours[2]['eve_end']))){echo "visibility:hidden;";} ?>"  />	
																							</div>
																						</div>
																					</td>
																				</tr>
																				<tr>
																					<td>Thursday</td>
																					<td>
																						<input type="checkbox" class="custom-switch4" name="ServiceHours[4][day]" id="close_4" onchange="moCheck(4)" <?php if(isset($consulting_hours) && !$consulting_hours[3]['work_24_7'] && !$consulting_hours[3]['morn_start'] && !$consulting_hours[3]['morn_end']  && !$consulting_hours[3]['aftr_start'] && !$consulting_hours[3]['aftr_end'] && !$consulting_hours[3]['eve_start'] && !$consulting_hours[3]['eve_end']){}else if(isset($consulting_hours) &&(($consulting_hours[3]['morn_start'] && $consulting_hours[3]['morn_end']) || ($consulting_hours[3]['aftr_start'] && $consulting_hours[3]['eve_start']) || ($consulting_hours[3]['eve_start'] && $consulting_hours[3]['eve_end']))){ echo "checked";}else{echo "checked";} ?>>
																						<div id="sub_option_4" style="<?php if(isset($consulting_hours) && !$consulting_hours[3]['morn_start'] && !$consulting_hours[3]['morn_end']  && !$consulting_hours[3]['aftr_start'] && !$consulting_hours[3]['aftr_end'] && !$consulting_hours[3]['eve_start'] && !$consulting_hours[3]['eve_end']){echo "display:none";} ?>">
																							<input type="checkbox" class="mor-switch4"  name="ServiceHours[4][mor_chk]" id="mon_close_4" onchange="change_stat(4,'mor')" <?php if(isset($consulting_hours) && $consulting_hours[3]['morn_start'] && $consulting_hours[3]['morn_end']){echo "checked";} else if(isset($consulting_hours) && !$consulting_hours[3]['morn_start'] && !$consulting_hours[3]['morn_end']){}else{ echo "checked";} ?>>
																							<input type="checkbox" class="aftr-switch4" name="ServiceHours[4][aftr_chk]" id="aftr_close_4" onchange="change_stat(4,'aftr')" <?php if(isset($consulting_hours) && $consulting_hours[3]['aftr_start'] && $consulting_hours[3]['aftr_end']){echo "checked";} else if(isset($consulting_hours) && !$consulting_hours[3]['aftr_start'] && !$consulting_hours[3]['aftr_end']){}else{ echo "checked";} ?>>
																							<input type="checkbox" class="eve-switch4" name="ServiceHours[4][eve_chk]" id="eve_close_4" onchange="change_stat(4,'eve')" <?php if(isset($consulting_hours) &&$consulting_hours[3]['eve_start'] && $consulting_hours[3]['eve_end']){echo "checked";} else if(isset($consulting_hours) &&	 !$consulting_hours[3]['eve_start'] && !$consulting_hours[3]['eve_end']){}else{ echo "checked";} ?>>
																						</div>
																					</td>
																					<td>
																						<input type="checkbox" class="open1" id="service_4" name="ServiceHours[4][full]"  onchange="moCheck(4)" <?php if(isset($consulting_hours[3]['work_24_7']) && $consulting_hours[3]['work_24_7'] == 1){echo "checked";}   if(isset($consulting_hours) && !$consulting_hours[3]['work_24_7'] && !$consulting_hours[3]['morn_start'] && !$consulting_hours[3]['morn_end']  && !$consulting_hours[3]['aftr_start'] && !$consulting_hours[3]['aftr_end'] && !$consulting_hours[3]['eve_start'] && !$consulting_hours[3]['eve_end']){echo "disabled";} ?>> 24/7  </td>
																					<td id= "morn_start_4">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "morn_input_start_4" min="00:00" max="12:00" name="ServiceHours[4][mor][start]" value="<?php echo isset($consulting_hours[3]['morn_start']) ? $consulting_hours[3]['morn_start'] : '' ?>"  style=" <?php if(isset($consulting_hours) && ( $consulting_hours[3]['work_24_7'] == 1 || (!$consulting_hours[3]['morn_start'] && !$consulting_hours[3]['morn_end']))){echo "visibility:hidden;";} ?>"	 />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "morn_input_end_4" min="00:00" max="12:00" name="ServiceHours[4][mor][end]" value="<?php echo isset($consulting_hours[3]['morn_end']) ? $consulting_hours[3]['morn_end'] : '' ?>" style=" <?php if(isset($consulting_hours) && ( $consulting_hours[3]['work_24_7'] == 1 || (!$consulting_hours[3]['morn_start'] && !$consulting_hours[3]['morn_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																						</div>
																					</td>
																					<td id= "aftr_start_4">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "aftr_input_start_4" min="12:00" max="17:00"  name="ServiceHours[4][aftr][start]" value="<?php echo isset($consulting_hours[3]['aftr_start']) ? $consulting_hours[3]['aftr_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[3]['work_24_7'] == 1  || (!$consulting_hours[3]['aftr_start'] && !$consulting_hours[3]['aftr_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "aftr_input_end_4" min="12:00" max="17:00" name="ServiceHours[4][aftr][end]" value="<?php echo isset($consulting_hours[3]['aftr_end']) ? $consulting_hours[3]['aftr_end'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[3]['work_24_7'] == 1  || (!$consulting_hours[3]['aftr_start'] && !$consulting_hours[3]['aftr_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																						</div>
																					</td>
																					<td id= "eve_start_4">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control"  id= "eve_input_start_4" min="17:00" max="23:59" name="ServiceHours[4][eve][start]" value="<?php echo isset($consulting_hours[3]['eve_start']) ? $consulting_hours[3]['eve_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[3]['work_24_7'] == 1 || (!$consulting_hours[3]['eve_start'] && !$consulting_hours[3]['eve_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "eve_input_end_4" min="17:00" max="23:59" name="ServiceHours[4][eve][end]" value="<?php echo isset($consulting_hours[3]['eve_end']) ? $consulting_hours[3]['eve_end'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[3]['work_24_7'] == 1 || (!$consulting_hours[3]['eve_start'] && !$consulting_hours[3]['eve_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																						</div>
																					</td>
																				</tr>
																				<tr>
																					<td>Friday</td>
																					<td>
																						<input type="checkbox" class="custom-switch5"  name="ServiceHours[5][day]" id="close_5" onchange="moCheck(5)" <?php if(isset($consulting_hours) && !$consulting_hours[4]['work_24_7'] && !$consulting_hours[4]['morn_start'] && !$consulting_hours[4]['morn_end']  && !$consulting_hours[4]['aftr_start'] && !$consulting_hours[4]['aftr_end'] && !$consulting_hours[4]['eve_start'] && !$consulting_hours[4]['eve_end']){}else if(isset($consulting_hours) &&(($consulting_hours[4]['morn_start'] && $consulting_hours[4]['morn_end']) || ($consulting_hours[4]['aftr_start'] && $consulting_hours[4]['eve_start']) || ($consulting_hours[4]['eve_start'] && $consulting_hours[4]['eve_end']))){ echo "checked";}else{echo "checked";} ?> >
																						<div id="sub_option_5"  style="<?php if(isset($consulting_hours) && !$consulting_hours[4]['morn_start'] && !$consulting_hours[4]['morn_end']  && !$consulting_hours[4]['aftr_start'] && !$consulting_hours[4]['aftr_end'] && !$consulting_hours[4]['eve_start'] && !$consulting_hours[4]['eve_end']){echo "display:none";} ?>">
																							<input type="checkbox" class="mor-switch5" name="ServiceHours[5][mor_chk]" id="mon_close_5" onchange="change_stat(5,'mor')" <?php if(isset($consulting_hours) &&$consulting_hours[4]['morn_start'] && $consulting_hours[4]['morn_end']){echo "checked";} else if(isset($consulting_hours) && !$consulting_hours[4]['morn_start'] && !$consulting_hours[4]['morn_end']){}else{ echo "checked";} ?>>
																							<input type="checkbox" class="aftr-switch5"  name="ServiceHours[5][aftr_chk]" id="aftr_close_5" onchange="change_stat(5,'aftr')" <?php if(isset($consulting_hours) &&$consulting_hours[4]['aftr_start'] && $consulting_hours[4]['aftr_end']){echo "checked";} else if(isset($consulting_hours) && !$consulting_hours[4]['aftr_start'] && !$consulting_hours[4]['aftr_end']){}else{ echo "checked";} ?>>
																							<input type="checkbox" class="eve-switch5" name="ServiceHours[5][eve_chk]" id="eve_close_5" onchange="change_stat(5,'eve')" <?php if(isset($consulting_hours) &&$consulting_hours[4]['eve_start'] && $consulting_hours[4]['eve_end']){echo "checked";} else if(isset($consulting_hours) &&	 !$consulting_hours[4]['eve_start'] && !$consulting_hours[4]['eve_end']){}else{ echo "checked";} ?>>
																						</div>
																					</td>
																					<td>
																						<input type="checkbox" class="open1" id="service_5" name="ServiceHours[5][full]"  onchange="moCheck(5)" <?php if(isset($consulting_hours[4]['work_24_7']) && $consulting_hours[4]['work_24_7'] == 1){echo "checked";}     if(isset($consulting_hours) && !$consulting_hours[4]['work_24_7'] && !$consulting_hours[4]['morn_start'] && !$consulting_hours[4]['morn_end']  && !$consulting_hours[4]['aftr_start'] && !$consulting_hours[4]['aftr_end'] && !$consulting_hours[4]['eve_start'] && !$consulting_hours[4]['eve_end']){echo "disabled";} ?>> 24/7  </td>
																					<td id= "morn_start_5">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control"  id= "morn_input_start_5" min="00:00" max="12:00" name="ServiceHours[5][mor][start]" value="<?php echo isset($consulting_hours[4]['morn_start']) ? $consulting_hours[4]['morn_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[4]['work_24_7'] == 1 || (!$consulting_hours[4]['morn_start'] && !$consulting_hours[4]['morn_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "morn_input_end_5" min="00:00" max="12:00" name="ServiceHours[5][mor][end]" value="<?php echo isset($consulting_hours[4]['morn_end']) ? $consulting_hours[4]['morn_end'] : '' ?>"  style=" <?php if(isset($consulting_hours) && ($consulting_hours[4]['work_24_7'] == 1 || (!$consulting_hours[4]['morn_start'] && !$consulting_hours[4]['morn_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																						</div>
																					</td>
																					<td id= "aftr_start_5">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "aftr_input_start_5"  min="12:00" max="17:00"  name="ServiceHours[5][aftr][start]" value="<?php echo isset($consulting_hours[4]['aftr_start']) ? $consulting_hours[4]['aftr_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[4]['work_24_7'] == 1 || (!$consulting_hours[4]['aftr_start'] && !$consulting_hours[4]['aftr_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "aftr_input_end_5"  min="12:00" max="17:00" name="ServiceHours[5][aftr][end]" value="<?php echo isset($consulting_hours[4]['aftr_end']) ? $consulting_hours[4]['aftr_end'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[4]['work_24_7'] == 1 || (!$consulting_hours[4]['aftr_start'] && !$consulting_hours[4]['aftr_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																						</div>
																					</td>
																					<td id= "eve_start_5">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "eve_input_start_5" min="17:00" max="23:59" name="ServiceHours[5][eve][start]" value="<?php echo isset($consulting_hours[4]['eve_start']) ? $consulting_hours[4]['eve_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[4]['work_24_7'] == 1 || (!$consulting_hours[4]['eve_start'] && !$consulting_hours[4]['eve_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "eve_input_end_5" min="17:00" max="23:59" name="ServiceHours[5][eve][end]" value="<?php echo isset($consulting_hours[4]['eve_end']) ? $consulting_hours[4]['eve_end'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[4]['work_24_7'] == 1 || (!$consulting_hours[4]['eve_start'] && !$consulting_hours[4]['eve_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																						</div>
																					</td>
																				</tr>
																				<tr>

																					<td>Saturday</td>
																					<td>
																						<input type="checkbox" class="custom-switch6" name="ServiceHours[6][day]" id="close_6" onchange="moCheck(6)"  <?php if(isset($consulting_hours) &&  !$consulting_hours[5]['work_24_7'] &&!$consulting_hours[5]['morn_start'] && !$consulting_hours[5]['morn_end']  && !$consulting_hours[5]['aftr_start'] && !$consulting_hours[5]['aftr_end'] && !$consulting_hours[5]['eve_start'] && !$consulting_hours[5]['eve_end']){}else if(isset($consulting_hours) &&(($consulting_hours[5]['morn_start'] && $consulting_hours[5]['morn_end']) || ($consulting_hours[5]['aftr_start'] && $consulting_hours[5]['eve_start']) || ($consulting_hours[5]['eve_start'] && $consulting_hours[5]['eve_end']))){ echo "checked";}else{echo "checked";} ?>>
																						<div id="sub_option_6"  style="<?php if(isset($consulting_hours) && !$consulting_hours[5]['morn_start'] && !$consulting_hours[5]['morn_end']  && !$consulting_hours[5]['aftr_start'] && !$consulting_hours[5]['aftr_end'] && !$consulting_hours[5]['eve_start'] && !$consulting_hours[5]['eve_end']){echo "display:none";} ?>" >
																							<input type="checkbox" class="mor-switch6"  name="ServiceHours[6][mor_chk]" id="mon_close_6" onchange="change_stat(6,'mor')" <?php if(isset($consulting_hours) &&$consulting_hours[5]['morn_start'] && $consulting_hours[5]['morn_end']){echo "checked";} else if(isset($consulting_hours) && !$consulting_hours[5]['morn_start'] && !$consulting_hours[5]['morn_end']){}else{ echo "checked";} ?>>
																							<input type="checkbox" class="aftr-switch6"  name="ServiceHours[6][aftr_chk]" id="aftr_close_6" onchange="change_stat(6,'aftr')" <?php if(isset($consulting_hours) &&$consulting_hours[5]['aftr_start'] && $consulting_hours[5]['aftr_end']){echo "checked";} else if(isset($consulting_hours) && !$consulting_hours[5]['aftr_start'] && !$consulting_hours[5]['aftr_end']){}else{ echo "checked";} ?>>
																							<input type="checkbox" class="eve-switch6"   name="ServiceHours[6][eve_chk]"id="eve_close_6" onchange="change_stat(6,'eve')" <?php if(isset($consulting_hours) &&$consulting_hours[5]['eve_start'] && $consulting_hours[5]['eve_end']){echo "checked";} else if(isset($consulting_hours) &&	 !$consulting_hours[5]['eve_start'] && !$consulting_hours[5]['eve_end']){}else{ echo "checked";} ?>>
																						</div>
																					</td>
																					<td>
																						<input type="checkbox" class="open1" id="service_6" name="ServiceHours[6][full]"  onchange="moCheck(6)" <?php if(isset($consulting_hours[5]['work_24_7']) && $consulting_hours[5]['work_24_7'] == 1){echo "checked";}  if(isset($consulting_hours) && !$consulting_hours[5]['work_24_7'] && !$consulting_hours[5]['morn_start'] && !$consulting_hours[5]['morn_end']  && !$consulting_hours[5]['aftr_start'] && !$consulting_hours[5]['aftr_end'] && !$consulting_hours[5]['eve_start'] && !$consulting_hours[5]['eve_end']){echo "disabled";} ?>> 24/7  </td>
																					<td id= "morn_start_6">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "morn_input_start_6" min="00:00" max="12:00" name="ServiceHours[6][mor][start]" value="<?php echo isset($consulting_hours[5]['morn_start']) ? $consulting_hours[5]['morn_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[5]['work_24_7'] == 1 || (!$consulting_hours[5]['morn_start'] && !$consulting_hours[5]['morn_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "morn_input_end_6" min="00:00" max="12:00" name="ServiceHours[6][mor][end]" value="<?php echo isset($consulting_hours[5]['morn_end']) ? $consulting_hours[5]['morn_end'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[5]['work_24_7'] == 1 || (!$consulting_hours[5]['morn_start'] && !$consulting_hours[5]['morn_end']))){echo "visibility:hidden;";} ?>"  />	
																							</div>
																						</div>
																					</td>
																					<td id= "aftr_start_6">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "aftr_input_start_6" min="12:00" max="17:00" name="ServiceHours[6][aftr][start]" value="<?php echo isset($consulting_hours[5]['aftr_start']) ? $consulting_hours[5]['aftr_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[5]['work_24_7'] == 1 || (!$consulting_hours[5]['aftr_start'] && !$consulting_hours[5]['aftr_end']))){echo "visibility:hidden;";} ?>"  />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "aftr_input_end_6" min="12:00" max="17:00" name="ServiceHours[6][aftr][end]" value="<?php echo isset($consulting_hours[5]['aftr_end']) ? $consulting_hours[5]['aftr_end'] : '' ?>"  style=" <?php if(isset($consulting_hours) && ($consulting_hours[5]['work_24_7'] == 1 || (!$consulting_hours[5]['aftr_start'] && !$consulting_hours[5]['aftr_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																						</div>
																					</td>
																					<td id= "eve_start_6">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "eve_input_start_6" min="17:00" max="23:59" name="ServiceHours[6][eve][start]"  value="<?php echo isset($consulting_hours[5]['eve_start']) ? $consulting_hours[5]['eve_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[5]['work_24_7'] == 1 || (!$consulting_hours[5]['eve_start'] && !$consulting_hours[5]['eve_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "eve_input_end_6" min="17:00" max="23:59" name="ServiceHours[6][eve][end]" value="<?php echo isset($consulting_hours[5]['eve_end']) ? $consulting_hours[5]['eve_end'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[5]['work_24_7'] == 1 || (!$consulting_hours[5]['eve_start'] && !$consulting_hours[5]['eve_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																						</div>
																					</td>
																				</tr>
																				<tr>
																					<td>Sunday</td>
																					<td>
																						<input type="checkbox" class="custom-switch7"  name="ServiceHours[7][day]" id="close_7" onchange="moCheck(7)" <?php if(isset($consulting_hours) && !$consulting_hours[6]['work_24_7'] && !$consulting_hours[6]['morn_start'] && !$consulting_hours[6]['morn_end']  && !$consulting_hours[6]['aftr_start'] && !$consulting_hours[6]['aftr_end'] && !$consulting_hours[6]['eve_start'] && !$consulting_hours[6]['eve_end']){}else if(isset($consulting_hours) &&(($consulting_hours[6]['morn_start'] && $consulting_hours[6]['morn_end']) || ($consulting_hours[6]['aftr_start'] && $consulting_hours[6]['eve_start']) || ($consulting_hours[6]['eve_start'] && $consulting_hours[6]['eve_end']))){ echo "checked";}else{echo "checked";} ?>>
																						<div id="sub_option_7"  style="<?php if(isset($consulting_hours) && !$consulting_hours[6]['morn_start'] && !$consulting_hours[6]['morn_end']  && !$consulting_hours[6]['aftr_start'] && !$consulting_hours[6]['aftr_end'] && !$consulting_hours[6]['eve_start'] && !$consulting_hours[6]['eve_end']){echo "display:none";} ?>">
																							<input type="checkbox" class="mor-switch7"  name="ServiceHours[7][mor_chk]" id="mon_close_7" onchange="change_stat(7,'mor')"  <?php if(isset($consulting_hours) &&$consulting_hours[6]['morn_start'] && $consulting_hours[6]['morn_end']){echo "checked";} else if(isset($consulting_hours) && !$consulting_hours[6]['morn_start'] && !$consulting_hours[6]['morn_end']){}else{ echo "checked";} ?>>
																							<input type="checkbox" class="aftr-switch7"  name="ServiceHours[7][aftr_chk]" id="aftr_close_7" onchange="change_stat(7,'aftr')" <?php if(isset($consulting_hours) &&$consulting_hours[6]['aftr_start'] && $consulting_hours[6]['aftr_end']){echo "checked";} else if(isset($consulting_hours) && !$consulting_hours[6]['aftr_start'] && !$consulting_hours[6]['aftr_end']){}else{ echo "checked";} ?>>
																							<input type="checkbox" class="eve-switch7" checked name="ServiceHours[7][eve_chk]" id="eve_close_7" onchange="change_stat(7,'eve')"  <?php if(isset($consulting_hours) &&$consulting_hours[6]['eve_start'] && $consulting_hours[6]['eve_end']){echo "checked";} else if(isset($consulting_hours) &&	 !$consulting_hours[6]['eve_start'] && !$consulting_hours[6]['eve_end']){}else{ echo "checked";} ?>>
																						</div>
																					</td>
																					<td>
																						<input type="checkbox" class="open1" id="service_7" name="ServiceHours[7][full]"  onchange="moCheck(7)" <?php if(isset($consulting_hours[6]['work_24_7']) && $consulting_hours[6]['work_24_7'] == 1){echo "checked";}   if(isset($consulting_hours) && !$consulting_hours[6]['work_24_7'] && !$consulting_hours[6]['morn_start'] && !$consulting_hours[6]['morn_end']  && !$consulting_hours[6]['aftr_start'] && !$consulting_hours[6]['aftr_end'] && !$consulting_hours[6]['eve_start'] && !$consulting_hours[6]['eve_end']){echo "disabled";} ?>> 24/7  </td>
																					<td id= "morn_start_7">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "morn_input_start_7" min="00:00" max="12:00" name="ServiceHours[7][mor][start]" value="<?php echo isset($consulting_hours[6]['morn_start']) ? $consulting_hours[6]['morn_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[6]['work_24_7'] == 1 || (!$consulting_hours[6]['morn_start'] && !$consulting_hours[6]['morn_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control" id= "morn_input_end_7" min="00:00" max="12:00" name="ServiceHours[7][mor][end]" value="<?php echo isset($consulting_hours[6]['morn_end']) ? $consulting_hours[6]['morn_end'] : '' ?>"  style=" <?php if(isset($consulting_hours) && ($consulting_hours[6]['work_24_7'] == 1 || (!$consulting_hours[6]['morn_start'] && !$consulting_hours[6]['morn_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																						</div>
																					</td>
																					<td id= "aftr_start_7">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "aftr_input_start_7" min="12:00" max="17:00" name="ServiceHours[7][aftr][start]" value="<?php echo isset($consulting_hours[6]['aftr_start']) ? $consulting_hours[6]['aftr_start'] : '' ?>" style=" <?php if(isset($consulting_hours) && ($consulting_hours[6]['work_24_7'] == 1  || (!$consulting_hours[6]['aftr_start'] && !$consulting_hours[6]['aftr_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control"  id= "aftr_input_end_7" min="12:00" max="17:00" name="ServiceHours[7][aftr][end]" value="<?php echo isset($consulting_hours[6]['aftr_end']) ? $consulting_hours[6]['aftr_end'] : '' ?>"  style=" <?php if(isset($consulting_hours) && ($consulting_hours[6]['work_24_7'] == 1 || (!$consulting_hours[6]['aftr_start'] && !$consulting_hours[6]['aftr_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																						</div>
																					</td>
																					<td id= "eve_start_7">
																						<div class="col-sm-6 col-md-12 padding-null">
																							<div class="form-group">
																								<input type="time" class="form-control" id= "eve_input_start_7" min="17:00" max="23:59" name="ServiceHours[7][eve][start]" value="<?php echo isset($consulting_hours[6]['eve_start']) ? $consulting_hours[6]['eve_start'] : '' ?>"  style=" <?php if(isset($consulting_hours) && ($consulting_hours[6]['work_24_7'] == 1 || (!$consulting_hours[6]['eve_start'] && !$consulting_hours[6]['eve_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																							<div class="form-group">
																								<input type="time" class="form-control"  id= "eve_input_end_7"  min="17:00" max="23:59" name="ServiceHours[7][eve][end]" value="<?php echo isset($consulting_hours[6]['eve_end']) ? $consulting_hours[6]['eve_end'] : '' ?>"  style=" <?php if(isset($consulting_hours) && ($consulting_hours[6]['work_24_7'] == 1 || (!$consulting_hours[6]['eve_start'] && !$consulting_hours[6]['eve_end']))){echo "visibility:hidden;";} ?>" />	
																							</div>
																						</div>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																		<div class="form-group">
																			<label>Further Details</label>
																			<textarea class="form-control" rows="3" id="further_details" placeholder="Further Details"><?php echo (isset($details['further_details']) ? $details['further_details'] : '') ?></textarea>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</form>
												</div>
                                            </div>
                                        </div>
                                    </div>
									<div class="actionBar">
										<a href="javascript:void(0);" class="buttonNext btn btn-success"  onclick="save_services();" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Save and Continue <i class="fa fa-angle-right" aria-hidden="true"></i></a>
									</div>
                                </div>
                            </div>
							
                            <div id="menu6" class="tab-pane fade">
                                <div class="x_panel">
									<div class="row">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#documentstab">Documents</a></li>
                                            <li><a data-toggle="tab" href="#imagetab">Images</a></li>
                                            <li><a data-toggle="tab" href="#videotab">Videos</a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div id="documentstab" class="tab-pane fade in active">


                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="row">
                                                        <br />
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">Documents </div>
                                                            <div class="panel-body">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-null">
                                                                            <div class="col-md-3 padding-null" style="width: auto;">
                                                                                <label class="" style="text-align:left !important;">Upload Documents :</label>
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                <p class="btn btn-primary btn-sm" style="color: #fff;">
                                                                                    <input class="file-4 upload_btn" id="upload-file-selector" type="file" multiple="" onchange="preview_file('upload-file-selector',this, 'upload_list_doc','upload_doc');"><i class="fa  fa-upload" data-toggle="tooltip" data-title="Edit Title"></i> Upload
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                <p class="btn btn-primary btn-sm" style="color: #fff;display:none">
                                                                                    <input class="upload_btn" type="button"><i class="fa  fa-save" data-toggle="tooltip" data-title="Edit Title"></i> Save
                                                                                </p>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-md-7 col-sm-12 col-xs-12 padding-null" id="upload_doc" style="<?php if(!isset($documents)){echo "display:none;";} ?>">
                                                                            
                                                                            <div class="list-group table-responsive" id="upload_doc_new" style="display:none;">
                                                                               <label style="margin-bottom:10px;color:green;margin-top:15px;">Uploaded Documents:</label>
																				<br />
																			   <table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
                                                                                    <thead>
                                                                                        <tr role="row">
                                                                                            <th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
                                                                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Files</th>
                                                                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
																							<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Visibility</th>
                                                                                            <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="upload_list_doc" style="height: 10px !important; overflow: scroll; "></tbody>
                                                                                </table>
                                                                            </div>
																			
																			<div class="list-group table-responsive" id="upload_doc_exist" style="<?php if(!isset($documents)){echo "display:none;";} ?>">
                                                                                <table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
                                                                                    <thead>
                                                                                        <tr role="row">
                                                                                            <th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
                                                                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
																							<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Visibility</th>
                                                                                            <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="upload_doc_exist_list" style="height: 10px !important; overflow: scroll; ">
																						<?php
																							if(!empty($documents)) {
																								$i=0;
																								foreach($documents as $key =>$val){
																									
																									$val_arr		= (array)$val;
																									if($val_arr['file_type'] =='documents'){
																										$i++;
																										?>
																										<tr role="row">
																											<td >
																											</td>
																											<td tabindex="0" >
																												<a href="#">
																												<?php
																												echo $val_arr['title'];
																												?></a>
																											</td>
																											<td>
																											<?php
																											if($val_arr['show_public'] == 0){
																												echo "Invisible";
																											}else{
																												echo "Visible";
																											}
																											?>
																											</td>
																											<td>
																												<a href="<?php echo base_url() .'assets/uploads/'.$val_arr['file_path'].$val_arr['file_name']; ?>" target="_blank" class="btn btn-success"><i class="fa fa-eye" data-toggle="tooltip" data-title="Share Document" data-original-title="" title=""></i></a>
																											</td>
																										</tr>
																										<?php
																									}	
																								}
																								if($i == 0){
																									echo "<tr><td colspan='4'><input type='hidden' id='upload_doc_empty' value='1'>No records uploaded</td></tr>";
																								}
																								}else{
																									echo "<tr><td colspan='4'><input type='hidden' id='upload_doc_empty' value='1'>No records uploaded</td></tr>";
																								}
																						   ?>
																					
																					</tbody>
                                                                                </table>
                                                                            </div>
																			
																			
																			
																			
                                                                            <!--<div class="modal fade notes-info" id="mail-edit-modal" style="display: none;">
                                                                                <div class="modal-dialog modal-md">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                                                                                            <h4 class="modal-title">Email Documents</h4>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <input class="form-control" placeholder="Enter Email">
                                                                                            <div class="action-icon">
                                                                                                <a href="#"><i class="fa fa-2x fa-envelope" data-toggle="tooltip" data-title="Send Mail" data-original-title="" title=""></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="imagetab" class="tab-pane fade">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="row">
                                                        <br />
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">Documents </div>
                                                            <div class="panel-body">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-null">
                                                                            <div class="col-md-3 padding-null" style="width: auto;">
                                                                                <label class="" style="text-align:left !important;">Upload Documents / Images:</label>
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                <p class="btn btn-primary btn-sm" style="color: #fff;">
                                                                                    <input class="file-4 upload_btn" id="upload-file-image" type="file" multiple="" onchange="preview_file('upload-file-image',this, 'upload_list_img','upload_img')"  accept="image/gif, image/jpeg, image/png, image/jpg, image/bmp"><i class="fa  fa-upload" data-toggle="tooltip" data-title="Edit Title"></i> Upload

                                                                                </p>
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                <p class="btn btn-primary btn-sm" style="color: #fff;display:none">
                                                                                    <input class="upload_btn" type="button"><i class="fa  fa-save" data-toggle="tooltip" data-title="Edit Title"></i> Save
                                                                                </p>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-md-7 col-sm-12 col-xs-12 padding-null" id="upload_img" style="<?php if(!isset($documents)){echo "display:none;";} ?>">
                                                                            <div class="list-group table-responsive" id="upload_img_new" style="display:none;">
																			<label style="margin-bottom:10px;color:green;margin-top:15px;">Uploaded Documents / Images:</label>
                                                                            <br />
                                                                                <table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
                                                                                    <thead>
                                                                                        <tr role="row">
                                                                                            <th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
                                                                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Files</th>
                                                                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
																							<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Visibility</th>
                                                                                            <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="upload_list_img" style="height: 10px !important; overflow: scroll; "></tbody>
                                                                                </table>
                                                                            </div>
																			
																			<div class="list-group table-responsive" id="upload_img_exist" style="<?php if(!isset($documents)){echo "display:none;";} ?>">
                                                                                <table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
                                                                                    <thead>
                                                                                        <tr role="row">
                                                                                            <th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
                                                                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
																							<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Visibility</th>
                                                                                            <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="upload_img_exist_list" style="height: 10px !important; overflow: scroll; ">
																					
																					<?php
																							if(!empty($documents)) {
																								$i=0;
																								foreach($documents as $key =>$val){
																									
																									$val_arr		= (array)$val;
																									if($val_arr['file_type'] =='images'){
																										$i++;
																										?>
																										<tr role="row">
																											<td >
																											</td>
																											<td tabindex="0" >
																												<a href="#">
																												<?php
																												echo $val_arr['title'];
																												?></a>
																											</td>
																											<td>
																											<?php
																											if($val_arr['show_public'] == 0){
																												echo "Invisible";
																											}else{
																												echo "Visible";
																											}
																											?>
																											</td>
																											<td>
																												<a href="<?php echo base_url() .'assets/uploads/'.$val_arr['file_path'].$val_arr['file_name']; ?>" target="_blank" class="btn btn-success"><i class="fa fa-eye" data-toggle="tooltip" data-title="Share Document" data-original-title="" title=""></i></a>
																											</td>
																										</tr>
																										<?php
																									}	
																								}
																								if($i == 0){
																									echo "<tr><td colspan='4'><input type='hidden' id='upload_img_empty' value='1'>No records uploaded</td></tr>";
																								}
																								}else{
																									echo "<tr><td colspan='4'><input type='hidden' id='upload_img_empty' value='1'>No records uploaded</td></tr>";
																								}
																						   ?>
																					
																					</tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="videotab" class="tab-pane fade">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="row">
                                                        <br />
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">Documents </div>
                                                            <div class="panel-body">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-null">
                                                                            <div class="col-md-3 padding-null" style="width: auto;">
                                                                                <label class="" style="text-align:left !important;">Upload Documents / Videos:</label>
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                <p class="btn btn-primary btn-sm" style="color: #fff;">
                                                                                    <input class="file-4 upload_btn" id="upload-file-video" type="file" multiple="" onchange="preview_file('upload-file-video',this, 'upload_list_video','upload_video');"><i class="fa  fa-upload" data-toggle="tooltip" data-title="Edit Title"></i> Upload

                                                                                </p>
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                <p class="btn btn-primary btn-sm" style="color: #fff;display:none">
                                                                                    <input class="upload_btn" type="button"><i class="fa  fa-save" data-toggle="tooltip" data-title="Edit Title"></i> Save
                                                                                </p>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-md-7 col-sm-12 col-xs-12 padding-null" id="upload_video" style="<?php if(!isset($documents)){echo "display:none;";} ?>">
                                                                            <div class="list-group table-responsive" id="upload_video_new" style="display:none;">
																			  <label style="margin-bottom:10px;color:green;margin-top:15px;">Uploaded Documents / Videos:</label>
																				<br />
                                                                                <table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
                                                                                    <thead>
                                                                                        <tr role="row">
                                                                                            <th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
                                                                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Files</th>
                                                                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
																							<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Visibility</th>
                                                                                            <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="upload_list_video" style="height: 10px !important; overflow: scroll; "></tbody>
                                                                                </table>
                                                                            </div>
																			
																			<div class="list-group table-responsive" id="upload_video_exist" style="<?php if(!isset($documents)){echo "display:none;";} ?>">
                                                                                <table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
                                                                                    <thead>
                                                                                        <tr role="row">
                                                                                            <th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
                                                                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
																							<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Visibility</th>
                                                                                            <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody id="upload_video_exist_list" style="height: 10px !important; overflow: scroll; ">
																					
																					<?php
																							if(!empty($documents)) {
																								$i=0;
																								foreach($documents as $key =>$val){
																									
																									$val_arr		= (array)$val;
																									if($val_arr['file_type'] =='videos'){
																										$i++;
																										?>
																										<tr role="row">
																											<td >
																											</td>
																											<td tabindex="0" >
																												<a href="#">
																												<?php
																												echo $val_arr['title'];
																												?></a>
																											</td>
																											<td>
																											<?php
																											if($val_arr['show_public'] == 0){
																												echo "Invisible";
																											}else{
																												echo "Visible";
																											}
																											?>
																											</td>
																											<td>
																												<a href="<?php echo base_url() .'assets/uploads/'.$val_arr['file_path'].$val_arr['file_name']; ?>" target="_blank" class="btn btn-success"><i class="fa fa-eye" data-toggle="tooltip" data-title="Share Document" data-original-title="" title=""></i></a>
																											</td>
																										</tr>
																										<?php
																									}	
																								}
																								if($i == 0){
																									echo "<tr><td colspan='4'><input type='hidden' id='upload_video_empty' value='1'>No records uploaded</td></tr>";
																								}
																								}else{
																									echo "<tr><td colspan='4'><input type='hidden' id='upload_video_empty' value='1'>No records uploaded</td></tr>";
																								}
																						   ?>
																					
																					</tbody>
                                                                                </table>
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
									<div class="actionBar">
										<a href="javascript:void(0);" class="buttonNext btn btn-success" onclick="summary_page();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save and Continue <i class="fa fa-angle-right" aria-hidden="true"></i></a>
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
	<?php
		$list				= '';
		$country_list		= '';
		$country_l			= '';
		$country_code		= '';
		foreach($country['name'] as $c_key => $c_val){
			$country_list	= $country_list.'<option value="'.$c_key.'">'.$c_val.'</option>';
			if($c_key !=''){
				$country_l	.= 'country_name['.$c_key.']= "'.$c_val.'";';
			}
		}
		foreach($country['code'] as $c_key => $c_val){
			if($c_key !=''){
				$country_code	.= 'country_name['.$c_key.']= "'.$c_val.'";';
			}
		}
	?>
    <!-- Modals -->    
    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>assets/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url();?>assets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url();?>assets/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url();?>assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url();?>assets/vendors/skycons/skycons.js"></script>

    <!-- DateJS -->
    <script src="<?php echo base_url();?>assets/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url();?>assets/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
     <script src="<?php echo base_url();?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- FullCalendar -->
    <script src="<?php echo base_url();?>assets/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/fullcalendar/dist/fullcalendar.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>assets/js/custom.js"></script>
    <script src="<?php echo base_url();?>assets/js/fileinput.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-imageupload.js"></script>
    <script src="<?php echo base_url();?>assets/js/drop-down.js"></script>

    <script src="<?php echo base_url();?>assets/vendors/switch/on-off-switch.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/switch/on-off-switch-onload.js"></script>
	
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyB30YkpVyTfcPsQkwNiiBLE2a-C5EHYFSA&libraries=places"></script>
   <script src="<?php echo base_url();?>assets/vendors/switchery/dist/switchery.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/magicsuggest/magicsuggest-min.js"></script>

    <script>
	
	/*$(document).ready(function() {
		$('input[type=radio][name=iCheck1]').on('change',function() {
			alert('dsf')
		});
	});*/
		
	$("#tel1,#tel2").keypress(function(e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 43 && e.which > 31 ) {
			return false;
		}
	});
	
	function nxt_tab(a) {
		$("#" + a).click();
	}
	
	function fill_address(){
		var code 	 							= $('#zipcode').val();
		var country  							= $('#country_id').val();
		//alert(country);
		if(country == ''){
			alert('Please Choose Country..');
			return false;
		}else if(code.trim()	== ''){
			$('#state').val('');
			$('#city_town').val('');
			$('#address').val('');
			//alert('Please enter State/Zip code..');
			return false;
		}else{
			var address							= new Array();
			var country_name					= new Array();
			<?php echo $country_code; ?>
			var url								= "https://maps.googleapis.com/maps/api/geocode/json?address="+code+"&key=AIzaSyAq9UJoUkc1CU43BUmWzJkhBlOvmd3xd2o&components=country:"+country_name[country]+"&region="+country_name[country];
			$.post(url,{code:code},function(data){
				if(data.results.length > 0){
					var address						= data.results[0].address_components;
					var add_len						= address.length;
					var cnt							= 2;
					$('#city_town').val('');
					$('#state').val('');
					$('#address').val('');
					if(address.length > 1){
						if(address[add_len - cnt]){
							if(address[add_len - cnt].short_name.length > 0){
								if(address[add_len-cnt].short_name = country_name[country]){
									cnt							= parseInt(cnt) + 1;
								}
							}
						}
						if(address[add_len - cnt]){
							if(address[add_len - cnt].long_name.length > 0){
								if(address[add_len	- cnt].long_name != code.trim() ){
									$('#city_town').val(address[add_len	- cnt].long_name);
								}
								cnt--;
							}
						}
						if(address[add_len - cnt]){
							if(address[add_len - cnt].long_name.length > 0){
								$('#state').val(address[add_len - cnt].long_name);
							}
						}
					}
				}else{
					$('#state').val('');
					$('#city').val('');
					$('#address').val('');
				}
			});
		}
	}
	
	function search_address(type){
		var country  							= $("#country_id").val();
		var code 	 							= $("#zipcode").val();
		var country_name						= new Array();
		<?php echo $country_code; ?>
		var options = {
						address :code,
						componentRestrictions: {country:country_name[country]}
					  };
		if(country.trim()  ==''){
			alert("Please select a country");
			$("#address").val('');
		}else{
			var places 							= new google.maps.places.Autocomplete(document.getElementById('address'),options);
			google.maps.event.addListener(places, 'place_changed', function () {
				var place 						= places.getPlace();
				var address 					= place.formatted_address;
				var latitude 					= place.geometry.location.A;
				var longitude 					= place.geometry.location.F;
		   });
		}
	}
	
	function save_details(){
		var data 						= new FormData();
		var form 						= $('#consulting_location');
		var location_name				= $("#location_name").val();
		var country_id					= $("#country_id").val();
		var postcode					= $("#zipcode").val();
		var city_town					= $("#city_town").val();
		var state						= $("#state").val();
		var address						= $("#address").val();
		var tel1						= $("#tel1").val();
		var tel2						= $("#tel2").val();
		var email1						= $("#email1").val();
		var email2						= $("#email2").val();
		var disable		 				= $("input[name='iCheck']:checked").val();
		var parking		 				= $("input[name='iCheck1']:checked").val();
		var parking_dir					= $("#parking").val();
		var further						= $("#further").val();
		if(location_name.trim() == ''){
			$("#location_name").focus();
			$("#location_name").css('border','1px solid #ff1a1c');
		}else if(country_id == ''){
			$("#country_id").focus();
			$("#country_id").css('border','1px solid #ff1a1c');
		}else if(postcode == ''){
			$("#zipcode").focus();
			$("#zipcode").css('border','1px solid #ff1a1c');
		}else if(city_town == ''){
			$("#city_town").focus();
			$("#city_town").css('border','1px solid #ff1a1c');
		}else if(state == ''){
			$("#state").focus();
			$("#state").css('border','1px solid #ff1a1c');
		}else if(address == ''){
			$("#address").focus();
			$("#address").css('border','1px solid #ff1a1c');
		}else if(city_town == ''){
			$("#city_town").focus();
			$("#city_town").css('border','1px solid #ff1a1c');
		}else if(tel1 == ''){
			$("#tel1").focus();
			$("#tel1").css('border','1px solid #ff1a1c');
		}else if(email1 == ''){
			$("#email1").focus();
			$("#email1").css('border','1px solid #ff1a1c');
		}else{
			var form_data 								= $(form).serializeArray();
			$.each(form_data, function (key, input) {
				data.append(input.name, input.value);
			});
			var	location_key	= $("#location_key").val();
			data.append('location_key', location_key);
			var url				= "<?php echo base_url() ?>consulting_location/save_details"; 
			$.ajax({
				url: url,
				type: 'POST',
				data: data,
				processData: false,
				contentType: false,
				dataType: "json",
				success: function(data){
					if(data['response'].trim()  == 'success'){
						$("#response").html("Last saved :" +data['last_time']);
						if(data['last_id']){
							$("#location_key").val(data['last_id']);
						}
						$("#pDcheck3").iCheck("check");
						nxt_tab('service_hrs');
					}else{
						alert("Please try after sometime...");
					}
				}
			});
		}
	}
	
	function save_services(){
		var form 							= $('#service_hours').serialize();
		var services						= ''; 
		var further_details					= '';
		var url								= "<?php echo base_url() ?>consulting_location/service_hours"; 
		if($("#location_key").length && $("#location_key").val() != ''){
			var  location_key				= $("#location_key").val();
			for (var i=1 ;i<8;i++){
				if($("#close_"+i).prop('checked')){
					if($("#mon_close_"+i).prop('checked')){
						if(!$("#service_"+i).prop('checked')){
							if($("#morn_input_start_"+i).val() == ''){
								$("#morn_input_start_"+i).focus();
								$("#morn_input_start_"+i).css('border','1px solid #ff1a1c');
								return false;
							}else if($("#morn_input_end_"+i).val() == ''){
								$("#morn_input_end_"+i).focus();
								$("#morn_input_end_"+i).css('border','1px solid #ff1a1c');
								return false;
							}
						}
					}else if($("#aftr_close_"+i).prop('checked')){
						if(!$("#service_"+i).prop('checked')){
							if($("#aftr_input_start_"+i).val() == ''){
								$("#aftr_input_start_"+i).focus();
								$("#aftr_input_start_"+i).css('border','1px solid #ff1a1c');
								return false;
							}else if($("#aftr_input_end_"+i).val() == ''){
								$("#aftr_input_end_"+i).focus();
								$("#aftr_input_end_"+i).css('border','1px solid #ff1a1c');
								return false;
							}
						}
					}else if($("#eve_close_"+i).prop('checked')){
						if(!$("#service_"+i).prop('checked')){
							if($("#eve_input_start_"+i).val() == ''){
								$("#eve_input_start_"+i).focus();
								$("#eve_input_start_"+i).css('border','1px solid #ff1a1c');
								return false;
							}else if($("#eve_input_end_"+i).val() == ''){
								$("#eve_input_end_"+i).focus();
								$("#eve_input_end_"+i).css('border','1px solid #ff1a1c');
								return false;
							}
						}
					} 
				} 
			} 
			
			
			var room_length	= $("#add_consulting").val();
			var	txt_arr		=	[]; 	
			if(room_length > 0){
				for(var x= 0 ;x<room_length ;x++){
					if($("#room_text_"+x).length >0){
						if($("#room_text_"+x).val() != ''){
							txt_arr	[x]		= $("#room_text_"+x).val();
							$("#room_text_"+x).css('border','1px solid #ccc');
						}else{
							$("#room_text_"+x).focus();
							$("#room_text_"+x).css('border','1px solid #ff1a1c');
							return false;
						}
					}
				}
			}
			
			if($("#services").val() !=''){
				services			= $("#services").val();
			}
			if($("#further_details").val() != ''){
				further_details			= $("#further_details").val();
			}
			
			$.ajax({
				url: url,
				type: 'POST',
				data: form + "&location_key="+location_key+"&services="+services+"&further= "+further_details+"&room_txt="+txt_arr,
				dataType: "json",
				success: function(data){
					console.log(data);
					if(data['response'].trim()  == 'success'){
						$("#response").html("Last saved :" +data['last_time']);
						$("#pDcheck6").iCheck("check");
						nxt_tab('service_document');
					}else{
						alert("Please try after sometime...");
					} 
				}
			});
		}else{
			alert("Please fill details tab first");
		}
	}

	var doccheck = document.getElementById("doc");

	var imacheck = document.getElementById("ima");

	var vedcheck = document.getElementById("ved");

	function docCheck() {

		var doct = document.getElementById("doctype");

		doct.style.display = "";

		var imat = document.getElementById("imatype");

		imat.style.display = "none";

		var vedt = document.getElementById("vedtype");

		vedt.style.display = "none";

		var docum = document.getElementById("document");
		docum.style.display = "";

		var imgs = document.getElementById("images");
		imgs.style.display = "none";

		var vid = document.getElementById("videos");
		vid.style.display = "none";

	}

	function imaCheck() {

		var imat = document.getElementById("imatype");

		imat.style.display = "";

		var doct = document.getElementById("doctype");
		doct.style.display = "none";

		var vedt = document.getElementById("vedtype");

		vedt.style.display = "none";

		var docum = document.getElementById("document");
		docum.style.display = "none";

		var imgs = document.getElementById("images");
		imgs.style.display = "";

		var vid = document.getElementById("videos");
		vid.style.display = "none";

	}


	function vedCheck() {

		var vedt = document.getElementById("vedtype");

		vedt.style.display = "";

		var doct = document.getElementById("doctype");

		doct.style.display = "none";

		var imat = document.getElementById("imatype");

		imat.style.display = "none";

		var docum = document.getElementById("document");
		docum.style.display = "none";

		var imgs = document.getElementById("images");
		imgs.style.display = "none";

		var vid = document.getElementById("videos");
		vid.style.display = "";
	}


	function moCheck(a) {
		if($("#service_"+a).prop("checked")){
			$("#morn_input_start_"+a).css('visibility','hidden');
			$("#morn_input_end_"+a).css('visibility','hidden');
			$("#aftr_input_start_"+a).css('visibility','hidden');
			$("#aftr_input_end_"+a).css('visibility','hidden');
			$("#eve_input_start_"+a).css('visibility','hidden');
			$("#eve_input_end_"+a).css('visibility','hidden');
			
		}else{
			$("#morn_input_start_"+a).css('visibility','visible');
			$("#morn_input_end_"+a).css('visibility','visible');
			$("#aftr_input_start_"+a).css('visibility','visible');
			$("#aftr_input_end_"+a).css('visibility','visible');
			$("#eve_input_start_"+a).css('visibility','visible');
			$("#eve_input_end_"+a).css('visibility','visible');
		}
	}

	function consulting_activity(a) {
		if($("#close_"+a).prop("checked")){
			$("#service_"+a).attr('disabled',false);
			DG.switches["#mon_close_"+a].check();
			DG.switches["#aftr_close_"+a].check();
			DG.switches["#eve_close_"+a].check();
			$("#morn_input_start_"+a).css('visibility','visible');
			$("#morn_input_end_"+a).css('visibility','visible');
			$("#aftr_input_start_"+a).css('visibility','visible');
			$("#aftr_input_end_"+a).css('visibility','visible');
			$("#eve_input_start_"+a).css('visibility','visible');
			$("#eve_input_end_"+a).css('visibility','visible');
			$("#sub_option_"+a).show();
		}else{
			//DG.switches("#mon_close_"+a);
			$("#service_"+a).attr('disabled',true);
			$("#service_"+a).prop('checked',false);
			$("#morn_input_start_"+a).css('visibility','hidden');
			$("#morn_input_end_"+a).css('visibility','hidden');
			$("#aftr_input_start_"+a).css('visibility','hidden');
			$("#aftr_input_end_"+a).css('visibility','hidden');
			$("#eve_input_start_"+a).css('visibility','hidden');
			$("#eve_input_end_"+a).css('visibility','hidden');
			$("#sub_option_"+a).hide();
		}
	}
	
	
	
	function change_stat(a,b){
		if(b == 'mor'){
			if($("#mon_close_"+a).prop('checked')){
				$("#mon_close_"+a).prop('checked',false);
				$('#morn_input_start_'+a).css('visibility','hidden');
				$('#morn_input_end_'+a).css('visibility','hidden');
			}else{
				$("#mon_close_"+a).prop('checked',true);
				$('#morn_input_start_'+a).css('visibility','visible');
				$('#morn_input_end_'+a).css('visibility','visible');
			}
		}else if(b == 'aftr'){
			if($("#aftr_close_"+a).prop('checked')){
				$("#aftr_close_"+a).prop('checked',false);
				$('#aftr_input_start_'+a).css('visibility','hidden');
				$('#aftr_input_end_'+a).css('visibility','hidden');
			}else{
				$("#aftr_close_"+a).prop('checked',true);
				$('#aftr_input_start_'+a).css('visibility','visible');
				$('#aftr_input_end_'+a).css('visibility','visible');
			}
		}else if(b == 'eve'){
			if($("#eve_close_"+a).prop('checked')){
				$("#eve_close_"+a).prop('checked',false);
				$('#eve_input_start_'+a).css('visibility','hidden');
				$('#eve_input_end_'+a).css('visibility','hidden');
			}else{
				$("#eve_close_"+a).prop('checked',true);
				$('#eve_input_start_'+a).css('visibility','visible');
				$('#eve_input_end_'+a).css('visibility','visible');
			}
		}
	}



   /* function tuCheck() {
		var tucheck = document.getElementById("tucheck");
		var tu = document.getElementsByClassName("tuopen");

		for (var i = 0; i <= tu.length; i++) {
			if (tucheck.checked == true) {
				tu[i].style.display = "none";
			}

			else {
				tu[i].style.display = "";
			}
		}
	}*/
	function moCloseCheck() {
		var mcheck = document.getElementById("close1");
		var mo = document.getElementsByClassName("mopen");
		var mo1 = document.getElementsByClassName("mclose24")

		for (var i = 0; i <= mo.length; i++) {
			if (mcheck.checked == true) {
				mo[i].style.display = "none";
				mo1[0].style.display = "none";
			}

			else {
				mo[i].style.display = "";
				mo1[0].style.display = "";
			}
		}
	}

	function tuCloseCheck() {
		var tcheck = document.getElementById("close2");
		var tu = document.getElementsByClassName("tuopen");
		var tu1 = document.getElementsByClassName("tuclose24")

		for (var i = 0; i <= tu.length; i++) {
			if (tcheck.checked == true) {
				tu[i].style.display = "none";
				tu1[0].style.display = "none";
			}
			else {
				tu[i].style.display = "";
				tu1[0].style.display = "";
			}
		}
	}


	var $imageupload = $('.imageupload');
	$imageupload.imageupload();


	function pdCheck2() {
		var check = document.getElementById("prof_name").value;
		var elem = document.getElementsByClassName("icheckbox_flat-green");
		if (check !== "") {
			document.getElementById("pDcheck3").checked = true;
			elem[0].setAttribute("class", "icheckbox_flat-green checked");
		} else {
			document.getElementById("pDcheck3").checked = false;
			elem[0].setAttribute("class", "icheckbox_flat-green");
		}
	}



	function pdCheck5() {

		var check = document.getElementById("demograp").value;
		var elem = document.getElementsByClassName("icheckbox_flat-green");
		if (check !== "") {
			document.getElementById("pDcheck6").checked = true;
			elem[1].setAttribute("class", "icheckbox_flat-green checked");
		} else {
			document.getElementById("pDcheck6").checked = false;
			elem[1].setAttribute("class", "icheckbox_flat-green");
		}
	}



	$(function () {
		$('.multiselect-ui').multiselect({
			maxHeight: 200,
			includeSelectAllOption: true
		});

	});


	function clearGP() {
		var r = confirm("Are you sure want to clear all data?");
		if (r == true) {
			$('#service_hours').find('input').val('');
		}
	}

	function chkfiles() {

		var chk = document.getElementById("chkallfiles").checked;

		var item = document.getElementById("multiaction");

		if (chk == true) {
			var chkall = document.getElementsByClassName("files");

			item.style.display = "block";

			for (var i = 0; i <= chkall.length; i++) {
				chkall[i].checked = true;
			}
		} else if (chk == false) {

			item.style.display = "none";

			var chkall = document.getElementsByClassName("files");
			for (var i = 0; i <= chkall.length; i++) {
				chkall[i].checked = false;
			}
		}
	}

	function chkpublic() {

		var chk = document.getElementById("publicviewall").checked;


		if (chk == true) {
			var chkall = document.getElementsByClassName("publicview");



			for (var i = 0; i <= chkall.length; i++) {
				chkall[i].checked = true;
			}
		} else if (chk == false) {


			var chkall = document.getElementsByClassName("publicview");
			for (var i = 0; i <= chkall.length; i++) {
				chkall[i].checked = false;
			}
		}
	}

	function chkopen() {

		var chk = document.getElementById("openall").checked;

		if (chk == true) {
			var chkall = document.getElementsByClassName("open");


			for (var i = 0; i <= chkall.length; i++) {
				chkall[i].checked = true;

			}
		} else if (chk == false) {

			var chkall = document.getElementsByClassName("open");
			for (var i = 0; i <= chkall.length; i++) {
				chkall[i].checked = false;

			}
		}
	}



    </script>
    <!-- Switchery -->
 
    <script>

		new DG.OnOffSwitchAuto({
            cls: '.mor-switch1',
            textOn: "M",
            height: 20,
			width: 40,
            textOff: "M",
			trackColorOn:'#E87E04',
			textSizeRatio: 0.5,
            listener: function (e){
				change_stat(1,'mor');              
            }
        });
		new DG.OnOffSwitchAuto({
            cls: '.aftr-switch1',
            textOn: "A",
            height: 20,
			width: 40,
            textOff: "A",
			trackColorOn:'#F7CA18',
			textSizeRatio: 0.5,
            listener: function (e){
				change_stat(1,'aftr');              
            }
        });
		new DG.OnOffSwitchAuto({
            cls: '.eve-switch1',
            textOn: "E",
            height: 20,
			width: 40,
            textOff: "E",
			trackColorOn:'#52B3D9',
            textSizeRatio: 0.5,
            listener: function (e){
				change_stat(1,'eve');              
            }
        });
		
		
		
		new DG.OnOffSwitchAuto({
            cls: '.mor-switch2',
            textOn: "M",
            height: 20,
			width: 40,
            textOff: "M",
			trackColorOn:'#E87E04',
			textSizeRatio: 0.5,
            listener: function (e){
				change_stat(2,'mor');              
            }
        });
		new DG.OnOffSwitchAuto({
            cls: '.aftr-switch2',
            textOn: "A",
            height: 20,
			width: 40,
            textOff: "A",
			trackColorOn:'#F7CA18',
			textSizeRatio: 0.5,
            listener: function (e){
				change_stat(2,'aftr');              
            }
        });
		new DG.OnOffSwitchAuto({
            cls: '.eve-switch2',
            textOn: "E",
            height: 20,
			width: 40,
            textOff: "E",
			trackColorOn:'#52B3D9',
            textSizeRatio: 0.5,
            listener: function (e){
				change_stat(2,'eve');              
            }
        });
		
		
		new DG.OnOffSwitchAuto({
            cls: '.mor-switch3',
            textOn: "M",
            height: 20,
			width: 40,
            textOff: "M",
			trackColorOn:'#E87E04',
			textSizeRatio: 0.5,
            listener: function (e){
				change_stat(3,'mor');              
            }
        });
		new DG.OnOffSwitchAuto({
            cls: '.aftr-switch3',
            textOn: "A",
            height: 20,
			width: 40,
            textOff: "A",
			trackColorOn:'#F7CA18',
			textSizeRatio: 0.5,
            listener: function (e){
				change_stat(3,'aftr');              
            }
        });
		new DG.OnOffSwitchAuto({
            cls: '.eve-switch3',
            textOn: "E",
            height: 20,
			width: 40,
            textOff: "E",
			trackColorOn:'#52B3D9',
            textSizeRatio: 0.5,
            listener: function (e){
				change_stat(3,'eve');              
            }
        });
		
		
		new DG.OnOffSwitchAuto({
            cls: '.mor-switch4',
            textOn: "M",
			height: 20,
			width: 40,
            textOff: "M",
			trackColorOn:'#E87E04',
			textSizeRatio: 0.5,
            listener: function (e){
				change_stat(4,'mor');              
            }
        });
		new DG.OnOffSwitchAuto({
            cls: '.aftr-switch4',
            textOn: "A",
            height: 20,
			width: 40,
            textOff: "A",
			trackColorOn:'#F7CA18',
			textSizeRatio: 0.5,
            listener: function (e){
				change_stat(4,'aftr');              
            }
        });
		new DG.OnOffSwitchAuto({
            cls: '.eve-switch4',
            textOn: "E",
            height: 20,
			width: 40,
            textOff: "E",
			trackColorOn:'#52B3D9',
            textSizeRatio: 0.5,
            listener: function (e){
				change_stat(4,'eve');              
            }
        });
		
		
		new DG.OnOffSwitchAuto({
            cls: '.mor-switch5',
            textOn: "M",
            height: 20,
			width: 40,
            textOff: "M",
			trackColorOn:'#E87E04',
			textSizeRatio: 0.5,
            listener: function (e){
				change_stat(5,'mor');              
            }
        });
		new DG.OnOffSwitchAuto({
            cls: '.aftr-switch5',
            textOn: "A",
            height: 20,
			width: 40,
            textOff: "A",
			trackColorOn:'#F7CA18',
			textSizeRatio: 0.5,
            listener: function (e){
				change_stat(5,'aftr');              
            }
        });
		new DG.OnOffSwitchAuto({
            cls: '.eve-switch5',
            textOn: "E",
            height: 20,
			width: 40,
            textOff: "E",
			trackColorOn:'#52B3D9',
            textSizeRatio: 0.5,
            listener: function (e){
				change_stat(5,'eve');              
            }
        });
		
		
		
		new DG.OnOffSwitchAuto({
            cls: '.mor-switch6',
            textOn: "M",
            height: 20,
			width: 40,
            textOff: "M",
			trackColorOn:'#E87E04',
			textSizeRatio: 0.5,
            listener: function (e){
				change_stat(6,'mor');              
            }
        });
		new DG.OnOffSwitchAuto({
            cls: '.aftr-switch6',
            textOn: "A",
            height: 20,
			width: 40,
            textOff: "A",
			trackColorOn:'#F7CA18',
			textSizeRatio: 0.5,
            listener: function (e){
				change_stat(6,'aftr');              
            }
        });
		new DG.OnOffSwitchAuto({
            cls: '.eve-switch6',
            textOn: "E",
            height: 20,
			width: 40,
            textOff: "E",
			trackColorOn:'#52B3D9',
            textSizeRatio: 0.5,
            listener: function (e){
				change_stat(6,'eve');              
            }
        });
		
		
		new DG.OnOffSwitchAuto({
            cls: '.mor-switch7',
            textOn: "M",
            height: 20,
			width: 40,
            textOff: "M",
			trackColorOn:'#E87E04',
			textSizeRatio: 0.5,
            listener: function (e){
				change_stat(7,'mor');              
            }
        });
		new DG.OnOffSwitchAuto({
            cls: '.aftr-switch7',
            textOn: "A",
            height: 20,
			width: 40,
            textOff: "A",
			trackColorOn:'#F7CA18',
			textSizeRatio: 0.5,
            listener: function (e){
				change_stat(7,'aftr');              
            }
        });
		new DG.OnOffSwitchAuto({
            cls: '.eve-switch7',
            textOn: "E",
            height: 20,
			width: 40,
            textOff: "E",
			trackColorOn:'#52B3D9',
            textSizeRatio: 0.5,
            listener: function (e){
				change_stat(7,'eve');              
            }
        });
		

        new DG.OnOffSwitchAuto({
            cls: '.custom-switch1',
            textOn: "Open",
            height: 30,
			width: 130,
            textOff: "Close",
            textSizeRatio: 0.40,
            listener: function (e){
				if($("#close_1").prop('checked')){
					$("#close_1").prop('checked',false);
					consulting_activity(1);
				}else{
					$("#close_1").prop('checked',true);
					consulting_activity(1);
				}               
            }
        });
        new DG.OnOffSwitchAuto({
            cls: '.custom-switch2',
            textOn: "Open",
			height: 30,
			width: 130,
            textOff: "Close",
            textSizeRatio: 0.40,
            listener: function (e) {
				if($("#close_2").prop('checked')){
					$("#close_2").prop('checked',false);
					consulting_activity(2);
				}else{
					$("#close_2").prop('checked',true);
					consulting_activity(2);
				}
            }
        });
		 new DG.OnOffSwitchAuto({
            cls: '.custom-switch3',
            textOn: "Open",
			height: 30,
			width: 130,
            textOff: "Close",
            textSizeRatio: 0.40,
            listener: function (e) {
				if($("#close_3").prop('checked')){
					$("#close_3").prop('checked',false);
					consulting_activity(3);
				}else{
					$("#close_3").prop('checked',true);
					consulting_activity(3);
				}
			}
        });
        new DG.OnOffSwitchAuto({
            cls: '.custom-switch4',
            textOn: "Open",
			height: 30,
			width: 130,
            textOff: "Close",
            textSizeRatio: 0.40,
            listener: function (e) {
				if($("#close_4").prop('checked')){
					$("#close_4").prop('checked',false);
					consulting_activity(4);
				}else{
					$("#close_4").prop('checked',true);
					consulting_activity(4);
				}
            }
        });
		 new DG.OnOffSwitchAuto({
            cls: '.custom-switch5',
            textOn: "Open",
            height: 30,
			width: 130,
            textOff: "Close",
            textSizeRatio: 0.40,
            listener: function (e) {
				if($("#close_5").prop('checked')){
					$("#close_5").prop('checked',false);
					consulting_activity(5);
				}else{
					$("#close_5").prop('checked',true);
					consulting_activity(5);
				}
            }
        });
        new DG.OnOffSwitchAuto({
            cls: '.custom-switch6',
            textOn: "Open",
			height: 30,
			width: 130,
            textOff: "Close",
            textSizeRatio: 0.40,
            listener: function (e) {
				if($("#close_6").prop('checked')){
					$("#close_6").prop('checked',false);
					consulting_activity(6);
				}else{
					$("#close_6").prop('checked',true);
					consulting_activity(6);
				}
            }
        });
		
		 new DG.OnOffSwitchAuto({
            cls: '.custom-switch7',
            textOn: "Open",
			height: 30,
			width: 130,
            textOff: "Close",
            textSizeRatio: 0.40,
            listener: function (e) {
				if($("#close_7").prop('checked')){
					$("#close_7").prop('checked',false);
					consulting_activity(7);
				}else{
					$("#close_7").prop('checked',true);
					consulting_activity(7);
				}
            }
        });
        

       /* $(document).ready(function () {
            Dropzone.options.myAwesomeDropzone = {

                accept: function (file, done) {
                    var re = /(?:\.([^.]+))?$/;
                    var ext = re.exec(file.name)[1];
                    ext = ext.toUpperCase();
                    if (ext == "JPEG" || ext == "BMP" || ext == "GIF" || ext == "JPG" || ext == "PNG" || ext == "JPE") {
                        done();
                    }
                    else { done("just select jpeg or bmp or gif or pnj files."); }
                }
            };

        });
	   */


    </script>
    <script>
        //newly added by vajesh
 		function preview_file(id,input, prev, imgDiv){
			 
			if (input.files) {
				var filesAmount = input.files.length;
				var html_content = '';
				for (i = 0; i < filesAmount; i++) {
					var reader = new FileReader();
					file_name = input.files[i]['name'];
					//   reader.onload = function (event) {
					x = i + 1;
					var html_content = html_content + '<tr id="'+imgDiv+'_row_'+i+'" role="row" class="odd"><td style="padding-left:8px;">' + x + '</td><td tabindex="0" class="sorting_1"><a href="#">' + file_name + '</a></td><td tabindex="0" class="sorting_1"><div class="form-group"><input class="form-control" type="text" style="width:99% !important" id="'+imgDiv+'_text_'+i+'" ></div></td><td tabindex="0"> <input type="checkbox" id="'+imgDiv+'_vis_'+i+'" /></td><td tabindex="0"><a href="#" class="btn btn-success" onclick="remove_upload_row('+"'"+imgDiv+"'"+','+"'"+prev+"'"+','+i+')"><i class="fa  fa-trash" data-toggle="tooltip" data-title="Delete" data-original-title="" title=""></i></a></td></tr>';
					}
				html_content	= html_content+'<tr ><td colspan="5" align="right"><a href="javascript:void(0);" class="buttonNext btn btn-success" onclick="upload_documents('+"'"+id+"'"+",'"+imgDiv+"'"+');"><i class="fa fa-upload" aria-hidden="true"></i> Upload files</a></td></tr>'; 
				$("#"+prev).html(html_content);
				$('#'+imgDiv).show();
				$('#'+imgDiv+"_new").show();
				$("#"+prev).show();
			}
		}
	  
		
		function upload_documents(id,a){
			if($("#location_key").val() != ''){
				if(a == 'upload_doc'){
					var upload_file			= document.getElementById('upload-file-selector');
				}else if(a == 'upload_img'){
					var upload_file			= document.getElementById('upload-file-image');
				}else if(a == 'upload_video'){
					var upload_file			= document.getElementById('upload-file-video');
				}
				var url						= "<?php echo base_url(); ?>consulting_location/service_documents";
				var i = 0, len = upload_file.files.length,file;
				form_data = new FormData();
				var details				= new Array();
				for (; i < len; i++){
					file = upload_file.files[i];
					if($("#"+a+"_text_"+i).length>0){
						form_data.append("file["+i+"]", file);
						form_data.append("title["+i+"]",$("#"+a+"_text_"+i).val());
						if($("#"+a+"_vis_"+i).prop('checked')){
							vis				= 1;
						}else{
							vis				= 0;
						}
						form_data.append("show["+i+"]",vis);
					}
				}
				form_data.append('file_type',a);
				form_data.append('location_key',$("#location_key").val());
				
				$.ajax({
						url: url,
						type: 'POST',
						data: form_data,
						dataType: "json",
						processData: false,
						contentType: false,
						success: function(data){
							var cont			= data.response;			
							if(cont.trim() =='success'){
								var html_content				= '';
								if(data.details.length> 0){
									for(i=0;i<data.details.length;i++){
										if(data.details[i].show_public == 0){
											visibility		= 'Invisible';
										}else{
											visibility		= 'Visible';
										}
										html_content			+='<tr role="row"><td></td><td tabindex="0"><a href="#">'+data.details[i].title+'</a></td><td>'+visibility+'</td><td><a href="<?php echo base_url(); ?>assets/uploads/'+data.details[i].file_path+data.details[i].file_name+'" target="_blank" class="btn btn-success"><i class="fa fa-eye" data-toggle="tooltip" data-title="Share Document" data-original-title="" title=""></i></a></td></tr>';
									}
								}
								if($("#"+a+"_empty").length > 0){
									$("#"+a+"_exist_list").html(html_content);
								}else{
									$("#"+a+"_exist_list").append(html_content);
								}
								$("#"+a+"_new").hide();
								$("#"+a+"_exist").show();
								$("#pDcheck7").iCheck("check");
								$("#"+id).val('');
							}
						}
				});
			}else{
				alert('Please fill details tab first..');
			}
		}
	
		function remove_upload_row(a,b,c){
			var alrt						= confirm('Are you sure do you want to remove this row?');
			if(alrt){
				$("#"+a+"_row_"+c).remove();
				if($("#"+b).html() == ''){
					$("#"+a).hide();
				}
			}
		}
		
		function summary_page(){
			if($("#location_key").val() != ''){
				window.location.href		= "<?php echo base_url() ?>consulting_location/manage_venue";
			}else{
				alert('Please fill details tab first..');
			}
		}
		
		function add_room(){
			var i							= $("#add_consulting").val();
			var elem						= '<div class="row" id="room_'+i+'"><div class="col-md-12 col-sm-12 col-xs-12" style="padding:10px;"><div class="col-md-10 col-sm-12 col-xs-12"><input id="room_text_'+i+'"class="form-control" type="text" placeholder="Title of room" /></div><div class="col-md-2 col-sm-12 col-xs-12"><i class="fa fa-minus-circle" style="font-size:15px;" onclick="remove_room('+i+')"></i></div></div></div></div>';
			$("#consulting_room").append(elem);
			$("#add_consulting").val(++i);
		} 
		
		function remove_room(a){
			$("#room_"+a).remove();
		}
		
		function change_status(a,b){
			var url							= "<?php echo base_url() ?>consulting_location/change_room_status";						
			$.post(url,{a:a,b:b},function(data){
				if(data.response.trim() 	== 'success'){
					if(data.status == 'active'){
						$("#room_status_"+b).css('color','#146068');
					}else{
						$("#room_status_"+b).css('color','#f11d1d');
					}
				}else{
					alert('Please try after sometime...');
				}
			},'json');
		} 
		
		function edit_room(a,b,c){
			$("#room_area_"+b).html('<div class="row"><div class="col-md-12 col-sm-12 col-xs-12"><div class="col-md-10 col-sm-12 col-xs-12"><input type="text" class="form-control" value="'+a+'" id="edit_text_'+b+'"></div><div class="col-md-2 col-sm-12 col-xs-12"><input type="button" value="save" class="btn btn-primary" onclick = "update_text('+c+','+b+');" /></div></div></div>');
			$("#room_area_"+b).css('border','none');
		}
		
		function update_text(a,b){
			var url							= "<?php echo base_url() ?>consulting_location/update_room_text";		
			var c							= $("#edit_text_"+b).val();
			if(c.trim() == ''){
				$("#edit_text_"+b).focus();
				$("#edit_text_"+b).css('border','1px solid #ff1a1c');
			}else{
				$.post(url,{a:a,b:b,c:c},function(data){
					if(data.response.trim() 	== 'success'){
						$('#room_area_'+b).html(data.response_text.trim());
						$('#room_area_'+b).css('border','1px solid #ccc');
					}else{
						alert('Please try after sometime...');
					}
				},'json');
			}
		}
		function week_days(a){
			if($(a).prop('checked')){
				$("#service_1").prop('checked', true);
				moCheck(1);
				$("#service_2").prop('checked', true);
				moCheck(2);
				$("#service_3").prop('checked', true);
				moCheck(3);
				$("#service_4").prop('checked', true);
				moCheck(4);
				$("#service_5").prop('checked', true);
				moCheck(5);
			}else{
				$("#service_1").prop('checked', false);
				moCheck(1);
				$("#service_2").prop('checked', false);
				moCheck(2);
				$("#service_3").prop('checked', false);
				moCheck(3);
				$("#service_4").prop('checked', false);
				moCheck(4);
				$("#service_5").prop('checked', false);
				moCheck(5);
			}
		}
		
    </script>
	<link href="<?php echo base_url();?>assets/vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
	<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
    <style>
        h2.pat-search {
            margin: 10px 0 6px;
        }
        .list-panel {
            padding: 0;
        }
        .calendar-des {
            color: #146068 !important;
            font-size: 12px !important;
        }
		.modal-dialog{
			z-index:1040 !important
		}
    </style>
            <!-- /top navigation -->
            <!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->
                <form class="form-horizontal form-label-left row custom_temp">
                    <div class="x_panel" style="height: auto;">
                        <!-- End Patients Search-->
                        <div class="x_title">
                            <h2 class="col-md-2 pat-search">Patient Search</h2>
                            <div class="col-md-8">
                                <div class="col-md-2 col-sm-9 col-xs-12 padding-null">
                                    <select class="form-control select-bg" id="search_cat">
                                        <option value="name">Name</option>
                                        <option value="phone">Mobile</option>
                                        <option value="nhs_no">NHS/Aadhaar/Social Security</option>
                                    </select>
                                </div>
                                <div class="col-md-7 col-sm-9 col-xs-12 padding-null">
                                    <input type="text" class="form-control" placeholder="Search here..." id="search_val">
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12 padding-null">
                                    <select class="form-control select-bg" id="search_status">
                                        <option value='all'>All</option>
                                        <option value='active'>Active</option>
                                        <option value='inactive'>Inactive</option>
                                        <option value='deceased'>Deceased</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12 text-right">
                                <button type="button" class="btn btn-success" id="patient-search-btn" style="margin-right:0; min-width:10%;">Search</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content padding-null" style="display: block;">
                            <div class="col-xs-12 col-sm-12 col-md-12 padding-null" id="patient-result" style="display: none;">
                                <div class="x_panel">
                                    <div class="x_title" style="margin-bottom: 0;">
                                        <h2>Patients List</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <table class="table table-bordered patient-result">
                                            <thead>
                                                <tr>
                                                    <th style="width: 8%;">ID</th>
                                                    <th style="width: 18%;">Name , DOB &amp; NHS No</th>
                                                    <th style="width: 22%;">Address</th>
                                                    <th style="width: 15%;">Preferred doctor</th>
                                                    <th style="width: 12%;">Info</th>
                                                    <th style="width: 8%;">Select</th>
                                                    <th style="width: 16%;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="patient_list">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- End Patients Search-->
                    </div>
                    <!-- Doctor Search Section -->
                    <div class="x_panel" style="height: auto;">
                        <div class="x_title">
                            <h2>Doctor Search</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                                </li>

                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Location</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" class="form-control" id="doctor_location">
											<input type="hidden" id="venue_id" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
										<?php
											$type					= array('all'=>'All','clinic'=>'Clinic','home visit'=>'Home Visit','telephone'=>'Telephone','video'=>'Video - Tel');
											$attr					= array('class'=>'form-control','id'=>'type');
											echo form_dropdown('Type',$type,'',$attr);
										?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Services</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                        	<?php
												array_unshift($services,'Select');
												$attr				= array('class'=>'form-control','id'=>'services');
												echo form_dropdown('Type',$services,'',$attr);
											?>
										</div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Clinician</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <?php
												$clinician			= array(''=>'Select');
												$attr				= array('class'=>'form-control','id'=>'clinician');
												echo form_dropdown('Type',$clinician,'',$attr);
											?>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-sm-6 col-md-8">
                                    <div class="form-group pull-right">
                                        <div class="col-md-12 col-sm-12 col-xs-12 text-right">
											<input type="button" class="btn btn-success" style="margin-right:0; min-width:50%;" id="clinician_search" value="Search" />
										
                                            <!--<button type="submit" class="btn btn-success" style="margin-right:0; min-width:50%;" id="clinician_search">Search</button>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Doctor Search-->
                    <div class="x_panel padding-one">
                        <div class="col-sm-12 col-md-2 col-xs-12 padding-one" id="menu_list">
                            <!-- left side Doctor list menu-->
                            <div class="x_panel list-panel">
                                <h4>Doctor's <a data-toggle="collapse" href="#collapse-clinic" style="color: #229e78;padding-right: 10px;" class="pull-right collapsed" aria-expanded="false"><i class="fa fa-chevron-circle-down" data-toggle="tooltip" data-title="More Details" data-original-title="" title=""></i></a></h4>
                                <div id="collapse-clinic" class="collapse" aria-expanded="false" style="height: 0px;">
                                    <ul class="list-group dr-list">
                                       <!-- 
									    <li class="list-group-item"><span class="color-circle" style="background-color: #26B99A"><img src="images/img.jpg" alt=""></span> <span class="dr-list-name">Doctor name 1</span></li>
                                        <li class="list-group-item"><span class="color-circle" style="background-color: #f0ad4e"><img src="images/img.jpg" alt=""></span> <span class="dr-list-name">Doctor name 2</span></li>
                                        <li class="list-group-item"><span class="color-circle" style="background-color: #f32a2a">JD</span> <span class="dr-list-name">Clinic name 1</span></li>
                                        <li class="list-group-item"><span class="color-circle" style="background-color: #26B99A"><img src="images/img.jpg" alt=""></span> <span class="dr-list-name">Doctor name 3</span></li>
                                        <li class="list-group-item"><span class="color-circle" style="background-color: #f0ad4e">JD</span> <span class="dr-list-name">Doctor name 4</span></li>
                                        <li class="list-group-item"><span class="color-circle" style="background-color: #f32a2a"><img src="images/img.jpg" alt=""></span> <span class="dr-list-name">Doctor name 5</span></li>
										-->
									</ul>
                                </div>
                            </div>
                            <!-- end of the left side Doctor list menu-->
                            <!-- left side menu list menu-->
                            <div class="x_panel padding-null">
                                <div id="cssmenu">
                                    <ul class="list-group ">
                                        <li class="custom-list-group list-group-item"><a href="alerts.html" class="left_side"><i class="fa fa-bell-o"></i>  Alerts</a></li>
                                        <li class="custom-list-group list-group-item"><a href="#" class="left_side"><i class="fa fa-hand-pointer-o"></i> Reminders</a></li>
                                        <li class="custom-list-group list-group-item"><a href="#"><i class="fa fa-calendar"></i> Appointments</a></li>
                                        <li class="custom-list-group list-group-item"><a href="#"><i class="fa fa fa-user-plus"></i> Consultations</a></li>
                                        <li class="custom-list-group list-group-item"><a href="#"><i class="fa fa-heartbeat"></i> Vitals</a></li>
                                        <li class="custom-list-group list-group-item"><a href="#"><i class="fa fa-file-text-o"></i> Journal</a></li>
                                        <li class="custom-list-group list-group-item"><a href="#"><i class="fa fa-search"></i> Investigations</a></li>
                                        <li class="custom-list-group list-group-item"><a href="#"><i class="fa fa-users"></i> Referrals</a></li>
                                        <li class="custom-list-group list-group-item"><a href="#"><i class="fa fa-file-o"></i> Sick Note</a></li>
                                        <li class="custom-list-group list-group-item"><a href="#"><i class="fa fa-eyedropper"></i> Prescriptions</a></li>
                                        <li class="custom-list-group list-group-item"><a href="#"><i class="fa fa-stethoscope"></i> Imms/Vacs</a></li>
                                        <li class="custom-list-group list-group-item"><a href="#"><i class="fa fa-files-o"></i> Documents</a></li>
                                        <li class="custom-list-group list-group-item"><a href="#"><i class="fa fa-home"></i> OPs</a></li>
                                        <li class="custom-list-group list-group-item has-sub">
                                            <a><i class="fa fa-medkit"></i> Health <i class="fa fa-caret-down pull-right" aria-hidden="true"></i></a>
                                            <ul style="display: none;">
                                                <li><a href="#"><i class="fa fa-universal-access"></i> Exercise</a></li>
                                                <li><a href="#"><i class="fa fa-cutlery" aria-hidden="true"></i>  Diet</a></li>
                                                <li><a href="#"><img src="<?php echo base_url(); ?>assets/img/icons/alcohol.png"> Alcohol</a></li>
                                                <li><a href="#"><img src="<?php echo base_url(); ?>assets/img/icons/smoke.png"> Smoke</a></li>
                                                <li><a href="#"><img src="<?php echo base_url(); ?>assets/img/icons/substance.png"> Substance</a></li>
                                            </ul>
                                        </li>
                                        <li class="custom-list-group list-group-item"><a href="#"><i class="fa fa-bar-chart-o"></i> Reports</a></li>
                                        <li class="custom-list-group list-group-item"><a href="#"><i class="fa fa-envelope-open-o"></i> Invoices</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end of the left side menu list menu-->
                        </div>
                        <div class="col-sm-12 col-md-10 col-xs-12 padding-one" id="calendar_view">
                            <!-- Calendar Section-->
                            <div class="x_panel">
                                <div id="calendar" style="overflow-y: auto;" ></div>
                            </div>
                            <!-- End of the Calendar Section-->
                        </div>
                        <div class="col-md-8 padding-one" style="display:none" id="calendar_v">
                            <div class="x_panel summary-view">
                                <h3>Summary</h3>
								<span class="pull-right" onclick="close_view();"><i class="fa fa-times"></i></span>
                                <ul class="summary-contain col-xs-12 col-sm-12 col-md-12" id="summary-contain">
                                 	
									<!--<li class="summary-row col-xs-12 col-sm-12 col-md-12 active" role="presentation">
                                        <div>
                                            <div class="col-xs-10 col-sm-11 col-md-11">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-4 col-md-4"><h5>Dr. John Doe</h5></div>
                                                    <div class="col-xs-12 col-sm-8 col-md-8"> 12/03/17, 10:00am - 20:00pm</div>
                                                </div>
                                                <div class="row booked-field">
                                                    <div class="col-xs-4 col-sm-4"><h5>General clinic center</h5></div>
                                                    <div class="col-xs-8 col-sm-8">
                                                        <div class="booked-count">
                                                            Booked: <input type="text" readonly="" class="form-control" name="booking1" id="booked1" value="4">
                                                        </div>
                                                        <div class="free-count">
                                                            Free: <input type="text" readonly="" class="form-control" name="booking1" id="booked1" value="9">
                                                        </div>
                                                        <div class="blocked-count">
                                                            Blocked: <input type="text" readonly="" class="form-control" name="booking1" id="booked1" value="2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-4 col-md-4"><h5>London, UK</h5></div>
                                                    <div class="col-xs-12 col-sm-8 col-md-8 action-icon" style="text-align:left;font-size: 16px;margin-top:-6px;">
                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""></i></a>
                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete" data-original-title="" title=""></i></a>
                                                        <a href="#"><i class="fa fa-print" data-toggle="tooltip" data-title="Print" data-original-title="" title=""></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-target="#summary1" data-toggle="tab" class="col-xs-2 col-sm-1 col-md-1 summary-arrow" style="background-color: #26B99A">
                                                <i class="fa fa-chevron-right"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="summary-row col-xs-12 col-sm-12 col-md-12" role="presentation">
                                        <div>
                                            <div class="col-xs-10 col-sm-11 col-md-11">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-4 col-md-4"><h5>Dr. James Smith</h5></div>
                                                    <div class="col-xs-12 col-sm-8 col-md-8">12/03/17, 10:00am - 20:00pm</div>
                                                </div>
                                                <div class="row booked-field">
                                                    <div class="col-xs-12 col-sm-4 col-md-4"><h5>Diabetic Hospital</h5></div>
                                                    <div class="col-xs-12 col-sm-8 col-md-8">
                                                        <div class="booked-count">
                                                            Booked: <input type="text" readonly="" class="form-control" name="booking2" id="booked1" value="3">
                                                        </div>
                                                        <div class="free-count">
                                                            Free: <input type="text" readonly="" class="form-control" name="booking2" id="booked1" value="7">
                                                        </div>
                                                        <div class="blocked-count">
                                                            Blocked: <input type="text" readonly="" class="form-control" name="booking2" id="booked1" value="2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-4 col-md-4"><h5>London, UK</h5></div>
                                                    <div class="col-xs-12 col-sm-8 col-md-8 action-icon" style="text-align:left; font-size: 16px;margin-top:-6px;">
                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""></i></a>
                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete" data-original-title="" title=""></i></a>
                                                        <a href="#"><i class="fa fa-print" data-toggle="tooltip" data-title="Print" data-original-title="" title=""></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-target="#summary2" data-toggle="tab" class="col-xs-2 col-sm-1 col-md-1 summary-arrow" style="background-color: #f0ad4e">
                                                <i class="fa fa-chevron-right"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="summary-row col-xs-12 col-sm-12 col-md-12" role="presentation">
                                        <div>
                                            <div class="col-xs-10 col-sm-11 col-md-11">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-4 col-md-4"><h5>Dr. David Corner</h5></div>
                                                    <div class="col-xs-12 col-sm-8 col-md-8">12/03/17, 10:00am - 20:00pm</div>
                                                </div>
                                                <div class="row booked-field">
                                                    <div class="col-xs-12 col-sm-4 col-md-4"><h5>Cardio Health Care Hospital</h5></div>
                                                    <div class="col-xs-12 col-sm-8 col-md-8">
                                                        <div class="booked-count">
                                                            Booked: <input type="text" readonly="" class="form-control" name="booking1" id="booked1" value="5">
                                                        </div>
                                                        <div class="free-count">
                                                            Free: <input type="text" readonly="" class="form-control" name="booking1" id="booked1" value="6">
                                                        </div>
                                                        <div class="blocked-count">
                                                            Blocked: <input type="text" readonly="" class="form-control" name="booking1" id="booked1" value="2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-4 col-md-4"><h5>London, UK</h5></div>
                                                    <div class="col-xs-12 col-sm-8 col-md-8 action-icon" style="text-align:left; font-size: 16px;margin-top:-6px;">
                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""></i></a>
                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete" data-original-title="" title=""></i></a>
                                                        <a href="#"><i class="fa fa-print" data-toggle="tooltip" data-title="Print" data-original-title="" title=""></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-target="#summary2" data-toggle="tab" class="col-xs-2 col-sm-1 col-md-1 summary-arrow" style="background-color: #fb7c7c">
                                                <i class="fa fa-chevron-right"></i>
                                            </div>
                                        </div>
                                    </li>-->
								</ul>
                            </div>
                            <div class="x_panel appointment-list" style="display:none;">
                                <div id="appointment-list">
                                    <div class="tab-content">
                                        <div class="row">
                                            <div class="col-xs-4 col-sm-5 col-md-10">
                                                <a href="#" onclick = "create_new_slot('slot_summary_details_0');"><i class="fa fa-plus-square" style="color:#ff9800"></i> Duplicate / Edit Session</a>
                                               <!-- &nbsp;<a href="#" onclick = "edit_session_slot();"><i class="fa fa-edit" style="color:#0000ff"></i> Edit Session</a>-->
												&nbsp;<a href="javascript:void(0)" style="display:none;" id="block_slot_link"><i class="fa fa-edit" style="color:#0000ff"></i> Block Slots</a>	
												&nbsp;<a href="javascript:void(0)" style="display:none;" id="deleted_slot_link"><i class="fa fa-trash" style="color:#ff0000"></i> Delete Slots</a>	
												&nbsp;<a href="javascript:void(0)" style="display:none;" id="merge_slot_link"><i class="fa fa-compress" style="color:#27b727"></i> Merge Slots</a>	
												&nbsp;<a href="javascript:void(0)" style="display:none;" id="duplicate_slot_link"><i class="fa fa-copy" style="color:##9e9e9e"></i> Duplicate</a>	
										</div>
											<div class="col-xs-4 col-sm-5 col-md-2 pull-right">
												<a href="#" class="pull-right"><i class="fa fa-close" onclick="disclose_cal();"></i></a>
											</div>
											<div class="col-xs-2 col-sm-2 col-md-2">
                                            </div>
										</div>
										<div role="tabpanel" class="tab-pane active" id="summary1">
											<!--<table class="table">
												<thead>
													<tr>
														<th style="font-size: 15px;font-weight: 500;">Dr. John Doe</th>
													</tr>
													<tr>
														<th style="font-size: 13px;font-weight: 500;"><i class="fa fa-calendar"></i> 12/03/17</th>
														<th style="font-size: 13px;font-weight: 500;"><i class="fa fa-clock-o"></i> 08:00am - 21:00pm</th>
													</tr>
													<tr>
														<th style="font-size: 13px;font-weight: 500;"><i class="fa fa-hospital-o" aria-hidden="true"></i> General clinic center</th>
														<th style="font-size: 13px;font-weight: 500;">City Name, London</th>
													</tr>
												</thead>
												<tbody>

													<tr>
														<td colspan="4">
															<div class="scrollit">
																<table class="table">
																	<tbody>
																		<tr class="booked-slot-row">
																			<td>
																				<div class="checkbox">
																					<label class="calendar-des">
																						<div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:00
																					</label>
																				</div>
																			</td>
																			<td colspan="2">
																				<div class="table-name">Mr.James Smith<br>(ID - 123456)</div>
																			</td>
																			<td>
																				<div class="action-icon">
																					<a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
																				</div>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<div class="checkbox">
																					<label class="calendar-des">
																						<div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:10
																					</label>
																				</div>
																			</td>
																			<td colspan="2">
																				<div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
																			</td>
																			<td>
																				<div class="action-icon">
																					<a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
																				</div>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<div class="checkbox">
																					<label class="calendar-des">
																						<div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:20
																					</label>
																				</div>
																			</td>
																			<td colspan="2">
																				<div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
																			</td>
																			<td>
																				<div class="action-icon">
																					<a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
																				</div>
																			</td>
																		</tr>
																		<tr class="booked-slot-row">
																			<td>
																				<div class="checkbox">
																					<label class="calendar-des">
																						<div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:30
																					</label>
																				</div>
																			</td>
																			<td colspan="2">
																				<div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
																			</td>
																			<td>
																				<div class="action-icon">
																					<a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
																				</div>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<div class="checkbox">
																					<label class="calendar-des">
																						<div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:40
																					</label>
																				</div>
																			</td>
																			<td colspan="2">
																				<div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
																			</td>
																			<td>
																				<div class="action-icon">
																					<a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
																				</div>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<div class="checkbox">
																					<label class="calendar-des">
																						<div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:50
																					</label>
																				</div>
																			</td>
																			<td colspan="2">
																				<div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
																			</td>
																			<td>
																				<div class="action-icon">
																					<a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
																				</div>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<div class="checkbox">
																					<label class="calendar-des">
																						<div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:00
																					</label>
																				</div>
																			</td>
																			<td colspan="2">
																				<div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
																			</td>
																			<td>
																				<div class="action-icon">
																					<a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
																				</div>
																			</td>
																		</tr>
																		<tr class="booked-slot-row">
																			<td>
																				<div class="checkbox">
																					<label class="calendar-des">
																						<div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:10
																					</label>
																				</div>
																			</td>
																			<td colspan="2">
																				<div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
																			</td>
																			<td>
																				<div class="action-icon">
																					<a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
																				</div>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<div class="checkbox">
																					<label class="calendar-des">
																						<div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:20
																					</label>
																				</div>
																			</td>
																			<td colspan="2">
																				<div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
																			</td>
																			<td>
																				<div class="action-icon">
																					<a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
																				</div>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<div class="checkbox">
																					<label class="calendar-des">
																						<div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:30
																					</label>
																				</div>
																			</td>
																			<td colspan="2">
																				<div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
																			</td>
																			<td>
																				<div class="action-icon">
																					<a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
																				</div>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<div class="checkbox">
																					<label class="calendar-des">
																						<div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:40
																					</label>
																				</div>
																			</td>
																			<td colspan="2">
																				<div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
																			</td>
																			<td>
																				<div class="action-icon">
																					<a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
																				</div>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<div class="checkbox">
																					<label class="calendar-des">
																						<div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:50
																					</label>
																				</div>
																			</td>
																			<td colspan="2">
																				<div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
																			</td>
																			<td>
																				<div class="action-icon">
																					<a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
																				</div>
																			</td>
																		</tr>
																		<tr class="booked-slot-row">
																			<td>
																				<div class="checkbox">
																					<label class="calendar-des">
																						<div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 10:00
																					</label>
																				</div>
																			</td>
																			<td colspan="2">
																				<div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
																			</td>
																			<td>
																				<div class="action-icon">
																					<a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
																					<a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
																				</div>
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</td>
													</tr>
												</tbody>
											</table>-->
										</div>
                                            <!--<div role="tabpanel" class="tab-pane" id="summary2">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Dr. James Smith</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Date: 20/12/17, Time: 8am-9pm</th>
                                                        </tr>
                                                        <tr>
                                                            <th>123, Streen name, City, State name - 12345</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="4">
                                                                <div class="scrollit">
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr class="booked-slot-row">
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:00
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:10
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:20
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="booked-slot-row">
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:30
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:40
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:50
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:30
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:40
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:50
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="booked-slot-row">
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 10:00
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="summary3">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Dr. David Corner</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Date: 20/12/17, Time: 8am-9pm</th>
                                                        </tr>
                                                        <tr>
                                                            <th>123, Streen name, City, State name - 12345</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="4">
                                                                <div class="scrollit">
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr class="booked-slot-row">
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:00
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:10
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:20
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="booked-slot-row">
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:30
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:40
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:50
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="booked-slot-row">
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:10
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:20
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="booked-slot-row">
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:30
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:40
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="booked-slot-row">
                                                                                <td>
                                                                                    <div class="checkbox">
                                                                                        <label>
                                                                                            <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 10:00
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td colspan="2">
                                                                                    <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="action-icon">
                                                                                        <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                                        <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>-->
                                        </div>
                                </div>
								
                                <!--<div class="x_panel" id="create-slot-form" style="display: none;">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#create-slots" role="tab" data-toggle="tab">Block Slots</a></li>
                                        <li role="presentation"><a href="#block-slots" role="tab" data-toggle="tab">Create Slots</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="create-slots">
                                            <h3>Create Slots</h3>
                                            <div class="create-slots-contain">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <select class="form-control">
                                                            <option>Choose option</option>
                                                            <option>Option one</option>
                                                            <option>Option two</option>
                                                            <option>Option three</option>
                                                            <option>Option four</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Appointment</label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <select class="form-control">
                                                            <option>Choose option</option>
                                                            <option>Option one</option>
                                                            <option>Option two</option>
                                                            <option>Option three</option>
                                                            <option>Option four</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Services</label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <select class="form-control">
                                                            <option>Choose option</option>
                                                            <option>Option one</option>
                                                            <option>Option two</option>
                                                            <option>Option three</option>
                                                            <option>Option four</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Consultant</label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Venue</label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                        <div class="xdisplay_inputx form-group has-feedback">
                                                            <input type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="mm/dd/yyyy" aria-describedby="inputSuccess2Status3">
                                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                            <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Time &amp; Slots</label>
                                                    <div class="col-md-3 col-sm-9 col-xs-12">
                                                        <input type="text" class="form-control" placeholder="start">
                                                    </div>
                                                    <div class="col-md-3 col-sm-9 col-xs-12">
                                                        <input type="text" class="form-control" placeholder="End">
                                                    </div>
                                                    <div class="col-md-3 col-sm-9 col-xs-12">
                                                        <input type="text" class="form-control" placeholder="Nos">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-xs-12 col-sm-4">
                                                        <div class="iradio_flat-green" style="position: relative;"><input type="radio" class="flat" name="booking1" id="booked1" value="Booked" required="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Repeat
                                                    </div>
                                                    <div class="col-xs-12 col-sm-8">
                                                        <input type="text" class="form-control" placeholder="Title">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-xs-12 col-sm-3">
                                                        <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" name="booking1" id="booked1" value="Break" required="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Break
                                                    </div>
                                                    <div class="col-md-9 col-sm-9 col-xs-8">
                                                        <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                                            <span>January 4, 2018 - February 2, 2018</span> <b class="caret"></b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                                                        <button type="submit" class="btn btn-danger">Block</button>
                                                        <button type="submit" class="btn btn-success">Search</button>
                                                        <button type="submit" class="btn btn-info" style="margin-right:0;">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane active" id="block-slots">
                                            <h3>Block Slots</h3>
                                            <div class="create-slots-contain">

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
    <!-- Summary -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-4" id="right-panel">
                        <!--<div class="x_panel" data-spy="affix" data-offset-top="20">-->
                        <div class="x_panel" id="appointment-list">
                            <div class="tab-content">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <a href="#" class="btn btn-success"><i class="fa fa-check-square-o"></i> Create slots</a>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                                        <a href="#" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i> Edit slots</a>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane active" id="">
								
								
                                    <!--<table class="table">
                                        <thead>
                                            <tr>
                                                <th>Dr. John Doe</th>
                                            </tr>
                                            <tr>
                                                <th>12/03/17</th>
                                                <th>08:00am - 21:00pm</th>
                                            </tr>
                                            <tr>
                                                <th>General clinic center</th>
                                                <th>City Name, London</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="scrollit">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr class="booked-slot-row">
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label class="">
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:00
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label class="">
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:10
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:20
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="booked-slot-row">
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:30
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:40
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:50
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:00
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="booked-slot-row">
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:10
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:20
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:30
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:40
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:50
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="booked-slot-row">
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 10:00
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>-->
									
									
                                </div>
                               <!-- <div role="tabpanel" class="tab-pane" id="summary2">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Dr. James Smith</th>
                                            </tr>
                                            <tr>
                                                <th>Date: 20/12/17, Time: 8am-9pm</th>
                                            </tr>
                                            <tr>
                                                <th>123, Streen name, City, State name - 12345</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="scrollit">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr class="booked-slot-row">
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:00
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:10
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:20
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="booked-slot-row">
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:30
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:40
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:50
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:30
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:40
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:50
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="booked-slot-row">
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 10:00
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="summary3">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Dr. David Corner</th>
                                            </tr>
                                            <tr>
                                                <th>Date: 20/12/17, Time: 8am-9pm</th>
                                            </tr>
                                            <tr>
                                                <th>123, Streen name, City, State name - 12345</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="4">
                                                    <div class="scrollit">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr class="booked-slot-row">
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:00
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:10
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:20
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="booked-slot-row">
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:30
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:40
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 8:50
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="booked-slot-row">
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:10
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:20
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="booked-slot-row">
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:30
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 9:40
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="booked-slot-row">
                                                                    <td>
                                                                        <div class="checkbox">
                                                                            <label>
                                                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 10:00
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <div class="table-name">Mr.James Smith (DOB)<br>(ID - 123456)</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="action-icon">
                                                                            <a href="#"><i class="fa fa-calendar-times-o" data-toggle="tooltip" data-title="Cancel appointment" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>-->
                            </div>
                        </div>
						
						
                        <!--<div class="x_panel" id="create-slot-form" style="display: none;">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#create-slots" role="tab" data-toggle="tab">Block Slots</a></li>
                                <li role="presentation"><a href="#block-slots" role="tab" data-toggle="tab">Create Slots</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="create-slots">
                                    <h3>Create Slots</h3>
                                    <div class="create-slots-contain">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <select class="form-control">
                                                    <option>Choose option</option>
                                                    <option>Option one</option>
                                                    <option>Option two</option>
                                                    <option>Option three</option>
                                                    <option>Option four</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Appointment</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <select class="form-control">
                                                    <option>Choose option</option>
                                                    <option>Option one</option>
                                                    <option>Option two</option>
                                                    <option>Option three</option>
                                                    <option>Option four</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Services</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <select class="form-control">
                                                    <option>Choose option</option>
                                                    <option>Option one</option>
                                                    <option>Option two</option>
                                                    <option>Option three</option>
                                                    <option>Option four</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Consultant</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Venue</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <div class="xdisplay_inputx form-group has-feedback">
                                                    <input type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="mm/dd/yyyy" aria-describedby="inputSuccess2Status3">
                                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                    <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Time &amp; Slots</label>
                                            <div class="col-md-3 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" placeholder="start">
                                            </div>
                                            <div class="col-md-3 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" placeholder="End">
                                            </div>
                                            <div class="col-md-3 col-sm-9 col-xs-12">
                                                <input type="text" class="form-control" placeholder="Nos">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-4">
                                                <div class="iradio_flat-green" style="position: relative;"><input type="radio" class="flat" name="booking1" id="booked1" value="Booked" required="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Repeat
                                            </div>
                                            <div class="col-xs-12 col-sm-8">
                                                <input type="text" class="form-control" placeholder="Title">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-3">
                                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" name="booking1" id="booked1" value="Break" required="" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Break
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-8">
                                                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                                    <span>December 4, 2017 - January 2, 2018</span> <b class="caret"></b>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                                                <button type="submit" class="btn btn-danger">Block</button>
                                                <button type="submit" class="btn btn-success">Search</button>
                                                <button type="submit" class="btn btn-info" style="margin-right:0;">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane active" id="block-slots">
                                    <h3>Block Slots</h3>
                                    <div class="create-slots-contain">

                                    </div>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- calendar modal -->
    <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h2 class="modal-title" id="myModalLabel"><i class="fa fa-calendar" aria-hidden="true"></i> Create Slots</h2>
					<h2 class="modal-title" id="myModalCopy" style="display:none;"><i class="fa fa-calendar" aria-hidden="true"></i> Duplicate / Edit Session  </h2>
				 </div>
                <div class="modal-body">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <button type="button" class="btn btn-primary" id="createSlot_btn" >Create Slot</button><span id="response_msg" style="color: green;"></span>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 text-right">
                        <button type="button" class="btn btn-warning" id="createEvent_btn">Event Text</button>
                    </div>
					<form id="slot_data" class="form-horizontal calender" role="form">
						<input type="hidden" id="SlotEdit" name="data[SlotEdit]" value="" />
						<input type="hidden" id="slot_summary_details_0" name="data[SlotSummary]" value="" />
						<div class="col-sm-12 col-md-12 col-xs-12" style="padding:10px 5px;" id="edit_radio_session">
							<div class="col-md-4 col-sm-12 col-xs-12">
								<input type='radio' name='data[SlotData]' value ='new'> Duplicate Session
							</div>
							<div class="col-md-4 col-sm-12 col-xs-12">
								<input type='radio' name='data[SlotData]' value = 'edit'> Edit Session	
							</div>
						</div>
						<div id="create-slots-form" style="padding: 5px;">
                            <div class="">
                                <div class="col-sm-12 col-md-6 col-xs-12 padding-null">
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12">Select Date</label>
                                        <div class="col-md-12 col-sm-10 col-xs-10">
                                            <input id="datepicker" type="text" name="data[CreateDate]" class="form-control" placeholder="Select Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-xs-12 padding-null">
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12">Professional Type</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
										<?php
											$attr	= array('class'=>'form-control','id'=>'professional_type');
											echo form_dropdown('data[ProfessionalType]',$professional_type,'',$attr);
										?>
                                        </div>
                                    </div>
                                </div>
                                <div id="dvPassport" style="display: none" class="col-sm-12 col-md-12 col-xs-12 padding-null">
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12">Choose specialist</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <select id="txtPassportNumber" class="form-control">
                                                <option>All</option>
                                                <option>Active</option>
                                                <option>Inactive</option>
                                                <option>Deceased</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
								<div class="col-sm-12 col-md-6 col-xs-12 padding-null">
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12">Consulting Location</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
										<?php
											$attr	= array('class'=>'form-control','id'=>'consulting_location');
											echo form_dropdown('data[ConsultingLocation]',$consulting_location,'',$attr);
										?>
										</div>
                                    </div>
                                </div>
								<div id="content">
                                <div class="col-sm-12 col-md-6 col-xs-12 padding-null">
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12">Consulting Room</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <select class="form-control" id="consulting_room" name="data[ConsultingRoom]">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-xs-12 padding-null">
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12">Select Clinicians</label>
                                        <div class="col-md-12 col-sm-10 col-xs-10">
                                            <select class="form-control" id="clinician_list"name="data[Clinician]">
                                               <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-xs-12 padding-null">
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12">Services (optional)</label>
                                        <div class="col-md-12 col-sm-10 col-xs-10">
                                            <select class="form-control" id="service_avails" name="data[Services]">
                                                <option value=''>Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-xs-12 padding-null">
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12">Assistance (optional)</label>
                                        <div class="col-md-12 col-sm-10 col-xs-10"  id="asst_div">
                                            <select class='multiselect-ui form-control multiservicelist' id="asst_clinician_list" name="data[AsstClinician][]" multiple>
											</select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-xs-12 padding-null">
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12">Appoinment Type</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
											<?php
												$attr	= array('class'=>'form-control','id'=>'appointment_type');
												echo form_dropdown('data[AppointmentType]',$appointment_type,'',$attr);
											?>
										</div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-xs-12 padding-null">
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12">Title (optional)</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" class="form-control" placeholder="Title" name="data[Title]">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-xs-12 padding-null">
									<div class="col-sm-12 col-md-12 col-xs-12 ">
										<label class="col-md-12 col-sm-12 col-xs-12">Sessions</label>
									</div>
									<div class="col-sm-12 col-md-12 col-xs-12 padding-null">
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="col-md-2 col-sm-12 col-xs-12  padding-null">
														<input type="checkbox" value="All" name="data[Session][]" id="all_chk" onchange="duration_visibility(this,'all')"> All
													</div >
													<div class="col-md-10 col-sm-12 col-xs-12 padding-null" id="all_session_div" style="display:none;" >
														<div class="col-md-3 col-sm-12 col-xs-12 ">
															<label class="col-md-12 col-sm-12 col-xs-12 padding-null">Start Time</label>
															 <input type="time" class="form-control" id="all_start_time" name="data[AllStartTime]" onchange="start_time_change('all',this);" />
														</div>
														<div class="col-md-3 col-sm-12 col-xs-12 ">
															<label class="col-md-12 col-sm-12 col-xs-12 padding-null">End Time</label>
															 <input type="time" class="form-control" id="all_end_time" name="data[AllEndTime]" onchange="end_time_change('all',this);" />
														</div>
														<div  class="col-md-3 col-sm-12 col-xs-12 ">
															<label class="col-md-12 col-sm-12 col-xs-12 padding-null">Length</label>
															<?php
																$length_opt= array(''=>'Select',5=>5,10=>10,15=>15,20=>20,25=>25,30=>30,35=>35,40=>40,45=>45,50=>50,55=>55,60=>60);
																$attr	= array('class'=>'form-control','id'=>'all_slot_length','onchange'=>"slot_duration('all',this);");
																echo form_dropdown('data[AllLength]',$length_opt,'',$attr);
															?>
														</div>
														<div class="col-md-3 col-sm-12 col-xs-12 ">
															<label class="col-md-12 col-sm-12 col-xs-12 padding-null">No of Slots</label>
															<input type="text" class="form-control" placeholder="Nos" id="all_no_of_slots" name="data[AllNumSlot]" onkeyup = "change_slot_len('all',this);" onkeypress="return restrict_keys(event)">
														</div>
													</div>
												</div>
												
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="col-md-2 col-sm-12 col-xs-12  padding-null">
														<input type="checkbox" value="Morning" name="data[Session][]" id="morn_chk" onchange="duration_visibility(this,'morning')"> Morning
													</div>
													<div  class="col-md-10 col-sm-12 col-xs-12 padding-null" id="morn_session_div" style="display:none;">
														<div class="col-md-3 col-sm-12 col-xs-12">
															<label class="col-md-12 col-sm-12 col-xs-12 padding-null ">Start Time</label>
															 <input type="time" class="form-control" id="morn_start_time" name="data[MornStartTime]" onchange="start_time_change('morn',this);" />
														</div>
														<div class="col-md-3 col-sm-12 col-xs-12">
															<label class="col-md-12 col-sm-12 col-xs-12 padding-null ">End Time</label>
															 <input type="time" class="form-control" id="morn_end_time" name="data[MornEndTime]" onchange="end_time_change('morn',this);" />
														</div>
														<div  class="col-md-3 col-sm-12 col-xs-12">
															<label class="col-md-12 col-sm-12 col-xs-12 padding-null ">Length</label>
															<?php
																$length_opt= array(''=>'Select',5=>5,10=>10,15=>15,20=>20,25=>25,30=>30,35=>35,40=>40,45=>45,50=>50,55=>55,60=>60);
																$attr	= array('class'=>'form-control','id'=>'morn_slot_length','onchange'=>"slot_duration('morn',this)");
																echo form_dropdown('data[MornLength]',$length_opt,'',$attr);
															?>
														</div>
														<div class="col-md-3 col-sm-12 col-xs-12">
															<label class="col-md-12 col-sm-12 col-xs-12 padding-null ">No of Slots</label>
															<input type="text" class="form-control" placeholder="Nos" id="morn_no_of_slots" name="data[MornNumSlot]" onkeyup = "change_slot_len('morn',this);"  onkeypress="return restrict_keys(event)">
														</div>
													</div>
													
											    </div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="col-md-2 col-sm-12 col-xs-12  padding-null">
														<input type="checkbox" value="Afternoon" name="data[Session][]" id="aftr_chk" onchange="duration_visibility(this,'afternoon')"> Afternoon
													</div>
													<div  class="col-md-10 col-sm-12 col-xs-12 padding-null" id="aftr_session_div" style="display:none;">
														<div class="col-md-3 col-sm-12 col-xs-12">
															<label class="col-md-12 col-sm-12 col-xs-12 padding-null">Start Time</label>
															 <input type="time" class="form-control" id="aftr_start_time" name="data[AftrStartTime]" onchange="start_time_change('aftr',this);" />
														</div>
														<div class="col-md-3 col-sm-12 col-xs-12">
															<label class="col-md-12 col-sm-12 col-xs-12 padding-null">End Time</label>
															 <input type="time" class="form-control" id="aftr_end_time" name="data[AftrEndTime]" onchange="end_time_change('aftr',this);" />
														</div>
														<div  class="col-md-3 col-sm-12 col-xs-12">
															<label class="col-md-12 col-sm-12 col-xs-12 padding-null">Length</label>
															<?php
																$length_opt= array(''=>'Select',5=>5,10=>10,15=>15,20=>20,25=>25,30=>30,35=>35,40=>40,45=>45,50=>50,55=>55,60=>60);
																$attr	= array('class'=>'form-control','id'=>'aftr_slot_length','onchange'=>"slot_duration('aftr',this);");
																echo form_dropdown('data[AftrLength]',$length_opt,'',$attr);
															?>
														</div>
														<div class="col-md-3 col-sm-12 col-xs-12">
															<label class="col-md-12 col-sm-12 col-xs-12 padding-null">No of Slots</label>
															<input type="text" class="form-control" placeholder="Nos" id="aftr_no_of_slots" name="data[AftrNumSlot]" onkeyup = "change_slot_len('aftr',this);" onkeypress="return restrict_keys(event)">
														</div>
													</div>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
												
													<div class="col-md-2 col-sm-12 col-xs-12  padding-null">
														<input type="checkbox" value="Evening" name="data[Session][]" id="eve_chk" onchange="duration_visibility(this,'evening')"> Evening
													</div>
													<div  class="col-md-10 col-sm-12 col-xs-12 padding-null"  id="eve_session_div" style="display:none;">
														<div class="col-md-3 col-sm-12 col-xs-12 ">
															<label class="col-md-12 col-sm-12 col-xs-12 padding-null">Start Time</label>
															 <input type="time" class="form-control" id="eve_start_time" name="data[EveStartTime]"  onchange="start_time_change('eve',this);" />
														</div>
														<div class="col-md-3 col-sm-12 col-xs-12">
															<label class="col-md-12 col-sm-12 col-xs-12 padding-null">End Time</label>
															 <input type="time" class="form-control" id="eve_end_time" name="data[EveEndTime]" onchange="end_time_change('eve',this);" />
														</div>
														<div  class="col-md-3 col-sm-12 col-xs-12">
															<label class="col-md-12 col-sm-12 col-xs-12 padding-null">Length</label>
															<?php
																$length_opt= array(''=>'Select',5=>5,10=>10,15=>15,20=>20,25=>25,30=>30,35=>35,40=>40,45=>45,50=>50,55=>55,60=>60);
																$attr	= array('class'=>'form-control','id'=>'eve_slot_length','onchange'=>"slot_duration('eve',this);");
																echo form_dropdown('data[EveLength]',$length_opt,'',$attr);
															?>
														</div>
														<div class="col-md-3 col-sm-12 col-xs-12">
															<label class="col-md-12 col-sm-12 col-xs-12 padding-null">No of Slots</label>
															<input type="text" class="form-control" placeholder="Nos" id="eve_no_of_slots" name="data[EveNumSlot]" onkeyup = "change_slot_len('eve',this);" onkeypress="return restrict_keys(event)">
														</div>
													</div>
												</div>
											</div>
                                        </div>
                                    </div>
                                    <!--<div class="col-sm-12 col-md-6 col-xs-12 padding-null">
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Start Time</label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input type="time" class="form-control" id="start_time" name="data[StartTime]" />
											</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-xs-12 padding-null">
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">End Time</label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input type="time" class="form-control" id="end_time" name="data[EndTime]" />
											</div>
                                        </div>
                                    </div>-->
                                </div>
                                <!--<div class="col-sm-12 col-md-12 col-xs-12 padding-null">
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <label class="col-md-12 col-sm-12 col-xs-12 padding-null">Length in Min ( 5 min )</label>
											<?php
											/*	$length_opt= array(''=>'Select',5=>5,10=>10,15=>15,20=>20,25=>25,30=>30,35=>35,40=>40,45=>45,50=>50,55=>55,60=>60);
												$attr	= array('class'=>'form-control','id'=>'slot_length');
												echo form_dropdown('data[Length]',$length_opt,'',$attr);
											*/
											?>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <label class="col-md-12 col-sm-12 col-xs-12 padding-null">Number of Slots created</label>
                                            <input type="text" class="form-control" placeholder="Nos" id="no_of_slots" name="data[NumSlot]" onkeypress="return restrict_keys(event)">
                                        </div>
                                    </div>
                                </div>-->
                                <div class="col-sm-12 col-md-12 col-xs-12 padding-null" id="break_time" style="display:none;">
                                    <div class="form-group">
                                        <label class="col-md-12 col-sm-12 col-xs-12">Break (optional)</label>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
											<input type="time" class="form-control" id="break_start_time" name="data[BreakStart]" />
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                           <input type="time" class="form-control" id="break_end_time" name="data[BreakEnd]" />
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <input type="text" class="form-control" placeholder="minutes" name="data[BreakDuration]" id="break_min" onkeypress="return restrict_keys(event)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="chkRepeat" name="data[Repeat]">
                                            <label class="form-check-label"> Repeat</label>
                                        </div>
                                    </div>
                                    <!-- Repeat div section -->
                                    <div id="dvRepeat" style="display: none">
                                        <div class="col-sm-12 col-md-6 col-xs-12 padding-null">
                                            <div class="form-group">
                                                <label class="col-md-12 col-sm-12 col-xs-12 padding-null">Repeat</label>
                                                <div class="col-md-12 col-sm-10 col-xs-10 padding-null">
													<?php
														$attr	= array('class'=>'form-control','id'=>'repeat_type');
														echo form_dropdown('data[RepeatType]',$repeat_type,'',$attr);
													?>
											    </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xs-12 padding-null" id="repeat_every_div" style="display:none">
                                            <div class="form-group">
                                                <label class="col-md-12 col-sm-12 col-xs-12 ">Repeat Every</label>
                                                <div class="col-md-6 col-sm-10 col-xs-10">
												<?php
													$repeat_opt= array(''=>'Select',1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12,13=>13,14=>14,15=>15,16=>16,17=>17,18=>18,19=>19,20=>20,21=>21,22=>22,23=>23,24=>24);
													$attr	= array('class'=>'form-control','id'=>'repeat_every');
													echo form_dropdown('data[RepeatEvery]',$repeat_opt,'',$attr);
												?>
                                                </div>
                                                <div class="col-md-6 col-sm-10 col-xs-10" >
                                                    <select class="form-control" name="data[RepeatTypeDuration]" id="duration_type">
                                                        <option value="days">Days</option>
                                                        <option value="weeks">Weeks</option>
                                                        <option value="months">Months</option>
                                                        <option value="years">Years</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xs-12 " id="start_on_div" style="display:none">
                                            <div class="form-group">
                                                <label class="col-md-12 col-sm-12 col-xs-12 ">Starts on</label>
                                                <div class="col-md-10 col-sm-12 col-xs-12 ">
                                                    <input type="text" class="form-control" placeholder="Start Date" id="repeat_start_date" name="data[RepeatStartDate]">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xs-12 padding-null" id="end_on_div" style="display:none">
                                            <div class="form-group">
                                                <label class="col-md-12 col-sm-12 col-xs-12 padding-null">Ends on</label>
                                               <div class="col-md-10 col-sm-12 col-xs-12 padding-null">
													<input type="text" class="form-control" placeholder="End Date" id="repeat_end_date" name="data[RepeatEndDate]">
                                                </div>
											</div>
                                        </div> 
										<div class="col-sm-12 col-md-12 col-xs-12 padding-null" id="selected_date_div" style="display:none">
                                            <div class="form-group">
												<input type="hidden" id="hidden_date_count" value ="0" />
                                                <div class="col-md-6 col-sm-12 col-xs-12 padding-null" id="selected_date">
													<div class="col-md-8 col-sm-12 col-xs-12 padding-null">
														<input type="text" class="form-control" placeholder="Select Date" style="margin:5px 0px;" id="SelectedDate_0" name="data[SelectedDate][0]" onchange="validate_date(this);">
													</div>
													<div class="col-md-4 col-sm-12 col-xs-12" style="padding:10px">
														<span id="add_new_date"><i class="fa fa-plus-square" aria-hidden="true"></i></span>
													</div>
												</div>
												 
											</div>
                                        </div> 
										</div>
                                    </div>
                                </div>
                            </div>
						</div>
					
						<div id="create-event-form" style="padding: 5px;display:none;">
							<!--<form id="antoform" class="form-horizontal calender" role="form">-->
								<div class="">
									<div class="col-sm-12 col-md-6 col-xs-12 padding-null">
										<div class="form-group">
											<label class="col-md-12 col-sm-12 col-xs-12">Select Date</label>
											<div class="col-md-12 col-sm-10 col-xs-10">
												<input id="datepicker1" type="text" class="form-control" placeholder="Select Date">
											</div>
										</div>
									</div>

									<div class="col-sm-12 col-md-6 col-xs-12 padding-null">
										<div class="form-group">
											<label class="col-md-12 col-sm-12 col-xs-12">Create Event</label>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<input type="text" class="form-control" placeholder="Create Event">
											</div>
										</div>
									</div>

									<div class="col-sm-12 col-md-12 col-xs-12 padding-null">
										<div class="col-sm-12 col-md-6 col-xs-12 padding-null">
											<div class="form-group">
												<label class="col-md-12 col-sm-12 col-xs-12">Start Time</label>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<input type="time" class="form-control" />
												</div>
											</div>
										</div>
										<div class="col-sm-12 col-md-6 col-xs-12 padding-null">
											<div class="form-group">
												<label class="col-md-12 col-sm-12 col-xs-12">End Time</label>
												<div class="col-md-12 col-sm-12 col-xs-12">
													 <input type="time" class="form-control" />
												</div>
											</div>
										</div>
									</div>
								</div>
							<!--</form>-->
						</div>
					</form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary antosubmit" id="save_slot">Save</button>
				</div>
            </div>
        </div>
    </div>
    <input type="hidden" id="cal_tog" value="0" />
    <div id="fc_create" data-toggle="modal" ></div>
    <div id="fc_edit" data-toggle="modal" ></div>
   
	<script src="<?php echo base_url(); ?>assets/vendors/iCheck/icheck.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/custom.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/menu-js.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendors/fullcalendar/dist/fullcalendar.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/drop-down.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
	    jQuery(document).ready(function ($) {
			$('.multiselect-ui').multiselect({
				includeSelectAllOption: false,
				buttonClass: 'btn btn-default asst'
			});
            $("#patient-result").hide();
			$(".hide-panel").on("click", function () {
                $("#patient-result").hide();
            });
        });
        // Repeat hide show js //
		
        $(function () {
            $("#chkRepeat").click(function () {
                if ($(this).is(":checked")) {
                    $("#dvRepeat").show();
                } else {
                    $("#dvRepeat").hide();
                }
            });
        });

        // Appoiment Summary hide show js //
        $("#summary-content-detail").hide();
        $(document).ready(function () {
            $(".fc-event-container").click(function () {
                $("#summary-content-detail").show();
            });
        });
		
		
		$(function () {
			var search_key ='intial';
			init_calendar(search_key);
		});
	
        $(document).ready(function () {
            $("#datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
				dateFormat: "dd/mm/yy",
				yearRange: "-0:+50"
            });
            $("#datepicker1").datepicker({
                changeMonth: true,
                changeYear: true
            });
            $("#datepicker3").datepicker({
                changeMonth: true,
                changeYear: true
            });
			
			$("#repeat_start_date").datepicker({
                changeMonth: true,
				dateFormat: "dd/mm/yy",
                changeYear: true
            });
            $("#repeat_end_date").datepicker({
                changeMonth: true,
				dateFormat: "dd/mm/yy",
                changeYear: true
            });
			$('#SelectedDate_0').datepicker({
				changeMonth: true,
				dateFormat: "dd/mm/yy",
				changeYear: true
			});
        });

        $(document).ready(function () {
            $("#createEvent_btn").click(function () {
                $("#create-event-form").show();
                $("#create-slots-form").hide();
            });
            $("#createSlot_btn").click(function () {
                $("#create-event-form").hide();
                $("#create-slots-form").show();
            });
        });

        // specialist textbox //

        $(function () {
            $("#cal_professional_type").change(function () {
                if ($(this).val() == "Y") {
                    $("#dvPassport").show();
                } else {
                    $("#dvPassport").hide();
                }
            });
        });

        $(function () {
            $("#cal_date").change(function () {
                if ($(this).val() == "dates") {
                    $("#div-date-text").show();
                } else {
                    $("#div-date-text").hide();
                }
            });
        });
		

		$("#patient-search-btn").click(function(){
			var url							= "<?php echo base_url() ?>diary/patient_search";
			var search_cat					= $("#search_cat").val();
			var search_val					= $("#search_val").val();
			var search_status				= $("#search_status").val();
			$.post(url,{search_cat:search_cat,search_val:search_val,search_status:search_status},function(data){
				if(data.response.trim()	=='success'){
					if(data.response_data){
						var  text			= '';
						var	 i				= 1;
						$.each(data.response_data, function (key, val) {
							if(val.middlename){
								name		= val.title+' '+val.firstname +' '+val.middlename+' '+val.lastname;
							}else{
								name		= val.title+' '+val.firstname+' '+val.lastname;
							}
							var dateAr 		= val.dob.split('-');
							var newDate 	= dateAr[1] + '/' + dateAr[2] + '/' + dateAr[0];
							var nhs_no		= '';
							if(val.nhs_no){
								nhs_no	= val.nhs_no;
							} 
							var bk_color	= '';
							if(val.status == 'inactive'){
								bk_color	='background-color:#ff0000';
							}
							text		   +='<tr><td><span>'+i+'</span></td><td><span><a href="<?php echo base_url()?>patient_setup/patients_summary/'+val.key+'">'+name+'</a></span><span> DOB : '+newDate+'</span><span>'+nhs_no+'</span></td><td><span>'+val.address+'</span><span>'+val.city_town+', '+val.state+'-'+val.postcode+'</span><span class="patient-ct"><i class="fa fa-mobile-phone"></i>'+val.mobile+'</span><span class="patient-ct"><i class="fa fa-envelope"></i>'+val.primary_email+'<i class="fa fa-check-circle" data-toggle="tooltip" data-title="Primary email" data-original-title="" title=""></i></span></td><td></td><td><span class="patient-status" data-toggle="tooltip" data-title="Active" data-original-title="" title="" style="'+bk_color+'"><i class="fa fa-check-square"></i></span><span class="patient-status blue" data-toggle="tooltip" data-title="Info" data-original-title="" title=""><a href="#patient-info-modal" data-toggle="modal"><i class="fa fa-info-circle"></i></a></span> </td><td> <div class="checkbox"> <label> <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div></label> </div></td><td> <span class="patient-action" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""><a href="#patient-edit-modal" data-toggle="modal"><i class="fa fa-pencil-square"></i></a></span> <span class="patient-action"><a href="#" data-toggle="tooltip" data-title="Book Appointment" data-original-title="" title=""><i class="fa fa-calendar-plus-o"></i></a></span> </td></tr>';
							i++;
						});
						$("#patient_list").html(text);
					}else{
						$("#patient_list").html('<tr><td colspan="7">No records found...</td></tr>');
					}
					$("#patient-result").show();
				}else if(data.response.trim() == 'empty'){
					$("#patient_list").html('<tr><td colspan="7">No records found...</td></tr>');
					$("#patient-result").show();
				}else{
					alert('Please after sometime..');
				}
			},'json');
		});
		
		$(function(){
			$("#datepicker").change(function(){
				var picked_Date			= $(this).val();
			 	var d					= new Date();
				var month 				= d.getMonth()+1;
				var day 				= d.getDate();
				var output 				= (day<10 ? '0' : '') + day+ '/' +
										  (month<10 ? '0' : '') + month + '/' +
										   d.getFullYear() ;
			    if ( picked_Date < output ) {
					alert('Date Cannot be less than today..');	
					$(this).val('');					
				}
			});
		 
			$("#consulting_location").change(function(){
				var val_location							= $(this).val();
				var val_date								= $("#datepicker").val();
				if(val_location !='' && val_date !=''){
					var  url								= "<?php echo base_url() ?>diary/list_consulting_room";
					$.post(url,{val_location:val_location,val_date:val_date},function(data){
						
						var options							= '<option value="">Select</option>';
						if(data.response.trim() == 'success'){
							if(data.location_on.trim() == 'closed' || data.location_on.trim() =='off'){
								alert('Consulting Location is not available on that day..');
							}else{
								var edt						= $("#edit_slot_row").val();
								var slot_details			= $("#"+edt).val();
								var obj 					= $.parseJSON(slot_details);
								var consulting_room			= obj.consulting_room;
								$.each(data.response_data, function (key, val) {
									if(consulting_room !='' && consulting_room == key){
										options				+= '<option value="'+key+'" selected>'+val+'</option>';
									}else{
										options				+= '<option value="'+key+'">'+val+'</option>';
									}
								});
							}
							$('#consulting_room').html(options);
							if(consulting_room !=''){
								$('#consulting_room').trigger('change');
							}
						}else if(data.response.trim() == 'empty'){
							if(data.location_on.trim() == 'closed' || data.location_on.trim() =='off'){
								alert('Consulting Location is not available on that day..');
							}
							$('#consulting_room').html('<option value="">Select</option>');
						}else{
							alert('Please try after sometime..');
						}
					},'json');
				}
			});
			
			$("#consulting_room").change(function(){
				var val_room						= $(this).val();
				if(val_room != ''){
					var  url							= "<?php echo base_url() ?>diary/clinician_list";
					var  loc							= $("#consulting_location").val();
					if(loc !=''){
						$.post(url,{val_room:val_room,loc:loc},function(data){
							if(data.response.trim() == 'success'){
								var options					= '<option value="">Select</option>';	
								var asst_options			= '';
								var edt						= $("#edit_slot_row").val();
								var slot_details			= $("#"+edt).val();
								//var slot_details			= $("#slot_summary_details").val();
								var obj 					= $.parseJSON(slot_details);
								var clinician_id			= obj.clinician_id;
								var assistants				= obj.assistants;
								var asst_Arr				= [];
								if( assistants !=''){
									asst_Arr				= assistants.split(',');
								}
								$.each(data.response_data, function (key, val) {
									if(clinician_id !='' && clinician_id == key){
										options					+= '<option value="'+key+'" selected>'+val+'</option>';
									}else{
										options					+= '<option value="'+key+'">'+val+'</option>';
									}
									if(assistants !='' && $.inArray(key, asst_Arr)!='-1' ){ 
										asst_options			+= '<option value="'+key+'" selected>'+val+'</option>';
									}else{
										asst_options			+= '<option value="'+key+'">'+val+'</option>';
									}
								});
								$('#clinician_list').html(options); 
								$('#asst_clinician_list').html(asst_options); 
								$('#asst_clinician_list').multiselect('rebuild');
								if(clinician_id !=''){
									$('#clinician_list').trigger('change');
								}
							}else if(data.response.trim() == 'empty'){
								$('#asst_clinician_list').html('');
								$('#asst_clinician_list').multiselect('rebuild');
							}else{
								alert('Please try after sometime..');
							}
						},'json');
					}else{
						alert('Please choose the consulting location..');
						$("#consulting_room").val('');
					}
				}
			});
		
			$("#clinician_list").change(function(){
		 		var cl										= $(this).val();
				if(cl != ''){
					var cons_loc							= $("#consulting_location").val();
					var asst_list							= $("#asst_clinician_list").html();
					$('#asst_clinician_list').html(asst_list); 
					$('#asst_clinician_list').multiselect('rebuild');
					$('#asst_clinician_list option').attr("disabled", false);
					$('#asst_div input').attr('disabled',false);
					$('#asst_clinician_list option[value="'+cl+'"]').attr("disabled", true);
					$('#asst_div input[value="'+cl+'"]').attr('disabled',true);
					$('#asst_div').parent('label').parent('a').parent('li').addClass('disabled');
					var edt									= $("#edit_slot_row").val();
					var slot_details						= $("#"+edt).val();
					//var slot_details						= $("#slot_summary_details").val();
					var obj 								= $.parseJSON(slot_details);
					var service_id							= obj.service_id;
					var url									= "<?php echo base_url() ?>diary/clinician_services";
					$.post(url,{cl:cl,cons_loc:cons_loc},function(data){
						if(data.response.trim()=='success'){
							var options						= '<option value="">Select</option>';
							$.each(data.response_data, function (key, val) {
								if(service_id == val.id){
									options				   += '<option value="'+val.id+'" selected>'+val.service_name+'</option>';
								}else{
									options				   += '<option value="'+val.id+'">'+val.service_name+'</option>';
								}
							});
							$("#service_avails").html(options);
						}else if(data.response.trim()=='empty'){
						}else{
							alert('Please try after sometime...');
						}
					},'json');
				}else{
					var options						= '<option value="">Select</option>';
					$("#service_avails").html(options);
					$('#asst_clinician_list').html(options); 
				}
			});
			
			$("#asst_clinician_list").change(function(){
				var cl										= $(this).val();
				$('#clinician_list option').attr("disabled", false);
				if(cl != ''){
					$('#clinician_list option[value="'+cl+'"]').attr("disabled", true);
				}
			});
			
			$("#doctor_location").autocomplete({
				source: "<?php echo base_url() ?>diary/location_details",
				minLength:1,
				select: function( event, ui ) {
					$("#venue_id").val('');
					$(this).val(ui.item.label);
					clinician_list(ui.item.value);
					$("#venue_id").val(ui.item.value);
					return false;
				},
			});
			
			$("#doctor_location").keyup(function(){
				var txt = $(this).val();
				if(txt.trim() == ''){
					$("#venue_id").val('');
					$("#clinician").html('<option value="">Select</option>');
				}
			});
			
			$("#break_end_time").change(function(){
				var break_start_time									= $("#break_start_time").val();
				var break_end_time										= $(this).val();
				if(break_end_time !=''){
					if(break_start_time == ''){
						alert('Please select break start time first.. ');
					}else if(break_end_time < break_start_time){
						alert('Break end time cannot be less than Break start time');
					}else{
						var startTime 									= new Date('1970/01/01 '+break_start_time); 
						var endTime 									= new Date('1970/01/01 '+break_end_time);
						var difference 									= endTime.getTime() - startTime.getTime(); // This will give difference in milliseconds
						var resultInMinutes 							= Math.round(difference / 60000);
						$("#break_min").val(resultInMinutes);
					}
				}
			});
			
			$("#break_min").keyup(function(){
				var break_start_time									= $("#break_start_time").val();
				var min													= $(this).val();
				if(break_start_time ==''){
					alert('Please select break start time first..');
					$(this).val('');
				}else{
					$("#break_end_time").val(moment.utc(break_start_time,'hh:mm').add(min,'minutes').format('hh:mm'));
				}
			});
			
			$("#repeat_type").change(function(){
				if($("#repeat_type").val() =='1'){
					$("#start_on_div").hide();
					$("#end_on_div").hide();
					$('#repeat_every_div').hide();
					$("#selected_date_div").hide();
				}else if($("#repeat_type").val() =='2'){
					$("#start_on_div").hide();
					$("#end_on_div").show();
					$('#repeat_every_div').hide();
					$("#duration_type option[value='days']").removeAttr('disabled');
					$("#duration_type option[value='months']").removeAttr('disabled');
					$("#duration_type option[value='years']").removeAttr('disabled');
					$("#selected_date_div").hide();
				}else if($("#repeat_type").val() =='3' || $("#repeat_type").val() =='4' ||$("#repeat_type").val() =='5'){
					$("#start_on_div").hide();
					$("#end_on_div").hide();
					$('#repeat_every_div').show();
					$("#duration_type option[value='days']").attr('disabled','disabled');
					$("#duration_type option[value='months']").attr('disabled','disabled');
					$("#duration_type option[value='years']").attr('disabled','disabled');
					$('#duration_type').val('weeks');
					$("#selected_date_div").hide();
				}else if($("#repeat_type").val() == '6'){
					$("#start_on_div").hide();
					$("#end_on_div").hide();
					$('#repeat_every_div').show();
					$("#duration_type option[value='days']").attr('disabled','disabled');
					$("#duration_type option[value='months']").attr('disabled','disabled');
					$("#duration_type option[value='years']").attr('disabled','disabled');
					$('#duration_type').val('weeks');
					$("#selected_date_div").hide();
				}else if($("#repeat_type").val() == '7'){
					$("#start_on_div").hide();
					$("#end_on_div").hide();
					$('#repeat_every_div').show();
					$("#duration_type option[value='days']").attr('disabled','disabled');
					$("#duration_type option[value='weeks']").attr('disabled','disabled');
					$("#duration_type option[value='years']").attr('disabled','disabled');
					$('#duration_type').val('months');
					$("#selected_date_div").hide();
				}else if($("#repeat_type").val() == '8'){
					$("#start_on_div").hide();
					$("#end_on_div").hide();
					$('#repeat_every_div').show();
					$("#duration_type option[value='days']").attr('disabled','disabled');
					$("#duration_type option[value='months']").attr('disabled','disabled');
					$("#duration_type option[value='weeks']").attr('disabled','disabled');
					$('#duration_type').val('years');
					$("#selected_date_div").hide();
				}else if($("#repeat_type").val() == '9'){
					$("#selected_date_div").show();
					$("#start_on_div").hide();
					$("#end_on_div").hide();
					$('#repeat_every_div').hide();
				}else if($("#repeat_type").val() == '10'){
					$("#start_on_div").show();
					$("#end_on_div").show();
					$('#repeat_every_div').hide();
					$("#selected_date_div").hide();
				}
			});
			
			$("#repeat_start_date").change(function(){
				var start_date											= $(this).val();
				if(start_date !=''){
					var cur_date										= moment().format("DD/MM/YYYY");
					if($.datepicker.parseDate('dd/mm/yy',cur_date) > $.datepicker.parseDate('dd/mm/yy',start_date)){
						alert('End date cannot be less than start day..');
						$(this).val('');
					}
				}
			});
			
			$("#repeat_end_date").change(function(){
				var start_date											= $("#repeat_start_date").val();
				var end_date											= $(this).val();
				var cur_date											= moment().format("DD/MM/YYYY");
				if(start_date !=''){
					if($.datepicker.parseDate('dd/mm/yy',start_date) >= $.datepicker.parseDate('dd/mm/yy',end_date)){
						alert('End date cannot be less than start day..');
						$(this).val('');
					}
				}else if($.datepicker.parseDate('dd/mm/yy',cur_date) >= $.datepicker.parseDate('dd/mm/yy',end_date)){
					alert('End date cannot be less than current day..');
					$(this).val('');
				}
			});
			
			$("input[name='data[Session]']").change(function(){
				$("#break_start_time").val('');
				$("#break_end_time").val('');
				$("#break_min").val('');
			});
			
			$("#add_new_date").click(function(){
				var cnt_val												= $("#hidden_date_count").val();
				cnt_val													= parseInt(cnt_val) + 1;
				$("#selected_date").append('<div class="col-md-8 col-sm-12 col-xs-12 padding-null" id="input_div_'+cnt_val+'"><input type="text" class="form-control" placeholder="Select Date" onchange="validate_date(this);" style="margin:5px 0px;" id="SelectedDate_'+cnt_val+'" name="data[SelectedDate]['+cnt_val+']"></div><div class="col-md-4 col-sm-12 col-xs-12" style="padding:10px" id="btn_div_'+cnt_val+'"><span onclick="remove_dates('+cnt_val+')"><i class="fa fa-minus" aria-hidden="true"></i></span></div>');
				$('#SelectedDate_'+cnt_val).datepicker({
					changeMonth: true,
					dateFormat: "dd/mm/yy",
					changeYear: true
				});
				$("#hidden_date_count").val(cnt_val);
			});
			
			$("#save_slot").click(function(){
				var slot_data											= $("#slot_data").serialize();
				var url													= "<?php echo base_url() ?>diary/slot_creation";
				if($("#datepicker").val().trim() == ''){
					$("#datepicker").focus();
					$("#datepicker").css('border','1px solid #ff1a1c');
					return false;
				}else if($("#professional_type").val() == ''){
					$("#professional_type").focus();
					$("#professional_type").css('border','1px solid #ff1a1c');
					return false;
				}else if($("#consulting_location").val() == ''){
					$("#consulting_location").focus();
					$("#consulting_location").css('border','1px solid #ff1a1c');
					return false;
				}else if($("#consulting_room").val() == ''){
					$("#consulting_room").focus();
					$("#consulting_room").css('border','1px solid #ff1a1c');
					return false;
				}else if($("#clinician_list").val() == ''){
					$("#clinician_list").focus();
					$("#clinician_list").css('border','1px solid #ff1a1c');
					return false;
				}else if($("#appointment_type").val() == ''){
					$("#appointment_type").focus();
					$("#appointment_type").css('border','1px solid #ff1a1c');
					return false;
				}else{
					if($("#all_chk").prop('checked')){
						if($("input[name='data[AllStartTime]']").val() ==''){
							$("input[name='data[AllStartTime]']").focus();
							$("input[name='data[AllStartTime]']").css('border','1px solid #ff1a1c');
							return false;
						}else if($("input[name='data[AllEndTime]']").val() ==''){
							$("input[name='data[AllEndTime]']").focus();
							$("input[name='data[AllEndTime]']").css('border','1px solid #ff1a1c');
							return false;
						}else if($("input[name='data[AllLength]']").val() ==''){
							$("input[name='data[AllLength]']").focus();
							$("input[name='data[AllLength]']").css('border','1px solid #ff1a1c');
							return false;
						}else if($("input[name='data[AllNumSlot]']").val() ==''){
							$("input[name='data[AllNumSlot]']").focus();
							$("input[name='data[AllNumSlot]']").css('border','1px solid #ff1a1c');
							return false;
						}
					}else {
						checked 				= $("input[name='data[Session][]']:checked").length;
						if(!checked) {
							alert("You must check at least one Session.");
							return false;
						}
					
						if($("#morn_chk").prop('checked')){
							if($("input[name='data[MornStartTime]']").val() ==''){
								$("input[name='data[MornStartTime]']").focus();
								$("input[name='data[MornStartTime]']").css('border','1px solid #ff1a1c');
								return false;
							}else if($("input[name='data[MornEndTime]']").val() ==''){
								$("input[name='data[MornEndTime]']").focus();
								$("input[name='data[MornEndTime]']").css('border','1px solid #ff1a1c');
								return false;
							}else if($("input[name='data[MornLength]']").val() ==''){
								$("input[name='data[MornLength]']").focus();
								$("input[name='data[MornLength]']").css('border','1px solid #ff1a1c');
								return false;
							}else if($("input[name='data[MornNumSlot]'").val() ==''){
								$("input[name='data[MornNumSlot]']").focus();
								$("input[name='data[MornNumSlot]']").css('border','1px solid #ff1a1c');
								return false;
							}
						}
						if($("#aftr_chk").prop('checked')){
							if($("input[name='data[AftrStartTime]']").val() ==''){
								$("input[name='data[AftrStartTime]']").focus();
								$("input[name='data[AftrStartTime]']").css('border','1px solid #ff1a1c');
								return false;
							}else if($("input[name='data[AftrEndTime]']").val() ==''){
								$("input[name='data[AftrEndTime]']").focus();
								$("input[name='data[AftrEndTime]']").css('border','1px solid #ff1a1c');
								return false;
							}else if($("input[name='data[AftrLength]']").val() ==''){
								$("input[name='data[AftrLength]']").focus();
								$("input[name='data[AftrLength]']").css('border','1px solid #ff1a1c');
								return false;
							}else if($("input[name='data[AftrNumSlot]']").val() ==''){
								$("input[name='data[AftrNumSlot]']").focus();
								$("input[name='data[AftrNumSlot]']").css('border','1px solid #ff1a1c');
								return false;
							}
						}
						if($("#eve_chk").prop('checked')){
							if($("input[name='data[EveStartTime]']").val() ==''){
								$("input[name='data[EveStartTime]']").focus();
								$("input[name='data[EveStartTime]']").css('border','1px solid #ff1a1c');
								return false;
							}else if($("input[name='data[EveEndTime]']").val() ==''){
								$("input[name='data[EveEndTime]']").focus();
								$("input[name='data[EveEndTime]']").css('border','1px solid #ff1a1c');
								return false;
							}else if($("input[name='data[EveLength]']").val() ==''){
								$("input[name='data[EveLength]']").focus();
								$("input[name='data[EveLength]']").css('border','1px solid #ff1a1c');
								return false;
							}else if($("input[name='data[EveNumSlot]']").val() ==''){
								$("input[name='data[EveNumSlot]']").focus();
								$("input[name='data[EveNumSlot]']").css('border','1px solid #ff1a1c');
								return false;
							}
						}
					}
					if($('#break_start_time').val() !=''){
						if($('#break_end_time').val() == ''){
							$("#break_end_time").focus();
							$("#break_end_time").css('border','1px solid #ff1a1c');
							return false;
						}else if($('#break_min').val() == ''){
							$("#break_min").focus();
							$("#break_min").css('border','1px solid #ff1a1c');
							return false;
						}
					}else if($('#break_end_time').val() !=''){
						if($('#break_start_time').val() == ''){
							$("#break_start_time").focus();
							$("#break_start_time").css('border','1px solid #ff1a1c');
							return false;
						}else if($('#break_min').val() == ''){
							$("#break_min").focus();
							$("#break_min").css('border','1px solid #ff1a1c');
							return false;
						}
					}
					
					if($("#chkRepeat").prop('checked')){
						if($("#repeat_type").val() =='2' || $("#repeat_type").val() == '6' || $("#repeat_type").val() == '7' || $("#repeat_type").val() == '8'){
							if($("#repeat_end_date").val() == ''){
								$("#repeat_end_date").focus();
								$("#repeat_end_date").css('border','1px solid #ff1a1c');
								return false;
							}
						}else if($("#repeat_type").val() =='3' || $("#repeat_type").val() =='4' ||$("#repeat_type").val() =='5'){
							if($("#repeat_every").val() == ''){
								$("#repeat_every").focus();
								$("#repeat_every").css('border','1px solid #ff1a1c');
								return false;
							}
						}else if($("#repeat_type").val() == '9'){
							if($('#hidden_date_count').val() != 0){
								var length				= $('#hidden_date_count').val();
								for(var i=0 ;i<=length ;i++){
									if($("#SelectedDate_"+i).length > 0 && $("#SelectedDate_"+i).val().trim() ==''){
										$("#SelectedDate_"+i).focus();
										$("#SelectedDate_"+i).css('border','1px solid #ff1a1c');
										return false;
									} 
								}
							}else{
								if($("#SelectedDate_0").val().trim() ==''){
									$("#SelectedDate_0").focus();
									$("#SelectedDate_0").css('border','1px solid #ff1a1c');
									return false;
								}
							}
						}else if($("#repeat_type").val() == '10'){
							if($("#repeat_start_date").val() == ''){
								$("#repeat_start_date").focus();
								$("#repeat_start_date").css('border','1px solid #ff1a1c');
								return false;
							}else if($("#repeat_end_date").val() == ''){
								$("#repeat_end_date").focus();
								$("#repeat_end_date").css('border','1px solid #ff1a1c');
								return false;
							}
						}
					}
					
					$.ajax({
						url: url,
						type: 'POST',
						dataType: "json",
						data: slot_data,
						success: function(data){
							if(data.response =='success'){
								if( !$.isEmptyObject(data.error)){
									var err_msg				 = 'Date & time : \n';
									$.each(data.error, function (key, val) {
										err_msg				+= val.date_err+' '+val.timing+' \n';
									});
									alert('Slot cannot be created for following : \n'+err_msg+'Since already created..');
								}else{
									$("#response_msg").html('Slot created successfully...');
								} 
								document.getElementById('slot_data').reset();
								$("#consulting_room").html('<option>Select</option>');
								$("#clinician_list").html('<option>Select</option>');
								$("#service_avails").html('<option>Select</option>');
								$('#asst_clinician_list').html('');
								$('#asst_clinician_list').multiselect('rebuild');
								$('#all_session_div').hide();
								$('#morn_session_div').hide();
								$('#aftr_session_div').hide();
								$('#eve_session_div').hide();
								$("#slot_data input").css('border','1px solid #ccc;');
								$("#slot_data select").css('border','1px solid #ccc;');
								$('#CalenderModalNew').animate({scrollTop: "0px"}, 200);
							}else{
								alert('Please try after sometimes..');
								document.getElementById('slot_data').reset();
								$('#morn_session_div').hide();
								$('#aftr_session_div').hide();
								$('#eve_session_div').hide();
								$('#asst_clinician_list').html('');
								$('#asst_clinician_list').multiselect('rebuild');
							}
						}
					});
				}
			});
			
			$("#clinician_search").click(function(){
				var search_arr											= new Object();
				if($("#doctor_location").val().trim() == ''){
					search_arr['venue_id']								= '';
				}else{
					search_arr['venue_id']								= $("#venue_id").val();
				}
				search_arr['type']										= $("#type").val();
				search_arr['services']									= $("#services").val();
				search_arr['clinician']									= $("#clinician").val();
				var url				 									= "<?php echo base_url() ?>diary/slot_details";
				$.post(url,{search_key:search_arr},function(data){
					details												= data.response_data;
					$('#calendar').fullCalendar('removeEvents');
					$('#calendar').fullCalendar('addEventSource', details);         
					$('#calendar').fullCalendar('rerenderEvents');
				},'json');
			});
			
			$("#block_slot_link").click(function(){
				if($('.slot_i:checkbox:checked').length >0){
					var slotArr											= [];
					$('.slot_i:checkbox:checked').each(function(){
						slotArr.push($(this).val());
					});
					var slot_i_key										= confirm('Are you sure do you want to block the slots ?');
					if(slot_i_key == true){
						var url											= "<?php echo base_url() ?>diary/block_slots";
						$.post(url,{Arr:slotArr},function(data){
							if(data.response.trim() == 'success'){
								for(var i= 0; i < slotArr.length; i++){
									$("#slot_row_"+slotArr[i]).css('background-color','#ffddae');
									$("#slot_i_key_"+slotArr[i]).prop('checked',false);
								}
							}else{
								alert('Please try after sometime..');
							}
						},'json');
					}
				}else{
					alert('Please select atleast on slot..');
				}
			});
			
			$("#deleted_slot_link").click(function(){
				if($('.slot_i:checkbox:checked').length >0){
					var slotArr											= [];
					$('.slot_i:checkbox:checked').each(function(){
						slotArr.push($(this).val());
					});
					var slot_i_key										= confirm('Are you sure do you want to delete the slots ?');
					if(slot_i_key == true){
						var url											= "<?php echo base_url() ?>diary/delete_slots";
						$.post(url,{Arr:slotArr},function(data){
							if(data.response.trim() == 'success'){
								for(var i= 0; i < slotArr.length; i++){
									$("#slot_row_"+slotArr[i]).remove();
								}
							}else{
								alert('Please try after sometime..');
							}
						},'json');
					}
				}else{
					alert('Please select atleast on slot..');
				}
			});
			$("#merge_slot_link").click(function(){
				var slotArr												= [];
				$('.slot_i:checkbox:checked').each(function(){
					slotArr.push($(this).val());
				});
				if(slotArr.len >2){
					
				}else{
					alert('Please choose more than one slot...');
				}
			});
			$("#duplicate_slot_link").click(function(){
				if($('.slot_i:checkbox:checked').length >0){
					var slotArr											= [];
					$('.slot_i:checkbox:checked').each(function(){
						slotArr.push($(this).val());
					});
					var slot_i_key										= confirm('Are you sure do you want to Duplicate the slots ?');
					if(slot_i_key == true){
						var url											= "<?php echo base_url() ?>diary/duplicate_slot";
						$.post(url,{Arr:slotArr},function(data){
							if(data.response.trim() == 'success'){
								htmlTxt								= '';
								for(var i= 0; i < data.response_data.length; i++){
									var val								= data.response_data[i];
									htmlTxt							   += '<tr id="slot_row_'+val.slot_i_key+'" style="background-color:#fff267"><td><div><input type="checkbox" value="87" onchange="show_link(this);" class="slot_i" id="slot_i_key_'+val.slot_i_key+'">&nbsp;'+val.start_time+' ('+val.slot_creation_type+')</div></td><td colspan="2"> <div class="table-name"> </div></td><td> <div class="action-icon"><a href="#"><i class="fa fa-bell" aria-hidden="true" data-toggle="tooltip" data-title="Alerts"></i></a> <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a> <a href="javascript:void(0);" onclick="fill_edit_slot('+val.slot_i_key+')"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a> <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a> <a href="javascript:void(0);" onclick="delete_slot('+val.slot_i_key+');"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a> </div></td></tr>';
								}
								$('#slot_list').append(htmlTxt);
							}else{
								alert('Please try after sometime..');
							}
						},'json');
					}
				}else{
					alert('Please select atleast on slot..');
				}
			});

			
		});
		
		function expand_cal(a) {
			var url				= "<?php echo base_url() ?>diary/summary_details";
			$.post(url,{a:a},function(data){
				if(data.response.trim() == 'success'){
					var list				 		= '';
					var slt_ttl						= '';
					var asst_name					= '';
					$.each(data.response_data, function (key, val) {
						var slt_ttl					= '';
						var asst_name				= '';
						var service_list			= '';
						
						if(val.service_name !=''){
							service_list			= '<div class="col-xs-12 col-sm-7 col-md-7"><h5>Services : '+ val.service_name+'</h5></div>';
						}
						
						if(val.slot_title !=''){
							slt_ttl					= '<div class="col-xs-12 col-sm-5 col-md-5"><h5> Slot title : '+ val.slot_title+'</h5></div>';
						}	
						if(val.assistant_name !=''){
							asst_name				= '<div class="col-xs-12 col-sm-5 col-md-5"><h5> Assistants : '+ val.assistant_name+'</h5></div>';
						}
						
						var last_row				='<div class="row">'+service_list+slt_ttl+asst_name+'</div>';
												
						list					   += '<li class="summary-row col-xs-12 col-sm-12 col-md-10 active" role="presentation" style="font-size: 14px;" id="li_row_'+val.slot_key+'"><input type="hidden" id="edit_slot_row" value=""><input type="hidden" id="slot_summary_details_'+val.slot_key+'" value='+"'"+JSON.stringify(val)+"'"+'><div><div class="col-xs-2 col-sm-2 col-md-2"><img src="'+val.img_src+'" style="border-radius:15px;"/></div> <div class="col-xs-8 col-sm-9 col-md-9"> <div class="row"> <div class="col-xs-12 col-sm-7 col-md-7"><span style="font-weight: bold;">'+val.name+'</span><span style="font-size: 11px;"> ( '+val.professional_name+' )</span></div><div class="col-xs-12 col-sm-5 col-md-5"> '+val.slot_date+', '+val.start_time+' - '+val.end_time+'</div></div><div class="row booked-field"> <div class="col-xs-7 col-sm-7"><h5>'+val.venue_name+'</h5></div><div class="col-xs-5 col-sm-5"> <div class="booked-count"> Booked: <input type="text" readonly="" class="form-control" value ="'+val.booked+'"> </div><div class="free-count"> Free: <input type="text" readonly="" class="form-control" value="'+val.open+'" > </div><div class="blocked-count"> Blocked: <input type="text" readonly="" class="form-control" value="'+val.blocked+'"> </div></div></div><div class="row"> <div class="col-xs-12 col-sm-7 col-md-7"><h5>'+val.address+'</h5></div><div class="col-xs-12 col-sm-5 col-md-5 action-icon" style="text-align:left;font-size: 16px;margin-top:-6px;"> <a href="javascript:void(0);" onclick="create_new_slot('+"'slot_summary_details_"+val.slot_key+"'"+');" ><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""></i></a> <a href="javascript:void(0)"  onclick="delete_slot_bundle('+"'"+val.slot_key+"'"+');"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete" data-original-title="" title="Delete Slot"></i></a> <!--<a href="#"><i class="fa fa-print" data-toggle="tooltip" data-title="Print" data-original-title="" title=""></i></a> --></div></div>'+last_row+'</div><div data-target="#summary1" data-toggle="tab" class="col-xs-2 col-sm-2 col-md-2 summary-arrow" style="background-color: #26B99A" onclick="slot_details('+"'"+val.request_key+"'"+','+"'"+val.parent_key+"'"+')"> <i class="fa fa-chevron-right"></i> </div></div></li>';
					});
					$('#summary-contain').html(list);
					$('#calendar_view').attr('class', 'col-md-4 padding-one');
					$('#calendar').fullCalendar('option', 'height', 400);
					$("#calendar_v").show();
					$("#cal_tog").val('1');
					$(".appointment-list").hide();
					$(".summary-view").show();
					$("#menu_list").hide();
        
				}else{ 
					alert('Please try after sometime...');
				}
			},'json');
		}
		
		function slot_details(a,b){
			var url								= "<?php echo base_url() ?>diary/get_slot_details";
			var html_content					= '';
			$.post(url,{a:a,b:b},function(data){
				var slot_list		= '';			
				if(data.response.trim() == 'success'){
					$("#summary1").html('');
					$.each(data.response_data, function (key, val) {
						//slot_list  			   += '<tr><td><div class="checkbox"> <label class="calendar-des"> <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" id="slot_i_key_'+val.slot_i_key+'" class="flat agree" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> '+val.start_d+val.slot_type+'</label> </div></td><td colspan="2"> <div class="table-name"> </div></td><td> <div class="action-icon"><a href="#"><i class="fa fa-bell" aria-hidden="true" data-toggle="tooltip" data-title="Alerts"></i></a> <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a> <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a> <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a> <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a> </div></td></tr>';
						var slot_crt_type		= '';
						if(val.slot_creation_type == 'duplicate'){
							slot_crt_type		= '(duplicate)';
						}
						slot_list  			   += '<tr id="slot_row_'+val.slot_i_key+'" style="background-color:'+val.bg_color+'"><td><div><input type="checkbox" value="'+val.slot_i_key+'" onchange="show_link(this);" class="slot_i" id="slot_i_key_'+val.slot_i_key+'">&nbsp;'+val.start_d+val.slot_type+' '+slot_crt_type+'  </div></td><td colspan="2"> <div class="table-name"> </div></td><td> <div class="action-icon"><a href="#"><i class="fa fa-bell" aria-hidden="true" data-toggle="tooltip" data-title="Alerts"></i></a> <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a> <a href="javascript:void(0);" onclick="fill_edit_slot('+val.slot_i_key+')"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a> <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a> <a href="javascript:void(0);" onclick="delete_slot('+val.slot_i_key+');"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a> </div></td></tr>';
					});
					var slt_ttl					= '';
					var asst_name				= '';
					var service_list			= '';
					
					if(data.slot_details.slot_title !=''){
						slt_ttl					= '<div class="col-xs-12 col-sm-6 col-md-6"><h5> Slot title : '+ data.slot_details.slot_title+'</h5></div>';
					}	
					if(data.slot_details.assistant_name !=''){
						asst_name				= '<div class="col-xs-12 col-sm-6 col-md-6"><h5> Assistants : '+ data.slot_details.assistant_name+'</h5></div>';
					}
					if(data.slot_details.service_name !=''){
						service_list			= '<div class="col-xs-12 col-sm-6 col-md-6"><h5>Services : '+ data.slot_details.service_name+'</h5></div>';
					}
					
					var last_row				='<div class="row">'+service_list+slt_ttl+asst_name+'</div>';
					var txt						= '<thead><tr><td colspan="6" style="padding:0px;"><div class="summary-row col-xs-12 col-sm-12 col-md-12 active" role="presentation"> <div><div class="col-xs-2 col-sm-2 col-md-2"><img src="'+data.img_src+'" style="height: 100px;width: 100px;border-radius: 55px;"/></div><div class="col-xs-8 col-sm-9 col-md-9"> <div class="row"> <div class="col-xs-12 col-sm-6 col-md-6"><span style="font-weight: bold;">'+data.name+'</span><span style="font-size: 11px;"> ( '+data.professional_name+' )</span></div><div class="col-xs-12 col-sm-6 col-md-6"><h5>'+data.slot_date+', '+data.parent_duration+'</h5></div></div><div class="row booked-field"><div class="col-xs-6 col-sm-6"><h5>'+data.venue_name+'</h5></div><div class="col-xs-6 col-sm-6"><div class="booked-count"> Booked: <input type="text" readonly="" class="form-control" value="'+data.slot_details.booked+'"> </div><div class="free-count"> Free: <input type="text" readonly="" class="form-control" value="'+data.slot_details.open+'" > </div><div class="blocked-count"> Blocked: <input type="text" readonly="" class="form-control" value="'+data.slot_details.blocked+'" > </div></div></div><div class="row"> <div class="col-xs-12 col-sm-6 col-md-6"><h5>'+data.address+'</h5></div><div class="col-xs-12 col-sm-6 col-md-6"><select class="form-control" id="summary_app_change" onchange="change_data(this)" style="max-width:150px;"><option value="">Select</option><option value="<?php echo $this->config->item('Booked') ?>">Booked</option><option value="<?php echo $this->config->item('Blocked') ?>">Blocked</option><option value="<?php echo $this->config->item('Open') ?>">Open</option></select></div></div>'+last_row+'</div></div></div></td></tr></thead>';
					html_content				= '<table class="table">'+txt+'<tbody id="slot_list">'+slot_list+'</tbody></table>';
					//console.log(data.slot_details);
					$("#slot_summary_details_0").val(JSON.stringify(data.slot_details));
					$("#summary1").html(html_content);
				}else{
					alert('Please try after sometime...');
				}
			},'json');
			$(".appointment-list").show();
			$(".summary-view").hide();
			$('#calendar_view').attr('class', 'col-md-4 padding-one');
			$('#calendar_v').attr('class', 'col-md-8 padding-one');
		}

        function disclose_cal() {
            $('#calendar_view').attr('class', 'col-md-10 padding-one');
			$('#calendar').fullCalendar('option', 'height', 800);
            $("#calendar_v").hide();
            $("#cal_tog").val('0');
			$("#menu_list").show();
        }

		function close_view(){
			$("#calendar_v").hide();
			$('#calendar_view').attr('class', 'col-md-10 padding-one');
			$('#calendar').fullCalendar('option', 'height', 800);
			$("#menu_list").show();
		}
		
		function change_data(a){
			var status								= $(a).val();
			var slot_details						= $("#slot_summary_details_0").val();
			var obj 								= $.parseJSON(slot_details);
			var slot_key							= obj.slot_key;//$("#slot_key").val();
			var clinician							= obj.clinician_id;//$("#clinician_list_slot_id").val();
			var url									= "<?php echo base_url() ?>diary/change_slot_data";
			$.post(url,{slot_key:slot_key,status:status,clinician:clinician},function(data){
				var slot_list		= '';			
				if(data.response.trim() == 'success'){
					var i = 0;
					$.each(data.response_data, function (key, val) {
						slot_list  += '<tr style="background-color:'+val.bg_color+'"><td><div><input type="checkbox" value="'+val.slot_i_key+'" onchange="show_link(this);" class="slot_i" id="slot_i_key_'+val.slot_i_key+'">&nbsp;'+val.start_d+val.slot_type+' </div></td><td colspan="2"> <div class="table-name"> </div></td><td> <div class="action-icon"><a href="#"><i class="fa fa-bell" aria-hidden="true" data-toggle="tooltip" data-title="Alerts"></i></a> <a href="#"><i class="fa fa-calendar-plus-o" data-toggle="tooltip" data-title="Book appointment" data-original-title="" title=""></i></a> <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit Slot" data-original-title="" title=""></i></a> <a href="#"><i class="fa fa-info-circle" data-toggle="tooltip" data-title="Slot Info" data-original-title="" title=""></i></a> <a href="#"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete Slot" data-original-title="" title=""></i></a> </div></td></tr>';
						i++;
					});
					$("#no_of_slots").html(i);
					$("#slot_list").html(slot_list);
				}else if(data.response.trim() == 'empty'){
					slot_list		= '<tr><td colspan="6"> None found..</td></tr>';
					$("#slot_list").html(slot_list);
					$("#no_of_slots").html('0');
				}else{
					alert('Please try after sometime..');
				}
			},'json');
		}
		
		function remove_dates(a){
			$("#input_div_"+a).remove();
			$("#btn_div_"+a).remove();
		}
		
		function clinician_list(a){
			var  url								= "<?php echo base_url() ?>diary/clinicians";
			$.post(url,{a:a},function(data){
				if(data.response.trim() =='success'){
					var options						= '<option value="">Select</option>';	
					$.each(data.response_data, function (key, val) {
						options					   += '<option value="'+key+'">'+val.name+'</option>';
					});
					$("#clinician").html(options);
				}else if(data.response.trim() =='empty'){
					$("#clinician").html('<option value="">Select</option>');
				}else{
					$("#clinician").html('<option value="">Select</option>');
				} 
			},'json');
		}
		
		function restrict_keys(e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which > 31 ) {
				return false;
			}
		}
		
		function validate_date(a){
			if($(a).val().trim() !=''){
				var val								= $(a).val();
				var cur_date						= moment().format("DD/MM/YYYY");
				if($.datepicker.parseDate('dd/mm/yy',cur_date) >= $.datepicker.parseDate('dd/mm/yy',val)){
					alert('Date cannot be less than current day..');
					$(a).val('');
				}
			 	var length							= $('#hidden_date_count').val();
				for(var i=0 ;i<=length ;i++){
					if($("#SelectedDate_"+i).length > 0 && $("#SelectedDate_"+i).val().trim() !=''){
						if($(a).attr('id')	!= "SelectedDate_"+i){
							if(val  == $("#SelectedDate_"+i).val().trim()){
								alert('Selected date is already in the list..');
								$(a).val('');
							}
						}
					} 
				}
			}
		}
		
		function duration_visibility(a,b){
			if($(a).prop('checked') && b == 'all'){
				$("#morn_chk").prop('checked',false);
				$("#aftr_chk").prop('checked',false);
				$("#eve_chk").prop('checked',false);
				$("#all_session_div").show();
				$("#morn_session_div").hide();
				$("#aftr_session_div").hide();
				$("#eve_session_div").hide();
				$("#break_time").show();
				$('#morn_session_div').find('input').val(''); 
				$('#morn_session_div').find('select').val(''); 				 
				$('#aftr_session_div').find('input').val('');    
				$('#aftr_session_div').find('select').val(''); 				 
				$('#eve_session_div').find('input').val('');    
				$('#eve_session_div').find('select').val(''); 				 
			}else if($(a).prop('checked') && b == 'morning'){
				$('#all_session_div').find('input').val('');    
				$('#all_session_div').find('select').val(''); 
				$("#all_chk").prop('checked',false);
				$("#all_session_div").hide();
				$("#morn_session_div").show();
				$("#break_time").hide();
			}else if($(a).prop('checked') 	&& b == 'afternoon'){
				$('#all_session_div').find('input').val('');    
				$('#all_session_div').find('select').val(''); 
				$("#all_chk").prop('checked',false);
				$("#aftr_session_div").show();
				$("#break_time").hide();
			}else if($(a).prop('checked') && b == 'evening'){
				$('#all_session_div').find('input').val('');    
				$('#all_session_div').find('select').val(''); 
				$("#all_chk").prop('checked',false);
				$("#eve_session_div").show();
				$("#break_time").hide();
			}else if($(a).prop('checked') ==false && b == 'all'){
				$('#all_session_div').find('input').val('');    
				$('#all_session_div').find('select').val(''); 			
				$("#all_session_div").hide();
				$("#break_time").hide();
			}else if($(a).prop('checked')==false && b == 'morning'){
				$('#morn_session_div').find('input').val(''); 
				$('#morn_session_div').find('select').val(''); 				 
				$("#morn_session_div").hide();
			}else if($(a).prop('checked')==false && b == 'afternoon'){
				$('#aftr_session_div').find('input').val('');    
				$('#aftr_session_div').find('select').val(''); 
				$("#aftr_session_div").hide();
			}else if($(a).prop('checked')==false && b == 'evening'){
				$('#eve_session_div').find('input').val('');    
				$('#eve_session_div').find('select').val(''); 			
				$("#eve_session_div").hide();
			}
		}
		
		function change_slot_len(a,b){
			var no_of_slots												= $(b).val();
			if(a == 'all'){
				var start_time											= $("#all_start_time").val();
				var end_time											= $("#all_end_time").val();
				var slot_len											= $("#all_slot_length").val();
				var final_end											= 'all_end_time';
			}else if(a == 'morn'){
				var start_time											= $("#morn_start_time").val();
				var end_time											= $("#morn_end_time").val();
				var slot_len											= $("#morn_slot_length").val();
				var final_end											= 'morn_end_time';
			}else if(a == 'aftr'){
				var start_time											= $("#aftr_start_time").val();
				var end_time											= $("#aftr_end_time").val();
				var slot_len											= $("#aftr_slot_length").val();
				var final_end											= 'aftr_end_time';
			}else if(a == 'eve'){
				var start_time											= $("#eve_start_time").val();
				var end_time											= $("#eve_end_time").val();
				var slot_len											= $("#eve_slot_length").val();
				var final_end											= 'eve_end_time';
			}
			var minutes_cal												= '';
			if(no_of_slots != ''){
				if(start_time == ''){
					alert('Start time cannot be empty..');
					$(b).val('');
				}else if(slot_len ==''){
					alert('Slot length cannot be empty..');
					$(b).val('');
				}else {
					startTime	 										= new Date('1970/01/01 '+start_time); 
					minutes_cal											= slot_len * no_of_slots;
					$("#"+final_end).val(moment.utc(start_time,'hh:mm').add(minutes_cal,'minutes').format('hh:mm'));
				}
			}
		}
			
		function slot_duration(a,b){
			var slot_len												= $(b).val();
			if(a == 'all'){
				var start_time											= $("#all_start_time").val();
				var end_time											= $("#all_end_time").val();
				var no_of_slots											= $("#all_no_of_slots").val();
				var slots												= 'all_no_of_slots';
				var final_end											= 'all_end_time';
			}else if(a == 'morn'){
				var start_time											= $("#morn_start_time").val();
				var end_time											= $("#morn_end_time").val();
				var no_of_slots											= $("#morn_no_of_slots").val();
				var slots												= 'morn_no_of_slots';
				var final_end											= 'morn_end_time';
			}else if(a == 'aftr'){
				var start_time											= $("#aftr_start_time").val();
				var end_time											= $("#aftr_end_time").val();
				var no_of_slots											= $("#aftr_no_of_slots").val();
				var slots												= 'aftr_no_of_slots';
				var final_end											= 'aftr_end_time';
			}else if(a == 'eve'){
				var start_time											= $("#eve_start_time").val();
				var end_time											= $("#eve_end_time").val();
				var no_of_slots											= $("#eve_no_of_slots").val();
				var slots												= 'eve_no_of_slots';
				var final_end											= 'eve_end_time';
			}
			if(slot_len == ''){
				$("#"+slots).val('');
			}else{
				if(start_time == ''){
					alert('Start time cannot be empty..');
					$(this).val('');
					$("#"+slots).val('');
				}else if(start_time != '' && end_time !=''){
					var startTime 										= new Date('1970/01/01 '+start_time); 
					var endTime 										= new Date('1970/01/01 '+end_time);
					var difference 										= endTime.getTime() - startTime.getTime(); // This will give difference in milliseconds
					var resultInMinutes 								= Math.round(difference / 60000);
					no_of_slots											= resultInMinutes / slot_len;
					round_off											= parseInt(no_of_slots);
					minutes_cal											= round_off * slot_len;
					$("#"+final_end).val(moment.utc(start_time,'hh:mm').add(minutes_cal,'minutes').format('hh:mm'));
					$('#'+slots).val(round_off);
				}else if(start_time != '' && no_of_slots !=''){
					minutes_cal											= slot_len * no_of_slots;
					$("#"+final_end).val(moment.utc(start_time,'hh:mm').add(minutes_cal,'minutes').format('hh:mm'));
				}
			}
		}
		
		function start_time_change(a,b){
			if(a == 'all'){
			 	var end_time											= $("#all_end_time").val();
			 	var slots												= 'all_no_of_slots';
				var final_end											= 'all_end_time';
				var slot_length											= 'all_slot_length';
			}else if(a == 'morn'){
			 	var end_time											= $("#morn_end_time").val();
			 	var slots												= 'morn_no_of_slots';
				var final_end											= 'morn_end_time';
				var slot_length											= 'morn_slot_length';
			}else if(a == 'aftr'){
			 	var end_time											= $("#aftr_end_time").val();
			 	var slots												= 'aftr_no_of_slots';
				var final_end											= 'aftr_end_time';
				var slot_length											= 'aftr_slot_length';
			}else if(a == 'eve'){
			 	var end_time											= $("#eve_end_time").val();
			 	var slots												= 'eve_no_of_slots';
				var final_end											= 'eve_end_time';
				var slot_length											= 'eve_slot_length';
			}
			var start_time												= $(b).val();
			if(end_time != ''){
				if(end_time < start_time){
					alert('End time cannot be less than start time.');
					$("#"+final_end).val('');
				}
			}
			$("#"+slot_length).val('');
			$("#"+slots).val('');
		}
		
		function end_time_change(a,b){
			if(a == 'all'){
			 	var start_time											= $("#all_start_time").val();
			 	var slots												= 'all_no_of_slots';
				var slot_length											= 'all_slot_length';
			}else if(a == 'morn'){
			 	var start_time											= $("#morn_start_time").val();
			 	var slots												= 'morn_no_of_slots';
				var slot_length											= 'morn_slot_length';
			}else if(a == 'aftr'){
			 	var start_time											= $("#aftr_start_time").val();
			 	var slots												= 'aftr_no_of_slots';
				var slot_length											= 'aftr_slot_length';
			}else if(a == 'eve'){
			 	var start_time											= $("#eve_start_time").val();
			 	var slots												= 'eve_no_of_slots';
				var slot_length											= 'eve_slot_length';
			}
			var end_time												= $(b).val();
			if(end_time < start_time){
				alert('End time cannot be less than start time.');
				$(b).val('');
			}
			$("#"+slot_length).val('');
			$("#"+slots).val('');
		}
		
		
		function init_calendar(search_key) {
			if ("undefined" != typeof $.fn.fullCalendar) {
				var e, f, a 											= new Date,
				b 														= a.getDate(),
				c 														= a.getMonth(),
				d 														= a.getFullYear();
				var details;
				var url				 									= "<?php echo base_url() ?>diary/slot_details";
				$.post(url,{search_key:search_key},function(data){
					details												= data.response_data;
					$("#calendar").fullCalendar({
						//theme: true,
						eventLimit: true,
						header: {
							left: "prev,next today",
							center: "title",
							//right: "month,agendaWeek,agendaDay,weekdaysAgendaDay,weekendAgendaDay"
							right: "month,agendaWeek,agendaDay"
						},
						views: {
							month:{
								eventLimit: 2
							},
							agendaWeek:{
								eventLimit: 2
							},
							agendaDay:{
								eventLimit: 2
							}
							/*weekendAgendaDay: {
								type: 'agenda',
								duration: {
									days: 2
								},
								 firstDay: 6,
								hiddenDays: [ 1, 2, 3, 4, 5 ],
								buttonText: " Sat/Sun",
							},
							weekdaysAgendaDay: {
								type: 'agenda',
								duration: {
									days: 5
								},
								weekends:false,
								buttonText: "5 Days",
							}*/
						},
						editable: true,
						droppable: true,
						events: details,
						eventDrop: function(event, delta, revertFunc) {
							var post_date 									= moment(event.start._d).format('YYYY-MM-DD'); //new Date(event.start._d);
							var cur_date 									= moment(new Date()).format('YYYY-MM-DD'); //new Date(event.start._d);
							if(post_date < cur_date){
								revertFunc();
								alert('Slot cannot be ported less than today date..');
							}else{
								var conf										= confirm('Are you sure do you want move the slot?');
								if(conf == true){
									var url_slot								= "<?php echo base_url() ?>diary/check_slot_reversed";
									$.post(url_slot,{session_key:event.session_key},function(data){
										if(data.response.trim() == 'success'){
											var url_slot						= "<?php echo base_url() ?>diary/port_slot_session";
											var msg								= false;
											$.post(url_slot,{a:post_date,b:event.session_key},function(data){
												if(data.response.trim() =='success'){
													alert('Slot ported succesfully');
												}else{
													revertFunc();
													alert('Please try after sometime..'); 
												}
											},'json');
										}else if(data.response.trim() == 'booked'){
											revertFunc();
											alert('Booked slot cannot be moved..');
										}else{
											revertFunc();
											alert('Please try after sometime..');
										}
									},'json');
								}else{
									revertFunc();
								}
							}
						},
						dayClick: function(date, jsEvent, view) {
							var dat 									= moment(); //Get the current date
							cur_date									= dat.format("YYYY-MM-DD");  
							exist_date									= date.format("YYYY-MM-DD");
					 		if(new Date(cur_date)  <= new Date(exist_date) ){
								var  date_val							= exist_date.split('-');
								date_new								= date_val[2]+'/'+date_val[1]+'/'+date_val[0];
								//$("#slot_summary_details").val('');
								$('#SlotEdit').val('');
								document.getElementById('slot_data').reset();
								$('#createSlot_btn').show();
								$('#createEvent_btn').show();
								$('#edit_radio_session').hide();
								$('#myModalLabel').show();
								$('#myModalCopy').hide();
								$('#myModalEdit').hide();
								$('#break_time').hide();
								$('#all_session_div').hide();
								$('#morn_session_div').hide();
								$('#aftr_session_div').hide();
								$('#eve_session_div').hide();
								$('#morn_chk').prop('disabled',false);
								$('#aftr_chk').prop('disabled',false);
								$('#eve_chk').prop('disabled',false);
								$("#consulting_room").html('<option>Select</option>');
								$("#clinician_list").html('<option>Select</option>');
								$("#service_avails").html('<option>Select</option>');
								$("#asst_clinician_list").html('<option>Select</option>');
								$("#asst_clinician_list").multiselect('rebuild');
								$("#datepicker").val(date_new);
								disclose_cal();
								close_view();
								$("#CalenderModalNew").modal("show");
							}else{
								alert("Please Choose another date..");
							}
						}
					});
					$("#calendar").fullCalendar('rerenderEvents');
				},'json');
			}
		}
		
		function create_new_slot(a){
			var slot_details											= $("#"+a).val();
			var obj 													= $.parseJSON(slot_details);
			$('#edit_slot_row').val(a)
			$('#createSlot_btn').hide();
			$('#createEvent_btn').hide();
			$('#morn_session_div').hide();
			$('#aftr_session_div').hide();
			$('#eve_session_div').hide();
			$('#break_time').show();
			$('#myModalLabel').hide();
			$('#myModalCopy').show();
			$('#myModalEdit').hide();
			$('#edit_radio_session').show();
			if(obj.brk_end_time != null){
				$("#break_end_time").val(obj.brk_end_time);
			}
			if(obj.brk_start_time != null){
				$("#break_start_time").val(obj.brk_start_time);
			}
			if(obj.brk_minute != null){
				$("input[name='data[BreakDuration]']").val(obj.brk_minute);
			}
			$('#datepicker').val(obj.slot_date);
			$('#professional_type').val(obj.professional_type);
			$('#appointment_type').val(obj.slot_type_id);
			$("input[name='data[Title]']").val(obj.slot_title);
			$("input[name='data[AllStartTime]']").val(obj.start_time);
			$("input[name='data[AllEndTime]']").val(obj.end_time);
			$("#all_slot_length").val(obj.slot_length);
			$("input[name='data[AllNumSlot]']").val(obj.initial_slots);
			$('input:radio[name="data[SlotData]"]').filter('[value="new"]').attr('checked', true);
			$('#morn_chk').prop('disabled',true);
			$('#aftr_chk').prop('disabled',true);
			$('#eve_chk').prop('disabled',true);
			$("#all_chk").prop('checked',true);
			$('#all_session_div').show();
			$('#CalenderModalNew').modal("show");
			$('#SlotEdit').val('1');
			$('#consulting_location').val(obj.consulting_location).change();
		}
		
		function show_link(a){
			if($(a).prop('checked')== true){
				$("#block_slot_link").show();
				$("#deleted_slot_link").show();
				$("#merge_slot_link").show();
				$("#duplicate_slot_link").show();
			}
		}
		
		function delete_slot(a){
			$("#slot_i_key_"+a).prop('checked',true);
			$("#deleted_slot_link").click();
		}
		
		function fill_edit_slot(a){
			var slot_row		= '<td><input class="form-control" type="text" /></td><td><select class="form-control" id="slot_appointment_type"><option value="1">All</option><option value="2">Clinic</option><option value="3">Home Visit</option><option value="4">Telephone</option><option value="5">Video - Tel</option></select></td><td><textarea placeholder="Note" class="form-control"></textarea></td><td><a href="javascript:void(0);"class="btn btn-success" onclick="update_slot('+a+');" ><i class="fa fa-edit"></i> Update</a></td>';
			$("#slot_row_"+a).html(slot_row);
		}
		
		function delete_slot_bundle(a){
			var confrm															= confirm('Are you sure do you want delete the slot?');
			if(confrm){
				var url_slot													= "<?php echo base_url() ?>diary/delete_slot_bundle";
				$.post(url_slot,{a:a},function(data){
					if(data.response == 'success'){
						$('#li_row_'+a).remove();
						var search_arr											= new Object();
						if($("#doctor_location").val().trim() == ''){
							search_arr['venue_id']								= '';
						}else{
							search_arr['venue_id']								= $("#venue_id").val();
						}
						search_arr['type']										= $("#type").val();
						search_arr['services']									= $("#services").val();
						search_arr['clinician']									= $("#clinician").val();
						var url				 									= "<?php echo base_url() ?>diary/slot_details";
						$.post(url,{search_key:search_arr},function(data){
							details												= data.response_data;
							$('#calendar').fullCalendar('removeEvents');
							$('#calendar').fullCalendar('addEventSource', details);         
							$('#calendar').fullCalendar('rerenderEvents');
						},'json');
						close_view();
					}else{
						alert('Please try after sometime...');
					}
				},'json');
			
			} 
		}
		
		function update_slot(a){
			alert(a);
		}
		
	</script>



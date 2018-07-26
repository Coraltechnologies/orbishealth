            <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
            <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
            <style>
                .avg-profile-img {
                    width: 120px;
                    height: 120px;
                }
        
                .up-cho-btn {
                    display: none;
                }
                p.summary_view_text {
                    font-family: 'Open Sans', sans-serif;
                    font-weight: 400;
                    color: #666;
                    font-size: 14px;
                    line-height: 1.6em;
                }
                
                .panel-heading {
                    margin-top: 0;
                    margin-bottom: 0;
                    font-size: 16px;
                    color: inherit;
                    padding: 5px 15px;
                }
                .panel-default-two > .panel-heading-two {
                    color: #fff;
                    background-color: #146068;
                    border-color: #146068;
                }
                .switch {
                    position: relative;
                    display: block;
                    vertical-align: top;
                    width: 100px;
                    height: 30px;
                    padding: 3px;
                    margin: 0 10px 10px 0;
                    background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
                    background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
                    border-radius: 18px;
                    box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
                    cursor: pointer;
                    box-sizing: content-box;
                }
        
                .switch-input {
                    position: absolute;
                    top: 0;
                    left: 0;
                    opacity: 0;
                    box-sizing: content-box;
                }
        
                .switch-label {
                    position: relative;
                    display: block;
                    height: inherit;
                    font-size: 10px;
                    text-transform: uppercase;
                    background: #eceeef;
                    border-radius: inherit;
                    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
                    box-sizing: content-box;
                }
        
                    .switch-label:before, .switch-label:after {
                        position: absolute;
                        top: 50%;
                        margin-top: -.5em;
                        line-height: 1;
                        -webkit-transition: inherit;
                        -moz-transition: inherit;
                        -o-transition: inherit;
                        transition: inherit;
                        box-sizing: content-box;
                    }
        
                    .switch-label:before {
                        content: attr(data-off);
                        right: 11px;
                        color: #aaaaaa;
                        text-shadow: 0 1px rgba(255, 255, 255, 0.5);
                    }
        
                    .switch-label:after {
                        content: attr(data-on);
                        left: 11px;
                        color: #FFFFFF;
                        text-shadow: 0 1px rgba(0, 0, 0, 0.2);
                        opacity: 0;
                    }
        
                .switch-input:checked ~ .switch-label {
                    background: #349c41;
                    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
                }
        
                    .switch-input:checked ~ .switch-label:before {
                        opacity: 0;
                    }
        
                    .switch-input:checked ~ .switch-label:after {
                        opacity: 1;
                    }
        
                .switch-handle {
                    position: absolute;
                    top: 4px;
                    left: 4px;
                    width: 28px;
                    height: 28px;
                    background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
                    background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
                    border-radius: 100%;
                    box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
                }
        
                    .switch-handle:before {
                        content: "";
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        margin: -6px 0 0 -6px;
                        width: 12px;
                        height: 12px;
                        background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
                        background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
                        border-radius: 6px;
                        box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
                    }
        
                .switch-input:checked ~ .switch-handle {
                    left: 74px;
                    box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
                }
        
                /* Transition
        ========================== */
                .switch-label, .switch-handle {
                    transition: All 0.3s ease;
                    -webkit-transition: All 0.3s ease;
                    -moz-transition: All 0.3s ease;
                    -o-transition: All 0.3s ease;
                }
                .pro_reg_border {
                    border: 1px solid #ddd;
                    padding: 10px;
                    margin: 10px;
                }
            </style>
            <!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->
                <form class="form-horizontal form-label-left row custom_temp">

                    <div class="x_panel">
                        <div class="row" id="edit-section">
                            <div class="x_title">
                                <h2> Patients Summary</h2>
                                <ul class="nav navbar-right panel_toolbox">
									<li>
										<a href="javascript:void(0)"  id="alert_point" class="edit-btn btn-warning" style="background-color: #eea236;margin-right: 5px;" ><i class="fa fa-bell-o"></i> Alerts</a>
									</li>	
									<!--<li>
										<a href="<?php echo base_url(); ?>account_setup" class="edit-btn"><i class="fa fa-edit"></i> Edit</a>
									</li>-->
								 </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Personal Details </div>
                                            <div class="panel-body">
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="text-center">
														<?php
															if(!($patient_details['img_name']) && !($patient_details['img_path'])){
														?>	
															<img src="<?php echo base_url(); ?>assets/img/profile-image.png" class="avg-profile-img img-circle img-thumbnail" alt="Profile">
														<?php
															}else{
														?>
															<img src="<?php echo base_url().'assets/uploads/'.$patient_details['img_path'].$patient_details['img_name']; ?>" class="avg-profile-img img-circle img-thumbnail" alt="Profile">
														<?php } ?>
                                                        <!--<img id="blah" src="images/img.jpg" style="margin-top:10px;" class="avg-profile-img img-circle img-thumbnail" alt="avatar">-->
                                                    </div>

                                                </div>
                                                <div class="col-md-9 col-sm-12 col-xs-12" style="margin-top:20px;">
                                                    <div class="col-md-2 col-sm-12 col-xs-12">
                                                        <label>Title</label>
                                                        <div class="form-group">
                                                            <p class="summary_view_text"><?php if($patient_details['title']){ echo $patient_details['title']; }?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>First Name</label>
                                                            <p class="summary_view_text"><?php if($patient_details['firstname']){ echo $patient_details['firstname'];} ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Middle Name</label>
                                                            <p class="summary_view_text"><?php if($patient_details['middlename']){ echo $patient_details['middlename'];} ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Last Name</label>
                                                            <p class="summary_view_text"><?php if($patient_details['lastname']){ echo $patient_details['lastname'];} ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 col-xs-12">
                                                        <label>Gender</label>
                                                        <p class="summary_view_text"><?php if($patient_details['gender']){ echo $patient_details['gender'];} ?></p>
                                                    </div>

                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>NHS No</label>
                                                            <p class="summary_view_text"><?php if($patient_details['nhs_no']){ echo $patient_details['nhs_no'];} ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                        <div class="">
                                                            <div class="xdisplay_inputx form-group has-feedback">
                                                                <label>DOB</label>
                                                                <p class="summary_view_text"><?php if($patient_details['dob']){ echo date('d/m/Y',strtotime($patient_details['dob']));} ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Age</label>
                                                            <p class="summary_view_text">
																<?php
																	$dob			= $patient_details['dob'];
																	$diff 			= (date('Y') - date('Y',strtotime($dob)));
																	echo $diff.' Years';
																?>
															</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="panel panel-default">
                                            <div class="panel-heading">Address Details </div>
                                            <div class="panel-body">
                                                <div class="col-md-8 col-sm-12 col-xs-12">

                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Country</label>
                                                            <p class="summary_view_text">
																<?php
																	if($patient_details['country_id']){echo $country['name'][$patient_details['country_id']];}
																?>
															</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Postcode</label>
                                                            <p class="summary_view_text">
																<?php
																	if($patient_details['postcode']){echo $patient_details['postcode'];}
																?>
															</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>City / Town</label>
                                                            <p class="summary_view_text">
																<?php
																	if($patient_details['city_town']){echo $patient_details['city_town'];}
																?>
															</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>State</label>
                                                            <p class="summary_view_text">
															<?php
																if($patient_details['state']){echo $patient_details['state'];}
															?>
															</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <p class="summary_view_text">
																<?php
																	if($patient_details['address']){echo $patient_details['address'];}
																?>
															</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Contact Details </div>
                                            <div class="panel-body">
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Home</label>
                                                        <p class="summary_view_text">
															<?php
																if($patient_details['home_telephone']){echo $patient_details['home_telephone'];}
															?>
														</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Work</label>
                                                        <p class="summary_view_text">
															<?php
																if($patient_details['work_telephone']){echo $patient_details['work_telephone'];}
															?>
														</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Mobile</label>
                                                        <p class="summary_view_text">
														<?php
															if($patient_details['mobile']){echo $patient_details['mobile'];}
														?>
														</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Email </label>
                                                        <p class="summary_view_text">
															<?php
																if($patient_details['primary_email']){echo $patient_details['primary_email'];}
															?>
														</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<?php
										if($diff < 16) {
									?>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">For Minors &lt; 16 </div>
                                            <div class="panel-body">
                                                <div class="input_fields_wrap">
                                                    <div class="col-md-2 col-sm-12 col-xs-12">
                                                        <label>Title</label>
													    <p class="summary_view_text"><?php if($patient_minor['title']){echo $patient_minor['title'];} ?></p>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Parent</label>
                                                            <p class="summary_view_text"><?php if($patient_minor['name']){echo $patient_minor['name'];} ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Relationship</label>
                                                            <p class="summary_view_text"><?php echo $relationship[$patient_minor['relationship_id']]; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <p class="summary_view_text"><?php if($patient_minor['address']){echo $patient_minor['address'];} ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Contact</label>
                                                            <p class="summary_view_text"><?php if($patient_minor['mobile']){echo $patient_minor['mobile'];} ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<?php } ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Next to Kin </div>
                                            <div class="panel-body">
                                                <div class="col-md-2 col-sm-12 col-xs-12">
													<label>Title</label>
													<p class="summary_view_text"><?php if(!empty($patient_nxt)&& $patient_nxt['title']){echo $patient_nxt['title'];} ?></p>
												</div>
												<div class="col-md-3 col-sm-12 col-xs-12">
													<div class="form-group">
														<label>Name</label>
														<p class="summary_view_text"><?php if(!empty($patient_nxt)&& $patient_nxt['name']){echo $patient_nxt['name'];} ?></p>
													</div>
												</div>
												<div class="col-md-2 col-sm-12 col-xs-12">
													<div class="form-group">
														<label>Contact</label>
														<p class="summary_view_text"><?php if(!empty($patient_nxt)&& $patient_nxt['mobile']){echo $patient_nxt['mobile'];} ?></p>
													</div>
												</div>
                                               <div class="col-md-5 col-sm-12 col-xs-12">
													<div class="form-group">
														<label>Address</label>
														<p class="summary_view_text"><?php if(!empty($patient_nxt)&& $patient_nxt['address']){echo $patient_nxt['address'];} ?></p>
													</div>
												</div>
                                                 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Demographic </div>
                                            <div class="panel-body">
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <label>Ethinic Origin</label>
                                                    <p class="summary_view_text"><?php if($patient_details['ethinic_origin']){echo $ethinic_details[$patient_details['ethinic_origin']];} ?></p>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Languages Spoken</label>
                                                        <p class="summary_view_text">
															<?php
															if(trim($patient_details['languages'])	!= ''){
																$list_array		= $this->common->language_list($patient_details['languages']);
																$lang			= '';
																foreach($list_array as $key => $val){
																	$lang		.= $val.', ';
																}
																echo trim($lang,', ');
															}
															?>
														</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Martial Status</label>
                                                        <p class="summary_view_text"><?php if($patient_details['marital_status']){echo $marital_list[$patient_details['marital_status']];} ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Family</div>
											<?php
											if(!empty($family_details)){
												foreach($family_details as $key => $value){
													$value	=(array)$value;
												?>
													<div class="panel-body">
														<div class="col-md-2 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Name</label>
																<p class="summary_view_text"><?php if($value['name']){echo $value['name'];} ?></p>
															</div>
														</div>
														<div class="col-md-2 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Relationship</label>
																<p class="summary_view_text"><?php if($value['relationship_id']){echo $relationship[$value['relationship_id']];} ?></p>
															</div>
														</div>
														<div class="col-md-1 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Age</label>
																<p class="summary_view_text"><?php if($value['age']){echo $value['age'];} ?> Years</p>
															</div>
														</div>
														<div class="col-md-3 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Address</label>
																<p class="summary_view_text"><?php if($value['address']){echo $value['address'];} ?></p>
															</div>
														</div>
														<div class="col-md-2 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Tel</label>
																<p class="summary_view_text"><?php if($value['mobile']){echo $value['mobile'];} ?></p>
															</div>
														</div>
													</div>
													<?php
													}
												}else{
												?>
												<div class="panel-body">
													<div class="col-md-2 col-sm-12 col-xs-12">
														<div class="form-group">
															<label>No records found...</label>
														</div>
													</div>
												</div>
											<?php } ?>
											
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
										
										<div class="panel panel-default">
											<div class="panel-heading">GP Details / Contact Info</div>
												
												<?php if(!empty($gp_details)){
													foreach ($gp_details as $gp_key => $gp_val) {
														$gp_val		= (array)$gp_val;	
														?>
														
														<div class="panel-body pro_reg_border">
															<div class="col-md-2 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>Practice Name</label>
																	<p class="summary_view_text"><?php if($gp_val['practice_name']){echo $gp_val['practice_name'];} ?></p>
																</div>
															</div>
															<div class="col-md-2 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>Doctor</label>
																	<p class="summary_view_text"><?php if($gp_val['doctor_name']){echo $gp_val['doctor_name'];} ?></p>
																</div>
															</div>
															<div class="col-md-2 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>Tel 1</label>
																	<p class="summary_view_text"><?php if($gp_val['tel1']){echo $gp_val['tel1'];} ?></p>
																</div>
															</div>
															<div class="col-md-2 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>Tel 2</label>
																	<p class="summary_view_text"><?php if($gp_val['tel2']){echo $gp_val['tel2'];} ?></p>
																</div>
															</div>
															<div class="col-md-3 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>Email </label>
																	<p class="summary_view_text"><?php if($gp_val['email']){echo $gp_val['email'];} ?></p>
																</div>
															</div>
															<div class="col-md-1 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>Country </label>
																	<p class="summary_view_text"><?php if($gp_val['country_id']){echo $country['name'][$gp_val['country_id']];} ?></p>
																</div>
															</div>
															<div class="col-md-2 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>Postcode </label>
																	<p class="summary_view_text"><?php if($gp_val['postcode']){echo $gp_val['postcode'];} ?></p>
																</div>
															</div>
															<div class="col-md-4 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>Address </label>
																	<p class="summary_view_text"><?php if($gp_val['address']){echo $gp_val['address'];} ?></p>
																</div>
															</div>
															<div class="col-md-2 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>City </label>
																	<p class="summary_view_text"><?php if($gp_val['city']){echo $gp_val['city'];} ?></p>
																</div>
															</div>
															<div class="col-md-2 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>State </label>
																	<p class="summary_view_text"><?php if($gp_val['state']){echo $gp_val['state'];} ?></p>
																</div>
															</div>
															
														</div>
												<?php
													}
												}else{
													?>
													<div class="panel-body">
														<div class="col-md-2 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>No records found</label>
															</div>
														</div>
													</div>
															
												<?php
												}
												?>	
												</div>
											</div>
                                    
									<!--<div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Address Details</div>
                                            <div class="panel-body">
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>County</label>
                                                            <p class="summary_view_text">United Kingdom</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Postcode</label>
                                                            <p class="summary_view_text">+1234567890</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>City</label>
                                                            <p class="summary_view_text">London</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>State</label>
                                                            <p class="summary_view_text">London</p>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <p class="summary_view_text">E3230, Park Plaza, Bridge Road,London</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
									</div> --> 
									
									
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Chemist Details / Contact Info</div>
                                            
											<?php
											if(!empty($chemist_details)){
												foreach ($chemist_details as $ch_key => $ch_val) {
													$ch_val		= (array)$ch_val;	
											?>
													<div class="panel-body pro_reg_border">
														<div class="col-md-2 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Pharmacy Name</label>
																<p class="summary_view_text"><?php if($ch_val['pharmacy_name']){echo $ch_val['pharmacy_name'];} ?></p>
															</div>
														</div>
														<div class="col-md-2 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Chemist Name</label>
																<p class="summary_view_text"><?php if($ch_val['chemist_name']){echo $ch_val['chemist_name'];} ?></p>
															</div>
														</div>
														<div class="col-md-2 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Tel 1</label>
																<p class="summary_view_text"><?php if($ch_val['tel1']){echo $ch_val['tel1'];} ?></p>
															</div>
														</div>
														<div class="col-md-2 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Tel 2</label>
																<p class="summary_view_text"><?php if($ch_val['tel2']){echo $ch_val['tel2'];} ?></p>
															</div>
														</div>
														<div class="col-md-3 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Email</label>
																<p class="summary_view_text"><?php if($ch_val['email']){echo $ch_val['email'];} ?></p>
															</div>
														</div>
														<div class="col-md-1 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Country </label>
																<p class="summary_view_text"><?php if($ch_val['country_id']){echo $country['name'][$ch_val['country_id']];} ?></p>
															</div>
														</div>
														<div class="col-md-2 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Postcode </label>
																<p class="summary_view_text"><?php if($ch_val['postcode']){echo $ch_val['postcode'];} ?></p>
															</div>
														</div>
														<div class="col-md-4 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Address </label>
																<p class="summary_view_text"><?php if($ch_val['address']){echo $ch_val['address'];} ?></p>
															</div>
														</div>
														<div class="col-md-2 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>City </label>
																<p class="summary_view_text"><?php if($ch_val['city']){echo $ch_val['city'];} ?></p>
															</div>
														</div>
														<div class="col-md-2 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>State </label>
																<p class="summary_view_text"><?php if($ch_val['state']){echo $ch_val['state'];} ?></p>
															</div>
														</div>
													</div>
													 
											<?php
												}
											}else{
											?>
												<div class="panel-body">
													<div class="col-md-12 col-sm-12 col-xs-12">
														<div class="form-group">
															<label>No records found...</label>
														</div>
													</div>
												</div>
											<?php
											}
											?>
											
                                        </div>
                                    </div>
                                    
									<!--<div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Address Details</div>
                                            <div class="panel-body">
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>County</label>
                                                            <p class="summary_view_text">United Kingdom</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Postcode</label>
                                                            <p class="summary_view_text">+1234567890</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>City</label>
                                                            <p class="summary_view_text">London</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>State</label>
                                                            <p class="summary_view_text">London</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <p class="summary_view_text">E3230, Park Plaza, Bridge Road,London</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
									
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Career Details / Contact Info</div>
                                           <?php
											if(!empty($career_details)){
												foreach ($career_details as $c_key => $c_val) {
													$c_val		= (array)$c_val;	
											?>
												<div class="panel-body pro_reg_border">
													<div class="col-md-2 col-sm-12 col-xs-12">
														<div class="form-group">
															<label>Company Name</label>
															<p class="summary_view_text"><?php if($c_val['company_name']){echo $c_val['company_name'];} ?></p>
														</div>
													</div>
													<div class="col-md-2 col-sm-12 col-xs-12">
														<div class="form-group">
															<label>Name</label>
															<p class="summary_view_text"><?php if($c_val['name']){echo $c_val['name'];} ?></p>
														</div>
													</div>
													<div class="col-md-2 col-sm-12 col-xs-12">
														<div class="form-group">
															<label>Tel 1</label>
															<p class="summary_view_text"><?php if($c_val['tel1']){echo $c_val['tel1'];} ?></p>
														</div>
													</div>
													<div class="col-md-2 col-sm-12 col-xs-12">
														<div class="form-group">
															<label>Tel 2</label>
															<p class="summary_view_text"><?php if($c_val['tel2']){echo $c_val['tel2'];} ?></p>
														</div>
													</div>
													<div class="col-md-3 col-sm-12 col-xs-12">
														<div class="form-group">
															<label>Email </label>
															<p class="summary_view_text"><?php if($c_val['email']){echo $c_val['email'];} ?></p>
														</div>
													</div>
													<div class="col-md-1 col-sm-12 col-xs-12">
														<div class="form-group">
															<label>Country </label>
															<p class="summary_view_text"><?php if($c_val['country_id']){echo $country['name'][$c_val['country_id']];} ?></p>
														</div>
													</div>
													<div class="col-md-2 col-sm-12 col-xs-12">
														<div class="form-group">
															<label>Postcode </label>
															<p class="summary_view_text"><?php if($c_val['postcode']){echo $c_val['postcode'];} ?></p>
														</div>
													</div>
													<div class="col-md-4 col-sm-12 col-xs-12">
														<div class="form-group">
															<label>Address </label>
															<p class="summary_view_text"><?php if($c_val['address']){echo $c_val['address'];} ?></p>
														</div>
													</div>
													<div class="col-md-2 col-sm-12 col-xs-12">
														<div class="form-group">
															<label>City </label>
															<p class="summary_view_text"><?php if($c_val['city']){echo $c_val['city'];} ?></p>
														</div>
													</div>
													<div class="col-md-2 col-sm-12 col-xs-12">
														<div class="form-group">
															<label>State </label>
															<p class="summary_view_text"><?php if($c_val['state']){echo $c_val['state'];} ?></p>
														</div>
													</div>
												</div>
											<?php }
											} else{?>
											<div class="panel-body ">
												<div class="col-md-2 col-sm-12 col-xs-12">
													<div class="form-group">
														<label>No records found...</label>
													</div>
												</div>
											</div>
											<?php } ?>
                                        </div>
                                    </div>
									
									<!--
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Address Details</div>
                                            <div class="panel-body">
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>County</label>
                                                            <p class="summary_view_text">United Kingdom</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Postcode</label>
                                                            <p class="summary_view_text">+1234567890</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>City</label>
                                                            <p class="summary_view_text">London</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>State</label>
                                                            <p class="summary_view_text">London</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <p class="summary_view_text">E3230, Park Plaza, Bridge Road,London</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									-->
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Documents</div>
                                            <div class="panel-body">
                                                <div class="panel panel-default panel-default-two" style="margin-bottom:0px;">
                                                    <div class="panel-heading panel-heading-two">Attachments</div>
													  <?php
														if(!empty($documents)){
															foreach ($documents as $d_key => $d_val) {
																$d_val		= (array)$d_val;	
														?>
																<div class="row" style="padding:5px 10px;">
																	<div class="col-md-2 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Title</label>
																			<p class="summary_view_text"><?php if($d_val['title']){echo $d_val['title'];} ?></p>
																		</div>
																	</div>
																	<div class="col-md-2 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Link</label>
																			<p class="summary_view_text">
																				<a href="<?php echo base_url() .'assets/uploads/'.$d_val['file_path'].$d_val['file_name']; ?>" target="_blank" style="text-decoration:underline" >
																					Document Link
																				</a>
																			</p>
																		</div>
																	</div>
																	<div class="col-md-2 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Added on</label>
																			<p class="summary_view_text"><?php if($d_val['created_date']){echo date('d/m/Y',strtotime($d_val['created_date']));} ?></p>
																		</div>
																	</div>
																 
																</div>
													<?php 	}
														}else{
															?>
															<div class="row" style="padding:5px 10px;">
																<div class="col-md-12 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>No records founds...</label>
																	</div>
																</div>
															</div>
															<?php
														}
													?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Notes</div>
                                             <?php
												if(!empty($notes)){
													foreach ($notes as $n_key => $n_val) {
														$n_val		= (array)$n_val;	
												?>
														<div class="row" style="padding:5px 10px;">
															<div class="col-md-4 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>Notes</label>
																	<p class="summary_view_text"><?php if($n_val['notes']){echo $n_val['notes'];} ?></p>
																</div>
															</div>
															<div class="col-md-8 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>Added By</label>
																	<p>@ <?php if($n_val['modified_date']){echo date("F j, Y, g:i a",strtotime($n_val['modified_date'])); } ?> Added by <i><?php echo ucfirst($n_val['title'].' '.$n_val['firstname'].' '.$n_val['lastname']); ?></i></p>
																</div>
															</div>
														</div>
											<?php 	}
												}else{
											?>
													<div class="panel-body">
														<div class="col-md-12 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>No records found...</label>
															</div>
														</div>
													</div>
											<?php
												}
											?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" id="alerts">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Alerts</div>
                                           
										    <?php
												if(!empty($alerts)){
													foreach ($alerts as $a_key => $a_val) {
														$a_val		= (array)$a_val;	
												?>
													<div class="row" style="padding:5px 10px;">
														<div class="col-md-4 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Alerts</label>
																<p class="summary_view_text"><?php if($a_val['alerts']){echo $a_val['alerts'];} ?></p>
															</div>
														</div>
														<div class="col-md-8 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Added By</label>
																<p>@ <?php if($a_val['modified_date']){echo date("F j, Y, g:i a",strtotime($a_val['modified_date'])); } ?> Added by  <i><?php echo ucfirst($a_val['title'].' '.$a_val['firstname'].' '.$a_val['lastname']); ?></i></p>
															</div>
														</div>
													</div>
												<?php 	}
													}else{
												?>
														<div class="panel-body">
															<div class="col-md-12 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>No records found...</label>
																</div>
															</div>
														</div>
												<?php
													}
												?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Save Section-->
                        <!--<div class="row" id="save-section" style="display:none;">
                            <div class="x_title">
                                <h2>New Patients Summary</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a href="#" class="save-btn"><i class="fa fa-save"></i> Save</a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Personal Details </div>
                                    <div class="panel-body">
                                        <div class="col-md-2 col-sm-6 col-xs-12">
                                            <div class="text-center">
                                                <img id="blah" src="images/img.jpg" class="avg-profile-img img-circle img-thumbnail" alt="avatar">
                                                <div></div>
                                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                                    <input type="file" id="FileUpload1" class="center-block well well-sm" onchange="readURL(this);" style="width: 100px; !important;padding: 6px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10 col-sm-6 col-xs-12 profile-details">
                                            <div class="row">
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <label>Title</label>
                                                    <div class="form-group">
                                                        <select class="form-control">
                                                            <option>Title</option>
                                                            <option>Mr</option>
                                                            <option>Ms</option>
                                                            <option>Mrs</option>
                                                            <option>Miss</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" id="fNamePd" onblur="pdCheck()" class="form-control" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Middle Name</label>
                                                        <input type="text" class="form-control" placeholder="Middle Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" placeholder="Last Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 col-sm-6 col-xs-6 form-text-wrapper ">
                                                    <label>Gender</label>
                                                    <select class="form-control">
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                        <option>Transgender</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>NHS No</label>
                                                        <input class="form-control" id="txtProfNHSNo" name="NHSNo" placeholder="NHS No" type="text" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper">
                                                    <div class="">
                                                        <div class="xdisplay_inputx form-group">
                                                            <label>DOB</label>
                                                            <input type="text" class="form-control hasDatepicker" id="datepicker" placeholder="dd/mm/yy">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-12 form-text-wrapper">
                                                    <div class="form-group">
                                                        <label>Age</label>
                                                        <input id="ageId" type="text" class="form-control" placeholder="age">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Address Details </div>
                                    <div class="panel-body">
                                        <div class="col-md-8 col-sm-12 col-xs-12 profile-details">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper">
                                                    <div class="form-group">
                                                        <label for="sel1">Country</label>
                                                        <select class="form-control" id="sel1">
                                                            <option>Country 1</option>
                                                            <option>Country 2</option>
                                                            <option>Country 3</option>
                                                            <option>Country 4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Postcode</label>
                                                        <input type="text" class="form-control" placeholder="Postcode">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>City / Town</label>
                                                        <input type="text" class="form-control" placeholder="City / Town">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>State</label>
                                                        <input type="text" class="form-control" placeholder="State">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12 form-text-wrapper">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control" rows="5" placeholder="Address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Contact Details </div>
                                    <div class="panel-body">
                                        <div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper">
                                            <div class="form-group">
                                                <label>Home</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <input type="checkbox">
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="+123 4567 890">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper">
                                            <div class="form-group">
                                                <label>Work</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <input type="checkbox">
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="+123 4567 890">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper">
                                            <div class="form-group">
                                                <label>Mobile</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <input type="checkbox">
                                                    </span>
                                                    <input type="text" class="form-control" placeholder="+123 4567 890">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper">
                                            <div class="form-group">
                                                <label>Email </label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="inputSuccess4" placeholder="Email ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">For Minors &lt; 16 </div>
                                    <div class="panel-body">
                                        <div class="col-md-7 col-sm-12 col-xs-12 profile-details">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <label>Title</label>
                                                    <div class="form-group">
                                                        <select class="form-control">
                                                            <option>Title</option>
                                                            <option>Mr</option>
                                                            <option>Ms</option>
                                                            <option>Mrs</option>
                                                            <option>Miss</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Parent</label>
                                                        <input type="text" class="form-control" placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Relationship</label>
                                                        <select class="form-control">
                                                            <option>Choose..</option>
                                                            <option>Father</option>
                                                            <option>Mother</option>
                                                            <option>Brother</option>
                                                            <option>Sister</option>
                                                            <option>Cousin</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Contact</label>
                                                        <input type="text" class="form-control" placeholder="Contact">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12 form-text-wrapper">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control" rows="3" placeholder="Address"></textarea>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="cbxMinorImportAddress">
                                                <label class="form-check-label" for="exampleCheck1">Import home  address</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-1 col-md-1">
                                            <div class="form-group">
                                                <label>Action</label>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <button type="button" class="add_field_button btn btn-default btn-sm">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Next to Kin </div>
                                    <div class="panel-body">
                                        <div class="col-md-6 col-sm-12 col-xs-12 profile-details">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <label>Title</label>
                                                    <div class="form-group">
                                                        <select class="form-control">
                                                            <option>Title</option>
                                                            <option>Mr</option>
                                                            <option>Ms</option>
                                                            <option>Mrs</option>
                                                            <option>Miss</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Contact</label>
                                                        <input type="text" class="form-control" placeholder="Contact">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12 form-text-wrapper">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control" rows="3" placeholder="Address"></textarea>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="cbxMinorImportAddress">
                                                <label class="form-check-label" for="exampleCheck1">Import home  address</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Demographic </div>
                                    <div class="panel-body">
                                        <div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
                                            <div class="form-group">
                                                <label>Ethinic Origin</label>
                                                <div class="form-group">
                                                    <select class="form-control" id="demograp" onchange="pdCheck5()">
                                                        <option>Choose..</option>
                                                        <option>Asian</option>
                                                        <option>Black</option>
                                                        <option>White</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
                                            <div class="form-group">
                                                <label>Languages Spoken</label>
                                                <span class="multiselect-native-select">
                                                    <span class="multiselect-native-select">
                                                        <select id="dates-field2" class="multiselect-ui form-control" multiple="multiple">
                                                            <option value="cheese">English</option>
                                                            <option value="tomatoes">German</option>
                                                            <option value="mozarella">French</option>
                                                            <option value="mushrooms">Italin</option>
                                                        </select>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
                                            <div class="form-group">
                                                <label>Martial Status</label>
                                                <select class="form-control">
                                                    <option>Choose..</option>
                                                    <option>Single</option>
                                                    <option>Married</option>
                                                    <option>Seprated</option>
                                                    <option>Living with Partner</option>
                                                    <option>Divorced</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Family</div>
                                    <div class="panel-body">
                                        <div class="">
                                            <div class="input_fields_wrap1">
                                                <div class="panel-body">
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control" placeholder="Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                                <label>Relationship to the Reg user</label>
                                                                <div class="form-group">
                                                                    <select class="form-control">
                                                                        <option>Father</option>
                                                                        <option>Mother</option>
                                                                        <option>Brother</option>
                                                                        <option>Sister</option>
                                                                        <option>Cousin</option>
                                                                        <option>Grand Father</option>
                                                                        <option>Grand Mother</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Tel</label>
                                                                    <input type="text" class="form-control" placeholder="Tel">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Contact</label>
                                                                    <input type="text" class="form-control" placeholder="Contact">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Age</label>
                                                                    <input type="text" class="form-control" placeholder="Age">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 col-xs-12 form-text-wrapper">
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <textarea class="form-control" rows="3" placeholder="Address"></textarea>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="cbxMinorImportAddress">
                                                            <label class="form-check-label" for="exampleCheck1">Import home  address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 col-md-2">
                                                        <div class="form-group">
                                                            <label>Add More</label>
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <button type="button" class="add_field_button1 btn btn-default btn-sm">
                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                </button>
                                                                <button type="button" class="add_field_button btn btn-default btn-sm">
                                                                    <span class="pull-right"><i onclick="clearPtD()" class="fa fa-eraser" data-toggle="tooltip" data-title="Clear all data" data-original-title="" title=""></i></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">GP Details / Contact Info</div>
                                    <div class="panel-body">
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Company Name</label>
                                                <input type="text" class="form-control" placeholder="Company Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Tel 1</label>
                                                <input type="text" class="form-control" placeholder="+1234567890">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Tel 2</label>
                                                <input type="text" class="form-control" placeholder="+1234567890">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Address Details</div>
                                    <div class="panel-body">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper">
                                                <div class="form-group">
                                                    <label for="sel1">Country</label>
                                                    <select class="form-control">
                                                        <option>Select Country</option>
                                                        <option>India</option>
                                                        <option>USA</option>
                                                        <option>Pakistan</option>
                                                        <option>UAE</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Postcode</label>
                                                    <input type="text" class="form-control" placeholder="Postcode">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>City / Town</label>
                                                    <input type="text" class="form-control" placeholder="City / Town">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <input type="text" class="form-control" placeholder="State">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control" rows="4" placeholder="Address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Chemist Details / Contact Info</div>
                                    <div class="panel-body">
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Pharmacy Name</label>
                                                <input type="text" class="form-control" placeholder="Pharmacy Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Chemist Name</label>
                                                <input type="text" class="form-control" placeholder="Chemist Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Tel 1</label>
                                                <input type="text" class="form-control" placeholder="+1234567890">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Tel 2</label>
                                                <input type="text" class="form-control" placeholder="+1234567890">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Address Details</div>
                                    <div class="panel-body">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper">
                                                <div class="form-group">
                                                    <label for="sel1">Country</label>
                                                    <select class="form-control">
                                                        <option>Select Country</option>
                                                        <option>India</option>
                                                        <option>USA</option>
                                                        <option>Pakistan</option>
                                                        <option>UAE</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Postcode</label>
                                                    <input type="text" class="form-control" placeholder="Postcode">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>City / Town</label>
                                                    <input type="text" class="form-control" placeholder="City / Town">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <input type="text" class="form-control" placeholder="State">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control" rows="4" placeholder="Address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Carer Details / Contact Info</div>
                                    <div class="panel-body">
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Company Name</label>
                                                <input type="text" class="form-control" placeholder="Company Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Tel 1</label>
                                                <input type="text" class="form-control" placeholder="+1234567890">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Tel 2</label>
                                                <input type="text" class="form-control" placeholder="+1234567890">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Address Details</div>
                                    <div class="panel-body">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper">
                                                <div class="form-group">
                                                    <label for="sel1">Country</label>
                                                    <select class="form-control">
                                                        <option>Select Country</option>
                                                        <option>India</option>
                                                        <option>USA</option>
                                                        <option>Pakistan</option>
                                                        <option>UAE</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Postcode</label>
                                                    <input type="text" class="form-control" placeholder="Postcode">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>City / Town</label>
                                                    <input type="text" class="form-control" placeholder="City / Town">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <input type="text" class="form-control" placeholder="State">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control" rows="4" placeholder="Address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Documents</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-5 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Upload Documents / Files</label>
                                                    <div class="file-input file-input-ajax-new">
                                                        <label class="btn btn-primary" style="margin-top: 10px;color:#fff;">
                                                            <input class="file-4 upload_btn" id="upload-file-selector" type="file" multiple="">Upload
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-sm-12 col-xs-12" id="upload_document" style="display:none;">
                                                <label>Uploaded Documents / Files</label>
                                                <div class="list-group table-responsive">
                                                    <table class="table table-fixed table-striped table-bordered">
                                                        <thead>
                                                            <tr role="row">
                                                                <th>
                                                                    <!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" /> &nbsp; #
                                                                </th>
                                                                <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Files</th>
                                                                <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
                                                                <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="upload_list_files" style="height: 10px !important; overflow: scroll; "></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Notes</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <label>Notes</label>
                                                <textarea onkeyup="pdChk6()" class="resizable_textarea form-control" placeholder="Notes.."></textarea>
                                                <!--<div class="action-icon">
                        <span class="left red">
                            My new notes are so good its just dummy notes...
                            <strong>@10:30am, 03-04-2017 by Doctor Team</strong>
                        </span>
                        </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Notes</th>
                                                            <th>Added By</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                Patient is voilent, please take care
                                                            </td>
                                                            <td>
                                                                <p>@ 6:14 PM, 04-04-2017 Added by <i>Dr. Nahar</i></p>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <a class="btn btn-success" href="#alert-modal" data-toggle="modal"><i class="fa fa-pencil"></i> </a>
                                                                    <a class="btn btn-success" onclick="confirm('Are you sure want to delete Alert ?')" href="#" data-toggle="tooltip" data-title="Delete Alert" data-original-title="" title=""><i class="fa fa  fa-trash" style="color:#fff;" data-original-title="" title=""></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Patient need addition person
                                                            </td>
                                                            <td>
                                                                <p>@ 6:14 PM, 04-04-2017 Added by <i>Dr. Nahar</i></p>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <a class="btn btn-success" href="#alert-modal" data-toggle="modal"><i class="fa fa-pencil"></i> </a>
                                                                    <a class="btn btn-success" onclick="confirm('Are you sure want to delete Alert ?')" href="#" data-toggle="tooltip" data-title="Delete Alert" data-original-title="" title=""><i class="fa fa  fa-trash" style="color:#fff;" data-original-title="" title=""></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="pull-right">
                                                    <a href="#" class="btn btn-success"><i class="fa fa-save"></i> Save</a>
                                                    <a class="btn btn-success" href="#notes-edit-modal" data-toggle="modal"><i class="fa fa-pencil"></i> Edit</a>
                                                    <a class="btn btn-success" href="#"><i class="fa fa  fa-trash" style="color:#fff;" data-toggle="tooltip" data-title="Delete Notes" data-original-title="" title=""></i> Delete</a>
                                                </div>
                                            </div>
                                            <div class="modal fade notes-info" id="notes-edit-modal">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            <h4 class="modal-title">Notes</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <textarea class="resizable_textarea form-control" placeholder="Notes..">                                                                    My new notes are so good its just dummy notes...
                                                                </textarea>
                                                            <div class="action-icon">
                                                                <br>
                                                                <a href="#" class="btn btn-success"><i class="fa fa-save"></i> Save</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Alerts</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="input_fields_wrap5">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                </div>
                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Alert Text</label>
                                                        <textarea type="text" row="3" class="form-control" placeholder="Alert Text"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <label>Action</label>
                                                    <div class="form-group">
                                                        <a href="#" class="btn btn-success" data-toggle="tooltip" data-title="Save Alert"><i class="fa fa-save"></i> Save</a>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Set Alert</label><br>
                                                        <label class="switch">
                                                            <input class="switch-input" type="checkbox" />
                                                            <span class="switch-label" data-on="On" data-off="Off"></span>
                                                            <span class="switch-handle"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Alerts</th>
                                                                <th>Added By</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    Patient is voilent, please take care
                                                                </td>
                                                                <td>
                                                                    <p>@ 6:14 PM, 04-04-2017 Added by <i>Dr. Nahar</i></p>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <a class="btn btn-success" href="#alert-modal" data-toggle="modal"><i class="fa fa-pencil"></i> </a>
                                                                        <a class="btn btn-success" onclick="confirm('Are you sure want to delete Alert ?')" href="#" data-toggle="tooltip" data-title="Delete Alert"><i class="fa fa  fa-trash" style="color:#fff;" data-original-title="" title=""></i></a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    Patient need addition person
                                                                </td>
                                                                <td>
                                                                    <p>@ 6:14 PM, 04-04-2017 Added by <i>Dr. Nahar</i></p>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <a class="btn btn-success" href="#alert-modal" data-toggle="modal"><i class="fa fa-pencil"></i> </a>
                                                                        <a class="btn btn-success" onclick="confirm('Are you sure want to delete Alert ?')" href="#" data-toggle="tooltip" data-title="Delete Alert"><i class="fa fa  fa-trash" style="color:#fff;" data-original-title="" title=""></i></a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal fade alerts-info" id="alert-modal">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                <h4 class="modal-title">Update Alert</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="resizable_textarea form-control" placeholder="Alert">                                                                Patient is voilent, please take care
                                                            </textarea>
                                                                <div class="action-icon">
                                                                    <br>
                                                                    <a href="#" class="btn btn-success"><i class="fa fa-save"></i> Update</a>
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
                        </div>-->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modals -->   
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>assets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url(); ?>assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url(); ?>assets/vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>assets/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-imageupload.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/drop-down.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/fileinput.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/switchery/dist/switchery.min.js"></script>
    <script>
        function ageCount() {
            document.getElementById('ageId').value = "";
            var birthday = new Date(document.getElementById("single_cal3").value);
            var today = new Date(),
                age = (
                    (today.getMonth() > birthday.getMonth())
                    ||
                    (today.getMonth() == birthday.getMonth() && today.getDate() >= birthday.getDate())
                ) ? today.getFullYear() - birthday.getFullYear() : today.getFullYear() - birthday.getFullYear() - 1;
            var months = today.getMonth() - birthday.getMonth();
            if (months < 0)
                months += 11;
            var days = today.getDate() - birthday.getDate();
            if (days < 0) {
                birthday.setMonth(birthday.getMonth() + 1, 0);
                days = birthday.getDate() - birthday.getDate() + today.getDate();
                --months;
            }

            document.getElementById('ageId').value = age + "yrs " + months + " month " + days + " days";

        }


        function ageCount1() {
            var date1 = new Date();
            var dob = document.getElementById("single_cal4").value;
            var date2 = new Date(dob);

            var y1 = date1.getFullYear();
            //getting current year
            var y2 = date2.getFullYear();
            //getting dob year
            var age = y1 - y2;
            //calculating age
            document.getElementById("ageId1").value = age;
            return true;

        }

        $(document).ready(function () {
            var max_fields 		= 6; //maximum input boxes allowed
            var wrapper		 	= $(".input_fields_wrap"); //Fields wrapper
            var add_button 		= $(".add_field_button"); //Add button ID
			var x 				= 1; //initlal text box count
            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(' <div class="row"><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><select class="form-control"><option>Title</option><option>Mr</option><option>Ms</option><option>Mrs</option><option>Miss</option></select></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><input type="text" class="form-control" placeholder="Parent"></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><select class="form-control"><option>Choose..</option><option>Father</option><option>Mother</option><option>Brother</option><option>Sister</option><option>Cousin</option></select></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><textarea class="form-control" rows="1" placeholder="Address"></textarea></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><input type="text" class="form-control" placeholder="Contact"></div></div><div class="col-sm-1 col-md-1"><div class="form-group"><div class="col-md-12 col-sm-12 col-xs-12"><button type="button" class="remove_field btn btn-default btn-sm"><span class="glyphicon glyphicon-minus"></span></button></div></div></div></div>'); //add input box

                }
            });

            $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
                var r 		= confirm("Are you sure want to delete?");
                if (r == true) {
                    e.preventDefault();
                    $(this).parent('div').parent('div').parent('div').parent('div').remove();
                    x--;
                }
            })
        });


    </script>
    <script>
        $(document).ready(function () {
            var max_fields 		= 6; //maximum input boxes allowed
            var wrapper	 		= $(".input_fields_wrap1"); //Fields wrapper
            var add_button 		= $(".add_field_button1"); //Add button ID
            var x 				= 1; //initlal text box count
            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="row"><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><input type="text" class="form-control" placeholder="Name"></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><select class="form-control"><option>Choose..</option><option>Father</option><option>Mother</option><option>Brother</option><option>Sister</option><option>Cousin</option><option>Grand Father</option><option>Grand Mother</option><option>Family</option></select></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class=""><div class="xdisplay_inputx form-group has-feedback"><input type="text" class="form-control has-feedback-left" id="single_cal2' + x + '" placeholder="date" aria-describedby="inputSuccess2Status4"><span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span><span id="inputSuccess2Status4" class="sr-only">(success)</span></div></div></div><div class="col-md-1 col-sm-12 col-xs-12"><div class="form-group"><input type="text" class="form-control" placeholder="Age"></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><textarea class="form-control" rows="1" placeholder="Address"></textarea></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><input type="text" class="form-control" placeholder="Contact no"></div></div><div class="col-md-1 col-sm-12 col-xs-12"><div class="form-group"><button type="button" class="remove_field1 btn btn-default btn-sm"><span class="glyphicon glyphicon-minus"></span></button><br/><br/><button type="button" onclick="clearFamily()" class="btn btn-default btn-sm"><i class="fa fa-eraser"></i></button></div></div></div>'); //add input box

                }
            });

            $(wrapper).on("click", ".remove_field1", function (e) { //user click on remove text
				var r 		= confirm("Are you sure want to delete?");
                if (r == true) {
                    e.preventDefault();
                    $(this).parent('div').parent('div').parent('div').remove();
                    x--;
                }
            })
        });



        $(document).ready(function () {
            var max_fields 		= 6; //maximum input boxes allowed
            var wrapper 		= $(".input_fields_wrap2"); //Fields wrapper
            var add_button 		= $(".add_field_button2"); //Add button ID
			var x 				= 1; //initlal text box count
            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="my"><div class=row><div class="col-sm-12 col-xs-12 col-md-5"><div class="panel panel-default"><div class=panel-heading>GP Details / Contact Info</div><div class=panel-body><div class="col-sm-12 col-xs-12 col-md-6"><div class=form-group><label>Practice Name</label><div class=input-group><span class=input-group-addon><input type=checkbox> </span><input class=form-control placeholder="Practice Name"id=pracNameGP onblur=pdCheck2()></div></div></div><div class="col-sm-12 col-xs-12 col-md-6"><div class=form-group><label>Doctor</label><input class=form-control placeholder=Doctor></div></div><div class="col-sm-12 col-xs-12 col-md-12"><div class=form-group><label>Tel 1</label><div class=input-group><span class=input-group-addon><input type=checkbox> </span><input class=form-control placeholder="+123 4567 890"></div></div></div><div class="col-sm-12 col-xs-12 col-md-12"><div class=form-group><label>Tel 2</label><div class=input-group><span class=input-group-addon><input type=checkbox> </span><input class=form-control placeholder="+123 4567 890"></div></div></div><div class="col-sm-12 col-xs-12 col-md-12"><div class=form-group><label>Email</label><div class="form-group has-feedback"><input class="form-control has-feedback-left"placeholder=Email id=inputSuccess4> <span class="fa fa-envelope form-control-feedback left"aria-hidden=true></span></div></div></div></div></div></div><div class="col-sm-12 col-xs-12 col-md-6"><div class="panel panel-default"><div class=panel-heading>Address Details</div><div class=panel-body><div class="col-sm-12 col-xs-12 col-md-6"><div class=form-group><label>County</label><select class=form-control><option>Select<option>India<option>USA<option>Dubai<option>UK</select></div></div><div class="col-sm-12 col-xs-12 col-md-6"><div class=form-group><label>Postcode</label><input class=form-control placeholder=Postcode></div></div><div class="col-sm-12 col-xs-12 col-md-6"><div class=form-group><label>City</label><input class=form-control placeholder=City></div></div><div class="col-sm-12 col-xs-12 col-md-6"><div class=form-group><label>State</label><input class=form-control placeholder=State></div></div><div class="col-sm-12 col-xs-12 col-md-12"><div class=form-group><label>Address</label><textarea class=form-control placeholder=Address rows=6></textarea></div></div></div></div></div><div class="col-md-1 col-sm-1"><div class=form-group><label>Action</label><div class="col-sm-12 col-xs-12 col-md-12"><button class="btn btn-default btn-sm add_field_button2"type=button><span class="glyphicon glyphicon-plus"></span></button></div><div class="col-sm-12 col-xs-12 col-md-12"><br><button class="btn btn-default btn-sm"type=button onclick=clearGP()><i class="fa fa-eraser"></i></button></div></div></div></div>'); //add input box

                }
            });

            $(wrapper).on("click", ".remove_field2", function (e) { //user click on remove text
                var r 		= confirm("Are you sure want to delete?");
                if (r == true) {
                    e.preventDefault();
                    $(this).parent('div').parent('div').parent('div').parent('div').parent('div').remove();
                    x--;
                }
            })
        });

        $(document).ready(function () {
            var max_fields = 3; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap3"); //Fields wrapper
            var add_button = $(".add_field_button3"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="my"><div class=row><div class="col-sm-12 col-xs-12 col-md-4"><div class="panel panel-default"><div class=panel-heading>Chemist Details / Contact Info</div><div class=panel-body><div class="col-sm-12 col-xs-12 col-md-12"><div class=form-group><label>Chemist Name</label><div class=input-group><span class=input-group-addon><input type=checkbox> </span><input class=form-control placeholder="Chemist Name"id=chemNameCD onblur=pdCheck3()></div></div></div><div class="col-sm-12 col-xs-12 col-md-12"><div class=form-group><label>Tel 1</label><div class=input-group><span class=input-group-addon><input type=checkbox> </span><input class=form-control placeholder="+123 4567 890"></div></div></div><div class="col-sm-12 col-xs-12 col-md-12"><div class=form-group><label>Tel 2</label><div class=input-group><span class=input-group-addon><input type=checkbox> </span><input class=form-control placeholder="+123 4567 890"></div></div></div><div class="col-sm-12 col-xs-12 col-md-12"><div class=form-group><label>Email</label><div class="form-group has-feedback"><input class="form-control has-feedback-left"placeholder="Email "id=inputSuccess4> <span class="fa fa-envelope form-control-feedback left"aria-hidden=true></span></div></div></div></div></div></div><div class="col-sm-12 col-xs-12 col-md-7"><div class="panel panel-default"><div class=panel-heading>Address Details</div><div class=panel-body><div class="col-sm-12 col-xs-12 col-md-6"><div class=form-group><label>County</label><select class=form-control><option>Select<option>India<option>USA<option>Dubai<option>UK</select></div></div><div class="col-sm-12 col-xs-12 col-md-6"><div class=form-group><label>Postcode</label><input class=form-control placeholder=Postcode></div></div><div class="col-sm-12 col-xs-12 col-md-6"><div class=form-group><label>City</label><input class=form-control placeholder=City></div></div><div class="col-sm-12 col-xs-12 col-md-6"><div class=form-group><label>State</label><input class=form-control placeholder=State></div></div><div class="col-sm-12 col-xs-12 col-md-12"><div class=form-group><label>Address</label><textarea class=form-control placeholder=Address rows=6></textarea></div></div></div></div></div><div class="col-md-1 col-sm-1"><div class=form-group><label>Action</label><div class="col-sm-12 col-xs-12 col-md-12"><button class="btn btn-default btn-sm add_field_button3"type=button><span class="glyphicon glyphicon-plus"></span></button></div><div class="col-sm-12 col-xs-12 col-md-12"><br><button class="btn btn-default btn-sm"type=button onclick=clearCD()><i class="fa fa-eraser"></i></button></div></div></div></div>'); //add input box

                }
            });

            $(wrapper).on("click", ".remove_field3", function (e) { //user click on remove text

                var r = confirm("Are you sure want to delete?");
                if (r == true) {
                    e.preventDefault();
                    $(this).parent('div').parent('div').parent('div').parent('div').parent('div').remove();
                    x--;
                }
            })
        });

        $(document).ready(function () {
            var max_fields = 3; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap4"); //Fields wrapper
            var add_button = $(".add_field_button4"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="my"><div class=row><div class="col-sm-12 col-xs-12 col-md-4"><div class="panel panel-default"><div class=panel-heading>Carer Details / Contact Info</div><div class=panel-body><div class="col-sm-12 col-xs-12 col-md-6"><div class=form-group><label>Company Name</label><div class=input-group><span class=input-group-addon><input type=checkbox> </span><input class=form-control placeholder="Company Name"id=compNameC onblur=pdCheck4()></div></div></div><div class="col-sm-12 col-xs-12 col-md-6"><div class=form-group><label>Name</label><input class=form-control placeholder=Name></div></div><div class="col-sm-12 col-xs-12 col-md-12"><div class=form-group><label>Tel 1</label><div class=input-group><span class=input-group-addon><input type=checkbox> </span><input class=form-control placeholder="+123 4567 890"></div></div></div><div class="col-sm-12 col-xs-12 col-md-12"><div class=form-group><label>Tel 2</label><div class=input-group><span class=input-group-addon><input type=checkbox> </span><input class=form-control placeholder="+123 4567 890"></div></div></div><div class="col-sm-12 col-xs-12 col-md-12"><div class=form-group><label>Email</label><div class="form-group has-feedback"><input class="form-control has-feedback-left"placeholder=Email id=inputSuccess4> <span class="fa fa-envelope form-control-feedback left"aria-hidden=true></span></div></div></div></div></div></div><div class="col-sm-12 col-xs-12 col-md-7"><div class="panel panel-default"><div class=panel-heading>Address Details</div><div class=panel-body><div class="col-sm-12 col-xs-12 col-md-6"><div class=form-group><label>County</label><select class=form-control><option>Select<option>India<option>USA<option>Dubai<option>UK</select></div></div><div class="col-sm-12 col-xs-12 col-md-6"><div class=form-group><label>Postcode</label><input class=form-control placeholder=Postcode></div></div><div class="col-sm-12 col-xs-12 col-md-6"><div class=form-group><label>City</label><input class=form-control placeholder=City></div></div><div class="col-sm-12 col-xs-12 col-md-6"><div class=form-group><label>State</label><input class=form-control placeholder=State></div></div><div class="col-sm-12 col-xs-12 col-md-12"><div class=form-group><label>Address</label><textarea class=form-control placeholder=Address rows=6></textarea></div></div></div></div></div><div class="col-md-1 col-sm-1"><div class=form-group><label>Action</label><div class="col-sm-12 col-xs-12 col-md-12"><button class="btn btn-default btn-sm add_field_button4"type=button><span class="glyphicon glyphicon-plus"></span></button></div><div class="col-sm-12 col-xs-12 col-md-12"><br><button class="btn btn-default btn-sm"type=button onclick=clearCR()><i class="fa fa-eraser"></i></button></div></div></div></div></div>'); //add input box

                }
            });

            $(wrapper).on("click", ".remove_field4", function (e) { //user click on remove text

                var r = confirm("Are you sure want to delete?");
                if (r == true) {
                    e.preventDefault();
                    $(this).parent('div').parent('div').parent('div').parent('div').parent('div').remove();
                    x--;
                }
            })
        });

        $(document).ready(function () {
            var max_fields = 6; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap5"); //Fields wrapper
            var add_button = $(".add_field_button5"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).on("click", function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="row"><div class="col-md-12 col-sm-12 col-xs-12"><div class="col-md-8 col-sm-12 col-xs-12"><div class="form-group"><input type="text" class="form-control" placeholder="Alert Text"></div> </div><div class="col-md-2 col-sm-12 col-xs-12"><div><label><input type="checkbox" class="js-switch" data-switchery="true">  Yes / No</label></div></div><div class="col-md-1 col-sm-12 col-xs-12"><div class="form-group"><a href="#" class="btn btn-success"><i class="fa fa-save"></i> Save</a></div></div><div class="col-sm-1 col-md-1"><div class="form-group"><div class="col-md-12 col-sm-12 col-xs-12"><button type="button" class="remove_field5 btn btn-default btn-sm"><span class="glyphicon glyphicon-minus"></span></button></div></div></div></div></div>'); //add input box

                }
            });

            $(wrapper).on("click", ".remove_field5", function (e) { //user click on remove text

                var r = confirm("Are you sure want to delete?");
                if (r == true) {
                    e.preventDefault();
                    $(this).parent('div').parent('div').parent('div').parent('div').parent('div').remove();
                    x--;
                }

            })
        });

        var $imageupload = $('.imageupload');
        $imageupload.imageupload();

        function pdCheck() {
            var check = document.getElementById("fNamePd").value;
            var elem = document.getElementsByClassName("icheckbox_flat-green");
            if (check !== "") {
                document.getElementById("pDcheck").checked = true;
                elem[0].setAttribute("class", "icheckbox_flat-green checked");
            } else {
                document.getElementById("pDcheck").checked = false;
                elem[0].setAttribute("class", "icheckbox_flat-green");
            }
        }

        function pdCheck1() {
            var check = document.getElementById("namePF").value;
            var elem = document.getElementsByClassName("icheckbox_flat-green");
            if (check !== "") {
                document.getElementById("pDcheck2").checked = true;
                elem[2].setAttribute("class", "icheckbox_flat-green checked");
            } else {
                document.getElementById("pDcheck2").checked = false;
                elem[2].setAttribute("class", "icheckbox_flat-green");
            }
        }

        function pdCheck2() {
            var check = document.getElementById("pracNameGP").value;
            var elem = document.getElementsByClassName("icheckbox_flat-green");
            if (check !== "") {
                document.getElementById("pDcheck3").checked = true;
                elem[3].setAttribute("class", "icheckbox_flat-green checked");
            } else {
                document.getElementById("pDcheck3").checked = false;
                elem[3].setAttribute("class", "icheckbox_flat-green");
            }
        }

        function pdCheck3() {
            var check = document.getElementById("chemNameCD").value;
            var elem = document.getElementsByClassName("icheckbox_flat-green");
            if (check !== "") {
                document.getElementById("pDcheck4").checked = true;
                elem[4].setAttribute("class", "icheckbox_flat-green checked");
            } else {
                document.getElementById("pDcheck4").checked = false;
                elem[4].setAttribute("class", "icheckbox_flat-green");
            }
        }

        function pdCheck4() {
            var check = document.getElementById("compNameC").value;
            var elem = document.getElementsByClassName("icheckbox_flat-green");
            if (check !== "") {
                document.getElementById("pDcheck5").checked = true;
                elem[5].setAttribute("class", "icheckbox_flat-green checked");
            } else {
                document.getElementById("pDcheck5").checked = false;
                elem[5].setAttribute("class", "icheckbox_flat-green");
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

        function pdChk6() {

            var check = document.getElementById("demograp").value;
            var elem = document.getElementsByClassName("icheckbox_flat-green");
            if (check !== "") {
                document.getElementById("pDcheck7").checked = true;
                elem[7].setAttribute("class", "icheckbox_flat-green checked");
            } else {
                document.getElementById("pDcheck7").checked = false;
                elem[7].setAttribute("class", "icheckbox_flat-green");
            }
        }

        $(function () {
            $('.multiselect-ui').multiselect({
                includeSelectAllOption: true
            });
        });


        /*var chkall = document.getElementById("checkall");

        chkall.addEventListener("click", function () {

            var elem = document.getElementsByClassName("icheckbox_flat-green");


            if (chkall.checked == true) {
                for (var i = 8; i <= elem.length; i++) {
                    elem[i].setAttribute("class", "icheckbox_flat-green checked");
                }
            }

            if (chkall.checked == false) {
                for (var i = 8; i <= elem.length; i++) {
                    elem[i].setAttribute("class", "icheckbox_flat-green");
                }
            }

        });*/

        function alertcolor() {

            var alertchk = document.getElementById("alertchk").checked;

            if (alertchk == true) {
                document.getElementById("switchoffon").innerHTML = "On";
                document.getElementById("alert_color").style.color = "red";
            } else {
                document.getElementById("alert_color").style.color = "inherit";
                document.getElementById("switchoffon").innerHTML = "Off";
            }
        }

        function clearGP() {
            var r = confirm("Are you sure want to clear all data?");
            if (r == true) {
                $('.input_fields_wrap2').find('input[type=text]').val('');
                $('.input_fields_wrap2').find('textarea').val('');
                pdCheck2();
            }

        }
        function clearCD() {
            var r = confirm("Are you sure want to clear all data?");
            if (r == true) {
                $('.input_fields_wrap3').find('input[type=text]').val('');
                $('.input_fields_wrap3').find('textarea').val('');
                pdCheck3();
            }

        }
        function clearCR() {
            debugger;
            var r = confirm("Are you sure want to clear all data?");
            if (r == true) {
                $('.input_fields_wrap4').find('input[type=text]').val('');
                $('.input_fields_wrap4').find('textarea').val('');
                pdCheck4();
            }

        }
        function clearFamily() {
            var r = confirm("Are you sure want to clear all data?");
            if (r == true) {
                $('.input_fields_wrap1').find('input[type=text]').val('');
                $('.input_fields_wrap1').find('textarea').val('');
                pdCheck1();
            }

        }

        function clearPtD() {
            var r = confirm("Are you sure want to clear all data?");
            if (r == true) {
                $('.input_fields_wrap').find('input[type=text]').val('');
                $('.input_fields_wrap').find('textarea').val('');
                pdCheck();
            }

        }



        function chkfiles() {
            debugger;
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
        /*  $(document).ready(function () {
              $(".cho-btn").click(function () {


              });
          });
          */
        function nxt_tab(a) {
            $("#" + a).click();
        }
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };
                $(".cho-btn").hide();
                $(".up-cho-btn").show();
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };
                $(".cho-btn").hide();
                $(".up-cho-btn").show();
                reader.readAsDataURL(input.files[0]);
            }
        }


        //newly added by vajesh
        $(function () {
            // Multiple images preview in browser
            var imagesPreview = function (input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;
                    var html_content = '';
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        file_name = input.files[i]['name'];
                        //   reader.onload = function (event) {
                        x = i + 1;
                        var html_content = html_content + '<tr role="row" class="odd"><td style="padding-left:8px;">' + x + '</td><td tabindex="0" class="sorting_1"><a href="#">' + file_name + '</a></td><td tabindex="0" class="sorting_1"><input type="text"></td><td><a href="#" class="btn btn-success"><i class="fa  fa-share" data-toggle="tooltip" data-title="Share Document" data-original-title="" title=""></i></a><a href="#" class="btn btn-success"><i class="fa  fa-edit" data-toggle="tooltip" data-title="Edit Title" data-original-title="" title=""></i></a><a href="#" class="btn btn-success" onclick="confirm(' + '"Are you sure want to delete document?"' + ')"><i class="fa  fa-trash" data-toggle="tooltip" data-title="Delete" data-original-title="" title=""></i></a></td></tr>';
                        //   $(placeToInsertImagePreview).append(html_content)
                        //    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        //  }
                        $("#upload_list_files").html(html_content);
                        //reader.readAsDataURL(input.files[i]);
                    }
                    $('#upload_document').show();
                }

            };
            $('#upload-file-selector').on('change', function () {
                imagesPreview(this, '#datatable-responsive');
            });

        });

        $(document).ready(function () {
           /* $('.edit-btn').click(function () {
                $('#edit-section').hide();
                $('#save-section').show();
                $('.edit-btn').hide();
                $('.save-btn').show();
            });
            $('.save-btn').click(function () {
                $('#edit-section').show();
                $('#save-section').hide();
                $('.edit-btn').show();
                $('.save-btn').hide();
            });*/
			$("#alert_point").click(function(){
					$('html, body').animate({
						scrollTop: $("#alerts").offset().top
					}, 2000);
				//$('html, body').animate({scrollTop:$(document).height()}, 'slow');
			});
		});
		 
    </script>
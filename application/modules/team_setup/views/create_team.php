	<link href="<?php echo base_url(); ?>assets/css/mutipleselect_drop.css" rel="stylesheet" />	
	
	<style>
        .up_div {
            position: relative;
            overflow: hidden;
        }

        .upload_btn{
            position: absolute;
            font-size: 50px;
            opacity: 0;
            right: 0;
            top: 0;
        }
		/**/
    </style>
            <!-- /top navigation -->
            <!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->
                <div class="form-horizontal form-label-left row">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Create Team</h2> &nbsp;&nbsp;&nbsp;<div id='alert' style="color: green;font-size: 12px;margin-top: 6px;display: inline-block;" ></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 padding-left-none">
                            <div class="panel panel-default">
                                <div class="panel-heading">Access </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Access </label>
                                        <div style="margin-top: 7px;">
											<?php
												$clinical				= '';
												$non_clinical			= '';
												$both					= '';
												$display_clinic			= '';
												$display_both		 	= '';
												if(isset($user_details) && $user_details['access_type_id']){
													if($user_details['access_type_id'] == $this->config->item('clinical')){
														$clinical		='checked';
													?>
														<style>
															.prof_type{
																display:none;
															}
														</style>
													<?php
													}else if($user_details['access_type_id'] == $this->config->item('non-clinical')){
														$non_clinical	='checked';
													?>
														<style>
															.prof_type{
																display:none;
															}
														</style>
													<?php
													}else if($user_details['access_type_id'] == $this->config->item('both')){
														$both			='checked';
														$display_clinic	= 'display:none;';
													}
												}else{
													?>
													<style>
													.prof_type{
														display:none;
													}
													</style>
											<?php
												}
											?>
                                            <label class="radio-inline">
                                                <input type="radio" id="clinical_id" name="optradio" <?php echo $clinical ?>>Clinical
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" id="non-clinical_id" name="optradio" <?php echo $non_clinical ?>>Non-Clinical
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" id="both_id" name="optradio" <?php echo $both ?>>Both
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<?php
						//echo "<pre>";
						//print_r($user_details);
						?>
						<input type="hidden" value="<?php echo (isset($user_details['primary_key']) ? $user_details['primary_key'] : '') ?>" id="primary_key" />
                        <div class="col-md-6 col-sm-12 col-xs-12 padding-right-none">
                            <div class="panel panel-default">
                                <div class="panel-heading">Personal details </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Choose:</label><span class="asterisk" style="color:red">*</span>
                                       <?php
											$role_list			= array(''=>'Select');
											if(isset($user_details['access_type_id'])){
												if($user_details['access_type_id'] == $this->config->item('clinical')){
													$role_list		= $this->common->roles_list(1);
												}else if($user_details['access_type_id'] == $this->config->item('non-clinical')){
													$role_list		= $this->common->roles_list(2);
												}else if($user_details['access_type_id'] == $this->config->item('both')){
													$role_list		= $roles;
												}else{
													$role_list		= $roles;
												}
											}
									 
											$attr	=array('class'=>'form-control','id'=>'professional_type', 'style'=>$display_clinic);
											 echo form_dropdown('professional',$role_list,(isset($user_roles['id']) ? trim($user_roles['id'],', ') : ''),$attr);
										
											$attr	=array('class'=>'multiselect-ui form-control multiservicelist multiselect-native-select','style'=>'max-height:200px;'.$display_both,'multiple'=>'multiple','id'=>'professional_type1');
											echo form_dropdown('professional[]',$role_list,(isset($user_roles['id']) ? explode(',',$user_roles['id']): ''),$attr);
										?>
									</div>
                                    <div id="subsets" class="form-group subsets hide-show-box" style="display:none;">
                                        <input type="text" class="form-control" placeholder="Select Team">
                                    </div>
                                </div>
                            </div>
                        </div>
						
                        <div class="custom_temp">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div id="Section-panel-div" class="tab-pane fade active in" style="display:none;">
                                    <p></p>
                                    <div class="x_panel">
                                        <div class="row">
										
                                            <div class="col-md-12 col-sm-12 col-xs-12 clinic-both-section padding-null">
												<form action="#" method="post" enctype="multipart/form-data" id="clinical" name ='Clinical' >
													<div class="panel-group">
														<div class="panel panel-default" style="display: block;">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Personal Profile</a>
																</h4>
															</div>
															<div class="panel">
																<div class="panel-body">
																	<div class="col-md-2 col-sm-6 col-xs-12">
																		<div class="text-center">
																			<?php
																				if(isset($user_details) &&!($user_details['img_name']) && !($user_details['img_path'])){
																			?>	
																				<img id="blah" src="<?php echo base_url(); ?>assets/img/profile-image.png" class="avg-profile-img img-circle img-thumbnail" style="height:125px;width:125px;" alt="Profile">
																			<?php
																				}else if(isset($user_details)){
																			?>
																				<img id="blah" src="<?php echo base_url().'assets/uploads/'.$user_details['img_path'].$user_details['img_name']; ?>" class="avg-profile-img img-circle img-thumbnail" style="height:125px;width:125px;" alt="Profile">
																			<?php } else{
																				?>
																				<img id="blah" src="<?php echo base_url(); ?>assets/img/profile-image.png" class="avg-profile-img img-circle img-thumbnail" style="height:125px;width:125px;" alt="Profile">
																				<?php }?>
																			<div></div>
																			<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
																				<input type="file" id="FileUpload1" class="center-block well well-sm" onchange="readURL(this);" style="width: 100px; !important;padding: 6px;">
																			</div>
																		</div>
																	</div>
																	<div class="col-md-10 col-sm-6 col-xs-12 profile-details">
																		<div class="row">
																			<div class="col-md-3 col-sm-12 col-xs-12">
																				<label>Title</label><span class="asterisk" style="color:red">*</span>
																				<div class="form-group">
																					<?php
																						$attr			= array('class'=>'form-control','id'=>'clinical_title');
																						$title_options	= array(''=>'Select','Dr'=>'Dr','Mr'=>'Mr','Ms'=>'Ms','Mrs'=>'Mrs','Miss'=>'Miss');
																						echo form_dropdown('Clinical[Title]', $title_options,(isset($user_details['title']) ? $user_details['title'] : ''),$attr);
																					?>
																				</div>
																			</div>
																			 <div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper ">
																				<label>Gender</label><span class="asterisk" style="color:red">*</span>
																				<?php
																					$attr			= array('class'=>'form-control','id'=>'clinical_gender');
																					$gender_options	= array(''=>'Select','Male'=>'Male','Female'=>'Female','Transgender'=>'Transgender');
																					echo form_dropdown('Clinical[Gender]', $gender_options,(isset($user_details['gender']) ? $user_details['gender'] : ''),$attr);
																				?>
																			</div>
																			<div class="col-md-3 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>First Name</label><span class="asterisk" style="color:red">*</span>
																					<input type="text" id="clinical_first_name" name="Clinical[FirstName]" class="form-control" placeholder="First Name" value="<?php echo (isset($user_details['firstname']) ? $user_details['firstname'] : '') ?>">
																				</div>
																			</div>
																			<div class="col-md-3 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Last Name</label><span class="asterisk" style="color:red">*</span>
																					<input type="text" id="clinical_last_name" name="Clinical[LastName]" class="form-control" placeholder="Last Name" value="<?php echo (isset($user_details['lastname']) ? $user_details['lastname'] : '') ?>">
																				</div>
																			</div>
																			<div class="col-md-3 col-sm-6 col-xs-12 form-text-wrapper">
																				<div class="form-group">
																					<label>Tel</label><span class="asterisk" style="color:red">*</span>
																					<input id="clinical_tel1" type="text"  name="Clinical[tel]" class="form-control" placeholder="+1234567890" value="<?php echo (isset($user_details['mobile']) ? $user_details['mobile'] : '') ?>">
																				</div>
																			</div>
																			<div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper ">
																				<div class="">
																					<div class="xdisplay_inputx form-group">
																						<label>DOB</label><span class="asterisk" style="color:red">*</span>
																						<input type="text" name="Clinical[dob]" class="form-control" id="datepicker2" placeholder="dd/mm/yy" onchange="ageCount('datepicker2');" value="<?php echo (isset($user_details['dob']) ? date('d/m/Y',strtotime($user_details['dob'])) : '') ?>">
																					</div>
																				</div>
																			</div>
																			<div class="col-md-2 col-sm-6 col-xs-6 form-text-wrapper ">
																				<div class="form-group">
																					<label>Age</label>
																					
																					<?php
																						$diff		='';
																						if(!empty($user_details) && $user_details['dob']){
																							$dob	= $user_details['dob'];
																							$diff 	= (date('Y') - date('Y',strtotime($dob)));
																						}else{
																							$diff	='';
																						}
																					?>
																					<input type="text" name="Clinical[age]" class="form-control" placeholder="age"id="ageId" value="<?php echo $diff; ?>" disabled>
																				</div>
																			</div>
																			<div class="col-md-4 col-sm-6 col-xs-12 form-text-wrapper">
																				<div class="form-group">
																					<label>Email</label><span class="asterisk" style="color:red">*</span>
																					<input  type="text" id="clinical_email" name="Clinical[email]" class="form-control" placeholder="Email" value="<?php echo (isset($user_details['primary_email']) ? $user_details['primary_email'] : '') ?>">
																				</div>
																			</div>
																			
																			<div class="col-md-3 col-sm-12 col-xs-12 form-text-wrapper">
																				<div class="form-group">
																					<label>Languages Spoken</label>
																					<span class="asterisk" style="color:red">*</span>
																					<?php
																						$attr	= array('class'=>'form-control multiselect-ui multiservicelist multiselect-native-select','id'=>'clinical_language_id','multiple'=>'multiple');
																						echo form_dropdown('Clinical[Language][]', $languages,(isset($user_details['languages']) ? explode(',',$user_details['languages']) : ''),$attr);
																					?>
																				</div>
																			</div>
																			
																			<div class="col-md-3 col-sm-12 col-xs-12 form-text-wrapper">
																				<div class="form-group">
																					<label>Ethinic Origin</label>
																					<span class="asterisk" style="color:red">*</span>
																					<?php
																					
																						$attr	=array('class'=>'form-control','id'=>'clinical_ethinic_id');
																						echo form_dropdown('Clinical[Ethinic]', $ethinic_details,(isset($user_details['ethinic_origin']) ? $user_details['ethinic_origin'] : ''),$attr);
																					?>
																				</div>
																			</div>
																			
																			
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	Address
																</h4>
															</div>
															<div class="panel">
																<div class="panel-body">
																	<div class="col-md-8 col-sm-12 col-xs-12 profile-details">
																		<div class="row">
																			<div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper">
																				<div class="form-group">
																					<label for="sel1">Country</label><span class="asterisk" style="color:red">*</span>
																					<?php
																						$attr	=array('class'=>'form-control','id'=>'clinical_country_id');
																						echo form_dropdown('Clinical[Country]', $country['name'],(isset($user_details['country_id']) ? $user_details['country_id'] : ''),$attr);
																					?>
																				</div>
																			</div>
																			<div class="col-md-6 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Postcode</label><span class="asterisk" style="color:red">*</span>
																					<input type="text" class="form-control" placeholder="Postcode" id="clinical_postcode" onkeyup="fill_address('clinical');" name="Clinical[Postcode]" value="<?php echo (isset($user_details['postcode']) ? $user_details['postcode'] : '') ?>"> 
																				</div>
																			</div>
																			<div class="col-md-6 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>City / Town</label><span class="asterisk" style="color:red">*</span>
																					<input type="text" class="form-control" placeholder="City / Town" id="clinical_city" name="Clinical[City]" value="<?php echo (isset($user_details['city_town']) ? $user_details['city_town'] : '') ?>">
																				</div>
																			</div>
																			<div class="col-md-6 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>State</label><span class="asterisk" style="color:red">*</span>
																					<input type="text" class="form-control" placeholder="State" id="clinical_state" name="Clinical[State]" value="<?php echo (isset($user_details['state']) ? $user_details['state'] : '') ?>">
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-4 col-sm-12 col-xs-12 form-text-wrapper">
																		<div class="form-group">
																			<label>Address</label><span class="asterisk" style="color:red">*</span>
																			<input type="text" id="clinical_address" class="form-control" onkeypress="search_address('clinical');" placeholder="Address" name="Clinical[Address]"  value="<?php echo (isset($user_details['address']) ? $user_details['address'] : '') ?>" />
																		   <!-- <textarea class="form-control" rows="5" placeholder="Address"></textarea>-->
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">Select Country of Practice( Licence to Practice ) </div>
															<div class="panel-body" style="padding-top: 22px;">
																<div class="col-md-4 col-sm-12 col-xs-12" id="prof_body">
																	<label>Select Country</label><span class="asterisk" style="color:red">*</span>
																	<div class="form-group">
																		<?php
																			if(isset($medical_bodies) && !empty($medical_bodies)){
																				$prof_medical		=(array)$medical_bodies[0];
																			}
																			//echo "<pre>";
																			//print_r($prof_medical);
																		 	$attr	=array('class'=>'form-control','id'=>'prof_country_id');
																			echo form_dropdown('Clinical[ProfCountry]', $country['name'],(isset($prof_medical['country_id']) ? $prof_medical['country_id'] : ''),$attr);
																		?>
																	</div>
																</div>
																<div class="col-md-4 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>Your Professional Details</label><span class="asterisk" style="color:red">*</span>
																		<?php
																			$attr	=array('class'=>'form-control','id'=>'Prof_id','onchange'=>'get_specialization(this);');
																			echo form_dropdown('Clinical[Professional]', $professional_body,(isset($prof_medical['professional_id']) ? $prof_medical['professional_id'] : ''),$attr);
																		?>
																	</div>
																</div>
																<div class="col-md-4 col-sm-12 col-xs-12" id="specialization" style="<?php if(isset($prof_medical['specialization_id']) && $prof_medical['specialization_id'] !=''){}else{echo 'display:none;';} ?>">
																	<div class="form-group">
																		<label>Type of specialist</label>
																		<?php
																			if(isset($prof_medical['professional_id'])){
																				$list_array		= $this->common->get_specialization($prof_medical['professional_id']);
																			}else{
																				$list_array		= array(''=>'Select');
																			}
																			$attr			= array('class'=>'form-control','id'=>'spl_body');
																			echo form_dropdown('Clinical[Specialization]', $list_array,(isset($prof_medical['specialization_id']) ? $prof_medical['specialization_id'] : ''),$attr);
																		?>
																		<!--<select id="spl_body" class="form-control" name="Clinical[Specialization]"></select>-->
																	</div>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">Professional Registration <a href="#mygmcUpload" data-toggle="modal" class="pull-right"><i class="fa fa-upload" aria-hidden="true"></i></a> </div>
															<div class="panel-body">
																<div class="col-md-4 col-sm-12 col-xs-12" id="prof_body">
																	<div class="form-group">
																		<label>Professional Body</label>
																		<?php
																			
																			if(isset($prof_medical['medical_bodies_id'])){
																				$list_array		= $this->common->register_categories($prof_medical['country_id'],$prof_medical['professional_id']);
																			}else{
																				$list_array		= array(''=>'Select');
																			}
																			$attr				= array('class'=>'form-control','id'=>'country_reg_cat');
																			//echo "<pre>";print_r($prof_medical);
																			echo form_dropdown('Clinical[CountryReg]', $list_array,(isset($prof_medical['medical_bodies_id']) ? $prof_medical['medical_bodies_id'] : ''),$attr);
																		?>
																	</div>
																</div>
																<div class="col-md-4 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>Register Number</label>
																		<input id="prof_number" type="text" name="Clinical[ProfNumber]" class="form-control" placeholder="Number" value="<?php echo(isset($prof_medical['register_number']) ? $prof_medical['register_number'] : '') ?>">
																	</div>
																</div>
																<div class="col-md-4 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>Expiry Date</label>
																		<input id="prof_expiry" type="text" name="Clinical[ProfDate]"  class="form-control" placeholder="Expiry Date" value="<?php if(isset($prof_medical['expiry_date']) && $prof_medical['expiry_date'] !='0000-00-00'){echo implode('/',array_reverse(explode('-',$prof_medical['expiry_date'])));} ?>">
																	</div>
																</div>
															</div>
														</div>
														<?php
															if(isset($other_bodies) && !empty($other_bodies)){
																foreach($other_bodies as $other_key => $other_val){
																	$other_val			= (array)$other_val;
																	if($other_val['other_bodies_id'] == $this->config->item('ico')){
																		$ico			= $other_val;
																	}else{
																		$indemnity		= $other_val;
																	}
																}
															}
														?>
														<div class="panel panel-default">
															<div class="panel-heading">ICO Registration  <a href="#myicoUpload" data-toggle="modal" class="pull-right"><i class="fa fa-upload" aria-hidden="true"></i></a></div>
															<div class="panel-body">
																<div class="col-md-4 col-sm-12 col-xs-12" id="prof_body">
																	<div class="form-group">
																		<label>Register Number</label>
																		<input id="number_ico" type="text" name="Clinical[IcoNumber]" class="form-control" placeholder="Number" value="<?php echo(isset($ico['register_number']) ? $ico['register_number'] : '') ?>">
																	</div>
																</div>
																<div class="col-md-4 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>Expiry Date</label>
																		<input id="expiry_ico" type="text" name="Clinical[IcoDate]"  class="form-control" placeholder="Expiry Date" value="<?php if(isset($ico['expiry_date']) && $ico['expiry_date'] !='0000-00-00'){echo implode('/',array_reverse(explode('-',$ico['expiry_date'])));} ?>">
																	</div>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">Indemnity  <a href="#myindemnityUpload" data-toggle="modal" class="pull-right"><i class="fa fa-upload" aria-hidden="true"></i></a></div>
															<div class="panel-body">
																<div class="col-md-4 col-sm-12 col-xs-12" id="prof_body">
																	<div class="form-group">
																		<label>Name of company</label>
																		<input id="indemnity_company" type="text" name="Clinical[IndemnityCompany]" class="form-control" placeholder="Company Name" value="<?php echo(isset($indemnity['company_name']) ? $indemnity['company_name'] : '') ?>">
																	</div>
																</div>
																<div class="col-md-4 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>Register Number</label>
																		<input id="indemnity_number" type="text" name="Clinical[IndemnityNumber]" class="form-control" placeholder="Number" value="<?php echo(isset($indemnity['register_number']) ? $indemnity['register_number'] : '') ?>">
																	</div>
																</div>
																<div class="col-md-4 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>Expiry Date</label>
																		<input id="indemnity_expiry" type="text" name="Clinical[IndemnityDate]" class="form-control" placeholder="Expiry Date" value="<?php if(isset($indemnity['expiry_date']) && $indemnity['expiry_date'] !='0000-00-00'){echo implode('/',array_reverse(explode('-',$indemnity['expiry_date'])));} ?>">
																	</div>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">Professional Details</div>
															<div class="panel-body">
																<div class="col-md-6 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>Qualifications</label>
																		<span class="asterisk" style="color:red">*</span>
																		<textarea class="form-control" rows="4" placeholder="Qualifications" id="qualifications" name='Clinical[qualifications]'><?php echo (isset($user_details['qualifications']) ? stripslashes($user_details['qualifications']) : ''); ?></textarea>
																	</div>
																</div>
																<div class="col-md-6 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>Memberships</label>
																		<textarea class="form-control" rows="4" placeholder="Memberships" id="membership" name='Clinical[membership]'><?php echo (isset($user_details['memberships']) ? stripslashes($user_details['memberships']) : '') ?></textarea>
																	</div>
																</div>
																<div class="col-md-6 col-sm-12 col-xs-12 form-text-wrapper">
																	<div class="col-md-12 col-sm-12 col-xs-12 padding-null">
																		<div class="form-group">
																			<label>Please select the services you provide</label>
																			<span class="asterisk" style="color:red">*</span>
																				<?php
																					$attr	=array('class'=>'multiselect-ui form-control multiservicelist multiselect-native-select','style'=>'max-height:200px','multiple'=>'multiple','id'=>'services');
																					echo form_dropdown('Clinical[services][]',$services,(isset($user_services) ? $user_services : ''),$attr);
																				?>
																				
																		</div>
																	</div>
																	<div class="col-md-11 col-sm-12 col-xs-12 padding-null">
																		<div class="form-group">
																			<label>Services if any</label>
																			<input type="text" class="form-control" placeholder="Other Services if any" id="new_service" name='Clinical[new_service]'>
																		</div>
																	</div>
																	<div class="col-md-1 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label></label>
																			<input type="button" id="addservice" class="btn btn-success btn-sm pull-right" style="margin-top: 4px; font-size:14px;"value="+" onclick="add_service();">
																		</div>
																	</div>
																	<div class="col-md-12 col-sm-12 col-xs-12 padding-null">
																		<div class="form-group">
																			<label>Years of Experience</label>
																			<input type="number" class="form-control" placeholder="Total years of experience"  min="1" max="15" id="exp_years" name='Clinical[exp_years]' value="<?php echo (isset($user_details['year_exp']) ? $user_details['year_exp'] : '') ?>" >
																		</div>
																	</div>
																</div>
																<div class="col-md-6 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>Professional Experience</label>
																		<textarea class="form-control" rows="4" placeholder="Professional Experience" style="height:165px;" id="professional_exp" name='Clinical[professional_exp]'><?php echo (isset($user_details['professional_exp']) ? stripslashes($user_details['professional_exp']) : '') ?></textarea>
																	</div>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">Documents </div>
															<div class="panel-body">
																<div class="col-md-12 col-sm-12 col-xs-12">
																	<div class="row">
																		<div class="col-md-4 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Upload Documents / Files</label>
																				<div class="file-input file-input-ajax-new">
																					<label class="btn btn-primary" style="margin-top: 10px;color: #fff;">
																						<input class="file-4 upload_btn" id="upload-file" name="document" type="file" multiple="">Upload
																					</label>
																				</div>
																			</div>
																		</div><div class="col-md-8 col-sm-12 col-xs-12" id="clinical_upload_document" style="display:none;">
																			<label>Uploaded Documents / Files</label>
																			<div class="list-group table-responsive">
																				<table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
																					<thead>
																						<tr role="row">
																							<th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
																							<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Files</th>
																							<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
																							<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Action</th>
																						</tr>
																					</thead>
																					<tbody id="clinical_upload_list_files" style="height: 10px !important; overflow: scroll; "></tbody>
																				</table>
																			</div>
																			
																		</div>
																	</div>
																	
																	
																	<?php if(isset($uploads_others)){
																	?>
																	<div class="row">
																		<div class="col-md-8 col-sm-12 col-xs-12" id="exist_upload_document">
																			<label>Uploaded Documents / Files</label>
																			<div class="list-group table-responsive">
																				<table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
																					<thead>
																						<tr role="row">
																							<th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
																							<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
																							<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Link</th>
																							<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Added on</th>
																						</tr>
																					</thead>
																					<tbody id="exist_upload_list_files" style="height: 10px !important; overflow: scroll; ">
																						<?php
																							if(isset($uploads_others) && !empty($uploads_others)){
																								foreach($uploads_others as $other_key => $other_val){
																									$other_val			= (array)$other_val;
																								?>
																									<tr role="row">
																										<td><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; </th>
																										<td class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending"><?php if($other_val['title']){echo $other_val['title'];} ?></td>
																										<td class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">
																											<a href="<?php echo base_url() .'assets/uploads/'.$other_val['file_path'].$other_val['file_name']; ?>" target="_blank" style="text-decoration:underline" >
																												Document Link
																											</a>
																										</td>
																										<td class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending"><?php if($other_val['modified_date']){echo date('d/m/Y H:i:s',strtotime($other_val['modified_date'])); } ?></td>
																									</tr>
																								<?php							
																								}	
																						?>
																						<?php 
																							}else{
																						?>
																						<tr role="row">
																							<td colspan="4">No records uploaded..</td>
																						</tr>
																						<?php		
																							}
																						?>
																					</tbody>
																				</table>
																			</div>
																		</div>
																	</div>
																<?php } ?>
																	
																	
																</div>
															</div>
														</div>
														<div class="actionBar">
															<a href="javascript:void(0)" class="buttonNext btn btn-success" onclick="save_cinical();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save </a>
														</div>
														
													</div>
												</form>
                                            </div>
											
											
                                            <!-- Non Clinic-->
											<form action="#" method="post" enctype="multipart/form-data" id="non_clinical"  name ='NonClinical' >
											<!--<form method="post" id="non_clinical"  name ='NonClinical' enctype='multipart/form-data'>-->
                                            <div class="col-md-12 col-sm-12 col-xs-12 noncliincal-section padding-null">
												<div class="panel-group">
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
																<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Personal Profile</a>
															</h4>
														</div>
														<div class="panel">
															<div class="panel-body">
																<div class="col-md-2 col-sm-6 col-xs-12">
																	<div class="text-center">
																		
																		<!--<img id="non_img" src="<?php echo base_url(); ?>assets/img/profile-image.png" class="avg-profile-img img-circle img-thumbnail" alt="avatar">-->
																		<?php
																			if(isset($user_details) && !($user_details['img_name']) && !($user_details['img_path'])){
																		?>	
																			<img id="blah" src="<?php echo base_url(); ?>assets/img/profile-image.png" class="avg-profile-img img-circle img-thumbnail" style="height:125px;width:125px;" alt="Profile">
																		<?php
																			}else if(isset($user_details)){
																		?>
																			<img id="blah" src="<?php echo base_url().'assets/uploads/'.$user_details['img_path'].$user_details['img_name']; ?>" class="avg-profile-img img-circle img-thumbnail" style="height:125px;width:125px;" alt="Profile">
																		<?php 
																			}else {
																		?>
																			<img id="blah" src="<?php echo base_url(); ?>assets/img/profile-image.png" class="avg-profile-img img-circle img-thumbnail" style="height:125px;width:125px;" alt="Profile">
																		<?php } ?>
																		<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
																			<input type="file" id="FileUpload1" class="center-block well well-sm" name="profile" onchange="readURL(this,'non');" style="width: 100px; !important;padding: 6px;">
																		</div>
																	</div>
																</div>
																<div class="col-md-10 col-sm-6 col-xs-12 profile-details">
																	<div class="row">
																		<div class="col-md-3 col-sm-12 col-xs-12">
																			<label>Title</label><span class="asterisk" style="color:red">*</span>
																			<div class="form-group">
																			   <!-- <select class="form-control">
																					<option>Title</option>
																					<option>Mr</option>
																					<option>Ms</option>
																					<option>Mrs</option>
																					<option>Miss</option>
																				</select> -->
																				<?php
																					$attr	=array('class'=>'form-control','id'=>'non_title');
																					echo form_dropdown('NonClinical[title]' , $title_options,(isset($user_details['title']) ? $user_details['title'] : ''),$attr);
																				?>
																			</div>
																		</div>
																		<div class="col-md-4 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>First Name</label><span class="asterisk" style="color:red">*</span>
																				<input type="text" id="non_firstname" class="form-control" name='NonClinical[firstname]' placeholder="First Name" value="<?php echo (isset($user_details['firstname']) ? $user_details['firstname'] : '') ?>">
																			</div>
																		</div>
																		<div class="col-md-5 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Last Name</label><span class="asterisk" style="color:red">*</span>
																				<input id="non_lastname" type="text" class="form-control" name='NonClinical[lastname]' placeholder="Last Name" value="<?php echo (isset($user_details['lastname']) ? $user_details['lastname'] : '') ?>">
																			</div>
																		</div>
																		<div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper ">
																			<label>Gender</label><span class="asterisk" style="color:red">*</span>
																			<!--<select class="form-control">
																				<option>Male</option>
																				<option>Female</option>
																				<option>Transgender</option>
																			</select>--->
																			<?php
																				$attr	=array('class'=>'form-control','id'=>'non_gender');
																				$title_options	= array(''=>'Select','Male'=>'Male','Female'=>'Female','Transgender'=>'Transgender');
																				echo form_dropdown('NonClinical[gender]', $title_options,(isset($user_details['gender']) ? $user_details['gender'] : ''),$attr);
																			?>
																		</div>
																		<div class="col-md-2 col-sm-6 col-xs-6 form-text-wrapper ">
																			<div class="">
																				<div class="xdisplay_inputx form-group">
																					<label>DOB</label><span class="asterisk" style="color:red">*</span>
																					<input type="text" class="form-control" name='NonClinical[dob]' id="datepicker3" placeholder="dd/mm/yy" onchange="ageCount('datepicker3');" value="<?php echo (isset($user_details['dob']) ? date('d/m/Y',strtotime($user_details['dob'])) : '')   ?>">
																				</div>
																			</div>
																		</div>
																		<div class="col-md-2 col-sm-6 col-xs-6 form-text-wrapper ">
																			<div class="form-group">
																				<label>Age</label>
																				<input id="non_age_id" type="text" class="form-control"  placeholder="age" disabled value="<?php echo $diff; ?>">
																			</div>
																		</div>
																		<div class="col-md-2 col-sm-6 col-xs-12 form-text-wrapper">
																			<div class="form-group">
																				<label>Tel</label><span class="asterisk" style="color:red">*</span>
																				<input id="non_tel" type="text" class="form-control" name='NonClinical[tel]' placeholder="+1234567890" value="<?php echo (isset($user_details['mobile']) ? $user_details['mobile'] : ''); ?>">
																			</div>
																		</div>
																		<div class="col-md-3 col-sm-6 col-xs-12 form-text-wrapper">
																			<div class="form-group">
																				<label>Email</label><span class="asterisk" style="color:red">*</span>
																				<input id="non_emailId" type="email" class="form-control" name='NonClinical[email]' placeholder="Email" value="<?php echo (isset($user_details['primary_email']) ? $user_details['primary_email'] : ''); ?>" <?php if(isset($user_details) && !empty($user_details)){echo "disabled";} ?>>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title">
																Address
															</h4>
														</div>
														<div class="panel">
															<div class="panel-body">

																<div class="col-md-8 col-sm-12 col-xs-12 profile-details">
																	<div class="row">
																		<div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper">
																			<div class="form-group">
																				<label for="sel1">Country</label><span class="asterisk" style="color:red">*</span>
																				<?php
																					$attr	=array('class'=>'form-control','id'=>'non_country_id');
																					echo form_dropdown('NonClinical[country_id]', $country['name'],(isset($user_details['country_id']) ? $user_details['country_id'] : ''),$attr);
																				?>
																			</div>
																		</div>
																		<div class="col-md-6 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Postcode</label><span class="asterisk" style="color:red">*</span>
																				<input type="text" class="form-control" name='NonClinical[postcode]' placeholder="Postcode" id="non_postcode" onkeyup="fill_address('non');" value="<?php echo (isset($user_details['postcode']) ? $user_details['postcode'] : '') ?>">
																			</div>
																		</div>
																		<div class="col-md-6 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>City / Town</label><span class="asterisk" style="color:red">*</span>
																				<input type="text" class="form-control" name='NonClinical[city]' placeholder="City / Town" id="non_city" value="<?php echo (isset($user_details['city_town']) ? $user_details['city_town'] : '') ?>">
																			</div>
																		</div>
																		<div class="col-md-6 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>State</label><span class="asterisk" style="color:red">*</span>
																				<input type="text" class="form-control" name='NonClinical[state]' placeholder="State" id="non_state" value="<?php echo (isset($user_details['state']) ? $user_details['state'] : '') ?>">
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-md-4 col-sm-12 col-xs-12 form-text-wrapper">
																	<div class="form-group">
																		<label>Address</label><span class="asterisk" style="color:red">*</span>
																		<input type="text" class="form-control" name='NonClinical[address]' placeholder='Address' id="non_address" onkeypress="search_address('non');" value="<?php echo (isset($user_details['address']) ? $user_details['address'] : '') ?>"  />
																		<!--<textarea class="form-control" rows="5" name='NonClinical[addre]' placeholder="Address"></textarea>-->
																	</div>
																</div>
															</div>
														</div>
													</div>

													<div class="panel panel-default">
														<div class="panel-heading">Documents </div>
														<div class="panel-body">
															<div class="col-md-12 col-sm-12 col-xs-12">
																<div class="row">
																
																	<div class="col-md-4 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Upload Documents / Files</label>
																			<div class="file-input file-input-ajax-new up_div">
																				<label class="btn btn-primary" style="margin-top: 10px;padding: 5px 13px 13px;color: #fff;">
																				<input class="file-4 upload_btn" id="upload-file-selector" name='non_document' type="file" multiple>Upload
																				</label>
																			</div>
																		</div>
																	</div>
																	
																	<div class="col-md-8 col-sm-12 col-xs-12" id="non_upload_document" style="display:none;">
																		<label>Choosen Documents / Files</label>
																		<div class="list-group table-responsive">
																			<table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
																				<thead>
																					<tr role="row">
																						<th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
																						<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Files</th>
																						<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
																						<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Action</th>
																					</tr>
																				</thead>
																				<tbody id="non_upload_list_files" style="height: 10px !important; overflow: scroll; "></tbody>
																			</table>
																		</div>
																	</div>
																	
																</div>
																
																<?php if(isset($uploads_others)){
																	?>
																	<div class="row">
																		<div class="col-md-8 col-sm-12 col-xs-12" id="non_exist_upload_document">
																			<label>Uploaded Documents / Files</label>
																			<div class="list-group table-responsive">
																				<table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
																					<thead>
																						<tr role="row">
																							<th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
																							<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
																							<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Link</th>
																							<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Added on</th>
																						</tr>
																					</thead>
																					<tbody id="non_exist_upload_list_files" style="height: 10px !important; overflow: scroll; ">
																						<?php
																							if(isset($uploads_others) && !empty($uploads_others)){
																								foreach($uploads_others as $other_key => $other_val){
																									$other_val			= (array)$other_val;
																								?>
																									<tr role="row">
																										<td><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; </th>
																										<td class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending"><?php if($other_val['title']){echo $other_val['title'];} ?></td>
																										<td class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">
																											<a href="<?php echo base_url() .'assets/uploads/'.$other_val['file_path'].$other_val['file_name']; ?>" target="_blank" style="text-decoration:underline" >
																												Document Link
																											</a>
																										</td>
																										<td class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending"><?php if($other_val['modified_date']){echo date('d/m/Y H:i:s',strtotime($other_val['modified_date'])); } ?></td>
																									</tr>
																								<?php							
																								}			
																							}else{
																						?>
																								<tr role="row">
																									<td colspan="4">No records uploaded..</td>
																								</tr>
																						<?php		
																							}
																						?>
																					</tbody>
																				</table>
																			</div>
																		</div>
																	</div>
																<?php } ?>
															</div>
															
															
														</div>
													</div>
													<div class="actionBar">
														<a href="javascript:void(0)" class="buttonNext btn btn-success" onclick="save_details();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save </a>
													</div>
												</div>
											</div>
										</form>
											
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
                <!-- /top tiles -->
            </div>
            <!-- /page content -->
            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    <p>&copy;2017 All Rights Reserved. <a href="https://coraltechnologies.co.uk/" target="_blank">Coral Technologies!</a></p>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>
    <!-- Modals -->
    <!-- Modal GMC Upload-->
    <div class="modal fade" id="mygmcUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> x </button>
                    <h4 class="modal-title" id="myModalLabel">Professional Registration Document</h4>
                </div>
                <div class="modal-body">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="imageupload-gmc">
								<div class="file-tab" id="FileAttr">
									<label class="btn btn-default btn-file">
										<span>Browse</span>
										<!-- The file is stored here. -->
										<input type="file" name="image-file" class="upload_btn" id="professional_document">
									</label>
								  
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12" id="prof_upload_document" style="display:none;">
							<label>Uploaded Documents / Files</label>
							<div class="list-group table-responsive">
								<table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
									<thead>
										<tr role="row">
											<th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
											<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Files</th>
											<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
											<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Action</th>
										</tr>
									</thead>
									<tbody id="prof_upload_list_files" style="height: 10px !important; overflow: scroll; "></tbody>
								</table>
							</div>
						</div>
					</div>
					
					<?php if(isset($uploads_medical)){ ?>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12" id="non_exist_upload_document">
								<label>Uploaded Documents / Files</label>
								<div class="list-group table-responsive">
									<table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
										<thead>
											<tr role="row">
												<th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
												<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
												<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Link</th>
												<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Added on</th>
											</tr>
										</thead>
										<tbody id="non_exist_upload_list_files" style="height: 10px !important; overflow: scroll; ">
											<?php
												if(isset($uploads_medical) && !empty($uploads_medical)){
													$cnt	=  0;
													foreach($uploads_medical as $up_key => $up_val){
														$up_val			= (array)$up_val;
														if($up_val['medical_bodies']){
															
														?>
														<tr role="row">
															<td><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; </th>
															<td class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending"><?php if($up_val['title']){echo $up_val['title'];} ?></td>
															<td class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">
																<a href="<?php echo base_url() .'assets/uploads/'.$up_val['file_path'].$up_val['file_name']; ?>" target="_blank" style="text-decoration:underline" >
																	Document Link
																</a>
															</td>
															<td class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending"><?php if($up_val['modified_date']){echo date('d/m/Y H:i:s',strtotime($up_val['modified_date'])); } ?></td>
														</tr>
														<?php
														$cnt++;
														}
														if($cnt == 0 ){
														?>
															<tr role="row">
																<td colspan="4">No records uploaded..</td>
															</tr>
														<?php
														}
													}	
												}else{
											?>
											<tr role="row">
												<td colspan="4">No records uploaded..</td>
											</tr>
											<?php		
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					<?php } ?>
					
					
				</div>
            </div>
        </div>
    </div>
    <!-- Modals ICO Upload -->
    <!-- Modal -->
    <div class="modal fade" id="myicoUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> x </button>
                    <h4 class="modal-title" id="myModalLabel">ICO Registration Document</h4>
                </div>
                <div class="modal-body">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="imageupload">
								<div class="file-tab">
									<label class="btn btn-default btn-file">
										<span>Browse</span>
										<!-- The file is stored here. -->
										<input type="file" name="image-file" class="upload_btn" id="ico_document" >
									</label>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12" id="ico_upload_document" style="display:none;">
							<label>Choosen Documents / Files</label>
							<div class="list-group table-responsive">
								<table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
									<thead>
										<tr role="row">
											<th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
											<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Files</th>
											<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
											<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Action</th>
										</tr>
									</thead>
									<tbody id="ico_upload_list_files" style="height: 10px !important; overflow: scroll; "></tbody>
								</table>
							</div>
						</div>
					</div>
					
					<?php if(isset($uploads_medical)){ ?>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12" id="non_exist_upload_document">
								<label>Uploaded Documents / Files</label>
								<div class="list-group table-responsive">
									<table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
										<thead>
											<tr role="row">
												<th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
												<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
												<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Link</th>
												<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Added on</th>
											</tr>
										</thead>
										<tbody id="non_exist_upload_list_files" style="height: 10px !important; overflow: scroll; ">
											<?php
												if(isset($uploads_medical) && !empty($uploads_medical)){
													$cnt	=  0;
													foreach($uploads_medical as $up_key => $up_val){
														$up_val			= (array)$up_val;
														if($up_val['other_bodies_id'] && $up_val['other_bodies_id'] == $this->config->item('ico')){
															
														?>
														<tr role="row">
															<td><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; </th>
															<td class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending"><?php if($up_val['title']){echo $up_val['title'];} ?></td>
															<td class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">
																<a href="<?php echo base_url() .'assets/uploads/'.$up_val['file_path'].$up_val['file_name']; ?>" target="_blank" style="text-decoration:underline" >
																	Document Link
																</a>
															</td>
															<td class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending"><?php if($up_val['modified_date']){echo date('d/m/Y H:i:s',strtotime($up_val['modified_date'])); } ?></td>
														</tr>
														<?php
														$cnt++;
														}
													}
													if($cnt == 0 ){
													?>
														<tr role="row">
															<td colspan="4">No records uploaded..</td>
														</tr>
													<?php
													}
													
											?>
											<?php 
												}else{
											?>
											<tr role="row">
												<td colspan="4">No records uploaded..</td>
											</tr>
											<?php		
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					<?php } ?>
					
				</div>
			</div>
        </div>
    </div>
    <!-- Modals upload -->
    <!-- Modal  Indemnity Upload-->
    <div class="modal fade" id="myindemnityUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> x </button>
                    <h4 class="modal-title" id="myModalLabel">Indemnity Document</h4>
                </div>
                <div class="modal-body">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="imageupload">
								<div class="file-tab" id="FileAttr">
									<label class="btn btn-default btn-file">
										<span>Browse</span>
										<!-- The file is stored here. -->
										<input type="file" name="image-file" class="upload_btn" id="indemnity_document">
									</label>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12" id="indemnity_upload_document" style="display:none;">
							<label>Choosen Documents / Files</label>
							<div class="list-group table-responsive">
								<table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
									<thead>
										<tr role="row">
											<th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
											<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Files</th>
											<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
											<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Action</th>
										</tr>
									</thead>
									<tbody id="indemnity_upload_list_files" style="height: 10px !important; overflow: scroll; "></tbody>
								</table>
							</div>
						</div>
					</div>
					
					<?php if(isset($uploads_medical)){ ?>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12" id="non_exist_upload_document">
								<label>Uploaded Documents / Files</label>
								<div class="list-group table-responsive">
									<table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
										<thead>
											<tr role="row">
												<th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
												<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
												<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Link</th>
												<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Added on</th>
											</tr>
										</thead>
										<tbody id="non_exist_upload_list_files" style="height: 10px !important; overflow: scroll; ">
											<?php
												if(isset($uploads_medical) && !empty($uploads_medical)){
													$cnt	=  0;
													foreach($uploads_medical as $up_key => $up_val){
														$up_val			= (array)$up_val;
														if($up_val['other_bodies_id'] && $up_val['other_bodies_id'] == $this->config->item('indemnity')){
															
														?>
														<tr role="row">
															<td><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; </th>
															<td class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending"><?php if($up_val['title']){echo $up_val['title'];} ?></td>
															<td class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">
																<a href="<?php echo base_url() .'assets/uploads/'.$up_val['file_path'].$up_val['file_name']; ?>" target="_blank" style="text-decoration:underline" >
																	Document Link
																</a>
															</td>
															<td class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending"><?php if($up_val['modified_date']){echo date('d/m/Y H:i:s',strtotime($up_val['modified_date'])); } ?></td>
														</tr>
														<?php
														$cnt++;
														}
													}
													if($cnt == 0 ){
													?>
														<tr role="row">
															<td colspan="4">No records uploaded..</td>
														</tr>
													<?php
													}
											?>
											<?php 
												}else{
											?>
											<tr role="row">
												<td colspan="4">No records uploaded..</td>
											</tr>
											<?php		
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					<?php } ?>
					
				</div>
            </div>
        </div>
    </div>
    <!-- Modals -->
    <!-- popup Models-->
    <!-- jQuery -->
    
	<script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/drop-down.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/multiple-select.js"></script>	
<?php
		$list				= '';
		$country_list		= '';
		$country_l			= '';
		$country_code		= '';
		foreach($professional_body as $key => $val){
			$list			= $list.'<option value="'.$key.'">'.$val.'</option>';
		}
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
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyB30YkpVyTfcPsQkwNiiBLE2a-C5EHYFSA&libraries=places"></script>
    <script>
	var non_clinical_arr		= [];
	var clinical_arr			= [];

	<?php
		$non_clinical_arr		= $this->common->roles_list(1);
		$clinical_arr			= $this->common->roles_list(2);
		$i						= 1;
		foreach($non_clinical_arr as $non_key => $non_val){
			if($non_key !=''){
	?>
			non_clinical_arr[<?php echo $i ?>]			= '<?php echo $non_key; ?>';
	<?php
			$i++;
			}
		}
		$i						= 1;
		foreach($clinical_arr as $cl_key => $cl_val){
			if($cl_key !=''){
	?>
			clinical_arr[<?php echo $i ?>]			= '<?php echo $cl_key; ?>';
	<?php
			$i++;
			}
		}
	?>
		$(function () {
			$('.multiservicelist').each(function() {
				if($(this).attr('id') == 'clinical_language_id'){
					$(this).multiselect({
						includeSelectAllOption: true,
						maxHeight: 200,
						buttonClass: 'btn btn-default lang'
					});
				}else if($(this).attr('id') == 'services'){
					$(this).multiselect({
						includeSelectAllOption: true,
						maxHeight: 200,
						buttonClass: 'btn btn-default service'
					});
				}else if($(this).attr('id') == 'professional_type1'){
					$(this).multiselect({
						includeSelectAllOption: true,
						maxHeight: 200,
						buttonClass: 'btn btn-default prof_type'
					});
				}else{
					$(this).multiselect({
						includeSelectAllOption: true,
						maxHeight: 200,
					});
				}
				
			});
            $('.multiselect-ui').multiselect({
                includeSelectAllOption: true,
			});
		});
		
		$("#clinical_tel1,#non_tel").keypress(function(e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 43 && e.which > 31 ) {
				return false;
			}
		});
	
		
		function fill_address(type){
			var code 	 							= $('#'+type+'_postcode').val();
			var country  							= $('#'+type+'_country_id').val();
			//alert(country);
			if(country == ''){
				alert('Please Choose Country..');
				return false;
			}else if(code.trim()	== ''){
				$('#'+type+'_state').val('');
				$('#'+type+'_city').val('');
				$('#'+type+'_address').val('');
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
						$('#'+type+'_city').val('');
						$('#'+type+'_state').val('');
						$('#'+type+'_address').val('');
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
										$('#'+type+'_city').val(address[add_len	- cnt].long_name);
									}
									cnt--;
								}
							}
							if(address[add_len - cnt]){
								if(address[add_len - cnt].long_name.length > 0){
									$('#'+type+'_state').val(address[add_len - cnt].long_name);
								}
							}
						}
					}else{
						$('#'+type+'_state').val('');
						$('#'+type+'_city').val('');
						$('#'+type+'_address').val('');
					}
				});
			}
		}
		function search_address(type){
			var country  							= $("#"+type+"_country_id").val();
			var code 	 							= $("#"+type+"_zipcode").val();
			var country_name						= new Array();
			<?php echo $country_code; ?>
			var options = {
							address :code,
							componentRestrictions: {country:country_name[country]}
						  };
			if(country.trim()  ==''){
				alert("Please select a country");
				$("#"+type+"_address").val('');
			}else{
				var places 							= new google.maps.places.Autocomplete(document.getElementById(type+'_address'),options);
				google.maps.event.addListener(places, 'place_changed', function () {
					var place 						= places.getPlace();
					var address 					= place.formatted_address;
					var latitude 					= place.geometry.location.A;
					var longitude 					= place.geometry.location.F;
			   });
			}
		}
		
		function save_details(){
			var data 									= new FormData();
			var form 									= $('#non_clinical');
			var access_type								= $('input[name=optradio]:checked').attr('id');
			if($("#professional_type").val() == ""){
				$("#professional_type").focus();
				$("#professional_type").css('border','1px solid #ff1a1c');
			}else if($("#non_title").val() == ""){
				$("#non_title").focus();
				$("#non_title").css('border','1px solid #ff1a1c');
			}else if($("#non_firstname").val() == ""){
				$("#non_firstname").focus();
				$("#non_firstname").css('border','1px solid #ff1a1c');
			}else if($("#non_lastname").val() == ""){
				$("#non_lastname").focus();
				$("#non_lastname").css('border','1px solid #ff1a1c');
			}else if($("#non_gender").val() == ""){
				$("#non_gender").focus();
				$("#non_gender").css('border','1px solid #ff1a1c');
			}else if($("#datepicker3").val() == ""){
				$("#datepicker3").focus();
				$("#datepicker3").css('border','1px solid #ff1a1c');
			}else if($("#non_tel").val() == ""){
				$("#non_tel").focus();
				$("#non_tel").css('border','1px solid #ff1a1c');
			}else if($("#non_emailId").val() == ""){
				$("#non_emailId").focus();
				$("#non_emailId").css('border','1px solid #ff1a1c');
			}else if($("#non_country_id").val() == ""){
				$("#non_country_id").focus();
				$("#non_country_id").css('border','1px solid #ff1a1c');
			}else if($("#non_postcode").val() == ""){
				$("#non_postcode").focus();
				$("#non_postcode").css('border','1px solid #ff1a1c');
			}else if($("#non_address").val() == ""){
				$("#non_address").focus();
				$("#non_address").css('border','1px solid #ff1a1c');
			}else if($("#non_city").val() == ""){
				$("#non_city").focus();
				$("#non_city").css('border','1px solid #ff1a1c');
			}else if($("#non_state").val() == ""){
				$("#non_state").focus();
				$("#non_state").css('border','1px solid #ff1a1c');
			}else{
				if($("#primary_key").length > 0){
					data.append('primary_key', $("#primary_key").val());
				}
				var form_data 								= $(form).serializeArray();
				$.each(form_data, function (key, input) {
					data.append(input.name, input.value);
				});

				var file_data 								= $('input[name="non_document"]')[0].files;
				for (var i = 0; i < file_data.length; i++) {
					if($("#non_file_row_text_"+i).length >0){
						data.append("document[]", file_data[i]);
					}
				}
				if($('input[name="profile"]')[0].files.length > 0){
					var prof_file 							= $('input[name="profile"]')[0].files;
					data.append("prof", prof_file[0]);
				}
				data.append("access_type",access_type);
				data.append("user_role",$("#professional_type").val());
				var url										= "<?php echo base_url(); ?>team_setup/non_clinic_registration";
				$.ajax({
					url: url,
					type: 'POST',
					data: data,
					processData: false,
					contentType: false,
					dataType: "json",
					success: function(data){
						if(data.response.trim() == 'success'){
							$("#non_img").attr('src','<?php echo base_url(); ?>assets/img/profile-image.png');
							document.getElementById("non_clinical").reset();
							$('#non_upload_document').hide();
							$('#non_upload_list_files').html('');
							$('#Section-panel-div').hide();
							$('#professional_type').val('');
							$('#professional_type').css('border','1px solid #ccc');
							$("#professional_type").html('');
							$('input').css('border','1px solid #ccc');
							$('select').css('border','1px solid #ccc');
							$('#non-clinical_id').prop('checked', false);
							$('#alert').html('User Created successfully..');
							var url								= "<?php echo base_url() ?>team_setup/manage_team/"+data.user_key.trim();
							window.location.href 				= url; 
						}else if(data.response.trim()=='exist'){
							alert('Please choose different Email Id..');
							$("#non_emailId").focus();
							$("#non_emailId").css('border','1px solid #ff1a1c');
						}else{
							alert('Please try after sometime..');
						}
					}
				});
			}
		}
		
		function save_cinical(){
			var data 									= new FormData();
			var form 									= $('#clinical'); 
			var access_type								= $('input[name=optradio]:checked').attr('id');
			if($("#clinical_title").val() == ""){
				$("#clinical_title").focus();
				$("#clinical_title").css('border','1px solid #ff1a1c');
			}else if($("#clinical_gender").val() == ""){
				$("#clinical_gender").focus();
				$("#clinical_gender").css('border','1px solid #ff1a1c');
			}else if($("#clinical_first_name").val() == ""){
				$("#clinical_first_name").focus();
				$("#clinical_first_name").css('border','1px solid #ff1a1c');
			}else if($("#clinical_last_name").val() == ""){
				$("#clinical_last_name").focus();
				$("#clinical_last_name").css('border','1px solid #ff1a1c');
			}else if($("#clinical_tel1").val() == ""){
				$("#clinical_tel1").focus();
				$("#clinical_tel1").css('border','1px solid #ff1a1c');
			}else if($("#datepicker2").val() == ""){
				$("#datepicker2").focus();
				$("#datepicker2").css('border','1px solid #ff1a1c');
			}else if($("#clinical_email").val() == ""){
				$("#clinical_email").focus();
				$("#clinical_email").css('border','1px solid #ff1a1c');
			}else if($("#clinical_language_id").val() == "" || $("#clinical_language_id").val() == null){
				$(".lang").focus();
				$(".lang").css('border','1px solid #ff1a1c');
			}else if($("#clinical_ethinic_id").val() == ""){
				$("#clinical_ethinic_id").focus();
				$(clinical_ethinic_id).css('border','1px solid #ff1a1c');
			}else if($("#clinical_country_id").val() == ""){
				$("#clinical_country_id").focus();
				$("#clinical_country_id").css('border','1px solid #ff1a1c');
			}else if($("#clinical_postcode").val() == ""){
				$("#clinical_postcode").focus();
				$("#clinical_postcode").css('border','1px solid #ff1a1c');
			}else if($("#clinical_address").val() == ""){
				$("#clinical_address").focus();
				$("#clinical_address").css('border','1px solid #ff1a1c');
			}else if($("#clinical_city").val() == ""){
				$("#clinical_city").focus();
				$("#clinical_city").css('border','1px solid #ff1a1c');
			}else if($("#clinical_state").val() == ""){
				$("#clinical_state").focus();
				$("#clinical_state").css('border','1px solid #ff1a1c');
			}else if($("#prof_country_id").val() == ""){
				$("#prof_country_id").focus();
				$("#prof_country_id").css('border','1px solid #ff1a1c');
			}else if($("#Prof_id").val() == ""){
				$("#Prof_id").focus();
				$("#Prof_id").css('border','1px solid #ff1a1c');
			}else if($("#country_reg_cat").val() == ""){
				$("#country_reg_cat").focus();
				$("#country_reg_cat").css('border','1px solid #ff1a1c');
			}else if($("#prof_number").val() == ""){
				$("#prof_number").focus();
				$("#prof_number").css('border','1px solid #ff1a1c');
			}else if($("#prof_expiry").val() == ""){
				$("#prof_expiry").focus();
				$("#prof_expiry").css('border','1px solid #ff1a1c');
			}else if($("#qualifications").val() == ""){
				$("#qualifications").focus();
				$("#qualifications").css('border','1px solid #ff1a1c');
			}else if($("#services").val() == '' ||$("#services").val() == null){
				$(".service").focus();
				$(".service").css('border','1px solid #ff1a1c');
			}else{
				if($("#primary_key").length > 0){
					data.append('primary_key', $("#primary_key").val());
				}
				var form_data 								= $(form).serializeArray();
				$.each(form_data, function (key, input) {
					data.append(input.name, input.value);
				});
				var file_data 								= $('input[name="document"]')[0].files;
				for (var i = 0; i < file_data.length; i++) {
					if($("#clinical_file_row_text_"+i).length >0){
						data.append("document[]", file_data[i]);
					}
				}
				
				var prof_doc 								= $('#professional_document')[0].files;
				var ico_doc 								= $('#ico_document')[0].files;
				var indemnity_doc 							= $('#indemnity_document')[0].files;
				if($('#FileUpload1')[0].files.length > 0){
					var prof_file 								= $('#FileUpload1')[0].files;
					data.append("prof", prof_file[0]);
				}
				if($("#prof_file_row_text_0").length > 0){
					data.append("prof_doc",prof_doc[0]);
					data.append("prof_text",$("#prof_file_row_text_0").val());
				}
				if($("#ico_file_row_text_0").length > 0){
					data.append("ico_doc",ico_doc[0]);
					data.append("ico_text",$("#ico_file_row_text_0").val());
				}
				if($("#indemnity_file_row_text_0").length > 0){
					data.append("indemnity_doc",indemnity_doc[0]);
					data.append("indemnity_text",$("#indemnity_file_row_text_0").val());
				}
				data.append("access_type",access_type);
				if(access_type == 'both_id'){
					var prof_val		= $("#professional_type1").val();
					var cl				= false;
					var non_cl			= false;
					for(var i =0;i < prof_val.length;i++){
						if(jQuery.inArray(prof_val[i],non_clinical_arr) > 0){
							cl		= true;
						}
						if(jQuery.inArray(prof_val[i],clinical_arr) > 0){
							non_cl	= true;
						}
					}
					if($("#professional_type1").val() == "" ){
						$(".prof_type").focus();
						$(".prof_type").css('border','1px solid #ff1a1c');
						return false;
					}else if(cl == false || non_cl == false){
						alert('Please choose atleast one Clinical and one Non-Clinical role');
						$(".prof_type").focus();
						$(".prof_type").css('border','1px solid #ff1a1c');
						return false;
					}else{
						data.append("user_role",$("#professional_type1").val());
					}
				}else{
					if($("#professional_type").val() == "" ){
						$("#professional_type").focus();
						$("#professional_type").css('border','1px solid #ff1a1c');
						return false;
					}else{
						data.append("user_role",$("#professional_type").val());
					}
				}
				
				var url										= "<?php echo base_url(); ?>team_setup/clinic_registration";
				
				if($("#prof_country_id").val() == <?php echo $this->config->item('uk_country_code') ?>){
					if($("#number_ico").val() ==''){
						$("#number_ico").focus();
						$("#number_ico").css('border','1px solid #ff1a1c');
					}else if($("#expiry_ico").val() ==''){
						$("#expiry_ico").focus();
						$("#expiry_ico").css('border','1px solid #ff1a1c');
					}else if($("#indemnity_company").val() ==''){
						$("#indemnity_company").focus();
						$("#indemnity_company").css('border','1px solid #ff1a1c');
					}else if($("#indemnity_number").val() ==''){
						$("#indemnity_number").focus();
						$("#indemnity_number").css('border','1px solid #ff1a1c');
					}else if($("#indemnity_expiry").val() ==''){
						$("#indemnity_expiry").focus();
						$("#indemnity_expiry").css('border','1px solid #ff1a1c');
					}else{
						$.ajax({
							url: url,
							type: 'POST',
							data: data,
							processData: false,
							contentType: false,
							dataType: "json",
							success: function(data){
								if(data.response.trim() == 'success'){
									$("#blah").attr('src','<?php echo base_url(); ?>assets/img/profile-image.png');
									document.getElementById("clinical").reset();
									$('#prof_upload_document').hide();
									$('#ico_upload_document').hide();
									$('#indemnity_upload_document').hide();
									$('#prof_upload_list_files').html('');
									$('#ico_upload_list_files').html('');
									$('#indemnity_upload_list_files').html('');
									$('#Section-panel-div').hide();
									$('#professional_type').val('');
									$('.prof_type').attr('title','');
									$('.prof_type').html('<span class="multiselect-selected-text">None selected</span> <b class="caret"></b>');
									$('#professional_type1').css('border','1px solid #ccc');
									$('#professional_type1').html('');
									$('#professional_type').hide();
									$('textarea').css('border','1px solid #ccc');
									$('#specialization').hide();
									$('.service').attr('title','');
									$('.service').html('<span class="multiselect-selected-text">None selected</span> <b class="caret"></b>');
									$('.prof_type').attr('title','Select');
									$('.prof_type').html('<span class="multiselect-selected-text">None selected</span> <b class="caret"></b>');
									$('.lang').attr('title','Select');
									$('.lang').html('<span class="multiselect-selected-text">None selected</span> <b class="caret"></b>');
									$('input').css('border','1px solid #ccc');
									$('select').css('border','1px solid #ccc');
									$('#clinical_id').prop('checked', false);
									$('#alert').html('User Created successfully..');
									var url								= "<?php echo base_url() ?>team_setup/manage_team/"+data.user_key.trim();
									window.location.href 				= url; 
								}else if(data.response.trim()=='exist'){
									alert('Please choose different Email Id..');
									$("#non_emailId").focus();
									$("#non_emailId").css('border','1px solid #ff1a1c');
								}else{
									alert('Please try after sometime..');
								}
							}
						});
					}
				}else{
					$.ajax({
						url: url,
						type: 'POST',
						data: data,
						processData: false,
						contentType: false,
						dataType: "json",
						success: function(data){
							//console.log(data);
							if(data.response.trim() == 'success'){
								$("#blah").attr('src','<?php echo base_url(); ?>assets/img/profile-image.png');
								document.getElementById("clinical").reset();
								$('#prof_upload_document').hide();
								$('#ico_upload_document').hide();
								$('#indemnity_upload_document').hide();
								$('#prof_upload_list_files').html('');
								$('#ico_upload_list_files').html('');
								$('#indemnity_upload_list_files').html('');
								$('#Section-panel-div').hide();
								//$('#professional_type').show();
								$('#professional_type').hide();
								$('#professional_type').val('');
								$('.prof_type').attr('title','');
								$('.prof_type').html('<span class="multiselect-selected-text">None selected</span> <b class="caret"></b>');
								$('#professional_type1').css('border','1px solid #ccc');
								$('#professional_type1').html('');
								$('textarea').css('border','1px solid #ccc');
								$('#specialization').hide();
								$('.service').attr('title','');
								$('.service').html('<span class="multiselect-selected-text">None selected</span> <b class="caret"></b>');
								$('.prof_type').attr('title','Select');
								$('.prof_type').html('<span class="multiselect-selected-text">None selected</span> <b class="caret"></b>');
								$('.lang').attr('title','Select');
								$('.lang').html('<span class="multiselect-selected-text">None selected</span> <b class="caret"></b>');
								$('input').css('border','1px solid #ccc');
								$('select').css('border','1px solid #ccc');
								$('#clinical_id').prop('checked', false);
								$('#alert').html('User Created successfully..');
								var url								= "<?php echo base_url() ?>team_setup/manage_team/"+data.user_key.trim();
								window.location.href 				= url; 
							}else if(data.response.trim()=='exist'){
								alert('Please choose different Email Id..');
								$("#clinical_email").focus();
								$("#clinical_email").css('border','1px solid #ff1a1c');
							}else{
								alert('Please try after sometime..');
							}
						}
					});
				
				}
				
			}
		}
		
		function ageCount(a){
			var dateString 			= $("#"+a).val();
			var dates 				= dateString.split("/");
			var d 					= new Date();
			var curday				= $.datepicker.formatDate('dd/mm/yy', new Date());
			if(new Date(dateString) > new Date(curday)){
				alert('Invalid date..');
				$("#"+a).val('');
			}else{
				var userday 		= dates[0];
				var usermonth 		= dates[1];
				var useryear 		= dates[2];
				var curday 			= d.getDate();
				var curmonth 		= d.getMonth()+1;
				var curyear 		= d.getFullYear();
				var age 			= curyear - useryear;
				if((curmonth < usermonth) || ((curmonth == usermonth) && curday < userday)){
					age--;
				}
				$("#age_hide").val(age);
				age					= age+' yrs';
				if(a =='datepicker2'){
					$("#ageId").val(age);
					$("#ageId").attr('disabled','disabled');
				}else{
					$("#non_age_id").val(age);
					$("#non_age_id").attr('disabled','disabled');
				}
			}
	    }
	
		function get_specialization(a){
			var country_id		= $("#prof_country_id").val();
			var prof			= $(a).val();
			if(prof !=''){
				var url			= "<?php echo base_url(); ?>account_setup/get_specialization";
				$.post(url,{prof : prof},function(response){
					if(response.trim() !=''){
						regis_category(country_id,prof);
						$("#spl_body").html(response);
						$("#specialization").show();
					}
				});
			}else{
				$("#spl_body").html('');
				$("#specialization").hide();
			}
		}
	
		function regis_category(country,prof_dl){
			var url 	="<?php echo base_url(); ?>account_setup/country_register_categories";
			$.post(url,{country : country,prof:prof_dl},function(response){
				 if(response.trim() ==''){
					var content 	='<option value="">Select</option>';
					$("#country_reg_cat").html(content);
				}else{
					$("#country_reg_cat").html(response);
				}
			});
		}
	
        function readURL(input,a) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
					if(a =='non'){
						  $('#non_img').attr('src', e.target.result);
					}else{
						  $('#blah').attr('src', e.target.result);
					}
                  
                };
                $(".cho-btn").hide();
                $(".up-cho-btn").show();
                reader.readAsDataURL(input.files[0]);
            }
        }
		
		$(function () {
			// Multiple images preview in browser
			var imagesPreview = function (input, placeToInsertImagePreview,type) {
				if (input.files) {
					var filesAmount = input.files.length;
					//alert(filesAmount);
					var html_content = '';
					for (i = 0; i < filesAmount; i++) {
						var reader 			= new FileReader();
						file_name 			= input.files[i]['name'];
						x 					= i ;
						xx					= i+1;
						var html_content 	= html_content + '<tr id="'+type+'_file_row_'+x+'" role="row" class="odd"><td style="padding-left:8px;">' +xx+ '</td><td tabindex="0" class="sorting_1"><a href="#">' + file_name + '</a></td><td tabindex="0" class="sorting_1"><input type="text" id="'+type+'_file_row_text_'+x+'" name="'+type+'_text_'+xx+'"></td><td><a href="#" class="btn btn-success"><i class="fa  fa-share" data-toggle="tooltip" data-title="Share Document" data-original-title="" title=""></i></a><a href="#" class="btn btn-success"><i class="fa  fa-edit" data-toggle="tooltip" data-title="Edit Title" data-original-title="" title=""></i></a><a href="javascript:void(0);" class="btn btn-success" onclick="remove_upload_row('+x+','+"'"+type+"'"+')"><i class="fa  fa-trash" data-toggle="tooltip" data-title="Delete" data-original-title="" title=""></i></a></td></tr>';
					}
					 	
						//console.log(html_content);
					//	console.log("#"+type+"_upload_list_files");
					//	console.log('#'+type+'_upload_document');
						
					$("#"+type+"_upload_list_files").html(html_content);
					$('#'+type+'_upload_document').show();
				}
			};
			$('#upload-file-selector').on('change', function () {
				imagesPreview(this, '#datatable-responsive','non');
			});
			$('#upload-file').on('change', function () {
				imagesPreview(this, '#datatable-responsive','clinical');
			});
			
			$('#professional_document').on('change', function () {
				imagesPreview(this, '#datatable-responsive','prof');
			});
			$('#indemnity_document').on('change', function () {
				imagesPreview(this, '#datatable-responsive','indemnity');
			});
			$('#ico_document').on('change', function () {
				imagesPreview(this, '#datatable-responsive','ico');
			});
		});
		
		function remove_upload_row(a,b){
			var alrt					= confirm('Are you sure do you want to remove this row?');
		 	if(alrt){
				$("#"+b+"_file_row_"+a).remove();
				if($("#"+b+"_upload_list_files").html() == ''){
					$("#"+b+"_upload_document").hide();
				}
			}
		}
		$(document).ready(function () {
		 	$("#datepicker2").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd/mm/yy",
				yearRange: '1900:' + new Date().getFullYear().toString()
			});
			$("#datepicker3").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd/mm/yy",
				yearRange: '1900:' + new Date().getFullYear().toString()
			});
			$("#expiry_ico").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd/mm/yy",
				yearRange: "-100:+50"
			});
			$("#indemnity_expiry").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd/mm/yy",
				yearRange: "-100:+50"
			});
			$("#prof_expiry").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "dd/mm/yy",
				yearRange: "-100:+50"
			});
			
		});
	 
		function get_details(a){
			var url 		= "<?php echo base_url(); ?>team_setup/get_roles";
			$.post(url,{a:a},function(data){
				if(data.response.trim() == 'success'){
					if(data.list != ''){
						$('#professional_type').html(data.list);
					}
				}
			},'json');
		}
        $(document).ready(function () {
            $('#Section-panel-div').hide();
            $('#clinical_id').click(function () {
                $('#Section-panel-div').show();
                $('.clinic-both-section').show();
                $('.noncliincal-section').hide();
				get_details('clinical');
				$("#professional_type").show();
				$(".prof_type").hide();

			});
            $('#non-clinical_id').click(function () {
                $('#Section-panel-div').show();
                $('.clinic-both-section').hide();
                $('.noncliincal-section').show();
				get_details('non-clinical');
				$("#professional_type").show();
				$(".prof_type").hide();
			});
            $('#both_id').click(function () {
                $('#Section-panel-div').show();
                $('.clinic-both-section').show();
                $('.noncliincal-section').hide();
				$(".prof_type").show();
				$("#professional_type").hide();
			});
        
		
		<?php
		if(isset($user_details) &&  $user_details['access_type_id']){
			if($user_details['access_type_id'] == $this->config->item('clinical')){
			?>
				$('#Section-panel-div').show();
                $('.clinic-both-section').show();
                $('.noncliincal-section').hide();
			 <?php
			}else if($user_details['access_type_id'] == $this->config->item('non-clinical')){
			?>
				$('#Section-panel-div').show();
                $('.clinic-both-section').hide();
                $('.noncliincal-section').show();
			<?php	 
			}else if($user_details['access_type_id'] == $this->config->item('both')){
			 ?>
			 $('#Section-panel-div').show();
                $('.clinic-both-section').show();
                $('.noncliincal-section').hide();
			<?php
			} 
			 
		}
		?>
		});
		
		
		function add_service(){
			var ser						= $("#new_service").val();
			if(ser.trim()	!= ''){
				var url					= "<?php echo base_url(); ?>account_setup/add_services";
				var exist_sel			= $("#services").val();
				var sel_arr				= new Array();
				$.post(url,{ser:ser},function(data){
					var st				= data.response.status;
					if(st.trim() == 'success'){
						var select = $('#services');
						select.empty();
						var list		= data.response.list;
						var options     = '';
						if(exist_sel !=''){
							sel_arr		= String(exist_sel).split(',');
						}
						$.each(list, function (key, val) {
							var ky					= key;
							if(ser.trim() == val){
								options							+= '<option value="'+key+'" selected>'+val+'</option>';
							}else if(sel_arr.indexOf(key) != -1){
								options							+= '<option value="'+key+'" selected>'+val+'</option>';
							}else{
								options							+= '<option value="'+key+'">'+val+'</option>';
							}
						});
						$("#services").html(options);
						$("#services").multiselect('rebuild');
						$("#new_service").val('');
					}else if(st.trim() == 'already exist'){
						alert("Service entered already available in the list...");
						$("#new_service").val('');
					}else if(st.trim() == 'failed'){
						alert("Please try after sometime...");
					}
				},'json');
			}else{
				alert("Please enter some service name...");
			}
		}

    </script>
 

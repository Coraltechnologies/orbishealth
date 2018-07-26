            <style>
				.upload_btn {
					position: absolute;
					font-size: 50px;
					opacity: 0;
					right: 0;
					top: 0;
				}
		
				.uploaded_text {
					margin-bottom: 10px;
					color: green;
					margin-top: 20px;
				}
				.pac-container:after {
					/* Disclaimer: not needed to show 'powered by Google' if also a Google Map is shown */
				
					background-image: none !important;
					height: 0px;
				}
				.modal-dialog{
					z-index:1040 !important;
				}
				 
			</style>
			<!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->
                <div class="form-horizontal form-label-left row custom_temp" >
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a id="doc_reg_personal-details" data-toggle="tab" href="#menu3">
                                    Practice Details  <input type="checkbox" id="pDcheck3" class="flat" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </a>
                            </li>
                            <li>
                                <a id="doc_reg_personal-resistration" data-toggle="tab" href="#menu2">
                                    Professional Registration <input type="checkbox" id="pDcheck6" class="flat" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </a>
                            </li>
                            <li>
                                <a id="doc_reg_personal-upload" data-toggle="tab" href="#menu6">
                                    Documents <input type="checkbox" id="pDcheck7" class="flat" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </a>
                            </li>
							<li>
							<a href="javascript:void(0)" style="color:green" id="last_saved">
							<?php  if(isset($last_saved) && $last_saved != ''){ echo "Last Saved :".$last_saved; } ?>
							</a>
							</li>
						</ul>

                        <div class="tab-content">

                            <div id="menu3" class="tab-pane fade in active">
                                <p></p>
                                <div class="x_panel">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Personal Details</div>
                                                <div class="panel-body">
                                                    <div class="col-md-2 col-sm-12 col-xs-12">
                                                        <div class="text-center">
															<?php
																if(!($details['img_name']) && !($details['img_path'])){
															?>	
																<img id="blah" src="<?php echo base_url(); ?>assets/img/profile-image.png" class="avg-profile-img img-circle img-thumbnail" style="height:125px;width:125px;" alt="Profile">
															<?php
																}else{
															?>
																<img id="blah" src="<?php echo base_url().'assets/uploads/'.$details['img_path'].$details['img_name']; ?>" class="avg-profile-img img-circle img-thumbnail" style="height:125px;width:125px;" alt="Profile">
															<?php } ?>
                                                            <div></div>
                                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                                                <input type="file" id="FileUpload1" class="center-block well well-sm" onchange="readURL(this);" accept="image/*" style="width: 100px; !important;padding: 6px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10 col-sm-12 col-xs-12">
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <label>Title</label>
															<span class="asterisk" style="color:red">*</span>
                                                            <div class="form-group">
																<?php
																	$attr	=array('class'=>'form-control','id'=>'title');
																	$title_options	= array(''=>'Select','Dr'=>'Dr','Mr'=>'Mr','Ms'=>'Ms','Mrs'=>'Mrs','Miss'=>'Miss');
																	echo form_dropdown('Title', $title_options,(isset($details['title']) ? $details['title'] : ''),$attr);
																?>
															</div>
                                                        </div>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <label>Gender</label>
															<span class="asterisk" style="color:red">*</span>
                                                            <div class="form-group">
																<?php
																	$attr	=array('class'=>'form-control','id'=>'gender');
																	$title_options	= array(''=>'Select','Male'=>'Male','Female'=>'Female','Transgender'=>'Transgender');
																	echo form_dropdown('Gender', $title_options,(isset($details['gender']) ? $details['gender'] : ''),$attr);
																?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>First Name</label>
																<span class="asterisk" style="color:red">*</span>
                                                                <input id="first_name" onblur="" type="text" class="form-control" placeholder="First Name" value="<?php echo $details['firstname'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Last Name</label>
																<span class="asterisk" style="color:red">*</span>
                                                                <input id="last_name" onblur="" type="text" class="form-control" placeholder="Last Name" value="<?php echo $details['lastname'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <div class="xdisplay_inputx form-group">
                                                                <label>DOB</label>
																<span class="asterisk" style="color:red">*</span>
                                                                <input type="text" class="form-control" id="datepicker" placeholder="dd/mm/yy" value="<?php if($details['dob']){echo date('d/m/Y',strtotime($details['dob']));} ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Mobile</label>
																<span class="asterisk" style="color:red">*</span>
                                                                <input id="Mobile" onblur="" type="text" class="form-control" placeholder="Mobile" value="<?php echo $details['mobile'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Phone</label>
                                                                <input id="Phone" onblur="" type="text" class="form-control" placeholder="Phone" value="<?php if($details['work_telephone']){echo $details['work_telephone'];} ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Email</label>
																<span class="asterisk" style="color:red">*</span>
                                                                <input id="Email" onblur="" type="text" class="form-control" placeholder="Email" value="<?php echo $details['primary_email'] ?>" disabled>
                                                            </div>
                                                        </div>
														<div class="col-md-3 col-sm-12 col-xs-12 form-text-wrapper">
															<div class="form-group">
																<label>Languages Spoken</label>
																<span class="asterisk" style="color:red">*</span>
																<?php
																	$lang			= array();
																	if($details['languages']){
																		$lang		= explode(',',$details['languages']);
																	}
																	$attr	= array('class'=>'form-control multiselect-ui multiservicelist multiselect-native-select','id'=>'language_id','multiple'=>'multiple');
																	echo form_dropdown('Languages', $languages,$lang,$attr);
																?>
															</div>
														</div>
														<div class="col-md-3 col-sm-12 col-xs-12 form-text-wrapper">
															<div class="form-group">
																<label>Ethinic Origin</label>
																<span class="asterisk" style="color:red">*</span>
																<?php
																
																	$attr	=array('class'=>'form-control','id'=>'ethinic_id');
																	echo form_dropdown('Title', $ethinic_details,(isset($details['ethinic_origin']) ? $details['ethinic_origin'] : ''),$attr);
																?>
															</div>
														</div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Address Details <span class="pull-right"><i onclick="clearGP()" class="fa fa-eraser" data-toggle="tooltip" data-title="Clear all data" data-original-title="" title=""></i></span></div>
                                                <div class="panel-body">
                                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Country</label>
																<span class="asterisk" style="color:red">*</span>
																<?php
																	$attr	=array('class'=>'form-control','id'=>'country_id','disabled'=>'disabled');
																	echo form_dropdown('Country', $country['name'],(isset($details['country_id']) ? $details['country_id'] : ''),$attr);
																?>
																<!--<input type="text" class="form-control" placeholder="Country">-->
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Postcode</label>
																<span class="asterisk" style="color:red">*</span>
                                                                <input type="text" class="form-control" placeholder="Postcode" id="zipcode" value="<?php if($details['postcode']){echo $details['postcode'];} ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>City / Town</label>
																<span class="asterisk" style="color:red">*</span>
                                                                <input type="text" class="form-control" placeholder="City / Town" id="town" value="<?php if($details['city_town']){echo $details['city_town'];} ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label> State</label>
																<span class="asterisk" style="color:red">*</span>
                                                                <input type="text" class="form-control" placeholder="State" id="state" value="<?php if($details['state']){echo $details['state'];} ?>">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Address</label>
																<span class="asterisk" style="color:red">*</span>
																<input type="text" class="form-control" rows="4" placeholder="Address" id="address" onkeyup="search_address();" value="<?php if($details['address']){echo $details['address'];} ?>" />
                                                                <!--<textarea class="form-control" rows="4" placeholder="Address" id="address"></textarea>-->
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
                                            </div>
                                        </div>
                                        <div class="actionBar">
                                            <a href="javascript:void(0)" class="buttonNext btn btn-success" onclick="save_data();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save and Continue <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
                            <div id="menu2" class="tab-pane fade">
								<form  method="post" action="<?php echo base_url(); ?>account_setup/" name ='data' enctype='multipart/form-data' onsubmit="save_professional_details(event);">
									<div class="x_panel">
										<div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="row">
													<div class="col-md-12 col-sm-12 col-xs-12">
	
														<div class="panel panel-default">
															<div class="panel-heading">Select Country of Practice(Licence to Practice)
															<?php
																if (count($prof_reg) >0){
																	$country_c		= count($prof_reg);
																}else{
																	$country_c		= 1;
																}
															?>
															<input type='hidden' id="country_select" value='<?php echo $country_c; ?>'/>
															<a href="#" data-toggle="modal" class="pull-right add_field_button1"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
															<div class="prof_input_fields_wrap">
																
																<?php if($prof_reg && !empty($prof_reg)){
																	$i	= 0;
																	foreach($prof_reg as $p_key =>$p_val){
																		$prof_val	= (array)$p_val;
																	?>
																		<div class="panel-body pratice_country">
																			<input type="hidden" class="hidden_country" value="<?php echo $i ?>">
																			<div class="col-md-3 col-sm-12 col-xs-12">
																				<label>Select Country</label>
																				<span class="asterisk" style="color:red">*</span>
																				<div class="form-group">
																					<?php
																						$attr	=array('class'=>'form-control country_prof','id'=>'country_prof_'.$i, 'onchange'=>'prof_regis_adding('.$i.')');
																						echo form_dropdown('data[prof_country]['.$i.']', $country['name'],$prof_val['country_id'],$attr);
																					?>
																				</div>
																			</div>
																			<div class="col-md-3 col-sm-12 col-xs-12">
																				<label>Your Professional Details</label>
																				<span class="asterisk" style="color:red">*</span>
																				<div class="form-group">
																					<?php
																						$attr	=array('class'=>'form-control','id'=>'prof_body_'.$i, 'onchange'=>'get_specialization(this,'.$i.');');
																						echo form_dropdown('data[professional_body]['.$i.']', $professional_body,$prof_val['professional_id'],$attr);
																					?>
																				  
																				</div>
																			</div>
																			<div id="specialization_0" class="col-md-3 col-sm-12 col-xs-12 form-text-wrapper" >
																				<div class="form-group">
																					<label>Select Specialist</label>
																					<?php
																					$list_array		= $this->common->get_specialization($prof_val['professional_id']);
																					$attr			= array('class'=>'form-control','id'=>'spl_body_'.$i);
																					echo form_dropdown('data[spl_body]['.$i.']', $list_array,$prof_val['specialization_id'],$attr);
																					?>
																					<!--<select id="spl_body_0" name='data[spl_body][0]' class="form-control">-->
																					</select>
																				</div>
																			</div>
																		</div>
																<?php
																	$i++;
																	}
																}else { ?>
																
																<div class="panel-body pratice_country">
																	<input type="hidden" class="hidden_country" value="0">
																	<div class="col-md-3 col-sm-12 col-xs-12">
																		<label>Select Country</label>
																		<span class="asterisk" style="color:red">*</span>
																		<div class="form-group">
																			<?php
																				$attr	=array('class'=>'form-control country_prof','id'=>'country_prof_0', 'onchange'=>'prof_regis_adding(0)');
																				echo form_dropdown('data[prof_country][0]', $country['name'],'',$attr);
																			?>
																		</div>
																	</div>
																	<div class="col-md-3 col-sm-12 col-xs-12">
																		<label>Your Professional Details</label>
																		<span class="asterisk" style="color:red">*</span>
																		<div class="form-group">
																			<?php
																				$attr	=array('class'=>'form-control','id'=>'prof_body_0', 'onchange'=>'get_specialization(this,0);');
																				echo form_dropdown('data[professional_body][0]', $professional_body,'',$attr);
																			?>
																		  
																		</div>
																	</div>
																	<div id="specialization_0" class="col-md-3 col-sm-12 col-xs-12 form-text-wrapper" style="display:none">
																		<div class="form-group">
																			<label>Select Specialist</label>
																			<select id="spl_body_0" name='data[spl_body][0]' class="form-control">
																			</select>
																		</div>
																	</div>
																</div>
																<?php } ?>
																
																
																
																
															</div>
														</div>
														
														
														<div class="panel panel-default" id="profess_reg" style="<?php if($prof_reg && !empty($prof_reg)){ }else{ echo 'display:none';} ?>">
															<div class="panel-heading">Professional Registration  <a href="#mygmcUpload" data-toggle="modal" class="pull-right"><i class="fa fa-upload" aria-hidden="true"></i></a> </div>
															<div class="prof_regis_wrap">
																<?php if($prof_reg && !empty($prof_reg)){
																	$i=0;
																foreach($prof_reg as $p_key =>$p_val){
																	$prof_val	= (array)$p_val;
																	
																?>
																
																<div class="panel-body" id="country_profession_<?php echo  $i; ?>">
																	<div class="col-md-3 col-sm-12 col-xs-12">
																		<label>Country</label>
																		<span class="asterisk" style="color:red">*</span>
																		<div class="form-group">
																			<?php
																				$attr	=array('class'=>'form-control','id'=>'country_reg_'.$i,'disabled'=>'disabled');
																				echo form_dropdown('data[country_reg]['.$i.']', $country['name'],$prof_val['country_id'],$attr);
																			?>
																			
																		</div>
																	</div>
																	<div class="col-md-3 col-sm-12 col-xs-12">
																		<label>Professional Body</label>
																		<span class="asterisk" style="color:red">*</span>
																		<div class="form-group">
																			<?php
																				$list_array		= $this->common->register_categories($prof_val['country_id'],$prof_val['professional_id']);
																				$attr			= array('class'=>'form-control','id'=>'country_reg_cat_'.$i);
																				echo form_dropdown('data[country_reg_cat]['.$i.']', $list_array,$prof_val['medical_bodies_id'],$attr);
																			?>
																			<!--<select class="form-control" id="country_reg_cat_0" name='data[country_reg_cat][0]'></select>-->
																		</div>
																	</div>
																	<div class="col-md-3 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Number</label>
																			<span class="asterisk" style="color:red">*</span>
																			<input type="text" class="form-control" placeholder="Number" id="country_reg_num_<?php echo $i; ?>" name='data[country_reg_num][<?php echo $i; ?>]' value="<?php echo $prof_val['register_number'] ?>">
																		</div>
																	</div>
																	<div class="col-md-2 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Expiry Date</label>
																			<span class="asterisk" style="color:red">*</span>
																			<input type="text" class="form-control" placeholder="Expiry Date" id="country_expiry_<?php echo $i; ?>" name='data[country_expiry][<?php echo $i; ?>]' value="<?php echo date('d/m/Y',strtotime($prof_val['expiry_date'])); ?>">
																		</div>
																	</div>
																</div>
																
																<?php
																$i++;
																}
																}else{?>
																	<div class="panel-body" id="country_profession_0">
																		<div class="col-md-3 col-sm-12 col-xs-12">
																			<label>Country</label>
																			<span class="asterisk" style="color:red">*</span>
																			<div class="form-group">
																				<?php
																					$attr	=array('class'=>'form-control','id'=>'country_reg_0','name'=>'data[country_reg][0]','disabled'=>'disabled');
																					echo form_dropdown('Country', $country['name'],'',$attr);
																				?>
																				
																			</div>
																		</div>
																		<div class="col-md-3 col-sm-12 col-xs-12">
																			<label>Professional Body</label>
																			<span class="asterisk" style="color:red">*</span>
																			<div class="form-group">
																				<?php ?>
																				<select class="form-control" id="country_reg_cat_0" name='data[country_reg_cat][0]'></select>
																			</div>
																		</div>
																		<div class="col-md-3 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Number</label>
																				<span class="asterisk" style="color:red">*</span>
																				<input type="text" class="form-control" placeholder="Number" id="country_reg_num_0" name='data[country_reg_num][0]'>
																			</div>
																		</div>
																		<div class="col-md-2 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Expiry Date</label>
																				<span class="asterisk" style="color:red">*</span>
																				<input type="text" class="form-control" placeholder="Expiry Date" id="country_expiry_0" name='data[country_expiry][0]'>
																			</div>
																		</div>
																	</div>
																<?php } ?>
																
															</div>
														</div>
														
														
														
														<div class="panel panel-default" id="ico_registration" style="<?php if($prof_reg && !empty($prof_reg)){ }else{ echo 'display:none';} ?>">
															<div class="panel-heading">ICO Registration <a href="#myicoUpload" data-toggle="modal" class="pull-right"><i class="fa fa-upload" aria-hidden="true"></i></a></div>
															<div id="ico_list">
																
																<?php if($other_bodies && !empty($other_bodies)){
																$i=0;
																foreach($other_bodies as $p_key =>$p_val){
																	$prof_val	= (array)$p_val;
																	if($prof_val['other_bodies_id']  == 1 ){
																		?>
																		<div class="panel-body" id="ico_profession_<?php echo $i; ?>">
																			<div class="col-md-4 col-sm-12 col-xs-12">
																				<label>Country</label>
																				<span class="asterisk mand_0" style="color:red;<?php if($prof_val['country_id'] != $this->config->item('uk_country_code')){echo 'display:none'; } ?>" >*</span>
																				<div class="form-group">
																					<?php
																						$attr	=array('class'=>'form-control','id'=>'ico_reg_'.$i,'disabled'=>'disabled','name'=>'data[ico_reg]['.$i.']');
																						echo form_dropdown('Country', $country['name'],$prof_val['country_id'],$attr);
																					?>
																					
																				</div>
																			</div>
																			<div class="col-md-4 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Number</label>
																					<span class="asterisk mand_0" style="color:red;<?php if($prof_val['country_id'] != $this->config->item('uk_country_code')){echo 'display:none';} ?>" >*</span>
																					<input type="text" class="form-control" placeholder="Number" id='ico_number_<?php echo $i; ?>'  name='data[ico_number][<?php echo $i; ?>]' value="<?php echo $prof_val['register_number'] ?>">
																				</div>
																			</div>
																			<div class="col-md-4 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Expiry Date</label>
																					<span class="asterisk mand_0" style="color:red;<?php if($prof_val['country_id'] != $this->config->item('uk_country_code')){echo 'display:none';} ?>" >*</span>
																					<input type="text" class="form-control" placeholder="Expiry Date" id='ico_expiry_<?php echo $i; ?>' name='data[ico_expiry][<?php echo $i; ?>]' value="<?php if($prof_val['expiry_date'] !=''){echo date('d/m/Y',strtotime($prof_val['expiry_date']));}  ?>">
																				</div>
																			</div>
																		</div>
																		<?php
																		$i++;
																		}
																	}
																}else{ ?>
																	<div class="panel-body" id="ico_profession_0">
																	<div class="col-md-4 col-sm-12 col-xs-12">
																		<label>Country</label>
																		<span class="asterisk mand_0" style="color:red" >*</span>
																		<div class="form-group">
																			<?php
																				$attr	=array('class'=>'form-control','id'=>'ico_reg_0','disabled'=>'disabled','name'=>'data[ico_reg][0]');
																				echo form_dropdown('Country', $country['name'],'',$attr);
																			?>
																			
																		</div>
																	</div>
																	<div class="col-md-4 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Number</label>
																			<span class="asterisk mand_0" style="color:red" >*</span>
																			<input type="text" class="form-control" placeholder="Number" id='ico_number_0'  name='data[ico_number][0]'>
																		</div>
																	</div>
																	<div class="col-md-4 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Expiry Date</label>
																			<span class="asterisk mand_0" style="color:red" >*</span>
																			<input type="text" class="form-control" placeholder="Expiry Date" id='ico_expiry_0' name='data[ico_expiry][0]'>
																		</div>
																	</div>
																</div>
																<?php } ?>
																
															</div>
														</div>
														<div class="panel panel-default" id="indemnity_registration" style="<?php if($prof_reg && !empty($prof_reg)){ }else{ echo 'display:none';} ?>">
															<div class="panel-heading">Indemnity <a href="#myindemnityUpload" data-toggle="modal" class="pull-right"><i class="fa fa-upload" aria-hidden="true"></i></a></div>
															<div id="indemnity_list">
																<?php
																if($other_bodies && !empty($other_bodies)){
																	$i=0;
																	foreach($other_bodies as $p_key =>$p_val){
																		$prof_val	= (array)$p_val;
																		if($prof_val['other_bodies_id']  == 2 ){
																		?>
																			<div class="panel-body" id="indemnity_profession_<?php echo $i; ?>">
																			<div class="col-md-3 col-sm-12 col-xs-12">
																				<label>Country</label>
																				<span class="asterisk mand_0" style="color:red;<?php if($prof_val['country_id'] != $this->config->item('uk_country_code')){echo 'display:none'; } ?>" >*</span>
																				<div class="form-group">
																					<?php
																						$attr	=array('class'=>'form-control','id'=>'indemnity_reg_'.$i,'disabled'=>'disabled','name'=>'data[indemnity_reg][0]');
																						echo form_dropdown('Country', $country['name'],$prof_val['country_id'],$attr);
																					?>
																					
																				</div>
																			</div>
																			<div class="col-md-3 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Name of company</label>
																					<span class="asterisk mand_0" style="color:red;<?php if($prof_val['country_id'] != $this->config->item('uk_country_code')){echo 'display:none'; } ?>" >*</span>
																					<input type="text" class="form-control" placeholder="Name of company" id='indemnity_company_<?php echo $i; ?>' name='data[indemnity_company][<?php echo $i; ?>]' value= "<?php echo $prof_val['company_name']?>">
																				</div>
																			</div>
																			<div class="col-md-3 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Number</label>
																					<span class="asterisk mand_0" style="color:red;<?php if($prof_val['country_id'] != $this->config->item('uk_country_code')){echo 'display:none'; } ?>" >*</span>
																					<input type="text" class="form-control" placeholder="Number" id='indemnity_number_<?php echo $i; ?>' name='data[indemnity_number][<?php echo $i; ?>]' value= "<?php echo $prof_val['register_number']?>"> 
																				</div>
																			</div>
																			<div class="col-md-3 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Expiry Date</label>
																					<span class="asterisk mand_0" style="color:red;<?php if($prof_val['country_id'] != $this->config->item('uk_country_code')){echo 'display:none'; } ?>" >*</span>
																					<input type="text" class="form-control" placeholder="Expiry Date" id='indemnity_expiry_<?php echo $i; ?>' name='data[indemnity_expiry][<?php echo $i; ?>]' value="<?php if($prof_val['expiry_date'] !=''){echo date('d/m/Y',strtotime($prof_val['expiry_date']));}  ?>">
																				</div>
																			</div>
																		</div>
																		<?php
																		$i++;
																		}
																	}
																}else{
																?>
																	<div class="panel-body">
																		<div class="col-md-3 col-sm-12 col-xs-12">
																			<label>Country</label>
																			<span class="asterisk mand_0" style="color:red" >*</span>
																			<div class="form-group">
																				<?php
																					$attr	=array('class'=>'form-control','id'=>'indemnity_reg_0','disabled'=>'disabled','name'=>'data[indemnity_reg][0]');
																					echo form_dropdown('Country', $country['name'],'',$attr);
																				?>
																				
																			</div>
																		</div>
																		<div class="col-md-3 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Name of company</label>
																				<span class="asterisk mand_0" style="color:red" >*</span>
																				<input type="text" class="form-control" placeholder="Name of company" id='indemnity_company_0' name='data[indemnity_company][0]'>
																			</div>
																		</div>
																		<div class="col-md-3 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Number</label>
																				<span class="asterisk mand_0" style="color:red" >*</span>
																				<input type="text" class="form-control" placeholder="Number" id='indemnity_number_0' name='data[indemnity_number][0]'> 
																			</div>
																		</div>
																		<div class="col-md-3 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Expiry Date</label>
																				<span class="asterisk mand_0" style="color:red" >*</span>
																				<input type="text" class="form-control" placeholder="Expiry Date" id='indemnity_expiry_0' name='data[indemnity_expiry][0]'>
																			</div>
																		</div>
																	</div>
																
																<?php } ?>
																
															</div>
														</div>
														
														<div class="panel panel-default">
															<div class="panel-heading">Professional Details</div>
															<div class="panel-body">
																<div class="col-md-6 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>Qualifications</label>
																		<span class="asterisk" style="color:red">*</span>
																		<textarea class="form-control" rows="4" placeholder="Qualifications" id="qualifications" name='data[qualifications]'><?php if($profession_details['qualifications']){ echo $profession_details['qualifications']; } ?></textarea>
																	</div>
																</div>
																<div class="col-md-6 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>Memberships</label>
																		<textarea class="form-control" rows="4" placeholder="Memberships" id="membership" name='data[membership]'><?php if($profession_details['memberships']){ echo $profession_details['memberships']; } ?></textarea>
																	</div>
																</div>
																
																<div class="col-md-6 col-sm-12 col-xs-12 form-text-wrapper">
																	<div class="col-md-12 col-sm-12 col-xs-12 padding-null">
																		<div class="form-group">
																			<label>Please select the services you provide</label>
																			<span class="asterisk" style="color:red">*</span>
																				<?php
																					$attr	=array('class'=>'multiselect-ui form-control multiservicelist multiselect-native-select','style'=>'max-height:200px','multiple'=>'multiple','id'=>'services');
																					echo form_dropdown('data[services][]',$services,$user_services,$attr);
																				?>
																		</div>
																	</div>
																	<div class="col-md-11 col-sm-12 col-xs-12 padding-null">
																		<div class="form-group">
																			<label>Services if any</label>
																			<input type="text" class="form-control" placeholder="Other Services if any" id="new_service" name='data[new_service]'>
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
																			<input type="number" class="form-control" placeholder="Total years of experience"  min="1" max="15" id="exp_years" name='data[exp_years]' value="<?php if($profession_details['year_exp']){ echo $profession_details['year_exp']; } ?>" >
																		</div>
																	</div>
																</div>
																<div class="col-md-6 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>Professional Experience</label>
																		<textarea class="form-control" rows="4" placeholder="Professional Experience" style="height:165px;" id="professional_exp" name='data[professional_exp]'><?php if($profession_details['professional_exp']){ echo $profession_details['professional_exp']; } ?></textarea>
																	</div>
																</div>
																
															</div>
															
															
															
														</div>
	
													</div>
												</div>
											</div>
											<div class="actionBar">
												<a href="javascript:void(0)" class="buttonPrevious btn btn-primary" onclick="nxt_tab('doc_reg_personal-details');"><i class="fa fa-angle-left" aria-hidden="true"></i> Previous</a>
												<button style="display:none;"id="prof_submit" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Save and Continue </button>
												<a href="javascript:void(0)" class="buttonNext btn btn-success" onclick="$('#prof_submit').click()"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save and Continue </a> 
											</div>
										</div>
									</div>
								</form>
						    </div>
							
							
                            <div id="menu6" class="tab-pane fade">
                                <p></p>
                                <div class="x_panel">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">Documents </div>
                                                    <div class="panel-body">
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-12 col-xs-12 padding-null">
                                                                    <div class="col-md-3 padding-null" style="width: auto;">
                                                                        <label class="" style="text-align:left !important;">Upload Documents / Files:</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <p class="btn btn-primary btn-sm" style="color: #fff;">
                                                                            <input class="file-4 upload_btn" id="upload-other" onchange ="display_uploaded(this,'upload_list_doc','upload_doc');" type="file" multiple=""><i class="fa  fa-upload" data-toggle="tooltip" data-title="Edit Title"></i> Upload
																		</p><span id="upload_doc_response"></span>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <p class="btn btn-primary btn-sm" style="color: #fff;display:none">
                                                                            <input class="upload_btn" type="button"><i class="fa  fa-save" data-toggle="tooltip" data-title="Edit Title"></i> Save
                                                                        </p>
                                                                    </div>
                                                                   
                                                                </div>
																
                                                                <div class="col-md-12 col-sm-12 col-xs-12 padding-null" id="upload_doc" style="display:none;">
                                                                    <label style="margin-bottom:10px;color:green;margin-top:15px;">Uploaded Documents / Images:</label>
                                                                    <br />
                                                                    <div class="list-group table-responsive">
                                                                        <table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
                                                                            <thead>
                                                                                <tr role="row">
                                                                                    <th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
                                                                                    <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Files</th>
                                                                                    <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
																					<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Show Public</th>
                                                                                    <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="upload_list_doc" style="height: 10px !important; overflow: scroll; "></tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="modal fade notes-info" id="mail-edit-modal" style="display: none;">
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
                                                                    </div>
                                                                </div>
																
																
																<div class="col-md-12 col-sm-12 col-xs-12 padding-null" id="upload_doc_exist" style="<?php if(empty($other_uploads)){echo 'display:none';} ?>">
																	<label style="margin-bottom:10px;color:green;margin-top:15px;">Existing Documents:</label>
																		<div class="list-group table-responsive">
																			<table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
																				<thead>
																					<tr role="row">
																						<th style="width:5px"><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
																						<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending" style="width:20px !important">Title</th>
																						<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending" style="width:20px !important">Visibility</th>
																						<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending" style="width:20px !important">Action</th>
																					</tr>
																				</thead>
																				<tbody style="height: 10px !important; overflow: scroll; " id="exist_other_document">
																					<?php
																						if(!empty($other_uploads)) {
																							foreach($other_uploads as $key =>$val){
																								$val_arr		= (array)$val;
																								?>
																								<tr role="row">
																									<td>
																									</td>
																									<td tabindex="0">
																										<a href="#">
																										<?php
																										echo $val_arr['title'];
																										?></a>
																									</td>
																									<td>
																										<?php
																											if($val_arr['show_public'] == 0){
																												echo "Private";
																											}else if($val_arr['show_public'] == 1){
																												echo "Public";
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
                                        <div class="actionBar">
                                            <a href="#" class="buttonPrevious btn btn-primary" onclick="nxt_tab('doc_reg_personal-resistration');"><i class="fa fa-angle-left" aria-hidden="true"></i> Previous</a>
											<a href="<?php echo base_url(); ?>account_setup/professional_summary" class="buttonNext btn btn-success" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Save and Continue </a> 
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
	
    <!-- Modals -->
    <div class="modal fade bd-example-modal-lg" id="mygmcUpload" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title" id="myModalLabel">Professional Registration Document Upload </h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">Documents </div>
                        <div class="panel-body">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 padding-null">
                                        <div class="col-md-3 padding-null" style="width: auto;">
                                            <label class="" style="text-align:left !important;">Upload Documents / Images:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="btn btn-primary btn-sm" style="color: #fff;">
                                                <input class="file-4 upload_btn" id="upload-prof" name ="data[upload-prof]" type="file" onchange ="display_uploaded(this,'upload_list_prof','upload_prof');" multiple><i class="fa  fa-upload" data-toggle="tooltip" data-title="Edit Title"></i> Upload

                                            </p><span id="upload_prof_response"></span>
                                        </div>
                                        <div class="col-md-2">
                                            <p class="btn btn-primary btn-sm" style="color: #fff;display:none;margin-left: 15px;">
                                                <input class="upload_btn" type="button"><i class="fa  fa-save" data-toggle="tooltip" data-title="Edit Title"></i> Save
                                            </p>
                                        </div>

                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 padding-null" id="upload_prof"   style="display:none;">
                                        <label style="margin-bottom:10px;color:green;margin-top:15px;">Uploaded Documents / Images:</label>
                                        <br/>
                                        <div class="list-group table-responsive">
                                            <table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
                                                <thead>
                                                    <tr role="row">
                                                        <th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Files</th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
														<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Professional Reg - Country&nbsp;<span class="asterisk" style="color:red">*</span></th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Show Public</th>
														<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="upload_list_prof" style="height: 10px !important; overflow: scroll; "></tbody>
                                            </table>
                                        </div>
										<div class="modal fade notes-info" id="mail-edit-modal" style="display: none;">
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
                                        </div>
                                    </div>
									
									<?php
									$x_count= 0;
									$y_count= 0;
									$z_count= 0;
									if(!empty($professional_uploads)) {
										foreach($professional_uploads as $key =>$val){
											$val_arr		= (array)$val;
											if($val_arr['medical_bodies'] == 1){
												$x_count++;
											}else if($val_arr['medical_bodies'] == null && $val_arr['other_bodies_id'] ==1){
												$y_count++;
											}else if($val_arr['medical_bodies'] == null && $val_arr['other_bodies_id'] ==2){
												$z_count++;
											}
										}
									 
									}
									?>
									<div class="col-md-12 col-sm-12 col-xs-12 padding-null" id="upload_prof_exist"  style="<?php if($x_count == 0){echo 'display:none';} ?>">
									<label style="margin-bottom:10px;color:green;margin-top:15px;">Existing Documents:</label>
										<div class="list-group table-responsive">
                                            <table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
                                                <thead>
                                                    <tr role="row">
                                                        <th style="width:5px"><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
														<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending" style="width:20px !important">Title</th>
														<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending" style="width:30px !important">Professional Reg - Country</th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending" style="width:20px !important">Visibility</th>
														<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending" style="width:20px !important">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="height: 10px !important; overflow: scroll; " id="exist_list_prof">
													<?php
														if(!empty($professional_uploads)) {
															foreach($professional_uploads as $key =>$val){
																$val_arr		= (array)$val;
																if($val_arr['medical_bodies'] == 1){
																?>
																<tr role="row">
																	<td>
																	</td>
																	<td tabindex="0">
																		<a href="#">
																		<?php
																		echo $val_arr['title'];
																		?></a>
																	</td>
																	<td tabindex="0">
																		<div class="form-group">
																			<?php echo $country['name'][$val_arr['country_id']]; ?>
																		</div>
																	</td>
																	<td>
																		<?php
																			if($val_arr['show_public'] == 0){
																				echo "Private";
																			}else if($val_arr['show_public'] == 1){
																				echo "Public";
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

    <div class="modal fade bd-example-modal-lg" id="myicoUpload" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title" id="myModalLabel">ICO Registration Document Upload </h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">Documents </div>
                        <div class="panel-body" >
                         
						    <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
								     <div class="col-md-12 col-sm-12 col-xs-12 padding-null">
                                        <div class="col-md-3 padding-null" style="width: auto;">
                                            <label class="" style="text-align:left !important;">Upload Documents / Images:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="btn btn-primary btn-sm" style="color: #fff;">
                                                <input class="file-4 upload_btn" id="upload-ico" name="data[upload-ico]"  onchange ="display_uploaded(this,'upload_list_ico','upload_ico');" type="file" multiple><i class="fa  fa-upload" data-toggle="tooltip" data-title="Edit Title"></i> Upload

                                            </p><span id="upload_ico_response"></span>
                                        </div>
                                        <div class="col-md-2">
                                            <p class="btn btn-primary btn-sm" style="color: #fff;display:none;margin-left: 15px;">
                                                <input class="upload_btn" type="button"><i class="fa  fa-save" data-toggle="tooltip" data-title="Edit Title"></i> Save
                                            </p>
                                        </div>

                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 padding-null" id="upload_ico" style="display:none;">
                                        <label style="margin-bottom:10px;color:green;margin-top:15px;">Uploaded Documents / Images:</label>
                                        <br />
                                        <div class="list-group table-responsive">
                                            <table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
                                                <thead>
                                                    <tr role="row">
                                                        <th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Files</th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
														<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Professional Reg - Country&nbsp;<span class="asterisk" style="color:red">*</span></th>
													    <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Show Public</th>
														<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="upload_list_ico" style="height: 10px !important; overflow: scroll; "></tbody>
                                            </table>
                                        </div>
                                        <div class="modal fade notes-info" id="mail-edit-modal" style="display: none;">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							
							<div class="col-md-12 col-sm-12 col-xs-12 padding-null" id="upload_ico_exist" style="<?php if($y_count == 0){echo 'display:none';} ?>">
								<label style="margin-bottom:10px;color:green;margin-top:15px;">Existing Documents:</label>
									<div class="list-group table-responsive">
										<table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
											<thead>
												<tr role="row">
													<th style="width:5px"><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
													<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending" style="width:20px !important">Title</th>
													<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending" style="width:30px !important">Professional Reg - Country</th>
													<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending" style="width:20px !important">Visibility</th>
													<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending" style="width:20px !important">Action</th>
												</tr>
											</thead>
											<tbody style="height: 10px !important; overflow: scroll; " id="exist_list_ico">
												<?php
													if(!empty($professional_uploads)) {
														foreach($professional_uploads as $key =>$val){
															$val_arr		= (array)$val;
															if($val_arr['medical_bodies'] == null && $val_arr['other_bodies_id'] == $this->config->item('ico_id')){
															?>
															<tr role="row">
																<td>
																</td>
																<td tabindex="0">
																	<a href="#">
																	<?php
																	echo $val_arr['title'];
																	?></a>
																</td>
																<td tabindex="0">
																	<div class="form-group">
																		<?php echo $country['name'][$val_arr['country_id']]; ?>
																	</div>
																</td>
																<td>
																	<?php
																		if($val_arr['show_public'] == 0){
																			echo "Private";
																		}else if($val_arr['show_public'] == 1){
																			echo "Public";
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

    <div class="modal fade bd-example-modal-lg" id="myindemnityUpload" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title" id="myModalLabel">INDEMNITY REGISTRATION DOCUMENT UPLOAD </h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">Documents </div>
                        <div class="panel-body" >
							
							
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 padding-null">
                                        <div class="col-md-3 padding-null" style="width: auto;">
                                            <label class="" style="text-align:left !important;">Upload Documents / Images:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="btn btn-primary btn-sm" style="color: #fff;">
                                                <input class="file-4 upload_btn" id="upload-indemnity" name="data[upload-indemnity]" onchange ="display_uploaded(this,'upload_list_idemnity','upload_idemnity');" type="file" multiple=""><i class="fa  fa-upload" data-toggle="tooltip" data-title="Edit Title"></i> Upload

                                            </p><span id="upload_idemnity_response"></span>
                                        </div>
                                        <div class="col-md-2">
                                            <p class="btn btn-primary btn-sm" style="color: #fff;display:none;margin-left: 15px;">
                                                <input class="upload_btn" type="button"><i class="fa  fa-save" data-toggle="tooltip" data-title="Edit Title"></i> Save
                                            </p>
                                        </div>

                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 padding-null" id="upload_idemnity" style="display:none;">
                                        <label style="margin-bottom:10px;color:green;margin-top:15px;">Uploaded Documents / Images:</label>
                                        <br />
                                        <div class="list-group table-responsive">
                                            <table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
                                                <thead>
                                                    <tr role="row">
                                                        <th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Files</th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th> 
                                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Professional Reg - Country</th>
														<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Show Public</th>
														<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="upload_list_idemnity" style="height: 10px !important; overflow: scroll; "></tbody>
                                            </table>
                                        </div>
                                        <div class="modal fade notes-info" id="mail-edit-modal" style="display: none;">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							
							<div class="col-md-12 col-sm-12 col-xs-12 padding-null"  id="upload_idemnity_exist" style="<?php if($z_count == 0){echo 'display:none';} ?>">
								<label style="margin-bottom:10px;color:green;margin-top:15px;">Existing Documents:</label>
									<div class="list-group table-responsive">
										<table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
											<thead>
												<tr role="row">
													<th style="width:5px"><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
													<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending" >Title</th>
													<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending" >Professional Reg - Country</th>
													<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending" >Visibility</th>
													<th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending" >Action</th>
												</tr>
											</thead>
											<tbody style="height: 10px !important; overflow: scroll; " id="exist_list_idemnity" >
												<?php
													if(!empty($professional_uploads)) {
														foreach($professional_uploads as $key =>$val){
															$val_arr		= (array)$val;
															if($val_arr['medical_bodies'] == null && $val_arr['other_bodies_id'] == $this->config->item('indemnity_id')){
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
																<td tabindex="0">
																	<div class="form-group">
																		<?php echo $country['name'][$val_arr['country_id']]; ?>
																	</div>
																</td>
																<td >
																	<?php
																		if($val_arr['show_public'] == 0){
																			echo "Private";
																		}else if($val_arr['show_public'] == 1){
																			echo "Public";
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
	 
	  <!-- Models Close-->
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendors/iCheck/icheck.min.js"></script>
	
    <!-- Custom Theme Scripts -->
	<script src="<?php echo base_url(); ?>assets/vendors/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.easing.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.appear.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/nivo-lightbox.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-imageupload.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/drop-down.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/multiple-select.js"></script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#blah').attr('src', e.target.result);
                };
                $(".cho-btn").hide();
                $(".up-cho-btn").show();
                reader.readAsDataURL(input.files[0]);
            }
        }
		function nxt_tab(a) {
            $("#" + a).click();
        }

        $(function () {
            $("#datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
				dateFormat: "dd/mm/yy",
				yearRange: '1900:' + new Date().getFullYear().toString()
            });
			$("#country_expiry_0").datepicker({
                changeMonth: true,
                changeYear: true,
				dateFormat: "dd/mm/yy",
				yearRange: "-100:+50"
            });
			$("#ico_expiry_0").datepicker({
                changeMonth: true,
                changeYear: true,
				dateFormat: "dd/mm/yy",
				yearRange: "-100:+50"
            });
			$("#indemnity_expiry_0").datepicker({
                changeMonth: true,
                changeYear: true,
				dateFormat: "dd/mm/yy",
				yearRange: "-100:+50"
            });
		});
    </script>
    <script type="text/javascript">
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
        $(function () {
			$('.multiservicelist').each(function() {
				if($(this).attr('id') == 'language_id'){
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
        // Add Extra Row Section //
		$(".add_field_button1").click(function(){
			var wrapper = ".prof_input_fields_wrap"; //Fields wrapper
			var x					= $("#country_select").val();
			
			var list				= '<?php echo $list ?>';
			var country_list		= '<?php echo $country_list ?>';
			$(wrapper).append('<div class="panel-body pratice_country" style="margin-left:10px;" id="pratice_country_'+x+'"> <div class="row"><input type="hidden" class="hidden_country" value="'+x+'"> <div class="col-md-3 col-sm-12 col-xs-12"> <label>Select Country</label><span class="asterisk" style="color:red" >*</span><div class="form-group"> <select class="form-control country_prof" name="data[prof_country]['+x+']" id="country_prof_'+x+'" onchange ="prof_regis_adding('+x+')">'+country_list+'</select> </div></div><div class="col-md-3 col-sm-12 col-xs-12"> <label>Your Professional Details</label><span class="asterisk" style="color:red" >*</span><div class="form-group"> <select id="prof_body_'+x+'" name="data[professional_body]['+x+']" class="form-control" onchange="get_specialization(this,'+x+');">'+list+'</select> </div></div><div class="col-md-3 col-sm-12 col-xs-12 form-text-wrapper" id="specialization_'+x+'" style="display:none"> <div class="form-group"> <label>Select Specialist</label><select id="spl_body_'+x+'" name="data[spl_body]['+x+']"  class="form-control"> </select> </div></div><div class="col-sm-2 col-md-1"> <div class="form-group"><label>Remove</label><button type="button" onclick ="remove_row('+x+')" class="remove_field1 btn btn-default btn-sm"> <span class="glyphicon glyphicon-minus"></span></button></div></div></div></div>'); //add input box
			$("#country_select").val(parseInt(x)+1);
			$('.multiselect-ui').multiselect({
                includeSelectAllOption: true
            });
		});
		
		//Removing addition rows
		function remove_row(a){
			var alrt			= confirm("Are you sure do you want to remove this row?");
			if(alrt){
				var country_name						= new Array();
				<?php echo $country_l; ?>
				$("#pratice_country_"+a).remove();
				$("#country_profession_"+a).remove();
				$("#ico_profession_"+a).remove();
				$("#indemnity_profession_"+a).remove();
				var elements 							= document.getElementsByClassName("country_prof");
				var country_list 						= $('.country_li');
				country_list.empty();
				var upload_options					  	= '<option>Select</option>';
				for (var i = 0, len = elements.length; i < len; i++) {
					if( elements[i].value !=''){
						upload_options					+= '<option value="'+elements[i].value+'">'+country_name[elements[i].value]+'</option>';
					}
				}
				$('.country_li').html(upload_options);
			}
			
		}
		
		// getting specializations
		function get_specialization(a,row){
			var country_id		= $("#country_prof_"+row).val();
			var prof			= $(a).val();
			if(prof !=''){
				var url			= "<?php echo base_url(); ?>account_setup/get_specialization";
				$.post(url,{prof : prof},function(response){
					if(response.trim() !=''){
						regis_category(country_id,row,prof);
						$("#spl_body_"+row).html(response);
						$("#specialization_"+row).show();
					}
				});
			}else{
				$("#spl_body_"+row).html('');
				$("#specialization_"+row).hide();
			}
		}
	
	
	    //adding  professional country registration
		function prof_regis_adding(a){
			var country_id		= $("#country_prof_"+a).val();
			var exist			= 0;
			var elements 		= document.getElementsByClassName("country_prof");
			for (var i = 0, len = elements.length; i < len; i++) {
				if(elements[i].value == country_id  && elements[i].id !=='country_prof_'+a){
				    exist				= 1;
					alert("Please choose different country..");
				} 
			}
			var country_name						= new Array();
			<?php echo $country_l; ?>
			var prof_dl								= $("#prof_body_"+a).val();
			var upload_options					  	= '<option value="">Select</option>';
			if(exist == 0){
				if($("#country_profession_"+a).length>0){
					$("#country_reg_"+a).val(country_id);
					$("#ico_reg_"+a).val(country_id);
					$("#indemnity_reg_"+a).val(country_id);
					if(country_id	== <?php echo $this->config->item('uk_country_code'); ?>){
						$(".mand_"+a).show();
					}else{
						$(".mand_"+a).hide();
					}
					var country_list = $('.country_li');
					country_list.empty();
					
					for (var i = 0, len = elements.length; i < len; i++) {
						if( elements[i].value !=''){
							upload_options					+= '<option value="'+elements[i].value+'">'+country_name[elements[i].value]+'</option>';
						}
					}
					$('.country_li').html(upload_options);
					regis_category(country_id,a,prof_dl);
					$("#profess_reg").show();
					$("#ico_registration").show();
					$("#indemnity_registration").show();
				}else{
					var wrapper 			= ".prof_regis_wrap";
					var country_list		= '<?php echo $country_list; ?>';
					var list				= '';
					var mand				= '';
					if(country_id	== <?php echo $this->config->item('uk_country_code'); ?>){
						mand				= '<span class="asterisk mand_'+a+'" style="color:red" >*</span>';
					}else{
						mand				= '<span class="asterisk mand_'+a+'" style="color:red;display:none" >*</span>';
					}
					regis_category(country_id,a,prof_dl);
					$(wrapper).append('<div class="panel-body" id="country_profession_'+a+'"><div class="col-md-3 col-sm-12 col-xs-12"><label>Country</label><span class="asterisk" style="color:red" >*</span><div class="form-group"><select class="form-control" name="data[country_reg]['+a+']"  id="country_reg_'+a+'" disabled>'+country_list+'</select></div></div><div class="col-md-3 col-sm-12 col-xs-12"><label>Professional Body</label><span class="asterisk" style="color:red" >*</span><div class="form-group"><select name="data[country_reg_cat]['+a+']" id="country_reg_cat_'+a+'" class="form-control" >'+list+'</select></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><label>Number</label><span class="asterisk" style="color:red" >*</span><input id="country_reg_num_'+a+'" name="data[country_reg_num]['+a+']"  type="text" class="form-control" placeholder="Number"></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Expiry Date</label><span class="asterisk" style="color:red" >*</span><input name="data[country_expiry]['+a+']" id="country_expiry_'+a+'" onblur="" type="text" class="form-control" placeholder="Expiry Date"></div></div></div>')
					$("#ico_list").append('<div class="panel-body" id="ico_profession_'+a+'"><div class="col-md-4 col-sm-12 col-xs-12"><label>Country</label>'+mand+'<div class="form-group"><select name="Country" class="form-control" name="data[ico_reg]['+a+']" id="ico_reg_'+a+'" disabled="disabled">'+country_list+'</select></div></div><div class="col-md-4 col-sm-12 col-xs-12"><div class="form-group"> <label>Number</label>'+mand+'<input type="text" class="form-control" placeholder="Number" name="data[ico_number]['+a+']" id="ico_number_'+a+'"></div></div><div class="col-md-4 col-sm-12 col-xs-12"><div class="form-group"><label>Expiry Date</label>'+mand+'<input type="text" class="form-control" placeholder="Expiry Date" name="data[ico_expiry]['+a+']" id="ico_expiry_'+a+'"></div></div></div>')
					$("#indemnity_list").append('<div class="panel-body" id="indemnity_profession_'+a+'"><div class="col-md-3 col-sm-12 col-xs-12"><label>Country</label>'+mand+'<div class="form-group"><select name="Country" class="form-control" name="data[indemnity_reg]['+a+']" id="indemnity_reg_'+a+'" disabled="disabled">'+country_list+'</select></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><label>Name of company</label>'+mand+'<input type="text" class="form-control" placeholder="Name of company" name="data[indemnity_company]['+a+']" id="indemnity_company_'+a+'"></div></div><div class="col-md-3 col-sm-12 col-xs-12"> <div class="form-group"><label>Number</label>'+mand+'<input type="text" name="data[indemnity_number]['+a+']" class="form-control" placeholder="Number" id="indemnity_number_'+a+'"></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><label>Expiry Date</label>'+mand+'<input type="text" class="form-control" placeholder="Expiry Date" name="data[indemnity_expiry]['+a+']" id="indemnity_expiry_'+a+'"></div></div></div>');
					var country_list = $('.country_li');
					country_list.empty();
					for (var i = 0, len = elements.length; i < len; i++) {
						if( elements[i].value !=''){
							upload_options					+= '<option value="'+elements[i].value+'">'+country_name[elements[i].value]+'</option>';
						}
					}
					$('.country_li').html(upload_options);
					
					$("#country_expiry_"+a).datepicker({
						changeMonth: true,
						changeYear: true,
						dateFormat: "dd/mm/yy",
						yearRange : "-100:+50"
					});
					$("#ico_expiry_"+a).datepicker({
						changeMonth: true,
						changeYear: true,
						dateFormat: "dd/mm/yy",
						yearRange : "-100:+50"
					});
					$("#indemnity_expiry_"+a).datepicker({
						changeMonth: true,
						changeYear: true,
						dateFormat: "dd/mm/yy",
						yearRange: "-100:+50"
					});
					$("#country_reg_"+a).val(country_id);
					$("#ico_reg_"+a).val(country_id);
					$("#indemnity_reg_"+a).val(country_id);
					$("#profess_reg").show();
					$("#ico_registration").show();
					$("#indemnity_registration").show();
				}
			}else{
				$("#country_prof_"+a).val('');
				$("#country_profession_"+a).remove();
				$("#ico_profession_"+a).remove();
				$("#indemnity_profession_"+a).remove();
				
			}
		}
		
		function regis_category(country,a,prof_dl){
			var url 	="<?php echo base_url(); ?>account_setup/country_register_categories";
			$.post(url,{country : country,prof:prof_dl},function(response){
				 if(response.trim() ==''){
					var content 	='<option value="">Select</option>';
					$("#country_reg_cat_"+a).html(content);
				}else{
					$("#country_reg_cat_"+a).html(response);
				}
			});
		}
		
		$("#country_id").change(function(){
			$('#zipcode').val('');
			$('#state').val('');
			$('#town').val('');
			$('#address').val('');
		});
		//added by vajesh for address search //
		$("#zipcode").keyup(function(){
			var code 	 							= $("#zipcode").val();
			var country  							= $("#country_id").val();
			if(country.trim() == ''){
				//alert('Please Choose Country..');
				return false;
			}else if(code.trim()	== ''){
				$('#state').val('');
				$('#town').val('');
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
						$("#town").val('');
						$("#state").val('');
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
										$("#town").val(address[add_len	- cnt].long_name);
									}
									cnt--;
								}
							}
							if(address[add_len - cnt]){
								if(address[add_len - cnt].long_name.length > 0){
									$("#state").val(address[add_len - cnt].long_name);
								}
							}
						}
					}else{
						$('#state').val('');
						$('#town').val('');
						$('#address').val('');
					}
				});
			}
		}); 
    </script>
	<script>
 
		<?php
			if (count($prof_reg) >0){
				$cc			= count($prof_reg)-1 ;
				for($i=1;$i<=$cc;$i++){ ?>
					$("#country_expiry_<?php echo $i ?>").datepicker({
						changeMonth: true,
						changeYear: true,
						dateFormat: "dd/mm/yy",
						yearRange : "-100:+50"
					});
					$("#ico_expiry_<?php echo $i ?>").datepicker({
						changeMonth: true,
						changeYear: true,
						dateFormat: "dd/mm/yy",
						yearRange : "-100:+50"
					});
					$("#indemnity_expiry_<?php echo $i ?>").datepicker({
						changeMonth: true,
						changeYear: true,
						dateFormat: "dd/mm/yy",
						yearRange : "-100:+50"
					});
					<?php
				}
			}
		?>
 
	</script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyB30YkpVyTfcPsQkwNiiBLE2a-C5EHYFSA&libraries=places"></script>
    <script type="text/javascript">
	
    function search_address(){
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
	
	$("#Phone").keypress(function(e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 43 && e.which > 31 ) {
			return false;
		}
	});
	
	$("#Mobile").keypress(function(e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 43 && e.which > 31 ) {
			return false;
		}
	});
	
	$("#title").change(function(){
		if($(this).val() == ''){
			$("#gender").val('');
			$("#gender"). removeAttr("disabled");
		}else{
			if($(this).val()  == 'Mr'){
				$("#gender").val('Male');
				$("#gender").attr('disabled','true');
			}else if($(this).val()  == 'Miss' || $(this).val()  == 'Mrs'){
				$("#gender").val('Female');
				$("#gender").attr('disabled','true');
			}else if($(this).val()  == 'Ms'){
				$("#gender").val('Transgender');
				$("#gender").attr('disabled','true');
			}else if($(this).val()  == 'Dr'){
				$("#gender").val('');
				$("#gender"). removeAttr("disabled");
			}
		}
	});
	
	function save_data(){
		var title 				= $("#title").val();
		var gender 				= $("#gender").val();
		var first_name 			= $("#first_name").val();
		var last_name 			= $("#last_name").val();
		var dob					= $("#datepicker").val();
		var Mobile				= $("#Mobile").val();
		var Email				= $("#Email").val();
		var country_id			= $("#country_id").val();
		var zipcode				= $("#zipcode").val();
		var town				= $("#town").val();
		var state				= $("#state").val();
		var Address				= $("#address").val();
		var Phone				= $("#Phone").val();
		var Lang				= $("#language_id").val();
		var ethinic				= $("#ethinic_id").val();
		
		//var file_data			= '';
		if(title == ""){
			$("#title").focus();
			$("#title").css('border','1px solid #ff1a1c');
		}else if(gender == ""){
			$("#gender").focus();
			$("#gender").css('border','1px solid #ff1a1c');
		}else if(first_name.trim() == ""){
			$("#first_name").focus();
			$("#first_name").css('border','1px solid #ff1a1c');
		}else if(last_name == ""){
			$("#last_name").focus();
			$("#last_name").css('border','1px solid #ff1a1c');
		}else if(dob.trim() == ""){
			$("#dob").focus();
			$("#dob").css('border','1px solid #ff1a1c');
		}else if(Mobile.trim() == ""){
			$("#Mobile").focus();
			$("#Mobile").css('border','1px solid #ff1a1c');
		}else if(Email.trim() == ""){
			$("#Email").focus();
			$("#Email").css('border','1px solid #ff1a1c');
		}else if(country_id == ""){
			$("#country_id").focus();
			$("#country_id").css('border','1px solid #ff1a1c');
		}else if(zipcode.trim() == ""){
			$("#zipcode").focus();
			$("#zipcode").css('border','1px solid #ff1a1c');
		}else if(town.trim() == ""){
			$("#town").focus();
			$("#town").css('border','1px solid #ff1a1c');
		}else if(state.trim() == ""){
			$("#state").focus();
			$("#state").css('border','1px solid #ff1a1c');
		}else if(Address.trim() == ""){
			$("#address").focus();
			$("#address").css('border','1px solid #ff1a1c');
		}else if(Lang == "" || Lang == null){
			$(".lang").focus();
			$(".lang").css('border','1px solid #ff1a1c');
		}else if(ethinic == "" || ethinic == null){
			$("#ethinic_id").focus();
			$("#ethinic_id").css('border','1px solid #ff1a1c');
		}else{
			var form_data 			= new FormData();
			var obj					= document.getElementById('FileUpload1');
			if($("#FileUpload1").val() !=''){
				form_data.append('file', obj.files[0]);
			}
			form_data.append('title', title);
			form_data.append('gender', gender);
			form_data.append('first_name', first_name.trim());
			form_data.append('last_name', last_name.trim());
			form_data.append('dob', dob.trim());
			form_data.append('mobile', Mobile.trim());
			if(Phone.trim() != ""){
				form_data.append('phone', Phone.trim());
			}
			form_data.append('email', Email.trim());
			form_data.append('country_id', country_id);
			form_data.append('zipcode', zipcode.trim());
			form_data.append('town', town.trim());
			form_data.append('state', state.trim());
			form_data.append('address', Address.trim());
			form_data.append('language',Lang);
			form_data.append('ethinic',ethinic);
			var url	="<?php echo base_url(); ?>account_setup/filling_details";
			$.ajax({
				url: url,
				type: 'POST',
				data: form_data,
				dataType: "json",
				processData: false,
				contentType: false,
				success: function(data){
					if(data.response.trim() == 'success'){
						nxt_tab('doc_reg_personal-resistration');
						$("#last_saved").html("Last Saved :"+data.save_time)
						$("#pDcheck3").iCheck("check");
					}else{
						alert('Please try after sometime..');
					}
				}
			});
		}
	}
	
	
	function save_professional_details(e){
		var list_details								= document.getElementsByClassName('hidden_country');
		var qualifications								= $("#qualifications").val();
		var membership									= $("#membership").val();
		var services									= $("#services").val();
		var exp_years									= $("#exp_years").val();
		var professional_exp							= $("#professional_exp").val();
		//var url											= "<?php echo base_url(); ?>account_setup/save_professional_details";
		for (var i = 0, len = list_details.length; i < len; i++){
			var row_val									= list_details[i].value;
			if(	$("#country_prof_"+row_val).val() == ''	){
				$("#country_prof_"+row_val).focus();
				$("#country_prof_"+row_val).css('border','1px solid #ff1a1c');
				e.preventDefault();
				return false;
			}else if($("#prof_body_"+row_val).val() == ''){
				$("#prof_body_"+row_val).focus();
				$("#prof_body_"+row_val).css('border','1px solid #ff1a1c');
				e.preventDefault();
				return false;
			}else if($("#spl_body_"+row_val+" option").length > 1 &&  $("#spl_body_"+row_val).val() ==''){
				$("#spl_body_"+row_val).focus();
				$("#spl_body_"+row_val).css('border','1px solid #ff1a1c');
				e.preventDefault();
				return false;
			}else if($("#country_reg_cat_"+row_val+" option").length > 1 &&  $("#country_reg_cat_"+row_val).val() ==''){
				$("#country_reg_cat_"+row_val).focus();
				$("#country_reg_cat_"+row_val).css('border','1px solid #ff1a1c');
				e.preventDefault();
				return false;
			}else if($("#country_reg_num_"+row_val).val() ==''){
				$("#country_reg_num_"+row_val).focus();
				$("#country_reg_num_"+row_val).css('border','1px solid #ff1a1c');
				e.preventDefault();
				return false;
			}else if($("#country_expiry_"+row_val).val() ==''){
				$("#country_expiry_"+row_val).focus();
				$("#country_expiry_"+row_val).css('border','1px solid #ff1a1c');
				e.preventDefault();
				return false;
			}else{
				if($("#country_prof_"+row_val).val() == <?php echo $this->config->item('uk_country_code') ?>){
					if($("#ico_number_"+row_val).val() ==''){
						$("#ico_number_"+row_val).focus();
						$("#ico_number_"+row_val).css('border','1px solid #ff1a1c');
						e.preventDefault();
						return false;
					}else if($("#ico_expiry_"+row_val).val() ==''){
						$("#ico_expiry_"+row_val).focus();
						$("#ico_expiry_"+row_val).css('border','1px solid #ff1a1c');
						e.preventDefault();
						return false;
					}else if($("#indemnity_company_"+row_val).val() ==''){
						$("#indemnity_company_"+row_val).focus();
						$("#indemnity_company_"+row_val).css('border','1px solid #ff1a1c');
						e.preventDefault();
						return false;
					}else if($("#indemnity_number_"+row_val).val() ==''){
						$("#indemnity_number_"+row_val).focus();
						$("#indemnity_number_"+row_val).css('border','1px solid #ff1a1c');
						e.preventDefault();
						return false;
					}else if($("#indemnity_expiry_"+row_val).val() ==''){
						$("#indemnity_expiry_"+row_val).focus();
						$("#indemnity_expiry_"+row_val).css('border','1px solid #ff1a1c');
						e.preventDefault();
						return false;
					}
				}
			}
		}
		if(qualifications.trim()  == ''){
			$("#qualifications").focus();
			$("#qualifications").css('border','1px solid #ff1a1c');
			e.preventDefault();
			return false;
		}else if(membership.trim() == ''){
			$("#membership").focus();
			$("#membership").css('border','1px solid #ff1a1c');
			e.preventDefault();
			return false;
		}else if(services =='' || services == null){
			$(".service").focus();
			$(".service").css('border','1px solid #ff1a1c');
			e.preventDefault();
			return false;
		}else if(exp_years.trim() ==''){
			$("#exp_years").focus();
			$("#exp_years").css('border','1px solid #ff1a1c');
			e.preventDefault();
			return false;
		}else if(professional_exp.trim() == ''){
			$("#professional_exp").focus();
			$("#professional_exp").css('border','1px solid #ff1a1c');
			e.preventDefault();
			return false;
		}
	}
	
	function display_uploaded(input,id,div_id){
		if (input.files) {
			var filesAmount 						= input.files.length;
			var html_content 						= '';
			var country_name						= new Array();
			<?php echo $country_l; ?>
			var options 							= '<option value="">Select</option>';
			$('.country_prof').each(function(){
				if($(this).val() !=''){
					options							+= '<option value="'+$(this).val()+'">'+country_name[$(this).val()]+'</option>';
				}
			 });
			var x 									= 0;
			for (i = 0; i < filesAmount; i++) {
				var reader = new FileReader();
				file_name = input.files[i]['name'];
				//   reader.onload = function (event) {
				if(div_id == 'upload_prof' || div_id == 'upload_ico' || div_id == 'upload_idemnity'){
					var html_content = html_content + '<tr role="row" id="'+div_id+'_row_'+x+'"><td style="padding-left:8px;"></td><td tabindex="0" ><a href="#">' + file_name + '</a></td><td tabindex="0" ><div class="form-group"><input id="'+div_id+'_text_row_'+x+'" name="data['+div_id+'_text]['+x+']" type="text" class="form-control" type="text" style="width:99% !important"></div></td><td style="padding-left:8px;"><select id="'+div_id+'_country_'+x+'" name="data['+div_id+'_country]['+x+']" class="form-control country_li" >'+options+'</select></td><td style="padding-left:8px;"><input name="data['+div_id+'_show]['+x+']" type="checkbox" id="'+div_id+'_show_'+x+'" /></td><td><a href="#" class="btn btn-success"><i class="fa  fa-share" data-toggle="tooltip" data-title="Share Document" data-original-title="" title=""></i></a><a href="#" class="btn btn-success"><i class="fa  fa-edit" data-toggle="tooltip" data-title="Edit Title" data-original-title="" title=""></i></a><a href="#" class="btn btn-success" onclick="remove_upload_row('+"'"+div_id+"'"+ ','+x+','+"'"+input.id+"'"+')"><i class="fa  fa-trash" data-toggle="tooltip" data-title="Delete" data-original-title="" title=""></i></a></td></tr>';
				}else{
					var html_content = html_content + '<tr role="row" id="'+div_id+'_row_'+x+'"><td style="padding-left:8px;"></td><td tabindex="0" ><a href="#">' + file_name + '</a></td><td tabindex="0" ><div class="form-group"><input id="'+div_id+'_text_row_'+x+'" name="data['+div_id+'_text]['+x+']" type="text" class="form-control" type="text" style="width:99% !important"></div></td><td style="padding-left:8px;"><input type="checkbox" id="'+div_id+'_show_'+x+'" name="data['+div_id+'_show]['+x+']" /></td><td><a href="#" class="btn btn-success"><i class="fa  fa-share" data-toggle="tooltip" data-title="Share Document" data-original-title="" title=""></i></a><a href="#" class="btn btn-success"><i class="fa  fa-edit" data-toggle="tooltip" data-title="Edit Title" data-original-title="" title=""></i></a><a href="#" class="btn btn-success" onclick="remove_upload_row('+"'"+div_id+"'"+ ','+x+','+"'"+input.id+"'"+')"><i class="fa  fa-trash" data-toggle="tooltip" data-title="Delete" data-original-title="" title=""></i></a></td></tr>';
				}
				x = i + 1;
			}
			if(div_id == 'upload_prof' || div_id == 'upload_ico' || div_id == 'upload_idemnity'){
				html_content		+= '<tr role="row" align="right"><td colspan="6"><span id="'+div_id+'_loader" style="display:none;"><img src="<?php echo base_url(); ?>assets/img/loader.gif"  style="height:50px;" alt="loader" /></span><span id="'+div_id+'_save" class="buttonNext btn btn-success" onclick="upload_files('+"'"+input.id+"'"+','+"'"+div_id+"'"+')"> <i class="fa fa-upload" aria-hidden="true"></i> Upload Files</span></td></tr>';
			}else{
				html_content		+= '<tr role="row" align="right"><td colspan="5"><span id="'+div_id+'_loader" style="display:none;"><img src="<?php echo base_url(); ?>assets/img/loader.gif" style="height:50px;" alt="loader" /></span><span id="'+div_id+'_save" class="buttonNext btn btn-success" onclick="upload_files('+"'"+input.id+"'"+','+"'"+div_id+"'"+')"> <i class="fa fa-upload" aria-hidden="true"></i> Upload Files</span></td></tr>';
			}
			$("#"+id).html(html_content);
			$('#'+div_id).show();
		}
	}
		
	function remove_upload_row(a,b,c){
		var alrt					= confirm('Are you sure do you want to remove this row?');
		var filelist				= document.getElementById(c);
		filelist.files[b]			= {};
		if(alrt){
			$("#"+a+"_row_"+b).remove();
		}
	}
	
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
	function upload_files(a,b){
		var input									= document.getElementById(a);
		var country_name							= new Array();
		<?php echo $country_l; ?>
		var url										= "<?php echo base_url(); ?>account_setup/save_uploaded_files";
		var i = 0, len = input.files.length,file;
		form_data = new FormData();
		var details				= new Array();
		for (; i < len; i++) {
			file = input.files[i];
			if($("#"+b+"_show_"+i).length>0){
				if (form_data) {
					form_data.append("file["+i+"]", file);
				}
				form_data.append("title["+i+"]", $("#"+b+"_text_row_"+i).val());
				if($("#"+b+"_country_"+i).length>0){
					if($("#"+b+"_country_"+i).val() ==''){
						$("#"+b+"_country_"+i).focus();
						$("#"+b+"_country_"+i).css('border','1px solid #ff1a1c');
						return false;
					}else{
						form_data.append("country["+i+"]", $("#"+b+"_country_"+i).val());
					}
				}
				if($("#"+b+"_show_"+i).is(":checked")){
					form_data.append("show["+i+"]", 1)
				}else{
					form_data.append("show["+i+"]", 0)
				}
			}
		}
		if(b == 'upload_prof'){
			form_data.append('file_type','medical_bodies');
		}else if(b == 'upload_ico' || b == 'upload_idemnity'){
			form_data.append('file_type','other_bodies');
			if(b == 'upload_ico'){
				form_data.append('other_body_id','1');
			}else if(b == 'upload_idemnity'){
				form_data.append('other_body_id','2');
			}
		}else{
			form_data.append('file_type','others');
		}
		$("#"+b+"_save").hide();
		$("#"+b+"_loader").show();
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
					$("#"+b+"_save").show();
					$("#"+b+"_loader").hide();
					var html_content			= '';
					var show					= 0;
					if(data.details.length> 0){
						for(i=0;i<data.details.length;i++){
							if(data.details[i].show_public == 0){
								show		="Private";
							}else if(data.details[i].show_public == 1){
								show		="Public";
							}
							if(b == 'upload_prof' || b == 'upload_ico' || b == 'upload_idemnity'){
								html_content			+='<tr role="row"><td></td><td tabindex="0"><a href="#">'+data.details[i].title+'</a></td><td tabindex="0" style="padding:5px"><div class="form-group">'+country_name[data.details[i].country_id]+'</div></td><td >'+show+'</td><td><a href="<?php echo base_url(); ?>assets/uploads/'+data.details[i].file_path+data.details[i].file_name+'" target="_blank" class="btn btn-success"><i class="fa fa-eye" data-toggle="tooltip" data-title="Share Document" data-original-title="" title=""></i></a></td></tr>';
							}else{
								html_content			+='<tr role="row"><td></td><td tabindex="0"><a href="#">'+data.details[i].title+'</a></td><td>'+show+'</td><td><a href="<?php echo base_url(); ?>assets/uploads/'+data.details[i].file_path+data.details[i].file_name+'" target="_blank" class="btn btn-success"><i class="fa fa-eye" data-toggle="tooltip" data-title="Share Document" data-original-title="" title=""></i></a></td></tr>';
							}
						}
					}
					if(b == 'upload_prof'){
						tb		='exist_list_prof';
					}else if(b =='upload_ico'){
						tb		= 'exist_list_ico';
					}else if(b =='upload_idemnity'){
						tb		= 'exist_list_idemnity';
					}else{
						tb		= 'exist_other_document';
					}
					$("#"+tb).append(html_content);
					$("#"+b).hide();
					$("#"+b+"_response").html("<span style='color:green;font-size:13px;'>File Uploaded Successfully..</span>&nbsp;&nbsp;&nbsp;");
					$("#"+b+"_exist").show();
					$("#pDcheck7").iCheck("check");
				}else{
					alert("Please try after sometime..");
					$("#"+b+"_save").show();
					$("#"+b+"_loader").hide();
				}
			}
		});
	}
	
	<?php if(isset($data_reg) && $data_reg == 1){ ?>
	$("#pDcheck3").iCheck("check");
	$("#pDcheck6").iCheck("check");
	nxt_tab('doc_reg_personal-upload');
	<?php } ?>
		
		
    </script>
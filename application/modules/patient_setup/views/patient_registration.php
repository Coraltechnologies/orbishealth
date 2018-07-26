			<style>
				.avg-profile-img {
					width: 120px;
					height: 120px;
				}
		
				.up-cho-btn {
					display: none;
				}
		
				#fileselector {
					margin: 10px;
				}
		
				#upload-file-selector {
					display: none;
				}
		
				.margin-correction {
					margin-right: 10px;
				}
		
				.table-fixed thead {
					width: 97%;
				}
		
				.table-fixed tbody {
					height: 230px !important;
					overflow-y: auto;
					width: 100%;
				}
				.pro_reg_border {
					border: 1px solid #ddd;
					padding: 10px;
					margin: 10px;
				}
			</style>
			<link href="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
			<link href="<?php echo base_url(); ?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
		    <!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->
               <div class="form-horizontal form-label-left row custom_temp">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a id="pat_reg_personal-details" data-toggle="tab" href="#pat_det">
                                    Patient Details <input type="checkbox" id="pDcheck" class="flat" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </a>
                            </li>
                            <li>
                                <a id="pat_reg_demographic" data-toggle="tab" href="#demog">
                                    Demographic  <input type="checkbox" id="pDcheck1" class="flat" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </a>
                            </li>
                            <li>
                                <a id="pat_reg_personal-family" data-toggle="tab" href="#menu2">
                                    Family <input type="checkbox" id="pDcheck2" class="flat" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </a>
                            </li>
                            <li>
                                <a id="pat_reg_personal-gp" data-toggle="tab" href="#menu3">
                                    GP  <input type="checkbox" id="pDcheck3" class="flat" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </a>
                            </li>
                            <li>
                                <a id="pat_reg_personal-chemist" data-toggle="tab" href="#menu4">
                                    Chemist  <input type="checkbox" id="pDcheck4" class="flat" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </a>
                            </li>
                            <li>
                                <a id="pat_reg_personal-carer" data-toggle="tab" href="#menu5">
                                    Career <input type="checkbox" id="pDcheck5" class="flat" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </a>
                            </li>
                            <li>
                                <a id="pat_reg_personal-documents" data-toggle="tab" href="#menu6">
                                    Documents <input type="checkbox" id="pDcheck6" class="flat" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </a>
                            </li>
                            <li>
                                <a id="pat_reg_personal-notes" data-toggle="tab" href="#menu61">
                                    Notes <input type="checkbox" id="pDcheck7" class="flat" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </a>
                            </li>
                            <li>
                                <a id="pat_reg_personal-consent" data-toggle="tab" href="#menu7">
                                    Consent <input type="checkbox" id="pDcheck8" class="flat" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </a>
                            </li>
                            <li><a id="pat_reg_personal-alerts" data-toggle="tab" href="#menu8" id="alert_color">Alerts</a></li>
							<li>
								<a data-toggle="tab" id="response" style="color:green"> </a>
							</li>
                        </ul>
                        <div class="tab-content">
                            <div id="pat_det" class="tab-pane fade in active">
                                <p></p>
                                <div class="x_panel">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12 personal-info">
                                            <div class="panel-group">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                      Personal Profile
                                                    </div>
                                                    <div class="panel">
                                                        <div class="panel-body">
                                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                                <div class="text-center">
                                                                	<?php if(!($patient_details['img_name']) && !($patient_details['img_path'])){
																	?>	
																		<img id="blah" src="<?php echo base_url(); ?>assets/img/profile-image.png" class="avg-profile-img img-circle img-thumbnail" style="height:125px;width:125px;" alt="Profile">
																	<?php
																		}else{
																	?>
																		<img id="blah" src="<?php echo base_url().'assets/uploads/'.$patient_details['img_path'].$patient_details['img_name']; ?>" class="avg-profile-img img-circle img-thumbnail" style="height:125px;width:125px;" alt="Profile">
																	<?php } ?>
																    <div></div>
                                                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                                                        <input type="file" id="FileUpload1" class="center-block well well-sm" onchange="readURL(this);" style="width: 100px; !important;padding: 6px;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-10 col-sm-6 col-xs-12 profile-details">
                                                                <div class="row">
                                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                                        <label>Title</label>
																		<span class="asterisk" style="color:red">*</span>
                                                                        <div class="form-group">
                                                                        	<?php
																				$attr	=array('class'=>'form-control','id'=>'title');
																				$title_options	= array(''=>'Select','Dr'=>'Dr','Mr'=>'Mr','Ms'=>'Ms','Mrs'=>'Mrs','Miss'=>'Miss');
																				echo form_dropdown('Title', $title_options,(isset($patient_details['title']) ? $patient_details['title'] : ''),$attr);
																			?>
                                                                        </div>
                                                                    </div>
																	<input type="hidden" id="user_key" value="<?php if(isset($user_key)){echo $user_key;} ?>" />
																	<div class="col-md-3 col-sm-12 col-xs-12">
																		<label>Gender</label>
																		<span class="asterisk" style="color:red">*</span>
																		<div class="form-group">
																			<?php
																				$attr	=array('class'=>'form-control','id'=>'gender');
																				$title_options	= array(''=>'Select','Male'=>'Male','Female'=>'Female','Transgender'=>'Transgender');
																				echo form_dropdown('Gender', $title_options,(isset($patient_details['gender']) ? $patient_details['gender'] : ''),$attr);
																			?>
																			
																		</div>
																	</div>
                                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>First Name</label>
                                                                            <span class="asterisk" style="color:red">*</span>
																			<input id="first_name" type="text" class="form-control" placeholder="First Name" value="<?php if(!empty($patient_details) && $patient_details['firstname'] ){echo $patient_details['firstname'];} ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>Middle Name</label>
																			<input id="middle_name" type="text" class="form-control" placeholder="Middle Name" value="<?php if(!empty($patient_details) && $patient_details['middlename'] ){echo $patient_details['middlename'];} ?>">
																		</div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>Last Name</label>
                                                                        	<span class="asterisk" style="color:red">*</span>
																			<input id="last_name" type="text" class="form-control" placeholder="Last Name" value="<?php if(!empty($patient_details) && $patient_details['lastname'] ){echo $patient_details['lastname'];} ?>">
																		</div>
                                                                    </div>
																	<?php //if(!empty($details) && $details['country_id'] == $this->config->item('uk_country_code')){ ?>
																	<div class="col-md-3 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>NHS/Aadhaar/Social Security</label>
                                                                            <input class="form-control" id="txtProfNHSNo" name="NHSNo" placeholder="Identity No" type="text" value="<?php if(!empty($patient_details) && $patient_details['nhs_no'] ){echo $patient_details['nhs_no'];} ?>">
                                                                        </div>
                                                                    </div>
																	<?php // } ?>
																	
                                                                    <div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper">
                                                                        <div class="">
                                                                            <div class="xdisplay_inputx form-group">
                                                                                <label>DOB</label>
                                                                                <span class="asterisk" style="color:red">*</span>
																				
																				<input type="text" class="form-control" id="datepicker" placeholder="dd/mm/yy" value="<?php if(!empty($patient_details) && $patient_details['dob']){echo date('d/m/Y',strtotime($patient_details['dob']));} ?>" onchange="ageCount();">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6 col-xs-12 form-text-wrapper">
                                                                        <div class="form-group">
                                                                            <label>Age</label>
																			<?php
																			$diff		='';
																			if(!empty($patient_details) && $patient_details['dob']){
																				$dob	= $patient_details['dob'];
																				$diff 	= (date('Y') - date('Y',strtotime($dob)));
																			}else{
																				$diff	='';
																			}
																			?>
																			<input type="hidden" value="<?php echo $diff; ?>" id="age_hide" />
                                                                            <input id="ageId" type="text" class="form-control" placeholder="age" disabled='disabled' value="<?php echo $diff; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                         Address
                                                    </div>
                                                    <div class="panel">
                                                        <div class="panel-body">

                                                            <div class="col-md-8 col-sm-12 col-xs-12 profile-details">
                                                                <div class="row">
                                                                    <div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper">
                                                                        <div class="form-group">
                                                                            <label for="sel1">Country</label>
																			<span class="asterisk" style="color:red">*</span>
                                                                            <?php
																				$attr	=array('class'=>'form-control','id'=>'country_id');
																				echo form_dropdown('Country', $country['name'],(isset($patient_details['country_id']) ? $patient_details['country_id'] : ''),$attr);
																			?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>Postcode</label>
																			<span class="asterisk" style="color:red">*</span>
                                                                           <!-- <input type="text" class="form-control" placeholder="Postcode">-->
																		    <input type="text" class="form-control" placeholder="Postcode" id="zipcode" value="<?php if(!empty($patient_details) && $patient_details['postcode']){echo $patient_details['postcode'];} ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>City / Town</label>
																			<span class="asterisk" style="color:red">*</span>
																			<input type="text" class="form-control" placeholder="City / Town" id="town" value="<?php if(!empty($patient_details) && $patient_details['city_town']){echo $patient_details['city_town'];} ?>">
                                                                            <!--<input type="text" class="form-control" placeholder="City / Town">-->
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>State</label>
																			<span class="asterisk" style="color:red">*</span>
																			<input type="text" class="form-control" placeholder="State" id="state" value="<?php if(!empty($patient_details) && $patient_details['state']){echo $patient_details['state'];} ?>">
                                                                            <!--<input type="text" class="form-control" placeholder="State">-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-12 col-xs-12 form-text-wrapper">
                                                                <div class="form-group">
                                                                    <label>Address</label>
																	<span class="asterisk" style="color:red">*</span>
																	<input type="text" class="form-control" rows="4" placeholder="Address" id="address" onkeyup="search_address();" value="<?php if(!empty($patient_details) && $patient_details['address']){echo $patient_details['address'];} ?>" />
                                                                    <!--<textarea class="form-control" rows="5" placeholder="Address"></textarea>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        Contact
                                                    </div>
                                                    <div class="panel">
                                                        <div class="panel-body profile-details">
                                                            <div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper">
                                                                <div class="form-group">
                                                                    <label>Home</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <input type="checkbox">
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="+123 4567 890" id="home_mobile" value="<?php if(!empty($patient_details) && $patient_details['mobile']){echo $patient_details['home_telephone'];} ?>" onkeypress="return restrict_keys(event)">
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
                                                                        <input type="text" class="form-control" placeholder="+123 4567 890" id="work_mobile" value="<?php if( !empty($patient_details) && $patient_details['mobile']){echo $details['work_telephone'];} ?>" onkeypress=" return restrict_keys(event)">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper">
                                                                <div class="form-group">
                                                                    <label>Mobile</label>
																	<span class="asterisk" style="color:red">*</span>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <input type="checkbox">
                                                                        </span>
                                                                        <input type="text" class="form-control" placeholder="+123 4567 890" id="Mobile" value="<?php if(!empty($patient_details) && $patient_details['mobile']){echo $patient_details['mobile'];} ?>" onkeypress="return restrict_keys(event)">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper">
                                                                <div class="form-group">
                                                                    <label>Email </label>
																	<span class="asterisk" style="color:red">*</span>
                                                                    <div class="form-group">
																		<input id="Email" onblur="" type="text" class="form-control" placeholder="Email" value="<?php if(!empty($patient_details) && $patient_details['primary_email']){echo $patient_details['primary_email'];} ?>" >
                                                                        <!--<input type="text" class="form-control" id="inputSuccess4" placeholder="Email ">-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default" id="minor_div" style="<?php if($diff == ''){echo 'display:none';}else if($diff >16){echo 'display:none';}?>">
                                                    <div class="panel-heading">
                                                        For Minors < 16 (Parent / Guardian Details)
													</div>
                                                    <div class="panel">
                                                        <div class="input_fields_wrap">
                                                            <div class="panel-body">

                                                                <div class="col-md-7 col-sm-12 col-xs-12 profile-details">
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                                            <label>Title</label>
																			<span class="asterisk" style="color:red">*</span>
                                                                            <div class="form-group">
																				<?php
																					$attr	=array('class'=>'form-control','id'=>'minor_title');
																					$title_options	= array(''=>'Select','Dr'=>'Dr','Mr'=>'Mr','Ms'=>'Ms','Mrs'=>'Mrs','Miss'=>'Miss');
																					echo form_dropdown('Title', $title_options,(isset($patient_minor['title']) ? $patient_minor['title'] : ''),$attr);
																				?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                                            <div class="form-group">
                                                                                <label>Parent</label>
																				<span class="asterisk" style="color:red">*</span>
                                                                                <input type="text" class="form-control" placeholder="Name" id="minor_name"  value="<?php if(!empty($patient_minor) && $patient_minor['name']){echo $patient_minor['name'];} ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                                            <div class="form-group">
                                                                                <label>Relationship</label>
																				<span class="asterisk" style="color:red">*</span>
																				<?php
																					$attr	=array('class'=>'form-control','id'=>'relationship_id');
																					echo form_dropdown('Relationship', $relationship,(isset($patient_minor['relationship_id']) ? $patient_minor['relationship_id'] : ''),$attr);
																				?>
																				
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                                            <div class="form-group">
                                                                                <label>Tel</label>
																				<span class="asterisk" style="color:red">*</span>
                                                                                <input type="text" class="form-control" placeholder="+123 4567 890" id="minor_mobile" value="<?php if(!empty($patient_minor) && $patient_minor['mobile']){echo $patient_minor['mobile'];} ?>" onkeypress="return restrict_keys(event)">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-sm-12 col-xs-12 form-text-wrapper">
                                                                    <div class="form-group">
                                                                        <label>Address</label>
																		<span class="asterisk" style="color:red">*</span>
                                                                        <textarea class="form-control" rows="3" placeholder="Address" id='minor_address'><?php if(!empty($patient_minor) && $patient_minor['address']){echo $patient_minor['address'];} ?></textarea>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input" id="cbxMinorImportAddress" onchange="fill_address(this,'minor_address')" <?php if($patient_details['address'] && isset($patient_minor['address']) && $patient_minor['address'] == $patient_details['address']){echo "checked";} ?>>
                                                                        <label class="form-check-label" for="exampleCheck1">Import home address</label>
                                                                    </div>
                                                                </div>
                                                                <!---<div class="col-sm-1 col-md-1">
                                                                    <div class="form-group">
                                                                        <label>Action</label>
                                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                                            <button type="button" class="add_field_button btn btn-default btn-sm">
                                                                                <span class="glyphicon glyphicon-plus"></span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        Next to Kin
                                                    </div>
                                                    <div class="panel">
                                                        <div class="panel-body">

                                                            <div class="col-md-6 col-sm-12 col-xs-12 profile-details">
                                                                <div class="row">
                                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                                        <label>Title</label>
                                                                        <div class="form-group">
																			<?php
																				$attr	=array('class'=>'form-control','id'=>'next_title');
																				$title_options	= array(''=>'Select','Dr'=>'Dr','Mr'=>'Mr','Ms'=>'Ms','Mrs'=>'Mrs','Miss'=>'Miss');
																				echo form_dropdown('Title', $title_options,(isset($patient_nxt['title']) ? $patient_nxt['title'] : ''),$attr);
																			?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>Name</label>
                                                                            <input type="text" class="form-control" placeholder="Name" id='next_name' value="<?php if(!empty($patient_nxt) && $patient_nxt['name']){echo $patient_nxt['name'];} ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>Tel</label>
                                                                            <input type="text" class="form-control" placeholder="+123 4567 890" id='next_mobile'  value="<?php if(!empty($patient_nxt) && $patient_nxt['mobile']){echo $patient_nxt['mobile'];} ?>" onkeypress="return restrict_keys(event)">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-12 col-xs-12 form-text-wrapper">
                                                                <div class="form-group">
                                                                    <label>Address</label>
                                                                    <textarea class="form-control" rows="3" placeholder="Address" id="next_address"><?php if(!empty($patient_nxt) && $patient_nxt['address']){echo $patient_nxt['address'];} ?></textarea>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="cbxMinorImportAddress" onchange="fill_address(this,'next_address')" <?php if(isset($patient_details['address']) && isset($patient_nxt['address']) && $patient_nxt['address'] == $patient_details['address']){echo "checked";} ?>>
                                                                    <label class="form-check-label" for="exampleCheck1">Import home address</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="actionBar">
                                        <a href="javascript:void(0);" class="buttonNext btn btn-success" onclick="save_details();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save and Continue <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div id="demog" class="tab-pane fade">
                                <p></p>
                                <div class="x_panel">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12 personal-info">
                                            <div class="panel-group">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        Demographic
                                                    </div>
                                                    <div class="panel">
                                                        <div class="panel-body profile-details">
                                                            <div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
                                                                <div class="form-group">
                                                                    <label>Ethinic Origin</label>
																	<span class="asterisk" style="color:red">*</span>
                                                                    <div class="form-group">
																		<?php
																			$attr	=array('class'=>'form-control','id'=>'ethinic_id');
																			echo form_dropdown('Title', $ethinic_details,(isset($patient_details['ethinic_origin']) ? $patient_details['ethinic_origin'] : ''),$attr);
																		?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
                                                                <div class="form-group">
                                                                    <label>Languages Spoken</label>
																	<span class="asterisk" style="color:red">*</span>
                                                                    <span class="multiselect-native-select">
                                                                        <?php
																			$lang				= array();
																			if(!empty($patient_details) && $patient_details['languages']){
																				$lang			= explode(',',$patient_details['languages']);
																			}
																			$attr				= array('class'=>'multiselect-ui form-control multiservicelist multiselect-native-select','id'=>'language_id','multiple'=>'multiple');
																			echo form_dropdown('Languages', $languages,$lang,$attr);
																		?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
                                                                <div class="form-group">
                                                                    <label>Martial Status</label>
																	<?php
																	$diff	= '';
																	if(isset($diff) && $diff !='' && $diff < 16 ){
																		$attr									= array('class'=>'form-control','id'=>'marital_status','disabled'=>true);
																		$patient_details['marital_status'] 		= '';
																	}else{
																		$attr									= array('class'=>'form-control','id'=>'marital_status');
																	}
																	$attr										= array('class'=>'form-control','id'=>'marital_status');
																	echo form_dropdown('Martial', $marital_list,(isset($patient_details['marital_status']) ? $patient_details['marital_status'] : ''),$attr);
																	?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="actionBar">
                                        <a href="javascript:void(0);" class="buttonPrevious btn btn-primary" onclick="nxt_tab('pat_reg_personal-details');"><i class="fa fa-angle-left" aria-hidden="true"></i> Previous</a>
                                        <a href="javascript:void(0);" class="buttonNext btn btn-success"  onclick="save_demography();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save and Continue <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <p></p>
                                <div class="x_panel">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
									        Family
                                        </div>
                                        <div class="">
											<form action="#" method="post" enctype="multipart/form-data" id="family_form">
                                            <div class="input_fields_wrap1">
                                                <div class="panel-body" id="family_row_0">
													<input type="hidden" value='0' id="family_count" />
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control" name='data[family_name][0]' placeholder="Name" id="family_name_0">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                                <label>Relationship to the Reg user</label>
                                                                <div class="form-group">
                                                                    <?php
																		$attr	=array('class'=>'form-control','id'=>'family_relation_0');
																		echo form_dropdown('data[family_relation][0]', $relationship,'',$attr);
																	?>
																</div>
                                                            </div>
															<div class="col-md-6 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Tel</label>
                                                                    <input type="text" class="form-control" placeholder="+123 4567 890" value="<?php //if(isset($details['country_id'])){echo $country['mobile'][$details['country_id']]; }  ?>" id='family_tel_0' name='data[family_tel][0]' onkeypress="return restrict_keys(event)">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Contact</label>
                                                                    <input type="text" class="form-control" placeholder="+123 4567 890"  value="<?php //echo $country['mobile'][$details['country_id']]  ?>" id='family_contact_0' name='data[family_contact][0]' onkeypress="return restrict_keys(event)">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Age</label>
                                                                    <input type="number" class="form-control" placeholder="Age" id='family_age_0' name='data[family_age][0]'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 col-xs-12 form-text-wrapper">
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <textarea class="form-control" rows="3" placeholder="Address" id="family_address_0" name='data[family_address][0]'></textarea>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="cbxMinorImportAddress" onchange="fill_address(this,'family_address_0')">
                                                            <label class="form-check-label" for="exampleCheck1">Import home address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 col-md-2">
                                                        <div class="form-group">
                                                            <label>Add More</label><br>
                                                            <button type="button" class="add_field_button1 btn btn-default btn-sm">
																<span class="glyphicon glyphicon-plus"></span>
															</button>
															<button type="button" class="add_field_button btn btn-default btn-sm" onclick="clearPtD(0)">
																<span class="pull-right"><i  class="fa fa-eraser" data-toggle="tooltip" data-title="Clear all data" data-original-title="" title=""></i></span>
															</button>
														</div>
                                                    </div>
                                                </div>
                                            </div>
											</form>
										</div>
                                    </div>
									<div class="row">
									 <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Family Details :</div>
											<div id="family_div_id">
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
																<p class="summary_view_text"><?php if($value['age']){echo $value['age'].'Years';} ?> </p>
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
														<div class="col-md-2 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Contact</label>
																<p class="summary_view_text"><?php if($value['home']){echo $value['home'];} ?></p>
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
															<label>No records uploaded...</label>
														</div>
													</div>
												</div>
											<?php } ?>
											</div>
										</div>
                                    </div>
									</div>
									
                                    <div class="actionBar">
                                        <a href="javascript:void(0);" class="buttonPrevious btn btn-primary" onclick="nxt_tab('pat_reg_demographic');"><i class="fa fa-angle-left" aria-hidden="true"></i> Previous</a>
                                        <a href="javascript:void(0);" class="buttonNext btn btn-success"  onclick="save_family_details();">Next <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
							
							
							
                            <div id="menu3" class="tab-pane fade">
                                <p></p>
								
                                <div class="x_panel">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="input_fields_wrap2">
												<form action="#" method="post" enctype="multipart/form-data" id="gp_form">
										   
										        <div class="row"  id="gp_row_0">
                                                    <div class="col-md-5 col-sm-12 col-xs-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                GP Details / Contact Info
                                                            </div>
                                                            <div class="input_fields_wrap">
																<input type="hidden" value='0' id="gp_count" />
                                                                <div class="panel-body" style="height:272px;">
																	<div class="col-md-12 col-sm-12 col-xs-12 profile-details">
                                                                        <div class="row">
                                                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label>Practice Name</label>
																					<span class="asterisk" style="color:red">*</span>
                                                                                    <input type="text" class="form-control" name='data[gp_practice_name][0]' id="gp_practice_name_0" placeholder="Practice Name">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label>Doctor</label>
																					<span class="asterisk" style="color:red">*</span>
                                                                                    <input type="text" class="form-control" placeholder="Doctor" name='data[gp_doctor_name][0]' id="gp_doctor_name_0" >
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label>Tel 1</label>
																					<span class="asterisk" style="color:red">*</span>
                                                                                    <input type="text" class="form-control" value="<?php //echo $country['mobile'][$details['country_id']]  ?>" placeholder="+123 456 7890" name='data[gp_tel1][0]' id="gp_tel1_0" onkeypress="return restrict_keys(event)">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label>Tel 2</label>
                                                                                    <input type="text" class="form-control" placeholder="+123 456 7890" name='data[gp_tel2][0]' onkeypress="return restrict_keys(event)" id="gp_tel2_0">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                <div class="form-group">
                                                                                    <label>Email</label>
																					<span class="asterisk" style="color:red">*</span>
                                                                                    <input type="email" class="form-control" placeholder="Email" name='data[gp_email][0]' id="gp_email_0">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
																	
																	
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                Address Details
                                                            </div>
                                                            <div class="panel-body">
																<div class="row">
                                                                    <div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper">
                                                                        <div class="form-group">
                                                                            <label for="sel1">Country</label>
																			<span class="asterisk" style="color:red">*</span>
                                                                            	<?php
																					$attr	=array('class'=>'form-control','id'=>'gp_country_0');
																					echo form_dropdown('data[gp_country][0]', $country['name'],'',$attr);
																				?>
																		</div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>Postcode</label>
																			<span class="asterisk" style="color:red">*</span>
                                                                            <input type="text" class="form-control" placeholder="Postcode" name='data[gp_postcode][0]' id="gp_postcode_0">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>City / Town</label>
																			<span class="asterisk" style="color:red">*</span>
                                                                            <input type="text" class="form-control" placeholder="City / Town" name='data[gp_town][0]' id="gp_town_0">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>State</label>
																			<span class="asterisk" style="color:red">*</span>
                                                                            <input type="text" class="form-control" placeholder="State" name='data[gp_state][0]' id="gp_state_0">
                                                                        </div>
                                                                    </div>
																	<div class="col-md-12 col-sm-12 col-xs-12 form-text-wrapper">
																		<div class="form-group">
																			<label>Address</label>
																			<span class="asterisk" style="color:red">*</span>
																			<textarea class="form-control" rows="3" placeholder="Address" name='data[gp_address][0]' id="gp_address_0"></textarea>
																		</div>
																	</div>
																 </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 col-md-1">
                                                        <div class="form-group">
														    <label>Add More</label>
															<div class="col-md-12 col-sm-12 col-xs-12" >
                                                                <button type="button" class="add_field_button2 btn btn-default btn-sm">
                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                </button>
                                                            </div>
															<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:8px;">
																<button type="button" class="btn btn-default btn-sm" title="Import Gp record" onclick="import_record(0);">
																	<i class="fa fa-download"></i>
																</button>
															</div>
                                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:8px;">
                                                                <button type="button" onclick="clearGP(0)" class="btn btn-default btn-sm">
                                                                    <i class="fa fa-eraser"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                           </form>
										   </div>
										
											
										<div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="panel panel-default">
													<div class="panel-heading">GP Details :</div>
														<div id="gp_div_id">
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
																		<label>No records uploaded...</label>
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
										</div>
									
									
									
									
									
                                    <div class="actionBar">
                                        <a href="javascript:void(0);" class="buttonPrevious btn btn-primary" onclick="nxt_tab('pat_reg_personal-family');"><i class="fa fa-angle-left" aria-hidden="true"></i> Previous</a>
                                        <a href="javascript:void(0);" class="buttonNext btn btn-success"  onclick="save_gp_details();">Next <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
								</form>
                            </div>
							
							
							
							
                            <div id="menu4" class="tab-pane fade">
                                <p></p>
									<div class="x_panel">
										<div class="input_fields_wrap3">
											<form action="#" method="post" enctype="multipart/form-data" id="chemist_form">
											<div class="row" id="chemist_row_0">
												<div class="col-md-5 col-sm-12 col-xs-12">
													<div class="panel panel-default">
														<div class="panel-heading">
															Chemist Details / Contact Info
														</div>
														<div class="input_fields_wrap">
															<div class="panel-body" style="height:272px;">
																<input type="hidden" value='0' id="chemist_count" />
																<div class="col-md-12 col-sm-12 col-xs-12 profile-details">
																	<div class="row">
																		<div class="col-md-6 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Pharmacy Name</label>
																				<span class="asterisk" style="color:red">*</span>
																				<input type="text" class="form-control" placeholder="Pharmacy Name" name='data[chemist_pharmacy_name][0]'>
																			</div>
																		</div>
																		<div class="col-md-6 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Chemist Name</label>
																				<input type="text" class="form-control" placeholder="Chemist Name" name='data[chemist_name][0]'>
																			</div>
																		</div>
																		<div class="col-md-6 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Tel 1</label>
																				<span class="asterisk" style="color:red">*</span>
																				<input type="text" class="form-control" placeholder="+123 456 7890" value="<?php //echo $country['mobile'][$details['country_id']]  ?>" name='data[chemist_tel1][0]' onkeypress="return restrict_keys(event)">
																			</div>
																		</div>
																		<div class="col-md-6 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Tel 2</label>
																				<input type="text" class="form-control" placeholder="+123 456 7890" name='data[chemist_tel2][0]' onkeypress="return restrict_keys(event)">
																			</div>
																		</div>
																		<div class="col-md-12 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Email</label>
																				<span class="asterisk" style="color:red">*</span>
																				<input type="text" class="form-control" placeholder="Email" name='data[chemist_email][0]'>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6 col-sm-12 col-xs-12">
													<div class="panel panel-default">
														<div class="panel-heading">
															Address Details
														</div>
														<div class="panel-body">
	
															<div class="row">
																<div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper">
																	<div class="form-group">
																		<label for="sel1">Country</label>
																		<span class="asterisk" style="color:red">*</span>
																			<?php
																				$attr	=array('class'=>'form-control','id'=>'country_id');
																				echo form_dropdown('data[chemist_country][0]', $country['name'],'',$attr);
																			?>
																	</div>
																</div>
																<div class="col-md-6 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>Postcode</label>
																		<span class="asterisk" style="color:red">*</span>
																		<input type="text" class="form-control" placeholder="Postcode" name='data[chemist_postcode][0]'>
																	</div>
																</div>
																<div class="col-md-6 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>City / Town</label>
																		<span class="asterisk" style="color:red">*</span>
																		<input type="text" class="form-control" placeholder="City / Town" name='data[chemist_town][0]'>
																	</div>
																</div>
																<div class="col-md-6 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>State</label>
																		<span class="asterisk" style="color:red">*</span>
																		<input type="text" class="form-control" placeholder="State" name='data[chemist_state][0]'>
																	</div>
																</div>
																<div class="col-md-12 col-sm-12 col-xs-12 form-text-wrapper">
																	<div class="form-group">
																		<label>Address</label>
																		<span class="asterisk" style="color:red">*</span>
																		<textarea class="form-control" rows="3" placeholder="Address" name='data[chemist_address][0]'></textarea>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-sm-1 col-md-1">
													<div class="form-group">
														<label>Add More</label>
														<div class="col-md-12 col-sm-12 col-xs-12">
															<button type="button" class="add_field_button3 btn btn-default btn-sm">
																<span class="glyphicon glyphicon-plus"></span>
															</button>
														</div>
														<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:8px;">
															<button type="button" onclick="clearCD(0)" class="btn btn-default btn-sm">
																<i class="fa fa-eraser"></i>
															</button>
														</div>
													</div>
												</div>
											</div>
									
									</form>
									</div>
										<div class="row">
										  <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Chemist Details :</div>
											<div id="chemist_div_id">
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
															<label>No records uploaded...</label>
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
								<div class="actionBar">
									<a href="javascript:void(0);" class="buttonPrevious btn btn-primary" onclick="nxt_tab('pat_reg_personal-gp');"><i class="fa fa-angle-left" aria-hidden="true"></i> Previous</a>
									<a href="javascript:void(0);" class="buttonNext btn btn-success"  onclick='save_chemist_details();'>Next <i class="fa fa-angle-right" aria-hidden="true"></i></a>
								</div>
							</div>
							
							
							
                            <div id="menu5" class="tab-pane fade">
                                <p></p>
								
									<div class="x_panel">
										<div class="input_fields_wrap4">
											<form action="#" method="post" enctype="multipart/form-data" id="career_form">
											<div class="row" id="career_row_0">
												<div class="col-md-5 col-sm-12 col-xs-12">
													<input type="hidden" value="0" id="career_count" />
													<div class="panel panel-default">
														<div class="panel-heading">
															Career Details / Contact Info
														</div>
														<div>
															<div class="panel-body" style="height:272px;">
																<div class="col-md-12 col-sm-12 col-xs-12 profile-details">
																	<div class="row">
																		<div class="col-md-6 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Company Name</label>
																				<input type="text" class="form-control" placeholder="Company Name" name="data[career_company_name][0]">
																			</div>
																		</div>
																		<div class="col-md-6 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Name</label>
																				<input type="text" class="form-control" placeholder="Name" name="data[career_name][0]">
																			</div>
																		</div>
																		<div class="col-md-6 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Tel 1</label>
																				<input type="text" class="form-control" placeholder="+123 456 7890" value="<?php echo $country['mobile'][$details['country_id']]  ?>" name="data[career_tel1][0]" onkeypress="return restrict_keys(event)">
																			</div>
																		</div>
																		<div class="col-md-6 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Tel 2</label>
																				<input type="text" class="form-control" placeholder="+123 456 7890" name="data[career_tel2][0]" onkeypress="return restrict_keys(event)">
																			</div>
																		</div>
																		<div class="col-md-12 col-sm-12 col-xs-12">
																			<div class="form-group">
																				<label>Email</label>
																				<input type="text" class="form-control" placeholder="Email" name="data[career_email][0]">
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6 col-sm-12 col-xs-12">
													<div class="panel panel-default">
														<div class="panel-heading">
															Address Details
														</div>
														<div class="panel-body">
	
															<div class="row">
																<div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper">
																	<div class="form-group">
																		<label for="sel1">Country</label>
																		<?php
																			$attr	=array('class'=>'form-control','id'=>'country_id');
																			echo form_dropdown('data[career_country][0]', $country['name'],'',$attr);
																		?>
																		 
																	</div>
																</div>
																<div class="col-md-6 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>Postcode</label>
																		<input type="text" class="form-control" placeholder="Postcode" name="data[career_postcode][0]">
																	</div>
																</div>
																<div class="col-md-6 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>City / Town</label>
																		<input type="text" class="form-control" placeholder="City / Town" name="data[career_town][0]">
																	</div>
																</div>
																<div class="col-md-6 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>State</label>
																		<input type="text" class="form-control" placeholder="State" name="data[career_state][0]">
																	</div>
																</div>
																<div class="col-md-12 col-sm-12 col-xs-12 form-text-wrapper">
																	<div class="form-group">
																		<label>Address</label>
																		<textarea class="form-control" rows="3" placeholder="Address" name="data[career_address][0]"></textarea>
																	</div>
																</div>
															</div>
															
														</div>
													</div>
												</div>
												
												
												<div class="col-sm-1 col-md-1">
													<div class="form-group">
														<label>Add More</label>
														<div class="col-md-12 col-sm-12 col-xs-12">
															<button type="button" class="add_field_button4 btn btn-default btn-sm">
																<span class="glyphicon glyphicon-plus"></span>
															</button>
														</div>
														<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:8px;">
															<button type="button" onclick="clearCR(0)" class="btn btn-default btn-sm">
																<i class="fa fa-eraser"></i>
															</button>
														</div>
													</div>
												</div>
											</div>
											</form>
											
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="panel panel-default">
													<div class="panel-heading">Career Details :</div>
													<div id="career_div_id">
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
																	<label>State</label>
																	<p class="summary_view_text"><?php if($c_val['state']){echo $c_val['state'];} ?></p>
																</div>
															</div>
														</div>
													<?php }
													}else{
													?>
														<div class="panel-body">
															<div class="col-md-12 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>No records Uploaded...</label>
																</div>
															</div>
														</div>
													<?php } ?>
													
												</div>
											</div>
										</div>
											
										</div>
										<div class="actionBar">
											<a href="javascript:void(0);" class="buttonPrevious btn btn-primary" onclick="nxt_tab('pat_reg_personal-chemist');"><i class="fa fa-angle-left" aria-hidden="true"></i> Previous</a>
											<a href="javascript:void(0);" class="buttonNext btn btn-success" onclick="save_career_details();">Next <i class="fa fa-angle-right" aria-hidden="true"></i></a>
										</div>
									</div>
							</div>
							</div>
                            <div id="menu6" class="tab-pane fade">
                                <p></p>
                                <div class="x_panel">
                                    <div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12 padding-null">
											<div class="col-md-3 padding-null" style="width: auto;">
												<label class="" style="text-align:left !important;">Upload Documents / Files:</label>
											</div>
											<div class="col-md-4">
												<p class="btn btn-primary btn-sm" style="color: #fff;">
													<input class="file-4 upload_btn" id="upload-other" onchange ="display_uploaded(this,'upload_list_files','upload_document');" type="file" multiple=""><i class="fa  fa-upload" data-toggle="tooltip" data-title="Edit Title"></i> Upload
												</p><span id="upload_doc_response"></span>
											</div>
											<div class="col-md-1">
												<p class="btn btn-primary btn-sm" style="color: #fff;display:none">
													<input class="upload_btn" type="button"><i class="fa  fa-save" data-toggle="tooltip" data-title="Edit Title"></i> Save
												</p>
											</div>
										</div>
                                        <div class="col-md-7 col-sm-12 col-xs-12" id="upload_document" style="display:none;" >
                                            <label>Upload Documents / Files</label>
                                            <div class="list-group table-responsive">
                                                <table class="table table-fixed table-striped table-bordered">
                                                    <thead>
                                                        <tr role="row">
                                                            <th><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
                                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Files</th>
                                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
                                                            <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-label="E-mail: activate to sort column ascending">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="upload_list_files" style="height: 10px !important; overflow: scroll; ">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
										<div class="col-md-7 col-sm-12 col-xs-12 padding-null" id="upload_doc_exist" style="<?php if(empty($other_uploads)){ echo 'display:none';} ?>">
											<label style="margin-bottom:10px;color:green;margin-top:15px;">Existing Documents:</label>
											<div class="list-group table-responsive">
												<table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
													<thead>
														<tr role="row">
															<th style="width:5px"><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
															<th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending" style="width:20px !important">Title</th>
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
																<td >
																</td>
																<td tabindex="0" >
																	<a href="#">
																	<?php
																	echo $val_arr['title'];
																	?></a>
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
                                    <div class="actionBar" style="margin-top:380px;">
                                        <a href="javascript:void(0);" class="buttonPrevious btn btn-primary" onclick="nxt_tab('pat_reg_personal-carer');"><i class="fa fa-angle-left" aria-hidden="true"></i> Previous</a>
                                        <a href="javascript:void(0);" class="buttonNext btn btn-success" onclick="nxt_tab('pat_reg_personal-notes');" >Next <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
							
                            <div id="menu61" class="tab-pane fade">
                                <p></p>
                                <div class="x_panel">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label>Notes:</label>&nbsp;&nbsp;&nbsp;&nbsp;<span id="notes_message" style="color:green;"></span>
                                                    <textarea id="notes_text" class="resizable_textarea form-control" placeholder="Notes.."></textarea>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <table class="table table-striped" id='notes_table'>
                                                        <thead>
                                                            <tr>
                                                                <th>Notes</th>
                                                                <th>Added By</th>
                                                                <!--<th>Actions</th>-->
                                                            </tr>
                                                        </thead>
                                                        <tbody id="notes_tbody">
															<?php
															if(!empty($notes)) {
																foreach($notes as $key =>$val){
																	$val_arr		= (array)$val;
																	?>
																	<tr id="note_row_<?php echo $val->id; ?>">
																		<td id="note_text_<?php echo $val->id; ?>">
																			<?php if($val->notes) {echo $val->notes; } ?>
																		</td>
																		<td>
																			<p id="note_time_<?php echo $val->id; ?>" ><?php if($val->modified_date) {echo date("F j, Y, g:i a",strtotime($val->modified_date)); } ?>  <i><?php echo  ' Added by '.ucfirst($val->title.' '.$val->firstname.' '.$val->lastname);  ?></i></p>
																		</td>
																		<td>
																			<div class="form-group">
																				<a class="btn btn-success" href="#note-modal" data-toggle="modal" onclick="edit_notes(<?php echo $val_arr['id'] ?>);" ><i class="fa fa-pencil"></i> </a>
																				<a class="btn btn-success"  onclick="delete_note(<?php echo $val_arr['id'] ?>);"  href="#" data-toggle="tooltip" data-title="Delete Alert" data-original-title="" title=""><i class="fa fa  fa-trash" style="color:#fff;" data-original-title="" title=""></i></a>
																			</div>
																		</td>
																	</tr>
																  <?php
																	} 
															}else{
															?>
																<tr>
																	<td colspan="3">
																		<input type="hidden" id="note_empty" value="1" />
																		No notes found...
																		
																	</td>
																</tr>
															<?php
															}
															?>
                                                            <!--<tr>
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
                                                            </tr>-->
                                                        </tbody>
                                                    </table>
                                                    <div class="pull-right">
                                                        <a href="javascript:void(0);" class="btn btn-success" onclick="save_notes();"><i class="fa fa-save"></i> Save</a>
                                                        <!--<a class="btn btn-success" href="#notes-edit-modal" data-toggle="modal"><i class="fa fa-pencil"></i> Edit</a>
                                                        <a class="btn btn-success" href="#"><i class="fa fa  fa-trash" style="color:#fff;" data-toggle="tooltip" data-title="Delete Notes" data-original-title="" title=""></i> Delete</a>-->
                                                    </div>
                                                </div>
                                                <div class="modal fade notes-info" id="note-modal">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
															
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title">Notes</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea class="resizable_textarea form-control" placeholder="Notes.." id="note_box">
                                                                    
                                                                </textarea>
																<input type="hidden" id="note_id" value='' />
                                                                <div class="action-icon">
                                                                    <br>
                                                                    <a href="javascript:void(0)" class="btn btn-success" onclick="update_notes();"><i class="fa fa-save"></i> Save</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="actionBar">
                                        <a href="javascript:void(0);" class="buttonPrevious btn btn-primary" onclick="nxt_tab('pat_reg_personal-documents');"><i class="fa fa-angle-left" aria-hidden="true"></i> Previous</a>
                                        <a href="javascript:void(0);" class="buttonNext btn btn-success" onclick="nxt_tab('pat_reg_personal-consent');">Next <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div id="menu7" class="tab-pane fade">
                                <p></p>
								<form action="#" method="post" enctype="multipart/form-data" id="consent_form">
                                <div class="x_panel">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <h4>Consent for GP Online Services</h4>
                                                    <p style="text-align:justify;">
                                                        You can now view your GP medical record online. If you would like to have secure online access to your
                                                        records, we need to make sure that you understand what this involves and that you are happy for us to use
                                                        the information about you (provided below) to set up and operate the service.
                                                    </p>
                                                    <p style="text-align:justify;">
                                                        The following form will take you through the things you need to think about. By signing the form you will be
                                                        giving us your permission to go ahead with setting up the service for you. If you decide not to join, or wish to
                                                        withdraw, it will not affect your treatment in any way.
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">&nbsp;<input type="checkbox" id="checkall"> Select All.  Please select your perferences below : &nbsp;&nbsp;&nbsp;&nbsp;<span id="consent_message" style="color:green"></span></div>
                                                            <div class="panel-body">
                                                                <table class="table table-striped">
                                                                    <tr>
                                                                        <td>
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <div class="icheckbox_flat-green" style="position: relative;">
                                                                                        <input type="checkbox" name="data[agree][]" id="agree_0" class="flat agree" style="position: absolute; opacity: 0;">
                                                                                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                                                    </div>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td>I agree to my GP practice giving me access to my record online.</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="checkbox">
                                                                                <label class="">
                                                                                    <div class="icheckbox_flat-green" style="position: relative;">
																						<input type="checkbox" name="data[agree][]" class="flat agree" id="agree_1"  style="position: absolute; opacity: 0;">
																						<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																					</div>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            I agree to use the system in a responsible manner in accordance with all instructions given to me by
                                                                            the practice. If not access may be withdrawn
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="checkbox">
                                                                                <label cclass="justify">
                                                                                    <div class="icheckbox_flat-green" style="position: relative;">
																						<input type="checkbox" name="data[agree][]" class="flat agree" id="agree_2"  style="position: absolute; opacity: 0;">
																						<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																					</div>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            If I see information which does not relate to me, I will immediately log out and report the matter to the
                                                                            practice as soon as possible
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="checkbox">
                                                                                <label class="justify">
                                                                                    <div class="icheckbox_flat-green" style="position: relative;"> 
																						<input type="checkbox" name="data[agree][]" class="flat agree" id="agree_3"  style="position: absolute; opacity: 0;">
																						<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																					</div>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            I agree that it is my responsibility to keep secure, my username and passwords. If I think these have
                                                                            been shared inappropriately I will reset them using the instructions supplied. I am also responsible for
                                                                            keeping safe any information I may print from the record.
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="checkbox">
                                                                                <label class="">
                                                                                    <div class="icheckbox_flat-green" style="position: relative;">
																						<input type="checkbox" name="data[agree][]" class="flat agree" id="agree_4"  style="position: absolute; opacity: 0;">
																						<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																					</div>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            I agree that my details below may be used to contact me about how useful I find the service and
                                                                            whether it could be improved.
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="checkbox">
                                                                                <label class="">
                                                                                    <div class="icheckbox_flat-green" style="position: relative;">
																						<input type="checkbox" name="data[agree][]" class="flat agree" id="agree_5"  style="position: absolute; opacity: 0;">
																						<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																					</div>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            I understand that online access is granted at the discretion of the practice, taking into account my best
                                                                            interests. I will be informed of any decision to withdraw the service. Please  note this does not affect your rights of Subject Access under the Data Protection Act.
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="checkbox">
                                                                                <label class="">
                                                                                    <div class="icheckbox_flat-green" style="position: relative;">
																						<input type="checkbox" name="data[agree][]" class="flat agree" id="agree_6"  style="position: absolute; opacity: 0;">
																						<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																					</div>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td>I wish to book appointments on line</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="checkbox">
                                                                                <label class="">
																					<div class="icheckbox_flat-green" style="position: relative;">
																						<input type="checkbox" name="data[agree][7]" class="flat agree" id="agree_7" style="position: absolute; opacity: 0;">
                                                                                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																					</div>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td>I wish to nominate a chemist to receive my prescriptions</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="checkbox">
                                                                                <label class="">
                                                                                    <div class="icheckbox_flat-green" style="position: relative;">
																						<input type="checkbox" name="data[agree][]" class="flat agree" id="agree_8"  style="position: absolute; opacity: 0;">
																						<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																					</div>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td>I wish to receive prescriptions by E-Mail</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="checkbox">
                                                                                <label class="">
                                                                                    <div class="icheckbox_flat-green" style="position: relative;">
                                                                                        <input type="checkbox" class="flat agree" name="data[agree][]" id="agree_9"  style="position: absolute; opacity: 0;">
                                                                                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                                                    </div>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td>I wish to receive appointment notifications by mail</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="checkbox">
                                                                                <label class="">
                                                                                    <div class="icheckbox_flat-green" style="position: relative;">
                                                                                        <input type="checkbox" class="flat agree" name="data[agree][]" id="agree_10" style="position: absolute; opacity: 0;">
                                                                                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                                                    </div>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td>I wish to share  my medical records with XXXX</td>
                                                                    </tr>
                                                                </table>
                                                                <h5>Other considerations</h5>
                                                                <table class="table table-striped">
                                                                    <tr>
                                                                        <td>
                                                                            <div class="checkbox">
                                                                                <label class="">
																					<div class="icheckbox_flat-green" style="position: relative;">
																						<input type="checkbox" class="flat agree" name="data[agree][]" id="agree_11"  style="position: absolute; opacity: 0;">
																						<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins> 
                                                                                    </div>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            If I notice any inaccuracies with my record, I will inform a senior member of staff or the practice manager as
                                                                            soon as possible of any errors or omissions.
                                                                        </td>
                                                                    <tr />
                                                                    <tr>
                                                                        <td>
                                                                            <div class="checkbox">
                                                                                <label class="">
                                                                                    <div class="icheckbox_flat-green" style="position: relative;">
                                                                                        <input type="checkbox" class="flat agree" name="data[agree][]" id="agree_12" style="position: absolute; opacity: 0;">
                                                                                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                                                    </div>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            I understand that I may see information on my record that I was unaware of / have forgotten about that
                                                                            could cause distress.
                                                                        </td>
                                                                    <tr />
                                                                    <tr>
                                                                        <td>
                                                                            <div class="checkbox">
                                                                                <label class="">
                                                                                    <div class="icheckbox_flat-green" style="position: relative;">
                                                                                        <input type="checkbox" class="flat agree" name="data[agree][]" id="agree_13"  style="position: absolute; opacity: 0;">
                                                                                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                                                    </div>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            I understand that as before, I will be informed directly, by the practice, of any test results which require
                                                                            further action. However I understand that I may see these results online before the practice has been able to
                                                                            contact me. This could be while the surgery is closed and there is no one available to discuss them with me
                                                                        </td>
                                                                    <tr />
                                                                </table>
                                                                <div class="row">
                                                                    <span class="section"></span>
                                                                    <div class="col-md-4 col-sm-12">
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12">
                                                                        <div class="checkbox">
                                                                            <label class="">
                                                                                <div class="icheckbox_flat-green" style="position: relative;" id="agree_id">
																					<input type="checkbox" id="accept_terms" class="flat agree" style="position: absolute; opacity: 0;">
																					<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
																				</div>
                                                                                <span style="color:red">I Agree <a href="" style="color:red">Terms &amp; Conditions</a> and Accept.</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <span class="section"></span>
                                                                    <div class="col-md-9 col-sm-12 col-xs-12 text-right">
                                                                    </div>
                                                                    <div class="col-md-1 col-sm-4 col-xs-4 text-right">
                                                                        <a href="javascript:void(0);" class="btn btn-success"><i class="fa fa-envelope"></i> Email</a>
                                                                    </div>
                                                                    <div class="col-md-1 col-sm-4 col-xs-4 text-right">
                                                                        <a href="javascript:void(0);" class="btn btn-success"><i class="fa fa-print"></i> Print</a>
                                                                    </div>
                                                                    <div class="col-md-1 col-sm-4 col-xs-4 text-right">
                                                                        <a href="javascript:void(0);" class="btn btn-success" onclick="save_consent();"><i class="fa fa-save"></i> Save</a>
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
                                        <a href="javascript:void(0);" class="buttonPrevious btn btn-primary" onclick="nxt_tab('pat_reg_personal-notes');"><i class="fa fa-angle-left" aria-hidden="true"></i> Previous</a>
                                        <a href="javascript:void(0);" class="buttonNext btn btn-success" onclick="nxt_tab('pat_reg_personal-alerts');">Next <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
								</form>
                            </div>
										
										
										
                            <div id="menu8" class="tab-pane fade">
                                <p></p>
                                <div class="x_panel">
                                    <div class="row">
                                        <div class="input_fields_wrap5">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            </div>
                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Alert Text: </label> <span id="alert_message" style="color:green;"></span>
                                                    <textarea type="text" row="3" class="form-control" placeholder="Alert Text" id="alert_text"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                                <label>Action</label>
                                                <div class="form-group">
                                                    <a href="#" class="btn btn-success" data-toggle="tooltip" data-title="Save Alert" onclick="save_alert();"><i class="fa fa-save"></i> Save</a>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Set Alert</label>
                                                    <div>
                                                        <label>
                                                            <input type="checkbox" id="alertchk" onclick="alertcolor()" class="js-switch" data-switchery="true" style="display: none;">
                                                            <label id="switchoffon">off</label>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Alerts</th>
                                                            <th>Added By</th>
                                                      <!--      <th>Actions</th>-->
                                                        </tr>
                                                    </thead>
													<tbody id="alert_tbody">
														<?php
															if(!empty($alerts)) {
																foreach($alerts as $key =>$val){
																	$val_arr		= (array)$val;
														 ?>
																	<tr id="alert_row_<?php echo $val->id; ?>">
																		<td id="alert_text_<?php echo $val_arr['id'] ?>">
																			<?php if($val->alerts) {echo $val->alerts; } ?>
																		</td>
																		<td>
																			<p id="alert_time_<?php echo $val_arr['id'] ?>"><?php if($val->modified_date) {echo date("F j, Y, g:i a",strtotime($val->modified_date));  } ?>  <i><?php echo ' Added by '.ucfirst($val->title.' '.$val->firstname.' '.$val->lastname); ?></i></p>
																		</td>
																		<td>
																			<div class="form-group">
																				<a class="btn btn-success" href="#alert-modal" data-toggle="modal" onclick="edit_alert(<?php echo $val_arr['id'] ?>);" ><i class="fa fa-pencil"></i> </a>
																				<a class="btn btn-success" onclick="delete_alert(<?php echo $val_arr['id'] ?>);" href="#" data-toggle="tooltip" data-title="Delete Alert" data-original-title="" title=""><i class="fa fa  fa-trash" style="color:#fff;" data-original-title="" title=""></i></a>
																			</div>
																		</td>
																	</tr>
																  <?php
																	} 
															}else{
															?>
																<tr>
																	<td colspan="3">
															<input type="hidden" id="alert_empty" value="1" />
																		No alerts found...
																	</td>
																</tr>
															<?php
															}
															?>
														
													</tbody>
                                                </table>
                                            </div>
											
                                            <div class="modal fade alerts-info" id="alert-modal">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Update Alert</h4>
                                                        </div>
														<input type="hidden" id="alert_id" value='' />
                                                        <div class="modal-body">
                                                            <textarea class="resizable_textarea form-control" placeholder="Alert" id="alert_box" >
                                                                Patient is voilent, please take care
                                                            </textarea>
                                                            <div class="action-icon">
                                                                <br>
                                                                <a href="#" class="btn btn-success" onclick="update_alert();"><i class="fa fa-save"></i> Update</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											
											
                                        </div>
                                    </div>
                                    <div class="actionBar">
                                        <a href="javascript:void(0);" class="buttonPrevious btn btn-primary" onclick="nxt_tab('pat_reg_personal-consent');"><i class="fa fa-angle-left" aria-hidden="true"></i> Previous</a>
										<a href="<?php echo base_url()."patient_setup/manage_patients"; ?>" class="buttonNext btn btn-success"> <i class="fa fa-floppy-o" aria-hidden="true"></i> Save and Continue</a>
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
		$relation			= '';
		foreach($professional_body as $key => $val){
			$list				= $list.'<option value="'.$key.'">'.$val.'</option>';
		}
		foreach($country['name'] as $c_key => $c_val){
			$country_list	= $country_list.'<option value="'.$c_key.'">'.$c_val.'</option>';
			if($c_key !=''){
				$country_l		.= 'country_name['.$c_key.']= "'.$c_val.'";';
			}
		}
		foreach($country['code'] as $c_key => $c_val){
			if($c_key !=''){
				$country_code	.= 'country_name['.$c_key.']= "'.$c_val.'";';
			}
		}
		foreach($relationship as $key => $val){
			$relation			= $relation.'<option value="'.$key.'">'.$val.'</option>';
		}
	?>
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
    <script src="<?php echo base_url(); ?>assets/vendors/switchery/dist/switchery.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyB30YkpVyTfcPsQkwNiiBLE2a-C5EHYFSA&libraries=places"></script>
    <script>
	
	<?php
	if(isset($consent)&& $consent){
		?>
		$("#accept_terms").iCheck("check");
		<?php
		$imp = explode(',',$consent['consent_value']);
		foreach($imp as $key =>$val){
			if($val == 1){
			?>
				$("#agree_<?php echo $key; ?>").iCheck("check");
			<?php
			}
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
		
		
		$(function () {
            $("#datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
				dateFormat: "dd/mm/yy",
				yearRange: '1900:' + new Date().getFullYear().toString()
            });
        });
	
        function ageCount(){
			var dateString 			= $("#datepicker").val();
			var dates 				= dateString.split("/");
			var d 					= new Date();
			var curday				= $.datepicker.formatDate('dd/mm/yy', new Date());
			if(new Date(dateString) > new Date(curday)){
				alert('Invalid date..');
				$("#datepicker").val('');
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
				if(age >16){
					$("#minor_div").hide();
					$("#marital_status").prop('disabled',false);
				}else{
					$("#minor_div").show();
					$("#marital_status").prop('disabled',true);
					$("#marital_status").val('');
				}
				age					= age+' yrs';
				$("#ageId").val(age);
				$("#ageId").attr('disabled','disabled');
			}
	    }


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

		function save_details(){
			var title 				= $("#title").val();
			var gender 				= $("#gender").val();
			var first_name 			= $("#first_name").val();
			var last_name 			= $("#last_name").val();
			var middle_name 		= $("#middle_name").val();
			if($("#txtProfNHSNo").length > 0){
				var nh_no			= $("#txtProfNHSNo").val();
			}
			var dob					= $("#datepicker").val();
			var country_id			= $("#country_id").val();
			var zipcode				= $("#zipcode").val();
			var Address				= $("#address").val();
			var town				= $("#town").val();
			var state				= $("#state").val();
			var home_mobile			= $("#home_mobile").val();
			var work_mobile			= $("#work_mobile").val();
			var Mobile				= $("#Mobile").val();
			var Email				= $("#Email").val();
			
			var minor_title			= $("#minor_title").val();
			var minor_name			= $("#minor_name").val();
			var relationship_id		= $("#relationship_id").val();
			var minor_mobile		= $("#minor_mobile").val();
			var minor_address		= $("#minor_address").val();
			
			var next_title			= $("#next_title").val();
			var next_name			= $("#next_name").val();
			var next_address		= $("#next_address").val();
			var next_mobile			= $("#next_mobile").val();
			var user_key			= $("#user_key").val();
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
				$("#datepicker").focus();
				$("#datepicker").css('border','1px solid #ff1a1c');
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
			}else if(Mobile.trim() == ""){
				$("#Mobile").focus();
				$("#Mobile").css('border','1px solid #ff1a1c');
			}else if(Email.trim() == ""){
				$("#Email").focus();
				$("#Email").css('border','1px solid #ff1a1c');
			}else{
				if($("#age_hide").val() < 16){
					if(minor_title == ""){
						$("#minor_title").focus();
						$("#minor_title").css('border','1px solid #ff1a1c');
						return false;
					}else if(minor_name.trim() == ""){
						$("#minor_name").focus();
						$("#minor_name").css('border','1px solid #ff1a1c');
						return false;
					}else if(relationship_id == ""){
						$("#relationship_id").focus();
						$("#relationship_id").css('border','1px solid #ff1a1c');
						return false;
					}else if(minor_mobile.trim() == ""){
						$("#minor_mobile").focus();
						$("#minor_mobile").css('border','1px solid #ff1a1c');
						return false;
					}else if(minor_address.trim() == ""){
						$("#minor_address").focus();
						$("#minor_address").css('border','1px solid #ff1a1c');
						return false;
					}
				} 
				var form_data 			= new FormData();
				var obj					= document.getElementById('FileUpload1');
				if($("#FileUpload1").val() !=''){
					form_data.append('file', obj.files[0]);
				}
				form_data.append('user_key', user_key);
				form_data.append('title', title);
				form_data.append('gender', gender);
				form_data.append('first_name', first_name.trim());
				form_data.append('last_name', last_name.trim());
				form_data.append('middle_name', middle_name.trim());
				if($("#txtProfNHSNo").length > 0){
					form_data.append('nh_no', nh_no.trim());
				}
				form_data.append('country_id', country_id);
				form_data.append('address', Address.trim());
				form_data.append('zipcode', zipcode.trim());
				form_data.append('town', town.trim());
				form_data.append('state', state.trim());
				form_data.append('dob', dob.trim());
				form_data.append('age',$("#age_hide").val());
				if(home_mobile.trim() != ""){
					form_data.append('home_mobile', home_mobile.trim());
				}
				if(work_mobile.trim() != ""){
					form_data.append('work_mobile', work_mobile.trim());
				}
				form_data.append('mobile', Mobile.trim());
				form_data.append('email', Email.trim());
				if($("#age_hide").val() <16){
					form_data.append('minor_title', minor_title);
					form_data.append('minor_name', minor_name.trim());
					form_data.append('relationship_id', relationship_id);
					form_data.append('minor_mobile', minor_mobile.trim());
					form_data.append('minor_address', minor_address.trim());
				}
				form_data.append('next_title', next_title);
				form_data.append('next_name', next_name.trim());
				form_data.append('next_address', next_address.trim());
				form_data.append('next_mobile', next_mobile.trim());
				 
				var url	="<?php echo base_url(); ?>patient_setup/patient_details";
				$.ajax({
					url: url,
					type: 'POST',
					data: form_data,
					dataType: "json",
					processData: false,
					contentType: false,
					success: function(data){
						if(data.response.trim() == 'success'){
							nxt_tab('pat_reg_demographic');
							$("#response").html("Last Saved :"+data.save_time)
							$("#pDcheck").iCheck("check");
							$("#user_key").val(data.user_key);
						}else if(data.response.trim() == 'exist'){
							alert('Email Id already exist..');
						}else{
							alert('Please try after sometime..');
						}
					}
				});
			}
		}
		
		function fill_address(a,b){
			var address								= $('#address').val();
			if($(a).is(':checked')){
				if(address.trim() !=''){
					$("#"+b).val(address);
				}else{
					$("#"+b).val('');
					$(a).prop('checked', false); // Unchecks it
					alert('Please fill home address..');
				}
			}else{
				$("#"+b).val('');
				$(a).prop('checked', false); // Unchecks it
			}
		}
								
		function restrict_keys(e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 43 && e.which > 31 ) {
				return false;
			}
		}
		
		function save_demography(){
			var ethinic_id 						= $("#ethinic_id").val();
			var language_id 					= $("#language_id").val();
			var marital_status 					= $("#marital_status").val();
			var user_key						= $("#user_key").val();
			if(ethinic_id == ''){
				$("#ethinic_id").focus();
				$("#ethinic_id").css('border','1px solid #ff1a1c');
			}else if(language_id == '' || language_id == null){
				$(".lang").focus();
				$(".lang").css('border','1px solid #ff1a1c');
			}else{
				var url								= "<?php echo base_url(); ?>patient_setup/update_details";
				var form_data 			= new FormData();
				form_data.append('ethinic_origin', ethinic_id);
				form_data.append('languages', language_id);
				form_data.append('marital_status', marital_status);
				form_data.append('user_key', user_key);
				$.ajax({
					url: url,
					type: 'POST',
					data: form_data,
					dataType: "json",
					processData: false,
					contentType: false,
					success: function(data){
						if(data.response.trim() == 'success'){
							nxt_tab('pat_reg_personal-family');
							$("#response").html("Last Saved :"+data.save_time)
							$("#pDcheck1").iCheck("check");
						}else if(data.response.trim() == 'UserInvalid'){
							alert('Please fill Patient details..');
						}else{
							alert('Please try after sometime..');
						} 
					}
				});
			}
		}
		
		function save_family_details(){
			var form 										= $('#family_form');
			var formData 									= $(form).serialize();
			var user_key									= $("#user_key").val();
			var url											= "<?php echo base_url(); ?>patient_setup/patient_family_details";
			$.ajax({
				url: url,
				type: 'POST',
				dataType: "json",
				data: $('#family_form').serialize()+'&user_key='+user_key,
				success: function(data){
					if(data.response.trim() == 'success'){
						nxt_tab('pat_reg_personal-gp');
						var len			= data.details.length;
						var content		= '';
						if(len >0){
							for(i=0;i<len;i++){
								content		+='<div class="panel-body"><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Name</label><p class="summary_view_text">'+(data.details[i].name == null ? '' : data.details[i].name)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Relationship</label><p class="summary_view_text">'+(data.details[i].relation == null ? '' : data.details[i].relation)+'</p></div></div><div class="col-md-1 col-sm-12 col-xs-12"><div class="form-group"><label>Age</label><p class="summary_view_text">'+(data.details[i].age == null ? '' : data.details[i].age)+' Years</p></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><label>Address</label><p class="summary_view_text">'+(data.details[i].address == null ? '' : data.details[i].address)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Tel</label><p class="summary_view_text">'+(data.details[i].mobile == null ? '' : data.details[i].mobile)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Contact</label><p class="summary_view_text">'+(data.details[i].home == null ? '' : data.details[i].home)+'</p></div></div></div>';
							}
						}else{
								content			='<div class="panel-body"><div class="col-md-12 col-sm-12 col-xs-12"><div class="form-group"><label>No records Uploaded...</label></div></div></div>'
						}
						document.getElementById("family_form").reset();
						$('.family_class').remove();
						$("#family_div_id").html(content);
						$("#response").html("Last Saved :"+data.save_time);
						$("#pDcheck2").iCheck("check");
					}else if(data.response.trim() == 'UserInvalid'){
						alert('Please fill Patient details..');
					}else{
						nxt_tab('pat_reg_personal-gp');
						//alert('Please try after sometime..');
					}  
				}
			});
		}
		function save_gp_details(){
			var form 										= $('#gp_form');
			var formData 									= $(form).serialize();
			var user_key									= $("#user_key").val();
			var url											= "<?php echo base_url(); ?>patient_setup/patient_gp_details";
			$.ajax({
				url: url,
				type: 'POST',
				dataType: "json",
				data: $('#gp_form').serialize()+'&user_key='+user_key,
				success: function(data){
					if(data.response.trim() == 'success'){
						nxt_tab('pat_reg_personal-chemist');
						var len			= data.details.length;
						var content		= '';
						if(len >0){
							for(i=0;i<len;i++){
								content		+='<div class="panel-body pro_reg_border"><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Practice Name</label><p class="summary_view_text">'+(data.details[i].practice_name == null ? '' : data.details[i].practice_name)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Doctor</label><p class="summary_view_text">'+(data.details[i].doctor_name == null ? '' : data.details[i].doctor_name)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Tel 1</label><p class="summary_view_text">'+(data.details[i].tel1 == null ? '' : data.details[i].tel1)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Tel 2</label><p class="summary_view_text">'+(data.details[i].tel2 == null ? '' : data.details[i].tel2)+'</p></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><label>Email </label><p class="summary_view_text">'+(data.details[i].email == null ? '' : data.details[i].email)+'</p></div></div><div class="col-md-1 col-sm-12 col-xs-12"><div class="form-group"><label>Country </label><p class="summary_view_text">'+(data.details[i].country == null ? '' : data.details[i].country)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Postcode </label><p class="summary_view_text">'+ (data.details[i].postcode == null ? '' : data.details[i].postcode)+'</p></div></div><div class="col-md-4 col-sm-12 col-xs-12"><div class="form-group"><label>Address </label><p class="summary_view_text">'+(data.details[i].address == null ? '' : data.details[i].address)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>City </label><p class="summary_view_text">'+(data.details[i].city == null ? '' : data.details[i].city)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>State </label><p class="summary_view_text">'+ (data.details[i].state == null ? '' : data.details[i].state)+'</p></div></div></div>';
							}
						}else{
								content			='<div class="panel-body"><div class="col-md-12 col-sm-12 col-xs-12"><div class="form-group"><label>No records Uploaded...</label></div></div></div>'
						}
						document.getElementById("gp_form").reset();
						$('.gp_class').remove();
						$("#gp_div_id").html(content);
						$("#response").html("Last Saved :"+data.save_time);
						$("#pDcheck3").iCheck("check");
					}else if(data.response.trim() == 'UserInvalid'){
						alert('Please fill Patient details..');
					}else{
						nxt_tab('pat_reg_personal-chemist');
						//alert('Please try after sometime..');
					}  
				}
			});
		}
		
		function save_chemist_details(){
			var form 										= $('#chemist_form');
			var formData 									= $(form).serialize();
			var user_key									= $("#user_key").val();
			var url											= "<?php echo base_url(); ?>patient_setup/patient_chemist_details";
			$.ajax({
				url: url,
				type: 'POST',
				dataType: "json",
				data: $('#chemist_form').serialize()+'&user_key='+user_key,
				success: function(data){
					if(data.response.trim() == 'success'){
						nxt_tab('pat_reg_personal-carer');
						var len			= data.details.length;
						var content		= '';
						if(len >0){
							for(i=0;i<len;i++){
								content		+='<div class="panel-body pro_reg_border"><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Pharmacy Name</label><p class="summary_view_text">'+(data.details[i].pharmacy_name == null ? '' : data.details[i].pharmacy_name)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Chemist Name</label><p class="summary_view_text">'+(data.details[i].chemist_name == null ? '' : data.details[i].chemist_name)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Tel 1</label><p class="summary_view_text">'+(data.details[i].tel1 == null ? '' : data.details[i].tel1)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Tel 2</label><p class="summary_view_text">'+(data.details[i].tel2 == null ? '' : data.details[i].tel2)+'</p></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><label>Email</label><p class="summary_view_text">'+(data.details[i].email == null ? '' : data.details[i].email)+'</p></div></div><div class="col-md-1 col-sm-12 col-xs-12"><div class="form-group"><label>Country </label><p class="summary_view_text">'+(data.details[i].country == null ? '' : data.details[i].country)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Postcode </label><p class="summary_view_text">'+(data.details[i].postcode == null ? '' : data.details[i].postcode)+'</p></div></div><div class="col-md-4 col-sm-12 col-xs-12"><div class="form-group"><label>Address </label><p class="summary_view_text">'+(data.details[i].address == null ? '' : data.details[i].address)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>City </label><p class="summary_view_text">'+(data.details[i].city == null ? '' : data.details[i].city)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>State </label><p class="summary_view_text">'+ (data.details[i].state == null ? '' : data.details[i].state)+'</p></div></div></div>';
							}
						}else{
								content			='<div class="panel-body"><div class="col-md-12 col-sm-12 col-xs-12"><div class="form-group"><label>No records Uploaded...</label></div></div></div>'
						}
						$('.chemist_class').remove();
						document.getElementById("chemist_form").reset();
						$("#chemist_div_id").html(content);
						$("#response").html("Last Saved :"+data.save_time)
						$("#pDcheck4").iCheck("check");
					}else if(data.response.trim() == 'UserInvalid'){
						alert('Please fill Patient details..');
					}else{
						nxt_tab('pat_reg_personal-carer');
						//alert('Please try after sometime..');
					} 
				}
			});
		}
		
		function save_career_details(){
			var form 										= $('#career_form');
			var formData 									= $(form).serialize();
			var user_key									= $("#user_key").val();
			var url											= "<?php echo base_url(); ?>patient_setup/patient_career_details";
			$.ajax({
				url: url,
				type: 'POST',
				dataType: "json",
				data: $('#career_form').serialize()+'&user_key='+user_key,
				success: function(data){
					if(data.response.trim() == 'success'){
						nxt_tab('pat_reg_personal-documents');
						var len			= data.details.length;
						var content		= '';
						if(len >0){
							for(i=0;i<len;i++){
								content		+='<div class="panel-body pro_reg_border"><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Company Name</label><p class="summary_view_text">'+(data.details[i].company_name == null ? '' : data.details[i].company_name)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Name</label><p class="summary_view_text">'+(data.details[i].name == null ? '' : data.details[i].name)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Tel 1</label><p class="summary_view_text">'+(data.details[i].tel1 == null ? '' : data.details[i].tel1)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Tel 2</label><p class="summary_view_text">'+(data.details[i].tel2 == null ? '' : data.details[i].tel2)+'</p></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><label>Email </label><p class="summary_view_text">'+(data.details[i].email == null ? '' : data.details[i].email)+'</p></div></div><div class="col-md-1 col-sm-12 col-xs-12"><div class="form-group"><label>Country </label><p class="summary_view_text">'+(data.details[i].country == null ? '' : data.details[i].country)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Postcode </label><p class="summary_view_text">'+(data.details[i].postcode == null ? '' : data.details[i].postcode)+'</p></div></div><div class="col-md-4 col-sm-12 col-xs-12"><div class="form-group"><label>Address </label><p class="summary_view_text">'+(data.details[i].address == null ? '' : data.details[i].address)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>City </label><p class="summary_view_text">'+(data.details[i].city == null ? '' : data.details[i].city)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>State </label><p class="summary_view_text">'+(data.details[i].state == null ? '' : data.details[i].state)+'</p></div></div></div>';
							}
						}else{
								content			='<div class="panel-body"><div class="col-md-12 col-sm-12 col-xs-12"><div class="form-group"><label>No records Uploaded...</label></div></div></div>'
						}
						document.getElementById("career_form").reset();
						$('.career_class').remove();
						$("#career_div_id").html(content);
						$("#response").html("Last Saved :"+data.save_time)
						$("#pDcheck5").iCheck("check");
					}else if(data.response.trim() == 'UserInvalid'){
						alert('Please fill Patient details..');
					}else{
						nxt_tab('pat_reg_personal-documents');
						alert('Please try after sometime..');
					}
				}
			});
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
					var html_content = html_content + '<tr role="row" id="'+div_id+'_row_'+x+'"><td style="padding-left:8px;"></td><td tabindex="0" ><a href="#">' + file_name + '</a></td><td tabindex="0" ><div class="form-group"><input id="'+div_id+'_text_row_'+x+'" name="data['+div_id+'_text]['+x+']" type="text" class="form-control" type="text" style="width:99% !important"></div></td><td><a href="#" class="btn btn-success"><i class="fa  fa-share" data-toggle="tooltip" data-title="Share Document" data-original-title="" title=""></i></a><a href="#" class="btn btn-success"><i class="fa  fa-edit" data-toggle="tooltip" data-title="Edit Title" data-original-title="" title=""></i></a><a href="#" class="btn btn-success" onclick="remove_upload_row('+"'"+div_id+"'"+ ','+x+','+"'"+input.id+"'"+')"><i class="fa  fa-trash" data-toggle="tooltip" data-title="Delete" data-original-title="" title=""></i></a></td></tr>';
					x++;
				}
				var id_val 		= 'upload-other';
				html_content 	= html_content+ '<tr role="row" ><td colspan="4"align="right"><a href="#" class="btn btn-success" onclick="upload_files('+"'"+id_val+"'"+')"><i class="fa fa-upload" aria-hidden="true"></i> Upload Files</a></td></tr>';
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
		
		function upload_files(a){
			var input									= document.getElementById(a);
			var country_name							= new Array();
			var user_key								= $("#user_key").val();
			var url										= "<?php echo base_url(); ?>patient_setup/save_uploaded_files";
			var i = 0, len = input.files.length,file;
			if(len >0){
				form_data = new FormData();
				var details				= new Array();
				for (; i < len; i++){
					file = input.files[i];
					if($("#upload_document_text_row_"+i).length>0){
						form_data.append("file["+i+"]", file);
						form_data.append("title["+i+"]", $("#upload_document_text_row_"+i).val());
					}
				}
				form_data.append('user_key', user_key);
				form_data.append('file_type','others');
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
									html_content			+='<tr role="row"><td></td><td tabindex="0"><a href="#">'+data.details[i].title+'</a></td><td><a href="<?php echo base_url(); ?>assets/uploads/'+data.details[i].file_path+data.details[i].file_name+'" target="_blank" class="btn btn-success"><i class="fa fa-eye" data-toggle="tooltip" data-title="Share Document" data-original-title="" title=""></i></a></td></tr>';
								}
							}
							$("#exist_other_document").append(html_content);
							$("#upload_document").hide();
							$("#upload_doc_response").html("<span style='color:green;font-size:13px;'>File Uploaded Successfully..</span>&nbsp;&nbsp;&nbsp;");
							$("#exist_other_document").show();
							$("#upload_doc_exist").show();
							$("#pDcheck6").iCheck("check");
							//nxt_tab('pat_reg_personal-notes');
						}else if(data.response.trim() == 'UserInvalid'){
							$("#upload_document").hide();			
							alert('Please fill Patient details..');
						}else{
							$("#upload_document").hide();				
							alert("Please try after sometime..");
						} 
					}
				});
			} 
		}
		
		function save_notes(){
			var notes										= $("#notes_text").val();
			var user_key									= $("#user_key").val();
			if(notes.trim() != ''){
				var form_data 								= new FormData();
				var url										= "<?php echo base_url(); ?>patient_setup/save_notes";
				form_data.append('notes',notes);
				form_data.append('type','notes');
				form_data.append('user_key', user_key);
				$.ajax({
					url: url,
					type: 'POST',
					data: form_data,
					dataType: "json",
					processData: false,
					contentType: false,
					success: function(data){
						$("#notes_text").val('');
						if(data.response == 'success'){
							$("#notes_message").html('Notes added successfully...');
							if($('#note_empty').length> 0 && $("#note_empty").val()==1){
								$("#notes_tbody").html('<tr id="note_row_'+data.last_id+'"><td id="note_text_'+data.last_id+'">'+notes.trim()+'</td><td><p id="note_time_'+data.last_id+'">'+data.saved_time+' Added by <i>'+data.name+'</i></p></td><td><div class="form-group"><a class="btn btn-success" href="#note-modal" data-toggle="modal" onclick="edit_notes('+data.last_id+');"><i class="fa fa-pencil"></i> </a><a class="btn btn-success" onclick="delete_note('+data.last_id+');" href="javascript:void(0)" data-toggle="tooltip" data-title="Delete Alert" data-original-title="" title=""><i class="fa fa  fa-trash" style="color:#fff;" data-original-title="" title=""></i></a></div></td></tr>');
							}else{
								$("#notes_tbody").append('<tr id="note_row_'+data.last_id+'"><td id="note_text_'+data.last_id+'">'+notes.trim()+'</td><td><p id="note_time_'+data.last_id+'">'+data.saved_time+' Added by <i>'+data.name+'</i></p></td><td><div class="form-group"><a class="btn btn-success" href="#note-modal" data-toggle="modal" onclick="edit_notes('+data.last_id+');"><i class="fa fa-pencil"></i> </a><a class="btn btn-success" onclick="delete_note('+data.last_id+');" href="javascript:void(0)" data-toggle="tooltip" data-title="Delete Alert" data-original-title="" title=""><i class="fa fa  fa-trash" style="color:#fff;" data-original-title="" title=""></i></a></div></td></tr>');
							}
							$("#pDcheck7").iCheck("check");
						}else if(data.response.trim() == 'UserInvalid'){
							alert('Please fill Patient details..');
						}else{
							alert("Please try after sometime...");
						} 
					}
				}); 
			}else{
				alert("Please enter something in notes..");
			}
		}
		function save_alert(){
			var alert_txt									= $("#alert_text").val();
			var user_key									= $("#user_key").val();
			if(alert_txt.trim() != ''){
				var form_data 								= new FormData();
				var url										= "<?php echo base_url(); ?>patient_setup/save_notes";
				form_data.append('alert',alert_txt);
				form_data.append('type','alert_txt');
				form_data.append('user_key', user_key);
			 	$.ajax({
					url: url,
					type: 'POST',
					data: form_data,
					dataType: "json",
					processData: false,
					contentType: false,
					success: function(data){
						$("#alert_text").val('');
						if(data.response == 'success'){
							$("#alert_message").html('Alert added successfully...');
							if($('#alert_empty').length> 0 && $("#alert_empty").val()==1){
								$("#alert_tbody").html('<tr id="alert_row_'+data.last_id+'"><td id="alert_text_'+data.last_id+'">'+alert_txt.trim()+'</td><td><p id="alert_time'+data.last_id+'">'+data.saved_time+' Added by <i>'+data.name+'</i></p></td><td><div class="form-group"><a class="btn btn-success" href="#alert-modal"  onclick="edit_alert('+data.last_id+');" data-toggle="modal"><i class="fa fa-pencil"></i> </a><a class="btn btn-success" onclick="delete_alert('+data.last_id+');" href="javascript:void(0)" data-toggle="tooltip" data-title="Delete Alert" data-original-title="" title=""><i class="fa fa  fa-trash" style="color:#fff;" data-original-title="" title=""></i></a></div></td></tr>');
							}else{
								$("#alert_tbody").append('<tr id="alert_row_'+data.last_id+'"><td id="alert_text_'+data.last_id+'">'+alert_txt.trim()+'</td><td><p id="alert_time'+data.last_id+'">'+data.saved_time+' Added by <i>'+data.name+'</i></p></td><td><div class="form-group"><a class="btn btn-success" href="#alert-modal" onclick="edit_alert('+data.last_id+');" data-toggle="modal"><i class="fa fa-pencil"></i> </a><a class="btn btn-success" onclick="delete_alert('+data.last_id+');" href="javascript:void(0)" data-toggle="tooltip" data-title="Delete Alert" data-original-title="" title=""><i class="fa fa  fa-trash" style="color:#fff;" data-original-title="" title=""></i></a></div></td></tr>');
							}
						}else if(data.response.trim() == 'UserInvalid'){
							alert('Please fill Patient details..');
						}else{
							alert("Please try after sometime...");
						}
					}
				});
				
			}else{
				alert("Please enter something in Alert..");
			}
		}
		
		function save_consent(){
			var vall											= $("#accept_terms").val();
			var user_key										= $("#user_key").val();
			if($("#accept_terms").prop('checked')){
				var url											= "<?php echo base_url(); ?>patient_setup/save_consent";
				var myCheckboxes 								= new Array();
				$(".agree").each(function() {
					if($(this).prop('checked')){
						myCheckboxes.push('1');
					}else{
						myCheckboxes.push('0');
					}
				});
				$.ajax({
					url: url,
					type: 'POST',
					data: {check_val:myCheckboxes,user_key:user_key},
					dataType: "json",
					success: function(data){
						if(data.response == 'success'){
							$("#pDcheck8").iCheck("check");
							$("#consent_message").html('Agreement updated successfully...');
							$('html, body').animate({scrollTop: "0px"}, 200);
						}else{
							alert("Please try after sometime...");
						}  
					}
				}); 
			}else if(data.response.trim() == 'UserInvalid'){
				alert('Please fill Patient details..');
			}else{
				alert("Please accept terms & conditions..");
				$("#agree_id > div").css({'border':'1px solid red','border-radius':'5px'});
				$("#agree_id > div").focus();
				
			}
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
            var max_fields = 6; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(' '); //add input box

                }
            });


            $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text

                var r = confirm("Are you sure want to delete?");

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
            var max_fields = 6; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap1"); //Fields wrapper
            var add_button = $(".add_field_button1"); //Add button ID
			var count=$("#family_count").val();
            var x = 1; //initlal text box count
            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
					count 			= parseInt(count) +1;
					var relation	='<?php echo $relation; ?>';
                    $(wrapper).append('<div class="panel-body family_class" id="family_row_'+count+'"> <div class="col-md-6 col-sm-12 col-xs-12"> <div class="row"> <div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Name</label> <input type="text" class="form-control" name="data[family_name]['+count+']" placeholder="Name" id="family_name_'+count+'"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <label>Relationship to the Reg user</label> <div class="form-group"> <select class="form-control" name="data[family_relation]['+count+']" id="family_relation_'+count+'">'+relation+'</select> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel</label> <input type="text" name="data[family_tel]['+count+']" id="family_tel_'+count+'" class="form-control" placeholder="+123 4567 890" onkeypress="return restrict_keys(event)"> </div></div><div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Contact</label> <input type="text" class="form-control" name="data[family_contact]['+count+']" onkeypress="return restrict_keys(event)" id="family_contact_'+count+'" placeholder="+123 4567 890"> </div></div><div class="col-md-2 col-sm-12 col-xs-12"> <div class="form-group"> <label>Age</label> <input type="number" name="data[family_age]['+count+']" id="family_age_'+count+'" class="form-control" placeholder="Age"> </div></div></div></div><div class="col-md-4 col-sm-12 col-xs-12 form-text-wrapper"> <div class="form-group"> <label>Address</label> <textarea class="form-control" rows="3" placeholder="Address" name="data[family_address]['+count+']" id="family_address_'+count+'"></textarea> </div><div class="form-check"> <input type="checkbox" class="form-check-input" id="cbxMinorImportAddress" onchange="fill_address(this,'+"'"+'family_address_'+count+"'"+')"> <label class="form-check-label" for="exampleCheck1">Import home address</label> </div></div><div class="col-sm-2 col-md-2"> <div class="form-group"><label>Remove</label> <br><button type="button" class="remove_field1 btn btn-default btn-sm" id="'+count+'"> <span class="glyphicon glyphicon-minus"></span></button><button type="button" onclick="clearPtD('+count+')" class="btn btn-default btn-sm"><i class="fa fa-eraser"></i></button> </div></div></div></div>'); //add input box
					$("#family_count").val(count);
                }
            });

            $(wrapper).on("click", ".remove_field1", function (e) { //user click on remove text

                var r = confirm("Are you sure want to delete?");
                if (r == true) {
                    e.preventDefault();
					var id					= $(this).attr('id');
					//alert(id);
					$("#family_row_"+id).remove();
                    //$(this).parent('div').parent('div').parent('div').remove();
                    x--;
                }
            })
        });



        $(document).ready(function () {
            var max_fields 				= 6; //maximum input boxes allowed
            var wrapper 				= $(".input_fields_wrap2"); //Fields wrapper
            var add_button 				= $(".add_field_button2"); //Add button ID
			var count					= $("#gp_count").val();
			var list					= '<?php echo $country_list; ?>';
            var x = 1; //initlal text box count
            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
					count 			= parseInt(count) +1;
                    $("#gp_form").append('<div class="row gp_class"  id="gp_row_'+count+'"  ><div class="col-md-5 col-sm-12 col-xs-12"><div class="panel panel-default"><div class="panel-heading">GP Details / Contact Info</div><div class="input_fields_wrap"><div class="panel-body" style="height:272px;"><div class="col-md-12 col-sm-12 col-xs-12 profile-details"><div class="row"><div class="col-md-6 col-sm-12 col-xs-12"><div class="form-group"><label>Practice Name</label><span class="asterisk" style="color:red">*</span><input type="text" class="form-control" placeholder="Practice Name" name="data[gp_practice_name]['+count+']" id="gp_practice_name_'+count+'"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Doctor</label><span class="asterisk" style="color:red">*</span> <input type="text" class="form-control" placeholder="Doctor" name="data[gp_doctor_name]['+count+']" id="gp_doctor_name_'+count+'"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 1</label><span class="asterisk" style="color:red">*</span> <input type="text" class="form-control" onkeypress="return restrict_keys(event)" placeholder="+123 456 7890" name="data[gp_tel1]['+count+']" id="gp_tel1_'+count+'"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 2</label> <input type="text" class="form-control" placeholder="+123 456 7890" onkeypress="return restrict_keys(event)" name="data[gp_tel2]['+count+']" id="gp_tel2_'+count+'"> </div></div><div class="col-md-12 col-sm-12 col-xs-12"> <div class="form-group"> <label>Email</label><span class="asterisk" style="color:red">*</span> <input type="text" class="form-control" placeholder="Email" name="data[gp_email]['+count+']" id="gp_email_'+count+'"> </div></div></div></div></div></div></div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="panel panel-default"> <div class="panel-heading">Address Details</div><div class="panel-body"> <div class="row"> <div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper"> <div class="form-group"> <label for="sel1">Country</label><span class="asterisk" style="color:red">*</span> <select class="form-control" name="data[gp_country]['+count+']" id="gp_country_'+count+'">'+list+'</select> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Postcode</label><span class="asterisk" style="color:red">*</span> <input type="text" class="form-control" placeholder="Postcode" name="data[gp_postcode]['+count+']" id="gp_postcode_'+count+'"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>City / Town</label><span class="asterisk" style="color:red">*</span> <input type="text" class="form-control" placeholder="City / Town" name="data[gp_town]['+count+']" id="gp_town_'+count+'"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>State</label><span class="asterisk" style="color:red">*</span> <input type="text" class="form-control" placeholder="State" name="data[gp_state]['+count+']" id="gp_state_'+count+'"></div></div><div class="col-md-12 col-sm-12 col-xs-12 form-text-wrapper"><div class="form-group"><label>Address</label><span class="asterisk" style="color:red">*</span><textarea class="form-control" rows="3" placeholder="Address" name="data[gp_address]['+count+']" id="gp_address_'+count+'"></textarea></div></div></div></div></div></div><div class="col-md-1 col-sm-1 col-xs-12"> <div class="form-group"> <label>Remove</label> <div class="col-md-12 col-sm-12 col-xs-12"> <button type="button" class="remove_field2 btn btn-default btn-sm" id="'+count+'" > <span class="glyphicon glyphicon-minus"></span></button></div><div class="col-md-12 col-sm-12 col-xs-12"><button type="button" class="btn btn-default btn-sm" title="Import Gp record" style="margin-top:8px;" onclick="import_record('+count+')"><i class="fa fa-download"></i></button></div><div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 8px;"><button type="button" onclick="clearGP('+count+')" class="btn btn-default btn-sm"><i class="fa fa-eraser"></i></button></div></div></div></div></div>'); //add input box
					$("#gp_count").val(count);
                }
			});

            $(wrapper).on("click", ".remove_field2", function (e) { //user click on remove text

                var r = confirm("Are you sure want to delete?");
                if (r == true) {
                    e.preventDefault();
					var id					= $(this).attr('id');
					$("#gp_row_"+id).remove();
                   	
				   // $(this).parent('div').parent('div').parent('div').parent('div').parent('div').remove();
                    x--;
                }
            })
        });

        $(document).ready(function () {
            var max_fields 					= 3; //maximum input boxes allowed
            var wrapper 					= $(".input_fields_wrap3"); //Fields wrapper
            var add_button 					= $(".add_field_button3"); //Add button ID
			var list						= '<?php echo $country_list; ?>';
			var count						= $("#chemist_count").val();
			var x 							= 1; //initlal text box count
            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
					count 			= parseInt(count) +1;
                    $("#chemist_form").append('<div class="row chemist_class" id="chemist_row_'+count+'"> <div class="col-md-5 col-sm-12 col-xs-12"> <div class="panel panel-default"> <div class="panel-heading">Chemist Details / Contact Info</div><div class="input_fields_wrap"> <div class="panel-body" style="height:272px;"> <div class="col-md-12 col-sm-12 col-xs-12 profile-details"> <div class="row"> <div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Pharmacy Name</label> <input type="text" class="form-control" placeholder="Pharmacy Name" name="data[chemist_pharmacy_name]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Chemist Name</label> <input type="text" class="form-control" placeholder="Chemist Name" name="data[chemist_name]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 1</label> <input type="text" class="form-control" placeholder="+123 456 7890" onkeypress="return restrict_keys(event)" name="data[chemist_tel1]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 2</label> <input type="text" class="form-control" placeholder="+123 456 7890" name="data[chemist_tel2]['+count+']" onkeypress="return restrict_keys(event)"> </div></div><div class="col-md-12 col-sm-12 col-xs-12"> <div class="form-group"> <label>Email</label> <input type="text" class="form-control" placeholder="Email" name="data[chemist_email]['+count+']"> </div></div></div></div></div></div></div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="panel panel-default"> <div class="panel-heading">Address Details</div><div class="panel-body"> <div class="row"> <div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper"> <div class="form-group"> <label for="sel1">Country</label> <select class="form-control" name="data[chemist_country]['+count+']">'+list+'</select> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Postcode</label> <input type="text" class="form-control" placeholder="Postcode" name="data[chemist_postcode]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>City / Town</label> <input type="text" class="form-control" placeholder="City / Town" name="data[chemist_town]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>State</label> <input type="text" class="form-control" placeholder="State" name="data[chemist_state]['+count+']"></div></div><div class="col-md-12 col-sm-12 col-xs-12 form-text-wrapper"> <div class="form-group"> <label>Address</label> <textarea class="form-control" rows="3" placeholder="Address" name="data[chemist_address]['+count+']"></textarea> </div></div></div></div></div></div><div class="col-sm-1 col-md-1"> <div class="form-group"> <label>Remove</label> <div class="col-md-12 col-sm-12 col-xs-12"> <button type="button" class="remove_field3 btn btn-default btn-sm" id="'+count+'"><span class="glyphicon glyphicon-minus"></span></button> </div><div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:8px;"> <button type="button" onclick="clearCD('+count+')" class="btn btn-default btn-sm"><i class="fa fa-eraser"></i></button> </div></div></div></div>'); //add input box
					$("#chemist_count").val(count);	
                }
            });

            $(wrapper).on("click", ".remove_field3", function (e) { //user click on remove text

                var r = confirm("Are you sure want to delete?");
                if (r == true) {
                    e.preventDefault();
					var id					= $(this).attr('id');
					$("#chemist_row_"+id).remove();
//                    $(this).parent('div').parent('div').parent('div').parent('div').parent('div').remove();
                    x--;
                }
            })
        });

        $(document).ready(function () {
            var max_fields 					= 3; //maximum input boxes allowed
            var wrapper 					= $(".input_fields_wrap4"); //Fields wrapper
            var add_button 					= $(".add_field_button4"); //Add button ID
			var list						= '<?php echo $country_list; ?>';
			var count						= $("#career_count").val();
			var x 							= 1; //initlal text box count
            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
					count 			= parseInt(count) +1;
                    $("#career_form").append('<div class="row career_class" id="career_row_'+count+'" > <div class="col-md-5 col-sm-12 col-xs-12"> <div class="panel panel-default"> <div class="panel-heading">Career Details / Contact Info</div><div class="input_fields_wrap"> <div class="panel-body" style="height:272px;"> <div class="col-md-12 col-sm-12 col-xs-12 profile-details"> <div class="row"> <div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Company Name</label> <input type="text" class="form-control" placeholder="Company Name" name="data[career_company_name]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Name</label> <input type="text" class="form-control" placeholder="Name" name="data[career_name]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 1</label> <input type="text" class="form-control" placeholder="+123 456 7890" name="data[career_tel1]['+count+']" onkeypress="return restrict_keys(event)"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 2</label> <input type="text" class="form-control" placeholder="+123 456 7890" onkeypress="return restrict_keys(event)" name="data[career_tel2]['+count+']"> </div></div><div class="col-md-12 col-sm-12 col-xs-12"> <div class="form-group"> <label>Email</label> <input type="text" class="form-control" placeholder="Email" name="data[career_email]['+count+']"> </div></div></div></div></div></div></div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="panel panel-default"> <div class="panel-heading">Address Details</div><div class="panel-body"> <div class="row"> <div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper"> <div class="form-group"> <label for="sel1">Country</label> <select class="form-control" name="data[career_country]['+count+']">'+list+'</select> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Postcode</label> <input type="text" class="form-control" placeholder="Postcode" name="data[career_postcode]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>City / Town</label> <input type="text" class="form-control" placeholder="City / Town" name="data[career_town]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>State</label> <input type="text" class="form-control" placeholder="State" name="data[career_state]['+count+']"> </div></div><div class="col-md-12 col-sm-12 col-xs-12 form-text-wrapper"> <div class="form-group"> <label>Address</label> <textarea class="form-control" rows="3" placeholder="Address" name="data[career_address]['+count+']"></textarea> </div></div></div></div></div></div><div class="col-sm-1 col-md-1"> <div class="form-group"> <label>Remove</label> <div class="col-md-12 col-sm-12 col-xs-12"> <button type="button" class="remove_field4 btn btn-default btn-sm" id="'+count+'"> <span class="glyphicon glyphicon-minus"></span></button> </div><div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:8px;"> <button type="button" onclick="clearCR('+count+')" class="btn btn-default btn-sm"><i class="fa fa-eraser"></i></button> </div></div></div></div>'); //add input box
					$("#career_count").val(count);	
                }
            });

            $(wrapper).on("click", ".remove_field4", function (e) { //user click on remove text

                var r = confirm("Are you sure want to delete?");
                if (r == true) {
                    e.preventDefault();
					var id					= $(this).attr('id');
					$("#career_row_"+id).remove();
                //    $(this).parent('div').parent('div').parent('div').parent('div').parent('div').remove();
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


        $(function () {
            $('.multiselect-ui').multiselect({
                includeSelectAllOption: true
            });
        });

	$("#checkall").change(function(){
		if (this.checked) {
			$('.agree').iCheck("check");
		}else{
			$('.agree').iCheck("uncheck");
		}
	});
	
	function edit_alert(a){
		var text			= $("#alert_text_"+a).html();
		$("#alert_id").val(a);
		$("#alert_box").val(text.trim());
	}
	function edit_notes(a){
		var text			= $("#note_text_"+a).html();
		$("#note_id").val(a);
		$("#note_box").val(text.trim());
	}
	function delete_alert(a){
		var stat			= confirm('Are you sure want to delete Alert ?');
		var url				= "<?php echo base_url(); ?>patient_setup/remove_notes";
		var user_key		= $("#user_key").val();
		if(stat == true){
			$.post(url,{a:a,type:'alert',user_key:user_key},function(response){
				if(response.response.trim() == 'success'){
					$("#alert_row_"+a).remove();
					if($("#alert_tbody").html() == ''){
						$("#alert_tbody").html('<tr><td colspan="3"><input type="hidden" id="alert_empty" value="1" />No alerts found...</td></tr>');
					}
				}else if(data.response.trim() == 'UserInvalid'){
					alert('Please fill Patient details..');
				}else{
					alert('Please try after sometime..');
				}
			},'json');
		}
	}
	
	function delete_note(a){
		var stat			= confirm('Are you sure want to delete Alert ?');
		var url				= "<?php echo base_url(); ?>patient_setup/remove_notes";
		var user_key		= $("#user_key").val();
		if(stat == true){
			$.post(url,{a:a,type:'notes',user_key:user_key},function(response){
				if(response.response.trim() == 'success'){
					$("#note_row_"+a).remove();
					if($("#notes_tbody").html() == ''){
						$("#notes_tbody").html('<tr><td colspan="3"><input type="hidden" id="note_empty" value="1" />No notes found...</td></tr>');
					}
				}else if(data.response.trim() == 'UserInvalid'){
					alert('Please fill Patient details..');
				}else{
					alert('Please try after sometime..');
				}
			},'json');
		}
	}
	
	
	function update_alert(){
		var txt_alert		= $("#alert_box").val();
		var txt_id			= $("#alert_id").val();
		var user_key		= $("#user_key").val();
		var url				= "<?php echo base_url(); ?>patient_setup/update_notes";
		$.post(url,{txt_alert : txt_alert,txt_id:txt_id,type:'alert',user_key:user_key},function(response){
			//console.log(response);
			if(response.response.trim()=='success'){
				$("#alert_text_"+txt_id).html(txt_alert.trim());
				$("#alert_time_"+txt_id).html('<p>'+response.saved_time+' Added by <i>'+response.name+'</i></p>');
				$("#alert_message").html('Alert updated successfully...');
			}else if(data.response.trim() == 'UserInvalid'){
				alert('Please fill Patient details..');
			}else{
				alert('Please after sometime...');
			}
			$("#alert-modal").attr('class','modal fade alerts-info');
			$("#alert-modal").attr('style','display:none');
			$(".popup").attr('class','modal-backdrop popup fade');
			$(".popup").attr('style','display:none');
			$("#alert_box").val('');
			
		},'json');
	}
	
	function update_notes(){
		var txt_alert		= $("#note_box").val();
		var txt_id			= $("#note_id").val();
		var user_key		= $("#user_key").val();
		var url				= "<?php echo base_url(); ?>patient_setup/update_notes";
		$.post(url,{txt_alert : txt_alert,txt_id:txt_id,type:'notes',user_key:user_key},function(response){
			//console.log(response);
			if(response.response.trim()=='success'){
			$("#note_text_"+txt_id).html(txt_alert.trim());
			$("#note_time_"+txt_id).html('<p>'+response.saved_time+' Added by <i>'+response.name+'</i></p>');
			$("#notes_message").html('Notes updated successfully...');
			}else if(data.response.trim() == 'UserInvalid'){
				alert('Please fill Patient details..');
			}else{
				alert('Please after sometime...');
			}
			$("#note-modal").attr('class','modal fade alerts-info');
			$("#note-modal").attr('style','display:none');
			$(".popup").attr('class','modal-backdrop popup fade');
			$(".popup").attr('style','display:none');
			$("#note_box").val('');
		},'json');
	}
	
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

	function clearGP(a) {
		var r = confirm("Are you sure want to clear all data?");
		if (r == true) {
			$('#gp_row_'+a).find('input[type=text]').val('');
			$('#gp_row_'+a).find('textarea').val('');
			$('#gp_row_'+a).find('input[type=email]').val('');
		}

	}
	function clearCD(a) {
		var r = confirm("Are you sure want to clear all data?");
		if (r == true) {
			$('#chemist_row_'+a).find('input[type=text]').val('');
			$('#chemist_row_'+a).find('textarea').val('');
			$('#chemist_row_'+a).find('input[type=email]').val('');
		//	pdCheck3();
		}

	}
	function clearCR() {
		var r = confirm("Are you sure want to clear all data?");
		if (r == true) {
			$('#career_row_'+a).find('input[type=text]').val('');
			$('#career_row_'+a).find('textarea').val('');
			$('#career_row_'+a).find('input[type=email]').val('');
		}

	}
/*        function clearFamily() {
		var r = confirm("Are you sure want to clear all data?");
		if (r == true) {
			$('.input_fields_wrap1').find('input[type=text]').val('');
			$('.input_fields_wrap1').find('textarea').val('');
			pdCheck1();
		}

	}
*/
	function clearPtD(a) {
		var r = confirm("Are you sure want to clear all data?");
		if (r == true) {
			$('#family_row_'+a).find('input[type=text]').val('');
			$('#family_row_'+a).find('textarea').val('');
			$('#family_row_'+a).find('input[type=email]').val('');
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
        
		
	function import_record(x){
		url				='<?php echo base_url(); ?>account_setup/user_details';
		$.post(url,function(response){
			console.log(response);
			if(response.response.trim()=='success'){
				if(response.details.firstname && response.details.lastname){
					$("#gp_doctor_name_"+x).val(response.details.firstname+' '+response.details.lastname);
				}else if(response.details.practice_name){
					$("#gp_practice_name_"+x).val(response.details.practice_name);
				}
				if(response.details.mobile){
					$("#gp_tel1_"+x).val(response.details.mobile);
				}else if(response.details.tel1){
					$("#gp_tel1_"+x).val(response.details.tel1);
				}
				$("#gp_email_"+x).val(response.details.primary_email);
				$("#gp_country_"+x).val(response.details.country_id);
				$("#gp_postcode_"+x).val(response.details.postcode);
				$("#gp_town_"+x).val(response.details.city_town);
				$("#gp_state_"+x).val(response.details.state);
				$("#gp_address_"+x).val(response.details.address);
				
			}else{
				alert('Please try after sometime...');
			}
		},'json');
	}

    </script>
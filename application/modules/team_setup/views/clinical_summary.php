 
	
	<link href="<?php echo base_url();?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url();?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <style>
        .avg-profile-img {
            width: 120px;
            height: 120px;
        }
        p.summary_view_text {
            font-family: 'Open Sans', sans-serif;
            font-weight: 400;
            color: #666;
            font-size: 14px;
            line-height: 1.6em;
            word-break: break-word;
			text-align: justify;
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
        .dummy_btm {
            padding-bottom: 19px;
        }
        .pro_reg_border {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }
		.attachment_heading {
            font-size: 14px !important;
            font-weight: bold !important;
        }
    </style>

            <!-- /top navigation -->
            <!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->
                <form class="form-horizontal form-label-left row custom_temp">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>
									Registration - Start: <?php echo date('d/m/Y',strtotime($user_details['user_start_date'])); ?> &nbsp;&nbsp;&nbsp; <span style="background: #229e78; color:#fff; padding: 1px 5px;" class="pull-right">
                                    <i class="fa fa-check-square"></i> Active
                                    </span>
                                </h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li>
										<a href="<?php echo base_url().'team_setup/index/'.$this->encryptionfunction->enCrypt($user_details['user_key']); ?>" type="button" class="btn btn-md btn-success" style="padding: 6px 10px;"> Edit </a>
									</li>
                                   <!-- <li> <input type="button" onclick="printDiv('printableArea')" class="btn btn-md btn-success" value="Print" /></li>-->
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="row" id="printableArea">
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="row">
                                            <!-- User profile -->
                                            <div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">Personal Details</h4>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="col-md-2">
                                                            <div class="text-center">
																<?php
																	if(!($user_details['img_name']) && !($user_details['img_path'])){
																?>	
																	<img src="<?php echo base_url(); ?>assets/img/profile-image.png" class="avg-profile-img img-circle img-thumbnail" alt="Profile">
																<?php
																	}else{
																?>
																	<img src="<?php echo base_url().'assets/uploads/'.$user_details['img_path'].$user_details['img_name']; ?>" class="avg-profile-img img-circle img-thumbnail" alt="Profile">
																<?php } ?>
																
																<!--
                                                                <img src="http://bootdey.com/img/Content/avatar/avatar5.png" class="avg-profile-img img-circle img-thumbnail" alt="...">-->
                                                            </div>

                                                        </div>
                                                        <div class="col-md-10" style="margin-top:15px;">
                                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                                                <label>Title</label>
                                                                <div class="form-group">
                                                                    <p class="summary_view_text"><?php if($user_details['title']){echo $user_details['title'];} ?> </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <p class="summary_view_text">
																		<?php
																			if($user_details['firstname'] && $user_details['lastname']){
																				if($user_details['middlename']){
																					echo $user_details['firstname'].' '.$user_details['middlename'].' '.$user_details['lastname'];
																				}else{
																					echo $user_details['firstname'].' '.$user_details['lastname'];
																				}
																			}
																		?>
																	</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                                                <label>Gender</label>
                                                                <p class="summary_view_text">
																	<?php
																		if($user_details['gender']){
																			echo $user_details['gender'];
																		}
																	?>
																</p>
                                                            </div>

                                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <div class="xdisplay_inputx form-group has-feedback">
                                                                        <label>DOB</label>
                                                                        <p class="summary_view_text"> 
																		<?php
																		if($user_details['dob']){
																			echo date('d/m/Y',strtotime($user_details['dob']));
																		}
																		?>
																	</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Age</label>
                                                                    <p class="summary_view_text">
																		<?php
																		$dob			= $user_details['dob'];
																		$diff 			= (date('Y') - date('Y',strtotime($dob)));
																		echo $diff.' Years';
																		?>
																	</p>
                                                                </div>
                                                            </div>
                                                            <!--<div class="col-md-2 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Martial Status</label>
                                                                    <p class="summary_view_text">Single</p>
                                                                </div>
                                                            </div>-->
                                                            <div class="col-md-8 col-sm-12 col-xs-12 padding-null">

                                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>Mobile</label>
                                                                        <p class="summary_view_text"><?php if($user_details['mobile']){echo $user_details['mobile'];} ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>Phone</label>
                                                                        <p class="summary_view_text"><?php if($user_details['work_telephone']){echo $user_details['work_telephone'];} ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>Email</label>
                                                                        <p class="summary_view_text"><?php if($user_details['primary_email']){echo $user_details['primary_email'];} ?></p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Address</label>
                                                                    <p class="summary_view_text">
																	<?php
																		if($user_details['address']){echo $user_details['address'];}
																	?>
																	</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">Demographic Details</h4>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Ethinic Origin</label>
                                                                <p class="summary_view_text"><?php if(isset($ethinic_details[$user_details['ethinic_origin']])){echo $ethinic_details[$user_details['ethinic_origin']];} ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Language Spoken</label>
                                                                <p class="summary_view_text">
																<?php
																	$list_array		= $this->common->language_list($user_details['languages']);
																	$lang			= '';
																	foreach($list_array as $key => $val){
																		$lang		.= $val.', ';
																	}
																	echo trim($lang,', ');
																?>
																</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">Professional Details</h4>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Professional Details</label>
                                                                    <p class="summary_view_text">
																		<?php
																			$prof_details			 = '';
																			foreach ($medical_bodies as $m_key => $m_val){
																				$val_r				 = (array)$m_val;
																				if($val_r['professional_id']){
																					$prof_details	.= $professional_body[$val_r['professional_id']].", ";
																				} 
																			}
																			echo trim($prof_details,', ');
																		?>
																	</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Type of specialization</label>
                                                                    <p class="summary_view_text">
																		<?php
																			$prof_details			 = '';
																			foreach ($medical_bodies as $m_key => $m_val){
																				$val_r				 = (array)$m_val;
																				if($val_r['specialization_id']){
																					$prof_details	.= $specialization[$val_r['specialization_id']].", ";
																				} 
																			}
																			echo trim($prof_details,', ');
																		?>
																	</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Qualifications</label>
                                                                    <p class="summary_view_text">
                                                                       <?php if($user_details['qualifications']){echo $user_details['qualifications'];} ?>
                                                                    </p>
                                                                </div>
                                                            </div>
															<div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Professional Experience </label>
                                                                    <p class="summary_view_text">
																	<?php if($user_details['professional_exp']){echo $user_details['professional_exp'];} ?>
																	</p>
                                                                </div>
                                                            </div>
                                                          
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Professional Services </label>
                                                                    <p class="summary_view_text">
																		<?php
																			$list_array		= $this->common->service_name($user_services);
																			$serv 			= '';
																			foreach($list_array as $key => $val){
																				$serv		.= $val.', ';
																			}
																			echo trim($serv,', ');
																		 ?>
																	</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Memberships </label>
                                                                    <p class="summary_view_text">
																	<?php if($user_details['memberships']){echo $user_details['memberships'];} ?>
																	</p>
                                                                </div>
                                                            </div>
															<!--<div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Services </label>
                                                                    <p class="summary_view_text">ENT, Xrays, Genral Practice, Surgon, Orthopetic </p>
                                                                </div>
                                                            </div>-->
															<div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Years of Experience</label>
                                                                    <p class="summary_view_text">
																	<?php if($user_details['year_exp']){echo $user_details['year_exp'].' yrs';} ?>
																	</p>
                                                                </div>
                                                            </div>
                                                        </div>
													</div>
                                                </div>

                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">Professional Registration</h4>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title">Professional Registration</h4>
                                                                </div>
                                                                <div class="panel-body">
																	<?php
																	foreach ($medical_bodies as $m_key => $m_val){
																		$val_r		= (array)$m_val;
																		?>
																		<div class="col-md-12 pro_reg_border">
                                                                        <p>Country : <?php if($country['name'][$val_r['country_id']]){echo $country['name'][$val_r['country_id']];} ?></p>
                                                                        <p>Professional Body : <?php if($val_r['medical_bodies_id']){echo $medical_body_type[$val_r['medical_bodies_id']];} ?></p>
                                                                        <p>Register Number : <?php if($val_r['register_number']){echo $val_r['register_number'];} ?></p>
                                                                        <p>Expiry Date : <?php if($val_r['expiry_date']){echo implode('/',array_reverse(explode('-',$val_r['expiry_date'])));} ?></p>
                                                                    </div>
																	<?php
																	}
																	?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title">ICO Registration</h4>
                                                                </div>
                                                                <div class="panel-body">
																	<?php
																	foreach ($other_bodies as $o_key => $o_val){
																		$val_r		= (array)$o_val;
																		if($val_r['other_bodies_id']== 1){
																			?>
																			<div class="col-md-12 pro_reg_border">
																				<p>Country : <?php if($country['name'][$val_r['country_id']]){echo $country['name'][$val_r['country_id']];} ?></p>
																				<p>Register Number : <?php echo $val_r['register_number'];  ?></p>
																				<p>Expiry Date : <?php if($val_r['expiry_date']){echo implode('/',array_reverse(explode('-',$val_r['expiry_date'])));} ?></p>
																				<p class="dummy_btm"></p>
																			</div>
																			<?php
																		}
																	}
																	?>
																</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title">Indemnity Registration</h4>
                                                                </div>
                                                                <div class="panel-body">
																	<?php
																	foreach ($other_bodies as $d_key => $d_val){
																		$val_r		= (array)$d_val;
																		if($val_r['other_bodies_id']== 2){
																			?>
																			<div class="col-md-12 pro_reg_border">
																				<p>Country : <?php if($country['name'][$val_r['country_id']]){echo $country['name'][$val_r['country_id']];} ?></p>
																				<p>Name of the Company : <?php if($val_r['company_name']) {echo $val_r['company_name'];}  ?></p>
																				<p>Register Number : <?php if($val_r['register_number']) {echo $val_r['register_number'];}  ?></p>
																				<p>Expiry Date : <?php if($val_r['expiry_date']){echo implode('/',array_reverse(explode('-',$val_r['expiry_date'])));} ?></p>
																			</div>
																			<?php
																		}
																	}
																	?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-default">
                                                    <div class="panel-heading">Documents</div>
                                                    <div class="panel-body">
                                                        <div class="panel panel-default panel-default-two" style="margin-bottom:0px;">
                                                            <div class="panel-heading panel-heading-two">Attachments</div>
															<div class="panel-body">
																<div class="x_panel">
																	<div class="x_title">
																		<h2 class="attachment_heading">Professional Registration Documents</h2>
																		<div class="clearfix"></div>
																	</div>
																	<?php
																	$i	= 0;
																	foreach($uploads_medical as $up_key => $up_val){  
																			$file_values		=(array)$up_val;
																			if($file_values['medical_bodies'] && $file_values['other_bodies_id']== null){
																				$i++;
																	?>
																		<div class="row">
																			<div class="col-md-2 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Title</label>
																					<p class="summary_view_text"><?php if($file_values['title']){echo $file_values['title'];} ?></p>
																				</div>
																			</div>
																			<div class="col-md-2 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Link</label>
																					<p class="summary_view_text">
																						<a href="<?php echo base_url() .'assets/uploads/'.$file_values['file_path'].$file_values['file_name']; ?>" target="_blank" style="text-decoration:underline" >
																							Document Link
																						</a>
																					</p>
																				</div>
																			</div>
																			<div class="col-md-2 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Added on</label>
																					<p class="summary_view_text"><?php if($file_values['created_date']){echo date('d/m/Y',strtotime($file_values['created_date']));} ?></p>
																				</div>
																			</div>
																		</div>
																	<?php
																			}
																		}
																		if($i == 0){
																		?>
																		<div class="row">
																			<div class="col-md-12 col-sm-12 col-xs-12">
																				<label>No records found...</label>
																			</div>
																		</div>
																		
																		<?php
																		}
																		?>
																</div>
																
																
																<div class="x_panel">
																	<div class="x_title">
																		<h2 class="attachment_heading">ICO Registration Documents</h2>
																		<div class="clearfix"></div>
																	</div>
																	<?php
																	$i	= 0;
																	foreach($uploads_medical as $up_key => $up_val){  
																		$file_values		=(array)$up_val;
																		if($file_values['other_bodies_id'] == $this->config->item('ico_id')  && $file_values['medical_bodies']== null){
																		$i++;
																	?>
																		<div class="row">
																			<div class="col-md-2 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Title</label>
																					<p class="summary_view_text"><?php if($file_values['title']){echo $file_values['title'];} ?></p>
																				</div>
																			</div>
																			<div class="col-md-2 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Link</label>
																					<p class="summary_view_text">
																						<a href="<?php echo base_url() .'assets/uploads/'.$file_values['file_path'].$file_values['file_name']; ?>" target="_blank" style="text-decoration:underline" >
																							Document Link
																						</a>
																					</p>
																				</div>
																			</div>
																			<div class="col-md-2 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Added on</label>
																					<p class="summary_view_text"><?php if($file_values['created_date']){echo date('d/m/Y',strtotime($file_values['created_date']));} ?></p>
																				</div>
																			</div>
																		</div>
																	<?php }
																	}
																	if($i == 0){
																		?>
																		<div class="row">
																			<div class="col-md-12 col-sm-12 col-xs-12">
																				<label>No records found...</label>
																			</div>
																		</div>
																		
																		<?php
																		}
																		
																	?>
																</div>
																
																
																<div class="x_panel">
																	<div class="x_title">
																		<h2 class="attachment_heading">Indemnity Documents</h2>
																		<div class="clearfix"></div>
																	</div>
																	<?php
																	$i	= 0;
																	foreach($uploads_medical as $up_key => $up_val){  
																		$file_values		=(array)$up_val;
																		if($file_values['other_bodies_id'] == $this->config->item('indemnity_id') && $file_values['medical_bodies']== null){
																			$i++;
																	?>
																		<div class="row">
																			<div class="col-md-2 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Title</label>
																					<p class="summary_view_text"><?php if($file_values['title']){echo $file_values['title'];} ?></p>
																				</div>
																			</div>
																			<div class="col-md-2 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Link</label>
																					<p class="summary_view_text">
																						<a href="<?php echo base_url() .'assets/uploads/'.$file_values['file_path'].$file_values['file_name']; ?>" target="_blank" style="text-decoration:underline" >
																							Document Link
																						</a>
																					</p>
																				</div>
																			</div>
																			 
																			<div class="col-md-2 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Added on</label>
																					<p class="summary_view_text"><?php if($file_values['created_date']){echo date('d/m/Y',strtotime($file_values['created_date']));} ?></p>
																				</div>
																			</div>
																		</div>
																	<?php }
																	}
																	if($i == 0){
																		?>
																		<div class="row">
																			<div class="col-md-12 col-sm-12 col-xs-12">
																				<label>No records found...</label>
																			</div>
																		</div>
																	<?php
																	}
																	?>
																</div>
															
															
															
																<div class="x_panel">
																	<div class="x_title">
																			<h2 class="attachment_heading">General Documents</h2>
																			<div class="clearfix"></div>
																		</div>
																<?php
																	$i	= 0;
																	foreach($uploads_others as $up_key => $up_val){
																		$i++;
																		$file_values		=(array)$up_val;
																?>		<div class="row">
																			<div class="col-md-2 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Title</label>
																					<p class="summary_view_text"><?php if($file_values['title']){echo $file_values['title'];} ?></p>
																				</div>
																			</div>
																			<div class="col-md-2 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Link</label>
																					<p class="summary_view_text">
																						<a href="<?php echo base_url() .'assets/uploads/'.$file_values['file_path'].$file_values['file_name']; ?>" target="_blank" style="text-decoration:underline" >
																							Document Link
																						</a>
																					</p>
																				</div>
																			</div>
																			<div class="col-md-2 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Added on</label>
																					<p class="summary_view_text"><?php if($file_values['created_date']){echo date('d/m/Y',strtotime($file_values['created_date']));} ?></p>
																				</div>
																			</div>
																		</div>
																<?php }
																	if($i == 0){
																		?>
																		<div class="row">
																			<div class="col-md-12 col-sm-12 col-xs-12">
																				<label>No records found...</label>
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

                                                <!--<div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">Consulting Rooms</h4>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="col-md-12">
                                                            <p>
                                                                <label style="font-size:17px;">Consulting Room 1</label> <br /> <strong>Address</strong> : London Street Road, State - 12345 <br />
                                                                <strong>Parking </strong>: Parking - off road
                                                            </p>
                                                            <p>
                                                                <table class="table table-striped table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Weeks</th>
                                                                            <th><i class="fa fa-coffee" aria-hidden="true"></i> Morn</th>
                                                                            <th>
                                                                                <i class="fa fa-sun-o" aria-hidden="true"></i>
                                                                                Noon
                                                                            </th>
                                                                            <th><i class="fa fa-moon-o" aria-hidden="true"></i> Even</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Mon</td>
                                                                            <td>09:00 - 11:00 AM</td>
                                                                            <td>01:00 - 03:00 PM</td>
                                                                            <td>06:00 - 09:00 PM</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Tue</td>
                                                                            <td>09:00 - 11:00 AM</td>
                                                                            <td>01:00 - 03:00 PM</td>
                                                                            <td>06:00 - 09:00 PM</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Wed</td>
                                                                            <td>09:00 - 11:00 AM</td>
                                                                            <td>01:00 - 03:00 PM</td>
                                                                            <td>06:00 - 09:00 PM</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Thu</td>
                                                                            <td colspan="3" style="text-align: center; color:green;"><b>---  24/7 Open ---</b></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Fri</td>
                                                                            <td colspan="3" style="text-align: center; color:red;"><b>---  Closed  ---</b></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Sat</td>
                                                                            <td colspan="3" style="text-align: center; color:green;"><b>---  24/7 Open ---</b></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Sun</td>
                                                                            <td colspan="3" style="text-align: center; color:red;"><b>---  Closed  ---</b></td>
                                                                        </tr>
																		<tr>
                                                                            <td> Holidays </td>
																			<td colspan="3">Christmas,New Year </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>-->


                                            </div>
                                            <!-- User profile -->
                                        </div>
                                        <div class="col-md-12">
                                            <!-- Community -->

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
	<script src="<?php echo base_url();?>assets/js/custom.min.js"></script>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
 
					<style type="text/css">
						.btn:hover {
							color: #fff;
							background-color: #1f9f78;
							border-color: #1f9f78;
						}
						.btn:focus {
							color: #fff;
							background-color: #1f9f78;
							border-color: #1f9f78;
						}
						.actionBar {
							width: 100%;
							border-top: 1px solid #ddd;
							padding: 10px 5px;
							text-align: right;
							margin-top: 10px;
						}
						.upload_btn{
							position: absolute;
							font-size: 50px;
							opacity: 0;
							right: 0;
							top: 0;
						}
						.modal-dialog{
							z-index:1040 !important;
						}
					</style>
					<!-- page content -->
					<div class="col-md-12">
						<div class="col-md-12 col-sm-12 col-xs-12 well admin-content" id="home">
							<div class="col-md-12">
								<p>
									Good Morning!<strong> <?php echo ucfirst($details['title'].' '.$details['firstname'].' '.$details['lastname']) ?></strong>.<br>
									Welcome to Orbis Health
								</p>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 dashboardlink">
								<a href="#" class="info-tiles booking-wrapper">
									<div class="dashboard-item-wrapper">
										<div class="dahshboard-item">
											<div class="icon">
												<i class="fa fa-bookmark" aria-hidden="true"></i>
											</div>
											<div class="text-right tile-body">
												<span>My Booking</span>
												<p>10</p>
											</div>
											<div class="tile-footer">
												<p>Manage Book <i class="fa fa-angle-double-right" aria-hidden="true"></i></p>
											</div>
										</div>
									</div>
								</a>
								<a href="#" class="info-tiles booking-wrapper upcoming">
									<div class="dashboard-item-wrapper">
										<div class="dahshboard-item">
											<div class="icon">
												<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
											</div>
											<div class="text-right tile-body">
												<span>Upcoming</span>
												<p>10/10/10</p>
											</div>
											<div class="tile-footer">
												<p>Appointment <i class="fa fa-angle-double-right" aria-hidden="true"></i></p>
											</div>
										</div>
									</div>
								</a>
								<a href="#" class="info-tiles unreadmgs">
									<div class="dashboard-item-wrapper">
										<div class="dahshboard-item">
											<div class="icon">
												<i class="fa fa-envelope" aria-hidden="true"></i>
											</div>
											<div class="text-right tile-body">
												<span>Unread Msg</span>
												<p>10</p>
											</div>
											<div class="tile-footer">
												<p>See all Mgs <i class="fa fa-angle-double-right" aria-hidden="true"></i></p>
											</div>
										</div>
									</div>
								</a>
								<a href="#" class="info-tiles booking-wrapper invoice">
									<div class="dashboard-item-wrapper">
										<div class="dahshboard-item">
											<div class="icon">
												<i class="fa fa-money" aria-hidden="true"></i>
											</div>
											<div class="text-right tile-body">
												<span>My Booking</span>
												<p>10</p>
											</div>
											<div class="tile-footer">
												<p>Manage Invoice <i class="fa fa-angle-double-right" aria-hidden="true"></i></p>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 well admin-content" id="Profile">
							<div class="col-md-12 col-sm-12 col-xs-12">
								
								<div class="row">
									<!-- edit form column -->
									<div class="col-md-12 col-sm-12 col-xs-12 personal-info">
										<div class="panel-group">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Personal Profile</a>
														&nbsp;&nbsp;&nbsp;<span id ="response" style="color:green;font-size:14px;"></span>
													</h4>
													
												</div>
												<div class="panel">
													<div class="panel-body">
														<div class="col-md-3 col-sm-6 col-xs-12">
															<div class="text-center">
																<div class="profile-pic">
																	<input type="file" class="prfile-upload" id="FileUpload1"  onchange="readURL(this);">
																	<!--<img src="http://lorempixel.com/200/200/people/9/" class="avatar img-circle img-thumbnail" alt="avatar" width="100%">-->
																	<?php if(!($details['img_name']) && !($details['img_path'])){
																	?>	
																		<img id="blah" src="<?php echo base_url(); ?>assets/img/profile-image.png" class="avatar img-circle img-thumbnail" style="height:125px;width:125px;" alt="Profile">
																	<?php
																		}else{
																	?>
																		<img id="blah" src="<?php echo base_url().'assets/uploads/'.$details['img_path'].$details['img_name']; ?>" class="avatar img-circle img-thumbnail" style="height:125px;width:125px;" alt="Profile">
																	<?php } ?>
																</div>
															</div>
														</div>
														<div class="col-md-9 col-sm-6 col-xs-12 profile-details">
															<div class="row">
																<div class="col-md-2 col-sm-6  col-xs-6  form-text-wrapper">
																	<label>Title</label><span class="asterisk" style="color:red">*</span>
																	<div class="form-group">     
																		<?php
																			$attr	=array('class'=>'form-control','id'=>'title');
																			$title_options	= array(''=>'Select','Dr'=>'Dr','Mr'=>'Mr','Ms'=>'Ms','Mrs'=>'Mrs','Miss'=>'Miss');
																			echo form_dropdown('Title', $title_options,(isset($details['title']) ? $details['title'] : ''),$attr);
																		?>																	
																		<!--<select class="form-control">
																			<option>Title</option>
																			<option>Mr</option>
																			<option>Ms</option>
																			<option>Mrs</option>
																			<option>Miss</option>
																		</select>-->
																	</div>
																</div>
																<div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper ">
																	<div class="form-group">
																		<label>First Name</label><span class="asterisk" style="color:red">*</span>
																		<input id="first_name" type="text" class="form-control" placeholder="First Name" value="<?php echo $details['firstname'] ?>">
																	</div>
																</div>
																<div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper ">
																	<div class="form-group">
																		<label>Middle Name</label><span class="asterisk" style="color:red">*</span>
																		<input id="middle_name" type="text" class="form-control" placeholder="Middle Name" value="<?php if(!empty($details) && $details['middlename'] ){echo $details['middlename'];} ?>">
																		<!--<input type="text" class="form-control" placeholder="Middle Name">-->
																	</div>
																</div>
																<div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper">
																	<div class="form-group">
																		<label>Last Name</label><span class="asterisk" style="color:red">*</span>
																		<input id="last_name" type="text" class="form-control" placeholder="Last Name" value="<?php echo $details['lastname'] ?>">
																		<!--<input type="text" class="form-control" placeholder="Last Name">-->
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-2 col-sm-6 col-xs-6 form-text-wrapper ">
																	<label>Gender</label><span class="asterisk" style="color:red">*</span>
																	<?php
																		$attr	=array('class'=>'form-control','id'=>'gender');
																		$title_options	= array(''=>'Select','Male'=>'Male','Female'=>'Female','Transgender'=>'Transgender');
																		echo form_dropdown('Gender', $title_options,(isset($details['gender']) ? $details['gender'] : ''),$attr);
																	?>
																	<!--<select class="form-control">
																		<option>Male</option>
																		<option>Female</option>
																		<option>Transgender</option>
																	</select>-->
																</div>
																<div class="col-md-5 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>NHS/Aadhaar/Social Security</label>
																		<input class="form-control" id="txtProfNHSNo" name="NHSNo" placeholder="Identity No" type="text" value="<?php if(!empty($details) && $details['nhs_no']){echo $details['nhs_no'];} ?>">
																	</div>
																</div>
																<div class="col-md-2 col-sm-6 col-xs-6 form-text-wrapper">
																	<div class="">
																		<div class="xdisplay_inputx form-group">
																			<label>DOB</label><span class="asterisk" style="color:red">*</span>
																			<!--<input type="text"  class="form-control" id="single_cal3" aria-describedby="inputSuccess2Status3">-->
																			<input type="text" class="form-control" id="datepicker" placeholder="dd/mm/yy" value="<?php if(!empty($details) && $details['dob']){echo date('d/m/Y',strtotime($details['dob']));} ?>" onchange="ageCount();">
																		</div>
																	</div>
																</div>
																<div class="col-md-2 col-sm-6 col-xs-12 form-text-wrapper">
																	<div class="form-group">
																		<label>Age</label>
																		<?php
																			$diff				= '';
																			if(!empty($details) && $details['dob']){
																				$dob			= $details['dob'];
																				$diff 			= (date('Y') - date('Y',strtotime($dob)));
																				$diff_yrs		= $diff.' yrs';
																			}else{
																				$diff			= '';
																				$diff_yrs		= '';
																			}
																		?>
																		<input type="hidden" value="<?php echo $diff; ?>" id="age_hide" />
																		<input id="ageId" type="text" class="form-control" placeholder="age" disabled='disabled' value="<?php echo $diff_yrs; ?>">
																		<!--<input id="ageId" type="text" class="form-control" placeholder="age">-->
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
														<div class="col-md-124 col-sm-12 col-xs-12 form-text-wrapper">
															<div class="row">
																<div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
																	<div class="form-group">
																		<label for="sel1">Country</label><span class="asterisk" style="color:red">*</span>
																		<!--<select class="form-control" id="sel1">
																			<option>Country 1</option>
																			<option>Country 2</option>
																			<option>Country 3</option>
																			<option>Country 4</option>
																		</select>-->
																		 <?php
																			$attr	=array('class'=>'form-control','id'=>'country_id','disabled'=>'disabled');
																			echo form_dropdown('Country', $country['name'],(isset($details['country_id']) ? $details['country_id'] : ''),$attr);
																		?>
																	</div>
																</div>
																<div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
																	<div class="form-group">
																		<label>Postcode</label><span class="asterisk" style="color:red">*</span>
																		<!--<input type="text" class="form-control" placeholder="Postcode">-->
																		<input type="text" class="form-control" placeholder="Postcode" id="zipcode" value="<?php if($details['postcode']){echo $details['postcode'];} ?>">
																	</div>
																</div>
																
																<div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
																	<div class="form-group">
																		<label>Address</label><span class="asterisk" style="color:red">*</span>
																		<!--<textarea class="form-control" rows="5" placeholder="Address" ></textarea>-->
																		<input type="text" class="form-control" rows="4" placeholder="Address" id="address" onkeyup="search_address();" value="<?php if($details['address']){echo $details['address'];} ?>" />
																	</div>
																</div>
																<div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
																	<div class="form-group">
																		<label>City / Town</label><span class="asterisk" style="color:red">*</span>
																		<!--<input type="text" class="form-control" placeholder="City / Town">-->
																		<input type="text" class="form-control" placeholder="City / Town" id="town" value="<?php if($details['city_town']){echo $details['city_town'];} ?>">
																	</div>
																</div>
																<div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
																	<div class="form-group">
																		<label> State</label><span class="asterisk" style="color:red">*</span>
																		<!--<input type="text" class="form-control" placeholder="County / State">-->
																		<input type="text" class="form-control" placeholder="State" id="state" value="<?php if($details['state']){echo $details['state'];} ?>">
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
														Contact
													</h4>
												</div>
												<div class="panel">
													<div class="panel-body profile-details">
														<div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
															<div class="form-group">
																<label>Home</label>
																<div class="input-group">
																	<span class="input-group-addon">
																		<input type="checkbox">
																	</span>
																	<!--<input type="text" class="form-control" placeholder="+123 4567 890">-->
																	<input type="text" class="form-control" placeholder="+123 4567 890" id="home_mobile" value="<?php if($details['mobile']){echo $details['home_telephone'];} ?>" onkeypress="return restrict_keys(event)">
																</div>
															</div>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
															<div class="form-group">
																<label>Work</label>
																<div class="input-group">
																	<span class="input-group-addon">
																		<input type="checkbox">
																	</span>
																	<!--<input type="text" class="form-control" placeholder="+123 4567 890">-->
																	<input type="text" class="form-control" placeholder="+123 4567 890" id="work_mobile" value="<?php if($details['work_telephone']){echo $details['work_telephone'];} ?>" onkeypress=" return restrict_keys(event)">
																</div>
															</div>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
															<div class="form-group">
																<label>Mobile</label><span class="asterisk" style="color:red">*</span>
																<div class="input-group">
																	<span class="input-group-addon">
																		<input type="checkbox">
																	</span>
																	<!--<input type="text" class="form-control" placeholder="+123 4567 890">-->
																	<input type="text" class="form-control" placeholder="+123 4567 890" id="Mobile" value="<?php if($details['mobile']){echo $details['mobile'];} ?>" onkeypress="return restrict_keys(event)">
																</div>
															</div>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
															<div class="form-group">
																<label>Email 1</label><span class="asterisk" style="color:red">*</span>
																<div class="form-group">	 
																	<!--<input type="text" class="form-control" id="inputSuccess4" placeholder="Email 1">-->
																	<input id="Email" onblur="" type="text" class="form-control" placeholder="Email" value="<?php echo $details['primary_email'] ?>" disabled>
																</div>
															</div>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
															<div class="form-group">
																<label>Email 2</label>
																<div class="form-group">
																	<input type="text" class="form-control" id="inputSuccess4" placeholder="Email 2">
																</div>
															</div>
														</div>	
													</div>
												</div>
											</div>
											
											
											
											
											<div class="panel panel-default  patient_minors_edit" id="minor_div" style="<?php if($diff == ''){echo 'display:none';}else if($diff >16){echo 'display:none';}?>">
												<div class="panel panel-default" id="minor16tab">
													<div class="panel-heading">
														<h4 class="panel-title">
															For Minors &lt; 16
														</h4>
													</div>
													<div class="panel-body">
														<div class="col-md-7 col-sm-12 col-xs-12 padding-null">
															<div class="col-md-6 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>Title</label><span class="asterisk" style="color:red">*</span>
																	<div class="form-group">
																		<?php
																			$attr	=array('class'=>'form-control','id'=>'minor_title');
																			$title_options	= array(''=>'Select','Dr'=>'Dr','Mr'=>'Mr','Ms'=>'Ms','Mrs'=>'Mrs','Miss'=>'Miss');
																			echo form_dropdown('Title', $title_options,(isset($patient_minor['title']) ? $patient_minor['title'] : ''),$attr);
																		?>
																	</div>
																</div>
															</div>
															<div class="col-md-6 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>Parent</label><span class="asterisk" style="color:red">*</span>
																	<input type="text" class="form-control" placeholder="Name" id="minor_name"  value="<?php if(!empty($patient_minor) && $patient_minor['name']){echo $patient_minor['name'];} ?>">
																</div>
															</div>
															<div class="col-md-6 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>Relationship</label><span class="asterisk" style="color:red">*</span>
																	<?php
																		$attr	=array('class'=>'form-control','id'=>'relationship_id');
																		echo form_dropdown('Relationship', $relationship,(isset($patient_minor['relationship_id']) ? $patient_minor['relationship_id'] : ''),$attr);
																	?>
																	 
																</div>
															</div>
															<div class="col-md-6 col-sm-12 col-xs-12">
																<div class="form-group">
																	<label>Tel</label><span class="asterisk" style="color:red">*</span>
																	<input type="text" class="form-control" placeholder="+123 4567 890" id="minor_mobile" value="<?php if(!empty($patient_minor) && $patient_minor['mobile']){echo $patient_minor['mobile'];} ?>" onkeypress="return restrict_keys(event)">
																</div>
															</div>
														</div>
														<div class="col-md-5 col-sm-12 col-xs-12">
															<div class="form-group">
																<div class="col-md-12 col-sm-12 col-xs-12 padding-null">
																	<div class="form-group">
																		<label>Address</label><span class="asterisk" style="color:red">*</span>
																		<textarea class="form-control" rows="3" placeholder="Address" id='minor_address'><?php if(!empty($patient_minor) && $patient_minor['address']){echo $patient_minor['address'];} ?></textarea>
																	</div>
																</div>
																<div class="col-md-12 col-sm-12 col-xs-12 padding-null">
																	<div class="form-group">
																		<input type="checkbox" style="display:inline-block;" class="form-check-input" id="cbxMinorImportAddress" onchange="fill_address(this,'minor_address')" <?php if($details['address'] && isset($patient_minor['address']) && $patient_minor['address'] == $details['address']){echo "checked";} ?>>
																		Import home address
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
														Demographic
													</h4>
												</div>
												<div class="panel">
													<div class="panel-body profile-details">
														<div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
															<div class="form-group">
																<label>Ethinic Origin</label><span class="asterisk" style="color:red">*</span>
																<div class="form-group">                                          
																	<?php
																		$attr	=array('class'=>'form-control','id'=>'ethinic_id');
																		echo form_dropdown('Title', $ethinic_details,(isset($details['ethinic_origin']) ? $details['ethinic_origin'] : ''),$attr);
																	?>
																</div>
															</div>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
															<div class="form-group">
																<label>Languages Spoken</label><span class="asterisk" style="color:red">*</span>                
																	
                                                                        <?php
																			$lang				= array();
																			if($details['languages']){
																				$lang			= explode(',',$details['languages']);
																			}
																			$attr				= array('class'=>'multiselect-ui form-control multiservicelist multiselect-native-select','id'=>'language_id','multiple'=>'multiple');
																			echo form_dropdown('Languages', $languages,$lang,$attr);
																		?>
                                                                    
															</div>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-6 form-text-wrapper">
															<div class="form-group">
																<label>Martial Status</label>                         
																<?php
																	if(isset($diff) && $diff !='' && $diff < 16 ){
																		$attr							= array('class'=>'form-control','id'=>'marital_status','disabled'=>true);
																		$details['marital_status'] 		= '';
																	}else{
																		$attr							= array('class'=>'form-control','id'=>'marital_status');
																	}
																	echo form_dropdown('Martial', $marital_list,(isset($details['marital_status']) ? $details['marital_status'] : ''),$attr);
																?>
															</div>
														</div>
													</div>
													<div class="actionBar">
														<a href="javascript:void(0);" class="buttonNext btn btn-success" onclick="save_details();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</a>
													</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 well admin-content" id="uploadsdoc">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12 padding-null" >
								 <span  onclick="more_details('upload_doc')" id="upload_doc_more" style="<?php if(empty($other_uploads)){echo "display:none;"; }?>"><label><span class="glyphicon glyphicon-plus"></span> Add More Documents</label></span>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12 padding-null"  id="upload_doc_0" style="<?php if(!empty($other_uploads)){ echo "display:none;";} ?>">
									<div class="col-md-3 padding-null" style="width: auto;">
										<label class="" style="text-align:left !important;">Upload Documents / Files:</label>
									</div>
									<div class="col-md-4">
										<p class="btn btn-success btn-sm" style="color: #fff;">
											<input class="file-4 upload_btn" id="upload-other" onchange ="display_uploaded(this,'upload_list_files','upload_document');" type="file" multiple><i class="fa  fa-upload" data-toggle="tooltip" data-title="Edit Title"></i> Upload
										</p><span id="upload_doc_response"style="margin-left:20px"></span>
									</div>
								</div>
								<div class="col-md-10 col-sm-12 col-xs-12" id="upload_document" style="display:none;">
									<!--<label>Upload Documents / Files</label>--> 	
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
								
								<div class="col-md-7 col-sm-12 col-xs-12 padding-null" id="upload_doc_exist">
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
														<td>
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
												}else{
												?>
												<tr role="row">
													<td colspan="3">
													<input id="upload_empty" value="1" type="hidden">
														No records uploaded...
													</td>
												</tr>
												<?php
												}
										   ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 well admin-content" id="fami">
							<div class="">
								<div class="panel panel-default">
									<div class="panel-heading">Family &nbsp;&nbsp;
										<span id ="family_response" style="color:green;font-size:14px;"></span> 
										<span class="pull-right" id="family_row_more" onclick="more_details('family_row')" style="<?php if(empty($family_details)){echo "display:none;";} ?>">
										<label>Add More</label>
										</span>
									</div>
									<div class="panel-body personal-info">
										<div class="row">
											<form action="#" method="post" enctype="multipart/form-data" id="family_form">
												<div class="input_fields_wrap1">
													<div class="panel-body" id="family_row_0" style="<?php if(!empty($family_details)){ echo "display:none;";} ?>">
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
																	<label>Relationship to the user</label>
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
																		<input type="text" class="form-control" placeholder="+123 4567 890" value="<?php echo $country['mobile'][$details['country_id']]  ?>" id='family_tel_0' name='data[family_tel][0]' onkeypress="return restrict_keys(event)">
																	</div>
																</div>
																<div class="col-md-4 col-sm-12 col-xs-12">
																	<div class="form-group">
																		<label>Contact</label>
																		<input type="text" class="form-control" placeholder="+123 4567 890"  value="<?php echo $country['mobile'][$details['country_id']]  ?>" id='family_contact_0' name='data[family_contact][0]' onkeypress="return restrict_keys(event)">
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
														   <div class="form-group">
																<input type="checkbox" style="display:inline-block;" class="form-check-input" id="cbxMinorImportAddress" onchange="fill_address(this,'family_address_0')" >
																Import home address
															</div>
															 
														</div>
														<div class="col-sm-2 col-md-2">
															<div class="form-group">
																<label>Action</label><br>
																<button type="button" class="add_field_button1 btn btn-success btn-sm">
																	<span class="glyphicon glyphicon-plus"></span>
																</button>
																<button type="button" class="btn btn-success btn-sm" onclick="clearPtD(0)">
																	<span class="pull-right"><i  class="fa fa-eraser" data-toggle="tooltip" data-title="Clear all data" data-original-title="" title=""></i></span>
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
																		<p class="summary_view_text"><?php if($value['age']){echo $value['age'].' yrs';} ?> </p>
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
															<div class="col-md-12 col-sm-12 col-xs-12">
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
									
										<div class="actionBar" id="family_row_save"  style="<?php if(!empty($family_details)){ echo "display:none;";} ?>">
											<a href="javascript:void(0);" class="buttonNext btn btn-success"  onclick="save_family_details();" ><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</a>
										</div>
									</div>
								</div>
							</div>
						</div>
															
						<div class="col-md-12 col-sm-12 col-xs-12 well admin-content" id="Invoices">
							<div class="panel-group" id="accordion">
								<div>
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
												<i class="fa fa-file" aria-hidden="true"></i>  &nbsp; Invoices 
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in">
										<div class="panel-body">
											<div class="row">
												<div class="filterable">
													<div class="panel-heading">
														<div class="row profile-details">
															<div class="col-md-3 col-sm-6 col-xs-12 form-text-wrapper">
																<div class="form-group">
																	<input id="fromdate" type="text" class="form-control" placeholder="From Date">
																</div>
															</div>
															<div class="col-md-3 col-sm-6 col-xs-12 form-text-wrapper">
																<div class="form-group">
																	<input id="todate" type="text" class="form-control" placeholder="To Date">
																</div>
															</div>
															<div class="col-md-3 col-sm-6 col-xs-12 form-text-wrapper">
																<div class="form-group">
																	<button id="search" class="btn btn-success btn-sm">Search</button>
																</div>
															</div>
														</div>
														<div class="pull-right">
															<button class="btn btn-success btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> </button>
														</div>
													</div>
													<div class="table-responsive" style="max-width: 1170px;width:100%;">
														<table class="table table-condensed">
															<thead>
																<tr class="filters">
																	<th><input type="text" class="form-control" placeholder="Invoice ID" disabled=""></th>
																	<th><input type="text" class="form-control" placeholder="Date" disabled=""></th>
																	<th><input type="text" class="form-control" placeholder="Received from" disabled=""></th>
																	<th><input type="text" class="form-control" placeholder="Details" disabled=""></th>
																	<th><input type="text" class="form-control" placeholder="Status" disabled=""></th>
																	<th style="width:14%;"></th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td> D00121</td>
																	<td><i class="fa fa-calendar" aria-hidden="true"></i> 22-08-2017</td>
																	<td>Mark Jhon</td>
																	<td>BP Checkup</td>
																	<td><span class="label label-success">Paid</span></td>
																	<td>
																		<a href="invoice.html" class="" data-toggle="collapse" data-target="#detailspatient" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea')" data-toggle="tooltip" title="" data-original-title="Print"><i class="fa fa-print" aria-hidden="true"></i></a> &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal" title="E-mail"><i class="fa fa-envelope" aria-hidden="true"></i> </a>
																	</td>
																</tr>
																<tr id="detailspatient" class="collapse">
																	<td><span class="label label-success"> D00121</td>
																	<td><i class="fa fa-calendar" aria-hidden="true"></i> 22-08-2017</td>
																	<td>Mark Jhon</td>

																	<td>BP Checkup</td>
																	<td><a class="" data-toggle="collapse" data-target="#detailspatient" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea')" data-toggle="tooltip" title="" data-original-title="Print"><i class="fa fa-print" aria-hidden="true"></i></a> &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal" title="E-mail"><i class="fa fa-envelope" aria-hidden="true"></i> </a></td>

																</tr>
																<tr>
																	<td> D00122</td>
																	<td><i class="fa fa-calendar" aria-hidden="true"></i> 22-08-2017</td>
																	<td>Mark Jhon</td>
																	<td>BP Checkup</td>
																	<td><span class="label label-success">Paid</span></td>
																	<td>
																		<a class="" data-toggle="collapse" data-target="#detailspatient" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea')" data-toggle="tooltip" title="" data-original-title="Print"><i class="fa fa-print" aria-hidden="true"></i></a> &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal" title="E-mail"><i class="fa fa-envelope" aria-hidden="true"></i> </a>
																	</td>
																</tr>
																<tr>
																	<td> D00123</td>
																	<td><i class="fa fa-calendar" aria-hidden="true"></i> 22-08-2017</td>
																	<td>Mark Jhon</td>

																	<td>BP Checkup</td>
																	<td><span class="label label-warning">UnPaid</span></td>
																	<td>
																		<a class="" data-toggle="collapse" data-target="#detailspatient" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea')" data-toggle="tooltip" title="" data-original-title="Print"><i class="fa fa-print" aria-hidden="true"></i></a> &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal" title="E-mail"><i class="fa fa-envelope" aria-hidden="true"></i> </a> &nbsp;  <a data-target="tooltip"  title="Pay Now" data-toggle="tooltip" data-original-title="Pay Now"><i class="fa fa-credit-card" aria-hidden="true"></i> </a>
																	</td>
																</tr>
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
															
															
						<div class="col-md-12 col-sm-12 col-xs-12 well admin-content" id="Activity">
						<div><h5>Bookings</h5></div>	

						<div class="panel-group" id="accordion">
						<div class="panel panel-success">
						<div class="panel-heading">
						<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="color:green;">
						<img src="<?php echo base_url(); ?>assets/img/calender2-icon.png">  &nbsp; Upcoming Bookings 
						</a>
						</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in">
						<div class="panel-body">
						<div class="row">
						<div class="filterable">
						<div class="panel-heading">

						<div class="pull-right">
						<button class="btn btn-success btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> </button>
						</div>
						</div>
						<div class="table-responsive" style="max-width:1170px;">
						<table class="table table-condensed">
						<thead>
						<tr class="filters">
						<th><input type="text" class="form-control" placeholder="Date/Time" disabled></th>
						<th><input type="text" class="form-control" placeholder="Doctor" disabled></th>
						<th><input type="text" class="form-control" placeholder="Type" disabled></th>
						<th><input type="text" class="form-control" placeholder="Details" disabled></th>
						<th style="width:20%;">Action</th>
						</tr>
						</thead>
						<tbody>
						<tr>
						<td><i class="fa fa-calendar" aria-hidden="true"></i> 22-08-2017 <br/><i class="fa fa-clock-o" aria-hidden="true"></i> 11:00AM</td>
						<td>Mark Jhon</td>
						<td><span class="label label-success"><i class="fa fa-home" aria-hidden="true"></i></span> Home</td>
						<td>BP Checkup</td>
						<td><a class="" data-toggle="collapse" data-target="#detailspatient" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea')" data-toggle="tooltip" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a> &nbsp;  <a class="" data-toggle="tooltip" title="Upload Doc"><i class="fa fa-upload"  aria-hidden="true"></i> </a> &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal"  title="E-mail"><i class="fa fa-envelope"  aria-hidden="true"></i> </a>&nbsp; <a style="color:green;" data-toggle="tooltip" title="Reschedule" ><i class="fa fa-calendar" aria-hidden="true"></i></a> &nbsp; <a style="color:red;" data-toggle="tooltip" title="Cancel"><i class="fa fa-times" aria-hidden="true"></i></a></td>

						</tr>
						<tr id="detailspatient" class="collapse">
						<td colspan="5" style="background: #DCDCDC;">
						<div id="printableArea" style="border: 1px solid #ececec; margin: 10px; padding: 10px;">
						<p> <a class="btn btn-xs btn-success pull-right">Add Notes</a><br/></p>
						<div style="background: #fff; padding: 10px 5px; margin-bottom: 20px;">
						<h6><b>Dr. Mark John </b></h6>
						<p>
						<i class="fa fa-phone" aria-hidden="true"></i>  +01234567890 &nbsp;&nbsp;&nbsp;
						<i class="fa fa-envelope" aria-hidden="true"></i> williamson@gmail.com<br/>123, Street name, City name, State - 12345 </p>
						</div>

						<p><i class="fa fa-calendar" aria-hidden="true"></i> Appointment Date: 22/08/2017 &nbsp;&nbsp;&nbsp; <i class="fa fa-clock-o" aria-hidden="true"></i> 11:00 AM &nbsp;&nbsp;&nbsp; Booking Id: 00132</p>
						<p><b>Type:</b> <span class="label label-success"><i class="fa fa-h-square" aria-hidden="true"></i></span> Clinic &nbsp; &nbsp; &nbsp; <b>Consultation Cost:</b> € 30</p>
						<p><b>Details:</b><br/> Body Checkup</p>

						</div>

						</td>
						</tr>
						<tr>
						<td><i class="fa fa-calendar" aria-hidden="true"></i> 26-08-2017 <br/><i class="fa fa-clock-o" aria-hidden="true"></i>  11:00AM</td>
						<td>Jacob</td>
						<td><span class="label label-success"><i class="fa fa-home" aria-hidden="true"></i></span> Home</td>
						<td>Body Checkup</td>
						<td><a class="" data-toggle="collapse" data-target="#detailspatient" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea')" data-toggle="tooltip" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a> &nbsp;  <a class="" data-toggle="tooltip" title="Upload Doc"><i class="fa fa-upload"  aria-hidden="true"></i> </a> &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal" title="E-mail"><i class="fa fa-envelope"  aria-hidden="true"></i> </a>&nbsp; <a style="color:green;" data-toggle="tooltip" title="Reschedule"><i class="fa fa-calendar" aria-hidden="true"></i></a> &nbsp; <a style="color:red;" data-toggle="tooltip" title="Cancel"><i class="fa fa-times" aria-hidden="true"></i></a></td>
						</tr>
						<tr>
						<td><i class="fa fa-calendar" aria-hidden="true"></i> 25-08-2017 <br/><i class="fa fa-clock-o" aria-hidden="true"></i> 11:00AM</td>
						<td>Larry</td>
						<td><span class="label label-success"><i class="fa fa-h-square" aria-hidden="true"></i></span> Clinic</td>
						<td>Complete Test</td>
						<td><a class="" data-toggle="collapse" data-target="#detailspatient" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea')" data-toggle="tooltip" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a> &nbsp;  <a class="" data-toggle="tooltip" title="Upload Doc"><i class="fa fa-upload"  aria-hidden="true"></i> </a> &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal" title="E-mail"><i class="fa fa-envelope"  aria-hidden="true"></i> </a>&nbsp; <a style="color:green;" data-toggle="tooltip" title="Reschedule"><i class="fa fa-calendar" aria-hidden="true"></i></a> &nbsp; <a style="color:red;" data-toggle="tooltip" title="Cancel"><i class="fa fa-times" aria-hidden="true"></i></a></td>
						</tr>
						</tbody>
						</table>
						</div>
						</div>
						</div>

						</div>
						</div>
						</div>

						<div class="panel panel-warning">
						<div class="panel-heading">
						<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
						<img src="<?php echo base_url(); ?>assets/img/calender2-icon.png">  &nbsp; Past Bookings
						</a>
						</h4>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse">
						<div class="panel-body">
						<div class="row">
						<div class="filterable">
						<div class="panel-heading">

						<div class="pull-right">
						<button class="btn btn-success btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> </button>
						</div>
						</div>
						<div class="table-responsive" style="max-width: 1170px;">
						<table class="table table-condensed">
						<thead>
						<tr class="filters">
						<th><input type="text" class="form-control" placeholder="Date/Time" disabled></th>
						<th><input type="text" class="form-control" placeholder="Doctor" disabled></th>
						<th><input type="text" class="form-control" placeholder="Type" disabled></th>
						<th><input type="text" class="form-control" placeholder="Details" disabled></th>
						<th style="width:20%;"></th>
						</tr>
						</thead>
						<tbody>
						<tr>
						<td><i class="fa fa-calendar" aria-hidden="true"></i> 22-08-2017 <br/><i class="fa fa-clock-o" aria-hidden="true"></i> 11:00AM</td>
						<td>Mark Jhon</td>
						<td><span class="label label-success"><i class="fa fa-home" aria-hidden="true"></i></span> Home</td>
						<td>BP Checkup</td>
						<td><a class="" data-toggle="collapse" data-target="#detailspatient" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea')" data-toggle="tooltip" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a> &nbsp;  <a class="" data-toggle="tooltip" title="Upload Doc"><i class="fa fa-upload"  aria-hidden="true"></i> </a> &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal" title="E-mail"><i class="fa fa-envelope"  aria-hidden="true"></i> </a>&nbsp; <a style="color:green;" data-toggle="tooltip" title="Reschedule"><i class="fa fa-calendar" aria-hidden="true"></i></a> &nbsp; <a style="color:red;" data-toggle="tooltip" title="Cancel"><i class="fa fa-times" aria-hidden="true"></i></a></td>
						</tr>
						<tr>
						<td><i class="fa fa-calendar" aria-hidden="true"></i> 26-08-2017 <br/><i class="fa fa-clock-o" aria-hidden="true"></i>  11:00AM</td>
						<td>Jacob</td>
						<td><span class="label label-success"><i class="fa fa-h-square" aria-hidden="true"></i></span> Clinic</td>
						<td>Body Checkup</td>
						<td><a class="" data-toggle="collapse" data-target="#detailspatient" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea')" data-toggle="tooltip" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a> &nbsp;  <a class="" data-toggle="tooltip" title="Upload Doc"><i class="fa fa-upload"  aria-hidden="true"></i> </a> &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal" title="E-mail"><i class="fa fa-envelope"  aria-hidden="true"></i> </a>&nbsp; <a style="color:green;" data-toggle="tooltip" title="Reschedule"><i class="fa fa-calendar" aria-hidden="true"></i></a> &nbsp; <a style="color:red;" data-toggle="tooltip" title="Cancel"><i class="fa fa-times" aria-hidden="true"></i></a></td>
						</tr>
						<tr>
						<td><i class="fa fa-calendar" aria-hidden="true"></i> 25-08-2017 <br/><i class="fa fa-clock-o" aria-hidden="true"></i> 11:00AM</td>
						<td>Larry</td>
						<td><span class="label label-success"><i class="fa fa-h-square" aria-hidden="true"></i></span> Clinic</td>
						<td>Complete Test</td>
						<td><a class="" data-toggle="collapse" data-target="#detailspatient" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea')" data-toggle="tooltip" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a> &nbsp;  <a class="" data-toggle="tooltip" title="Upload Doc"><i class="fa fa-upload"  aria-hidden="true"></i> </a> &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal" title="E-mail"><i class="fa fa-envelope"  aria-hidden="true"></i> </a>&nbsp; <a style="color:green;" data-toggle="tooltip" title="Reschedule"><i class="fa fa-calendar" aria-hidden="true"></i></a> &nbsp; <a style="color:red;" data-toggle="tooltip" title="Cancel"><i class="fa fa-times" aria-hidden="true"></i></a></td>
						</tr>
						</tbody>
						</table>
						</div>
						</div>
						</div>
						</div>
						</div>
						</div>
						<div class="panel panel-danger">
						<div class="panel-heading">
						<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" style="color:red;">
						<img src="<?php echo base_url(); ?>assets/img/calender2-icon.png"> &nbsp;  Cancelled Bookings 
						</a>
						</h4>
						</div>
						<div id="collapseThree" class="panel-collapse collapse">
						<div class="panel-body">
						<div class="row">
						<div class="filterable">
						<div class="panel-heading">

						<div class="pull-right">
						<button class="btn btn-success btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> </button>
						</div>
						</div>
						<div class="table-responsive" style="max-width: 1170px;">
						<table class="table table-condensed">
						<thead>
						<tr class="filters">
						<th><input type="text" class="form-control" placeholder="Date/Time" disabled></th>
						<th><input type="text" class="form-control" placeholder="Doctor" disabled></th>
						<th><input type="text" class="form-control" placeholder="Type" disabled></th>
						<th><input type="text" class="form-control" placeholder="Details" disabled></th>
						<th><input type="text" class="form-control" placeholder="Status" disabled></th>
						</tr>
						</thead>
						<tbody>
						<tr>
						<td><i class="fa fa-calendar" aria-hidden="true"></i> 22-06-2017 <br/><i class="fa fa-clock-o" aria-hidden="true"></i> 11:00AM</td>
						<td>Mark Jhon</td>
						<td><span class="label label-success"><i class="fa fa-home" aria-hidden="true"></i></span> Home</td>
						<td>BP Checkup</td>
						<td><span class="label label-danger">Cancelled</span></td>
						</tr>
						<tr>
						<td><i class="fa fa-calendar" aria-hidden="true"></i> 26-06-2017 <br/><i class="fa fa-clock-o" aria-hidden="true"></i>  11:00AM</td>
						<td>Jacob</td>
						<td><span class="label label-success"><i class="fa fa-h-square" aria-hidden="true"></i></span> Clinic</td>
						<td>Body Checkup</td>
						<td><span class="label label-danger">Cancelled</span></td>
						</tr>
						<tr>
						<td><i class="fa fa-calendar" aria-hidden="true"></i> 25-06-2017 <br/><i class="fa fa-clock-o" aria-hidden="true"></i> 11:00AM</td>
						<td>Larry</td>
						<td><span class="label label-success"><i class="fa fa-h-square" aria-hidden="true"></i></span> Clinic</td>
						<td>Complete Test</td>
						<td><span class="label label-danger">Cancelled</span></td>
						</tr>
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
														
						<div class="col-md-12 col-sm-12 col-xs-12 well admin-content" id="gpdetail">
						<div class="panel panel-default">
							<div class="panel-heading">GP&nbsp;&nbsp;<span id ="gp_response" style="color:green;font-size:14px;"></span> <?php if(!empty($gp_details)){ echo '<span class="pull-right" onclick="more_details('."'".'gp_row'."'".')"><label>Add More</label></span>';} ?></div>
								<div class="panel-body personal-info">
									<div class="">
										<div class="input_fields_wrap2">
											<form action="#" method="post" enctype="multipart/form-data" id="gp_form">
												<div class="row" id="gp_row_0" style="<?php if(!empty($gp_details)){ echo "display:none;";} ?>">
													<div class="col-md-5 col-sm-12 col-xs-12">
														<div class="panel panel-default">
															<div class="panel-heading">
																GP Details / Contact Info
															</div>
															<div class="input_fields_wrap">
																<input type="hidden" value='0' id="gp_count" />
																<div class="panel-body" style="height:313px;">
																	<div class="col-md-12 col-sm-12 col-xs-12 profile-details">
																		<div class="row">
																			<div class="col-md-6 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Practice Name</label>
																					<span class="asterisk" style="color:red">*</span>
																					<input type="text" class="form-control" name='data[gp_practice_name][0]' placeholder="Practice Name">
																				</div>
																			</div>
																			<div class="col-md-6 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Doctor</label>
																					<span class="asterisk" style="color:red">*</span>
																					<input type="text" class="form-control" placeholder="Doctor" name='data[gp_doctor_name][0]'>
																				</div>
																			</div>
																			<div class="col-md-6 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Tel 1</label>
																					<span class="asterisk" style="color:red">*</span>
																					<input type="text" class="form-control" value="<?php echo $country['mobile'][$details['country_id']]  ?>" placeholder="+123 456 7890" name='data[gp_tel1][0]' onkeypress="return restrict_keys(event)">
																				</div>
																			</div>
																			<div class="col-md-6 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Tel 2</label>
																					<input type="text" class="form-control" placeholder="+123 456 7890" name='data[gp_tel2][0]' onkeypress="return restrict_keys(event)">
																				</div>
																			</div>
																			<div class="col-md-12 col-sm-12 col-xs-12">
																				<div class="form-group">
																					<label>Email</label>
																					<span class="asterisk" style="color:red">*</span>
																					<input type="email" class="form-control" placeholder="Email" name='data[gp_email][0]'>
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
																			<label>Country</label>
																			<span class="asterisk" style="color:red">*</span>
																				<?php
																					$attr	=array('class'=>'form-control','id'=>'country_id');
																					echo form_dropdown('data[gp_country][0]', $country['name'],'',$attr);
																				?>
																		</div>
																	</div>
																	<div class="col-md-6 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>Postcode</label>
																			<span class="asterisk" style="color:red">*</span>
																			<input type="text" class="form-control" placeholder="Postcode" name='data[gp_postcode][0]'>
																		</div>
																	</div>
																	<div class="col-md-6 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>City / Town</label>
																			<span class="asterisk" style="color:red">*</span>
																			<input type="text" class="form-control" placeholder="City / Town" name='data[gp_town][0]'>
																		</div>
																	</div>
																	<div class="col-md-6 col-sm-12 col-xs-12">
																		<div class="form-group">
																			<label>State</label>
																			<span class="asterisk" style="color:red">*</span>
																			<input type="text" class="form-control" placeholder="State" name='data[gp_state][0]'>
																		</div>
																	</div>
																	<div class="col-md-12 col-sm-12 col-xs-12 form-text-wrapper">
																		<div class="form-group">
																			<label>Address</label>
																			<span class="asterisk" style="color:red">*</span>
																			<textarea class="form-control" rows="3" placeholder="Address" name='data[gp_address][0]'></textarea>
																		</div>
																	</div>
																 </div>
															</div>
														</div>
													</div>
													<div class="col-sm-1 col-md-1">
														<div class="form-group">
															<label>Action</label>
															<div class="col-md-12 col-sm-12 col-xs-12" >
																<button type="button" class="add_field_button2 btn btn-success btn-sm">
																	<span class="glyphicon glyphicon-plus"></span>
																</button>
															</div>
															<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:8px;">
																<button type="button" onclick="clearGP(0)" class="btn btn-success btn-sm">
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
										<div class="actionBar"  id="gp_row_save" style="<?php if(!empty($family_details)){ echo "display:none;";} ?>">
											<a href="javascript:void(0);" class="buttonNext btn btn-success" onclick="save_gp_details();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					  
														
														
														
														
						<div class="col-md-12 col-sm-12 col-xs-12 well admin-content" id="chemistdetail">
							<div class="">
								<div class="panel panel-default">
									<div class="panel-heading">Chemist &nbsp;&nbsp;
										<span id ="chemist_response" style="color:green;font-size:14px;"></span>
										<span class="pull-right" onclick="more_details('chemist_row')" id="chemist_row_more" style="<?php if(empty($chemist_details)){ echo "display:none;";} ?>">
											<label>Add More</label>
										</span>
									</div>
									<div class="panel-body personal-info">
										<div class="input_fields_wrap3">
											<form action="#" method="post" enctype="multipart/form-data" id="chemist_form">
												<div class="row" id="chemist_row_0" style="<?php if(!empty($chemist_details)){ echo "display:none;";} ?>">
													<div class="col-md-5 col-sm-12 col-xs-12">
														<div class="panel panel-default">
															<div class="panel-heading">
																Chemist Details / Contact Info
															</div>
															<div class="input_fields_wrap">
																<div class="panel-body" style="height:313px;">
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
																					<input type="text" class="form-control" placeholder="+123 456 7890" value="<?php echo $country['mobile'][$details['country_id']]  ?>" name='data[chemist_tel1][0]' onkeypress="return restrict_keys(event)">
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
																			<label>Country</label>
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
															<label>Action</label>
															<div class="col-md-12 col-sm-12 col-xs-12">
																<button type="button" class="add_field_button3 btn btn-success btn-sm">
																	<span class="glyphicon glyphicon-plus"></span>
																</button>
															</div>
															<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:8px;">
																<button type="button" onclick="clearCD(0)" class="btn btn-success btn-sm">
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
										
										
										<div class="actionBar">
											<a href="javascript:void(0);" class="buttonNext btn btn-success" id="chemist_row_save"  onclick='save_chemist_details();' style="<?php if(!empty($chemist_details)){ echo "display:none;";} ?>"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</a>
										</div>
									</div>
								</div>
							</div>
						</div>
														
														
														
						<div class="col-md-12 col-sm-12 col-xs-12 well admin-content" id="carerdetails">
							<div class="panel panel-default">
								<div class="panel-heading">Career &nbsp;&nbsp;
									<span id ="career_response" style="color:green;font-size:14px;"></span>
									<span class="pull-right" onclick="more_details('career_row')" id="career_row_more" style="<?php if(empty($career_details)){ echo "display:none;";} ?>">.
										<label>Add More</label>
									</span>
								</div>
								<div class="panel-body personal-info">
									<div class="input_fields_wrap4">
										<form action="#" method="post" enctype="multipart/form-data" id="career_form">
											<div class="row" id="career_row_0" style="<?php if(!empty($career_details)){ echo "display:none;";} ?>">
												<div class="col-md-5 col-sm-12 col-xs-12">
													<input type="hidden" value="0" id="career_count" />
													<div class="panel panel-default">
														<div class="panel-heading">
															Career Details / Contact Info
														</div>
														<div>
															<div class="panel-body" style="height:313px;">
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
																		<label>Country</label>
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
														<label>Action</label>
														<div class="col-md-12 col-sm-12 col-xs-12">
															<button type="button" class="add_field_button4 btn btn-success btn-sm">
																<span class="glyphicon glyphicon-plus"></span>
															</button>
														</div>
														<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:8px;">
															<button type="button" onclick="clearCR(0)" class="btn btn-success btn-sm">
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
											<a href="javascript:void(0);" class="buttonNext btn btn-success" id="career_row_save" onclick="save_career_details();" style="<?php if(!empty($career_details)){ echo "display:none;";} ?>"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</a>
										</div>
									</div>
								</div>
							</div>
						</div>
														
														
						<div class="col-md-12 col-sm-12 col-xs-12 well admin-content" id="Prescriptions">
						<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 profile-details">
						<div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper">
						<div class="form-group">
						<input id="fromdate" type="text" class="form-control" placeholder="From Date">
						</div>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper">
						<div class="form-group">
						<input id="todate" type="text" class="form-control" placeholder="To Date">
						</div>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-6 form-text-wrapper">
						<div class="form-group">
						<button id="search" class="btn btn-success btn-sm">Search</button>
						</div>
						</div>
						</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 no-paading-container">
						<div class="x_panel x_panel-1">
						<div class="col-md-12 col-sm-12 col-xs-12 prescriptions_bg marginbot-20 text-right">
						<a class="print-btn pres-btn" href="#" data-filter="all" data-toggle="tooltip" data-title="View All" data-original-title="" title=""> All</a>
						<a class="print-btn pres-btn" href="#" data-filter="current-details" data-toggle="tooltip" data-title="View Current" data-original-title="" title=""> C</a>
						<a class="print-btn pres-btn" href="#" data-filter="repeat-details" data-toggle="tooltip" data-title="View Repeat" data-original-title="" title=""> R</a>
						</div>
						<div class="pres_top col-md-12 col-sm-12 col-xs-12 profile-details">
						<div class="panel panel-default reminder-head filter current-details" style="display: block;">
						<div class="panel-body" style="padding: 0px 15px;" data-toggle="collapse" href="#referral-collapse" aria-expanded="true">
						<div class="col-md-1 col-sm-1 col-xs-6 no-paading-container form-text-wrapper">
						<b><a href="#" data-toggle="tooltip" data-title="Current" data-original-title="" title=""> <img src="<?php echo base_url(); ?>assets/img/current-icon.png"></a></b>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-6 no-paading-container form-text-wrapper">
						<b> <img src="<?php echo base_url(); ?>assets/img/calender2-icon.png"> 22.03.2017 </b>
						</div>
						<div class="col-md-8 col-sm-8 col-xs-6 form-text-wrapper">
						<b>Dr. John Doe Watson</b>
						</div>
						<div class="col-md-1 col-sm-1 col-xs-6 form-text-wrapper action-icon reminder-action-icon">
						<a style="color: #229e78;" class=""><i class="fa fa-chevron-circle-down" data-toggle="tooltip" data-title="More Details" data-original-title="" title=""></i></a>
						</div>
						</div>
						<div id="referral-collapse" class="panel-body reminder-body collapse table-responsive" style="padding: 0px 15px;max-width:1170px;width:100%;" aria-expanded="true">
						<p>
						<table class="table">
						<tr>
						<td><i class="fa fa-calendar" aria-hidden="true"></i> 22-03-2017 </td>
						<td>Prescription 1</td>
						<td><span class="label label-success"><i class="fa fa-home" aria-hidden="true"></i></span> Home</td>
						<td>BP Checkup</td>
						<td><a class="" data-toggle="collapse" data-target="#detailspatient" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea')" data-toggle="tooltip" title="" data-original-title="Print"><i class="fa fa-print" aria-hidden="true"></i></a>  &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal" title="E-mail"><i class="fa fa-envelope" aria-hidden="true"></i> </a></td>
						</tr>
						</table>
						</p>
						</div>
						</div>

						<div class="panel panel-default reminder-head filter repeat-details" style="display: block;">
						<div class="panel-body" style="padding: 0px 15px;" data-toggle="collapse" href="#referral-collapse1" aria-expanded="true">
						<div class="col-md-1 col-sm-1 col-xs-6 no-paading-container form-text-wrapper">
						<b><a href="#" data-toggle="tooltip" data-title="repeat" data-original-title="" title=""> <img src="<?php echo base_url(); ?>assets/img/repeat-icon.png"></a></b>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-6 no-paading-container form-text-wrapper">
						<b> <img src="<?php echo base_url(); ?>assets/img/calender2-icon.png"> 22.03.2017 </b>
						</div>
						<div class="col-md-8 col-sm-8 col-xs-6 form-text-wrapper">
						<b>Dr. John Doe Watson</b>
						</div>
						<div class="col-md-1 col-sm-1 col-xs-6 form-text-wrapper action-icon reminder-action-icon">
						<a style="color: #229e78;" class=""><i class="fa fa-chevron-circle-down" data-toggle="tooltip" data-title="More Details" data-original-title="" title=""></i></a>
						</div>
						</div>
						<div id="referral-collapse1" class="panel-body reminder-body collapse table-responsive" style="padding: 0px 15px;max-width:1170px;width:100%;" aria-expanded="true">
						<p>
						reasons
						</p>
						</div>
						</div>
						<div class="panel panel-default reminder-head filter current-details" style="display: block;">
						<div class="panel-body" style="padding: 0px 15px;">
						<div class="col-md-1 col-sm-1 col-xs-6 no-paading-container form-text-wrapper">
						<b><a href="#" data-toggle="tooltip" data-title="Current" data-original-title="" title=""> <img src="<?php echo base_url(); ?>assets/img/current-icon.png"></a></b>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-6 no-paading-container form-text-wrapper">
						<b> <img src="<?php echo base_url(); ?>assets/img/calender2-icon.png"> 22.03.2017 </b>
						</div>
						<div class="col-md-8 col-sm-8 col-xs-6 form-text-wrapper">
						<b>Dr. John Doe Watson</b>
						</div>
						<div class="col-md-1 col-sm-1 col-xs-6 form-text-wrapper action-icon reminder-action-icon">
						<a data-toggle="collapse" href="#referral-collapse2" style="color: #229e78;" class="" aria-expanded="true"><i class="fa fa-chevron-circle-down" data-toggle="tooltip" data-title="More Details" data-original-title="" title=""></i></a>
						</div>
						</div>
						<div id="referral-collapse2" class="panel-body reminder-body collapse table-responsive" style="padding: 0px 15px;max-width:1170px;width:100%;" aria-expanded="true">
						<p>
						<table class="table">
						<tr>
						<td><i class="fa fa-calendar" aria-hidden="true"></i> 22-03-2017 </td>
						<td>Prescription 1</td>
						<td><span class="label label-success"><i class="fa fa-home" aria-hidden="true"></i></span> Home</td>
						<td>BP Checkup</td>
						<td><a class="" data-toggle="collapse" data-target="#detailspatient" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea')" data-toggle="tooltip" title="" data-original-title="Print"><i class="fa fa-print" aria-hidden="true"></i></a>  &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal" title="E-mail"><i class="fa fa-envelope" aria-hidden="true"></i> </a></td>
						</tr>
						</table>
						</p>
						</div>
						</div>
						</div>
						</div>
						</div>

						</div>
				<div class="col-md-12 col-sm-12 col-xs-12 well admin-content" id="smoking">
                	<div class="non-padding">

                		<div class="col-xs-12 col-sm-12 col-md-12 no-paading-container">
                			<div class="x_panel x_panel-1">
                				<div class="panel-heading alert-panel">
                					<b><img src="<?php echo base_url(); ?>assets/img/smoking-icon.png" /> Smoking <a href="#" data-toggle="modal" data-target="#smokingModal"><i class="fa fa-plus-circle pull-right" data-toggle="tooltip" data-title="New Reminders"></i></a></b>
                				</div>
                				<div class="panel panel-default reminder-head" data-toggle="collapse" href="#collapse-exercise3" aria-expanded="true">
                					<div class="panel-body profile-details" style="padding: 0px 15px;">
                						<div class="col-md-2 col-xs-6 no-paading-container col-sm-3 form-text-wrapper">
                							<b><img src="<?php echo base_url(); ?>assets/img/calendar-icon.png" /> 22.05.2017</b>
                						</div>
                						<div class="col-md-2 col-xs-6 col-sm-3 form-text-wrapper">
                							<b><img src="<?php echo base_url(); ?>assets/img/small-cigarette-icon.png" /> Cigarette</b>
                						</div>
                						<div class="col-md-6 col-xs-11 col-sm-5">
                							<b><img src="<?php echo base_url(); ?>assets/img/countdown-icon.png" /> 10 - Cigarettes</b>
                						</div>
                						<div class="col-md-2 col-xs-1 col-sm-1 action-icon reminder-action-icon">
                							<a style="color: #229e78;" class=""><i class="fa fa-chevron-circle-down" data-toggle="tooltip" data-title="More Details" data-original-title="" title=""></i></a>
                						</div>
                					</div>
                					<div id="collapse-exercise3" class="panel-body reminder-body collapse" style="padding: 0px 0px;">
                						<div class="container-fluid cus-fluid">

                							<div class="charts-view">
                								<div class="col-md-12 col-sm-12 col-xs-12">
                									<div class="x_title cutom_data">
                										<b class="chart_heading"><img src="<?php echo base_url(); ?>assets/img/cigarette-icon.png" />  Cigarette</b>
                										<div class="btn-group btn-group-sm pull-right" role="group" aria-label="Small button group">
                											<button id="smoke-date-btn" type="button" class="btn btn-secondary">Date</button>
                											<button id="smoke-day-btn" type="button" class="btn btn-secondary">Day</button>
                											<button id="smoke-week-btn" type="button" class="btn btn-secondary">Week</button>
                											<button id="smoke-month-btn" type="button" class="btn btn-secondary">Month</button>
                											<button id="smoke-year-btn" type="button" class="btn btn-secondary">Year</button>
                										</div>
                										<div class="clearfix"></div>

                									</div>
                									<div class="container-fluid">
                										<div id="dateViewcharts">
                											<div id="smokeDateview" style="width:100%; height:300px; margin: 0 auto"></div>
                											<div class="cigarette-table">
                												<table class="table table-bordered table-striped exercise-table">
                													<thead>
                														<tr>
                															<th><i class="fa fa-calendar" aria-hidden="true"></i> Date</th>
                															<th><i class="fa fa-star-o" aria-hidden="true"></i> Type</th>
                															<th><i class="fa fa-list-ol" aria-hidden="true"></i> Numbers</th>
                															<th>Action</th>
                														</tr>
                													</thead>
                													<tbody>
                														<tr>
                															<td scope="row" data-label='Date'>22.05.2017</td>
                															<td data-label='Type'>Cigarette</td>
                															<td data-label='Numbers'>10</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>

                															</td>
                														</tr>
                														<tr>
                															<td scope="row" data-label='Date'>21.05.2017</td>
                															<td data-label='Type'>Cigar</td>
                															<td data-label='Numbers'>15</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>
                															</td>
                														</tr>
                													</tbody>
                												</table>
                											</div>
                										</div>
                										<div id="dayViewcharts" style="display:none;">
                											<div id="smokeDayview" style="width:100%; height:300px; margin: 0 auto"></div>
                											<div class="cigarette-table">
                												<table class="table table-bordered table-striped exercise-table">
                													<thead>
                														<tr>
                															<th><i class="fa fa-calendar" aria-hidden="true"></i> Date</th>
                															<th><i class="fa fa-star-o" aria-hidden="true"></i> Type</th>
                															<th><i class="fa fa-list-ol" aria-hidden="true"></i> Numbers</th>
                															<th>Action</th>
                														</tr>
                													</thead>
                													<tbody>
                														<tr>
                															<td scope="row" data-label='Date'>22.05.2017</td>
                															<td data-label='Type'>Cigarette</td>
                															<td data-label='Numbers'>10</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>

                															</td>
                														</tr>
                														<tr>
                															<td scope="row" data-label='Date'>21.05.2017</td>
                															<td data-label='Type'>Cigar</td>
                															<td data-label='Numbers'>15</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>
                															</td>
                														</tr>
                													</tbody>
                												</table>
                											</div>
                										</div>
                										<div id="weekViewcharts" style="display:none;">
                											<div id="smokeWeekview" style="width:100%; height:300px; margin: 0 auto"></div>
                											<div class="cigarette-table">
                												<table class="table table-bordered table-striped exercise-table">
                													<thead>
                														<tr>
                															<th><i class="fa fa-calendar" aria-hidden="true"></i> Date</th>
                															<th><i class="fa fa-star-o" aria-hidden="true"></i> Type</th>
                															<th><i class="fa fa-list-ol" aria-hidden="true"></i> Numbers</th>
                															<th>Action</th>
                														</tr>
                													</thead>
                													<tbody>
                														<tr>
                															<td scope="row" data-label='Date'>22.05.2017</td>
                															<td data-label='Type'>Cigarette</td>
                															<td data-label='Numbers'>10</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>

                															</td>
                														</tr>
                														<tr>
                															<td scope="row" data-label='Date'>21.05.2017</td>
                															<td data-label='Type'>Cigar</td>
                															<td data-label='Numbers'>15</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>
                															</td>
                														</tr>
                													</tbody>
                												</table>
                											</div>
                										</div>

                										<div id="monthViewcharts" style="display:none;">
                											<div id="smokeMonthview" style="width:100%; height:300px; margin: 0 auto"></div>
                											<div class="cigarette-table">
                												<table class="table table-bordered table-striped exercise-table">
                													<thead>
                														<tr>
                															<th><i class="fa fa-calendar" aria-hidden="true"></i> Date</th>
                															<th><i class="fa fa-star-o" aria-hidden="true"></i> Type</th>
                															<th><i class="fa fa-list-ol" aria-hidden="true"></i> Numbers</th>
                															<th>Action</th>
                														</tr>
                													</thead>
                													<tbody>
                														<tr>
                															<td scope="row" data-label='Date'>22.05.2017</td>
                															<td data-label='Type'>Cigarette</td>
                															<td data-label='Numbers'>10</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>

                															</td>
                														</tr>
                														<tr>
                															<td scope="row" data-label='Date'>21.05.2017</td>
                															<td data-label='Type'>Cigar</td>
                															<td data-label='Numbers'>15</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>
                															</td>
                														</tr>
                													</tbody>
                												</table>
                											</div>
                										</div>

                										<div id="yearViewcharts" style="display:none;">
                											<div id="smokeYearview" style="width:100%; height:300px; margin: 0 auto"></div>
                											<div class="cigarette-table">
                												<table class="table table-bordered table-striped exercise-table">
                													<thead>
                														<tr>
                															<th><i class="fa fa-calendar" aria-hidden="true"></i> Date</th>
                															<th><i class="fa fa-star-o" aria-hidden="true"></i> Type</th>
                															<th><i class="fa fa-list-ol" aria-hidden="true"></i> Numbers</th>
                															<th>Action</th>
                														</tr>
                													</thead>
                													<tbody>
                														<tr>
                															<td scope="row" data-label='Date'>22.05.2017</td>
                															<td data-label='Type'>Cigarette</td>
                															<td data-label='Numbers'>10</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>

                															</td>
                														</tr>
                														<tr>
                															<td scope="row" data-label='Date'>21.05.2017</td>
                															<td data-label='Type'>Cigar</td>
                															<td data-label='Numbers'>15</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>
                															</td>
                														</tr>
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

                				<div class="panel panel-default reminder-head" data-toggle="collapse" href="#collapse-exercise4" aria-expanded="true">
                					<div class="panel-body profile-details" style="padding: 0px 15px;">
                						<div class="col-md-2 col-xs-6 no-paading-container col-sm-3 form-text-wrapper">
                							<b><img src="<?php echo base_url(); ?>assets/img/calendar-icon.png" /> 20.05.2017</b>
                						</div>
                						<div class="col-md-2 col-xs-6 col-sm-3 form-text-wrapper">
                							<b><img src="<?php echo base_url(); ?>assets/img/cigar-small-icon.png" /> Cigar</b>
                						</div>
                						<div class="col-md-6 col-xs-11 col-sm-5">
                							<b><img src="<?php echo base_url(); ?>assets/img/countdown-icon.png" /> 20 - Cigar</b>
                						</div>
                						<div class="col-md-2 col-xs-1 col-sm-1 action-icon reminder-action-icon">
                							<a  style="color: #229e78;" class=""><i class="fa fa-chevron-circle-down" data-toggle="tooltip" data-title="More Details"></i></a>
                						</div>
                					</div>
                					<div id="collapse-exercise4" class="panel-body reminder-body collapse" style="padding: 0px 0px;">
                						<div class="container-fluid cus-fluid">

                							<div class="charts-view">
                								<div class="col-md-12 col-sm-12 col-xs-12">
                									<div class="x_title cutom_data">
                										<h2 class="chart_heading"><img src="<?php echo base_url(); ?>assets/img/cigar-green-icon.png" />  Cigar</h2>
                										<div class="btn-group btn-group-sm pull-right" role="group" aria-label="Small button group">
                											<button id="date-btn" type="button" class="btn btn-secondary">Date</button>
                											<button id="day-btn" type="button" class="btn btn-secondary">Day</button>
                											<button id="week-btn" type="button" class="btn btn-secondary">Week</button>
                											<button id="month-btn" type="button" class="btn btn-secondary">Month</button>
                											<button id="year-btn" type="button" class="btn btn-secondary">Year</button>
                										</div>
                										<div class="clearfix"></div>

                									</div>
                									<div class="container-fluid">
                										<div id="dateViewcharts">
                											<div id="smokeDateview" style="width:100%; height:300px; margin: 0 auto"></div>
                											<div class="cigarette-table">
                												<table class="table table-bordered table-striped exercise-table">
                													<thead>
                														<tr>
                															<th><i class="fa fa-calendar" aria-hidden="true"></i> Date</th>
                															<th><i class="fa fa-star-o" aria-hidden="true"></i> Type</th>
                															<th><i class="fa fa-list-ol" aria-hidden="true"></i> Numbers</th>
                															<th>Action</th>
                														</tr>
                													</thead>
                													<tbody>
                														<tr>
                															<td scope="row" data-label='Date'>22.05.2017</td>
                															<td data-label='Type'>Cigarette</td>
                															<td data-label='Numbers'>10</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>

                															</td>
                														</tr>
                														<tr>
                															<td scope="row" data-label='Date'>21.05.2017</td>
                															<td data-label='Type'>Cigar</td>
                															<td data-label='Numbers'>15</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>
                															</td>
                														</tr>
                													</tbody>
                												</table>
                											</div>
                										</div>
                										<div id="dayViewcharts" style="display:none;">
                											<div id="smokeDayview" style="width:100%; height:300px; margin: 0 auto"></div>
                											<div class="cigarette-table">
                												<table class="table table-bordered table-striped exercise-table">
                													<thead>
                														<tr>
                															<th><i class="fa fa-calendar" aria-hidden="true"></i> Date</th>
                															<th><i class="fa fa-star-o" aria-hidden="true"></i> Type</th>
                															<th><i class="fa fa-list-ol" aria-hidden="true"></i> Numbers</th>
                															<th>Action</th>
                														</tr>
                													</thead>
                													<tbody>
                														<tr>
                															<td scope="row" data-label='Date'>22.05.2017</td>
                															<td data-label='Type'>Cigarette</td>
                															<td data-label='Numbers'>10</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>

                															</td>
                														</tr>
                														<tr>
                															<td scope="row" data-label='Date'>21.05.2017</td>
                															<td data-label='Type'>Cigar</td>
                															<td data-label='Numbers'>15</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>
                															</td>
                														</tr>
                													</tbody>
                												</table>
                											</div>
                										</div>
                										<div id="weekViewcharts" style="display:none;">
                											<div id="smokeWeekview" style="width:100%; height:300px; margin: 0 auto"></div>
                											<div class="cigarette-table">
                												<table class="table table-bordered table-striped exercise-table">
                													<thead>
                														<tr>
                															<th><i class="fa fa-calendar" aria-hidden="true"></i> Date</th>
                															<th><i class="fa fa-star-o" aria-hidden="true"></i> Type</th>
                															<th><i class="fa fa-list-ol" aria-hidden="true"></i> Numbers</th>
                															<th>Action</th>
                														</tr>
                													</thead>
                													<tbody>
                														<tr>
                															<td scope="row" data-label='Date'>22.05.2017</td>
                															<td data-label='Type'>Cigarette</td>
                															<td data-label='Numbers'>10</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>

                															</td>
                														</tr>
                														<tr>
                															<td scope="row" data-label='Date'>21.05.2017</td>
                															<td data-label='Type'>Cigar</td>
                															<td data-label='Numbers'>15</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>
                															</td>
                														</tr>
                													</tbody>
                												</table>
                											</div>
                										</div>

                										<div id="monthViewcharts" style="display:none;">
                											<div id="smokeMonthview" style="width:100%; height:300px; margin: 0 auto"></div>
                											<div class="cigarette-table">
                												<table class="table table-bordered table-striped exercise-table">
                													<thead>
                														<tr>
                															<th><i class="fa fa-calendar" aria-hidden="true"></i> Date</th>
                															<th><i class="fa fa-star-o" aria-hidden="true"></i> Type</th>
                															<th><i class="fa fa-list-ol" aria-hidden="true"></i> Numbers</th>
                															<th>Action</th>
                														</tr>
                													</thead>
                													<tbody>
                														<tr>
                															<td scope="row" data-label='Date'>22.05.2017</td>
                															<td data-label='Type'>Cigarette</td>
                															<td data-label='Numbers'>10</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>

                															</td>
                														</tr>
                														<tr>
                															<td scope="row" data-label='Date'>21.05.2017</td>
                															<td data-label='Type'>Cigar</td>
                															<td data-label='Numbers'>15</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>
                															</td>
                														</tr>
                													</tbody>
                												</table>
                											</div>
                										</div>

                										<div id="yearViewcharts" style="display:none;">
                											<div id="smokeYearview" style="width:100%; height:300px; margin: 0 auto"></div>
                											<div class="cigarette-table">
                												<table class="table table-bordered table-striped exercise-table">
                													<thead>
                														<tr>
                															<th><i class="fa fa-calendar" aria-hidden="true"></i> Date</th>
                															<th><i class="fa fa-star-o" aria-hidden="true"></i> Type</th>
                															<th><i class="fa fa-list-ol" aria-hidden="true"></i> Numbers</th>
                															<th>Action</th>
                														</tr>
                													</thead>
                													<tbody>
                														<tr>
                															<td scope="row" data-label='Date'>22.05.2017</td>
                															<td data-label='Type'>Cigarette</td>
                															<td data-label='Numbers'>10</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>

                															</td>
                														</tr>
                														<tr>
                															<td scope="row" data-label='Date'>21.05.2017</td>
                															<td data-label='Type'>Cigar</td>
                															<td data-label='Numbers'>15</td>
                															<td>
                																&nbsp;<a href="#" data-toggle="tooltip" data-title="Edit"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-edit-icon.png" /></a>&nbsp;&nbsp;&nbsp;
                																<a href="#" data-toggle="tooltip" data-title="Delete"><img class="table-edite" src="<?php echo base_url(); ?>assets/img/table-delete-icon.png" /></a>
                															</td>
                														</tr>
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

                	<!-- Start of Alert model-->
                	<div class="modal fade" id="smokingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                		<div class="modal-dialog" role="document">
                			<div class="modal-content">
                				<div class="modal-header">
                					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                					<h5 class="modal-title" id="exampleModalLabel">New Smoking</h5>
                				</div>
                				<div class="modal-body">
                					<div class="row profile-details">
                						<div class="col-sm-4 col-md-3 col-xs-4 form-text-wrapper">
                							<div class="form-group">
                								<label class="control-label">Date</label>                								
                								<input type="text" class="form-control" placeholder="date">                								
                							</div>
                						</div>
                						<div class="col-sm-4 col-md-3 col-xs-4 form-text-wrapper">
                							<div class="form-group">
                								<label class="control-label">Type</label>                								
            									<select class="form-control">
            										<option>Cigarette</option>
            										<option>Cigar</option>
            									</select>                								
                							</div>
                						</div>
                						<div class="col-sm-4 col-md-6 col-xs-4 form-text-wrapper">
                							<div class="form-group">
                								<label class="control-label text-left">Number of Smoke </label>                								
                								<input type="text" class="form-control" placeholder="Number of Smoke">                								
                							</div>
                						</div>
                					</div>
                				</div>
                				<div class="modal-footer">
                					<button type="button" class="btn btn-success btn-xs">Save</button>
                				</div>
                			</div>
                		</div>
                	</div>
                	<!-- End of Alert model-->


                </div>
				<div class="col-md-12 col-sm-12 col-xs-12 well admin-content" id="dietContent">
                	<div class=" non-padding">        
                		<div class="col-xs-12 col-sm-12 col-md-12 no-paading-container">
                			<div class="x_panel x_panel-1">
                				<div class="panel-heading alert-panel">
                					<b><img src="<?php echo base_url(); ?>assets/img/diet-icon.png" /> Diet <a href="#" data-toggle="modal" data-target="#dietModal"><i class="fa fa-plus-circle pull-right" data-toggle="tooltip" data-title="New Reminders"></i></a></b>
                				</div>
                				<div class="panel panel-default reminder-head" data-toggle="collapse" href="#collapse-diet" aria-expanded="true">
                					<div class="panel-body profile-details" style="padding: 0px 15px;">
                						<div class="col-md-2 col-xs-6 col-sm-2 form-text-wrapper no-paading-container">
                							<b><i class="fa fa-calendar" aria-hidden="true"></i> 21.05.2017</b>
                						</div>
                						<div class="col-md-2 col-xs-6 form-text-wrapper col-sm-2">
                							<b> Chicken </b>
                						</div>
                						<div class="col-md-6 col-xs-6 form-text-wrapper col-sm-6">
                							<b><i class="fa fa-road" aria-hidden="true"></i> 239 calories</b>
                						</div>
                						<div class="col-md-2 col-xs-6 col-sm-2 form-text-wrapper action-icon reminder-action-icon">
                							<a style="color: #229e78;" class=""><i class="fa fa-chevron-circle-down" data-toggle="tooltip" data-title="More Details" data-original-title="" title=""></i></a>
                						</div>
                					</div>
                					<div id="collapse-diet" class="panel-body reminder-body collapse" style="padding: 0px 0px;">
                						<div class="container-fluid cus-fluid">

                							<div class="charts-view">
                								<div class="col-md-12">
                									<div class="x_title cutom_data">
                										<b class="chart_heading"><img src="<?php echo base_url(); ?>assets/img/chicken-icon.png" /> Chicken</b>
                										<div class="clearfix"></div>

                									</div>
                									<main>
                										<input id="tab5" type="radio" name="tabs" checked>
                										<label for="tab5">Chicken</label>

                										<section id="content5">

                											<div class="btn-group pull-right" role="group" aria-label="Basic example">
                												<button type="button" class="btn btn-secondary">Date</button>
                												<button type="button" class="btn btn-secondary">Day</button>
                												<button type="button" class="btn btn-secondary">Month</button>
                												<button type="button" class="btn btn-secondary">Year</button>
                											</div>
                											<div id="containerDiet" style="width:100%; height:350; margin: 0 auto"></div>
                											<table class="table table-bordered exercise-table">
                												<thead>
                													<tr>
                														<th><i class="fa fa-calendar" aria-hidden="true"></i> Date</th>
                														<th><i class="fa fa-road" aria-hidden="true"></i> Cannabis</th>
                														<th>Table</th>
                													</tr>
                												</thead>
                												<tbody>
                													<tr>
                														<td data-label="Date">10.09.2017</td>
                														<td data-label="Cannabis">100 calories</td>
                														<td data-label="Table"> - </td>
                													</tr>
                													<tr>
                														<td data-label="Date">09.09.2017</td>
                														<td data-label="Cannabis">300 calories</td>
                														<td data-label="Table"> - </td>
                													</tr>
                												</tbody>
                											</table>
                										</section>
                									</main>
                								</div>
                							</div>
                						</div>
                					</div>
                				</div>
                				<div class="panel panel-default reminder-head" data-toggle="collapse" href="#collapse-diet1" aria-expanded="true">
                					<div class="panel-body profile-details" style="padding: 0px 15px;">
                						<div class="col-md-2 col-xs-6 col-sm-2 form-text-wrapper no-paading-container">
                							<b><i class="fa fa-calendar" aria-hidden="true"></i> 21.05.2017</b>
                						</div>
                						<div class="col-md-2 col-xs-6 form-text-wrapper col-sm-2">
                							<b> Salads </b>
                						</div>
                						<div class="col-md-6 col-xs-6 form-text-wrapper col-sm-6">
                							<b><i class="fa fa-road" aria-hidden="true"></i> 152 calories</b>
                						</div>
                						<div class="col-md-2 col-xs-6 col-sm-2 form-text-wrapper action-icon reminder-action-icon">
                							<a style="color: #229e78;" class=""><i class="fa fa-chevron-circle-down" data-toggle="tooltip" data-title="More Details" data-original-title="" title=""></i></a>
                						</div>
                					</div>
                					<div id="collapse-diet1" class="panel-body reminder-body collapse" style="padding: 0px 15px;">
                						<b>BP Chcekup</b>
                					</div>
                				</div>
                			</div>
                		</div>
                	</div>	
                	<!-- Start of Alert model-->
                	<div class="modal fade" id="dietModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                		<div class="modal-dialog" role="document">
                			<div class="modal-content">
                				<div class="modal-header">
                					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                					<h5 class="modal-title" id="exampleModalLabel">New Diet</h5>
                				</div>
                				<div class="modal-body">
                					<div class="row profile-details">
                						<div class="col-sm-4 col-md-4 col-xs-4 form-text-wrapper">
                								<label class="control-label col-md-3 col-sm-2 col-xs-2">Date</label>
                							<div class="form-group">
                								
                									<input type="text" class="form-control" placeholder="date">
                								
                							</div>
                						</div>
                						<div class="col-sm-4 col-md-4 col-xs-4 form-text-wrapper">
                								<label class="control-label">Type</label>
                							<div class="form-group">
                								<input type="text" class="form-control" placeholder="Enter the type of food">
                							</div>
                						</div>
                						<div class="col-sm-4 col-md-4 col-xs-4 form-text-wrapper">
                								<label class="control-label">calories</label>
                							<div class="form-group">
                								
                									<input type="text" class="form-control" placeholder="calories">
                								
                							</div>
                						</div>
                					</div>
                				</div>
                				<div class="modal-footer">
                					<button type="button" class="btn btn-success btn-sm">Save</button>
                				</div>
                			</div>
                		</div>
                	</div>
                	<!-- End of Alert model-->


                </div>
				<div class="col-md-12 col-sm-12 col-xs-12 well admin-content" id="InstallationJobs">
					<!--CREDIT CART PAYMENT-->
					<div class="row">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#wallet">Wallet</a></li>

							<li><a data-toggle="tab" href="#cards">Manage Cards</a></li>
						</ul>

						<div class="tab-content">
							<div id="wallet" class="tab-pane fade in active">
								<br/>
								<div class="col-md-12 col-sm-12 col-xs-12 profile-details"><h5><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Orbis Balance : € 200.00 &nbsp;&nbsp;&nbsp; <a href="#addcredit" class="btn btn-success btn-xs"  data-toggle="collapse"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Credit</a></h5>
									<div id="addcredit" class="collapse">
										<div class="row" style="background: #fff;padding: 20px 0px 5px;">
											<div class="col-md-2 col-sm-2 col-xs-6 form-text-wrapper">
												<div class="form-group">

													<input id="amount" type="text" class="form-control" placeholder="Enter Amount">
												</div>
											</div>
											<div class="col-md-5 col-sm-5 col-xs-6 form-text-wrapper">
												<div class="form-group">

													<button class="btn btn-success">Add Credit</button> 
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>

							<div id="cards" class="tab-pane fade">
								<div class="col-md-12 col-sm-12 col-xs-12 table-responsive" style="max-width: 1170px;width: 100%;">
									<br/>
									<table class="table table-striped custab">
										<thead>

											<tr>
												<th> Set Default</th>
												<th>Card Type</th>
												<th>Card Number</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tr>
											<td> <input type="radio" name="card" value=""> </td>
											<td>Visa</td>
											<td>XXXX-XXXXX-XXXX-XX11</td>
											<td class="text-center"><a class='btn btn-info btn-xs' href="#"><span class="glyphicon glyphicon-edit"></span> </a> <a href="#" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a></td>
										</tr>
										<tr>
											<td> <input type="radio" name="card" value=""> </td>
											<td>Visa</td>
											<td>XXXX-XXXXX-XXXX-XX11</td>
											<td class="text-center"><a class='btn btn-info btn-xs' href="#"><span class="glyphicon glyphicon-edit"></span> </a> <a href="#" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a></td>
										</tr>
										<tr>
											<td> <input type="radio" name="card" value=""> </td>
											<td>Master</td>
											<td>XXXX-XXXXX-XXXX-XX11</td>
											<td class="text-center"><a class='btn btn-info btn-xs' href="#"><span class="glyphicon glyphicon-edit"></span> </a> <a href="#" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> </a></td>
										</tr>
									</table>


									<a  data-toggle="collapse" data-target="#demo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Card</a>
									<div id="demo" class="collapse" style="max-width: 650px;">
										<br/>
										<div class="form-group row">
											<label class="col-sm-3 col-md-3 col-xs-6 control-label form-text-wrapper text-left" for="card-holder-name">Name on Card</label>
											<div class="col-sm-9 col-md-9 col-xs-6 form-text-wrapper">
												<input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Card Holder's Name">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 col-md-3 col-xs-6 control-label form-text-wrapper text-left" for="card-number">Card Number</label>
											<div class="col-sm-9 col-md-9 col-xs-6 form-text-wrapper">
												<input type="text" class="form-control" name="card-number" id="card-number" placeholder="Debit/Credit Card Number">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 col-md-3 col-xs-6 control-label form-text-wrapper text-left" for="expiry-month">Expiration Date</label>
											<div class="col-sm-9 col-md-9 col-xs-6 form-text-wrapper">
												<div class="row">
													<div class="col-xs-12 col-md-6 col-sm-6">
														<select class="form-control col-sm-2" name="expiry-month" id="expiry-month">
															<option>Month</option>
															<option value="01">Jan (01)</option>
															<option value="02">Feb (02)</option>
															<option value="03">Mar (03)</option>
															<option value="04">Apr (04)</option>
															<option value="05">May (05)</option>
															<option value="06">June (06)</option>
															<option value="07">July (07)</option>
															<option value="08">Aug (08)</option>
															<option value="09">Sep (09)</option>
															<option value="10">Oct (10)</option>
															<option value="11">Nov (11)</option>
															<option value="12">Dec (12)</option>
														</select>
													</div>
													<div class="col-xs-12 col-md-6 col-sm-6">
														<select class="form-control" name="expiry-year">
															<option value="13">2013</option>
															<option value="14">2014</option>
															<option value="15">2015</option>
															<option value="16">2016</option>
															<option value="17">2017</option>
															<option value="18">2018</option>
															<option value="19">2019</option>
															<option value="20">2020</option>
															<option value="21">2021</option>
															<option value="22">2022</option>
															<option value="23">2023</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 col-md-3 col-xs-6 control-label form-text-wrapper text-left" for="cvv">Card CVV</label>
											<div class="col-sm-9 col-md-9 col-xs-6 form-text-wrapper">
												<input type="text" class="form-control" name="cvv" id="cvv" placeholder="Security Code">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-offset-3 col-sm-9">
												<button type="button" class="btn btn-success">Save Changes</button>
											</div>
										</div>

									</div>
									<!--CREDIT CART PAYMENT END-->
								</div>
							</div>

						</div>

					</div>														

															</div>
															<div class="col-md-12 col-sm-12 col-xs-12 well admin-content" id="healt">
																Health
															</div>
															<div class="col-md-12 col-sm-12 col-xs-12 well admin-content" id="Settings">
											                	Settings
											                </div>
											                <div class="col-md-12 col-sm-12 col-xs-12 well admin-content" id="exercisecont">
															<!-- Start of Alert model-->
															<div class="modal fade" id="exerciseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
																<div class="modal-dialog" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																			<h6 class="modal-title" id="exampleModalLabel">New Exercise</h6>
																		</div>
																		<div class="modal-body">
																			<div class="row profile-details">
																				<div class="col-sm-6 col-md-3 col-xs-6 form-text-wrapper">
																						<label class="control-label non-padding">Date</label>
																					<div class="form-group">
																						
																							<input type="text" class="form-control" placeholder="date">
																						
																					</div>
																				</div>
																				<div class="col-sm-6 col-md-3 col-xs-6 form-text-wrapper">
																						<label class="control-label non-padding">Activity</label>
																					<div class="form-group">
																						
																							<select class="form-control">
																								<option>Running</option>
																								<option>Cycling</option>
																								<option>Swimming</option>
																								<option>Steps</option>
																								<option>Yoga</option>
																								<option>Tennis</option>
																								<option>Badmetan</option>
																							</select>
																						
																					</div>
																				</div>
																				<div class="col-sm-6 col-md-3 col-xs-6 form-text-wrapper">
																						<label class="control-label non-padding">Min / Day</label>
																					<div class="form-group">
																						
																							<input type="text" class="form-control" placeholder="Minutes">
																						
																					</div>
																				</div>
																				<div class="col-sm-6 col-md-3 col-xs-6 form-text-wrapper">
																						<label class="control-label non-padding">Distance</label>
																					<div class="input-group">
																						
																							<input type="text" class="form-control" placeholder="">
																						<span class="input-group-btn">
																							<div class="btn-group">
																								<button class="btn dropdown-toggle" data-toggle="dropdown" type="button">Distance</button>
																								<ul class="dropdown-menu">
																									<li>KM</li>
																									<li>Miles</li>
																									<li>Meters</li>
																								</ul>
																							</div>
																						</span>
																						
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-xs btn-success">Save</button>
																		</div>
																	</div>
																</div>
															</div>
															<!-- End of Alert model-->
															<div class="non-padding">

																<div class="col-xs-12 col-sm-12 col-md-12 no-paading-container">
																	<div class="x_panel x_panel-1">
																		<div class="panel-heading alert-panel">
																			<b> <img src="<?php echo base_url(); ?>assets/img/sports.png"> Exercise / Sports <a href="#" data-toggle="modal" data-target="#exerciseModal"><i class="fa fa-plus-circle pull-right" data-toggle="tooltip" data-title="New Reminders" data-original-title="" title=""></i></a></b>
																		</div>
																		<div class="panel panel-default reminder-head" data-toggle="collapse" href="#collapse-exercise" aria-expanded="true">
																			<div class="panel-body profile-details" style="padding: 0px 15px;">
																				<div class="col-md-2 col-sm-3 form-text-wrapper col-xs-6 no-paading-container">
																					<b><i class="fa fa-calendar" aria-hidden="true"></i> 22.05.2017</b>
																				</div>
																				<div class="col-md-2 col-sm-3 form-text-wrapper col-xs-6">
																					<b> Running</b>
																				</div>
																				<div class="col-md-3 col-sm-3 form-text-wrapper col-xs-6">
																					<b><i class="fa fa-clock-o" aria-hidden="true"></i> 00:55 Min / Day</b>
																				</div>
																				<div class="col-md-3 col-sm-2 form-text-wrapper col-xs-4">
																					<b><i class="fa fa-road" aria-hidden="true"></i> 3 KM</b>
																				</div>
																				<div class="col-md-2 col-sm-1 form-text-wrapper col-xs-2 action-icon reminder-action-icon">
																					<a style="color: #229e78;" class=""><i class="fa fa-chevron-circle-down" data-toggle="tooltip" data-title="More Details" data-original-title="" title=""></i></a>
																				</div>
																			</div>
																			<div id="collapse-exercise" class="panel-body reminder-body collapse" style="padding: 0px 0px;">
																				<div class="container-fluid cus-fluid">
                                            <!--<div class="container-fluid charts-header">
                                                <h3 class="ex-custom-head col-md-2 no-paading-container"><img src="images/running-icon.png"> Running</h3>
                                                <div class="col-md-3 change-btn">
                                                    <a class="side-btn" href="#"> Minutes</a>
                                                    <a class="side-btn side-btn-active" href="#"> Distance</a>
                                                </div>
                                            </div>-->
                                            <div class="charts-view">
                                            	<div class="col-md-12">
                                            		<div class="">
                                            			<b class="text-center"> <img src="<?php echo base_url(); ?>assets/img/sports.png"> Running </b>
                                            			<div class="clearfix"></div>

                                            		</div>
                                            		<main>
                                            			<input id="tab1" type="radio" name="tabs" checked>
                                            			<label for="tab1">Distance</label>

                                            			<input id="tab2" type="radio" name="tabs">
                                            			<label for="tab2">Minutes</label>

                                            			<section id="content1">

                                            				<div class="btn-group pull-right" role="group" aria-label="Basic example">
                                            					<button type="button" class="btn btn-secondary">Date</button>
                                            					<button type="button" class="btn btn-secondary">Day</button>
                                            					<button type="button" class="btn btn-secondary">Month</button>
                                            					<button type="button" class="btn btn-secondary">Year</button>
                                            				</div>
                                            				<div id="container" style="width:100%; height:350; margin: 0 auto"></div>
                                            				<table class="table table-bordered exercise-table">
                                            					<thead>
                                            						<tr>
                                            							<th><i class="fa fa-calendar" aria-hidden="true"></i> Date</th>
                                            							<th><i class="fa fa-road" aria-hidden="true"></i> Distance</th>
                                            							<th><i class="fa fa-clock-o" aria-hidden="true"></i> Minutes</th>
                                            							<th>Table</th>
                                            						</tr>
                                            					</thead>
                                            					<tbody>
                                            						<tr>
                                            							<td data-label='Date'>10.09.2017</td>
                                            							<td data-label='Distance'>2 Km</td>
                                            							<td data-label='Minutes'>30 mnts</td>
                                            							<td data-label='Table'> - </td>
                                            						</tr>
                                            						<tr>
                                            							<td data-label='Date'>09.09.2017</td>
                                            							<td data-label='Distance'>3 Km</td>
                                            							<td data-label='Minutes'>45 mnts</td>
                                            							<td data-label='Table'> - </td>
                                            						</tr>
                                            					</tbody>
                                            				</table>
                                            			</section>

                                            			<section id="content2">
                                            				<p>
                                            					Bacon ipsum dolor sit amet landjaeger sausage brisket, jerky drumstick fatback boudin ball tip turducken. Pork belly meatball t-bone bresaola tail filet mignon kevin turkey ribeye shank flank doner cow kielbasa shankle. Pig swine chicken hamburger, tenderloin turkey rump ball tip sirloin frankfurter meatloaf boudin brisket ham hock. Hamburger venison brisket tri-tip andouille pork belly ball tip short ribs biltong meatball chuck. Pork chop ribeye tail short ribs, beef hamburger meatball kielbasa rump corned beef porchetta landjaeger flank. Doner rump frankfurter meatball meatloaf, cow kevin pork pork loin venison fatback spare ribs salami beef ribs.
                                            				</p>
                                            				<p>
                                            					Jerky jowl pork chop tongue, kielbasa shank venison. Capicola shank pig ribeye leberkas filet mignon brisket beef kevin tenderloin porchetta. Capicola fatback venison shank kielbasa, drumstick ribeye landjaeger beef kevin tail meatball pastrami prosciutto pancetta. Tail kevin spare ribs ground round ham ham hock brisket shoulder. Corned beef tri-tip leberkas flank sausage ham hock filet mignon beef ribs pancetta turkey.
                                            				</p>
                                            			</section>
                                            		</main>
                                            	</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default reminder-head" data-toggle="collapse" href="#collapse-exercise2" aria-expanded="true">
                                	<div class="panel-body profile-details" style="padding: 0px 15px;">
                                		<div class="col-md-2 col-sm-3 form-text-wrapper col-xs-6 no-paading-container">
                                			<b><i class="fa fa-calendar" aria-hidden="true"></i> 21.05.2017</b>
                                		</div>
                                		<div class="col-md-2 col-sm-3 form-text-wrapper col-xs-6">
                                			<b> Cycling</b>
                                		</div>
                                		<div class="col-md-3 col-sm-3 form-text-wrapper col-xs-6">
                                			<b><i class="fa fa-clock-o" aria-hidden="true"></i> 00:40 Min / Day</b>
                                		</div>
                                		<div class="col-md-3 col-sm-2 form-text-wrapper col-xs-4">
                                			<b><i class="fa fa-road" aria-hidden="true"></i> 5 KM</b>
                                		</div>
                                		<div class="col-md-2 col-sm-1 form-text-wrapper col-xs-2 action-icon reminder-action-icon">
                                			<a style="color: #229e78;" class="" ><i class="fa fa-chevron-circle-down" data-toggle="tooltip" data-title="More Details" data-original-title="" title=""></i></a>
                                		</div>
                                	</div>
                                	<div id="collapse-exercise2" class="panel-body reminder-body collapse" style="padding: 0px 15px;">
                                		<h5>BP Chcekup</h5>
                                	</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end exercise -->
                </div>
				<div class="col-md-12 col-sm-12 col-xs-12 well admin-content" id="alerts">

					<div class="panel-group" id="accordion1">
						<div class="panel panel-success">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" style="color:green;" aria-expanded="true" class="collapsed">
										<i class="fa fa-exclamation-circle" aria-hidden="true"></i>  &nbsp; Active Alerts 
									</a>
								</h4>
							</div>
							<div id="collapseOne1" class="panel-collapse collapse in" aria-expanded="true" style="">
								<div class="panel-body">
									<div class="row">
										<div class="filterable">
											<div class="panel-heading">

												<div class="pull-right">
													<button class="btn btn-success btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> </button>
												</div>
											</div>
											<div class="table-responsive" style="max-width: 1170px;width: 100%;">
											<table class="table table-condensed">
												<thead>
													<tr class="filters">
														<th><input type="text" class="form-control" placeholder="Date/Time" disabled=""></th>
														<th><input type="text" class="form-control" placeholder="Doctor" disabled=""></th>

														<th><input type="text" class="form-control" placeholder="Details" disabled=""></th>
														<th style="width:20%;"></th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><i class="fa fa-calendar" aria-hidden="true"></i> 22-08-2017 <br><i class="fa fa-clock-o" aria-hidden="true"></i> 11:00AM</td>
														<td>Mark Jhon</td>
														<td> Blood test</td>
														<td><a class="" data-toggle="collapse" data-target="#detailsalert" title="View" aria-expanded="true"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea2')" data-toggle="tooltip" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a> &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal" title="E-mail"><i class="fa fa-envelope" aria-hidden="true"></i> </a>&nbsp; <a style="color:red;" data-toggle="tooltip" title="Inactive"><i class="fa fa-ban" aria-hidden="true"></i></a></td>

													</tr>
													<tr id="detailsalert" class="collapse" aria-expanded="true" style="">
														<td colspan="5" style="background: #DCDCDC;">
															<div id="printableArea2" style="border: 1px solid #ececec; margin: 10px; padding: 10px;">

																<div style="background: #fff; padding: 10px 5px; margin-bottom: 20px;">
																	<h6><b>Dr. Mark John </b></h6>
																	<p><b>Details:</b><br> Body Checkup</p>
																</div>

															</div>

														</td>
													</tr>

													<td><i class="fa fa-calendar" aria-hidden="true"></i> 26-08-2017 <br><i class="fa fa-clock-o" aria-hidden="true"></i>  11:00AM</td>
													<td>Jacob</td>

													<td>Body Checkup</td>
													<td><a class="" data-toggle="collapse" data-target="#detailsalert" title="View" aria-expanded="true"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea2')" data-toggle="tooltip" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a> &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal" title="E-mail"><i class="fa fa-envelope" aria-hidden="true"></i> </a>&nbsp; <a style="color:red;" data-toggle="tooltip" title="Inactive"><i class="fa fa-ban" aria-hidden="true"></i></a></td>
												</tr>
												<tr>
													<td><i class="fa fa-calendar" aria-hidden="true"></i> 25-08-2017 <br><i class="fa fa-clock-o" aria-hidden="true"></i> 11:00AM</td>
													<td>Larry</td>

													<td>Complete Test</td>
													<td><a class="" data-toggle="collapse" data-target="#detailsalert" title="View" aria-expanded="true"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea2')" data-toggle="tooltip" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a> &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal" title="E-mail"><i class="fa fa-envelope" aria-hidden="true"></i> </a>&nbsp; <a style="color:red;" data-toggle="tooltip" title="Inactive"><i class="fa fa-ban" aria-hidden="true"></i></a></td>
												</tr>
											</tbody>
										</table>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>

					<div class="panel panel-danger">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" class="" aria-expanded="false">
									<img src="<?php echo base_url(); ?>assets/img/calender2-icon.png">  &nbsp; Inactive Alerts
								</a>
							</h4>
						</div>
						<div id="collapseTwo1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
							<div class="panel-body">
								<div class="row">
									<div class="filterable">
										<div class="panel-heading">

											<div class="pull-right">
												<button class="btn btn-success btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> </button>
											</div>
										</div>
										<div class="table-responsive" style="max-width: 1170px;width: 100%;">
										<table class="table table-condensed">
											<thead>
												<tr class="filters">
													<th><input type="text" class="form-control" placeholder="Date/Time" disabled=""></th>
													<th><input type="text" class="form-control" placeholder="Doctor" disabled=""></th>

													<th><input type="text" class="form-control" placeholder="Details" disabled=""></th>
													<th><input type="text" class="form-control" placeholder="Date Closed" disabled=""></th>
													<th style="width:20%;"></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><i class="fa fa-calendar" aria-hidden="true"></i> 22-08-2017 <br><i class="fa fa-clock-o" aria-hidden="true"></i> 11:00AM</td>
													<td>Mark Jhon</td>

													<td>BP Checkup</td>
													<td>22-08-2017 <i class="fa fa-clock-o" aria-hidden="true"></i> 11:00AM <br/> by User</td>
													<td><a class="collapsed" data-toggle="collapse" data-target="#detailsalert" title="View" aria-expanded="false"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea2')" data-toggle="tooltip" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a> &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal" title="E-mail"><i class="fa fa-envelope" aria-hidden="true"></i> </a>&nbsp; <a style="color:green;" data-toggle="tooltip" title="Active"><i class="fa fa-ban" aria-hidden="true"></i></a></td>
												</tr>
												<tr>
													<td><i class="fa fa-calendar" aria-hidden="true"></i> 26-08-2017 <br><i class="fa fa-clock-o" aria-hidden="true"></i>  11:00AM</td>
													<td>Jacob</td>

													<td>Body Checkup</td>
													<td> 22-08-2017 <i class="fa fa-clock-o" aria-hidden="true"></i> 11:00AM <br/> by User</td>
													<td><a class="collapsed" data-toggle="collapse" data-target="#detailsalert" title="View" aria-expanded="false"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea2')" data-toggle="tooltip" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a> &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal" title="E-mail"><i class="fa fa-envelope" aria-hidden="true"></i> </a>&nbsp; <a style="color:green;" data-toggle="tooltip" title="Active"><i class="fa fa-ban" aria-hidden="true"></i></a></td>
												</tr>
												<tr>
													<td><i class="fa fa-calendar" aria-hidden="true"></i> 25-08-2017 <br><i class="fa fa-clock-o" aria-hidden="true"></i> 11:00AM</td>
													<td>Larry</td>

													<td>Complete Test</td>
													<td>22-08-2017 <i class="fa fa-clock-o" aria-hidden="true"></i> 11:00AM <br/> by User</td>
													<td><a class="collapsed" data-toggle="collapse" data-target="#detailsalert" title="View" aria-expanded="false"><i class="fa fa-eye" aria-hidden="true"></i></a> &nbsp; <a class="" onclick="printDiv('printableArea2')" data-toggle="tooltip" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a> &nbsp;  <a data-target="#mail-edit-modal" data-toggle="modal" title="E-mail"><i class="fa fa-envelope" aria-hidden="true"></i> </a>&nbsp; <a style="color:green;" data-toggle="tooltip" title="Active"><i class="fa fa-ban" aria-hidden="true"></i></a></td>
												</tr>
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
														<!--footer-->
					<footer class="">
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-6 col-md-4 col-xs-12">
									<div class="wow fadeInDown" data-wow-delay="0.1s">
										<div class="widget">
											<h5>About Medicio</h5>
											<p>
												Lorem ipsum dolor sit amet, ne nam purto nihil impetus, an facilisi accommodare sea
											</p>
										</div>
									</div>
									<div class="wow fadeInDown" data-wow-delay="0.1s">
										<div class="widget">
											<h5>Information</h5>
											<ul>
												<li><a href="#">Home</a></li>
												<li><a href="#">Laboratory</a></li>
												<li><a href="#">Medical treatment</a></li>
												<li><a href="#">Terms & conditions</a></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-md-4 col-xs-12">
									<div class="wow fadeInDown" data-wow-delay="0.1s">
										<div class="widget">
											<h5>Medical center</h5>
											<p>
												Nam leo lorem, tincidunt id risus ut, ornare tincidunt naqunc sit amet.
											</p>
											<ul>
												<li>
													<span class="fa-stack fa-lg">
														<i class="fa fa-circle fa-stack-2x"></i>
														<i class="fa fa-calendar-o fa-stack-1x fa-inverse"></i>
													</span> Monday - Saturday, 8am to 10pm
												</li>
												<li>
													<span class="fa-stack fa-lg">
														<i class="fa fa-circle fa-stack-2x"></i>
														<i class="fa fa-phone fa-stack-1x fa-inverse"></i>
													</span> +44 000 000 000
												</li>
												<li>
													<span class="fa-stack fa-lg">
														<i class="fa fa-circle fa-stack-2x"></i>
														<i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i>
													</span> info@coraltech.com
												</li>

											</ul>
										</div>
									</div>
								</div>
								<div class="col-sm-6 col-md-4 col-xs-12">
									<div class="wow fadeInDown" data-wow-delay="0.1s">
										<div class="widget">
											<h5>Our location</h5>
											<p>The Suithouse V303, Kuningan City, UK</p>		

										</div>
									</div>
									<div class="wow fadeInDown" data-wow-delay="0.1s">
										<div class="widget">
											<h5>Follow us</h5>
											<ul class="company-social">
												<li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
												<li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
												<li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
												<li class="social-vimeo"><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
												<li class="social-dribble"><a href="#"><i class="fa fa-dribbble"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>	
						</div>
						<div class="sub-footer">
							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
										<div class="wow fadeInLeft" data-wow-delay="0.1s">
											<div class="text-left">
												<p>&copy;Copyright - Medical Software. All rights reserved.</p>
											</div>
										</div>
									</div>
									<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
										<div class="wow fadeInRight" data-wow-delay="0.1s">
											<div class="text-right">
												<div class="credits">
													<!-- 
														All the links in the footer should remain intact. 
														You can delete the links only if you purchased the pro version.
														Licensing information: https://bootstrapmade.com/license/
														Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Medicio
													-->
													<a href="#">Coral Tech. All rights reserved</a>
												</div>
											</div>
										</div>
									</div>
								</div>	
							</div>
						</div>
					</footer>
				</div>
			</div>
		</div>
	</section>

<div class="modal fade" id="mail-edit-modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
				<h6 class="modal-title">Email Booking</h6>
			</div>
			<div class="modal-body">


				<input class="form-control" placeholder="Enter Email">
				<div class="action-icon">
					<br/>
					<a href="#" class="pull-right btn-success btn btn-xs">Send</a>
					<br/>
					<br/>
				</div>
			</div>
		</div>
	</div>
</div>

</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
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
<!-- Core JavaScript Files -->
<script src="<?php echo base_url(); ?>assets/js/jquery.easing.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.appear.js"></script>
<script src="<?php echo base_url(); ?>assets/js/stellar.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/nivo-lightbox.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>

<script src="<?php echo base_url(); ?>assets/js/fileinput.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/drop-down.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dashboard.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyB30YkpVyTfcPsQkwNiiBLE2a-C5EHYFSA&libraries=places"></script>
<script>
	/*$(function () {
		$('.multiservicelist').each(function() {
			if($(this).attr('id') == 'language_id'){
				$(this).multiselect({
					includeSelectAllOption: true,
					maxHeight: 200,
					buttonClass: ''
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
	/*	$('.multiselect-ui').multiselect({
			includeSelectAllOption: true,
		}); 
	});*/

	
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
			
			/*var next_title			= $("#next_title").val();
			var next_name			= $("#next_name").val();
			var next_address		= $("#next_address").val();
			var next_mobile			= $("#next_mobile").val();
			*/
			var ethinic_id 			= $("#ethinic_id").val();
			var language_id 		= $("#language_id").val();
			var marital_status 		= $("#marital_status").val();
			 
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
			}else if(Address.trim() == ""){
				$("#address").focus();
				$("#address").css('border','1px solid #ff1a1c');
			}else if(Mobile.trim() == ""){
				$("#Mobile").focus();
				$("#Mobile").css('border','1px solid #ff1a1c');
			}else if(Email.trim() == ""){
				$("#Email").focus();
				$("#Email").css('border','1px solid #ff1a1c');
			}else if(ethinic_id == ''){
				$("#ethinic_id").focus();
				$("#ethinic_id").css('border','1px solid #ff1a1c');
			}else if(language_id == '' || language_id == null){
				$(".multiselect").focus();
				$(".multiselect").css('border','1px solid #ff1a1c');
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
				form_data.append('title', title);
				form_data.append('gender', gender);
				form_data.append('first_name', first_name.trim());
				form_data.append('last_name', last_name.trim());
				form_data.append('middle_name', middle_name.trim());
				form_data.append('ethinic_origin', ethinic_id);
				form_data.append('languages', language_id);
				form_data.append('marital_status', marital_status);
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
				/*form_data.append('next_title', next_title);
				form_data.append('next_name', next_name.trim());
				form_data.append('next_address', next_address.trim());
				form_data.append('next_mobile', next_mobile.trim());
				 */
				var url	="<?php echo base_url(); ?>account_setup/patient_details";
				$.ajax({
					url: url,
					type: 'POST',
					data: form_data,
					dataType: "json",
					processData: false,
					contentType: false,
					success: function(data){
						if(data.response.trim() == 'success'){
							$("#response").html("Profile updated successfully...");
							$('input').css('border','1px solid #ccc');
							//$('html, body').animate({scrollTop: $("#response").offset().top}, 2000);
							document.body.scrollTop = 0; // For Safari
							document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
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
			var url											= "<?php echo base_url(); ?>account_setup/patient_family_details";
			$.ajax({
				url: url,
				type: 'POST',
				dataType: "json",
				data: $('#family_form').serialize(),
				success: function(data){
					if(data.response.trim() == 'success'){
						var len			= data.details.length;
						var content		= '';
						if(len >0){
							for(i=0;i<len;i++){
								content		+='<div class="panel-body"><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Name</label><p class="summary_view_text">'+(data.details[i].name == null ? '' : data.details[i].name)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Relationship</label><p class="summary_view_text">'+(data.details[i].relation == null ? '' : data.details[i].relation)+'</p></div></div><div class="col-md-1 col-sm-12 col-xs-12"><div class="form-group"><label>Age</label><p class="summary_view_text">'+(data.details[i].age == null ? '' : data.details[i].age)+' yrs</p></div></div><div class="col-md-3 col-sm-12 col-xs-12"><div class="form-group"><label>Address</label><p class="summary_view_text">'+(data.details[i].address == null ? '' : data.details[i].address)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Tel</label><p class="summary_view_text">'+(data.details[i].mobile == null ? '' : data.details[i].mobile)+'</p></div></div><div class="col-md-2 col-sm-12 col-xs-12"><div class="form-group"><label>Contact</label><p class="summary_view_text">'+(data.details[i].home == null ? '' : data.details[i].home)+'</p></div></div></div>';
							}
						}else{
								content			='<div class="panel-body"><div class="col-md-12 col-sm-12 col-xs-12"><div class="form-group"><label>No records Uploaded...</label></div></div></div>'
						}
						document.getElementById("family_form").reset();
						$('.family_class').remove();
						$("#family_div_id").html(content);
						$("#family_response").html('Details updated sucessfully...');
						$("#family_row_0").hide();
						$("#family_row_more").show();
						document.body.scrollTop = 0; // For Safari
						document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
						
					}else{
						//nxt_tab('pat_reg_personal-gp');
						alert('Please try after sometime..');
					}  
				}
			});
		}
		
		function save_gp_details(){
			var form 										= $('#gp_form');
			var formData 									= $(form).serialize();
			var url											= "<?php echo base_url(); ?>account_setup/patient_gp_details";
			$.ajax({
				url: url,
				type: 'POST',
				dataType: "json",
				data: $('#gp_form').serialize(),
				success: function(data){
					if(data.response.trim() == 'success'){
						//nxt_tab('pat_reg_personal-chemist');
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
						$("#gp_response").html('Details updated sucessfully...');
						$("#gp_row_0").hide();
						$("#gp_row_more").show();
						document.body.scrollTop = 0; // For Safari
						document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
						//$("#response").html("Last Saved :"+data.save_time);
					//	$("#pDcheck3").iCheck("check");
					}else{
						//nxt_tab('pat_reg_personal-chemist');
						alert('Please try after sometime..');
					}  
				}
			});
		}
		
		function save_chemist_details(){
			var form 										= $('#chemist_form');
			var formData 									= $(form).serialize();
			var url											= "<?php echo base_url(); ?>account_setup/patient_chemist_details";
			$.ajax({
				url: url,
				type: 'POST',
				dataType: "json",
				data: $('#chemist_form').serialize(),
				success: function(data){
					if(data.response.trim() == 'success'){
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
						$("#chemist_response").html('Details updated sucessfully...');
						$("#chemist_row_0").hide();
						$("#chemist_row_more").show();
						document.body.scrollTop = 0; // For Safari
						document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
						//$("#response").html("Last Saved :"+data.save_time)
						//$("#pDcheck4").iCheck("check");
					}else{
						//nxt_tab('pat_reg_personal-carer');
						alert('Please try after sometime..');
					} 
				}
			});
		}
		
		function save_career_details(){
			var form 										= $('#career_form');
			var formData 									= $(form).serialize();
			var url											= "<?php echo base_url(); ?>account_setup/patient_career_details";
			$.ajax({
				url: url,
				type: 'POST',
				dataType: "json",
				data: $('#career_form').serialize(),
				success: function(data){
					if(data.response.trim() == 'success'){
						//nxt_tab('pat_reg_personal-documents');
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
						$("#career_response").html('Details updated sucessfully...');
						$("#career_row_0").hide();
						$("#career_row_more").show();
						document.body.scrollTop = 0; // For Safari
						document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
						//$("#response").html("Last Saved :"+data.save_time)
						//$("#pDcheck5").iCheck("check");
					}else{
						//nxt_tab('pat_reg_personal-documents');
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
			var url										= "<?php echo base_url(); ?>account_setup/save_uploaded_files";
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
							if($("#upload_empty").length > 0 && $("#upload_empty").val() ==1){
								$("#exist_other_document").html(html_content);
							}else{
								$("#exist_other_document").append(html_content);
							}
							
							$("#upload_document").hide();
							$("#upload_doc_response").html("<span style='color:green;font-size:13px;'>File Uploaded Successfully..</span>&nbsp;&nbsp;&nbsp;");
							$("#exist_other_document").show();
							$("#upload_doc_exist").show();
							$("#upload_doc_0").hide();
							$("#upload_doc_more").show();
							//$("#pDcheck6").iCheck("check");
							//nxt_tab('pat_reg_personal-notes');
						}else{
							alert("Please try after sometime..");
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
	
		function readURL(input) {
            if (input.files && input.files[0]) {
                var reader 				= new FileReader();

                reader.onload 			= 	function (e) {
												$('#blah').attr('src', e.target.result);
											};
                $(".cho-btn").hide();
                $(".up-cho-btn").show();
                reader.readAsDataURL(input.files[0]);
            }
        }
	

		$(document).ready(function(){
			
			$('.button-left').click(function(){
				$('.sidebar').toggleClass('fliph');
				$('.dashboard-wrapper').toggleClass('pl250 pl100');
				$('footer .container').toggleClass('pl200 pl10');
			});
			$('.closeside').click(function(){
				$('.button-left').click();
			});
			var navItems = $('.list-sidebar li > a');
			var navListItems = $('.list-sidebar li');
			var allWells = $('.admin-content');
			var allWellsExceptFirst = $('.admin-content:not(:first)');

			allWellsExceptFirst.hide();
			navItems.click(function(e)
			{
				e.preventDefault();
				navListItems.removeClass('active');
				$(this).closest('li').addClass('active');

				allWells.hide();
				var target = $(this).attr('data-target-id');
				$('#' + target).show();
			});
			<?php if($details['registration_complete'] != 1){ ?>
					$("[data-target-id=Profile]").click();
			<?php } ?> 
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
                    $(wrapper).append('<div class="panel-body family_class" id="family_row_'+count+'"> <div class="col-md-6 col-sm-12 col-xs-12"> <div class="row"> <div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Name</label> <input type="text" class="form-control" name="data[family_name]['+count+']" placeholder="Name" id="family_name_'+count+'"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <label>Relationship to the Reg user</label> <div class="form-group"> <select class="form-control" name="data[family_relation]['+count+']" id="family_relation_'+count+'">'+relation+'</select> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel</label> <input type="text" name="data[family_tel]['+count+']" id="family_tel_'+count+'" class="form-control" placeholder="+123 4567 890" onkeypress="return restrict_keys(event)"> </div></div><div class="col-md-4 col-sm-12 col-xs-12"> <div class="form-group"> <label>Contact</label> <input type="text" class="form-control" name="data[family_contact]['+count+']" onkeypress="return restrict_keys(event)" id="family_contact_'+count+'" placeholder="+123 4567 890"> </div></div><div class="col-md-2 col-sm-12 col-xs-12"> <div class="form-group"> <label>Age</label> <input type="number" name="data[family_age]['+count+']" id="family_age_'+count+'" class="form-control" placeholder="Age"> </div></div></div></div><div class="col-md-4 col-sm-12 col-xs-12 form-text-wrapper"> <div class="form-group"> <label>Address</label> <textarea class="form-control" rows="3" placeholder="Address" name="data[family_address]['+count+']" id="family_address_'+count+'"></textarea> </div><div class="form-group"><input type="checkbox" style="display:inline-block;" class="form-check-input" id="cbxMinorImportAddress" onchange="fill_address(this,'+"'"+'family_address_'+count+"'"+')">Import home address</div></div><div class="col-sm-2 col-md-2"> <div class="form-group"><label>Remove</label> <br><button type="button" class="remove_field1 btn btn-success btn-sm" style="margin-right: 3px;" id="'+count+'"> <span class="glyphicon glyphicon-minus"></span></button><button type="button" onclick="clearPtD('+count+')" class="btn btn-success btn-sm"><i class="fa fa-eraser"></i></button> </div></div></div></div>'); //add input box
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
                    $("#gp_form").append('<div class="row gp_class"  id="gp_row_'+count+'"  ><div class="col-md-5 col-sm-12 col-xs-12"><div class="panel panel-default"><div class="panel-heading">GP Details / Contact Info</div><div class="input_fields_wrap"><div class="panel-body" style="height:313px;"><div class="col-md-12 col-sm-12 col-xs-12 profile-details"><div class="row"><div class="col-md-6 col-sm-12 col-xs-12"><div class="form-group"><label>Practice Name</label><span class="asterisk" style="color:red">*</span><input type="text" class="form-control" placeholder="Practice Name" name="data[gp_practice_name]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Doctor</label><span class="asterisk" style="color:red">*</span> <input type="text" class="form-control" placeholder="Doctor" name="data[gp_doctor_name]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 1</label><span class="asterisk" style="color:red">*</span> <input type="text" class="form-control" onkeypress="return restrict_keys(event)" placeholder="+123 456 7890" name="data[gp_tel1]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 2</label> <input type="text" class="form-control" placeholder="+123 456 7890" onkeypress="return restrict_keys(event)" name="data[gp_tel2]['+count+']"> </div></div><div class="col-md-12 col-sm-12 col-xs-12"> <div class="form-group"> <label>Email</label><span class="asterisk" style="color:red">*</span> <input type="text" class="form-control" placeholder="Email" name="data[gp_email]['+count+']"> </div></div></div></div></div></div></div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="panel panel-default"> <div class="panel-heading">Address Details</div><div class="panel-body"> <div class="row"> <div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper"> <div class="form-group"> <label>Country</label><span class="asterisk" style="color:red">*</span> <select class="form-control" name="data[gp_country]['+count+']">'+list+'</select> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Postcode</label><span class="asterisk" style="color:red">*</span> <input type="text" class="form-control" placeholder="Postcode" name="data[gp_postcode]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>City / Town</label><span class="asterisk" style="color:red">*</span> <input type="text" class="form-control" placeholder="City / Town" name="data[gp_town]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>State</label><span class="asterisk" style="color:red">*</span> <input type="text" class="form-control" placeholder="State" name="data[gp_state]['+count+']"></div></div><div class="col-md-12 col-sm-12 col-xs-12 form-text-wrapper"><div class="form-group"><label>Address</label><span class="asterisk" style="color:red">*</span><textarea class="form-control" rows="3" placeholder="Address" name="data[gp_address]['+count+']"></textarea></div></div></div></div></div></div><div class="col-md-1 col-sm-1 col-xs-12"> <div class="form-group"> <label>Remove</label> <div class="col-md-12 col-sm-12 col-xs-12"> <button type="button" class="remove_field2 btn btn-success btn-sm" id="'+count+'"> <span class="glyphicon glyphicon-minus"></span></button></div><div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 8px;"><button type="button" onclick="clearGP('+count+')" class="btn btn-success btn-sm"><i class="fa fa-eraser"></i></button></div></div></div></div></div>'); //add input box
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
                    $("#chemist_form").append('<div class="row chemist_class" id="chemist_row_'+count+'"> <div class="col-md-5 col-sm-12 col-xs-12"> <div class="panel panel-default"> <div class="panel-heading">Chemist Details / Contact Info</div><div class="input_fields_wrap"> <div class="panel-body" style="height:313px;"> <div class="col-md-12 col-sm-12 col-xs-12 profile-details"> <div class="row"> <div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Pharmacy Name</label> <input type="text" class="form-control" placeholder="Pharmacy Name" name="data[chemist_pharmacy_name]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Chemist Name</label> <input type="text" class="form-control" placeholder="Chemist Name" name="data[chemist_name]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 1</label> <input type="text" class="form-control" placeholder="+123 456 7890" onkeypress="return restrict_keys(event)" name="data[chemist_tel1]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 2</label> <input type="text" class="form-control" placeholder="+123 456 7890" name="data[chemist_tel2]['+count+']" onkeypress="return restrict_keys(event)"> </div></div><div class="col-md-12 col-sm-12 col-xs-12"> <div class="form-group"> <label>Email</label> <input type="text" class="form-control" placeholder="Email" name="data[chemist_email]['+count+']"> </div></div></div></div></div></div></div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="panel panel-default"> <div class="panel-heading">Address Details</div><div class="panel-body"> <div class="row"> <div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper"> <div class="form-group"> <label>Country</label> <select class="form-control" name="data[chemist_country]['+count+']">'+list+'</select> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Postcode</label> <input type="text" class="form-control" placeholder="Postcode" name="data[chemist_postcode]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>City / Town</label> <input type="text" class="form-control" placeholder="City / Town" name="data[chemist_town]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>State</label> <input type="text" class="form-control" placeholder="State" name="data[chemist_state]['+count+']"></div></div><div class="col-md-12 col-sm-12 col-xs-12 form-text-wrapper"> <div class="form-group"> <label>Address</label> <textarea class="form-control" rows="3" placeholder="Address" name="data[chemist_address]['+count+']"></textarea> </div></div></div></div></div></div><div class="col-sm-1 col-md-1"> <div class="form-group"> <label>Remove</label> <div class="col-md-12 col-sm-12 col-xs-12"> <button type="button" class="remove_field3 btn btn-success btn-sm" id="'+count+'"><span class="glyphicon glyphicon-minus"></span></button> </div><div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:8px;"> <button type="button" onclick="clearCD('+count+')" class="btn btn-success btn-sm"><i class="fa fa-eraser"></i></button> </div></div></div></div>'); //add input box
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
                    $("#career_form").append('<div class="row career_class" id="career_row_'+count+'" > <div class="col-md-5 col-sm-12 col-xs-12"> <div class="panel panel-default"> <div class="panel-heading">Career Details / Contact Info</div><div class="input_fields_wrap"> <div class="panel-body" style="height:313px;"> <div class="col-md-12 col-sm-12 col-xs-12 profile-details"> <div class="row"> <div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Company Name</label> <input type="text" class="form-control" placeholder="Company Name" name="data[career_company_name]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Name</label> <input type="text" class="form-control" placeholder="Name" name="data[career_name]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 1</label> <input type="text" class="form-control" placeholder="+123 456 7890" name="data[career_tel1]['+count+']" onkeypress="return restrict_keys(event)"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Tel 2</label> <input type="text" class="form-control" placeholder="+123 456 7890" onkeypress="return restrict_keys(event)" name="data[career_tel2]['+count+']"> </div></div><div class="col-md-12 col-sm-12 col-xs-12"> <div class="form-group"> <label>Email</label> <input type="text" class="form-control" placeholder="Email" name="data[career_email]['+count+']"> </div></div></div></div></div></div></div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="panel panel-default"> <div class="panel-heading">Address Details</div><div class="panel-body"> <div class="row"> <div class="col-md-6 col-sm-6 col-xs-6 form-text-wrapper"> <div class="form-group"> <label>Country</label> <select class="form-control" name="data[career_country]['+count+']">'+list+'</select> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>Postcode</label> <input type="text" class="form-control" placeholder="Postcode" name="data[career_postcode]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>City / Town</label> <input type="text" class="form-control" placeholder="City / Town" name="data[career_town]['+count+']"> </div></div><div class="col-md-6 col-sm-12 col-xs-12"> <div class="form-group"> <label>State</label> <input type="text" class="form-control" placeholder="State" name="data[career_state]['+count+']"> </div></div><div class="col-md-12 col-sm-12 col-xs-12 form-text-wrapper"> <div class="form-group"> <label>Address</label> <textarea class="form-control" rows="3" placeholder="Address" name="data[career_address]['+count+']"></textarea> </div></div></div></div></div></div><div class="col-sm-1 col-md-1"> <div class="form-group"> <label>Remove</label> <div class="col-md-12 col-sm-12 col-xs-12"> <button type="button" class="remove_field4 btn btn-success btn-sm" id="'+count+'"> <span class="glyphicon glyphicon-minus"></span></button> </div><div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:8px;"> <button type="button" onclick="clearCR('+count+')" class="btn btn-success btn-sm"><i class="fa fa-eraser"></i></button> </div></div></div></div>'); //add input box
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
		
		
		function clearPtD(a) {
            var r = confirm("Are you sure want to clear all data?");
            if (r == true) {
                $('#family_row_'+a).find('input[type=text]').val('');
                $('#family_row_'+a).find('textarea').val('');
				$('#family_row_'+a).find('input[type=email]').val('');
				$('#family_relation_'+a).val('');
            }
		}
		
		function clearGP(a) {
            var r = confirm("Are you sure want to clear all data?");
            if (r == true) {
                $('#gp_row_'+a).find('input[type=text]').val('');
                $('#gp_row_'+a).find('textarea').val('');
				$('#gp_row_'+a).find('select').val('');
			}

        }
		function more_details(a){
			if($("#"+a+"_0").length > 0){	
				$("#"+a+"_0").show();
			}
			if($("#"+a+"_save").length > 0){
				$("#"+a+"_save").show();
			}
			
		}
		 
		
	</script>

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
            line-height: 1.9em;
            margin-left: 2px;
        }
        .panel-heading {
            margin-top: 0;
            margin-bottom: 0;
            font-size: 16px;
            color: inherit;
            padding: 5px 15px;
        }
    </style>

            <!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->
                <form class="form-horizontal form-label-left row custom_temp">
                    <div class="x_panel">
						<!--<span class="pull-right "><a href="<?php echo base_url(); ?>account_setup" class="buttonNext btn btn-success"><i class="fa fa-edit"></i> Edit</a></span>-->
						 <div class="x_title">
                                <h2>Registration - Start: <?php echo date('d/m/Y',strtotime($user_details['user_start_date'])); ?> &nbsp;&nbsp;&nbsp; <span style="background: #229e78; color:#fff; padding: 1px 5px;" class="pull-right">
                                    <i class="fa fa-check-square"></i> Active
                                    </span>
								</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a href="<?php echo base_url()."team_setup/index/".$this->encryptionfunction->enCrypt($user_details['user_key']); ?>" class="edit-btn"><i class="fa fa-edit"></i> Edit</a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default view-profile-section">
                                            <div class="panel-heading">Personal Details <!--<span class="pull-right"><a href="#" class="pro-edit-btn"><i class="fa fa-edit"></i> Edit</a></span>--></div>
                                            <div class="panel-body">
												<div class="col-md-12 col-sm-12 col-xs-12">
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
														</div>
													</div>
													<div class="col-md-10 col-sm-12 col-xs-12">
														<div class="col-md-2 col-sm-12 col-xs-12">
															<label>Title</label>
															<div class="form-group">
																<p class="summary_view_text"><?php if($user_details['title']){echo $user_details['title'];} ?></p>
															</div>
														</div>
														<div class="col-md-3 col-sm-12 col-xs-12">
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
														<div class="col-md-2 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Gender</label>
																<p class="summary_view_text">
																<?php
																	if($user_details['gender']){
																		echo $user_details['gender'];
																	}
																?>
																</p>
															</div>
														</div>
														<div class="col-md-2 col-sm-12 col-xs-12">
														   <div class="form-group">
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
													    <div class="col-md-2 col-sm-12 col-xs-12">
														   <div class="form-group">
															   <label>Email</label>
															   <p class="summary_view_text">
																   <?php if($user_details['primary_email']){echo $user_details['primary_email'];} ?>
															   </p>
														   </div>
														</div>
														<div class="col-md-2 col-sm-12 col-xs-12">
															<div class="form-group">
																<label>Mobile</label>
																<p class="summary_view_text"><?php if($user_details['mobile']){echo $user_details['mobile'];} ?></p>
															</div>
														</div>
													</div>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default view-add-section">
                                            <div class="panel-heading">Address Details <!--<span class="pull-right"><a href="#" class="add-edit-btn"><i class="fa fa-edit"></i> Edit</a></span>--></div>
                                            <div class="panel-body">
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <p class="summary_view_text"><?php if($user_details['address']){echo $user_details['address'];} ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>City / Town</label>
                                                        <p class="summary_view_text"><?php if($user_details['city_town']){echo $user_details['city_town'];} ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>State</label>
                                                        <p class="summary_view_text"><?php if($user_details['state']){echo $user_details['state'];} ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <p class="summary_view_text"><?php if($user_details['country_id']){echo $country['name'][$user_details['country_id']];} ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Postcode</label>
                                                        <p class="summary_view_text"><?php if($user_details['postcode']){echo $user_details['postcode'];} ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="panel panel-default view-doc-section">
                                            <div class="panel-heading">
                                                Documents
                                                <!--<span class="pull-right"><a href="#" class="doc-edit-btn"><i class="fa fa-edit"></i> Edit</a></span>-->
                                            </div>
                                            <div class="panel-body">
                                                <div class="panel panel-default panel-default-two" style="margin-bottom:0px;">
                                                    <div class="panel-heading panel-heading-two">Attachments</div>
													 <?php
														if(!empty($uploads_others)){
															foreach ($uploads_others as $d_key => $d_val) {
																
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
                                                    <!--<div class="panel-body">
                                                        <div class="col-md-2 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Title</label>
                                                                <p class="summary_view_text">Sample Document</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Link</label>
                                                                <p class="summary_view_text">http://178.238.139.243/assets/16/Profile Image/Profile Image.jpg</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Type</label>
                                                                <p class="summary_view_text">jpg</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Add on</label>
                                                                <p class="summary_view_text">10.02.2018</p>
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
                </form>
            </div>
        </div>
    </div>
    <!-- Modals -->
 
  
    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>assets/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url();?>assets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <!-- iCheck -->
    <script src="<?php echo base_url();?>assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>assets/js/custom.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap-imageupload.js"></script>
    <script src="<?php echo base_url();?>assets/js/drop-down.js"></script>
    <script>
        $(document).ready(function () {
            $(".pro-edit-btn").click(function () {
                $(".edit-profile-section").show();
                $(".view-profile-section").hide();
            });
            $(".pro-save-btn").click(function () {
                $(".edit-profile-section").hide();
                $(".view-profile-section").show();
            });

            $(".add-edit-btn").click(function () {
                $(".edit-add-section").show();
                $(".view-add-section").hide();
            });
            $(".add-save-btn").click(function () {
                $(".edit-add-section").hide();
                $(".view-add-section").show();
            });
            $(".doc-edit-btn").click(function () {
                $(".edit-doc-section").show();
                $(".view-doc-section").hide();
            });
            $(".doc-save-btn").click(function () {
                $(".edit-doc-section").hide();
                $(".view-doc-section").show();
            });
        });
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
            $('#Section-panel-div').hide();
            $('#clinical_id').click(function () {
                $('#Section-panel-div').show();
                $('.clinic-both-section').show();
                $('.noncliincal-section').hide();
            });
            $('#non-clinical_id').click(function () {
                $('#Section-panel-div').show();
                $('.clinic-both-section').hide();
                $('.noncliincal-section').show();
            });
            $('#both_id').click(function () {
                $('#Section-panel-div').show();
                $('.clinic-both-section').show();
                $('.noncliincal-section').hide();
            });
        });

    </script>


    <!-- Switchery -->
    <script src="<?php echo base_url();?>assets/vendors/switchery/dist/switchery.min.js"></script>
 
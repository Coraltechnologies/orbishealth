            <style>
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
                                <h2>Practice Summary</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a href="<?php echo base_url(); ?>account_setup" class="edit-btn"><i class="fa fa-edit"></i> Edit</a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default edit-profile-section" style="display:none">
                                            <div class="panel-heading">Practice Details / Contact Info <span class="pull-right"><a href="#" class="pro-save-btn"><i class="fa fa-save"></i> Save</a></span></div>
                                            <div class="panel-body">
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Practice Name</label>
                                                        <input id="prof_name" onblur="pdCheck2()" type="text" class="form-control" class="form-control" placeholder="Practice Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-12 col-xs-12">
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
                                                        <label>Your Name</label>
                                                        <input id="prof_name" onblur="pdCheck2()" type="text" class="form-control" placeholder="Your Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Tel 1</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <input type="checkbox">
                                                            </span>
                                                            <input type="text" class="form-control" placeholder="+123 4567 890">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Tel 2</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <input type="checkbox">
                                                            </span>
                                                            <input type="text" class="form-control" placeholder="+123 4567 890">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Email </label>
                                                        <div class="form-group has-feedback">
                                                            <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Email ">
                                                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default view-profile-section">
                                            <div class="panel-heading">Personal Details <!--<span class="pull-right"><a href="#" class="pro-edit-btn"><i class="fa fa-edit"></i> Edit</a></span>--></div>
                                            <div class="panel-body">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="col-md-3 col-sm-12 col-xs-12">
														<label>Practice Name</label>
														<div class="form-group">
															<p class="summary_view_text"><?php if($practice_details['practice_name']){echo $practice_details['practice_name'];} ?></p>
														</div>
													</div>
													<div class="col-md-1 col-sm-12 col-xs-12">
														<label>Title</label>
														<p class="summary_view_text"><?php if($practice_details['title']){echo $practice_details['title'];} ?></p>
													</div>
													<div class="col-md-2 col-sm-12 col-xs-12">
														<div class="form-group">
															<label>Your Name</label>
															<p class="summary_view_text"><?php if($practice_details['owner_name']){echo $practice_details['owner_name'];} ?></p>
														</div>
													</div>
													 <div class="col-md-2 col-sm-12 col-xs-12">
														<div class="form-group">
															<label>Designation</label>
															<p class="summary_view_text"><?php if($practice_details['role']){echo $practice_details['role'];} ?></p>
														</div>
													</div>
													<div class="col-md-2 col-sm-12 col-xs-12">
														<div class="form-group">
															<label>Email</label>
															<p class="summary_view_text"><?php if($practice_details['primary_email']){echo $practice_details['primary_email'];} ?></p>
														</div>
													</div>
													<div class="col-md-2 col-sm-12 col-xs-12">
														<div class="form-group">
															<label>Tel1</label>
															<p class="summary_view_text"><?php if($practice_details['tel1']){echo $practice_details['tel1'];} ?></p>
														</div>
													</div>
													<div class="col-md-2 col-sm-12 col-xs-12">
														<div class="form-group">
															<label>Tel2</label>
															<p class="summary_view_text"><?php if($practice_details['tel2']){echo $practice_details['tel2'];} ?></p>
														</div>
													</div>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="panel panel-default edit-add-section" style="display:none">
                                            <div class="panel-heading">Address Details <span class="pull-right"><a href="#" class="add-save-btn"><i class="fa fa-save"></i> Save</a></span></div>
                                            <div class="panel-body">
                                                <div class="col-md-8 col-sm-12 col-xs-12">
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>City / Town</label>
                                                            <input type="text" class="form-control" placeholder="City / Town">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label> State</label>
                                                            <input type="text" class="form-control" placeholder="County / State">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Country</label>
                                                            <input type="text" class="form-control" placeholder="Country">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Postcode</label>
                                                            <input type="text" class="form-control" placeholder="Postcode">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <textarea class="form-control" rows="4" placeholder="Address"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default view-add-section">
                                            <div class="panel-heading">Address Details <!--<span class="pull-right"><a href="#" class="add-edit-btn"><i class="fa fa-edit"></i> Edit</a></span>--></div>
                                            <div class="panel-body">
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <p class="summary_view_text"><?php if($practice_details['address']){echo $practice_details['address'];} ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>City / Town</label>
                                                        <p class="summary_view_text"><?php if($practice_details['city_town']){echo $practice_details['city_town'];} ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>State</label>
                                                        <p class="summary_view_text"><?php if($practice_details['state']){echo $practice_details['state'];} ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <p class="summary_view_text"><?php if($practice_details['country_id']){echo $country['name'][$practice_details['country_id']];} ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Postcode</label>
                                                        <p class="summary_view_text"><?php if($practice_details['postcode']){echo $practice_details['postcode'];} ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default edit-doc-section" style="display:none">
                                            <div class="panel-heading">
                                                Documents
                                               <!-- <span class="pull-right"><a href="#" class="doc-save-btn"><i class="fa fa-edit"></i> Edit</a></span>-->
                                            </div>
                                            <div class="panel-body">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Upload Documents / Files</label>
                                                                <div class="file-input file-input-ajax-new">
                                                                    <label class="btn btn-primary" style="margin-top: 10px;color: #fff;">
                                                                        <input class="file-4 upload_btn" id="upload-file-selector" type="file" multiple="">Upload
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div><div class="col-md-8 col-sm-12 col-xs-12" id="upload_document" style="display:none;">
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
                                                                    <tbody id="upload_list_files" style="height: 10px !important; overflow: scroll; "></tbody>
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

            <style>       
				.upload_btn {
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
            <div class="right_col" role="main">
                <!-- top tiles -->
                <form class="form-horizontal form-label-left row custom_temp">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a id="prac_personal-registration" data-toggle="tab" href="#menu3">
                                    Practice Details  <input type="checkbox" id="pDcheck3" class="flat" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </a>
                            </li>
                            <li>
                                <a id="prac_document-registration" data-toggle="tab" href="#menu6">
                                    Documents <input type="checkbox" id="pDcheck6" class="flat" style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </a>
                            </li>
							<li>
							<a href="javascript:void(0)" style="color:green" id="last_saved">
							 
							</a>
							</li>
                        </ul>
                        <div class="tab-content">
                            <div id="menu3" class="tab-pane fade in active">
                                <p></p>
                                <div class="x_panel">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="input_fields_wrap2">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">Practice Details / Contact Info</div>
                                                            <div class="panel-body">
                                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>Practice Name</label><span class="asterisk" style="color:red">*</span>
	                                                                    <input id="practice_name" type="text" class="form-control" class="form-control" placeholder="Practice Name" value="<?php if($practice_details['practice_name']){ echo $practice_details['practice_name'];} ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                                    <label>Title</label><span class="asterisk" style="color:red">*</span>
                                                                    <div class="form-group">
																		<?php
																			$attr	=array('class'=>'form-control','id'=>'title');
																			$title_options	= array(''=>'Select','Dr'=>'Dr','Mr'=>'Mr','Ms'=>'Ms','Mrs'=>'Mrs','Miss'=>'Miss');
																			echo form_dropdown('Title', $title_options,(isset($practice_details['title']) ? $practice_details['title'] : ''),$attr);
																		?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>Your Name</label><span class="asterisk" style="color:red">*</span>
                                                                        <input id="name" type="text" class="form-control" placeholder="Your Name" value="<?php if($practice_details['owner_name']){ echo $practice_details['owner_name'];} ?>">
                                                                    </div>
                                                                </div>
																<div class="col-md-3 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>Designation</label><span class="asterisk" style="color:red">*</span>
                                                                        <input  type="text" class="form-control" id="role" placeholder="Designation" value="<?php if($practice_details['role']){ echo $practice_details['role'];} ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>Tel 1</label><span class="asterisk" style="color:red">*</span>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                <input type="checkbox">
                                                                            </span>
                                                                            <input type="text" id="tel1" class="form-control" placeholder="+123 4567 890" value="<?php if($practice_details['tel1']){ echo $practice_details['tel1'];} ?>" onkeypress="return restrict_keys(event)">
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
                                                                            <input type="text" id="tel2" class="form-control" placeholder="+123 4567 890" value="<?php if($practice_details['tel2']){ echo $practice_details['tel2'];} ?>" onkeypress="return restrict_keys(event)">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>Email </label><span class="asterisk" style="color:red">*</span>
                                                                        <div class="form-group has-feedback">
                                                                            <input type="text" class="form-control has-feedback-left" id="email" id="inputSuccess4" placeholder="Email" value="<?php if($practice_details['primary_email']){ echo $practice_details['primary_email'];} ?>" disabled>
                                                                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">Address Details <span class="pull-right"><i onclick="clearGP()" class="fa fa-eraser" data-toggle="tooltip" data-title="Clear all data" data-original-title="" title=""></i></span></div>
                                                            <div class="panel-body" id="address_detail">
                                                                <div class="col-md-8 col-sm-12 col-xs-12">
																	<div class="col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>Country</label><span class="asterisk" style="color:red">*</span>
                                                                            <?php
																				$attr	=array('class'=>'form-control','id'=>'country_id','disabled'=>'disabled');
																				echo form_dropdown('Country', $country['name'],(isset($practice_details['country_id']) ? $practice_details['country_id'] : ''),$attr);
																			?>
                                                                        </div>
                                                                    </div>
																	<div class="col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>Postcode</label><span class="asterisk" style="color:red">*</span>
                                                                            <input type="text" class="form-control" placeholder="Postcode" value="<?php if($practice_details['postcode']){ echo $practice_details['postcode'];} ?>" id="zipcode">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>City / Town</label><span class="asterisk" style="color:red">*</span>
                                                                            <input type="text" class="form-control" placeholder="City / Town" value="<?php if($practice_details['city_town']){ echo $practice_details['city_town'];} ?>" id="town">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label> State</label><span class="asterisk" style="color:red">*</span>
                                                                            <input type="text" class="form-control" placeholder="State" value="<?php if($practice_details['state']){ echo $practice_details['state'];} ?>" id="state">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label>Address</label><span class="asterisk" style="color:red">*</span>
																			<input type="text" class="form-control" rows="4" placeholder="Address" id="address" onkeyup="search_address();" value="<?php if($practice_details['address']){ echo $practice_details['address'];} ?>" />
                                                                            <!--<textarea class="form-control" rows="4" placeholder="Address"></textarea>-->
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
										<a href="javascript:void(0);" class="buttonNext btn btn-success" onclick="save_details();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save and Continue <i class="fa fa-angle-right" aria-hidden="true"></i></a>
									</div>
                                </div>
								
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
                                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>Upload Documents / Files:</label>
                                                                        <div class="file-input file-input-ajax-new">
                                                                            <label class="btn btn-primary" style="margin-top: 10px;color: #fff;">
                                                                                <input class="file-4 upload_btn" id="upload-file-selector" type="file" multiple="">Upload
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
																<div class="col-md-8 col-sm-12 col-xs-12" id="upload_document" style="display:none;">
                                                                    <label>Uploaded Documents / Files :</label>
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
														<div class="col-md-12 col-sm-12 col-xs-12">
															<label>Existing Documents / Files :</label><span id="upload_doc_response"></span>
															<div class="row">
																<div class="col-md-8 col-sm-12 col-xs-12">
																	<div class="list-group table-responsive">
																		<table id="datatable-responsive" class="table table-fixed table-striped table-bordered" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%; ">
																			<thead>
																				<tr role="row">
																					<th width="20"><!--<input type="checkbox" onchange="chkfiles()" id="chkallfiles" />--> &nbsp; #</th>
																					<th width="20" class="sorting_asc" tabindex="0" aria-controls="datatable-responsive"  aria-sort="ascending" aria-label="First name: activate to sort column descending">Title</th>
																					<th width="20" class="sorting" tabindex="0" aria-controls="datatable-responsive" aria-label="E-mail: activate to sort column ascending">Action</th>
																				</tr>
																			</thead>
																			<tbody id='exsiting_document'>
																			<?php 
																				if(isset($other_uploads) && !empty($other_uploads)) { 
																					$xx			= 1; 
																					foreach($other_uploads as $up_key => $up_val){ 
																					$val_arr			=(array)$up_val;
																			?>
																						<tr role="row">
																							<td >
																							<?php echo $xx; ?>
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
																					$xx++;
																					}
																				}else{																	
																			?>
																			<tr>
																				<td colspan="3"> No records uploaded...<input type="hidden" id="files_empty" value="1" /></td>
																			</tr>
																				<?php } ?>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
															<div class="actionBar">
																<a href="javascript:void(0);" class="buttonPrevious btn btn-primary" onclick="nxt_tab('prac_personal-registration');"><i class="fa fa-angle-left" aria-hidden="true"></i> Previous</a>
																<a href="<?php echo base_url(); ?>account_setup/practice_summary" class="buttonNext btn btn-success" onclick="nxt_tab('pat_reg_personal-consent');"> <i class="fa fa-floppy-o" aria-hidden="true"></i> Save and Continue</a>
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
                </form>
            </div>
        </div>
    </div>
    <!-- Modals -->
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/vendors/iCheck/icheck.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- FullCalendar -->
    <script src="<?php echo base_url(); ?>assets/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/fullcalendar/dist/fullcalendar.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-imageupload.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/drop-down.js"></script>
    <script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader 					= new FileReader();
			reader.onload 				= function (e) {
				$('#blah').attr('src', e.target.result);
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
					var reader 			= new FileReader();
					file_name 			= input.files[i]['name'];
					x 					= i ;
					xx					= i+1;
					var html_content 	= html_content + '<tr id="file_row_'+x+'" role="row" class="odd"><td style="padding-left:8px;">' +xx+ '</td><td tabindex="0" class="sorting_1"><a href="#">' + file_name + '</a></td><td tabindex="0" class="sorting_1"><input type="text" id="file_row_text_'+x+'"></td><td><a href="#" class="btn btn-success"><i class="fa  fa-share" data-toggle="tooltip" data-title="Share Document" data-original-title="" title=""></i></a><a href="#" class="btn btn-success"><i class="fa  fa-edit" data-toggle="tooltip" data-title="Edit Title" data-original-title="" title=""></i></a><a href="#" class="btn btn-success" onclick="remove_upload_row('+x+')"><i class="fa  fa-trash" data-toggle="tooltip" data-title="Delete" data-original-title="" title=""></i></a></td></tr>';
				}
				html_content			+='<tr><td colspan="4" align="right "><span id="upload_doc_loader" style="display:none;"><img src="<?php echo base_url(); ?>assets/img/loader.gif" style="height:50px;" alt="loader" /></span><span id="upload_doc" class="buttonNext btn btn-success" onclick="upload_files()"> <i class="fa fa-upload" aria-hidden="true"></i> Upload Files</span></td></tr>';
				
				$("#upload_list_files").html(html_content);
				$('#upload_document').show();
			}
		};
		$('#upload-file-selector').on('change', function () {
			imagesPreview(this, '#datatable-responsive');
		});
	});
        
    </script>
    <!-- Switchery -->
    <script src="<?php echo base_url(); ?>assets/vendors/switchery/dist/switchery.min.js"></script>
	
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyB30YkpVyTfcPsQkwNiiBLE2a-C5EHYFSA&libraries=places"></script>
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
	
	function restrict_keys(e) {
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 43 && e.which > 31 ) {
			return false;
		}
	}
	
	function save_details(){
		var practice_name					= $("#practice_name").val();
		var title							= $("#title").val();
		var name							= $("#name").val();
		var tel1							= $("#tel1").val();
		var tel2							= $("#tel2").val();
		var email							= $("#email").val();
		var country_id						= $("#country_id").val();
		var postcode						= $("#zipcode").val();
		var town							= $("#town").val();
		var state							= $("#state").val();
		var address							= $("#address").val();
		var role							= $("#role").val();
		if(practice_name.trim() == ""){
			$("#practice_name").focus();
			$("#practice_name").css('border','1px solid #ff1a1c');
		}else if(title.trim() == ""){
			$("#title").focus();
			$("#title").css('border','1px solid #ff1a1c');
		}else if(name.trim() == ""){
			$("#name").focus();
			$("#name").css('border','1px solid #ff1a1c');
		}else if(tel1.trim() == ""){
			$("#tel1").focus();
			$("#tel1").css('border','1px solid #ff1a1c');
		}else if(email.trim() == ""){
			$("#email").focus();
			$("#email").css('border','1px solid #ff1a1c');
		}else if(country_id == ""){
			$("#country_id").focus();
			$("#country_id").css('border','1px solid #ff1a1c');
		}else if(postcode.trim() == ""){
			$("#zipcode").focus();
			$("#zipcode").css('border','1px solid #ff1a1c');
		}else if(town.trim() == ""){
			$("#town").focus();
			$("#town").css('border','1px solid #ff1a1c');
		}else if(state.trim() == ""){
			$("#state").focus();
			$("#state").css('border','1px solid #ff1a1c');
		}else if(address.trim() == ""){
			$("#address").focus();
			$("#address").css('border','1px solid #ff1a1c');
		}else if(role.trim() == ""){
			$("#role").focus();
			$("#role").css('border','1px solid #ff1a1c');
		}else{
			var form_data 			= new FormData();
			form_data.append('practice_name', practice_name.trim());
			form_data.append('title', title.trim());
			form_data.append('name', name.trim());
			form_data.append('role', role.trim());
			form_data.append('tel1', tel1.trim());
			form_data.append('tel2', tel2.trim());
			form_data.append('email', email.trim());
			form_data.append('country_id', country_id);
			form_data.append('postcode', postcode.trim());
			form_data.append('town', town.trim());
			form_data.append('state', state.trim());
			form_data.append('address', address.trim());
			
			var url	="<?php echo base_url(); ?>account_setup/practice_details";
			$.ajax({
				url: url,
				type: 'POST',
				data: form_data,
				dataType: "json",
				processData: false,
				contentType: false,
				success: function(data){
					console.log(data);
					if(data.response.trim() == 'success'){
						nxt_tab('prac_document-registration');
						$("#last_saved").html("Last Saved :"+data.save_time);
						$("#pDcheck3").iCheck("check");
					}else{
						alert('Please try after sometime..');
					} 
				}
			});
		}
	}
	function nxt_tab(a) {
		$("#" + a).click();
	}
	function clearGP(){
		$('#address_detail').find('input[type=text]').val('');
		//$('#country_id').val('');
	}
	function remove_upload_row(a){
		var alrt					= confirm('Are you sure do you want to remove this row?');
		var filelist				= document.getElementById('upload-file-selector');
		filelist.files[a]			= {};
		if(alrt){
			$("#file_row_"+a).remove();
		}
	}
	
	function upload_files(){
		var input									= document.getElementById('upload-file-selector');
		var country_name							= new Array();
		var url										= "<?php echo base_url(); ?>account_setup/save_uploaded_files";
		var i = 0, len = input.files.length,file;
		if(len >0){
			form_data = new FormData();
			var details				= new Array();
			for (; i < len; i++){
				file = input.files[i];
				if($("#file_row_text_"+i).length>0){
					form_data.append("file["+i+"]", file);
					form_data.append("title["+i+"]", $("#file_row_text_"+i).val());
				}
			}
			form_data.append('file_type','others');
			$("#upload_doc").hide();
			$("#upload_doc_loader").show();
			$.ajax({
				url: url,
				type: 'POST',
				data: form_data,
				dataType: "json",
				processData: false,
				contentType: false,
				success: function(data){
					var cont			= data.response;	
					var cnt				= $('#exsiting_document tr').length
					if(cont.trim() =='success'){
						var html_content				= '';
						if(data.details.length> 0){
							for(i=0;i<data.details.length;i++){
								if($("#files_empty").length >0 && $("#files_empty").val() == 1){
									var xx					= i+1;
								}else{
									var xx					= cnt + 1;
								}
								html_content			+='<tr role="row"><td>'+xx+'</td><td tabindex="0"><a href="#">'+data.details[i].title+'</a></td><td><a href="<?php echo base_url(); ?>assets/uploads/'+data.details[i].file_path+data.details[i].file_name+'" target="_blank" class="btn btn-success"><i class="fa fa-eye" data-toggle="tooltip" data-title="Share Document" data-original-title="" title=""></i></a></td></tr>';
								cnt++;
							}
						}
						if($("#files_empty").length >0 && $("#files_empty").val() == 1){
							$("#exsiting_document").html(html_content);
						}else{
							$("#exsiting_document").append(html_content);
						}
						$("#upload_doc").show();
						$("#upload_doc_loader").hide();
						$("#upload_document").hide();
						$("#upload_doc_response").html("<span style='color:green;font-size:13px;'>File Uploaded Successfully..</span>&nbsp;&nbsp;&nbsp;");
						$("#exsiting_document").show();
						$("#pDcheck6").iCheck("check");
						$("#last_saved").html("Last Saved :"+data.saved_time);
						///nxt_tab('pat_reg_personal-notes');
					}else{
						alert("Please try after sometime..");
					} 
				}
			});
		} 
	}
	</script>
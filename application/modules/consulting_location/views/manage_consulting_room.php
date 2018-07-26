	
	<link href="<?php echo base_url(); ?>assets/vendors/list/listbox.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/magicsuggest/magicsuggest-min.css" rel="stylesheet">
  		<style>
        .nav-tabs {
            border-bottom: 2px solid #DDD;
        }

            .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
                border-width: 0;
            }

            .nav-tabs > li > a {
                border: none;
                color: #666;
            }

                .nav-tabs > li.active > a, .nav-tabs > li > a:hover {
                    border: none;
                    color: #4285F4 !important;
                    background: transparent;
                }

                .nav-tabs > li > a::after {
                    content: "";
                    background: #4285F4;
                    height: 2px;
                    position: absolute;
                    width: 100%;
                    left: 0px;
                    bottom: -1px;
                    transition: all 250ms ease 0s;
                    transform: scale(0);
                }

            .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after {
                transform: scale(1);
            }

        .tab-nav > li > a::after {
            background: #21527d none repeat scroll 0% 0%;
            color: #fff;
        }

        .tab-pane {
            padding: 15px 0;
        }

        .tab-content {
            padding: 20px
        }

        .card {
            background: #FFF none repeat scroll 0% 0%;
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }
    </style>
            <!-- /top navigation -->
            <!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->
                <form class="form-horizontal form-label-left row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Search Consutling Room</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Consulting Room</label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="consulting_search" placeholder="Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-3">
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-4 col-xs-12">Professionals</label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" id="Professionals_search" placeholder="Professionals">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-3">
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-4 col-xs-12">Location/City</label>
                                            <div class="col-md-12 col-sm-8 col-xs-12">
                                                <input type="text" class="form-control" id="city_search" placeholder="City">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-2">
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-4 col-xs-12">Status</label>
                                            <div class="col-md-12 col-sm-8 col-xs-12">
                                                <select class="form-control" id="Status_search">
                                                    <option value="all">All</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                    <option value="notassigned">Not Assigned</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-1">
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
												<input type="button" class="btn btn-success" style="margin-right:0; min-width:100%;margin-top: 19px;" value="Search" onclick ='search_room();' />
                                                <!--<button type="button" class="btn btn-success" id="location-search-btn" style="margin-right:0; min-width:100%;margin-top: 19px;">Search</button>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="loctaion-list"  style="display:none" >
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
														<th>
															<div class="col-md-12 col-sm-12 col-xs-12">
																<div class="col-md-1 col-sm-2 col-xs-2">
																	S no	
																</div>
																<div class="col-md-11 col-sm-10 col-xs-10">
																	Consulting Location
																</div>
															</div>
														</th>
                                                    </tr>
												</thead>
												<hr>
                                                <tbody  id="search_details">
												</tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Assign Consutling Room</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link collapse"><i class="fa fa-chevron-up"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content collapse">
								<div>
								<input type="button" class="btn btn-md btn-success pull-right" onclick = "assign_cosulting_room();" value="Assign Room">
								</div>
								<div class="row">
									<div class="col-md-12 col-xs-12 col-sm-12 ">
										<div class="col-md-6 col-xs-12 col-sm-12 ">
											<div class="form-group">
												<label>Select Consulting Location</label>
												<?php 
													$attr					= array('class'=>'form-control','id'=>'doc_drop','multiple'=>'multiple','onchange'=>'consulting_room_list();');
													echo form_dropdown("Location", $details,'',$attr);
												?>
											</div>
										</div>
										
										<div class="col-md-3 col-xs-12 col-sm-12 ">
											<div class="form-group">
												<label>Select Consulting Rooms (Multiple)</label>
												<select id="cons_room" multiple class="form-control">
												
												</select>
											</div>
										</div>
										
										<div class="col-md-3 col-xs-12 col-sm-12 ">
											<div class="form-group">
												<label>Select Clinician (Multiple)</label>
												<?php 
													$attr					= array('class'=>'form-control','id'=>'clinician','multiple'=>'multiple');
													echo form_dropdown("Team", $team,'',$attr);
												?>
											</div>
										</div>
									</div>
								</div>
                               <!--<div class="col-md-2 col-xs-12 col-sm-12 ">
                                    <div class="form-group" style="padding-top:19px;">
										<input type="button" class="btn btn-md btn-success pull-right" onclick = "assign_cosulting_room();" value="Assign Room">
                                        
                                    </div>
                                </div> -->
                                <div>
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Consulting Location</th>
                                                    <th>Consulting Rooms</th>
                                                    <th>Clinicians</th>
                                                </tr>
                                            </thead>
                                            <tbody id="created_room">
												<tr>
													<td colspan="4">
													<input type="hidden" value ='1' id="no_record" />
														No records added...
													</td>
												</tr>
											</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    </form>
            </div>
        </div>
    </div>
	<?php
		$list				= '';
		foreach($team as $t_key => $t_val){
			$list			.= '<option value="'.$t_key.'">'.$t_val.'</option>';
		}
		 
	?>
    
    <!--<div class="modal fade patient-info" id="patient-info-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Image / Videos</h4>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td><img src="https://drsafehands.com/resources/assets/images/doctor.png" width="70%" /></td>
                            <td><iframe width="360" height="215" src="https://www.youtube.com/embed/yAoLSRbwxL8" frameborder="0" allowfullscreen></iframe></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>-->
    <!-- jQuery -->
      <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/drop-down.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url(); ?>assets/vendors/skycons/skycons.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/magicsuggest/magicsuggest-min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/list/listbox.js"></script>
    <script type="text/javascript">
	
        $(function () {
            $('#cons_location').listbox({ 'searchbar': true});
            $('#cons_room').listbox({ 'searchbar': true,'class':'dynamic_list'});
            $('#doc_drop').listbox({ 'searchbar': true,'id':'search_location' });
		   $('#clinician').listbox({ 'searchbar': true ,'class':'clinician_list','id':'search_clinician_id','onkeyup':'search_clinician'});
        });
        jQuery(document).ready(function ($) {
            $("#room-search-btn").on("click", function () {
                $("#room-result").show();
                $("#doclist").hide();
                $("#doclist1").hide();
                $("#docl").hide();
                event.preventDefault();
            });

            $(".hide-panel").on("click", function () {
                $("#room-result").hide();
                event.preventDefault();
            });
        });
    
        $(document).ready(function () {
            $("#location-search-btn").click(function () {
                $(".loctaion-list").show();
            });
        });
				
		function consulting_room_list(){
			var a									= $("#doc_drop").val();
			var url							 		=  "<?php echo base_url() ?>consulting_location/list_consulting_room";
			if(a !=null){
				$.post(url,{a:a},function(data){
					if(data.response.trim() == 'success'){
						if(data.response_data.length > 0){
							var option				= '';
							for(var i= 0 ; i < data.response_data.length ; i++){
								option				+='<option value="'+data.response_data[i].id+'">'+data.response_data[i].consulting_room_title+'</option>';
							}
							$("#cons_room").html(option);
							$('.dynamic_list').remove();
							$('#cons_room').listbox({ 'searchbar': true,'class':'dynamic_list'});
						} 
					}else if(data.response.trim() == 'empty'){
						alert('No consulting room available for this location...');
						$("#cons_room").html('');
						$('.dynamic_list').remove();
						$('#cons_room').listbox({ 'searchbar': true,'class':'dynamic_list'});
					}else{
						alert('Please try after sometime...');
					}
				},'json');
			}else{
				$("#cons_room").html('');
				$('.dynamic_list').remove();
				$('#cons_room').listbox({ 'searchbar': true,'class':'dynamic_list'});
			}
		}
		
		function assign_cosulting_room(){
			var  consulting_loc							= $("#doc_drop").val();
			var  consulting_room						= $("#cons_room").val();
			var  clinician								= $("#clinician").val();
			if(consulting_loc == null){
				alert('Please select atleast one Consulting Location...');
			}else if(consulting_room == null){
				alert('Please select atleast one Consulting room...');
			}else if(clinician == null){
				alert('Please select atleast one Clinician...');
			}else{
				var url									= "<?php echo base_url() ?>consulting_location/assign_consulting_room";
				$.post(url,{consulting_loc:consulting_loc,consulting_room:consulting_room,clinician:clinician},function(data){
					if(data.response.trim() == 'success'){
						$("#doc_drop").val('');
						$("#cons_room").val('');
						$("#clinician").val('');
						$(".lbjs-item").removeAttr('selected');
						var new_rooms					= '';
						for(var i =0; i < data.response_data.length;i++){
							
							if(data.response_data[i].middlename == null){
								name					= data.response_data[i].title+' '+data.response_data[i].firstname+' '+data.response_data[i].lastname;
							}else{
								name					= data.response_data[i].title+' '+data.response_data[i].firstname+' '+data.response_data[i].middlename+' '+data.response_data[i].lastname;
							}
							new_rooms					+="<tr><td>"+ data.response_data[i].consulting_name +' - '+ data.response_data[i].address +"</td><td>"+ data.response_data[i].consulting_room_title+"</td><td>"+name+"</td></tr>";
						}
						if($("#no_record").length>0 && $("#no_record").val() == 1 && new_rooms.trim() !=''){
							$("#created_room").html(new_rooms);
						}else{
							$("#created_room").append(new_rooms);
						}
						
						if(data.response_addtional && data.response_addtional.trim() == 'exist'){
							var exist_room										= '';
							for(var i =0; i < data.response_addtional_info.length;i++){
								if(data.response_addtional_info[i].middlename == null){
									name					= data.response_addtional_info[i].title+' '+data.response_addtional_info[i].firstname+' '+data.response_addtional_info[i].lastname;
								}else{
									name					= data.response_addtional_info[i].title+' '+data.response_addtional_info[i].firstname+' '+data.response_addtional_info[i].middlename+' '+data.response_addtional_info[i].lastname;
								}
								exist_room				   +=name +'has been already assign to room( '+data.response_addtional_info[i].consulting_room_title+" )\n";
							}
							alert(exist_room);
						}
					}else{
						$("#doc_drop").val('');
						$("#cons_room").val('');
						$("#clinician").val('');
						$(".lbjs-item").removeAttr('selected');
						alert('Please try after sometime..');
					}
				},'json');
			}
		}
		
		function search_room(){
			var consulting_val							= $("#consulting_search").val();
			var professional_val						= $("#Professionals_search").val();
			var city_val								= $("#city_search").val();
			var status_val								= $("#Status_search").val();
			var url										= "<?php echo base_url() ?>consulting_location/search_consulting_room";
			$.post(url,{consulting_val:consulting_val,professional_val:professional_val,city_val:city_val,status_val:status_val},function(data){
				if(data.response == 'success'){
					//$('.loctaion-list').show();
					var div_list						= '';
					var x								= 1;
					$.each( data.response_data, function( key, value ) {
						var list_room					= '';
						var cnt							= 1;	
						var i							= 0;
						$.each(value.consulting_id, function( v_key, v_value ) {
							var clinician_name			= '';
							if(v_value.clinician_name != null){
								clinician_name			= v_value.clinician_name;
							}
							list_room				   += '<tr id="row_'+ value.venue_key +'_'+i+'"><td width="5%">'+cnt+'</td><td width="35%" id="text_'+ value.venue_key +'_'+i+'" >'+v_value.consulting_room_title+'</td><td width="25%" id="clinician_'+ value.venue_key +'_'+i+'">'+clinician_name+'</td> <td width="25%" id="status_div_'+ value.venue_key +'_'+i+'">'+v_value.status +'</td><td width="10%"><div id="update_div_'+ value.venue_key +'_'+i+'" style="display:none"><a href="javascript:void(0);" class="btn btn-success pull-right" id="update_'+ value.venue_key +'_'+i+'" onclick="update_room('+value.venue_key+','+v_value.consulting_id+','+"'"+i+"'"+')" >Update</a></div><div id="edit_'+ value.venue_key +'_'+i+'" class="action-icon" align="center"><a href="#"><i class="fa fa-pencil-square"  onclick="edit_room('+value.venue_key+','+v_value.consulting_id+','+"'"+i+"'"+')" data-toggle="tooltip" data-title="Edit" data-original-title="" title="Edit"></i></a><a href="#" onclick="remove_room('+value.venue_key+','+v_value.consulting_id +','+"'"+i+"'"+')"><i class="fa fa-trash" data-toggle="tooltip" data-title="Delete" data-original-title="" title=""></i></a></div></td></tr>';
							cnt++;
							i++;
						});
						div_list					   += '<tr><td><div class="col-md-12 col-sm-12 col-xs-12"><div class="col-md-1 col-sm-2 col-xs-2">'+x+'</div><div class="col-md-10 col-sm-10 col-xs-10">'+value.name+'</div><div class="col-md-1 col-sm-1 col-xs-1"><a data-toggle="collapse" data-parent="#accordion" href="#collapse_'+x+'"><span class="pull-right"><i class="fa fa-sort-down"></i></span></a></div></div><div id="collapse_'+x+'" class="panel-collapse collapse"><div class="col-md-12 col-sm-12 col-xs-12" style="padding: 5px 16px;"><table class="table table-striped table-bordered" style="margin-top: 10px;"><thead><tr><th>S no</th><th> Consulting room</th><th>Clinician</th><th>Status</th><th>Actions</th></tr></thead><tbody>'+list_room+'</tbody></table></div></div></td></tr>';
						x++;
					});
					$('.loctaion-list').show();
					$('#search_details').html(div_list);
				}else if(data.response == 'empty'){
					$('.loctaion-list').show();
					$('#search_details').html('<tr><td><div class="col-md-12 col-sm-12 col-xs-12"> No records found..</div></td></tr>');
					
				}else{
					alert('Please try after sometime..');
				}
			},'json');
		}
		
		function remove_room(a,b,d){
			var url							= "<?php echo base_url() ?>consulting_location/remove_room";
			var check						= confirm('Are you sure do you want to delete?');
			if(check == true){
				$.post(url,{a:a,b:b},function(data){
					if(data.response.trim() == 'success'){
						$("#row_"+a+"_"+d).remove();
					}else{
						alert('Please try after sometime..');
					}
				},'json');
			}
		}
		
		function edit_room(a,b,d){
			var text						= $("#text_"+a+"_"+d).html();
			$("#update_div_"+a+"_"+d).show();
			$("#edit_"+a+"_"+d).hide();
			$("#text_"+a+"_"+d).html('<input type="text" class="form-control" value="'+text+'" id="input_'+a+'_'+d+'"/>');
			$("#clinician_"+a+"_"+d).html('<select id="c_input_'+a+'_'+d+'" class="multiselect-ui form-control multiservicelist multiselect-native-select" multiple><?php echo $list; ?></select>');
			$('.multiselect-ui').multiselect({
				maxHeight: 200,
				includeSelectAllOption: true
			});
			$("#status_div_"+a+"_"+d).html('<select class="form-control" id="status_'+a+'_'+d+'"><option value="active">Active</option><option value="inactive">Inactive</option></select>');
		}
		
		function update_room(a,b,d){
			var title						= $("#input_"+a+"_"+d).val();
			var clinician					= $("#c_input_"+a+"_"+d).val();
			var status						= $("#status_"+a+"_"+d).val();
			var clinician_name				= $("#c_input_"+a+"_"+d).find(":selected").text();
			if(title.trim() == ''){
				$("#input_"+a+"_"+d).focus();
				$("#input_"+a+"_"+d).css('border','1px solid #ff1a1c');
			}else{
				var url						= "<?php echo base_url() ?>consulting_location/edit_room";
				$.post(url,{a:a,b:b,title:title,clinician:clinician,status:status},function(data){
					if(data.response.trim() =='success'){
						var selText			= '';
						$("#c_input_"+a+"_"+d+" option:selected").each(function () {
							var $this = $(this);
							if ($this.length && $this.val() !='') {
								selText += $this.text()+"<br/>";
							}
						});
						$("#text_"+a+"_"+d).html(title.trim()); 
						$("#clinician_"+a+"_"+d).html(selText.trim());
						$("#status_div_"+a+"_"+d).html(data.status.trim());
						$("#update_div_"+a+"_"+d).hide();
						$("#edit_"+a+"_"+d).show();
					}else{
						alert('Please try after sometime..');
					} 
				},'json');
			}
		}
	/*	 $(function () {
			$("#search_location").keyup(function(){
				alert('search_location');
			});
			$("#search_room").keyup(function(){
				alert('search_room');
			});
			
			 
				
		});
		
		function search_clinician(){
			var text					= $("#search_clinician_id").val();
			var url						=  "<?php echo base_url() ?>consulting_location/search_clinician";
			$.post(url,{text:text},function(data){
				if(data.response.trim() =='success'){
					var options			= '';
					jQuery.each( data.response_data, function( i, val ) {
						options			+= '<option value="'+i+'">'+val+'</option>';
					});
					$("#clinician").html(options);
					//$("#clinician").removeItem();
					$('.clinician_list').remove();
					//$('#clinician').refreshList({'id':'search_clinician'});
					$('#clinician').listbox({ 'searchbar': true ,'class':'clinician_list','id':'search_clinician_id','onkeyup':'search_clinician'});
					//$('#clinician').listbox({ 'searchbar': true,'class':'clinician_list','id':'search_clinician'});
					$("#search_clinician").val(text);
					
				}else if(data.response.trim() =='empty'){
					
				}else{
					alert('Please try after sometime..');
				}
			},'json');
		}*/
    </script>
    <!-- Modals -->
 
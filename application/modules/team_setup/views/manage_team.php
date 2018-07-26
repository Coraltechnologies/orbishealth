 
    <style>
        .avg-profile-img {
            width: 120px;
        }

        .mg-panel-body {
            padding: 5px;
        }
        /*** Profile: Header  ***/
        .profile__avatar-2 {
            float: left;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin-right: 20px;
            overflow: hidden;
            margin-top: -4px;
        }
        .box-filter {
        }
        .one{}
        .two {}
        .three {
        }

        @media (min-width: 768px) {
            .profile__avatar-2 r {
                width: 70px;
                height: 70px;
            }
        }

        .profile__avatar-2 > img {
            width: 100%;
            height: auto;
        }

        .text-cus {
            margin-top: -7px;
        }
        .mg-team-header {
            background-color: #ddd;
            height: 40px;
            padding: 0px 0px !important;
        }
		
    </style>

            <!-- page content -->
            <div class="right_col" role="main">
                <form class="form-horizontal form-label-left row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Manage Team</h2>
                                <ul class="nav navbar-right panel_toolbox">
							        <li style="margin-top: 2px;"><a class="" href="javascript:void(0);"  onclick="team_member_search()"><i class="fa fa-search fa-lg"></i></a></li>
                                </ul>
                                <div class="col-md-2 pull-right">
									<?php
										$attr	=array('class'=>'form-control','id'=>'role');
										echo form_dropdown('Role',$role,'',$attr);
									?>
                                    <!--<select class="form-control">
                                        <option value="box-filter">All</option>
                                        <option value="one">Accountant</option>
                                        <option>Cashier</option>
                                        <option>Chief Executive</option>
                                        <option>Dentist</option>
                                        <option>Director</option>
                                        <option>Driver</option>
                                        <option  value="two">General Practitioner</option>
                                        <option>Health Care Assistant</option>
                                        <option>Lab Technician</option>
                                        <option>Manager</option>
                                        <option value="three">Nurse</option>
                                        <option>Office Admin</option>
                                        <option>Optician</option>
                                        <option>Receptionist</option>
                                        <option>Specialist</option>
                                        <option>Therapist</option>
                                        <option>Ward Assistant</option>
                                    </select>-->
                                </div>
								
                                <div class="col-md-3 pull-right">
                                    <div class="col-md-3">
                                        <label style="margin-top: 8px;">Status</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control col-md-6" id="search_status">
                                            <option>All</option>
                                            <option value='active'>Active</option>
                                            <option value='inactive'>Inactive</option>
                                        </select>
                                    </div>
                                </div>
								
								<div class="col-md-5 pull-right">
                                    <!--<div class="col-md-2">
                                        <label style="margin-top: 8px;">Search</label>
                                    </div>-->
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" placeholder="Name Search" id="search_name"/>
                                    </div>
                                </div>
								
								
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="x_panel" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .08);">
                                            <div class="x_title">
                                                <h2 class="box-filter"><i class="fa fa-users" aria-hidden="true"></i> Team</h2>
                                                <!--<h2 class="one" style="display:none;"><i class="fa fa-user-md" aria-hidden="true"></i> Accountant</h2>
                                                <h2 class="two" style="display:none;"><i class="fa fa-user-md" aria-hidden="true"></i> General Practitioner</h2>
                                                <h2 class="three" style="display:none;"><i class="fa fa-user-md" aria-hidden="true"></i> Nurse</h2>-->
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li style="margin-top: 2px;">
                                                        <h2>Count : <span id="count_id"><?php echo count($prof_details) ?></span></h2>
                                                    </li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div id="ajax_load">
                                                <div class="row">
                                                   <?php if(!empty($prof_details)){
													 	foreach($prof_details as $prof_key => $prof_val){
															$prof_val	= (array)$prof_val;
															//print_r($prof_val);
														?>
															<div class="padding-null one box-filter" id="container_<?php echo $prof_val['primary_id'] ?>">
																<div>
																	<div class="container-fluid mg-team-header">
																		<div class="col-md-4 col-sm-12 col-xs-12">
																			<div class="profile__header">
																				<h3 style="font-size:17px;"><a href="<?php echo base_url() ?>team_setup/summary/<?php echo $this->encryptionfunction->enCrypt($prof_val['primary_id']); ?>" ><?php  echo ucfirst($prof_val['title'].' '.$prof_val['firstname'].' '.$prof_val['lastname']) ?></a>&nbsp;&nbsp;&nbsp;<small><?php if($prof_val['qualifications']){echo '('.$prof_val['qualifications'].')'; } ?></small></h3>
																				</p>
																			</div>
																		</div>
																		<div class="col-md-4 col-sm-12 col-xs-12">
																			<div class="profile__header">
																				<?php
																					$cate		= $this->common->get_roles($prof_val['primary_id']);
																				?>
																				<h3 style="font-size:17px;width: 250px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;cursor:pointer;"  title="<?php echo trim($cate['name'],', '); ?>">
																					<?php echo trim($cate['name'],', '); ?>	
																				</h3>
																				</p>
																			</div>
																		</div>
																		<div class="col-md-4 col-sm-12 col-xs-12">
																			<div class="profile__header">
																			<?php //echo "<pre>";print_r($prof_val) ?>
																				<h3 style="font-size:17px;" onclick="change_status('<?php echo $this->encryptionfunction->enCrypt($prof_val['primary_id']);  ?>',<?php echo $prof_val['primary_id']; ?>)">Status <i class="fa fa-check customer-details-active" data-toggle="tooltip" data-original-title="<?php if($prof_val['status'] == 'active'){echo "Active now";}else{echo "Inactive now";} ?>"  style="color:<?php if($prof_val['status'] == 'active'){echo "#559900";}else{echo "#ff0000";} ?>" aria-hidden="true" title="" id="status_<?php echo $prof_val['primary_id'];  ?>"></i></h3>
																				</p>
																			</div>
																		</div>
																	</div>
																	<div class="x_panel">
																		<div class="col-md-4 col-sm-12 col-xs-12 padding-null">
																			<div class="profile__avatar-2 ">
																				<?php
																					if(!($prof_val['img_name']) && !($prof_val['img_path'])){
																				?>	
																					<img src="<?php echo base_url(); ?>assets/img/profile-image.png" alt="Profile">
																				<?php
																					}else{
																				?>
																					<img src="<?php echo base_url().'assets/uploads/'.$prof_val['img_path'].$prof_val['img_name']; ?>"  alt="Profile">
																				<?php } ?>
																			</div>
																			<div class="profile__header">
																				<h3 style="font-size:17px;"><small style="color:blue;"> <?php echo $prof_val['gender']; ?></small></h3>
																				<p class="text-muted text-cus">
																					<strong>Age:</strong>
																					<?php
																						$diff		='';
																						if(!empty($prof_val) && $prof_val['dob']){
																							$dob	= $prof_val['dob'];
																							$diff 	= (date('Y') - date('Y',strtotime($dob)));
																						}else{
																							$diff	='';
																						}
																						echo $diff;
																					?>
																					
																					 &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <strong>DOB:</strong> <?php echo date("d/m/Y",strtotime($prof_val['dob'])); ?>
																				</p>
																			</div>
																		</div>

																		<div class="col-md-2 col-sm-12 col-xs-12 ">
																			<div class="profile__header">
																				<?php if($prof_val['register_number']){ ?>
																				<h3 style="font-size:14px;">Prof Reg No</h3>
																				<p class="text-muted text-cus">
																					<strong><?php echo $prof_val['register_number']; ?> </strong><br /><small style="color:red;"> (Exp Date : <?php echo  implode('/',array_reverse(explode('-',$prof_val['expiry_date']))); ?>)</small>
																				</p>
																				<?php } ?>
																			</div>
																		</div>
																		<div class="col-md-6 col-sm-12 col-xs-12 padding-null">
																			<div class="col-md-5 col-sm-12 col-xs-12 padding-null">
																				<div class="profile__header">
																					<h3 style="font-size:14px;">Start Date</h3>
																					<h3 style="font-size:12px;"><?php echo date("d/m/Y",strtotime($prof_val['created_date'])); ?></h3>
																				</div>
																			</div>
																			<div class="col-md-5 col-sm-12 col-xs-12 padding-null">
																				<!--<div class="profile__header">
																					<h3 style="font-size:14px;">End Date</h3>
																					<h3 style="font-size:12px;">02/11/1995</h3>
																				</div>-->
																			</div>
																			<div class="col-md-2 col-xs-12 action-icon reminder-action-icon padding-null">
																				<a href="<?php echo  base_url() ?>team_setup/index/<?php echo $this->encryptionfunction->enCrypt($prof_val['primary_id']); ?>"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""></i></a>
																				<a href="#"><i class="fa fa-chevron-circle-down" data-toggle="tooltip" data-title="View More" data-original-title="" title=""></i></a>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														<?php
														}
													}else{
													?>
													<div class="padding-null one box-filter">
                                                        <div>
															<div class="container-fluid">
																<div class="col-md-4 col-sm-12 col-xs-12">
																	<div class="profile__header">
																		No records found...
																	</div>
																</div>
															</div>
														</div>
													</div>
													<?php 
													} 
													?>
													<!--
													<div class="padding-null one box-filter">
                                                        <div>
                                                            <div class="container-fluid mg-team-header">
                                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                                    <div class="profile__header">
                                                                        <h3 style="font-size:17px;">Mr.Karthik  Mcom <small>(CA)</small></h3>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                                    <div class="profile__header">
                                                                        <h3 style="font-size:17px;">Accountant</h3>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                                    <div class="profile__header">
                                                                        <h3 style="font-size:17px;">Status <i class="fa fa-check customer-details-active" data-toggle="tooltip" data-title="Active now" aria-hidden="true" data-original-title="" title=""></i></h3>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="x_panel">
                                                                <div class="col-md-4 col-sm-12 col-xs-12 padding-null">
                                                                    <div class="profile__avatar-2 ">
                                                                        <img src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/1.jpg" alt="...">
                                                                    </div>
                                                                    <div class="profile__header">
                                                                        <h3 style="font-size:17px;"><small style="color:blue;"> Male</small></h3>
                                                                        <p class="text-muted text-cus">
                                                                            <strong>Age:</strong> 23 &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <strong>DOB:</strong> 12/01/1998
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-2 col-sm-12 col-xs-12 ">
                                                                    <div class="profile__header">
                                                                        <h3 style="font-size:14px;"></h3>
                                                                        <p class="text-muted text-cus">
                                                                            
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-sm-12 col-xs-12 padding-null">
                                                                    <div class="col-md-5 col-sm-12 col-xs-12 padding-null">
                                                                        <div class="profile__header">
                                                                            <h3 style="font-size:14px;">Start Date</h3>
                                                                            <h3 style="font-size:12px;">02/11/1990</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5 col-sm-12 col-xs-12 padding-null">
                                                                        <div class="profile__header">
                                                                            <h3 style="font-size:14px;">End Date</h3>
                                                                            <h3 style="font-size:12px;">02/11/1995</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 col-xs-12 action-icon reminder-action-icon padding-null">
                                                                        <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""></i></a>
                                                                        <a href="#"><i class="fa fa-chevron-circle-down" data-toggle="tooltip" data-title="View More" data-original-title="" title=""></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="padding-null two box-filter">
                                                            <div>
                                                                <div class="container-fluid mg-team-header">
                                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                                        <div class="profile__header">
                                                                            <h3 style="font-size:17px;">Dr.Bharathi  MBBS , FRCS</h3>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                                        <div class="profile__header">
                                                                            <h3 style="font-size:17px;">General Practitioner</h3>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                                        <div class="profile__header">
                                                                            <h3 style="font-size:17px;">Status <i class="fa fa-check customer-details-active" data-toggle="tooltip" data-title="Active now" aria-hidden="true" data-original-title="" title=""></i></h3>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="x_panel">
                                                                    <div class="col-md-4 col-sm-12 col-xs-12 padding-null">
                                                                        <div class="profile__avatar-2 ">
                                                                            <img src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/4.jpg" alt="...">
                                                                        </div>
                                                                        <div class="profile__header">
                                                                            <h3 style="font-size:17px;"><small style="color:blue;"> Female</small></h3>
                                                                            <p class="text-muted text-cus">
                                                                                <strong>Age:</strong> 23 &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <strong>DOB:</strong> 12/01/1990
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2 col-sm-12 col-xs-12 ">
                                                                        <div class="profile__header">
                                                                            <h3 style="font-size:14px;">Prof Reg No</h3>
                                                                            <p class="text-muted text-cus">
                                                                                <strong>GMC0987654321 </strong><br /><small style="color:red;"> (Expiry Date 19-08-2019)</small>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12 col-xs-12 padding-null">
                                                                        <div class="col-md-5 col-sm-12 col-xs-12 padding-null">
                                                                            <div class="profile__header">
                                                                                <h3 style="font-size:14px;">Start Date</h3>
                                                                                <h3 style="font-size:12px;">02/11/1990</h3>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-5 col-sm-12 col-xs-12 padding-null">
                                                                            <div class="profile__header">
                                                                                <h3 style="font-size:14px;">End Date</h3>
                                                                                <h3 style="font-size:12px;">02/11/1995</h3>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 col-xs-12 action-icon reminder-action-icon padding-null">
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-chevron-circle-down" data-toggle="tooltip" data-title="View More" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="padding-null three box-filter">
                                                            <div>
                                                                <div class="container-fluid mg-team-header">
                                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                                        <div class="profile__header">
                                                                            <h3 style="font-size:17px;">Miss.Krishna Veni  Bsc <small>(Nursing)</small></h3>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                                        <div class="profile__header">
                                                                            <h3 style="font-size:17px;">Nurse</h3>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                                        <div class="profile__header">
                                                                            <h3 style="font-size:17px;">Status <i class="fa fa-check customer-details-active" data-toggle="tooltip" data-title="Active now" aria-hidden="true" data-original-title="" title=""></i></h3>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="x_panel">
                                                                    <div class="col-md-4 col-sm-12 col-xs-12 padding-null">
                                                                        <div class="profile__avatar-2 ">
                                                                            <img src="https://wrappixel.com/demos/admin-templates/pixeladmin/plugins/images/users/6.jpg" alt="...">
                                                                        </div>
                                                                        <div class="profile__header">
                                                                            <h3 style="font-size:17px;"><small style="color:blue;"> Female</small></h3>
                                                                            <p class="text-muted text-cus">
                                                                                <strong>Age:</strong> 23 &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <strong>DOB:</strong> 12/01/1990
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2 col-sm-12 col-xs-12 ">
                                                                        <div class="profile__header">
                                                                            <h3 style="font-size:14px;"></h3>
                                                                            <p class="text-muted text-cus">
                                                                                
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12 col-xs-12 padding-null">
                                                                        <div class="col-md-5 col-sm-12 col-xs-12 padding-null">
                                                                            <div class="profile__header">
                                                                                <h3 style="font-size:14px;">Start Date</h3>
                                                                                <h3 style="font-size:12px;">02/11/1990</h3>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-5 col-sm-12 col-xs-12 padding-null">
                                                                            <div class="profile__header">
                                                                                <h3 style="font-size:14px;">End Date</h3>
                                                                                <h3 style="font-size:12px;">02/11/1995</h3>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2 col-xs-12 action-icon reminder-action-icon padding-null">
                                                                            <a href="#"><i class="fa fa-pencil-square" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""></i></a>
                                                                            <a href="#"><i class="fa fa-chevron-circle-down" data-toggle="tooltip" data-title="View More" data-original-title="" title=""></i></a>
                                                                        </div>
                                                                    </div>
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
                    </div>
                </form>
            </div>
            <!-- /page content -->
            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    &copy; 2017 All Rights Reserved. <a target="_blank" href="https://coraltechnologies.co.uk/"> Coral Technologies </a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/menu-js.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/graph/jquery.canvasjs.min.js"></script>
    <script>
        jQuery(document).ready(function ($) {

            $("#patient-result").hide();
            $("#patient-search-btn").on("click", function () {
                $("#patient-result").show();
            });
            $(".hide-panel").on("click", function () {
                $("#patient-result").hide();
            });

            // New Imms-vacs page Add & Remove Section //

            $("#add-more").click(function () {
                var html = $(".copy-fields").html();
                $(".after-add-more").after(html);
            });
            //here it will remove the current value of the remove button which has been pressed
            $("body").on("click", ".remove", function () {
                $(this).parents(".control-group").remove();
            });

        });

    </script>
    <script type="text/javascript">
      /*  $(document).ready(function () {
            $("select").change(function () {
                $(this).find("option:selected").each(function () {
                    var optionValue = $(this).attr("value");
                    if (optionValue) {
                        $(".box-filter").not("." + optionValue).hide();
                        $("." + optionValue).show();
                    } else {
                        $(".box-filter").show();
                    }
                });
            }).change();
		});
	/*	$(document).ready(function(){
			<?php 
			if(isset($search_key)){
			?>
				$('html, body').animate({
					scrollTop: $("#container_<?php echo $search_key; ?>").offset().top
				}, 2000);
			<?php
			} 
			?>
		});*/
		
		function team_member_search(){
			var search_name			= $("#search_name").val();
			var search_status		= $("#search_status").val();			
			var search_role			= $("#role").val();
			var url					= "<?php echo base_url() ?>team_setup/search_members";
			 $.post(url,{name:search_name,status:search_status,role:search_role},function(data){
				 
				if(data['response'].trim()	== 'success'){
					$("#ajax_load").html(data['content'].trim());
					$("#count_id").html(data['data_count']);
				}else{
					alert('Please try after sometime..');
				}

			},'json');
		}
		function change_status(a,b){
			var user_div						= $("#status_"+b)
			var	x								= false;
			if(user_div.attr('data-original-title')	=='Active now'){
				x =confirm('Are you sure do you want deactivate this user ?');
			}else{
				x =confirm('Are you sure do you want activate this user ?');
			}
			if(x ==true){
				var url					= "<?php echo base_url() ?>team_setup/change_status";
				 $.post(url,{a:a},function(data){
					if(data['response'].trim()	== 'success'){
						if(data['status'].trim() =='active'){
							$("#status_"+b).css('color','#559900');
							$("#status_"+b).attr('data-original-title','Active now');
						}else if(data['status'].trim() =='inactive'){
							$("#status_"+b).css('color','#ff0000');
							$("#status_"+b).attr('data-original-title','Inactive now');
						}
					}else{
						alert('Please try after sometime..');
					}
				},'json');	
			}
		}
		
		
    </script>
 
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
									<h3 style="font-size:17px;" onclick="change_status('<?php echo $this->encryptionfunction->enCrypt($prof_val['primary_id']);  ?>')">Status <i class="fa fa-check customer-details-active" data-toggle="tooltip"   aria-hidden="true" data-original-title="" title="Active now" id="status_<?php echo $this->encryptionfunction->enCrypt($prof_val['primary_id']);  ?>"></i></h3>
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
	</div>

  
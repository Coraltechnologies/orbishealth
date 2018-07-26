    <link href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet">
	
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
			
	        <div class="container navigation">
			
	            <div class="navbar-header page-scroll">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
	                    <i class="fa fa-bars"></i>
	                </button>
	                <a class="navbar-brand" href="<?php echo base_url(); ?>">
	                    <img src="<?php echo base_url(); ?>assets/img/logo.png" alt="" width="230" height="52" />
	                </a>
	            </div>

	            <!-- Collect the nav links, forms, and other content for toggling -->
	            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
				  <ul class="nav navbar-nav">
					<li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
	                <li><a href="#">Patients</a></li>
					<li><a href="#">Professionals</a></li>							
					<li><a href="#">Practice</a></li>
  					<li class="btn btn-xs btn-success dropdown login-dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-lock"></span> Login / Signup <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><div class="mb5"><a href="<?php echo base_url(); ?>page/index/patient-reg"><button class="btn-md btn-success login-menu btn-block">&nbsp; PATIENTS &nbsp;</button></a></div></li>
							<li><div  class="mb5"><a href="<?php echo base_url(); ?>page/index/professional-reg"><button class="btn-md btn-success login-menu btn-block">&nbsp; PROFESSIONALS  &nbsp;</button></a></div></li>
							<li><div class="mb5"><a href="<?php echo base_url(); ?>page/index/practice-reg"><button class="btn-md btn-success login-menu btn-block">&nbsp; PRACTICE &nbsp;</button></a></div></li>
						</ul>
	                </li>
				  </ul>
	                
	            </div>
	            <!-- /.navbar-collapse -->
	        </div>
	        <!-- /.container -->
	    </nav>

	
	<section  class="home-section">
	<div class="container">
	<div class="row">
	
	<div class="col-sm-6 col-md-6 col-xs-12">
	
	<div id="container_demo" >
		 <?php if($this->session->flashdata('login_failed')){ ?>
			<div  class="panel panel-default reg-suc-content">
				<div class="panel-body" style="padding: 10px 20px;">
					<h3 class="panel-title" style="color: red; font-size:15px;"> <?php echo $this->session->flashdata('login_failed') ?></h3>
				</div>
			</div>
		<?php } ?>
		
		
		<?php if(isset($activation_status) && $activation_status == 'success') { ?>
			<div class="panel panel-default reg-suc-content" >
				<div class="panel-body" style="padding: 10px 20px;">
					<h3 class="panel-title" style="color: forestgreen; font-size:15px;"><img src="<?php echo base_url(); ?>assets/icons/tick-circle.png"> <?php echo $activation_msg ?></h3>
				</div>
			</div>
		<?php }else if(isset($activation_status) && ($activation_status == 'fail' || $activation_status == 'exist' || $activation_status == 'expired')){ ?>
			<div  class="panel panel-default reg-suc-content">
				<div class="panel-body" style="padding: 10px 20px;">
					<h3 class="panel-title" style="color: red; font-size:15px;">  <?php echo $activation_msg ?></h3>
				</div>
			</div>
		<?php } ?>
		
		
		<?php if(isset($register) && $register == 1) { ?>
			<div class="panel panel-default reg-suc-content" >
				<div class="panel-body" style="padding: 10px 20px;">
					<h3 class="panel-title" style="color: forestgreen; font-size:15px;"><img src="<?php echo base_url(); ?>assets/icons/tick-circle.png">  Register Success! Please check your email for login credentials.</h3>
				</div>
			</div>
		<?php }else if(isset($register) && $register == 'exist') { ?>
			<div  class="panel panel-default reg-suc-content">
				<div class="panel-body" style="padding: 10px 20px;">
					<h3 class="panel-title" style="color: red; font-size:15px;"> EmailId is already exists! Please try again</h3>
				</div>
			</div>
		<?php }else if(isset($register) && $register == 'invalid') { ?>
			<div class="panel panel-default reg-suc-content" >
				<div class="panel-body" style="padding: 10px 20px;">
					<h3 class="panel-title" style="color: red;font-size:15px;"> Entered details format is invalid..</h3>
				</div>
			</div>
		<?php }else if(isset($register) && $register == 0) { ?>
			<div class="panel panel-default reg-suc-content" >
				<div class="panel-body" style="padding: 10px 20px;">
					<h3 class="panel-title" style="color: red;font-size:15px;"> Please try after sometime.</h3>
				</div>
			</div>
		<?php } ?>
		<!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
		<a class="hiddenanchor" id="toregister"></a>
		<a class="hiddenanchor" id="tologin"></a>
		<div id="wrapper">
			<div id="login" class="animate form abpos">
				<form  action="<?php echo base_url(); ?>page/login/professional-reg" autocomplete="on" method="POST" id="login_form"> 
					<h1>Log in as Professional</h1>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 form-group mb5 clearfix"><p> 
							<label for="username" class="uname" > User Id</label>
							<input id="username" name="username" required="required" type="text" placeholder="567870"/>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 form-group mb5 clearfix"><p> 
							<label for="password" class="youpasswd"> Password </label>
							<input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
						</div>
					</div>
					<div class="row">
						<p class="keeplogin col-md-12 col-sm-12 col-xs-12 form-group mb5 clearfix"> 
							<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
							<label for="loginkeeping">Keep me logged in</label>
						</p>
					</div>
					
					<p class="login button"> 
					 <a  href="#" style="color:#fff; float:left; left:0px; text-decoration:underline; ">Forgot Password ?</a>    <input type="submit" value="Login" /> 
					</p>
					<p class="change_link">
						Not a member yet ?
						<a href="#" class="to_register">Join us</a>
					</p>
				</form>
			</div>

			<div id="register" class="animate form">
				<form  action="#" autocomplete="on" method="POST" id="register_form"> 
					<h1> Sign up as Professional</h1> 
					<div class="row">      
						<div class="col-md-6 col-sm-6 col-xs-12 form-group mb5 clearfix"> 
							<label for="userfnamesignup" class="uphone" >First Name</label>
							<input id="usernamesignup" name="ForeName" required="required" type="text" placeholder="First Name" />
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 form-group mb5 clearfix">
							<label for="userlnamesignup" class="uphone" >Last Name</label>
							<input id="userlnamesignup" name="LastName" required="required" type="text" placeholder="Last Name" />
						</div>
					</div>
					<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12 form-group mb5 clearfix"> 
						<label for="emailsignup" class="youmail" >Professional Type</label>
						<?php
						$attr	=array('class'=>'form-control');
						echo form_dropdown('ProfessionalType', $prof_body,'',$attr); ?>
					   <!-- <input id="emailsignup" name="EmailId" required="required" type="email" placeholder="mysupermail@mail.com"/> -->
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12 form-group mb5 clearfix"> 
						<label for="userphonesignup" class="uphone" >Email</label>
						<input id="emailsignup" name="EmailId" required="required" type="text" placeholder="sample@mail.com"/>
						<!--<input id="userphonesignup" name="Phone" required="required" type="text" placeholder="mysupermail@mail.com" />-->
					</div>
					</div>
					<div class="row">   
					<div class="col-md-6 col-sm-6 col-xs-12 form-group mb5 clearfix"> 
						<label for="passwordsignup" class="youpasswd" >Country</label>
						<?php
							$attr	=array('class'=>'form-control','onchange'=>'country_change(this);','required'=>'required');
							echo form_dropdown('Country', $country['name'],'',$attr);
						?>
						
						<input type="hidden" name="UserType" value="<?php echo $this->config->item('professional'); ?>" /> 
					   <!-- <input id="passwordsignup" name="Password" required="required" type="password" placeholder="eg. X8df!90EO"/>-->
				   </div>
					<div class="col-md-6 col-sm-6 col-xs-12 form-group mb5 clearfix"> 
						<label for="passwordsignup_confirm" class="youpasswd" >Phone</label>
						<input id="userphonesignup" name="Mobile" required="required" type="text" placeholder="+44 000 000" />
					   <!-- <input id="passwordsignup_confirm" name="ConfirmPassword" required="required" type="password" placeholder="eg. X8df!90EO"/>-->
					</div>
					</div>
					<p class="signin button "> 
						<input type="checkbox" id="accept_terms" value="" style="width: 20px;" required> I accept the <a href="#" style="color:#000; text-decoration: underline;">terms & conditions</a> &nbsp;&nbsp; <input type="submit" value="Sign up"/> 
					</p>
					
					 
					<p class="change_link">  
						Already a member ?
						<a href="#tologin" class="to_register"> Log in </a>
					</p>
					
				</form>
			</div>
			
		</div>
	</div>  
           
	
	
	
	</div>
	
	<div class="col-sm-6 col-md-6 col-xs-12">
	<br/>
	<h5>Create account in a minute time</h5>
	<ul class="list-group">
	<li class="list-group-item"><span class="fa fa-hand-o-right"></span> Step easy account setup</li>
	<li class="list-group-item"><span class="fa fa-hand-o-right"></span> Verify your email after New account Signup</li>
	<li class="list-group-item"><span class="fa fa-hand-o-right"></span> Book & Manage Appointments</li>
	<li class="list-group-item"><span class="fa fa-hand-o-right"></span> Multiple Booking options</li>
	<li class="list-group-item"><span class="fa fa-hand-o-right"></span> Manage Patient details online</li>
	</ul>
	</div>
	</div>
	</div>
	</section>
	
	
	
	<script>
	function country_change(a){
		var url		= "<?php echo base_url(); ?>page/country_select";
		var code	= $(a).val();
		if(code.trim() == ''){
			$("#userphonesignup").val('');
		}else{
			$.post(url,{code : code},function(response){
				response	=response.trim();
				if(response != ''){
					$("#userphonesignup").val(response);
				}
			});
		}
	}
	</script>
	<script src="<?php echo base_url(); ?>assets/js/professional-reg.js"></script>
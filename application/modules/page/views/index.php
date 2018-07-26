				<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
					<div class="container navigation">
						<div class="navbar-header page-scroll">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
								<i class="fa fa-bars"></i>
							</button>
							<a class="navbar-brand" href="index.html">
								<img src="<?php echo base_url(); ?>assets/img/logo.png" alt="" width="230" height="52" class="img-responsive"/>
							</a>
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
							<ul class="nav navbar-nav">
								<li class="active">
									<a href="<?php echo base_url(); ?>">Home</a>
								</li>
								<li>
									<a href="#">Patients</a>
								</li>
								<li>
									<a href="#">Professionals</a>
								</li>
								<li>
									<a href="#">Practice</a>
								</li>
								<li class="btn btn-xs btn-success dropdown" style="border-radius:0px; margin-top: 8px;">
									<a href="#" class="dropdown-toggle" style="color:#fff; width:182px; padding:5px;" data-toggle="dropdown">
										<span class="fa fa-lock"></span> Login / Signup 
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li>
											<div style="margin-bottom: 5px;">
												<a href="<?php echo base_url(); ?>page/index/patient-reg">
													<button class="btn-md btn-success" style="padding:3px 10px; border-radius:0px; width:150px;">&nbsp; PATIENTS &nbsp;</button>
												</a>
												</div>
												</li>
												<li>
													<div  style="margin-bottom: 5px;">
														<a href="<?php echo base_url(); ?>page/index/professional-reg">
															<button class="btn-md btn-success" style="padding:3px 5px; border-radius:0px; width:150px">&nbsp; PROFESSIONALS  &nbsp;</button>
														</a>
														</div>
														</li>
														<li>
															<div style="margin-bottom: 5px;">
																<a href="<?php echo base_url(); ?>page/index/practice-reg">
																	<button class="btn-md btn-success" style="padding:3px 10px; border-radius:0px; width:150px;">&nbsp; PRACTICE &nbsp;</button>
																</a>
																</div>
																</li>
															</ul>
														</li>
													</ul>
												</div>
												<!-- /.navbar-collapse -->
											</div>
											<!-- /.container -->
										</nav>
										<!-- Section: intro -->
										<section id="intro" class="intro">
											<div class="intro-content">
												<div class="container">
													<div class="row">
														<div class="col-lg-12 col-sm-12">
															<nav class="nav navbar-default" role="navigation">
																<div class="nav navbar-collapse">
																	<button type="button" class="navbar-toggle service-toggle" data-toggle="collapse" data-target="#collapse">
																		<span class="sr-only">Toggle navigation</span>
																		<span class="icon-bar"></span>
																		<span class="icon-bar"></span>
																		<span class="icon-bar"></span>
																		<span class="icon-bar"></span>
																		<span class="icon-bar"></span>
																		<span class="servicetext">service</span>
																	</button>
																</div>
																<div class="collapse navbar-collapse servicenavbar" id="collapse">
																	<ul class="nav navbar-nav nav1 navbar">
																		<li class="dropdown nav navbar-nav show-on-hover">
																			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																				<center>
																					<span>
																						<img src="<?php echo base_url(); ?>assets/icons/stethoscope.png" class="img-responsive"/>
																					</span>
																				</center>
																				<span class="font-head">GP</span>
																				<span class="caret"></span>
																			</a>
																			<ul class="dropdown-menu text-right" role="menu">
																				<li class="dropdown-header">Select All</li>
																				<li>
																					<a href="#">General Practitioner</a>
																				</li>
																				<li>
																					<a href="#">General Physician</a>
																				</li>
																			</ul>
																		</li>
																		<li class="dropdown dropdown-large  show-on-hover">
																			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																				<center>
																					<span >
																						<img src="<?php echo base_url(); ?>assets/icons/special.png" class="img-responsive"/>
																					</span>
																				</center>
																				<span class="font-head">SPECIALIST</span>
																				<span class="caret"></span>
																			</a>
																			<ul class="dropdown-menu dropdown-menu-large row">
																			
																				<li class="col-lg-3 col-md-3 col-sm-6">
																					<ul>
																						<li class="dropdown-header">Select All</li>
																						<li class="dropdown-header1">Bones and Joints</li>
																						<li>
																							<a href="o_mobl.aspx">Orthopaedics</a>
																						</li>
																						<li>
																							<a href="o_miz.aspx">Rheumatology</a>
																						</li>
																						<li>
																							<a href="c_sandali.aspx">Spinal Surgeon</a>
																						</li>
																						<li class="dropdown-header1">Common Surgical Conditions</li>
																						<li>
																							<a href="c_sandali.aspx">Surgery – General</a>
																						</li>
																						<li class="dropdown-header1">Common Medical Conditions</li>
																						<li>
																							<a href="s_sandali.aspx">Medicine – General</a>
																						</li>
																						<li class="dropdown-header1">Kidneys / Bladder / Prostrate</li>
																						<li>
																							<a href="g_sandali.aspx">Urology</a>
																						</li>
																						<li>
																							<a href="fil.aspx">Nephrology</a>
																						</li>
																						<li class="dropdown-header1">Ears/ Nose / Throat / Head / Neck Problems</li>
																						<li>
																							<a href="lib.aspx">ENT</a>
																						</li>
																						<li>
																							<a href="f_mobl.aspx">Head & Neck Surgeon</a>
																						</li>
																						<li class="dropdown-header1">Eye & Laser surgery</li>
																						<li>
																							<a href="tablo.aspx">Ophthalmology</a>
																						</li>
																					</ul>
																				</li>
																				<li class="col-lg-3 col-md-3 col-sm-6">
																					<ul>
																						<li class="dropdown-header1">Children`s Conditions</li>
																						<li>
																							<a href="tablo.aspx">Paediatrics General</a>
																						</li>
																						<li>
																							<a href="tablo.aspx">Paediatric Cardiology</a>
																						</li>
																						<li>
																							<a href="taghiz.aspx">Paediatric Neurology</a>
																						</li>
																						<li>
																							<a href="nimkat.aspx">Paediatric Surgery</a>
																						</li>
																						<li>
																							<a href="tabore.aspx">Paediatric Orthopaedics</a>
																						</li>
																						<li class="dropdown-header1">Heart and Blood Vessel</li>
																						<li>
																							<a href="tabore.aspx">Cardiology</a>
																						</li>
																						<li>
																							<a href="tabore.aspx">Cardiothoracic Surgery</a>
																						</li>
																						<li class="boldh">
																							<a href="#">Vascular Surgery</a>
																						</li>
																						<li class="dropdown-header1">Brain / Spine & Nerve Conditions / Stoke</li>
																						<li class="boldh">
																							<a href="ketabkhane.aspx">Neurology</a>
																						</li>
																						<li class="boldh">
																							<a href="mehmansara.aspx">Neuro Surgery</a>
																						</li>
																						<li class="dropdown-header1">Skin / Cosmetics & Scars</li>
																						<li class="boldh">
																							<a href="#">Plastic Surgery</a>
																						</li>
																						<li class="boldh">
																							<a href="#">Dermatology</a>
																						</li>
																						<li class="boldh">
																							<a href="#">Oro-Maxillofacial Surgery</a>
																						</li>
																					</ul>
																				</li>
																				<li class="col-lg-3 col-md-3 col-sm-6">
																					<ul>
																						<li class="dropdown-header1"> Mental Health</li>
																						<li class="boldh">
																							<a href="#">Psychiatry</a>
																						</li>
																						<li class="boldh">
																							<a href="#">Psychologist</a>
																						</li>
																						<li class="dropdown-header1">Abdomen / Bowel / Liver Condition</li>
																						<li class="boldh">
																							<a href="#">Gastroenterology</a>
																						</li>
																						<li>
																							<a href="tablo.aspx">Hepatology</a>
																						</li>
																						<li>
																							<a href="taghiz.aspx">Colorectal Surgery</a>
																						</li>
																						<li>
																							<a href="taghiz.aspx">Gastroenterology – Surgery</a>
																						</li>
																						<li class="dropdown-header1">Chest / Lung</li>
																						<li class="boldh">
																							<a href="#">Respiratory Medicine</a>
																						</li>
																						<li class="dropdown-header1">Diabetes / Thyroid / Gland Conditions</li>
																						<li class="boldh">
																							<a href="#">Diabetology</a>
																						</li>
																						<li class="boldh">
																							<a href="#">Endocrinology</a>
																						</li>
																						<li class="dropdown-header1">Blood and Immune Disorders</li>
																						<li class="boldh">
																							<a href="#">Hematology</a>
																						</li>
																						<li class="boldh">
																							<a href="#">Immunology</a>
																						</li>
																					</ul>
																				</li>
																				<li class="col-lg-3 col-md-3 col-sm-6">
																					<ul>
																						<li class="dropdown-header1">Cancer and Terminal Conditions</li>
																						<li class="boldh">
																							<a href="#">Oncology</a>
																						</li>
																						<li class="boldh">
																							<a href="#">Palliative Medicine</a>
																						</li>
																						<li class="dropdown-header1">Emergency Care & Anesthesia</li>
																						<li class="boldh">
																							<a href="#">Medicine – Emergency</a>
																						</li>
																						<li>
																							<a href="tablo.aspx">Anesthetics</a>
																						</li>
																						<li class="dropdown-header1">Old Age Medicine</li>
																						<li>
																							<a href="taghiz.aspx">Medicine - Geriatrics</a>
																						</li>
																						<li class="dropdown-header1">Sexual Health</li>
																						<li>
																							<a href="taghiz.aspx">Genito-Urinary Medicine</a>
																						</li>
																						<li class="dropdown-header1">Breast</li>
																						<li class="boldh">
																							<a href="#">Breast Surgery</a>
																						</li>
																						<li class="dropdown-header1">Pregnancy,Childbirth & Women Conditions</li>
																						<li class="boldh">
																							<a href="#">Obstetrics & Gynecology</a>
																						</li>
																					</ul>
																				</li>
																			</ul>
																		</li>
																		<li class="dropdown nav navbar-nav show-on-hover">
																			<a href="contact.aspx" class="dropdown-toggle" data-toggle="dropdown">
																				<center>
																					<span>
																						<img src="<?php echo base_url(); ?>assets/icons/teeth.png" class="img-responsive"/>
																					</span>
																				</center>
																				<span class="font-head">DENTIST</span>
																				<span class="caret"></span>
																			</a>
																			<ul class="dropdown-menu text-right" role="menu">
																				<li class="dropdown-header">Select All</li>
																				<li>
																					<a href="article2.aspx">Cosmetic Dentist</a>
																				</li>
																				<li>
																					<a href="article4.aspx">Endodontist</a>
																				</li>
																				<li>
																					<a href="article1.aspx">General Dentist</a>
																				</li>
																				<li>
																					<a href="article3.aspx">Orthodontist</a>
																				</li>
																				<li>
																					<a href="article5.aspx">Oral & Maxillofacial Surgeon</a>
																				</li>
																				<li>
																					<a href="article6.aspx">Periodontist </a>
																				</li>
																				<li>
																					<a href="article6.aspx">Prosthodontist </a>
																				</li>
																			</ul>
																		</li>
																		<li class="dropdown nav navbar-nav show-on-hover">
																			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																				<center>
																					<span>
																						<img src="<?php echo base_url(); ?>assets/icons/thero.png" class="img-responsive"/>
																					</span>
																				</center>
																				<span class="font-head">THERAPIST</span>
																				<span class="caret"></span>
																			</a>
																			<ul class="dropdown-menu text-right" role="menu">
																				<li class="dropdown-header">Select All</li>
																				<li>
																					<a href="article3.aspx">Acupuncture</a>
																				</li>
																				<li>
																					<a href="article2.aspx">Chiropractor</a>
																				</li>
																				<li>
																					<a href="article4.aspx">Osteopath</a>
																				</li>
																				<li>
																					<a href="article1.aspx">Physiotherapist</a>
																				</li>
																			</ul>
																		</li>
																		<li>
																			<a href="#">
																				<center>
																					<span>
																						<img src="<?php echo base_url(); ?>assets/icons/juice.png" class="img-responsive"/>
																					</span>
																				</center>
																				<span class="font-head">DIETICIAN</span>
																			</a>
																		</li>
																		<li>
																			<a href="hair.aspx">
																				<center>
																					<span>
																						<img src="<?php echo base_url(); ?>assets/icons/eye.png" class="img-responsive"/>
																					</span>
																				</center>
																				<span class="font-head">OPTICIAN</span>
																			</a>
																		</li>
																		<li class="dropdown  show-on-hover">
																			<a href="" class="dropdown-toggle" data-toggle="dropdown">
																				<center>
																					<span>
																						<img src="<?php echo base_url(); ?>assets/icons/brain.png" class="img-responsive"/>
																					</span>
																				</center>
																				<span class="font-head">MIND </span>
																				<span class="caret"></span>
																			</a>
																			<ul class="dropdown-menu text-right" role="menu">
																				<li class="dropdown-header">Select All</li>
																				<li>
																					<a href="">Psychologist</a>
																				</li>
																				<li>
																					<a href="">Psychotherapist</a>
																				</li>
																				<li>
																					<a href="">Life Coach</a>
																				</li>
																			</li>
																		</ul>
																	</li>
																	<li class="activee dropdown nav navbar-nav show-on-hover">
																		<a href="default.aspx">
																			<center>
																				<span >
																					<img src="<?php echo base_url(); ?>assets/icons/doctor.png" class="img-responsive"/>
																				</span>
																			</center>
																			<span class="font-head">VETS</span>
																		</a>
																	</li>
																	<li class="dropdown  show-on-hover">
																		<a href="default.aspx" class="dropdown-toggle" data-toggle="dropdown">
																			<center>
																				<span>
																					<img src="<?php echo base_url(); ?>assets/icons/nurse.png" class="img-responsive"/>
																				</span>
																			</center>
																			<span class="font-head">NURSES</span>
																			<span class="caret"></span>
																		</a>
																		<ul class="dropdown-menu text-right" role="menu">
																			<li class="dropdown-header">Select All</li>
																			<li>
																				<a href="">Dental Nurse</a>
																			</li>
																			<li>
																				<a href="">General</a>
																			</li>
																			<li>
																				<a href="">Palliative care</a>
																			</li>
																			<li>
																				<a href="">Vet Nurse</a>
																			</li>
																		</ul>
																	</li>
																</ul>
															</div>
														</nav>
													</div>
												</div>
											</div>
											<div class="container">
												<div class="row">
													<div class="col-lg-2"></div>
													<div class="col-lg-8">
														<div class="form-wrapper">
															<div class="wow fadeInLeft" data-wow-duration="2s" data-wow-delay="0.2s">
																<br>
																	<br>
																		<br>
																			<h3 class="display-3" align="center">Find your Heath Professional</h3>
																			<p style="text-align: center;">Search and Book Appointments</p>
																			<form action="" method="post" role="form" class="contactForm lead">
																				<div class="row">
																					<div class="col-xs-12 col-sm-12 col-md-12">
																						<div class="nav nav-justified navbar-nav search-wraper">
																							<form class="navbar-form navbar-search" role="search">
																								<div class="input-group">
																									<input type="text" class="form-control sepc" placeholder="eg : Specialist">
																										<input type="text" class="form-control place-search" placeholder="eg : Post Code / Place ">
																											<div class="input-group-btn">
																												<button type="button" class="btn btn-search btn-success">
																													<span class=" glyphicon glyphicon-search SearchIcon" ></span>
																												</button>
																											</div>
																										</div>
																										<div class="col-xs-12 col-sm-12 col-md-1"></div>
																									</form>
																								</div>
																							</div>
																						</div>
																						<div class="row">
																							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center service-type">
																								<div class="form-group">
																										<a href="search-page.html" class="btn btn-search btn-success">
																											<span class=" glyphicon glyphicon-search SearchIcon" ></span> All

																										</a>
																										<a href="search-page.html"  class="btn btn-search btn-success">
Video / Tel 
</a>
																										<a href="search-page.html"  class="btn btn-search btn-success">
Clinic
</a>
																										<a href="search-page.html" class="btn btn-search btn-success">
Hospital
</a>
																										<a href="search-page.html" class="btn btn-search btn-success">
Home Visit
</a>
																								</div>
																							</div>
																							<div class="col-xs-12 col-sm-6 col-md-2"></div>
																						</div>
																					</form>
																				</div>
																			</div>
																		</div>
																		<div class="col-lg-2"></div>
																	</div>
																</div>
																<div class="quick_btn_section">
																	<div  class="container">
																		<div class="row text-center">
																			
																				<a class="quick-btn" href="#">
																					<i class="fa fa-hospital-o fa-2x"></i>
																					<br/>
																					<span> Vaccinations</span>
																				</a>
																			
																				<a class="quick-btn" href="#">
																					<i class="fa fa-hospital-o fa-2x"></i>
																					<br/>
																					<span> Cosmetic Treatments</span>
																				</a>
																			
																				<a class="quick-btn" href="#">
																					<i class="fa fa-medkit fa-2x"></i>
																					<br/>
																					<span> Order Medications</span>
																				</a>
																			
																				<a class="quick-btn" href="#">
																					<i class="fa fa-calendar fa-2x"></i>
																					<br/>
																					<span> Book Investigations</span>
																				</a>
																			
																		</div>
																	</div>
																</div>
															</div>
														</section>
														<!-- /Section: intro -->
														<section style="height:300px;" class="home-section nopadding paddingtop-60">
															<div class="container">
																<div class="row">
																	<div class="col-sm-12 col-md-12">
																		<p>Page content will come here</p>
																	</div>
																</div>
															</div>
														</section>														
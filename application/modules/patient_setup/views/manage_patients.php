            <!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->
                <form class="form-horizontal form-label-left row">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2 class="col-md-2">Patient Search</h2>
                            <div class="col-md-8">
                                <div class="col-md-2 col-sm-9 col-xs-12 padding-null">
                                    <select class="form-control select-bg">
                                        <option>Name</option>
                                        <option>Phone</option>
                                        <option>NHS No</option>
                                    </select>
                                </div>
                                <div class="col-md-7 col-sm-9 col-xs-12 padding-null">
                                    <input type="text" class="form-control" placeholder="Search here...">
                                </div>
                                <div class="col-md-2 col-sm-9 col-xs-12 padding-null">
                                    <select class="form-control select-bg">
                                        <option>All</option>
                                        <option>Active</option>
                                        <option>Inactive</option>
                                        <option>Deceased</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12 col-xs-12 text-right">
                                <button type="button" class="btn btn-success" id="patient-search-btn" style="margin-right:0; min-width:10%;">Search</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_panel padding-null">
                            <div class="x_content">
                                <div class="x_title">
                                    <h2>Patient's List</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered patient-result table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 2%;">S.No</th>
                                                <th style="width: 20%;">Name , DOB &amp; NHS No</th>
                                                <th style="width: 23%;">Address</th>
                                                <th style="width: 15%;">Preferred doctor</th>
                                                <th class="text-center" style="width: 10%;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            <?php
                                            //echo "<pre>";
                                            //print_r($patient_details);
                                            $i                  = 1;
                                            if(!empty($patient_details)){ 
                                                foreach($patient_details as $p_key => $p_val){
                                                    $p_val          = (array)$p_val;
                                                ?>
                                                <tr>
                                                    <td class="text-center"><span><?php echo $i ?></span></td>
                                                    <td>
                                                        <span><a href="<?php echo base_url()."patient_setup/patients_summary/".$this->encryptionfunction->enCrypt($p_val['user_id']) ?>"><?php echo ucfirst($p_val['title'].' '.$p_val['firstname'].' '.$p_val['lastname']).' ('.$p_val['gender'].')'; ?></a></span>
                                                        <span><?php echo date('d/m/Y',strtotime($p_val['dob'])); ?></span>
                                                        <span>
                                                            <?php
                                                                if($p_val['nhs_no']){
                                                                    echo $p_val['nhs_no'];
                                                                }
                                                            ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span><?php  if($p_val['address']){echo $p_val['address'].'<br>'; } ?></span>
                                                        <span>
                                                              <?php
                                                                if($p_val['city_town']){
                                                                    echo $p_val['city_town'].', ';
                                                                }
                                                                if($p_val['state']){
                                                                    echo $p_val['state'].' - ';
                                                                }
                                                                 if($p_val['postcode']){
                                                                    echo $p_val['postcode'];
                                                                }
                                                                
                                                            ?>
                                                        </span>
                                                        <span class="patient-ct"><i class="fa fa-mobile-phone"></i> <?php if($p_val['mobile']){ echo $p_val['mobile'];} ?></span>
                                                        <span class="patient-ct"><?php if($p_val['work_telephone']){ ?><i class="fa fa-phone"></i><?php  echo $p_val['work_telephone'];} ?></span>
                                                        <span class="patient-ct"><i class="fa fa-envelope"></i><?php if($p_val['primary_email']){ echo $p_val['primary_email'];} ?><i class="fa fa-check-circle" data-toggle="tooltip" data-title="Primary email" data-original-title="" title=""></i></span>
                                                        <span class="patient-ct"><?php if($p_val['secondary_email']){ ?><i class="fa fa-envelope"></i> <?php echo $p_val['secondary_email'];} ?></span>
                                                    </td>
                                                    <td>
                                                        <!--<span>Dr. John Doe</span>
                                                        <span>Clinic Name</span>
                                                        <span>London</span>-->
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="patient-action" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""><a href="<?php echo base_url(); ?>patient_setup/index/<?php echo $this->encryptionfunction->enCrypt($p_val['user_id']); ?>" data-toggle="modal"><i class="fa fa-pencil-square"></i></a></span>
                                                        <span class="patient-action"><a href="#" data-toggle="tooltip" data-title="Book Appointment" data-original-title="" title=""><i class="fa fa-calendar-plus-o"></i></a></span>
                                                        <span class="patient-status" data-toggle="tooltip" data-title="Active" data-original-title="" title=""><i class="fa fa-check-square"></i></span>
                                                        <span class="patient-status blue" data-toggle="tooltip" data-title="Info" data-original-title="" title=""><a href="#patient-info-modal" data-toggle="modal"><i class="fa fa-info-circle"></i></a></span>
                                                    </td>
                                                </tr>
                                                
                                                
                                                <?php
                                                $i++;
                                                }
                                            }else{
                                                ?>
                                                 <tr>
                                                    <td class="text-center" colspan="5">No records found...</td>
                                                 </tr>
                                                <?php
                                            }
                                            ?>
                                            
                                            
                                            
                                            <!--<tr>
                                                <td class="text-center"><span>1</span></td>
                                                <td>
                                                    <span>Mr.Williamson (Male)</span>
                                                    <span>02/01/1975</span>
                                                    <span>12345</span>
                                                </td>
                                                <td>
                                                    <span>123, Street name,</span>
                                                    <span>City name, State - 12345</span>
                                                    <span class="patient-ct"><i class="fa fa-mobile-phone"></i> +01234567890</span>
                                                    <span class="patient-ct"><i class="fa fa-phone"></i> +01234567890</span>
                                                    <span class="patient-ct"><i class="fa fa-envelope"></i> williamson@gmail.com <i class="fa fa-check-circle" data-toggle="tooltip" data-title="Primary email" data-original-title="" title=""></i></span>
                                                    <span class="patient-ct"><i class="fa fa-envelope"></i> williamson2@gmail.com</span>
                                                </td>
                                                <td>
                                                    <span>Dr. John Doe</span>
                                                    <span>Clinic Name</span>
                                                    <span>London</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="patient-action" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""><a href="http://178.238.139.243/OrbisHealth_Sabari/patients-summary.html" data-toggle="modal"><i class="fa fa-pencil-square"></i></a></span>
                                                    <span class="patient-action"><a href="#" data-toggle="tooltip" data-title="Book Appointment" data-original-title="" title=""><i class="fa fa-calendar-plus-o"></i></a></span>
                                                    <span class="patient-status" data-toggle="tooltip" data-title="Active" data-original-title="" title=""><i class="fa fa-check-square"></i></span>
                                                    <span class="patient-status blue" data-toggle="tooltip" data-title="Info" data-original-title="" title=""><a href="#patient-info-modal" data-toggle="modal"><i class="fa fa-info-circle"></i></a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><span>2</span></td>
                                                <td>
                                                    <span>Mr.David Warner (Male)</span>
                                                    <span>02/01/1975</span>
                                                    <span>12345</span>
                                                </td>
                                                <td>
                                                    <span>123, Street name,</span>
                                                    <span>City name, State - 12345</span>
                                                    <span class="patient-ct"><i class="fa fa-mobile-phone"></i> +01234567890</span>
                                                    <span class="patient-ct"><i class="fa fa-phone"></i> +01234567890</span>
                                                    <span class="patient-ct"><i class="fa fa-envelope"></i> david@gmail.com <i class="fa fa-check-circle" data-toggle="tooltip" data-title="Primary email" data-original-title="" title=""></i></span>
                                                    <span class="patient-ct"><i class="fa fa-envelope"></i> david_warner@yahoo.in</span>
                                                </td>
                                                <td>
                                                    <span>Dr. John Doe</span>
                                                    <span>Clinic Name</span>
                                                    <span>London</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="patient-action" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""><a href="http://178.238.139.243/OrbisHealth_Sabari/patients-summary.html" data-toggle="modal"><i class="fa fa-pencil-square"></i></a></span>
                                                    <span class="patient-action"><a href="#" data-toggle="tooltip" data-title="Book Appointment" data-original-title="" title=""><i class="fa fa-calendar-plus-o"></i></a></span>
                                                    <span class="patient-status" data-toggle="tooltip" data-title="Active" data-original-title="" title=""><i class="fa fa-check-square"></i></span>
                                                    <span class="patient-status blue" data-toggle="tooltip" data-title="Info" data-original-title="" title=""><a href="#patient-info-modal" data-toggle="modal"><i class="fa fa-info-circle"></i></a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><span>3</span></td>
                                                <td>
                                                    <span>Mr.Jadan Smith (Male)</span>
                                                    <span>02/01/2002</span>
                                                    <span>12325</span>
                                                </td>
                                                <td>
                                                    <span>123, Street name,</span>
                                                    <span>City name, State - 12345</span>
                                                    <span class="patient-ct"><i class="fa fa-mobile-phone"></i> +01234567890</span>
                                                    <span class="patient-ct"><i class="fa fa-phone"></i> +01234567890</span>
                                                    <span class="patient-ct"><i class="fa fa-envelope"></i> jadan@gmail.com <i class="fa fa-check-circle" data-toggle="tooltip" data-title="Primary email" data-original-title="" title=""></i></span>
                                                    <span class="patient-ct"><i class="fa fa-envelope"></i> jadansmithr@yahoo.in</span>
                                                </td>
                                                <td>
                                                    <span>Dr. John Doe</span>
                                                    <span>Clinic Name</span>
                                                    <span>London</span>
                                                </td>

                                                <td class="text-center">
                                                    <span class="patient-action" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""><a href="http://178.238.139.243/OrbisHealth_Sabari/patients-summary.html" data-toggle="modal"><i class="fa fa-pencil-square"></i></a></span>
                                                    <span class="patient-action"><a href="#" data-toggle="tooltip" data-title="Book Appointment" data-original-title="" title=""><i class="fa fa-calendar-plus-o"></i></a></span>
                                                    <span class="patient-status" data-toggle="tooltip" data-title="Active" data-original-title="" title=""><i class="fa fa-check-square"></i></span>
                                                    <span class="patient-status blue" data-toggle="tooltip" data-title="Info" data-original-title="" title=""><a href="#patient-info-modal" data-toggle="modal"><i class="fa fa-info-circle"></i></a></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><span>4</span></td>
                                                <td>
                                                    <span>Mr.David Warner (Male)</span>
                                                    <span>02/01/1975</span>
                                                    <span>12345</span>
                                                </td>
                                                <td>
                                                    <span>123, Street name,</span>
                                                    <span>City name, State - 12345</span>
                                                    <span class="patient-ct"><i class="fa fa-mobile-phone"></i> +01234567890</span>
                                                    <span class="patient-ct"><i class="fa fa-phone"></i> +01234567890</span>
                                                    <span class="patient-ct"><i class="fa fa-envelope"></i> david@gmail.com <i class="fa fa-check-circle" data-toggle="tooltip" data-title="Primary email" data-original-title="" title=""></i></span>
                                                    <span class="patient-ct"><i class="fa fa-envelope"></i> david_warner@yahoo.in</span>
                                                </td>
                                                <td>
                                                    <span>Dr. John Doe</span>
                                                    <span>Clinic Name</span>
                                                    <span>London</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="patient-action" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""><a href="http://178.238.139.243/OrbisHealth_Sabari/patients-summary.html" data-toggle="modal"><i class="fa fa-pencil-square"></i></a></span>
                                                    <span class="patient-status orange" data-toggle="tooltip" data-title="Inactive" data-original-title="" title=""><i class="fa fa-close"></i></span>
                                                    <span class="patient-status blue" data-toggle="tooltip" data-title="Info" data-original-title="" title=""><a href="#patient-info-modal" data-toggle="modal"><i class="fa fa-info-circle"></i></a></span>
                                                    <!--<span class="patient-action"><a href="#" data-toggle="tooltip" data-title="Book Appointment"><i class="fa fa-calendar-plus-o"></i></a></span>
                    <span class="patient-action" data-toggle="tooltip" data-title="Info"><a href="#patient-info-modal" data-toggle="modal"><i class="fa fa-info-circle"></i></a></span> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center"><span>5</span></td>
                                                <td>
                                                    <span>Mr.Jadan Smith (Male)</span>
                                                    <span>02/01/1980</span>
                                                    <span>12315</span>
                                                </td>
                                                <td>
                                                    <span>123, Street name,</span>
                                                    <span>City name, State - 12345</span>
                                                    <span class="patient-ct"><i class="fa fa-mobile-phone"></i> +01234567890</span>
                                                    <span class="patient-ct"><i class="fa fa-phone"></i> +01234567890</span>
                                                    <span class="patient-ct"><i class="fa fa-envelope"></i> david@gmail.com <i class="fa fa-check-circle" data-toggle="tooltip" data-title="Primary email" data-original-title="" title=""></i></span>
                                                    <span class="patient-ct"><i class="fa fa-envelope"></i> david_warner@yahoo.in</span>
                                                </td>
                                                <td>
                                                    <span>Dr. John Doe</span>
                                                    <span>Clinic Name</span>
                                                    <span>London</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="patient-action" data-toggle="tooltip" data-title="Edit" data-original-title="" title=""><a href="http://178.238.139.243/OrbisHealth_Sabari/patients-summary.html" data-toggle="modal"><i class="fa fa-pencil-square"></i></a></span>
                                                    <span class="patient-status red" data-toggle="tooltip" data-title="Deceased" data-original-title="" title=""><i class="fa fa-eye-slash"></i></span>
                                                    <span class="patient-status blue" data-toggle="tooltip" data-title="Info" data-original-title="" title=""><a href="#patient-info-modal" data-toggle="modal"><i class="fa fa-info-circle"></i></a></span>
                                                    <!--<span class="patient-action"><a href="#" data-toggle="tooltip" data-title="Book Appointment"><i class="fa fa-calendar-plus-o"></i></a></span>
                    <span class="patient-action" data-toggle="tooltip" data-title="Info"><a href="#patient-info-modal" data-toggle="modal"><i class="fa fa-info-circle"></i></a></span>
                                                </td>
                                            </tr>-->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <!-- /top tiles -->
            </div>
            <!-- /page content -->            
        </div>
    </div>

    <!-- jQuery -->

    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>
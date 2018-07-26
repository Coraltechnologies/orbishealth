<?php
/**
 * Major user roles
 * 1:Professional
 * 2:Medical Practice
 * 3:Patient
 * 
 * */
$userType       = $this->acl->hasUserType();

$userTypeData   = 0;
if($userType != 0){
   $userTypeData = $userType;
}
?>
<?php if($userTypeData == $this->config->item('professional')){ ?>
<?php $this->load->view('template/header_professional'); ?>
<?php } else if($userTypeData == $this->config->item('medical_practice')){ ?>
<?php $this->load->view('template/header_practice'); ?>
<?php } else if($userTypeData == $this->config->item('patient')){ ?>
<?php $this->load->view('template/header_patient'); ?>
<?php } else { ?>
<?php $this->load->view('template/header'); ?>
<?php } ?>
<?php #$this->load->view("template/top_menu"); ?>
<?php #$this->load->view("template/header_2"); ?>

<?php #$this->load->view("template/left_menu"); ?>

<!-- Content Start -->
<?php echo $content ?>
<!-- Content Ends -->

<?php if($userTypeData == $this->config->item('professional')){ ?>
<?php $this->load->view("template/footer_professional"); ?>
<?php } else if($userTypeData == $this->config->item('medical_practice')){ ?>
<?php $this->load->view("template/footer_practice"); ?>
<?php } else if($userTypeData == $this->config->item('patient')){ ?>
<?php $this->load->view("template/footer_patient"); ?>
<?php } else { ?>
<?php $this->load->view("template/footer"); ?>
<?php } ?>
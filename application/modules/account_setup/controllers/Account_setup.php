<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_setup extends CI_Controller {
	
	public function __construct(){

		parent::__construct();
		$this->load->model('account_setup_model');
		$this->load->helper(array('form','url','loginvalidate'));
		$this->load->library(array('Common','EncryptionFunction','form_validation'));
	}
	function index(){		
		$reg_sucess											= 0;
		$data												= array();
		if(isset($_POST) && !empty($_POST)){
		 	$details										= $_POST['data'];
			$this->db->from('user_services');
			$this->db->where('user_id', $this->session->userdata('User')['id']);
			$get_service									= $this->db->get();
			if($get_service->num_rows() > 0){
				$this->db->where('user_id', $this->session->userdata('User')['id']);
				$this->db->delete('user_services');
			}
			foreach($details['services'] as $s_key =>$s_val){
				$ser_val									= array();
				$ser_val['user_id']							= $this->session->userdata('User')['id'];
				$ser_val['service_id']						= $s_val;
				$ser_val['created_by']						= $this->session->userdata('User')['id'];
				$ser_val['modified_by']						= $this->session->userdata('User')['id'];
				$ser_val['created_date']					= date('Y-m-d H:i:s');
				$ser_val['modified_date']					= date('Y-m-d H:i:s');
				$ser_query									= $this->db->insert('user_services', $ser_val);
			}
			foreach($details['prof_country'] as $key => $value){
				$save_details								= array();
				$save_details['user_id']					= $this->session->userdata('User')['id'];
				$save_details['country_id']					= $value;
				$this->db->from('user_professional_register_detail');
				$this->db->where($save_details);
				$exist_prof									= $this->db->get();
				if(trim($details['country_expiry'][$key]) != ''){
					$date_array								= explode('/',$details['country_expiry'][$key]);
					$temp									= $date_array[1];
					$date_array[1]							= $date_array[0];
					$date_array[0]							= $temp;
					$date_rev								= implode('/',$date_array);
				}else{
					$date_rev								= '';
				}
				if($exist_prof->num_rows()>0){
					$update_condition						= array('user_id'=>$this->session->userdata('User')['id'],'country_id'=>$value);
					$this->db->where($update_condition);
					$save_details							= array();
					$save_details['professional_id']		= $details['professional_body'][$key];
					$save_details['specialization_id']		= $details['spl_body'][$key];
					$save_details['medical_bodies_id']		= $details['country_reg_cat'][$key];
					$save_details['register_number']		= $details['country_reg_num'][$key];
					$save_details['modified_by']			= $this->session->userdata('User')['id'];
					if($date_rev !=''){
						$save_details['expiry_date']		= date('Y-m-d',strtotime($date_rev));
					}
					$save_details['modified_date']			= date('Y-m-d H:i:s');
					$this->db->update('user_professional_register_detail', $save_details);
				}else{
					$save_details['professional_id']		= $details['professional_body'][$key];
					$save_details['specialization_id']		= $details['spl_body'][$key];
					$save_details['medical_bodies_id']		= $details['country_reg_cat'][$key];
					$save_details['register_number']		= $details['country_reg_num'][$key];
					if($date_rev !=''){
						$save_details['expiry_date']		= date('Y-m-d',strtotime($date_rev));
					}
					$save_details['created_by']				= $this->session->userdata('User')['id'];
					$save_details['modified_by']			= $this->session->userdata('User')['id'];
					$save_details['created_date']			= date('Y-m-d H:i:s');
					$save_details['modified_date']			= date('Y-m-d H:i:s');
					$ins									= $this->db->insert('user_professional_register_detail', $save_details);
				}
				
				$ico_reg									= array();
				$ico_reg['user_id']							= $this->session->userdata('User')['id'];
				$ico_reg['country_id']						= $value;
				$ico_reg['other_bodies_id']					= 1;
				$this->db->from('other_bodies_register_details');
				$this->db->where($ico_reg);
				$exist_prof									= $this->db->get();
				
				if(trim($details['ico_expiry'][$key]) != ''){
					$date_array								= explode('/',$details['ico_expiry'][$key]);
					$temp									= $date_array[1];
					$date_array[1]							= $date_array[0];
					$date_array[0]							= $temp;
					$date_rev								= implode('/',$date_array);
				}else{
					$date_rev								= '';
				}
				
				if($exist_prof->num_rows()>0){
					$update_condition						= array('user_id'=>$this->session->userdata('User')['id'],'country_id'=>$value,'other_bodies_id'=>1);
					$this->db->where($update_condition);
					$ico_reg								= array();
					$ico_reg['register_number']				= $details['ico_number'][$key];
					if($date_rev !=''){
						$ico_reg['expiry_date']				= date('Y-m-d',strtotime($date_rev));
					}
					$ico_reg['modified_by']					= $this->session->userdata('User')['id'];
					$ico_reg['modified_date']				= date('Y-m-d H:i:s');
					$this->db->update('other_bodies_register_details', $ico_reg);
					
				}else{
					$ico_reg['register_number']				= $details['ico_number'][$key];
					if($date_rev !=''){
						$ico_reg['expiry_date']				= date('Y-m-d',strtotime($date_rev));
					}
					$ico_reg['created_by']					= $this->session->userdata('User')['id'];
					$ico_reg['modified_by']					= $this->session->userdata('User')['id'];
					$ico_reg['created_date']				= date('Y-m-d H:i:s');
					$ico_reg['modified_date']				= date('Y-m-d H:i:s');
					$ins									= $this->db->insert('other_bodies_register_details', $ico_reg);
				}
			 	
				$indemnity_reg								= array();
				$indemnity_reg['user_id']					= $this->session->userdata('User')['id'];
				$indemnity_reg['country_id']				= $value;
				$indemnity_reg['other_bodies_id']			= 2;
				$this->db->from('other_bodies_register_details');
				$this->db->where($indemnity_reg);
				if(trim($details['indemnity_expiry'][$key])!= ''){
					$date_array								= explode('/',$details['indemnity_expiry'][$key]);
					$temp									= $date_array[1];
					$date_array[1]							= $date_array[0];
					$date_array[0]							= $temp;
					$date_rev								= implode('/',$date_array);
				}else{
					$date_rev								= '';
				}
				
				if($exist_prof->num_rows()>0){
					$update_condition						= array('user_id'=>$this->session->userdata('User')['id'],'country_id'=>$value,'other_bodies_id'=>2);
					$this->db->where($update_condition);
					$indemnity_reg							= array();
					$indemnity_reg['register_number']		= $details['indemnity_number'][$key];
					if($date_rev !=''){
						$indemnity_reg['expiry_date']		= date('Y-m-d',strtotime($date_rev));
					}
					$indemnity_reg['company_name']			= $details['indemnity_company'][$key];
					$indemnity_reg['modified_by']			= $this->session->userdata('User')['id'];
					$indemnity_reg['modified_date']			= date('Y-m-d H:i:s');
					$this->db->update('other_bodies_register_details', $indemnity_reg);
				}else{
					$indemnity_reg['register_number']		= $details['indemnity_number'][$key];
					if($date_rev !=''){
						$indemnity_reg['expiry_date']		= date('Y-m-d',strtotime($date_rev));
					}
					$indemnity_reg['company_name']			= $details['indemnity_company'][$key];
					$indemnity_reg['created_by']			= $this->session->userdata('User')['id'];
					$indemnity_reg['modified_by']			= $this->session->userdata('User')['id'];
					$indemnity_reg['created_date']			= date('Y-m-d H:i:s');
					$indemnity_reg['modified_date']			= date('Y-m-d H:i:s');
					$ins									= $this->db->insert('other_bodies_register_details', $indemnity_reg);
				}
			}
			 
			$prof_details								= array();
			$prof_details['qualifications']				= trim($_POST['data']['qualifications']);
			$prof_details['memberships']				= trim($_POST['data']['membership']);
			$prof_details['professional_exp']			= trim($_POST['data']['professional_exp']);
			$prof_details['memberships']				= trim($_POST['data']['membership']);
			$prof_details['year_exp']					= $_POST['data']['exp_years'];
			$prof_details['modified_by']				= $this->session->userdata('User')['id'];
			$prof_details['modified_date']				= date('Y-m-d H:i:s');
			$this->db->where('user_id',$this->session->userdata('User')['id']);
			$qry										= $this->db->update('user_professional_details',$prof_details);
			
			$user_details								= array();
			$user_details['registration_complete']		= 1;
			$this->db->where('id',$this->session->userdata('User')['id']);
			$qry										= $this->db->update('users',$user_details);
			
			$reg_sucess									= 1;
			$data['last_saved']							= date('d/m/Y H:i:s');
		}	
		
		
		$session_value 					= $this->session->all_userdata();
		$personal_details				= $this->account_setup_model->personal_details($session_value['User']['id']);
		$professional_details			= $this->account_setup_model->professional_details($session_value['User']['id']);
		$service_details				= $this->account_setup_model->user_services($session_value['User']['id']);
		$prof_reg_details				= $this->account_setup_model->professional_reg_details($session_value['User']['id']);
		$other_bodies_details			= $this->account_setup_model->other_bodies_details($session_value['User']['id']);
		$uploads_medical				= $this->account_setup_model->professional_uploads($session_value['User']['id']);
		$uploads_others					= $this->account_setup_model->others_uploads($session_value['User']['id']);
		
		$notes							= $this->account_setup_model->notes($session_value['User']['id']);
		$alerts							= $this->account_setup_model->alerts($session_value['User']['id']);
		$consent						= $this->account_setup_model->consent($session_value['User']['id']);
		$gp_details						= $this->account_setup_model->gp_details($this->session->userdata['User']['id']);
		$chemist_details				= $this->account_setup_model->chemist_details($this->session->userdata['User']['id']);
		$career_details					= $this->account_setup_model->career_details($this->session->userdata['User']['id']);
		
		$patient_minor					= $this->account_setup_model->patient_minor($session_value['User']['id'],1);
		$family_details					= $this->account_setup_model->patient_minor($this->session->userdata['User']['id'],0);
		$patient_nxt					= $this->account_setup_model->patient_nxt($session_value['User']['id']);
		
		if($session_value['User']['user_type']	== $this->config->item('medical_practice')){
			$pract_details				= $this->account_setup_model->practice_details($session_value['User']['id']);
			$data['practice_details']	= $pract_details;
		}
		
		$data['country']				= $this->common->country_details();
		$data['family_details']			= $family_details;
		$data['details']				= $personal_details;
		$data['professional_body']		= $this->common->get_details();
		$data['user_services']			= $service_details;
		$data['services']				= $this->common->service_name();
		$data['languages']				= $this->common->language_list();
		$data['relationship']			= $this->common->relationship_list();
		$data['marital_list']			= $this->common->marital_list();
		$data['profession_details']		= $professional_details;
		$data['prof_reg']				= $prof_reg_details;
		$data['other_bodies']			= $other_bodies_details;
		$data['data_reg']				= $reg_sucess;
		$data['professional_uploads']	= $uploads_medical;
		$data['other_uploads']			= $uploads_others;
		$data['patient_minor']			= $patient_minor;
		$data['patient_nxt']			= $patient_nxt;
		$data['notes']					= $notes;
		$data['alerts']					= $alerts;
		$data['consent']				= $consent;
		$data['gp_details']				= $gp_details;
		$data['chemist_details']		= $chemist_details;
		$data['career_details']			= $career_details;
		$data['ethinic_details']		= $this->common->ethinic_details();
		if($this->session->userdata('User')['user_type'] == $this->config->item('professional')){
			#$this->load->view('professional_registraion',$data);
			$this->template->render_content('professional_registraion',$data);
		}else if($this->session->userdata('User')['user_type'] == $this->config->item('patient')){
			#$this->load->view('patient_registration1',$data);
			$this->template->render_content('patient_registration1',$data);
		}else if($this->session->userdata('User')['user_type'] == $this->config->item('medical_practice')){
			#$this->load->view('practice_registration',$data);
			$this->template->render_content('practice_registration',$data);
		}
	}
	function get_specialization(){
		if($_POST['prof']){
			$spl_list					= $this->common->get_specialization($_POST['prof']);
			$spl_option					= '';
			foreach($spl_list as $key  => $val){
				$spl_option			= $spl_option.'<option value="'.$key.'">'.$val.'</option>';
			}
			echo $spl_option;
		}
		
	}
	function country_register_categories(){
		$spl_option							= '';
		if($_POST['country'] && $_POST['prof']){
			$conditions						= array('country_id'=>$_POST['country'],'professional_type_id'=>$_POST['prof'],'status'=>1);
			$this->db->from('medical_bodies');
			$this->db->where($conditions);
			$this->db->select('id,medical_body_name');
			$query 							= $this->db->get();
			$items							= array();
			$items['']						= 'Select';
			if($query->num_rows() > 0) {
				foreach($query->result() as $data) {
					$items[$data->id] 		= $data->medical_body_name;
				}
				foreach($items as $key  => $val){
					if($key ==''){
						$spl_option			= $spl_option.'<option value="'.$key.'" selected="selected">'.$val.'</option>';
					}else{
						$spl_option			= $spl_option.'<option value="'.$key.'">'.$val.'</option>';
					}
				}
			}
		}
		echo trim($spl_option);
	}
	function add_services(){
		$results											= array();
		if(isset($_POST['ser']) && $_POST['ser'] !=''){
			$conditions										= array('service_name'=>trim($_POST['ser']),'active'=>1);
			$this->db->from('services');
			$this->db->where($conditions);
			$this->db->select('id');
			$query 											= $this->db->get();
			if($query->num_rows() > 0) {
				$results['response']['status']				= "already exist"; 					
			 }else{
				$services									= array();
				$services['service_name']					= trim($_POST['ser']);
				$services['active']							= 1;
				$services['created_by']						= $this->session->userdata('User')['id'];
				$services['modified_by']					= $this->session->userdata('User')['id'];
				$services['created_date']					= date('Y-m-d H:i:s');
				$services['modified_date']					= date('Y-m-d H:i:s');
				$ins										= $this->db->insert('services', $services);
				if($ins){
					$conditions								= array('active'=>1);
					$this->db->from('services');
					$this->db->where($conditions);
					$this->db->select('id,service_name');
					$query_serv 							= $this->db->get();
					$items									= array();
					if($query_serv->num_rows() > 0) {
						foreach($query_serv->result() as $data) {
							$items[$data->id] 		= $data->service_name;
						}
					}
					$results['response']['list']			= $items;
					$results['response']['status']			= "success"; 	
				}else{
					$results['response']['status']			= "failure"; 	
				}
			}
			echo  json_encode($results);
		}
	}
	function filling_details(){
		if(isset($_POST) && !empty($_POST)){
			if(isset($_FILES) && !empty($_FILES)){
				if(!is_dir(FCPATH .'assets/uploads/'.$this->session->userdata('User')['id'].'/profile_pic/')) {
					mkdir(FCPATH .'assets/uploads/'.$this->session->userdata('User')['id'].'/profile_pic/', 0777, true);
				}
				$tmp								= $_FILES['file']['tmp_name'];
				$ext								= explode('.',$_FILES['file']['name']);
				$time_st							= time();
				$dst								= FCPATH.'assets/uploads/'.$this->session->userdata('User')['id'].'/profile_pic/'.$_POST['first_name']."_".$this->session->userdata('User')['id'].'_'.$time_st.'.'.$ext[1];
				if(move_uploaded_file($tmp, $dst)){
					$data['img_name']				= $_POST['first_name'].'_'.$this->session->userdata('User')['id'].'_'.$time_st.'.'.$ext[1];
					$data['img_path']				= $this->session->userdata('User')['id'].'/profile_pic/';
				}
			}
			if(isset($_POST['phone'])&& $_POST['phone'] !=''){
				$data['work_telephone']				= $_POST['phone'];
			}
			$data['title']							= $_POST['title'];
			$data['firstname']						= $_POST['first_name'];
			$data['lastname']						= $_POST['last_name'];
			$data['gender']							= $_POST['gender'];
			$data['dob']							= implode('-', array_reverse(explode('/', $_POST['dob'])));
			$data['languages']						= $_POST['language'];
			$data['mobile']							= $_POST['mobile'];
			$data['primary_email']					= $_POST['email'];
			$data['ethinic_origin']					= $_POST['ethinic'];
			$data['modified_by']					= $this->session->userdata('User')['id'];
			$data['modified_date']					= date('Y-m-d H:i:s');
			$this->db->where('user_id',$this->session->userdata('User')['id']);
			$this->db->update('user_personal_details',$data);
			
			$address_dtl							= array();
			$address_dtl['address']					= $_POST['address'];
			$address_dtl['city_town']				= $_POST['town'];
			$address_dtl['state']					= $_POST['state'];
			$address_dtl['country_id']				= $_POST['country_id'];
			$address_dtl['postcode']				= $_POST['zipcode'];
			$address_dtl['modified_by']				= $this->session->userdata('User')['id'];
			$address_dtl['modified_date']			= date('Y-m-d H:i:s');
			
			$query  								= $this->db->get_where('user_address_details', array('user_id' => $this->session->userdata('User')['id']));
			
			$count 									= $query->num_rows(); //counting result from query

			if ($count === 0) {
				$address_dtl['user_id']				= $this->session->userdata('User')['id'];
				$address_dtl['created_by']			= $this->session->userdata('User')['id'];
				$address_dtl['created_date']		= date('Y-m-d H:i:s');
				$qry								= $this->db->insert('user_address_details', $address_dtl);
			}else{
				$this->db->where('user_id',$this->session->userdata('User')['id']);
				$qry								= $this->db->update('user_address_details',$address_dtl);	
			}
			$arr_msg								= array();
			if($qry){
				$arr_msg['response']				= 'success';
				$arr_msg['save_time']				= date('d/m/Y H:i:s');
				echo json_encode($arr_msg);
			}
		}
 	}
	function practice_details(){
		$data									= array();
		if(isset($_POST) && !empty($_POST)){
			$save_details								= array();
			$save_details['practice_name']				= trim($_POST['practice_name']);
			$save_details['title']						= trim($_POST['title']);
			$save_details['role']						= trim($_POST['role']);
			$save_details['tel1']						= trim($_POST['tel1']);
			if(isset($_POST['tel2'])){
				$save_details['tel2']						= trim($_POST['tel2']);
			}
			$save_details['primary_email']				= trim($_POST['email']);
			$save_details['address']					= trim($_POST['address']);
			$save_details['city_town']					= trim($_POST['town']);
			$save_details['state']						= trim($_POST['state']);
			$save_details['country_id']					= trim($_POST['country_id']);
			$save_details['postcode']					= trim($_POST['postcode']);
			$this->db->where('user_id',$this->session->userdata('User')['id']);
			$qry										= $this->db->update('medical_practice_details',$save_details);
			$arr_msg									= array();
			if($qry){
				$arr_msg['response']					= 'success';
				$arr_msg['save_time']					= date('d/m/Y H:i:s');
			}else{
				$arr_msg['response']					= 'failed';
			}
			echo json_encode($arr_msg);	
			
		}
	}
	function patient_details(){
		$data									= array();
		if(isset($_POST) && !empty($_POST)){
			if(isset($_FILES) && !empty($_FILES)){
				if(!is_dir(FCPATH .'assets/uploads/'.$this->session->userdata('User')['id'].'/profile_pic/')) {
					mkdir(FCPATH .'assets/uploads/'.$this->session->userdata('User')['id'].'/profile_pic/', 0777, true);
				}
				$tmp								= $_FILES['file']['tmp_name'];
				$ext								= explode('.',$_FILES['file']['name']);
				$time_st							= time();
				 $dst								= FCPATH.'assets/uploads/'.$this->session->userdata('User')['id'].'/profile_pic/'.$_POST['first_name']."_".$this->session->userdata('User')['id'].'_'.$time_st.'.'.$ext[1];
				if(move_uploaded_file($tmp, $dst)){
					$data['img_name']				= $_POST['first_name'].'_'.$this->session->userdata('User')['id'].'_'.$time_st.'.'.$ext[1];
					$data['img_path']				= $this->session->userdata('User')['id'].'/profile_pic/';
				}
			}
			if(isset($_POST['work_mobile'])&& $_POST['work_mobile'] !=''){
				$data['work_telephone']				= $_POST['work_mobile'];
			}
			if(isset($_POST['home_mobile'])&& $_POST['home_mobile'] !=''){
				$data['home_telephone']				= $_POST['home_mobile'];
			}
			if(isset($_POST['nh_no'])&& $_POST['nh_no'] !=''){
				$data['nhs_no']						= trim($_POST['nh_no']);
			}
			
			$data['title']							= $_POST['title'];
			$data['firstname']						= $_POST['first_name'];
			$data['lastname']						= $_POST['last_name'];
			$data['gender']							= $_POST['gender'];
			$data['dob']							= implode('-', array_reverse(explode('/', $_POST['dob'])));
			$data['mobile']							= $_POST['mobile'];
			$data['primary_email']					= $_POST['email'];
			$data['ethinic_origin']					= $_POST['ethinic_origin'];
			$data['languages']						= $_POST['languages'];
			$data['marital_status']					= $_POST['marital_status'];
			$data['modified_by']					= $this->session->userdata('User')['id'];
			$data['modified_date']					= date('Y-m-d H:i:s');
			$this->db->where('user_id',$this->session->userdata('User')['id']);
			$this->db->update('user_personal_details',$data);
			
			$address_dtl							= array();
			$address_dtl['address']					= $_POST['address'];
			$address_dtl['city_town']				= $_POST['town'];
			$address_dtl['state']					= $_POST['state'];
			$address_dtl['country_id']				= $_POST['country_id'];
			$address_dtl['postcode']				= $_POST['zipcode'];
			$address_dtl['modified_by']				= $this->session->userdata('User')['id'];
			$address_dtl['modified_date']			= date('Y-m-d H:i:s');
			
			$query  								= $this->db->get_where('user_address_details', array('user_id' => $this->session->userdata('User')['id']));
			
			$count 									= $query->num_rows(); //counting result from query

			if ($count === 0) {
				$address_dtl['user_id']				= $this->session->userdata('User')['id'];
				$address_dtl['created_by']			= $this->session->userdata('User')['id'];
				$address_dtl['created_date']		= date('Y-m-d H:i:s');
				$qry								= $this->db->insert('user_address_details', $address_dtl);
			}else{
				$this->db->where('user_id',$this->session->userdata('User')['id']);
				$qry								= $this->db->update('user_address_details',$address_dtl);	
			}
			
			$user_details							= array();
			$user_details['registration_complete']	= 1;
			$user_details['modified_by']			= $this->session->userdata('User')['id'];
			$user_details['modified_date']			= date('Y-m-d H:i:s');
			$this->db->where('id',$this->session->userdata('User')['id']);
			$qry									= $this->db->update('users',$user_details);	
			
			if(isset($_POST['age']) && $_POST['age'] !='' && $_POST['age'] < 16){
				
				$patient_minor								= array();
				$patient_minor['title']						= $_POST['minor_title'];
				$patient_minor['name']						= $_POST['minor_name'];
				$patient_minor['relationship_id']			= $_POST['relationship_id'];
				$patient_minor['mobile']					= $_POST['minor_mobile'];
				$patient_minor['address']					= $_POST['minor_address'];
				$patient_minor['modified_by']				= $this->session->userdata('User')['id'];
				$patient_minor['modified_date']				= date('Y-m-d H:i:s');
				$query  									= $this->db->get_where('patient_family_details', array('user_id' => $this->session->userdata('User')['id'],'is_guardian'=>1));
				$count										= 0;
				$count 										= $query->num_rows(); //counting result from query
				if ($count === 0) {
					$patient_minor['is_guardian']			= 1;
					$patient_minor['user_id']				= $this->session->userdata('User')['id'];
					$patient_minor['created_by']			= $this->session->userdata('User')['id'];
					$patient_minor['created_date']			= date('Y-m-d H:i:s');
					$qry									= $this->db->insert('patient_family_details', $patient_minor);
				}else{
					$conditions								= array('user_id'=>$this->session->userdata('User')['id'],'is_guardian'=>1);
					$this->db->where($conditions);
					$qry								= $this->db->update('patient_family_details',$patient_minor);	
				}
			}
			/*if($_POST['next_title'] !='' || trim($_POST['next_name']) !='' || trim($_POST['next_address']) !='' || trim($_POST['next_mobile']) !='' ){
				$patient_minor								= array();
				$patient_minor['title']						= $_POST['next_title'];
				$patient_minor['name']						= $_POST['next_name'];
				$patient_minor['mobile']					= $_POST['next_mobile'];
				$patient_minor['address']					= $_POST['next_address'];
				$patient_minor['modified_by']					= $this->session->userdata('User')['id'];
				$patient_minor['modified_date']				= date('Y-m-d H:i:s');
				$query  									= $this->db->get_where('patient_nexttokin', array('user_id' => $this->session->userdata('User')['id']));
				$count										= 0;
				$count 										= $query->num_rows(); //counting result from query
				if ($count === 0) {
					$patient_minor['user_id']				= $this->session->userdata('User')['id'];
					$patient_minor['created_by']			= $this->session->userdata('User')['id'];
					$patient_minor['created_date']			= date('Y-m-d H:i:s');
					$qry									= $this->db->insert('patient_nexttokin', $patient_minor);
				}else{
					$this->db->where('user_id',$this->session->userdata('User')['id']);
					$qry									= $this->db->update('patient_nexttokin',$patient_minor);	
				}
			}*/
			
			$arr_msg										= array();
			if($qry){
				$arr_msg['response']						= 'success';
				$arr_msg['save_time']						= date('d/m/Y H:i:s');
				echo json_encode($arr_msg);
			}
		} 
	}
	function patient_family_details(){
		if(!empty($_POST['data'])){
			$details										= $_POST['data'];
			$qry											= 0;
			foreach($details['family_name'] as $key =>$val){
				$save_details								= array();
				$save_details['name']						= trim($val);
				$save_details['relationship_id']			= $details['family_relation'][$key];
				$save_details['mobile']						= trim($details['family_tel'][$key]);
				$save_details['home']						= trim($details['family_contact'][$key]);
				$save_details['age']						= trim($details['family_age'][$key]);
				$save_details['address']					= trim($details['family_address'][$key]);
				$save_details['modified_by']				= $this->session->userdata('User')['id'];
				$save_details['modified_date']				= date('Y-m-d H:i:s');
				if($save_details['name'] =='' && $save_details['relationship_id'] =='' && $save_details['mobile']== '' && $save_details['home']	=='' && $save_details['age'] =='' && $save_details['address']=='' ){
				}else{
					$query  									= $this->db->get_where('patient_family_details', array('user_id' => $this->session->userdata('User')['id'],'relationship_id'=>$details['family_relation'][$key],'is_guardian'=>0));
					$count										= 0;
					$count 										= $query->num_rows(); //counting result from query
					if ($count === 0) {
						$save_details['relationship_id']		= $details['family_relation'][$key];
						$save_details['user_id']				= $this->session->userdata('User')['id'];
						$save_details['created_by']				= $this->session->userdata('User')['id'];
						$save_details['created_date']			= date('Y-m-d H:i:s');
						$qry									= $this->db->insert('patient_family_details', $save_details);
					}else{
						$this->db->where(array('user_id'=>$this->session->userdata('User')['id'],'relationship_id'=>$details['family_relation'][$key]));
						$qry									= $this->db->update('patient_family_details',$save_details);	
					} 
				}
			}
			if($qry){
				$family_details								= $this->account_setup_model->patient_minor($this->session->userdata['User']['id'],0);
				$array_details								= array();
				$i											= 0;
				$relationship								= $this->common->relationship_list();
				if(count($family_details)>0){
					foreach($family_details as $f_key => $f_val){
						$array_details[$i]						= (array)$f_val;
						if(isset($relationship[$f_val->relationship_id])){
							$array_details[$i]['relation']		= $relationship[$f_val->relationship_id];
						}else{
							$array_details[$i]['relation']		='';
						}
						$i++;
					}
				}
				$arr_msg['response']						= 'success';
				$arr_msg['save_time']						= date('d/m/Y H:i:s');
				$arr_msg['details']							= $array_details;
			}else{
				$arr_msg['response']						= 'failed';
			}
			echo json_encode($arr_msg);
		}
	}
	function patient_gp_details(){
		if(!empty($_POST['data'])){
			$details										= $_POST['data'];
			$qry											= 0;
			foreach($details['gp_practice_name'] as $key =>$val){
				$save_details								= array();
				$save_details['user_id']					= $this->session->userdata('User')['id'];
				$save_details['practice_name']				= $val;
				$save_details['doctor_name']				= trim($details['gp_doctor_name'][$key]);
				$save_details['tel1']						= trim($details['gp_tel1'][$key]);
				if(isset($details['gp_tel2'][$key]) && $details['gp_tel2'][$key] !=''){
					$save_details['tel2']					= trim($details['gp_tel2'][$key]);
				}
				$save_details['email']						= trim($details['gp_email'][$key]);
				$save_details['address']					= trim($details['gp_address'][$key]);
				$save_details['city']						= trim($details['gp_town'][$key]);
				$save_details['state']						= trim($details['gp_state'][$key]);
				$save_details['postcode']					= trim($details['gp_postcode'][$key]);
				$save_details['country_id']					= trim($details['gp_country'][$key]);
				$save_details['created_by']					= $this->session->userdata('User')['id'];
				$save_details['modified_by']				= $this->session->userdata('User')['id'];
				$save_details['created_date']				= date('Y-m-d H:i:s');
				$save_details['modified_date']				= date('Y-m-d H:i:s');
				if($save_details['practice_name'] =='' && $save_details['doctor_name'] =='' && $save_details['email']	=='' && $save_details['address'] ==''  && $save_details['city']=='' && $save_details['state']=='' && $save_details['postcode']=='' && $save_details['country_id']==''){
				}else{
					$qry										= $this->db->insert('patient_gp_details', $save_details);
				}
			}
			if($qry){
				$gp_details									= $this->account_setup_model->gp_details($this->session->userdata['User']['id']);
				$array_details								= array();
				$i											= 0;
				$country										= $this->common->country_details();
				if(count($gp_details)>0){
					foreach($gp_details as $f_key => $f_val){
						$array_details[$i]					= (array)$f_val;
						if(isset($country['name'][$f_val->country_id])){
							$array_details[$i]['country']	= $country['name'][$f_val->country_id];
						}else{
							$array_details[$i]['country']	= '';
						}
						$i++;
					}
				}
				$arr_msg['response']						= 'success';
				$arr_msg['save_time']						= date('d/m/Y H:i:s');
				$arr_msg['details']							= $array_details;
				
			}else{
				$arr_msg['response']						= 'failed';
			}
			echo json_encode($arr_msg);
		}
	}
	
	function patient_chemist_details(){
		if(!empty($_POST['data'])){
			$details										= $_POST['data'];
			$qry											= 0;
			foreach($details['chemist_pharmacy_name'] as $key =>$val){
				$save_details								= array();
				$save_details['user_id']					= $this->session->userdata('User')['id'];
				$save_details['pharmacy_name']				= $val;
				$save_details['chemist_name']				= $details['chemist_name'][$key];
				$save_details['tel1']						= $details['chemist_tel1'][$key];
				if(isset($details['chemist_tel2'][$key]) && $details['chemist_tel2'][$key] !=''){
					$save_details['tel2']					= $details['chemist_tel2'][$key];
				}
				$save_details['email']						= $details['chemist_email'][$key];
				$save_details['address']					= $details['chemist_address'][$key];
				$save_details['city']						= $details['chemist_town'][$key];
				$save_details['state']						= $details['chemist_state'][$key];
				$save_details['postcode']					= $details['chemist_postcode'][$key];
				$save_details['country_id']					= $details['chemist_country'][$key];
				$save_details['created_by']					= $this->session->userdata('User')['id'];
				$save_details['modified_by']				= $this->session->userdata('User')['id'];
				$save_details['created_date']				= date('Y-m-d H:i:s');
				$save_details['modified_date']				= date('Y-m-d H:i:s');
				if($save_details['pharmacy_name'] =='' && $save_details['chemist_name'] =='' && $save_details['email']	=='' && $save_details['address'] ==''  && $save_details['city']=='' && $save_details['state']=='' && $save_details['postcode']=='' && $save_details['country_id']==''){
				}else{
					$qry										= $this->db->insert('patient_chemist_details', $save_details);
				}
			}
			if($qry){
				$chemist_details							= $this->account_setup_model->chemist_details($this->session->userdata['User']['id']);
				$array_details								= array();
				$i											= 0;
				$country									= $this->common->country_details();
				if(count($chemist_details)>0){
					foreach($chemist_details as $f_key => $f_val){
						$array_details[$i]						= (array)$f_val;
						if(isset($country['name'][$f_val->country_id])){
							$array_details[$i]['country']	= $country['name'][$f_val->country_id];
						}else{
							$array_details[$i]['country']	= '';
						}
						$i++;
					}
				}
				$arr_msg['response']						= 'success';
				$arr_msg['details']							= $array_details;
				$arr_msg['save_time']						= date('d/m/Y H:i:s');
			}else{
				$arr_msg['response']						= 'failed';
			}
			echo json_encode($arr_msg);
		}
	}
	
	function patient_career_details(){
		if(!empty($_POST['data'])){
			$details										= $_POST['data'];
			$qry											= 0;
			foreach($details['career_company_name'] as $key =>$val){
				$save_details								= array();
				$save_details['user_id']					= $this->session->userdata('User')['id'];
				$save_details['company_name']				= $val;
				$save_details['name']						= $details['career_name'][$key];
				$save_details['tel1']						= $details['career_tel1'][$key];
				if(isset($details['career_tel2'][$key]) && $details['career_tel2'][$key] !=''){
					$save_details['tel2']					= $details['career_tel2'][$key];
				}
				$save_details['email']						= $details['career_email'][$key];
				$save_details['address']					= $details['career_address'][$key];
				$save_details['city']						= $details['career_town'][$key];
				$save_details['state']						= $details['career_state'][$key];
				$save_details['postcode']					= $details['career_postcode'][$key];
				$save_details['country_id']					= $details['career_country'][$key];
				$save_details['created_by']					= $this->session->userdata('User')['id'];
				$save_details['modified_by']				= $this->session->userdata('User')['id'];
				$save_details['created_date']				= date('Y-m-d H:i:s');
				$save_details['modified_date']				= date('Y-m-d H:i:s');
				if($save_details['company_name'] =='' && $save_details['name'] =='' && $save_details['email']	=='' && $save_details['address'] ==''  && $save_details['city']=='' && $save_details['state']=='' && $save_details['postcode']=='' && $save_details['country_id']==''){
				}else{
					$qry										= $this->db->insert('patient_career_details', $save_details);
				}
			}
			if($qry){
				$career_details							= $this->account_setup_model->career_details($this->session->userdata['User']['id']);
				$array_details								= array();
				$i											= 0;
				$country									= $this->common->country_details();
				if(count($career_details)>0){
					foreach($career_details as $f_key => $f_val){
						$array_details[$i]					= (array)$f_val;
						if(isset($country['name'][$f_val->country_id])){
							$array_details[$i]['country']	= $country['name'][$f_val->country_id];
						}else{
							$array_details[$i]['country']	= '';
						}
						$i++;
					}
				}
				$arr_msg['response']						= 'success';
				$arr_msg['details']							= $array_details;
				$arr_msg['save_time']						= date('d/m/Y H:i:s');
			}else{
				$arr_msg['response']						= 'failed';
			}
			echo json_encode($arr_msg);
		}
	}
	function update_details(){
		$this->db->where('user_id',$this->session->userdata('User')['id']);
		$qry										= $this->db->update('user_personal_details',$_POST);
		$arr_msg									= array();
		if($qry){
			$arr_msg['response']					= 'success';
			$arr_msg['save_time']					= date('d/m/Y H:i:s');
			echo json_encode($arr_msg);
		}
	}
	
	function save_uploaded_files(){
		if(isset($_POST) && !empty($_POST) && isset($_FILES) && !empty($_FILES)){
			if(!is_dir(FCPATH .'assets/uploads/'.$this->session->userdata('User')['id'].'/documents/')) {
				mkdir(FCPATH .'assets/uploads/'.$this->session->userdata('User')['id'].'/documents/', 0777, true);
			}
			$result										= array();
			foreach($_FILES['file']['name'] as $key => $val){
				$data									= array();
				$tmp									= $_FILES['file']['tmp_name'][$key];
				$ext									= explode('.',$_FILES['file']['name'][$key]);
				$time_st								= time();
				$dst									= FCPATH.'assets/uploads/'.$this->session->userdata('User')['id'].'/documents/'."document_".$key."_".$this->session->userdata('User')['id'].'_'.$time_st.'.'.$ext[1];
				if(move_uploaded_file($tmp, $dst)){
					$data['file_name']					= "document_".$key."_".$this->session->userdata('User')['id'].'_'.$time_st.'.'.$ext[1];
					$data['file_path']					= $this->session->userdata('User')['id'].'/documents/';
				}
				$data['user_id']						= $this->session->userdata('User')['id'];
				if(isset($_POST['file_type']) && $_POST['file_type'] !='others'){
					$data['country_id']					= $_POST['country'][$key];
					if(isset($_POST['file_type']) && $_POST['file_type'] =='medical_bodies'){
						$data['medical_bodies']			= 1;
					}else if(isset($_POST['file_type']) && $_POST['file_type'] =='other_bodies'){
						$data['other_bodies_id']		= $_POST['other_body_id'];
					}
				}
				$data['title']							= $_POST['title'][$key];
				if(isset($_POST['show'][$key])){
					$data['show_public']				= $_POST['show'][$key];
				}
				$data['created_by']						= $this->session->userdata('User')['id'];
				$data['modified_by']					= $this->session->userdata('User')['id'];
				$data['created_date']					= date('Y-m-d H:i:s');
				$data['modified_date']					= date('Y-m-d H:i:s');
				if(isset($_POST['file_type']) && $_POST['file_type'] !='others'){
					$documents							= $this->db->insert('user_professional_documents', $data);
				}else{
					$documents							= $this->db->insert('user_other_documents', $data);
				}
				$result['details'][]					= $data;
			}
			if($documents){
				$result['response']						= 'success';
				$result['saved_time']					= date('d/m/Y H:i:s');
			}else{
				$result									= array('response'=>'failed');
			}
		}else{
			$result										= array('response'=>'failed');
		}
		echo json_encode($result);
	}
	
	function save_notes(){
		if(isset($_POST['type']) && trim($_POST['type']) != ''){
			$save_details								= array();
			$save_details['user_id']					= $this->session->userdata('User')['id'];
			$save_details['created_by']					= $this->session->userdata('User')['id'];
			$save_details['modified_by']				= $this->session->userdata('User')['id'];
			$save_details['created_date']				= date('Y-m-d H:i:s');
			$save_details['status']						= 1;
			$save_details['modified_date']				= date('Y-m-d H:i:s');
			if(isset($_POST['type']) && $_POST['type']=='alert_txt'){
				$save_details['alerts']					= trim($_POST['alert']);
				$qry									= $this->db->insert('patient_alerts', $save_details);
			}else if(isset($_POST['type']) && $_POST['type']=='notes'){
				$save_details['notes']					= trim($_POST['notes']);
				$qry									= $this->db->insert('patient_notes', $save_details);
			}
			if($qry){
				$insert_id = $this->db->insert_id();
				$result									= array('response'=>'success','saved_time'=>date("F j, Y, g:i a",strtotime($save_details['modified_date'])),'name'=>$this->session->userdata('User')['title'].' '.$this->session->userdata('User')['firstname'].' '.$this->session->userdata('User')['lastname'],'last_id'=>$insert_id);
			}else{
				$result									= array('response'=>'failed');
			}
			echo json_encode($result);
		}
	}
	
	function update_notes(){
		if(isset($_POST)){
			$save_details								= array();
			$qry										= 0;
			$save_details['modified_date']				= date('Y-m-d H:i:s');
			$save_details['modified_by']				= $this->session->userdata('User')['id'];
			$this->db->where('id',$_POST['txt_id']);
			if(isset($_POST['type']) && $_POST['type']=='alert'){
				$save_details['alerts']						= trim($_POST['txt_alert']);
				$qry										= $this->db->update('patient_alerts',$save_details);
			}else if(isset($_POST['type']) && $_POST['type']=='notes'){
				$save_details['notes']						= trim($_POST['txt_alert']);
				$qry										= $this->db->update('patient_notes',$save_details);
			}
			if($qry){
				$result									= array('response'=>'success','saved_time'=>date("F j, Y, g:i a",strtotime($save_details['modified_date'])),'name'=>$this->session->userdata('User')['title'].' '.$this->session->userdata('User')['firstname'].' '.$this->session->userdata('User')['lastname']);
			}else{
				$result									= array('response'=>'failed');
			}
			echo json_encode($result);
		}
	}
	function remove_notes(){
		if(isset($_POST)){
			$save_details								= array();
			$qry										= 0;
			$save_details['modified_date']				= date('Y-m-d H:i:s');
			$save_details['modified_by']				= $this->session->userdata('User')['id'];
			$save_details['status']						= 0;
			$this->db->where('id',$_POST['a']);
			if(isset($_POST['type']) && $_POST['type']=='alert'){
				$qry										= $this->db->update('patient_alerts',$save_details);
			}else if(isset($_POST['type']) && $_POST['type']=='notes'){
				$qry										= $this->db->update('patient_notes',$save_details);
			}
			if($qry){
				$result									= array('response'=>'success');
			}else{
				$result									= array('response'=>'failed');
			}
			echo json_encode($result);
		}
	}
		
	function save_consent(){
		if(isset($_POST['check_val']) && !empty($_POST['check_val'])){
			
			$save_details								= array();
			$save_details['consent_value']				= implode(',',$_POST['check_val']);
			$save_details['modified_by']				= $this->session->userdata('User')['id'];
			$save_details['modified_date']				= date('Y-m-d H:i:s');
			$query  									= $this->db->get_where('patient_consent', array('user_id' => $this->session->userdata('User')['id']));
			$count										= 0;
			$count 										= $query->num_rows(); //counting result from query
			if($count > 0){
				$this->db->where('user_id',$this->session->userdata('User')['id']);
				$qry									= $this->db->update('patient_consent', $save_details);
			}else{
				$save_details['user_id']				= $this->session->userdata('User')['id'];
				$save_details['created_by']				= $this->session->userdata('User')['id'];
				$save_details['created_date']			= date('Y-m-d H:i:s');;
				$qry									= $this->db->insert('patient_consent', $save_details);
			}
			if($qry){
				$result									= array('response'=>'success','saved_time'=>date('d/m/Y H:i:s'),'name'=>$this->session->userdata('User')['firstname'].' '.$this->session->userdata('User')['lastname']);
			}else{
				$result									= array('response'=>'failed');
			}
			echo json_encode($result);
		}
	
	}
	
	function professional_summary(){
		$data											= array();
		$condition										= array('User.id'=>$this->session->userdata('User')['id']);
		$this->db->from('users as User');
		$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = User.id','LEFT');
		$this->db->join('user_address_details as UserAddressDetail', 'UserAddressDetail.user_id = User.id','LEFT');
		$this->db->join('user_professional_details as UserProfessionalDetail', 'UserProfessionalDetail.user_id = User.id','LEFT');
		$this->db->select('User.*,User.created_date as user_start_date,UserPersonalDetail.*,UserAddressDetail.*,UserProfessionalDetail.*');
		$this->db->where($condition);
		$query 											= $this->db->get();
		$ret 											= $query->row();
		$data['user_details']							= (array)$ret;
		$service_details								= $this->account_setup_model->user_services($this->session->userdata('User')['id']);
		$medical_bodies									= $this->account_setup_model->professional_reg_details($this->session->userdata('User')['id']);
		$other_bodies									= $this->account_setup_model->other_bodies_details($this->session->userdata('User')['id']);
		$uploads_medical								= $this->account_setup_model->professional_uploads($this->session->userdata('User')['id']);
		$uploads_others									= $this->account_setup_model->others_uploads($this->session->userdata('User')['id']);
		$data['user_services']							= $service_details;
		$data['medical_bodies']							= $medical_bodies;
		$data['other_bodies']							= $other_bodies;
		$data['country']								= $this->common->country_details();
		$data['medical_body_type']						= $this->common->register_categories();
		$data['professional_body']						= $this->common->get_details();
		$data['specialization']							= $this->common->get_specialization();
		$data['ethinic_details']						= $this->common->ethinic_details();
		$data['uploads_medical']						= $uploads_medical;
		$data['uploads_others']							= $uploads_others;
		#$this->load->view('professional_summary',$data);
		$this->template->render_content('professional_summary',$data);
	}
	
	
	function patients_summary(){
		$data											= array();
		$condition										= array('User.id'=>$this->session->userdata('User')['id']);
		$this->db->from('users as User');
		$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = User.id','LEFT');
		$this->db->join('user_address_details as UserAddressDetail', 'UserAddressDetail.user_id = User.id','LEFT');
		$this->db->join('user_professional_details as UserProfessionalDetail', 'UserProfessionalDetail.user_id = User.id','LEFT');
		$this->db->select('User.*,User.created_date as user_start_date,UserPersonalDetail.*,UserAddressDetail.*,UserProfessionalDetail.*');
		$this->db->where($condition);
		$query 											= $this->db->get();
		$ret 											= $query->row();
		$data['user_details']							= (array)$ret;
		$uploads_medical								= $this->account_setup_model->professional_uploads($this->session->userdata('User')['id']);
		$uploads_others									= $this->account_setup_model->others_uploads($this->session->userdata('User')['id']);
		
		$patient_minor									= $this->account_setup_model->patient_minor($this->session->userdata['User']['id'],1);
		
		$family_details									= $this->account_setup_model->patient_minor($this->session->userdata['User']['id'],0);
		
		$patient_nxt									= $this->account_setup_model->patient_nxt($this->session->userdata['User']['id']);
		$gp_details										= $this->account_setup_model->gp_details($this->session->userdata['User']['id']);
		$chemist_details								= $this->account_setup_model->chemist_details($this->session->userdata['User']['id']);
		
		$career_details									= $this->account_setup_model->career_details($this->session->userdata['User']['id']);
		$documents										= $this->account_setup_model->others_uploads($this->session->userdata['User']['id']);
		$notes											= $this->account_setup_model->notes($this->session->userdata['User']['id']);
		$alerts											= $this->account_setup_model->alerts($this->session->userdata['User']['id']);
	 
		$data['country']								= $this->common->country_details();
		$data['medical_body_type']						= $this->common->register_categories();
		$data['professional_body']						= $this->common->get_details();
		$data['specialization']							= $this->common->get_specialization();
		$data['ethinic_details']						= $this->common->ethinic_details();
		$data['relationship']							= $this->common->relationship_list();
		$data['marital_list']							= $this->common->marital_list();
		$data['uploads_medical']						= $uploads_medical;
		$data['uploads_others']							= $uploads_others;
		$data['patient_minor']							= $patient_minor;
		$data['patient_nxt']							= $patient_nxt;
		$data['family_details']							= $family_details;
		$data['gp_details']								= $gp_details;
		$data['chemist_details']						= $chemist_details;
		$data['career_details']							= $career_details;
		$data['documents']								= $documents;
		$data['notes']									= $notes;
		$data['alerts']									= $alerts;
		//print_r($family_details);
		
		#$this->load->view('patients_summary',$data);
		$this->template->render_content('patients_summary',$data);

	}
	
	function practice_summary(){
		$data											= array();
		$condition										= array('User.id'=>$this->session->userdata('User')['id']);
		$this->db->from('users as User');
		$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = User.id','LEFT');
		$this->db->join('user_address_details as UserAddressDetail', 'UserAddressDetail.user_id = User.id','LEFT');
		$this->db->join('user_professional_details as UserProfessionalDetail', 'UserProfessionalDetail.user_id = User.id','LEFT');
		$this->db->select('User.*,User.created_date as user_start_date,UserPersonalDetail.*,UserAddressDetail.*,UserProfessionalDetail.*');
		$this->db->where($condition);
		$query 											= $this->db->get();
		$ret 											= $query->row();
		$data['details']								= (array)$ret;
		$pract_details									= $this->account_setup_model->practice_details($this->session->userdata['User']['id']);
		$documents										= $this->account_setup_model->others_uploads($this->session->userdata['User']['id']);
		$data['country']								= $this->common->country_details();
		$data['practice_details']						= $pract_details;
		$data['documents']								= $documents;
		
		#$this->load->view('practice_summary',$data);
		$this->template->render_content('practice_summary',$data);
	}
	
	function user_details(){
		$condition										= array('User.id'=>$this->session->userdata('User')['id']);
		$this->db->from('users as User');
		if($this->session->userdata('User')['user_type'] == $this->config->item('medical_practice')){
			$this->db->join('medical_practice_details as MedicalPracticeDetail', 'MedicalPracticeDetail.user_id = User.id','LEFT');
			$this->db->select('MedicalPracticeDetail.*');
		}else{
			$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = User.id','LEFT');
			$this->db->join('user_address_details as UserAddressDetail', 'UserAddressDetail.user_id = User.id','LEFT');
			$this->db->join('user_professional_details as UserProfessionalDetail', 'UserProfessionalDetail.user_id = User.id','LEFT');
			$this->db->select('UserPersonalDetail.*,UserAddressDetail.*,UserProfessionalDetail.*');
		}
		$this->db->where($condition);
		$query 											= $this->db->get();
		$ret 											= $query->row();
		$data											= array();
		if(!empty($ret)){
			$data['response']							= 'success';
			$data['details']							= (array)$ret;
		}else{
			$data['response']							= 'failed';
		}
		echo json_encode($data);
	}


}
?>
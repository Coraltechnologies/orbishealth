<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Patient_setup extends CI_Controller {
		
		public function __construct(){
	
			parent::__construct();
			$this->load->model('patient_setup_model');
			$this->load->model('account_setup/account_setup_model');
			$this->load->model('page/Page_model');
			$this->load->helper(array('form','url','loginvalidate'));
			$this->load->library(array('Common','EncryptionFunction','form_validation'));
		}
		
		function index($user_id = null){
			if($user_id){
				$user_id					= $this->encryptionfunction->deCrypt($user_id);
			}
			$data							= array();
			$personal_details				= $this->account_setup_model->personal_details($this->session->userdata['User']['id']);
			$data['details']				= $personal_details;
			$data['country']				= $this->common->country_details();
			$data['languages']				= $this->common->language_list();
			$data['relationship']			= $this->common->relationship_list();
			$data['marital_list']			= $this->common->marital_list();
			$data['ethinic_details']		= $this->common->ethinic_details();
			$data['professional_body']		= $this->common->get_details();
			
		 
			$patient_details				= $this->account_setup_model->personal_details($user_id);
			$uploads_others					= $this->account_setup_model->others_uploads($user_id);
			$notes							= $this->account_setup_model->notes($user_id);
			$alerts							= $this->account_setup_model->alerts($user_id);
			$consent						= $this->account_setup_model->consent($user_id);
			$gp_details						= $this->account_setup_model->gp_details($user_id);
			$chemist_details				= $this->account_setup_model->chemist_details($user_id);
			$career_details					= $this->account_setup_model->career_details($user_id);
			$patient_minor					= $this->account_setup_model->patient_minor($user_id,1);
			$family_details					= $this->account_setup_model->patient_minor($user_id,0);
			$patient_nxt					= $this->account_setup_model->patient_nxt($user_id);
			
			$data['other_uploads']			= $uploads_others;
			$data['patient_minor']			= $patient_minor;
			$data['patient_nxt']			= $patient_nxt;
			$data['notes']					= $notes;
			$data['alerts']					= $alerts;
			$data['consent']				= $consent;
			$data['gp_details']				= $gp_details;
			$data['chemist_details']		= $chemist_details;
			$data['career_details']			= $career_details;
			$data['family_details']			= $family_details;
			$data['patient_details']		= $patient_details;
			$data['user_key']				= $user_id;
			
			#$this->load->view('patient_registration',$data);
			$this->template->render_content('patient_registration',$data);
		}
		function manage_patients(){
			$data							= array();
			$personal_details				= $this->account_setup_model->personal_details($this->session->userdata['User']['id']);
			$patient_details				= $this->patient_setup_model->patient_details($this->session->userdata['User']['id']);
			$data['details']				= $personal_details;
			$data['patient_details']		= $patient_details;
			
			#$this->load->view('manage_patients',$data);
			$this->template->render_content('manage_patients',$data);
		}
		function patients_summary($user_id = null){
			if($user_id){
				$user_id									= $this->encryptionfunction->deCrypt($user_id);
			}
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
			$patient_details								= $this->account_setup_model->personal_details($user_id);
			$uploads_medical								= $this->account_setup_model->professional_uploads($user_id);
			$uploads_others									= $this->account_setup_model->others_uploads($user_id);
			
			$patient_minor									= $this->account_setup_model->patient_minor($user_id,1);
			
			$family_details									= $this->account_setup_model->patient_minor($user_id,0);
			
			$patient_nxt									= $this->account_setup_model->patient_nxt($user_id);
			$gp_details										= $this->account_setup_model->gp_details($user_id);
			$chemist_details								= $this->account_setup_model->chemist_details($user_id);
			
			$career_details									= $this->account_setup_model->career_details($user_id);
			$documents										= $this->account_setup_model->others_uploads($user_id);
			$notes											= $this->account_setup_model->notes($user_id);
			$alerts											= $this->account_setup_model->alerts($user_id);
		 
			$data['country']								= $this->common->country_details();
			$data['patient_details']						= $patient_details;
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
		
		function patient_details(){
			$data									= array();
			if(isset($_POST) && !empty($_POST)){
				if(isset($_POST) && trim($_POST['user_key']) == ''){
					$country_details						= $this->Page_model->country_code($_POST['country_id']);
					$rand									= rand(10000,99999);
					if($country_details){
						$country_code						= $country_details->country_code_three;
					}
					if($country_code){
						$login_id 							= $this->Page_model->unique_user_name($country_code,$rand);
					}
					$data									= array();
					$data['login_id']						= $this->common->post($login_id);
					$string									= $this->common->generateRandomString();
					$pass									= $this->encryptionfunction->aes_encrypt($string);
					$data['password']						= $this->common->post($pass);
					$data['activation_code']				= $this->encryptionfunction->aes_encrypt($data['login_id']);
					$data['user_type']						= $this->config->item('patient');
					$data['created_by']						= $this->session->userdata('User')['id'];
					$data['modified_by']					= $this->session->userdata('User')['id'];
					$data['created_date']					= date('Y-m-d H:i:s');
					$data['modified_date']					= date('Y-m-d H:i:s');
					$primary_email							= $this->common->post($_POST['email']);
					$country								= $_POST['country_id'];
					$insert_details							= $this->patient_setup_model->insert_details($data,$primary_email);
				}else{
					$insert_details							= trim($_POST['user_key']);
				}
				$data										= array();
				if($insert_details != 0 && $insert_details != 'exist'){
					
					$data['title']							= $_POST['title'];
					$data['firstname']						= $_POST['first_name'];
					if(isset($_POST['middle_name']) && ($_POST['middle_name'])	!=''){
						$data['middlename']					= $_POST['middle_name'];
					}
					$data['lastname']						= $_POST['last_name'];
					$data['gender']							= $_POST['gender'];
					$data['dob']							= implode('-', array_reverse(explode('/', $_POST['dob'])));
					if(isset($_POST['nh_no'])&& $_POST['nh_no'] !=''){
						$data['nhs_no']						= trim($_POST['nh_no']);
					}
					$data['mobile']							= $_POST['mobile'];
					if(isset($_POST['work_mobile'])&& $_POST['work_mobile'] !=''){
						$data['work_telephone']				= $_POST['work_mobile'];
					}
					
					if(isset($_POST['home_mobile'])&& $_POST['home_mobile'] !=''){
						$data['home_telephone']				= $_POST['home_mobile'];
					}
					$data['primary_email']					= $_POST['email'];
					if(isset($_FILES) && !empty($_FILES)){
						if(!is_dir(FCPATH .'assets/uploads/'.$insert_details.'/profile_pic/')) {
							mkdir(FCPATH .'assets/uploads/'.$insert_details.'/profile_pic/', 0777, true);
						}
						$tmp								= $_FILES['file']['tmp_name'];
						$ext								= explode('.',$_FILES['file']['name']);
						$time_st							= time();
						 $dst								= FCPATH.'assets/uploads/'.$insert_details.'/profile_pic/'.$_POST['first_name']."_".$insert_details.'_'.$time_st.'.'.$ext[1];
						if(move_uploaded_file($tmp, $dst)){
							$data['img_name']				= $_POST['first_name'].'_'.$insert_details.'_'.$time_st.'.'.$ext[1];
							$data['img_path']				= $insert_details.'/profile_pic/';
						}
					}
					
					$query  								= $this->db->get_where('user_personal_details', array('user_id' => $insert_details));
					
					$p_count 								= $query->num_rows(); //counting result from query
					$data['modified_by']					= $this->session->userdata('User')['id'];
					$data['modified_date']					= date('Y-m-d H:i:s');
					if($p_count >0){
						$this->db->where('user_id',$insert_details);
						$qry								= $this->db->update('user_personal_details',$data);
					}else{
						$data['created_by']					= $this->session->userdata('User')['id'];
						$data['created_date']				= date('Y-m-d H:i:s');
						$data['user_id']					= $insert_details;
						$ins_user							= $this->db->insert('user_personal_details', $data);
					}
					
					$address_dtl							= array();
					$address_dtl['address']					= $_POST['address'];
					$address_dtl['city_town']				= $_POST['town'];
					$address_dtl['state']					= $_POST['state'];
					$address_dtl['country_id']				= $_POST['country_id'];
					$address_dtl['postcode']				= $_POST['zipcode'];
					$address_dtl['modified_by']				= $this->session->userdata('User')['id'];
					$address_dtl['modified_date']			= date('Y-m-d H:i:s');
					
					$query  								= $this->db->get_where('user_address_details', array('user_id' => $insert_details));
					
					$count 									= $query->num_rows(); //counting result from query
		
					if ($count === 0) {
						$address_dtl['user_id']				= $insert_details;
						$address_dtl['created_by']			= $this->session->userdata('User')['id'];
						$address_dtl['created_date']		= date('Y-m-d H:i:s');
						$qry								= $this->db->insert('user_address_details', $address_dtl);
					}else{
						$this->db->where('user_id',$insert_details);
						$qry								= $this->db->update('user_address_details',$address_dtl);	
					}
					
					if(isset($_POST['age']) && $_POST['age'] !='' && $_POST['age'] < 16){
						$patient_minor								= array();
						$patient_minor['title']						= $_POST['minor_title'];
						$patient_minor['name']						= $_POST['minor_name'];
						$patient_minor['relationship_id']			= $_POST['relationship_id'];
						$patient_minor['mobile']					= $_POST['minor_mobile'];
						$patient_minor['address']					= $_POST['minor_address'];
						$patient_minor['modified_by']				= $this->session->userdata('User')['id'];
						$patient_minor['modified_date']				= date('Y-m-d H:i:s');
						$query  									= $this->db->get_where('patient_family_details', array('user_id' => $insert_details,'is_guardian'=>1));
						$count										= 0;
						$count 										= $query->num_rows(); //counting result from query
						if ($count === 0) {
							$patient_minor['is_guardian']			= 1;
							$patient_minor['user_id']				= $insert_details;
							$patient_minor['created_by']			= $this->session->userdata('User')['id'];
							$patient_minor['created_date']			= date('Y-m-d H:i:s');
							$qry									= $this->db->insert('patient_family_details', $patient_minor);
						}else{
							$conditions								= array('user_id'=>$insert_details,'is_guardian'=>1);
							$this->db->where($conditions);
							$qry									= $this->db->update('patient_family_details',$patient_minor);	
						}
					}
					if($_POST['next_title'] !='' || trim($_POST['next_name']) !='' || trim($_POST['next_address']) !='' || trim($_POST['next_mobile']) !='' ){
						$patient_minor								= array();
						$patient_minor['title']						= $_POST['next_title'];
						$patient_minor['name']						= $_POST['next_name'];
						$patient_minor['mobile']					= $_POST['next_mobile'];
						$patient_minor['address']					= $_POST['next_address'];
						$patient_minor['modified_by']					= $this->session->userdata('User')['id'];
						$patient_minor['modified_date']				= date('Y-m-d H:i:s');
						$query  									= $this->db->get_where('patient_nexttokin', array('user_id' => $insert_details));
						$count										= 0;
						$count 										= $query->num_rows(); //counting result from query
						if ($count === 0) {
							$patient_minor['user_id']				= $insert_details;
							$patient_minor['created_by']			= $this->session->userdata('User')['id'];
							$patient_minor['created_date']			= date('Y-m-d H:i:s');
							$qry									= $this->db->insert('patient_nexttokin', $patient_minor);
						}else{
							$this->db->where('user_id',$insert_details);
							$qry									= $this->db->update('patient_nexttokin',$patient_minor);	
						}
					}
					$arr_msg										= array();
					if($qry){
						$arr_msg['response']						= 'success';
						$arr_msg['save_time']						= date('d/m/Y H:i:s');
						$arr_msg['user_key']						= $insert_details;
						
					}
				}else if($insert_details == 'exist'){
					$arr_msg['response']							= 'exist';
					
				}else if($insert_details == 0){
					$arr_msg['response']							= 'failed';
				}
				echo json_encode($arr_msg);
			}
		}
		
		function update_details(){
			if(isset($_POST['user_key']) && trim($_POST['user_key']) == ''){
				$arr_msg['response']						= 'UserInvalid';		
			}else{
				$this->db->where('user_id',trim($_POST['user_key']));
				$details									= array();
				$details['ethinic_origin']					= $_POST['ethinic_origin'];
				$details['languages']						= $_POST['languages'];
				$details['marital_status']					= $_POST['marital_status'];
				$details['modified_by']						= $this->session->userdata('User')['id'];
				$details['modified_date']					= date('Y-m-d H:i:s');
				$qry										= $this->db->update('user_personal_details',$details);
				$arr_msg									= array();
				if($qry){
					$arr_msg['response']					= 'success';
					$arr_msg['save_time']					= date('d/m/Y H:i:s');
				}else{
					$arr_msg['response']					= 'failed';	
				}
			}
			echo json_encode($arr_msg);
		}
		
		function patient_family_details(){
			if(!empty($_POST['data'])){
				$details											= $_POST['data'];
				$qry												= 0;
				if(isset($_POST['user_key']) && trim($_POST['user_key']) !=''){
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
							$query  								= $this->db->get_where('patient_family_details', array('user_id' => trim($_POST['user_key']),'relationship_id'=>$details['family_relation'][$key],'is_guardian'=>0));
							$count									= 0;
							$count 									= $query->num_rows(); //counting result from query
							if ($count === 0) {
								$save_details['relationship_id']	= $details['family_relation'][$key];
								$save_details['user_id']			= trim($_POST['user_key']);
								$save_details['created_by']			= $this->session->userdata('User')['id'];
								$save_details['created_date']		= date('Y-m-d H:i:s');
								$qry								= $this->db->insert('patient_family_details', $save_details);
							}else{
								$this->db->where(array('user_id'=>trim($_POST['user_key']),'relationship_id'=>$details['family_relation'][$key]));
								$qry								= $this->db->update('patient_family_details',$save_details);	
							} 
						}
					}
					if($qry){
						$family_details								= $this->account_setup_model->patient_minor(trim($_POST['user_key']),0);
						$array_details								= array();
						$i											= 0;
						$relationship								= $this->common->relationship_list();
						if(count($family_details)>0){
							foreach($family_details as $f_key => $f_val){
								$array_details[$i]					= (array)$f_val;
								if(isset($relationship[$f_val->relationship_id])){
									$array_details[$i]['relation']	= $relationship[$f_val->relationship_id];
								}else{
									$array_details[$i]['relation']	='';
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
				}else{
					$arr_msg['response']							= 'UserInvalid';;
				}
				echo json_encode($arr_msg);
			}
		}
		
		function patient_gp_details(){
			if(!empty($_POST['data'])){
				$details											= $_POST['data'];
				$qry												= 0;
				if(isset($_POST['user_key']) && trim($_POST['user_key']) !=''){
					foreach($details['gp_practice_name'] as $key =>$val){
						$save_details								= array();
						$save_details['user_id']					= trim($_POST['user_key']);
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
							$qry									= $this->db->insert('patient_gp_details', $save_details);
						}
					}
					if($qry){
						$gp_details									= $this->account_setup_model->gp_details(trim($_POST['user_key']));
						$array_details								= array();
						$i											= 0;
						$country									= $this->common->country_details();
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
				}else{
					$arr_msg['response']							= 'UserInvalid';
				}
				echo json_encode($arr_msg);
			}
		}
		
		function patient_chemist_details(){
			if(!empty($_POST['data'])){
				$details										= $_POST['data'];
				$qry											= 0;
				if(isset($_POST['user_key']) && trim($_POST['user_key']) !=''){
					foreach($details['chemist_pharmacy_name'] as $key =>$val){
						$save_details								= array();
						$save_details['user_id']					= trim($_POST['user_key']);
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
						$chemist_details							= $this->account_setup_model->chemist_details(trim($_POST['user_key']));
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
				}else{
					$arr_msg['response']							= 'UserInvalid';
				}
				echo json_encode($arr_msg);
			}
		}
		
		function patient_career_details(){
			if(!empty($_POST['data'])){
				$details											= $_POST['data'];
				$qry												= 0;
				if(isset($_POST['user_key']) && trim($_POST['user_key']) !=''){
					foreach($details['career_company_name'] as $key =>$val){
						$save_details								= array();
						$save_details['user_id']					= trim($_POST['user_key']);
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
						if($save_details['company_name'] =='' && $save_details['name'] =='' && $save_details['tel1']== '' && $save_details['email']	=='' && $save_details['address'] ==''  && $save_details['city']=='' && $save_details['state']=='' && $save_details['postcode']=='' && $save_details['country_id']==''){
						}else{
							$qry									= $this->db->insert('patient_career_details', $save_details);
						}
					}
					if($qry){
						$career_details								= $this->account_setup_model->career_details(trim($_POST['user_key']));
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
				}else{
					$arr_msg['response']							= 'UserInvalid';
				}
				echo json_encode($arr_msg);
			}
		}
		
		function save_uploaded_files(){
			if(isset($_POST) && !empty($_POST) && isset($_FILES) && !empty($_FILES)){
				if(isset($_POST['user_key']) && trim($_POST['user_key']) !=''){
					if(!is_dir(FCPATH .'assets/uploads/'.trim($_POST['user_key']).'/documents/')) {
						mkdir(FCPATH .'assets/uploads/'.trim($_POST['user_key']).'/documents/', 0777, true);
					}
					$result										= array();
					foreach($_FILES['file']['name'] as $key => $val){
						$data									= array();
						$tmp									= $_FILES['file']['tmp_name'][$key];
						$ext									= explode('.',$_FILES['file']['name'][$key]);
						$time_st								= time();
						$dst									= FCPATH.'assets/uploads/'.trim($_POST['user_key']).'/documents/'."document_".$key."_".trim($_POST['user_key']).'_'.$time_st.'.'.$ext[1];
						if(move_uploaded_file($tmp, $dst)){
							$data['file_name']					= "document_".$key."_".trim($_POST['user_key']).'_'.$time_st.'.'.$ext[1];
							$data['file_path']					= trim($_POST['user_key']).'/documents/';
						}
						$data['user_id']						= trim($_POST['user_key']);
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
					$result										= array('response'=>'UserInvalid');
				}
			}else{
				$result											= array('response'=>'failed');
			}
			echo json_encode($result);
		}
		
		function save_notes(){
			if(isset($_POST['type']) && trim($_POST['type']) != ''){
				if(isset($_POST['user_key']) && trim($_POST['user_key']) !=''){
					$save_details								= array();
					$save_details['user_id']					= trim($_POST['user_key']) ;
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
				}else{
					$result										= array('response'=>'UserInvalid');
				}
				echo json_encode($result);
			}
		}
		
		function update_notes(){
			if(isset($_POST)){
				if(isset($_POST['user_key']) && trim($_POST['user_key']) !=''){
					$save_details									= array();
					$qry											= 0;
					$save_details['modified_date']					= date('Y-m-d H:i:s');
					$save_details['modified_by']					= $this->session->userdata('User')['id'];
					$conditions										= array('id'=>$_POST['txt_id'],'user_id'=> trim($_POST['user_key']));
					$this->db->where($conditions);
					if(isset($_POST['type']) && $_POST['type']=='alert'){
						$save_details['alerts']						= trim($_POST['txt_alert']);
						$qry										= $this->db->update('patient_alerts',$save_details);
					}else if(isset($_POST['type']) && $_POST['type']=='notes'){
						$save_details['notes']						= trim($_POST['txt_alert']);
						$qry										= $this->db->update('patient_notes',$save_details);
					}
					if($qry){
						$result										= array('response'=>'success','saved_time'=>date("F j, Y, g:i a",strtotime($save_details['modified_date'])),'name'=>$this->session->userdata('User')['title'].' '.$this->session->userdata('User')['firstname'].' '.$this->session->userdata('User')['lastname']);
					}else{
						$result										= array('response'=>'failed');
					}
				}else{
					$result											= array('response'=>'UserInvalid');
				}
				echo json_encode($result);
			}
		}
		
		function remove_notes(){
			if(isset($_POST)){
				if(isset($_POST['user_key']) && trim($_POST['user_key']) !=''){
					$save_details									= array();
					$qry											= 0;
					$save_details['modified_date']					= date('Y-m-d H:i:s');
					$save_details['modified_by']					= $this->session->userdata('User')['id'];
					$save_details['status']							= 0;
					$this->db->where('id',$_POST['a']);
					if(isset($_POST['type']) && $_POST['type']=='alert'){
						$qry										= $this->db->update('patient_alerts',$save_details);
					}else if(isset($_POST['type']) && $_POST['type']=='notes'){
						$qry										= $this->db->update('patient_notes',$save_details);
					}
					if($qry){
						$result										= array('response'=>'success');
					}else{
						$result										= array('response'=>'failed');
					}
				}else{
					$result											= array('response'=>'UserInvalid');
				}
				echo json_encode($result);
			}
		}
		
		function save_consent(){
			if(isset($_POST['check_val']) && !empty($_POST['check_val'])){
				if(isset($_POST['user_key']) && trim($_POST['user_key']) !=''){
					$save_details								= array();
					$save_details['consent_value']				= implode(',',$_POST['check_val']);
					$save_details['modified_by']				= $this->session->userdata('User')['id'];
					$save_details['modified_date']				= date('Y-m-d H:i:s');
					$query  									= $this->db->get_where('patient_consent', array('user_id' => trim($_POST['user_key'])));
					$count										= 0;
					$count 										= $query->num_rows(); //counting result from query
					if($count > 0){
						$this->db->where('user_id',trim($_POST['user_key']));
						$qry									= $this->db->update('patient_consent', $save_details);
					}else{
						$save_details['user_id']				= trim($_POST['user_key']);
						$save_details['created_by']				= $this->session->userdata('User')['id'];
						$save_details['created_date']			= date('Y-m-d H:i:s');;
						$qry									= $this->db->insert('patient_consent', $save_details);
					}
					if($qry){
						$result									= array('response'=>'success','saved_time'=>date('d/m/Y H:i:s'),'name'=>$this->session->userdata('User')['firstname'].' '.$this->session->userdata('User')['lastname']);
					}else{
						$result									= array('response'=>'failed');
					}
				}else{
					$result										= array('response'=>'UserInvalid');
				}
				echo json_encode($result);
			}
		}
	
		
	}
?>
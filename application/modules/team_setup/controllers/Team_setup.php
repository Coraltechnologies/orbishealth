<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Team_setup extends CI_Controller {
		
		public function __construct(){
	
			parent::__construct();
			$this->load->model('team_setup_model');
			$this->load->model('account_setup/account_setup_model');
			$this->load->model('page/Page_model');
			$this->load->helper(array('form','url','loginvalidate'));
			$this->load->library(array('Common','EncryptionFunction','form_validation'));
			/*if(!$this->acl->hasAccess()){
				show_error('You do not have access to this section');
		    }*/
		}
		
		function index($user_id = null){
			$data												= array();
			$condition											= array('User.id'=>$this->session->userdata('User')['id']);
			$this->db->from('users as User');
			$this->db->join('medical_practice_details as MedicalPracticeDetail', 'MedicalPracticeDetail.user_id = User.id','LEFT');
			$this->db->select('User.*,User.created_date as user_start_date,MedicalPracticeDetail.*');
			$this->db->where($condition);
			$query 												= $this->db->get();
			$ret 												= $query->row();
			$roles												= $this->common->roles_list();
			$data['details']									= (array)$ret;
			$data['roles']										= $roles;
			$data['country']									= $this->common->country_details();
			$data['professional_body']							= $this->common->get_details();
			$data['languages']									= $this->common->language_list();
			$data['ethinic_details']							= $this->common->ethinic_details();
			$data['services']									= $this->common->service_name();
			
			if($user_id){
				if($user_id){
					$user_id									= $this->encryptionfunction->deCrypt($user_id);
				}
				$condition										= array('User.id'=>$user_id);
				$this->db->from('users as User');
				$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = User.id','LEFT');
				$this->db->join('user_address_details as UserAddressDetail', 'UserAddressDetail.user_id = User.id','LEFT');
				$this->db->join('user_professional_details as UserProfessionalDetail', 'UserProfessionalDetail.user_id = User.id','LEFT');
				$this->db->join('user_access_types as UserAccessType', 'UserAccessType.user_id = User.id','LEFT');
				$this->db->select('User.*,User.id as primary_key,User.created_date as user_start_date,UserPersonalDetail.*,UserAddressDetail.*,UserProfessionalDetail.*,UserAccessType.access_type_id');
				$this->db->where($condition);
				$query 											= $this->db->get();
				$ret 											= $query->row();
				$data['user_details']							= (array)$ret;
				$service_details								= $this->account_setup_model->user_services($user_id);
				$medical_bodies									= $this->account_setup_model->professional_reg_details($user_id);
				$other_bodies									= $this->account_setup_model->other_bodies_details($user_id);
				$uploads_medical								= $this->account_setup_model->professional_uploads($user_id);
				$uploads_others									= $this->account_setup_model->others_uploads($user_id);
				
				$user_roles										= $this->common->get_roles($user_id);
				$data['user_roles']								= $user_roles;
				$data['user_services']							= $service_details;
				$data['medical_bodies']							= $medical_bodies;
				$data['other_bodies']							= $other_bodies;
				$data['medical_body_type']						= $this->common->register_categories();
				$data['specialization']							= $this->common->get_specialization();
				$data['uploads_medical']						= $uploads_medical;
				$data['uploads_others']							= $uploads_others;
			}
			 
			//$data['']
			
			//$this->load->view('create_team',$data);
			$this->template->render_content('create_team',$data);
		}
		
		function non_clinic_registration(){
			if(!empty($_POST)){
 				$country_details							= $this->Page_model->country_code($_POST['NonClinical']['country_id']);
				$rand										= rand(10000,99999);
				if($country_details){
					$country_code							= $country_details->country_code_three;
				}
				if($country_code){
					$login_id 								= $this->Page_model->unique_user_name($country_code,$rand);
				}
				 
				$data										= array();
				$user_id									= '';
				if(isset($_POST['primary_key']) && $_POST['primary_key'] != ''){
					$user_id								= $_POST['primary_key'];
				}else{
					$data['login_id']						= $this->common->post($login_id);
					$string									= $this->common->generateRandomString();
					$pass									= $this->encryptionfunction->aes_encrypt($string);
					$data['password']						= $this->common->post($pass);
					$data['activation_code']				= $this->encryptionfunction->aes_encrypt($data['login_id']);
					$data['user_type']						= $this->config->item('professional');
					$data['created_date']					= date('Y-m-d H:i:s');
					$data['modified_date']					= date('Y-m-d H:i:s');
					$data['created_by']						= $this->session->userdata('User')['id'];
					$data['modified_by']					= $this->session->userdata('User')['id'];
				}
				
				$personal_details							= array();
				$personal_details['title']					= $this->common->post($_POST['NonClinical']['title']);
				$personal_details['firstname']				= $this->common->post($_POST['NonClinical']['firstname']);
				$personal_details['lastname']				= $this->common->post($_POST['NonClinical']['lastname']);
				$personal_details['gender']					= $this->common->post($_POST['NonClinical']['gender']);
				$personal_details['dob']					= implode('-', array_reverse(explode('/', $_POST['NonClinical']['dob'])));
				$personal_details['mobile']					= $this->common->post($_POST['NonClinical']['tel']);
				
				if(!isset($_POST['primary_key'])){
					$personal_details['primary_email']		= $this->common->post($_POST['NonClinical']['email']);
				}
				
				$address_details							= array();
				$address_details['address']					= $this->common->post($_POST['NonClinical']['address']);
				$address_details['city_town']				= $this->common->post($_POST['NonClinical']['city']);
				$address_details['state']					= $this->common->post($_POST['NonClinical']['state']);
				$address_details['country_id']				= $this->common->post($_POST['NonClinical']['country_id']);
				$address_details['postcode']				= $this->common->post($_POST['NonClinical']['postcode']);
				$access_type								= '';
				
				if($_POST['access_type'] == 'non-clinical_id'){
					$access_type							= $this->config->item('non-clinical');
				}else if($_POST['access_type'] == 'clinical_id'){
					$access_type							= $this->config->item('clinical');
				}else if($_POST['access_type'] == 'both_id'){
					$access_type							= $this->config->item('both');
				}
				$user_role									= '';
				$user_role									= $_POST['user_role'];
				if(isset($_POST['primary_key']) && $_POST['primary_key'] != ''){
					$qry									= $this->team_setup_model->update_details($user_id,$personal_details,$address_details,$access_type,$user_role);
				}else{
					$qry									= $this->team_setup_model->insert_details($data,$personal_details,$address_details,$access_type,$user_role);
				}
				$arr_msg									= array();
				if($qry['response'] == 1){
					if($qry['user_id'] != ''){
						if(isset($_FILES['prof']) && !empty($_FILES['prof'])){
							if(!is_dir(FCPATH .'assets/uploads/'.$qry['user_id'].'/profile_pic/')) {
								mkdir(FCPATH .'assets/uploads/'.$qry['user_id'].'/profile_pic/', 0777, true);
							}
							$tmp							= $_FILES['prof']['tmp_name'];
							$ext							= explode('.',$_FILES['prof']['name']);
							$time_st						= time();
							$dst							= FCPATH.'assets/uploads/'.$qry['user_id'].'/profile_pic/'.$_POST['NonClinical']['firstname']."_".$qry['user_id'].'_'.$time_st.'.'.$ext[1];
							if(move_uploaded_file($tmp, $dst)){
								$file_update['img_name']	= $_POST['NonClinical']['firstname'].'_'.$qry['user_id'].'_'.$time_st.'.'.$ext[1];
								$file_update['img_path']	= $qry['user_id'].'/profile_pic/';
								$this->db->where('user_id',$qry['user_id']);
								$this->db->update('user_personal_details',$file_update);
							}
						}
						
						if(isset($_FILES['document']) && !empty($_FILES['document'])){
							if(!is_dir(FCPATH .'assets/uploads/'.$qry['user_id'].'/documents/')) {
								mkdir(FCPATH .'assets/uploads/'.$qry['user_id'].'/documents/', 0777, true);
							}
							$cnt = 1;
							foreach($_FILES['document']['name'] as $key => $val){
								$data									= array();
								$tmp									= $_FILES['document']['tmp_name'][$key];
								$ext									= explode('.',$_FILES['document']['name'][$key]);
								$time_st								= time();
								$dst									= FCPATH.'assets/uploads/'.$qry['user_id'].'/documents/'."document_".$key."_".$qry['user_id'].'_'.$time_st.'.'.$ext[1];
								if(move_uploaded_file($tmp, $dst)){
									$data['file_name']					= "document_".$key."_".$qry['user_id'].'_'.$time_st.'.'.$ext[1];
									$data['file_path']					= $qry['user_id'].'/documents/';
								}
								$data['user_id']						= $qry['user_id'];
								$data['title']							= $_POST["non_text_$cnt"] ;
								$data['created_by']						= $this->session->userdata('User')['id'];
								$data['modified_by']					= $this->session->userdata('User')['id'];
								$data['created_date']					= date('Y-m-d H:i:s');
								$data['modified_date']					= date('Y-m-d H:i:s');
							
								$documents								= $this->db->insert('user_other_documents', $data);
								$cnt++;
							}
						}
					}
					$arr_msg['response']								= 'success';
					$arr_msg['user_key']								= $this->encryptionfunction->enCrypt($qry['user_id']);
				}else if($qry['response'] == 'exist'){
					$arr_msg['response']								= 'exist';
				}else{
					$arr_msg['response']								= 'failed';	
				}
				echo json_encode($arr_msg);
			}
		}
		
		function clinic_registration(){
			$result											= array();
			if(!empty($_POST)){
 				$country_details							= $this->Page_model->country_code($_POST['Clinical']['Country']);
				$rand										= rand(10000,99999);
				if($country_details){
					$country_code							= $country_details->country_code_three;
				}
				if($country_code){
					$login_id 								= $this->Page_model->unique_user_name($country_code,$rand);
				}
				
				$data										= array();
				if(isset($_POST['primary_key']) && $_POST['primary_key'] != ''){
					$user_id								= $_POST['primary_key'];
				}else{
					$data['login_id']						= $this->common->post($login_id);
					$string									= $this->common->generateRandomString();
					$pass									= $this->encryptionfunction->aes_encrypt($string);
					$data['password']						= $this->common->post($pass);
					$data['activation_code']				= $this->encryptionfunction->aes_encrypt($data['login_id']);
					$data['user_type']						= $this->config->item('professional');
					$data['created_date']					= date('Y-m-d H:i:s');
					$data['modified_date']					= date('Y-m-d H:i:s');
					$data['created_by']						= $this->session->userdata('User')['id'];
					$data['modified_by']					= $this->session->userdata('User')['id'];
				}
				
				$personal_details							= array();
				$personal_details['title']					= $this->common->post($_POST['Clinical']['Title']);
				$personal_details['firstname']				= $this->common->post($_POST['Clinical']['FirstName']);
				$personal_details['lastname']				= $this->common->post($_POST['Clinical']['LastName']);
				$personal_details['primary_email']			= $this->common->post($_POST['Clinical']['email']);
				$personal_details['gender']					= $this->common->post($_POST['Clinical']['Gender']);
				$personal_details['dob']					= implode('-', array_reverse(explode('/', $_POST['Clinical']['dob'])));
				$personal_details['mobile']					= $this->common->post($_POST['Clinical']['tel']);
				if(isset($_POST['Clinical']['Ethinic'])){
					$personal_details['ethinic_origin']		= $this->common->post($_POST['Clinical']['Ethinic']);
				}
				
				if(isset($_POST['Clinical']['Language'])){
					$personal_details['languages']		= $this->common->post(implode(',',$_POST['Clinical']['Language']));
				}
					
				$address_details							= array();
				$address_details['address']					= $this->common->post($_POST['Clinical']['Address']);
				$address_details['city_town']				= $this->common->post($_POST['Clinical']['City']);
				$address_details['state']					= $this->common->post($_POST['Clinical']['State']);
				$address_details['country_id']				= $this->common->post($_POST['Clinical']['Country']);
				$address_details['postcode']				= $this->common->post($_POST['Clinical']['Postcode']);
				$access_type								= '';
				
				$access_type								= '';
				if($_POST['access_type'] == 'non-clinical_id'){
					$access_type							= $this->config->item('non-clinical');
				}else if($_POST['access_type'] == 'clinical_id'){
					$access_type							= $this->config->item('clinical');
				}else if($_POST['access_type'] == 'both_id'){
					$access_type							= $this->config->item('both');
				}
				$user_role									= '';
				$user_role									= $_POST['user_role'];
				
				$prof_details								= array();
				$prof_details['qualifications']				= $this->common->post($_POST['Clinical']['qualifications'],true);
				$prof_details['memberships']				= $this->common->post($_POST['Clinical']['membership'],true);
				$prof_details['professional_exp']			= $this->common->post($_POST['Clinical']['professional_exp'],true);
				$prof_details['year_exp']					= $this->common->post($_POST['Clinical']['exp_years']);
				
				$prof_register_details						= array();
				$prof_register_details['country_id']		= $this->common->post($_POST['Clinical']['ProfCountry']);
				$prof_register_details['professional_id']	= $this->common->post($_POST['Clinical']['Professional']);
				$prof_register_details['specialization_id']	= $this->common->post($_POST['Clinical']['Specialization']);
				$prof_register_details['medical_bodies_id']	= $this->common->post($_POST['Clinical']['CountryReg']);
				$prof_register_details['register_number']	= $this->common->post($_POST['Clinical']['ProfNumber']);
				$prof_register_details['expiry_date']		= implode('-', array_reverse(explode('/',$_POST['Clinical']['ProfDate'])));
				
				$ico_reg									= array();
				$ico_reg['country_id']						= $this->common->post($_POST['Clinical']['ProfCountry']);
				$ico_reg['other_bodies_id']					= $this->config->item('ico');
				$ico_reg['register_number']					= $this->common->post($_POST['Clinical']['IcoNumber']);
				$ico_reg['expiry_date']						= implode('-', array_reverse(explode('/',$_POST['Clinical']['IcoDate'])));
					
				$idemnity_reg								= array();
				$idemnity_reg['country_id']					= $this->common->post($_POST['Clinical']['ProfCountry']);
				$idemnity_reg['other_bodies_id']			= $this->config->item('indemnity');
				$idemnity_reg['company_name']				= $this->common->post($_POST['Clinical']['IndemnityCompany']);
				$idemnity_reg['register_number']			= $this->common->post($_POST['Clinical']['IndemnityNumber']);
				$idemnity_reg['expiry_date']				= implode('-', array_reverse(explode('/',$_POST['Clinical']['IndemnityDate'])));
				
				if(isset($_POST['primary_key']) && $_POST['primary_key'] != ''){
					$qry									= $this->team_setup_model->update_details($user_id,$personal_details,$address_details,$access_type,$user_role,$prof_details,$prof_register_details,$ico_reg,$idemnity_reg);
				}else{
					$qry									= $this->team_setup_model->insert_details($data,$personal_details,$address_details,$access_type,$user_role,$prof_details,$prof_register_details,$ico_reg,$idemnity_reg);
				}
				//$qry										= $this->team_setup_model->insert_details($data,$personal_details,$address_details,$access_type,$user_role,$prof_details,$prof_register_details,$ico_reg,$idemnity_reg);
				if($qry['response'] == 1){
					//$services								= explode(',',$_POST['Clinical']['services']);
					
					$this->db->from('user_services');
					$this->db->where('user_id', $qry['user_id']);
					$get_service									= $this->db->get();
					if($get_service->num_rows() > 0){
						$this->db->where('user_id', $qry['user_id']);
						$this->db->delete('user_services');
					}
					
					foreach($_POST['Clinical']['services'] as $s_key =>$s_val){
						$ser_val									= array();
						$ser_val['user_id']							= $qry['user_id'];
						$ser_val['service_id']						= $s_val;
						$ser_val['created_by']						= $this->session->userdata('User')['id'];
						$ser_val['modified_by']						= $this->session->userdata('User')['id'];
						$ser_val['created_date']					= date('Y-m-d H:i:s');
						$ser_val['modified_date']					= date('Y-m-d H:i:s');
						$ser_query									= $this->db->insert('user_services', $ser_val);
					}
					if(isset($_FILES['prof']) && !empty($_FILES['prof'])){
						if(!is_dir(FCPATH .'assets/uploads/'.$qry['user_id'].'/profile_pic/')) {
							mkdir(FCPATH .'assets/uploads/'.$qry['user_id'].'/profile_pic/', 0777, true);
						}
						$tmp								= $_FILES['prof']['tmp_name'];
						$ext								= explode('.',$_FILES['prof']['name']);
						$time_st							= time();
						$dst								= FCPATH.'assets/uploads/'.$qry['user_id'].'/profile_pic/'.$_POST['Clinical']['FirstName']."_".$qry['user_id'].'_'.$time_st.'.'.$ext[1];
						if(move_uploaded_file($tmp, $dst)){
							$file_update['img_name']	= $_POST['Clinical']['FirstName'].'_'.$qry['user_id'].'_'.$time_st.'.'.$ext[1];
							$file_update['img_path']	= $qry['user_id'].'/profile_pic/';
							$this->db->where('user_id',$qry['user_id']);
							$this->db->update('user_personal_details',$file_update);
						}
					}
					if(isset($_FILES['document']) && !empty($_FILES['document'])){
						
						if(!is_dir(FCPATH .'assets/uploads/'.$qry['user_id'].'/documents/')) {
							mkdir(FCPATH .'assets/uploads/'.$qry['user_id'].'/documents/', 0777, true);
						}
						$cnt = 1;
						foreach($_FILES['document']['name'] as $key => $val){
							$data									= array();
							$tmp									= $_FILES['document']['tmp_name'][$key];
							$ext									= explode('.',$_FILES['document']['name'][$key]);
							$time_st								= time();
							$dst									= FCPATH.'assets/uploads/'.$qry['user_id'].'/documents/'."document_".$key."_".$qry['user_id'].'_'.$time_st.'.'.$ext[1];
							if(move_uploaded_file($tmp, $dst)){
								$data['file_name']					= "document_".$key."_".$qry['user_id'].'_'.$time_st.'.'.$ext[1];
								$data['file_path']					= $qry['user_id'].'/documents/';
								$data['user_id']					= $qry['user_id'];
								$data['title']						= $this->common->post($_POST["clinical_text_$cnt"]) ;
								$data['created_by']					= $this->session->userdata('User')['id'];
								$data['modified_by']				= $this->session->userdata('User')['id'];
								$data['created_date']				= date('Y-m-d H:i:s');
								$data['modified_date']				= date('Y-m-d H:i:s');
								$documents							= $this->db->insert('user_other_documents', $data);
							}
							$cnt++;
						}
					}
					
					if(isset($_FILES['prof_doc']) && !empty($_FILES['prof_doc'])){
						$data										= array();
						if(!is_dir(FCPATH .'assets/uploads/'.$qry['user_id'].'/documents/')) {
							mkdir(FCPATH .'assets/uploads/'.$qry['user_id'].'/documents/', 0777, true);
						}
						$tmp										= $_FILES['prof_doc']['tmp_name'];
						$ext										= explode('.',$_FILES['prof_doc']['name']);
						$time_st									= time();
						$rand										= rand(0,10000);
						$dst										= FCPATH.'assets/uploads/'.$qry['user_id'].'/documents/document_'.$qry['user_id'].'_'.$time_st.$rand.'.'.$ext[1];
						if(move_uploaded_file($tmp, $dst)){
							$data['user_id']						= $qry['user_id'];
							$data['country_id']						= $this->common->post($_POST['Clinical']['ProfCountry']);
							$data['medical_bodies']					= $this->common->post($_POST['Clinical']['CountryReg']);
							$data['title']							= $this->common->post($_POST["prof_text"]) ;
							$data['file_name']						= 'document_'.$qry['user_id'].'_'.$time_st.$rand.'.'.$ext[1];
							$data['file_path']						= $qry['user_id'].'/documents/';
							$data['created_by']						= $this->session->userdata('User')['id'];
							$data['modified_by']					= $this->session->userdata('User')['id'];
							$data['created_date']					= date('Y-m-d H:i:s');
							$data['modified_date']					= date('Y-m-d H:i:s');
							$prof_doc								= $this->db->insert('user_professional_documents', $data);
						}
					}
					
					if(isset($_FILES['ico_doc']) && !empty($_FILES['ico_doc'])){
						$data										= array();
						if(!is_dir(FCPATH .'assets/uploads/'.$qry['user_id'].'/documents/')) {
							mkdir(FCPATH .'assets/uploads/'.$qry['user_id'].'/documents/', 0777, true);
						}
						$tmp										= $_FILES['ico_doc']['tmp_name'];
						$ext										= explode('.',$_FILES['ico_doc']['name']);
						$time_st									= time();
						$rand										= rand(0,10000);
						$dst										= FCPATH.'assets/uploads/'.$qry['user_id'].'/documents/document_'.$qry['user_id'].'_'.$time_st.$rand.'.'.$ext[1];
						if(move_uploaded_file($tmp, $dst)){
							$data['user_id']						= $qry['user_id'];
							$data['country_id']						= $this->common->post($_POST['Clinical']['ProfCountry']);
							$data['other_bodies_id']				= $this->config->item('ico');
							$data['title']							= $this->common->post($_POST["ico_text"]) ;
							$data['file_name']						= 'document_'.$qry['user_id'].'_'.$time_st.$rand.'.'.$ext[1];
							$data['file_path']						= $qry['user_id'].'/documents/';
							$data['created_by']						= $this->session->userdata('User')['id'];
							$data['modified_by']					= $this->session->userdata('User')['id'];
							$data['created_date']					= date('Y-m-d H:i:s');
							$data['modified_date']					= date('Y-m-d H:i:s');
							$prof_doc								= $this->db->insert('user_professional_documents', $data);
						}
					}
					
					if(isset($_FILES['indemnity_doc']) && !empty($_FILES['indemnity_doc'])){
						$data										= array();
						if(!is_dir(FCPATH .'assets/uploads/'.$qry['user_id'].'/documents/')) {
							mkdir(FCPATH .'assets/uploads/'.$qry['user_id'].'/documents/', 0777, true);
						}
						$tmp										= $_FILES['indemnity_doc']['tmp_name'];
						$ext										= explode('.',$_FILES['indemnity_doc']['name']);
						$time_st									= time();
						$rand										= rand(0,10000);
						$dst										= FCPATH.'assets/uploads/'.$qry['user_id'].'/documents/document_'.$qry['user_id'].'_'.$time_st.$rand.'.'.$ext[1];
						if(move_uploaded_file($tmp, $dst)){
							$data['user_id']						= $qry['user_id'];
							$data['country_id']						= $this->common->post($_POST['Clinical']['ProfCountry']);
							$data['other_bodies_id']				= $this->config->item('indemnity');
							$data['title']							= $this->common->post($_POST["indemnity_text"]) ;
							$data['file_name']						= 'document_'.$qry['user_id'].'_'.$time_st.$rand.'.'.$ext[1];
							$data['file_path']						= $qry['user_id'].'/documents/';
							$data['created_by']						= $this->session->userdata('User')['id'];
							$data['modified_by']					= $this->session->userdata('User')['id'];
							$data['created_date']					= date('Y-m-d H:i:s');
							$data['modified_date']					= date('Y-m-d H:i:s');
							$prof_doc								= $this->db->insert('user_professional_documents', $data);
						}
					}
					$result											= array('response'=>'success','user_key'=>$this->encryptionfunction->enCrypt($qry['user_id']));
				}else if($qry['response']=='exist'){
					$result											= array('response'=>'exist');
				}else{
					$result											= array('response'=>'failed');
				}
				echo  json_encode($result);
			}
		}
		
		function get_roles(){
			$reponse												= [];
			if(isset($_POST) && !empty($_POST)){
				$param												= '';
				if($_POST['a'] == 'clinical'){
					$param											=	1;
				}else if($_POST['a'] == 'non-clinical'){
					$param											=	2;
				}
				$list												= $this->common->roles_list($param);
				if(!empty($list)){		
					$list_option									= '';
					foreach($list as $key  => $val){
						$list_option								= $list_option.'<option value="'.$key.'">'.$val.'</option>';
					}
					$reponse										= array('response'=>'success','list'=>$list_option);
				}else{
					$reponse										= array('reponse'=>'failed');
				} 
			}else{
				$reponse											= array('reponse'=>'failed');
			}
			echo json_encode($reponse);
		}
		
		function summary($user_id = null){
			if($user_id){
				$user_id									= $this->encryptionfunction->deCrypt($user_id);
			}
			
			$data											= array();
			$condition										= array('User.id'=>$this->session->userdata('User')['id']);
			$this->db->from('users as User');
			$this->db->join('medical_practice_details as MedicalPracticeDetail','MedicalPracticeDetail.user_id = User.id','LEFT');
			$this->db->select('User.*,User.created_date as user_start_date,MedicalPracticeDetail.*');
			$this->db->where($condition);
			$query 											= $this->db->get();
			$ret 											= $query->row();
			$data['details']								= (array)$ret;
			$condition										= array('User.id'=>$user_id);
			$this->db->from('users as User');
			$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = User.id','LEFT');
			$this->db->join('user_address_details as UserAddressDetail', 'UserAddressDetail.user_id = User.id','LEFT');
			$this->db->join('user_professional_details as UserProfessionalDetail', 'UserProfessionalDetail.user_id = User.id','LEFT');
			$this->db->join('user_access_types as UserAccessType', 'UserAccessType.user_id = User.id','LEFT');
			$this->db->select('User.*,User.id as user_key,User.created_date as user_start_date,UserPersonalDetail.*,UserAddressDetail.*,UserProfessionalDetail.*,UserAccessType.access_type_id');
			$this->db->where($condition);
			$query 											= $this->db->get();
			$ret 											= $query->row();
			$data['user_details']							= (array)$ret;
			$service_details								= $this->account_setup_model->user_services($user_id);
			$medical_bodies									= $this->account_setup_model->professional_reg_details($user_id);
			$other_bodies									= $this->account_setup_model->other_bodies_details($user_id);
			$uploads_medical								= $this->account_setup_model->professional_uploads($user_id);
			$uploads_others									= $this->account_setup_model->others_uploads($user_id);
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
			if($data['user_details']['access_type_id'] == $this->config->item('both') || $data['user_details']['access_type_id'] == $this->config->item('clinical')){
				//$this->load->view('clinical_summary',$data);
				$this->template->render_content('clinical_summary',$data);
			}else{
				//$this->load->view('non_clinical_summary',$data);
				$this->template->render_content('non_clinical_summary',$data);
			}
		}
		
		function manage_team($user_id = null){
			$data											= array();
			$condition										= array('User.id'=>$this->session->userdata('User')['id']);
			$this->db->from('users as User');
			$this->db->join('medical_practice_details as MedicalPracticeDetail', 'MedicalPracticeDetail.user_id = User.id','LEFT');
			$this->db->select('User.*,User.created_date as user_start_date,MedicalPracticeDetail.*');
			$this->db->where($condition);
			$query 											= $this->db->get();
			$ret 											= $query->row();
			$data['details']								= (array)$ret;
			$prof_details									= $this->team_setup_model->professional_details($this->session->userdata['User']['id']);
			$data['prof_details']							= $prof_details;
			$roles											= $this->common->roles_list();
			$data['role']									= $roles;
			if($user_id){
				$user_id									= $this->encryptionfunction->deCrypt($user_id); 
				$data['search_key']							= $user_id;
			}
			$this->template->render_content('manage_team',$data);
		}
		
		function search_members(){
			$result											= array();
			if($_POST && !empty($_POST)){
				$condition									= array();
				if(isset($_POST['name']) && trim($_POST['name'])){
					$condition['name']						= trim($_POST['name']);
				}
				if(isset($_POST['status']) && trim($_POST['status'])){
					$condition['status']					= trim($_POST['status']);
				}
				if(isset($_POST['role']) && trim($_POST['role'])){
					$condition['role']						= trim($_POST['role']);
				}
				$prof_details								= $this->team_setup_model->professional_details($this->session->userdata['User']['id'],$condition);
				$data['prof_details']						= $prof_details;
				$roles										= $this->common->roles_list();
				$data['role']								= $roles;
				$result['response']							= 'success';
				$result['content']							= $this->load->view('ajax_manage_team',$data,true);
				$result['data_count']						= count((array)$prof_details) ;
			}else{
				$result['response']							= 'failed';
			}
			echo json_encode($result);
		}
		
		function change_status(){
			$result											= array();
			if($_POST && !empty($_POST)){
				$user_id 									= $this->encryptionfunction->deCrypt($_POST['a']);
				$condition									= array('id'=>$user_id);
				$this->db->from('users');
				$this->db->select('status');
				$this->db->where($condition);
				$query 										= $this->db->get();
				$ret 										= $query->row();
				$status										= '';
				if($ret->status == 'active'){
					$update									= array('status' =>'inactive');
					$this->db->where('id',$user_id);
					$qry									= $this->db->update('users',$update);
					$status									= 'inactive';
				}else{
					$update									= array('status' =>'active');
					$this->db->where('id',$user_id);
					$qry									= $this->db->update('users',$update);
					$status									= 'active';
				}
				if($qry){
					$result['response']						= 'success';
					$result['status']						= $status;
				}else{
					$result['response']						= 'failed';
				}
			}else{
				$result['response']							= 'failed';
			}
			echo json_encode($result);
		}
		
	
	}
?>
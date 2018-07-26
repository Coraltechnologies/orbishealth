<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {
	
	public function __construct(){

		parent::__construct();
		/////include model file
		//$this->load->model('Welcome_model');
		$this->load->model('Page_model');
		$this->load->model('users/Users_model');
		$this->load->helper(array('form','url','email','loginvalidate'));
		$this->load->library(array('Common','EncryptionFunction','form_validation','CommonEmail','email','encrypt'));
	}
	
	function index($action = null){	
		$data									= array();
		if(isset($_POST) && !empty($_POST)){
			/*echo "<pre>";
			print_r($_POST);
			exit;
		/*	echo $this->config->item('professional');
			exit;
		*/
			$this->form_validation->set_rules('ForeName','ForeName','trim|required');
			$this->form_validation->set_rules('LastName','LastName','trim|required');
			if(isset($_POST['ProfessionalType'])){
				$this->form_validation->set_rules('ProfessionalType','ProfessionalType','trim|required');
			}
			$this->form_validation->set_rules('EmailId','EmailId','trim|required|valid_email');
			$this->form_validation->set_rules('Country','Country','trim|required');
			$this->form_validation->set_rules('Mobile','Mobile','trim|required');
			if($this->form_validation->run()){
				$country_details							= $this->Page_model->country_code($_POST['Country']);
				$rand										= rand(10000,99999);
				if($country_details){
					$country_code							= $country_details->country_code_three;
				}
				if($country_code){
					$login_id 								= $this->Page_model->unique_user_name($country_code,$rand);
				}
				 
				$data										= array();
				$data['login_id']							= $this->common->post($login_id);
				$string										= $this->common->generateRandomString();
				$pass										= $this->encryptionfunction->aes_encrypt($string);
				$data['password']							= $this->common->post($pass);
				$data['activation_code']					= sha1($data['login_id']); //$this->encryptionfunction->aes_encrypt($data['login_id']);
				$data['user_type']							= $_POST['UserType'];
				$data['created_date']						= date('Y-m-d H:i:s');
				$data['modified_date']						= date('Y-m-d H:i:s');
			 
				
				$personal_details['primary_email']			= $this->common->post($_POST['EmailId']);
				if($_POST['UserType'] == $this->config->item('medical_practice')){
					$personal_details['tel1']				= $this->common->post($_POST['Mobile']);
					$personal_details['practice_name']		= $this->common->post($_POST['HospitalName']);
					$personal_details['owner_name']			= $this->common->post($_POST['ForeName']).' '.$this->common->post($_POST['LastName']);
					$personal_details['country_id']			= $_POST['Country'];
				}else{
					$personal_details['firstname']			= $this->common->post($_POST['ForeName']);
					$personal_details['lastname']			= $this->common->post($_POST['LastName']);
					$personal_details['mobile']				= $this->common->post($_POST['Mobile']);	
				}
				$fullname                                   = $this->common->post($_POST['ForeName']).' '.$this->common->post($_POST['LastName']);
				
				$prof_details								= array();
				$result										= $this->Page_model->insert_details($data,$personal_details,$_POST['UserType'],$_POST['Country']);
				if($result == 'exist'){
					$data['register']						= 'exist';
				}else if($result == 1 ){
					$email_data                         = array();
                    $email_data['to_email']             = $this->common->post($_POST['EmailId']);
                    $email_data['to_name']              = $fullname;
                    $email_data['activation_code']      = $data['activation_code'];
                    $email_data['login_id']             = $this->encryptionfunction->aes_encrypt($data['login_id']);
                    
                    $this->commonemail->register_email($email_data);
					
					$data['register']						= 1;
					/*$this->email->from('admin@orbishealth.com','Orbis Health Team');
					$this->email->to($this->common->post($_POST['EmailId']),$this->common->post($_POST['ForeName']));
					$this->email->subject('Registration Test');
					$this->email->set_mailtype("html");
					$content	='<strong>Orbis Health Credentials</strong><br/><br/>User Id : '.$data['login_id'].'<br/>Password : '.$string;
					$this->email->message($content);
					$this->email->send();*/
				}else if($result == 0){
					$data['register']				= 0;
				}
			}else{
				$data['register']					= 'invalid';
			}
		}
		$prof_body							= $this->common->get_details();
		$data['prof_body']					= $prof_body;
		$country							= $this->common->country_details();
		$data['country']					= $country;
		
		if(!$action){
			#$this->load->view('index');
			$this->template->render_content('index',$data);
		}else if($action == 'professional-reg'){
			#$this->load->view('professional_reg',$data);
			$this->template->render_content('professional_reg',$data);
		}else if($action == 'practice-reg'){
			#$this->load->view('practice_reg',$data);
			$this->template->render_content('practice_reg',$data);
		}else if($action == 'patient-reg'){
			#$this->load->view('patient_reg',$data);
			$this->template->render_content('patient_reg',$data);
		}
		
	}
	
	function country_select(){
		$code					= $_POST['code'];
		$country				= $this->Page_model->country_code($code);
		if($country){
			echo $country->mobile_code;
		}
	}
	
	function login($action = null){
		if(isset($_POST) && !empty($_POST)){
			$this->form_validation->set_rules('username','UserName','trim|required');
			$this->form_validation->set_rules('password','Password','trim|required');
			if($this->form_validation->run()){
				$user_id							= $_POST['username'];
				$pass								= $this->encryptionfunction->aes_encrypt($_POST['password']);
				/*$condition						= array('User.login_id'=>$user_id,'User.password'=>$pass,'User.status'=>'active');
				$this->db->from('users as User');
				$this->db->select('User.id,User.user_type');
				$this->db->where($condition);
				$query								= $this->db->get();
				if($query->row()){
					$details						= $query->row_array();
					$this->session->set_userdata('User', $query->row_array());
					$data							= array('last_login_time'=>date('Y-m-d H:i:s'));
					$this->db->where('id',$details['id']);
					$this->db->update('users',$data);
					redirect('/account_setup');
				}else{
					$this->session->set_flashdata('login_failed', 'Invalid Credentials..');
					redirect('/page/index/'.$action);
					exit;
				}*/
				$result = $this->Users_model->login($user_id, $pass);
				if(count($result) > 0){			
					
					/* User Activies start */
					$user_activies                      = array();
					$user_activies['user_id'] 		    = $result['id']; //User iD
					$user_activies['is_web'] 		    = 1;
					$user_activies['ip_web'] 		    = $_SERVER['REMOTE_ADDR'];
					$user_activies['web_current_date'] 	= date('Y-m-d H:i:s');
					$user_activies['created'] 	        = date('Y-m-d H:i:s');
					$user_activies['modified'] 	        = date('Y-m-d H:i:s');
					$user_activies_data                 = $this->Users_model->user_activies_data($user_activies, 'web');
					
					if(count($user_activies_data) > 0){
						$result['last_login_date'] = $user_activies_data['web_last_used_date'];
					}
					/*User Activies Ends */	
					
					$this->session->set_userdata('User', $result);					
					redirect('/account_setup');
					exit;
				}else{
					$this->session->set_flashdata('login_failed', 'Invalid Credentials..');
					redirect('/page/index/'.$action);
					exit;
				}
			}else{
				$this->session->set_flashdata('login_failed', 'Invalid Details format..');
				redirect('/page/index/'.$action);
				exit;
			}
		}else{
			redirect('/');
			exit;
		}
	}
	
	function confirmation($active_code){		
		$data       	= array();
		$users_data		= array();
		$msg 			= '';
		$user_type  	= '';
		$update_email 	= 0;
		if($active_code){			
			$user_details = $this->Users_model->check_email_activation($active_code);			
			if(count($user_details) > 0){
				$user_type		= $user_details['user_type'];
				$login_id		= $user_details['login_id'];
				$uID			= $user_details['id'];
				$email_confirm	= $user_details['email_confirm'];
				
				#Check url expire start
				$datetime1 	= date_create(date('Y-m-d', strtotime($user_details['created_date'])));
				$datetime2 	= date_create(date('Y-m-d'));
				$interval 	= date_diff($datetime1, $datetime2);				
				$countPM 	= (int)$interval->format('%a');
				#CHeck url expire ends
				
				if($countPM > $this->config->item('email_confirmation_days')){
					$data['activation_msg'] 	= 'Your url expired';
					$data['activation_status'] 	= 'expired';
				} else {
					if($email_confirm != 1){
						$string							= $this->common->generateRandomString();
						$pass							= $this->encryptionfunction->aes_encrypt($string);
						$users_data['password']  		= $pass;
						$users_data['email_confirm']	= 1;
						$update_email 					= $this->Users_model->update_users($users_data, $uID);
						
						if($update_email){
							$addtion_user_data = $this->common->users_validate($user_details);
							
							if(count($addtion_user_data) > 0){
								$email_data = array();
								if($user_type == $this->config->item('medical_practice')){
									$fullname = $addtion_user_data['owner_name'];
								} else {
									$fullname = $addtion_user_data['firstname'].''.$addtion_user_data['lastname'];
								}
								
								$email_data['to_email']             = $addtion_user_data['primary_email'];
								$email_data['to_name']              = $fullname;							
								$email_data['login_id']             = $login_id;
								$email_data['password']             = $string;							
								$register_confirm_email 			= $this->commonemail->register_confirm_email($email_data);
								
								if($register_confirm_email){
									$data['activation_msg'] 	= 'Your account activated successfully';
									$data['activation_status'] 	= 'success';
								} 
							} else {
								$data['activation_msg'] 	= 'Your account already activated successfully';
								$data['activation_status'] 	= 'exist';
							}
						}
					} else {
						$data['activation_msg'] 	= 'Your account already activated successfully';
						$data['activation_status'] 	= 'exist';
					}
				}				
			} else {
				$data['activation_msg'] 	= 'Please check the url';
				$data['activation_status'] 	= 'fail';
			}
		} else{
			$data['activation_msg'] 	= 'Please check the url';
			$data['activation_status'] 	= 'fail';
		}
		
		if(!$user_type){
			$this->template->render_content('index',$data);
		}else if($user_type == $this->config->item('professional')){
			$this->template->render_content('professional_reg',$data);
		}else if($user_type == $this->config->item('medical_practice')){
			$this->template->render_content('practice_reg',$data);
		}else if($user_type == $this->config->item('patient')){
			$this->template->render_content('patient_reg',$data);
		}
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect('/page/index/');
	}
}
?>
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {
	
	public function __construct(){

		parent::__construct();
		/////include model file
		$this->load->model('Page_model');
        $this->load->model('users/Users_model');
		$this->load->helper(array('form','url','email','loginvalidate'));
		$this->load->library(array('Common','EncryptionFunction','form_validation','CommonEmail','email'));
	}

	function index($action = null){
        echo 'tedst1';
        exit;
    }
    
    function login(){
        $response       = array();
        if(($this->input->method() == 'post') AND !empty($this->input->post())){
            $user_name	= $this->common->post($this->input->post('username'));            
            $password 	= $this->common->post($this->input->post('password'));            
           
            if(empty($user_name)){
                $response = array('status'=>'fail','reason'=>'username_empty');
            }
            else if(empty($password)){
                $response = array('status'=>'fail','reason'=>'password_empty');
            }else{
                if(!empty($user_name)&&!empty($password)) {
                    
                    $result = $this->Users_model->login($user_name, $this->encryptionfunction->aes_encrypt($password));
                    if(count($result) > 0){
                        $userdata  = $this->common->users_validate($result);
                        
						if($result['user_type'] == $this->config->item('medical_practice')){
							if(count($userdata) > 0){
								$result['owner_name']   = $userdata['owner_name'];								
								$result['primary_email']= $userdata['primary_email'];
								$result['practice_name']= $userdata['practice_name'];
							}
							
							if($result['registration_complete'] == 0){
								$get_medical_practice_details = $this->Users_model->get_medical_practice_details($result['id']);
								if(count($get_medical_practice_details) > 0){
									$result['medical_practice_details'] = $get_medical_practice_details;
								}
							}
						} else {
							if(count($userdata) > 0){
								$result['firstname']    = $userdata['firstname'];
								$result['lastname']     = $userdata['lastname'];
								$result['title']        = $userdata['title'];
								$result['img_name']     = $userdata['img_name'];
								$result['img_path']     = $userdata['img_path'];
							}
						}
                        
                        /* User Activies start */
                        $user_activies                      = array();
                        $user_activies['user_id'] 		    = $result['id']; //User iD
                        $user_activies['is_app'] 		    = 1;
                        $user_activies['used_app'] 		    = 'iOS';
                        $user_activies['app_current_date'] 	= date('Y-m-d H:i:s');
                        $user_activies['created'] 	        = date('Y-m-d H:i:s');
                        $user_activies['modified'] 	        = date('Y-m-d H:i:s');
                        $user_activies_data                 = $this->Users_model->user_activies_data($user_activies, 'app');
                        
                        if(count($user_activies_data) > 0){
                            $result['last_login_date'] = $user_activies_data['app_last_used_date'] ? $user_activies_data['app_last_used_date'] : '';
                        }
                        /*User Activies Ends */
                        
                       
                        /* User Token start */
                        $user_token                 = array();
                        $token = md5(uniqid(rand(),true));
                        $user_token['user_id'] 		= $result['id']; //User iD
                        $user_token['token'] 		= $token;
                        $user_token['created'] 		= date('Y-m-d H:i:s');
                        $user_token['modified'] 	= date('Y-m-d H:i:s');
                        $token_data = $this->Users_model->insert_token($user_token);
                        
                        if(count($token_data) > 0){
                            $result['token']        = $token_data['token'];
                        }
                        /*User Token Ends */                        
                        $result_sts['status']        = 'success';
                        
                        $result                      = $result_sts + $result;
                        
                        $response                    = $result;
                        
                    } else {
                        $response = array('status'=>'error','reason'=>'login_failed');
                    }
                } else {
                    $response = array('status'=>'error','reason'=>'invaild_username_password');
                }
            }
        }
        
        echo json_encode($response);
        exit;
    }
    
    function register(){
        $response       = array();
        if(($this->input->method() == 'post') AND !empty($this->input->post())){
            $forname	        = $this->common->post($this->input->post('ForeName'));            
            $lastname 	        = $this->common->post($this->input->post('LastName'));
            $emailid	        = $this->common->post($this->input->post('EmailId'));            
            $country 	        = $this->common->post($this->input->post('Country'));
            $mobile 	        = $this->common->post($this->input->post('Mobile'));
            $hospital_name      = @$this->common->post($this->input->post('HospitalName'));
            $professional_type  = @$this->common->post($this->input->post('ProfessionalType'));
            $usertype 	        = $this->common->post($this->input->post('UserType'));
            $accept_terms 	    = $this->common->post($this->input->post('AcceptTerms'));
            
            $this->form_validation->set_rules('ForeName','Forename','trim|required');
            $this->form_validation->set_rules('LastName','lastname','trim|required');
            $this->form_validation->set_rules('EmailId','Email Address','trim|required|valid_email');
            $this->form_validation->set_rules('Country','country','trim|required');
            $this->form_validation->set_rules('Mobile','mobile','trim|required');
            
            if($usertype == $this->config->item('medical_practice')){
                $this->form_validation->set_rules('HospitalName','hospital name','trim|required');
            }
            
            if($usertype == $this->config->item('professional')){
                $this->form_validation->set_rules('ProfessionalType','professional type','trim|required');
            }
            
            $this->form_validation->set_rules('AcceptTerms','accept terms','trim|required');

            if ($this->form_validation->run() == FALSE) {
                //echo validation_errors();
                if(empty($forname)){
                    $response = array('status'=>'fail','reason'=>'forname_empty');
                }
                else if(empty($lastname)){
                    $response = array('status'=>'fail','reason'=>'lastname_empty');
                }
                else if(empty($emailid)){
                    $response = array('status'=>'fail','reason'=>'email_empty');
                }
                else if(!filter_var($emailid, FILTER_VALIDATE_EMAIL)){
                    $response = array('status'=>'fail','reason'=>'vaild_email');
                }
                else if(empty($country)){
                    $response = array('status'=>'fail','reason'=>'country_empty');
                }
                else if(empty($mobile)){
                    $response = array('status'=>'fail','reason'=>'mobile_empty');
                }
                else if($usertype == $this->config->item('medical_practice')){
                    if(empty($hospital_name)){
                        $response = array('status'=>'fail','reason'=>'hospital_name_empty');
                    }
                }
                else if($usertype == $this->config->item('professional')){
                    if(empty($professional_type)){
                        $response = array('status'=>'fail','reason'=>'professional_type_empty');
                    }
                }
                else if(empty($accept_terms)){
                    $response = array('status'=>'fail','reason'=>'accept_terms_empty');
                }
            } else {
                
                $country_details							= $this->Page_model->country_code($country);
                
				$rand										= rand(10000,99999);
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
				$data['user_type']							= $usertype;
				$data['created_date']						= date('Y-m-d H:i:s');
				$data['modified_date']						= date('Y-m-d H:i:s');
                
                $personal_details['primary_email']			= $emailid;
                if($usertype == $this->config->item('medical_practice')){
					$personal_details['tel1']				= $mobile;
					$personal_details['practice_name']		= $hospital_name;
					$personal_details['owner_name']			= $forname.' '.$lastname;
					$personal_details['country_id']			= $country;
				}else{
					$personal_details['firstname']			= $forname;
					$personal_details['lastname']			= $lastname;
					$personal_details['mobile']				= $mobile;	
				}
                
                $fullname                                   = $forname.' '.$lastname;
                
                $prof_details								= array();
				$result										= $this->Page_model->insert_details($data, $personal_details, $usertype, $country);
                
                if($result == 'exist'){
					$response = array('status'=>'fail','reason'=>'exist');
				}else if($result == 1){
                    $email_data                         = array();
                    $email_data['to_email']             = $emailid;
                    $email_data['to_name']              = $fullname;
                    $email_data['activation_code']      = $data['activation_code'];
                    $email_data['login_id']             = $this->encryptionfunction->aes_encrypt($data['login_id']);
                    
                    $this->commonemail->register_email($email_data);
					$response = array('status'=>'success', 'reason'=>'Register Success! Please check your email for login credentials.');
                    
					/*$this->email->from('admin@orbishealth.com','Orbis Health Team');
					$this->email->to($this->common->post($_POST['EmailId']),$this->common->post($_POST['ForeName']));
					$this->email->subject('Registration Test');
					$this->email->set_mailtype("html");
					$content	='<strong>Orbis Health Credentials</strong><br/><br/>User Id : '.$data['login_id'].'<br/>Password : '.$string;
					$this->email->message($content);
					$this->email->send();*/
                    
				}else if($result == 0){
					$response = array('status'=>'fail','reason'=>'Please try after sometime.');
				}
            }
        }
        echo json_encode($response);
        exit;
    }
}
?>
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {
	
	public function __construct(){

		parent::__construct();
		/////include model file
		$this->load->model('page/Page_model');
        $this->load->model('users/Users_model');
		$this->load->helper(array('form','url','email','loginvalidate'));
		$this->load->library(array('Common','EncryptionFunction','form_validation','CommonEmail','email'));
	}
	
	function profile_image_upload(){		
		$response = array();		
		if(($this->input->method() == 'post') AND !empty($this->input->post())){			
			$user_id	        = $this->common->post($this->input->post('user_id'));            
            $token	        	= $this->common->post($this->input->post('token'));
			$filename	        = $_FILES['profile_img']['name'];
			
			$this->form_validation->set_rules('user_id','User ID','trim|required');
			$this->form_validation->set_rules('token','Token','trim|required');
           
			
			if ($this->form_validation->run() == FALSE) {
                //echo validation_errors();
                if(empty($user_id)){
                    $response = array('status'=>'fail','reason'=>'user_id');
                }				
                else if(empty($token)){
                    $response = array('status'=>'fail','reason'=>'token_empty');
                }		
			} else {	
				
				$check_token = $this->Users_model->check_user_token($user_id, $token);				
				
				if(count($check_token) > 0) {		
					if(isset($_FILES['profile_img']) && !empty($_FILES['profile_img']['name'])){
						
						$ext 							= pathinfo($filename, PATHINFO_EXTENSION);
						
						$upload_path 					= FCPATH .'assets/uploads/'.$user_id.'/'.$this->config->item('profile_img_folder').'/';
						if(!is_dir($upload_path)) {
							mkdir($upload_path, 0777, true);
						}
						$time_st						= time();
						
						$user_type = $this->common->check_user_type($user_id);
						$userdata  = $this->common->users_validate(array('id'=>$user_id, 'user_type'=>$user_type));
						
						if(count($userdata) > 0){
							$firstname    			= $userdata['firstname'];
							$lastname     			= $userdata['lastname'];
							$title        			= $userdata['title'];
							$old_img_name     		= $userdata['img_name'];
							$old_img_path     		= $userdata['img_path'];
						}
						
						$fullname 					= $firstname.'_'.$lastname;
						
						$new_file_name  			= $fullname.'_'.$user_id.'_'.$time_st.'.'.$ext;
						
						$pro_img['upload_path']          = $upload_path;
						$pro_img['allowed_types']        = implode('|', $this->config->item('image_file_types'));
						$pro_img['max_size']             = $this->config->item('file_upload_size');
						#$pro_img['encrypt_name'] 		 = TRUE;
						$pro_img['file_name'] 		 	 = $new_file_name;			
						
						$this->load->library('upload', $pro_img);
						
						if($this->upload->do_upload('profile_img')) {
							
							#Resize image start
							$config_manip['image_library'] 	= 'gd2';
							$config_manip['source_image']  	= FCPATH .'assets/uploads/'.$user_id.'/'.$this->config->item('profile_img_folder').'/'.$new_file_name;
							$config_manip['new_image']  	= $upload_path;
							$config_manip['maintain_ratio'] = TRUE;
							$config_manip['create_thumb']  	= TRUE;
							$config_manip['thumb_marker']  	= '_thumb';
							$config_manip['width']  		= $this->config->item('image_thumb_size');
							$config_manip['height']  		= $this->config->item('image_thumb_size');							
							
							$this->load->library('image_lib', $config_manip);
							$this->image_lib->resize();
							#Resize image ends
							
							$new_thumb_file_name 			= $fullname.'_'.$user_id.'_'.$time_st.'_thumb'.'.'.$ext;
							
							$data['img_name']			= $new_thumb_file_name;
							$data['img_path']			= $user_id.'/'.$this->config->item('profile_img_folder').'/';
							$data['modified_date']		= date('Y-m-d H:i:s');
							
							if($user_type == $this->config->item('professional')){
								$result = $this->Users_model->update_user_personal_details($data, $user_id);
							}
							else if($user_type == $this->config->item('medical_practice')){
								$result = $this->Users_model->update_medical_practice_details($data, $user_id);
							}
							else if($user_type == $this->config->item('patient')){
								$result = $this->Users_model->update_user_personal_details($data, $user_id);
							}						
							
							if($result) {
								if($old_img_name AND $old_img_path){
									$old_img_name_wo		= trim(pathinfo($old_img_name, PATHINFO_FILENAME), '_thumb');
									$old_img_name_ext		= pathinfo($old_img_name, PATHINFO_EXTENSION);
									$old_file_path 			= FCPATH .'assets/uploads/'.$old_img_path.''.$old_img_name_wo.'.'.$old_img_name_ext;									
									$thumb_old_file_path 	= FCPATH .'assets/uploads/'.$old_img_path.''.$old_img_name;
									
									if(file_exists($old_file_path)){
										unlink($old_file_path);
									}
									if(file_exists($thumb_old_file_path)){
										unlink($thumb_old_file_path);
									}
								}
								
								$new_file_name_data = base_url().'assets/uploads/'.$user_id.'/profile_pic/'.$new_file_name;
								
								$response 			= array('status'=>'success','profile_img'=>$new_file_name_data);
							}	
						} else {
							$response = array('status'=>'fail','reason'=>'image_upload_error');
						}
					} else {
						$response = array('status'=>'fail','reason'=>'filename_empty');
					}
				} else {
					$response = array('status'=>'fail','reason'=>'token_expired');
				}
				
			}			
		}
		
		echo json_encode($response); 
		exit;
	}
	
	function get_user_details(){		
		# Get JSON as a string
		$json_str = file_get_contents('php://input');
		
		# Get as an object
		$json_obj = (array)json_decode($json_str);
	
		$response = array();		
		if(count($json_obj) > 0){
			$user_id	        = $json_obj['user_id'];            
            $token	        	= $json_obj['token'];
			if(empty($user_id)){
				$response = array('status'=>'fail','reason'=>'user_id');
			}				
			else if(empty($token)){
				$response = array('status'=>'fail','reason'=>'token_empty');
			} else {
				$check_token = $this->Users_model->check_user_token($user_id, $token);				
				
				if(count($check_token) > 0) {
					$user_type = $this->common->check_user_type($user_id);
					
					$data['id']  		= $user_id;
					$data['user_type']  = $user_type;
					
					if($user_type == $this->config->item('professional')){
						$result = $this->Users_model->get_user_details($data);
					}
					else if($user_type == $this->config->item('medical_practice')){
						$result = $this->Users_model->get_user_details($data);
					}
					else if($user_type == $this->config->item('patient')){
						$result = $this->Users_model->get_user_details($data);
					}
					
					$response = array('status'=>'success', 'data' => $result);
			
				} else {
					$response = array('status'=>'fail','reason'=>'token_expired');
				}
			}
		}
		echo json_encode($response); 
		exit;
	}
	
	function update_medical_practice_details(){
		
		$response = array();		
		if(($this->input->method() == 'post') AND !empty($this->input->post())){		
			$user_id	        			= $this->common->post($this->input->post('user_id'));            
            $token	        				= $this->common->post($this->input->post('token'));
			$medical_practice_details		= $this->input->post('medical_practice_details');
			
			$this->form_validation->set_rules('user_id','User ID','trim|required');
			$this->form_validation->set_rules('token','Token','trim|required');
            $this->form_validation->set_rules('medical_practice_details','medical practice details','trim|required');
			
			if ($this->form_validation->run() == FALSE) {
				 //echo validation_errors();
                if(empty($user_id)){
                    $response = array('status'=>'fail','reason'=>'user_id_empty');
                }
                else if(empty($token)){
                    $response = array('status'=>'fail','reason'=>'token_empty');
                }
                else if(empty($medical_practice_details)){
                    $response = array('status'=>'fail','reason'=>'medical_practice_details_empty');
                }
			} else {
				$check_token = $this->Users_model->check_user_token($user_id, $token);				
				
				if(count($check_token) > 0) {				
					$medical_practice_details_data = (array)json_decode($medical_practice_details);
					
					if(empty($medical_practice_details_data['practice_name'])){
						$response = array('status'=>'fail','reason'=>'practice_name_empty');
					}
					else if(empty($medical_practice_details_data['title'])){
						$response = array('status'=>'fail','reason'=>'title_empty');
					}
					else if(empty($medical_practice_details_data['owner_name'])){
						$response = array('status'=>'fail','reason'=>'owner_name_empty');
					}
					else if(empty($medical_practice_details_data['role'])){
						$response = array('status'=>'fail','reason'=>'role_empty');
					}
					else if(empty($medical_practice_details_data['tel1'])){
						$response = array('status'=>'fail','reason'=>'tel1_empty');
					}
					else if(empty($medical_practice_details_data['primary_email'])){
						$response = array('status'=>'fail','reason'=>'primary_email_empty');
					}
					else if(empty($medical_practice_details_data['address'])){
						$response = array('status'=>'fail','reason'=>'address_empty');
					}
					else if(empty($medical_practice_details_data['city_town'])){
						$response = array('status'=>'fail','reason'=>'city_town_empty');
					}
					else if(empty($medical_practice_details_data['state'])){
						$response = array('status'=>'fail','reason'=>'address_empty');
					}
					else if(empty($medical_practice_details_data['country_id'])){
						$response = array('status'=>'fail','reason'=>'country_empty');
					}
					else if(empty($medical_practice_details_data['postcode'])){
						$response = array('status'=>'fail','reason'=>'postcode_empty');
					} else {
						
						$data['practice_name'] 	= $medical_practice_details_data['practice_name'];
						$data['title'] 			= $medical_practice_details_data['title'];
						$data['owner_name'] 	= $medical_practice_details_data['owner_name'];
						$data['role'] 			= $medical_practice_details_data['role'];
						$data['tel1'] 			= $medical_practice_details_data['tel1'];
						$data['tel2'] 			= $medical_practice_details_data['tel2'];
						#$data['primary_email'] = $medical_practice_details_data['primary_email'];
						$data['secondary_email']= $medical_practice_details_data['secondary_email'];
						$data['address'] 		= $medical_practice_details_data['address'];
						$data['city_town'] 		= $medical_practice_details_data['city_town'];
						$data['state'] 			= $medical_practice_details_data['state'];
						$data['country_id'] 	= $medical_practice_details_data['country_id'];
						$data['postcode'] 		= $medical_practice_details_data['postcode'];
						$data['modified_by'] 	= $user_id;
						$data['modified_date'] 	= date('Y-m-d H:i:s');
						
						$result 				= $this->Users_model->update_medical_practice_details($data, $user_id);
						
						if($result){							
							$users['registration_complete'] = 1;
							$users['modified_by'] 			= $user_id;
							$users['modified_date'] 		= date('Y-m-d H:i:s');
							$result_users					= $this->Users_model->update_users($users, $medical_practice_details_data['user_id']);
							
							$response = array('status'=>'success', 'reason'=>'Updated Successfully');
						}						
					}
				} else {
					$response = array('status'=>'fail','reason'=>'token_expired');
				}
			}
		}
		
		echo json_encode($response); 
		exit;
	}
}
?>
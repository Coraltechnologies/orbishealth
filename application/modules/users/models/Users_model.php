<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

	function __construct(){  
		parent::__construct();  
	}
    
    function login($u, $p){
        $result = array();
        if($u AND $p){           
            $condition	= array('User.login_id'=>$u,'User.password'=>$p,'User.status'=>'active', 'User.email_confirm'=>'1');
            $this->db->from('users as User');
            $this->db->select('User.id, User.user_type, User.registration_complete, User.email_confirm');
            $this->db->where($condition);
            $query		= $this->db->get();
            
            if($query->num_rows() > 0){
                $result = $query->row_array();
            }
        }
        return $result;
    }
    
    function insert_token($data){
        $result = array();
        if(count($data) > 0){		
			$this->db->from('user_tokens');
            $this->db->select('id, user_id');
            $this->db->where('user_id', $data['user_id']);
			$this->db->order_by('id', 'ASC');
            $query		= $this->db->get();
			if($query->num_rows() > 0){
				$result = $query->row_array();
				$ut_id  = $result['id'];
				$this->db->where('id', $ut_id);
				$this->db->update('user_tokens', $data);
				if($this->db->affected_rows() > 0){
					$result = $data;
				}
			} else {			
				$this->db->insert('user_tokens', $data);
				
				if($this->db->affected_rows() > 0){
					$result = $data;
				}
			}
        }
        return $result;
    }
	
	function user_activies_data($data, $type = 'web'){
        $result = array();
        if(count($data) > 0){			
			$this->db->from('user_activies');
            $this->db->select('id, user_id, app_current_date, tool_current_date, web_current_date');
            $this->db->where('user_id', $data['user_id']);
			$this->db->order_by('id', 'ASC');
            $query		= $this->db->get();
			if($query->num_rows() > 0){
				$result 					 = $query->row_array();				
				$ua_id  					 = $result['id'];
				if($type == 'web'){
					$data['web_last_used_date']  = $result['web_current_date'];		
				} else if($type == 'app'){
					$data['app_last_used_date']  = $result['app_current_date'];
				} else if($type == 'tool'){
					$data['tool_last_sync_date'] = $result['tool_current_date'];
				}		
				
				$this->db->where('id', $ua_id);
				$this->db->update('user_activies', $data);
				if($this->db->affected_rows() > 0){
					$result = $data;
				}
			} else {
				if($type == 'web'){
					$data['web_last_used_date']  = '';		
				} else if($type == 'app'){
					$data['app_last_used_date']  = '';
				} else if($type == 'tool'){
					$data['tool_last_sync_date'] = '';
				}		
				$this->db->insert('user_activies', $data);
				
				if($this->db->affected_rows() > 0){
					$result = $data;
				}
			}
        }
        return $result;
    }
	
	function check_email_activation($activation_code){
		$result = array();
        if($activation_code){			
			$condition	= array('User.activation_code'=>$activation_code,'User.status'=>'active');
            $this->db->from('users as User');
            $this->db->select('User.id, User.login_id, User.user_type, User.registration_complete, User.created_date, User.email_confirm');
            $this->db->where($condition);
            $query		= $this->db->get();
            
            if($query->num_rows() > 0){
                $result = $query->row_array();
            }
		}
		return $result;
	}	
	
	function update_users($data, $user_id){
		$result = false;
        if((count($data) > 0) AND $user_id){			
            $this->db->where('id', $user_id);
			$this->db->update('users', $data);
			
            if($this->db->affected_rows() > 0){
				$result = true;
			}
		}
		return $result;
	}
	
	function update_user_personal_details($data, $user_id){
		$result = false;
        if((count($data) > 0) AND $user_id){			
            $this->db->where('user_id', $user_id);
			$this->db->update('user_personal_details', $data);
			
            if($this->db->affected_rows() > 0){
				$result = true;
			}
		}
		return $result;
	}
	
	function update_medical_practice_details($data, $user_id){
		$result = false;
        if((count($data) > 0) AND $user_id){			
            $this->db->where('user_id', $user_id);
			$this->db->update('medical_practice_details', $data);
			
            if($this->db->affected_rows() > 0){
				$result = true;
			}
		}
		return $result;
	}
	
	function check_user_token($user_id, $token){
		$result = array();
        if($user_id AND $token){
			$this->db->select('User.id, UserToken.token');
            $this->db->from('users as User');            
			$this->db->join('user_tokens as UserToken', 'User.id = UserToken.user_id');
            $this->db->where('User.status = "active" AND UserToken.token = "'.$token.'" AND User.id = '.$user_id);
            $query		= $this->db->get();
            
            if($query->num_rows() > 0){
                $result = $query->row_array();
            }
		}
		return $result;
	}
	
	function get_medical_practice_details($user_id){
		$result = array();
		if($user_id){
			$this->db->select('*');
            $this->db->from('medical_practice_details');            
            $this->db->where('user_id = '.$user_id);
            $query		= $this->db->get();
            
            if($query->num_rows() > 0){
                $result = $query->row_array();
            }
		}
		return $result;
	}
	
	function get_user_details($user_data = null){
		
		$user_details = array();
		
		if($user_data){
			$userId			 = $user_data['id'];
			$userType		 = $user_data['user_type'];
			
			$ci				 =& get_instance();
			$condition		 = array('User.id'=>$userId,'User.status'=>'active');
			$ci->db->from('users as User');
			if($userType == $this->config->item('professional')){
				$ci->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = User.id','LEFT');
				$ci->db->join('user_address_details as UserAddressDetails', 'UserAddressDetails.user_id = User.id','LEFT');
				$ci->db->select('User.*, UserPersonalDetail.*, UserAddressDetails.*');
			} else if($userType == $this->config->item('medical_practice')){
				$ci->db->join('medical_practice_details as MedicalPracticeDetails', 'MedicalPracticeDetails.user_id = User.id','LEFT');
				$ci->db->select('User.id,User.user_type, MedicalPracticeDetails.title, MedicalPracticeDetails.owner_name, MedicalPracticeDetails.primary_email, MedicalPracticeDetails.practice_name');
			} else if($userType == $this->config->item('patient')){
				$ci->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = User.id','LEFT');
				$ci->db->join('user_address_details as UserAddressDetails', 'UserAddressDetails.user_id = User.id','LEFT');
				$ci->db->select('User.id AS u_id, UserPersonalDetail.id AS upd_id, UserAddressDetails.id AS uad_id');
	
			}		
			$ci->db->where($condition);
			$query			= $ci->db->get();
			$user_details	= $query->row_array();		
		}	
		return $user_details;
	}
	
}
?>
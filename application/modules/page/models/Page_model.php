<?php
class Page_model extends CI_Model {

	function __construct(){  
		parent::__construct();  
	}
	function get_details(){
		$this->db->from('professional_types');
		$this->db->select('id,type');
		$query 							= $this->db->get();
		$items							= array();
		$items['']						= 'Choose Professional Body';
		if($query->num_rows() > 0) {
			foreach($query->result() as $data) {
				 $items[$data->id] 		= $data->type;
			}
			return $items;
		}else{
			return $items;
		}
	}
	
	
	function country_code($code= null){
		$this->db->from('countries');
		$this->db->select('*');
		$cond							= array('status'=>1,'id'=>$code);
		$this->db->where($cond);
		$query 							= $this->db->get();
		if($query->num_rows() == 1){
			return $query->row();
		}
		return false;
	}
	
	function unique_user_name($code,$key){
		if($key){
			$this->db->from('users');
			$this->db->where('login_id',$code.$key);
			$query 							= $this->db->get();
			if($query->num_rows() > 0){
				$key						= rand(10000,99999);
				return $this->unique_user_name($code,$key);
			}else{
				return $code.$key;
			}
			
		}
		
	}
	
	function insert_details($data,$personal_details,$user_type,$country){
		
		$this->db->from('user_personal_details');
		$this->db->where('primary_email',$personal_details['primary_email']);
		$query 											= $this->db->get();
		$this->db->from('medical_practice_details');
		$this->db->where('primary_email',$personal_details['primary_email']);
		$m_query 										= $this->db->get();
		if($query->num_rows()>0 || $m_query->num_rows()>0){
			return 'exist';
		}else{
			$data['registration_complete']						= 0;
			$data['email_confirm']								= 0;
			$ins_user											= $this->db->insert('users', $data);
			$personal_details['user_id']						= $this->db->insert_id();
			$personal_details['created_by']						= $this->db->insert_id();
			$personal_details['modified_by']					= $this->db->insert_id();
			$personal_details['created_date']					= date('Y-m-d H:i:s');
			$personal_details['modified_date']					= date('Y-m-d H:i:s');
			if($ins_user){
				$user_roles          							= array();
				$user_roles['user_id']       					= $personal_details['created_by'];
				$user_roles['created_by']      					= $personal_details['created_by'];
				$user_roles['modified_by']      				= $personal_details['created_by'];
				$user_roles['created_date']      				= date('Y-m-d H:i:s');
				$user_roles['modified_date']     				= date('Y-m-d H:i:s');
				$user_roles['role_id']       					= $user_type;
				$user_role_ins         							= $this->db->insert('user_roles', $user_roles);
	
				if($user_type == $this->config->item('medical_practice')){
					$ins										= $this->db->insert('medical_practice_details', $personal_details);
				}else{
					$ins										= $this->db->insert('user_personal_details', $personal_details);
					$addr										= array();
					$addr['user_id']							= $personal_details['user_id'];
					$addr['created_by']							= $personal_details['user_id'];
					$addr['modified_by']						= $personal_details['user_id'];
					$addr['created_date']						= date('Y-m-d H:i:s');
					$addr['modified_date']						= date('Y-m-d H:i:s');
					$addr['country_id']							= $country;
					$ins_prof									= $this->db->insert('user_address_details', $addr);
					if($user_type == $this->config->item('professional')){
						$prof_details['user_id']				= $personal_details['user_id'];
						$prof_details['created_by']				= $personal_details['user_id'];
						$prof_details['modified_by']			= $personal_details['user_id'];
						$prof_details['created_date']			= date('Y-m-d H:i:s');
						$prof_details['modified_date']			= date('Y-m-d H:i:s');
						$ins_prof								= $this->db->insert('user_professional_details', $prof_details);
					}
				}
			}
			if($ins){
				return 1;
			}else{
				return 0;
			}
		}
		
	}
	
	 
	
}
?>
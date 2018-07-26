	<?php
class Patient_setup_model extends CI_Model {

	function __construct(){  
		parent::__construct();  
	}
	
	function insert_details($data,$primary_email){
		
		$this->db->from('user_personal_details');
		$this->db->where('primary_email',$primary_email);
		$query 												= $this->db->get();
		$this->db->from('medical_practice_details');	
		$this->db->where('primary_email',$primary_email);
		$m_query 											= $this->db->get();
		if($query->num_rows()>0 || $m_query->num_rows()>0){
			return 'exist';
		}else{
			$ins_user										= $this->db->insert('users', $data);
			$insert_id 										= $this->db->insert_id();
			if($ins_user){
				return $insert_id;
			}else{
				return 0;
			}
		}
	}
	
	function patient_details($user_id){
		$condition										= array('User.created_by'=>$user_id,'User.user_type'=>$this->config->item('patient'));
		$this->db->from('users as User');
		$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = User.id','LEFT');
		$this->db->join('user_address_details as UserAddressDetail', 'UserAddressDetail.user_id = User.id','LEFT');
		$this->db->select('User.id as user_id,UserPersonalDetail.*,UserAddressDetail.*');
		$this->db->where($condition);
		$query 											= $this->db->get();
		$list							= array();
		if($query->num_rows() > 0){
			$list						= $query->result();
		}
		return $list;
	}
}
?>
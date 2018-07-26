<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function validate($user_data = null){
	
	$user_details = array();
	
	if($user_data){
		$userId			 = $user_data['id'];
		$userType		 = $user_data['user_type'];
		
		$ci				 =& get_instance();
		$condition		 = array('User.id'=>$userId,'User.status'=>'active');
		$ci->db->from('users as User');
		if($userType == $ci->config->item('professional')){
			$ci->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = User.id','LEFT');
			$ci->db->select('User.id,User.user_type,UserPersonalDetail.firstname,UserPersonalDetail.lastname,UserPersonalDetail.title, UserPersonalDetail.img_name, UserPersonalDetail.img_path');
		} else if($userType == $ci->config->item('medical_practice')){
			$ci->db->join('medical_practice_details as MedicalPracticeDetails', 'MedicalPracticeDetails.user_id = User.id','LEFT');
			$ci->db->select('User.id,User.user_type, MedicalPracticeDetails.title, MedicalPracticeDetails.owner_name');
		} else if($userType == $ci->config->item('patient')){
			$ci->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = User.id','LEFT');
			$ci->db->select('User.id,User.user_type,UserPersonalDetail.firstname,UserPersonalDetail.lastname,UserPersonalDetail.title, UserPersonalDetail.img_name, UserPersonalDetail.img_path');

		}		
		$ci->db->where($condition);
		$query			= $ci->db->get();
		$user_details	= $query->row_array();		
	}	
	return $user_details;
}
?>
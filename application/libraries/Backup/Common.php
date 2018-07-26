<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Common {
	
	private $CI;

	function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->database();
	}

	function generateRandomString($length = 4) {
		$characters 						= '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength 					= strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString 				.= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function post($post, $security = true) {
		$post_val 	= '';
		$db 		= get_instance()->db->conn_id;
		if($security){
			$post_val = mysqli_real_escape_string($db,trim($post));
		} else{
			$post_val = $post;
		}
		return $post_val;
	}
	
	function get($get, $security = true) {
		$get_val = '';
		$db 	 = get_instance()->db->conn_id;
		if($security){
			$get_val = mysqli_real_escape_string($db,trim($get));
		} else{
			$get_val = $get;
		}
		return $get_val;
	}
	
	function country_details(){
		$ci =& get_instance();
		$ci->db->from('countries');
		$ci->db->select('id,country_name,country_code_two,mobile_code');
		$ci->db->where('status',1);
		$query 							= $ci->db->get();
		$items							= array();
		$new_item						= array();
		$country_code					= array();
		$items['']						= 'Choose Country';
		$mobile_code['']				= 'Select';
		if($query->num_rows() > 0){
			foreach($query->result() as $data) {
				$items[$data->id] 		= ucwords(strtolower($data->country_name));
				$country_code[$data->id] = $data->country_code_two;
				$mobile_code[$data->id] = $data->mobile_code;
			}
			$new_item['name']			= $items;
			$new_item['code']			= $country_code;
			$new_item['mobile']			= $mobile_code;
			return $new_item;
		}else{
			return $new_item;
		}
	}
	
	function get_details(){
		$ci =& get_instance();
		$ci->db->from('professional_types');
		$ci->db->select('id,type');
		$query 							= $ci->db->get();
		$items							= array();
		$items['']						= 'Select';
		if($query->num_rows() > 0) {
			foreach($query->result() as $data) {
				 $items[$data->id] 		= $data->type;
			}
			return $items;
		}else{
			return $items;
		}
	}
	
	function get_specialization($prof_id =null){
		$ci =& get_instance();
		if($prof_id){
			$conditions						= array('professional_type_id'=>$prof_id,'status'=>1);
		}else{
			$conditions						= array('status'=>1);
		}
		$ci->db->from('professional_specializations');
		$ci->db->where($conditions);
		$ci->db->select('id,specialization_type');
		$query 							= $ci->db->get();
		$items							= array();
		$items['']						= 'Choose Specialization';
		if($query->num_rows() > 0) {
			foreach($query->result() as $data) {
				 $items[$data->id] 		= $data->specialization_type;
			}
			return $items;
		}else{
			return $items;
		}
	}
	
	function service_name($id = null){
		$ci =& get_instance();
		$conditions						= array('active'=>1);
		if(!empty($id)){
			$ci->db->where_in('id',$id);
		}
		$ci->db->from('services');
		$ci->db->where($conditions);
		$ci->db->select('id,service_name');
		$query 							= $ci->db->get();
		$items							= array();
		if($query->num_rows() > 0) {
			foreach($query->result() as $data) {
				 $items[$data->id] 		= $data->service_name;
			}
			return $items;
		}else{
			return $items;
		}
	}
	
	function language_list($id= null){
		$ci =& get_instance();
		$conditions						= array('status'=>1);
		if($id != null){
			$conditions					= array('status'=>1);
			$cnd						= explode(',',$id);
			$ci->db->where_in('id',$cnd);
		}
		$ci->db->from('languages');
		$ci->db->where($conditions);
		$ci->db->select('id,language');
		$query 							= $ci->db->get();
		$items							= array();
		if($query->num_rows() > 0) {
			foreach($query->result() as $data) {
				 $items[$data->id] 		= $data->language;
			}
			return $items;
		}else{
			return $items;
		}
	}
	
	function register_categories($country = null,$prof = null){
		$ci 								=& get_instance();
		if($country != null && $prof != null){
			$conditions						= array('country_id'=>$country,'professional_type_id'=>$prof,'status'=>1);
		}else{
			$conditions						= array('status'=>1);	
		}
		$ci->db->from('medical_bodies');
		$ci->db->where($conditions);
		$ci->db->select('id,medical_body_name');
		$query 							= $ci->db->get();
		$items							= array();
		$items['']						= 'Choose Professional Body';
		if($query->num_rows() > 0) {
			foreach($query->result() as $data) {
				 $items[$data->id] 		= $data->medical_body_name;
			}
			return $items;
		}else{
			return $items;
		}
	}
	function ethinic_details(){
		$ci 								=& get_instance();
		$ci->db->from("ethinic_origin");
		$ci->db->where('status',1);
		$query								= $ci->db->get();
		$list								= array();
		$items['']							= 'Select';
		if($query->num_rows() > 0){
			foreach($query->result() as $data) {
				 $items[$data->id] 			= $data->name;
			}
		}
		return $items;
	}
	function relationship_list(){
		$ci 								=& get_instance();
		$ci->db->from("relationships");
		$ci->db->where('status',1);
		$query								= $ci->db->get();
		$list								= array();
		$items['']							= 'Select';
		if($query->num_rows() > 0){
			foreach($query->result() as $data) {
				 $items[$data->id] 			= $data->relationship_name;
			}
		}
		return $items;
	}
	function marital_list(){
		$ci 								=& get_instance();
		$ci->db->from("marital_status_list");
		$ci->db->where('status',1);
		$query								= $ci->db->get();
		$list								= array();
		$items['']							= 'Select';
		if($query->num_rows() > 0){
			foreach($query->result() as $data) {
				 $items[$data->id] 			= $data->type;
			}
		}
		return $items;
	}
	function roles_list($cat=null){
		$ci 								=& get_instance();
		$conditions							= array();
		if($cat && $cat == 1){
			$conditions						= array('is_clinical'=>1,'active'=>1);
		}else if($cat && $cat == 2){
			$conditions						= array('is_clinical'=>0,'active'=>1);
		}else{
			$conditions						= array('active'=>1,'is_clinical !='=>NULL);
		}
		$ci->db->order_by("role","asc");
		$ci->db->where($conditions);
		$ci->db->from("roles");
		//$ci->db->order_by("role","asc");
		$query								= $ci->db->get();
		$list								= array();
		$items['']							= 'Select';
		if($query->num_rows() > 0){
			foreach($query->result() as $data) {
				 $items[$data->id] 			= $data->role;
			}
		}
		return $items;
	}
	
	function get_roles($user_id = null){
		if($user_id){
			$ci 								=& get_instance();
			$conditions							= array('UserRoles.user_id'=>$user_id,'Roles.is_clinical !='=> NULL);
			$ci->db->order_by("role","asc");
			$ci->db->where($conditions);
			$ci->db->from("user_roles as UserRoles");
			$ci->db->join('roles as Roles', 'Roles.id	 = UserRoles.role_id','LEFT');
			$ci->db->select("Roles.role,Roles.id");
			$query								= $ci->db->get();
			$items								= '';
			if($query->num_rows() > 0){
				$items['id']					= '';
				$items['name']					= '';
				foreach($query->result() as $data) {
					$items['id'] 			= $data->id.', '.$items['id'];
					$items['name'] 			= $data->role.', '.$items['name'];
				}
			}
			return $items;
		}
	}
	
	function consulting_room_list($consulting_venue_id = null){
		if($consulting_venue_id){
			$ci 																=& get_instance();
			$ci->db->where(array('ConsultingRoom.consulting_venue_id'=>$consulting_venue_id,'ConsultingRoom.delete_status'=>0));
			$ci->db->from('consulting_room as ConsultingRoom');
			$ci->db->join('assign_consulting_room as AssignConsultingRoom', 'AssignConsultingRoom.consulting_room_id = ConsultingRoom.id','LEFT');
			$ci->db->join('consulting_venues as ConsultingVenue', 'ConsultingVenue.id = ConsultingRoom.consulting_venue_id','LEFT');
			$ci->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id =AssignConsultingRoom.clinician_id','LEFT');
			$ci->db->select('ConsultingVenue.consulting_name,ConsultingVenue.id as venue_id,ConsultingVenue.address,ConsultingRoom.id as consulting_id,ConsultingRoom.status,AssignConsultingRoom.id as assign_id,AssignConsultingRoom.delete_status,ConsultingRoom.consulting_room_title,UserPersonalDetail.title,UserPersonalDetail.firstname,UserPersonalDetail.middlename,UserPersonalDetail.lastname');
			$qry																= $ci->db->get();
			if($qry){
				if(!empty($qry->result_array())){
					$result['response']											= 'success';
					$reponse_data												= $qry->result_array();
					$i															= 0;
					foreach($reponse_data as $r_key =>$r_val){
						if($r_val['middlename']){
							$clinician_name										= ucfirst($r_val['title'].' '.$r_val['firstname'].' '.$r_val['middlename'].' '.$r_val['lastname']);
						}else{
							$clinician_name										= ucfirst($r_val['title'].' '.$r_val['firstname'].' '.$r_val['lastname']);
						}
						$result['response_data'][$r_val['consulting_id']]['consulting_room_title'] 	 = $r_val['consulting_room_title'];
						if($r_val['delete_status'] != 1){
							if(isset($result['response_data'][$r_val['consulting_id']]['clinician_name'])){
								$result['response_data'][$r_val['consulting_id']]['clinician_name']	.= $clinician_name.'<br/>';
							}else{
								$result['response_data'][$r_val['consulting_id']]['clinician_name']     ='';
								$result['response_data'][$r_val['consulting_id']]['clinician_name']	.= $clinician_name.'<br/>';
							}
						}
						$result['response_data'][$r_val['consulting_id']]['consulting_id'] 			 = $r_val['consulting_id'];
						$result['response_data'][$r_val['consulting_id']]['status']					 = $r_val['status'];
						$i++;
					}
				}else{
					$result['response']											= 'empty';
				}
			}
			return $result;
		}
	}
	
	function consulting_location_list($user_id = null,$venue_id = null){
		$result																	= array(''=>'Select');
		$ci 																	=& get_instance();
		if($venue_id){
			$ci->db->where(array('created_by'=>$user_id,'id'=>$venue_id));
		}else{
			$ci->db->where(array('created_by'=>$user_id));
		}
		$ci->db->from('consulting_venues');
		$qry																	= $ci->db->get();			
		if($venue_id){
			$result																= $qry->row_array();
		}else{
			if(!empty($qry->result_array())){
				foreach($qry->result_array() as $key => $val){
					$result[$val['id']]											= $val['consulting_name'].' - '.$val['address'];
				}
			}
		}
		return $result;
	}
	
	function clinician_list($venue_id = null){
		$result																				= array();
		$ci 																				=& get_instance();
		if(isset($venue_id) && $venue_id !=''){
				$ci->db->where('AssignConsultingRoom.consulting_venue_id',$venue_id);
				$ci->db->where('AssignConsultingRoom.delete_status',0);
				$ci->db->from('assign_consulting_room as AssignConsultingRoom');
				$ci->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = AssignConsultingRoom.clinician_id','LEFT');
				$ci->db->join('user_professional_details as UserProfessionalDetail', 'UserProfessionalDetail.user_id = AssignConsultingRoom.clinician_id','LEFT');
				$ci->db->join('users as User', 'User.id = AssignConsultingRoom.clinician_id','LEFT');
				$ci->db->join('user_roles as UserRole', 'UserRole.user_id = AssignConsultingRoom.clinician_id','LEFT');
				$ci->db->join('roles as Role', 'Role.id = UserRole.role_id','LEFT');
				$ci->db->select('UserPersonalDetail.user_id,UserPersonalDetail.title,UserPersonalDetail.firstname,UserPersonalDetail.lastname,Role.role,User.status,UserProfessionalDetail.qualifications,UserPersonalDetail.img_path,UserPersonalDetail.img_name');
				$query 																		= $ci->db->get();
				if(!empty($query->result_array())){
					$result['response']														= 'success';
					foreach($query->result_array() as $key => $value){
						$result['response_data'][$value['user_id']]['name']					= ucfirst($value['title'].' '.$value['firstname'].' '.$value['lastname']);
						$result['response_data'][$value['user_id']]['role']					= $value['role'];
						$result['response_data'][$value['user_id']]['status']				= $value['status'];
						$result['response_data'][$value['user_id']]['qualifications']		= $value['qualifications'];
					}
				}else{
					$result['response']														= 'empty';
				}
		}else{
			$result['response']																= 'failed';
		}
		return $result;
	}
	
	function repeat_type_list( $id = null){
		$result																				= array();
		$ci 																				=& get_instance();
		if($id){
			$ci->db->where(array('id'=>$id));
		} 
		$ci->db->from('slot_repeat_types');
		$qry																				= $ci->db->get();			
		if(!empty($qry->result_array())){
			foreach($qry->result_array() as $key => $val){
				$result[$val['id']]															= $val['slot_repeat_type'];
			}
		}
		return $result;
	}
	function appointment_type_list($id = null){
		$result																				= array();
		$ci 																				=& get_instance();
		if($id){
			$ci->db->where(array('id'=>$id));
		} 
		$ci->db->from('appointment_types');
		$qry																				= $ci->db->get();			
		if(!empty($qry->result_array())){
			foreach($qry->result_array() as $key => $val){
				$result[$val['id']]															= $val['appointment_type'];
			}
		}
		return $result;
	}
	
	function solt_parent_list($id = null,$consulting_venue_id = null,$slot_date = null,$professional_id =null){
		$result																				= array();
		$ci 																				=& get_instance();
		$ci->db->where('SlotParent.created_by',$id);
		if($consulting_venue_id && $consulting_venue_id !='intial' &&  $consulting_venue_id !=''){
			$ci->db->where('SlotParent.consulting_venues_id',$consulting_venue_id);
		}
		if($slot_date && trim($slot_date) !=''){
			$ci->db->where('SlotParent.slot_date',$slot_date);
		}
		if($professional_id && trim($professional_id) !=''){
			$ci->db->where('SlotParent.professional_id',$professional_id);
		}
		$ci->db->from('slot_parent as SlotParent');
		$ci->db->join('consulting_venues as ConsultingVenue', 'ConsultingVenue.id = SlotParent.consulting_venues_id','LEFT');
		$ci->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = SlotParent.professional_id','LEFT');
		$ci->db->select('ConsultingVenue.consulting_name,ConsultingVenue.address,SlotParent.id as slot_parent,SlotParent.initial_slots,SlotParent.professional_id,SlotParent.consulting_venues_id,SlotParent.start_time,SlotParent.end_time,SlotParent.slot_date,SlotParent.professional_id,UserPersonalDetail.title,UserPersonalDetail.firstname,UserPersonalDetail.middlename,UserPersonalDetail.lastname,UserPersonalDetail.img_path,UserPersonalDetail.img_name');
		$qry																				= $ci->db->get();			
		if(!empty($qry->result_array())){
			foreach($qry->result_array() as $key => $val){
				$result[]																	= $val;
			}
		}
		return $result;
	}
	function solt_details($id = null,$professional_id = null,$slot_parent_id = null,$status = null){
		$result																				= array();
		$ci 																				=& get_instance();
		$ci->db->where('Slot.created_by',$id);
		$ci->db->where('SlotParent.professional_id',$professional_id);
		$ci->db->where('Slot.slot_parent_id',$slot_parent_id);
		if($status){
			$ci->db->where('Slot.status_id',$status);
		}
		$ci->db->from('slots as Slot');
		$ci->db->join('slot_parent as SlotParent', 'SlotParent.id = Slot.slot_parent_id','LEFT');
		$ci->db->join('consulting_venues as ConsultingVenue', 'ConsultingVenue.id = SlotParent.consulting_venues_id','LEFT');
		$ci->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = SlotParent.professional_id','LEFT');
		$ci->db->join('appointment_types as AppointmentType', 'AppointmentType.id = Slot.appointment_type_id','LEFT');
		$ci->db->join('slot_parents_services as SlotParentService', 'SlotParentService.slot_parent_id = SlotParent.id','LEFT');
		$ci->db->select('AppointmentType.appointment_type,ConsultingVenue.consulting_name,ConsultingVenue.address,SlotParent.professional_type_id,SlotParent.consulting_venues_id,SlotParent.consulting_room_id,SlotParent.slot_date,SlotParent.start_time as parent_start,SlotParent.end_time as parent_end,SlotParent.id as slot_parent,SlotParent.professional_id,SlotParent.professional_id,SlotParent.slot_title,SlotParent.slot_length,SlotParent.initial_slots,SlotParentService.service_id,Slot.start_time,Slot.end_time,Slot.slot_type_id,UserPersonalDetail.title,UserPersonalDetail.firstname,UserPersonalDetail.middlename,UserPersonalDetail.lastname,UserPersonalDetail.img_path,UserPersonalDetail.img_name');
		$qry																				= $ci->db->get();
		
		if(!empty($qry->result_array())){
			foreach($qry->result_array() as $key => $val){
				$result[]																	= $val;
			}
		}
		return $result;
	}
	
	function assistant_clinician($slot_parent_id = null){
		$result																				= array();
		$ci 																				=& get_instance();
		$ci->db->where('slot_parent_id',$slot_parent_id);
		$ci->db->from('slot_parents_assistants');
		$ci->db->select('user_id');
		$qry																				= $ci->db->get();
		if(!empty($qry->result_array())){
			foreach($qry->result_array() as $key => $val){
				$result[]																	= $val;
			}
		}
		return $result;
	}
	
	function users_validate($user_data = null){
		
		$user_details = array();
		
		if($user_data){
			$userId			 = $user_data['id'];
			$userType		 = $user_data['user_type'];
			
			$ci				 =& get_instance();
			$condition		 = array('User.id'=>$userId,'User.status'=>'active');
			$ci->db->from('users as User');
			if($userType == 1){
				$ci->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = User.id','LEFT');
				$ci->db->select('User.id,User.user_type,UserPersonalDetail.firstname,UserPersonalDetail.lastname,UserPersonalDetail.title, UserPersonalDetail.img_name, UserPersonalDetail.img_path, UserPersonalDetail.primary_email');
			} else if($userType == 2){
				$ci->db->join('medical_practice_details as MedicalPracticeDetails', 'MedicalPracticeDetails.user_id = User.id','LEFT');
				$ci->db->select('User.id,User.user_type, MedicalPracticeDetails.title, MedicalPracticeDetails.owner_name, MedicalPracticeDetails.primary_email');
			} else if($userType == 3){
				$ci->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = User.id','LEFT');
				$ci->db->select('User.id,User.user_type,UserPersonalDetail.firstname,UserPersonalDetail.lastname,UserPersonalDetail.title, UserPersonalDetail.img_name, UserPersonalDetail.img_path, UserPersonalDetail.primary_email');
	
			}		
			$ci->db->where($condition);
			$query			= $ci->db->get();
			$user_details	= $query->row_array();		
		}	
		return $user_details;
	}
	
}
?>
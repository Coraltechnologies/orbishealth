<?php
	class Consulting_location_model extends CI_Model {
	
		function __construct(){  
			parent::__construct();  
		}
		function get_venue_details($venue_id = null){
			$result											= array();
			if($venue_id){
				$this->db->where(array('created_by'=>$this->session->userdata('User')['id'],'id'=>$venue_id));
			}else{
				$this->db->where(array('created_by'=>$this->session->userdata('User')['id']));
			}
			$this->db->from('consulting_venues');
			$qry											= $this->db->get();			
			if($venue_id){
				$result										= $qry->row_array();
			}else{
				$result['details']							= $qry->result_array();
			}
			return $result;
		}
		
		function venue_services($venue_id = null){
			if($venue_id){
				$this->db->from('consulting_services_details');
				$this->db->select('id,service_id');
				$this->db->where('consulting_venue_id',$venue_id);
				$query							= $this->db->get();
				$items							= array();
				if($query->num_rows() > 0){
					foreach($query->result() as $data) {
						 $items[$data->id] 		= $data->service_id;
					}
					return $items;
				}else{
					return $items;
				}
			}
		}
		
		function get_venue_list(){
			$list											= array();
			$this->db->where(array('created_by'=>$this->session->userdata('User')['id']));
			$this->db->from('consulting_venues');
			$qry											= $this->db->get();			
		 	$result											= $qry->result_array();
			foreach($result as $r_key => $r_val){
				$list[$r_val['id']]							= $r_val['consulting_name'].' - '.$r_val['address'];			
			}
			return $list;
		}
		function clinician_list($name = null){
			$list											= array();
			$this->db->where('User.created_by',$this->session->userdata('User')['id']);
			$or_cond										= '(UserAccessType.access_type_id ='.$this->config->item('clinical').' OR UserAccessType.access_type_id ='.$this->config->item('both').')';
			$this->db->where($or_cond);
			if($name && trim($name) !=''){
				$this->db->where("concat_ws('',UserPersonalDetail.firstname,UserPersonalDetail.middlename,UserPersonalDetail.lastname) LIKE '%$name%'");
			}
			$this->db->from('users as User');
			$this->db->join('user_access_types as UserAccessType', 'UserAccessType.user_id = User.id','LEFT');
			$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = User.id','LEFT');
			$this->db->select('User.id as user_key,UserPersonalDetail.title,UserPersonalDetail.firstname,UserPersonalDetail.middlename,UserPersonalDetail.lastname');
			$qry											= $this->db->get();			
		 	$result											= $qry->result_array();
			foreach($result as $r_key => $r_val){
				$middle										= '';
				if($r_val['middlename']){
					$middle									= trim($r_val['middlename']).' ';
				}
				$list[$r_val['user_key']]					= trim($r_val['title']).' '.trim($r_val['firstname']).' '.$middle.trim($r_val['lastname']);			
			}
			return $list;
		}
		function assigned_room_list(){
			$result											= array();
			$this->db->where('AssignConsultingRoom.created_by',$this->session->userdata('User')['id']);
			$this->db->from('assign_consulting_room as AssignConsultingRoom');
			$this->db->join('consulting_room as ConsultingRoom', 'ConsultingRoom.id = AssignConsultingRoom.consulting_room_id','LEFT');
			$this->db->join('consulting_venues as ConsultingVenue', 'ConsultingVenue.id = AssignConsultingRoom.consulting_venue_id','LEFT');
			$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id =AssignConsultingRoom.clinician_id','LEFT');
			$this->db->select('ConsultingVenue.consulting_name,ConsultingRoom.consulting_room_title,UserPersonalDetail.title,UserPersonalDetail.firstname,UserPersonalDetail.middlename,UserPersonalDetail.lastname');
			$qry											= $this->db->get();			
		 	$result											= $qry->result_array();
			return $result;
		}
		
	}
?>
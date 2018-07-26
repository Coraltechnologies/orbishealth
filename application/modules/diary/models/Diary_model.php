<?php
	class Diary_model extends CI_Model {
	
		function __construct(){  
			parent::__construct();  
		}
		
		function slot_parent_list($id = null,$consulting_venue_id = null,$slot_date = null,$professional_id = null,$services = null){
			$result																				= array();
			$this->db->where('SlotParent.created_by',$id);
			$this->db->where('SlotParentService.status IS NULL');
			$this->db->where('SlotParent.status','active');
			if($consulting_venue_id && $consulting_venue_id !='intial' &&  $consulting_venue_id !=''){
				$this->db->where('SlotParent.consulting_venues_id',$consulting_venue_id);
			}
			if($slot_date && trim($slot_date) !=''){
				$this->db->where('SlotParent.slot_date',$slot_date);
			}
			if($professional_id && trim($professional_id) !=''){
				$this->db->where('SlotParents.professional_id',$professional_id);
			}
			if($services && trim($services) !=''){
				$this->db->where('SlotParent.professional_type_id',$services);
			}
			$this->db->from('slot_parent as SlotParent');
			$this->db->join('consulting_venues as ConsultingVenue', 'ConsultingVenue.id = SlotParent.consulting_venues_id','LEFT');
			$this->db->join('slot_parents_services as SlotParentService', 'SlotParent.id = SlotParentService.slot_parent_id','LEFT');
			$this->db->join('services as Service', 'Service.id = SlotParentService.service_id','LEFT');
			$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = SlotParent.professional_id','LEFT');
			$this->db->join('professional_types as ProfessionalType', 'ProfessionalType.id = SlotParent.professional_type_id','LEFT');
			$this->db->select('ConsultingVenue.consulting_name,ConsultingVenue.address,SlotParent.id as slot_parent,ProfessionalType.type,SlotParentService.service_id,SlotParent.initial_slots,SlotParent.professional_id,SlotParent.consulting_room_id,SlotParent.professional_type_id,SlotParent.consulting_venues_id,SlotParent.start_time,SlotParent.end_time,SlotParent.slot_date,SlotParent.professional_id,SlotParent.slot_title,SlotParent.break_start_time,SlotParent.break_end_time,SlotParent.break_minutes,UserPersonalDetail.title,UserPersonalDetail.firstname,UserPersonalDetail.middlename,UserPersonalDetail.lastname,UserPersonalDetail.img_path,UserPersonalDetail.img_name,Service.service_name');
			$this->db->group_by('SlotParent.id'); 
			$qry																				= $this->db->get();			
			if(!empty($qry->result_array())){
				foreach($qry->result_array() as $key => $val){
					$result[]																	= $val;
				}
			}
			return $result;
		}
		function slot_details($id = null,$professional_id = null,$slot_parent_id = null,$status = null){
			$result																				= array();
			$this->db->where('Slot.created_by',$id);
			$this->db->where('Slot.status IS NULL');
			$this->db->where('SlotParent.professional_id',$professional_id);
			$this->db->where('Slot.slot_parent_id',$slot_parent_id);
			if($status){
				$this->db->where('Slot.status_id',$status);
			}
			$this->db->from('slots as Slot');
			$this->db->where('SlotParent.status','active');
			$this->db->join('slot_parent as SlotParent', 'SlotParent.id = Slot.slot_parent_id','LEFT');
			$this->db->join('consulting_venues as ConsultingVenue', 'ConsultingVenue.id = SlotParent.consulting_venues_id','LEFT');
			$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = SlotParent.professional_id','LEFT');
			$this->db->join('appointment_types as AppointmentType', 'AppointmentType.id = Slot.appointment_type_id','LEFT');
			$this->db->join('slot_parents_services as SlotParentService', 'SlotParentService.slot_parent_id = SlotParent.id','LEFT');
			$this->db->join('professional_types as ProfessionalType', 'ProfessionalType.id = SlotParent.professional_type_id','LEFT');
			$this->db->join('services as Service', 'Service.id = SlotParentService.service_id','LEFT');
			$this->db->select('AppointmentType.appointment_type,ConsultingVenue.consulting_name,ConsultingVenue.address,ProfessionalType.type,SlotParent.professional_type_id,SlotParent.consulting_venues_id,SlotParent.consulting_room_id,SlotParent.slot_date,SlotParent.start_time as parent_start,SlotParent.end_time as parent_end,SlotParent.id as slot_parent,SlotParent.professional_id,SlotParent.professional_id,SlotParent.slot_title,SlotParent.slot_length,SlotParent.initial_slots,SlotParentService.service_id,SlotParent.break_start_time,SlotParent.break_end_time,SlotParent.break_minutes,Slot.id as slot_i_key,Slot.start_time,Slot.end_time,Slot.slot_type_id,Slot.status_id,Slot.slot_creation_type,UserPersonalDetail.title,UserPersonalDetail.firstname,UserPersonalDetail.middlename,UserPersonalDetail.lastname,UserPersonalDetail.img_path,UserPersonalDetail.img_name,Service.service_name');
			$this->db->group_by('Slot.id'); 
			$qry																				= $this->db->get();
			if(!empty($qry->result_array())){
				foreach($qry->result_array() as $key => $val){
					$result[]																	= $val;
				}
			}
			return $result;
		}
		
		function assistant_clinician($slot_parent_id = null){
			$result																				= array();
			$this->db->where('SlotParentAssistant.slot_parent_id',$slot_parent_id);
			$this->db->where('SlotParentAssistant.status IS NULL');
			$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = SlotParentAssistant.user_id','LEFT');
			$this->db->from('slot_parents_assistants as SlotParentAssistant');
			$this->db->select('SlotParentAssistant.user_id,UserPersonalDetail.title,UserPersonalDetail.firstname,UserPersonalDetail.lastname');
			$qry																				= $this->db->get();
			if(!empty($qry->result_array())){
				$i																				= 0;
				foreach($qry->result_array() as $key => $val){
					$result[$i]['user_id']														= $val['user_id'];
					$result[$i]['name']															= ucfirst($val['title'].' '.$val['firstname'].' '.$val['lastname']);
					$i++;
				}
			}
			return $result;
		}
		
		function slot_split_list($slot_parent_id = null){
			$result																				= array();
			$this->db->where('slot_parent_id',$slot_parent_id);
			$this->db->where('status IS NULL');
			$this->db->from('slots');
			$this->db->select('status_id');
			$qry																				= $this->db->get();
			if(!empty($qry->result_array())){
				foreach($qry->result_array() as $key => $val ){
					$arr[]																		= $val['status_id'];
				}
				$result = array_count_values($arr);
			}
			return $result;
		}
	}
?>
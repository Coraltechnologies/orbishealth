	<?php
class Account_setup_model extends CI_Model {

	function __construct(){  
		parent::__construct();  
	}
	
	function personal_details($user_id = null){
		if($user_id){
			$this->db->from('users as User');
			$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = User.id','LEFT');
			$this->db->join('user_address_details as UserAddressDetail', 'UserAddressDetail.user_id = User.id','LEFT');
			$this->db->select('*');
			$this->db->where('User.id',$user_id);
			$query								= $this->db->get();
			if($query->num_rows()>0){
				return $query->row_array();
			}
		}
	}
	function professional_details($user_id = null){
		if($user_id){
			$this->db->from('user_professional_details');
			$this->db->select('*');
			$this->db->where('user_id',$user_id);
			$query								= $this->db->get();
					
			if($query->num_rows()>0){
				return $query->row_array();
			}
		}
	}
	function user_services($user_id = null){
		if($user_id){
			$this->db->from('user_services');
			$this->db->select('id,service_id');
			$this->db->where('user_id',$user_id);
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
	function professional_reg_details($user_id = null){
		if($user_id){
			$this->db->from("user_professional_register_detail");
			$this->db->where('user_id',$user_id);
			$query							= $this->db->get();
			$list							= array();
			if($query->num_rows() > 0){
				$list						= $query->result();
			}
			return $list;
		}
	}
	function other_bodies_details($user_id =null){
		if($user_id){
			$this->db->from("other_bodies_register_details");
			$this->db->where('user_id',$user_id);
			$query							= $this->db->get();
			$list							= array();
			if($query->num_rows() > 0){
				$list						= $query->result();
			}
			return $list;
		}
	}
	function professional_uploads($user_id=null){
		if($user_id){
			$this->db->from("user_professional_documents");
			$this->db->where('user_id',$user_id);
			$query							= $this->db->get();
			$list							= array();
			if($query->num_rows() > 0){
				$list						= $query->result();
			}
			return $list;
		}
	}
	function others_uploads($user_id=null){
		if($user_id){
			$this->db->from("user_other_documents");
			$this->db->where('user_id',$user_id);
			$query							= $this->db->get();
			$list							= array();
			if($query->num_rows() > 0){
				$list						= $query->result();
			}
			return $list;
		}
	}
	function patient_minor($user_id = null,$is_guradian = null){
		if($user_id){
			$this->db->from("patient_family_details");
			$conditions						= array();
			if($is_guradian  == 1){
				$conditions					= array('user_id'=>$user_id,'is_guardian'=>$is_guradian);
			}else{
				$conditions					= array('user_id'=>$user_id,'is_guardian' =>null);
			}
			$this->db->where($conditions);
			$query							= $this->db->get();
			$list							= array();
			if($query->num_rows() > 0){
				if($is_guradian  == 1){
					$list					= (array)$query->row();
				}else{
					$list					= $query->result();
				}
			}
			return $list;
		}
	}
	function patient_nxt($user_id=null){
		if($user_id){
			$this->db->from("patient_nexttokin");
			$this->db->where('user_id',$user_id);
			$query							= $this->db->get();
			$list							= array();
			if($query->num_rows() > 0){
				$list						= (array)$query->row();
			}
			return $list;
		}
	}
	function notes($user_id =null){
		if($user_id){
			$this->db->select("User.firstname,User.lastname,User.title,PatientNotes.notes,PatientNotes.modified_date,PatientNotes.id");
			$this->db->from("patient_notes as PatientNotes");
			$this->db->join('user_personal_details as User', 'PatientNotes.modified_by = User.user_id','LEFT');
			$this->db->where(array('PatientNotes.user_id'=>$user_id,'PatientNotes.status'=>1));
			$query							= $this->db->get();
			$list							= array();
			if($query->num_rows() > 0){
				$list						= $query->result();
			}
			return $list;
		}
	}
	function alerts($user_id =null){
		if($user_id){
			$this->db->select("User.firstname,User.lastname,User.title,PatientAlert.alerts,PatientAlert.modified_date,PatientAlert.id");
			$this->db->from("patient_alerts as PatientAlert");
			$this->db->join('user_personal_details as User', 'PatientAlert.modified_by = User.user_id','LEFT');
			$this->db->where(array('PatientAlert.user_id'=>$user_id,'PatientAlert.status'=>1));
			$query							= $this->db->get();
			$list							= array();
			if($query->num_rows() > 0){
				$list						= $query->result();
			}
			return $list;
		}
	}
	
	function consent($user_id =null){
		if($user_id){
			$this->db->from("patient_consent");
			$this->db->where('user_id',$user_id);
			$query							= $this->db->get();
			$list							= array();
			if($query->num_rows() > 0){
				$list						= (array)$query->row();
			}
			return $list;
		}
	}
	
	function gp_details($user_id =null){
		if($user_id){
			$this->db->from("patient_gp_details");
			$this->db->where('user_id',$user_id);
			$query							= $this->db->get();
			$list							= array();
			if($query->num_rows() > 0){
				$list						= $query->result();
			}
			return $list;
		}
	}
	
	function chemist_details($user_id =null){
		if($user_id){
			$this->db->from("patient_chemist_details");
			$this->db->where('user_id',$user_id);
			$query							= $this->db->get();
			$list							= array();
			if($query->num_rows() > 0){
				$list						= $query->result();
			}
			return $list;
		}
	}
	
	function career_details($user_id =null){
		if($user_id){
			$this->db->from("patient_career_details");
			$this->db->where('user_id',$user_id);
			$query							= $this->db->get();
			$list							= array();
			if($query->num_rows() > 0){
				$list						= $query->result();
			}
			return $list;
		}
	}
	
	function practice_details($user_id = null){
		if($user_id){
			$this->db->from("medical_practice_details");
			$this->db->where('user_id',$user_id);
			$query							= $this->db->get();
			$list							= array();
			if($query->num_rows() > 0){
				$list						= (array)$query->row();
			}
			return $list;
		}
	}
}
?>
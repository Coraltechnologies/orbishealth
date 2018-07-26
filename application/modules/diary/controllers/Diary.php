<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Diary extends CI_Controller {
		
		public function __construct(){
	
			parent::__construct();
			$this->load->model('Diary_model');
		 	$this->load->helper(array('form','url','loginvalidate'));
			$this->load->library(array('Common','EncryptionFunction','form_validation'));
		}
		
		function index(){
			$data																				= array();
			$data['consulting_location']														= $this->common->consulting_location_list($this->session->userdata('User')['id']);
			$data['professional_type']															= $this->common->get_details();
			$data['services']																	= $this->common->service_name();
			$data['repeat_type']																= $this->common->repeat_type_list();
			$data['appointment_type']															= $this->common->appointment_type_list();
			//$this->load->view('index',$data);
			$this->template->render_content('index',$data);
		}
		
		function patient_search(){
			$result													= array();
			if($_POST && !empty($_POST)){
				$this->db->where('User.created_by',$this->session->userdata['User']['id']);
				$this->db->where('User.user_type',$this->config->item('patient'));
				if(isset($_POST['search_cat']) && trim($_POST['search_cat']) !=''){
					if(trim($_POST['search_cat'])  == 'name'){
						if(isset($_POST['search_val']) && trim($_POST['search_val']) !=''){
							$name																= trim($_POST['search_val']);
							$this->db->where("concat_ws('',UserPersonalDetail.firstname,UserPersonalDetail.middlename,UserPersonalDetail.lastname) LIKE '%$name%'");
						}
					}else if(trim($_POST['search_cat'])  == 'phone'){
						if(isset($_POST['search_val']) && trim($_POST['search_val']) !=''){
							$mobile																= trim($_POST['search_val']);
							$this->db->where("UserPersonalDetail.mobile LIKE '%$mobile%'");
						}
					}else if(trim($_POST['search_cat'])  == 'nhs_no'){
						if(isset($_POST['search_val']) && trim($_POST['search_val']) !=''){
							$nhs_no																= trim($_POST['search_val']);
							$this->db->where("UserPersonalDetail.nhs_no LIKE '%$nhs_no%'");
						}
						$this->db->where('User.user_type',$this->config->item('patient'));
					} 
				}
				if(isset($_POST['search_status']) && trim($_POST['search_status']) != ''){
					if(trim($_POST['search_status']) == 'all'){
					}else if(trim($_POST['search_status']) == 'active'){
						$this->db->where('User.status','active');
					}else if(trim($_POST['search_status']) == 'inactive'){
						$this->db->where('User.status','inactive');
					}
				}
				$this->db->from('users as User');
				$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = User.id','LEFT');
				$this->db->join('user_address_details as UserAddressDetail', 'UserAddressDetail.user_id = User.id','LEFT');
				$this->db->select('User.id as user_key,User.status,UserPersonalDetail.*,UserAddressDetail.*');
				$query 																			= $this->db->get();
				if($query){
					$list																		= array();
					if($query->num_rows() > 0){
						$result['response']														= 'success';
						$i																		= 0;
						foreach($query->result_array() as $key => $val){
							$result['response_data'][$i]										= $val;
							$result['response_data'][$i]['key']									= $this->encryptionfunction->enCrypt($val['user_key']);
						$i++;
						}
					}else{
						$result['response']														= 'empty';
					}
				}else{
					$result['response']															= 'failed';
				}
			}else{
				$result['response']																= 'failed';
			}
			echo json_encode($result);
		}
		
		function list_consulting_room(){
			$result																				= array();
			if(isset($_POST) && !empty($_POST)){
				$date_val			= trim(implode('-',array_reverse(explode('/',$_POST['val_date']))));
				$date_Str			= date('l', strtotime($date_val));
				$days				= array('Monday'=>1,'Tuesday'=>2,'Wednesday'=>3,'Thursday'=>4,'Friday'=>5,'Saturday'=>6,'Sunday'=>7);
				$this->db->where('day_id',$days[$date_Str]);
				$this->db->where('consulting_venue_id',trim($_POST['val_location']));
				$this->db->from('consulting_hours');
				$this->db->select('work_24_7,morn_start,morn_end,aftr_start,aftr_end,eve_start,eve_end');
				$query_hr 																		= $this->db->get();
				if($query_hr){
					$data																		= $query_hr->row_array();
					if($data['work_24_7'] == null && $data['morn_start'] == null && $data['morn_end'] == null && $data['aftr_start'] == null && $data['aftr_end'] == null && $data['eve_start'] == null && $data['eve_end'] == null){
						$result['location_on']													= 'closed';	
					}else if($data['work_24_7'] == 1){
						$result['location_on']													= '24/7';
					}else{
						$result['location_on']													= 'on';
						$result['time_session']													= $data;
					}
				}else{
					$result['location_on']														= 'off';	
				}
				if(trim($_POST['val_location']) !=''){
					$this->db->where('AssignConsultingRoom.consulting_venue_id',trim($_POST['val_location']));
					$this->db->where('ConsultingRoom.delete_status',0);
					$this->db->from('assign_consulting_room as AssignConsultingRoom');
					$this->db->join('consulting_room as ConsultingRoom', 'ConsultingRoom.id = AssignConsultingRoom.consulting_room_id','LEFT');
					$this->db->select('ConsultingRoom.consulting_room_title,ConsultingRoom.id');
					$query 																		= $this->db->get();
					if(!empty($query->result_array())){
						$result['response']														= 'success';
						foreach($query->result_array() as $key => $value){
							$result['response_data'][$value['id']]								= $value['consulting_room_title'];
						}
					}else{
						$result['response']														= 'empty';
					}
				}else{
					$result['response']															= 'failed';
				}
			}else{
				$result['response']																= 'failed';
			}
			echo json_encode($result);
		}
		
		function clinician_list(){
			$result																				= array();
			if(isset($_POST) && !empty($_POST)){
				if(trim($_POST['val_room']) !=''){
					$this->db->where('AssignConsultingRoom.consulting_room_id',$_POST['val_room']);
					$this->db->where('AssignConsultingRoom.consulting_venue_id',$_POST['loc']);
					$this->db->where('AssignConsultingRoom.delete_status',0);
					$this->db->from('assign_consulting_room as AssignConsultingRoom');
					$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = AssignConsultingRoom.clinician_id','LEFT');
					$this->db->select('UserPersonalDetail.user_id,UserPersonalDetail.title,UserPersonalDetail.firstname,UserPersonalDetail.lastname');
					$query 																		= $this->db->get();
					if(!empty($query->result_array())){
						$result['response']														= 'success';
						foreach($query->result_array() as $key => $value){
							$result['response_data'][$value['user_id']]							= ucfirst($value['title'].' '.$value['firstname'].' '.$value['lastname']);
						}
					}else{
						$result['response']														= 'empty';
					}
				}else{
					$result['response']															= 'empty';
				}
			}else{
				$result['response']																= 'failed';
			}
			echo json_encode($result);
		}
		
		function clinician_services(){
			$result																				= array();
			if(isset($_POST) && !empty($_POST)){
				$this->db->where('consulting_venue_id',$_POST['cons_loc']);
				$this->db->select('service_id');
				$location_services 																= $this->db->get('consulting_services_details')->result_array();
				$this->db->where('user_id',$_POST['cl']);
				$this->db->select('service_id');
				$user_services 																	= $this->db->get('user_services')->result_array();
				$location_list																	= array();
				$user_list																		= array();
				foreach($location_services as $l_key => $l_val){
					$location_list[]															= $l_val['service_id'];
				}
				foreach($user_services as $u_key => $u_val){
					$user_list[]																= $u_val['service_id'];
				}
				$qry_common 																	= array_intersect($location_list,$user_list);
				if(!empty($qry_common)){
					$this->db->where_in('id',$qry_common);
					$this->db->select('service_name,id');
					$result['response']															= 'success';
					$result['response_data'] 													= $this->db->get('services')->result_array();
				}else{
					$result['response']															= 'empty';
				}
			}else{
				$result['response']																= 'failed';
			}
			echo json_encode($result);
		}
		
		function location_details(){
			$response																			= array();
			$searchTerm 																		= $_GET['term'];
			$limit 																				= 10;
			if($searchTerm == ""){
				$searchTerm																		= "%";
			}else{
				$searchTerm 																	= "%".$searchTerm. "%";
			}
			$this->db->where('consulting_name LIKE "'.$searchTerm.'"');
			$this->db->where('created_by',$this->session->userdata('User')['id']);
			$this->db->select('id,consulting_name,address');
			$location_services 																	= $this->db->get('consulting_venues')->result_array();
			$i	= 0;
			foreach($location_services as $key => $val){
				$response[$i]['value']														 	= $val['id'];
				$response[$i]['label']															= $val['consulting_name'].' - '.$val['address'];
				$i++;
			}
			echo json_encode($response);
		}
		
		function clinicians(){
			$results																			= array();
			if($_POST && !empty($_POST)){
				$results																		= $this->common->clinician_list(trim($_POST['a']));
			}else{
				$results['response']															= 'failed';
			}
			echo json_encode($results);
		}
		
		function slot_creation(){
			$results																			= array();
			if($_POST && !empty($_POST)){
				if(isset($_POST['data']) && !empty($_POST['data'])){
					$data																		= $_POST['data'];
					$slot_parent_details														= array();
					$slot_parent_details['slot_date']											= implode('-',array_reverse(explode('/',$data['CreateDate'])));
					$slot_parent_details['professional_type_id']								= $data['ProfessionalType'];
					$slot_parent_details['professional_id']										= $data['Clinician'];
					$slot_parent_details['consulting_venues_id']								= $data['ConsultingLocation'];
					$slot_parent_details['consulting_room_id']									= $data['ConsultingRoom'];
					
					if(isset($_POST['data']['Title']) && trim($_POST['data']['Title']) !=''){
						$slot_parent_details['slot_title']										= $data['Title'];
					}
					if(isset($_POST['data']['BreakStart']) && $_POST['data']['BreakStart'] !='' && isset($_POST['data']['BreakEnd']) && $_POST['data']['BreakEnd'] !='' && isset($_POST['data']['BreakDuration'])){
						$slot_parent_details['break_start_time']								= $data['BreakStart'];
						$slot_parent_details['break_end_time']									= $data['BreakEnd'];
						$slot_parent_details['break_minutes']									= $data['BreakDuration'];
					}
					$slot_parent_details['slot_owner_id']										=  $this->session->userdata('User')['id'];
					if(isset($_POST['Repeat']) && $_POST['Repeat'] == 'on'){
						$slot_parent_details['user_slot_repeat_id']								= '';
					}
					$slot_parent_details['created_by']											= $this->session->userdata('User')['id'];
					$slot_parent_details['created_date']										= date('Y-m-d H:i:s');
					$slot_parent_details['modified_by']											= $this->session->userdata('User')['id'];
					$slot_parent_details['modified_date']										= date('Y-m-d H:i:s');
					$err_i																		= 0;
					foreach($data['Session'] as $session_key => $session_val){
						if($session_val	== 'All'){
							$slot_parent_details['start_time']									= $data['AllStartTime'];
							$slot_parent_details['end_time']									= $data['AllEndTime'];
							$slot_parent_details['slot_length']									= $data['AllLength'];
							$slot_parent_details['initial_slots']								= $data['AllNumSlot'];
						}else if($session_val	== 'Morning'){
							$slot_parent_details['start_time']									= $data['MornStartTime'];
							$slot_parent_details['end_time']									= $data['MornEndTime'];
							$slot_parent_details['slot_length']									= $data['MornLength'];
							$slot_parent_details['initial_slots']								= $data['MornNumSlot'];
						}else if($session_val	== 'Afternoon'){
							$slot_parent_details['start_time']									= $data['AftrStartTime'];
							$slot_parent_details['end_time']									= $data['AftrEndTime'];
							$slot_parent_details['slot_length']									= $data['AftrLength'];
							$slot_parent_details['initial_slots']								= $data['AftrNumSlot'];
						}else if($session_val	== 'Evening'){
							$slot_parent_details['start_time']									= $data['EveStartTime'];
							$slot_parent_details['end_time']									= $data['EveEndTime'];
							$slot_parent_details['slot_length']									= $data['EveLength'];
							$slot_parent_details['initial_slots']								= $data['EveNumSlot'];
						}
						$this->db->where('slot_date',$slot_parent_details['slot_date']);
						$this->db->where('consulting_venues_id',$slot_parent_details['consulting_venues_id']);
						$this->db->where('consulting_room_id',$slot_parent_details['consulting_room_id']);
						$where																	= "((TIME(start_time) < CAST('".$slot_parent_details['start_time']."' AS time)AND CAST('".$slot_parent_details['start_time']."' AS time) < TIME(end_time)) OR (TIME(start_time) < CAST('".$slot_parent_details['end_time']."' AS time) AND CAST('".$slot_parent_details['end_time']."' AS time) < TIME(end_time)) OR (start_time LIKE '".$slot_parent_details['start_time']."') OR (end_time LIKE '".$slot_parent_details['end_time']."'))";
						$this->db->where($where);
						$qry_row																= $this->db->get('slot_parent');
						//print_r($qry_row->result_array());
						
						if($data['SlotData']	== 'edit'){
							$exist_slot															=(array)json_decode($data['SlotSummary']);
							$this->db->where('slot_date',$slot_parent_details['slot_date']);
							$this->db->where('consulting_venues_id',$slot_parent_details['consulting_venues_id']);
							$this->db->where('consulting_room_id',$slot_parent_details['consulting_room_id']);
							$this->db->where('id !=',$exist_slot['slot_key']);
							$where																= "((TIME(start_time) < CAST('".$slot_parent_details['start_time']."' AS time)AND CAST('".$slot_parent_details['start_time']."' AS time) < TIME(end_time)) OR (TIME(start_time) < CAST('".$slot_parent_details['end_time']."' AS time) AND CAST('".$slot_parent_details['end_time']."' AS time) < TIME(end_time)) OR (start_time LIKE '".$slot_parent_details['start_time']."') OR (end_time LIKE '".$slot_parent_details['end_time']."'))";
							$this->db->where($where);
							$qry_row															= $this->db->get('slot_parent');
							
							$this->db->where('id',$exist_slot['slot_key']);
							$this->db->where('status_id',$this->config->item('Booked'));
							//$this->db->where('status != ','deleted');
							$qry_slot_row														= $this->db->get('slots');
							//print_r($qry_row->result_array());
							///print_r($qry_slot_row->result_array());
							//exit;
							if(empty($qry_row->result_array()) && empty($qry_slot_row->result_array())){ 
								$update_details													= array();
								$update_details['slot_date']									= implode('-',array_reverse(explode('/',$data['CreateDate'])));
								$update_details['professional_type_id']							= $data['ProfessionalType'];
								$update_details['professional_id']								= $data['Clinician'];
								$update_details['consulting_venues_id']							= $data['ConsultingLocation'];
								$update_details['consulting_room_id']							= $data['ConsultingRoom'];
								$update_details['slot_title']									= $data['Title'];
								$update_details['start_time']									= $slot_parent_details['start_time'];
								$update_details['end_time']										= $slot_parent_details['end_time'];
								$update_details['slot_length']									= $slot_parent_details['slot_length'];
								$update_details['initial_slots']								= $slot_parent_details['initial_slots'];
								$update_details['modified_by']									= $this->session->userdata('User')['id'];
								$update_details['modified_date']								= date('Y-m-d H:i:s');
								if($data['BreakStart'] == '' && $data['BreakEnd'] == '' && $data['BreakDuration'] == ''){
									$update_details['break_start_time']							= null;
									$update_details['break_end_time']							= null;
									$update_details['break_minutes']							= null;
								}else if($data['BreakStart'] != '' && $data['BreakEnd'] != '' && $data['BreakDuration'] != ''){
									$update_details['break_start_time']							= $data['BreakStart'];
									$update_details['break_end_time']							= $data['BreakEnd'];
									$update_details['break_minutes']							= $data['BreakDuration'];
								}
								$this->db->where('id',$exist_slot['slot_key']);
								$qry															= $this->db->update('slot_parent',$update_details);
								
								if($qry){
									$this->db->where('slot_parent_id',$exist_slot['slot_key']);
									$slot_asst													= array();
									$slot_asst['status']										= 'deleted';
									$qry														= $this->db->update('slot_parents_assistants',$slot_asst);
									
									if(isset($data['AsstClinician']) && !empty($data['AsstClinician'])){
										foreach($data['AsstClinician'] as $key => $val){
											$slot_assistants									= array();
											$slot_assistants['slot_parent_id']					= $exist_slot['slot_key'];
											$slot_assistants['user_id']							= $val;
											$slot_assistants['created_by']						= $this->session->userdata('User')['id'];
											$slot_assistants['modified_by']						= $this->session->userdata('User')['id'];
											$slot_assistants['created_date']					= date('Y-m-d H:i:s');
											$slot_assistants['modified_date']					= date('Y-m-d H:i:s');
											$qry_asst											= $this->db->insert('slot_parents_assistants', $slot_assistants);
										}
									}
									$this->db->where('slot_parent_id',$exist_slot['slot_key']);
									$slot_asst													= array();
									$slot_asst['status']										= 'deleted';
									$qry														= $this->db->update('slot_parents_services',$slot_asst);
									
									if(isset($data['Services']) && $data['Services'] !=''){
										$slot_service											= array();
										$slot_service['slot_parent_id']							= $exist_slot['slot_key'];
										$slot_service['service_id']								= trim($data['Services']);
										$slot_service['created_by']								= $this->session->userdata('User')['id'];
										$slot_service['modified_by']							= $this->session->userdata('User')['id'];
										$slot_service['created_date']							= date('Y-m-d H:i:s');
										$slot_service['modified_date']							= date('Y-m-d H:i:s');
										$qry_serv												= $this->db->insert('slot_parents_services', $slot_service);
									}
									
									$this->db->where('slot_parent_id',$exist_slot['slot_key']);
									$slot_asst													= array();
									$slot_asst['status']										= 'deleted';
									$qry														= $this->db->update('slots',$slot_asst);
									
									$start_time													= $update_details['start_time'];		
									$minutes													= $update_details['slot_length'];
									//echo "<pre>";
									for($i = 0 ;$i < $update_details['initial_slots'] ;$i++){
										$end_time												= date('h:i',strtotime($start_time . ' +'.$minutes.' minutes'));
										$slots													= array();
										$slots['slot_parent_id']								= $exist_slot['slot_key'];
										$slots['appointment_type_id']							= $data['AppointmentType'];
										$slots['start_time']									= $start_time;
										$slots['end_time']										= $end_time;
										$slots['status_id']										= $this->config->item('Open');
										$slots['created_by']									= $this->session->userdata('User')['id'];
										$slots['modified_by']									= $this->session->userdata('User')['id'];
										$slots['created_date']									= date('Y-m-d H:i:s');
										$slots['modified_date']									= date('Y-m-d H:i:s');
										if(isset($_POST['data']['BreakStart']) && $_POST['data']['BreakStart'] !='' && isset($_POST['data']['BreakEnd']) && $_POST['data']['BreakEnd'] !='' && isset($_POST['data']['BreakDuration'])){
											$BreakStart											= strtotime($data['BreakStart'].':00');
											$BreakEnd											= strtotime($data['BreakEnd'].':00');
											$start_tim											= strtotime($start_time.':00');
											$end_tim											= strtotime($end_time.':00');
											if(($BreakStart < $start_tim	 &&  $start_tim < $BreakEnd) || ($BreakStart < $end_tim && $end_tim < $BreakEnd)){
												$slots['break_status']							= 1; 
											}
										}
										$qry_slot												= $this->db->insert('slots', $slots);
										$start_time												= $end_time;
									}
									$results['response']										= 'success';
								}else{
									$results['response']										= 'failed';	
								}
							}else{
								$results['error'][$err_i]['date_err']							= $data['CreateDate'];
								$results['error'][$err_i]['session']							= $session_val;
								$results['error'][$err_i]['timing']								= $slot_parent_details['start_time'];
								$err_i++;
							}
						}else{
						 	if($qry_row->result_array() && !empty($qry_row->result_array())){
								$results['response']											= 'success';
								if(count($data['Session']) > 1  && $session_val != 'All'){
									$results['error'][$err_i]['date_err']						= $data['CreateDate'];
									$results['error'][$err_i]['session']						= $session_val;
									$results['error'][$err_i]['timing']							= $slot_parent_details['start_time'];
								}else{
									$results['error'][$err_i]['date_err']						= $data['CreateDate'];
									$results['error'][$err_i]['session']						= $session_val;
									$results['error'][$err_i]['timing']							= $slot_parent_details['start_time'];
								}
							}else{
								$qry															= $this->db->insert('slot_parent', $slot_parent_details);
								if($qry){
									$slot_parent_id												= $this->db->insert_id();
									if(isset($data['AsstClinician']) && !empty($data['AsstClinician'])){
										foreach($data['AsstClinician'] as $key => $val){
											$slot_assistants									= array();
											$slot_assistants['slot_parent_id']					= $slot_parent_id;
											$slot_assistants['user_id']							= $val;
											$slot_assistants['created_by']						= $this->session->userdata('User')['id'];
											$slot_assistants['modified_by']						= $this->session->userdata('User')['id'];
											$slot_assistants['created_date']					= date('Y-m-d H:i:s');
											$slot_assistants['modified_date']					= date('Y-m-d H:i:s');
											$qry_asst											= $this->db->insert('slot_parents_assistants', $slot_assistants);
										}
									}
									if(isset($data['Services']) && $data['Services'] !=''){
										$slot_service											= array();
										$slot_service['slot_parent_id']							= $slot_parent_id;
										$slot_service['service_id']								= trim($data['Services']);
										$slot_service['created_by']								= $this->session->userdata('User')['id'];
										$slot_service['modified_by']							= $this->session->userdata('User')['id'];
										$slot_service['created_date']							= date('Y-m-d H:i:s');
										$slot_service['modified_date']							= date('Y-m-d H:i:s');
										$qry_serv												= $this->db->insert('slot_parents_services', $slot_service);
									}
									$start_time													= $slot_parent_details['start_time'];		
									$minutes													= $slot_parent_details['slot_length'];
									//echo "<pre>";
									for($i = 0 ;$i < $slot_parent_details['initial_slots'] ;$i++){
										$end_time												= date('h:i',strtotime($start_time . ' +'.$minutes.' minutes'));
										$slots													= array();
										$slots['slot_parent_id']								= $slot_parent_id;
										$slots['appointment_type_id']							= $data['AppointmentType'];
										$slots['start_time']									= $start_time;
										$slots['end_time']										= $end_time;
										$slots['status_id']										= $this->config->item('Open');
										$slots['created_by']									= $this->session->userdata('User')['id'];
										$slots['modified_by']									= $this->session->userdata('User')['id'];
										$slots['created_date']									= date('Y-m-d H:i:s');
										$slots['modified_date']									= date('Y-m-d H:i:s');
										if(isset($_POST['data']['BreakStart']) && $_POST['data']['BreakStart'] !='' && isset($_POST['data']['BreakEnd']) && $_POST['data']['BreakEnd'] !='' && isset($_POST['data']['BreakDuration'])){
											$BreakStart											= strtotime($data['BreakStart'].':00');
											$BreakEnd											= strtotime($data['BreakEnd'].':00');
											$start_tim											= strtotime($start_time.':00');
											$end_tim											= strtotime($end_time.':00');
											if(($BreakStart < $start_tim	 &&  $start_tim < $BreakEnd) || ($BreakStart < $end_tim && $end_tim < $BreakEnd)){
												$slots['break_status']							= 1; 
											}
										}
										$qry_slot												= $this->db->insert('slots', $slots);
										$start_time												= $end_time;
									}
									$results['response']										= 'success';
								}else{
									$results['response']										= 'failed';
								}
							}
						}
						$err_i++;
					}
				}else{
					$results['response']														= 'failed';
				}
			}else{
				$results['response']															= 'failed';
			}
			echo json_encode($results);
		}
		
		function slot_details(){
			$results																			= array();
			if($_POST['search_key']){
				//print_r($_POST['search_key']);
				//exit;
				if(is_array ($_POST['search_key'])){
					$search_results																= $this->Diary_model->slot_parent_list($this->session->userdata('User')['id'],$_POST['search_key']['venue_id'],'',$_POST['search_key']['clinician'],$_POST['search_key']['services']);
				}else{
					$search_results																= $this->Diary_model->slot_parent_list($this->session->userdata('User')['id'],$_POST['search_key']);
				}
				if(!empty($search_results)){
					$results['response']														= 'success';
					$i																			= 0; 
					foreach($search_results as $key =>$val){
						$results['response_data'][$i]['title']									= ucfirst($val['title'].' '.$val['firstname'].' '.$val['lastname']);
						$results['response_data'][$i]['start']									= date('Y-m-d',strtotime($val['slot_date']));	
						$results['response_data'][$i]['img']									= base_url().'assets/uploads/'.$val['img_path'].$val['img_name'];
						$results['response_data'][$i]['key']									= $val['slot_date'];
						$rand = substr(md5(rand()), 0, 6);
						$results['response_data'][$i]['backgroundColor']						= '#' . $rand;
						$results['response_data'][$i]['borderColor']							= '#' . $rand;
						$results['response_data'][$i]['session_key']							= $this->encryptionfunction->enCrypt($val['slot_parent']);
						//$results['response_data'][$i]['editable']								= false;
						$i++;
					}
				}else{
					$results['response']														= 'empty';
				}
			}else{
				$results['response']															= 'failed';
			}
			echo json_encode($results);
		}
		
		function summary_details(){
			$results																			= array();
			if($_POST['a']){
				$search_results																	= $this->Diary_model->slot_parent_list($this->session->userdata('User')['id'],'',$_POST['a']);
				if(!empty($search_results)){
					$results['response']														= 'success';
					$i																			= 0; 
					foreach($search_results as $key =>$val){
						$slot_split																= $this->Diary_model->slot_split_list($val['slot_parent']);
						$asst_clinician															= $this->Diary_model->assistant_clinician($val['slot_parent']);
						if(!empty($asst_clinician)){
							$assistants															= '';
							$assistant_name														= '';
							foreach($asst_clinician as $a_key =>$a_val){
								$assistants													   .= $a_val['user_id'].',';
								$assistant_name												   .= $a_val['name'].', ';
							}
							$results['response_data'][$i]['assistants']							= trim($assistants,', ');
							$results['response_data'][$i]['assistant_name']						= trim($assistant_name,', ');
						}else{
							$results['response_data'][$i]['assistants']							= '';
							$results['response_data'][$i]['assistant_name']						= '';
						}
						$results['response_data'][$i]['name']									= ucfirst($val['title'].' '.$val['firstname'].' '.$val['lastname']);
						$results['response_data'][$i]['venue_name']								= $val['consulting_name'];	
						$results['response_data'][$i]['address']								= $val['address'];
						$results['response_data'][$i]['slot_date']								= date('d/m/Y',strtotime($val['slot_date']));
						$results['response_data'][$i]['start_time']								= $val['start_time'];
						$results['response_data'][$i]['end_time']								= $val['end_time'];
						$results['response_data'][$i]['request_key']							= $this->encryptionfunction->enCrypt($val['professional_id']);
						$results['response_data'][$i]['venue_key']								= $this->encryptionfunction->enCrypt($val['consulting_venues_id']);
						$results['response_data'][$i]['parent_key']								= $this->encryptionfunction->enCrypt($val['slot_parent']);
						$results['response_data'][$i]['professional_name']						= $val['type'];
						$results['response_data'][$i]['initial_slots']							= $val['initial_slots'];
						$results['response_data'][$i]['slot_key']								= $val['slot_parent'];
						$results['response_data'][$i]['consulting_location']					= $val['consulting_venues_id'];
						$results['response_data'][$i]['consulting_room']						= $val['consulting_room_id'];
						$results['response_data'][$i]['clinician_id']							= $val['professional_id'];
						$results['response_data'][$i]['professional_type']						= $val['professional_type_id'];
						$results['response_data'][$i]['service_id']								= $val['service_id'];
						$results['response_data'][$i]['slot_type_id']							= 1;
						$results['response_data'][$i]['brk_start_time']							= $val['break_start_time'];
						$results['response_data'][$i]['brk_end_time']							= $val['break_end_time'];
						$results['response_data'][$i]['brk_minute']								= $val['break_minutes'];
					
						if($val['slot_title']){
							$results['response_data'][$i]['slot_title']							= $val['slot_title'];
						}else{
							$results['response_data'][$i]['slot_title']							= '';
						}
						if($val['service_name']){
							$results['response_data'][$i]['service_name']						= $val['service_name'];
						}else{
							$results['response_data'][$i]['service_name']						= '';
						}
						if($val['img_path'] && $val['img_name']){
							$results['response_data'][$i]['img_src']							= base_url().'assets/uploads/'.$val['img_path'].$val['img_name'];
						}else{
							$results['response_data'][$i]['img_src']							= base_url().'assets/img/profile-image.png';
						}
						$results['response_data'][$i]['booked']									= (isset($slot_split[$this->config->item('Booked')]) ?  $slot_split[$this->config->item('Booked')]:'0');
						$results['response_data'][$i]['blocked']								= (isset($slot_split[$this->config->item('Blocked')]) ? $slot_split[$this->config->item('Blocked')]:'0');
						$results['response_data'][$i]['open']									= (isset($slot_split[$this->config->item('Open')]) ? $slot_split[$this->config->item('Open')]:'0');
						$i++;
					}
				}else{
					$results['response']														= 'empty';
				}
			}else{
				$results['response']															= 'failed';
			}
			echo json_encode($results);
		}
		
		function get_slot_details(){
			if($_POST && !empty($_POST)){
				$search_results																	= $this->Diary_model->slot_details($this->session->userdata('User')['id'], $this->encryptionfunction->deCrypt($_POST['a']),$this->encryptionfunction->deCrypt($_POST['b']));
				$asst_clinician																	= $this->Diary_model->assistant_clinician($this->encryptionfunction->deCrypt($_POST['b']));
				if(!empty($asst_clinician)){
					$assistants																	= '';
					$assistant_name																= '';
					foreach($asst_clinician as $a_key =>$a_val){
						$assistants															   .= $a_val['user_id'].',';
						$assistant_name														   .= $a_val['name'].', ';
					}
					$results['slot_details']['assistants']										= trim($assistants,', ');
					$results['slot_details']['assistant_name']									= trim($assistant_name,', ');
				}else{
					$results['slot_details']['assistants']										= '';
					$results['slot_details']['assistant_name']									= '';
				}
				if(!empty($search_results)){
					$results['response']														= 'success';
					$i																			= 0;
					$results['name']															= ucfirst($search_results[0]['title'].' '.$search_results[0]['firstname'].' '.$search_results[0]['lastname']);
					if($search_results[0]['img_path'] && $search_results[0]['img_name']){
						$results['img_src']														= base_url().'assets/uploads/'.$search_results[0]['img_path'].$search_results[0]['img_name'];
					}else{
						$results['img_src']														= base_url().'assets/img/profile-image.png';
					}
					$results['slot_date']														= date('d/m/Y',strtotime($search_results[0]['slot_date']));
					$results['venue_name']														= $search_results[0]['consulting_name'];
					$results['address']															= $search_results[0]['address'];
					$results['professional_name']												= $search_results[0]['type'];
					$results['parent_duration']													= $search_results[0]['parent_start'].' - '.$search_results[0]['parent_end'];
					$results['slot_details']['consulting_location']								= $search_results[0]['consulting_venues_id'];
					$results['slot_details']['consulting_room']									= $search_results[0]['consulting_room_id'];
					$results['slot_details']['slot_date']										= date('d/m/Y',strtotime($search_results[0]['slot_date']));
					$results['slot_details']['start_time']										= $search_results[0]['parent_start'];
					$results['slot_details']['end_time']										= $search_results[0]['parent_end'];
					$results['slot_details']['slot_key']										= $search_results[0]['slot_parent'];
					$results['slot_details']['clinician_id']									= $search_results[0]['professional_id'];
					$results['slot_details']['professional_type']								= $search_results[0]['professional_type_id'];
					$results['slot_details']['service_id']										= $search_results[0]['service_id'];
					$results['slot_details']['slot_type_id']									= $search_results[0]['slot_type_id'];
					$results['slot_details']['brk_start_time']									= $search_results[0]['break_start_time'];
					$results['slot_details']['brk_end_time']									= $search_results[0]['break_end_time'];
					$results['slot_details']['brk_minute']										= $search_results[0]['break_minutes'];
					$slot_split																	= $this->Diary_model->slot_split_list($search_results[0]['slot_parent']);
					$results['slot_details']['booked']											= (isset($slot_split[$this->config->item('Booked')]) ?  $slot_split[$this->config->item('Booked')]:'0');
					$results['slot_details']['blocked']											= (isset($slot_split[$this->config->item('Blocked')]) ? $slot_split[$this->config->item('Blocked')]:'0');
					$results['slot_details']['open']											= (isset($slot_split[$this->config->item('Open')]) ? $slot_split[$this->config->item('Open')]:'0');
					
					if($search_results[0]['slot_title']){
						$results['slot_details']['slot_title']									= $search_results[0]['slot_title'];
					}else{
						$results['slot_details']['slot_title']									= '';
					}
					
					if($search_results[0]['service_name']){
						$results['slot_details']['service_name']								= $search_results[0]['service_name'];
					}else{
						$results['slot_details']['service_name']								= '';
					}
					$results['slot_details']['slot_length']										= $search_results[0]['slot_length'];
					$results['slot_details']['initial_slots']									= $search_results[0]['initial_slots'];
					foreach($search_results as $key =>$val){
						$results['response_data'][$i]['start_d']								= $val['start_time'];
						if($val['appointment_type'] != 'All'){
							$results['response_data'][$i]['slot_type']							= " (".$val['appointment_type'].")";
						}else {
							$results['response_data'][$i]['slot_type']							= '';
						}
						$results['response_data'][$i]['slot_i_key']								= $val['slot_i_key'];
						if($val['status_id'] == $this->config->item('Blocked')){
							$results['response_data'][$i]['bg_color']							= '#ffddae';
						}else if($val['status_id'] == $this->config->item('Open')){
							$results['response_data'][$i]['bg_color']							= '#ffffff';
						}
						if($val['slot_creation_type'] =='duplicate'){
							$results['response_data'][$i]['bg_color']							= '#fff267a1';
						}
						$results['response_data'][$i]['slot_creation_type']						= $val['slot_creation_type'];
						$i++;
					}
				}else{
					$results['response']														= 'empty';
				}
			}else{
				$results['response']															= 'failed';
			}
			echo json_encode($results);
		}
		
		function change_slot_data(){
			if($_POST && !empty($_POST)){
				$search_results																	= $this->Diary_model->slot_details($this->session->userdata('User')['id'], $_POST['clinician'],$_POST['slot_key'],$_POST['status']);
				if(!empty($search_results)){
					$results['response']														= 'success';
					$i																			= 0;
					foreach($search_results as $key =>$val){
						$results['response_data'][$i]['start_d']								= $val['start_time'];
						$results['response_data'][$i]['slot_i_key']								= $val['slot_i_key'];
						if($val['appointment_type'] != 'All'){
							$results['response_data'][$i]['slot_type']							= " (".$val['appointment_type'].")";
						}else {
							$results['response_data'][$i]['slot_type']							= '';
						}
						
						if($val['status_id'] == $this->config->item('Blocked')){
							$results['response_data'][$i]['bg_color']							= '#ffddae';
						}else if($val['status_id'] == $this->config->item('Open')){
							$results['response_data'][$i]['bg_color']							= '#ffffff';
						}
						if($val['slot_creation_type'] =='duplicate'){
							$results['response_data'][$i]['bg_color']							= '#fff267a1';
						}
						$i++;
					}
				}else{
					$results['response']														= 'empty';
				}
			}else{
				$results['response']															= 'failed';
			}
			echo json_encode($results);
		}
		
		function check_slot_reversed(){
			$results																			= array();
			if($_POST && !empty($_POST)){
				$slot_parent_id																	= $this->encryptionfunction->deCrypt($_POST['session_key']);
				$this->db->where('slot_parent_id',$slot_parent_id);
				$this->db->where('status_id',$this->config->item('Booked'));
				$this->db->where('status IS NULL');
				$this->db->from('slots');
				$qry																			= $this->db->get();	
				if(empty($qry->row_array())){
					$results['response']														= 'success';
				}else{
					$results['response']														= 'booked';
				}
			}else{
				$results['response']															= 'failed';
			}
			echo json_encode($results);
		}
		function port_slot_session(){
			$results																			= array();
			if($_POST && !empty($_POST)){
				$slot_parent_id																	= $this->encryptionfunction->deCrypt($_POST['b']);
				$this->db->where('id',$slot_parent_id);
				$update_details																	= array();
				$update_details['slot_date']													= trim($_POST['a']);
				$update_details['modified_by']													= $this->session->userdata('User')['id'];
				$update_details['modified_date']												= date('Y-m-d H:i:s');
				$qry																			= $this->db->update('slot_parent',$update_details);
				if($qry){
					$results['response']														= 'success';
				}else{
					$results['response']														= 'failed';
				}
			}else{
				$results['response']															= 'failed';
			}
			echo json_encode($results);
		}
		function block_slots(){
			$results																			= array();
			if($_POST && !empty($_POST)){
				$this->db->where_in('id', $_POST['Arr']);
				$this->db->from('slots');
				$qry 																			= $this->db->get();
				if(!empty($qry->result_array())){
					$this->db->where_in('id', $_POST['Arr']);
					$status																		= array();
					$status['status_id']														= $this->config->item('Blocked');
					$status['modified_by']														= $this->session->userdata('User')['id'];
					$status['modified_date']													= date('Y-m-d H:i:s');
					$qry																		= $this->db->update('slots',$status);
					if($qry){
						$results['response']													= 'success';
					}else{
						$results['response']													= 'failed';
					}
				}else{
					$results['response']														= 'failed';
				}
			}else{
				$results['response']															= 'failed';
			}
			echo json_encode($results);
		}
		function delete_slots(){
			$results																			= array();
			if($_POST && !empty($_POST)){
				$this->db->where_in('id', $_POST['Arr']);
				$this->db->from('slots');
				$qry 																			= $this->db->get();
				if(!empty($qry->result_array())){
					$this->db->where_in('id', $_POST['Arr']);
					$status																		= array();
				//	$status['status_id']														= $this->config->item('Blocked');
					$status['status']															= 'deleted';
					$status['modified_by']														= $this->session->userdata('User')['id'];
					$status['modified_date']													= date('Y-m-d H:i:s');
					$qry																		= $this->db->update('slots',$status);
					if($qry){
						$results['response']													= 'success';
					}else{
						$results['response']													= 'failed';
					}
				}else{
					$results['response']														= 'failed';
				}
			}else{
				$results['response']															= 'failed';
			}
			echo json_encode($results);
		}
		
		function duplicate_slot(){
			$result																				= array();
			if($_POST && !empty($_POST)){
				$this->db->where_in('id', $_POST['Arr']);
				$this->db->from('slots');
				$this->db->select('slot_parent_id,appointment_type_id,start_time,end_time,slot_type_id');
				$qry 																			= $this->db->get();
				if(!empty($qry->result_array())){
					foreach($qry->result_array() as $key => $val){
						$where																	= $val;
						$where['slot_creation_type']											= 'duplicate';
						$this->db->where($where);
						$slots																	= array();
						$slots['slot_parent_id']												= $val['slot_parent_id'];
						$slots['appointment_type_id']											= $val['appointment_type_id'];
						$slots['start_time']													= $val['start_time'];
						$slots['end_time']														= $val['end_time'];
						$slots['slot_type_id']													= $val['slot_type_id'];
						$slots['status_id']														= $this->config->item('Open');
						$slots['slot_creation_type']											= 'duplicate';
						$slots['duplicate_count']												= $this->db->count_all_results('slots');
						$slots['created_by']													= $this->session->userdata('User')['id'];
						$slots['modified_by']													= $this->session->userdata('User')['id'];
						$slots['created_date']													= date('Y-m-d H:i:s');
						$slots['modified_date']													= date('Y-m-d H:i:s');
						$ins_slt																= $this->db->insert('slots', $slots);
						$slots['slot_i_key']													= $this->db->insert_id();
						$results['response_data'][]												= $slots;
					}
					$results['response']														= 'success';
				}else{
					$results['response']														= 'failed';
				}
			}else{
				$results['response']															= 'failed';
			}
			echo json_encode($results);
		}
		
		function delete_slot_bundle(){
			$results['response']																=  array();	
			if($_POST && !empty($_POST)){
				$this->db->where('id', trim($_POST['a']));
				$this->db->from('slot_parent');
				$qry 																			= $this->db->get();
				if(!empty($qry->result_array())){
					$update_details																= array();
					$update_details['status']													= 'inactive';
					$update_details['modified_by']												= $this->session->userdata('User')['id'];
					$update_details['modified_date']											= date('Y-m-d H:i:s');
					$this->db->where('id',trim($_POST['a']));
					$qry																		= $this->db->update('slot_parent',$update_details);
					if($qry){
						$results['response']													= 'success';
					}else{
						$results['response']													= 'failed';
					}
				}else{
					$results['response']														= 'failed';
				}
			}else{
				$results['response']															= 'failed';
			}
			echo json_encode($results);
		}
		
		
	}
?>
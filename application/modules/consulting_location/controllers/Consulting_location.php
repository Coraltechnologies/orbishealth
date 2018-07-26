<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Consulting_location extends CI_Controller {
		
		public function __construct(){
	
			parent::__construct();
			$this->load->model('consulting_location_model');
		 	$this->load->helper(array('form','url','loginvalidate'));
			$this->load->library(array('Common','EncryptionFunction','form_validation'));
		}
		
		function index($venue_id = null){
			$data							= array();
			$data['country']				= $this->common->country_details();
			$data['services']				= $this->common->service_name();
			if($venue_id){
				$venue_id					= $this->encryptionfunction->deCrypt($venue_id);
				$data['details'] 			= $this->consulting_location_model->get_venue_details($venue_id);
				$this->db->where('consulting_venue_id', $data['details']['id']); 
				$data['documents']      	= $this->db->get('consulting_venue_documents')->result_array();
				$data['user_services']	    = $this->consulting_location_model->venue_services($data['details']['id']);
				$this->db->where('consulting_venue_id', $data['details']['id']);
				$data['consulting_hours']	= $this->db->get('consulting_hours')->result_array();
				$this->db->where('consulting_venue_id', $data['details']['id']);
				$data['consulting_room']	= $this->db->get('consulting_room')->result_array();
			}
			#$this->load->view('create_consulting_location',$data);
			//$this->load->view('manage_consulting_summary',$data);
			$this->template->render_content('create_consulting_location',$data);
		}
		
		function save_details(){
			$response									= array();
			if(isset($_POST)  && !empty($_POST)){
			
				$data									= array();	
				$data['consulting_name']				= $_POST['Consultation']['name'];
				$data['country_id']						= $_POST['Consultation']['country_id'];
				$data['postcode']						= $_POST['Consultation']['postcode'];
				$data['city_town']						= $_POST['Consultation']['city_town'];
				$data['state']							= $_POST['Consultation']['state'];
				$data['address']						= $_POST['Consultation']['address'];
				$data['tel1']							= $_POST['Consultation']['tel1'];
				if(isset($_POST['Consultation']['tel2']) && trim($_POST['Consultation']['tel2']) != ''){
					$data['tel2']						= $_POST['Consultation']['tel2'];
				}
				$data['email1']							= $_POST['Consultation']['email1'];
				if(isset($_POST['Consultation']['email2']) && trim($_POST['Consultation']['email2']) != ''){
					$data['email1']						= $_POST['Consultation']['email2'];
				}
				if(isset($_POST['iCheck']) && trim($_POST['iCheck']) == 'no'){
					$data['disable_access']				= 0;
				}else{
					$data['disable_access']				= 1;
				}
				$data['parking']						= $_POST['iCheck1'];
				
				if(isset($_POST['Consultation']['parking_dir']) && trim($_POST['Consultation']['parking_dir']) != ''){
					$data['parking_direction']			= $_POST['Consultation']['parking_dir'];
				}
				
				$data['modified_by']					= $this->session->userdata('User')['id'];
				$data['modified_date']					= date('Y-m-d H:i:s');
				if(isset($_POST['location_key']) && $_POST['location_key'] !=''){
					$this->db->where(array('id'=> $_POST['location_key'] ));
					$qry								= $this->db->update('consulting_venues', $data);
					$insert_id							= $_POST['location_key'];
				}else{
					$data['created_by']					= $this->session->userdata('User')['id'];
					$data['created_date']				= date('Y-m-d H:i:s');
					$qry								= $this->db->insert('consulting_venues', $data);
					$insert_id 							= $this->db->insert_id();
				}
				
				if($qry){
					$response['response']				= 'success';
					$response['last_time']				= date('d/m/Y H:i:s');
					$response['last_id']				= $insert_id;
				}else{
					$response['response']				= 'failed';
				}
			}else{
				$response['response']					= 'failed';
			}
			echo json_encode($response);
		}
		
		function service_hours(){
			$response											= array();
			if($_POST && !empty($_POST)){
				if(isset($_POST['Services']) && !empty($_POST['Services'])){
					$this->db->where('consulting_venue_id', $_POST['location_key']);
					$this->db->delete('consulting_services_details');
					foreach($_POST['Services'] as $s_key => $s_val){
						$s_details								= array();
						$s_details['user_id']					= $this->session->userdata('User')['id'];
						$s_details['consulting_venue_id']		= $_POST['location_key'];
						$s_details['service_id']				= $s_val;
						$s_details['created_by']				= $this->session->userdata('User')['id'];
						$s_details['modified_by']				= $this->session->userdata('User')['id'];
						$s_details['created_date']				= date('Y-m-d H:i:s');
						$s_details['modified_date']				= date('Y-m-d H:i:s');
						$qry									= $this->db->insert('consulting_services_details', $s_details);
					}
				}
				if($_POST['further'] && isset($_POST['further']) && trim($_POST['further']) !=''){
					$s_details									= array();
					$s_details['further_details']				= trim($_POST['further']);
					$this->db->where(array('id'=> $_POST['location_key'] ));
					$qry										= $this->db->update('consulting_venues' ,$s_details);
				}
				if(isset($_POST['room_txt']) && trim($_POST['room_txt'])  !=''){
					$txt_room									= explode(',',trim($_POST['room_txt']));
					foreach($txt_room as $room_key => $room_val){
						if(trim($room_val) != ''){
							$room_details							= array();
							$room_details['user_id']				= $this->session->userdata('User')['id'];
							$room_details['consulting_venue_id']	= $_POST['location_key'];
							$room_details['consulting_room_title']	= $room_val;
							$room_details['created_by']				= $this->session->userdata('User')['id'];
							$room_details['modified_by']			= $this->session->userdata('User')['id'];
							$room_details['created_date']			= date('Y-m-d H:i:s');
							$room_details['modified_date']			= date('Y-m-d H:i:s');
							$qry									= $this->db->insert('consulting_room', $room_details);
						}
					}
				}
				foreach($_POST['ServiceHours'] as $key => $val){
					$details									= array();
					$details['user_id']							= $this->session->userdata('User')['id'];
					$details['consulting_venue_id']				= $_POST['location_key'];
				 	if(isset($val['day']) && $val['day']== 'on'){
						if(isset($val['full']) && $val['full']== 'on'){
							$details['work_24_7']				= 1;
					 	}else{
							$details['work_24_7']				= null;
							if(isset($val['mor_chk']) && $val['mor_chk'] == 'on'){
								$details['morn_start']			= $val['mor']['start'];
								$details['morn_end']			= $val['mor']['end'];
							}
							if(isset($val['aftr_chk']) && $val['aftr_chk'] == 'on'){
								$details['aftr_start']			= $val['aftr']['start'];
								$details['aftr_end']			= $val['aftr']['end'];	
							}
							if( isset($val['eve_chk']) && $val['eve_chk'] == 'on'){
								$details['eve_start']			= $val['eve']['start'];
								$details['eve_end']				= $val['eve']['end'];
							}
						}
					}else{
						$details['work_24_7']					= null;
						$details['morn_start']					= null;
						$details['morn_end']					= null;
						$details['aftr_start']					= null;
						$details['aftr_end']					= null;
						$details['eve_start']					= null;
						$details['eve_end']						= null;
					}
					$details['day_id']							= $key;
					$details['modified_by']						= $this->session->userdata('User')['id'];
					$details['modified_date']					= date('Y-m-d H:i:s');
					$this->db->from('consulting_hours');
					$this->db->where(array('consulting_venue_id'=> $_POST['location_key'] ,'day_id'=> $key));
					$query 										= $this->db->get();
					if($query->num_rows() > 0){
						$this->db->where(array('consulting_venue_id'=> $_POST['location_key'] ,'day_id'=> $key));
						$qry									= $this->db->update('consulting_hours' ,$details);
					}else{
						$details['created_by']					= $this->session->userdata('User')['id'];
						$details['created_date']				= date('Y-m-d H:i:s');
						$qry									= $this->db->insert('consulting_hours', $details);
					}
				}
				if($qry){
					$response['response']						= 'success';
					$response['last_time']						= date('d/m/Y H:i:s');
				}else{
					$response['response']						= 'failed';
				}				
			}else{
				$response['response']							= 'failed';
			}
			echo  json_encode($response);
		}
		
		function  service_documents(){
			$result											= array();
			if(isset($_FILES) && !empty($_FILES)){
				if($_POST['file_type'] && isset($_POST['file_type'])){
					$path_dir								= '';
					if(trim($_POST['file_type'])=='upload_doc'){
						$path_dir							= 'documents';
					}else if(trim($_POST['file_type'])=='upload_img'){
						$path_dir							= 'images';
					}else if(trim($_POST['file_type'])=='upload_video'){
						$path_dir							= 'videos';
					}
				}
				$i									= 1;
				foreach($_FILES['file']['name'] as $file_key =>$file_val){
					$details							= array();
					if(!is_dir(FCPATH .'assets/uploads/'.$this->session->userdata('User')['id'].'/consulting_venue/'.$path_dir)) {
						mkdir(FCPATH .'assets/uploads/'.$this->session->userdata('User')['id'].'/consulting_venue/'.$path_dir, 0777, true);
					}
					$tmp									= $_FILES['file']['tmp_name'][$file_key];
					$ext									= explode('.',$file_val);
					$time_st								= time();
					$dst									= FCPATH.'assets/uploads/'.$this->session->userdata('User')['id'].'/consulting_venue/'.$path_dir.'/document_'.$i.'_'.$this->session->userdata('User')['id'].'_'.$time_st.'.'.$ext[1];
					if(move_uploaded_file($tmp, $dst)){
						$details['file_name']				= 'document_'.$i.'_'.$this->session->userdata('User')['id'].'_'.$time_st.'.'.$ext[1];
						$details['file_path']				= $this->session->userdata('User')['id'].'/consulting_venue/'.$path_dir.'/';
						$details['user_id']					= $this->session->userdata('User')['id'];
						$details['consulting_venue_id']		= $_POST['location_key'];
						$details['file_type']				= $path_dir;
						$details['title']					= $_POST['title'][$file_key];
						$details['show_public']				= $_POST['show'][$file_key];
						$details['created_by']				= $this->session->userdata('User')['id'];
						$details['modified_by']				= $this->session->userdata('User')['id'];
						$details['created_date']			= date('Y-m-d H:i:s');
						$details['modified_date']			= date('Y-m-d H:i:s');
						$qry								= $this->db->insert('consulting_venue_documents', $details);
						$result['details'][]				= $details;
					}
					$i++;
				}
				if($qry){
					$result['response']						= 'success';
					$result['saved_time']					= date('d/m/Y H:i:s');
				}else{
					$result['response']						= 'failed';
				}
			}else{
				$result['response']							= 'failed';
			}
			echo json_encode($result);
		}
		
		function manage_venue(){
			$data											= array();
			$data 											= $this->consulting_location_model->get_venue_details();
			$data['services_name']							= $this->common->service_name();
			//$this->load->view('manage_consulting_location',$data);
			
			$this->template->render_content('manage_consulting_location',$data);
		}
		
		function change_room_status(){
			$json_value										= array();
			if(isset($_POST) && !empty($_POST)){
				$condition									= array('consulting_venue_id'=>trim($_POST['a']),'id'=>trim($_POST['b']));
				$this->db->where($condition);
				$qry										= $this->db->get('consulting_room')->row_array();
				$update_details								= array();
				if($qry && !empty($qry)){
					$this->db->where($condition);
					if($qry['status'] =='active'){
						$update_details						= array('status'=>'inactive','modified_by'=>$this->session->userdata('User')['id'],'modified_date'=>date('Y-m-d H:i:s'));
						$qry								= $this->db->update('consulting_room' ,$update_details);
						$json_value							= array('response'=>'success','status'=>'inactive');
					}else{
						$update_details						= array('status'=>'active','modified_by'=>$this->session->userdata('User')['id'],'modified_date'=>date('Y-m-d H:i:s'));
						$qry								= $this->db->update('consulting_room' ,$update_details);
						$json_value							= array('response'=>'success','status'=>'active');
					}
				}else{
					$json_value								= array('response'=>'failed');
				}
			}else{
				$json_value									= array('response'=>'failed');
			}
			echo json_encode($json_value);
		}
		
		function update_room_text(){
			$json_value										= array();
			$color											= '';
			$status											= '';
			if(isset($_POST) && !empty($_POST)){
				$condition									= array('consulting_venue_id'=>trim($_POST['a']),'id'=>trim($_POST['b']));
				$this->db->where($condition);
				$qry										= $this->db->get('consulting_room')->row_array();
				$update_details								= array();
				if($qry && !empty($qry)){
					$status									= $qry['status'];
					$this->db->where($condition);
					$update_details							= array('consulting_room_title'=>trim($_POST['c']),'modified_by'=>$this->session->userdata('User')['id'],'modified_date'=>date('Y-m-d H:i:s'));
					$qry									= $this->db->update('consulting_room' ,$update_details);
					if($qry){
						if($status == 'active'){
							$color							= '#146068';
						}else{
							$color							= '#f11d1d';
						}
						$response_txt						= '<span>'.trim($_POST['c']).'</span><span class="pull-right"><i class="fa fa-check-circle" id="room_status_'.trim($_POST['b']).'" onclick="change_status('.trim($_POST['a']).','.trim($_POST['b']).');" style="color:'.$color.'"></i> <i class="fa fa-edit" onclick="edit_room('."'".$_POST['c']."'	".','.trim($_POST['b']).','.trim($_POST['a']).');"></i></span>';
						$json_value							= array('response'=>'success','response_text'=>$response_txt);
					}else{
						$json_value							= array('response'=>'failed');
					}
				}else{
					$json_value								= array('response'=>'failed');
				}
			}else{
				$json_value									= array('response'=>'failed');
			}
			echo json_encode($json_value);
		}
		function manage_consulting_room(){
			$data														= array();
			$data['details']											= $this->consulting_location_model->get_venue_list();
			$data['team']												= $this->consulting_location_model->clinician_list();
			$data['room_list']											= $this->consulting_location_model->assigned_room_list();
			//$this->load->view('manage_consulting_room',$data);
			$this->template->render_content('manage_consulting_room',$data);
		//	$this->load->view('consulting_room_sampl',$data);
			
		}
		function list_consulting_room(){	
			$result														= array();
			if(isset($_POST) && !empty($_POST['a'])){
				$this->db->where_in('consulting_venue_id',$_POST['a']);
				$this->db->where('delete_status',0);
				$qry													= $this->db->get('consulting_room')->result_array();
				if($qry && !empty($qry)){
					$result												= array('response'=>'success','response_data'=>$qry);
				}else if(empty($qry)){	
					$result												= array('response'=>'empty');
				}else{
					$result												= array('response'=>'failed');	
				}
			}else{
				$result													= array('response'=>'failed');
			}
			echo json_encode($result);
		}
		
		function assign_consulting_room(){
			$result														= array();
			if(isset($_POST) && !empty($_POST)){
				$qry													= array();
				$this->db->where_in('id',$_POST['consulting_room']);
				$qry													= $this->db->get('consulting_room')->result_array();
				if(isset($_POST['clinician']) && !empty($_POST['clinician'])){
					$result['response']									= 'success';
					$result['response_data']							= array();
					$room_id											= array();
					$exist_id											= array();
					foreach($_POST['clinician'] as $key =>$val){
						foreach($qry as $r_key => $r_val){
						 	$save_details								= array();
							$save_details['consulting_venue_id']		= $r_val['consulting_venue_id'];
							$save_details['consulting_room_id']			= $r_val['id'];
							$save_details['clinician_id']				= $val;
							$save_details['status']						= 'active';
							$save_details['created_by']					= $this->session->userdata('User')['id'];
							$save_details['modified_by']				= $this->session->userdata('User')['id'];
							$save_details['created_date']				= date('Y-m-d H:i:s');
							$save_details['modified_date']				= date('Y-m-d H:i:s');
							$exist_qry									= array();
							$this->db->where(array('consulting_venue_id'=>$r_val['consulting_venue_id'],'consulting_room_id'=>$r_val['id'],'clinician_id'=>$val,'delete_status != '=>1));
							$exist_qry								    = $this->db->get('assign_consulting_room')->row_array();
							if(!$exist_qry){ 
								$qry_room								= $this->db->insert('assign_consulting_room', $save_details);
								if($qry_room){
									$room_id[]							= $this->db->insert_id();	
								}
							}else{
								$result['response_addtional']			= 'exist';
								$exist_id[]								=  $exist_qry['id'];
							}
						}
					}
					if($room_id && isset($room_id) && !empty($room_id)){
						$this->db->where_in('AssignConsultingRoom.id',$room_id);
						$this->db->from('consulting_room as ConsultingRoom');
						$this->db->join('assign_consulting_room as AssignConsultingRoom', 'AssignConsultingRoom.consulting_room_id = ConsultingRoom.id','LEFT');
						$this->db->join('consulting_venues as ConsultingVenue', 'ConsultingVenue.id = ConsultingRoom.consulting_venue_id','LEFT');
						$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id =AssignConsultingRoom.clinician_id','LEFT');
						$this->db->select('ConsultingVenue.consulting_name,ConsultingVenue.address,ConsultingRoom.consulting_room_title,UserPersonalDetail.title,UserPersonalDetail.firstname,UserPersonalDetail.middlename,UserPersonalDetail.lastname');
						$this->db->group_by('AssignConsultingRoom.id'); 
						$qry_new										= $this->db->get();
						$result['response_data']						= $qry_new->result_array();
					}
					
					if($exist_id && isset($exist_id) && !empty($exist_id)){
						$this->db->where_in('AssignConsultingRoom.id',$exist_id);
						$this->db->from('consulting_room as ConsultingRoom');
						$this->db->join('assign_consulting_room as AssignConsultingRoom', 'AssignConsultingRoom.consulting_room_id = ConsultingRoom.id','LEFT');
						$this->db->join('consulting_venues as ConsultingVenue', 'ConsultingVenue.id = ConsultingRoom.consulting_venue_id','LEFT');
						$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id =AssignConsultingRoom.clinician_id','LEFT');
						$this->db->select('ConsultingVenue.consulting_name,ConsultingVenue.address,ConsultingRoom.consulting_room_title,UserPersonalDetail.title,UserPersonalDetail.firstname,UserPersonalDetail.middlename,UserPersonalDetail.lastname');
						$this->db->group_by('AssignConsultingRoom.id'); 
						$qry_new										= $this->db->get();
						$result['response_addtional_info']				= $qry_new->result_array();
					}
				}else{
					$result['response']									= 'failed';
				}
			}else{
				$result['response']										= 'failed';
			}
			echo json_encode($result);
		}
		
		function search_consulting_room(){
			$result														= array();
			if(isset($_POST) && !empty($_POST)){
				$condition												= array();
				if(isset($_POST['consulting_val']) && $_POST['consulting_val'] !=''){
					$consulting_room									= $_POST['consulting_val'];
					$this->db->where("ConsultingRoom.consulting_room_title LIKE '%$consulting_room%'");
				}
				
				if(isset($_POST['professional_val']) && $_POST['professional_val'] !=''){
					$prof_val											= $_POST['professional_val'];
					$this->db->where("concat_ws('',UserPersonalDetail.firstname,UserPersonalDetail.middlename,UserPersonalDetail.lastname) LIKE '%$prof_val%'");
				}
				
				if(isset($_POST['city_val']) && $_POST['city_val'] !=''){
					$city_val											= $_POST['city_val'];
					$this->db->where("ConsultingVenue.city_town	LIKE '%$city_val%'");
				}
				
				if(isset($_POST['status_val']) && $_POST['status_val'] !=''){
					if(trim($_POST['status_val']) == 'active'){
						$this->db->where("ConsultingRoom.status",'active');
					}else if(trim($_POST['status_val']) == 'inactive'){
						$this->db->where("ConsultingRoom.status",'inactive');
					}else if(trim($_POST['status_val']) == 'notassigned'){
						$this->db->where("AssignConsultingRoom.consulting_room_id Is NULL");
					}
				}
				$this->db->where(array('ConsultingRoom.created_by'=>$this->session->userdata('User')['id'],'ConsultingRoom.delete_status'=>0));
				
				$this->db->from('consulting_room as ConsultingRoom');
				$this->db->join('assign_consulting_room as AssignConsultingRoom', 'AssignConsultingRoom.consulting_room_id = ConsultingRoom.id','LEFT');
				$this->db->join('consulting_venues as ConsultingVenue', 'ConsultingVenue.id = ConsultingRoom.consulting_venue_id','LEFT');
				$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id =AssignConsultingRoom.clinician_id','LEFT');
				$this->db->select('ConsultingVenue.consulting_name,ConsultingVenue.id as venue_id,ConsultingVenue.address,ConsultingRoom.id as consulting_id,ConsultingRoom.status,AssignConsultingRoom.id as assign_id,AssignConsultingRoom.delete_status,ConsultingRoom.consulting_room_title,UserPersonalDetail.title,UserPersonalDetail.firstname,UserPersonalDetail.middlename,UserPersonalDetail.lastname');
				$qry																= $this->db->get();
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
							$result['response_data'][$r_val['venue_id']]['venue_key']															 = $r_val['venue_id'];
							$result['response_data'][$r_val['venue_id']]['name']																 = $r_val['consulting_name'].' - '.$r_val['address'];
							$result['response_data'][$r_val['venue_id']]['consulting_id'][$r_val['consulting_id']]['consulting_room_title'] 	 = $r_val['consulting_room_title'];
							if($r_val['delete_status'] != 1){
								if(isset($result['response_data'][$r_val['venue_id']]['consulting_id'][$r_val['consulting_id']]['clinician_name'])){
									$result['response_data'][$r_val['venue_id']]['consulting_id'][$r_val['consulting_id']]['clinician_name']	.= $clinician_name.'<br/>';
								}else{
									$result['response_data'][$r_val['venue_id']]['consulting_id'][$r_val['consulting_id']]['clinician_name']     ='';
									$result['response_data'][$r_val['venue_id']]['consulting_id'][$r_val['consulting_id']]['clinician_name']	.= $clinician_name.'<br/>';
								}
							}
							$result['response_data'][$r_val['venue_id']]['consulting_id'][$r_val['consulting_id']]['consulting_id'] 			 = $r_val['consulting_id'];
						//	$result['response_data'][$r_val['venue_id']]['consulting_id'][$r_val['consulting_id']]['assign_id'][$i]				= $r_val['assign_id'];
							$result['response_data'][$r_val['venue_id']]['consulting_id'][$r_val['consulting_id']]['status']					 = $r_val['status'];
							$i++;
						}
					}else{
						$result['response']											= 'empty';
					}
				}else{
					$result['response']												= 'failed';
				}
			}else{
				$result['response']													= 'empty';
			}
			echo json_encode($result);
		}
		
		function search_clinician(){
			$response																= array();
			if($_POST && !empty($_POST)){
				$search_result														= $this->consulting_location_model->clinician_list($_POST['text']);
				if(!empty($search_result)){
					$response['response']											= 'success';
					$response['response_data']										= $search_result;
				}else{
					$response['response']											= 'empty';
				}
			}else{
				$response['response']												= 'failed';
			}
			echo json_encode($response);
		}
		
		function remove_room(){
			$response														= array();
			if($_POST && !empty($_POST)){
				$del														= array('delete_status'=>1,'modified_by'=>$this->session->userdata('User')['id'],'modified_date'=>date('Y-m-d H:i:s'));
				$this->db->where(array('consulting_venue_id'=>trim($_POST['a']),'consulting_room_id'=>trim($_POST['b'])));
				$qry														= $this->db->get('assign_consulting_room')->row_array();
				if($qry){
					$this->db->where(array('consulting_venue_id'=>trim($_POST['a']),'consulting_room_id'=>trim($_POST['b'])));
					$this->db->update('assign_consulting_room',$del);
				}
				$this->db->where(array('consulting_venue_id'=>trim($_POST['a']),'id'=>trim($_POST['b'])));
				$qry														= $this->db->update('consulting_room',$del);
				if($qry){
					$response['response']									= 'success'; 
				}else{
					$response['response']									= 'failed';
				}
			}else{
				$response['response']										= 'failed';
			}
			echo json_encode($response);
		}
		
		function edit_room(){
			$response														= array();
			if($_POST && !empty($_POST)){
				$this->db->where(array('consulting_venue_id'=>trim($_POST['a']),'consulting_room_id'=>trim($_POST['b'])));
				$del														= array('delete_status'=>1,'modified_by'=>$this->session->userdata('User')['id'],'modified_date'=>date('Y-m-d H:i:s'));														
				$qry														= $this->db->update('assign_consulting_room',$del);
			 	if(isset($_POST['clinician']) && !empty($_POST['clinician'])){
					foreach($_POST['clinician'] as $key => $val){
						$this->db->where(array('consulting_venue_id'=>trim($_POST['a']),'consulting_room_id'=>trim($_POST['b']),'clinician_id'=>$val));
						$qry												= $this->db->get('assign_consulting_room')->row_array();
						if(!$qry){
							$save_details									= array();
							$save_details['consulting_venue_id']			= trim($_POST['a']);
							$save_details['consulting_room_id']				= trim($_POST['b']);
							$save_details['clinician_id']					= trim($val);
							$save_details['status']							= trim($_POST['status']);
							$save_details['created_by']						= $this->session->userdata('User')['id'];
							$save_details['modified_by']					= $this->session->userdata('User')['id'];
							$save_details['created_date']					= date('Y-m-d H:i:s');
							$save_details['modified_date']					= date('Y-m-d H:i:s');
							$qry_room										= $this->db->insert('assign_consulting_room', $save_details);
						}else{
							$this->db->where(array('consulting_venue_id'=>trim($_POST['a']),'consulting_room_id'=>trim($_POST['b']),'clinician_id'=>$val));
							$change_stat									= array('delete_status'=>0,'modified_by'=>$this->session->userdata('User')['id'],'modified_date'=>date('Y-m-d H:i:s'));														
							$qry											= $this->db->update('assign_consulting_room',$change_stat);
			 			} 
					}
				}
				$change_text												= array('consulting_room_title'=>trim($_POST['title']),'status'=>trim($_POST['status']),'modified_by'=>$this->session->userdata('User')['id'],'modified_date'=>date('Y-m-d H:i:s'));
				$this->db->where(array('consulting_venue_id'=>trim($_POST['a']),'id'=>trim($_POST['b'])));
				$qry														= $this->db->update('consulting_room',$change_text);
				if($qry){
					$response['response']									= 'success';
					$response['status']										= trim($_POST['status']);
				}else{
					$response['response']									= 'failed';
				}
			}else{
				$response['response']										= 'failed';
			}
			echo json_encode($response);
		}
	
	}
?>
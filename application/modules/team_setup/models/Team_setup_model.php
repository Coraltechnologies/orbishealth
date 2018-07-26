<?php
	class Team_setup_model extends CI_Model {
	
		function __construct(){  
			parent::__construct();  
		}
		
		function insert_details($data = null,$personal = null,$address = null,$access_type = null,$user_role = null,$prof_details = null,$prof_register_details = null,$ico_reg = null,$idemnity_reg = null){
			if($data){
				$this->db->from('user_personal_details');
				$this->db->where('primary_email',$personal['primary_email']);
				$query 													= $this->db->get();
				$this->db->from('medical_practice_details');
				$this->db->where('primary_email',$personal['primary_email']);
				$m_query 												= $this->db->get();
				$val													= array();
				if($query->num_rows() > 0 || $m_query->num_rows() > 0){
					$val['response']									= 'exist';
					return $val;
				}else{
					$ins_user											= $this->db->insert('users',$data);
					$personal['user_id']								= $this->db->insert_id();
					$personal['created_by']								= $this->session->userdata('User')['id'];
					$personal['modified_by']							= $this->session->userdata('User')['id'];
					$personal['created_date']							= date('Y-m-d H:i:s');
					$personal['modified_date']							= date('Y-m-d H:i:s');
					if($ins_user){
						$access_arr										= array();
						$access_arr['user_id']							= $personal['user_id'];
						$access_arr['access_type_id']					= $access_type;
						$access_arr['created_by']						= $this->session->userdata('User')['id'];
						$access_arr['modified_by']						= $this->session->userdata('User')['id'];
						$access_arr['created_date']						= date('Y-m-d H:i:s');
						$access_arr['modified_date']					= date('Y-m-d H:i:s');
						$access_qry										= $this->db->insert('user_access_types',$access_arr);
						
						$role											= explode(',',$user_role);
						foreach($role as $key => $val_r){
							if($val_r != ''){
								$role_arr									= array();
								$role_arr['user_id']						= $personal['user_id'];
								$role_arr['role_id']						= $val_r;
								$role_arr['created_by']						= $this->session->userdata('User')['id'];
								$role_arr['modified_by']					= $this->session->userdata('User')['id'];
								$role_arr['created_date']					= date('Y-m-d H:i:s');
								$role_arr['modified_date']					= date('Y-m-d H:i:s');
								$role_qry									= $this->db->insert('user_roles',$role_arr);
							}
						}
						
						$ins											= $this->db->insert('user_personal_details',$personal);
						$address['user_id']								= $personal['user_id'];
						$address['created_by']							= $this->session->userdata('User')['id'];
						$address['modified_by']							= $this->session->userdata('User')['id'];
						$address['created_date']						= date('Y-m-d H:i:s');
						$address['modified_date']						= date('Y-m-d H:i:s');
						$ins_prof										= $this->db->insert('user_address_details',$address);
						
						if($prof_details){
							$prof_details['user_id']					= $personal['user_id'];
							$prof_details['created_by']					= $this->session->userdata('User')['id'];
							$prof_details['modified_by']				= $this->session->userdata('User')['id'];
							$prof_details['created_date']				= date('Y-m-d H:i:s');
							$prof_details['modified_date']				= date('Y-m-d H:i:s');
							$prof_qry									= $this->db->insert('user_professional_details',$prof_details);
						}
						
						if($prof_register_details){
							$prof_register_details['user_id']			= $personal['user_id'];
							$prof_register_details['created_by']		= $this->session->userdata('User')['id'];
							$prof_register_details['modified_by']		= $this->session->userdata('User')['id'];
							$prof_register_details['created_date']		= date('Y-m-d H:i:s');
							$prof_register_details['modified_date']		= date('Y-m-d H:i:s');
							$prof_register_qry							= $this->db->insert('user_professional_register_detail',$prof_register_details);
						}
						
						if($ico_reg){
							$ico_reg['user_id']							= $personal['user_id'];
							$ico_reg['created_by']						= $this->session->userdata('User')['id'];
							$ico_reg['modified_by']						= $this->session->userdata('User')['id'];
							$ico_reg['created_date']					= date('Y-m-d H:i:s');
							$ico_reg['modified_date']					= date('Y-m-d H:i:s');
							$ico_qry									= $this->db->insert('other_bodies_register_details',$ico_reg);
						}
						
						if($idemnity_reg){
							$idemnity_reg['user_id']					= $personal['user_id'];
							$idemnity_reg['created_by']					= $this->session->userdata('User')['id'];
							$idemnity_reg['modified_by']				= $this->session->userdata('User')['id'];
							$idemnity_reg['created_date']				= date('Y-m-d H:i:s');
							$idemnity_reg['modified_date']				= date('Y-m-d H:i:s');
							$idemnity_qry								= $this->db->insert('other_bodies_register_details',$idemnity_reg);
						}
					}
					if($ins){
						$val['response']								= 1;
						$val['user_id']									= $personal['user_id'];
						return $val;
					}else{
						$val['response']								= 0;
						return $val;
					}
				}
			}
		}
		
		function update_details($user_id= null,$personal = null,$address = null,$access_type = null,$user_role = null,$prof_details = null,$prof_register_details = null,$ico_reg = null,$idemnity_reg = null){
			$val													= array();
			if($user_id){
				if($personal && !empty($personal)){
				 	$personal['modified_by']						= $this->session->userdata('User')['id'];
					$personal['modified_date']						= date('Y-m-d H:i:s');
					$update_condition								= array('user_id'=>$user_id);
					$this->db->where($update_condition);
					$this->db->update('user_personal_details', $personal);
				}
				if($address && !empty($address)){
					$address['modified_by']							= $this->session->userdata('User')['id'];
					$address['modified_date']						= date('Y-m-d H:i:s');
					$update_condition								= array('user_id'=>$user_id);
					$this->db->where($update_condition);
					$this->db->update('user_address_details', $address);
				}
				if($access_type && $access_type !=''){
					$access_arr										= array();
					$access_arr['access_type_id']					= $access_type;
					$access_arr['modified_by']						= $this->session->userdata('User')['id'];
					$access_arr['modified_date']					= date('Y-m-d H:i:s');
					$update_condition								= array('user_id'=>$user_id);
					$this->db->where($update_condition);
					$this->db->update('user_access_types', $access_arr);
				}
				if($user_role && $user_role !=''){ 
					$this->db->where('user_id',$user_id);
					$this->db->delete('user_roles');
					$role											= explode(',',$user_role);
					foreach($role as $key => $val_r){
						if($val_r != ''){
							$role_arr								= array();
							$role_arr['user_id']					= $user_id;
							$role_arr['role_id']					= $val_r;
							$role_arr['created_by']					= $this->session->userdata('User')['id'];
							$role_arr['modified_by']				= $this->session->userdata('User')['id'];
							$role_arr['created_date']				= date('Y-m-d H:i:s');
							$role_arr['modified_date']				= date('Y-m-d H:i:s');
							$role_qry								= $this->db->insert('user_roles',$role_arr);
						}
					}
				}
				if($prof_details){
					$prof_details['modified_by']					= $this->session->userdata('User')['id'];
					$prof_details['modified_date']					= date('Y-m-d H:i:s');
					$update_condition								= array('user_id'=>$user_id);
					$this->db->where($update_condition);
					$this->db->update('user_professional_details', $prof_details);
				}
				if($prof_register_details){
					$prof_register_details['modified_by']			= $this->session->userdata('User')['id'];
					$prof_register_details['modified_date']			= date('Y-m-d H:i:s');
					$update_condition								= array('user_id'=>$user_id);
					$this->db->where($update_condition);
					$this->db->update('user_professional_register_detail', $prof_register_details);
					 
				}
				if($ico_reg){
					$ico_reg['modified_by']						= $this->session->userdata('User')['id'];
					$ico_reg['modified_date']					= date('Y-m-d H:i:s');
					$update_condition							= array('user_id'=>$user_id,'other_bodies_id'=>$this->config->item('ico'));
					$this->db->where($update_condition);
					$this->db->update('other_bodies_register_details', $ico_reg);
				}
				if($idemnity_reg){
					$idemnity_reg['modified_by']				= $this->session->userdata('User')['id'];
					$idemnity_reg['modified_date']				= date('Y-m-d H:i:s');
					$update_condition							= array('user_id'=>$user_id,'other_bodies_id'=>$this->config->item('indemnity'));
					$this->db->where($update_condition);
					$this->db->update('other_bodies_register_details', $idemnity_reg);
				}
				
				$val['response']								= 1;
				$val['user_id']									= $user_id;
			}else{
				$val['response']								= 0;
			}
			return $val;
		}
		
		function professional_details($user_id =null, $cond	= null){
			$condition										= array();
			if(isset($cond['status']) && $cond['status'] != 'All'){
				$this->db->where('User.status',$cond['status']); 
			}
			if(isset($cond['role']) && $cond['role']){
				$this->db->where('UserRole.role_id',$cond['role']); 
			}
			if(isset($cond['name']) && $cond['name']){
				$where = '((UserPersonalDetail.firstname LIKE "%'.$cond['name'].'%") OR (UserPersonalDetail.lastname LIKE "%'.$cond['name'].'%"))';
				$this->db->where($where); 
			}
			$this->db->group_by('User.id'); 
			$this->db->where('User.created_by',$user_id);
			$this->db->where('User.user_type',$this->config->item('professional'));
			$this->db->where("User.id !=",$this->session->userdata('User')['id']);
			$this->db->from('users as User');
			$this->db->join('user_personal_details as UserPersonalDetail', 'UserPersonalDetail.user_id = User.id','LEFT');
			$this->db->join('user_professional_details as UserProfessionalDetail', 'UserProfessionalDetail.user_id = User.id','LEFT');
			$this->db->join('user_address_details as UserAddressDetail', 'UserAddressDetail.user_id = User.id','LEFT');
			$this->db->join('user_professional_register_detail as UserProfessionalRgisterDetail', 'UserProfessionalRgisterDetail.user_id = User.id','LEFT');
			$this->db->join('user_roles as UserRole', 'UserRole.user_id = User.id','LEFT');
			$this->db->select('User.id as primary_id,User.status,UserPersonalDetail.*,UserAddressDetail.*,UserProfessionalDetail.*,UserProfessionalRgisterDetail.register_number,UserProfessionalRgisterDetail.expiry_date');
			
			$query 											= $this->db->get();
			$list											= array();
			if($query->num_rows() > 0){
				$list										= $query->result();
			}
			return $list;
		}
		
		
	}
?>
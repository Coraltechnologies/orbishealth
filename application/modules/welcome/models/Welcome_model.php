<?php
class Welcome_model extends CI_Model {

	function __construct(){  
		parent::__construct();  
	}
	
	function get_details(){

		$this->db->from('welcome');
		$this->db->order_by('w_id', 'DESC');
		$query = $this->db->get();
		/*echo "<pre><br>";
		print_r($this->db);
		exit;*/
		if($query->num_rows() > 0) {
			
			return $query->result_array();
		}
		else {
			return false;
		}
	}
	
	function login($uname = '', $upass = ''){
		
		$this->db->select('*');
		$this->db->from('welcome');
		$this->db->where('w_login',$uname);
		$this->db->where('w_password',$upass);
		$query = $this->db->get();
		/*echo "<pre><br>";
		print_r($this->db);
		exit;*/
		if($query->num_rows() > 0) {
			
			$result = $query->row_array();
			$this->session->set_userdata('user_session', $result['w_id']);
			
			redirect('welcome/index');
			return $result;
		} else {
			$output = 'Error';
			return $output;
		}
	
	}
	
}
?>
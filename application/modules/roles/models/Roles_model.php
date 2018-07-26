<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles_model extends CI_Model {

	function __construct(){  
		parent::__construct();  
	}
    
    function all_user_types(){		
        $this->db->from('roles');
        $this->db->select('*');
		$this->db->where('is_clinical IS NULL');
        $this->db->order_by('id', 'ASC');
        $query		= $this->db->get();
        if($query->num_rows()>0){
            $result = $query->result_array();
        }
        return $result;
	}
	
	function all_roles(){		
        $this->db->from('roles');
        $this->db->select('*');
		$this->db->where('is_clinical IS NOT NULL');
        $this->db->order_by('id', 'ASC');
        $query		= $this->db->get();
        if($query->num_rows()>0){
            $result = $query->result_array();
        }
        return $result;
	}  
}
?>
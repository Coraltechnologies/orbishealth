<?php
class Api_model extends CI_Model {

	function __construct(){  
		parent::__construct();  
	}
    
    function sync_master_tables(){		
        $this->db->from('sync_master_tables as smt');
        $this->db->select('smt.*');
        $this->db->order_by('smt.id', 'ASC');
        $query		= $this->db->get();
        if($query->num_rows()>0){
            $result = $query->result_array();
        }
        return $result;
	}
	
	function all_languages(){		
        $this->db->from('languages');
        $this->db->select('*');
		$this->db->where('status', '1');
        $this->db->order_by('id', 'ASC');
        $query		= $this->db->get();
        if($query->num_rows()>0){
            $result = $query->result_array();
        }
        return $result;
	}   
}
?>
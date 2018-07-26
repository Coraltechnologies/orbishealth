<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Countries_model extends CI_Model {

	function __construct(){  
		parent::__construct();  
	}
    
    function all_countries(){		
        $this->db->from('countries');
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
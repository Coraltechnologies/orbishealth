<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model('api_model');        
        $this->load->model('countries/countries_model');        
        $this->load->model('roles/roles_model');
    }
    
    function sync_master_data(){
        $result = array();
        /*if($_POST && !empty($_POST)){
            
            echo '<pre><br>';
            print_r($_POST);
            
            $result = $this->api_model->sync_master_tables();
            
        } else {*/
            $result    = $this->api_model->sync_master_tables();        
        //}
        
        echo json_encode($result);
        exit;
    }
    
    function all_master_data(){
        
        $result_country = $this->countries_model->all_countries();
            
        $result_roles   = $this->roles_model->all_roles();
        
        $result         = array('countries' => $result_country, 'roles' => $result_roles);
        
        echo json_encode($result);
        exit;
    }
    
    function all_active_countries(){
        $result = $this->countries_model->all_countries();
        echo json_encode($result);
        exit;
    }
    
    function all_user_types(){
        $result = $this->roles_model->all_user_types();
        echo json_encode($result);
        exit;
    }
    
    function all_roles(){
        $result = $this->roles_model->all_roles();
        echo json_encode($result);
        exit;
    }
    
    function all_languages(){
        $result = $this->api_model->all_languages();
        echo json_encode($result);
        exit;
    }
   
}
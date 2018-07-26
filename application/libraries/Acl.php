<?php

if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class Acl
{
    protected $CI;

    protected $userId = NULL;

    protected $userRoleId = NULL;
	
	protected $userTypeId = NULL;

    protected $guestPages = [
        'login/index'
    ];

    protected $_config = [
        'acl_table_users' => 'users',
        'acl_users_fields' => [
            'id' => 'id',
			'user_type' => 'user_type'
        ],
        'acl_table_user_roles' => 'user_roles',
		'acl_user_roles_fields' => array(
			'id' => 'id',
			'user_id' => 'user_id',
			'role_id' => 'role_id'
		),
        'acl_table_menus' => 'menus',
        'acl_menu_fields' => [
            'id' => 'id',
            'menu_name' => 'menu_name',            
            'controller' => 'controller',
            'is_parent' => 'is_parent',
            'order' => 'order'
        ],
        'acl_table_menu_urls' => 'menu_urls',
        'acl_menu_urls_fields' => [
            'id' => 'id',
            'menu_id' => 'menu_id',
            'action' => 'action'
        ],
        'acl_table_menu_permissions' => 'menu_permissions',
        'acl_menu_permissions_fields' => [
            'id' => 'id',
            'role_id' => 'role_id',
            'menu_url_id' => 'menu_url_id'
        ],
        'acl_table_user_menu_permissions' => 'user_menu_permissions',
        'acl_user_menu_permissions_fields' => [
            'id' => 'id',
            'user_id' => 'user_id',
            'menu_url_id' => 'menu_url_id',
            'status' => 'status'
        ],
        'acl_user_session_key' => 'User'
    ];

    /**
     * Constructor
     *
     * @param array $config            
     */
    public function __construct($config = array())
    {
        $this->CI = &get_instance();
        
        // Load Session library
        $this->CI->load->library('session');
        
        // Load ACL model
        $this->CI->load->model('acl_model');
    }

    public function getAclConfig($key = NULL)
    {
        if ($key) {
            return $this->_config[$key];
        }
        
        return $this->_config;
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Check is controller/method has access for role
     *
     * @access public
     * 
     * @return bool
     */
    public function hasAccess()
    {
        if ($this->getUserId()) {
            
            $permissions     = $this->CI->acl_model->getUserPermissions($this->getUserId());
            
            if(count($permissions) == 0){            
                $permissions = $this->CI->acl_model->getRolePermissions($this->getUserRoleId());
            }            
            
            if (count($permissions) > 0) {
                $currentPermission = $this->CI->uri->rsegment(1) . '/' . $this->CI->uri->rsegment(2);
                if (in_array($currentPermission, $permissions)) {
                    return TRUE;
                }
            }
        }
        
        return FALSE;
    }
    
     /**
     * Check is controller/method has access for role
     *
     * @access public
     * 
     * @return array
     */
    public function hasMenuAccess()
    {
        $menus = array();
        if ($this->getUserId()) {
            
            $menus     = $this->CI->acl_model->getUserMenu($this->getUserId());
            
            if(count($menus) == 0){            
                $menus = $this->CI->acl_model->getRoleMenu($this->getUserRoleId());
            }            
            
        }
        
        return $menus;
    }
	
	
	/**
     * Check is controller/method has access for role
     *
     * @access public
     * 
     * @return array
     */
    public function hasUserRole()
    {
        $user_role = array();
        if ($this->getUserId()) {          
            
            $user_role_data = $this->getUserRoleId();
			
			if(count($user_role_data) > 0){
				$user_role = $user_role_data;
			}
            
        }
        
        return $user_role;
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Return the value of user id from the session.
     * Returns 0 if not logged in
     *
     * @access private
     * @return int
     */
    private function getUserId()
    {
        if ($this->userId == NULL) {
            $user           = $this->CI->session->userdata($this->_config['acl_user_session_key']);
            
            $user           = $user['id']; //Added by mskt ( 12-Jul-2018 )
            
            $this->userId   = $user; //Added by mskt ( 12-Jul-2018 )
            
            if ($this->userId === FALSE) {
                $this->userId = NULL;
            }
        }
        
        return $this->userId;
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Return user role
     *
     * @return int
     */
    private function getUserRoleId()
    {
        if ($this->userRoleId == NULL) {
            // Set the role
            $this->userRoleId = $this->CI->acl_model->getUserRoleId($this->getUserId());            
            
            if (! $this->userRoleId) {
                $this->userRoleId = 0;
            }
        }
        
        return $this->userRoleId;
    }
    
    public function getGuestPages()
    {
        return $this->guestPages;
    }
	
	/**
     * Check is controller/method has access for role
     *
     * @access public
     * 
     * @return array
     */
    public function hasUserType()
    {
        $user_type = '';
        if ($this->getUserId()) {          
            
            $user_type_data = $this->getUserTypeId();
			
			if(count($user_type_data) > 0){
				$user_type = $user_type_data;
			}
            
        }
        
        return $user_type;
    }
	
	/**
	 * Return usertype
	 * @return int
	 * */
	private function getUserTypeId()
    {
        if ($this->userTypeId == NULL) {
            // Set the user type
            $this->userTypeId = $this->CI->acl_model->getUserType($this->getUserId());            
            
            if (! $this->userTypeId) {
                $this->userTypeId = 0;
            }
        }
        
        return $this->userTypeId;
    }
}
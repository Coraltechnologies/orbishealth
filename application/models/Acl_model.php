<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acl_model extends CI_Model {

	// --------------------------------------------------------------------

	/**
	 * Get current user by session info
	 * @param   int $userId
	 * @return  array
	 */
	public function getUserRoleId($userId = 0)
	{
		//Added by mskt ( 13-Jul-2018 )
	    /*$query = $this->db->select("u.{$this->acl->getAclConfig('acl_users_fields')['role_id']} as role_id")
			->from($this->acl->getAclConfig('acl_table_users').' u')
			->where("u.{$this->acl->getAclConfig('acl_users_fields')['id']}", $userId)
			->get();*/
		
		$query = $this->db->select("u.{$this->acl->getAclConfig('acl_users_fields')['id']} as user_id, ur.{$this->acl->getAclConfig('acl_user_roles_fields')['role_id']} as role_id")
			->from($this->acl->getAclConfig('acl_table_users').' u')
			->join($this->acl->getAclConfig('acl_table_user_roles').' ur', "u.{$this->acl->getAclConfig('acl_users_fields')['id']} = ur.{$this->acl->getAclConfig('acl_user_roles_fields')['user_id']}")
			->where("u.{$this->acl->getAclConfig('acl_users_fields')['id']}", $userId)
			->get();
		
        
		// User was found
		if ($query->num_rows() > 0)
		{
			//Added by mskt ( 13-Jul-2018 )
			/*$row = $query->row_array();			
		    	
			return $row['role_id'];*/
			
			$row = $query->result_array();
			
			$roles	= array();
			if(count($row) > 0) {
				foreach ($row as $key => $val) {					
					$roles[] = strtolower($val['role_id']);
				}
			}
			
			return $roles;
		}

		// No role
		return 0;
	}

	// --------------------------------------------------------------------

	/**
	 * Get permissions from database for  particular role
	 *
	 * @param   array $roleId
	 * @return  array
	 */
	public function getRolePermissions($roleId = 0)
	{
		//Added by mskt ( 13-Jul-2018 )
	    /*$query = $this->db->select([
    	        "p.{$this->acl->getAclConfig('acl_permissions_fields')['action']} as action",
    	        "r.{$this->acl->getAclConfig('acl_resources_fields')['controller']} as controller"
            ])
			->from($this->acl->getAclConfig('acl_table_permissions').' p')
			->join($this->acl->getAclConfig('acl_table_resources').' r', "p.{$this->acl->getAclConfig('acl_permissions_fields')['resource_id']} = r.{$this->acl->getAclConfig('acl_resources_fields')['id']}")
			->join($this->acl->getAclConfig('acl_table_role_permissions').' rp', "rp.{$this->acl->getAclConfig('acl_role_permissions_fields')['permission_id']} = p.{$this->acl->getAclConfig('acl_permissions_fields')['id']}")
			->where("rp.{$this->acl->getAclConfig('acl_role_permissions_fields')['role_id']}", $roleId)
			->get();*/
		
		$query = $this->db->select([
    	        "mu.{$this->acl->getAclConfig('acl_menu_urls_fields')['action']} as action",
    	        "m.{$this->acl->getAclConfig('acl_menu_fields')['controller']} as controller"
            ])
			->from($this->acl->getAclConfig('acl_table_menu_urls').' mu')
			->join($this->acl->getAclConfig('acl_table_menus').' m', "mu.{$this->acl->getAclConfig('acl_menu_urls_fields')['menu_id']} = m.{$this->acl->getAclConfig('acl_menu_fields')['id']}")
			->join($this->acl->getAclConfig('acl_table_menu_permissions').' mp', "mp.{$this->acl->getAclConfig('acl_menu_permissions_fields')['menu_url_id']} = mu.{$this->acl->getAclConfig('acl_menu_urls_fields')['id']}")
			->where_in("mp.{$this->acl->getAclConfig('acl_menu_permissions_fields')['role_id']}", $roleId)
			->group_by("m.{$this->acl->getAclConfig('acl_menu_fields')['id']}")
			->get();

		$permissions = array();
		
		// Add to the list of permissions
		foreach ($query->result_array() as $row)
		{		    
			$permissions[] = strtolower($row['controller'] . '/' . $row['action']);
		}		

		return $permissions;
	}
	
	/**
	 * Added by mskt ( 13-Jul-2018 )
	 * Get permissions from database for  particular role
	 *
	 * @param   int $userId
	 * @return  array
	 */
	public function getUserPermissions($userId = 0)
	{		
		$query = $this->db->select([
    	        "mu.{$this->acl->getAclConfig('acl_menu_urls_fields')['action']} as action",
    	        "m.{$this->acl->getAclConfig('acl_menu_fields')['controller']} as controller"
            ])
			->from($this->acl->getAclConfig('acl_table_menu_urls').' mu')
			->join($this->acl->getAclConfig('acl_table_menus').' m', "mu.{$this->acl->getAclConfig('acl_menu_urls_fields')['menu_id']} = m.{$this->acl->getAclConfig('acl_menu_fields')['id']}")
			->join($this->acl->getAclConfig('acl_table_user_menu_permissions').' ump', "ump.{$this->acl->getAclConfig('acl_user_menu_permissions_fields')['menu_url_id']} = mu.{$this->acl->getAclConfig('acl_menu_urls_fields')['id']}")
			->where("ump.{$this->acl->getAclConfig('acl_user_menu_permissions_fields')['user_id']}", $userId)
			->where("ump.{$this->acl->getAclConfig('acl_user_menu_permissions_fields')['status']}", 'active')
			->group_by("m.{$this->acl->getAclConfig('acl_menu_fields')['id']}")
			->get();

		$permissions = array();
		
		// Add to the list of permissions
		foreach ($query->result_array() as $row)
		{		    
			$permissions[] = strtolower($row['controller'] . '/' . $row['action']);
		}		

		return $permissions;
	}
	
	/**
	 * Get permissions from database for  particular role
	 *
	 * @param   array $roleId
	 * @return  array
	 */
	public function getRoleMenu($roleId = 0)
	{	
		$query = $this->db->select([
    	        "m.{$this->acl->getAclConfig('acl_menu_fields')['id']} as id",
    	        "m.{$this->acl->getAclConfig('acl_menu_fields')['menu_name']} as menu_name",
				"m.{$this->acl->getAclConfig('acl_menu_fields')['controller']} as controller",		
				"mu.{$this->acl->getAclConfig('acl_menu_urls_fields')['action']} as action",
				"m.{$this->acl->getAclConfig('acl_menu_fields')['is_parent']} as is_parent",
				"m.{$this->acl->getAclConfig('acl_menu_fields')['order']} as order"
            ])
			->from($this->acl->getAclConfig('acl_table_menu_urls').' mu')
			->join($this->acl->getAclConfig('acl_table_menus').' m', "mu.{$this->acl->getAclConfig('acl_menu_urls_fields')['menu_id']} = m.{$this->acl->getAclConfig('acl_menu_fields')['id']}")
			->join($this->acl->getAclConfig('acl_table_menu_permissions').' mp', "mp.{$this->acl->getAclConfig('acl_menu_permissions_fields')['menu_url_id']} = mu.{$this->acl->getAclConfig('acl_menu_urls_fields')['id']}")
			->where_in("mp.{$this->acl->getAclConfig('acl_menu_permissions_fields')['role_id']}", $roleId)
			->group_by("m.{$this->acl->getAclConfig('acl_menu_fields')['id']}")
			->get();

		$role_menu = array();
		
		if($query->num_rows() > 0) {
			$role_menu = $query->result_array();
		}

		return $role_menu;
	}
	
	/**
	 * Added by mskt ( 13-Jul-2018 )
	 * Get permissions from database for  particular role
	 *
	 * @param   int $userId
	 * @return  array
	 */
	public function getUserMenu($userId = 0)
	{		
		$query = $this->db->select([
				"m.{$this->acl->getAclConfig('acl_menu_fields')['id']} as id",
    	        "m.{$this->acl->getAclConfig('acl_menu_fields')['menu_name']} as menu_name",
				"m.{$this->acl->getAclConfig('acl_menu_fields')['controller']} as controller",		
				"mu.{$this->acl->getAclConfig('acl_menu_urls_fields')['action']} as action",
				"m.{$this->acl->getAclConfig('acl_menu_fields')['is_parent']} as is_parent",
				"m.{$this->acl->getAclConfig('acl_menu_fields')['order']} as order"
            ])
			->from($this->acl->getAclConfig('acl_table_menu_urls').' mu')
			->join($this->acl->getAclConfig('acl_table_menus').' m', "mu.{$this->acl->getAclConfig('acl_menu_urls_fields')['menu_id']} = m.{$this->acl->getAclConfig('acl_menu_fields')['id']}")
			->join($this->acl->getAclConfig('acl_table_user_menu_permissions').' ump', "ump.{$this->acl->getAclConfig('acl_user_menu_permissions_fields')['menu_url_id']} = mu.{$this->acl->getAclConfig('acl_menu_urls_fields')['id']}")
			->where("ump.{$this->acl->getAclConfig('acl_user_menu_permissions_fields')['user_id']}", $userId)
			->where("ump.{$this->acl->getAclConfig('acl_user_menu_permissions_fields')['status']}", 'active')
			->group_by("m.{$this->acl->getAclConfig('acl_menu_fields')['id']}")
			->get();

		$user_menu 		= array();
		
		if($query->num_rows() > 0) {
			$user_menu = $query->result_array();
		}

		return $user_menu;
	}
	
	/**
	 * Added by mskt ( 13-Jul-2018 )
	 * Get permissions from database for  particular role
	 *
	 * @param   int $userId
	 * @return  array
	 */
	public function getUserType($userId = 0){
		$query = $this->db->select("u.{$this->acl->getAclConfig('acl_users_fields')['id']} as user_id, ur.{$this->acl->getAclConfig('acl_user_roles_fields')['id']} as user_type_id")
			->from($this->acl->getAclConfig('acl_table_users').' u')
			->join($this->acl->getAclConfig('acl_table_user_roles').' ur', "u.{$this->acl->getAclConfig('acl_users_fields')['user_type']} = ur.{$this->acl->getAclConfig('acl_user_roles_fields')['id']}")
			->where("u.{$this->acl->getAclConfig('acl_users_fields')['id']}", $userId)
			->get();
		
        $usertype	= 0;
		// User was found
		if ($query->num_rows() > 0)
		{
			//Added by mskt ( 13-Jul-2018 )
			/*$row = $query->row_array();			
		    	
			return $row['role_id'];*/
			
			$row = $query->row_array();
			
			if(count($row) > 0){
				$usertype = $row['user_type_id'];
			}
		}
		return $usertype;
	}
	
}
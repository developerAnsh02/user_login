<?php

Class Department_Model extends CI_Model {

	// Insert registration data in database
	public function department_insert($data) 
	{

		// Query to check whether username already exist or not
		$condition = "department_name =" . "'" . $data['department_name'] . "'";

		$this->db->select('*');
		$this->db->from('departments');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		//print_r($data);exit;
		if ($query->num_rows() == 0) {
		// Query to insert data in database
		$this->db->insert('departments', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		} else { 
		return false;
		}
	}
	public function department_update($data,$id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $id);
		$this->db->update('departments', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}
	public function departmentsList() 
	{
		
		$this->db->select('*');
		$this->db->from('departments');
		$this->db->where('flag','0');
		$this->db->order_by("department_name", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}
	public function getById($id) {
       	$this->db->select('*');
		$this->db->from('departments');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function UserRightMenus($id) {
       	$this->db->select('menu_ids');
		$this->db->from('user_rights');
        $this->db->where('role_id', $id);
        $query = $this->db->get()->result_array();
        //print_r($query[0]['menu_ids']);exit;
        $menu_ids=explode(',', $query[0]['menu_ids']);
        //print_r($menu_ids);exit;
        $menuUrl=[];
        foreach ($menu_ids as $key => $menu_id) {
			//echo $menu_id;
			$this->db->select('url,controller,action');
			$this->db->from('menus');
        	$this->db->where('id',$menu_id);
        	$query1 = $this->db->get()->result_array();
        	//print_r($query1);exit;
        	$menuUrl[]=$query1[0]['url'].'index.php/'.$query1[0]['controller'].'/'.$query1[0]['action'];//echo "<br>";
       		//print_r($menuUrl);
		}
		//exit;

        return $menuUrl;
        
    }

    public function getMenuURL($id) {
       	$this->db->select('menu_ids');
		$this->db->from('user_rights');
        $this->db->where('role_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // ************* show department name by id *****************//
	/*public function fetchcatName($id) {
       	$this->db->select('department_name');
		$this->db->from('departments');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
        //print_r($query);exit;
    }*/



}
?>
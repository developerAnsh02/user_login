<?php

Class Sub_categories_Model extends CI_Model {

	// Insert registration data in database
	public function sub_category_insert($data) 
	{

		// Query to check whether username already exist or not
		$condition = "sub_category_name =" . "'" . $data['sub_category_name'] . "'";

		$this->db->select('*');
		$this->db->from('sub_categories');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		//print_r($data);exit;
		if ($query->num_rows() == 0) {
		// Query to insert data in database
		$this->db->insert('sub_categories', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		} else { 
		return false;
		}
	}
	public function sub_category_update($data,$id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $id);
		$this->db->update('sub_categories', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		else { 
		return false;
		}
	}
	public function sub_categoryList() 
	{
		
		$this->db->select('*');
		$this->db->from('sub_categories');
		$this->db->where('flag','0');
		$this->db->order_by("sub_category_name", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}
	public function getById($id) {
       	$this->db->select('*');
		$this->db->from('sub_categories');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    // ************* show grid name by id *****************//
	/*public function fetchcatName($id) {
       	$this->db->select('grid_name');
		$this->db->from('grids');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
        //print_r($query);exit;
    }*/

	function getCategories() { 
		$result = $this->db->select('id, category_name')->from('categories')->where(['flag'=>'0'])->get()->result_array();         
        return $result; 
    } 
	function getsub_categoryByCategory($category_id) { 
		$result = $this->db->select('id, sub_category')->from('sub_categories')->where(['flag'=>'0','categories_id'=>$category_id])->get()->result_array();         
        return $result; 
    } 

}
?>
<?php

class Employee extends CI_Model
{

	// Insert registration data in database
	public function employee_insert($data)
	{

		// Query to check whether username already exist or not
		$condition = "email =" . "'" . $data['email'] . "'";

		$this->db->select('*');
		$this->db->from('employees');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		//print_r($data);exit;
		if ($query->num_rows() == 0) {
			// Query to insert data in database
			$this->db->insert('employees', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}
	public function employee_update($data, $id)
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $id);
		$this->db->update('employees', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	function getEmployeeCode()
	{
		$count = 0;
		$this->db->select("*");
		$this->db->from('employees');
		$query = $this->db->get();
		$total = $query->num_rows();
		//print_r($query['employee_code']);exit;
		$count = $total + 1;
		return $count;
	}

	public function employeesList()
	{

		$this->db->select('employees.*,roles.role,countries.name as cnty_name,countries.phonecode as cnty_code');
		$this->db->from('employees');
		$this->db->join('roles', 'employees.role_id = roles.id', 'left');
		$this->db->join('countries', 'employees.countrycode = countries.id', 'left');
		$this->db->where('employees.flag', '0');
		$this->db->order_by("employees.id", "desc");
		$query = $this->db->get();
		//print_r($query);exit;
		return $query->result_array();
	}

	public function employeesListnew($limit, $start, $conditions)
	{
		$this->db->select('employees.*,roles.role,countries.name as cnty_name,countries.phonecode as cnty_code');
		$this->db->from('employees');
		$this->db->join('roles', 'employees.role_id = roles.id', 'left');
		$this->db->join('countries', 'employees.countrycode = countries.id', 'left');
		$this->db->where('employees.flag', '0');
		$this->db->order_by("employees.id", "desc");
		if ($conditions['customer_id'] != "0") {
			$this->db->where('employees.id', $conditions['customer_id']);
		}
		if(isset($limit) && !empty($limit)) {
			$this->db->limit($limit, $start);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	public function export_csv()
	{
		$this->db->select('employees.*');
		$this->db->from('employees');
		$this->db->where('employees.flag', '0');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getById($id)
	{
		$this->db->select('employees.*,roles.role,countries.name as cnty_name,countries.phonecode as cnty_code');
		$this->db->from('employees');
		$this->db->join('roles', 'employees.role_id = roles.id', 'left');
		$this->db->join('countries', 'employees.countrycode = countries.id', 'left');
		$this->db->where('employees.id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}
	function getRoles()
	{
		$role_id = $this->session->userdata['logged_in']['role_id'];
		if($role_id == 1)
		{
			$result = $this->db->select('id, role')->from('roles')->where('flag', '0')->get()->result_array();
		}
		else 
		{
			$result = $this->db->select('id, role')->from('roles')->where(['flag'=>'0', 'role' => 'User' ])->get()->result_array();
		}
		$roles = array();
		$roles[''] = 'Select Role';
		if ($role_id == 3) {
			foreach ($result as $r) {
				if ($r['id'] == 2) {
					$roles[$r['id']] = $r['role'];
				} else {
					//$roles[$r['id']] = $r['role']; 
				}
			}
		} else {
			foreach ($result as $r) {
				$roles[$r['id']] = $r['role'];
			}
		}
		return $roles;
	}

	function getBanks()
	{
		$result = $this->db->select('id, name')->from('banks')->where('flag', '0')->get()->result_array();
		$roles = array();
		$roles[''] = 'Select Banks...';
		foreach ($result as $r) {
			$roles[$r['id']] = $r['name'];
		}

		return $roles;
	}



	function getCountries()
	{
		$result = $this->db->select('id, name,phonecode')->from('countries')->get()->result_array();
		//$result= $result->result_array();
		$departments = array();
		$departments[' '] = 'Select Country...';
		foreach ($result as $r) {
			$departments[$r['id']] = $r['name'] . ' ( +' . $r['phonecode'] . ')';
		}

		return $departments;
	}
	function deleteemployee($id)
	{
		//if($this->db->delete('suppliers', "id = ".$id)) return true;
		$data = array('flag' => '1', 'status' => '1');
		$this->db->set('flag', 'flag', false);
		$this->db->where('id', $id);
		if ($this->db->update('employees', $data)) {
			return true;
		}
	}

	public function getEmployee()
	{
		$query = $this->db->get('employees');
		return $query->result();
	}
	public function insert_writer($data) {
        // Insert the data into the employees table
        $this->db->insert('employees', $data);
    }

	public function getWriters()
{
    $this->db->select('id, name, email');
    $this->db->from('employees');
    $this->db->where('role_id', 6);
	$this->db->where('flag',0);
    $query = $this->db->get();
    return $query->result_array();
}

public function is_email_exists($email) {
	$this->db->where('email', $email);
	$query = $this->db->get('employees');
	return $query->num_rows() > 0;
}

public function getsubWritersfortl($tl_id)
{
    $this->db->select('id, name, email');
    $this->db->from('employees');
    $this->db->where('role_id', 7);
    $this->db->where('tl_id', $tl_id);
    $this->db->where('flag', 0);
    $query = $this->db->get();
    return $query->result_array();
}

public function getsubWriters()
{
	$this->db->select('id, name, email');
    $this->db->from('employees');
    $this->db->where('role_id', 7);
    $this->db->where('flag', 0);
    $query = $this->db->get();
    return $query->result_array();
}
}

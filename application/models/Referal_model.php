<?php

class Referal_model extends CI_Model
{
	private $table = 'referfriend';
	private $viewtable = 'referfriend_view';
	private $card_detailTable = 'customer_card_details';
	private $status;

	public function __construct()
	{
		parent::__construct();
		$this->status = 1;
		$this->login_id = $this->session->userdata['logged_in']['id'];
		$this->role_id = $this->session->userdata['logged_in']['role_id'];
		$this->email = $this->session->userdata['logged_in']['email'];
	}

	function checkemail($email)
	{
		$this->db->select('referfriend.*');
		$this->db->where('referfriend.friendemail', $email);
		$query =  $this->db->get('referfriend')->result_array();
		return count($query);
	}

	function checkmobile($mobile)
	{

		$this->db->select('referfriend.*');
		$this->db->where('referfriend.phone', $mobile);
		$query =  $this->db->get('referfriend')->result_array();
		return count($query);
	}

	function referal_insert()
	{
		if ($this->input->post('name')) :
			foreach ($this->input->post('name') as $key => $value) :
				$this->db->set('uemail', $this->input->post('refer_by_email')[$key]);
				$this->db->set('friendname', $value);
				$this->db->set('friendemail', $this->input->post('email')[$key]);
				$this->db->set('phone', $this->input->post('mobile_no')[$key]);
				$this->db->set('countrycode', $this->input->post('countrycode')[$key]);
				$this->db->insert($this->table);
			endforeach;
		endif;
	}

	function fetchOrderDetails($id)
	{
		$count = 0;
		$this->db->select('uid');
		$this->db->from('orders');
		$this->db->where('id', $id);
		$query = $this->db->get()->row_array();
		return $query;
	}

	function CustomerCardDetails($id)
	{
		$this->db->where('customer_id', $id);
		$this->db->delete($this->card_detailTable);
		if ($this->input->post('name_on_card')) :
			foreach ($this->input->post('name_on_card') as $key => $value) :

				$this->db->set('customer_id', $id);
				$this->db->set('name_on_card', $value);
				$this->db->set('card_memorial_name', $this->input->post('card_memorial_name')[$key]);
				$this->db->set('type_of_card', $this->input->post('type_of_card')[$key]);
				$this->db->set('card_number', $this->input->post('card_number')[$key]);
				$this->db->set('expiry', $this->input->post('expiry')[$key]);
				$this->db->set('cvv_code', $this->input->post('cvv_code')[$key]);
				$this->db->insert($this->card_detailTable);

			endforeach;
		endif;
	}

	public function export_csv()
	{
		$this->db->select('orders.*,employees.name as c_name,employees.email as c_email,employees.countrycode as countrycode,employees.mobile_no as c_mobile');
		$this->db->from('orders');
		$this->db->join('employees', 'orders.uid = employees.id', 'left');
		if ($this->role_id == '3') {
			$this->db->where('orders.uid', $this->login_id);
		}
		$this->db->order_by("orders.id", "asc");

		$query =  $this->db->get()->result_array();
		foreach ($query as $i => $po_data) {
			$this->db->select('files_db.*');
			$this->db->where('files_db.detail_id', $po_data['id']);
			$images_query = $this->db->get('files_db')->result_array();
			$query[$i]['order_file_details'] = $images_query;
		}

		return $query;
	}

	public function mywallet()
	{
		$this->db->select('employees.*');
		$this->db->where('employees.id', $this->login_id);
		$query =  $this->db->get('employees')->result_array();
		return $query;
	}

	public function myreferals()
	{
		$this->db->select('*');
		$this->db->from($this->viewtable);
		if ($this->role_id == '2') {
			$this->db->where('referfriend_view.uemail', $this->email);
		}
		$this->db->order_by("referfriend_view.id", "asc");
		$query =  $this->db->get()->result_array();
		return $query;
	}

	public function order_list_by_filter($conditions)
	{

		$this->db->select('orders.*,employees.name as c_name,employees.email as c_email,employees.countrycode as countrycode,employees.mobile_no as c_mobile');
		$this->db->from('orders');
		$this->db->join('employees', 'orders.uid = employees.id', 'left');
		if ($this->role_id == '3') {
			$this->db->where('orders.uid', $this->login_id);
		}
		$this->db->order_by("orders.id", "asc");
		if ($conditions['customer_id'] != "0")
			$this->db->like('orders.uid', $conditions['customer_id'], 'both');
		if ($conditions['from_date'] != '1970-01-01')
			$this->db->where('orders.order_date >=', $conditions['from_date']);
		if ($conditions['upto_date'] != '1970-01-01')
			$this->db->where('orders.order_date <=', $conditions['upto_date']);
		$this->db->order_by("orders.id", "asc");
		$query =  $this->db->get()->result_array();
		return $query;
	}


	function deleteorder($id)
	{
		$this->db->where('id', $id);
		if ($this->db->delete('orders')) {
			$this->db->where('detail_id', $id);
			if ($this->db->delete('files_db')) {
				return true;
			}
		}
	}
	public function CheckcustomerCode($code)
	{
		$this->db->select('customer_code');
		$this->db->from('customers');
		$this->db->where(['customer_code' => $code]);
		$query = $this->db->get()->num_rows();
		return $query;
	}

	public function TotalSupliers()
	{
		$this->db->select('*');
		$this->db->from('customers');
		$this->db->where('flag', '0');
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function TotalCandidates()
	{
		$this->db->select('*');
		$this->db->from('send_emails');
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function FetchallEmails()
	{
		$this->db->select('email');
		$this->db->from('send_emails');
		$query =  $this->db->get()->result_array();
		return $query;
	}
	public function TotalOrders()
	{
		$this->db->select('*');
		$this->db->from('purchase_orders');
		$this->db->where('flag', '0');
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function TotalEmployees()
	{
		$this->db->select('*');
		$this->db->from('employees');
		$this->db->where('flag', '0');
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function TotalProducts()
	{
		$this->db->select('*');
		$this->db->from('item_masters');
		$this->db->where('flag', '0');
		$query = $this->db->get();
		return $query->num_rows();
	}



	function getCategories()
	{
		$result = $this->db->select('id, category_name')->from('categories')->where('flag', '0')->get()->result_array();
		return $result;
	}

	function getCategoriesEditPage()
	{
		$result = $this->db->select('id, category_name')->from('categories')->where('flag', '0')->get()->result_array();
		//print_r($result);exit;
		//order_by('category_name', 'asc');
		$productname = array();
		// $productname[''] = 'Select Category...'; 
		foreach ($result as $r) {
			$productname[$r['category_name']] = $r['category_name'];
		}

		return $productname;
	}
	function getCountries()
	{
		//$result = $this->db->select('id, state_name')->from('states')->where('flag','0')->get()->result_array(); 
		$result = $this->db->select('id, name')->get('countries')->result_array();
		//print_r($result);exit;
		//order_by('category_name', 'asc');
		$states = array();
		$states[''] = 'Select Country...';
		foreach ($result as $r) {
			$states[$r['id']] = $r['name'];
		}
		return $states;
	}
	function getUserEmails()
	{
		//$result = $this->db->select('id, state_name')->from('states')->where('flag','0')->get()->result_array(); 
		$result = $this->db->select('email')->where(['flag' => '0', 'role_id' => '2'])->get('employees')->result_array();
		//print_r($result);exit;
		//order_by('category_name', 'asc');
		$states = array();
		$states[''] = 'Select Refer By Email...';
		foreach ($result as $r) {
			$states[$r['email']] = $r['email'];
		}
		return $states;
	}
	function getCountry_codes()
	{
		//$result = $this->db->select('id, state_name')->from('states')->where('flag','0')->get()->result_array(); 
		$result = $this->db->select('id,country_name,iso_code,isd_code')->get('country_codes')->result_array();
		//print_r($result);exit;
		//order_by('category_name', 'asc');
		/* $codes = array(); 
        $codes[''] = 'Select Country...'; 
        foreach($result as $r) { 
            $codes[$r['id']] = $r['country_name'].'( '.$r['isd_code'].')'; 
        } */
		return $result;
	}
	function getStates($id)
	{
		$result = $this->db->select('id, state_name')->from('states')->where('country_id', $id)->get()->result_array();
		// $result = $this->db->select('id, state_name')->get('states')->result_array(); 
		//print_r($result);exit;
		//order_by('category_name', 'asc');
		$states = array();
		$states[''] = 'Select State...';
		foreach ($result as $r) {
			$states[$r['id']] = $r['state_name'];
		}
		return $states;
	}
	function getCities($id)
	{
		$result = $this->db->select('id, city')->from('cities')->where('state_id', $id)->get()->result_array();

		//$result = $this->db->select('id, city')->get('cities')->result_array(); 
		//print_r($result);exit;
		//order_by('category_name', 'asc');
		$states = array();
		$states[''] = 'Select City...';
		foreach ($result as $r) {
			$states[$r['id']] = $r['city'];
		}
		return $states;
	}
	function getUsersList()
	{
		$result = $this->db->select('id, name,employee_code')->from('employees')->where('flag',0)->get()->result_array();

		//$result = $this->db->select('id, city')->get('cities')->result_array(); 
		//print_r($result);exit;
		//order_by('category_name', 'asc');
		$users = array();
		$users[''] = 'Select Customer...';
		foreach ($result as $r) {
			$users[$r['id']] = $r['name'] . ' (' . $r['employee_code'] . ')';
		}
		return $users;
	}

	function get_menu_tree($parent_id)
	{
		global $con;
		$menu = "";
		$sqlquery = " SELECT * FROM menus where flag='0' and parent_id='" . $parent_id . "' ";
		$res = mysqli_query($con, $sqlquery);
		while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
			$menu .= "<li class='nav-item has-treeview menu-open'><a class='nav-link active' href='" . $row['link'] . "'>" . $row['menu_name'] . "</a>";

			$menu .= "<ul>" . $this->get_menu_tree($row['menu_id']) . "</ul>"; //call  recursively

			$menu .= "</li>";
		}

		return $menu;
	}
	public function get_categories()
	{

		$this->db->select('*');
		$this->db->from('menus');
		$this->db->where('parent_id', 0);
		//Add here role condition
		$parent = $this->db->get();

		$categories = $parent->result();
		$i = 0;
		foreach ($categories as $p_cat) {

			$categories[$i]->sub = $this->sub_categories($p_cat->id);
			$i++;
		}
		return $categories;
	}
	public function sub_categories($id)
	{

		$this->db->select('*');
		$this->db->from('menus');
		$this->db->where('parent_id', $id);
		//add here role condition
		$child = $this->db->get();
		$categories = $child->result();
		$i = 0;
		foreach ($categories as $p_cat) {

			$categories[$i]->sub = $this->sub_categories($p_cat->id);
			$i++;
		}
		return $categories;
	}

	public function verify_email($email)
	{
		$condition = "email =" . "'" . $email . "'";
		$this->db->select('*');
		$this->db->from('employees');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	function getEmployees()
	{
		$result = $this->db->select('id, name')->from('employees')->where('flag', '0')->get()->result_array();
		return $result;
	}
	function getcustomerByCategory($id)
	{
		$result = $this->db->select('id, customer_name')->from('customers')->where(['flag' => '0', 'categories_id' => $id])->get()->result_array();

		return $result;
	}
	function getcustomerById($id)
	{
		$result = $this->db->select('gst_no')->from('customers')->where(['flag' => '0', 'id' => $id])->get()->row_array();

		return $result;
	}

	function FindStateCodeById($id)
	{
		$result = $this->db->select('state_code')->from('states')->where(['id' => $id])->get()->row_array();
		return $result;
	}
	function actionOrder($data, $old_id)
	{
		$this->db->where('id', $old_id);
		$this->db->update('orders', $data);
		//$this->requisitionDetails($old_id);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function getAllcustomers()
	{
		$result = $this->db->select('id,name')->from('employees')->where('flag', '0')->get()->result_array();
		return $result;
	}

	public function getByIdReferal($id)
	{
		$this->db->select('orders.*,employees.name as c_name,employees.email as c_email,employees.countrycode as countrycode,employees.mobile_no as c_mobile');
		$this->db->from('orders');
		//$this->db->join('categories', 'customers.categories_id = categories.id','left'); 
		$this->db->join('employees', 'orders.uid = employees.id', 'left');
		//$this->db->where($condition);
		$this->db->where('orders.id', $id);

		//$this->db->where('orders.flag','0');
		$this->db->order_by("orders.id", "asc");

		$query =  $this->db->get()->result_array();
		foreach ($query as $i => $po_data) {
			$this->db->select('files_db.*');
			$this->db->where('files_db.detail_id', $po_data['id']);
			$images_query = $this->db->get('files_db')->result_array();
			$query[$i]['order_file_details'] = $images_query;
		}
		return $query;
	}
}

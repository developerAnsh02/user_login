<?php


class Order_model extends CI_Model
{
	private $table = 'orders';
	private $detailTable = 'files_db';
	private $payment_details = 'payment_details';
	private $card_detailTable = 'customer_card_details';
	private $completedOrders = 'completed_orders';
	private $status;

	public function __construct()
	{
		parent::__construct();
		$this->status = 1;
		$this->login_id = @$this->session->userdata['logged_in']['id'];
		$this->role_id = @$this->session->userdata['logged_in']['role_id'];
		$this->email = @$this->session->userdata['logged_in']['email'];
	}

	public function TotalCustomers()
	{
		$this->db->select('*');
		$this->db->from('employees');
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function TotalOrders($online_order = '')
	{
		$this->db->select('*');
		$this->db->from('orders');

		if (!empty($online_order)) {
			$this->db->where('orders.order_type', 'Website');
		}

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function TotalOrdersToday()
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('order_date', date('Y-m-d'));
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function TotalOrdersCurrentMonth()
	{
		$start =  mktime(0, 0, 0, date("n"), 1, date("Y"));
		$end = mktime(0, 0, 0, date("n") + 1, 1, date("Y")) - 1;

		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where(['order_date >=' => date('Y-m-d', $start), 'order_date <=' => date('Y-m-d', $end)]);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function TotalOrdersCurrentMonthOther()
	{
		$start =  mktime(0, 0, 0, date("n"), 1, date("Y"));
		$end = mktime(0, 0, 0, date("n") + 1, 1, date("Y")) - 1;
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where(['order_date >=' => date('Y-m-d', $start), 'order_date <=' => date('Y-m-d', $end)]);
		$names = array('Cancelled', 'Pending');
		$this->db->where_not_in('projectstatus', $names);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function TotalOrdersCurrentMonthPending()
	{
		$start =  mktime(0, 0, 0, date("n"), 1, date("Y"));
		$end = mktime(0, 0, 0, date("n") + 1, 1, date("Y")) - 1;
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where(['order_date >=' => date('Y-m-d', $start), 'order_date <=' => date('Y-m-d', $end)]);
		$this->db->where(['projectstatus' => 'Pending']);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function TotalOrdersCurrentMonthCancelled()
	{
		$start =  mktime(0, 0, 0, date("n"), 1, date("Y"));
		$end = mktime(0, 0, 0, date("n") + 1, 1, date("Y")) - 1;
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where(['order_date >=' => date('Y-m-d', $start), 'order_date <=' => date('Y-m-d', $end)]);
		$this->db->where(['projectstatus' => 'Cancelled']);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function TotalOrdersPending()
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('projectstatus', 'Pending');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function MyReferalsTotal()
	{
		$this->db->select('*');
		$this->db->from('referfriend');
		$this->db->where('uemail', $this->email);
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function TotalOrdersUser()
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('uid', $this->login_id);
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function TotalOrdersTodayUser()
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where(['order_date' => date('Y-m-d'), 'uid' => $this->login_id]);
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function TotalOrdersPendingUser()
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where(['projectstatus' => 'Pending', 'uid' => $this->login_id]);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function getinfo($order_id)
	{
		$this->db->select('orders.*,employees.name as c_name,employees.email as c_email,employees.mobile_no as c_mobile');
		$this->db->from('orders');
		$this->db->join('employees', 'orders.uid = employees.id', 'left');
		$this->db->where('orders.order_id', $order_id);
		$query =  $this->db->get()->result_array();
		return $query;
	}

	public function feedback_insert($data)
	{
		$image = '';
		if (!empty($_FILES['feedback_file']['name'])) {
			$_FILES['file']['name'] = $_FILES['feedback_file']['name'];
			$_FILES['file']['type'] = $_FILES['feedback_file']['type'];
			$_FILES['file']['tmp_name'] = $_FILES['feedback_file']['tmp_name'];
			$_FILES['file']['error'] = $_FILES['feedback_file']['error'];
			$_FILES['file']['size'] = $_FILES['feedback_file']['size'];

			$config['upload_path'] = './uploads/customers/';
			$config['allowed_types'] = '*';
			$config['max_size']    = '50000';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('file')) {

				$uploadData = $this->upload->data();

				$filename = $uploadData['file_name'];
				$image = $filename;
			}
		}
		$data['image'] = $image;
		$this->db->insert('feedbacks', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function call_insert($data)
	{
		$this->db->insert('calls', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function call_list($id)
	{
		$this->db->select('calls.*, employees.name as ename');
		$this->db->from('calls');
		$this->db->join('employees', 'calls.created_by = employees.id', 'left');
		$this->db->where('calls.order_id', $id);
		// $this->db->order_by("calls.id", "desc");
		$query =  $this->db->get()->result_array();
		return $query;
	}

	public function feedback_list($id)
	{
		$login_id = $this->session->userdata['logged_in']['id'];

		$this->db->select('feedbacks.*,employees.name as c_name,employees.email as c_email,orders.order_id as code,employees.mobile_no as c_mobile');
		$this->db->from('feedbacks');
		$this->db->join('employees', 'feedbacks.user_id = employees.id', 'left');
		$this->db->join('orders', 'feedbacks.order_id = orders.id', 'left');
		$this->db->where('feedbacks.order_id', $id);

		// if ($this->role_id == '2') {
		// 	$this->db->where('feedbacks.user_id', $login_id);
		// }

		$this->db->where('feedbacks.flag', '0');
		// $this->db->order_by("feedbacks.id", "desc");

		$query =  $this->db->get()->result_array();
		return $query;
	}

	public function feedback_list_all()
	{
		$login_id = $this->session->userdata['logged_in']['id'];
		$this->db->select('feedbacks.*,employees.name as c_name,employees.email as c_email,orders.order_id as code,employees.mobile_no as c_mobile');
		$this->db->from('feedbacks');
		$this->db->join('employees', 'feedbacks.user_id = employees.id', 'left');
		$this->db->join('orders', 'feedbacks.order_id = orders.id', 'left');
		if ($this->role_id == '2') {
			$this->db->where('feedbacks.user_id', $login_id);
		}
		$this->db->where('feedbacks.flag', '0');
		$this->db->order_by("feedbacks.id", "desc");
		$query =  $this->db->get()->result_array();
		return $query;
	}

	public function feedback_notification()
	{
		$login_id = $this->session->userdata['logged_in']['id'];
		$this->db->select('feedbacks.*,employees.name as c_name,employees.email as c_email,orders.order_id as code,employees.mobile_no as c_mobile');
		$this->db->from('feedbacks');
		$this->db->join('employees', 'feedbacks.user_id = employees.id', 'left');
		$this->db->join('orders', 'feedbacks.order_id = orders.id', 'left');
		if ($this->role_id == '2') {
			$this->db->where('feedbacks.user_id', $login_id);
		}
		$this->db->where('feedbacks.status', '0');
		$this->db->order_by("feedbacks.id", "desc");
		$query =  $this->db->get()->result_array();
		return $query;
	}

	public function order_read($id)
	{
		$data['is_read'] = 1;
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('id', $id);
		if ($this->db->update('orders', $data)) {
			return true;
		}
	}

	public function feedback_delete($id)
	{
		$data['flag'] = 1;
		$this->db->select('*');
		$this->db->from('feedbacks');
		$this->db->where('id', $id);
		if ($this->db->update('feedbacks', $data)) {
			return true;
		}
	}

	public function feedback__notify_update()
	{
		$data['status'] = 1;
		$this->db->select('*');
		$this->db->from('feedbacks');
		$this->db->where('status', '0');
		if ($this->db->update('feedbacks', $data)) {
			return true;
		}
	}
	public function feedback_notify_updatenew($id)
	{
		$data['status'] = 1;
		$this->db->select('*');
		$this->db->from('feedbacks');
		$this->db->where('order_id', $id);
		if ($this->db->update('feedbacks', $data)) {
			return true;
		}
	}
	public function feedback__notify_updatenewall()
	{
		$data['status'] = 1;
		$this->db->select('*');
		$this->db->from('feedbacks');
		$this->db->where('status', 0);
		if ($this->db->update('feedbacks', $data)) {
			return true;
		}
	}

	public function duplicate_order_insert($data)
	{
		$this->db->insert('orders', $data);
	}

	// Insert customer data in database
	public function order_insert($data)
	{
		$picture = array();
		$countfiles = count($_FILES['bill_image']['name']);
		for ($i = 0; $i < $countfiles; $i++) {
			if (!empty($_FILES['bill_image']['name'][$i])) {
				$_FILES['file']['name'] = $_FILES['bill_image']['name'][$i];
				$_FILES['file']['type'] = $_FILES['bill_image']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['bill_image']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['bill_image']['error'][$i];
				$_FILES['file']['size'] = $_FILES['bill_image']['size'][$i];
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = '*';
				$config['max_size']    = '50000'; // max_size in kb
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('file')) {
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					$picture[] = $filename;
				} else {
					$picture[] = '';
				}
			} else {
				$picture[] = '';
			}
		}
		$condition = "order_id =" . "'" . $data['order_id'] . "'";
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($query->num_rows() == 0) {
			$this->db->insert('orders', $data);
			$id = $this->db->insert_id();
			$this->CustomerAssetsDetails($id, $picture);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}

	/************** Asset Profile Details Insertion ******************/

	function uploadOrderFiles()
	{
		$picture = array();
		$countfiles = count($_FILES['order_file']['name']);
		for ($i = 0; $i < $countfiles; $i++) {
			if (!empty($_FILES['order_file']['name'][$i])) {
				$config = [];
				$_FILES['file']['name'] 	= $_FILES['order_file']['name'][$i];
				$_FILES['file']['type'] 	= $_FILES['order_file']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['order_file']['tmp_name'][$i];
				$_FILES['file']['error'] 	= $_FILES['order_file']['error'][$i];
				$_FILES['file']['size'] 	= $_FILES['order_file']['size'][$i];
				// Set preference
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = '*';
				$config['max_size']    = '50000';
				//Load upload library
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('file')) {
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					$picture[] = $filename;
				} else {
					$picture[] = '';
				}
			} else {
				$picture[] = '';
			}
		}
		$order_id = $this->input->post('order_id');
		$this->CustomerAssetsDetails($order_id, $picture);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function CustomerAssetsDetails($order_id, $picture)
	{
		date_default_timezone_set("Europe/London");
		$updated_on = date("Y-m-d H:i:s");
		$req_data = $this->fetchOrderDetails($order_id);
		$user_id = $req_data['uid'];
		foreach ($picture as  $value) :
			if($_SERVER['HTTP_HOST']=='localhost')
			{
				$value = "http://localhost/wm/uploads/" . $value;
			} else {
				$value = "https://assignnmentinneed.com/admin/uploads/" . $value;
			}
			$this->db->set('detail_id', $order_id);
			$this->db->set('u_id', $user_id);
			$this->db->set('file', $value);
			$this->db->set('updated_on', $updated_on);
			$this->db->insert($this->detailTable);
		endforeach;
	}

	// API post 
	public function order_post()
	{
		$data = array(
			'uid' => $this->input->post('user_id'),
			'order_id' => $this->input->post('order_id'),
			'order_date' => date('Y-m-d', strtotime($this->input->post('order_date'))),
			'services' => $this->input->post('typeofservice'),
			'formatting' => $this->input->post('formatting'),
			'typeofpaper' => $this->input->post('typeofpaper'),
			'typeofwritting' => $this->input->post('typeofwritting'),
			'pages' => $this->input->post('pages'),
			'title' => $this->input->post('title'),
			'deadline' => $this->input->post('deadline'),
			'message' => $this->input->post('message'),
			'actual_amount' => $this->input->post('actualorder'),
			'discount_per' => $this->input->post('discount_per'),
			'amount' => $this->input->post('order_total'),
			'paymentstatus' => 'Pending',
			'projectstatus' => 'Pending',
			'order_type' => 'Pending',
			'order_type' => $this->input->post('order_type'),
		);
		$this->db->insert('orders', $data);
		$id = $this->db->insert_id();
		$picture = array();
		$countfiles = count($_FILES['bill_image']['name']);
		for ($i = 0; $i < $countfiles; $i++) {
			if (!empty($_FILES['bill_image']['name'][$i])) {
				$_FILES['file']['name'] = $_FILES['bill_image']['name'][$i];
				$_FILES['file']['type'] = $_FILES['bill_image']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['bill_image']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['bill_image']['error'][$i];
				$_FILES['file']['size'] = $_FILES['bill_image']['size'][$i];
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				$config['max_size']    = '50000';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('file')) {
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					$picture[] = $filename;
				} else {
					$picture[] = '';
				}
			} else {
				$picture[] = '';
			}
		}

		$this->CustomerAssetsDetails($id, $picture);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function updatePaymentinOrders($order_id, $new_received_amount)
	{
		$data = array('received_amount' => $new_received_amount);
		$this->db->set('received_amount', $new_received_amount);
		$this->db->where('id', $order_id);
		$this->db->update('orders', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function addPayment($data)
	{
		$this->db->insert('payment_details', $data);
		//$this->CustomerCardDetails($id);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function fetchOrderDetails($id)
	{
		$this->db->select('uid');
		$this->db->from('orders');
		$this->db->where('id', $id);
		$query = $this->db->get()->row_array();
		//print_r($query);exit;
		//$count=$query['pending_qty'];
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

	function editOrder($data, $old_id)
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('id', $old_id);
		if ($this->db->update('orders', $data)) {
			return true;
		}
	}
	function updateOtp($data, $id)
	{
		$this->db->select('*');
		$this->db->from('employees');
		$this->db->where('id', $id);
		if ($this->db->update('employees', $data)) {
			return true;
		}
	}
	function updatePassword($email, $data)
	{
		$this->db->select('*');
		$this->db->from('employees');
		$this->db->where('email', $email);
		/*$this->db->limit(1);
			$this->db->get();*/
		if ($this->db->update('employees', $data)) {
			return true;
		} else {
			return false;
		}
	}
	function myPasswordChange($emp_id, $data)
	{
		//echo $emp_id;exit;
		$this->db->select('*');
		$this->db->from('employees');
		$this->db->where('id', $emp_id);
		//$this->db->limit(1);
		//$this->db->get();
		if ($this->db->update('employees', $data)) {
			return true;
		} else {
			return false;
		}
	}

	function getOrderId()
	{
		$this->db->select("order_id");
		$this->db->from('orders');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get()->row_array();
		if (!empty($query)) {
			$dd = explode('UKS', $query['order_id']);
			$count = $dd[1] + 1;
			return $count;
		} else {
			$count = 16075;
			return $count;
		}
	}

	public function create_csv(){
		$this->db->select('orders.*');
		$this->db->from('orders');
		$query =  $this->db->get()->result_array();
		return $query;
	}

	public function export_csv()
	{
		$this->db->select('orders.*,employees.name as c_name,employees.email as c_email,employees.countrycode as countrycode,employees.mobile_no as c_mobile');
		$this->db->from('orders');
		$this->db->join('employees', 'orders.uid = employees.id', 'left');
		if ($this->role_id == '2') {
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

	public function order_list($id = null)
	{

		$this->db->select('orders.*,employees.name as c_name,employees.email as c_email,countries.phonecode as countrycode,employees.mobile_no as c_mobile');
		$this->db->from('orders');
		//$this->db->join('categories', 'customers.categories_id = categories.id','left'); 
		$this->db->join('employees', 'orders.uid = employees.id', 'left');
		$this->db->join('countries', 'countries.id = employees.countrycode', 'left');
		//$this->db->where($condition);
		if ($this->role_id == '2') {
			$this->db->where('orders.uid', $id);
		}
		// $this->db->limit($limit, $start);
		//$this->db->where('orders.flag','0');
		$this->db->order_by("orders.id", "desc");

		$query =  $this->db->get()->result_array();
		foreach ($query as $i => $po_data) {
			$this->db->select('files_db.*');
			$this->db->where('files_db.detail_id', $po_data['id']);
			$images_query = $this->db->get('files_db')->result_array();
			$query[$i]['order_file_details'] = $images_query;
		}
		foreach ($query as $i => $po_data) {
			$this->db->select('completed_orders.*');
			$this->db->where('completed_orders.order_id', $po_data['id']);
			$images_query = $this->db->get('completed_orders')->result_array();
			$query[$i]['completed_orders'] = $images_query;
		}

		//print_r($query);exit;
		return $query;
	}

	public function order_list_10($id)
	{
		$this->db->select('orders.*,employees.name as c_name,employees.email as c_email,countries.phonecode as countrycode,employees.mobile_no as c_mobile');
		$this->db->from('orders');
		$this->db->join('employees', 'orders.uid = employees.id', 'left');
		$this->db->join('countries', 'countries.id = employees.countrycode', 'left');
		if ($this->role_id == '2') {
			$this->db->where('orders.uid', $id);
		}
		$this->db->limit(5);
		$this->db->order_by("orders.id", "desc");

		$query =  $this->db->get()->result_array();
		foreach ($query as $i => $po_data) {
			$this->db->select('files_db.*');
			$this->db->where('files_db.detail_id', $po_data['id']);
			$images_query = $this->db->get('files_db')->result_array();
			$query[$i]['order_file_details'] = $images_query;
		}
		foreach ($query as $i => $po_data) {
			$this->db->select('completed_orders.*');
			$this->db->where('completed_orders.order_id', $po_data['id']);
			$images_query = $this->db->get('completed_orders')->result_array();
			$query[$i]['completed_orders'] = $images_query;
		}
		return $query;
	}

	public function order_listnew($id, $limit, $start, $online_order='')
	{
		$this->db->select('orders.*, orders.id as id, employees.name as c_name,employees.email as c_email,countries.phonecode as countrycode,employees.mobile_no as c_mobile');
		$this->db->from('orders');
		$this->db->join('employees', 'orders.uid = employees.id', 'left');
		$this->db->join('countries', 'countries.id = employees.countrycode', 'left');
		$this->db->where('orders.flag', '0');
		if ($this->role_id == '2') {
			$this->db->where('orders.uid', $id);
		}
		if (isset($online_order) && !empty($online_order)) {
			$this->db->where('orders.order_type', 'Website');
		}
		$this->db->limit($limit, $start);
		$this->db->order_by("orders.id", "desc");

		$query =  $this->db->get()->result_array();

		foreach ($query as $i => $po_data) {
			$this->db->select('payment_details.*');
			$this->db->where('payment_details.order_id', $po_data['id']);
			$b_query = $this->db->get('payment_details')->result_array();
			$query[$i]['payment_details'] = $b_query;
		}
		foreach ($query as $i => $po_data) {
			$this->db->select('files_db.*');
			$this->db->where('files_db.detail_id', $po_data['id']);
			$a_query = $this->db->get('files_db')->result_array();
			$query[$i]['order_file_details'] = $a_query;
		}
		foreach ($query as $i => $po_data) {
			$this->db->select('completed_orders.*');
			$this->db->where('completed_orders.order_id', $po_data['id']);
			$c_query = $this->db->get('completed_orders')->result_array();
			$query[$i]['completed_orders'] = $c_query;
		}
		return $query;
	}

	public function order_list_by_filter($conditions)
	{
		$this->db->select('orders.*,employees.name as c_name,employees.email as c_email,employees.countrycode as countrycode,employees.mobile_no as c_mobile');
		$this->db->from('orders');
		$this->db->join('employees', 'orders.uid = employees.id', 'left');

		if ($this->role_id == '2') {
			$this->db->where('orders.uid', $this->login_id);
		}

		
		
		if ($conditions['customer_id'] != "0")
			$this->db->where('orders.uid', $conditions['customer_id']);

		if ($conditions['order_id'] != "0")
			$this->db->like('orders.order_id', $conditions['order_id'], 'both');

		if ($conditions['title'] != "") {

			if ($conditions['filter_check'] == 'title') {
				$this->db->like('orders.title', $conditions['title'], 'both');
			}

			if ($conditions['filter_check'] == 'title') {
				if ($conditions['writer_name'] != "0") 
				{
					$this->db->like('orders.writer_name', $conditions['writer_name'], 'both');
				}
				}

			if ($conditions['filter_check'] == 'college') {
				$this->db->like('orders.college_name', $conditions['title'], 'both');
			}
		}

		if ($conditions['order_date_filter'] == 'order_date') {
			if ($conditions['from_date'] != '1970-01-01')
				$this->db->where('orders.order_date >=', $conditions['from_date']);
			if ($conditions['upto_date'] != '1970-01-01')
				$this->db->where('orders.order_date <=', $conditions['upto_date']);
		} elseif ($conditions['order_date_filter'] == 'writer') {
			if ($conditions['from_date'] != '1970-01-01')
				$this->db->where('orders.writer_deadline >=', $conditions['from_date']);
			if ($conditions['upto_date'] != '1970-01-01')
				$this->db->where('orders.writer_deadline <=', $conditions['upto_date']);
		} else {
			if ($conditions['from_date'] != '1970-01-01')
				$this->db->where('orders.delivery_date >=', $conditions['from_date']);
			if ($conditions['upto_date'] != '1970-01-01')
				$this->db->where('orders.delivery_date <=', $conditions['upto_date']);
		}

		if ($conditions['status'] != '') {
			$this->db->where('orders.projectstatus', $conditions['status']);
		}

		if (!empty($conditions['online_order'])) {
			$this->db->where('orders.order_type', 'Website');
		}
		$this->db->where('orders.flag', '0');
		$this->db->order_by("orders.id", "desc");
		$query =  $this->db->get()->result_array();

		foreach ($query as $i => $po_data) {
			$this->db->select('files_db.*');
			$this->db->where('files_db.detail_id', $po_data['id']);
			$images_query = $this->db->get('files_db')->result_array();
			$query[$i]['order_file_details'] = $images_query;
		}
		foreach ($query as $i => $po_data) {
			$this->db->select('completed_orders.*');
			$this->db->where('completed_orders.order_id', $po_data['id']);
			$images_query = $this->db->get('completed_orders')->result_array();
			$query[$i]['completed_orders'] = $images_query;
		}
		foreach ($query as $i => $po_data) {
			$this->db->select('payment_details.*');
			$this->db->where('payment_details.order_id', $po_data['id']);
			$b_query = $this->db->get('payment_details')->result_array();
			$query[$i]['payment_details'] = $b_query;
		}
		return $query;
	}

	function deleteorder($id)
	{
		$this->db->where('id', $id);
		// if ($this->db->delete('orders')) {
		// 	$this->db->where('detail_id', $id);
		// 	if ($this->db->delete('files_db')) {
		// 		return true;
		// 	}
		// }
	}

	function deleteorderFile($id)
	{

		$this->db->where('id', $id);
		if ($this->db->delete('files_db')) {
			return true;
		}
	}

	function deleteCompletedFile($id)
	{

		$this->db->where('id', $id);
		if ($this->db->delete('completed_orders')) {
			return true;
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

	function getOrderIDs()
	{
		$result = $this->db->select('id, order_id')->from('orders')->where('flag','0')->order_by('id','desc')->get()->result_array();
		return $result;
	}

	function getCategories()
	{
		$result = $this->db->select('id, category_name')->from('categories')->where('flag', '0')->get()->result_array();
		return $result;
	}

	function getServices()
	{
		$result = $this->db->select('id, service_name,factor')->from('services')->where('flag', '0')->get()->result_array();
		return $result;
	}

	function getTypeOfPaper()
	{
		$this->db->select('id, paper_type,factor')->from('type_papers')->where('flag', '0');
		$this->db->order_by("paper_type", "asc");
		$result = $this->db->get()->result_array();
		return $result;
	}

	function getPagesList()
	{
		$result = $this->db->select('id, page,factor')->from('pages')->where('flag', '0')->get()->result_array();
		return $result;
	}

	function getTimelines()
	{
		$result = $this->db->select('id, timeline,factor')->from('timelines')->where('flag', '0')->get()->result_array();
		return $result;
	}

	function getFormattings()
	{
		$result = $this->db->select('id, formatting_name')->from('formattings')->where('flag', '0')->get()->result_array();
		return $result;
	}

	function getWtittingTypes()
	{
		$result = $this->db->select('id,type_of_writing,factor')->from('type_of_writtings')->where('flag', '0')->get()->result_array();
		return $result;
	}

	function getCategoriesEditPage()
	{
		$result = $this->db->select('id, category_name')->from('categories')->where('flag', '0')->get()->result_array();
		$productname = array();
		foreach ($result as $r) {
			$productname[$r['category_name']] = $r['category_name'];
		}

		return $productname;
	}

	function getCountries()
	{
		$result = $this->db->select('id, name')->get('countries')->result_array();
		$states = array();
		$states[''] = 'Select Country...';
		foreach ($result as $r) {
			$states[$r['id']] = $r['name'];
		}
		return $states;
	}
	function getCountry_codes()
	{
		$result = $this->db->select('id,country_name,iso_code,isd_code')->get('country_codes')->result_array();
		return $result;
	}

	function getStates($id)
	{
		$result = $this->db->select('id, state_name')->from('states')->where('country_id', $id)->get()->result_array();
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
		$states = array();
		$states[''] = 'Select City...';
		foreach ($result as $r) {
			$states[$r['id']] = $r['city'];
		}
		return $states;
	}

	function getUsersList()
	{
		$result = $this->db->select('id, name,employee_code')->from('employees')->where('flag',0)->order_by("name", "ASC")->get()->result_array();
		$users = array();
		$users[''] = '';
		foreach ($result as $r) {
			$users[$r['id']] = $r['name'];
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
		$picture = array();

		// Count total offer_images
		$countfiles = count($_FILES['offer_images']['name']);

		// Looping all files
		for ($i = 0; $i < $countfiles; $i++) {

			if (!empty($_FILES['offer_images']['name'][$i])) {

				// Define new $_FILES array - $_FILES['file']
				$_FILES['file']['name'] = $_FILES['offer_images']['name'][$i];
				$_FILES['file']['type'] = $_FILES['offer_images']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['offer_images']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['offer_images']['error'][$i];
				$_FILES['file']['size'] = $_FILES['offer_images']['size'][$i];

				// Set preference
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = '*';
				$config['max_size']    = '50000';	// max_size in kb
				//$config['file_name'] = $_FILES['offer_images']['name'][$i];

				//Load upload library
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				// File upload

				if ($this->upload->do_upload('file')) {
					// Get data about the file
					//print_r($_FILES);exit;
					$uploadData = $this->upload->data();
					//print_r($uploadData);exit;
					$filename = $uploadData['file_name'];

					// Initialize array
					$picture[] = $filename;
				} else {
					$picture[] = '';
				}
			} else {
				$picture[] = '';
			}
		}

		$this->db->where('id', $old_id);
		$this->db->update('orders', $data);
		$this->completedOrderFiles($old_id, $picture);
		$return_data = [true, $picture];
		if ($this->db->affected_rows() > 0) {
			return $return_data;
		} else {
			return false;
		}
	}
	function completedOrderFiles($old_id, $picture)
	{
		date_default_timezone_set("Europe/London");
		$updated_on = date("Y-m-d H:i:s");
		foreach ($picture as  $value) :
			$value = "https://assignnmentinneed.com/admin/uploads/" . $value;
			$this->db->set('order_id', $old_id);
			$this->db->set('file_path', $value);
			$this->db->set('updated_on', $updated_on);
			$this->db->insert($this->completedOrders);
		endforeach;
	}

	function getAllcustomers()
	{
		$result = $this->db->select('id,name,email,mobile_no')->from('employees')->where('flag', '0')->order_by('id','desc')->get()->result_array();
		return $result;
	}

	public function getById($id)
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

		foreach ($query as $i => $po_data) {
			$this->db->select('payment_details.*');
			$this->db->where('payment_details.order_id', $po_data['id']);
			$images_query = $this->db->get('payment_details')->result_array();
			$query[$i]['payment_details'] = $images_query;
		}

		foreach ($query as $i => $po_data) {
			$this->db->select('completed_orders.*');
			$this->db->where('completed_orders.order_id', $po_data['id']);
			$images_query = $this->db->get('completed_orders')->result_array();
			$query[$i]['completed_orders'] = $images_query;
		}

		return $query;
	}

	public function getByIdnew($id)
	{

		$id = explode(',', $id);
		$this->db->select('orders.*,banks.*,employees.name as c_name,employees.email as c_email,employees.countrycode as countrycode,employees.mobile_no as c_mobile');
		$this->db->from('orders');
		//$this->db->join('categories', 'customers.categories_id = categories.id','left'); 
		$this->db->join('employees', 'orders.uid = employees.id', 'left');
		$this->db->join('banks', 'employees.bank_id = banks.id', 'left');
		//$this->db->where($condition);
		$this->db->where_in('orders.id', $id);

		//$this->db->where('orders.flag','0');
		$this->db->order_by("orders.id", "asc");

		$query =  $this->db->get()->result_array();
		foreach ($query as $i => $po_data) {
			$this->db->select('files_db.*');

			$this->db->where('files_db.detail_id', $po_data['id']);
			$this->db->order_by("files_db.id", "desc");
			$images_query = $this->db->get('files_db')->result_array();
			$query[$i]['order_file_details'] = $images_query;
		}

		foreach ($query as $i => $po_data) {
			$this->db->select('payment_details.*');
			$this->db->where('payment_details.order_id', $po_data['id']);
			$images_query = $this->db->get('payment_details')->result_array();
			$query[$i]['payment_details'] = $images_query;
		}

		foreach ($query as $i => $po_data) {
			$this->db->select('completed_orders.*');
			$this->db->where('completed_orders.order_id', $po_data['id']);
			$this->db->order_by("completed_orders.id", "desc");
			$images_query = $this->db->get('completed_orders')->result_array();
			$query[$i]['completed_orders'] = $images_query;
		}

		return $query;
	}
	public function getOrderImages($id)
	{

		$this->db->select('files_db.*');
		$this->db->where('detail_id', $id);
		$this->db->order_by("files_db.id", "desc");
		$images_query = $this->db->get('files_db')->result_array();
		//$query[$i]['order_file_details'] = $images_query;
		return $images_query;
	}

	public function getOrdersByEmail($uid)
	{
		$this->db->select('orders.*,employees.name as c_name,employees.email as c_email,employees.countrycode as countrycode,employees.mobile_no as c_mobile');
		$this->db->from('orders');
		//$this->db->join('categories', 'customers.categories_id = categories.id','left'); 
		$this->db->join('employees', 'orders.uid = employees.id', 'left');
		//$this->db->where($condition);
		$this->db->where('orders.uid', $uid);

		// $this->db->where('orders.projectstatus', 'Pending');
		$names = array('Other', 'Pending');
		$this->db->where_in('projectstatus', $names);
		$this->db->order_by("orders.id", "asc");

		$query =  $this->db->get()->result_array();
		foreach ($query as $i => $po_data) {
			$this->db->select('files_db.*');
			$this->db->where('files_db.detail_id', $po_data['id']);
			$images_query = $this->db->get('files_db')->result_array();
			$query[$i]['order_file_details'] = $images_query;
		}

		foreach ($query as $i => $po_data) {
			$this->db->select('payment_details.*');
			$this->db->where('payment_details.order_id', $po_data['id']);
			$images_query = $this->db->get('payment_details')->result_array();
			$query[$i]['payment_details'] = $images_query;
		}

		return $query;
	}



	public function leads($conditions)
	{
		$this->db->select('leads.*,employees.name as c_name,employees.email as c_email,employees.countrycode as countrycode,employees.mobile_no as c_mobile');
		$this->db->from('leads');
		$this->db->join('employees', 'leads.emp_id = employees.id', 'left');

		if ($this->role_id == '2') {
			$this->db->where('orders.uid', $this->login_id);
		}
		
		if ($conditions['order_id'] != "0")
			$this->db->like('leads.order_id', $conditions['order_id'], 'both');

			if ($conditions['project_title'] != "0")
			$this->db->like('leads.project_title', $conditions['project_title'] , 'both');

			if ($conditions['mobile'] != "0")
			$this->db->like('leads.mobile', $conditions['mobile']);

			if ($conditions['l_status'] != "0")
			$this->db->like('leads.l_status', $conditions['l_status']);
		
            
			
			


		$this->db->where('leads.flag', '0');
		$this->db->order_by("leads.id", "desc");
		$query =  $this->db->get()->result_array();

		
		
		return $query;
	}

	
	
}

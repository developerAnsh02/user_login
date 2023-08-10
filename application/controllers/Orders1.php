<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Orders extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata['logged_in']['id']) {
			redirect('User_authentication/index');
		}
		// Load form helper library
		$this->load->helper('form');
		$this->load->helper('download');
		$this->load->helper('url');
		// new security feature
		$this->load->helper('security');
		// Load form validation library
		$this->load->library('form_validation');
		$this->load->library('encryption');
		// Load session library
		$this->load->library('session');
		$this->load->library('template');
		// Load database
		$this->load->model('order_model');
	}

	// Show login page
	public function add()
	{
		$data['title'] = 'Create New Order';
		$data['order_ids'] = $this->order_model->getOrderId();
		$voucher_no = $data['order_ids'];
		$data['order_id'] = 'UKS' . $voucher_no;
		$data['user_id'] = $this->session->userdata['logged_in']['id'];
		$data['categories'] = $this->order_model->getCategories();
		$data['services'] = $this->order_model->getServices();
		$data['typeofpapers'] = $this->order_model->getTypeOfPaper();
		$data['pages'] = $this->order_model->getPagesList();
		$data['timelines'] = $this->order_model->getTimelines();
		$data['formattings'] = $this->order_model->getFormattings();
		$data['typeofwritings'] = $this->order_model->getWtittingTypes();
		$data['countries'] = $this->order_model->getCountries();
		$data['users'] = $this->order_model->getUsersList();
		$data['prefix'] = array('Mr.' => 'Mr.', 'Miss.' => 'Miss.', 'Ms.' => 'Ms.');
		$this->template->load('template', 'orders/order_add', $data);
	}

	public function callstatus($id)
	{
		$data['order_id'] = $id;
		$result = $this->order_model->call_list($id);
		$data['call_lists'] = $result;
		$this->template->load('template', 'orders/callstatus', $data);
	}

	public function callstatusadd()
	{
		$login_id = $this->session->userdata['logged_in']['id'];
		$data = $this->input->post();
		$backurl = $this->input->post('backurl');

		unset($data['backurl']);

		$data['created_by'] = $login_id;
		$result = $this->order_model->call_insert($data);

		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'calls Added Successfully  !');
			redirect($backurl, 'refresh');
		} else {
			$this->session->set_flashdata('failed', 'Insertion Failed');
			redirect($backurl, 'refresh');
		}
	}

	public function readorder($id)
	{
		$this->order_model->order_read($id);
	}

	public function deletefeedback($id)
	{
		$this->order_model->feedback_delete($id);
		redirect('/Orders/feedbackall', 'refresh');
	}

	public function feedbackall($status = null)
	{
		$data['title'] = 'Feedback List';
		$data['feedback_lits'] = $this->order_model->feedback_list_all();
		$this->template->load('template', 'feedbackall', $data);
	}

public function emailindusial()
	{
		$data = $this->input->post();
		// print_r($data); exit;
		$email_to = $data['to'];
		$subject = $data['subject'];
		$message = $data['message'];
		$word = $data['word'];
		$deadline = $data['deadline'];
		$formatting = $data['formatting'];
		$files = $data['files'];
		$body = "<div style='font-family: Verdana !important;'>
				<p><br/> Hi,<br/><br/>

				Kindly find the details of the work:<br/><br/> 

				Word count: " . $word . " <br/><br/>

				Deadline:  " . $deadline . "   <br/><br/>				

				Additional Details: <br/><p> " . $message . " </p><br/><br/>
				**********************************************************************<br/>
				Still, if you need any other information please let us know. <br/><br/>
				
			Thanks & Regards,<br/>
			
				</p>
				</div>";

		// Email Code Start

		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_port' => 587,
			'smtp_user' => 'rohitkumarjoshi43@gmail.com', // change it to yours
			'smtp_pass' => '7737581643yogita', // change it to yours
			'mailtype' => 'html',
			'smtp_crypto' => 'tls',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->set_mailtype("html");
		$this->email->to($email_to);
		$this->email->bcc('order@assignnmentinneed.com');
		$this->email->from('order@assignnmentinneed.com', "Quotation");
		$this->email->subject($subject);
		$this->email->message($body);
		foreach ($files as $image) {
			$this->email->attach($image);
		}
		if ($this->email->send()) {
				$this->session->set_flashdata('success', 'Mail Send Successfully !');
		    	$current_page = $_SESSION['fullURL'];
		    	redirect($current_page, 'refresh');
		} else {
			$this->session->set_flashdata('failed', 'Mail Send failed please try again !');
		    	$current_page = $_SESSION['fullURL'];
		    	redirect($current_page, 'refresh');
		}
	}

	public function indusialemail($id = null)
	{
		$query = $this->db->get_where("orders", array("id" => $id));
		$result = $query->result_array();
		$data = $result[0];
		$query1 = $this->db->get_where("files_db", array("detail_id" => $id));
		$result1 = $query1->result_array();
		$data['files'] = $result1;
		$this->template->load('template', 'indusialemail', $data);
	}

	public function feedback($id = null, $status = null)
	{
		$role_id = $this->session->userdata['logged_in']['role_id'];
		$login_id = $this->session->userdata['logged_in']['id'];

		$data['login_id'] = $login_id;
		$data['order_id'] = $id;

		if ($status) {
			$this->order_model->feedback_notify_updatenew($id);
		}

		$data['title'] = 'Feedback';
		$data['feedback_lits'] = $this->order_model->feedback_list($id);
		$this->template->load('template', 'orders/feedback', $data);
	}

	public function add_feedback()
	{
		$login_id = $this->session->userdata['logged_in']['id'];
		$data = $this->input->post();
		$data['user_id'] = $login_id;
		$result = $this->order_model->feedback_insert($data);

		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Feedback Added Successfully  !');
			redirect('/Orders/index', 'refresh');
		} else {
			$this->session->set_flashdata('failed', 'Insertion Failed');
			redirect('/Orders/index', 'refresh');
		}
	}

	public function index()
	{
		$this->load->library("pagination");
		$config = array();
		$config["base_url"] = base_url() . "Orders/index";
		$config["total_rows"] = $this->order_model->TotalOrders();
		$config["per_page"] = 10;
		$config["uri_segment"] = 3;
		$data['Total_order'] = $this->order_model->TotalOrders();
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$config['next_tag_open'] = '<li class="pg-next">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="pg-prev">';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data["links"] = $this->pagination->create_links();
		$role_id = $this->session->userdata['logged_in']['role_id'];
		$login_id = $this->session->userdata['logged_in']['id'];
		$data['title'] = 'Orders List';

		$data['all_customers'] = $this->order_model->getAllCustomers();
		$data['OrderIDs'] = $this->order_model->getOrderIDs();
		if ($this->input->get()) {
			if ($this->input->get('notify') == "yes") {
				$this->order_model->feedback__notify_update();
			}
			$conditions['per_page'] = $config["per_page"];
			$conditions['page'] = $page;
			$conditions['status'] = $this->input->get('status');
			$conditions['customer_id'] = $this->input->get('customer_id');
			$conditions['order_id'] = $this->input->get('order_id');
			$conditions['title'] = $this->input->get('title');
			$conditions['filter_check'] = $this->input->get('filter_check');
			// $conditions['writer_name'] = $this->input->get('writer_name');
			$conditions['order_date_filter'] = $this->input->get('order_date_filter');
			$conditions['from_date'] = date('Y-m-d', strtotime($this->input->get('from_date')));
			$conditions['upto_date'] = date('Y-m-d', strtotime($this->input->get('upto_date')));
			$data['from_date'] = $this->input->get('from_date');
			$data['upto_date'] = $this->input->get('upto_date');
			$data['customer_id'] = $this->input->get('customer_id');
			$data['orders'] = $this->order_model->order_list_by_filter($conditions);
		} else {
			$online_order = 0;
			if ($role_id == 2) {
				$data['orders'] = $this->order_model->order_listnew($login_id, $config["per_page"], $page, $online_order);
			} else {
				$data['orders'] = $this->order_model->order_listnew(null, $config["per_page"], $page, $online_order);
			}
		}

		$data['categories'] 		= $this->order_model->getCategories();
		$data['services'] 			= $this->order_model->getServices();
		$data['typeofpapers'] 		= $this->order_model->getTypeOfPaper();
		$data['pages'] 				= $this->order_model->getPagesList();
		$data['timelines'] 			= $this->order_model->getTimelines();
		$data['formattings'] 		= $this->order_model->getFormattings();
		$data['typeofwritings'] 	= $this->order_model->getWtittingTypes();
		$data['countries'] 			= $this->order_model->getCountries();
		$data['users'] 				= $this->order_model->getUsersList();
		$data['prefix'] 			= array('Mr.' => 'Mr.', 'Miss.' => 'Miss.', 'Ms.' => 'Ms.');
		$data['o_counts'] 			= count($data['orders']);
		// pre($data);
		// die();
		$this->template->load('template', 'orders/order_view', $data);
	}

	public function online_orders()
	{
		$online_order = 1;

		$this->load->library("pagination");
		$config = array();
		$config["base_url"] = base_url() . "Orders/online_orders";
		$config["total_rows"] = $this->order_model->TotalOrders($online_order);
		$config["per_page"] = 10;
		$config["uri_segment"] = 3;
		$data['Total_order'] = $this->order_model->TotalOrders($online_order);
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$config['next_tag_open'] = '<li class="pg-next">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="pg-prev">';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data["links"] = $this->pagination->create_links();
		$role_id = $this->session->userdata['logged_in']['role_id'];
		$login_id = $this->session->userdata['logged_in']['id'];
		$data['title'] = 'Orders List';

		$data['all_customers'] = $this->order_model->getAllCustomers();
		$data['OrderIDs'] = $this->order_model->getOrderIDs();
		if ($this->input->get()) {
			if ($this->input->get('notify') == "yes") {
				$this->order_model->feedback__notify_update();
			}
			$conditions['per_page'] = $config["per_page"];
			$conditions['page'] = $page;
			$conditions['status'] = $this->input->get('status');
			$conditions['customer_id'] = $this->input->get('customer_id');
			$conditions['order_id'] = $this->input->get('order_id');
			$conditions['title'] = $this->input->get('title');
			$conditions['filter_check'] = $this->input->get('filter_check');
			$conditions['order_date_filter'] = $this->input->get('order_date_filter');
			$conditions['from_date'] = date('Y-m-d', strtotime($this->input->get('from_date')));
			$conditions['upto_date'] = date('Y-m-d', strtotime($this->input->get('upto_date')));
			$data['from_date'] = $this->input->get('from_date');
			$data['upto_date'] = $this->input->get('upto_date');
			$conditions['online_order'] = 1;
			$data['orders'] = $this->order_model->order_list_by_filter($conditions);
		} else {
			$online_order = 1;
			if ($role_id == 2) {
				$data['orders'] = $this->order_model->order_listnew($login_id, $config["per_page"], $page, $online_order);
			} else {
				$data['orders'] = $this->order_model->order_listnew(null, $config["per_page"], $page, $online_order);
			}
		}
		$this->template->load('template', 'orders/order_view', $data);
	}

	public function report()
	{
		$data['title'] = 'Orders Report';
		$data['all_customers'] = $this->order_model->getAllCustomers();
		if ($this->input->get()) {
			$conditions['customer_id'] = $this->input->get('customer_id');
			$conditions['from_date'] = date('Y-m-d', strtotime($this->input->get('from_date')));
			$conditions['upto_date'] = date('Y-m-d', strtotime($this->input->get('upto_date')));
			$data['conditions'] = $conditions;
			$data['orders'] = $this->order_model->order_list_by_filter($conditions);
		} else {
			$data['orders'] = $this->order_model->order_list();
		}
		$this->template->load('template', 'order_report', $data);
	}

	public function add_new_order()
	{
		$this->form_validation->set_rules('user_id', 'User Name', 'required');

		//print_r($this->input->post());
		//exit;
		if ($this->form_validation->run() == FALSE) {
			//echo "hy";exit;
			if (isset($this->session->userdata['logged_in'])) {
				$data['categories'] = $this->order_model->getCategories();
				$this->template->load('template', 'orders/order_add', $data);
				//$this->load->view('admin_page');
			} else {
				$this->load->view('login_form');
			}
			//$this->template->load('template','customer_add');
		} else {
			///Referal functionality

			$data = array(
				'uid' => $this->input->post('user_id'),
				'order_id' => $this->input->post('order_id'),
				'delivery_date' => date('Y-m-d', strtotime($this->input->post('delivery_date'))),
				'order_date' => date('Y-m-d', strtotime($this->input->post('order_date'))),
				'services' => $this->input->post('typeofservice'),
				'formatting' => $this->input->post('formatting'),
				'typeofpaper' => $this->input->post('typeofpaper'),
				'typeofwritting' => $this->input->post('typeofwritting'),
				'pages' => $this->input->post('pages'),
				//'numberofsources' => $this->input->post('numberofsources'),
				'title' => $this->input->post('title'),
				'deadline' => $this->input->post('no_of_days'),
				'delivery_time' => $this->input->post('delivery_time'),
				'message' => $this->input->post('message'),
				'actual_amount' => $this->input->post('actualorder'),
				'discount_per' => $this->input->post('discount_per'),
				'amount' => $this->input->post('order_total'),
				//'received_amount' => $this->input->post('order_total'),
				'paymentstatus' => 'Pending',
				'projectstatus' => 'Pending',
				'order_type' => 'Pending',
				'order_type' => $this->input->post('order_type'),
				'writer_name' => $this->input->post('writer_name'),
				'writer_price' => $this->input->post('writer_price'),
				'created_by' => $this->session->userdata['logged_in']['id'],
				'college_name' => $this->input->post('college_name'),
			);
			//print_r($data);exit;

			$result = $this->order_model->order_insert($data);
			if ($result == TRUE) {
				$this->session->set_flashdata('success', 'Order Added Successfully  !');
				redirect('/Orders/index', 'refresh');
			} else {
				$this->session->set_flashdata('failed', 'Insertion Failed, Order Already exists !');
				redirect('/Orders/index', 'refresh');
			}
		}
	}

	public function payments($id)
	{
		$data['title'] = 'Order Payment Module ';
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->order_model->getById($id);
		if (isset($data['current'][0]['amount'])) {
			$data['amount'] = $data['current'][0]['amount'];
		}
		if (isset($data['current'][0]['received_amount'])) {
			$data['received_amount'] = $data['current'][0]['received_amount'];
		}
		if (isset($data['current'][0]['received_amount'])) {
			$amt   = $data['amount'];
			$r_amt = $data['received_amount'];
			if (isset($data['received_amount']) && !empty($data['received_amount']) && isset($data['amount']) && !empty($data['amount'])) {
				$r_a_new = $amt - $r_amt;
			} else {
				$r_a_new = '0';
			}
			$data['remaining_amount_old'] = $r_a_new;
		}

		if (isset($data['current'][0]['order_id'])) {
			$data['order_id'] = $data['current'][0]['order_id'];
		}
		if (isset($data['current'][0]['id'])) {
			$data['order_row_id'] = $data['current'][0]['id'];
		}
		if (isset($data['current'][0]['payment_details'])) {
			$data['payment_details'] = $data['current'][0]['payment_details'];
		}
		$this->template->load('template', 'orders/payments', $data);
	}

	public function addPayment()
	{
		$this->form_validation->set_rules('paid_amount', 'Paid Amount', 'required');
		if ($this->form_validation->run() == FALSE) {
			if (isset($this->session->userdata['logged_in'])) {
				$this->template->load('template', 'orders/payments');
			} else {
				$this->load->view('login_form');
			}
		} else {
			if (!empty($this->input->post('payment_date'))) {
				$payment_date = $this->input->post('payment_date');
			} else {
				$payment_date = date('l, d F Y h:i A');
			}
			$remaining_amount_old = '0';
			$order_id 				= $this->input->post('order_row_id');
			$current_page 			= $this->input->post('backurl');
			$paid_amount 			= $this->input->post('paid_amount');
			$remaining_amount_old   = $this->input->post('received_amount');

			$new_received_amount = '';
			if (isset($_POST['from_order_list']) && !empty($_POST['from_order_list'])) {
				$received_amount = 0;
				if (!empty($this->input->post('received_amount'))) {
					$received_amount = $this->input->post('received_amount');
				}
				$new_received_amount = $received_amount + $paid_amount;
			} else {
				$new_received_amount   = $remaining_amount_old + $paid_amount;
			}

			$data = array(
				'order_id' 		=> $this->input->post('order_row_id'),
				'paid_amount'   => $this->input->post('paid_amount'),
				'payment_date'  => $payment_date,
				'reference'     => $this->input->post('reference'),
			);

			// pre($data);
			// die();

			$result = $this->order_model->addPayment($data);
			if ($result) {
				$this->order_model->updatePaymentinOrders($order_id, $new_received_amount);

				$this->session->set_flashdata('success', 'Payment Added Successfully  !');
				$current_page = $_SESSION['fullURL'];
				redirect($current_page, 'refresh');
			} else {
				$this->session->set_flashdata('failed', ' Payment Failed !');
				$current_page = $_SESSION['fullURL'];
				redirect($current_page, 'refresh');
			}
		}
	}

	public function deletePayment()
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('id', $_POST['row_order_row_id']);
		$query = $this->db->get();
		$query->row_array();
		$order_data = $query->row_array();

		$new_amt 	= (float)$order_data['received_amount'] - (float)$_POST['row_paid_amount'];

		$this->db->set('received_amount', $new_amt);
		$this->db->where('id', $_POST['row_order_row_id']);
		if ($this->db->update('orders')) {
			$this->db->where('id', $_POST['row_id']);
			$this->db->delete('payment_details');
		}
	}

	public function Emails($uid)
	{
		$data['title'] = 'All Your Orders Details ';
		$uid = $this->uri->segment('3');
		$data['orders'] = $this->order_model->getOrdersByEmail($uid);
		$this->template->load('template', 'orders/order_email', $data);
	}

	public function edit($id)
	{
		$data['title'] = 'Edit Order';
		$id = $this->uri->segment('3');

		$query = $this->db->get_where("orders", array("order_id" => $id));
		$data['current'] = $query->result();
		$id = $data['current'][0]->id;

		if (isset($data['current'][0]->order_id)) :
			$data['id'] = $data['current'][0]->id;
		endif;

		if (isset($data['current'][0]->order_type)) :
			$data['order_type'] = $data['current'][0]->order_type;
		endif;

		if (isset($data['current'][0]->order_id)) :
			$data['order_id'] = $data['current'][0]->order_id;
		endif;

		if (isset($data['current'][0]->uid)) :
			$data['user_id'] = $data['current'][0]->uid;
			$query 			 = $this->db->get_where("employees", array("id" => $data['user_id']));
			$userRecord 	 = $query->result();
			if (isset($userRecord) && !empty($userRecord)) {
				$data['user_name'] = $userRecord[0]->name;
			}

		endif;
		 
		// 		 ansh new update
			if (isset($data['current'][0]->uid)) :
			$data['user_id'] = $data['current'][0]->uid;
			$query 			 = $this->db->get_where("employees", array("id" => $data['user_id']));
			$userRecord 	 = $query->result();
			if (isset($userRecord) && !empty($userRecord)) {
				$data['user_email'] = $userRecord[0]->email;
			}

		endif;

		if (isset($data['current'][0]->uid)) :
			$data['user_id'] = $data['current'][0]->uid;
			$query 			 = $this->db->get_where("employees", array("id" => $data['user_id']));
			$userRecord 	 = $query->result();
			if (isset($userRecord) && !empty($userRecord)) {
				$data['mobile_no'] = $userRecord[0]->mobile_no;
			}

		endif;


		if (isset($data['current'][0]->college_name)) :
			$data['received_amount'] = $data['current'][0]->received_amount;
		endif;
			// 		 ansh ne update end 
		
	
		
		

		
		
		if (isset($data['current'][0]->order_date)) :
			$data['order_date'] = $data['current'][0]->order_date;
		endif;

		if (isset($data['current'][0]->delivery_date)) :
			$data['delivery_date'] = $data['current'][0]->delivery_date;
		endif;

		if (isset($data['current'][0]->delivery_time)) :
			$data['delivery_time'] = $data['current'][0]->delivery_time;
		endif;

		if (isset($data['current'][0]->deadline)) :
			$data['no_of_days'] = $data['current'][0]->deadline;
		endif;

		if (isset($data['current'][0]->services)) :
			$data['service'] = $data['current'][0]->services;

		endif;
		if (isset($data['current'][0]->formatting)) :
			$data['formatting'] = $data['current'][0]->formatting;
		endif;

		if (isset($data['current'][0]->typeofpaper)) :
			$data['typeofpaper'] = $data['current'][0]->typeofpaper;
		endif;

		if (isset($data['current'][0]->typeofwritting)) :
			$data['typeofwritting'] = $data['current'][0]->typeofwritting;
		endif;

		if (isset($data['current'][0]->pages)) :
			$data['page'] = $data['current'][0]->pages;
		endif;

		if (isset($data['current'][0]->numberofsources)) :
			$data['numberofsources'] = $data['current'][0]->numberofsources;

		endif;
		if (isset($data['current'][0]->title)) :
			$data['project_title'] = $data['current'][0]->title;
		endif;

		if (isset($data['current'][0]->deadline)) :
			$data['deadline'] = $data['current'][0]->deadline;
		endif;

		if (isset($data['current'][0]->message)) :
			$data['message'] = $data['current'][0]->message;
		endif;

		if (isset($data['current'][0]->actual_amount)) :
			$data['actual_amount'] = $data['current'][0]->actual_amount;
		endif;

		if (isset($data['current'][0]->discount_per)) :
			$data['discount_per'] = $data['current'][0]->discount_per;
		endif;

		if (isset($data['current'][0]->amount)) :
			$data['amount'] = $data['current'][0]->amount;
		endif;

		if (isset($data['current'][0]->projectstatus)) :
			$data['projectstatus'] = $data['current'][0]->projectstatus;
		endif;

		if (isset($data['current'][0]->paymentstatus)) :
			$data['paymentstatus'] = $data['current'][0]->paymentstatus;
		endif;

		if (isset($data['current'][0]->ordernumber)) :
			$data['ordernumber'] = $data['current'][0]->ordernumber;
		endif;

		if (isset($data['current'][0]->currentdate)) :
			$data['currentdate'] = $data['current'][0]->currentdate;
		endif;

		if (isset($data['current'][0]->assignment_file)) :
			$data['assignment_file'] = $data['current'][0]->assignment_file;
		endif;

		if (isset($data['current'][0]->email_flag)) :
			$data['email_flag'] = $data['current'][0]->email_flag;
		endif;

		if (isset($data['current'][0]->writer_name)) :
			$data['writer_name'] = $data['current'][0]->writer_name;
		endif;

		if (isset($data['current'][0]->writer_deadline)) :
			$data['writer_deadline'] = $data['current'][0]->writer_deadline;
		endif;

		if (isset($data['current'][0]->writer_price)) :
			$data['writer_price'] = $data['current'][0]->writer_price;
		endif;

		if (isset($data['current'][0]->referal)) :
			$data['referal'] = $data['current'][0]->referal;
		endif;

		if (isset($data['current'][0]->college_name)) :
			$data['college_name'] = $data['current'][0]->college_name;
		endif;



		$data['old_id'] = $id;
		$data['categories'] = $this->order_model->getCategories();
		$data['services'] = $this->order_model->getServices();
		$data['typeofpapers'] = $this->order_model->getTypeOfPaper();
		$data['pages'] = $this->order_model->getPagesList();
		$data['timelines'] = $this->order_model->getTimelines();
		$data['formattings'] = $this->order_model->getFormattings();
		$data['typeofwritings'] = $this->order_model->getWtittingTypes();
		$data['countries'] = $this->order_model->getCountries();
		$data['users'] = $this->order_model->getUsersList();
		$data['prefix'] = array('Mr.' => 'Mr.', 'Miss.' => 'Miss.', 'Ms.' => 'Ms.');

		// echo '<pre>'; print_r($data); exit;
		// $this->template->load('template', 'orders/order_edit', $data);
	}

	public function UploadOrderFile()
	{
		$backurl = $this->input->post('backurl');
		$result = $this->order_model->uploadOrderFiles();
		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Order Files Updated Successfully !');
			redirect($backurl, 'refresh');
		} else {
			$this->session->set_flashdata('failed', 'Updation Failed !');
			redirect($backurl, 'refresh');
		}
	}

	// Update Order
	public function editorder($edit_id = '')
	{
		$backurl = $this->input->post('backurl');
		$this->form_validation->set_rules('order_id', 'Order ID', 'required');

		if ($this->form_validation->run() == FALSE) 
		{
			if (isset($this->session->userdata['logged_in']))
			{
				$data['categories'] = $this->order_model->getCategories();
				$this->template->load('template', 'orders/order_add', $data);
			} 
			else
			{
				$this->load->view('login_form');
			}
		} 
		else
		{
			if ($this->input->post('referal') == 'Yes') 
			{
				$query = $this->db->get_where("employees", array("id" => $this->input->post('user_id')));
				$result = $query->result_array();
				$user_email = $result[0]['email'];
				if (!empty($user_email)) 
				{
					$total = 0;
					$query1 = $this->db->get_where("referfriend", array("friendemail" => $user_email));
					$result1 = $query1->result_array();
					$referal_user_email = $result1[0]['uemail'];
					if (!empty($referal_user_email)) 
					{
						$query2 = $this->db->get_where("employees", array("email" => $referal_user_email));
						$result2 = $query2->result_array();
						$referral_amount = $result2[0]['referral_amount'];
						$discount = $this->input->post('order_total') * 5 / 100;
						$total = $referral_amount + $discount;
						$data2['referral_amount'] = $total;
						$this->db->from('employees');
						$this->db->where('email', $referal_user_email);
						$this->db->update('employees', $data2);
					}
				}
			}

			$u_id = $this->input->post('u_id');
			$query = $this->db->get_where("employees", array("id" => $u_id));
			$result = $query->result_array();
			$id=$result[0]['id'];
			$update = array
			(
				'email' => $this->input->post('u_email'),
				'mobile_no'=> $this->input->post('u_mobile_no')
			);
			// echo '<pre>'; print_r($update); exit;
			$this->db->where('id',$id);
			$this->db->update('employees', $update);
			// end new code by ansh


			$data = array
			(
				'order_id' => $this->input->post('order_id'),
				'delivery_date' => date('Y-m-d', strtotime($this->input->post('delivery_date'))),
				'delivery_time' => $this->input->post('delivery_time'),
				'order_date' => date('Y-m-d', strtotime($this->input->post('order_date'))),
				'services' => $this->input->post('typeofservice'),
				'formatting' => $this->input->post('formatting'),
				'typeofpaper' => $this->input->post('typeofpaper'),
				'typeofwritting' => $this->input->post('typeofwritting'),
				'pages' => $this->input->post('pages'),
				'title' => $this->input->post('title'),
				'deadline' => $this->input->post('no_of_days'),
				'message' => $this->input->post('message'),
				'actual_amount' => $this->input->post('actualorder'),
				'discount_per' => $this->input->post('discount_per'),
				'amount' => $this->input->post('order_total'),
				'paymentstatus' => $this->input->post('paymentstatus'),
				'projectstatus' => $this->input->post('projectstatus'),
				'order_type' => $this->input->post('order_type'),
				'writer_name' => $this->input->post('writer_name'),
				'writer_deadline' => date('Y-m-d', strtotime($this->input->post('writer_deadline'))),
				'writer_price' => $this->input->post('writer_price'),
				'referal' => @$this->input->post('referal'),
				'edited_by' => $this->session->userdata['logged_in']['id'],
				'college_name' => $this->input->post('college_name'),
				// 'received_amount' => $this->input->post('received_amount'),
				'flag' => '0',
			);
			if (!empty($this->input->post('user_id')) && $this->input->post('user_id') != '') 
			{
				$data['uid'] = $this->input->post('user_id');
			}
			$old_id = $this->input->post('edit_id');
			$result = $this->order_model->editOrder($data, $old_id);
        	$due =  $this->input->post('due_amount');
            if ( $data['projectstatus'] == 'Completed' AND $due != '0' )
			{

	                         
				$due =  $this->input->post('due_amount');
				$email_to = $this->input->post('u_email') ;
				$name = $this->input->post('u_name');
				$title = $data['title'];
				$oid = $data['order_id'];
				$subject = $oid;
				// $name = $result[0]['name'];
				//  print_r	($due); exit;
			
				$body = "<div style='font-family: Verdana !important;'>
							<p><br/> Hi <b>$name</b>,<br/>
							Greetings of the day. Hope you are doing well.<br/><br/> 
                     
							This email is regarding the current assignment <b> $title </b>, order code<b> $oid </b>, is ready.<br/><br/>
							
							You can proceed with the balance payment of<b> £  $due </b>in order to deliver the work.<br/>	<br/>		
                             
							We will be waiting for your reply. <br/>
							Thanks & Regards,<br/>
							Assignnmentinneed.com<br/>
							Email: order@assignnmentinneed.com<br/>
							Whatsapp No: +44 7459420438<br/>
									+44  7826233106
						
							</p>
						</div>";
					// Email Code Start
					
					$config = array(
						'protocol' => 'smtp',
						'smtp_host' => 'smtp.gmail.com',
						'smtp_port' => 587,
						'smtp_user' => 'anshsuthar03@gmail.com', // change it to yours
						'smtp_pass' => 'krss11@@', // change it to yours
						'mailtype' => 'html',
						'smtp_crypto' => 'tls',
						'charset' => 'iso-8859-1',
						'wordwrap' => TRUE
					);

					$this->load->library('email');
					$this->email->set_newline("\r\n");
					$this->email->set_mailtype("html");
					$this->email->to($email_to);
					$this->email->bcc('order24assignment@gmail.com');
					$this->email->from('order@assignnmentinneed.com', "Assignment In Need(Completed)");
					$this->email->subject($subject);
					$this->email->message($body);
                    
                    
		
					if ($this->email->send())
					{
					$this->session->set_flashdata('success', 'Mail send & Order Updated Successfully !');
					$current_page = $_SESSION['fullURL'];
					redirect($current_page, 'refresh');
					}
		
					else
					{
						$this->session->set_flashdata('success', 'Order Updated Successfully !');
						$this->session->set_flashdata('failed', 'Mail Not Send Please Try Again !');
						$current_page = $_SESSION['fullURL'];
						redirect($current_page, 'refresh');
					}
			}

			elseif($data['projectstatus'] == 'Delivered')
			{
				$this->db->select('completed_orders.*');
				$this->db->where('completed_orders.order_id', $old_id);
				$images_query = $this->db->get('completed_orders')->result_array();

				$name = $this->input->post('u_name');
				$oid = $data['order_id'];
				$subject = $oid;
				$email_to = $this->input->post('u_email');


				$body = "<div style='font-family: Verdana !important;'>
				<img src='http://localhost:8080/wm_admin/uploads_old/assignmentinneed.png' style='width:100px; height:100px; margin:auto;'>
				
				<p> Hi <b>$name</b>,<br/>

				Greetings of the day!.<br/><br/> 

				Kindly find the attachment and let us know.<br/>

				If you need any changes in the work, kindly send feedback with the same order code. We will render you the best solution possible.<br/>	<br/>		

				We are always here to help you.<br/>
				
				Thanks & Regards,<br/>
				Assignnmentinneed.com<br/>
				Email: order@assignnmentinneed.com<br/>
				Whatsapp No: +44 7459420438<br/>
							 +44 7826233106
			
				</p>
				</div>";

				$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'smtp.gmail.com',
				'smtp_port' => 587,
				'smtp_user' => 'rohitkumarjoshi43@gmail.com', // change it to yours
				'smtp_pass' => '7737581643yogita', // change it to yours
				'mailtype' => 'html',
				'smtp_crypto' => 'tls',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
				);
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->set_mailtype("html");
				$this->email->to($email_to);
				$this->email->bcc('order@assignnmentinneed.com');
				$this->email->from('order@assignnmentinneed.com', "Completed");
				$this->email->subject($subject);
				$this->email->message($body);
				if (!empty($images_query)) 
				{
					foreach ($images_query as  $file_details)
					{
						
						$this->email->attach($file_details['file_path']);
					}
				}
				// echo '<pre>'; print_r($body); exit;
				
			}
			else
			{
				if ($result == TRUE) 
				{
					$this->session->set_flashdata('success', 'Order Updated Successfully !');
					$current_page = $_SESSION['fullURL'];
					redirect($current_page, 'refresh');
				} 
				else 
				{
					$this->session->set_flashdata('failed', 'Update Failed !');
					$current_page = $_SESSION['fullURL'];
					redirect($current_page, 'refresh');
				}
			}

		}
	}

	public function print($id)
	{
		$id = $this->uri->segment('3');
		$data['current'] = $this->order_model->getById($id);
		if (isset($data['current']['customer_code']) && $data['current']['customer_code']) :
			$data['c_code'] = $data['current']['customer_code'];
			$voucher_no = $data['c_code'];
			if ($voucher_no < 10) {
				$order_id_view = 'CUS000' . $voucher_no;
			} else if (($voucher_no >= 10) && ($voucher_no <= 99)) {
				$order_id_view = 'CUS00' . $voucher_no;
			} else if (($voucher_no >= 100) && ($voucher_no <= 999)) {
				$order_id_view = 'CUS0' . $voucher_no;
			} else {
				$order_id_view = 'CUS' . $voucher_no;
			}
			$data['customer_code'] = $order_id_view;
		else :
			$data['customer_code'] = '';
		endif;
		$data['title'] = 'Order Invoice';
		$this->template->load('template', 'orders/print_order', $data);
	}

	public function sendMail($id = null)
	{
		$body = '';
		$ids = $this->input->post('ids');

		if (!empty($ids)) {
			$result = $this->order_model->getByIdnew($ids);
			$body .= '<style>.border_ap{ border: 1px solid #9c9898;}</style>
						<div style="font-family: Verdana;">
							Hi,<br/> <br/>
							Greetings of the day! We hope you are doing well.<br><br/>
							Thanks for placing the order at Assignment In Need.<br/> <br/> We have attached the quotation for the assignments given by you. Kindly have a look. <br/><br/>
							<table style="border-collapse: collapse;"><thead>
								<tr style="background: #9fc59e85;">
									<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> Sr No.</th>
									<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> Order Type </th>
									<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> Order code </th>
									<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> Title</th>
									<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> Word Limit</th>
									<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> Time Period</th>
									<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> Amount (£) </th>
								</tr>
							</thead>
						<tbody>';
			$z = 0;
			$total = 0;
			foreach ($result as $key => $value) {
				$email_to =	$value['c_email'];
				$pass = explode('@', $email_to);
		(float)$total += (float)$value['amount'];
				$body .= '<tr>
							<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">' . ++$z . '</td>
							<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">' . $value['typeofpaper'] . '</td>
							<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">' . $value['order_id'] . '</td>
							<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">' . $value['title'] . '</td>
							<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">' . $value['pages'] . '</td>
							<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">' . $value['deadline'] . ' days</td>
		
							<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">' . $value['amount'] . '</td>
						</tr>';
			}
			$body .= '<tr>
						<td colspan="6" align="right" style="border: 1px solid #dddddd;padding: 8px;">Total</td>
						<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> £ ' .$total . ' </td>
					</tr>';
			$body .= '</tbody></table> <br><br/>
					In order to confirm the order kindly make the partial payment so we can start working on the assignments. The bank details are as follows: <br/><br/>
					<table style="border-collapse: collapse;">
					<tr>
					<td style="background: #9fc59e85;border: 1px solid #dddddd;text-align: left;padding: 8px;" class="border_ap">Bank Name:</td>
					<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> Wise</td>
					</tr>
					<tr>
					<td style="background: #9fc59e85;border: 1px solid #dddddd;text-align: left;padding: 8px;" class="border_ap">Account Holder:</td>
					<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> ' . $value['account_holder'] . '</td>
					</tr>
					<tr>
					<td style="background: #9fc59e85;border: 1px solid #dddddd;text-align: left;padding: 8px;">Account Number:</td> 
					<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">' . $value['account_number'] . '</td>
					</tr>
					<tr>
					<td style="background: #9fc59e85;border: 1px solid #dddddd;text-align: left;padding: 8px;" class="border_ap">Sort Code:</td> 
					<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">' . $value['sort_code'] . '</td>
					</tr>
					</table>
					<br/><br/>
					In case, you have any concern, please do let us know.<br/><br/>
					<div style="border: 1px solid #ccc;padding: 20px;">
					Your log in details are as follows <a href="https://www.assignnmentinneed.com/admin" target="_blank">(link)</a><br/><br/>
					<b> User name: </b> ' . $email_to . '<br/><br/>
					<b> Password: </b>  user@123(unless you change the password)
					</div>
					<br/><br/>
					We will look forward to getting your reply.<br/><br/>
					Thanks & Regards,<br/>
					Assignnmentinneed.com<br/>
					Email: order@assignnmentinneed.com<br/>
					Whatsapp No: +447459420438<br/>
					Contact no: +447520626128  <br/> 
				</div>';


			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'smtp.gmail.com',
				'smtp_port' => 587,
				'smtp_user' => 'rohitkumarjoshi43@gmail.com', // change it to yours
				'smtp_pass' => '7737581643yogita', // change it to yours
				'mailtype' => 'html',
				'smtp_crypto' => 'tls',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
			);
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->set_mailtype("html");
			$this->email->to($email_to);
			$this->email->bcc('order24assignment@gmail.com');
			$this->email->from('order@assignnmentinneed.com', "Quotation");
			$this->email->subject('Order Details From Assignment In Need');
			$this->email->message($body);
			if ($this->email->send()) {
				echo $this->session->set_flashdata('success', 'All selected Order Details are  Successfully sent on user email !');
				$upData = array();
				$upData['quotation_status'] = 1;
				$this->db->where('id', $_POST['ids']);
				$this->db->update('orders', $upData);
				redirect('/Orders/index', 'refresh');
				// redirect($this->uri->uri_string('/Orders/index', 'refresh'));
			} else {
				echo $this->session->set_flashdata('failed', 'Email sending failed ! Please Try again');
				redirect('/Orders/Emails/11', 'refresh');
			}
		}
	}

	public function duplicate($id = null)
	{

		$query = $this->db->get_where("orders", array("id" => $id));
		$result = $query->result_array();
		$data = $result[0];
		unset($data['id']);
		$order_ids = $this->order_model->getOrderId();
		$data['order_id'] = 'UKS' . $order_ids;
		$result = $this->order_model->duplicate_order_insert($data);
		redirect('/Orders/index', 'refresh');
	}

	public function deleteorder($id = null)
	{
		$ids = $this->input->post('ids');
		if (!empty($ids)) {
			$Datas = explode(',', $ids);
			foreach ($Datas as $key => $id) {
				$this->order_model->deleteorder($id);
			}
			echo $this->session->set_flashdata('success', 'Order deleted Successfully !');
			redirect('/Orders/index', 'refresh');
		} else {

			$id = $this->uri->segment('3');
			$this->order_model->deleteorder($id);
			$this->session->set_flashdata('success', 'Order deleted Successfully !');
			redirect('/Orders/index', 'refresh');
			//$this->fetchcustomers(); //render the refreshed list.
		}
	}

	public function deleteorderFile($id = null)
	{
		$id = $this->uri->segment('3');
		$this->order_model->deleteorderFile($id);
		$this->session->set_flashdata('success', 'Order File deleted Successfully !');
		redirect('/Orders/index', 'refresh');
	}

	public function deleteCompletedFile($id = null)
	{
		$id = $this->uri->segment('3');
		$this->order_model->deleteCompletedFile($id);
		$this->session->set_flashdata('success', 'Order File deleted Successfully !');
		redirect('/Orders/index', 'refresh');
	}

	public function ordersCSV()
	{
		$filename = 'orders-data-' . date('Y-m-d') . '.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/csv; ");

		$expenses_data = $this->order_model->create_csv();

		$file = fopen('php://output', 'w');

		$header = array(
			"id",
			"uid",
			"order_id",
			"lead_id",
			"order_date",
			"u_email",
			"uname",
			"services",
			"formatting",
			"typeofpaper",
			"typeofwritting",
			"pages",
			"title",
			"deadline",
			"delivery_date",
			"delivery_time",
			"message",
			"status",
			"actual_amount",
			"discount_per",
			"amount",
			"received_amount",
			"ordernumber",
			"currentdate",
			"paymentstatus",
			"projectstatus",
			"completed_date",
			"completed_on",
			"completed_comment",
			"assignment_file",
			"writer_name",
			"writer_price",
			"quotation_status",
			"email_flag",
			"order_type",
			"created_by",
			"created_on",
			"edited_by",
			"edited_on",
			"flag",
			"is_read",
			"writer_deadline_old",
			"referal",
			"writer_deadline",
			"college_name",
			"is_fail",
		);

		fputcsv($file, $header);
		foreach ($expenses_data as $key => $line) {
			$line['order_file_details'] = null;
			fputcsv($file, $line);
		}
		fclose($file);
		exit;
	}

	function createXLS()
	{
		// load excel library
		$this->load->library('excel');

		$fileName = 'order-report-' . date('d-M-Y') . '.xlsx';

		if ($this->input->post()) {
			$conditions['customer_id'] = $this->input->post('customer_id');
			$conditions['from_date'] = date('Y-m-d', strtotime($this->input->post('from_date')));
			$conditions['upto_date'] = date('Y-m-d', strtotime($this->input->post('upto_date')));
			$empInfo = $this->order_model->order_list_by_filter($conditions);
		} else {
			$empInfo = $this->order_model->export_csv();
		}
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Order Date');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Order Id');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Email');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Mobile No');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Order Type');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Project Title');
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Type Of Services');
		$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Formatting');
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Type Of Paper');
		$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Type Of Writtig');
		$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'pages');
		$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Number Of Sources');
		$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Deadline');
		$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Actual Amount');
		$objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Discount %');
		$objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Final Amount');
		$objPHPExcel->getActiveSheet()->SetCellValue('R1', 'Project Status');
		$objPHPExcel->getActiveSheet()->SetCellValue('S1', 'Payment Status');

		// set Row
		$rowCount = 2;
		foreach ($empInfo as $element) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['c_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['order_date']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['order_id']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['c_email']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, '+' . $element['countrycode'] . '-' . $element['c_mobile']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['order_type']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['title']);
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['services']);
			$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['formatting']);
			$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element['typeofpaper']);
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element['typeofwritting']);
			$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element['pages']);
			$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $element['numberofsources']);
			$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $element['deadline']);
			$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $element['actual_amount']);
			$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $element['discount_per']);
			$objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $element['amount']);
			$objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $element['projectstatus']);
			$objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $element['paymentstatus']);

			$rowCount++;
		}
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="orderData.xls"');
		$objWriter->save('php://output');
		redirect('/Orders/index', 'refresh');
	}

	public function FindStateCodeById($id)
	{
		$data = array();
		$data['state_code'] = $this->order_model->FindStateCodeById($id);
		return $data['state_code'];
	}

	public function getcustomerById($id)
	{
		$data = array();
		$data['customers_data'] = $this->order_model->getcustomerById($id);
		//print_r($data['customers_data']);exit;
		echo json_encode($this->load->view('supplierbycategory', $data));
	}

	public function UploadOrder($id = null)
	{
		$data['title'] = 'Upload Order Panel ';
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->order_model->getById($id);
		if (isset($data['current'][0]['id'])) {
			$data['id'] = $data['current'][0]['id'];
			$data['projectstatus'] = $data['current'][0]['projectstatus'];
			$data['c_email'] = $data['current'][0]['c_email'];
		}
		if (isset($data['current'][0]['completed_orders'])) {
			$data['completed_orders'] = $data['current'][0]['completed_orders'];
		}

		$data['order_id'] = $data['current']['0']['order_id'];
		$this->template->load('template', 'upload_order', $data);
	}

	public function EditOrderFile($id = null)
	{
		$data['title'] = 'Upload Order File ';
		$id = $this->uri->segment('3');
		$data['current'] = $this->order_model->getOrderImages($id);
		$news = $this->order_model->getByIdnew($id);
		$data['order_type'] = $news[0]['order_type'];
		$data['detail_id'] = $id;
		$data['order_id'] = $news[0]['order_id'];
		$this->template->load('template', 'orders/file_upload_order', $data);
	}

	public function ActionOrder($id = null)
	{
		$old_id = $this->input->post('order_id');
		$status = $this->input->post('status');
		$backurl = $this->input->post('backurl');
		$email_to = $this->input->post('c_email');
		$pass =	explode('@', $email_to);
		/* print_r($_FILES);
			echo "<pre>";
			print_r($_POST);
			echo "</pre>";exit;
		*/
		//	if($status=='Completed'){

		$body = "<div style='font-family: Verdana !important;'>Hi, <br/><br/>
			Greetings of the day! We hope you are doing well. <br/><br/>
			
			Kindly find the attachment.<br/>
			And, let us know, if you need any changes in the work, we are always here to help you. 
			Please, try to send the feedback in the same <b>order code </b> given for prompt response and easy process. You can also check your portal for further details.
			<br/><br/>
			<div style='border: 1px solid #ccc;padding: 20px;'>
			Your log in details is as follows: For log in <a href='https://www.assignnmentinneed.com/terms/' target='_blank'>(Click here)</a><br/><br/>
			
			<b>User name:</b> <span> <a href=''>" . $email_to . " </a> </span> <br/><br/>
			<b> Password: </b> <span> <a  href=''> " . $pass[0] . "@123 </a> </span> (unless you change the password)
			</div>
			<br/><br/> 
			We are always here to help you.<br/><br/>
			Thanks & Regards,<br/>
			Assignnmentinneed.com<br/>
			Email: order@assignnmentinneed.com<br/>
			Whatsapp No: +447459420438<br/>
			Contact no: +447441430251   </div>";


		$data = array(
			'projectstatus' => $status,
			'completed_date' => $this->input->post('approved_date'),
			'completed_on' => date('Y-m-d H:i:s'),
			'completed_comment' => $this->input->post('completed_comment')
		);
		//print_r($order_id);exit;
		$result = $this->order_model->actionOrder($data, $old_id);

		// Email Code Start

		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_port' => 587,
			'smtp_user' => 'rohitkumarjoshi43@gmail.com', // change it to yours
			'smtp_pass' => '7737581643yogita', // change it to yours
			'mailtype' => 'html',
			'smtp_crypto' => 'tls',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);


		$this->load->library('email');
		//$this->load->helper('string');
		//$this->email->initialize($config);

		//$email_to="rohitkumarjoshi43@gmail.com";

		$this->email->set_newline("\r\n");
		$this->email->set_mailtype("html");
		$this->email->to($email_to);
		//$this->email->to('rohitkumarjoshi43@gmail.com');
		$this->email->bcc('order@assignnmentinneed.com');
		$this->email->from('order@assignnmentinneed.com', "Quotation");
		$this->email->subject('Upload order files');
		$this->email->message($body);
		foreach ($result[1] as $image) {
			$this->email->attach('https://assignnmentinneed.com/terms/uploads/' . $image . '');
		}



		if ($this->email->send()) {
			//echo "email sent";
			//redirect('/Orders/index', 'refresh');
		} else {
			//echo "email is not sent";
			//show_error($this->email->print_debugger());
		}



		if ($result[0] == TRUE) {
			$this->session->set_flashdata('success', 'Order Completed successfully !');
			redirect($backurl, 'refresh');
			//$this->template->load('template','supplier_view');
		} else {
			$this->session->set_flashdata('failed', 'Operation Failed !');
			redirect($backurl, 'refresh');
			//$this->template->load('template','supplier_view');
		}
		//	}

	}

	public function CheckcustomerCode($customer_code)
	{
		$isExist = $this->order_model->CheckCustomerCode($customer_code);
		if (!empty($isExist)) {
			echo json_encode($isExist);
		}
	}

	public function failedJobs($id = NULL)
	{
		$this->load->model('master_model');
		$data = array();

		$this->load->library("pagination");
		$config = array();
		$config["base_url"] = base_url() . "Orders/failedJobs";
		$where = array('is_fail' => '1');
		$config["total_rows"] = $this->master_model->getTotalCount('orders', 'is_fail', '', $where);
		$config["per_page"] = 10;
		$config["uri_segment"] = 3;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$config['next_tag_open'] = '<li class="pg-next">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="pg-prev">';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$page          = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["links"] = $this->pagination->create_links();

		$data['title'] = 'Failed Jobs List';

		$conditions = array();
		$conditions['limit'] = $config["per_page"];
		$conditions['start'] = $page;
		if ($this->input->get()) {
			if (!empty($this->input->get('from_date'))) {
				$conditions['from_date']   = date('Y-m-d', strtotime($this->input->get('from_date')));
			} else {
				$conditions['from_date']   = '';
			}
			if (!empty($this->input->get('upto_date'))) {
				$conditions['upto_date']   = date('Y-m-d', strtotime($this->input->get('upto_date')));
			} else {
				$conditions['upto_date']   = '';
			}
			if (!empty($this->input->get('writer_name'))) {
				$conditions['writer_name'] = $this->input->get('writer_name');
			} else {
				$conditions['writer_name'] = '';
			}
			if (!empty($this->input->get('d_from_date'))) {
				$conditions['d_from_date']   = date('Y-m-d', strtotime($this->input->get('d_from_date')));
			} else {
				$conditions['d_from_date']   = '';
			}
			if (!empty($this->input->get('d_upto_date'))) {
				$conditions['d_upto_date']   = date('Y-m-d', strtotime($this->input->get('d_upto_date')));
			} else {
				$conditions['d_upto_date']   = '';
			}
		} else {
			$conditions['from_date']  = '';
			$conditions['upto_date']   = '';
			$conditions['writer_name'] = '';
		}

		$data['conditions'] = $conditions;
		$data['datalists']  = $this->master_model->failedJobList($conditions);
		$this->template->load('template', 'master/failjobs', $data);
	}

	public function markAsFailed()
	{
		$data = array();
		$data['is_fail'] = '1';
		$this->db->set('is_fail', '1');
		$this->db->where('id', $_POST['row_id']);
		$this->db->update('orders', $data);
		return true;
		die();
	}
}

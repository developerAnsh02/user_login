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
		$this->load->model('Employee');
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
		$config["base_url"]   		 = base_url() . "Orders/index";
		$config["total_rows"] 		 = $this->order_model->TotalOrders();
		$config["per_page"]			 = 10;
		$config["uri_segment"]  	 = 3;
		$data['Total_order'] 		 = $this->order_model->TotalOrders();
		$config['num_tag_open']		 = '<li>';
		$config['num_tag_close']	 = '</li>';
		$config['cur_tag_open'] 	 = '<li class="active"><a href="javascript:void(0);">';
		$config['cur_tag_close'] 	 = '</a></li>';
		$config['next_link'] 		 = 'Next';
		$config['prev_link'] 		 = 'Prev';
		$config['next_tag_open'] 	 = '<li class="pg-next">';
		$config['next_tag_close'] 	 = '</li>';
		$config['prev_tag_open']	 = '<li class="pg-prev">';
		$config['prev_tag_close']	 = '</li>';
		$config['first_tag_open']	 = '<li>';
		$config['first_tag_close']	 = '</li>';
		$config['last_tag_open']	 = '<li>';
		$config['last_tag_close'] 	 = '</li>';
	
		$this->pagination->initialize($config);
	
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	
		$data["links"] 	 = $this->pagination->create_links();
		$role_id 		 = $this->session->userdata('logged_in')['role_id'];
		$login_id		 = $this->session->userdata('logged_in')['id'];
		$data['title']	 = 'Orders List';
	
		$data['all_customers'] = $this->order_model->getAllCustomers();
		$data['OrderIDs'] 	   = $this->order_model->getOrderIDs();
		$data['getOrderIDsw']  = $this->order_model->getOrderIDsw();
		$customer_id = $this->input->get('customer_id');

	
		if ($this->input->get()) {
		    if($role_id == 1 || $role_id == 2|| $role_id == 3|| $role_id == 4 ||$role_id == 5){
			    if ($this->input->get('notify') == "yes") {
				$this->order_model->feedback__notify_update();
    			}
    			$conditions['per_page'] 		 = $config["per_page"];
    			$conditions['page']				 = $page;
    			$conditions['status']			 = $this->input->get('status');
    			$conditions['customer_id']  	 = $this->input->get('customer_id');
    			$conditions['wid'] 				 = $this->input->get('wid');
    			$conditions['order_id'] 		 = $this->input->get('order_id');
    			$conditions['title'] 		     = $this->input->get('title');
    			$conditions['filter_check']      = $this->input->get('filter_check');
    			$conditions['writer_name']       = $this->input->get('writer_name');
    			$conditions['order_date_filter'] = $this->input->get('order_date_filter');
    			$conditions['from_date'] 		 = date('Y-m-d', strtotime($this->input->get('from_date')));
    			$conditions['upto_date'] 		 = date('Y-m-d', strtotime($this->input->get('upto_date')));
    			$data['from_date'] 				 = $this->input->get('from_date');
    			$data['upto_date'] 				 = $this->input->get('upto_date');
    			$data['customer_id'] 			 = $this->input->get('customer_id');
    			$data['wid']					 = $this->input->get('wid');
    			$data['orders']					 = $this->order_model->order_list_by_filter($conditions);
    			}
    			else
    			{
    				$conditions['per_page'] 			= $config["per_page"];
    				$conditions['page'] 	    		= $page;
    				$conditions['status']	    		= $this->input->get('status');
    				$conditions['swid']					= $this->input->get('swid');
    				$conditions['order_id'] 			= $this->input->get('order_id');
    				$conditions['order_date_filter'] 	= $this->input->get('order_date_filter');
    				$conditions['from_date'] 			= date('Y-m-d', strtotime($this->input->get('from_date')));
    				$conditions['upto_date'] 			= date('Y-m-d', strtotime($this->input->get('upto_date')));
    				$data['from_date'] 					= $this->input->get('from_date');
    				$data['upto_date'] 					= $this->input->get('upto_date');
    				$data['orders'] 					= $this->order_model->order_list_by_filter_writer($conditions);
    			}
		} else {
			$online_order = 0;
			if ($role_id == 2) {
				$data['orders']		= $this->order_model->order_listnew($login_id, $config["per_page"], $page, $online_order);
				$data['leads'] 		= $this->order_model->order_listnews($login_id, $config["per_page"], $page, $online_order);
			} elseif ($role_id == 6) {
				$data['orders'] 	= $this->order_model->writer_data($login_id, $config["per_page"], $page, $online_order);
			} elseif ($role_id == 7) {
				$data['orders']		= $this->order_model->sub_writer_data($login_id, $config["per_page"], $page, $online_order);
			} elseif ($role_id == 8) {
				$data['orders']		= $this->order_model->admin_writer_data($login_id, $config["per_page"], $page, $online_order);
			} 
			else {
				$data['orders'] 	= $this->order_model->order_listnew(null, $config["per_page"], $page, $online_order);
			}
		}
		$login_id = $this->session->userdata['logged_in']['id'];
		// Load other data needed for the view
	
		$data['o_counts'] 		= count($data['orders']);
		$data['writerTL'] 		= $this->Employee->getWriters();
		$data['subwrtier']	 	= $this->Employee->getsubWritersfortl($login_id);
		$data['customer_id'] 	= $customer_id;

		// echo '<pre>'; print_r($data); exit;
	
		$this->template->load('template', 'orders/order_view', $data);
	}

	public function online_orders()
	{
		$online_order = 1;

		$this->load->library("pagination");
		$config = array();
		$config["base_url"] 		 = base_url() . "Orders/online_orders";
		$config["total_rows"] 		 = $this->order_model->TotalOrders($online_order);
		$config["per_page"] 		 = 10;
		$config["uri_segment"]		 = 3;
		$data['Total_order']		 = $this->order_model->TotalOrders($online_order);
		$config['num_tag_open']  	 = '<li>';
		$config['num_tag_close']	 = '</li>';
		$config['cur_tag_open'] 	 = '<li class="active"><a href="javascript:void(0);">';
		$config['cur_tag_close'] 	 = '</a></li>';
		$config['next_link']	     = 'Next';
		$config['prev_link'] 		 = 'Prev';
		$config['next_tag_open'] 	 = '<li class="pg-next">';
		$config['next_tag_close']	 = '</li>';
		$config['prev_tag_open'] 	 = '<li class="pg-prev">';
		$config['prev_tag_close'] 	 = '</li>';
		$config['first_tag_open'] 	 = '<li>';
		$config['first_tag_close']	 = '</li>';
		$config['last_tag_open'] 	 = '<li>';
		$config['last_tag_close']	 = '</li>';

		$this->pagination->initialize($config);

		$page 					 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["links"] 	   		 = $this->pagination->create_links();
		$role_id				 = $this->session->userdata['logged_in']['role_id'];
		$login_id 				 = $this->session->userdata['logged_in']['id'];
		$data['title']			 = 'Orders List';
		$data['all_customers'] 	 = $this->order_model->getAllCustomers();
		$data['OrderIDs'] 		 = $this->order_model->getOrderIDs();


		if ($this->input->get()) {
			if ($this->input->get('notify') == "yes") {
				$this->order_model->feedback__notify_update();
			}
			$conditions['per_page'] 			 = $config["per_page"];
			$conditions['page'] 				 = $page;
			$conditions['status']				 = $this->input->get('status');
			$conditions['customer_id'] 			 = $this->input->get('customer_id');
			$conditions['order_id'] 			 = $this->input->get('order_id');
			$conditions['title'] 				 = $this->input->get('title');
			$conditions['filter_check'] 		 = $this->input->get('filter_check');
			$conditions['order_date_filter']	 = $this->input->get('order_date_filter');
			$conditions['from_date'] 			 = date('Y-m-d', strtotime($this->input->get('from_date')));
			$conditions['upto_date']			 = date('Y-m-d', strtotime($this->input->get('upto_date')));
			$data['from_date'] 					 = $this->input->get('from_date');
			$data['upto_date']                   = $this->input->get('upto_date');
			$conditions['online_order'] 		 = 1;
			$data['orders'] 					 = $this->order_model->order_list_by_filter($conditions);
		} else {
			$online_order = 1;
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
		$this->template->load('template', 'orders/order_view', $data);
	}

	public function report()
	{
		$data['title']					 = 'Orders Report';
		$data['all_customers']			 = $this->order_model->getAllCustomers();
		if ($this->input->get()) {
			$conditions['customer_id']	 = $this->input->get('customer_id');
			$conditions['from_date']	 = date('Y-m-d', strtotime($this->input->get('from_date')));
			$conditions['upto_date']	 = date('Y-m-d', strtotime($this->input->get('upto_date')));
			$data['conditions']			 = $conditions;
			$data['orders'] 			 = $this->order_model->order_list_by_filter($conditions);
		} else {
			$data['orders'] 			 = $this->order_model->order_list();
		}
		$this->template->load('template', 'order_report', $data);
	}

	public function add_new_order()
	{
		$this->form_validation->set_rules('user_id', 'User Name', 'required');

		if ($this->form_validation->run() == FALSE) {
			if (isset($this->session->userdata['logged_in'])) {
				$data['categories'] = $this->order_model->getCategories();
				$this->template->load('template', 'orders/order_add', $data);
			} else {
				$this->load->view('login_form');
			}
		} else {

			$data = array(
				'uid'			 => $this->input->post('user_id'),
				'order_id'		 => $this->input->post('order_id'),
				'delivery_date'  => date('Y-m-d', strtotime($this->input->post('delivery_date'))),
				'order_date'	 => date('Y-m-d', strtotime($this->input->post('order_date'))),
				'services'		 => $this->input->post('typeofservice'),
				'formatting' 	 => $this->input->post('formatting'),
				'typeofpaper' 	 => $this->input->post('typeofpaper'),
				'typeofwritting' => $this->input->post('typeofwritting'),
				'pages'			 => $this->input->post('pages'),
				'title'			 => $this->input->post('title'),
				'deadline'		 => $this->input->post('no_of_days'),
				'delivery_time'  => $this->input->post('delivery_time'),
				'message'		 => $this->input->post('message'),
				'actual_amount'  => $this->input->post('actualorder'),
				'discount_per'   => $this->input->post('discount_per'),
				'amount' 		 => $this->input->post('order_total'),
				'paymentstatus'  => 'Pending',
				'projectstatus'  => 'Pending',
				'order_type' 	 => 'Pending',
				'order_type' 	 => $this->input->post('order_type'),
				'writer_name' 	 => $this->input->post('writer_name'),
				'writer_price'	 => $this->input->post('writer_price'),
				'created_by'	 => $this->session->userdata['logged_in']['id'],
				'college_name'   => $this->input->post('college_name'),
			);

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
	
	public function user_add_new_order()
    {
        $this->form_validation->set_rules('user_id', 'User Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            if (isset($this->session->userdata['logged_in'])) {
                $data['categories'] = $this->order_model->getCategories();
                $this->template->load('template', 'orders/order_add', $data);
            } else {
                $this->load->view('login_form');
            }
        } else {
            $query = $this->db->get_where("employees", array("id" => $this->input->post('user_id')));
            $result = $query->row_array();

            $data = array(
                'emp_id' 		 => $this->input->post('user_id'),
                'order_id' 		 => $this->input->post('order_id'),
                'deadline' 		 => date('Y-m-d', strtotime($this->input->post('delivery_date'))),
                'create_at' 	 => date('Y-m-d', strtotime($this->input->post('order_date'))),
                'mobile' 		 => $result['mobile_no'],
                'email' 		 => $result['email'],
                'countrycode'    => $result['countrycode'],
                'user_name' 	 => $result['username'],
                'message'		 => $this->input->post('message'),
            );

            $result = $this->db->insert('leads', $data);
            if ($result) {
                $lead_id = $this->db->insert_id();

                $target_dir	 = 'uploads/';
                $total		 = count($_FILES['bill_image']['tmp_name']);
                $detail_id   = $lead_id;

                foreach ($_FILES['bill_image']['name'] as $key => $val) {
                    $rand = rand(11111111, 99999999);
                    $file = $rand . '_' . $val;
                    move_uploaded_file($_FILES['bill_image']['tmp_name'][$key], $target_dir . $file);
                    $filess		 = "https://https://assignnmentinneed.com//upload-your-assignment/uploads/" . $file;
                    $file_data   = array(
                        'u_id'		 => $this->input->post('user_id'),
                        'detail_id'  => $detail_id,
                        'file'		 => $filess
                    );

                    $this->db->insert('files_db', $file_data);
                }

                $this->session->set_flashdata('success', 'Data and files inserted successfully!');
                redirect('/Orders/index', 'refresh');
            } else {
                $this->session->set_flashdata('failed', 'Failed to insert data into leadstable!');
                redirect('/Orders/index', 'refresh');
            }
        }
    }

	public function payments($id)
	{
		$data['title'] 	= 'Order Payment Module ';
		$id 			= $this->uri->segment('3');

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
			$new_received_amount 	= '';


			if (isset($_POST['from_order_list']) && !empty($_POST['from_order_list'])) {
				$received_amount = 0;
				if (!empty($this->input->post('received_amount'))) {
					$received_amount 	= $this->input->post('received_amount');
				}
				$new_received_amount 	= $received_amount + $paid_amount;
			} else {
				$new_received_amount    = $remaining_amount_old + $paid_amount;
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
		$data['title']		 = 'All Your Orders Details ';
		$uid = $this->uri->segment('3');
		$data['orders'] 	 = $this->order_model->getOrdersByEmail($uid);
		$this->template->load('template', 'orders/order_email', $data);
	}

	public function edit($id)
	{
		$data['title'] 	= 'Edit Order';
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
		
		

		if (isset($data['current'][0]->received_amount)) :
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

// 		if (isset($data['current'][0]->chapter)) :
// 			$data['chapter'] = $data['current'][0]->chapter;
// 		endif;

// 		if (isset($data['current'][0]->draftrequired)) :
// 			$data['draftrequired'] = $data['current'][0]->draftrequired;
// 		endif;

// 		if (isset($data['current'][0]->draft_date)) :
// 			$data['draft_date'] = $data['current'][0]->draft_date;
// 		endif;

// 		if (isset($data['current'][0]->draft_time)) :
// 			$data['draft_time'] = $data['current'][0]->draft_time;
// 		endif;
		
			if (isset($data['current'][0]->uid)) :
			$data['user_id'] = $data['current'][0]->uid;
			$query 			 = $this->db->get_where("orders", array("order_id" => $data['order_id']));
			$userRecord 	 = $query->result();
			if (isset($userRecord) && !empty($userRecord)) {
				$data['draftrequired'] = $userRecord[0]->draftrequired;
			}

		endif;
		
			if (isset($data['current'][0]->uid)) :
			$data['user_id'] = $data['current'][0]->uid;
			$query 			 = $this->db->get_where("orders", array("order_id" => $data['order_id']));
			$userRecord 	 = $query->result();
			if (isset($userRecord) && !empty($userRecord)) {
				$data['chapter'] = $userRecord[0]->chapter;
			}

		endif;
		
			if (isset($data['current'][0]->uid)) :
			$data['user_id'] = $data['current'][0]->uid;
			$query 			 = $this->db->get_where("orders", array("order_id" => $data['order_id']));
			$userRecord 	 = $query->result();
			if (isset($userRecord) && !empty($userRecord)) {
				$data['uid'] = $userRecord[0]->uid;
			}

		endif;
		
			if (isset($data['current'][0]->uid)) :
			$data['user_id'] = $data['current'][0]->uid;
			$query 			 = $this->db->get_where("orders", array("order_id" => $data['order_id']));
			$userRecord 	 = $query->result();
			if (isset($userRecord) && !empty($userRecord)) {
				$data['draft_date'] = $userRecord[0]->draft_date;
			}

		endif;
		
			if (isset($data['current'][0]->uid)) :
			$data['user_id'] = $data['current'][0]->uid;
			$query 			 = $this->db->get_where("orders", array("order_id" => $data['order_id']));
			$userRecord 	 = $query->result();
			if (isset($userRecord) && !empty($userRecord)) {
				$data['draft_time'] = $userRecord[0]->draft_time;
			}

		endif;

		if (isset($data['current'][0]->uid)) :
			$data['user_id'] = $data['current'][0]->uid;
			$query 			 = $this->db->get_where("orders", array("order_id" => $data['order_id']));
			$userRecord 	 = $query->result();
			if (isset($userRecord) && !empty($userRecord)) {
				$data['wid'] = $userRecord[0]->wid;
			}

		endif;

		if (isset($data['current'][0]->uid)) :
			$data['user_id'] = $data['current'][0]->uid;
			$query 			 = $this->db->get_where("orders", array("order_id" => $data['order_id']));
			$userRecord 	 = $query->result();
			if (isset($userRecord) && !empty($userRecord)) {
				$data['admin_id'] = $userRecord[0]->admin_id;
			}

		endif;

		


		$data['old_id']				 = $id;
		$data['categories']			 = $this->order_model->getCategories();
		$data['services']			 = $this->order_model->getServices();
		$data['typeofpapers'] 		 = $this->order_model->getTypeOfPaper();
		$data['pages']				 = $this->order_model->getPagesList();
		$data['timelines']			 = $this->order_model->getTimelines();
		$data['formattings']		 = $this->order_model->getFormattings();
		$data['typeofwritings']		 = $this->order_model->getWtittingTypes();
		$data['countries']			 = $this->order_model->getCountries();
		$data['users']				 = $this->order_model->getUsersList();
		$data['writerTL'] 		   	 = $this->Employee->getWriters();
		$data['writerAdmin'] 		 = $this->Employee->getWritersAdmin();
		$data['prefix'] 			 = array('Mr.' => 'Mr.', 'Miss.' => 'Miss.', 'Ms.' => 'Ms.');

		// echo '<pre>'; print_r($data); exit;
		$this->template->load('template', 'orders/order_edit', $data);
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

			$u_id 		= $this->input->post('u_id');
			$query 		= $this->db->get_where("employees", array("id" => $u_id));
			$result 	= $query->result_array();
			$id		    = $result[0]['id'];

			$new_email	= $this->input->post('u_email');

			// Check if the new email already exists in the database
			$email_check_query	 = $this->db->get_where("employees", array("email" => $new_email));
			$email_check_result	 = $email_check_query->result_array();
			$order_id			 = $this->input->post('order_id');

			if (!empty($email_check_result) && $email_check_result[0]['id'] !== $id) {
				// Email already exists and belongs to a different employee
				$this->session->set_flashdata('error', 'Email already exists in the record with diffrent name . Please Use Other Email Thank You.');
				redirect('/Orders/edit/' . $order_id);
			} else {
				$update = array(
					'name' => $this->input->post('u_name'),
					'email' => $new_email,
					'mobile_no' => $this->input->post('u_mobile_no')
				);

				$this->db->where('id', $id);
				$this->db->update('employees', $update);

				// Redirect or perform other actions as needed
			}

			// Redirect to the view page
			 // Replace with your actual route



			$data = array
			(
				'order_id'     		 => $this->input->post('order_id'),
				'delivery_date' 	 => date('Y-m-d', strtotime($this->input->post('delivery_date'))),
				'delivery_time'		 => $this->input->post('delivery_time'),
				'order_date'		 => date('Y-m-d', strtotime($this->input->post('order_date'))),
				'services' 			 => $this->input->post('typeofservice'),
				'formatting' 		 => $this->input->post('formatting'),
				'typeofpaper'		 => $this->input->post('typeofpaper'),
				'typeofwritting' 	 => $this->input->post('typeofwritting'),
				'pages'				 => $this->input->post('pages'),
				'title' 			 => $this->input->post('title'),
				'deadline' 			 => $this->input->post('no_of_days'),
				'message' 		 	 => $this->input->post('message'),
				'actual_amount' 	 => $this->input->post('actualorder'),
				'discount_per' 		 => $this->input->post('discount_per'),
				'amount' 			 => $this->input->post('order_total'),
				'paymentstatus' 	 => $this->input->post('paymentstatus'),
				'projectstatus' 	 => $this->input->post('projectstatus'),
				'order_type' 		 => $this->input->post('order_type'),
				'writer_name'		 => $this->input->post('writer_name'),
				'writer_deadline'	 => date('Y-m-d', strtotime($this->input->post('writer_deadline'))),
				'writer_price'		 => $this->input->post('writer_price'),
				'referal'			 => @$this->input->post('referal'),
				'edited_by'			 => $this->session->userdata['logged_in']['id'],
				'college_name'		 => $this->input->post('college_name'),
				'chapter'			 =>  @$this->input->post('chapter'),
				'draftrequired'		 => $this->input->post('draftrequired'),
				'draft_date'		 => $this->input->post('draft_date'),
				'draft_time'		 => $this->input->post('draft_time'),
				'wid' 				 =>$this->input->post('writer_name_new'),
				'admin_id'			 => $this->input->post('writer_name') === 'team 013' ? 8392 : $this->input->post('writer_new_admin'),
				'flag' => '0',
			);
			if (!empty($this->input->post('user_id')) && $this->input->post('user_id') != '') 
			{
				$data['uid'] = $this->input->post('user_id');
			}
			$old_id = $this->input->post('edit_id');
			$result = $this->order_model->editOrder($data, $old_id);
            $due =  $this->input->post('due_amount');
            
			// echo '<pre>'; print_r($data); exit;
			
            
            
            if ( $data['projectstatus'] == 'Completed'   )
			{

	                         
				$due =  $this->input->post('due_amount');
				$email_to = $this->input->post('u_email') ;
				$name = $this->input->post('u_name');
				$title = $data['title'];
				$oid = $data['order_id'];
				$subject = $oid;
			
				$body = "<div style='font-family: Verdana !important;'>
				            <img src='https://assignnmentinneed.com/user_login/uploads/assignmentinneed.png' style='width:100px; height:100px; '>
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
						'smtp_user' => 'order@assignnmentinneed.com', // change it to yours
						'smtp_pass' => 'jghvstagmtzpqddv', // change it to yours
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

        	public function successmessage()
	{
	
	    
		$email_to = 'nadeansh@gmail.com';
	    $subject = 'UID';
	
	$body = "<div style='font-family: Verdana !important;'>
				<p><br/> Hi,Ansh<br/><br/>

				Greetings of the day. Hope you are doing well.<br/><br/> 

				This email is regarding the current assignment Title name and Order_code is ready.<br/><br/>

				You can proceed with the balance_payment  in order to deliver the work.   <br/><br/>				

				We will be waiting for your reply. <br/><br/>
				
			Thanks & Regards,<br/>
			Your log in details is as follows: For log in <a href='https://www.assignnmentinneed.com/admin/' target='_blank'>(Assignmentinneed)</a><br/><br/><br/>
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
		$this->email->from('order@assignnmentinneed.com', "Success");
		$this->email->subject($subject);
		$this->email->message($body);
		if ($this->email->send())
		{
			$this->session->set_flashdata('success', 'Order Updated Successfully !');
			$current_page = $_SESSION['fullURL'];
			redirect($current_page, 'refresh');
			
		}
		
		else {
		    echo "Failed Send Mail";
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
		$body .= '<html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
			<head>
			<title></title>
			<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
			<meta content="width=device-width, initial-scale=1.0" name="viewport"/><!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]--><!--[if !mso]><!-->
			<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css"/><!--<![endif]-->
			<style>
					* {
						box-sizing: border-box;
					}
			
					body {
						margin: 0;
						padding: 0;
					}
			
					a[x-apple-data-detectors] {
						color: inherit !important;
						text-decoration: inherit !important;
					}
			
					#MessageViewBody a {
						color: inherit;
						text-decoration: none;
					}
			
					p {
						line-height: inherit
					}
			
					.desktop_hide,
					.desktop_hide table {
						mso-hide: all;
						display: none;
						max-height: 0px;
						overflow: hidden;
					}
			
					.image_block img+div {
						display: none;
					}
			
					@media (max-width:660px) {
						.desktop_hide table.icons-inner {
							display: inline-block !important;
						}
			
						.icons-inner {
							text-align: center;
						}
			
						.icons-inner td {
							margin: 0 auto;
						}
			
						.image_block img.big,
						.row-content {
							width: 100% !important;
						}
			
						.mobile_hide {
							display: none;
						}
			
						.stack .column {
							width: 100%;
							display: block;
						}
			
						.mobile_hide {
							min-height: 0;
							max-height: 0;
							max-width: 0;
							overflow: hidden;
							font-size: 0px;
						}
			
						.desktop_hide,
						.desktop_hide table {
							display: table !important;
							max-height: none !important;
						}
					}
				</style>
			</head>
			<body style="background-color: #fcfcfc; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
			<table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fcfcfc;" width="100%">
			<tbody>
			<tr>
			<td>
			<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url("https://assignnmentinneed.com/user_login/uploads_old/BLD_BG_BLUE_MIX_900.png"); background-position: top center; background-repeat: no-repeat;" width="100%">
			<tbody>
			<tr>
			<td>
			<table border="0" cellpadding="0" cellspacing="0" class="image_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
			<tr>
			<td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">
			<div align="center" class="alignment" style="line-height:10px"><a href="https://www.example.com" style="outline:none" tabindex="-1" target="_blank"><img alt="Your Logo" src="https://assignnmentinneed.com/user_login/uploads_old/assignment_logo.png" style="display: block; height: auto; border: 0; width: 192px; max-width: 100%;" title="Your Logo" width="192"/></a></div>
			</td>
			</tr>
			</table>
			<div class="spacer_block block-3" style="height:0px;line-height:0px;font-size:1px;"> </div>
			<div class="spacer_block block-4" style="height:60px;line-height:60px;font-size:1px;"> </div>
			<table border="0" cellpadding="0" cellspacing="0" class="text_block block-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
			<tr>
			<td class="pad" style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px;">
			<div style="font-family: sans-serif">
			<div class="" style="font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2;">
			<p style="margin: 0; font-size: 22px; text-align: center; mso-line-height-alt: 26.4px;"><span style="font-size:42px;"><strong>Assignment In Need</strong></span></p>
			</div>
			</div>
			</td>
			</tr>
			</table>
			<div class="spacer_block block-6" style="height:50px;line-height:50px;font-size:1px;"> </div>
			<table border="0" cellpadding="0" cellspacing="0" class="image_block block-7" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
			<tr>
			<td class="pad" style="padding-left:10px;padding-right:10px;width:100%;">
			<div align="center" class="alignment" style="line-height:10px"><img alt="Book Heart Image" class="big" src="https://assignnmentinneed.com/user_login/uploads_old/BLD_Book_heart_new.png" style="display: block; height: auto; border: 0; width: 620px; max-width: 100%;" title="Book Heart Image" width="620"/></div>
			</td>
			</tr>
			</table>
			<div class="spacer_block block-8" style="height:30px;line-height:30px;font-size:1px;"> </div>
			</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			</tbody>
			</table>
			<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url("http://localhost/new/user_login/uploads_old/BLD_BG_GREY_SECTION_700x900.png"); background-position: center top; background-repeat: no-repeat;" width="100%">
			<tbody>
			<tr>
			<td>
			<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 100%;" >
			<tbody>
			<tr>
			<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
			<div class="spacer_block block-1" style="height:0px;line-height:0px;font-size:1px;"> </div>
			<div class="spacer_block block-2" style="height:15px;line-height:15px;font-size:1px;"> </div>
			<table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
			<tr>
			<td class="pad" style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px;">
			<div style="font-family: sans-serif">
			<div class="" style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;">
			<p style="margin: 0; font-size: 12px; mso-line-height-alt: 14.399999999999999px;"><strong><span style="font-size:16px;">Hi,</span></strong></p>
			</div>
			</div>
			</td>
			</tr>
			</table>
			<div class="spacer_block block-4" style="height:10px;line-height:10px;font-size:1px;"> </div>
			<table border="0" cellpadding="0" cellspacing="0" class="text_block block-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
			<tr>
			<td class="pad" style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px;">
			<div style="font-family: sans-serif">
			<div class="" style="font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2;">
			<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;">Thank you for ordering from Assignment In Need.</p>
			<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 14.399999999999999px;"> </p>
			<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;">We appreciate your decision-making. We strive to provide you with the hassle-free service and top-notch work to exceed your expectations. </p>
			</div>
			</div>
			</td>
			</tr>
			</table>
			<div class="spacer_block block-6" style="height:10px;line-height:10px;font-size:1px;"> </div>
			</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			</tbody>
			</table>
			<tr>
			<b>The following are the specifics of the order you placed:</b>';
			$body .= '<style>.border_ap{ border: 1px solid #9c9898;}</style>
						<div style="font-family: Verdana;">
							
							<table style="border-collapse: collapse; ;width: 100%;"><thead>
								<tr style="background: #9fc59e85;">
									<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> Sr No.</th>
									<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> Order code </th>
									<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> Title</th>
									<th style="border: 1px solid #dddddd;text-align: left;padding: 8px;"> Time Period</th>
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
										<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">' . $value['order_id'] . '</td>
										<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">' . $value['title'] . '</td>
										<td style="border: 1px solid #dddddd;text-align: left;padding: 8px;">' . $value['delivery_date'] . '</td>
					
									</tr> </br>';
						}

						

			$body .='</tbody></table><table border="0" cellpadding="0" cellspacing="0" class="image_block block-13" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
			<tr>
			<td class="pad" style="width:100%;padding-right:0px;padding-left:0px;">';

			$body .= '</tbody></table> <br><br/>
			"Your portal login information is as follows: This will allow you to check the status of the job, share feedback, and place orders. In a nutshell, the ideal solution to all of your assignments tasks " </br><br/>
			
			In case, you have any concern, please do let us know.<br/><br/>
			<div style="border: 1px solid #ccc;padding: 20px;">
			Your log in details are as follows <a href="https://www.assignnmentinneed.com/user_login" target="_blank">(link)</a><br/><br/>
			<b> User name: </b> ' . $email_to . '<br/><br/>
			<b> Password: </b>  user@123 / User@123(unless you change the password)
			</div>
			<br/>
			We will look forward to getting your reply.<br/><br/>
			Thanks & Regards,<br/>
			Assignnmentinneed.com<br/>
			Email: order@assignnmentinneed.com<br/>
			Whatsapp No: +447459420438<br/>
			Contact no: +447520626128  <br/> 
		</div>
			<div align="center" class="alignment" style="line-height:10px"><img alt="Quote Design Elements" class="big" src="https://assignnmentinneed.com/user_login/uploads_old/BLD_bot_quote.png" style="display: block; height: auto; border: 0; width: 384px; max-width: 100%;" title="Quote Design Elements" width="384"/></div>
			</td>
			</tr>

			</table>
			

			</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			</tbody>
			</table>
			
			
			</td>
			</tr>
			</tbody>
			</table>
			
			</td>
			</tr>
			</tbody>
			</table>
			
			</td>
			</tr>
			</tbody>
			</table>
			
			</td>
			</tr>
			</tbody>
			</table>
			
			</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			</tbody>
			</table><!-- End -->
			</body>
			</html>';



		$config = Array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'smtp.gmail.com',
			  'smtp_port' => 587,
			  'smtp_user' => 'order@assignnmentinneed.com', // change it to yours
			  'smtp_pass' => 'jghvstagmtzpqddv', // change it to yours
			  'mailtype' => 'html',
			   'smtp_crypto' => 'tls',
			  'charset' => 'iso-8859-1',
			  'wordwrap' => TRUE
			);
			 $this->load->library('email');
			//$this->load->helper('string');
			//$this->email->initialize($config);
			
			
			$this->email->set_newline("\r\n");
			$this->email->set_mailtype("html");
			$this->email->to($email_to);
		//	$this->email->to('rohitkumarjoshi43@gmail.com');
			$this->email->bcc('order24assignment@gmail.com');
			$this->email->from('order@assignnmentinneed.com', "order confirmation");
			$this->email->subject($value['order_id']);
			$this->email->message($body);
			if($this->email->send())
		    { 
	 			echo $this->session->set_flashdata('success', 'All selected Order Details are  Successfully sent on user email !');
				$upData = array();
				$upData['quotation_status'] = 1;
				$this->db->where('id', $_POST['ids']);
				$this->db->update('orders', $upData);
	 		}else{
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
	    $url = $this->input->post('urlll');
		$id = $this->uri->segment('3');
		$this->order_model->deleteCompletedFile($id);
		$this->session->set_flashdata('success', 'Order File deleted Successfully !');
// 		redirect('/Orders/index', 'refresh');
        redirect($url, 'refresh');
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
		if (isset($data['current'][0]['delivered_orders'])) {
			$data['delivered_orders'] = $data['current'][0]['delivered_orders'];
		}
		if (isset($data['current'][0]['feedback_delivered_file'])) {
			$data['feedback_delivered_file'] = $data['current'][0]['feedback_delivered_file'];
		}

		// echo '<pre>'; print_r($data); exit;
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
		$subject = $this->input->post('uks_order_id');
		
		
		
		$data = array(
			'projectstatus' => $status,
			'completed_date' => $this->input->post('approved_date'),
			'completed_on' => date('Y-m-d H:i:s'),
			'completed_comment' => $this->input->post('completed_comment')
		);
		//print_r($order_id);exit;
		$result = $this->order_model->actionOrder($data, $old_id);



		if($data['projectstatus'] == 'Draft Delivered')
		{
				$this->db->select('completed_orders.*');
				$this->db->where('completed_orders.order_id', $old_id);
				$images_query = $this->db->get('completed_orders')->result_array();
                
				$body = "<div style='font-family: Verdana !important;'>
				<img src='https://assignnmentinneed.com/user_login/uploads/assignmentinneed.png' style='width:100px; height:100px; '>
				
				<p> Hi <b></b>,<br/>

				Greetings of the day!.<br/><br/> 

				We hope you are doing well. <br/>

				Kindly find the attached DRAFT of the work..<br/>	<br/>		

			    If you need any changes in the work, kindly send feedback with the same order code.<br/><br/>
			    
			    If work is to be held before getting the feedback of the DRAFT, kindly do reply.<br/>
				
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
				$this->email->bcc('order24assignment@gmail.com');
				$this->email->from('order@assignnmentinneed.com', "Assignment In Need(Draft Delivered )");
				$this->email->subject($subject);
				$this->email->message($body);
				if (!empty($images_query)) 
				{
					foreach ($images_query as  $file_details)
					{
						$s = $file_details['file_path'];
						
						$this->email->attach($file_details['file_path']);
					}
				}
					if ($this->email->send())
					{
					   // echo '<pre>'; print_r($body); exit;
					$this->session->set_flashdata('success', 'Draft Mail send & Order Updated Successfully !');
					$current_page = $_SESSION['fullURL'];
					redirect($backurl, 'refresh');
					}
		
					else
					{

					
						$this->session->set_flashdata('success', 'Order Uploaded Successfully !');
						$this->session->set_flashdata('failed', 'Mail Not Send Please Try Again !');
						$current_page = $_SESSION['fullURL'];
						redirect($backurl, 'refresh');
					}
		}

		elseif($status == 'Delivered')
			{
				$this->db->select('delivered_orders.*');
				$this->db->where('delivered_orders.order_id', $old_id);
				$images_query = $this->db->get('delivered_orders')->result_array();
                
           
				$body = "<div style='font-family: Verdana !important;'>
				<img src='https://assignnmentinneed.com/user_login/uploads/assignmentinneed.png' style='width:100px; height:100px; '>
				
				<p> Hi <b></b>,<br/>

				Greetings of the day!.<br/><br/> 

				We hope you are doing well. <br/>

				Kindly find the attachment and let us know.<br/>	<br/>		

			    If you need any changes in the work, kindly send feedback with the same order code. We will render you the best solution possible.<br/><br/>
			    
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
				$this->email->bcc('order24assignment@gmail.com');
				$this->email->from('order@assignnmentinneed.com', "Assignment In Need( Delivered )");
				$this->email->subject($subject);
				$this->email->message($body);
				if (!empty($images_query)) 
				{
					foreach ($images_query as  $file_details)
					{
						
						$this->email->attach($file_details['file_path']);
					}
				}
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

			elseif($data['projectstatus'] == 'Feedback Delivered'   )
			{
				$this->db->select('feedback_delivered_file.*');
				$this->db->where('feedback_delivered_file.order_id', $old_id);
				$images_query = $this->db->get('feedback_delivered_file')->result_array();

				$body = "<div style='font-family: Verdana !important;'>
				<img src='https://assignnmentinneed.com/user_login/uploads/assignmentinneed.png' style='width:100px; height:100px; '>
				
				<p> Hi <b></b>,<br/>

				Greetings of the day!.<br/><br/> 

				We hope you are doing well. <br/>

				Kindly find the attachment and let us know.<br/>	<br/>		

			    If you need any changes in the work, kindly send feedback with the same order code. We will render you the best solution possible.<br/><br/>
			    
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
				$this->email->bcc('order24assignment@gmail.com');
				$this->email->from('order@assignnmentinneed.com', "Assignment In Need(Feedback Delivered )");
				$this->email->subject($subject);
				$this->email->message($body);
				if (!empty($images_query)) 
				{
					foreach ($images_query as  $file_details)
					{
						
						$this->email->attach($file_details['file_path']);
					}
				}
					if ($this->email->send())
					{
					$this->session->set_flashdata('success', 'Feedback Derivered Mail send & Order Updated Successfully !');
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
			



		if ($result[0] == TRUE) {
			$this->session->set_flashdata('success', 'File Uploaded successfully !');
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
		$config["per_page"] = 300;
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

		$data = array();
		$data['is_fail'] = '1';
		$this->db->set('is_fail', '1');
		$this->db->where('id', $_POST['uid']);
		$this->db->update('employees', $data);
		return true;
		
		die();
	}

	public function userOrderFail()
	{
		$data = array();
		$data['is_fail'] = '1';
		$this->db->set('is_fail', '1');
		$this->db->where('id', $_POST['uid']);
		$this->db->update('employees', $data);
		return true;
		die();		
	}

	public function date()
	{
		$delivery_time = 1;

		$this->load->library("pagination");
		$config = array();
		$config["base_url"] = base_url() . "Orders/date";
		$config["total_rows"] = $this->order_model->TotalOrders($delivery_time);
		$config["per_page"] = 10;
		$config["uri_segment"] = 3;
		$data['Total_order'] = $this->order_model->TotalOrders($delivery_time);
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
		$data['OrderIDs'] = $this->order_model->getOrderIDs_time();
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
			
			$conditions['delivery_time'] = 1;
			$data['orders'] = $this->order_model->order_list_by_time($conditions);
		} else {
			$delivery_time = 1;
			if ($role_id == 2) {
				$data['orders'] = $this->order_model->feedback_listnew($login_id, $config["per_page"], $page, $online_order);
			} else {
				$data['orders'] = $this->order_model->feedback_listnew(null, $config["per_page"], $page);
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
		$this->template->load('template', 'orders/feedback_view', $data);
	}
	
	public function Write_tl()
	{
		$this->load->model('employee');
	
		// Fetch writers with role_id = 6
		$writers = $this->employee->getWriters();
	
		$data['writers'] = $writers;
		$this->template->load('template', 'master/write_master', $data);
	}
	

	public function insert_writer()
	{
		// Get the writer email and mobile number from the form
		$writer_email = $this->input->post('writer_email');
		$writer_No = $this->input->post('mobile_number');
	
		// Load the necessary models and libraries
		$this->load->model('employee');
	
		// Check if the email already exists in the database
		if ($this->employee->is_email_exists($writer_email)) {
			$this->session->set_flashdata('error', 'Email already exists!');
			redirect($_SERVER['HTTP_REFERER']); // Redirect to the same page
			return;
		}
	
		// Extract the name from the email address
		$name = explode('@', $writer_email)[0];
	
		// Prepare the data for insertion
		$data = array(
			'role_id' => 6,
			'countrycode' => 91,
			'mobile_no' => $writer_No,
			'email' => $writer_email, // Assigning email as name
			'name' => $name, // Assigning name as email name before @
			'username' => $writer_email, // Assigning email as username
			'password' => md5('user@123') // Using 'User@123' as the default password
		);
	
		// Insert the data into the employees table
		$run = $this->employee->insert_writer($data);
	
		if ($run == TRUE) {
			$this->session->set_flashdata('error', 'Failed to insert writer!');
		} else {
			$writer = array(
				'role_id' => 7,
			);
			$this->session->set_flashdata('success', 'Writer Inserted Successfully!');
		}
	
		redirect($_SERVER['HTTP_REFERER']); // Redirect to the same page
	}

	public function subwriter()
	{
		$this->load->model('employee');
		$role_id = $this->session->userdata['logged_in']['role_id'];
		$tl_id = $this->session->userdata['logged_in']['id'];
		// Fetch writers with role_id = 6
		// echo $tl_id; exit;
		if($role_id == 6)
		{
			$writers = $this->employee->getsubWritersfortl($tl_id);
		}
		else
		{
			$writers = $this->employee->getsubWriters();
		}
		$data['writerTL'] = $this->Employee->getWriters();
		$data['writers'] = $writers;
		$this->template->load('template', 'master/sub_writer_master', $data);
	}

	public function insert_sub_writer()
{
    $writer_email = $this->input->post('writer_email');
    $writer_No = 123456789;
	
    $tl_id = $this->input->post('writer_name_new');

    $this->load->model('employee');

    if ($this->employee->is_email_exists($writer_email)) {
        $this->session->set_flashdata('error', 'Email already exists!');
        redirect($_SERVER['HTTP_REFERER']); // Redirect to the same page
        return;
    }

    // Extract the name from the email address
    $name = explode('@', $writer_email)[0];
	
	
	 $role_id = $this->session->userdata['logged_in']['role_id'];;
    if ($role_id == 2) {
		$tl_id;
    } elseif ($role_id == 6) {
        $tl_id = $this->session->userdata['logged_in']['id'];
    }
    // Prepare the data for insertion
    $data = array(
        'role_id' => 7,
        'countrycode' => 91,
        'mobile_no' => $writer_No,
        'email' => $writer_email, // Assigning email as name
        'name' => $name, // Assigning name as email name before @
        'username' => $writer_email, // Assigning email as username
        'password' => md5('user@123'),
		'tl_id' => $tl_id, 
	);

    // Check the role_id and assign the appropriate tl_id
    
	// echo '<pre>'; print_r($data); exit;
    // Insert the data into the employees table
    $run = $this->employee->insert_writer($data);

    if ($run == TRUE) {
        $this->session->set_flashdata('error', 'Failed to insert writer!');
    } else {
        $this->session->set_flashdata('success', 'Writer Inserted Successfully!');
    }

    redirect($_SERVER['HTTP_REFERER']); // Redirect to the same page
}

public function writeEdit($edit_id = '')
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
        if ($this->input->post('referral') == 'Yes') 
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

        $role_id = $this->session->userdata['logged_in']['role_id'];
        $login_id = $this->session->userdata['logged_in']['id'];
		$swid = $this->input->post('subwriter_name_new');
		$wid = $this->input->post('writer_name_new');
       if($role_id == 8 && $swid == $login_id )
	   {
		$wid = 0;
	   }
	   

        $data = array(
			'writer_deadline' => $this->input->post('writer_deadline'),
            'wid' => $wid,
            'swid' => $this->input->post('subwriter_name_new') === '8411' ? '8392' : $this->input->post('subwriter_name_new'),
            'writer_status' => $this->input->post('writer_status'),
            'flag' => '0',
        );

        // Uncomment the line below to display the data being passed to the model
        // echo '<pre>';
		// print_r($data); exit;

        if (!empty($this->input->post('user_id')) && $this->input->post('user_id') != '') 
        {
            $data['uid'] = $this->input->post('user_id');
        }

        $old_id = $this->input->post('edit_id');
        $result = $this->order_model->editOrder($data, $old_id);
        $due = $this->input->post('due_amount');

        // Uncomment the line below to display the data being passed to the model
        // echo '<pre>'; print_r($data); exit;

        if ($result == TRUE) 
        {
            // Insert swid into orders table
            $order_data = array(
                'swid' => $this->input->post('writer_name_new')
            );
            $this->db->where('order_id', $old_id);
            $this->db->update('orders', $order_data);

            $this->session->set_flashdata('success', 'Order Updated Successfully!');
            $current_page = $_SESSION['fullURL'];
            redirect($current_page, 'refresh');
        } 
        else 
        {
            $this->session->set_flashdata('failed', 'Update Failed!');
            $current_page = $_SESSION['fullURL'];
            redirect($current_page, 'refresh');
        }
    }
}


 public function orderchat($order_id = NULL)
 {
     	$role_id = $this->session->userdata['logged_in']['role_id'];
	$data['title'] = 'Edit Order';
	$id = $this->uri->segment('3');

	$query = $this->db->get_where("orders", array("order_id" => $order_id));
	$data['current'] = $query->result();
	$id = $data['current'][0]->id;

	if (isset($data['current'][0]->order_id)) :
		$data['id'] = $data['current'][0]->id;
	endif;

	if (isset($data['current'][0]->wid)) :
		$data['wid'] = $data['current'][0]->wid;
	endif;

	if (isset($data['current'][0]->swid)) :
		$data['swid'] = $data['current'][0]->swid;
	endif;

	if (isset($data['current'][0]->order_id)) :
		$data['order_id'] = $data['current'][0]->order_id;
	endif;


	if($role_id == 6){
	// get Sub write name approve this order  
	if (isset($data['current'][0]->swid)) :
		$data['user_id'] = $data['current'][0]->swid;
		$query 			 = $this->db->get_where("employees", array("id" => $data['user_id']));
		$userRecord 	 = $query->result();
		if (isset($userRecord) && !empty($userRecord)) {
			$data['user_name'] = $userRecord[0]->name;
		}
 
	endif;
}else{
		if (isset($data['current'][0]->wid)) :
		$data['user_id'] = $data['current'][0]->wid;
		$query 			 = $this->db->get_where("employees", array("id" => $data['user_id']));
		$userRecord 	 = $query->result();
		if (isset($userRecord) && !empty($userRecord)) {
			$data['user_name'] = $userRecord[0]->name;
		}

	endif;
}
	
	


	

// 	echo '<pre>'; print_r($data); exit;
	$this->template->load('template', 'message/message_box', $data);
}

public function orderchatc($order_id = NULL)
{
   $data['title'] = 'Edit Order';
   $id = $this->uri->segment('3');

   $query = $this->db->get_where("orders", array("order_id" => $order_id));
   $data['current'] = $query->result();
   $id = $data['current'][0]->id;

   if (isset($data['current'][0]->order_id)) :
	   $data['id'] = $data['current'][0]->id;
   endif;

   if (isset($data['current'][0]->wid)) :
	   $data['wid'] = $data['current'][0]->wid;
   endif;

   if (isset($data['current'][0]->swid)) :
	   $data['swid'] = $data['current'][0]->swid;
   endif;

   if (isset($data['current'][0]->order_id)) :
	   $data['order_id'] = $data['current'][0]->order_id;
   endif;

   // get Sub write name approve this order  
   if (isset($data['current'][0]->swid)) :
	   $data['user_id'] = $data['current'][0]->swid;
	   $query 			 = $this->db->get_where("employees", array("id" => $data['user_id']));
	   $userRecord 	 = $query->result();
	   if (isset($userRecord) && !empty($userRecord)) {
		   $data['user_name'] = $userRecord[0]->name;
	   }

   endif;


   

   // echo '<pre>'; print_r($data); exit;
   $this->template->load('template', 'message/clintwriter_chatbox', $data);
}

public function updateCallsData($order_code)
{
	$login_id = $this->session->userdata['logged_in']['id'];
    $this->db->set('is_read', 0); // Set the 'is_read' column to 0
    $this->db->where('order_code', $order_code); // Use the provided $order_code to identify the row(s) to update
    $this->db->where('created_by !=', $login_id); // Add condition to check created_by is not equal to $login_id
    $this->db->update('calls'); // Execute the update query

    $redirect_url = base_url('index.php/Orders/orderchat/'. $order_code);

    // Redirect to the desired URL
    redirect($redirect_url);
}

public function updateclient($order_code)
{
	$login_id = $this->session->userdata['logged_in']['id'];
    // Assuming you have the $login_id variable defined or retrieved from your authentication system

    // Load the database library (if not autoloaded)
    // $this->load->database();

    // Build the update query using Query Builder
    $this->db->set('is_read', 0); // Set the 'is_read' column to 0
    $this->db->where('order_code', $order_code); // Use the provided $order_code to identify the row(s) to update
    $this->db->where('created_by !=', $login_id); // Add condition to check created_by is not equal to $login_id
    $this->db->update('clintchat'); // Execute the update query

    // You can check the result of the update operation if needed
    // $result = $this->db->affected_rows();

    // Construct the URL for redirect
    $redirect_url = base_url('index.php/Orders/orderchatc/'. $order_code);

    // Redirect to the desired URL
    redirect($redirect_url);
}


public function callstatusaddwrite()
{
	$login_id = $this->session->userdata['logged_in']['id'];
	$data     = $this->input->post();
	$backurl  = $this->input->post('backurl');
  

	unset($data['backurl']);

	date_default_timezone_set("Europe/London");
	$data['created_on'] = date("Y-m-d h:i:s A");
	$data['created_by'] = $login_id;


	if ($data['description']) {
		$result = $this->call_insert_c($data);
		if ($result == TRUE) {
			// $this->session->set_flashdata('success', 'Calls Added Successfully !');
			// redirect($backurl, 'refresh');
		} else {
			// $this->session->set_flashdata('failed', 'Insertion Failed');
			// redirect($backurl, 'refresh');
		}
	} else {
		// $this->session->set_flashdata('failed', 'Insertion Failed');
		// redirect($backurl, 'refresh');
	}
}

public function call_insert_c($data)
{
	$this->db->insert('call_notes', $data);
	if ($this->db->affected_rows() > 0) {
		return true;
	} else {
		return false;
	}
}

public function get_call_listwriter($c_id = '')
{
    $user_id = $this->session->userdata['logged_in']['id'];
    if (empty($c_id)) {
        $c_id = $_POST['c_id'];
    }
    $this->db->select('call_notes.*, employees.name as ename');
    $this->db->from('call_notes');
    $this->db->join('employees', 'call_notes.created_by = employees.id', 'left');
    if (!empty($c_id)) {
        $this->db->where('call_notes.c_id', $c_id);
    }
    $call_lists = $this->db->get()->result_array();

    if (isset($call_lists) && !empty($call_lists)) {
        $html = '';
        $html .= '<style>';
        $html .= 'ul.no-bullets { list-style-type: none; }';
        $html .= '</style>';
        $html .= '<ul class="no-bullets">';

        // Initialize a variable to track the previous date
        $prev_date = null;

        foreach ($call_lists as $call_list) {
            $created_on = strtotime($call_list['created_on']);
            $current_date = date('d-m-y', $created_on);
            
            // If the current date is different from the previous date, display the date
            if ($current_date != $prev_date) {
                $html .= '<div class="col-md-12">';
                $html .= '<p style="text-align: center; color: #888;">' . ($current_date === date('d-m-y') ? 'Today' : $current_date) . '</p>';
                $html .= '</div>';
                // Update the previous date with the current date
                $prev_date = $current_date;
            }

            $html .= '<div class="col-md-12">';
            if ($call_list['c_id'] == $c_id) {
                if ($call_list['created_by'] == $user_id) {
                    $html .= '<li class="msg-right" style="text-align:end!important;display: flex;flex-direction: column;align-items: flex-end;margin: 5px 0;background-color: #DCF8C6;padding: 8px 12px;border-radius: 10px 0 10px 10px;font-size: 14px;max-width: 100%;margin: 0;white-space: pre-wrap;text-align: right;">';
                } else {
                    $html .= '<li class="msg-left" style="flex-direction: column;align-items: flex-end;margin: 5px 0;background-color: #DDB3B3;padding: 8px 12px;border-radius: 10px 0 10px 10px;font-size: 14px;margin: 0;white-space: pre-wrap;">';
                }
                $html .= "<div class='msg-left-sub'>";
                $html .= '<div class="msg-desc" style="white-space: pre-wrap;">';
                $html .= '<pre>';
                $html .= $call_list['description'];
                $html .= '</pre>';
                $html .= '</div>';
                $html .= '<small>';
                $html .= date('h:i: A', strtotime($call_list['created_on']));
                $html .= ' ';
                $html .= '<b>';
                $html .= $call_list['created_by'] == $user_id ? 'You' : $call_list['ename'];
                $html .= '</b>';
                $html .= '</small>';
                $html .= '</div>';
                $html .= '</li>';
                $html .= '</br>';
                // Check if the file field is not empty and display the file
                $html .= '</br>';
            } else {
                $html .= '<div class="col-md-12">';
                $html .= '</div>';
            }
            $html .= "</div>";
        }
        $html .= "</ul>";

        echo $html;
        die();
    }
}

public function writer_admin()
{
    $this->load->model('Employee'); // Make sure the model name is capitalized
    $data = [];

    $logged_in_user = $this->session->userdata('logged_in'); // Access session data using function

    
        $writers = $this->Employee->getAdminWriters();
    

    // Fetch all writers regardless of role
    $data['writerTL'] = $this->Employee->getWriters();
    $data['writers'] = $writers;

    $this->template->load('template', 'master/writer_tl_admin', $data);
}


	public function insert_writer_admin()
	{
		// Get the writer email and mobile number from the form
		$writer_email = $this->input->post('email');
		$writer_name = $this->input->post('name');
	
		// Load the necessary models and libraries
		$this->load->model('employee');
	
		// Check if the email already exists in the database
		if ($this->employee->is_email_exists($writer_email)) {
			$this->session->set_flashdata('error', 'Email already exists! Please Try again with another email');
			redirect($_SERVER['HTTP_REFERER']); // Redirect to the same page
			return;
		}
	
		// Extract the name from the email address
		
	
		// Prepare the data for insertion
		$data = array(
			'role_id' => 8,
			'countrycode' => 91,
			'mobile_no' => '********',
			'email' => $writer_email, // Assigning email as name
			'name' => $writer_name, // Assigning name as email name before @
			'username' => $writer_email, // Assigning email as username
			'password' => md5('user@123') // Using 'User@123' as the default password
		);
	
		// Insert the data into the employees table
		$run = $this->employee->insert_writer_admin($data);
	
		if ($run == TRUE) {
			$this->session->set_flashdata('error', 'Failed to insert writer!');
		} else {
			$this->session->set_flashdata('success', 'Writer Inserted Successfully!');
		}
	
		redirect($_SERVER['HTTP_REFERER']); // Redirect to the same page
	}

	public function orderchatAdmin($order_id = NULL)
	{
			$role_id = $this->session->userdata['logged_in']['role_id'];
	   $data['title'] = 'Edit Order';
	   $id = $this->uri->segment('3');
   
	   $query = $this->db->get_where("orders", array("order_id" => $order_id));
	   $data['current'] = $query->result();
	   $id = $data['current'][0]->id;
   
	   if (isset($data['current'][0]->order_id)) :
		   $data['id'] = $data['current'][0]->id;
	   endif;
   
	   if (isset($data['current'][0]->wid)) :
		   $data['wid'] = $data['current'][0]->wid;
	   endif;
   
	   if (isset($data['current'][0]->swid)) :
		   $data['swid'] = $data['current'][0]->swid;
	   endif;
   
	   if (isset($data['current'][0]->order_id)) :
		   $data['order_id'] = $data['current'][0]->order_id;
	   endif;
	
		   if (isset($data['current'][0]->wid)) :
		   $data['user_id'] = $data['current'][0]->wid;
		   $query 			 = $this->db->get_where("employees", array("id" => $data['user_id']));
		   $userRecord 	 = $query->result();
		   if (isset($userRecord) && !empty($userRecord)) {
			   $data['user_name'] = $userRecord[0]->name;
		   }
   
	   endif;
   // 	echo '<pre>'; print_r($data); exit;
	   $this->template->load('template', 'message/message_box_admin', $data);
   }


   public function updateadmin($order_code)
{
	$login_id = $this->session->userdata['logged_in']['id'];
    // Assuming you have the $login_id variable defined or retrieved from your authentication system

    // Load the database library (if not autoloaded)
    // $this->load->database();

    // Build the update query using Query Builder
    $this->db->set('is_read', 0); // Set the 'is_read' column to 0
    $this->db->where('order_code', $order_code); // Use the provided $order_code to identify the row(s) to update
    $this->db->where('created_by !=', $login_id); // Add condition to check created_by is not equal to $login_id
    $this->db->update('calls'); // Execute the update query

    // You can check the result of the update operation if needed
    // $result = $this->db->affected_rows();

    // Construct the URL for redirect
    $redirect_url = base_url('index.php/Orders/orderchatAdmin/'. $order_code);

    // Redirect to the desired URL
    redirect($redirect_url);
}
   










}

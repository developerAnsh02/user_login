<?php

class User_authentication extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->library('session');
		$this->load->library('template');
		$this->load->model('login_database');
	}

public function dashboard()
	{
		$this->load->model('order_model');
		$this->load->library("pagination");

		$config = array();
		$config["base_url"]    = base_url() . "User_authentication/dashboard";
		$config["total_rows"]  = $this->order_model->TotalOrders();
		$config["per_page"]    = 10;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["links"]   = $this->pagination->create_links();
		$data['role_id'] = $this->session->userdata['logged_in']['role_id'];
		$login_id 		 = $this->session->userdata['logged_in']['id'];

		if ($data['role_id'] == 1) {
			$data['title'] = 'Admin Dashboard';
			$data['total_customers'] = $this->order_model->TotalCustomers();
			$data['TotalOrders'] = $this->order_model->TotalOrders();
			$data['TotalOrdersToday'] = $this->order_model->TotalOrdersToday();
			$data['TotalOrdersCurrentMonth'] = $this->order_model->TotalOrdersCurrentMonth();
			$data['TotalOrdersCurrentMonthOther'] = $this->order_model->TotalOrdersCurrentMonthOther();
			$data['TotalOrdersCurrentMonthPending'] = $this->order_model->TotalOrdersCurrentMonthPending();
			$data['TotalOrdersCurrentMonthCancelled'] = $this->order_model->TotalOrdersCurrentMonthCancelled();
			$data['pending_orders'] = $this->order_model->TotalOrdersPending();
			$data['orders_10'] = $this->order_model->order_list_10(null);
			$data['orders'] = $this->order_model->order_listnew(null, $config["per_page"], $page);
		}
		elseif ($data['role_id'] == 6 ) {
			$data['title'] = 'Admin Dashboard';
			$data['total_writer'] = $this->order_model->TotalWriter();
			$data['total_writer_order'] = $this->order_model->TotalWriterOrders();
			$data['total_writer_order_pending'] = $this->order_model->TotalWriterOrdersPending();
			$data['todays_deadline_orders'] = $this->order_model->Totaldeliversorders();
			$data['recent_orders'] = $this->order_model->TodayRecentorder();

		}

		elseif ( $data['role_id'] == 7) {
			$data['title'] = 'Admin Dashboard';
			$data['total_writer_order'] = $this->order_model->totalOrdersSubWriter();
			$data['total_writer_order_pending'] = $this->order_model->TotalInProgressSubwriter();
			$data['todays_deadline_orders'] = $this->order_model->Totalsubwriterdeadline();
			$data['recent_orders'] = $this->order_model->TodayRecentorderSubWriter();

		}
		
		
		
		else {
			$data['title'] = 'User Dashboard';
	    	$data['leads_total'] = $this->order_model->TotalLeadsUser();
			$data['totalleadstoday'] = $this->order_model->TotalLeadsTodayUser();
			$data['total_customers'] = $this->order_model->MyReferalsTotal();
			$data['TotalOrders'] = $this->order_model->TotalOrdersUser();
			$data['TotalOrdersCurrentMonth'] = $this->order_model->TotalOrdersCurrentMonth();
			$data['TotalOrdersToday'] = $this->order_model->TotalOrdersTodayUSer();
			$data['pending_orders'] = $this->order_model->TotalOrdersPendingUser();
			$data['orders_10'] = $this->order_model->order_list_10($login_id);
			$data['orders'] = $this->order_model->order_listnew($login_id, $config["per_page"], $page);
		}

		$data['one']   = date('m');
		$data['two']   = date('m', strtotime("-1 month"));
		$data['three'] = date('m', strtotime("-2 month"));
		$data['four']  = date('m', strtotime("-3 month"));
		$data['five']  = date('m', strtotime("-4 month"));
		$data['six']   = date('m', strtotime("-5 month"));

		$today = date('Y-m-d');
		$data['month'] = date('F', strtotime($today));

		$this->template->load('template', 'template/dashboard', $data);
	}

	public function index()
	{
		$data = [];
		$con = $this->input->get('con');
		if ($con) {
			$options = 0;
			$ciphering = "AES-128-CTR";
			$decryption_iv = 'Order@783qaz1234';
			$decryption_key = "Assignnment";
			$decryption = openssl_decrypt(
				$con,
				$ciphering,
				$decryption_key,
				$options,
				$decryption_iv
			);
			$data['email'] = $decryption;
		}
		$this->load->view('login_form', $data);
	}

	// Show registration page
	public function user_registration_show()
	{
		$data = array();
		$this->load->model('employee');
		$data['countries'] = $this->employee->getCountries();
		$this->load->view('old_pages/registration_form', $data);
	}

	// Validate and store registration data in database
	public function new_user_registration()
	{
		// Check validation for user input in SignUp form
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$password = 'user@123';
		$new_pass = md5($password);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('old_pages/registration_form');
		} else {
			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'countrycode' => $this->input->post('countrycode'),
				'mobile_no' => $this->input->post('mobile_no'),
				'role_id' => $this->input->post('role_id'),
				'username' => $this->input->post('email'),
				'password' => $new_pass
			);
			$result = $this->login_database->registration_insert($data);
			if ($result == TRUE) {
				$this->session->set_flashdata('success', 'Registration Successfully! Please Login with your email and password as user@123');
				redirect('User_authentication/index', 'refresh');
			} else {
				$this->session->set_flashdata('failed', 'Email already registered! Please register with new email');
				redirect('User_authentication/user_registration_show', 'refresh');
			}
		}
	}

	// Check for user login process
	public function user_login_process()
	{
		setcookie("orderid", "", time() - 60, "/", "", 0);
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$new_password = md5($this->input->post('password'));
		if ($this->form_validation->run() == FALSE) {
			if (isset($this->session->userdata['logged_in'])) {
				$this->index();
			} else {
				$this->load->view('login_form');
			}
		} else {
			$data = array(
				'username' => $this->input->post('username'),
				'password' => $new_password
			);

			$result = $this->login_database->login($data);
			if ($result == 'Inactive') {
				$this->session->set_flashdata('failed', 'User is In Active!');
				redirect('User_authentication/index', 'refresh');
			} else if ($result == 'active') {
				$username = $this->input->post('username');
				$result = $this->login_database->read_user_information($username);

				if ($result != false) {
					$session_data = array(
						'id' => $result[0]->id,
						'username' => $result[0]->email,
						'email' => $result[0]->email,
						'name' => $result[0]->name,
						'mobile_no' => $result[0]->mobile_no,
						'role_id' => $result[0]->role_id,
						'role' => $result[0]->role,
					);
					// Add user data in session
					$this->session->sess_expiration = '14400';
					$this->session->set_userdata('logged_in', $session_data);

					// Check if User then no need to check IP Address
					if ($session_data['role_id'] == 1 || $session_data['role_id'] == '2') {
						$this->session->set_flashdata('success', 'Welcome to Assignment In Need Admin Panel!');
						redirect('/User_authentication/dashboard', 'refresh');
					} else {
						$ip = file_get_contents('https://api.ipify.org');
						// pre($ip);
						// die();
						$status = checkIP($ip);
						if (isset($status) && !empty($status)) {
							$this->session->set_flashdata('success', 'Welcome to Assignment In Need Admin Panel!');
							redirect('/User_authentication/dashboard', 'refresh');
						} else {
							$this->session->set_flashdata('failed', 'No access allowed on out of office!');
							redirect('/User_authentication/dashboard', 'refresh');
						}
					}
				}
			} else {

				$this->session->set_flashdata('failed', 'Invalid Username or Password!');
				redirect('User_authentication/index', 'refresh');
			}
		}
	}

	// Logout from admin page
	public function logout()
	{
		// Removing session data
		$sess_array = array(
			'id' => '',
			'username' => '',
			'password' => '',
			'role_id' => '',
			'mobile_no' => '',
			'email' => '',
			'role' => '',
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$this->session->set_flashdata('success', 'User Successfully Logout!');
		$this->session->sess_destroy();
		redirect('User_authentication/index', 'refresh');
	}

	public function ForgotPassword()
	{
		$this->load->view('old_pages/forgot_password');
	}

	public function EmailVerify() {
// 	$data =[];
// 	$data['error_message']='';
// 	$data['success_mesg']='';

	$this->form_validation->set_rules('email', 'Email', 'required');
	$email=$this->input->post('email');
	$result=$this->login_database->verify_email($email);
	//print_r($result[0]->email);exit;
	if(!empty($result)){

		$emp_email=$result[0]->email;
		$emp_mobile=$result[0]->mobile_no;
		$id=$result[0]->id;

		//$data['success_mesg']='Email is verified.';
		$config = Array(
		  'protocol' => 'mail',
		  'smtp_host' => 'smtp.gmail.com',
		  'smtp_port' => 587,
		  'smtp_user' => 'anshsuthar03@gmail.com', // change it to yours
		  'smtp_pass' => 'krss11@@', // change it to yours
		  'mailtype' => 'html',
		  'charset' => 'iso-8859-1',
		  'wordwrap' => TRUE
		);
// 		$this->load->helper('string');
// 		$code= random_string('numeric', 6);

// 		//$code='123456';
//         $message = 'Your one time password is : '.$code;
//         $this->load->library('email', $config);
// 	    $this->email->set_newline("\r\n");
	  
// 		$this->email->from('order@assignnmentinneed.com', "OTP");
// 		$this->email->subject('Forgot Password ');
// 	    $this->email->message($message);
	    
	    
	    $this->load->helper('string');
			$code = random_string('numeric', 6);

			$message = 'Your one time password is : ' . $code;
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->email->to($emp_email); // change it to yours
			$this->email->bcc('order@assignnmentinneed.com');
			$this->email->from('order@assignnmentinneed.com', "OTP");
			$this->email->subject('Forgot Password ');
			$this->email->message($message);
	   // print_r($message); exit;
	    if($this->email->send())
	    {
	    	$data = array(
			'forgot_code' => $code
			);
	    	$this->login_database->updateOtp($data,$id);
	    	$data['email']=$emp_email;
	    	$data['id']=$id;
	    	//$this->session->set_flashdata('success', 'OTP is sent to your registered mail id');
	    	// $data['success_mesg']=' OTP is sent to your registered mail id .';
	    	$this->session->set_flashdata('success', 'OTP is sent to your registered mail id ');
	     	$this->load->view('otp_verify',$data);
	    }
	   	else
	    {
	    	$this->session->set_flashdata('failed', 'Email sending failed');
	    	redirect('User_authentication/ForgotPassword','refresh');
	     // $data['error_message']=$this->email->print_debugger();
	    }


	}
	else{
		$this->session->set_flashdata('failed', 'Email is not registered with us,please try with another registered email');
		redirect('User_authentication/ForgotPassword','refresh');
	}
	
	}
	public function otpVerify()
	{
		$this->form_validation->set_rules('otp', 'OTP', 'required');
		$email = $this->input->post('email');
		$otp = $this->input->post('otp');
		$result = $this->login_database->verify_email($email);
		if ($result[0]->forgot_code == $otp) {
			$data['email'] = $result[0]->email;
			$data['success_mesg'] = 'OTP is verified Succesfully';
			$this->load->view('change_password', $data);
		} else {
			$data['email'] = $result[0]->email;
			$data['error_message'] = 'OTP does not match ';
			$this->load->view('otp_verify', $data);
		}
	}

	public function ChangePassword()
	{
		$password = $this->input->post('password');
		$cpassword = $this->input->post('confirm_password');
		$email = $this->input->post('email');
		$data = array('password' => md5($password));
		$result = $this->login_database->updatePassword($email, $data);
		if ($result == true) {
			$this->session->set_flashdata('success', 'Password Changed Succesfully');
			redirect('User_authentication/index', 'refresh');
		} else {
			$this->session->set_flashdata('failed', 'Operation Failed');
			redirect('User_authentication/ChangePassword', 'refresh');
		}
	}

	public function MyPasswordChangeView()
	{
		$this->load->model('order_model');
		$data['title'] = ' Change Password';
		$data['employees'] = $this->login_database->getEmployees();
		$this->template->load('template', 'template/mypasswordchange', $data);
	}

	public function UserPasswordChange()
	{
		$password = md5($this->input->post('password'));
		$cpassword = md5($this->input->post('confirm_password'));

		if ($password == $cpassword) {
			$data = array('password' => $password);
			$emp_id = $this->input->post('emp_id');
			$result = $this->login_database->myPasswordChange($emp_id, $data);
			if ($result == true) {
				$this->session->set_flashdata('success', 'Password Changed Succesfully');
				redirect('User_authentication/dashboard', 'refresh');
			} else {
				$this->session->set_flashdata('failed', 'Operation Failed');
				redirect('User_authentication/MyPasswordChangeView', 'refresh');
			}
		}
	}

	public function sendMail()
	{
		$data['title'] = 'Welcome to Send Email Page ';
		$data['total_candidate'] = $this->login_database->TotalCandidates();
		$this->template->load('template', 'mailer', $data);
	}

	public function SendEmailtoAllUsers()
	{
		$result = $this->login_database->FetchallEmails();

		if (!empty($result)) {
			foreach ($result as $key => $data) {
				$sent_to = $data['email'];
				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => 'ipnu.admission@nirmauni.ac.in', // change it to yours
					'smtp_pass' => 'Digital@NirmaPharma', // change it to yours
					'mailtype' => 'html',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE
				);
				$this->load->helper('string');
				$message = " Hello! 
        		<br><br>
					In reference to our previous email, we would like to inform you that 'LAST DATE FOR REGISTRATION IS 27TH JUNE 2019 '. Hurry up and register yourself for becoming a part of one of the best University. Hurry up! limited seats. Follow the registration link below and get yourself registered..<br><br>

					For registering with us, follow the link: http://admissions.nirmauni.ac.in/CampusLynxNU/onindex.html <br>
					NOTE: Ignore if you have already applied.<br><br>

					Feel free to contact us on the numbers and e-mail address mentioned below.<br>
					1.     Phone: (079)30642715,(02717)241900-04 <br>
					2.     Email: admission.ip@nirmauni.ac.in
					<br><br>
					Regards, <br>
					Institute of Pharmacy, Nirma University <br>
					Website: http://www.nirmauni.ac.in/IPNU <br>
					Address: Sarkhej-Gandhinagar Highway, Post Chandlodia, <br>
					Via Gota, Ahmedabad – 382481. Gujarat, India <br><br>
					";
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from('ipnu.admission@nirmauni.ac.in'); // change it to yours
				$this->email->to($sent_to); // change it to yours
				$this->email->subject('LAST DATE FOR REGISTRATION IS 27TH JUNE 2019! Institute of Pharmacy, Nirma University');
				$this->email->message($message);
				$this->email->send();
			}
		} else {
			$this->session->set_flashdata('failed', 'Email is not registered with us,please try with another registered email');
			redirect('User_authentication/sendMail', 'refresh');
		}
	}
}

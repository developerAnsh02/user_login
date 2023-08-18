<?php

class Employees extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata['logged_in']['id']) {
			redirect('User_authentication/index');
		}
		// Load form helper library
		$this->load->helper('form');
		$this->load->helper('url');
		// new security feature
		$this->load->helper('security');
		// Load form validation library
		$this->load->library('form_validation');
		// Load session library
		$this->load->library('session');
		$this->load->model('order_model');
		$this->load->library('template');
		// Load database
		$this->load->model('employee');
	}

	// Show User View
	public function index()
	{
		$this->load->library("pagination");
		$config 					= array();
		$config["base_url"] 		= base_url() . "Employees/index";
		$config["total_rows"] 		= count($this->employee->employeesList());
		$config["per_page"] 		= 10;
		$config["uri_segment"] 		= 3;
		$config['num_tag_open'] 	= '<li>'; 
		$config['num_tag_close']	= '</li>'; 
		$config['cur_tag_open'] 	= '<li class="active"><a href="javascript:void(0);">'; 
		$config['cur_tag_close'] 	= '</a></li>'; 
		$config['next_link'] 		= 'Next'; 
		$config['prev_link'] 		= 'Prev'; 
		$config['next_tag_open'] 	= '<li class="pg-next">'; 
		$config['next_tag_close'] 	= '</li>'; 
		$config['prev_tag_open'] 	= '<li class="pg-prev">'; 
		$config['prev_tag_close'] 	= '</li>'; 
		$config['first_tag_open'] 	= '<li>'; 
		$config['first_tag_close'] 	= '</li>'; 
		$config['last_tag_open'] 	= '<li>'; 
		$config['last_tag_close'] 	= '</li>';

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data["links"] 				= $this->pagination->create_links();
		$data['all_customers'] 		= $this->employee->employeesList();
		$conditions['customer_id'] 	= 0;
		if ($this->input->get()) {
			$conditions['customer_id'] = $this->input->get('customer_id');
			$data['conditions'] 	   = $conditions;
		}
		$data['title'] 		= 'Users List';
		$data['employees'] 	= $this->employee->employeesListnew($config["per_page"], $page, $conditions);
		$data['roles'] 		= $this->employee->getRoles();
		$data['countries'] 	= $this->employee->getCountries();
		$this->template->load('template', 'employee/employee_view', $data);
	}

	public function export_csv()
	{
		$filename = 'users-data-' . date('Y-m-d') . '.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/csv; ");
		
		$expenses_data = $this->employee->export_csv();

		$file = fopen('php://output', 'w');

		$header = array(
			"id",
			"payment_terms",
			"name",
			"employee_code",
			"email",
			"countrycode",
			"mobile_no",
			"role_id",
			"department_id",
			"username",
			"password",
			"pan_no",
			"gender",
			"aadhaar_no",
			"dob",
			"photo",
			"address",
			"forgot_code",
			"status",
			"created_on",
			"created_by",
			"edited_on",
			"flag",
			"bank_id",
			"referral_amount",
		);

		fputcsv($file, $header);
		foreach ($expenses_data as $key => $line) {
			fputcsv($file, $line);
		}
		fclose($file);
		exit;
	}

	public function add()
	{
		$data = array();
		$data['title'] = 'Add New User';
		$data['roles'] = $this->employee->getRoles();
		$data['banks'] = $this->employee->getBanks();
		$data['countries'] = $this->employee->getCountries();
		$this->template->load('template', 'employee/employees_add', $data);
	}

	public function edit($id = NULL)
	{
		$data = array();
		$result = $this->employee->getById($id);

		if (isset($result['id']) && $result['id']) :
			$data['id'] = $result['id'];
		else :
			$data['id'] = '';
		endif;
		if (isset($result['name']) && $result['name']) :
			$data['name'] = $result['name'];
		else :
			$data['name'] = '';
		endif;
		if (isset($result['email']) && $result['email']) :
			$data['email'] = $result['email'];
		else :
			$data['email'] = '';
		endif;
		if (isset($result['mobile_no']) && $result['mobile_no']) :
			$data['mobile_no'] = $result['mobile_no'];
		else :
			$data['mobile_no'] = '';
		endif;
		if (isset($result['countrycode'])) :
			$data['countrycode'] = $result['countrycode'];
		else :
			$data['countrycode'] = '';
		endif;

		if (isset($result['role_id']) && $result['role_id']) :
			$data['role_id'] = $result['role_id'];
		else :
			$data['role_id'] = '';
		endif;
		if (isset($result['bank_id']) && $result['bank_id']) :
			$data['bank_id'] = $result['bank_id'];
		else :
			$data['bank_id'] = '';
		endif;
		if (isset($result['address']) && $result['address']) :
			$data['address'] = $result['address'];
		else :
			$data['address'] = '';
		endif;
		if (isset($result['photo']) && $result['photo']) :
			$data['photo'] = $result['photo'];
		else :
			$data['photo'] = '';
		endif;

		if (isset($result['id']) && $result['id']) :
			$data['title'] = 'Edit User';
		else :
			$data['title'] = 'Add New User';
		endif;
		$data['roles'] = $this->employee->getRoles();
		$data['banks'] = $this->employee->getBanks();
		$data['countries'] = $this->employee->getCountries();
		$this->template->load('template', 'employee/employee_edit', $data);
	}

	public function add_new_employee()
	{
		$this->form_validation->set_rules('email', 'Enter email ', 'required');
		$this->form_validation->set_rules('role_id', 'Role ', 'required');
		$emails = $this->input->post('email');
		$password_news = explode('@', $emails);
		$password_new = 'user@123';
		$password = $password_new;
		// print_r($password); exit;

		if ($this->form_validation->run() == FALSE) {
			if (isset($this->session->userdata['logged_in'])) {
				redirect('/Employees/add');
			} else {
				$this->load->view('login_form');
			}
			
		} else {
			$loginId = $this->session->userdata['logged_in']['id'];
			/*$config['upload_path']          = './uploads/';
	        $config['allowed_types']        = 'jpg|png';
	        $config['max_size']             = 100;
	        $config['max_width']            = 1024;
	        $config['max_height']           = 768;*/
			$this->load->library('upload');
			$this->upload->do_upload('photo');

			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('email'),
				'photo' => $this->upload->data()['file_name'],
				'mobile_no' => $this->input->post('mobile_no'),
				'countrycode' => $this->input->post('countrycode'),
				'role_id' => $this->input->post('role_id'),
				'bank_id' => $this->input->post('bank_id'),
				'created_by' => $loginId,
				'password' => md5($password),
			);
			$result = $this->employee->employee_insert($data);
			if ($result == TRUE) {
				$this->session->set_flashdata('success', 'User Added Successfully !');
				redirect('/Employees/index', 'refresh');
			} else {
				$this->session->set_flashdata('failed', 'User insertion failed!');
				redirect('/Employees/index', 'refresh');
			}
		}
	}

	public function editemployee($id)
	{
		$this->form_validation->set_rules('role_id', 'Role ', 'required');
		if ($this->form_validation->run() == FALSE) {
			if (isset($this->session->userdata['logged_in'])) {
				$this->add();
			} else {
				$this->load->view('login_form');
			}
		} else {
			$loginId = $this->session->userdata['logged_in']['id'];

			if ($this->input->post('flag') == 1) {
				$status = '1';
			} else {
				$status = '0';
			}
			/*
			$config['upload_path']          = './uploads/';
	       	$config['allowed_types'] 		= 'gif|jpg|jpeg|png';
	        $config['overwrite'] 			= TRUE;
	        $config['max_size']             = 2048000;
	        $config['max_width']            = 1024;
	        $config['max_height']           = 768;
			*/
			$this->load->library('upload');
			$this->upload->do_upload('photo');
			// print_r($photo);exit;
			// $result=$this->upload->do_upload('photo');
			//$this->upload->do_upload('photo');
			//$this->upload->do_upload('photo');
			
			if (!empty($this->upload->data()['file_name'])) {
				$file_name = $this->upload->data()['file_name'];
			} else {
				$file_name = $this->input->post('old_image');
			}
			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('email'),
				'photo' => $file_name,
				'mobile_no' => $this->input->post('mobile_no'),
				'countrycode' => $this->input->post('countrycode'),
				'role_id' => $this->input->post('role_id'),
				'bank_id' => $this->input->post('bank_id'),
				'edited_by' => $loginId,
			);

			$result = $this->employee->employee_update($data, $id);
			if ($result == TRUE) {
				if (!empty($this->upload->data()['file_name'])) {
					$old_image = $this->input->post('old_image');
					unlink("uploads/" . $old_image);
				}
				$this->session->set_flashdata('success', 'User Updated Successfully !');
				redirect('/Employees/index', 'refresh');
			} else {
				$this->session->set_flashdata('failed', 'No Changes in User details !');
				redirect('/Employees/index', 'refresh');
			}
		}
	}

	public function deleteEmployee($id = null)
	{
		$ids = $this->input->post('ids');
		if (!empty($ids)) {
			$Datas = explode(',', $ids);
			foreach ($Datas as $key => $id) {
				$this->employee->deleteemployee($id);
				$result = $this->employee->getById($id);
				if (isset($result['photo']) && $result['photo']) :
					$user_image = $result['photo'];
					unlink("uploads/" . $user_image);
				endif;
			}
			echo $this->session->set_flashdata('success', 'Employees deleted Successfully !');
		} else {
			$id = $this->uri->segment('3');
			$this->employee->deleteemployee($id);
			$result = $this->employee->getById($id);
			if (isset($result['photo']) && $result['photo']) :
				$user_image = $result['photo'];
				unlink("uploads/" . $user_image);
			endif;
			$this->session->set_flashdata('success', 'Employee deleted Successfully !');
			redirect('/Employees/index', 'refresh');
		}
	}

	public function MyProfile($id = null)
	{
		$data['title'] = 'My Profile Details';
		$data['result'] = $this->employee->getById($id);
		$this->template->load('template', 'employee/myprofile', $data);
	}

	public function profile(){
		$this->load->model('Employee');
		$emp = $this->Employee->getEmployee();
		$this->load->view('template/dashboard',$emp);
	}

	public function edit_writer($id = NULL)
	{
		$this->load->model('Employee');
		$data = array();
		$result = $this->employee->getById($id);

		if (isset($result['id']) && $result['id']) :
			$data['id'] = $result['id'];
		else :
			$data['id'] = '';
		endif;
		if (isset($result['name']) && $result['name']) :
			$data['name'] = $result['name'];
		else :
			$data['name'] = '';
		endif;
		if (isset($result['email']) && $result['email']) :
			$data['email'] = $result['email'];
		else :
			$data['email'] = '';
		endif;
		if (isset($result['mobile_no']) && $result['mobile_no']) :
			$data['mobile_no'] = $result['mobile_no'];
		else :
			$data['mobile_no'] = '';
		endif;
		if (isset($result['countrycode'])) :
			$data['countrycode'] = $result['countrycode'];
		else :
			$data['countrycode'] = '';
		endif;

		if (isset($result['role_id']) && $result['role_id']) :
			$data['role_id'] = $result['role_id'];
		else :
			$data['role_id'] = '';
		endif;
		if (isset($result['bank_id']) && $result['bank_id']) :
			$data['bank_id'] = $result['bank_id'];
		else :
			$data['bank_id'] = '';
		endif;
		if (isset($result['address']) && $result['address']) :
			$data['address'] = $result['address'];
		else :
			$data['address'] = '';
		endif;
		if (isset($result['photo']) && $result['photo']) :
			$data['photo'] = $result['photo'];
		else :
			$data['photo'] = '';
		endif;

		if (isset($result['id']) && $result['id']) :
			$data['title'] = 'Edit User';
		else :
			$data['title'] = 'Add New User';
		endif;

		if (isset($result['tl_id']) && $result['tl_id']) :
			$data['tl_id'] = $result['tl_id'];
		else :
			$data['tl_id'] = '';
		endif;
		
		$data['writerTL'] 		= $this->Employee->getWriters();
		$data['roles']			= $this->employee->getRoles();
		$data['banks']			= $this->employee->getBanks();
		$data['countries'] 		= $this->employee->getCountries();

		// echo '<pre>'; print_r($data); exit;
		$this->template->load('template', '/writer/writer_edit', $data);
	}


	public function editwriter($id)
	{
    $this->form_validation->set_rules('role_id', 'Role', 'required');

        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('email'),
            'mobile_no' => $this->input->post('mobile_no'),
            'countrycode' => $this->input->post('countrycode'),
            'role_id' => $this->input->post('role_id'),
            'bank_id' => $this->input->post('bank_id'),
            'tl_id' => $this->input->post('writer_name_new'),
            'edited_by' => $loginId,
        );

        $result = $this->employee->employee_update($data, $id);
        if ($result == TRUE) {
           
            $this->session->set_flashdata('success', 'Writer Updated Successfully !');
			redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('failed', 'No Changes in User details !');
			redirect($_SERVER['HTTP_REFERER']);
        }
    }




}

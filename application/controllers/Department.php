<?php

//session_start(); //we need to start session in order to access it through CI

Class Department extends CI_Controller {

public function __construct() {
parent::__construct();
if(!$this->session->userdata['logged_in']['id']){
    redirect('User_authentication/index');
}
/*require_once APPPATH.'third_party/PHPExcel.php';
$this->excel = new PHPExcel(); */

// Load form helper library
$this->load->helper('form');
$this->load->helper('url');
// new security feature
$this->load->helper('security');
// Load form validation library
$this->load->library('form_validation');
$this->load->model('order_model');

// Load session library
$this->load->library('session');


$this->load->library('template');

// Load database
$this->load->model('department_model');
}

// Show login page	

	public function index($id = NULL) 
	{
		/*$currentURL=current_url();
		$role_id=$this->session->userdata['logged_in']['role_id'];
		$MenuUrl = $this->department_model->UserRightMenus($role_id);
		// /print_r($MenuUrl);exit;
		 if(in_array($currentURL, $MenuUrl))
            {*/
            	
		/*$menu_ids=explode(',', $UserRightMenus['menu_ids']);echo "<br><br/>";
		$menu_url=[];
		foreach ($menu_ids as $key => $menu_id) {
			echo $menu_id;
			$MenuUrl = $this->department_model->getMenuURL($menu_id);
			echo $MenuUrl;
		}*/
		$data = array();
			$result = $this->department_model->getById($id);

			if (isset($result['id']) && $result['id']) :
	            $data['id'] = $result['id'];
	        else:
	            $data['id'] = '';
	        endif;

			if (isset($result['department_name']) && $result['department_name']) :
	            $data['department_name'] = $result['department_name'];
	       else:
	            $data['department_name'] = '';
	        endif;
	        if (isset($result['department_code']) && $result['department_code']) :
	            $data['department_code'] = $result['department_code'];
	       else:
	            $data['department_code'] = '';
	        endif;

			$data['title'] = 'Department Master';
			$data['departments'] = $this->department_model->departmentsList();
			//echo var_dump($data['students']);
			//print_r($data['department_name']);exit;
			$this->template->load('template','department_master',$data);
		/*}
		else{
			redirect('User_authentication/dashboard');
		}*/
	}
	public function add_new_department() {
		
		$this->form_validation->set_rules('department_name', 'Department Name', 'required');
		$this->form_validation->set_rules('department_code', 'Department Code', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
			$this->index();
			//$this->load->view('admin_page');
			}else{
			$this->load->view('login_form');
			}
			//$this->template->load('template','supplier_add');
		}
		else 
		{
			
			$data = array(
			'department_name' => $this->input->post('department_name'),
			'department_code' => $this->input->post('department_code')
			);
			$result = $this->department_model->department_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Department Added Successfully !');
			redirect('/Department/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Already Exists , Department Not Inserted !');
			redirect('/Department/index', 'refresh');
			}
		} 
	}

	public function editdepartment($id) {
		$this->form_validation->set_rules('department_name', 'Department Name', 'required');
		$this->form_validation->set_rules('department_code', 'Department Code', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
			$this->index();
			//$this->load->view('admin_page');
			}else{
			$this->load->view('login_form');
			}
			//$this->template->load('template','supplier_add');
		}
		else 
		{
			$data = array(
			//'id' => $id,
			'department_name' => $this->input->post('department_name'),
			'department_code' => $this->input->post('department_code'),
			'flag' => $this->input->post('flag')
			);
			$result = $this->department_model->department_update($data,$id);
			//echo $result;exit;
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Department Updated Successfully !');
			redirect('/Department/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Department!');
			redirect('/Department/index', 'refresh');
			}
		} 
	}

}

?>
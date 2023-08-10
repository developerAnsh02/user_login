<?php

//session_start(); //we need to start session in order to access it through CI

Class Sub_category extends CI_Controller {

  public function __construct() {
  parent::__construct();
  if(!$this->session->userdata['logged_in']['id']){
      redirect('User_authentication/index');
  }
/*require_once APPPATH.'third_party/PHPExcel.php';
$this->excel = new PHPExcel(); */

// Load form helper library
$this->load->helper('form');
$this->load->helper('security');

$this->load->helper('url');
// new security feature

// Load form validation library
$this->load->library('form_validation');
$this->load->model('order_model');

// Load session library
$this->load->library('session');

$this->load->library('template');

// Load database
$this->load->model('sub_categories_model');
}

// Show login page
public function add() {
  $this->template->load('template','supplier_add');
  //$this->load->view('footer');
  }

 /*  public function fetchgrids(){
      $data['title'] = 'Product grid Master';
      $data['grid'] = $this->grid_model->gridList();
      //echo var_dump($data['students']);
      $this->template->load('template','grid_model',$data);
    }
 */

  

  public function index($id = NULL) 
  {
    $data = array();
      $result = $this->sub_categories_model->getById($id);

      if (isset($result['id']) && $result['id']) :
              $data['id'] = $result['id'];
          else:
              $data['id'] = '';
          endif;
 if (isset($result['categories_id']) && $result['categories_id']) :
              $data['categories_id'] = $result['categories_id'];
         else:
              $data['categories_id'] = '';
          endif;
      if (isset($result['sub_category_name']) && $result['sub_category_name']) :
              $data['sub_category_name'] = $result['sub_category_name'];
         else:
              $data['sub_category_name'] = '';
          endif;

      $data['title'] = 'Sub Category Master';
      $data['sub_categories'] = $this->sub_categories_model->sub_categoryList();
	  $data['categories'] = $this->sub_categories_model->getCategories();
      //echo var_dump($data['students']);
      //print_r($data['grid_name']);exit;
      $this->template->load('template','sub_category_master',$data);
  }
  public function add_new_sub_category() {
    
    $this->form_validation->set_rules('sub_category_name', 'sub category name', 'required');
    if ($this->form_validation->run() == FALSE) 
    {
      if(isset($this->session->userdata['logged_in'])){
      $this->index();
      //$this->template->load('template','grid_model');
      //$this->load->view('admin_page');
      }else{
      $this->load->view('login_form');
      }
      //$this->template->load('template','supplier_add');
    }
    else 
    {
      
      $data = array(
	  'categories_id'=>$this->input->post('categories_id'),
      'sub_category_name' => $this->input->post('sub_category_name')
      );
      $result = $this->sub_categories_model->sub_category_insert($data);
      if ($result == TRUE) {
      
      // Send otp to user via SMS
      /*  $recipient_no='9664100138';
      $rand_no='123456';
      //$senderID='YASHMM';
            $message = 'Dear User, OTP for mobile number verification is '.$rand_no.'. Thanks CodexWorld';
            $send = $this->sendSMS($recipient_no, $message);
            //print_r($send);exit;
            if($send){
                $this->session->set_flashdata('success', 'grid Added Successfully !');
        redirect('/Grid/index', 'refresh');
            }else{
                $this->session->set_flashdata('failed', 'OTP Not sent !');
        redirect('/Grid/index', 'refresh');
            }*/
      //$data['message_display'] = 'grid Added Successfully !';
      //$this->session->set_flashdata('success', 'grid Added Successfully !');
      //redirect('/Grid/index', 'refresh');
      //$this->fetchSuppliers();
        $this->session->set_flashdata('success', 'Sub Category Added Successfully !');
        redirect('/Sub_category/index', 'refresh');
      } else {
      $this->session->set_flashdata('failed', 'Already exists, Sub Category Could not added !');
      redirect('/Sub_category/index', 'refresh');
      }
    } 
  }

  public function editsub_category($id) {
    $this->form_validation->set_rules('sub_category_name', 'Sub Category Name', 'required');
    if ($this->form_validation->run() == FALSE) 
    {
      if(isset($this->session->userdata['logged_in'])){
        $this->index();
      //$this->template->load('template','grid_model');
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
	   'categories_id'=>$this->input->post('categories_id'),
      'sub_category_name' => $this->input->post('sub_category_name'),
      'flag' => $this->input->post('flag')
      );
	  //print_r($data);exit;
      $result = $this->sub_categories_model->sub_category_update($data,$id);
     
      //echo $result;exit;
      if ($result == TRUE) {
      $this->session->set_flashdata('success', 'Sub Category Updated Successfully !');
      redirect('/Sub_category/index', 'refresh');
      //$this->fetchSuppliers();
      }
      else {
      $this->session->set_flashdata('failed', 'No Changes in Sub Category!');
      redirect('/Sub_category/index', 'refresh');
      }
    } 
    } 
  public function getsub_categoryByCategory($category_id)
  {
	  $data=array();
	   $data['sub_categories'] = $this->sub_categories_model->getsub_categoryByCategory($category_id);
		$this->load->view('sub_category_by_category',$data);
		
  }
  

}

?>
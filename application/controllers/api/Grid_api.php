<?php

//session_start(); //we need to start session in order to access it through CI
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to start session in order to access it through CI
require APPPATH . '/libraries/REST_Controller.php';

Class Grid_api extends Restserver\Libraries\REST_Controller  {

public function __construct($config = 'rest') { 
parent::__construct($config);

$this->load->model('grid_model');
$this->load->helper('form');
$this->load->helper('security');

$this->load->helper('url');
// new security feature

// Load form validation library
$this->load->library('form_validation');


// Load session library
$this->load->library('session');

$this->load->library('template');
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


     public function index_post() {
        $this->data = array();

       $data['grids'] = $this->grid_model->gridList();
        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;
        $result = array();
        foreach ($data['grids'] as $object) :
            $result[] = array(
                'id' => $object['id'],
                'grid_name' => $object['grid_name'],
                'flag' => $object['flag'],
            );
        endforeach;
        $this->data['draw'] = $draw;
        //$this->data['recordsTotal'] = $this->grid_model->countAll();
        //$this->data['recordsFiltered'] = $this->grid_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

  public function add_new_grid_post() {
    
    $this->form_validation->set_rules('grid_name', 'grid Name', 'required');
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
      'grid_name' => $this->input->post('grid_name')
      );
      $result = $this->grid_model->grid_insert($data);
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
        $this->session->set_flashdata('success', 'grid Added Successfully !');
        redirect('/Grid/index', 'refresh');
      } else {
      $this->session->set_flashdata('failed', 'Already exists, grid Could not added !');
      redirect('/Grid/index', 'refresh');
      }
    } 
  }

  public function editgrid($id) {
    $this->form_validation->set_rules('grid_name', 'grid Name', 'required');
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
      'grid_name' => $this->input->post('grid_name'),
      'flag' => $this->input->post('flag')
      );
      $result = $this->grid_model->grid_update($data,$id);
      //echo $result;exit;
      if ($result == TRUE) {
      $this->session->set_flashdata('success', 'grid Updated Successfully !');
      redirect('/Grid/index', 'refresh');
      //$this->fetchSuppliers();
      }
      else {
      $this->session->set_flashdata('failed', 'No Changes in grid!');
      redirect('/Grid/index', 'refresh');
      }
    } 
  }

}

?>
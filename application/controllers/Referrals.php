<?php

//session_start(); //we need to start session in order to access it through CI

class Referrals extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata['logged_in']['id']) {
      redirect('user_authentication/index');
    }
    $this->load->helper('form');
    $this->load->helper('security');
    $this->load->helper('url');
    $this->load->model('order_model');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->library('template');
    $this->load->model('referal_model');
  }

  public function myRefers()
  {
    $data['title']    = 'My Referals';
    $data['wallets']  = $this->referal_model->mywallet();
    $data['referals'] = $this->referal_model->myreferals();
    $this->template->load('template', 'referal/referal_index', $data);
  }

  public function add()
  {
    $data = array();
    $data['title'] = 'Add New Referal';
    $data['countries'] = $this->referal_model->getCountries();
    $data['useremails'] = $this->referal_model->getUserEmails();
    $this->template->load('template', 'referal/add_referal', $data);
  }

  public function index($id = NULL)
  {
    $data = array();
    $result = $this->referal_model->getByIdReferal($id);

    if (isset($result['id']) && $result['id']) :
      $data['id'] = $result['id'];
    else :
      $data['id'] = '';
    endif;

    if (isset($result['formatting_name'])) :
      $data['formatting_name'] = $result['formatting_name'];
    else :
      $data['formatting_name'] = '';
    endif;

    if (isset($result['factor'])) :
      $data['factor'] = $result['factor'];
    else :
      $data['factor'] = '';
    endif;

    $data['title'] = 'Formatting Master';
    $this->template->load('template', 'old_pages/formatting_master', $data);
  }

  public function checkemail()
  {
    $email = $this->input->post('email');
    echo $this->referal_model->checkemail($email);
    exit;
  }

  public function checkmobile()
  {
    $email = $this->input->post('mobile');
    echo $this->referal_model->checkmobile($email);
    exit;
  }

  public function add_new_record()
  {
    $result = $this->referal_model->referal_insert();
    if ($result) {
      $this->session->set_flashdata('success', 'Record Added Successfully !');
      redirect('/Referrals/myRefers', 'refresh');
    } else {
      $this->session->set_flashdata('failed', 'Already exists, Record Could not added !');
      redirect('/Referrals/myRefers', 'refresh');
    }
  }

  public function editRecord($id)
  {
    $this->form_validation->set_rules('formatting_name', 'Formatting Name', 'required');
    if ($this->form_validation->run() == FALSE) {
      if (isset($this->session->userdata['logged_in'])) {
        $this->index();
      } else {
        $this->load->view('login_form');
      }
    } else {
      $data = array(
        'formatting_name' => $this->input->post('formatting_name'),
        'factor' => $this->input->post('factor'),
        'flag' => $this->input->post('flag')
      );
      $result = $this->referal_model->formatting_update($data, $id);
      if ($result == TRUE) {
        $this->session->set_flashdata('success', 'Formatting Updated Successfully !');
        redirect('/Referrals/index', 'refresh');
      } else {
        $this->session->set_flashdata('failed', 'No Changes in Formatting!');
        redirect('/Referrals/index', 'refresh');
      }
    }
  }
}

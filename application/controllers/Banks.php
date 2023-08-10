<?php

class Banks extends CI_Controller
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
    $this->load->library('form_validation');
    $this->load->model('order_model');
    $this->load->library('session');
    $this->load->library('template');
    $this->load->model('Banks_model');
  }

  public function index($id = NULL)
  {
    $data = array();
    $result = $this->Banks_model->getById($id);

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

    if (isset($result['account_holder']) && $result['account_holder']) :
      $data['account_holder'] = $result['account_holder'];
    else :
      $data['account_holder'] = '';
    endif;

    if (isset($result['account_number']) && $result['account_number']) :
      $data['account_number'] = $result['account_number'];
    else :
      $data['account_number'] = '';
    endif;

    if (isset($result['sort_code']) && $result['sort_code']) :
      $data['sort_code'] = $result['sort_code'];
    else :
      $data['sort_code'] = '';
    endif;

    $data['title'] = 'Bank Master';
    $data['categories'] = $this->Banks_model->bankList();
    $this->template->load('template', 'master/bank_master', $data);
  }

  public function add_new_bank()
  {
    $this->form_validation->set_rules('name', 'Name', 'required');
    if ($this->form_validation->run() == FALSE) {
      if (isset($this->session->userdata['logged_in'])) {
        $this->index();
      } else {
        $this->load->view('login_form');
      }
    } else {
      $data = $this->input->post();
      $result = $this->Banks_model->bank_insert($data);
      if ($result == TRUE) {
        $this->session->set_flashdata('success', 'Bank Added Successfully !');
        redirect('/Banks/index', 'refresh');
      } else {
        $this->session->set_flashdata('failed', 'Already exists, Category Could not added !');
        redirect('/Banks/index', 'refresh');
      }
    }
  }

  public function editbank($id)
  {
    $this->form_validation->set_rules('name', 'Name', 'required');
    if ($this->form_validation->run() == FALSE) {
      if (isset($this->session->userdata['logged_in'])) {
        $this->index();
      } else {
        $this->load->view('login_form');
      }
    } else {
      $data =  $this->input->post();
      $result = $this->Banks_model->bank_update($data, $id);
      if ($result == TRUE) {
        $this->session->set_flashdata('success', 'Bank Updated Successfully !');
        redirect('/Banks/index', 'refresh');
      } else {
        $this->session->set_flashdata('failed', 'No Changes in Bank!');
        redirect('/Banks/index', 'refresh');
      }
    }
  }
}

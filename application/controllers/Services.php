<?php

class Services extends CI_Controller
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
    $this->load->model('master_model');
  }

  public function add()
  {
    $this->template->load('template', 'supplier_add');
  }

  public function index($id = NULL)
  {
    $data = array();
    $result = $this->master_model->getByIdService($id);

    if (isset($result['id']) && $result['id']) :
      $data['id'] = $result['id'];
    else :
      $data['id'] = '';
    endif;

    if (isset($result['service_name'])) :
      $data['service_name'] = $result['service_name'];
    else :
      $data['service_name'] = '';
    endif;

    if (isset($result['factor'])) :
      $data['factor'] = $result['factor'];
    else :
      $data['factor'] = '';
    endif;

    $data['title'] = 'Services Master';
    $data['services'] = $this->master_model->servicesList();

    $this->template->load('template', 'master/service_master', $data);
  }

  public function add_new_service()
  {
    $this->form_validation->set_rules('service_name', 'Service Name', 'required');
    if ($this->form_validation->run() == FALSE) {
      if (isset($this->session->userdata['logged_in'])) {
        $this->index();
      } else {
        $this->load->view('login_form');
      }
    } else {
      $data = array(
        'service_name' => $this->input->post('service_name'),
        'factor' => $this->input->post('factor')
      );

      $result = $this->master_model->service_insert($data);
      if ($result == TRUE) {
        $this->session->set_flashdata('success', 'Service Added Successfully !');
        redirect('/Services/index', 'refresh');
      } else {
        $this->session->set_flashdata('failed', 'Already exists, Service Could not added !');
        redirect('/Services/index', 'refresh');
      }
    }
  }

  public function editService($id)
  {
    $this->form_validation->set_rules('service_name', 'Service Name', 'required');
    if ($this->form_validation->run() == FALSE) {
      if (isset($this->session->userdata['logged_in'])) {
        $this->index();
      } else {
        $this->load->view('login_form');
      }
    } else {
      $data = array(
        'service_name' => $this->input->post('service_name'),
        'factor' => $this->input->post('factor'),
        'flag' => $this->input->post('flag')
      );

      $result = $this->master_model->service_update($data, $id);

      if ($result == TRUE) {
        $this->session->set_flashdata('success', 'Service Updated Successfully !');
        redirect('/Services/index', 'refresh');
      } else {
        $this->session->set_flashdata('failed', 'No Changes in Services!');
        redirect('/Services/index', 'refresh');
      }
    }
  }
}

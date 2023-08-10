<?php

class Formattings extends CI_Controller
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

  public function index($id = NULL)
  {
    $data = array();
    $result = $this->master_model->getByIdFormatting($id);

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
    $data['formattings'] = $this->master_model->formattingsList();
    $this->template->load('template', 'master/formatting_master', $data);
  }

  public function add_new_record()
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
      );
      $result = $this->master_model->formatting_insert($data);
      if ($result == TRUE) {
        $this->session->set_flashdata('success', 'Formatting Added Successfully !');
        redirect('/Formattings/index', 'refresh');
      } else {
        $this->session->set_flashdata('failed', 'Already exists, Formatting Could not added !');
        redirect('/Formattings/index', 'refresh');
      }
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
      $result = $this->master_model->formatting_update($data, $id);
      if ($result == TRUE) {
        $this->session->set_flashdata('success', 'Formatting Updated Successfully !');
        redirect('/Formattings/index', 'refresh');
      } else {
        $this->session->set_flashdata('failed', 'No Changes in Formatting!');
        redirect('/Formattings/index', 'refresh');
      }
    }
  }
}

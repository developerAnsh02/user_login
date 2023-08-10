<?php

class Offers extends CI_Controller
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
    $this->load->model('master_model');
  }

  public function myOffers()
  {
    $data = array();
    $data['title'] = 'My Offers';
    $data['result'] = $this->master_model->getOfferImages();
    $this->template->load('template', 'offers/my_offers', $data);
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
    $this->template->load('template', 'formatting_master', $data);
  }

  public function add_new_offer()
  {
    $result = $this->master_model->add_offer();
    if ($result == TRUE) {
      $this->session->set_flashdata('success', 'Offer Images Uploaded Successfully !');
      redirect('/Offers/myOffers', 'refresh');
    } else {
      $this->session->set_flashdata('failed', 'Operation Failed,Images not uploaded !!!');
      redirect('/Offers/myOffers', 'refresh');
    }
  }

  public function deleteoffer($id = null)
  {
    $id = $this->uri->segment('3');
    $this->master_model->deleteoffer($id);
    $this->session->set_flashdata('success', 'Offer Image deleted Successfully !');
    redirect('/Offers/myOffers', 'refresh');
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

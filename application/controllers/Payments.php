<?php

class Payments extends CI_Controller
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

    $this->load->library("pagination");
    $config = array();
    $config["base_url"] = base_url() . "Payments/index";
    $config["total_rows"] = $this->master_model->getTotalCount('payment_details');
    $config["per_page"] = 10;
    $config["uri_segment"] = 3;
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
    $config['cur_tag_close'] = '</a></li>';
    $config['next_link'] = 'Next';
    $config['prev_link'] = 'Prev';
    $config['next_tag_open'] = '<li class="pg-next">';
    $config['next_tag_close'] = '</li>';
    $config['prev_tag_open'] = '<li class="pg-prev">';
    $config['prev_tag_close'] = '</li>';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

    $this->pagination->initialize($config);
    $page          = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data["links"] = $this->pagination->create_links();

    $data['title']    = 'Payments List';
    $data['datalists'] = $this->master_model->paymentsList($config["per_page"], $page);
    $this->template->load('template', 'master/payment_master', $data);
  }

  public function confirmPayment()
  {
    $data = array();
    $data['account_status'] = '1';
    $this->db->where('id', $_POST['id']);
    if($this->db->update('payment_details', $data)){
      die('success');
    } else {
      die('failed');
    }
  }
}

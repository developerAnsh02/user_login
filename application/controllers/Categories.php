<?php

class Categories extends CI_Controller
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

  public function fetchCategories()
  {
    $data['title']      = 'Product Category Master';
    $data['categories'] = $this->master_model->categoriesList();
    $this->template->load('template', 'category_master', $data);
  }

  public function index($id = NULL)
  {
    $data   = array();
    $result = $this->master_model->getByIdCategory($id);

    if (isset($result['id']) && $result['id']) :
      $data['id'] = $result['id'];
    else :
      $data['id'] = '';
    endif;

    if (isset($result['category_name']) && $result['category_name']) :
      $data['category_name'] = $result['category_name'];
    else :
      $data['category_name'] = '';
    endif;

    $data['title']      = 'Category Master';
    $data['categories'] = $this->master_model->categoriesList();
    $this->template->load('template', 'master/category_master', $data);
  }

  public function add_new_category()
  {
    $this->form_validation->set_rules('category_name', 'Category Name', 'required');
    if ($this->form_validation->run() == FALSE) {
      if (isset($this->session->userdata['logged_in'])) {
        $this->index();
      } else {
        $this->load->view('login_form');
      }
    } else {

      $data = array(
        'category_name' => $this->input->post('category_name'),
      );

      $result = $this->master_model->category_insert($data);
      if ($result == TRUE) {

        $this->session->set_flashdata('success', 'Category Added Successfully !');
        redirect('/Categories/index', 'refresh');
      } else {
        $this->session->set_flashdata('failed', 'Already exists, Category Could not added !');
        redirect('/Categories/index', 'refresh');
      }
    }
  }

  public function editCategory($id)
  {
    $this->form_validation->set_rules('category_name', 'Category Name', 'required');
    if ($this->form_validation->run() == FALSE) {
      if (isset($this->session->userdata['logged_in'])) {
        $this->index();
      } else {
        $this->load->view('login_form');
      }
    } else {
      $data = array(
        'category_name' => $this->input->post('category_name'),
        'flag' => $this->input->post('flag')
      );
      $result = $this->master_model->category_update($data, $id);
      if ($result == TRUE) {
        $this->session->set_flashdata('success', 'Category Updated Successfully !');
        redirect('/Categories/index', 'refresh');
      } else {
        $this->session->set_flashdata('failed', 'No Changes in Category!');
        redirect('/Categories/index', 'refresh');
      }
    }
  }
}

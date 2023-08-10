<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to start session in order to access it through CI
require APPPATH . '/libraries/REST_Controller.php';
Class Orders_api extends Restserver\Libraries\REST_Controller  {

public function __construct($config = 'rest') {
parent::__construct($config);

$this->load->helper('form');
$this->load->helper('download');

$this->load->helper('url');
// new security feature
$this->load->helper('security');
// Load form validation library
$this->load->library('form_validation');

$this->load->library('encryption');

// Load session library
$this->load->library('session');


$this->load->library('template');

// Load database
$this->load->model('order_model');
}

// Show login page
/*public function index_post() {
	$data['categories'] = $this->master_model->categoriesList();
	$this->response($data);
	}*/
    public function index_post() {
        $this->data = array();

       $result = $this->order_model->order_list();
        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;
        // $result = array();
        // foreach ($data['orders'] as $object) :
        //     $result[] = array(
        //         'id' => $object['id'],
        //         'category_name' => $object['category_name'],
        //         'flag' => $object['flag'],
        //     );
        // endforeach;
        $this->data['draw'] = $draw;
        //$this->data['recordsTotal'] = $this->master_model->countAll();
        //$this->data['recordsFiltered'] = $this->master_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }
    public function save_post(){
        $this->data = array();
        $result = $this->order_model->order_post();
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = 'update success!';
            $this->data['result'] = $result;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'update failed!';
            $this->data['result'] = array();
        endif;
        $this->response($this->data);
    }
   

public function fetchCategories_post(){
	$data['title'] = 'Product Category Master';
	$data['categories'] = $this->master_model->categoriesList();
	//echo var_dump($data['students']);
	$this->response($data);
}

}

?>
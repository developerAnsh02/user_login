<?php

class Meenus extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata['logged_in']['id']) {
			redirect('User_authentication/index');
		}
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->model('order_model');
		$this->load->library('session');
		$this->load->library('template');
		$this->load->model('menus');
	}

	public function index($id = NULL)
	{
		$data = array();
		$result = $this->menus->getById($id);

		if (isset($result['id']) && $result['id']) :
			$data['id'] = $result['id'];
		else :
			$data['id'] = '';
		endif;

		if (isset($result['menu_name']) && $result['menu_name']) :
			$data['menu_name'] = $result['menu_name'];
		else :
			$data['menu_name'] = '';
		endif;

		if (isset($result['parent_id']) && $result['parent_id']) :
			$data['parent_id'] = $result['parent_id'];
		else :
			$data['parent_id'] = '';
		endif;

		if (isset($result['controller']) && $result['controller']) :
			$data['controller'] = $result['controller'];
		else :
			$data['controller'] = '';
		endif;

		if (isset($result['action']) && $result['action']) :
			$data['action'] = $result['action'];
		else :
			$data['action'] = '';
		endif;

		if (isset($result['icon_class']) && $result['icon_class']) :
			$data['icon_class'] = $result['icon_class'];
		else :
			$data['icon_class'] = '';
		endif;

		if (isset($result['is_hidden']) && $result['is_hidden']) :
			$data['is_hidden'] = $result['is_hidden'];
		else :
			$data['is_hidden'] = 'N';
		endif;

		if (isset($result['target']) && $result['target']) :
			$data['target'] = $result['target'];
		else :
			$data['target'] = '';
		endif;

		if (isset($result['is_parent']) && $result['is_parent']) :
			$data['is_parent'] = $result['is_parent'];
		else :
			$data['is_parent'] = 'N';
		endif;

		if (isset($result['show_menu']) && $result['show_menu']) :
			$data['show_menu'] = $result['show_menu'];
		else :
			$data['show_menu'] = 'Y';
		endif;

		$data['title'] = 'Menu Master';
		$data['menus'] = $this->menus->menusList();
		$data['parentMenus'] = $this->menus->getParents();
		$this->template->load('template', 'template/master_menu', $data);
	}

	public function add_new_menu()
	{
		$data = array(
			'menu_name' => $this->input->post('menu_name'),
			'parent_id' => $this->input->post('parent_id'),
			'url' => $this->input->post('url'),
			'controller' => $this->input->post('controller'),
			'action' => $this->input->post('action'),
			'icon_class' => $this->input->post('icon_class'),
			'show_menu' => $this->input->post('show_menu'),
			'target' => $this->input->post('target'),
			'is_parent' => $this->input->post('is_parent'),
		);
		$result = $this->menus->menu_insert($data);
		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Menu Added Successfully !');
			redirect('/Meenus/index', 'refresh');
		} else {
			$this->session->set_flashdata('failed', 'Already exists, Menu Could not added !');
			redirect('/Meenus/index', 'refresh');
		}
	}

	public function editmenu($id)
	{
		$this->form_validation->set_rules('menu_name', 'menu Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			if (isset($this->session->userdata['logged_in'])) {
				$this->index();
			} else {
				$this->load->view('login_form');
			}
		} else {
			$data = array(
				'menu_name' => $this->input->post('menu_name'),
				'parent_id' => $this->input->post('parent_id'),
				'url' => $this->input->post('url'),
				'controller' => $this->input->post('controller'),
				'action' => $this->input->post('action'),
				'icon_class' => $this->input->post('icon_class'),
				'show_menu' => $this->input->post('show_menu'),
				'target' => $this->input->post('target'),
				'is_parent' => $this->input->post('is_parent'),
			);
			$result = $this->menus->menu_update($data, $id);
			if ($result == TRUE) {
				$this->session->set_flashdata('success', 'Menu Updated Successfully !');
				redirect('/Meenus/index', 'refresh');
			} else {
				$this->session->set_flashdata('failed', 'No Changes in Menu!');
				redirect('/Meenus/index', 'refresh');
			}
		}
	}

	function delete($id)
	{
		$result = $this->menus->delete($id);
		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Menu deleted Successfully !');
			redirect('/Meenus/index', 'refresh');
		} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Meenus/index', 'refresh');
		}
	}

	function UserRights()
	{
		$data['title'] = 'User Rights Panel';
		$data['roles'] = $this->menus->getRoles();
		$data['employees'] = $this->menus->getEmployees();
		$this->template->load('template', 'template/user_rights', $data);
	}

	public function rolewisedata($id)
	{
		$data['menus'] = $this->menus->get_menus();
		$data['old_data'] = $this->menus->FindOldUserRightsRoles($id);
		$menu_ids = [];
		$userRightsIds = [];

		if (isset($data['old_data']['menu_ids']) && !empty($data['old_data']['menu_ids'])) {
			$menu_ids[] = explode(',', $data['old_data']['menu_ids']);
			foreach ($menu_ids as $key => $value) {
				foreach ($value as $key1 => $value1) {
					$userRightsIds[] = $value1;
				}
			}
		}
		$data['userRightsIds'] = $userRightsIds;
		echo json_encode($this->load->view('template/rolewisedata', $data));
	}

	public function employeewisedata($id)
	{
		$data['menus'] = $this->menus->get_menus();
		$data['old_data'] = $this->menus->FindOldUserRightsEmployees($id);
		$menu_ids = [];
		$userRightsIds = [];
		$menu_ids[] = explode(',', $data['old_data']['menu_ids']);
		foreach ($menu_ids as $key => $value) {
			foreach ($value as $key1 => $value1) {
				$userRightsIds[] = $value1;
			}
		}
		$data['userRightsIds'] = $userRightsIds;
		echo json_encode($this->load->view('rolewisedata', $data));
	}

	public function addEmployeeRights()
	{
		$employee_id = $this->input->post('employee_id');
		if (!empty($this->input->post('menu_id'))) {
			$menu_ids = implode(',', $this->input->post('menu_id'));
		} else {
			$menu_ids = '';
		}
		$data = array(
			'employee_id' => $employee_id,
			'menu_ids' => $menu_ids
		);
		$result = $this->menus->addUserRightsEmployee($data);
		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'User Rights Added Successfully !');
			redirect('/Meenus/UserRights', 'refresh');
		} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Meenus/UserRights', 'refresh');
		}
	}

	public function addRoleRights()
	{
		$role_id = $this->input->post('role_id');
		if (!empty($this->input->post('menu_id'))) {
			$menu_ids = implode(',', $this->input->post('menu_id'));
		} else {
			$menu_ids = '';
		}
		$data = array(
			'role_id' => $role_id,
			'menu_ids' => $menu_ids
		);
		$result = $this->menus->addUserRightsRole($data);
		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'User Rights Added Successfully !');
			redirect('/Meenus/UserRights', 'refresh');
		} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Meenus/UserRights', 'refresh');
		}
	}
}

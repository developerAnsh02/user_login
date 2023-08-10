<?php

class Master_Model extends CI_Model
{

	public function category_insert($data)
	{
		$condition = "category_name =" . "'" . $data['category_name'] . "'";
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			$this->db->insert('categories', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}

	public function add_offer()
	{
		$picture = array();
		$countfiles = count($_FILES['offer_images']['name']);

		for ($i = 0; $i < $countfiles; $i++) {
			if (!empty($_FILES['offer_images']['name'][$i])) {
				$_FILES['file']['name'] = $_FILES['offer_images']['name'][$i];
				$_FILES['file']['type'] = $_FILES['offer_images']['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES['offer_images']['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES['offer_images']['error'][$i];
				$_FILES['file']['size'] = $_FILES['offer_images']['size'][$i];
				$config['upload_path'] = './uploads/customers/';
				$config['allowed_types'] = '*';
				$config['max_size']    = '50000';
				$config['file_name'] = $_FILES['offer_images']['name'][$i];
				//Load upload library
				$this->load->library('upload', $config);
				// File upload
				if ($this->upload->do_upload('file')) {
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					$picture[] = $filename;
				} else {
					$picture[] = '';
				}
			} else {
				$picture[] = '';
			}
		}
		foreach ($picture as  $value) :
			$this->db->set('file_path', $value);
			$this->db->insert('offer_images');
		endforeach;
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function deleteoffer($id)
	{
		$this->db->where('id', $id);
		if ($this->db->delete('offer_images')) {
			return true;
		} else {
			return false;
		}
	}

	public function getByIdOfferImage($id)
	{
		$this->db->select('*');
		$this->db->from('offer_images');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function category_update($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('categories', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function categoriesList()
	{
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('flag', '0');
		$this->db->order_by("category_name", "asc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getOfferImages()
	{
		$this->db->select('*');
		$this->db->from('offer_images');
		$this->db->order_by("id", "asc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getByIdCategory($id)
	{
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	/////////////////////// Services Master ////////////////////

	public function service_insert($data)
	{
		$condition = "service_name =" . "'" . $data['service_name'] . "'";
		$this->db->select('*');
		$this->db->from('services');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			$this->db->insert('services', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}

	public function service_update($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('services', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function servicesList()
	{
		$this->db->select('*');
		$this->db->from('services');
		$this->db->where('flag', '0');
		$this->db->order_by("service_name", "asc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getByIdService($id)
	{
		$this->db->select('*');
		$this->db->from('services');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function formatting_insert($data)
	{
		$condition = "formatting_name =" . "'" . $data['formatting_name'] . "'";
		$this->db->select('*');
		$this->db->from('formattings');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			$this->db->insert('formattings', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} else {
			return false;
		}
	}

	public function formatting_update($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('formattings', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function formattingsList()
	{
		$this->db->select('*');
		$this->db->from('formattings');
		$this->db->where('flag', '0');
		$this->db->order_by("formatting_name", "asc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getByIdFormatting($id)
	{
		$this->db->select('*');
		$this->db->from('payment_details');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function paymentsList($limit = '', $start = '')
	{
		$this->db->select('*,payment_details.id as id, orders.order_id, employees.name, employees.mobile_no');
		$this->db->from('payment_details');
		$this->db->join('orders', 'orders.id = payment_details.order_id', 'left');
		$this->db->join('employees', 'employees.id = orders.uid', 'left');
		$this->db->limit($limit, $start);
		$this->db->order_by("payment_details.id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getByIdPayments($id)
	{
		$this->db->select('*');
		$this->db->from('formattings');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function failedJobList($conditions)
	{
		$limit = $conditions['limit'];
		$start = $conditions['start'];

		$this->db->select('*');
		$this->db->from('orders');

		if (isset($conditions['from_date']) && !empty($conditions['from_date'])) {
			$this->db->where('orders.order_date >=', $conditions['from_date']);
		}
		if (isset($conditions['upto_date']) && !empty($conditions['upto_date'])) {
			$this->db->where('orders.order_date <=', $conditions['upto_date']);
		}
		if (isset($conditions['writer_name']) && !empty($conditions['writer_name'])) {
			$this->db->where('orders.writer_name', $conditions['writer_name']);
		}
		if (isset($conditions['d_from_date']) && !empty($conditions['d_from_date'])) {
			$this->db->where('orders.delivery_date >=', $conditions['d_from_date']);
		}
		if (isset($conditions['d_upto_date']) && !empty($conditions['d_upto_date'])) {
			$this->db->where('orders.delivery_date <=', $conditions['d_upto_date']);
		}

		$this->db->where('orders.is_fail', '1');
		$this->db->join('employees', 'employees.id = orders.uid', 'left');
		$this->db->limit($limit, $start);
		$this->db->order_by("orders.id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getTotalCount($table = '$names', $colum = '', $names = '', $where = '')
	{
		$this->db->select('*');
		$this->db->from($table);
		if (isset($colum) && !empty($colum)) {
			$this->db->where_in($colum, $names);
		}
		if (isset($where) && !empty($where)) {
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
}

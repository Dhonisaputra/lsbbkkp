<?php
/**
* 
*/
class Brand extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('lib_login');
	}

	public function data_brand()
	{
		$this->load->model('company_model');
		$select = $this->input->post('select');
		$where = $this->input->post('where');
		$row_array = $this->input->post('row');
		$data = $this->company_model->data_brand($select, $where, $row);
		echo json_encode($data);
	}

	public function brand_company()
	{
		$this->load->model('company_model');
		$id_a0_cat = $this->input->post('id_a0_cat');
		$data = $this->company_model->get_spesific_brand_company($id_a0_cat);
		echo json_encode($data);
	}
}
<?php

/**
* 
*/
class Commodity extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('commodity_model');
		$this->load->helper('url');
		$this->load->library('lib_login');
		$this->lib_login->restriction_login();
	}

	public function index()
	{
		$this->load->view('templates/head', array('title' => 'Company'));

		$this->load->view('templates/navbar');

		$this->load->view('commodity/commodity_dashboard');

		$this->load->view('templates/footer');
	}		

	public function commodity_dashboard()
	{

	}

	/*process*/
	
	/*
	|---------------------
	| Get data a0_cat
	|---------------------
	*/
	public function data_scope($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('commodity');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}

	/*
	* 
	*/
	public function get_commodity()
	{
		$data = $this->commodity_model->get_commodity();
		echo json_encode($data);
	}

	public function add_commodity()
	{
		$data = $this->commodity_model->add_commodity($_POST);
		echo json_encode($data);
	}

	// U P D A T E ------------------------------------------------------------------------------------

	public function update_status_revoke_scope()
	{
		$data = array();
		$data['id_scope'] = $this->input->post('id_scope');
		$data['status_revoke'] = $this->input->post('status_revoke');
		$this->commodity_model->status_revoke_scope($data);
	}

	public function update_scope()
	{
		$data = array();
		$data['id_scope'] = $this->input->post('id_scope');
		$data['commodity_name'] = $this->input->post('commodity_name');
		$this->commodity_model->update_scope($data);
	}
}
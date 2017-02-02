<?php
/**
* 
*/
class Nace extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('nace_model');
	}

	// process
	public function items()
	{
		$this->nace_model->data_nace();
	}

	public function getUsedNace()
	{
		$a = $this->input->post('id_certificate');
		$nace = $this->nace_model->getUsedNace($a);
		echo json_encode($nace);
	}

	public function getUnusedNace()
	{
		$a = $this->input->post('id_certificate');
		$nace = $this->nace_model->getUnusedNace($a);
		echo json_encode($nace);
	}

	public function test()
	{
		$a = array(
		    '10' => array(
		        '4' => array(
		            '7' => 'value',
		            '9' => array(
		                '5' => 'value2'
		            ),
		            '5' => array(
		                '3' => 'value2'
		            )
		        )
		    )
		);

		$c = $this->nace_model->array_find_deep($a, '3');
		print_r($c);
	}

	// GET //////////////////////////////////////////////////////
	public function get_nace_json()
	{
		$nace = $this->nace_model->data_nace();
		echo json_encode($nace);
	}

	// UPDATE //////////////////////////////////////////////////////
	public function revoke_item()
	{
		$data = $this->input->post();
		$where['nace_item'] = $data['nace_item'];
		$update['revoke_nace'] = $data['revoke'];

		$this->nace_model->update_nace($update, $where);

	}

	public function update_data_nace()
	{
		$data = $this->input->post();
		$where['nace_item'] = $data["new_nace_item_code"];

		// $update['nace_parent'] = $data["new_nace_parent_code"];
		// $update['nace_type'] = $data["new_nace_parent_type"];
		$update['nace_name'] = $data["new_nace_item_name"];

		$this->nace_model->update_nace($update, $where);
	}

	////////////////////////////////////////////////////////////
	// INSERT //////////////////////////////////////////////////////
	public function insert_new_item()
	{
		$data = $this->input->post();
		$this->nace_model->insert_new_item($data);
	}
	////////////////////////////////////////////////////////////
}
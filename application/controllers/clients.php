<?php
/**
* 
*/
class Clients extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('clients_model');
		$this->load->library('lib_login');
		// $this->lib_login->restriction_login();
		
	}



	// Process //////////////////////////////////////////////////////////
	/*
	| function countries
	| desc: function to get client country
	*/
	private function helper__countries($data, $id)
	{

	}
	public function countries($scope = "GET")
	{
		$data = $this->clients_model->countries($scope);
		if(!empty($id))
		{

		}
		echo json_encode($data);
	}
}
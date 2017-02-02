<?php
/**
* 
*/
class Clients_model extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('dataakses');
	}

	public function countries($scope = 'GET')
	{
		switch (strtolower($scope) ) {
			case 'get':
				return $this->dataakses->SQL('SELECT * FROM countries');
				
				break;
			
			default:
				# code...
				break;
		}
	}
}
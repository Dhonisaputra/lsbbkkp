<?php
/**
* 
*/
class Invoice extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('lib_login');
	}

	
}
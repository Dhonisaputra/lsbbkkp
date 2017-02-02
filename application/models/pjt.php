<?php

/**
* 
*/
class Pjt extends CI_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->helper('url');

		$this->load->library('lib_login');

	}

	public function dashboard()
	{
		$this->load->view('templates/head', array('title' => 'Dashboard Auditor'));
		$this->load->view('pjt/pjt--dashboard' );
		$this->load->view('templates/footer');
	}
}
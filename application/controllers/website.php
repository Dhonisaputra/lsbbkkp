<?php
/**
* 
*/
class Website extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('website/components/head', array('title'=> 'LSSM BBKKP - YOQA -- index'));
		$this->load->view('website/components/navbar');
		$this->load->view('website/index');

	}

	public function signup()
	{
		$this->load->view('templates/headsource', array('title' => 'create new company'));

		$this->load->view('company/company_create--index');


	}

}
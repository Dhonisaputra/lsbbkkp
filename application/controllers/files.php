<?php
/**
* 
*/
class Files extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('files_model');
	}

	public function download_file($file)
	{
		$this->load->helper('download');

		$file = $this->files_model->get_file($file)[0];
		$data = file_get_contents($file['file_path'].$file['file_name']); // Read the file's contents
		$name = $file['client_name'];
		force_download($name, $data);
	}
}
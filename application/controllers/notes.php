<?php
/**
* 
*/
class Notes extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('notes_model');
	}

	public function get_notes()
	{
		$post = empty($this->input->post('params'))? array() : $this->input->post('params');
		$notes = $this->notes_model->get_notes($post);
		if(  $this->input->post('returnAs') == 'json')
		{
			echo json_encode($notes);
		}else
		{
			return $notes;
		}
	}
}
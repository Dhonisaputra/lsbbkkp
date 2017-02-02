<?php
/**
* 
*/
class Notes_model extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->database();
		$this->load->library('dataakses');

	}

	public function get_notes($where = array())
	{
		$this->load->model('files_model');

		if( count($where) > 0 )
		{
			$query = $this->db->get_where('notes_log', $where);
		}else
		{
			$query = $this->db->get('notes_log');
		}

		if( count( $query->result_array() > 1 ) )
		{
			$result = $query->result_array();
			foreach ($result as $key => $value) {
				
				if( !empty($value['attachments']) )
				{
					$files = explode(',', $value['attachments']);
					foreach ($files as $fkey => $fvalue) {
						$result[$key]['files'] = $this->files_model->get_file($fvalue);
					}
				}

			}

			return $result;
		}else
		{
			$result = $query->row_array();
			if( !empty($value['attachments']) )
			{
				$files = explode(',', $value['attachments']);
				foreach ($files as $fkey => $fvalue) {
					$result[$key]['files'] = $this->files_model->get_file($fvalue);
				}
			}
			return $result;
		}

	}

	public function insert_notes_log($data)
	{
		$this->db->insert('notes_log', $data);
		return $this->db;
	}


	/*
	* create confirmation assessment notes
	*/
	public function create_confirmation_assessment_notes($data, $files)
	{
		$this->load->model('files_model');
		$attachments = $this->create_confirmation_assessment_notes_attachments($data['id_company'], $files);
		$data['notes_for_type'] = isset( $data['notes_for_type'] )? $data['notes_for_type'] : 0;
		$attachments = implode(',', $attachments);

		$insertNotes = $this->dataakses->SQL('INSERT INTO notes_log (notes_reference_id, notes_content, notes_status, notes_for_type, attachments) values (?,?,?,?,?)', 'issis', $data['notes_reference_id'], $data['explanation'], $data['new_status'], $data['notes_for_type'], $attachments);
		// echo 'INSERT INTO notes_log (notes_reference_id, notes_content, notes_status, notes_for_type, attachments) values ('.$data['notes_reference_id'].',"'.$data['explanation'].'","'.$data['new_status'].'",'.$data['notes_for_type'].',"'.$attachments.'")';
		
	}

	/*
	* requirements
		- type assessment [newassessment, reassessment],
		- certification [JPA-00#, JECA-00#, YQ-00#],
		- id_a0, 
		- $_FILES

	*/
	public function create_confirmation_assessment_notes_attachments($id_company, $files)
	{
		$file_records = array();
		$this->load->model('company_model');

		$this->load->library('upload');
		$config['upload_path'] 		= $this->company_model->COMPANY_DIRECTORY.$id_company.'/files/';
		$config['encrypt_name']		= TRUE;
		$config['allowed_types'] 	= '*';

		foreach ($files as $key => $value) {
			
			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload($key))
			{
				$error = array('error' => $this->upload->display_errors());
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				$file = $this->upload->data();
				$file = $this->files_model->save_file($file);

				// simpan pada filerecords
				array_push($file_records, $file);
			}
		}

		return $file_records;
	} 

}
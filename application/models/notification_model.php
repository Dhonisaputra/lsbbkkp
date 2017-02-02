<?php
/**
* 
*/
// notification company -- new company registered
// notification company -- company has been uploaded documents
// notification company -- company updated 
// notification is new certification request
// notification is pjt has been accepted new certification request
// notification is pjt has been accepted new certification request
// notification is auditor want new competency updated
// notification is auditor want to add new education

/*
|-----------
| Kind of level users
|-----------
1 = Admin
2 = Auditor
3 = PJT
4 = perusahaan
100 = master admin
*/

class Notification_model extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->database();
		$this->load->library('lib_login');
		$this->load->library('cookies');

	}

	public function data_notification($select = '*', $where = array())
	{
		$this->db->select($select);
		$this->db->from('notification');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		return $this->db->get();
	}

	/*
	|-------------------
	| Function to send notification for specific users
	|-------------------
	|
	| @params_structure = $level, $text, $url;
	|
	| @params @array || like @params_structure
	*/
	public function for_level()
	{
		$args = func_get_args();
		$params = array();

		if(!is_array($args[0]))
		{
			$this->insert_notification(array(
				'notification_text' 	=> $args[1],
				'notification_for_level'=> $args[0],
				'notification_link' 	=> $args[2]	
			));

		}else
		{
			foreach ($args as $key => $value) {
				$this->insert_notification(array(
					'notification_text' 	=> $value[1],
					'notification_for_level'=> $value[0],
					'notification_link' 	=> $value[2]
				));
			}
		}
	}

	/*
	|-------------------
	| Function to send notification for specific users
	|-------------------
	|
	| @params_structure = $id_user, $level, $text, $url;
	|
	| @params @array || like @params_structure
	*/
	public function for_user()
	{
		$args = func_get_args();
		$params = array();

		if(!is_array($args[0]))
		{
			$this->insert_notification(array(
				'notification_text' 	=> $args[2],
				'notification_for_level'=> $args[1],
				'notification_for_user'	=> $args[0],
				'notification_link' 	=> $args[3]
			));
		}else
		{
			foreach ($args as $key => $value) {
				$this->insert_notification(array(
					'notification_text' 	=> $value[2],
					'notification_for_level'=> $value[1],
					'notification_for_user' => $value[0],
					'notification_link' 	=> $value[3]
				));
			}
		}
		print_r($params);
	}

	public function send_notification($data)
	{
		$this->load->model('users_model');
		$this->load->model('auditor_model');
		$this->load->model('company_model');

		$issetUser 	= isset($data['notification_for_user']);
		$level 		= $data['notification_for_level'];
		$receiver 	= '';

		if(!$issetUser)
		{

			$users = $this->users_model->data_users('*', array('level' => $level) )->result_array();
			if( count($users) > 0 )
			{
				$users = array_column($users, 'id_users');
				$receiver = $users;
			}else{
				$company = $this->company_model->data_company('*', array('company_level' => $level ));
				if( count($company) > 0 )
				{
					$company = array_column($company, 'id_company');
					$receiver = $company;
				}else{
					$auditor = $this->auditor_model->data_auditor('*', array('auditor_level' => $level ));
					$auditor = array_column($auditor, 'id_auditor');
					$receiver = $auditor;
				}
			}
		}else
		{
			$receiver = array($data['notification_for_user']);
		}


		foreach ($receiver as $key => $value) {
			$data['notification_for_user'] = $value;
			$this->insert_notification($data);
		}

	}

	public function insert_notification($data)
	{
		$this->db->insert('notification', $data);
		return $this->db;
	}

	public function update_notification($update, $where)
	{
		$this->db->where($where);
		$this->db->update('notification', $update); 
	}

}
<?php
/**
* 
*/
class Notification extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('notification_model');
		$this->load->helper('url');
	}

	public function send()
	{
		$post = $this->input->post();
		$this->notification_model->send_notification($post);
	}

	public function test()
	{
		$this->notification_model->for_level( 2, $_SESSION['username'].' Memanggil anda semua untuk melakukan verifikasi ulang ',site_url('pjt/panel/schedules/detail/assessment/1') );
	}

	public function get_notification()
	{
		$action = $this->input->post('action');
		$notification_id = $this->input->post('notification_id');
		$notification_timestamp = $this->input->post('notification_timestamp');

		$level = $_SESSION['level'];
		$user = $_SESSION['id_users'];
		$userText = '';
		if(!empty($user) )
		{
			$userText .= ' AND (notification_for_user = '.$user.' OR notification_for_user IS NULL)';
		}
		
		if($action == 'load_more')
		{
			$userText .= ' AND notification_id > '.$notification_id.' AND notification_timestamp < "'.$notification_timestamp.'"';
		}

		$notif = $this->notification_model->data_notification('*','notification_for_level = '.$level.$userText.' and notification_status = 0 ORDER BY notification_timestamp DESC LIMIT 10');
		// echo $this->db->last_query();
		$notif = $notif->result_array();
		echo json_encode($notif);
	}

	public function update()
	{
		$update = $this->input->post('update');
		$where = $this->input->post('where');
		$this->notification_model->update_notification($update, $where);
	}

}
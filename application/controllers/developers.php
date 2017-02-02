<?php
/**
* 
*/
class Developers extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('tools');
		$this->load->helper('url');
		$this->load->library('profiling/Pengguna');

	}


	public function send_error()
	{	
		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'cplusco.developers@gmail.com',
		    'smtp_pass' => 'tamansafari1945',
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		// Set to, from, message, etc.

		$this->email->from('developers@yoqa.com', 'Yoqa Developers Report');
		$this->email->to('cplusco.developers@gmail.com'); 

		$this->email->subject('Yoqa Error Notifier');
		$time = strtotime( date('Y-m-d H:i:s') );

		$this->email->message($_POST['message']);	

		$this->email->send();
	}

	public function calculator_auditor()
	{
		
	}
	public function truncate($what = 'a0, a0_cat, assessment_collective, assessment_collective_participant, auditor_log, brand, certificate, certification_request, email_log, issued, lampiran, master_files, notes_log, rs, rs_schedule' )
	{
		if(!$this->pengguna->has_level(1) || $this->pengguna->is_login() == false)
		{
			die('error, please login!');
		}else
		{
			
			$this->load->database();
			$whatRecords = explode(',', $what);
			foreach ($whatRecords as $key => $value) {
				$value = trim($value);
				$this->db->truncate($value);
			}
		}
	}
	public function testermail()
	{
		$to      = 'dhoni.p.saputra@gmail.com';
		$subject = 'the subject';
		$message = '
		<html>
		<head>
		  <title>Birthday Reminders for August</title>
		</head>
		<body>
		  <p>Here are the birthdays upcoming in August!</p>
		  <table>
		    <tr>
		      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
		    </tr>
		    <tr>
		      <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
		    </tr>
		    <tr>
		      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
		    </tr>
		  </table>
		</body>
		</html>
';

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";

		if(!mail($to, 'My Subject', $message, $headers) )
		{
			show_error('email not send',500);
		}else
		{
			show_error('email send',400);

		}
	}

	public function test_tracker()
	{
		$trackerStatus = array(
				'TRC-1' => 'Silahkan pilih sertifikasi yang ingin diajukan',
				'TRC-2' => 'Silahkan upload nota pembayaran',
				'TRC-3' => 'Permintaan sertifikasi sedang di periksa oleh LSBBKKP-YOQA',
				'TRC-4' => 'Silahkan lengkapi kelengkapan dokumen',
				'TRC-5' => 'Menunggu waktu pelaksanaan sertifikasi',
				'TRC-6' => 'Sertifikasi sedang dilaksanakan',
				'TRC-7' => 'Menunggu hasil sertifikasi',
				'TRC-7' => 'Hasil sertifikasi diterbitkan',
				'TRC-8' => 'Silahkan tentukan hari dilaksanakan assessment.',

			);
		
	}

	public function pusher()
	{
		$data = $this->dataakses->SQL('SELECT * FROM users');

	}
}
<?php

/*
* Company View and Return data
* 

# Process
- 
*/
class Company extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('company_model');
		$this->load->library('lib_login');
		$this->load->library('profiling/Pengguna');

		$this->isAjax = $this->input->is_ajax_request();
		
	}

	// tampilkan daftar company
	public function index()
	{
		$this->lib_login->restriction_login();
		$this->load->library('user_agent');
				
		if(!$this->isAjax)
		{
			$this->load->view('templates/head', array('title' => 'Company'));
		}


		$this->load->view('company/dashboard__company_create');

		if(!$this->isAjax)
		{
			$this->load->view('templates/footer');
		}
	}

	public function open_company($id_company)
	{
		$data_company = $this->company_model->data_company('*', array('id_company' => $id_company));
		if(count($data_company) < 1)
		{
			show_404();
			return false;
		}
		
		$this->lib_login->restriction_login();
		$this->load->library('user_agent');

		$dataCompany = $this->company_model->get_spesific_company($id_company);

		$assessment_list = $this->company_model->data_assessment($id_company);

		$this->load->view('templates/head', array('title' => $dataCompany['company_name']));

		$this->load->view('company/profile_dashboard', array('company' => $dataCompany, 'assessment' => $assessment_list) );

		$this->load->view('templates/footer');
	}

	public function signup()
	{

		if(isset($_SESSION['id_users']))
		{
			$this->load->view('templates/head', array('title' => 'create new company'));
		}else{
			$this->load->view('templates/headsource', array('title' => 'create new company'));
		}

		$this->load->view('company/company_create--index');

		if(isset($_SESSION['id_users']))
		{
			$this->load->view('templates/footer');
		}
	}

	public function create_brand($id_company)
	{
		$this->lib_login->restriction_login();
		$dataCompany = $this->company_model->get_spesific_company($id_company);

		$this->load->model('certification_model');

		$this->load->view('templates/head', array('title' => 'create new brand'));

		$this->load->view('templates/navbar');

		$this->load->view('company/brand_create', array( 'id_company' => $id_company, 'data_company' => $dataCompany ));

		$this->load->view('templates/footer');
	}

	public function account_settings($id_company)
	{
		require_once(APPPATH.'libraries/profiling/Session.php');
		$Sess = new Session;

		$company = $this->company_model->data_company('*', array('id_company' => $id_company) );
		if(count($company) < 1)
		{
			show_404();
		}
		$company = $company[0];

		$this->lib_login->restriction_login();

		$this->load->view('templates/head', array('title'=> 'Settings - '.$company['company_name']));

		$this->load->view('company/perusahaan_settings', array('company' => $company));		

		$this->load->view('templates/footer');
	}

	public function add_certification($id_company, $id_brand)
	{
		$this->lib_login->restriction_login();
		$this->load->view('templates/head', array('title' => 'add new certification'));

		$this->load->view('templates/navbar');

		$this->load->view('company/brand_add_certification', array('id_company' => $id_company, 'id_brand' => $id_brand) );

		$this->load->view('templates/footer');
	}


	public function login()
	{
		$this->lib_login->exceptional_login();
		$this->load->view('templates/headsource', array('title'=> 'Login Perusahaan'));
		
		$this->load->view('company/login_perusahaan');
		$this->load->view('templates/footer');
	}

	public function upload_company_by_excel()
	{
		if(!$this->isAjax)
		{

			$this->load->view('templates/head', array('title'=> 'Upload perusahaan' ));
		}
		
		$this->load->view('company/company_create--upload-excel');

		if(!$this->isAjax)
		{
			$this->load->view('templates/footer');
		}

	}

	// P E R U S A H A A N -- P A N E L

	/*
	|---------------
	| Perusahaan panel dashboard
	|---------------
	*/

	public function dashboard()
	{
		if($this->pengguna->has_level(4) == false)
		{
			header('location:'.site_url(''));
		}

		$company = $this->company_model->data_company('*', array('id_company' => $_SESSION['id_company']), 0 );

		$this->load->view('templates/head', array('title'=> $company['company_name']));
		
		$this->load->view('company/perusahaan--panel--dashboard', array('company' => $company));		
		
		$this->load->view('templates/footer');
	}
	
	/*
	|---------------
	| Perusahaan panel settings
	|---------------
	*/

	public function perusahaan_panel_settings()
	{
		if($this->pengguna->has_level(4) == false)
		{
			header('location:'.site_url(''));
		}

		$company = $this->company_model->data_company('*', array('id_company' => $_SESSION['id_company']), 0 );

		$this->load->view('templates/head', array('title'=> $company['company_name']));
		
		$this->load->view('company/perusahaan--panel--settings', array('company' => $company));		
		
		$this->load->view('templates/footer');
	}

	/*
	|---------------
	| Perusahaan panel detail schedules
	|---------------
	*/

	public function perusahaan_panel_detail_schedules($type, $id_a0)
	{
		$this->load->model('assessment_model');
		$this->load->model('company_model');

		if($this->pengguna->has_level(4) == false)
		{
			header('location:'.site_url(''));
		}

		$company = $this->company_model->data_company('*', array('id_company' => $_SESSION['id_company']), 0 );
		$a0 = $this->assessment_model->data_a0('*', array('id_a0' => $id_a0), 0 );

		$this->load->view('templates/head', array('title'=> $company['company_name']));
		
		$this->load->view('company/perusahaan--panel--detail-schedules--a0', array('id_a0' => $id_a0, 'company' => $company, 'a0' => $a0));		
		
		$this->load->view('templates/footer');
	}

	/*
	|
	| DAFTAR PERMINTAAN SERTIFIKASI
	|
	*/
	
	public function ajukan_permintaan_sertifikasi($id_company)
	{
		$this->load->model('certification_model');
		$company = $this->company_model->data_company('*', array('id_company' => $id_company), 0 );
		$master_kelengkapan = $this->certification_model->data_master_kelengkapan_permintaan('*', array('peruntukan' => 'perusahaan', 'show_first' => 1) )->result_array();

		if(!$this->isAjax)
		{
			$this->load->view('templates/head', array('title'=> 'Ajukan permintaan baru'));
		}
		
		$this->load->view('company/panel--ajukan-permintaan-sertifikasi', array( 'company' => $company, 'master_kelengkapan' => $master_kelengkapan ));
		
		if($this->isAjax)
		{
			$this->load->view('templates/footer');
		}
	}
	/*
	|
	| DETAIL PERMINTAAN SERTIFIKASI
	|
	*/
	public function detail_pengajuan_permintaan_sertifikasi($id_company, $id_permintaan_sertifikasi)
	{
		$this->load->model('certification_model');
		$this->load->model('assessment_model');
		$this->load->model('invoice_model');
		$this->load->model('files_model');
		
		$kelengkapan = $this->certification_model->get_kelengkapan_sertifikasi_perusahaan($id_company, $id_permintaan_sertifikasi);
		// ambil id files dari detail untuk pengecheckan data kelengkapan dokumen
		$docs_payment = array();
		if( !is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['id_invoice']) )
		{
			$docs_payment = $this->invoice_model->data_invoice_detail('*', array('id_invoice' => $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_invoice'] ))->result_array();
		}
		
		if( !is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['id_a0']) )
		{
			$a0_cat = $this->assessment_model->datasource_assessment($kelengkapan['kelengkapan_permintaan_sertifikasi']['id_a0']);
		}

		$notes = array();
		if(!is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['id_a0']) && !is_null($a0_cat['a0']['a0_notes']))
		{
			$notes = explode(',', $a0_cat['a0']['a0_notes']);
			$notes = implode(' OR notes_log_id = ', $notes);
			$notes = $this->db->query('SELECT * FROM notes_log where notes_log_id = '.$notes." order by notes_addtime DESC")->result_array();
		}
		
		$company = $this->company_model->data_company('*', array('id_company' => $id_company), 0 );

		// print_r($a0_cat);
		// STATUS
		$this->load->view('templates/headsource', array('title'=> 'Detail pengajuan permintaan baru'));
		
		$this->load->view('company/panel--detail-ajukan-permintaan-sertifikasi', array(
			'company' 		=> $company, 
			'kelengkapan' 	=> $kelengkapan,
			'payment' 		=> $docs_payment,
			'request' 		=> @$a0_cat,
			'notes' 		=> @$notes,
			)
		);
	}

	/*processing ===========================*/

	/*
	|
	| Company COntact Get 
	|
	| @params 
	| - POST :id_company value id_company 
	*/
	public function get_company_contacts()
	{
		$id_company = $_POST['id_company'];
		$data = $this->company_model->data_company_contact('*', array('id_company' => $id_company));
		echo json_encode($data);
	}

	/*
	* function get certification some company
	* status : used
	*/
	public function get_certification_company($id_company = 0)
	{
		$this->lib_login->restriction_login();
		$data = $this->company_model->data_assessment($id_company);
		echo json_encode($data);
	}

	public function get_check_availability_company_name()
	{
		$this->lib_login->restriction_login();
		$this->company_model->check_availability_company($_POST['company_name']);
	}

	public function get_check_availability_company_email()
	{
		$this->company_model->check_availability_company_email($_POST['email']);
	}

	/*
	* function create new company
	* parameters
		- company_name
		- company_address
		- company_post
		- email
		- country
		- telephone
		- company_fax
		- company_cp_name[]
		- company_cp_phone[]
		- company_cp_ext[]

		* sign [] meaning parameters can fill more than 1 value.

	*/
	public function create_new_company()
	{

		$this->load->model('users_model');
		$this->load->model('notification_model');
		require_once(APPPATH.'libraries/profiling/Pengguna.php');
		$user = new Pengguna;

		$randPass = bin2hex(openssl_random_pseudo_bytes(4));
		$user = $user->create_account(array('password' => $randPass ));	
		$keychain = $this->users_model->save_keychain($user['key_A'], $user['key_B']);

		$data = $this->company_model->create_company(array(
			'company_name' 		=> $_POST['company_name'],
			'company_address' 	=> $_POST['company_address'],
			'company_post' 		=> $_POST['company_postzip'],
			'email' 			=> $_POST['company_email'],
			'country_code' 		=> $_POST['country_code'],
			'telephone' 		=> $_POST['company_telephone'],
			'company_fax' 		=> $_POST['company_fax'],
			'company_province' 	=> $_POST['company_province'],
			'company_region' 	=> $_POST['company_city'],
			
			'company_employee' 	=> $_POST['company_employee'],
			'company_shift' 	=> $_POST['company_shift'],
			'company_karyawan_tetap' 		=> $_POST['company_karyawan_tetap'],
			'company_karyawan_tidak_tetap' 	=> $_POST['company_karyawan_tidak_tetap'],
			'status_perusahaan' => $_POST['status_perusahaan'],
			'luas_bangunan' 	=> $_POST['luas_bangunan'],
			'luas_tanah' 		=> $_POST['luas_tanah'],

			'nama_wakil_management' => $_POST['nama_wakil_manajemen'],
			'akta_pendirian' 		=> $_POST['akta_pendirian'],
			'nama_pemilik' 			=> $_POST['nama_pemilik'],
			'nama_pimpinan' 		=> $_POST['nama_pimpinan'],
			
			'keychain' 			=> $keychain,
			'company_password'	=> $user['password'],
			'password_raw'		=> $randPass,

		));
		
		for ($i=0; $i < count($_POST['company_cp_name']); $i++) { 
			$this->company_model->add_contact( $data['id_company'], $_POST['company_cp_name'][$i], $_POST['company_cp_phone'][$i], $_POST['company_cp_ext'][$i] );
		}
		
		echo json_encode($data);
	}

	public function create_new_brand()
	{
		$this->lib_login->restriction_login();
		$brand = $this->company_model->save_brand($_POST);
		echo json_encode($brand);
	}

	/*
	* function update brand
	* 
	* function status : used
	*/

	function process__update_brand()
	{
		$this->lib_login->restriction_login();
		$this->company_model->update_brand($_POST);
	}

	/*
	* function update company
	*
	* status : used
	*/
	function process__update_company()
	{
		$this->lib_login->restriction_login();
		$args = func_get_args();
		switch ($args[0]) {
			case 'email':
				$email = $_POST['email'];
				$id_company = $_POST['id_company'];
				$this->company_model->update_company(array('id_company' => $id_company), array('email' => $email) );
				break;
			case 'remove_contact':
				// echo json_encode($_POST);
				$this->company_model->delete_contact(array('id_company' => (int)$_POST['id_company'], 'contact_number' => $_POST['no_telp'] ) );
				break;

			case 'add_contact':
				// echo json_encode($_POST);
				$this->company_model->add_contact( $_POST['id_company'], $_POST['name'], $_POST['number'], $_POST['ext'] );
				break;

			case 'update_contact':
				$number = $_POST['number'];
				$old_number = $_POST['old_number'];
				$name = $_POST['name'];
				$ext = $_POST['ext'];
				$id_company = $_POST['id_company'];

				$this->company_model->update_contact(array('id_company' => $id_company, 'contact_number' => $old_number), array('contact_number' => $number, 'contact_name'=> $name, 'ext'=> $ext));
				break;

				case 'update_address':
				$company_address = $_POST['company_address'];
				$company_post = $_POST['company_postzip'];
				$company_region = $_POST['company_city'];
				$id_company = $_POST['id_company'];
				$this->company_model->update_company(array('id_company' => $id_company), array('company_address' => $company_address, 'company_post' => $company_post, 'company_region' => $company_region) );

				break;
			
			default:
				# code...
				break;
		}
		// $this->company_model->update_company($_POST);
	}
	/*
	|------------------------
	| Function request new certification
	|------------------------
	|
	| @params
	| - id_company
	| - data requested
	*/
	public function request_certification()
	{
		$this->lib_login->restriction_login();
		$post = $this->input->post();
		$this->load->model('certification_model');

		$request = $this->certification_model->pre_save_certification($post);
			
		echo json_encode($request);
	}

	public function resend_email_confirmation_request()
	{

		$this->load->model('certification_model');
		$this->certification_model->send_email_assessment_date($_POST['id_company'], $_POST['a0_id'], $_POST['data']);

	}

	public function get_all_company($options = array())
	{
		
		$this->lib_login->restriction_login();
		$this->load->library('dataakses');

		$options['return'] = !isset($options['return'])? 'json' : 'array';
		$id_company = $this->input->post('id_company');
		
		if( isset($_POST['id_company']) )
		{
			$data = $this->company_model->get_company($id_company);
			$type = $this->dataakses->SQL('SELECT GROUP_CONCAT(DISTINCT TYPE) as type FROM a0_cat JOIN a0 USING(id_a0) WHERE id_company = ?', 'i', $id_company);
			$data['requested'] = explode(',', $type[0]['type']);
		}else
		{
			$data = $this->company_model->get_company();
			foreach ($data as $key => $value) {			
				$type = $this->dataakses->SQL('SELECT GROUP_CONCAT(DISTINCT TYPE) as type FROM a0_cat JOIN a0 USING(id_a0) WHERE id_company = ?', 'i', $value['id_company']);
				$data[$key]['requested'] = explode(',', $type[0]['type']);
			}
		}
		switch ($options['return']) {
			case 'json':
				echo json_encode($data);
				break;
			
			default:
				return $data;
				break;
		}
	}

	public function get_brand($id_company, $return = 'json')
	{
		
		$this->lib_login->restriction_login();
		$data = $this->get__brand_by('id_company', $id_company);

		switch ($return) {
			case 'json':
				echo json_encode($data);
				break;

			case 'datatable':

				$result['data'] = array();
				foreach ($data as $key => $value) {
					array_push($result['data'], array($key+1, $value['brand_name'], $value['commodity_name']));
				}

				// $result = ( count($data) > 0 )? $result : $empty;
				echo json_encode($data);
				break;

			default:
				# code...
				break;
		}
	}


	/*
	* function get brand by type
	*/
	public function get__brand_by($by = 'id_company', $value)
	{
		$this->lib_login->restriction_login();
		$return_in = isset($_REQUEST['return_in'])?$_REQUEST['return_in'] : 'array' ;
		$data = $this->company_model->get_brand();
		$result = array();

		foreach ($data as $data) {
			if( $data[$by] == $value )
			{
				array_push($result, $data);
			}
		}

		switch ($return_in) {
			case 'array':
				return $result;
				break;

			case 'json':
				echo json_encode($result);
				break;
			
			default:
				# code...
				break;
		}
	}

	

	public function get_commodity($id_company, $return = 'json')
	{
		
		$this->lib_login->restriction_login();
		$data = $this->company_model->get_spesific_commodity_company($id_company);

		switch ($return) {
			case 'json':
				echo json_encode($data);
				break;

			case 'datatable':

				// $result['data'] = array();
				// $empty = array(
				// 		"iTotalRecords" => 0,
				// 		"iTotalDisplayRecords"=> 0,
				// 		"aaData" => array()
				// 	);
				// foreach ($data as $key => $value) {
				// 	array_push($result['data'], array($key+1, $value['brand_name'], $value['commodity_name']));
				// }

				// // $result = ( count($data) > 0 )? $result : $empty;
				// echo json_encode($result);
				break;

			default:
				# code...
				break;
		}
	}

	public function get_divisi($id_company, $return = 'json')
	{
		
		$this->lib_login->restriction_login();
		$data = $this->company_model->get_spesific_divisi_company($id_company);

		switch ($return) {
			case 'json':
				echo json_encode($data);
				break;

			case 'datatable':

				// $result['data'] = array();
				// $empty = array(
				// 		"iTotalRecords" => 0,
				// 		"iTotalDisplayRecords"=> 0,
				// 		"aaData" => array()
				// 	);
				// foreach ($data as $key => $value) {
				// 	array_push($result['data'], array($key+1, $value['brand_name'], $value['commodity_name']));
				// }

				// // $result = ( count($data) > 0 )? $result : $empty;
				// echo json_encode($result);
				break;

			default:
				# code...
				break;
		}
	}

	public function get_assessment()
	{
		$this->lib_login->restriction_login();
		$id_brand =  isset($_GET['id_brand'])?$_GET['id_brand'] : 0;
		$return = isset($_GET['return'])?$_GET['return'] : 'json';
		$data = $this->company_model->data_assessment($id_brand);
		switch ($return) {
			case 'json':
				echo json_encode($data);
				break;

			case 'debug':
				print_r($data);
				break;
			
			default:
				# code...
				break;
		}
	}

	public function upload_excel_company()
	{
		$file = fopen($_FILES['file-1']['tmp_name'], "r");
		$emapData = fgetcsv($file, 10, ",");

		foreach ($emapData as $key => $value) {
			
			print_r($value);
		}
		/*

		$emapData = fgetcsv($file, 10000, ",");
		print_r($emapData);*/
	}

	// END GET ///////////////////////////////////////////////////////////////////////////////


	public function check_availability_brandName()
	{
		$data = $this->company_model->check_availability_brandName($_POST);
		echo json_encode($data);

	}


	public function send_mail_company()
	{
		

		$this->lib_login->restriction_login();
		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'cplusco.developers@gmail.com',
		    'smtp_pass' => '6285728256529',
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		// Set to, from, message, etc.

		$this->email->from('developers@cplusco.com', 'cplusco developers');
		$this->email->reply_to('dellacroug@gmail.com', 'dellacroug-bot-mail');
		$this->email->to('cplusco.developers@gmail.com, aiken.wighnantaka@cplusco.com'); 
		// $this->email->to('aiken.wighnantaka@cplusco.com'); 

		$this->email->subject('Test Email');
		$this->email->message('if you can see this email, please reply "OK"');	

		$this->email->send();

		echo $this->email->print_debugger();

		// end
	}

	public function authenticationLogin()
	{
		$data = $this->company_model->authenticationLogin($_POST);
		echo json_encode($data);
	}

	public function change_password_perusahaan()
	{
		$newPassword = $this->input->post('newPassword');
		$oldPassword = $this->input->post('old_password');
		
		$this->load->model('users_model');
		$company = $this->company_model->data_company('*', array('id_company' => $_SESSION['id_company']), 0 );
		$key = $this->company_model->authenticationLogin(array('username' => $company['email'], 'password' => $oldPassword ));
		
		// rehash new password
		$newpassword = $this->pengguna->hash_content($newPassword, $key['fkey'], $key['skey']);

		$update = array('company_password' => $newpassword);
		$where = array('id_company' => $company['id_company']);
		$this->company_model->change_password_perusahaan($update, $where);
	}

	private function save_password_perusahaan()
	{

	}

	public function reset_password_perusahaan()
	{
		// punya level perusahaan, dilarang masuk ke sini.
		if(!$this->pengguna->has_level(1))
		{
			show_404();
		}

		$id_company = $this->input->post('id_company');

		// load user model
		$this->load->model('users_model');

		// get data company
		$company = $this->company_model->data_company('*', array('id_company' => $id_company), 0 );
		
		// random some pass
		$randPass = bin2hex(openssl_random_pseudo_bytes(4));
	
		// get keychain
		$key = $this->users_model->get_keychain($company['keychain']);
		
		// hash mew password
		$newpassword = $this->pengguna->hash_content($randPass, $key['fkey'], $key['skey']);

		$update = array('company_password' => $newpassword);
		$where = array('id_company' => $company['id_company']);
		$this->company_model->change_password_perusahaan($update, $where);

		$this->company_model->send_email_after_reset_company_password(array(
			'email' => $company['email'],
			'company_name' => $company['company_name'],
			'company_password' => $randPass,
		));
	}

	/*
	
	@params 
	- type [assessment / reassessment]
	- id [id_rs_schedule / id_a0]
	*/
	public function process_confirm_from_company_dashboard($type, $id)
	{
		if(!$this->pengguna->has_level(4))
		{
			show_error('sorry, please login first!', 500, 'Error on fetching page');
		}

		$this->load->model('assessment_model');
		$this->load->library('hash');

		if($type === 'assessment')
		{
			$data = $this->assessment_model->data_a0('*', array('id_a0' => $id), 0);
			$data['cleanToken'] = $this->hash->encode_token_link($data['token']);
			header('location: '.site_url('assessment/confirmation/'.$data['id_a0'].'/'.$data['cleanToken']));
		}elseif ($type === "reassessment") {
			$rs = $this->assessment_model->data_rs('*', array('id_rs_schedule' => $id), 0);
			$rs_schedule = $this->assessment_model->data_rs_schedule('*', array('id_rs_schedule' => $id), 0);
			$rs_schedule['cleanToken'] = $this->hash->encode_token_link($rs_schedule['token']);
			header('location: '.site_url('assessment/lanjutan/'.$rs['id_rs'].'/'.$rs_schedule['cleanToken']));
		}

	}

	public function assessmentDocumentUpload()
	{
		$this->load->model('assessment_model');
		$this->load->model('files_model');

		$id_a0 = $this->input->post('id_a0');

		$a0 = $this->assessment_model->data_a0('*', array('id_a0' => $id_a0), 0 );
		$documents = explode(',', $a0['documents'] );

		$this->load->library('upload');
		$config['upload_path'] 		= $this->company_model->COMPANY_DIRECTORY.$a0['id_company'].'/files/';
		$config['encrypt_name']		= TRUE;
		$config['allowed_types'] 	= '*';

		foreach ($_FILES as $key => $value) {
			
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
				array_push($documents, $file);
			}
		}

		$documents = implode(',', $documents);
		$this->assessment_model->update_a0(array('documents'=>$documents), array('id_a0' => $id_a0));
		echo $documents;

	}
}

<?php
/**
* 
*/
/*include_once (dirname(__FILE__) . "/users.php");
class Assessment extends Users*/
class Assessment extends CI_Controller
{
	private $can_send_email_on_assessment_group = TRUE;

	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('assessment_model');
		$this->load->library('lib_login');
		$this->load->library('profiling/Pengguna');
		$this->isAjax = $this->input->is_ajax_request();

		// $this->lib_login->restriction_login();		
	}

	public function index()
	{
		$this->lib_login->restriction_login();
		if(isset($_SESSION['is_login']))
		{
			$this->load->model('users_model');
			$user = $this->users_model->data_master_userlevel('*', array('id_userlevel' => $_SESSION['level'] ))->row_array();
			header('location:'.site_url($user['userlevel_redirect']));		
		}
	}

	public function setup()
	{
		$this->lib_login->restriction_login();

		$this->load->view('templates/head', array('title' => 'Assessment Setup'));

		$this->load->view('dashboard/dashboard.assessment.setup.php');

		$this->load->view('templates/footer');
	}

	public function schedules()
	{
		$this->lib_login->restriction_login();

		$this->load->view('templates/head', array('title' => 'Schedules'));

		$this->load->view('assessment/assessment_schedules', array() );

		$this->load->view('templates/footer');
	}

	public function main_dashboard()
	{
		/*if($this->pengguna->has_level(4)) // company
		{
			header('location:'.site_url('company/dashboard'));
		}elseif($this->pengguna->has_level(3)) // pjt
 		{
			header('location:'.site_url('pjt/panel'));
		}elseif($this->pengguna->has_level(2)) // auditor
 		{
			header('location:'.site_url('auditor/panel?_='.uniqid()));
		}

		$this->lib_login->restriction_login();

		if(!$this->isAjax)
		{
			$this->load->view('templates/head', array('title' => 'Main Dashboard'));
		}


		$this->load->view('templates/dashboard');

		if(!$this->isAjax)
		{
			$this->load->view('templates/footer');
		}*/
	}
	


	public function pjt_dashboard()
	{
		if( $this->isAjax == FALSE )
		{
			$this->load->view('templates/head', array('title' => 'PJT'));
		}

		$this->load->view('assessment/pjt/assessment_pjt_dashboard');
		
		if( $this->isAjax == FALSE )
		{
			$this->load->view('templates/footer');
		}
	}

	public function pjt_dashboard_pick_company()
	{
		if( $this->isAjax == FALSE )
		{
			$this->load->view('templates/head', array('title' => 'Daftar perusahaan'));
		}

		$this->load->view('assessment/pjt/assessment_pjt_company');
		
		if( $this->isAjax == FALSE ){
			$this->load->view('templates/footer');
		}
	}

	public function precertification()
	{
		$this->lib_login->restriction_login();

		if( $this->isAjax == FALSE )
		{
			$this->load->view('templates/head', array('title' => 'Pre sertification'));
		}

		$this->load->view('assessment/assessment_presertification');
		if( $this->isAjax == FALSE )
		{
			$this->load->view('templates/footer');
		}
	}

	public function detail_precertification($id_company, $id_permintaan_sertifikasi)
	{
		$this->load->model('certification_model');
		$this->load->model('assessment_model');
		$this->load->model('files_model');
		$this->load->model('invoice_model');
		$this->load->model('company_model');
		$this->load->model('notes_model');
		
		$kelengkapan = $this->certification_model->get_kelengkapan_sertifikasi_perusahaan($id_company, $id_permintaan_sertifikasi);
		// ambil id files dari detail untuk pengecheckan data kelengkapan dokumen
		$docs_payment = array();
		if( !is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['id_invoice']) )
		{
			$docs_payment = $this->invoice_model->data_invoice_detail('*', array('id_invoice' => $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_invoice'] ))->result_array();
		}

		if(!is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['id_a0']))
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

		// STATUS
		$data = array(
			'company' 		=> $company, 
			'kelengkapan' 	=> $kelengkapan,
			'payment' 		=> $docs_payment,
			'request' 		=> @$a0_cat,
			'notes' 		=> @$notes,

			);
		$this->load->view('templates/headsource', array('title'=> 'Detail pengajuan permintaan baru'));
		$this->load->view('assessment/assessment_presertification--detail', $data);

		// $kelengkapan = $this->certification_model->get_kelengkapan_sertifikasi_perusahaan($id_company, $id_pengajuan);

		// $data = $this->assessment_model->data_a0('*', 'id_a0 = '.$id_a0.' and pass_the_review <= 0' );
		
		/*
		if(count($data) <= 0)
		{
			show_404();
		}*/
		// $data = $this->assessment_model->data_a0_cat('*',array('id_a0' => $id_a0));
		/*foreach ($data as $key => $value) {
			$data[$key]['data_detail'][] = $this->assessment_model->get_detail_assessment($value['id_a0_cat']);
		}*/

		// $_docs_file = array_column($kelengkapan['detail_kelengkapan_permintaan_sertifikasi'], 'id_files');

		/*$_status_item['null_docs'] = array_filter($_docs_file, function($res){
			return($res == null);
		});*/
		/*if(count($_status_item['null_docs']) > 0)
		{
			$status = 'Silahkan lengkapi dokumen';
		}*/
		
		/*if( $this->isAjax == FALSE )
		{

			$this->load->view('templates/head', array('title' => 'Pre sertification'));
		}*/

		
		/*if( $this->isAjax == FALSE )
		{
			$this->load->view('templates/footer');
		}*/
	}
	
	public function calendar()
	{
		$this->lib_login->restriction_login();

		$this->load->view('templates/head', array('title' => 'Calendar'));

		$this->load->view('templates/navbar');

		echo '<div class="mdl-navbar-1st-level mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">';
			$this->load->view('templates/__widget_calendar');
		echo '</div>';
		$this->load->view('templates/footer');
	}

	public function notification()
	{
		$this->lib_login->restriction_login();

		$this->load->view('templates/head', array('title' => 'Company'));

		$this->load->view('templates/navbar');

		$this->load->view('templates/nofitication_page');

		$this->load->view('templates/footer');
	}

	public function confirmation($id_a0, $token)
	{
		require_once(APPPATH.'libraries/profiling/Session.php');
		$Sess = new Session;

		if( !$this->pengguna->has_level([1,10,0]) && $this->pengguna->is_login() == false)
		{
			if(!isset($_GET['callback']))
			{
				$url = site_url('perusahaan/login').'?callback='.site_url($_SERVER['PATH_INFO']);
				header('location:'.$url);
			}else
			{
				show_404();
			}
		}

		$this->load->model('company_model');
		$this->load->view('templates/headsource', array('title' => 'assessment confirmation'));
		// $this->load->view('templates/navbar');

		$dataAuth = $this->company_model->authentication__assessment_token($id_a0, $token);
		#var_dump($dataAuth);//return false;
		if($dataAuth['is_auth'] == true)
		{
			$company = $this->company_model->data_company('*', array('id_company' => $dataAuth['data']['id_company']), 0 );
			$email = $company['email'];
			$mail_segments = explode("@", $email);

			$mailHidden = substr($mail_segments[0], 2,-1);
			$mailShown = substr($mail_segments[0], 0,2);
		    $mailHidden = str_repeat("*", strlen($mailHidden));
		    $mail_segments[0] = $mailShown.$mailHidden;
		    $mail_segments = implode("@", $mail_segments);

			if((int)$Sess->get_session('id_company') !== (int)$company['id_company'])
			{
				$logoutLINK = site_url('users/logout').'?callback='.$_SERVER['PATH_INFO'];
				$echo = '
					<p>Hello, '.$Sess->get_session('username').'</p>
					<p>Akun anda <strong>'.$Sess->get_session('email').'</strong> tidak sesuai dengan halaman ini. <br>
					Halaman ini harus dikonfirmasikan oleh akun <strong>'.$mail_segments.'</strong> dan tidak dapat diwakilkan.</p>
					<p>jika anda ingin mengkonfirmasikan halaman berikut, silahkan ikuti langkah dibawah ini : 
						<ol>
							<li>Silahkan logout akun LSBBKKP anda saat ini dengan klik tautan disamping <a class="btn btn-primary" href="'.$logoutLINK.'">Logout</a></li>
							<li>lalu login menggunakan akun '.$mail_segments.'</li>
							<li>anda akan otomatis diarahkan menuju halaman konfirmasi tanggal</li>
						</ol>
					</p>

				';
				show_error($echo, '404', $heading = 'Terjadi kesalahan');	
			}
			
			$this->view_assessment_onauth($dataAuth);
		}else if($dataAuth['is_auth'] == false)
		{
			$this->load->view('assessment/fail_confirmation');
		}else
		{
			show_404();

		}

		// $this->load->view('templates/footer');
	}

	public function assessment_lanjutan($id_rs, $token)
	{
		require_once(APPPATH.'libraries/profiling/Session.php');
		$Sess = new Session;
		if( !$this->pengguna->has_level([1,0]) && $this->pengguna->is_login() == false)
		{
			if(!isset($_GET['callback']))
			{
				$url = site_url('perusahaan/login').'?callback='.site_url($_SERVER['PATH_INFO']);
				header('location:'.$url);
			}else
			{
				show_404();
			}
		}

		$this->load->library('dataakses');
		$this->load->model('company_model');
		$this->dataakses->SQL('SELECT id_company FROM rs JOIN issued USING(id_issued) JOIN a0_cat USING(id_certificate) JOIN a0 USING(id_a0) join company using(id_company) WHERE id_rs = ?','i', $id_rs);
		$company = $this->dataakses->row_array();

		if((int)$Sess->get_session('id_company') !== (int)$company['id_company'])
		{
			show_error('Please login with your company account to confirm this schedule!',500, 'Sorry, company mismatch');
		}

		$this->load->view('templates/head', array('title' => 'Assessment Lanjutan'));

		$dataAuth = $this->assessment_model->authentication__assessment_lanjutan($id_rs, $token);
		if($dataAuth['is_auth'] == true)
		{
			$this->load->view('assessment/assessment_lanjutan', array( 'assessment' => $dataAuth['data'] ));
		}else
		{
			$this->load->view('assessment/fail_confirmation');
		}


		// $this->load->view('templates/footer');
	}

	/*
	* menampilkan data assessment  / reassessment yang sudah konfirmasi tanggal & tanggal sekarang > tanggal konfirmasi && status masih progress
	*/
	public function assessment_confirmation_result($id_a0)
	{
		$this->lib_login->restriction_login();

		$this->load->model('company_model');
		$this->load->model('notes_model');
		$this->load->model('certification_model');
		$this->load->model('product_line_model');


		$a0 			= $this->certification_model->get_a0($id_a0);
		$company 		= $this->company_model->get_company($a0['id_company']);
		$unconfirmed_a0 = $this->assessment_model->get_a0_unconfirmed_result($company['id_company']);
		$unconfirmed_rs = $this->assessment_model->get_rs_unconfirmed_result($company['id_company']);
		$audit_khusus 	= $this->assessment_model->get_audit_khusus_unconfirmed_result($company['id_company']);

		foreach ($unconfirmed_a0 as $key => $value) {

			$unconfirmed_a0[$key]['data_detail'] = $this->assessment_model->get_detail_assessment($value['id_a0_cat']);
			$unconfirmed_a0[$key]['notes'] = $this->notes_model->get_notes( array('notes_reference_id' => $value['id_a0_cat'], 'notes_for_type' => 0 ) );

		}

		foreach ($audit_khusus as $key => $value) {

			$audit_khusus[$key]['data_detail'] = $this->assessment_model->get_detail_assessment($value['id_a0_cat']);
			$audit_khusus[$key]['notes'] = $this->notes_model->get_notes( array('notes_reference_id' => $value['id_a0_cat'], 'notes_for_type' => 0 ) );

		}


		foreach ($unconfirmed_rs as $key => $value) {
			# code...
			$unconfirmed_rs[$key]['data_detail'] = $this->assessment_model->get_detail_reassessment($value['id_rs']);
			
			$unconfirmed_rs[$key]['notes'] = $this->notes_model->get_notes( array('notes_reference_id' => $value['id_rs'], 'notes_for_type' => 1 ) );
		}


		// print_r($unconfirmed_rs);
		if( $this->isAjax == FALSE )
		{
			$this->load->view('templates/head', array('title' => 'Konfirmasi pelaksanaan assessment'));
		}
		
		$permintaan = $this->certification_model->data_kelengkapan_permintaan('*', array('id_a0' => $a0['id_a0']))->row_array();
		$kelengkapan = $this->certification_model->get_kelengkapan_sertifikasi_perusahaan($company['id_company'], $permintaan['id_permintaan_sertifikasi']);

		// print_r($kelengkapan);
		$this->load->view('assessment/assessment_confirmation_result', array( 
			'a0' => $a0, 
			'company' => $company, 
			'unconfirmed_a0' => $unconfirmed_a0, 
			'unconfirmed_rs' => $unconfirmed_rs, 
			'audit_khusus' => $audit_khusus ,
			'kelengkapan' => $kelengkapan,
			) 
		);
		if( $this->isAjax == FALSE ){
			$this->load->view('templates/footer');
		}
	}

	public function detail_reassessment_on_dashboard(/*$data*/)
	{
		$this->lib_login->restriction_login();

		$this->load->view('assessment/detail_reassessment'/*, array('rs' => $data)*/ );
		
	}

	public function detail_assessment_on_dashboard(/*$data*/)
	{
		$this->lib_login->restriction_login();

		$this->load->view('assessment/detail_assessment'/*, $data*/);
	}

	public function result_assessment()
	{
		$this->lib_login->restriction_login();

		$this->load->view('assessment/result_assessment');
	}

	public function detail_all_schedule()
	{
		$this->lib_login->restriction_login();

		$this->load->view('assessment/detail_all_schedule');
	}

	public function detail_schedule($type, $id)
	{
		$this->load->view('templates/head', array('title' => 'Company'));

		$type = urldecode($type);
		switch ($type) {
			case 'new assessment':
				# code...
				$data = $this->assessment_model->get_a0($id);
				$this->detail_assessment_on_dashboard($data);
				break;

			case 'reassessment':
				$data = $this->assessment_model->get_rs($id);
				$this->detail_reassessment_on_dashboard($data);
				break;
		}
		$this->load->view('templates/footer');
	}

	public function notify_as_group()
	{
		$this->lib_login->restriction_login();

		$this->load->view('assessment/notify_as_group');
	}

	/*
	| --------------------------------
	| Panel untuk koordinator assessment kolektif konfirmasi tanggal
	| --------------------------------
	*/
	public function collective_coordinator_confirmation($id_assessment_collective, $token)
	{
		$this->load->view('templates/headsource', array('title' => 'confirmation coordinator collective Assessment'));

		$this->load->library('hash');
		$token = $this->hash->decode_token_link($token);
		$d0 = $this->assessment_model->get_assessment_collective( array('id_assessment_group' => $id_assessment_collective, 'collective_token' => $token) );

		// check pattern
		$pattern = base64_encode('collective.'.$id_assessment_collective);
		$auth = $this->hash->decrypt( $pattern, $token );

		if( !empty($d0) && $auth == TRUE)
		{
			$participant = $this->assessment_model->get_assessment_collective_participant( array('id_assessment_group'=>$id_assessment_collective) );
			foreach ($participant as $key => $value) {
				$d1 = $this->assessment_model->get_full_rs( array('id_rs'=>$value['id_participant']) );
				$participant[$key] = $d1[0];
			}
			$this->load->view('assessment/assessment_collective_coordinator_confirmation', array('data' => $d0, 'participant' => $participant ));
		}else
		{
			$this->load->view('assessment/fail_confirmation');
		}
	}

	/*
	|
	|
	|
	*/
	public function data_detail_request($type = 'assessment', $id, $scope = array('auditor','company','certification','a0_cat','certification_request','') )
	{
		$this->load->model('auditor_model');
		$this->load->model('company_model');
		$this->load->model('commodity_model');
		$this->load->model('certification_model');

		$scope = (!is_array($scope))? explode('.', $scope) : $scope;
		$keyScope = ($type=='assessment')? 'a0' : 'rs';
		$dataKey = array();

		$dataRequirement['assessment'] = array('a0_cat','certification_request','certificate','issued','rs','rs_schedule','auditor');
		$data = array();
		switch ($type) {
			case 'reassessment':
				$data['rs'] = $this->assessment_model->data_rs('*', array('id_rs'=>$id), 0);
				$id_key = $data['rs']['id_rs'];
				break;

			case 'assessment':
				$data['a0'] = $this->assessment_model->data_a0('*', array('id_a0'=>$id), 0);
				$id_key = $data['a0']['id_a0'];
				break;
			
			default:
				echo 'which one do you prefer? assessment or reassessment';
				break;
		}

		foreach ($scope as $key => $value) {
			# code...
			if($value == 'rs_schedule')
			{
				$data['rs_schedule'] = $this->assessment_model->data_rs_schedule('*', array('id_rs_schedule' => $id_key) );
			}		

			if($value == 'auditor_log')
			{
				$typeAssessment = ($keyScope == 'a0')? 'assessment' : 'reassessment';
				$data['auditor_log'] = $this->auditor_model->data_auditor_log('*', array('id_assessment' => $id_key) );
			}

			if($value == 'issued')
			{
				$issued = (isset($data['certificate']))? array('id_certificate' => $data['certificate']['id_certificate']) : null;
				$issued = (is_null($issued) && isset($data['rs'])) ? array('id_issued' => $data['rs']['id_issued']) : $id_issued;
				$data['issued'] = $this->certification_model->data_issued('*', $issued );
			}

			if($value == 'a0_cat')
			{
				$data['a0_cat'] = $this->assessment_model->data_a0_cat('*', array('id_a0' => $data['a0']['id_a0']), 0 );
			}

			if($value == 'certificate')
			{
				$id_certificate = (isset($data['rs']) && !empty($data['rs']['id_certificate']) )? $data['rs'] : null;
				$id_certificate = (is_null($id_certificate) && isset($data['issued']))? $data['issued']['id_certificate'] : $id_certificate;

				$data['certificate'] = (!is_null($id_certificate))? $this->certification_model->data_certificate('*', array('id_certificate' => $id_certificate), 0 ) : FALSE;
			}

			if($value == 'certification_request')
			{
				$data['certification_request'] = $this->assessment_model->data_certification_request('*', array('id_a0_cat' => $data['a0_cat']['id_a0_cat']) );


				foreach ($data['certification_request'] as $a => $b) {
					$SC = explode(',', $b['scope']);
					$PL = explode(',', $b['product_line']);
					$AR = explode(',', $b['audit_reference']);

					if(in_array('brand', $scope))
					{
						$data['certification_request'][$a]['data-brand'] = $this->company_model->data_brand('*', array('id_brand' => $b['id_brand']));
					}
					
					if(in_array('scope', $scope))
					{
						foreach ($SC as $c => $d) {
							# code...
							$data['certification_request'][$a]['data-scope'] = $this->commodity_model->data_scope('*', array('id_commodity' => $d));
						}
					}

					if(in_array('product_line', $scope))
					{

						foreach ($PL as $c => $d) {
							$PL1 = explode('.', $d);
							$data['certification_request'][$a]['data-product-line']= $this->assessment_model->data_product_line('*', array('product_line_id' => $PL1[0]) );
							
							array_shift($PL1);
							$data['certification_request'][$a]['data-product-line'][$c]['notes'] = implode(',', $PL1);
							
						}
					}

					if(in_array('audit_reference', $scope))
					{
						foreach ($AR as $c => $d) {
							# code...
							$data['certification_request'][$a]['data-certificate'] = $this->assessment_model->data_audit_reference('*', array('audit_reference' => $d));
						}
					}
				}
			}

		}

		
		return $data;
	}

	/*
	|---------------------------------
	| View untuk menampilkan detail certificat yang diminta.
	|---------------------------------
	*/
	public function data_detail_certification($type, $id, $useHeadSource = TRUE)
	{
		if($useHeadSource === TRUE)
		{
			$this->load->view('templates/headsource', array('title' => 'Detail Request'));
		}
		$data = $this->get_detail_certification($type, $id);
	}

	///////////////////////////////////////////////////////// P R O C E S S ////////////////////////////////////////////////////
	/*
	|------------------------------
	| Process ambil data berdasarkan certification
	|------------------------------
	*/
	public function detail_certification($type, $id)
	{
		switch ($type) {
			case 'assessment':
				$data = $this->assessment_model->get_detail_assessment($id);
				break;
			case 'reassessment':
				$data = $this->assessment_model->get_detail_reassessment($id);
				break;
			case 'a0':
				$data = $this->assessment_model->data_a0_cat('*',array('id_a0' => $id));
				foreach ($data as $key => $value) {
					$data[$key]['data_detail'][] = $this->assessment_model->get_detail_assessment($value['id_a0_cat']);
				}
				break;
			
			default:
				# code...
				break;
		}

		// print_r($data);
		echo json_encode($data);
	}

	/*
	|-----------------------
	| Process datasource
	|-----------------------
	|
	| Params :
	| @type = assessment || audit khusus @id = id_a0
	| @type = surveilen @id = id_rs
	| 
	| #status = development
	*/
	public function datasource($type, $id)
	{
		switch ($type) {
			case 'assessment':
			case 'audit_khusus':
				$data = $this->assessment_model->datasource_assessment($id);
				break;

			case 'surveilen':
				$data = $this->assessment_model->datasource_reassessment($id);
				break;
			
			default:
				# code...
				break;
		}
		print_r($data);
	}

	/*
	|-----------------------
	| Process ambil + View data requested 
	|-----------------------
	|
	| Params :
	| @type = assessment || audit khusus @id = id_a0_cat
	| @type = reassessment @id = id_rs
	*/
	public function get_detail_certification($type, $id)
	{
		switch ($type) {
			case 'assessment':
				$data = $this->assessment_model->get_detail_assessment($id);
				$this->load->view('assessment/detail_certification_requested', array('value'=>$data));
				break;
			case 'reassessment':
				$data = $this->assessment_model->get_detail_reassessment($id);
				$this->load->view('assessment/detail_certification_requested', array('value'=>$data));
				break;
			case 'a0':
				$data = $this->assessment_model->data_a0_cat('*',array('id_a0' => $id));
				foreach ($data as $key => $value) {
					$data = $this->assessment_model->get_detail_assessment($value['id_a0_cat']);
					$this->load->view('assessment/detail_certification_requested', array('value'=>$data));
				}
				break;
			
			default:
				# code...
				break;
		}

		// print_r($data);
	}

	/*
	|---------------------
	| Function get data request risk change
	|---------------------
	*/
	public function get_requested_risk_change()
	{
		$data = $this->assessment_model->data_requested_risk_change();
		echo json_encode($data);
	}

	/*
	* function complete 
	*/
	public function complete_schedule()
	{
		$data = $this->assessment_model->get_complete_schedule();
		echo json_encode($data);
	}
	

	/*
	* function unconfirmed schedules. 

	* function status : used
	*/
	public function get__unconfirmed_schedules()
	{
		$data = $this->assessment_model->get_assessment_unconfirmed_schedules();
		echo json_encode($data);
	}

	/*
	|------------------
	| function presertification PJT
	|------------------
	*/
	public function get_presertification()
	{
		$this->load->model('certification_model');

		$data = $this->db->query('SELECT * 
			from kelengkapan_permintaan_sertifikasi 
			join company using(id_company) 
			LEFT JOIN a0_cat USING(id_a0)
			where id_a0 is null or a0_cat.`status` = ? OR a0_cat.`status` = ? group by id_a0', array('process', 'remidial'))->result_array();
		echo json_encode($data);
	}

	/*
	* function confirmed schedules. 

	* function status : used
	*/
	public function get__confirmed_schedules()
	{
		$data = $this->assessment_model->get_assessment_confirmed_schedules();
		echo json_encode($data);
	}
	public function get__confirmed_schedules_single()
	{
		$data = $this->assessment_model->get_assessment_confirmed_schedules('single');
		echo json_encode($data);
	}
	public function get__confirmed_schedules_group()
	{
		$data = $this->assessment_model->get_assessment_confirmed_schedules('group');
		echo json_encode($data);
	}

	/*
	* public function get assigned assessment
	*/
	public function get__assigned_assessment()
	{
		$params = NULL;
		if( isset($_POST['id_company']) )
		{
			$params = $this->input->post('id_company');
		}

		$data = $this->assessment_model->data_assigned_assessment($params);
		echo json_encode($data);
	}

	/*
	* public function get schedule assessment / reassessment
	*/
	public function get__schedule()
	{
		$params = NULL;
		// $_POST['id_company'] = 2;
		if( isset($_POST['id_company']) )
		{
			$params = $this->input->post('id_company');
		}

		$data = $this->assessment_model->data_schedule_assessment($params);
		echo json_encode($data);
	}

	/*
	* public function get assigned assessment
	*/
	public function get__conducted_assessment()
	{
		$data = $this->assessment_model->data_conducted_assessment();
		echo json_encode($data);
	}

	/*
	* function get a0_cat details. 

	* function status : used
	*/
	public function get__a0_cat_details()
	{	
		$this->lib_login->restriction_login();
		$id_a0_cat = $_POST['id_a0_cat'];
		$data = $this->assessment_model->detail_a0_cat($id_a0_cat);
		echo json_encode($data);
		// print_r($data);
	}

	/*
	|
	|
	|
	*/
	public function get__waiting_result()
	{
		$this->lib_login->restriction_login();
		$data = $this->assessment_model->data_waiting_result_assessment();
		echo json_encode($data);
		
	}

	/*
	|----------------
	| Get Product Line #using master_product_line
	|----------------
	*/
	public function get__master_product_line()
	{
		$this->lib_login->restriction_login();
		$select = isset($_POST['select'])? $_POST['select'] : '*';
		$where = isset($_POST['where'])? $_POST['where'] : array();

		$data = $this->assessment_model->data_master_product_line($select, $where);
		echo json_encode($data);
	}

	/*
	|------------------
	| Mengambil document yang diupload oleh perusahaan pada assessment awal
	|------------------
	*/
	public function get_files_a0_documents()
	{
		$this->load->model('files_model');

		$id_a0 	= $this->input->post('id_a0');
		$a0 	= $this->assessment_model->data_a0('id_a0, documents', array('id_a0' => $id_a0) );
		$files 	= array();
		if(count($a0) > 0 && !is_null($a0[0]['documents']) )
		{
			$a0 = $a0[0];
			$docs 	= explode(',', $a0['documents']);
			foreach ($docs as $key => $value) {
				if($value !== '')
				{
					$files[] = $this->files_model->get_file($value)[0];
				}
			}
		}

		echo json_encode($files);
	}

	/*
	# FUNCTION get all assessment available in some company
	# requirement
	# POST
		- id_a0
	*/
	public function company_assessment_available()
	{
		$this->lib_login->restriction_login();
		$id_company = $_POST['id_company'];
		$data = $this->assessment_model->company_assessment_available('*', 'rs_status IS NULL AND company.id_company = '.$id_company);
		echo json_encode($data);
	}

	/*confirmation date assessment*/
	public function confirmation_assessment_date()
	{
		$result = array('success' => false);
		$post = $this->input->post();
		$response = $this->assessment_model->confirmation_assessment_date($post);

		$this->load->model('assessment_model');
		$this->load->model('notification_model');
		$this->load->model('company_model');

		$data = $this->db->query('SELECT * FROM a0 JOIN company ON a0.id_company = company.`id_company` WHERE a0.id_a0 = ?', array($post['id_a0']))->row_array();

		$this->notification_model->insert_notification(array(
			'notification_text' => $data['company_name'].' telah melakukan konfirmasi tanggal kesiapan pelaksanaan assessment.',
			'notification_for_level' => 1, // level-LSBBKKP
		));

		$result['success'] = true;
		$result['response'] = $response;
		echo json_encode($result);
	}

	public function get_available_date()
	{
		$this->load->model('certification_model');

		define('AUDITOR_COMPETENCY_AS_PARAMETERS', false);

		$_POST 	= array('startDate' => '2017/01', 'finishDate' => '2017/03', 'id_a0' => 602);
		$post 	= $this->input->post();
		$a0_cat = $this->assessment_model->data_a0_cat('*',array('id_a0' => $post['id_a0']), 0 );
		
		// $permintaan = $this->certification_model->data_kelengkapan_permintaan('*', array('id_a0' => $post['id_a0']) )->row_array();

		
		
		$toDay 		= date('Y-m-d');
		$startDate 	= date('Y-m-d', strtotime( $post['startDate'].'/01') );
		$finishDate = date('Y-m-d', strtotime( $post['finishDate'].'/30') );
		$schedule 	= $this->assessment_model->get_schedule($startDate, $finishDate);

		
		
		$records 	= array();
		
			foreach ($schedule as $key => $value) {
				$length = $value['a0_cat_audit_length'];
				$fDate = $this->assessment_model->forecasting_next_date($length, $value['assessment_date']);
				$fDate = array_pop($fDate['work_days']);
				$records[] = array(
					'startDate' 	=> $value['assessment_date'], 
					'length' 		=> $value['a0_cat_audit_length'],
					'finishDate' 	=>  $fDate,
					'title'			=> $value['type_report'].' #'.$value['id_assessment'].' '.$value['company_name'],
				);
			}

		
		// print_r($data); return false;
		// print_r($records);
		// print_r($data);

		echo json_encode($data);

		// AMBIL RECORDS
		// LOOP RECORDS
			// JIKA ADA RECORDS YANG JEDA NYA LEBIH BESAR DARI JUMLAH N, ULANGI
		// END LOOP
	}

	public function get_forecasting_schedule()
	{
		$this->load->model('auditor_model');
		$post = $this->input->post();
		$a0 = $this->assessment_model->data_a0('*', array('id_a0' => $post['id_a0']), 0 );
		$a0cat = $this->db->query('SELECT * from a0_cat join certification_request using(id_a0_cat) where id_a0 = ?', array($post['id_a0']))->result_array();

		$audit_reference = array_column($a0cat, 'audit_reference');
		$audit_reference = explode(',', implode(',', $audit_reference));
		
		$audit_length = array_column($a0cat, 'a0_cat_audit_length');

		$competency = $this->auditor_model->data_competent_and_available_auditor(array(
				'assessment_date' 		=> $post['startDate'],
				'competency' 			=> $audit_reference,
				'assessment_date_range' => $audit_length
			))->result_array();
		
		$data['is_available'] = FALSE;
		if(count($competency) >= $a0['auditor_need'])
		{
			$data['is_available'] = TRUE;
			$b = $this->assessment_model->forecasting_next_date($post['length'], $post['startDate']);
			$data['records'] = $b;
		}


		echo json_encode($data);
	}


	/*
	|
	| /////////////////////////////////////// D E L E T E ///////////////////////////////////////////////
	|
	*/

	/*
	|
	| /////////////////////////////////////// U P D A T E ///////////////////////////////////////////////
	|
	*/

	/*
	|-------------
	| Update documents a0
	|------------
	*/
	public function update_documents_a0()
	{
		$docs = $this->input->post('documents');
		$id_a0 = $this->input->post('id_a0');

		if(!empty($docs))
		{
			$this->assessment_model->update_a0( array('documents' => $docs), array('id_a0' => $id_a0) );
		}
	}


	/*
	* :: update confirmation date assessment
	* 	- this function used in dashboard profile company
	* :: requirement
	* 	- id a0
	* 	- assessment_date
	* 
	*/
	public function update_confirmation_assessment_date()
	{
		$result = array('success' => false);
		$response = $this->assessment_model->update_confirmation_assessment_date($_POST);
		$result['success'] = true;
		$result['response'] = $response;
		echo json_encode($result);
	}

	/*================================================================================================
	|--------------------------
	| UPDATE KONFIGURASI JUMLAH AUDIT, AUDITOR, DAN JUMLAH PEMBAYARAN
	|-------------------------
	*/
	public function update_precertification()
	{

		$data = $this->input->post();
		
		// AMBIL DATA A0 =============================================
		$a0 = $this->db->query('SELECT * FROM a0 join company on a0.id_company = company.id_company where id_a0 = ?', $data['id_a0'] )->row_array();

		switch ($data['pass_the_review']) {
			case '1':
			case 1:
				$this->accept_precertification($data);
				break;
			case '-1':
			case -1:
				$this->deny_precertification($data, $a0);
				break;
			
			default:
				# code...
				break;
		}

		// SEND MAIL 
		$this->new_email_confirmation_from_precertification($a0);
	}
	public function accept_precertification($data)
	{
		$this->load->model('certification_model');
		$this->load->model('invoice_model');

		$where = array( 
			'id_a0' => $data['id_a0']  
			);

		// INSERT NEW INVOICE ========================================
		$invoice = $this->invoice_model->insert_invoice(array(
			'amount_paid' => $data['pembayaran']
		));
		// ===========================================================

		// UPDATE A0 =================================================
		$update = array(
			'pass_the_review'	=> $data['pass_the_review'],
			'id_invoice' 		=> $invoice->insert_id(),
			'auditor_need' 		=> $data['auditor_need'],
			'a0_approved_by' 	=> $_SESSION['id_users'].'.'.$_SESSION['level'],
			);
		
		$this->assessment_model->update_a0($update, $where);
		// =============================================================

		// UPDATE A0_CAT ===============================================

		$update = array(
				'reduce' 				=> $data['reduce'],
				'risk' 					=> $data['risk'],
				'suggest_risk' 			=> $data['risk'],
				'a0_cat_audit_length' 	=> $data['audit_days']
			);
		
		$this->assessment_model->update_a0_cat($update, $where);
		// ==============================================================

		// UPDATE KELENGKAPAN DOKUMEN====================================
		$update = array(
			'is_accepted' => 1
			);
		$where = array( 
			'id_a0' => $data['id_a0']  
			);
		$this->certification_model->update_kelengkapan_dokumen( $update, $where);
		// ==============================================================




	}

	public function deny_precertification($data, $a0)
	{
		$this->load->model('certification_model');		
		$this->load->model('notes_model');		

		$where = array( 
			'id_a0' => $data['id_a0']  
			);

		// INSERT NOTES===============================================
		$notes_data = array(
				'notes_subject' => 'Permintaan sertifikasi ditolak',
				'notes_content' => $data['notes'],
			);
		$notes = $this->notes_model->insert_notes_log($notes_data);
		// ===========================================================

		// UPDATE A0 =================================================
		$a0_notes 	= is_null($a0['a0_notes']) || $a0['a0_notes'] == ''? array() : explode(',', $a0['a0_notes']);
		array_push($a0_notes, $notes->insert_id());
		$a0_notes 	= implode(',', $a0_notes);

		$update = array(
			'pass_the_review'	=> $data['pass_the_review'],
			'a0_approved_by' 	=> $_SESSION['id_users'].'.'.$_SESSION['level'],
			'a0_notes' 			=> $a0_notes,
			);
		$this->assessment_model->update_a0($update, $where);
		// =============================================================

		// UPDATE KELENGKAPAN DOKUMEN====================================
		$update = array(
			'is_accepted' => 1
			);
		$this->certification_model->update_kelengkapan_dokumen( $update, $where);
		// ==============================================================
	}

	public function new_email_confirmation_from_precertification($a0)
	{
		$this->load->model('tools');

		// ==============================================================
		// ENCODE TOKEN FOR URL
		$token = $this->tools->encode_token_link($a0['token']);
		// MAKE URL
		$url = site_url('assessment/confirmation/'.$a0['id_a0'].'/'.$token);

		// LOAD LIBRARY MAIL
		$this->load->library('mail');
		$this->mail->from('LSBBKKP','costumer_service@lsbbkkp.com');
		$this->mail->subject('Hasil pengecekan syarat assessment');
		$this->mail->to($a0['email']);
		if($a0['pass_the_review'] < 1)
		{

			$message = $this->load->view('templates/email/template--email-info--confirmation-fail-new-certification',array(
				'companyName' => $a0['company_name'],
			),true);
		}else
		{
			$message = $this->load->view('templates/email/template--email-info--confirmation-ok-new-certification',array(
				'companyName' => $a0['company_name'],
				'url_confirmation' => $url
			),true);
		}
		$this->mail->message($message);
		if( !$this->mail->send() )
		{
			show_error('error send email',500);
		}
	}

	 
	/*public function update_precertification()
	{
		$data = $this->input->post();

		$this->load->model('tools');
		$this->load->model('company_model');
		$this->load->model('certification_model');
		$this->load->model('invoice_model');
		$this->load->model('notification_model');

		// TAMBAHKAN DATA INVOICE
		$invoice = $this->invoice_model->insert_invoice(array(
				'amount_paid' => $data['pembayaran']
			));

		// UPDATE A0 =================================================
		$update['pass_the_review'] = $data['pass_the_review'];
		$update['id_invoice'] = $invoice->insert_id();
		$update['auditor_need'] = $data['auditor_need'];
		$update['a0_approved_by'] = $_SESSION['id_users'].'.'.$_SESSION['level'];

		$where = array( 'id_a0' => $data['id_a0']  );
		$this->assessment_model->update_a0($update, $where);
		// ============================================================

		// UPDATE A0_CAT ===============================================
		$where_cat = array( 'id_a0' => $data['id_a0'] );
		$update_cat = array(
				'reduce' => $data['reduce'],
				'risk' => $data['risk'],
				'suggest_risk' => $data['risk'],
				'a0_cat_audit_length' => $data['audit_days']
			);
		
		$this->assessment_model->update_a0_cat($update_cat, $where_cat);
		// ==============================================================
		$this->certification_model->update_kelengkapan_dokumen(array('is_accepted' => 1), array('id_a0' => $data['id_a0']));
		// ==============================================================

		// AMBIL DATA A0
		$a0 = $this->assessment_model->data_a0('*', array('id_a0' => $data['id_a0']))[0];
		// AMBIL DATA PERUSAHAAN
		$company = $this->company_model->data_company('*', array('id_company' => $a0['id_company']))[0];
		
		// ============================================================== KIRIM NOTIFIKASI
		$this->notification_model->insert_notification(array(
			'notification_text' => 'LSBBKKP telah melakukan konfirmasi terkait permintaan sertifikasi anda. silahkan buka tracker permintaan!',
			'notification_for_level' =>  $company['company_level'], // perusahaan
			'notification_for_user' => $company['id_company'], // id perusahaan
		));
		// ==============================================================
		// ENCODE TOKEN FOR URL
		$token = $this->tools->encode_token_link($a0['token']);
		// MAKE URL
		$url = site_url('assessment/confirmation/'.$a0['id_a0'].'/'.$token);

		// LOAD LIBRARY MAIL
		$this->load->library('mail');
		$this->mail->from('LSBBKKP','costumer_service@lsbbkkp.com');
		$this->mail->subject('Hasil pengecekan syarat assessment');
		$this->mail->to($company['email']);
		if($data['status'] < 1)
		{

			$message = $this->load->view('templates/email/template--email-info--confirmation-fail-new-certification',array(
				'companyName' => $company['company_name'],
			),true);
		}else
		{
			$message = $this->load->view('templates/email/template--email-info--confirmation-ok-new-certification',array(
				'companyName' => $company['company_name'],
				'url_confirmation' => $url
			),true);
		}
		$this->mail->message($message);
		if( !$this->mail->send() )
		{
			show_error('error send email',500);
		}
	}*/

	/*
	| </ END OF UPDATE KONFIGURASI JUMLAH AUDIT, AUDITOR, DAN JUMLAH PEMBAYARAN
	=======================================================================================================================*/

	/*
	|
	| Update Schedule
	|
	*/
	public function update_schedule()
	{
		$type = $this->input->post('type_assessment');
		$id = $this->input->post('id_assessment');
		$id_company = $this->input->post('id_company');
		$date = $this->input->post('schedule-date');
		switch ($type) {
			case 'assessment':
			case 'audit-khusus':
				// update plus reset token.
				$this->assessment_model->update_schedule_assessment(array('assessment_date' => $date, 'changed_by_client' => 0, 'token' => '' ), array('id_a0' => $id) );
				# code...
				break;

			case 'reassessment':
				$this->assessment_model->update_schedule_reassessment( array('survey_date' => $date, 'token' => ''), array('id_rs_schedule' => $id) );
				# code...
				break;
		}
		// print_r($_POST);
	}

	/*
	|
	| Update RS Deadline
	|
	*/
	public function update_rs_deadline()
	{
		$id_rs = $this->input->post('id_rs');
		$date = $this->input->post('deadline_date');
		$this->assessment_model->update_rs( array('deadline_date' => $date), array('id_rs' => $id_rs ) );

	}

	/*
	| Update current risk
	*/
	public function update_current_risk()
	{
		$id_a0_cat = $this->input->post('id_a0_cat');
		$risk = $this->input->post('risk');
		$this->assessment_model->update_current_risk( array('id_a0_cat' => $id_a0_cat, 'risk' => $risk ) );

	}
	

	/*confirmation date assessment*/
	public function confirmation_advanced_assessment()
	{
		$result = array('success' => false);
		$response = $this->assessment_model->confirmation_reassessment_date($_POST);
		$result['success'] = true;
		$result['response'] = $response;
		echo json_encode($result);
	}

	

	/*
	* set resurvey data
	* update resurvey with rs schedule
	* create token for reassessment
	*
	* params
	* 	- rs schedule id
	*/
	public function set__resurvey($id_rs, $otherEmail = '')
	{
		$this->load->model('certification_model');

		$data_rs = $this->assessment_model->get_full_rs(array('id_rs' => $id_rs))[0];
		$get_audit_time = $this->assessment_model->configure_audit_time($data_rs['id_a0'], $data_rs['risk']);

		$now = new DateTime(date('Y-m-d'));
		$deadlinedate = new DateTime( $data_rs['deadline_date'] );
		$between = $deadlinedate->diff($now);
		$between = $between->format('%a');

		$token = $this->assessment_model->create_token_resurvey($id_rs);
		$rs_schedule = $this->assessment_model->create_resurvey_schedule($token);
		$this->assessment_model->set_resurvey($id_rs, $rs_schedule, $get_audit_time['detail']['audit_time']);
		$this->assessment_model->send_email_notification_reassessment($id_rs, $rs_schedule, $otherEmail);
	}

	

	public function get_all_assessment_data()
	{
		$this->load->model('company_model');

		$id_brand =  isset($_GET['id_brand'])?$_GET['id_brand'] : 0;
		
		$return = isset($_GET['return'])?$_GET['return'] : 'json';
		
		$data = $this->company_model->data_assessment();
		
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

	protected function view_assessment_onauth($data)
	{
		$this->load->view('assessment/confirmation', array('assessment' => $data['data']));
	}

	protected function view_assessment_notauth()
	{

	}

	/*
	* get data assessment in request. whether cinfirmed or unconfirmed date
	*
	*/
	public function get_request_assessment_confirmed_date()
	{
		$this->load->model('certification_model');
		$data = $this->certification_model->get__data_request_assessment();
		$data = array_filter($data, function($res){
			return $res['assessment_date'] !== NULL;
		});
		print_r($data);

	}

	/*
	* function Name :: detail_reassessment ::
	* ::used to: get all data reassessment 
	* :: requirements
	* 	- id certificate 
	*
	* function status : used
 	*/
	public function detail_reassessment()
	{
		$data = $this->assessment_model->get__data_detail_reassessment($_POST);
		echo json_encode($data);
	}

	/*
	|---------------
	| Unconfirmed assessment
	|---------------
	fetch all unconfirmed assessment
	status : developing
	*/
	public function unconfirmed_assessment($id_company)
	{
		$data['unconfirmed_a0'] = $this->assessment_model->get_a0_unconfirmed_result($id_company);
		$data['unconfirmed_rs'] = $this->assessment_model->get_rs_unconfirmed_result($id_company);
		$data['audit_khusus'] 	= $this->assessment_model->get_audit_khusus_unconfirmed_result($id_company);
		print_r($data);
	}

	/*
	* function to resend email
	* type : post
	* requirement: id_company (need verification manager)
	*/
	public function resend_email()
	{
		
		$this->load->model('certification_model');
		foreach ($_POST['data'] as $key => $value) {
			switch ($value['type_schedule']) {
				case 're assessment':
					$this->assessment_model->send_email_notification_reassessment($value['id'], $value['_']);
					break;
				case 'new assessment':
					$this->certification_model->send_email_assessment_date($value['id_company'], $value['id_a0'], array() );
					break;
				
				default:
					# code...
					break;
			}
		}
	}

	/*
	| ----------------------------------------------------
	| Controller re-assessment as group.
	| ----------------------------------------------------
	| Requirements :
	| this controller requirement an array that contains array company.
	| array company contains :
	| - email,
	| - etc. 
	*/

	function post_assessment_collective()
	{
		$this->load->library('hash');
		$data = $_POST;
		$data_collective = $this->assessment_model->new_assessment_collective( $data['coordinator_name'], $data['coordinator_email'], $data['date'] );
		$data = array_merge($data_collective, $data);
		foreach ($_POST['company'] as $ckey => $cvalue) {

			$this->set__resurvey($cvalue['id'], $_POST['emailContent'][$cvalue['id_company']]);
			$this->assessment_model->insert_assessment_participant($data_collective['id_assessment_collective'], $cvalue['id'], 1);

		}

		// save to email 
		$data_collective = $this->post_assessment_collective_send_email_coordinator($data);

		
	}

	function post_assessment_single()
	{
		$post = json_decode($_POST['data'],true);
		foreach ($post as $ckey => $cvalue) {
			$this->set__resurvey($cvalue['id']);
		}
		
	}

	// send email for coordinator
	private function post_assessment_collective_send_email_coordinator($data)
	{
		$this->load->model('certification_model');
		$this->load->library('mail');

		// $data_collective = $this->assessment_model->new_assessment_collective($data['coordinator_name'], $data['coordinator_email'], $data['date'] );

		// url token
		$url = site_url('assessment/collective/confirmation/coordinator/'.$data['id_assessment_collective'].'/'.$data['url_token']);
		// deadline date
		$deadline = $data['date'];

		$messageOri = $data['coordinator_email_content']['content'];
		
		$message = <<<EOF
		$messageOri
		<p><strong>Mohon diperhatikan<strong></p>
		<p>Silahkan Klik link dibawah ini untuk konfirmasi tanggal assessment secara kolektif yang sudah dibicarakan dengan perusahaan terkait. </p>
		<p><a href="$url">$url</a></p>
		<p>Tautan diatas akan otomatis dihapus setelah melewati batas tanggal assessment kolektif yang telah ditetapkan. yaitu <strong>$deadline</strong> </p>
		<br>
		<br>
		<p>Salam</p>
		<p>YOQA</p>
EOF;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Yoqa Costumer Service <costumer.service@yoqa.com>' . "\r\n";

		$this->certification_model->save_email_log($data['id_assessment_collective'], $data['coordinator_email'], $data['coordinator_email_content']['subject'], $message, 'collective');
		if($this->can_send_email_on_assessment_group === TRUE)
		{
			
			$this->mail->subject($data['coordinator_email_content']['subject']);
			$this->mail->from('LSBBKKP', 'costumer.service@LSBBKKP.com');
			$this->mail->replyTo('noreply@LSBBKKP.com');
			$this->mail->message($message);
			$this->mail->to($data['coordinator_email']);

			if(!$this->mail->send())
			// if(!mail($data['coordinator_email'], $data['coordinator_email_content']['subject'], $message, $headers) )
			{
				show_error('send email to coordinator is unsuccessfull. please check your code!',500);
				header("HTTP/1.0 500 send email to coordinator is unsuccessfull. please check your code!");
			}
		}

		return $data_collective;
	}

	/*
	| -------------------------------------
	| Function to process hasil konfirmasi tanggal assessment collective
	| -------------------------------------
	*/
	public function confirmation_collective_date_assessment()
	{
		$data['id_assessment_group'] 	= $this->input->post("id_assessment_collective");
		$data["collective_date"] 		= $this->input->post("collective_date");
		$data['token'] 					= $this->input->post("token");
		
		foreach ($_POST['collective_id_assessment'] as $key => $value) {
			$data['collective'][] = array('id_rs' => $value, 'survey_date' => $_POST['collective_date'][$key]);
		}
		
		$this->assessment_model->update_collective_date_assessment($data);
	}

	

	////////////////////////////////////// W I D G E T //////////////////////////////////////

	# W I D G E T

	/*
	* function counter assessment
	* requirement: none
	*
	* function status : used
	*/
	public function __widget_assessment_counter()
	{
		$data = $this->assessment_model->assessment_counter();
		foreach ($data as $key => $value) {
			$data[$key]['percentage'] = ($value['type_length']/$value['all_length'])*100;
		}
		echo json_encode($data);
	}

	#  D A T A T A B L E /////////////////////////////////////////////////

	public function datatable__reassessment()
	{
		$data = $this->assessment_model->list__reassessment();
		echo json_encode($data);
		// print_r($data);
	}

	# C A L E N D A R //////////////////////////////////////////////////////
	public function __widget_calendar()
	{
		$this->load->helper('url');
		$widget = array();
		
		// ambil data semua assessment atau reassessment yang jadwal nya sudah di confirm;
		$dataRe = $this->assessment_model->data_reassessment_confirmed_date();
		$dataAss = $this->assessment_model->data_assessment_confirmed_date();

		foreach ($dataAss as $key => $value) {
			$url = site_url('assessment/detail/assessment/'.$value['id_a0_cat']);
			array_push($widget, array( 'title' => 'new assessment '.$value['type'], 'start'=>$value['start'], 'url'=> $url, 'backgroundColor' => '#1BBC9B', 'color'=> '#ffffff' ) );
		}

		foreach ($dataRe as $key => $value) {
			$url = site_url('assessment/detail/reassessment/'.$value['id_rs']);
			array_push($widget, array( 'title' => 're-assessment '.$value['id_certificate'], 'start'=>$value['start'], 'url'=> $url, 'backgroundColor' => '#4183D7', 'color'=> '#ffffff' ) );
		}

		echo json_encode($widget);
	}

	# S E R V E R  S E N T /////////////////////////////////////////////////

	public function ss_calendar()
	{
		$_SESSION['__widget_calendar'] = isset( $_SESSION['__widget_calendar'] )? $_SESSION['__widget_calendar'] : 0;

		// ambil data calendar
		$calendar = $this->__widget_calendar();
		$calendarLen = count($calendar);

		// if session yang ada tidak sama dengan jumlah data, update session lalu return data
		if($_SESSION['__widget_calendar'] !== $calendarLen)
		{

		}

	}

	public function ss_assessment_lanjutan()
	{
		header('Content-Type: text/event-stream');
		header('Cache-Control: no-cache');

		$time = date('r');
		echo "data: The server time is: {$time}\n\n";
		flush();
	}

	public function sse_all_schedules()
	{
		$data['unconfirmed_assessment'] = $this->assessment_model->get_assessment_unconfirmed_schedules();
		$data['all_schedule'] = $this->assessment_model->get_complete_schedule();
		$data['confirmed_single'] = $this->assessment_model->get_assessment_confirmed_schedules('single');
		$data['confirmed_group'] = $this->assessment_model->get_assessment_confirmed_schedules('group');
		$data = json_encode($data);
		
		header('Content-Type: text/event-stream');
		header('Cache-Control: no-cache');
		header('Connection: keep-alive');
		echo "data: {$data}\n\nretry: 15000\n\n";
		flush();
	}

	public function ss_assessment_awal()
	{
		$_SESSION['__notify'] = 2;
	}

	/*
	|----------------
	| Function untuk mencari kebutuhan assessment.
	|----------------
	|
	| Params 
	| @POST 
	| - employee @int
	| - id_a0 @int
	| 
	*/
	public function audit_time_configuration($id_a0, $reduce_length, $risk)
	{
		$data 			= array();
		$audit 			= array();

		$a0 			= $this->assessment_model->get_a0($id_a0);
		$result 		= $a0['result'];
		$row 			= $a0['a0'];
		$employee 		= $row['company_employee'];

		// tambahkan data audit time
		foreach ($result as $key => $value) {
			$value['audit_time'] = $this->certification_model->get_audit_time($value['company_employee'], $value['type'], $risk)->row_array();
			$data['type'][$value['type']][] = $value;
		}

		// jika data cuma 1
		if( count($data['type']) == 1 )
		{

			switch ($row['type']) {
				case 'JPA-009':
					
					$audit['detail']['raw_audit_time'] = $data['type']['JPA-009'][0]['audit_time']['audit_time'];
					$audit['detail']['raw_days'] = $this->assessment_model->rumus_hitung_smp($audit['detail']['raw_audit_time'],  count($data['type']['JPA-009']));
					break;
				case 'YQ-005':
					$audit['detail']['raw_audit_time'] = $data['type']['YQ-005'][0]['audit_time']['audit_time'];
					$audit['detail']['raw_days'] = $this->assessment_model->rumus_hitung_smm($audit['detail']['raw_audit_time']);

					break;

				case 'JECA-004':
					$audit['detail']['raw_audit_time'] = $data['type']['JECA-004'][0]['audit_time']['audit_time'];
					$audit['detail']['raw_days'] = $this->assessment_model->rumus_hitung_sml($audit['detail']['raw_audit_time']);
					break;

			}
		}else // jika lebih dari satu
		{
			// jika sertifikasi yang dikirimkan hanya SML dan SMM
			if(isset($data['type']['JECA-004']) && isset($data['type']['YQ-005']) && !isset($data['type']['JPA-009']) )
			{
				$sml_days = $data['type']['JECA-004'][0]['audit_time']['audit_time'];
				$smm_days = $data['type']['YQ-005'][0]['audit_time']['audit_time'];
				
				$audit['detail']['combine_days']['JECA-004'] = $sml_days;
				$audit['detail']['combine_days']['YQ-005'] = $smm_days;

				$audit['detail']['raw_days'] = $this->assessment_model->rumus_hitung_sml_smm($sml_days, $smm_days);
			}else
			// jika sertifikasi yang dimina SMProduk dan SMM
			if(isset($data['type']['JPA-009']) && isset($data['type']['YQ-005']) && !isset($data['type']['JECA-004']) )
			{
				$smm_days = $data['type']['YQ-005'][0]['audit_time']['audit_time'];
				
				$audit['detail']['combine_days']['JPA-009'] = $smm_days;
				$audit['detail']['combine_days']['YQ-005'] = $smm_days;
				$audit['detail']['product_length'] = count($data['type']['YQ-005']);

				$audit['detail']['raw_days'] = $this->assessment_model->rumus_hitung_smm_smp($smm_days, count($data['type']['YQ-005']) );
			}else
			// jika sertifikasi yang diminta SML dan SMPro
			if(isset($data['type']['JECA-004']) && isset($data['type']['JPA-009']) && !isset($data['type']['YQ-005']) )
			{
				$sml_days = $data['type']['JECA-004'][0]['audit_time']['audit_time'];
				$smp_days = $data['type']['JPA-009'][0]['audit_time']['audit_time'];

				$audit['detail']['combine_days']['JPA-009'] = $smp_days;
				$audit['detail']['combine_days']['JECA-004'] = $sml_days;

				$audit['detail']['raw_days'] = $this->assessment_model->rumus_hitung_sml_smp($sml_days, $smp_days, count($data['type']['JPA-009']));
			}else
			// jika pengguna minta semua sertifikasi
			if( count($data['data']['type']) == 3 )
			{
				$sml_days = $data['type']['JECA-004'][0]['audit_time']['audit_time'];
				$smm_days = $data['type']['YQ-005'][0]['audit_time']['audit_time'];

				$audit['detail']['combine_days']['JECA-004'] = $sml_days;
				$audit['detail']['combine_days']['YQ-005'] = $smm_days;
				$audit['detail']['combine_days']['JPA-009'] = $smm_days;

				$audit['detail']['raw_days'] = $this->assessment_model->rumus_hitung_smm_sml_smp($sml_days, $smm_days, count($data['type']['JPA-009']));
			}
		}

		// hitung reduce dari raw_days
		$reduce = $this->assessment_model->rumus_reduce_hari_audit($reduce_length, $audit['detail']['raw_days']);
		$audit['detail']['reduction_percents'] = $reduce_length;
		// tulis hitungan direduksi n hari 
		$audit['detail']['reduction_day'] = $reduce['reduction'];
		// tulis jumlah hari hasil reduksi !belum di round
		$audit['detail']['raw_days_reduced'] = $reduce['reduced'];
		
		// hitung kebutuhan audit
		$kebutuhan = $this->assessment_model->tentukan_kebutuhan_audit($reduce['reduced']);
		$audit['kebutuhan'] = $kebutuhan;

		
		// hitung jumlah kebutuhan auditor per type
		foreach ($data['type'] as $key => $value) {
			foreach ($value as $a => $b) {
				switch ($key) {
					case 'JPA-009':
						
						$audit['kebutuhan']['auditor_type']['JPA-009'] = ceil($this->assessment_model->rumus_hitung_smp($b['audit_time']['audit_time'], count($data['type']['JPA-009'])) );
						break;
					case 'YQ-005':
						$audit['kebutuhan']['auditor_type']['YQ-005'] = ceil($this->assessment_model->rumus_hitung_smm($b['audit_time']['audit_time'] ) );
						break;

					case 'JECA-004':
						$audit['kebutuhan']['auditor_type']['JECA-004'] = ceil($this->assessment_model->rumus_hitung_sml($b['audit_time']['audit_time'] ) );
						break;
				}
			}
		}
			

		
		return $audit;		
	}

	// check audit_time using ajax / call via address URL
	public function AJAX_audit_time_configuration()
	{
		$this->load->model('certification_model');

		/*$_POST['id_a0'] = 1;
		$_POST['reduce'] = 20;
		$_POST['risk'] = 'low';*/
		
		$id_a0 			= $this->input->post('id_a0');
		$reduce_length 	= $this->input->post('reduce');
		$risk 			= $this->input->post('risk');

		echo json_encode($this->assessment_model->configure_audit_time($id_a0, $risk));
		
		
	}

	public function test2()
	{
		$this->load->model('certification_model');
		$a = $this->certification_model->resurvey_counter('YQ-005');
		print_r($a);
	}

	public function test()
	{
		$this->load->model('certification_model');
		$_POST['id_a0'] = 1;
		$a0 = $this->assessment_model->get_a0($_POST['id_a0']);
		// $_POST['reduce'] = 20;
		$_POST['risk'] = 'Low';

		// $a = $this->configure_days(7);
		// $b = $this->configure_days(9);
		// $c = $this->get_same_days(array(2,3),array(4,5));
		// if(!$c)
		// {
		// }
		// $d = $this->get_min_auditor(6,12,12);
		$e = $this->assessment_model->get_raw_audit_days_single('YQ-005', 7);
		// $f = $this->certification_model->get_audit_time(20, 'YQ-005', $_POST['risk'])->row_array();
		// $g = $this->get_efficiency_audit(array('covered_system' => 2), array('qualified_length' => 2), array('qualified_length' => '1') );

		$hData = array( 
			array('type' => 'JECA-004',	'audit_time' => 7), 
			array('type' => 'YQ-005',	'audit_time' => 9), 
			array('type' => 'JPA-009',	'audit_time' => 9) 
		);

		$data = call_user_func_array(array($this->assessment_model, 'get_raw_audit_days_combine'), $hData);
		
		$cData = array_map(function($res){
			return($res['audit_time']);
		}, $hData);
		
		$c = call_user_func_array(array($this->assessment_model, 'get_max_days'), $cData);
		
		$data['detail']['max_auditor'] = $c;
		
		foreach ($data['data'] as $key => $value) {
			$data['data'][$key]['auditor'] = $this->assessment_model->get_cover_auditor($value['audit_time'], $data['detail']['max_auditor']['sum']);
		}
		// print_r($data);
		// print_r($a0);


		// print_r($a);
		// print_r($b);
		// print_r($c);
		// print_r($d);
		print_r($e);
		// print_r($f);
		// print_r($g);
		// print_r($h);

		// print_r($audit_time);
	}

	public function test_3()
	{
		//Start point of our date range.
		$start = strtotime("1 January 2017");
		 
		//End point of our date range.
		$end = strtotime("1 September 2017");
		 
		//Custom range.
		
		// Jumlah random
		$randLen = 50;

		//Print it out.
		$randDate = array();
		for ($i=0; count($randDate) < $randLen; $i++) { 
			$timestamp = mt_rand($start, $end);
			$date = date("Y-m-d", $timestamp);
			$randLen = rand(1, 6);

			if(!in_array($date, $randDate))
			{
				$randDate[] = $date;
				$this->db->insert('a0', array(
					'assessment_date' => $date,
					'id_company' => 1
				));
				$id = $this->db->insert_id();
				$this->db->insert('a0_cat', array(
					'id_a0' => $id,
					'type' => 'YQ-005',
					'a0_cat_audit_length' => $randLen,
				));
			}

		}
		usort($randDate, function($a,$b){
			return strcmp($b, $a);
		});

		print_r($randDate);
		// print_r($randDate_ch);
		
	}
	public function test_4()
	{
		$this->load->model('auditor_model');
		$a = '2017-01-19';
		$b = $this->assessment_model->forecasting_next_date(4, $a);
		print_r($b);
		$firstDate = array_shift($b['work_days']);
		$lastDate = array_pop($b['work_days']);
		// echo $firstDate."\n";
		// echo $lastDate."\n";
		$this->auditor_model->save_auditor_assignment(1, 22, 'assessment', 0);

	}
}
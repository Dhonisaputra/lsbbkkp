<?php
/**
* 
*/
class Auditor extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('auditor_model');
		$this->load->library('lib_login');
		$this->isAjax = $this->input->is_ajax_request();
	}
	// V I E W //////////////////////////////////////

	public function index()
	{
		$this->login();
	}
	public function login()
	{
		if(isset($_SESSION['is_login']) && $_SESSION['level'] == 2)
		{
			// header('location:'.site_url('auditor/panel/profile/'.$_SESSION['id_users']));

			$this->panel_auditor_profile($_SESSION['id_users']);
		}else
		{
			$this->load->view('templates/headsource', array('title' => 'Auditor Login'));
			$this->load->view('auditor/page--login-auditor');
		}
	}
	
	private function assigned_group($data)
	{
		$data = $this->assessment_model->data_assessment_collective('*', array('assessment_collective_participant.id_assessment_group' => $_GET['id']) );

		# penghitungan jumlah participant assessment group
		$data_len = count($data['datasource']);

		# penguraian unique audit reference id -------------------------------------
		foreach ($data['datasource'] as $key => $value) {
			$_audit_time[] = $this->assessment_model->configure_audit_time($value['a0_cat'][0]['id_a0_cat'], FALSE);
			$data['_helper_assessment_date_list'][] = $value['rs_schedule']['survey_date'] ;
			
			foreach ($value['unique_audit_reference_id'] as $a => $b) {
				$data['unique_audit_reference_id'][] =  $b;
			}
		}

		# urutkan tanggal dari urutan paling awal ke paling akhir
		usort($data['_helper_assessment_date_list'], function($a, $b){
			return strtotime($a) - strtotime($b);
		});
		# ambil tanggal awal
		$data['start_audit'] = $data['_helper_assessment_date_list'][0];
		$data['last_audit']  = $data['_helper_assessment_date_list'][count($data['_helper_assessment_date_list']) -1];
		$assessment_date 	 = $data['start_audit']; 

		# Penghitungan audit time -----------------------------------
		$_audit_time_fixed_auditor = 0;
		$_audit_time_audit_time = 0;
		foreach ($_audit_time as $key => $value) {
			$_audit_time_fixed_auditor = $_audit_time_fixed_auditor + $value['detail']['fixed_auditor'];
			$_audit_time_audit_time = $_audit_time_audit_time + $value['detail']['audit_time'];
			// $audit_time[$key]['detail'] = $value
			$audit_time['data'][] = $value['data'];
		}
		$_audit_time_fixed_auditor = round($_audit_time_fixed_auditor / $data_len);

		$audit_time['detail']['audit_time'] = $_audit_time_audit_time;
		$audit_time['detail']['fixed_auditor'] = $_audit_time_fixed_auditor;
		#-------------------------------------------------------------
		

		print_r($data);

	}
	public function assigned()
	{
		$this->load->model('company_model');
		$this->load->model('assessment_model');
		$id = $_GET['id'];

		#-- GET DATA FROM DETAIL CERTIFICATION ---------------
		

		#IF TYPE COORDINATION IS GROUP
		if(isset($_GET['type_coordination']) && $_GET['type_coordination'] == 'group')
		{
			#$data = $this->assigned_group($_GET);
			$data = $this->assessment_model->data_assessment_collective('*', array('assessment_collective_participant.id_assessment_group' => $_GET['id']) );

			# penghitungan jumlah participant assessment group
			$data_len = count($data['datasource']);

			# penguraian unique audit reference id -------------------------------------
			foreach ($data['datasource'] as $key => $value) {
				$_audit_time[] = $this->assessment_model->configure_audit_time($value['a0_cat'][0]['id_a0_cat'], FALSE);
				$data['_helper_assessment_date_list'][] = $value['rs_schedule']['survey_date'] ;
				
				foreach ($value['unique_audit_reference_id'] as $a => $b) {
					$data['unique_audit_reference_id'][] =  $b;
				}

				foreach ($value['audit_reference_id_based_on_type'] as $a => $b) {
					foreach ($b as $c => $d) {
						# code...
						// print_r($d);
						$data['audit_reference_id_based_on_type'][$a][] = $d;
					}
				}
				foreach ($value['audit_reference_title'] as $a => $b) {
					$data['audit_reference_title'][] =  $b;
				}
				
			}

			# unique $data['audit_reference_title']
			$data['unique_audit_reference_title'] = array_unique($data['audit_reference_title']); 

			# urutkan tanggal dari urutan paling awal ke paling akhir
			usort($data['_helper_assessment_date_list'], function($a, $b){
				return strtotime($a) - strtotime($b);
			});
			# ambil tanggal awal
			$data['start_audit'] = $data['_helper_assessment_date_list'][0];
			$data['last_audit']  = $data['_helper_assessment_date_list'][count($data['_helper_assessment_date_list']) -1];
			$assessment_date 	 = $data['start_audit']; 

			# Penghitungan audit time -----------------------------------
			$_audit_time_fixed_auditor = 0;
			$_audit_time_audit_time = 0;
			foreach ($_audit_time as $key => $value) {
				$_audit_time_fixed_auditor = $_audit_time_fixed_auditor + $value['detail']['fixed_auditor'];
				$_audit_time_audit_time = $_audit_time_audit_time + $value['detail']['audit_time'];
				// $audit_time[$key]['detail'] = $value
				foreach ($value['data'] as $a => $b) {
					# code...
					$audit_time['data'][] = $b;
				}
			}
			$_audit_time_fixed_auditor = round($_audit_time_fixed_auditor / $data_len);

			$audit_time['detail']['audit_time'] = $_audit_time_audit_time;
			$audit_time['detail']['fixed_auditor'] = $_audit_time_fixed_auditor;
			#-------------------------------------------------------------

			// return false;

		}else{
			if($_GET['type_assessment'] == 'reassessment')
			{
				$data 			= $this->assessment_model->datasource_reassessment($id);
				$audit_time 	= $this->assessment_model->configure_audit_time($data['a0_cat'][0]['id_a0_cat'], FALSE);
			}else
			{
				$data 			= $this->assessment_model->datasource_assessment($id);
				$audit_time 	= $this->assessment_model->configure_audit_time($data['a0']['id_a0']);
			}

			$assessment_date = $data['a0']['assessment_date'];
		}


		#-----------------------------------------------------
		
		#-- GET SEMUA JABATAN -------------------------------
		$jabatan 			= $this->auditor_model->get_jabatan();
		#-----------------------------------------------------
		

		#-- GET AUDITOR YANG SESUAI DENGAN KOMPETENSI YANG DICARI------
		$competency = array_unique( $data['unique_audit_reference_id'] );
		

		$auditor_competent = $this->auditor_model->data_competent_and_available_auditor(
			array(
				'assessment_date' => $assessment_date,
				'competency' => $competency,
				'assessment_date_range' => $audit_time['detail']['audit_time'],
				)
			)->result_array();
		#---------------------------------------------------------------
		#-- GET TYPE CERTIFICATION(SNI...) BERDASARKAN TYPE REQUEST(JECA,JPA,YQ)
		foreach ($audit_time['data'] as $key => $value) {
			$this->audit_time_type = $value['type'];
			/*
			$a = array_filter($data['audit_reference_id_based_on_type'], function($res){
				return($res['type'] == $this->audit_time_type);
			});*/
			$a = array_unique( $data['audit_reference_id_based_on_type'][$value['type']] );

			// $ai = array_map(function($res){
			// 	return($res['audit_reference']);
			// }, $a);

			// $a = array_map(function($res){
			// 	return($res['name']);
			// }, $a);
			
			
			$audit_time['data'][$key]['competency']['name'] = $a;
			// $audit_time['data'][$key]['competency']['id'] = $ai;


		}

		// print_r($audit_time); return false;

		if( $this->isAjax == FALSE )
		{
			$this->load->view('templates/head', array('title' => 'Konfigurasi penugasan auditor'));
		}

		/*
		Data Needed?
		1. competency
		2. auditor relevan dengan kompetensi
		3. daftar request
		4. detail permintaan request.
		5. daftar perusahaan *group
		6. daftar jabatan -OK
		*/
		$this->load->view(
			'auditor/auditor_assignment', 
			array( 
				'auditor_competent' => $auditor_competent, 
				'audit_time' 		=> $audit_time, 
				'parameters' 		=> $_GET, 
				'data'				=> $data,//$_GET['type_coordination'] == 'single'? $data : $data['datasource'], 
				// 'company' 			=> @$data['company'], 
				'jabatan' 			=> $jabatan
				) 
			);

		if( $this->isAjax == FALSE )
		{
			$this->load->view('templates/footer');
		}
	}

	public function list_assigned_auditor()
	{
		$this->load->model('assessment_model');
		$this->load->model('company_model');
		$this->load->model('notes_model');
		$this->load->model('certification_model');
		$this->load->model('product_line_model');


		$isAjax = $this->input->is_ajax_request();
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/head', array('title' => 'Auditor Profile'));
		}

		$a0 			= $this->certification_model->get_a0($_GET['a0']);
		$company 		= $this->company_model->get_company($a0['id_company']);

		$schedule_a0 = array();
		$schedule_sv = array();
		$schedule_au = array();

		$schedule 		= $this->assessment_model->data_schedule_assessment($a0['id_company']);

		foreach ($schedule as $key => $value) {
			switch ($value['type_report']) {
				case 'assessment':
					$schedule_a0[$key] = $value;
					$schedule_a0[$key]['auditor'] = $this->auditor_model->get_auditor_log( array('assessment_type' => 'assessment', 'id_assessment' => $value['id_a0']) )->result_array() ;
					break;
				case 'reassessment':
					$schedule_sv[$key] = $value;
					$schedule_sv[$key]['auditor'] = $this->auditor_model->get_auditor_log(array('assessment_type' => 'assessment', 'id_assessment' => $value['id_rs']) )->result_array() ;
					break;
				case 'audit khusus':
					$schedule_au[$key] = $value;
					$schedule_au[$key]['auditor'] = $this->auditor_model->get_auditor_log(array('assessment_type' => 'assessment', 'id_assessment' => $value['id_a0']) )->result_array() ;
					break;
			}
		}
		// print_r($schedule_a0);
		$this->load->view('auditor/list_assigned_auditor', array('company' => $company, 'a0' => $schedule_a0, 'rs' => $schedule_sv, 'au' => $schedule_au ) );

		if( $isAjax == FALSE )
		{
			$this->load->view('templates/footer');
		}
	}

	/*
	| menampilkan data auditor dalam pop up
	*/
	public function pick_auditor()
	{
		

		$isAjax = $this->input->is_ajax_request();
		if( $isAjax == FALSE && $_GET['media'] !== 'window' ) 
		{
			$this->load->view('templates/head', array('title' => 'Auditor Profile'));
		}else
		{
			$this->load->view('templates/headsource', array('title' => 'Auditor Picker'));
		}

		
		$jabatan = $this->auditor_model->get_jabatan();
		$this->load->view('auditor/panel-auditor--pick-auditor', array('jabatan' => $jabatan) );
		$isAjax = $this->input->is_ajax_request();
		if( $isAjax == FALSE && $_GET['media'] !== 'window')
		{
			// $this->load->view('templates/footer');
		}
	}

	public function list_conducted_auditor($id_company = FALSE)
	{
		if($id_company === FALSE && !isset($_POST['company_name']))
		{
			show_error('Please gimme some data to access this!',404,'Parameters not found!');
		}
		$this->load->model('assessment_model');
		$this->load->model('company_model');

		$isAjax = $this->input->is_ajax_request();
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/head', array('title' => 'Auditor Profile'));
		}

		$company_name = $this->input->post('company_name');
		$a0Company = ($id_company !== FALSE)? array('id_company' => $id_company ) : array('company_name' => $company_name );
		$dataCompany = $this->company_model->CI_get_company( $a0Company );

		$a0 = $this->assessment_model->CI_get_schedules_new_assessment('*, GROUP_CONCAT(a0_cat.type SEPARATOR ",") as requested', 'ref = "new" AND a0_cat.`id_certificate`IS NULL and (a0_cat.status = "process" or a0_cat.status = "remidial") and a0.id_company = '.$id_company );
		foreach ($a0 as $key => $value) {
			$a0[$key]['data_detail'] = $this->assessment_model->get_detail_assessment($value['id_a0_cat']);
		}

		$rs = $this->assessment_model->CI_get_schedules_reassessment('*', 'rs.id_rs_schedule IS NOT NULL and (rs.rs_status = "process" or rs.rs_status = "remidial") and a0.id_company = '.$id_company);
		foreach ($rs as $key => $value) {
			$rs[$key]['data_detail'] = $this->assessment_model->get_detail_reassessment($value['id_rs']);
		}

		$ak = $this->assessment_model->CI_get_schedules_new_assessment('*', 'ref = "exist" AND a0_cat.`id_certificate`IS NOT NULL and (a0_cat.status = "process" or a0_cat.status = "remidial") and a0.id_company = '.$id_company );
		foreach ($ak as $key => $value) {
			$ak[$key]['data_detail'] = $this->assessment_model->get_detail_assessment($value['id_a0_cat']);
		}
		
		$this->load->view('auditor/list_conducted_auditor', array('company' => $dataCompany, 'new_assessment' => $a0, 'reassessment' => $rs, 'audit_khusus' => $ak) );
		
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/footer');
		}
	}

	/*
	* panel auditor
	*/
	public function panel_auditor()
	{
		$this->load->view('templates/head', array('title' => 'Auditor'));

		// $this->load->view('templates/navbar');

		$this->load->view('auditor/panel_auditor_index');

		$this->load->view('templates/footer');
	}

	/*
	| ----------------------
	| View tambah kompetensi auditor
	| ----------------------
	*/
	public function auditor_add_competency($id_auditor)
	{
		$isAjax = $this->input->is_ajax_request();
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/head', array('title' => 'Auditor Profile'));
		}
		if( $id_auditor !== FALSE )
		{
			$id_auditor = $id_auditor;
		}else
		{
			$id_auditor = $this->input->post('id_auditor');
		}
		$this->load->model('assessment_model');

		$profile = $this->auditor_model->get_auditor(array('id_auditor' => $id_auditor));

        $this->load->view('auditor/panel-auditor--add-competency', array('profile' => $profile) );
		
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/footer');
		}
	}

	/*
	|----------------------
	| Upload competency document 
	|----------------------
	*/
	public function upload_competency_documents($id_auditor, $id_competency)
	{
		if(!isset($id_auditor) || !isset($id_competency))
		{
			show_404();
		}

		$competency = $this->auditor_model->data_auditor_competency('*', array('id_auditor' => $id_auditor, 'competency' => $id_competency));

		$isAjax = $this->input->is_ajax_request();
		if( $isAjax == FALSE && $_GET['ajax'] == 0 )
		{
			$this->load->view('templates/head', array('title' => 'Tambah dokumen kompetensi'));
		}else
		{
			$this->load->view('templates/headsource', array('title' => 'Tambah dokumen kompetensi'));

		}
        $this->load->view('auditor/panel-auditor--add-competency-documents', array('id_auditor' => $id_auditor, 'id_competency' => $id_competency, 'competency' => $competency->row_array()) );
		
		if( $isAjax == FALSE && $_GET['ajax'] == 0)
		{
			$this->load->view('templates/footer');
		}
	}
	/*
	|----------------------
	| Upload pendidikan document 
	|----------------------
	*/
	public function upload_pendidikan_documents($id_pendidikan)
	{
		if(!isset($id_pendidikan) )
		{
			show_404();
		}

		$education = $this->auditor_model->data_auditor_education('*', array('id_riwayat_pendidikan_auditor' => $id_pendidikan))->row_array();

		$isAjax = $this->input->is_ajax_request();
		if( $isAjax == FALSE && $_GET['ajax'] == 0 )
		{
			$this->load->view('templates/head', array('title' => 'Tambah dokumen pendidikan'));
		}else
		{
			$this->load->view('templates/headsource', array('title' => 'Tambah dokumen pendidikan'));

		}
        $this->load->view('auditor/panel-auditor--add-pendidikan-documents', array('id_auditor' => $education['id_auditor'], 'id_riwayat_pendidikan_auditor' => $id_pendidikan, 'pendidikan' => $education ) );
		
		if( $isAjax == FALSE && $_GET['ajax'] == 0)
		{
			$this->load->view('templates/footer');
		}
	}

	public function panel_auditor_profile($id_auditor = FALSE)
	{
		$isAjax = $this->input->is_ajax_request();
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/head', array('title' => 'Auditor Profile'));
		}
		if( $id_auditor !== FALSE )
		{
			$id_auditor = $id_auditor;
		}else
		{
			$id_auditor = $this->input->post('id_auditor');
		}

		$profile = $this->auditor_model->get_auditor(array('id_auditor' => $id_auditor));


		// $profile = $this->input->post();
		$this->load->view('auditor/panel_auditor_profile', array('profile' => $profile));
		
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/footer');
		}

	}

	public function panel_auditor_settings($id_auditor)
	{
		$isAjax = $this->input->is_ajax_request();
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/head', array('title' => 'Auditor Profile'));
		}
		if( $id_auditor !== FALSE )
		{
			$id_auditor = $id_auditor;
		}else
		{
			$id_auditor = $this->input->post('id_auditor');
		}

		$profile = $this->auditor_model->get_auditor(array('id_auditor' => $id_auditor));

		$this->load->view('auditor/panel-audit--profile--settings', array('profile' => $profile));
		
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/footer');
		}

	}

	public function panel_auditor_add_auditor($id_jabatan = FALSE)
	{
		$isAjax = $this->input->is_ajax_request();
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/head', array('title' => 'tambah Auditor'));
		}


		if( $id_jabatan !== FALSE )
		{
			$id_jabatan = $id_jabatan;
		}else
		{
			$id_jabatan = $this->input->post('id_jabatan');
		}

		if(empty($id_jabatan))
		{
			show_error('Please Fill Up requirement','500', 'Kami Butuh Jabatan!');
		}

		// $profile = $this->input->post();
		$this->load->view('auditor/panel-auditor--add-auditor', array('id_jabatan' => $id_jabatan));
		
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/footer');
		}

	}

	/*
	////////////////////////////////// DIMULAINYA ERA PANEL AUDITOR //////////////////////////////////
	*/
	public function panel_auditor_dashboard($id_auditor)
	{
		$auditor = $this->auditor_model->data_auditor('*', array('id_auditor' => $id_auditor));
		if(!$id_auditor || count($auditor) < 1)
		{
			show_404();
		}
		$isAjax = $this->input->is_ajax_request();
		if( $isAjax == FALSE ) 
		{
			$this->load->view('templates/head', array('title' => 'Dashboard Auditor'));
		}else
		{
			$this->load->view('templates/headsource', array('title' => 'Dashboard Auditor'));
		}
		$this->load->view('auditor/panel_auditor/panel-auditor--profile--dashboard', array('auditor' => $auditor[0]) );
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/footer');
		}

	}

	public function panel_auditor_show_schedule($id_auditor)
	{
		$auditor = $this->auditor_model->data_auditor('*', array('id_auditor' => $id_auditor));
		if(!$id_auditor || count($auditor) < 1)
		{
			show_404();
		}

		$log = $this->auditor_model->get_log_audit( array('auditor.id_auditor' => $id_auditor) );


		$isAjax = $this->input->is_ajax_request();
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/head', array('title' => 'Jadwal Auditor'));
		}
		$schedule = array();
		foreach ($log as $key => $value) {
			$schedule[] = array(
					'title' => $value['assessment_type'].' '.$value['company_name'].' ( Click for detail )' ,
					'start' => $value['audit_start'],
					'url' => site_url('assessment/data_detail_certification/assessment/'.$value['id_assessment']),
					'end' => date('Y-m-d', strtotime($value['audit_end'])+(24*60*60) ),

				);
			$schedule[] = array(
					'title' => 'berangkat',
					'start' => date('Y-m-d', strtotime($value['audit_start'])-(24*60*60) ),
					'end' => $value['audit_start'],
					'color' => '#8bc34a'
				);
			$schedule[] = array(
					'title' => 'pulang',
					'start' => date('Y-m-d', strtotime($value['audit_end'])+(24*60*60) ),
					'end' => date('Y-m-d', strtotime($value['audit_end'])+(2*24*60*60) ) ,
					'color' => '#ec9528'
				);
			$schedule[] = array(
					'title' => 'istirahat',
					'start' => date('Y-m-d', strtotime($value['audit_end'] )+(2*24*60*60) ),
					'end' => date('Y-m-d', strtotime($value['audit_end'])+(3*24*60*60) )  ,
					'color' => '#dc361c'

				);
		}
		$schedule = json_encode($schedule);

		$this->load->view('auditor/panel_auditor/panel-auditor--profile--schedule', array('schedule' => $schedule, 'log' => $log) );
		
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/footer');
		}
	}


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// process
	

	// G E T
	public function get_login_status()
	{
		require_once(APPPATH.'libraries/profiling/Session.php');
		$this->load->library('profiling/Pengguna');

		$Sess = new Session;
		$result = array('is_auth' => false);
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$auditor = $this->auditor_model->check_data_login(array('username' => $username, 'password' => $password));

		if($auditor['is_authentic'])
		{
			$_SESSION['userauthentication']['is_login'] = true;
			$_SESSION['userauthentication']['level'] = 2;
			$_SESSION['userauthentication']['username'] = $auditor['auditor']['fullname'];
			$_SESSION['userauthentication']['email'] = $auditor['auditor']['email'];
			$_SESSION['userauthentication']['id_users'] = $auditor['auditor']['id_auditor'];
			$_SESSION['userauthentication']['avatar'] = $auditor['auditor']['avatar'];

			$this->pengguna->login($_SESSION['userauthentication']);

			$result = array(
				'found' => true,
				'data' => array(
					'username' => $auditor['auditor']['fullname'],
					'level' 	=> $auditor['auditor']['auditor_level'],
					'id_users' 	=> $auditor['auditor']['id_auditor'],
					),
				'is_auth' => true
			);
		}

		echo json_encode($result);
	}

	/*
	|-----------------
	| L O G O U T
	|-----------------
	*/
	public function logout()
	{
		require_once(APPPATH.'libraries/profiling/Session.php');
		$session = new Session;
		$session->destroy();
		if(isset($_GET['callback']))
		{
			header('location:'.site_url($_GET['callback']));
		}else
		{
			header('location:'.site_url('auditor/login'));
		}
	}

	public function get_auditor()
	{
		echo json_encode($this->auditor_model->get_auditor());
	}
	
	/*
	* get jataban
	* parameters 
		POST where  = array();

	*/
	public function get_jabatan()
	{
		$where = isset($_POST['where'])? $this->input->post('where') : array();
		
		$data = $this->auditor_model->get_jabatan($where);

		echo json_encode($data);
	}

	public function get_unrequested_competency()
	{
		$id_auditor = $this->input->post('id_auditor');
		$audit_reference = $this->auditor_model->unrequested_competency($id_auditor)->result_array();
		echo json_encode($audit_reference);
	}

	public function get_auditor_assigned($type, $id_a0)
	{
		$auditor = $this->auditor_model->get_auditor_log(array('assessment_type' => $type, 'id_assessment' => $id_a0) )->result_array() ;

		echo json_encode($auditor);
	}

	/*
	|----------------
	| FUNCTION get_auditor_competency()
	| params = @id_auditor int
	|----------------
	*/
	public function get_auditor_competency()
	{
		$data = $this->input->post();
		$data['is_approved'] = isset($data['is_approved'])? $data['is_approved'] : 1;
		/*if(!isset($data['id_auditor']))
		{
			show_error('Parameters required not found', 500);
		}*/
		$competency = $this->auditor_model->data_auditor_competency('*', array('id_auditor' => $data['id_auditor'], 'is_approved' => $data['is_approved'] ) );
		$competency = $competency->result_array();
		echo json_encode($competency);
	}

	public function get_auditor_education()
	{
		if(!isset($_POST['id_auditor']) )
		{
			header("HTTP/1.0 404 Auditor Not Found");
		}else{
			$d0 = $this->input->post('id_auditor');
			echo json_encode($this->auditor_model->get_auditor_education( $d0 ));
		}

	}

	public function get_log_audit()
	{	
		if(!isset($_POST['id_auditor']) )
		{
			header("HTTP/1.0 404 Auditor Not Found");
		}else{
			$d0 = $this->input->post('id_auditor');
			$d0 = $this->auditor_model->get_log_audit($d0);
			echo json_encode($d0);
		}
	}

	/*
	|---------------
	| Fucntion get auditor yang kompeten dan tersedia pada tanggal tertentu
	|--------------
	| @params
	|	- assessment_data @date
	| 	- competency @array @min = 1
	*/
	public function get_competent_and_available_auditor()
	{
		// $_POST = array('assessment_date' => '2016-11-28', 'competency' => [47,46], 'assessment_date_range' => 9);

		$a0 = $this->input->post('assessment_date');
		$a1 = $this->input->post('competency');
		$a2 = $this->input->post('assessment_date_range');

		
		$a2 = $this->auditor_model->data_competent_and_available_auditor(
			array(
				'assessment_date' => $a0,
				'competency' => $a1,
				'assessment_date_range' => $a2,
				)
			);
		echo json_encode($a2->result_array());
	}

	public function get_is_competent_audit()
	{

		$data = array();

		$a0 = $this->input->post('check_audit_reference');// audit reference that will check
		$a1 = $this->input->post('id_auditor');
		$a2 = $this->auditor_model->data_auditor_competency('audit_reference, id_auditor, name, competency', array('id_auditor' => $a1, 'is_approved' => 1 )); // get competency
		$a2 = $a2->result_array();
		$a3 = array_map(function($elm){
			return($elm['competency']);
		}, $a2);

		// jika hasil array_diff, jumlah nya masih sama seperti a0, berarti dia ndak ada yang kompeten.
		$a4 = array_diff($a0, $a3); // ambil nilai yang tidak kompeten
		$a5 = array_intersect($a0, $a3); // ambil nilai yang kompeten
		// print_r($a2);

		foreach ($a2 as $key => $value) {
			
			if( in_array($value['competency'], $a5) )
			{
				$data['competent'][] = $value;
			}

		}

		echo json_encode($data);
	}

	/*
	|-------------------
	| Function to get all auditor_schedule
	|-------------------
	*/
	public function get_schedule_auditor()
	{
		$id_auditor = $this->input->post('id_auditor');
		if(empty($id_auditor))
		{
			show_404();
		}
		$nowdate = date('Y-m-d');
		$schedule = $this->auditor_model->data_auditor_log('auditor_log_id, auditor.id_auditor, auditor_as, assessment_type, id_assessment, audit_start, audit_end, fullname', 'audit_start >= '.$nowdate.' and auditor.id_auditor = '.$id_auditor );
		echo json_encode($schedule);
	}

	/*
	|-------------------
	| Function to get all auditor_schedule
	|-------------------
	*/
	public function get_unaccepted_schedule_auditor()
	{
		// $_POST['id_auditor'] = 10;
		$id_auditor = $this->input->post('id_auditor');
		if(empty($id_auditor))
		{
			show_404();
		}
		$nowdate = date('Y-m-d');
		$schedule = $this->auditor_model->get_log_audit($id_auditor);
		echo json_encode($schedule);
	}


	// D E L E T E ///////////////////////////////////
	public function delete_auditor()
	{
		$data = $this->input->post();
		$this->auditor_model->delete_auditor( array('id_auditor' => $data['id_auditor']) );
		
	}

	public function delete_auditor_competency()
	{
		$data = $this->input->post();
		
		if(isset($data['id_auditor']) && isset($data['competency']))
		{
			$this->auditor_model->delete_auditor_competency( array('id_auditor' => $data['id_auditor'], 'competency' => $data['competency']) );
		}
		
	}

	public function delete_auditor_log()
	{
		$item = $this->input->post('item');
		$assessment_type = $this->input->post('assessment_type');
		$id_assessment = $this->input->post('id_assessment');
		foreach ($item as $key => $value) {
			# code...
			$this->auditor_model->delete_auditor_log(array('id_auditor' => $value, 'assessment_type' => $assessment_type, 'id_assessment' => $id_assessment ));
		}
	}

	public function delete_log_pendidikan_auditor()
	{
		$id_riwayat_pendidikan_auditor = $this->input->post('id_riwayat_pendidikan');
		$this->auditor_model->delete_log_pendidikan_auditor( array('id_riwayat_pendidikan_auditor' => $id_riwayat_pendidikan_auditor) );
	}

	// U P D A T E ////////////////////////////////////
	public function update_auditor()
	{
		$data = $this->input->post();
		$id_auditor = array_shift($data);

		$this->auditor_model->update_auditor($data, array('id_auditor' => $id_auditor) );
	}

	public function update_auditor_assigned()
	{
		if(isset($_POST['removed']) && count($_POST['removed']) > 0)
		{
			foreach ($_POST['removed'] as $key => $value) {
		
				$this->auditor_model->delete_auditor_assigned($_POST['id_a0'], $value['id_auditor'], $_POST['type']);
			}
		}

		if(isset($_POST['newdata']) && count($_POST['newdata']) > 0)
		{
			foreach ($_POST['newdata'] as $key => $value) {
				$this->auditor_model->save_auditor_assignment($_POST['id_a0'], (int) $value);
			}
		}
	}

	public function auditor_log_schedule_confirm()
	{
		$auditor_log = $this->input->post('auditor_log_id');
		$schedule_confirm = $this->input->post('schedule_confirm');
		$schedule_confirm = ($schedule_confirm < 0)? -1 : 1;

		$this->auditor_model->update_auditor_log(array('schedule_confirm' => $schedule_confirm), array('auditor_log_id' => $auditor_log) );

	}

	public function update_photo_auditor()
	{
		$data = $this->input->post();
		$id_auditor = $data['id_auditor'];
		
		$dir = $this->create_folder_auditor($id_auditor);
		$this->upload_avatar_auditor(array(
			'upload_path' => $dir['auditor_directory'].'/images',
			'id_auditor' => $id_auditor
		));
		$this->auditor_model->update_auditor(array('avatar' => $dir['auditor_directory'].'/images/'.$id_auditor.'_ava.png'), array('id_auditor' => $id_auditor) );
		print_r($_REQUEST);
		print_r($_FILES);
	}

	public function post_auditor_assignment()
	{
		$post = $this->input->post();
		$this->auditor_model->prepare_save_auditor_assignment( $post );

		// Notification
		$this->load->model('notification_model');
		$this->load->model('company_model');

		$company = $this->company_model->data_company('*', array('id_company' => $post['data'][0]['company']), 0);
		$this->notification_model->insert_notification(array(
			'notification_text' => 'LSBBKKP telah menambahkan auditor untuk jadwal assessment anda',
			'notification_for_level' => $company['company_level'], // level-perusahaan
		));


		// print_r($_POST);
		// foreach ($_POST['schedules_confirmed'] as $skey => $svalue) {
		// 	foreach ($_POST['auditor_assignment'] as $key => $value) {
		// 	}
		// }
	}

	public function post_auditor_education()
	{
		$data = $this->input->post();
		$data = $this->auditor_model->add_auditor_education($data);
		echo json_encode( array('data' => $data) );
	}

	public function update_auditor_competency()
	{
		$data = $this->input->post();
		$update = array();
		$where = array();

		$update['is_approved'] = $data['confirmation'];
		$update['approved_by'] = $_SESSION['id_users'].'.'.$_SESSION['level'];

		$where['id_auditor'] = $data['id_auditor'];
		$where['competency'] = $data['competency'];
		$this->auditor_model->update_auditor_competency($update, $where);

	}

	public function update_approval_auditor_education()
	{
		$data = $this->input->post();
		$update = array();
		$where = array();

		$update['is_approved'] = $data['status'] < 1? 0 : 1;
		$update['approved_by'] = $_SESSION['id_users'].'.'.$_SESSION['level'];

		$where['id_riwayat_pendidikan_auditor'] = $data['id_riwayat_pendidikan_auditor'];
		$this->auditor_model->update_auditor_education($update, $where);

	}

	public function update_auditor_education()
	{
		$data = $this->input->post();
		$update = array();
		$where = array();

		$update['pendidikan'] = $data['pendidikan'];
		$update['jurusan'] = $data['jurusan'];
		$update['tahun_masuk'] = $data['tahun_masuk'];
		$update['tahun_lulus'] = $data['tahun_lulus'];
		$update['jenjang'] = $data['jenjang'];

		$where['type_riwayat'] = $data['type_riwayat'];
		$where['id_riwayat_pendidikan_auditor'] = $data['id_riwayat_pendidikan_auditor'];
		$this->auditor_model->update_auditor_education($update, $where);

	}

	public function upload_competency_document()
	{
		$this->load->model('files_model');

		$id_auditor = $this->input->post('id_auditor');
		$id_competency = $this->input->post('competency');

		$config['upload_path'] 		= APPPATH.'clients/auditors/'.$id_auditor.'/documents/';
		$config['encrypt_name']		= TRUE;
		$config['allowed_types'] 	= '*';

		$files = $this->files_model->upload($config, $_FILES);
		$id_files = array_map(function($res){
			return($res['id_files']);
		}, $files);
		$id_files = implode(',', $id_files);

		$this->auditor_model->update_auditor_competency( array('competency_documents' => $id_files), array('id_auditor' => $id_auditor, 'competency'=>$id_competency) );
	}

	public function upload_kegiatan_documents()
	{
		$this->load->model('files_model');

		$id_riwayat_pendidikan_auditor = $this->input->post('id_riwayat_pendidikan_auditor');
		$education = $this->auditor_model->data_auditor_education('*', array('id_riwayat_pendidikan_auditor' => $id_riwayat_pendidikan_auditor))->row_array();

		$config['upload_path'] 		= APPPATH.'clients/auditors/'.$education['id_auditor'].'/documents/';
		$config['encrypt_name']		= TRUE;
		$config['allowed_types'] 	= '*';

		$files = $this->files_model->upload($config, $_FILES);
		$docs = array_map(function($res){
			return($res['id_files']);
		}, $files);
		$docs = implode(',', $docs);

		if(!empty($education['dokumen_bukti_pendidikan']))
		{
			$dcs[] = $docs;
			$dcs[] = $education['dokumen_bukti_pendidikan'];
			$docs = implode(',', $dcs);
		}

		$this->auditor_model->update_auditor_education( array('dokumen_bukti_pendidikan' => $docs), array('id_riwayat_pendidikan_auditor' => $id_riwayat_pendidikan_auditor ) );
	}
	

	/*
	|---------------------------
	| Insert Auditor Log
	|---------------------------
	*/

	public function insert_new_auditor()
	{

		if(isset($_POST['jabatan']))
		{
			$data = $this->input->post();	
			
			$d0 = $this->auditor_model->insert_new_auditor($data);
			if(is_int($d0) && $d0 > 0)
			{
				$dir = $this->create_folder_auditor($d0);
				$this->upload_avatar_auditor(array(
					'upload_path' => $dir['auditor_directory'].'/images',
					'id_auditor' => $d0
				));

			}
		}

	}

	public function upload_avatar_auditor($data = array())
	{
		$this->load->helper(array('form', 'url'));

		$config['upload_path'] = isset($data['upload_path'])? $data['upload_path'] : '.';
		$config['allowed_types'] = '*';
		$config['overwrite'] = TRUE;
		$config['file_name'] = @$data['id_auditor'].'_ava.png';


		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('avatar'))
		{
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
			// $this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			print_r($data);

			// $this->load->view('upload_success', $data);
		}
	}

	public function insert_auditor_log()
	{
		$auditor = $this->input->post('auditor');
		$type_assessment = $this->input->post('assessment_type');
		$id_assessment = $this->input->post('id_assessment');
		foreach ($auditor as $key => $value) {		
			$this->auditor_model->save_auditor_assignment($id_assessment, $value, $type_assessment);
		}
		// print_r($id_assessment);
	}

	/*
	|-------------------
	| Function insert new competency
	|-------------------
	| @params
	|	- id_auditor @int
	| 	- competency @int from audit_reference
	*/
	public function insert_new_competency()
	{
		$this->load->model('assessment_model');
		$data = $this->input->post();	
		$audit_ref = $this->assessment_model->data_audit_reference('*', array('audit_reference' => @$data['competency']) );

		// $check_avaibility_audit_reference = 
		if(isset($data['id_auditor']) && isset($data['competency']) && count($audit_ref) > 0)
		{

			$is_approved = ( $_SESSION['level'] == 1 || $_SESSION['level'] == 100)? 1 : 0;
			$dataInsert = array(
					'id_auditor' => $data['id_auditor'],
					'competency' => $data['competency'],
					'competency_added_time' => date('Y-m-d H:i:s'),
					'added_by_level' => $_SESSION['level'],
					'added_by_id' => $_SESSION['id_users'],
					'is_approved' => $is_approved
				);
			$d0 = $this->auditor_model->insert_new_competency($dataInsert);
			header("HTTP/1.0 200 Kompetensi selesai ditambahkan");
			
		}else
		{
			header("HTTP/1.0 500 Kompetensi tidak ditemukan atau beberapa parameter tidak ditemukan");
		}

	}

	/*
	|-----------------------------------------
	| Create new auditor account as user
	|-----------------------------------------
	|
	| @params
	| - POST @password string
	| - POST @id_auditor int
	|------------------------------------------
	*/

	public function create_new_account_auditor()
	{
		$password = $this->input->post('password');
		$id_auditor = $this->input->post('id_auditor');

		if(!isset($password))
		{
			show_error('password required', 500);
		}

		require_once(APPPATH.'libraries/profiling/Pengguna.php');
		$this->load->model('users_model');

		$user = new Pengguna;
		$user = $user->create_account(array(
				'password' => $password
			));	

		$keychain = $this->users_model->save_keychain($user['key_A'], $user['key_B']);

		$this->auditor_model->update_auditor(array('auditor_password' => $user['password'], 'auditor_keychain' => $keychain), array('id_auditor' => $id_auditor) );
	}	

	/*
	|-----------------
	| Create Folder for Auditor
	|-----------------
	|
	| @params 
	| - Params @id_auditor int
	|
	*/
	public function create_folder_auditor($id_auditor)
	{
		$dir_prop = array('images','documents');

		$rootclients = APPPATH.'clients/auditors/';
		$dirclient = $rootclients.$id_auditor;
		$is_dir_roots = is_dir( $rootclients );
		$is_dir_client = is_dir($dirclient);
		if($is_dir_roots)
		{
			if(!$is_dir_client)
			{
				mkdir($dirclient, 0777);
			}

			foreach ($dir_prop as $key => $value) {
				$prop = $dirclient.'/'.$value;
				if(!is_dir($prop))
				{
					mkdir($prop, 0777);
				}				
			}
		}

		return array('auditor_directory' => $dirclient);
	}

	/*
	|
	| T E S T E R
	|
	*/
	public function tester_email_send()
	{
		$this->load->model('company_model');
		$company = $this->company_model->data_company('*', array('id_company' => 1), 0);
		$this->load->library('mail');
		$this->mail->from('Tester','Tester@cplusco.com');
		$this->mail->subject('Kesanggupan auditor');
		$this->mail->to('dhoni.p.saputra@gmail.com');
		$d = $this->load->view('templates/email/template--penunjukan-kesanggupan-auditor', array(
				'perusahaan' => $company['company_name'],
				'alamat' => $company['company_address'],
				'type_pelaksanaan' => 'Assessment baru',
				'auditor' => 'Budiwiyanto',
				'jenis_produk' => 'Crumb Rubber/ SIR 10',
				'standard_acuan' => 'SNI. ISO 9001:2008',
				'tanggal_pelaksanaan' => '22 - 30 Maret 2017',

			), TRUE);
		$this->mail->message($d);

		$this->mail->send();
		echo $d;
		// print_r($company);
	}
	
}
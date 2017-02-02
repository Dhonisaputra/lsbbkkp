<?php

/**
* 
*/
class Certification extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('certification_model');
		$this->load->library('lib_login');
		$this->isAjax = $this->input->is_ajax_request();

	}

	// VIEWS FOR DOCUMENTS CERTIFICATION REQUEST ===========================================

	public function document__kondisi_umum_peusahaan__informasi_tambahan()
	{
		$this->load->view('templates/headsource', array('title' => 'Kondisi umum perusahaan -- informasi tambahan'));

		$this->load->view('certification/document_templates/kondisi-umum-perusahaan--informasi-tambahan');

	}
	public function document__surat_pernyataan()
	{
		
		$this->load->view('certification/document_templates/surat-pernyataan','');
		

	}
	/*
	| VIEW =================================================================================
	*/
	public function index()
	{
		$this->lib_login->restriction_login();
		
		$this->load->view('templates/head', array('title' => 'Certification List'));

		$this->load->view('templates/navbar');

		$data = $this->certification_model->get_certification_list();

		$this->load->view('certification/dashboard', array('certification' => $data));

		$this->load->view('templates/footer');
	}

	public function adding_certification($id_company)
	{
		$this->lib_login->restriction_login();
		$this->load->model('company_model');
		$data_company = $this->company_model->data_company('*', array('id_company' => $id_company));

		if(count($data_company) < 1)
		{
			show_404();
			return false;
		}
		if(!$this->isAjax)
		{
			$this->load->view('templates/head', array('title' => $data_company[0]['company_name'].' - Permintaan sertifikasi baru'));
		}

		$this->load->view('certification/request_certification', array('id_company' => $id_company) );
		if(!$this->isAjax)
		{
			$this->load->view('templates/footer');
		}
	}

	public function add_existing_certification($id_company)
	{
		$this->lib_login->restriction_login();
		$this->load->model('company_model');
		$data_company = $this->company_model->data_company('*', array('id_company' => $id_company));

		if(count($data_company) < 1)
		{
			show_404();
			return false;
		}
		if(!$this->isAjax)
		{
			$this->load->view('templates/head', array('title' => $data_company[0]['company_name'].' - Tambah sertifikasi yang telah terbit'));
		}

		$this->load->view('certification/request_existing_certification', array('id_company' => $id_company) );
		if(!$this->isAjax)
		{
			$this->load->view('templates/footer');
		}
	}

	public function add_existing_certification_a0_cat_detail_section($id_company, $id_a0)
	{
		$this->lib_login->restriction_login();
		$this->load->model('company_model');
		$this->load->model('assessment_model');

		$data_company = $this->company_model->data_company('*', array('id_company' => $id_company));
		$a0_cat = $this->assessment_model->data_a0_cat('*', array('id_a0' => $id_a0));
		$certificate = array_map(function($res){
			return($res['id_certificate']);
		}, $a0_cat);
		$old_reference = $this->certification_model->add_existing_certification_a0_cat_detail_section__data_old_reference($certificate)->result_array();
		foreach ($old_reference as $key => $value) {
			$olds[$value['id_certificate']] = $value;
		}
		
		if(count($data_company) < 1)
		{
			show_404();
			return false;
		}
		if(!$this->isAjax)
		{
			$this->load->view('templates/head', array('title' => $data_company[0]['company_name'].' - Tambah sertifikasi yang telah terbit'));
		}

		$this->load->view('certification/request_existing_certification_a0_cat_detail', array( 'reference' => @$olds, 'id_company' => $id_company, 'a0_cat' => $a0_cat) );
		if(!$this->isAjax)
		{
			$this->load->view('templates/footer');
		}
	}

	public function adding_certification__no_template($id_company)
	{

		$this->lib_login->restriction_login();
		$this->load->view('certification/certification_begin', array('id_company' => $id_company) );
	}

	public function add_old_reference($certificate_md5)
	{
		$this->load->view('templates/head', array('title' => 'add old reference' ));
		$data = $this->certification_model->data_certificate('*', array( 'certificate_md5' => $certificate_md5 ),0);
		$old = $this->certification_model->data_old_certificate('*', array( 'id_certificate' => $data['id_certificate'] ));
		$dataOld = $old->row_array();

		$data['has_old'] = count($old->result_array()) > 0? 1 : 0;
		$data['old'] = count($old->result_array()) > 0?  $dataOld['old_reference']: '';
		

		$this->load->view('certification/certificate--add-old-reference', array('data' => $data));
		$this->load->view('templates/footer');
	}

	public function audit_khusus($md5_certification)
	{
		$this->lib_login->restriction_login();
		$this->load->model('assessment_model');

		$d0 = $this->certification_model->get_certificate_dynamic(array( 'certificate_md5' => $md5_certification ));
		$d0_data = $d0->row_array();

		$this->load->view('templates/head', array('title' => 'Audit Khusus' ));


		// data latest expiration
		$d1 = $this->certification_model->getExpiredLatestResurvey($d0_data['id_certificate']); 

		// get data a0;
		$d2 = $this->assessment_model->get_a0($d0_data['id_a0']);

		if( count($d0->result_array()) > 0 )
		{
			if( md5($d0_data['id_certificate'].'.'.$d0_data['id_a0_cat']) == $md5_certification )
			{
				$this->insert_product_view(array('id_company' => $d0_data['id_company'], 'data' => $d0_data, 'expired' => $d1, 'a0' => $d2['a0'] ));
			}else
			{
				// show error
				// show_error('Certificate Not Found! Something not right', 500 );
			}
		}else
		{
			// show error
			// show_error('Certificate Not registered!', 500 );
		}

		$this->load->view('templates/footer');

	}

	public function insert_product_view( $data = array() )
	{
		$this->lib_login->restriction_login();
		$this->load->view('certification/certification_audit_khusus', $data);
	}

	public function create()
	{
		$this->lib_login->restriction_login();
		$this->load->view('certification/create');
	}


	/* == PANEL CERTIFICATION == */
	# THIS SECTION IS VIEW FOR PANEL CERTIFICATION

	/*
	* view create new certification
	*/
	public function panel_certification()
	{

		$this->lib_login->restriction_login();
		$data['product_line']['all'] = $this->certification_model->get_overall_product_line();

		$data['product_line']['category'] = array_filter( $data['product_line']['all'], function($k){
			return $k['product_line_parent'] == "0";
		});	


		$this->load->view('templates/head', array('title' => 'Certification List'));
		$this->load->view('certification/panel/panel_certification--index', $data);
		$this->load->view('templates/footer');

	}

	/*
	* FORM ADD NEW CERTIFICATION ITEM
	*/
	public function panel_form_new_certification()
	{
		$this->lib_login->restriction_login();
		$this->load->view('certification/panel/panel-certificate--form-add-certificate-request');
	}

	/*
	* FORM ADD NEW PRODUCT LINE ITEM
	*/
	public function panel_form_new_product_line()
	{
		$this->lib_login->restriction_login();
		$this->load->view('certification/panel/panel-certificate--form-add-product-line');
	}

	/*
	* FORM edit NEW PRODUCT LINE ITEM
	*/
	public function panel_form_edit_product_line()
	{
		$this->lib_login->restriction_login();
		$this->load->view('certification/panel/panel-certificate--form-edit-product-line');
	}

	/*
	|----------------------------
	| Detail Audit Reference
	|----------------------------
	*/
	public function detail_audit_reference($audit_reference, $name)
	{
		$this->lib_login->restriction_login();
		$isAjax = $this->input->is_ajax_request();
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/head', array('title' => 'Auditor Profile'));
		}
		$dAR = $this->input->post('audit_reference');// data Audit Reference
		$d0 = $this->certification_model->get_certification_category(array('audit_reference' => $audit_reference));

		$this->load->view('certification/panel/panel-certificate--audit-reference--edit', array('AR' => $d0[0]) );

		if( $isAjax == FALSE )
		{
			$this->load->view('templates/footer');
		}
	}

	/*
	|-----------------------
	| view Certificate export as pdf
	|-----------------------
	*/
	public function view_certificate($id_a0_cat)
	{
		
		$this->load->helper('download');
		$this->load->model('assessment_model');
		$this->load->helper('file');
		$data = $this->assessment_model->get_detail_assessment($id_a0_cat);
		$this->load->view('templates/headsource', array('title' => ''));

		$cfnm = str_replace('/', '.', $data['a0_cat']['id_certificate']);
		
		$fileloc = base_url('application/clients/Companies/'.$data['company']['id_company'].'/certificates/'.$cfnm.'.pdf');
		$this->load->view('company/company_certificate_public_view', array('data' => $data));

		/*echo '<style>body {overflow:hidden;}</style>
		<object data="'.$fileloc.'" type="application/pdf" width="100%" style="height:100vh;">
		      <embed src="'.$fileloc.'" type="application/pdf" width="100%" style="height:100vh;"/>
		      <p>It appears you do not have PDF support in this web browser. <a href="my-pdf-file.pdf" target="_blank">Click here to download the document.</a></p>
		</object>';*/
	}

	/*
	|
	| Search certificate
	|
	*/
	public function search_certificate()
	{
		$certificate = $this->certification_model->get_certificate_dynamic();
		$certificate = $certificate->result_array();
		// print_r($certificate);return false;

		$isAjax = $this->input->is_ajax_request();
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/head', array('title' => 'Search certificate'));
		}
		$this->load->view('certification/panel-search-certificate', array('certificate' => $certificate ));
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/footer');
		}
	}

	/*
	|
	| AKUNTANSI -- REVIEW PAYMENT
	|
	*/
	public function review_payment_certification()
	{
		$isAjax = $this->input->is_ajax_request();
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/head', array('title' => 'Check pembayaran sertifikasi'));
		}
		$this->load->view('certification/panel-akuntansi--review_payment');
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/footer');
		}
	}

	public function upload_nota_pembayaran_sertifikasi($id_a0)
	{
		$this->load->model('assessment_model');
		$a0 = $this->assessment_model->data_a0('*', array('id_a0' => $id_a0), 0);

		$isAjax = $this->input->is_ajax_request();
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/head', array('title' => 'Upload bukti pebayaran'));
		}
		$this->load->view('certification/certification--upload-bukti-pembayaran', array('a0' => $a0));
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/footer');
		}
	}

	public function panel_manipulasi_kelengkapan_dokumen()
	{

		$isAjax = $this->input->is_ajax_request();
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/head', array('title' => 'Kelengkapan dokumen'));
		}

		$this->load->view('certification/panel--manipulate--kelengkapan-dokumen');
		if( $isAjax == FALSE )
		{
			$this->load->view('templates/footer');
		}
	}

	public function detail_invoice($id_a0)
	{
		$this->load->model('assessment_model');
		$this->load->model('invoice_model');

		$a0 = $this->assessment_model->data_a0('*', array('id_a0' => $id_a0), 0);
		$permintaan = $this->certification_model->data_kelengkapan_permintaan('*', array('id_a0' => $id_a0))->row_array();
		$detail_invoice = $this->invoice_model->data_invoice_detail('*', array('id_invoice' => $a0['id_invoice']))->result_array();
		$invoice = $this->invoice_model->data_invoice('*', array('id_invoice' => $a0['id_invoice']))->row_array();

		$this->load->view('templates/headsource', array('title' => 'detail invoice'));
		$this->load->view('invoice/page--detail-invoice', array(
			'a0' => $a0, 
			'permintaan' => $permintaan, 
			'detail_invoice' => $detail_invoice,
			'invoice' => $invoice
			)
		);

	}
	/*
	|
	* /////////////////////////////////// P R O C E S S ////////////////////////////////////////////////////////////////
	|
	*/

	/*
	| ----------------
	|  G E T
	| ----------------
	*/

	/*
	& function to retrieved all data certification in certification category.
	*/
	public function get_certification_list()
	{
		echo json_encode($this->certification_model->get_certification_list());
	}

	/*
	* function get scope certificate
	*/
	public function get_scope_certificate()
	{
		echo json_encode( $this->certification_model->get_scope_certificate() );
	}

	/*
	* function get nace certificate
	*/
	public function get_nace_certificate()
	{
		echo json_encode( $this->certification_model->get_nace_certificate() );
	}

	/*
	* function get product line certificate
	*/
	public function get_product_line_overall()
	{
		$d0 = $this->certification_model->get_overall_product_line();
		echo json_encode( $d0 );
	}

	# PRODUCT LINE ITEM ///////////////////////
	/*
	* function get product line certificate
	*/
	public function get_product_line_certificate()
	{
		echo json_encode( $this->certification_model->get_product_line_certificate() );
	}

	/*
	* get product lline subcategory
	*/
	public function get_product_line_subcategory_certificate()
	{
		echo json_encode( $this->certification_model->get_product_line_subcategory_certificate() );
	}

	/*
	* function get product line category
	*/
	public function get_product_line_category_certificate()
	{
		echo json_encode( $this->certification_model->get_product_line_category_certificate() );
	}

	/*
	* get CERTIFICATE list
	* to fetch certificate list
	*
	* function status : used;
	*/
	public function get_certificate_list()
	{
		echo json_encode($this->certification_model->get_certificate_list());
		// print_r($this->certification_model->get_certificate_list());
	}

	/*
	* get certification status == active
	*
	* function status : used
	*/
	public function get_certification_active_in_company($id_company)
	{
		$data = $this->certification_model->get_certification_active_in_company(array('id_company' => $id_company))->result_array();
		echo json_encode($data);
	}

	/*
	* get certification status == active
	*
	* function status : used
	*/
	public function get_certification($status = 'active')
	{
		$data = $this->certification_model->get_certification($status);
		echo json_encode($data);
	}

	public function get_data_a0_cat($id_a0_cat, $type = NULL)
	{
		$type = (isset($type) && !empty($type))? $type : $_POST['type']; 
		$certificate = $this->certification_model->get_a0_cat($id_a0_cat, $type);
		echo json_encode($certificate);
	}

	/*
	* function retrieve data certification used before
	*/
	public function getUsedCertification()
	{
		$a = $this->input->post('id_certificate');
		// $a = 'JECA-004/1';
		$a = $this->certification_model->getUsedCertification($a);
		echo json_encode($a);
	}

	/*
	* all request assessment in progress
	* 
	*/
	public function list__all_request_assessment_in_progress()
	{
		$this->load->model('tools');
		$data = $this->certification_model->get__data_request_assessment_in_progress();
		foreach ($data as $key => $value) {
			$data[$key]['url_token'] = $this->tools->hash_confirmation_address($value['token']);
		}
		return $data;
	}

	/*
	* GET CERTIFICATION WHICH AVAILABLE TO REGISTER FOR SPECIFIC BRAND.
	*
	* $_POST contain
		- id_company
	*/
	public function brand_available_certification()
	{
		$certificate = $this->certification_model->get_certification_available_in_brand($_POST);
		echo json_encode($certificate);
	}

	public function company_active_certification()
	{
		$certificate = $this->certification_model->get_certification_active_in_company($_POST);
		echo json_encode($certificate);
	}

	public function certification_type()
	{
		$this->load->library('dataakses');
		$data = $this->dataakses->get_enum('certification_category', 'type');
		echo json_encode($data);
	}

	public function draft_new_certification_available()
	{
		$this->load->library('dataakses');
		$data = '';
		switch ($_POST['type']) {
			case 'JPA-009':
				# code...
				$data = $this->dataakses->SQL(' SELECT * FROM certification_category where NOT EXISTS (SELECT * FROM a0 join a0_cat using(id_a0) join company using(id_company) join brand using(id_company) join a0_cat_master using(id_a0_cat) where dibrakom = '.$_POST['id_brand'].' and certification_category.audit_reference = a0_cat_master.audit_reference) and type = "JPA-009" ');
				echo json_encode($data);
				break;
		}
		
	}

	/*
	* insert new product in existed certificate
	*/
	public function request_insert_product()
	{
		$post = $this->input->post(NULL, TRUE);
		$this->certification_model->audit_khusus($post);
	}

	public function request_assessment()
	{
		if(isset($_POST['certification']) )
		{
			// $this->certification_model->save_certification_company($_POST);
		}else
		{
			header("HTTP/1.0 500 no data certification found!");
			// print_r($_POST);
			// echo json_encode( array('code' => 400, 'message' => 'no certification found!', 'type' => 'alert') );
		}
	}

	/*
	* check compatibility certification
	* parameters needed
	* type, dibrakom[ id_divisi, id_brand, brand.id_commodity ], audit_reference
	* access = certification/process/check/compatibility_dibrakom
	*/

	public function get_compatibility_dibrakom_with_certification()
	{
		
		foreach ($_POST['dibrakom'] as $key => $value) {
			$_POST['dibrakom'] = $value['value'];
			$result[] = $this->certification_model->get_compatibility_dibrakom_with_certification($_POST);
		}

		echo json_encode($result);
	}


	public function get_surveilen($id_certificate)
	{
		$this->load->model('assessment_model');
		$issued = $this->certification_model->data_issued('*', array('id_certificate' => $id_certificate) );
		$issued = array_pop($issued);
		$rs = $this->assessment_model->data_rs('*', array('id_issued' => $issued['id_issued'] ) );
		$data = array('data' => $rs);
		$data['finish'] = array_filter($rs, function($res){
			return($res['rs_status'] == 'success');
		});
		$data['unscheduled'] = array_filter($rs, function($res){
			return($res['rs_status'] == NULL);
		});
		$data['fail'] = array_filter($rs, function($res){
			return($res['rs_status'] == 'fail');
		});
		$data['remidial'] = array_filter($rs, function($res){
			return($res['rs_status'] == 'remidial');
		});
		$data['success'] = array_filter($rs, function($res){
			return($res['rs_status'] == 'success');
		});
		$data['ongoing'] = array_filter($rs, function($res){
			return($res['rs_status'] == 'process');
		});
		$data['next_surveilen'] = ( count($data['success']) >= 0 && count($data['success']) < count($data['data']) )? count($data['success']) + 1 : null  ;
		$data['previous_surveilen'] = ( count($data['success']) > 0 && count($data['success']) <= count($data['data']) )? count($data['success']) : 0  ;
		$data['last_surveilen'] = ( count($data['success']) > 0 && count($data['success']) == count($data['data']) )? true : false  ;
		$data['first_surveilen'] = ( count($data['success']) == 0 )? true : false  ;
		$data['total_surveilen'] = count($data['data'])  ;

		if( count($data['ongoing']) > 0 )
		{
			$done = array();
			foreach ($rs as $key => $value) {
				if($value['rs_status'] == 'success' || $value['rs_status'] == 'process' || $value['rs_status'] == 'remidial' )
				{
					array_push($done, $value['id_rs']);
				}
			}

			$data['surveilen_no'] = count($done);
		}

		return $data;
	}

	/*
	|-------------------
	| Audit Time
	|-------------------
	*/
	public function data_audit_time()
	{
		
		$as = $this->input->post('as');
		$company_employee = $this->input->post('company_employee');

		if($as == 'combine')
		{	
			$req = array();
			$data = $this->input->post('data');
			foreach ($data as $key => $value) {
				
				$a = $this->certification_model->get_audit_time($company_employee, $value['type'], $value['risk']);
				$a = $a->row_array();
				$req[] = array(
						'risk' => $a['risk_value'], 
						'day' => $a['audit_time'], 
						'limit' => $a['limit']
					);
			}
			$b = $this->audit_time_collective($req);
			echo json_encode($b);
		}else
		{
			$employee = $this->input->post('employee');
			$type = $this->input->post('type');
			$risk = $this->input->post('risk');

			$a = $this->certification_model->get_audit_time($employee, $type, $risk);
			$a = $a->row_array();
			$b = $this->audit_time_single($a['risk_value'], $a['audit_time'], $a['limit']);
			
			echo json_encode($b);
		}

	}
	public function audit_time_single($risk, $day, $limit = null)
	{
		$data = $this->certification_model->audit_time_single($risk, $day, $limit);
		return $data;
	}

	public function audit_time_collective($certification)
	{
		$data = $this->certification_model->audit_time_collective($certification);
		return $data;
	}

	public function get_payment_requested_assessment()
	{
		$post = $this->input->post();
		$where = array();
		$like = array();
		if($post['search_payment_company'] != '')
		{
			$like = array('company_name' => $post['search_payment_company']);
		}
		$data = $this->certification_model->get_payment_requested_assessment($like);
		echo json_encode($data);
	}

	public function get_master_requirement_kelengkapan_dokumen()
	{
		$data = $this->certification_model->data_master_kelengkapan_permintaan('*')->result_array();
		echo json_encode($data);
	}

	public function status_pengajuan($id_company, $id_permintaan_sertifikasi)
	{
		$this->load->model('invoice_model');

		// AMBIL KELENGKAPAN DOKUMENT ==========================
		$kelengkapan = $this->certification_model->get_kelengkapan_sertifikasi_perusahaan($id_company, $id_permintaan_sertifikasi);
		// ambil id files dari detail untuk pengecheckan data kelengkapan dokumen
		$_docs_file = array_column($kelengkapan['detail_kelengkapan_permintaan_sertifikasi'], 'id_files');
		$_required_but_null = array_filter($kelengkapan['detail_kelengkapan_permintaan_sertifikasi'], function($res){
			return($res['is_important'] == 1 && @$res['id_files'] == NULL);
		});

		// ambil yang nilain nya id_files == null
		$NULL_DOCS = array_filter($_docs_file, function($res){
			return($res == null);
		});
		// =======================================================

		// AMBIL NOTA PEMBAYARAN
		$detail_invoice = array();
		if(!is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['id_invoice']))
		{
			$detail_invoice = $this->invoice_model->data_invoice_detail('*', array('id_invoice' => $kelengkapan['kelengkapan_permintaan_sertifikasi']['id_invoice'] ))->result_array();
		}

		// PENGECHECKAN DOKUMEN YANG MASIH KOSONG
		$NULL_DOCS = (count($_required_but_null) > 0)?TRUE : FALSE;
		// PENGECHECKAN APAKAH A0 SUDAH DIREVIEW JUMLAH HARI DAN JUMLAH AUDITOR NYA?
		$PASSED_REVIEW = ($kelengkapan['kelengkapan_permintaan_sertifikasi']['pass_the_review'] > 0)?TRUE : FALSE;
		// JIKA A0/SERTIFIKASI BARU SUDAH DITAMBAHKAN, NILAI NYA AKAN JADI TRUE
		$IS_A0 = is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['id_a0'])? FALSE : TRUE; 
		// JIKA SUDAH BAYAR, NILAINYA AKAN JADI TRUE
		$PAY = is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['id_invoice']) || $kelengkapan['kelengkapan_permintaan_sertifikasi']['status_paid'] == 0? FALSE : TRUE;
		$PAY_STATUS = $kelengkapan['kelengkapan_permintaan_sertifikasi']['status_paid'];

		$DOCS_PAYMENT = is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['id_invoice']) || count($detail_invoice) < 1? FALSE : TRUE;
		
		$CONFIRM_ASSINGMENT_DATE = is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['assessment_date']) ? FALSE : TRUE;
		
		$VISIT_TIME = ( is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['assessment_date']) 
			|| ( !is_null($kelengkapan['kelengkapan_permintaan_sertifikasi']['assessment_date']) && strtotime(date('Y-m-d H:i:s')) < strtotime($kelengkapan['kelengkapan_permintaan_sertifikasi']['assessment_date'])  ) )? FALSE : TRUE ;
		
		$ASSIGNED_AUDITOR = true;
		$CONFIRM = true;
		$STATUS_CONFIRMATION = 'remidial';


		if($NULL_DOCS)
		{
			$data['status'] = 'Silahkan lengkapi dokumen pengajuan';
			$data['_state'] = 'user';
			$data['_code'] 	= '0500';
		}elseif(!$NULL_DOCS && !$IS_A0)
		{
			$data['status'] = 'Dokumen sedang dalam proses pemeriksaan';
			$data['_state'] = 'system';
			$data['_code'] 	= '0501';
		}elseif (!$PASSED_REVIEW) {
			$data['status'] = 'Permintaan anda sedang direview';
			$data['_state'] = 'user';
			$data['_code'] 	= '0501';
		}elseif (!$NULL_DOCS && $IS_A0 && !$CONFIRM_ASSINGMENT_DATE) {
			$data['status'] = 'Silahkan konfirmasikan tanggal kunjungan';
			$data['_state'] = 'user';
			$data['_code'] 	= '0502';
		}elseif ($PASSED_REVIEW && !$PAY && !$DOCS_PAYMENT) {
			$data['status'] = 'Silahkan konfirmasikan bukti pembayaran';
			$data['_state'] = 'user';
			$data['_code'] 	= '0503';
		}elseif (!$PAY && $DOCS_PAYMENT) {
			$data['status'] = 'Nota pembayaran sedang diperiksa';
			$data['_state'] = 'system';
			$data['_code'] 	= '0504';
		}elseif ($PAY && $PAY_STATUS < 0 && $DOCS_PAYMENT) {
			$data['status'] = 'Silahkan ulangi upload nota pembayaran';
			$data['_state'] = 'user';
			$data['_code'] 	= '0504';
		}elseif ($PAY && !$ASSIGNED_AUDITOR) {
			$data['status'] = 'Pembayaran telah dikonfirmasi. Sedang dalam proses penambahan auditor';
			$data['_state'] = 'user';
			$data['_code'] 	= '0505';
		}elseif(!$VISIT_TIME)
		{
			$data['status'] = 'Menunggu waktu kunjungan assessment';
			$data['_state'] = 'system';
			$data['_code'] 	= '0506';

		}elseif($VISIT_TIME && !$CONFIRM)
		{
			$data['status'] = 'Sedang dalam proses assessment';
			$data['_state'] = 'system';
			$data['_code'] 	= '0507';
		}elseif ($VISIT_TIME && $CONFIRM) {
			switch ($STATUS_CONFIRMATION) {
				case 'done':
					# code...
					$data['status'] = 'Sertifikasi selesai';
					break;
				case 'remidial':
					# code...
					$data['status'] = 'Status Sertifikasi masih remidial';
					break;
				case 'fail':
					$data['status'] = 'Status sertifikasi gagal';
					break;
				default:
					$data['status'] = 'Proses sertifikasi masih berlangsung';
					break;
			}
			$data['_state'] = 'system';
			$data['_code'] 	= '0508';
		}

		return $data;
	}
	public function get_status_pengajuan($id_company, $id_permintaan_sertifikasi)
	{
		
		$data = $this->status_pengajuan($id_company, $id_permintaan_sertifikasi);
		echo json_encode($data);
	}

	public function get_kelengkapan_dokumen()
	{
		$data = $this->input->post();
		$kelengkapan = $this->certification_model->get_kelengkapan_sertifikasi_perusahaan($data['id_company'], $data['id_permintaan_sertifikasi']);
		echo json_encode($kelengkapan);
	}

	public function get_catatan_a0()
	{
		$this->load->model('assessment_model');
		$post = $this->input->post();
		$a0 = $this->assessment_model->data_a0('*', array('id_a0' => $post['id_a0']), 0);

		$notes = array();
		if(!is_null($a0['id_a0']) && !is_null($a0['a0_notes']))
		{
			$notes = explode(',', $a0['a0_notes']);
			$notes = implode(' OR notes_log_id = ', $notes);
			$notes = $this->db->query('SELECT * FROM notes_log where notes_log_id = '.$notes." order by notes_addtime DESC")->result_array();
		}
		echo json_encode($notes);
	}


	/*
	| ----------------
	|  I N S E R T
	| ----------------
	*/
	/*
	* Function insert new existing certificate 
	*/
	function insert_existing_certificate()
	{
		$post = $this->input->post();
		$this->load->model('auditor_model');
		// print_r($post); return false;
		// TAMBAHKAN KE A0
		$a0 = $this->certification_model->save_a0($post['id_company']);
		$this->certification_model->update_a0(array('token' => '', 'pass_the_review' => 1, 'assessment_date' => $post['sertifikasi']['detail']['audit_time_start'] ), array('id_a0' => $a0) );

		// TAMBAHKAN KE A0_CAT
		foreach ($post['sertifikasi']['request'] as $key => $value) {
			# code...
			if($value['is_self_announcement'] == 'false')
			{
				// SIMPAN SERTIFICATE
				$a0_cat = $this->certification_model->save_certification($value, $post['id_company']);
				
				// BUAT CERTIFICATE
				$newCert 	= $this->certification_model->draft_data_certificate( array('type' => $value['type']) );
				
				$this->certification_model->insert_new_certificate(array(
						'id_certificate' => $newCert['next_certificate'],
						'id_a0_cat' => $a0_cat,
					));

				// update a0 cat
				$datediff = strtotime(strtotime($post['sertifikasi']['detail']['audit_time_finish'] - $post['sertifikasi']['detail']['audit_time_start']) );

				$audit_length = floor($datediff / (60 * 60 * 24));
				
				$this->certification_model->update_a0_cat(
					array(
						'status' 				=> 'success',
						'id_certificate'		=> $newCert['next_certificate'],
						'risk' 					=> $post['sertifikasi']['detail']['risk'], 
						'a0_cat_audit_length' 	=> $audit_length 
						), 
					array(
						'id_a0_cat' => $a0_cat
						) 
					);

			}
		}

		// TAMBAHKAN LOG AUDITOR
		foreach ($post['sertifikasi']['detail']['auditor_assigned'] as $key => $value) {
			$splitAuditor = explode('.', $value);

			$auditor[] = array(
				'id_auditor' 		=> $splitAuditor[0],
				'auditor_as' 		=> $splitAuditor[1],
				'assessment_type' 	=> 'assessment',
				'audit_start' 		=> $post['sertifikasi']['detail']['audit_time_start'],
				'audit_end' 		=> $post['sertifikasi']['detail']['audit_time_finish'],
				'schedule_confirm' 	=> 1,
				'is_leader' 		=> ($post['sertifikasi']['detail']['as_leader'] == $splitAuditor[0])? 1 : 0
			);
		}

		$this->auditor_model->insert_auditor_for_existing_certificate($auditor);
		echo json_encode(array('id_company' =>$post['id_company'],  'id_a0' => $a0));
	}
	/*
	* function insert new certification
	*/
	public function insert_new_certification_list()
	{
		$data = $this->input->post();

		$this->certification_model->addNewCertification($data);
	}

	/*
	* insert new scope
	*/
	public function insert_new_scope()
	{
		$data = $this->input->post();
		$this->certification_model->addNewScope($data);

	}

	/*
	* insert product line item
	*/
	public function insert_product_line_item()
	{
		$data = $this->input->post();
		$this->certification_model->addNewProductLine($data);
	}

	/*
	* insert product line subcategory
	*/
	public function insert_product_line_subcategory()
	{
		$data = $this->input->post();
		$d0 = $this->certification_model->addNewProductLineSubcategory($data);
		// jika d0 success
		echo json_encode($d0);
	}

	/*
	* insert product line category
	*/
	public function insert_product_line_category()
	{
		$data = $this->input->post();
		$d0 = $this->certification_model->addNewProductLineCategory($data);
		echo json_encode($d0);
	}

	public function create_certificate()
	{
		$certificate = $this->certification_model->create_certificate($_POST);
		echo json_encode($certificate);
		// echo json_encode($_POST);
	}

	public function insert_master_requirement_data_kelengkapan_dokumen()
	{
		$post = $this->input->post();
		$this->certification_model->insert_master_requirement_data_kelengkapan_dokumen(array(
				'nama_dokumen' => $post['nama_dokumen'],
				'deskripsi_dokumen' => $post['deskripsi_dokumen'],
				'peruntukan' => $post['diperuntukan'],
				'is_important' => $post['is_important']
			));
		print_r($post);
	}

	public function insert_kelengkapan_dokumen()
	{
		$this->load->model('files_model');
		$post = $this->input->post();

		$config['upload_path'] 		= APPPATH.'clients/Companies/'.$post['id_company'].'/files/';
		$config['encrypt_name']		= TRUE;
		$config['allowed_types'] 	= '*';

		$files = $this->files_model->upload($config, $_FILES)[0];

		$detail = $this->certification_model->data_detail_kelengkapan_permintaan('*', array(
			'id_permintaan_sertifikasi' => $post['id_permintaan_sertifikasi'],
			'id_master_kelengkapan_permintaan' => $post['id_master_kelengkapan_permintaan'],
			)
		)->result_array();

		if(count($detail) > 0)
		{
			// UPDATE
			$this->certification_model->update_detail_kelengkapan_dokumen(
				array('id_files' => $files['id_files']), 
				array(
					'id_permintaan_sertifikasi' => $post['id_permintaan_sertifikasi'],
					'id_master_kelengkapan_permintaan' => $post['id_master_kelengkapan_permintaan'],
					'id_detail_permintaan_sertifikasi' => $detail[0]['id_detail_permintaan_sertifikasi']
				) );
		}else
		{
			// INSERT
			$this->certification_model->insert_detail_requirement_data_kelengkapan_dokumen(array(
					'id_permintaan_sertifikasi' => $post['id_permintaan_sertifikasi'],
					'id_master_kelengkapan_permintaan' => $post['id_master_kelengkapan_permintaan'],
					'id_files' => $files['id_files']
				));
		}

	}

	public function insert_dokumen_pengajuan_sertifikasi()
	{
		$this->load->model('files_model');

		$post = $this->input->post();
		$master = explode(',', $post['master']);

		// insert into table kelengkapan blablabla *fiuh
		$id_pengajuan = $this->certification_model->insert_pengajuan_kelengkapan_dokumen(array(
				'id_company' => $post['id_company']
			))->insert_id();

		$config['upload_path'] 		= APPPATH.'clients/Companies/'.$post['id_company'].'/files/';
		$config['encrypt_name']		= TRUE;
		$config['allowed_types'] 	= '*';

		$files = $this->files_model->upload($config, $_FILES);

		$id_files = array_column($files, 'id_files');
		
		foreach ($master as $key => $value) {	
			$data[] = array(
					'id_permintaan_sertifikasi' => $id_pengajuan,
					'id_master_kelengkapan_permintaan' => $value,
					'id_files' => $id_files[$key]
				);
		}

		$this->certification_model->insert_detail_pengajuan_kelengkapan_dokumen_bulk($data);

		echo json_encode(array(
				'id_permintaan_sertifikasi' => $id_pengajuan
			));

	}



	/*
	| ----------------
	|  U P D A T E 
	| ----------------
	*/
	/*update progress to success*/
	public function update_progress_certification($id_a0_cat, $type ,$status='success')
	{
		$this->certification_model->create_certificate( array('new_status' => $status, 'id_a0_cat' => $id_a0_cat, 'type' => $type ) );
	}

	/*////////////////////// RESURVEY ////////////////////////////////*/

	/*
	* update resurvey
	* require
	* 	- id_rs
	*	- id_issued
	* 	- status (new status for rs)
	*
	* status function : used
	*/
	public function update_resurvey()
	{
		$this->certification_model->resurvey( $_POST );
		
	}

	/*
	|
	|
	|
	*/
	public function update_audit_reference()
	{
		$_POST['revoke_audit_reference'] = isset($_POST['revoke_audit_reference'])? 1 : 0;
		$data = [];
		$audit_reference = $this->input->post('audit_reference');
		unset($_POST['audit_reference']);
		foreach ($_POST as $key => $value) {
			$data[$key] = $this->input->post($key);
		}
		$this->certification_model->update_audit_reference($data, array('audit_reference' => $audit_reference ));
	}


	/*
	|------------------------
	| Update Product Line Item
	|------------------------
	*/
	public function update_product_line_item()
	{
		$this->load->model('product_line_model');
		$data = $this->input->post();
		$subcategory = $this->product_line_model->data_product_line_subcategory('product_subcategory_id', array('product_line_number' => $data['product_line_parent']), 0);
		
		$update = array();
		$update['product_line_name'] = $data['product_line_name'];
		$update['SNI'] = $data['certification_category_list'];
		$update['product_line_note'] = isset($data['product_line_note'])? $data['product_line_note'] : 0;

		$where = array('product_subcategory' => $subcategory['product_subcategory_id'], 'product_line_id' => $data['product_line_item']);
		$this->product_line_model->update_product_line_item($update, $where);
	}

	/*
	|--------------------------
	| Update status certificate
	|-------------------------
	*/
	public function update_certificate_status()
	{
		$data = $this->input->post();
		$update = array();
		$update['certificate_status'] = $data['status'];

		$where = array( 'certificate_md5' => $data['certificate_md5'] );
		$this->certification_model->update_certificate($update, $where);
	}

	public function add_old_certificate()
	{
		$data = $this->input->post();
		if($data['has_old'] == 0)
		{
			$this->certification_model->insert_old_reference($data);
		}else
		{
			$this->certification_model->update_old_reference(array('old_reference' => $data['old_certificate']), array('id_certificate' => $data['id_certificate']));
		}

	}
	
	public function konfirmasi_bukti_pembayaran()
	{
		$post = $this->input->post();
		$this->load->model('invoice_model');

		$post['update']['invoice_confirmed_by'] = $_SESSION['id_users'].'.'.$_SESSION['level'];
		$this->invoice_model->update_invoice($post['update'], $post['where']);


	}

	/*
	|----------------------------
	| UPLOAD NOTA BUKTI PEMBAYARAN SERTIFIKASI
	|----------------------------
	*/
	public function update_bukti_pembayaran()
	{
		if(count($_FILES) > 0)
		{
			$post = $this->input->post();
			$this->load->model('files_model');
			$this->load->model('company_model');
			$this->load->model('invoice_model');
			$this->load->model('assessment_model');
			$this->load->model('notification_model');

			$a0 = $this->assessment_model->data_a0('*', array('id_a0' => $post['id_a0']),0 );
			
			$config['upload_path'] 		= APPPATH.'clients/Companies/'.$a0['id_company'].'/files/';
			$config['encrypt_name']		= TRUE;
			$config['allowed_types'] 	= '*';

			$files = $this->files_model->upload($config, $_FILES);
			$docs = array_map(function($res){
				return($res['id_files']);
			}, $files);

			$docs = implode(',', $docs);

			$this->invoice_model->insert_invoice_detail(
				array(
					'id_invoice' => $post['id_invoice'],
					'bill' => $docs
				)	
			);
			$this->invoice_model->update_invoice(
				array('status_paid' => 0), 
				array('id_invoice' => $post['id_invoice']) 
			);
		}

	}
	/*
	|---------------------
	| Update Certification_request / revoke brand 
	|---------------------
	| Requirements = id_a0_cat
	
	public function revoke_brand()
	{
		$data = $this->input->post();
		$update = array();
		$update['revoke_request'] = 1;
		$where = array( 'id_certification_request' => $data['id_certification_request'] );

		$this->certification_model->update_certification_request($update, $where);

	}*/

	public function update_status_detail_kelengkapan_dokumen()
	{
		$this->load->model('files_model');
		$this->load->model('notes_model');		
		$this->load->model('assessment_model');		

		$data = $this->input->post();
		if($data['status'] < 0)
		{

			$file = $this->files_model->data_files('*', array('file_id' => $data['id_files']) )->row_array();

			$this->certification_model->remove_detail_kelengkapan_permintaan_sertifikasi(
				array(
					'id_detail_permintaan_sertifikasi' => $data['id_detail_permintaan_sertifikasi']
				)
			);
			$this->files_model->remove_files(
					array(
						'file_id' => $data['id_files']
					)
				);
			if( is_file($file['file_path'].$file['file_name']) )
			{
				unlink($file['file_path'].$file['file_name']);
			}

			$this->assessment_model->update_a0_notes($data['id_a0'], 'Dokumen '.$data['requirement_name'].' anda ditolak', $data['notes']);

			return false;

		}
		$this->certification_model->update_detail_kelengkapan_dokumen(
			array(
					'status_kelengkapan' => $data['status']
				),
			array(
					'id_detail_permintaan_sertifikasi' => $data['id_detail_permintaan_sertifikasi']
				)
			);
	}

	public function update_a0_notes()
	{
		$data = $this->input->post();
		$this->load->model('assessment_model');		
		$this->load->model('notes_model');		
		
		$this->assessment_model->update_a0_notes($data['id_a0'], $data['subject'], $data['notes']);
	}
	/*
	| ----------------
	|  D E L E T E
	| ----------------
	*/
	public function remove_data_requirement_kelengkapan_dokumen()
	{
		$post = $this->input->post();
		$this->certification_model->remove_data_requirement_kelengkapan_dokumen(array(
				'id_master_kelengkapan_permintaan' => $post['id_master_kelengkapan_permintaan']
			));

	}


	/*
	| ----------------
	|  D A T A T A B L E
	| ----------------
	*/

	public function datatable__assessment_progress()
	{
		$data = $this->list__all_request_assessment_in_progress();
		echo json_encode($data);
	}

	/*
	| ----------------
	|  S E R V E R  -  S E N T
	| ----------------
	*/
	public function server_sent__assessment_progress()
	{
		$data = $this->list__all_request_assessment_in_progress();
		$data = array(
				'assessment' => $data,
				'sum_assessment' => count($data)
			);
		$data = json_encode($data);
		header('Content-Type: text/event-stream');
		header('Cache-Control: no-cache');
		
		echo "data: {$data}\n\n";

		flush();
	}
	

	/*
	| ----------------
	|  O T H E R S
	| ----------------
	*/
	

	public function generate_issues_existing_certificate()
	{
		$start = $_POST['tanggal_terbit'];
		$selesai = $_POST['tanggal_selesai'];
		$type = $_POST['type'];
		$rs = $this->certification_model->resurvey_generator_for_existing_certification($start, $selesai, $type);
		echo json_encode(array(
				'data' => $rs,
				'now' => date('Y-m-d')
			));
	}

	public function save_existing_certification_issue()
	{
		$this->load->model('tools');

		$post = $this->input->post();
		// insert rs_schedule
		foreach ($post['rs'] as $a => $b) {
			$issued = $this->certification_model->insert_new_issued(array(
						'issued_date' => $post['rs_issued'][$a],
						'id_certificate' => $post['id_certificate'],
					));
			foreach ($b as $c => $d) {
				# code...
				$rss = $this->certification_model->insert_rs_schedule(array(
						'survey_date' => $d['issued']
					));
				$rs = $this->certification_model->insert_rs(array(
						'id_rs_schedule' => $rss,
						'id_issued' => $issued,
						'deadline_date' => $d['scheduled'],
						'rs_status' => 'success',
						'rs_description' => $this->tools->romanic_number($c),
					));
			}
		}
	}

	

	function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
	    $file = $path.$filename;
	    $file_size = filesize($file);
	    $handle = fopen($file, "r");
	    $content = fread($handle, $file_size);
	    fclose($handle);
	    $content = chunk_split(base64_encode($content));
	    $uid = md5(uniqid(time()));
	    $header = "From: ".$from_name." <".$from_mail.">\r\n";
	    $header .= "Reply-To: ".$replyto."\r\n";
	    $header .= "MIME-Version: 1.0\r\n";
	    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
	    $header .= "This is a multi-part message in MIME format.\r\n";
	    $header .= "--".$uid."\r\n";
	    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
	    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
	    $header .= $message."\r\n\r\n";
	    $header .= "--".$uid."\r\n";
	    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
	    $header .= "Content-Transfer-Encoding: base64\r\n";
	    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
	    $header .= $content."\r\n\r\n";
	    $header .= "--".$uid."--";
	    if (mail($mailto, $subject, "", $header)) {
	        echo "mail send ... OK"; // or use booleans here
	    } else {
	        echo "mail send ... ERROR!";
	    }
	}

	public function detail_existing_certification__data_surveilen($id_a0_cat)
	{
		$data = $this->certification_model->detail_existing_certification__data_surveilen(array('id_a0_cat' => $id_a0_cat));
		echo json_encode($data);
	}
	
	
}
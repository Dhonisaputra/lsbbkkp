<?php

/**
* 
*/
class Assessment_model extends CI_Model
{
	private $can_send_email_notification_reassessment = TRUE;
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('dataakses');
		$this->load->database();

	}

	/////////////////////////////////////////////////////// G E T - S E C T I O N /////////////////////////////////////////////////////////
	/*
	|---------------------
	| Get Data a0
	|---------------------
	*/
	public function data_a0($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('a0');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}

	/*
	|---------------------
	| Get data a0_cat
	|---------------------
	*/
	public function data_a0_cat($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('a0_cat');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}

	/*
	|---------------------
	| Get data rs
	|---------------------
	*/
	public function data_rs($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('rs');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}


	/*
	|---------------------
	| Get data pre sertification
	|---------------------
	*/
	public function data_presertification($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('a0');
		$this->db->join('company', 'a0.id_company = company.id_company');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return $data;
	}
	/*
	|-------------------
	| Get data requested change the risk
	|-------------------
	| fungsi untuk menampilkan data permintaan penggantian resiko dari a0 dan rs
	*/
	public function data_requested_risk_change()
	{
		$a0 = $this->db->query('SELECT id_company, company_name, email, company_level, company_employee, id_a0, id_a0_cat, risk, suggest_risk FROM a0 JOIN a0_cat USING(id_a0) JOIN company USING(id_company) WHERE a0_cat.`risk` != a0_cat.`suggest_risk`');
		return $a0->result_array();
	}

	/*
	|---------------------
	| Get data certification_request
	|---------------------
	*/
	public function only_data_certification_request($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('certification_request');
		$this->db->join('a0_cat', 'certification_request.id_a0_cat = a0_cat.id_a0_cat');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}
	public function data_certification_request($select = '*', $where = array(), $row_array=-1, $useJoin = TRUE)
	{
		$this->db->select($select);
		$this->db->from('certification_request');
		$this->db->join('brand', 'brand.id_brand = certification_request.id_brand', 'left');
		$this->db->join('lampiran', 'lampiran.id_lampiran = certification_request.id_lampiran','left');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		$a0 = $data->result_array();
		foreach ($a0 as $key => $value) {
			$a00 = explode(',', $value['product_line']);
		
			foreach ($a00 as $a00key => $a00value) {
				# code...
				$exp = explode('.', $a00value);
				$isItem = array_shift($exp);//(strpos($a00value, '.') === FALSE)? $a00value : array_shift($exp);
				// $a0[$key]['data_product_line'][] = $isItem;
				
				$a000 = $this->data_product_line('*', array('product_line.product_line_id' => $isItem), 0 );
				$a000['item'] = implode(',', $exp);

				$a0[$key]['data_product_line'][] = $a000;
			}
		}

		return ($row_array < 0)? $a0 : $a0[$row_array];
	}

	/*
	|---------------------
	| Get data rs_schedule
	|---------------------
	*/
	public function data_rs_schedule($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('rs_schedule');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}

	/*
	|---------------------
	| Get data audit reference
	|---------------------
	*/
	public function data_audit_reference($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('certification_category');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}

	/*
	|---------------------
	| Get data master_product_line (WILL DEPRECATED)
	|---------------------
	*/
	public function data_product_line($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('product_line');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}

	/*
	|---------------------
	| Get data master_product_line (WILL DEPRECATED)
	|---------------------
	*/
	public function data_assessment_collective($select = '*', $where = array(), $scope = array('rs','issued','certificate','a0_cat', 'a0', 'company'), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('assessment_collective');
		$this->db->join('assessment_collective_participant', 'assessment_collective.id_assessment_group = assessment_collective_participant.id_assessment_group');
		$data = $this->db->get();
		$d0 = array();
		foreach ($data->result_array() as $key => $value) {
			$d0['datasource'][] = $this->assessment_model->datasource_reassessment($value['id_participant']);
		}
		$data_row = $data->row_array();
		$d0['coordinator_name'] = $data_row['coordinator_name'];
		$d0['coordinator_email'] = $data_row['coordinator_email'];
		$d0['data_collective'] = $data->result_array();
		

		return $d0;
		/*if(in_array('rs', $scope))
		{
			$this->db->join('rs', 'rs.id_rs = assessment_collective_participant.id_participant');
		}
		
		if(in_array('issued', $scope))
		{
			$this->db->join('issued', 'issued.id_issued = rs.id_issued');
		}

		if(in_array('certificate', $scope))
		{
			$this->db->join('certificate', 'certificate.id_certificate = issued.id_certificate');
		}

		if(in_array('a0_cat', $scope))
		{
			$this->db->join('a0_cat', 'a0_cat.id_certificate = certificate.id_certificate');
		}

		if(in_array('a0', $scope))
		{
			$this->db->join('a0', 'a0.id_a0 = a0_cat.id_a0');
		}

		if(in_array('company', $scope))
		{
			$this->db->join('company', 'a0.id_company = company.id_company');
		}

		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);*/
	}

	/*
	|---------------------
	| Get data master_product_line
	|---------------------
	*/
	public function data_master_product_line($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('master_product_line');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}


	/*
	* model complete schedules
	* requirement *none
	*/
	public function get_complete_schedule()
	{
		return $this->dataakses->SQL('SELECT 
			
			a0_cat.type, rs.id_rs as id, a0.id_a0, certificate.id_certificate as certificate, id_company, company.email, company.telephone, company_name, countries.country_name, company_region, rs_schedule.survey_date as execution, rs_schedule.resurvey_added_on as notification_time, rs.deadline_date as deadline, "reassessment" as type_schedule, rs.rs_status as status 
			from rs 
			left join rs_schedule using(id_rs_schedule) 
			join issued using(id_issued) 
			left join certificate using(id_certificate) 
			left join a0_cat using(id_certificate) 
			left join a0 using(id_a0)
			left join company using(id_company) 
			join countries on company.country_code = countries.id_country 
			where ( rs.rs_status IS NULL) group by id_certificate' );

	}
	/*
	|-------------------------------------
	| Function to get schedule
	|-------------------------------------
	* @params
	* @params $start string date
	* @params $finish string date 
	*	# harus lebih besar dari @params $start
	|-------------------------------------
	*/
	public function get_schedule($start, $finish)
	{
		$assessmentSQL = 'SELECT 
			CASE WHEN a0_cat.`ref` = "exist" THEN "audit-khusus" ELSE "assessment" END AS type_report, 
			EXTRACT(YEAR_MONTH FROM assessment_date) AS ext_assessment_date, 
			EXTRACT(YEAR_MONTH FROM ?) AS ext_start,
			EXTRACT(YEAR_MONTH FROM ?) AS ext_finish,
			a0_cat.a0_cat_audit_length,
			a0_cat.id_a0_cat, 
			a0_cat.type, 
			a0.id_a0 AS id_assessment, 
			NULL AS id_rs, 
			id_company, 
			a0_cat.id_certificate, 
			assessment_date, 
			a0.pass_the_review, 
			a0.id_a0, 
			company.company_name, 
			countries.country_name, 
			company.company_region, 
			"" AS description
			
			FROM a0 
			JOIN company USING(id_company) 
			JOIN countries ON company.country_code = countries.id_country 
			JOIN a0_cat USING(id_a0) 
			WHERE 
			assessment_date IS NOT NULL 
			GROUP BY id_a0
			HAVING ext_assessment_date>=ext_start and ext_assessment_date<=ext_finish and assessment_date >= ?
			';

		$reassessmentSQL = 'SELECT 
			"reassessment" as type_report,
			EXTRACT(YEAR_MONTH FROM assessment_date) AS ext_assessment_date, 
			EXTRACT(YEAR_MONTH FROM ?) AS ext_start,
			EXTRACT(YEAR_MONTH FROM ?) AS ext_finish,
			a0_cat.a0_cat_audit_length,
			a0_cat.id_a0_cat, 
			a0_cat.type, 
			rs_schedule.id_rs_schedule as id_assessment, 
			id_rs,  
			id_company, 
			a0_cat.id_certificate, 
			rs_schedule.survey_date as assessment_date, 
			a0.pass_the_review, 
			a0.id_a0, 
			company.company_name, 
			countries.country_name, 
			company.company_region, 
			rs.rs_description as description

			FROM rs
			JOIN rs_schedule on rs.id_rs_schedule = rs_schedule.id_rs_schedule
			join issued on rs.id_issued = issued.id_issued
			join certificate on certificate.id_certificate = issued.id_certificate
			join a0_cat on a0_cat.id_certificate = certificate.id_certificate
			join a0 on a0.id_a0 = a0_cat.id_a0
			join company using(id_company) 
			join countries on company.country_code = countries.id_country 
			where 
			assessment_date IS NOT NULL 

			group by rs_schedule.id_rs_schedule
			HAVING ext_assessment_date>=ext_start and ext_assessment_date<=ext_finish
			ORDER BY assessment_date ASC';

			$result = $this->db->query($assessmentSQL.' UNION '.$reassessmentSQL,  array($start, $finish,  $start, $start, $finish) );
			$result = $result->result_array();
			return $result;
	}

	/*
	* model complete schedules
	* requirement *none
	*/
	public function company_assessment_available($select = '*', $where = array())
	{

		$data = $this->db->query('SELECT 
		a0_cat.type, rs.id_rs as id, a0.id_a0, certificate.id_certificate as certificate, certification_category.name as assessment_name, 
		id_company, company.email, company.telephone, company_name, countries.country_name, company_region, rs.deadline_date as deadline, 
		"reassessment" as type_schedule, rs.rs_status as status 
		FROM rs 
		JOIN issued USING(id_issued) 
		JOIN certificate USING(id_certificate) 
		JOIN a0_cat USING(id_certificate) 
		JOIN certification_request ON a0_cat.id_a0_cat = certification_request.id_a0_cat
		JOIN certification_category ON certification_request.audit_reference = certification_category.audit_reference
		JOIN a0 USING(id_a0)
		JOIN company USING(id_company) 
		JOIN countries ON company.country_code = countries.id_country 
		WHERE '.$where.' GROUP BY id_issued order by rs.deadline_date ASC');

		return $data->result_array();
	}

	/*masih diperuntukan seperti atas ini*/
	public function detail_reassessment($id_company)
	{
		$query = 'SELECT *, MIN(id_rs)
			FROM rs 
			JOIN issued USING(id_issued) 
			JOIN certificate USING(id_certificate) 
			JOIN a0_cat USING(id_certificate) 
			JOIN certification_request ON a0_cat.id_a0_cat = certification_request.id_a0_cat
			JOIN certification_category ON certification_request.audit_reference = certification_category.audit_reference
			JOIN a0 USING(id_a0)
			JOIN company USING(id_company) 
			JOIN countries ON company.country_code = countries.id_country 
			WHERE 
			rs_status IS NULL
			AND company.id_company =  ';
	}

	/*
	| function get data waiting assessment
	| 
	| requirement: none
	|
	| status function : used
	*/
	public function get_assessment_unconfirmed_schedules()
	{
		

		return $this->dataakses->SQL('SELECT 
			a0.id_a0 as id, a0.id_a0, a0_cat.type, a0_cat.id_a0_cat as _, company_region, country_name, id_company, company_name, company.telephone,  a0.assessment_date as execution, a0.a0_added_on as last_notice , "new assessment" as type_schedule, a0_cat.status as status 
			FROM `a0` 
			join a0_cat using(id_a0) 
			join company using(id_company) 
			join countries on countries.id_country = company.country_code
			where a0_cat.status = "process" and a0.assessment_date IS NULL and a0.pass_the_review = 1 group by id_company
			UNION 
			select rs.id_rs as id, a0.id_a0, a0_cat.type, rs.id_rs_schedule as _, company_region, country_name,  id_company, company_name, company.telephone, rs_schedule.survey_date as execution, rs_schedule.resurvey_added_on as last_notice, "re assessment" as type_schedule, rs.rs_status as status 
			from rs 
			left join rs_schedule using(id_rs_schedule) 
			join issued using(id_issued) 
			left join certificate using(id_certificate) 
			left join a0_cat using(id_certificate) 
			left join a0 using(id_a0)
			left join company using(id_company) 
			left join countries on countries.id_country = company.country_code
			where rs.rs_status = "process"  and rs_schedule.survey_date IS NULL group by id_company
			');
	}

	# same as above but using CI and exclusived for new assessment
	public function CI_get_schedules_new_assessment($select = '*', $where = array() )
	{
		$this->load->model('auditor_model');

		$this->db->select($select,false);
		$this->db->from('a0');
		$this->db->join('a0_cat', 'a0.id_a0 = a0_cat.id_a0');
		$this->db->join('company', 'a0.id_company = company.id_company');
		if(count($where) > 0 )
		{
			$this->db->where($where);
		}
		$this->db->group_by('a0.id_a0');
		$data = $this->db->get();
		$data = $data->result_array();
		foreach ($data as $key => $value) {
			$data[$key]['data_certification_category'] = $this->get_certification_request('*', array('id_a0_cat' => $value['id_a0_cat']) );

			$a0 = $this->auditor_model->get_auditor_log( array('id_assessment' => $value['id_a0'], 'assessment_type' => 'assessment' ) );
			$data[$key]['data_auditor'] = $a0->result_array();
			
		}
		return $data;
	}

	public function CI_get_schedules_reassessment($select = '*', $where = array() )
	{
		$this->db->select($select,false);
		$this->db->from('rs');
		$this->db->join('issued', 'issued.id_issued = rs.id_issued ');
		$this->db->join('certificate', 'certificate.id_certificate = issued.id_certificate');
		$this->db->join('a0_cat', 'certificate.id_a0_cat = a0_cat.id_a0_cat');
		$this->db->join('a0', 'a0.id_a0 = a0_cat.id_a0');

		$this->db->join('rs_schedule', 'rs.id_rs_schedule = rs_schedule.id_rs_schedule ', 'left');

		// $this->db->join('certification_request', 'certification_request.id_a0_cat = a0_cat.id_a0_cat');
		if(count($where) > 0 )
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		$data = $data->result_array();
		
		foreach ($data as $key => $value) {
			$data[$key]['certification_request'] = $this->get_certification_request('*', array('id_a0_cat' => $value['id_a0_cat']) );

			$a0 = $this->auditor_model->get_auditor_log( array('id_assessment' => $value['id_rs'], 'assessment_type' => 'reassessment' ) );
			$data[$key]['data_auditor'] = $a0->result_array();
		}
		return $data;
	}

	/*
	| ---------------------------------------
	| Function get certification request
	| ---------------------------------------
	*/
	public function get_certification_request($select = '*', $where = array() )
	{
		$this->load->model('certification_model');

		$this->db->select('*');
		$this->db->from('certification_request');
		$this->db->join('brand','brand.id_brand = certification_request.id_brand','left');
		if( count($where) > 0 )
		{
			$this->db->where($where);
		}
		$data = $this->db->get();

		$data = $data->result_array();

		foreach ($data as $key => $value) {
			$a0 = $this->extract_audit_reference($value['audit_reference']);
			$a1 = $this->extract_nace_reference($value['nace']);
			$a2 = $this->extract_scope_reference($value['id_commodity']);

			foreach ($a0 as $a0key => $a0value) {
				$data[$key]['data_audit_reference'] = $this->certification_model->get_certification_category(array('audit_reference' => $a0value));
			}

			foreach ($a1 as $a1key => $a1value) {
				$data[$key]['data_nace'] = $this->certification_model->get_nace_certificate(array('nace_item' => $a1value));
			}

			foreach ($a2 as $a2key => $a2value) {
				$data[$key]['data_scope'] = $this->certification_model->get_scope_certificate(array('id_commodity' => $a2value));
			}

		}

		return $data;
	}

	/*
	| -------------------------------
	| Function explode audit reference
	| -------------------------------
	*/
	public function extract_audit_reference($text_audit_reference)
	{
		$data = explode(',', $text_audit_reference);
		return $data;
	}

	/*
	| -------------------------------
	| Function explode scope
	| -------------------------------
	*/
	public function extract_scope_reference($text_scope)
	{
		$data = explode(',', $text_scope);
		return $data;
	}

	/*
	| -------------------------------
	| Function explode product line
	| -------------------------------
	*/
	public function extract_product_line_reference($text_product_line)
	{
		$data = explode(',', $text_product_line);
		return $data;
	}

	/*
	| -------------------------------
	| Function explode product line item
	| -------------------------------
	*/
	public function extract_product_line_item($text_product_line_item)
	{
		$data = explode('.', $text_product_line_item);
		$item = explode('|', @$data[1]);
		return array(
				'text'=> implode(',', $item),
				'item'=> $item,
				'product_line' => @$data[0]
			);
	}

	/*
	| -------------------------------
	| Function explode nace
	| -------------------------------
	*/
	public function extract_nace_reference($text_nace)
	{
		$data = explode(',', $text_nace);
		return $data;
	}

	/*
	| -------------------------------
	| Function explode brand
	| -------------------------------
	*/
	public function extract_brand($text_brand)
	{
		$data = explode(',', $text_brand);
		return $data;
	}

	/*
	|---------------------------
	| Detail reassessment
	|---------------------------
	*/
	public function get_detail_reassessment($id_rs)
	{
		$this->load->model('certification_model');
		$this->load->model('commodity_model');
		$this->load->model('nace_model');
		$this->load->model('company_model');

		$data = array();
		$data['rs'] = $this->data_rs('*', array('id_rs'=>$id_rs), 0 );
		$data['issued'] = $this->certification_model->data_issued('*', array('id_issued' => $data['rs']['id_issued'] ), 0);
		$data['certificate'] = $this->certification_model->data_certificate('*', array('id_certificate' => $data['issued']['id_certificate'] ), 0);
		$data['a0_cat'] = $this->data_a0_cat('*', array('id_a0_cat' => $data['certificate']['id_a0_cat']),0 );
		$data['a0'] = $this->data_a0('*', array('id_a0' => $data['a0_cat']['id_a0']),0 );
		$data['company'] = $this->company_model->data_company('*', array('id_company' => $data['a0']['id_company']),0 );
		
		/*get data certification type*/
		$data['certification_type'] = $this->certification_model->data_certification_type('*', array('type' => $data['a0_cat']['type']), 0);
		
		$data['certification_request'] = $this->only_data_certification_request('*, GROUP_CONCAT(id_brand) as brand_requested', array('a0_cat.id_a0_cat'=>$data['a0_cat']['id_a0_cat']));
		
		foreach ($data['certification_request'] as $key => $value) {
			if(!empty($value['brand_requested'])){ 
				$br = $this->extract_brand($value['brand_requested']);
				
				foreach ($br as $brkey => $brvalue) {
					$a0br = $this->company_model->data_brand('*', array('id_brand' => $brvalue), 0 );				
					$data['data_brand'][] = $a0br;
				}
			}
			
			if(!empty($value['product_line']))
			{
				$pl = $this->extract_product_line_reference($value['product_line']);
				foreach ($pl as $plk => $plv) {
					$p0 = $this->extract_product_line_item($plv);
					$p0['product_line_data'] = $this->data_product_line('*', array('product_line_id = ' => $p0['product_line'] ),0 );
					$data['product_line'][] = $p0;
				}
			}
			if(!empty($value['scope']))
			{
				$a0Scope = $this->extract_scope_reference($value['scope']);
				foreach ($a0Scope as $scValue) {
					# code...
					$data['scope'][] = $this->commodity_model->data_scope('*', array('id_commodity' => $scValue), 0);
				}
				// print_r($a0Scope);
			}

			if(!empty($value['nace']))
			{
				$a0Nace = $this->extract_nace_reference($value['nace']);
				foreach ($a0Nace as $ncValue) {
					# code...
					$data['nace'][] = $this->nace_model->data_nace('*', array('nace_item' => $ncValue), 0);
				}
				// print_r($a0Scope);
			}
			if(!empty($value['audit_reference']))
			{
				$au = $this->extract_audit_reference($value['audit_reference']);
				foreach ($au as $aukey => $auvalue) {
					# code...
					$data['certification'][] = $this->data_audit_reference('*', array('audit_reference' => $auvalue ), 0);
				}
			}


		}
		if(isset($data['scope']) === TRUE)
		{
			$scope = array_map(function($r){
				return $r['commodity_name'];
			}, $data['scope']);
			$data['text_scope'] = implode(', ', $scope);
		}

		if(isset($data['data_brand']) === TRUE)
		{
			$brand = array_map(function($r){
				return $r['brand_name'];
			}, $data['data_brand']);
			$data['text_brand'] = implode(', ', $brand);
		}

		if(isset($data['nace']) === TRUE)
		{
			$nace = array_map(function($r){
				return $r['nace_name'].' ('.$r['nace_item'].') ';
			}, $data['nace']);
			$data['text_nace'] = implode(', ', $nace);
		}

		if(isset($data['certification']) === TRUE)
		{
			$audit_reference = array_map(function($r){
				return $r['certificate_title'].' ( '.$r['name'].' ) ';
			}, $data['certification']);
			$audit_reference_sertificate = array_map(function($r){
				return $r['name'];
			}, $data['certification']);
			$data['audit_reference']['certificate'] = $audit_reference_sertificate;
			$data['text_audit_reference'] = implode(', ', $audit_reference);
		}

		if(isset($data['product_line']) === TRUE)
		{
			$pl = array_map(function($r){
				return $r['product_line_data']['product_line_name'];
			}, $data['product_line']);

			$pl2 = array_map(function($r){
				return $r['text'];
			}, $data['product_line']);
			
			$pl2 = implode(', ', $pl2);
			$pl2 = (!empty($pl2))? '( '.$pl2.' )' : '';
			$data['text_product_line'] = implode(', ', $pl).$pl2;
		}

		// define data type assessment
		if($data['a0_cat']['ref'] == 'exist')
		{
			$data['text_type_request'] = 'Audit Khusus';
		}elseif( $data['a0_cat']['ref'] == 'new' && empty($data['a0_cat']['id_certificate']) )
		{
			$data['text_type_request'] = 'New Assessment';
		}else
		{
			$data['text_type_request'] = 'Re Assessment';

		}
		
		return $data;
	}



	/*
	|---------------------------
	| Detail assessment
	|---------------------------
	*/
	
	/*
	| status icebox
	*/
	public function get_detail_assessment($id_a0_cat)
	{
		$this->load->model('certification_model');
		$this->load->model('commodity_model');
		$this->load->model('nace_model');
		$this->load->model('company_model');
		$data = array();

		/*get data a0_cat*/
		$data['a0_cat'] = $this->data_a0_cat('*', array('id_a0_cat' => $id_a0_cat),0 );
		
		/*get data a0*/
		$data['a0'] = $this->data_a0('*', array('id_a0'=>$data['a0_cat']['id_a0']), 0 );
		
		/*get data certification request*/
		// $data['certification_request'] = $this->only_data_certification_request('*, GROUP_CONCAT(id_brand) as brand_requested', "a0_cat.id_a0_cat = ". $data['a0_cat']['id_a0_cat'] );
		$data['certification_request'] = $this->only_data_certification_request('*, GROUP_CONCAT(product_line) AS product_line_requested, GROUP_CONCAT(id_brand) AS brand_requested, GROUP_CONCAT(scope) AS scope_requested, GROUP_CONCAT(nace) AS nace_requested', "a0_cat.id_a0_cat = ".$data['a0_cat']['id_a0_cat']." OR a0_cat.`id_certificate` = '".$data['a0_cat']['id_certificate']."'" );
		
		/*get data certification type*/
		$data['certification_type'] = $this->certification_model->data_certification_type('*', array('type' => $data['a0_cat']['type']), 0);
		
		/*get data audit_khusus*/
		if(!is_null($data['a0_cat']['id_certificate']))
		{
			$data['audit_khusus'] = $this->certification_model->data_audit_khusus('*', array('id_certificate' => $data['a0_cat']['id_certificate']) );
			if(count($data['audit_khusus']) > 0)
			{
				$data['audit_khusus_terakhir'] = $data['audit_khusus'][count($data['audit_khusus'])-1];
			}
		}
		
		/*get data perusahaan*/
		$data['company'] = $this->company_model->data_company('*', array('id_company' => $data['a0']['id_company']),0 );
		
		foreach ($data['certification_request'] as $key => $value) {
			if(!empty($value['brand_requested'])){ 
				$br = $this->extract_brand($value['brand_requested']);
				$brand = array();
				foreach ($br as $brkey => $brvalue) {
					$a0br = $this->company_model->data_brand('*', array('id_brand' => $brvalue), 0 );				
					if(!empty($a0br)){ 
						$data['data_brand'][] = $a0br; 
						$brand[] = $a0br['brand_name'];
					}
					
				}
				if(count($brand) > 0)
				{
					$data['certification_request'][$key]['text_brand'] = implode(', ', $brand);
				}
			}
			// lampiran
			if(!empty($value['id_lampiran'])){ 
				$data['certification_request'][$key]['text_lampiran'] = $this->dataakses->SQL('SELECT * FROM lampiran where id_lampiran = ?', 'i', $value['id_lampiran'])[0]['content_lampiran'];
			}
			
			if(!empty($value['product_line_requested']))
			{
				$pl = $this->extract_product_line_reference($value['product_line_requested']);
				$pl = array_unique($pl);

				foreach ($pl as $plk => $plv) {
					$p0 = $this->extract_product_line_item($plv);

					$p0['product_line_data'] = $this->data_product_line('*', array('product_line_id = ' => $p0['product_line'] ), 0 );
					if(!empty($p0['product_line_data']))
					{
						$data['product_line'][] = $p0;
					}
				}
			}


			/*
			|----------------
			|get data scope
			|----------------
			*/
			if(!empty($value['scope_requested']))
			{
				$a0Scope = $this->extract_scope_reference($value['scope_requested']);
				foreach ($a0Scope as $scValue) {
					# code...
					$scope = $this->commodity_model->data_scope('*', array('id_commodity' => $scValue), 0);
					if(!empty($scope))
					{
						$data['scope'][] = $scope;
					}
				}
				// print_r($a0Scope);
			}

			if(!empty($value['nace_requested']))
			{
				$a0Nace = $this->extract_nace_reference($value['nace_requested']);
				foreach ($a0Nace as $ncValue) {
					# code...
					$nace = $this->nace_model->data_nace('*', array('nace_item' => $ncValue), 0);
					if(!empty($nace))
					{
						$data['nace'][] = $nace;
					}
				}
				// print_r($a0Scope);
			}

			if(!empty($value['audit_reference']))
			{
				$au = $this->extract_audit_reference($value['audit_reference']);
				foreach ($au as $aukey => $auvalue) {
					# code...
					$data['certification'][] = $this->data_audit_reference('*', array('audit_reference' => $auvalue ), 0);
				}
			}
		}

		if(!empty($data['a0_cat']['id_certificate']))
		{
			$data['certificate'] = $this->certification_model->data_certificate('*', array('id_certificate' => $data['a0_cat']['id_certificate'] ), 0);
			$data['issued'] = $this->certification_model->data_issued('*', array('id_certificate' => $data['a0_cat']['id_certificate'] ));
			$data['issued_terakhir'] = $data['issued'][count($data['issued']) -1];
		}
			
		if(isset($data['scope']) === TRUE)
		{
			$scope = array_map(function($r){
				return $r['commodity_name'];
			}, $data['scope']);
			$data['text_scope'] = implode(', ', $scope);
		}

		if(isset($data['data_brand']) === TRUE)
		{
			$brand = array_map(function($r){
				return $r['brand_name'];
			}, $data['data_brand']);
			$data['text_brand'] = implode(', ', $brand);
		}

		if(isset($data['nace']) === TRUE)
		{
			$nace = array_map(function($r){
				return $r['nace_name'].' ('.$r['nace_item'].') ';
			}, $data['nace']);
			$data['text_nace'] = implode(', ', $nace);
		}

		if(isset($data['certification']) === TRUE)
		{
			$audit_reference = array_map(function($r){
				return $r['certificate_title'].' ( '.$r['name'].' ) ';
			}, $data['certification']);

			$audit_reference_sertificate = array_map(function($r){
				return $r['name'];
			}, $data['certification']);

			$data['audit_reference']['certificate'] = $audit_reference_sertificate;
			$data['text_audit_reference'] = implode(', ', $audit_reference);
		}

		if(isset($data['product_line']) === TRUE)
		{
			$pl = array_map(function($r){
				return $r['product_line_data']['product_line_name'];
			}, $data['product_line']);
			$pl = array_unique($pl);
			$pl2 = array();
			foreach ($data['product_line'] as $key => $value) {
				# code...
				if($value['text'] !== '')
				{
					foreach ($value['item'] as $key => $val) {
						array_push($pl2, $val);
					}
				}
			}

			$pl2 = array_unique($pl2);

			$data['spesifikasi_produk'] = count($pl2) > 0? $pl2 : array();
			
			$pl2 = implode(', ', $pl2);
			$pl2 = (!empty($pl2))? ' ( '.$pl2.' )' : '';
			$data['text_product_line'] = implode(', ', $pl).$pl2;
		}

		// define data type assessment
		if($data['a0_cat']['ref'] == 'exist')
		{
			$data['text_type_request'] = 'Audit Khusus';
		}elseif( $data['a0_cat']['ref'] == 'new' && empty($data['a0_cat']['id_certificate']) )
		{
			$data['text_type_request'] = 'New Assessment';
		}else
		{
			$data['text_type_request'] = 'Re Assessment';

		}
		
		return $data;
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
	public function datasource_assessment($id_a0)
	{
		$this->load->model('certification_model');
		$this->load->model('commodity_model');
		$this->load->model('company_model');
		$this->load->model('nace_model');

		if( !is_null($id_a0) )
		{
			$where = array('id_a0' => $id_a0);
		}else
		{
			$where = array();
		}

		$data['a0'] = $this->data_a0('*', array('id_a0' => $id_a0), 0);
		$data['company'] = $this->company_model->data_company('id_company, company_name, company_address, company_post, company_province, company_reference_number, company_region, company_employee, telephone, email, company_fax, country_name,  country_code, capital, region, subregion, callingCodes', array('id_company' => $data['a0']['id_company']), 0);
		$data['a0_cat'] = $this->data_a0_cat('*', $where );
		$data_proc = $this->_processing_datasource($data);
		$data = array_merge($data, $data_proc);

		return $data;

	}

	public function datasource_reassessment($id_rs)
	{
		$this->load->model('certification_model');
		$this->load->model('commodity_model');
		$this->load->model('company_model');
		$this->load->model('nace_model');

		$data['rs'] = $this->data_rs('*', array('id_rs'=> $id_rs),0);
		$data['rs_schedule'] = $this->data_rs_schedule('*', array('id_rs_schedule' => $data['rs']['id_rs_schedule']), 0);
		$data['issued'] = $this->certification_model->data_issued('*', array('id_issued'=>$data['rs']['id_issued']) );
		$data['latest_issued'] = $data['issued'][count($data['issued'])-1];
		$data['certificate'] = $this->certification_model->data_certificate('*', array('id_certificate' => $data['latest_issued']['id_certificate']), 0);

		$data['a0_cat'] = $this->data_a0_cat('*', array('id_a0_cat' => $data['certificate']['id_a0_cat']) );
		$data['a0'] = $this->data_a0('*', array('id_a0' => $data['a0_cat'][0]['id_a0']), 0);
		
		$data_proc = $this->_processing_datasource($data);
		$data = array_merge($data, $data_proc);

		return $data;

	}

	private function _processing_datasource($data)
	{
		$data['company'] = $this->company_model->data_company('id_company, company_name, company_address, company_post, company_province, company_reference_number, company_region, company_employee, telephone, email, company_fax, country_name,  country_code, capital, region, subregion, callingCodes', array('id_company' => $data['a0']['id_company']), 0);
		
		$_helper_summary__audit_reference = array();
		$_helper_summary__audit_reference_ID = array();
		$_helper_summary__audit_reference_basedOn_type = array();
		$_helper_summary__scope = array();
		$_helper_type_requested	= array();
		foreach ($data['a0_cat'] as $key => $value) {

			// cari certification_request dari a0_cat
			// $data['certification_request'] = $this->data_certification_request('*', array('id_a0_cat' => $value['id_a0_cat']) );
			$data['a0_cat'][$key]['certification_request'] = $this->data_certification_request('*', array('id_a0_cat' => $value['id_a0_cat']) );

			# Certification requested
			$_helper_type_requested[] = $value['type'];
			
			foreach ($data['a0_cat'][$key]['certification_request'] as $a => $b) {
				# extractor product line
				$ext_product_line = $this->extract_product_line_reference($b['product_line']);
				# extractor nace
				$ext_nace = $this->extract_nace_reference($b['nace']);
				# extractor scope
				$ext_scope = $this->extract_scope_reference($b['scope']);
				# extractor audit reference
				$ext_ar = $this->extract_audit_reference($b['audit_reference']);

				foreach ($ext_ar as $c => $d) {
					$d0 = $this->data_audit_reference('*', array('audit_reference' => $d),0);
					$data['a0_cat'][$key]['certification_request'][$a]['audit_reference_detail'][$c] = $d0;
					$data['a0_cat'][$key]['certification_request'][$a]['audit_reference_title'][] = @$d0['name'];
					$_helper_summary__audit_reference[] = @$d0['name'];
					$_helper_summary__audit_reference_ID[] = @$d0['audit_reference'];
					$_helper_summary__audit_reference_basedOn_type[$value['type']][] = @$d0['name'];
				}
				
				foreach ($ext_scope as $c => $d) {
					$d0 =  $this->commodity_model->data_scope('*', array('id_commodity' => $d), 0);
					$data['a0_cat'][$key]['certification_request'][$a]['scope_detail'][$c] = $d0;
					$data['a0_cat'][$key]['certification_request'][$a]['scope_detail_title'][] = @$d0['commodity_name'];
					$_helper_summary__scope[] = @$d0['commodity_name'];
				}
				foreach ($ext_product_line as $c => $d) {
					$d0 = $this->data_product_line('*', array('product_line_id = ' => $d ), 0 );
					$data['a0_cat'][$key]['certification_request'][$a]['product_line_detail'][$c] = $d0;
					$data['a0_cat'][$key]['certification_request'][$a]['product_line_title'][] = @$d0['product_line_name'];
					$_helper_summary__product_line[] = @$d0['product_line_name'];
				}
				foreach ($ext_nace as $c => $d) {
					$d0 = $this->nace_model->data_nace('*', array('nace_item' => $d), 0);
					$data['a0_cat'][$key]['certification_request'][$a]['nace_detail'][$c] = $d0;
					$data['a0_cat'][$key]['certification_request'][$a]['nace_detail_title'][] = @$d0['nace_name'];
					$_helper_summary__nace[] = @$d0['nace_name'];
				}
				
				/*$data['a0_cat'][$key]['certification_request'][$a]['nace_detail_title'] = implode(', ', $data['a0_cat'][$key]['certification_request'][$a]['nace_detail_title']);
				$data['a0_cat'][$key]['certification_request'][$a]['scope_detail_title'] = implode(', ', $data['a0_cat'][$key]['certification_request'][$a]['scope_detail_title']);
				$data['a0_cat'][$key]['certification_request'][$a]['audit_reference_title'] = implode(', ', $data['a0_cat'][$key]['certification_request'][$a]['audit_reference_title']);*/

				$data['brand_requested'][] = $b['brand_name'];
			}


		}

		# audit reference using title (SNI ...)
		$data['audit_reference_title'] = $_helper_summary__audit_reference;
		$data['unique_audit_reference_title'] = array_unique( $_helper_summary__audit_reference );
		#audit reference using id (43,44,..., n)
		$data['audit_reference_id'] = $_helper_summary__audit_reference_ID;
		$data['unique_audit_reference_id'] = array_unique( $_helper_summary__audit_reference_ID);
		#audit reference using type (JPA-009 { SNI,... } )
		$data['audit_reference_id_based_on_type'] = $_helper_summary__audit_reference_basedOn_type;
		# type requested [jpa,jpa,yq,jeca]
		$data['type_requested'] = $_helper_type_requested;
		#type request [jpa,yq,jeca]
		$data['unique_type_requested'] = array_unique($data['type_requested']);
		
		#scope requested
		$data['scope_requested'] = $_helper_summary__scope;
		#product line requested
		$data['product_line_requested'] = $_helper_summary__product_line;
		#NACE requested
		$data['nace_requested'] = $_helper_summary__nace;

		# jumlah request
		$data['request_length'] = count($data['a0_cat']);

		return $data;
	}

	/*
	| function get data confirmed schedules
	| 
	| requirement: none
	|
	| status function : used
	*/
	public function get_assessment_confirmed_schedules($singleOrGroup = FALSE)
	{
		switch ($singleOrGroup) {
			case FALSE: 
			case 'single':
				return $this->dataakses->SQL('SELECT 
					"single" as type_coordination, a0.id_a0 as id, a0.id_a0, a0_cat.type, countries.country_name as country_name, countries.region as region, id_company, company_name, company_region, company.telephone,  a0.assessment_date as execution, a0.a0_added_on as last_notice , "new assessment" as type_schedule, a0_cat.status as status, "permintaan awal" as description 
					FROM `a0` 
					join a0_cat using(id_a0) 
					join company using(id_company) 
					join countries on company.country_code = countries.id_country
					where a0_cat.status = "process" and a0.assessment_date IS NOT NULL 
					and NOT EXISTS (SELECT * FROM auditor_log where auditor_log.id_assessment = a0.id_a0 and auditor_log.assessment_type = "assessment" ) 
					group by id_company
					UNION 
					select 
					"single" as type_coordination, rs.id_rs as id, a0.id_a0, a0_cat.type, countries.country_name as country_name, countries.region as region, id_company, company_name, company_region, company.telephone, rs_schedule.survey_date as execution, rs_schedule.resurvey_added_on as last_notice, "re assessment" as type_schedule, rs.rs_status as status, rs.rs_description as description 
					from rs 
					left join rs_schedule using(id_rs_schedule) 
					join issued using(id_issued) 
					left join certificate using(id_certificate) 
					left join a0_cat using(id_certificate) 
					left join a0 using(id_a0)
					left join company using(id_company) 
					join countries on company.country_code = countries.id_country
					where rs.rs_status = "process" and rs_schedule.survey_date IS NOT NULL 
					and NOT EXISTS (SELECT * FROM auditor_log where auditor_log.id_assessment = rs.id_rs and auditor_log.assessment_type = "reassessment" ) 
					AND NOT EXISTS (SELECT * FROM assessment_collective_participant WHERE assessment_collective_participant.`id_participant` = rs.`id_rs`)
					group by id_company');
				# code...
				break;
			case 'group':
				return $this->dataakses->SQL('SELECT 
					"group" as type_coordination, assessment_collective.*, rs.id_rs AS id, a0.id_a0, a0_cat.type, countries.country_name AS country_name, countries.region AS region, id_company, company_name, company_region, company.telephone, rs_schedule.survey_date AS execution, rs_schedule.resurvey_added_on AS last_notice, "re assessment" AS type_schedule, rs.rs_status AS STATUS 
					FROM rs 
					JOIN assessment_collective_participant ON assessment_collective_participant.`id_participant` = rs.`id_rs`
					JOIN assessment_collective USING(id_assessment_group)
					LEFT JOIN rs_schedule USING(id_rs_schedule) 
					JOIN issued USING(id_issued) 
					LEFT JOIN certificate USING(id_certificate) 
					LEFT JOIN a0_cat USING(id_certificate) 
					LEFT JOIN a0 USING(id_a0)
					LEFT JOIN company USING(id_company) 
					JOIN countries ON company.country_code = countries.id_country
					WHERE rs.rs_status = "process" AND rs_schedule.survey_date IS NOT NULL 
					AND NOT EXISTS (SELECT * FROM auditor_log WHERE auditor_log.id_assessment = rs.id_rs AND auditor_log.assessment_type = "reassessment" ) 

					GROUP BY id_assessment_group');
				break;
			
			default:
				# code...
				break;
		}
	}

	

	/*
	* function data widget calendar
	* used for: get data for widget calendar.
	* spesific data: data from reassessment and assessment which survey date has been confirmed. 
	* requirements: none
	*
	* function status : used
	*/
	public function data_assessment_confirmed_date()
	{
		$dataRe = $this->dataakses->SQL("SELECT company.*, a0_cat.id_a0_cat, a0_cat.type, company_name as title, assessment_date as start from company join a0 using(id_company) join a0_cat using(id_a0) where assessment_date IS NOT NULL and status = 'progress' ");
		return $dataRe;	
	}

	/*
	* function to get data resend email.
	* requirements: id_company
	*/
	public function data_resend_email($id_company)
	{
		return $this->dataakses->SQL('SELECT * FROM a0 join email_log using(email_log_id) where assessment_date IS NULL and email_log_id IS NOT NULL and id_company = '.$id_company);
	}

	/*
	* assigned assessment
	*/
	public function data_assigned_assessment($id_company = NULL)
	{
		$where = '';
		if( !is_null($id_company)  )
		{
			$where .= 'and a0.id_company = '.$id_company;
		}
			return $this->dataakses->SQL('SELECT "assessment" as type_report, assessment_date, a0.id_a0, auditor.fullname, company.company_name, countries.country_name, company.company_region 
				FROM a0 
				join company using(id_company) 
				join countries on company.country_code = countries.id_country 
				join auditor_log on a0.id_a0 = auditor_log.id_assessment 
				join a0_cat using(id_a0)
				join auditor using(id_auditor) 
				where assessment_date IS NOT NULL and auditor_log.auditor_as = 1 and assessment_type = "assessment" and a0_cat.status = "process" and auditor_log.auditor_as = 1 and DATE(NOW()) < a0.assessment_date '.$where.' group by id_company

				UNION

				SELECT "reassessment" as type_report, assessment_date, a0.id_a0, auditor.fullname, company.company_name, countries.country_name, company.company_region
				FROM rs
				JOIN rs_schedule on rs.id_rs_schedule = rs_schedule.id_rs_schedule
				join issued on rs.id_issued = issued.id_issued
				join certificate on certificate.id_certificate = issued.id_certificate
				join auditor_log on rs.id_rs = auditor_log.id_assessment 
				join a0_cat on a0_cat.id_certificate = certificate.id_certificate
				join a0 on a0.id_a0 = a0_cat.id_a0
				join auditor using(id_auditor)
				join company using(id_company) 
				join countries on company.country_code = countries.id_country 
				where survey_date IS NOT NULL and auditor_log.auditor_as = 1 and assessment_type = "reassessment" and rs.rs_status = "process" and auditor_log.auditor_as = 1 and DATE(NOW()) < rs_schedule.survey_date '.$where.' group by id_company

			');
	}

	

	/*
	|
	|
	|
	*/
	public function data_schedule_assessment($id_company = null)
	{
		$where = '';
		if( !is_null($id_company)  )
		{
			$where .= 'and a0.id_company = '.$id_company;
		}
		$assessmentSQL = 'SELECT 
			CASE WHEN a0_cat.`ref` = "exist" THEN "audit-khusus" ELSE "assessment" END AS type_report, 
			a0_cat.id_a0_cat, a0_cat.type, a0.id_a0 AS id_assessment, NULL as id_rs, company.id_company, a0_cat.id_certificate, assessment_date, a0.pass_the_review, a0.id_a0, company.company_name, countries.country_name, company.company_region, "" as description, id_permintaan_sertifikasi
			FROM a0 
			JOIN company USING(id_company) 
			JOIN kelengkapan_permintaan_sertifikasi using(id_a0)
			JOIN countries ON company.country_code = countries.id_country 
			JOIN a0_cat USING(id_a0) 
			WHERE 
			(a0_cat.status = "process" OR a0_cat.status = "remidial")
			'.$where.'
			group by a0.id_a0';
		$reassessmentSQL = 'SELECT 
			"reassessment" as type_report, 
			a0_cat.id_a0_cat, a0_cat.type, rs_schedule.id_rs_schedule as id_assessment, id_rs,  company.id_company, a0_cat.id_certificate, rs_schedule.survey_date as assessment_date, a0.pass_the_review, a0.id_a0, company.company_name, countries.country_name, company.company_region, rs.rs_description as description, id_permintaan_sertifikasi
			FROM rs
			JOIN rs_schedule on rs.id_rs_schedule = rs_schedule.id_rs_schedule
			join issued on rs.id_issued = issued.id_issued
			join certificate on certificate.id_certificate = issued.id_certificate
			join a0_cat on a0_cat.id_certificate = certificate.id_certificate
			join a0 on a0.id_a0 = a0_cat.id_a0
			join company using(id_company) 
			JOIN kelengkapan_permintaan_sertifikasi on a0.id_a0 = kelengkapan_permintaan_sertifikasi.id_a0
			join countries on company.country_code = countries.id_country 
			where 
			(rs.rs_status = "process" or rs.rs_status = "remidial")   '.$where.' group by rs_schedule.id_rs_schedule';

		return $this->dataakses->SQL($assessmentSQL.' UNION '.$reassessmentSQL);

	}
	/*
	* assigned assessment
	*/
	public function data_conducted_assessment()
	{
		$d0 =  $this->dataakses->SQL('SELECT  
			id_rs, ref, id_a0, a0_cat.id_a0_cat, countries.country_name, company.*, 

			CASE 
			WHEN rs.`id_rs` IS NULL OR ref = "exist"
			THEN a0.`assessment_date`
			ELSE rs_schedule.`survey_date`
			END AS data_assessment_date,

			CASE 
			WHEN rs.`id_rs` IS NULL OR ref = "exist"
			THEN a0_cat.`status`
			ELSE rs.`rs_status`
			END AS data_assessment_status,

			CASE 
			WHEN rs.`id_rs` IS NULL OR ref = "exist"
			THEN a0.`id_a0`
			ELSE rs.`id_rs`
			END AS data_assessment_id,

			CASE 
			WHEN rs.`id_rs` IS NULL or ref = "exist"
			THEN "assessment"
			ELSE "reassessment"
			END AS data_assessment_type

			FROM company
			JOIN `countries` ON company.`country_code` = `countries`.`id_country`
			JOIN a0 USING(id_company)
			JOIN a0_cat USING(id_a0)
			LEFT JOIN certificate USING(id_certificate)
			LEFT JOIN issued USING(id_certificate)
			LEFT JOIN rs USING(id_issued)
			LEFT JOIN rs_schedule USING(id_rs_schedule)


			WHERE 
			( (rs.`rs_status` = "process" OR rs.`rs_status` = "remidial" ) OR (a0_cat.`status` = "process" OR a0_cat.`status` = "remidial") ) 
			-- AND ( (rs_schedule.`survey_date` IS NOT NULL and rs_schedule.survey_date <= DATE(NOW()) ) or (a0.`assessment_date` IS NOT NULL and a0.`assessment_date` <= DATE(NOW()) ) )

			GROUP BY id_company

		');
		$dataReturn = array();
		foreach ($d0 as $key => $value) {
			# code...
			$query = 'SELECT MIN(auditor_as) as leader, auditor_log_id, fullname FROM 
				auditor_log 
				JOIN auditor ON auditor.`id_auditor` = auditor_log.`id_auditor`
				WHERE id_assessment = '.$value['data_assessment_id'].' and assessment_type = "'.$value['data_assessment_type'].'" ';
			$d1 = $this->dataakses->SQL($query);
			foreach ($d1[0] as $a => $b) {
				$d0[$key][$a] = $b;
			}
			
			if(!is_null($d0[$key]['leader']) && strtotime($value['data_assessment_date']) <= strtotime(date('Y-m-d')) )
			{
				$dataReturn[] = $d0[$key];
			}
		}

		return $dataReturn;
	}

	public function data_waiting_result_assessment()
	{
		return $this->dataakses->SQL('SELECT 
			CASE 
			WHEN auditor_log.`assessment_type` = "assessment"
			THEN 
				a0.`assessment_date`
			ELSE	
				rs_schedule.`survey_date`
			END
			AS assessment_date,
			assessment_type,
			a0.id_a0, auditor.fullname, company.company_name, countries.country_name, company.company_region 
			FROM auditor_log
			JOIN auditor USING(id_auditor)
			LEFT JOIN rs_schedule ON rs_schedule.`id_rs_schedule` = auditor_log.`id_assessment`
			LEFT JOIN rs USING(id_rs_schedule)
			LEFT JOIN issued USING(id_issued)
			LEFT JOIN certificate USING(id_certificate)
			LEFT JOIN a0 ON a0.`id_a0` = auditor_log.`id_assessment`
			LEFT JOIN a0_cat USING(id_a0)
			LEFT JOIN company USING(id_company)
			LEFT JOIN `countries` ON company.`country_code` = `countries`.`id_country`
			WHERE (a0.assessment_date IS NOT NULL OR rs_schedule.`survey_date` IS NOT NULL ) AND (DATE(NOW()) >= a0.assessment_date OR DATE(NOW()) >= rs_schedule.`survey_date`) AND ( (a0_cat.status = "process" OR a0_cat.status = "remidial") OR (rs.`rs_status` = "process" OR rs.`rs_status` = "remidial") )
			GROUP BY a0.id_company

		');
	}

	
	/*
	* function get__data_detail_reassessment
	* requirement
	* - id certificate
	*
	* function status : used
	*/
	public function get__data_detail_reassessment($data)
	{
		return $this->dataakses->SQL("SELECT * FROM certificate join issued using(id_certificate) join rs using(id_issued) left join rs_schedule using(id_rs_schedule) where id_certificate = '".$data['id_certificate']."'");
	}

	/*
	* get data rs
	*
	* function status : used
	*/
	public function get_rs($rs)
	{
		$this->dataakses->SQL("SELECT * FROM rs where id_rs = ".$rs);
		return $this->dataakses->row_array();
	}

	public function get_full_rs($where = FALSE)
	{
		$this->db->select('*');
		$this->db->from('rs');
		$this->db->join('rs_schedule', 'rs_schedule.id_rs_schedule = rs.id_rs_schedule', 'left');
		$this->db->join('issued', 'rs.id_issued = issued.id_issued');
		$this->db->join('certificate', 'issued.id_certificate = certificate.id_certificate');
		$this->db->join('a0_cat', 'a0_cat.id_certificate = certificate.id_certificate');
		$this->db->join('a0', 'a0.id_a0 = a0_cat.id_a0');
		$this->db->join('company', 'a0.id_company = company.id_company');
		$this->db->join('countries', 'company.country_code = countries.id_country');
		if($where !== FALSE)
		{
			$this->db->where($where);
		}

		$data = $this->db->get();
		return $data->result_array();
	}

	/*
	* get data a0
	*
	* function status : used
	*/
	public function get_a0($id_a0)
	{
		$this->load->model('tools');
		
		$dataFull = $this->db->query("SELECT *
			FROM a0 
			join company on a0.id_company = company.id_company 
			join a0_cat on a0.id_a0 = a0_cat.id_a0 
			join certification_request on a0_cat.id_a0_cat = certification_request.id_a0_cat 
			where a0.id_a0 = ?", array($id_a0));
		
		$data['raw'] = $dataFull;
		$data['result'] = $dataFull->result_array();
		$data['a0'] = $dataFull->row_array();
		$data['a0']['url_token'] = (isset($data['a0']['token']))? $this->tools->hash_confirmation_address($data['a0']['token']) : '';
		
		return $data;
	}

	
	/*
	* function assessment counter model
	* requirement none
	* used by: __widget_assessment_counter
	*
	* function status: none
	*/
	public function assessment_counter()
	{
		return $this->dataakses->SQL('SELECT *, (select count(*) as all_length from a0_cat ) as all_length, count(type) as type_length FROM `a0_cat` group by type');
	}

	/*
	* function data_reassessment_confirmed_date
	* used for: get data for widget calendar.
	* spesific data: data from reassessment and assessment which survey date has been confirmed. 
	* requirements: none
	*
	* function status : used
	*/
	public function data_reassessment_confirmed_date()
	{
		$dataRe = $this->dataakses->SQL("SELECT company.*, certificate.id_certificate, certificate_status, company_name as title, survey_date as start, id_rs FROM rs 
										LEFT JOIN rs_schedule on rs.id_rs_schedule = rs_schedule.id_rs_schedule 
										join issued on rs.id_issued = issued.id_issued 
										join certificate on issued.id_certificate = certificate.id_certificate 
										join a0_cat on certificate.id_a0_cat = a0_cat.id_a0_cat
										join a0 on a0_cat.id_a0 = a0.id_a0
										join company on a0.id_company = company.id_company where survey_date IS NOT NULL and rs_status = 'process' ");
		return $dataRe;	
	}


	/*
	* list data reassessment
	*/
	public function list__reassessment()
	{
		$this->load->model('tools');

		$data = $this->dataakses->SQL('	SELECT rs.*, resurvey_added_on, company.id_company, company.company_name, a0_cat.id_a0_cat, rs_schedule.token, rs_schedule.survey_date, certification_category.name, expired_period, certification_category.type, DATE_ADD( deadline_date , INTERVAL certification_category.expired_period DAY) as expired_date, 
										DATEDIFF( rs.deadline_date, DATE(NOW())) as days_before_deadline, DATEDIFF( rs_schedule.survey_date, DATE(NOW())) as days_before_resurvey, DATEDIFF( DATE_ADD( deadline_date , INTERVAL certification_category.expired_period DAY), DATE(NOW())) as days_before_expired,
										certificate.id_certificate
										
										FROM rs 
										LEFT JOIN rs_schedule on rs.id_rs_schedule = rs_schedule.id_rs_schedule 
										join issued on rs.id_issued = issued.id_issued 
										join certificate on issued.id_certificate = certificate.id_certificate 
										join a0_cat on certificate.id_a0_cat = a0_cat.id_a0_cat
										join a0 on a0_cat.id_a0 = a0.id_a0
										join company on a0.id_company = company.id_company
										join certification_request on a0_cat.id_a0_cat = certification_request.id_a0_cat 
										join certification_category on certification_request.audit_reference = certification_category.audit_reference 
										where/* DATEDIFF( rs.deadline_date,  DATE(NOW())) <= 50
										and*/ rs_status = "process"
										');

		foreach ($data as $key => $value) {
			$data[$key]['is_confirm'] = ($value['token'] == '' && !is_null($value['id_rs_schedule']) && !is_null($value['survey_date']) )? true : false;
			$data[$key]['is_expired'] = ( date('Y-m-d') > $value['expired_date'] )? true :false;
			$data[$key]['full_deadline_date'] = date('M, d \'y', strtotime($value['deadline_date']) ).' ( '.$value['days_before_deadline'].' days again ) ';
			$data[$key]['full_resurvey_date'] = !is_null( $value['survey_date'] )? date('M, d \'y', strtotime($value['survey_date']) ).' ( '.$value['days_before_resurvey'].' days again ) ' : 'not confirmed yet!';
			$data[$key]['items'] = $this->dibrakom_items( $value['type'], $value['id_a0_cat']);
			$data[$key]['token_link'] = $this->tools->encode_token_link($value['token']);
		}

		return $data;
	}

	/*
	# function get certification request detail
	# requirements
		- id a0 cat
	*/
	public function detail_a0_cat($id_a0_cat = 0)
	{
		$this->load->database();

		$this->db->select('*');
		$this->db->from('a0');
		$this->db->join('a0_cat', 'a0_cat.id_a0 = a0.id_a0');
		$this->db->join('certification_request', 'certification_request.id_a0_cat = a0_cat.id_a0_cat', 'left');
		$this->db->join('brand', 'brand.id_brand = certification_request.id_brand','left');
		$this->db->join('company', 'company.id_company = a0.id_company');
		if( $id_a0_cat != 0 )
		{
			$this->db->where('a0_cat.id_a0_cat',$id_a0_cat);
			$query = $this->db->get();
			return $query->row_array();
		}else
		{
			$query = $this->db->get();
			return $query->result_array();
		}


		/*return $this->dataakses->SQL('SELECT * FROM a0 
			join a0_cat using(id_a0)
			join certification_request using(id_a0_cat)
			join brand using(id_brand)
			join company on company.id_company = a0.id_company
			where id_a0_cat = '.$id_a0_cat );*/
	}

	/*
	* get detail nace
	*/
	public function get_detail_nace($nace = null)
	{
		if(is_null($nace))
		{
			$query = $this->db->get('nace');
			return $query->result_array();
		}
		else 
		{
			$data = array();
			if( is_string($nace) )
			{
				$nace = explode(',', $nace);
			}

			foreach ($nace as $key => $value) {
				# code...
				$this->db->select('*');
				$this->db->from('nace');
				$this->db->where('nace_item',$value);
				$query = $this->db->get();
				$query = $query->row_array();
				array_push($data, $query);
			}

			return $data;
		}
	}

	public function get_detail_scope($scope = null)
	{
		if(is_null($scope))
		{
			$query = $this->db->get('commodity');
			return $query->result_array();
		}
		else 
		{
			$data = array();
			if( is_string($scope) )
			{
				$scope = explode(',', $scope);
			}

			foreach ($scope as $key => $value) {
				# code...
				$this->db->select('*');
				$this->db->from('commodity');
				$this->db->where('id_commodity',$value);
				$query = $this->db->get();
				$query = $query->row_array();
				array_push($data, $query);
			}

			return $data;
		}
	}

	public function get_detail_product_line($product_line = null)
	{
		if(is_null($product_line))
		{
			$this->db->select('*');
			$this->db->from('product_line');
			$this->db->join('product_line_subcategory', 'product_line_subcategory.product_subcategory_id = product_line.product_subcategory');
			$this->db->join('product_line_category', 'product_line_category.product_category_id = product_line_subcategory.product_category_id');
			$query = $this->db->get();
			return $query->result_array();
		}
		else 
		{
			$data = array();
			if( is_string($product_line) )
			{
				$product_line = explode(',', $product_line);
			}

			foreach ($product_line as $key => $value) {
				$isItem = strpos($value, '.');
				$item = FALSE;
				if($isItem !== FALSE)
				{
					$item = explode( '.', $value );
					array_shift($item);
					$item = implode(',', $item);
				}

				# code...
				$this->db->select('*');
				$this->db->from('product_line');
				$this->db->join('product_line_subcategory', 'product_line_subcategory.product_subcategory_id = product_line.product_subcategory');
				$this->db->join('product_line_category', 'product_line_category.product_category_id = product_line_subcategory.product_category_id');
				$this->db->where('product_line_id',$value);
				$query = $this->db->get();
				$query = $query->row_array();
				$query['item'] = $item;
				array_push($data, $query);
			}

			return $data;
		}
	}

	/*
	* get a0 yang sudah dikonfirmasi namun belum dibuat result
	INGAT. unconfirmed result [progress, success, etc]
	*/
	public function get_a0_unconfirmed_result($company = 0)
	{
		$this->load->database();
		$query = "SELECT *, GROUP_CONCAT(brand_name) as requested_brand FROM a0
				JOIN a0_cat ON a0_cat.id_a0 = a0.id_a0
				JOIN certification_request ON certification_request.id_a0_cat = a0_cat.id_a0_cat
				LEFT JOIN brand ON brand.id_brand = certification_request.id_brand
				WHERE  assessment_date IS NOT NULL
				AND a0.assessment_date <= DATE(NOW()) 
				AND (a0_cat.status = 'process' OR a0_cat.status = 'remidial')
				AND a0_cat.id_certificate IS NULL 
				AND  EXISTS (SELECT id_assessment FROM auditor_log WHERE id_assessment = a0.id_a0)
				";

		
		if($company > 0)
		{
			$query .= ' and a0.id_company = ? ';
			$query .= ' group by a0_cat.id_a0_cat ';
			$query .= ' order by a0_cat.id_a0_cat ASC';

			$query = $this->db->query( $query, array($company) );	
			
		}else
		{
			// $query .= 'GROUP BY a0.id_a0';
			$query = $this->db->query($query);
		}
		// return $query;
		return $query->result_array();

	}

	public function get_audit_khusus_unconfirmed_result($company = 0)
	{
		$this->load->database();
		$query = "SELECT *  , GROUP_CONCAT(brand_name SEPARATOR ',') AS brand_requested 
				FROM a0
				JOIN a0_cat ON a0_cat.id_a0 = a0.id_a0 
				JOIN certification_request ON certification_request.id_a0_cat = a0_cat.id_a0_cat 
				LEFT JOIN brand ON brand.id_brand = certification_request.id_brand 
				WHERE 
				a0.assessment_date <= DATE(NOW()) AND (a0_cat.status = 'process' OR a0_cat.status = 'remidial') 
				AND a0_cat.id_certificate IS NOT NULL 
				AND ref = 'exist' 
				AND a0_cat.id_certificate IN (SELECT id_certificate FROM certificate) 
				";

		if($company > 0)
		{			
			$query .= ' and a0.id_company = ?';
		}
		$query .= ' group by certification_request.id_a0_cat';
		if($company > 0)
		{
			$query = $this->db->query( $query, array($company) );	
			
		}else
		{
			$query = $this->db->query($query);
		}
		// return $query;
		return $query->result_array();

	}

	/*
	* get rs yang sudah dikonfirmasi namun belum dibuat result
	INGAT. unconfirmed result [progress, success, etc]
	*/
	public function get_rs_unconfirmed_result($company = 0)
	{
		$this->load->database();

		// $this->db->select('*');
		// $this->db->from('rs');
		// $this->db->join('rs_schedule', 'rs.id_rs_schedule = rs_schedule.id_rs_schedule','left' );
		// $this->db->join('issued', 'rs.id_issued = issued.id_issued' );
		// $this->db->join('certificate', 'issued.id_certificate = certificate.id_certificate' );
		// $this->db->join('a0_cat', 'certificate.id_a0_cat = a0_cat.id_a0_cat' );
		// $this->db->join('a0', 'a0_cat.id_a0 = a0.id_a0' );
		// $this->db->join('company', 'a0.id_company = company.id_company' );
		// $this->db->join('certification_request', 'a0_cat.id_a0_cat = certification_request.id_a0_cat' );
		// $this->db->join('certification_category', 'certification_request.audit_reference = certification_category.audit_reference' );
		// $this->db->where('rs_status = "process" ');
		// $query = $this->db->get();
		
		$query = "SELECT * , GROUP_CONCAT(brand_name SEPARATOR ',') AS brand_requested
				FROM rs
				left join rs_schedule on rs.id_rs_schedule = rs_schedule.id_rs_schedule
				join issued on rs.id_issued = issued.id_issued
				join certificate on issued.id_certificate = certificate.id_certificate
				join a0_cat on certificate.id_a0_cat = a0_cat.id_a0_cat
				join a0 on a0_cat.id_a0 = a0.id_a0
				join company on a0.id_company = company.id_company
				join certification_request on a0_cat.id_a0_cat = certification_request.id_a0_cat
				join certification_category on certification_request.audit_reference = certification_category.audit_reference
				LEFT JOIN brand using(id_brand)
				where (rs_status = 'process' or rs_status = 'remidial')
				";

		if($company > 0)
		{
			$query .= 'and a0.id_company = ? ';
		}
		$query .= "group by id_rs";

		if($company > 0)
		{
			$query = $this->db->query( $query, array($company) );	
			
		}else
		{
			$query = $this->db->query($query);
		}
		// return $query;
		return $query->result_array();
	}

	/*
	* confirmation re assessment
	* require
	* 	- assessment date
	* 	- token
	* 	- id rs
	*
	* function status : used
	*/
	public function confirmation_reassessment_date($data)
	{
		$this->dataakses->SQL("SELECT * FROM rs where id_rs = ".$data['id_rs']);
		$rs = $this->dataakses->row_array();

		$this->dataakses->SQL('UPDATE rs_schedule set survey_date = "'.$data['assessment_date'].'", token="" where token="'.$data['token'].'" and id_rs_schedule='.$rs['id_rs_schedule'] );
		$this->dataakses->SQL('UPDATE rs set rs_status = "process" where id_rs = '.$data['id_rs'] );
		return $this->dataakses->affectedRows();
	}

	/*
	| ------------------------
	| check collective data
	| ------------------------
	*/
	public function get_assessment_collective($where = array())
	{
		if( count($where) > 0 )
		{

			$d0 = $this->db->get_where('assessment_collective', $where);
			
			return $d0->row_array();
		}else
		{
			$d0 = $this->db->get('assessment_collective');
			
			return $d0->result_array();
		}
	}

	/*
	|---------------------
	| Get assessment  / reassessment unassigned auditor.
	|---------------------
	*/
	public function assessment_unasigned_auditor($select = '*', $where=FALSE, $return_as = FALSE)
	{
		$this->db->select('*');
		$this->db->from('a0');
		$this->db->join('a0_cat', 'a0.id_a0 = a0_cat.id_a0');
		$this->db->join('certification_request','a0_cat.id_a0_cat = certification_request.id_a0_cat');
		// $this->db->where('');
		if($where)
		{
			$this->db->where($where);
		}

		$data = $this->db->get();
		if($return_as)
		{
			return $data->row_array($return_as);
		}else if($return_as === 'raw')
		{
			return $data;
		}else
		{
			return $data->result_array();
		}
	}

	/*
	| ------------------------
	| get assessment collective participants
	| ------------------------
	*/

	public function get_assessment_collective_participant($where = array())
	{
		if( count($where) > 0 )
		{

			$d0 = $this->db->get_where('assessment_collective_participant', $where);
			
			return $d0->result_array();
		}else
		{
			$d0 = $this->db->get('assessment_collective_participant');
			
			return $d0->result_array();
		}
	}


	// E N D - G E T /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	
	/*
	| ---------------------------------------------------------------------------------------------
	| S T A R T  -  U P D A T E  S E C T I O N
	| ---------------------------------------------------------------------------------------------

	*/

	/*
	* function confirmation_assessment_date
	* used for: confirmation assessment date from page confirm date assessment
	* requirements
	* 	- assessment_date (date)
	* 	- token (string)  
	* 	- id_company (int)
	*
	* function status: undefined
	*/
	public function confirmation_assessment_date($data)
	{
		$this->dataakses->SQL('UPDATE a0 set assessment_date = "'.$data['assessment_date'].'", token="" where token="'.$data['token'].'" and id_company='.$data['id_company'] );
		return $this->dataakses->affectedRows();
	}

	/*
	* function update_confirmation_assessment_date
	* used for: confirmation assessment date from page confirm date assessment
	* requirements
	* 	- assessment_date (date)
	* 	- id_a0 (int)
	*
	* function status: undefined
	*/
	public function update_confirmation_assessment_date($data)
	{
		$this->dataakses->SQL('UPDATE a0 set assessment_date = "'.$data['assessment_date'].'" where id_a0 = '.$data['id_a0'] );
		return $this->dataakses->affectedRows();
	}

	/*
	* function update_a0_cat
	* used for: update a0_cat
	* requirements
	* 	- $update array
	* 	- $where array
	*
	* function status: used
	*/
	public function update_a0_cat($update, $where)
	{
		
		$this->db->where($where);
		$this->db->update('a0_cat', $update); 
	}

	/*
	* function update_a0
	* used for: update a0
	* requirements
	* 	- $update array
	* 	- $where array
	*
	* function status: used
	*/
	public function update_a0($update, $where)
	{
		
		$this->db->where($where);
		$this->db->update('a0', $update); 
	}

	/*
	* function update_current_risk
	* used for: update current risk based on suggest risk
	* requirements
	* 	- risk status (string enum)
	* 	- id_a0 (int)
	*
	* function status: used
	*/
	public function update_current_risk($data)
	{
		$this->dataakses->SQL('UPDATE a0_cat set risk = ? where id_a0_cat = ?', 'si', $data['risk'], $data['id_a0_cat'] );
		return $this->dataakses->affectedRows();
	}

	/*
	* function update_suggest_risk
	* used for: update current risk based on suggest risk
	* requirements
	* 	- risk status (string enum)
	* 	- id_a0 (int)
	*
	* function status: used
	*/
	public function update_suggest_risk($data)
	{
		$this->dataakses->SQL('UPDATE a0_cat set suggest_risk = ? where id_a0_cat = ?', 'si', $data['risk'], $data['id_a0_cat'] );
		return $this->dataakses->affectedRows();
	}

	/*
	| -----------------------------------------
	| Function to update date collective assessment
	| -----------------------------------------

	*/
	public function update_collective_date_assessment($data)
	{
		// $d0 = $this->get_assessment_collective( array('id_assessment_group' => $data['id_assessment_group']) );
		// print_r($d0);
		// print_r($data);
		$this->db->where(array( 'id_assessment_group' => $data['id_assessment_group'] ) );
		$this->db->update('assessment_collective', array('collective_date' => $data['collective_date'][0], 'collective_token' => ''));
		// $2y$11$IUAjJCVeJiohQCMkJV4mKedGCHkAP4oSjJJS5aCfqbAOVy289r/Xu

		# bagian :: samakan semua tanggal di rs / company dengan tanggal diatas

		// $d1 = $this->get_assessment_collective_participant( array('id_assessment_group' => $data['id_assessment_group']) );
		
		foreach ($data['collective'] as $key => $value) {
			$d2 = $this->db->get_where('rs', array('id_rs' => $value['id_rs']) );
			$d2 = $d2->row_array();
			$this->db->where('id_rs_schedule', $d2['id_rs_schedule']);
			$this->db->update('rs_schedule', array('survey_date' => $value['survey_date'], 'token' => '') );

		}
		// print_r($d1);
	}

	/*
	|-----------------------------
	| Update assessment schedule
	|-----------------------------
	*/
	public function update_schedule_assessment($update, $where)
	{
		$this->db->where($where);
		$this->db->update('a0', $update); 
	}

	/*
	|-----------------------------
	| Update reassessment schedule
	|-----------------------------
	*/
	public function update_schedule_reassessment($update, $where)
	{

		$this->db->where($where);
		$this->db->update('rs_schedule', $update); 
	}

	/*
	|-----------------------------
	| Update reassessment data
	|-----------------------------
	*/
	public function update_rs($update, $where)
	{
		$this->db->where($where);
		$this->db->update('rs', $update); 
	}

	public function update_a0_notes($id_a0, $subject, $notes_content)
	{
		$a0 = $this->data_a0('*', array('id_a0' => $id_a0), 0);

		// INSERT NOTES===============================================
		$notes_data = array(
			'notes_subject' => $subject,
			'notes_content' => $notes_content,
			);
		$notes = $this->notes_model->insert_notes_log($notes_data);

		$a0_notes 	= is_null($a0['a0_notes']) || $a0['a0_notes'] == ''? array() : explode(',', $a0['a0_notes']);
		array_push($a0_notes, $notes->insert_id());
		$a0_notes 	= implode(',', $a0_notes);

		$update = array(
			'a0_notes' 			=> $a0_notes,
			);
		$this->assessment_model->update_a0($update, array('id_a0' => $id_a0));
	}


	/*
	| ---------------------------------------------------------------------------------------------
	| //E N D  -  U P D A T E  S E C T I O N
	| ---------------------------------------------------------------------------------------------

	*/

	/*
	| ---------------------------------------------------------------------------------------------
	| S T A R T  -  I N S E R T  S E C T I O N
	| ---------------------------------------------------------------------------------------------
	*/

	/*
	* set resurvey data
	* update resurvey with rs schedule
	*
	* params
	* 	- rs schedule id
	*
	* function status : used
	*/
	public function set_resurvey($id_rs, $rs_schedule, $audit_length)
	{
		$this->dataakses->SQL('UPDATE rs set id_rs_schedule = ?,  rs_status = ?, rs_audit_length = ? where id_rs = ?', 'isii', $rs_schedule, 'process', $audit_length, $id_rs );

	}

	/*
	|-------------------------------
	| Create new assessment collective
	|-------------------------------
	*/
	public function new_assessment_collective($coordinator_name, $coordinator_email, $dateline)
	{
		$this->load->library('hash');

		$date = explode('/', $dateline );
		$dateline = $date[2].'-'.$date[1].'-'.$date[0];
		$this->dataakses->SQL('INSERT into assessment_collective(coordinator_name, coordinator_email, collective_date_deadline) values(?,?,?)', 'sss', $coordinator_name, $coordinator_email, $dateline);
		$id = $this->dataakses->insert_id();

		$hashKey = base64_encode('collective.'.$id);
		$token = $this->hash->encrypt($hashKey);

		// update token
		$this->db->where('id_assessment_group', $id);
		$this->db->update('assessment_collective', array('collective_token' => $token) );

		// url token
		$url_token = $this->hash->encode_token_link($token);

		return array( 'id_assessment_collective' => $id, 'url_token' => $url_token );
	}

	/*
	| ----------------------------------------------
	| insert assessment collective participant
	| ----------------------------------------------
	
	*/
	public function insert_assessment_participant($id_assessment_collective, $id_assessment, $type = 1)
	{
		$this->dataakses->SQL('INSERT into assessment_collective_participant(id_assessment_group, id_participant, type_participant) values(?,?,?)', 'iii', $id_assessment_collective, $id_assessment, $type);
	}

	/*
	* Get available date based on records
	* @ params $daysNum (int) Jumlah hari yang akan dilakukan
	* @ params @records records array 
		- example
		$records = array(
			array( '2017-01-05', '2017-01-10' ),
			array( '2017-01-12', '2017-01-13' ),
			array( '2017-01-17', '2017-01-19' ),
			array( '2017-01-25', '2017-01-27' ),
		);

	*/
	public function fetching_available_date($daysNum = 3, $records = null)
	{


		// loop j
		$days = 60*60*24;
		$offdays = $this->config->item('weekend');

		// $records = array(
		// 	array( date('Y-m-d'), date('Y-m-d') ),
		// 	array( '2017-01-20', '2017-01-23' ),
		// 	array( '2017-02-12', '2017-02-13' ),
		// 	array( '2017-02-17', '2017-02-19' ),
		// 	array( '2017-03-25', '2017-03-27' ),
		// );
		$itemLen = count($records);
		$next_iterator = new ArrayIterator($records);
		$next_iterator->next();
		$result = array();
		$lastKey = end(array_keys($records));

		foreach ($records as $key => $value) {
			$data = array();
			$n 				= $next_iterator->current();
			
			
			$str_curEnd 	= strtotime($value[1]);
			$str_nxtStart 	= strtotime($n[0]);
			$inWeekDay 		= isset($n) ? $this->worksDay_checker($value[1], $n[0], $offdays) : FALSE;
			$data['days_between'] 		= isset($n)? ($str_nxtStart - $str_curEnd ) / $days : 0;

			$data['last_records'] 		= isset($n)? FALSE : TRUE;
			$data['currentEndEvent'] 	= $value[1];
			$data['nextStartEvent'] 	= (isset($n))? $n[0] : NULL;
			$data['pass_holiday'] 		= $inWeekDay['holiday_length'] > 0? TRUE : FALSE;
			$data['holiday_length'] 	= $inWeekDay['holiday_length'];
			$data['holiday_items'] 		= isset($inWeekDay['holiday'] )? $inWeekDay['holiday'] : array();
			$data['work_days_length'] 	= $inWeekDay['work_days_length']? $inWeekDay['work_days_length'] : 0;
			$data['is_available_for_schedule'] = ($data['work_days_length'] < $daysNum) && $data['last_records'] == FALSE ? FALSE : TRUE;
			$data['can_be_draft'] = (int)floor( $data['work_days_length']/$daysNum );

			if($data['last_records'] == FALSE && $data['is_available_for_schedule'])
			{
				for ($a=0; $a < $data['can_be_draft']; $a++) { 
					$data['draft'][$a]['start'] 	= $inWeekDay['work_days'][0];
					$data['draft'][$a]['finish'] 	= $inWeekDay['work_days'][$daysNum - 1];
				
					for ($i=0; $i < $daysNum; $i++) { 
						$data['draft'][$a]['days_items'][] = isset($n) ? array_shift( $inWeekDay['work_days']) : NULL;
					}
				}
			}else if(($data['last_records'] == TRUE) )
			{
				$forecast = $this->forecasting_next_date($daysNum, $value[1], $offdays);
				$data['draft'][0]['start'] 	= $forecast['work_days'][0];
				$data['draft'][0]['finish'] 	= $forecast['work_days'][$daysNum - 1];
				for ($i=0; $i < $daysNum; $i++) { 
					$data['draft'][0]['days_items'][] = $forecast['work_days'][$i];
				}
			}


		
			$result[] = $data;
			$next_iterator->next();

		}
		// print_r($result);

		return $result;
	}

	/*
	|------------------
	| Function worksDay_checker
	|------------------
	| Function to check apakah ada hari libur dalam tanggal mulai - tanggal selesai.

	* @params $start (string date) Y-m-d
	* @params $finish (string date) Y-m-d
	* @params $offdays array [n1,n2, .., n] 
		- n = days PHP ISO-8601 numeric representation of the day of the week (added in PHP 5.1.0) format N
		- default [6,7]

	*/
	public function worksDay_checker($start, $finish, $offdays = NULL)
	{
		$days 		= 60*60*24;
		$weeksoff 	= is_null($offdays)? $this->config->item('weekend') : $offdays;
		$offdays 	= is_null($offdays)? $this->config->item('weekend') : $offdays;
		$str_start 	= strtotime($start);
		$str_end 	= strtotime($finish);
		$daysLen 	= ($str_end - $str_start ) / $days;
		$daysItem 	= array();
		$holiday 	= array();
		$startDate 	= $start;
		$data = $this->fetching_next_date($daysLen, $startDate, $offdays);

		return $data;
	}
	/*
	|------------------------------------------
	| Function fetching next date
	|------------------------------------------
	| Fungsi untuk mencari jumlah hari kerja dalam n hari.
	* Params
	* @params $daysNum int
	* @params $startDate string date
	* @params $offdays array 
	|-------------------------------------------
	*/
	public function fetching_next_date($daysNum, $startDate, $offdays = NULL)
	{
		$offdays 	= is_null($offdays)? $this->config->item('weekend') : $offdays;
		for ($i=0; $i < $daysNum; $i++) { 
			$nextDate 				= date('Y-m-d', strtotime($startDate."+1 days"));
			$data['days_item'][] 	= $nextDate;
			$startDate 				= $nextDate;
			if( $this->is_holiday($nextDate, $offdays) )
			{
				$data['holiday'][] 	= $nextDate;
			}else
			{
				$data['work_days'][]= $nextDate;
			}
			// var_dump(in_array(date('N', strtotime($nextDate) ), $weeksoff));
		}
		$data['holiday_length'] 	= isset($data['holiday'])? count($data['holiday']) : 0;
		$data['work_days_length'] 	= isset($data['work_days'])? count($data['work_days']) : 0;
		return $data;
	}
	/*
	|---------------------------------------------------
	| Function forecasting_next_date
	|---------------------------------------------------
	| Fungsi untuk mendapatkan n hari kerja dari tanggal 
	| tertentu
	|---------------------------------------------------
	* @params
	* @params $daysNum int
	* @params $startDate string date
	* @params $offdays array 
	|---------------------------------------------------
	*/
	public function forecasting_next_date($daysNum, $startDate, $offdays = NULL)
	{
		$offdays 	= is_null($offdays)? $this->config->item('weekend') : $offdays;
		$data['days_item'][] 	= $startDate;
		if( $this->is_holiday($startDate, $offdays) )
		{
			$data['holiday'][] 	= $startDate;
			$daysNum = $daysNum + 1;
		}else
		{
			$data['work_days'][]= $startDate;
		}

		for ($i=1; $i < $daysNum; $i++) { 
			$nextDate 				= date('Y-m-d', strtotime($startDate."+1 days"));
			$data['days_item'][] 	= $nextDate;
			$startDate 				= $nextDate;
			if( $this->is_holiday($nextDate, $offdays) )
			{
				$data['holiday'][] 	= $nextDate;
				$daysNum = $daysNum + 1;
			}else
			{
				$data['work_days'][]= $nextDate;
			}
			// var_dump(in_array(date('N', strtotime($nextDate) ), $weeksoff));
		}
		$data['holiday_length'] 	= isset($data['holiday'])? count($data['holiday']) : 0;
		$data['work_days_length'] 	= isset($data['work_days'])? count($data['work_days']) : 0;
		return $data;
	}
	/*
	|------------------------------------------------
	| Function is holidays
	|------------------------------------------------
	| fungsi untuk menentukan apakah tanggal n adalah 
	| hari libur
	|------------------------------------------------
	* @params
	* @params $date string data
	* @params offdays array
	|------------------------------------------------
	*/
	public function is_holiday($date, $offdays = NULL)
	{
		$offdays 	= is_null($offdays)? $this->config->item('weekend') : $offdays;
		$str_date = strtotime($date);
		// echo date('N', $str_date);
		return in_array(date('N', $str_date), $offdays);
	}


	/*
	| ---------------------------------------------------------------------------------------------
	| // E N D  -  I N S E R T  S E C T I O N
	| ---------------------------------------------------------------------------------------------

	*/

	/*
	* create token for resurvey
	* params
	* 	- id rs
	*
	* function status : used
	*/
	public function create_token_resurvey($id_rs)
	{
		$this->load->library('hash');
		$hashKey = base64_encode('resurvey.'.$id_rs);

		return $this->hash->encrypt($hashKey);

	}

	

	/*
	* create resurvey schedule
	* params 
	* 	- token
	* 
	* output
	* 	- resurvey schedule id
	*
	* function status : used
	*/

	public function create_resurvey_schedule($token)
	{
		$this->dataakses->SQL('INSERT INTO rs_schedule(token, resurvey_added_on) values(?,?)','ss', $token, date('Y-m-d'));
		return $this->dataakses->insert_id();
	}

	/*
	* NOTE :::::::
	*
	* $token harus di encode terlebih dahulu.
	* $token sebelum dikirim ke email, semua tanda / (slash) harus di ganti menjadi ||
	* lalu disini, setelah url di decode, akan di "netralisir" lagi tanda || menjadi /
	*
	* function status : used
	*/
	public function authentication__assessment_token($id_company, $token)
	{
		$this->load->library('hash');

		$pattern = '$2y$11$'.str_replace('||', '/', urldecode($token) );
		$result = array('is_auth' => false);
		$this->dataakses->SQL('SELECT * FROM a0 JOIN a0_cat using(id_a0) where id_company='.$id_company.' and token = "'.$pattern.'"');

		$result['is_found'] = (count($this->dataakses->result_array()) > 0)? true : false ;
		if($result['is_found'] == true)
		{
			$data = $this->dataakses->row_array();

			$hashKey = base64_encode($id_company.'.'.$data['id_a0']);
			$auth = $this->hash->decrypt($hashKey, $pattern);

			if($auth == true)
			{
				// $this->dataakses->SQL('SELECT * FROM company join brand using(id_company) where id_brand='.$brand);
				$result['is_auth'] = $auth;			
				$result['data'] = $data;			
				// $result['company'] = $this->dataakses->row_array();			
			}
		}
		return $result;
	}

	/*
	* NOTE :::::::
	*
	* $token harus di encode terlebih dahulu.
	* $token sebelum dikirim ke email, semua tanda / (slash) harus di ganti menjadi ||
	* lalu disini, setelah url di decode, akan di "netralisir" lagi tanda || menjadi /
	*/
	public function authentication__assessment_lanjutan($id_rs, $token)
	{
		$this->load->library('hash');

		$pattern = '$2y$11$'.str_replace('||', '/', urldecode($token) );
		$result = array('is_auth' => false);
		$this->dataakses->SQL('SELECT * FROM rs JOIN rs_schedule using(id_rs_schedule) where id_rs='.$id_rs.' and token = "'.$pattern.'"');

		$result['is_found'] = (count($this->dataakses->result_array()) > 0)? true : false ;
		if($result['is_found'] == true)
		{
			$data = $this->dataakses->row_array();

			$hashKey = base64_encode('resurvey.'.$id_rs);
			$auth = $this->hash->decrypt($hashKey, $pattern);

			if($auth == true)
			{
				// $this->dataakses->SQL('SELECT * FROM company join brand using(id_company) where id_brand='.$brand);
				$result['is_auth'] = $auth;			
				$result['data'] = $data;			
				// $result['company'] = $this->dataakses->row_array();			
			}
		}
		return $result;
	}

	/*
	* function send email notification reassessment
	*
	* function status : used
	*/
	function send_email_notification_reassessment($id_rs, $id_rs_schedule, $otherEmailContent = '')
	{
		$this->load->model('certification_model');
		$this->load->model('tools');
		$this->dataakses->SQL('SELECT company_name, email, rs_schedule.token, deadline_date, certificate.id_certificate, id_rs FROM rs join rs_schedule using(id_rs_schedule) join issued using(id_issued) join certificate using(id_certificate) join a0_cat using(id_a0_cat) join a0 using(id_a0) join company using(id_company) where id_rs = '.$id_rs.' and id_rs_schedule = '.$id_rs_schedule);
		$dataCertificate = $this->dataakses->row_array();

		$companyName = $dataCertificate['company_name'];
		$no_certificate = $dataCertificate['id_certificate'];
		$batasAkhir = $dataCertificate['deadline_date'];


		$token = $this->tools->encode_token_link($dataCertificate['token']);
		$url = site_url('assessment/lanjutan/'.$dataCertificate['id_rs'].'/'.$token);
		$subject = 'Confirmation Re Assessment date';

		$mailContent = <<<EOF
		<div class="display:inline;">
		Hallo, Perusahaan $companyName.<br>
		<p>Saat ini, sertifikat anda dengan nomor sertifikat $no_certificate akan memasuki masa peninjauan ulang.</p> 
		<p> Batas Akhir Peninjauan Ulang adalah pada tanggal $batasAkhir </p>
		<p>Silahkan anda konfirmasikan tanggal untuk pelaksanaan peninjauan kembali sertifikasi $no_certificate dengan menuju tautan di bawah ini. </p>
		</div>
		<div style="display:inline;"> 
			<a href="$url" style="padding:10px; background:#4285f4;color:white;text-decoration: none;"> Konfirmasi Tanggal Re Assessment</a>
		</div>
		$otherEmailContent
		<p> Jika Saat Pengisian terdapat kesalahan, silahkan hubungi costumer support kami. Terima kasih. </p>

EOF;
		echo $mailContent;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Yoqa Costumer Service <costumer.service@yoqa.com>' . "\r\n";

		if( $this->can_send_email_notification_reassessment === TRUE  )
		{
			// simpan email ke email log
			$this->certification_model->save_email_log($id_rs_schedule, $dataCertificate['email'], $subject, $mailContent, 'reassessment');

			if(!mail( $dataCertificate['email'], $subject, $mailContent, $headers) )
			{
				header("HTTP/1.0 500 send email to coordinator is unsuccessfull. please check your code!");
			}
		}
		

		// $this->email->send();

	}

	/*
	|----------------------
	| RUmus reduce hari audit
	|----------------------
	*/
	public function rumus_reduce_hari_audit($percent, $days)
	{
		$percent = $percent / 100;
		$days_reduction = $days * $percent;
		$days = $days - $days_reduction;
		return array('reduction' => $days_reduction, 'reduced' => $days);
	}

	/*
	|----------------------
	| RUmus hitung Hari JPA
	|----------------------
	*/
	public function rumus_hitung_smp($hari_smp, $jpa_length)
	{
		return sqrt( (1/3)*$hari_smp + ($jpa_length - 1) );
	}

	/*
	|---------------------
	| Rumus hitung SML / JECA
	|---------------------
	*/
	public function rumus_hitung_sml($hari_sml)
	{
		return sqrt($hari_sml);
	}

	/*
	|---------------------
	| Rumus hitung SML
	|---------------------
	*/
	public function rumus_hitung_smm($hari_smm)
	{
		return sqrt($hari_smm);
	}

	/*
	|---------------------
	| Rumus hitung SMM + JPA
	|---------------------
	*/
	public function rumus_hitung_smm_smp($hari_smm, $jpa_length)
	{
		return sqrt($hari_smm + $jpa_length);
	}

	/*
	|---------------------
	| Rumus hitung SMM + SML (no JPA)
	|---------------------
	*/
	public function rumus_hitung_sml_smm($hari_sml, $hari_smm)
	{
		// return $this->rumus_hitung_sml($hari_sml) + $this->rumus_hitung_smm($hari_smm);
		return sqrt($hari_sml + $hari_smm);
	}

	/*
	|---------------------
	| Rumus hitung JPA + SML
	|---------------------
	*/
	public function rumus_hitung_sml_smp($hari_sml, $hari_smm, $jpa_length)
	{
		// return $this->rumus_hitung_smp($hari_smm, $jpa_length) + $this->rumus_hitung_sml($hari_sml);
		return sqrt( (1/3)*$hari_smm + ($jpa_length - 1) + $hari_sml );
	}

	/*
	|--------------------
	|	Rumus hotimg SMM + SML + JPA
	|--------------------
	*/
	public function rumus_hitung_smm_sml_smp($hari_sml, $hari_smm, $jpa_length)
	{
		// return $this->rumus_hitung_smm_smp($hari_smm, $jpa_length) +  $this->rumus_hitung_sml($hari_sml);
		// echo "sqrt( (1/3)*".$hari_smm." + ".$jpa_length." + ".$hari_sml." )";
		return sqrt( (1/3)*$hari_smm + $jpa_length + $hari_sml );
	}

	/*
	|-------------------
	| Define jumlah hari audit
	|-------------------
	*/
	public function hitung_hari_audit($hari)
	{
		return floor($hari);
	}

	/*
	|-------------------
	| Define jumlah auditor
	|-------------------
	*/
	public function hitung_jumlah_auditor($hari)
	{
		return ceil($hari);
	}

	public function tentukan_kebutuhan_audit($hari)
	{
		return array( 'auditor' => $this->hitung_jumlah_auditor($hari), 'hari_audit' => $this->hitung_hari_audit($hari) );
	}

	public function get_raw_audit_days_single($type, $raw_audit_time, $jpa_length = null)
	{

		switch ($type) {
			case 'JPA-009':
				if( !isset($jpa_length) )
				{
					show_error('Kami membutuhkan parameter jumlah jpa.', 500);
				}
				$audit['detail']['raw_audit_time'] = $raw_audit_time;
				$audit['detail']['raw_days'] = $this->rumus_hitung_smp($raw_audit_time,  $jpa_length);
				break;
			case 'YQ-005':
				$audit['detail']['raw_audit_time'] = $raw_audit_time;
				$audit['detail']['raw_days'] = $this->rumus_hitung_smm($raw_audit_time);

				break;

			case 'JECA-004':
				$audit['detail']['raw_audit_time'] = $raw_audit_time;
				$audit['detail']['raw_days'] = $this->rumus_hitung_sml($raw_audit_time);
				break;

		}

		// waktu audit di bulatkan kebawah
		$audit_time = floor($audit['detail']['raw_days']);
		
		// jumlah auditor di bulatkan keatas / kebawah. (round)
		$fixed_auditor = round($audit['detail']['raw_days']);
		
		// jika audit time kurang dari 1 hari, jadikan satu hari. selain itu pakai jumlah hitungan hari
		$audit['detail']['audit_time'] 		= ($audit_time < 1)? 1 : $audit_time;
		// jika jumlah auditor yang bertugas kurang dari 2, jadikan 2. selain itu pakai jumlah hitungan auditor
		$audit['detail']['fixed_auditor'] 	= ($fixed_auditor < 2)? 2 : $fixed_auditor;

		return $audit;
	}
	/*
	|---------------------
	|Function get audit days when using conbine assessment
	|---------------------
	|
	| $this->get_raw_audit_days_combine();
	|
	*/
	public function get_raw_audit_days_combine()
	{
		$args_len = func_num_args();
		if($args_len < 2)
		{
			trigger_error('Bad request. fungsi ini hanya mengakomodir assessment combine');
			die();
		}

		$args = func_get_args();
		foreach ($args as $key => $value) {
			$data[$value['type']] = $value;
		}

		$type = array_map(function($res){
			return($res['type']);
		},$args);
		$uniqueType = array_unique($type);
		$jpa_length = array_filter($type, function($res){
			return($res=='JPA-009');
		});

		/*========== JECA && YQ =================*/
		if( in_array('JECA-004', $type) && 
			in_array('YQ-005', $type) 	&& 
			!in_array('JPA-009', $type) )
		{
			$sml_days = $data['JECA-004']['audit_time'];
			$smm_days = $data['YQ-005']['audit_time'];
			$detail['raw_audit_time'] = $this->rumus_hitung_sml_smm($sml_days, $smm_days);
		}
		// ---------------------------------------

		/*========== JPA && YQ =================*/
		elseif( in_array('JPA-009', $type) 	&& 
				in_array('YQ-005', $type) 	&& 
				!in_array('JECA-004', $type) )
		{
			$smm_days = $data['YQ-005']['audit_time'];
			$detail['raw_audit_time'] = $this->rumus_hitung_smm_smp($smm_days, count($jpa_length) );
		} 
		// ----------------E N D-----------------------
		
		/*========== JECA && JPA =================*/
		elseif(	in_array('JECA-004', $uniqueType) 	&& 
				in_array('JPA-009', $uniqueType) 	&& 
				!in_array('YQ-005', $uniqueType) )
		{
			$sml_days = $data['JECA-004']['audit_time'];
			$smp_days = $data['JPA-009']['audit_time'];
			
			$detail['raw_audit_time'] = $this->rumus_hitung_sml_smp($sml_days, $smp_days, count($jpa_length));
		}
		// ----------------E N D-----------------------
		
		/*========== JECA && YQ && JPA =================*/
		elseif( count($uniqueType) == 3 )
		{
			$sml_days = $data['JECA-004']['audit_time'];
			$smm_days = $data['YQ-005']['audit_time'];

			$detail['raw_audit_time'] = $this->rumus_hitung_smm_sml_smp($sml_days, $smm_days, count($jpa_length) );
		}
		// -----------------E N D----------------------
		$detail['audit_time'] = floor($detail['raw_audit_time']);
		return array('detail' => $detail, 'data' => $args);
	}


	
	
	/*
	|--------------
	| Get maximum days from arguments
	|--------------
	|
	| @params 
	| Jumlah terserah. yang penting array
	| cth = $this->get_max_days(array(1,2), array(2,3), array(3,4), ..., n);
	*/
	public function get_max_days()
	{
		// get args
		$args = func_get_args();
		
		// get the max
		$sum = 0;
		foreach ($args as $key => $value) {
			$sum = $sum + $value;
		}
		$sum_total = $sum/floor(sqrt($sum));

		// return value
		return array('sum' => $sum, 'total' => $sum_total);
	}
	/*
	|--------------
	| Get minimum auditors needed
	|--------------
	|
	| @params 
	| 
	| cth = $this->get_min_auditor(7,9,9,3,...,n);
	*/
	public function get_cover_auditor($audit_days, $sum_all)
	{
		return round( $audit_days/sqrt($sum_all) );
	}
	
	/*
	|--------------
	| Get efficiency auditors needed
	|--------------
	|
	| @params 
	| args[0] = @config_efficiency @array
	|	$config_audit['decimal']  = jumlah management system yang akan diaudit. 
	|	$config_audit['covered_system']  = jumlah management system yang akan diaudit. * required
	| 	
	| $args[1-n] = @config_audit @array 
	| 	$config_audit['qualified_length'] = jumlah kompetensi auditor yang sesuai dengan sistem yang akan diaudit.
	|
	| 
	| cth = $this->get_efficiency_audit(array('covered_system' => 2), array('qualified_length' => 1), array('qualified_length' => 3), array('qualified_length' => n));
	*/
	public function get_efficiency_audit()
	{
		$args = func_get_args();

		if( !isset($args[0]['covered_system']) )
		{
			trigger_error('Bad Request. covered system parameters is needed to count efficiency audit');
			die();
		}

		$args[0]['decimal'] = !isset($args[0]['decimal'])? 0 : $args[0]['decimal'];
		$auditor_len = func_num_args();
		$xSum = 0;
		foreach ($args as $key => $value) {
			if($key > 0)
			{
				$xSum = $xSum + ($value['qualified_length'] - 1);
			}
		}
		$sum = 100 * $xSum / $auditor_len * ($args[0]['covered_system']);
		return array('raw_efficiency' => $sum, 'percentage' => round($sum, $args[0]['decimal']));

	}

	/*
	|
	|
	|
	| @params
	| - id = (id_a0 / id_a0_cat )
	*/
	public function configure_audit_time($id, $isA0 = TRUE)
	{
		$this->load->model('certification_model');
		if( $isA0 == TRUE )
		{
			$a0 = $this->get_a0($id); 
		}else
		{
			$a0_cat = $this->data_a0_cat('*', array('id_a0_cat' => $id), 0);
			$a0 = $this->get_a0($a0_cat['id_a0']);
			$this->_helper_id_a0_cat = $id;
			$a0 = array_filter($a0['result'], function($res){
				return($res['id_a0_cat'] == $this->_helper_id_a0_cat);
			});
			$a0['result'] = $a0;
		}

		foreach ($a0['result'] as $key => $value) {
			$at 			= $this->certification_model->get_audit_time($value['company_employee'], $value['type'], $value['risk'])->row_array();
			$type[] 		= array('a0_cat' => $value['id_a0_cat'], 'type' => $value['type'], 'audit_time' => $at['audit_time']);
			$uniqueType[] 	= $value['type'];
		}
		$uniqueType = array_unique($uniqueType);
		if(count($uniqueType) < 2)
		{
			$a0_cat = $type[0];
			$jpaLen = count(array_filter($type, function($res){
				return($res == 'JPA-009');
			}) );

			$data 			= $this->get_raw_audit_days_single($a0_cat['type'], $a0_cat['audit_time'], $jpaLen);
			$data['data'][]	= array('a0_cat' => $a0_cat['a0_cat'], 'audit_time' => $data['detail']['audit_time'], 'auditor' => $data['detail']['fixed_auditor'], 'type' => $a0_cat['type']);

		}else
		{
			
			
			$data 	= call_user_func_array(array($this, 'get_raw_audit_days_combine'), $type);
			$cData 	= array_map(function($res){
				return($res['audit_time']);
			}, $type);
			$c 		= call_user_func_array(array($this, 'get_max_days'), $cData);
			$data['detail']['max_auditor'] 		= $c;
			$data['detail']['fixed_auditor'] 	= floor($c['total']);

			foreach ($data['data'] as $key => $value) {
				$data['data'][$key]['auditor'] 	= $this->get_cover_auditor($value['audit_time'], $data['detail']['max_auditor']['sum']);
			}
		}


		// print_r($data);
		return $data;
	}
	

}
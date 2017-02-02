<?php
/**
* 
*/
class Certification_model extends CI_Model
{
	private $send_email_assessment = TRUE;
	private $send_email_on_create_certificate = TRUE;

	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->library('dataakses');
		$this->load->database();

	}

	/*
	|---------------------
	| Get data certificate
	|---------------------
	*/
	public function data_certificate($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('certificate');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}

	/*
	|---------------------
	| Get data certificate
	|---------------------
	*/
	public function data_old_certificate($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('old_ref_certificate');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return $data;
	}
	public function add_existing_certification_a0_cat_detail_section__data_old_reference($arr_certificate)
	{
		$this->db->select('*');
		$this->db->from('old_ref_certificate');
		$this->db->where_in('id_certificate', $arr_certificate);
		$data = $this->db->get();
		return $data;
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
		return $this->db->get();
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
		return $this->db->get();
	}

	/*
	|---------------------
	| Get data audit_khusus
	|---------------------
	*/
	public function data_audit_khusus($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('a0_cat');
		$this->db->where(array('ref' => 'exist'));
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}

	/*
	|---------------------
	| Get data certification_type
	|---------------------
	*/
	public function data_certification_type($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('certification_type');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}

	/*
	|---------------------
	| Get data issued
	|---------------------
	*/
	public function data_issued($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('issued');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}

	/*
	|---------------------
	| Get data master_kelengkapan_permintaan
	|---------------------
	*/
	public function data_master_kelengkapan_permintaan($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('master_kelengkapan_permintaan');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return $data;
	}
	/*
	|---------------------
	| Get data kelengkapan_permintaan
	|---------------------
	*/
	public function data_kelengkapan_permintaan($select = '*', $where = array())
	{
		$this->db->select($select);
		$this->db->from('kelengkapan_permintaan_sertifikasi');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return $data;
	}
	/*
	|---------------------
	| Get data detail_kelengkapan_permintaan
	|---------------------
	*/
	public function data_detail_kelengkapan_permintaan($select = '*', $where = array())
	{
		$this->db->select($select);
		$this->db->from('detail_kelengkapan_permintaan_sertifikasi');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return $data;
	}

	/*
	|-------------------
	| GET audit time
	|-------------------
	| Parameters 
	| - employee @int 
	| - type_certification @string [JPA-009, JECA-004, YQ-005]
	| - risk @string [High, Medium High, Medium, Medium Low, Low]
	*/
	public function get_audit_time($employee, $type_certification, $risk)
	{
		$employee = (int)$employee;
		$sql = 'SELECT * FROM master_audit_time JOIN master_audit_time_certification USING(id_master_audit_time) JOIN master_risk ON master_audit_time_certification.`risk` = master_risk.`risk_level` WHERE type_certification = ? AND minimum_number_of_personnel <= ? AND risk = ? ORDER BY minimum_number_of_personnel DESC LIMIT 1 ';
		return $this->db->query($sql, array($type_certification, $employee, $risk) );
	}

	/*Certification CRUD*/

	/*
	* add new certification
	* requirement data
	* [name, use_period, resurvey_attempt, grace_period, expired_period, type, description(optional)]
	*/
	public function addNewCertification($data = array())
	{
		$data = array_merge( array('certification_description' => ''),  $data);
		$this->dataakses->SQL('INSERT INTO certification_category(name, use_period, resurvey_attempt, grace_period, expired_period, type, certification_description, certificate_title, certificate_note) values(?,?,?,?,?,?,?,?,?) ', 'siiiissss', $data['name'], $data['use_period'], $data['resurvey_attempt'], $data['grace_period'], $data['expired_period'], $data['type'], $data['certification_description'], $data['certificate_title'], $data['certificate_note'] );
	}

	/*
	|
	| Insert to old reference
	|
	Requirements
	- id_certificate @string, 
	- old_certificate @string
	*/
	public function insert_old_reference($data)
	{
		$this->dataakses->SQL('INSERT into old_ref_certificate(id_certificate, old_reference) values(?,?)','ss', $data['id_certificate'], $data['old_certificate']);
	}

	/*
	* remove certification
	*/
	public function rm_certification($audit_reference)
	{
		$this->dataakses->SQL("DELETE from certification_category where audit_reference = ?", 'i', $audit_reference);
	}

	/*
	* Update Certification
	*/
	public function update_certification($data_update, $where)
	{
		$this->db->update('certification_category', $data_update, $where); 
	}

	/*NACE CRUD*/

	/*
	* add new nace certification
	* requirement
	* [nace_item, nace_parent, nace_name, nace_type, ]
	*/
	public function addNewNace($data = array())
	{
		$data = array_merge(array('nace_parent' => 0), $data);
		$parentRecognizer = explode('.', $data['nace_parent']);
		$data['nace_type'] = '';

		switch (count($parentRecognizer)) {
			case 1:
			default:
				$data['nace_type'] = 'nace_category';
				break;
			case 2:
				$data['nace_type'] = 'nace_subcategory';
				break;
			case 3:
				$data['nace_type'] = 'nace_item';
				break;
		}

		$this->dataakses->SQL('INSERT INTO nace(nace_item, nace_parent, nace_name, nace_type, nace_added_time) values(?,?,?,?,?) ', 'sssss', $data['nace_item'], $data['nace_parent'], $data['nace_name'], $data['nace_type'], date('Y-m-d H:i:s'));

	} 

	public function get_nace_certificate($where = array())
	{
		if(count($where) > 0)
		{
			$query = $this->db->get_where('nace', $where);
		}else
		{
			$query = $this->db->get('nace');
		}
		return $query->result_array();
	}

	/*
	* remove nace certification
	*/
	public function rm_nace($where)
	{
		$this->db->delete('nace', $where); 
	}

	/*
	* update nace
	*/
	public function update_nace($data_update, $where )
	{
		$this->db->update('nace', $data_update, $where); 
	}


	/*
	* SCOPE Certification
	*/

	/*
	* function add new scope
	* requirements *type = array
	* [commodity_name, subcommodity]
	*/
	public function addNewScope($data = array())
	{
		if(count($data) > 0)
		{
			$this->dataakses->SQL('INSERT INTO commodity(commodity_name, subcommodity) values(?,?) ', 'ss', $data['commodity_name'], $data['subcommodity']);
		}
	}

	public function get_scope_certificate($where = FALSE )
	{
		if( $where !== FALSE)
		{
			$query = $this->db->get_where('commodity', $where);
		}else
		{
			$query = $this->db->get('commodity');
		}
		return $query->result_array();
	}

	/*
	* remove scope
	*/
	public function rm_scope($where)
	{
		$this->db->delete('commodity', $where); 
	}

	/*
	* update scope
	*/
	public function update_scope($data_update, $where)
	{
		$this->db->update('commodity', $data_update, $where); 

	}


	/*
	* PRODUCT LINE
	*/

	public function get_overall_product_line()
	{
		return $this->dataakses->SQL('SELECT product_line_id as product_line_id, product_line_parent, product_line_name, SNI as product_line_certificate, "" as product_line_number, "item" as product_line_type, product_line_note as note
			FROM `product_line`
			UNION
			SELECT product_line_subcategory.product_subcategory_id as product_line_id,  product_line_parent, product_line_subcategory.product_subcategory_name as product_line_name, "" as product_line_certificate, product_line_number, "subcategory" as product_line_item, "" as note
			from product_line_subcategory
			UNION
			SELECT product_line_category.product_category_id as product_line_id, 0 as product_line_parent, product_line_category.product_category_name as product_line_name, "" as product_line_certificate, product_line_number, "category" as product_line_item, "" as note
			from product_line_category');
		
	}

	// PRODUCT LINE //////////////////
	/*
	* function add new product line
	* requirements
	* [product_subcategory, product_line_name, certification_category_list, product_line_note, product_line_parent]
	*/
	public function addNewProductLine($data = array())
	{
		if( is_array($data['certification_category_list']) )
		{
			$data['certification_category_list'] = implode(',', $data['certification_category_list']);
		}

		$data['product_line_note'] = isset($data['product_line_note'])? $data['product_line_note'] : 0;

		$this->dataakses->SQL('INSERT INTO product_line(product_subcategory, product_line_name, SNI, product_line_note, product_line_parent) values(?,?,?,?,?)', 'sssss', $data['product_subcategory'], $data['product_line_name'], $data['certification_category_list'], $data['product_line_note'], $data['product_line_parent'] );
	}

	public function get_product_line_certificate()
	{
		$query = $this->db->get('product_line');
		return $query->result_array();
	}

	/*
	* function remove product line
	*/
	public function rm_product_line($where)
	{
		$this->db->delete('product_line', $where); 
	}

	/*
	* function update product line
	*/
	public function update_product_line($data_update, $where)
	{
		$this->db->update('product_line', $data_update, $where); 	
	}

	// PRODUCT LINE SUBCATEGORY

	/*
	* function to add new product_line_subcategory
	* requirement
	* [product_category_id, product_subcategory_name, product_line_number]
	*/
	public function addNewProductLineSubcategory($data = array())
	{
		if(is_array($data))
		{
			$this->db->trans_start();
			$this->db->query('INSERT INTO product_line_subcategory(product_category_id, product_subcategory_name, product_line_number, product_line_parent) values(?,?,?,?)',  array( $data['product_category_id'], $data['product_subcategory_name'], $data['product_line_parent'].'.'.$data['product_line_number'], $data['product_line_parent'] ) );
			$d0 = $this->db->insert_id();
			$this->db->trans_complete();
			// var_dump();
			
			if($this->db->trans_status() === FALSE)
			{
				header("HTTP/1.0 406 Data has been existed. check your product line number");
				return false;
			}else
			{
				$d0 = $this->certification_model->get_product_line_subcategory_certificate( array('product_subcategory_id' => $d0) );
				return $d0;
			}
		}
	}

	/*
	* function retrieved product line subcategory
	* optional
	* $where array
	*/
	public function get_product_line_subcategory_certificate($where = array())
	{
		if( count( $where ) < 1 )
		{
			$query = $this->db->get('product_line_subcategory');
			return $query->result_array();
		}else
		{
			$query = $this->db->get_where('product_line_subcategory', $where);
			return $query->row_array();
		}
	}

	/*
	* remove product_line_subcategory
	*/
	public function rm_product_line_subcategory($where = array())
	{
		if( is_array($data) )
		{
			$this->db->delete('product_line_subcategory', $where);
		}
	}

	/*
	* update product_line_subcategory
	*/
	public function update_product_line_subcategory($data_update, $where)
	{
		$this->db->update('product_line_subcategory', $data_update, $where);
	}

	/*
	* function product_line_category
	* requirement
	* [product_category_name, product_line_number]
	*/
	public function addNewProductLineCategory($data = array())
	{
		$this->db->trans_start();
			$this->db->query('INSERT into product_line_category(product_category_name, product_line_number) values(?,?)',  array( $data['product_category_name'], $data['product_line_number']) );
			$d0 = $this->db->insert_id();
			$this->db->trans_complete();
			// var_dump();
			
			if($this->db->trans_status() === FALSE)
			{
				header("HTTP/1.0 406 Data has been existed. check your product line number");
				return false;
			}else
			{
				$d0 = $this->get_product_line_category_certificate( array('product_category_id' => $d0) );
				return $d0;
			}

	}

	public function get_product_line_category_certificate($where = array())
	{
		if( count( $where ) < 1 )
		{
			$query = $this->db->get('product_line_category');
			return $query->result_array();
		}else
		{
			$query = $this->db->get_where('product_line_category', $where);
			return $query->row_array();
		}
	}

	/*
	* function remove product_line_category
	*/
	public function rm_product_line_category($where)
	{
		$this->db->delete('product_line_category' ,$where);
	}

	/*
	* function update product_line_category
	*/
	public function update_product_line_category($data_update, $where)
	{
		$this->db->update('product_line_category', $data_update, $where);	
	}

	////////////////////////////////////////////////////////////////////  G E T ///////////////////////////////////////////////////////////
	/*
	| ---------------------------
	| get certification category
	| ---------------------------
	*/
	public function get_certification_list()
	{
		return $this->dataakses->SQL('SELECT * FROM certification_category');
	}
	public function get_certification_category($where = array() )
	{
		if( count($where) > 0 )
		{
			$data = $this->db->get_where('certification_category', $where);
		}else
		{
			$data = $this->db->get('certification_category');
		}
		return $data->result_array();
	}

	/*
	| ------------------------------------------
	| get certificate list
	| ------------------------------------------
	*/

	public function get_certificate_list($certificate = '')
	{
		$q = 'SELECT a0_cat.*,  certificate.certificate_status, company.company_name  FROM a0_cat join a0 using(id_a0) join company using(id_company) join certificate using(id_a0_cat) ';
		if($certificate !== '')
		{
			$q .= ' certificate.id_certificate = "'.$certificate.'"';
		}

		$data = $this->dataakses->SQL($q);
		foreach ($data as $key => $value) {
			$data[$key]['issued_list'] = $this->dataakses->SQL('SELECT * from issued where id_certificate = "'.$value['id_certificate'].'"');
			$data[$key]['resurvey_list'] = $this->dataakses->SQL('SELECT * from issued join rs using(id_issued) left join rs_schedule using(id_rs_schedule) where issued.id_certificate = "'.$value['id_certificate'].'"');
		}
		return $data;
	}

	/*
	* get certification with Codeigniter database library. untuk kedinamisan data.
	* 
	*/
	public function get_certificate_dynamic($where = array(), $limit = null, $offset = null)
	{
		$this->load->database();
		
		$this->db->select('*');
		$this->db->from('certificate');
		$this->db->join('old_ref_certificate', 'old_ref_certificate.id_certificate = certificate.id_certificate', 'left');
		$this->db->join('a0_cat', 'a0_cat.id_certificate = certificate.id_certificate');
		$this->db->join('a0', 'a0.id_a0 = a0_cat.id_a0');
		$this->db->join('issued', 'issued.id_certificate = certificate.id_certificate');
		$this->db->join('company', 'company.id_company = a0.id_company');

		if( count($where) > 0 )
		{
			$this->db->where($where);
		}

		if( $limit !== null && $offset !== null )
		{
			$this->db->limit($limit, $offset);
		}

		return $this->db->get();
	}

	public function get_a0($id_a0 = 0)
	{
		$this->load->database();
		if($id_a0 == 0)
		{
			$query = $this->db->get('a0');
			return $query->result_array();
		}else
		{	
			$query = $this->db->get_where('a0', array('id_a0' => $id_a0) ); 
			return $query->row_array();
		}
	}

	public function get_a0_cat($id_a0_cat, $type)
	{
		$data = $this->dataakses->SQL('SELECT * FROM a0 join a0_cat using(id_a0) join certification_request using(id_a0_cat) join commodity using(id_commodity)  where id_a0_cat = '.$id_a0_cat);
		foreach ($data as $key => $value) {
			$this->dataakses->SQL('SELECT * FROM brand where id_brand = '.$value['id_brand']);
			$data[$key] = array_merge($data[$key], $this->dataakses->row_array());
		}
		// $data = $this->dataakses->SQL('SELECT a0_cat.*, commodity.*, brand.id_brand, brand.brand_name, brand.id_company, a0.id_a0, a0.token, a0.assessment_date, a0.a0_added_on, a0.changed_on, certification_request.*  FROM a0_cat join certification_request using(id_a0_cat) join commodity using(id_commodity) join a0 using(id_a0) left join brand using(id_brand) where id_a0_cat = '.$id_a0_cat);
		return $data;
	}

	public function get_SNI($certificate)
	{
		$data = $this->dataakses->SQL('SELECT * FROM certification_category where audit_reference = "'.$certificate.'"');
		return $this->dataakses->row_array();
	}

	public function get_rs_certificate($id_certificate)
	{
		return $this->dataakses->SQL('SELECT *, MAX(deadline_date) as expired_date FROM rs where id_issued = (SELECT id_issued from certificate join issued using(id_certificate) where id_certificate = ?)', 's', $id_certificate);
	}
	public function get_expired_certification($id_certificate)
	{
		$rs = $this->get_rs_certificate($id_certificate);
		return array_pop($rs);
	}
	public function getExpiredLatestResurvey($id_certificate)
	{
		$this->dataakses->SQL('SELECT * FROM rs where id_issued = (SELECT id_issued from certificate join issued using(id_certificate) where id_certificate = ?) and rs_status IS NULL order by deadline_date ASC limit 1', 's', $id_certificate);
		return $this->dataakses->row_array();
	}

	public function getUsedCertification($id_certificate)
	{
		$this->load->database();
		$query = $this->db->query('SELECT *
			from a0_cat 
			join certification_request using(id_a0_cat) 
			where a0_cat.id_certificate = ? ', array($id_certificate));
		$query = $query->result_array();

		$used = array();
		foreach ($query as $key => $value) {
			$nace = explode(',', $value['nace']);
			$scope = explode(',', $value['scope']);
			$productLine = explode(',', $value['product_line']);
			
			foreach ($nace as $a => $b) {
				if(!empty($b))
				{
					$used['nace'][] = $b;
				}
			}

			foreach ($scope as $a => $b) {
				if(!empty($b))
				{
					$used['scope'][] = $b;
				}
			}

			foreach ($productLine as $a => $b) {
				if(!empty($b))
				{
					$used['product_line'][] = $b;
				}
			}
		}

		return $used;
	}

	/*
	|--------------- 
	| Function to get single audit time
	|---------------
	| parameters
	| - risk @string
	| - day @int #from get_audit_time
	| - limit @int #from get_audit_time
	| *status used = unused
	*/
	public function audit_time_single($risk, $day, $limit = null)
	{
		$data = array();
		$data['master_day'] = $day;
		$data['discount'] = $risk.'%';
		$data['discounted_day'] = ceil($day*($risk/100) );
		$data['audit_days'] = $day - $data['discounted_day'];
		$data['onduty_length'] = 1+$data['audit_days']+1;
		if(isset($limit) && $data['audit_days'] < $limit)
		{
			$data['audit_days'] = $limit;
			$data['onduty_length'] = ceil(1+$limit+1);
		}
		$data['is_limit'] = isset($limit)? true : false;
		$data['limit_day'] = isset($limit)? $limit : 0;

		$data['auditor_can_be_used_after_days'] = $data['onduty_length'] + 1;
		return $data;
	}

	/*
	|--------------- 
	| Function to get collective audit time
	|---------------
	| parameters
	| - certification @array
	| 	- risk @string
	| 	- day @int #from get_audit_time
	| 	- limit @int #from get_audit_time

	*/
	public function audit_time_collective($certification)
	{
		$data = array('data' => array());
		$error = FALSE;
		foreach ($certification as $key => $value) {
			if(!isset($value['risk']) || !isset($value['day']) )
			{
				// array_push($data['data'], 'Parameter need risk and day. please check again your code!');
				$error = TRUE;
				continue;
			}
			$time = $this->audit_time_single($value['risk'], $value['day'], @$value['limit']);
			array_push($data['data'], $time);

		}

		if($error)
		{
			show_error('error, parameter required not found!', 500);
		}

		$data['combined_days'] = 0;
		foreach ($data['data'] as $key => $value) {
			$days = (@$value['limit'] > $value['audit_days'])? @$value['limit'] : $value['audit_days'];
			$data['combined_days'] = $data['combined_days'] + $days;
		}
		$average = $data['combined_days']/count($data['data']);
		$data['average'] = $average;
		$data['combine_audit_days'] = ceil($average);
		$data['total_duty_collective'] = 1+$data['combine_audit_days']+1;
		$data['auditor_can_be_used_after_days'] = $data['total_duty_collective']+1;

		return $data;
		
	}

	public function detail_existing_certification__data_surveilen($data)
	{
		return $this->dataakses->SQL('SELECT * FROM rs join rs_schedule using(id_rs_schedule) join issued using(id_issued) join certificate using(id_certificate) where id_a0_cat = ?', 's', $data['id_a0_cat']);
	}

	public function get_payment_requested_assessment($like = array())
	{
		$this->db->select('a0.*, a0_cat.*, status_paid, company_level, company_name, GROUP_CONCAT(a0_cat.`type`) AS permintaan, (SELECT count(id_invoice_detail) FROM invoice_detail where id_invoice = a0.id_invoice) as jumlah_nota ');
		$this->db->from('a0');
		$this->db->join('a0_cat', 'a0.id_a0 = a0_cat.id_a0');
		$this->db->join('company', 'a0.id_company = company.id_company');
		$this->db->join('invoice', 'a0.id_invoice = invoice.id_invoice');
		if( count($like) > 0 )
		{
			// $this->db->where(array('is_pay' => 1));
			$this->db->like($like);
		}

		$this->db->having('jumlah_nota > 0');
		$this->db->group_by(array("a0.id_a0"));
		$data = $this->db->get();
		return $data->result_array();
	}


	public function get_kelengkapan_sertifikasi_perusahaan($id_company, $id_permintaan_sertifikasi)
	{
		$master_docs = $this->data_master_kelengkapan_permintaan('*')->result_array();
		$master_detail = $this->db->query('SELECT * FROM kelengkapan_permintaan_sertifikasi join detail_kelengkapan_permintaan_sertifikasi using(id_permintaan_sertifikasi) where id_permintaan_sertifikasi = ?', array($id_permintaan_sertifikasi))->result_array();
		foreach ($master_docs as $a => $b) {
			foreach ($master_detail as $c => $d) {
				if($b['id_master_kelengkapan_permintaan'] == $d['id_master_kelengkapan_permintaan'])
				{

					foreach ($d as $e => $f) {
						if(!isset($master_docs[$a][$e]))
						{
							$master_docs[$a][$e] = $f;
						}
					}
				}else
				{
					foreach ($d as $e => $f) {
						if(!isset($master_docs[$a][$e]))
						{
							$master_docs[$a][$e] = NULL;
						}
					}
				}
			}
		}
		$master_client = array_filter($master_docs, function($res){
			return($res['peruntukan'] == 'perusahaan');
		});
		$master_ls = array_filter($master_docs, function($res){
			return($res['peruntukan'] == 'lsbbkkp');
		});


		$data['kelengkapan_permintaan_sertifikasi'] = $this->db->query('SELECT a.*, invoice.status_paid, a0.id_invoice, company.company_name, a0.a0_added_on, a0.assessment_date, a0.pass_the_review
			FROM kelengkapan_permintaan_sertifikasi a
			JOIN company USING(id_company)
			LEFT JOIN a0 USING(id_a0)
			LEFT JOIN invoice USING(id_invoice)
			where 
			a.id_company = ? and id_permintaan_sertifikasi = ? ', array($id_company, $id_permintaan_sertifikasi))->row_array();
		
		$data['detail_kelengkapan_permintaan_sertifikasi'] = $master_client;

		$data['detail_system'] = $master_ls;

		return $data;
	}
	////////////////////////////////////////////////////////////// E N D  G E T /////////////////////////////////////////////////////////
	
	/////////////////////////// I N S E R T ///////////////////////////////////
	/*
	|
	| public function insert certificate
	|
	@ parameters
	- id_a0_cat
	- new_status 
	- id_certificate (bisa dicari dari function draft_data_certificate dengan nama next_certificate)
	*/

	public function insert_new_certificate($data)
	{
		// insert new certificate
		$md5Certificate = md5($data['id_certificate'].'.'.$data['id_a0_cat']);
		$data['certificate_md5'] = $md5Certificate;
		$this->db->insert('certificate', $data);
	}

	// insert new issued
	public function insert_new_issued($data)
	{
		$this->db->insert('issued', $data);
		return $this->db->insert_id();
	}

	// insert rs
	public function insert_rs($data)
	{
		$this->db->insert('rs', $data);
		return $this->db->insert_id();
	}

	// insert rs schedule
	public function insert_rs_schedule($data)
	{
		$this->db->insert('rs_schedule', $data);
		return $this->db->insert_id();
	}

	public function insert_master_requirement_data_kelengkapan_dokumen($data)
	{
		$this->db->insert('master_kelengkapan_permintaan', $data);
		return $this->db->insert_id();
	}

	public function insert_detail_requirement_data_kelengkapan_dokumen($data)
	{
		$this->db->insert('detail_kelengkapan_permintaan_sertifikasi', $data);
		return $this->db->insert_id();
	}
	

	///////////////////////////////////////////// COMPANY ADD CERTIFICATION ////////////////////////////////////////

	/*
	* params
		- id_brand i
		- certification []
	*/
	public function save_certification_company($data)
	{
		$this->load->library('hash');
		if( is_array($data) == FALSE )
		{
			exit('data required an array in save certification company');
		}
		$this->dataakses->commitOff();
		$this->save_a0($data);

		// save into sertification progress
		$this->save_certification_detail($data);
		$this->dataakses->commitOn();

		$this->send_email_assessment_date($data['id_company'], $this->a0_id);
	}

	/*
	* insert auditor khusus
	* auditor khusus = tambah brand / tambah jeca / tambah yq
	*/
	public function audit_khusus($data)
	{
		$this->load->model('company_model');

		$this->dataakses->commitOff();
		$this->save_a0($data['id_company']);
		switch ( $data['type'] ) {
			case 'JECA-004':
				# code...
				$a0_cat = $this->save_a0_cat($this->a0_id, 'JECA-004');
				$this->save_certification_JECA($data['JECA-004'], $a0_cat, $data['certificateTarget']);

				break;

			case 'YQ-005':
				# code...
				$a0_cat = $this->save_a0_cat($this->a0_id, 'YQ-005');
				$this->save_certification_YQ($data['YQ-005'], $a0_cat, $data['certificateTarget']);

				break;
			
			case 'JPA-009':
				# code...

				foreach ($data['JPA-009']['brand'] as $a1 => $a2) {
					$a2['id_company'] = $data['id_company'];

					foreach ($a2['item'] as $b1 => $b2) {
						$insertID = $this->company_model->add_brand($data['id_company'], $b2, '');
						$a2['brand'][$b1] = $insertID;
					}
					
					$a0_cat = $this->save_a0_cat($this->a0_id, 'JPA-009', $data['certificateTarget']);
					
					$this->save_certification_JPA($data['JPA-009'], $a2, $a0_cat);
				}
				break;
		}
		$this->dataakses->commitOn();

	}

	/*
	* new certification system
	*requirements $_POST
	* data certificateTarget can be null.
	*/
	public function pre_save_certification($data)
	{
		$this->load->model('company_model');
		// jika tidak ada sertifikasi berarti audit khusus
		if(!isset($data['sertifikasi']))
		{
			$data['sertifikasi'] = $this->pre_audit_khusus($data);
		}
		$sertification_item = array();
		
		$this->db->trans_begin();
		
		$this->save_a0($data['id_company']);

		foreach ($data['sertifikasi'] as $key => $value) {
			$request = $this->save_certification($value, $data['id_company']);
			if(!empty($request) )
			{
				$sertification_item[] = $request;
			}
		}

		if(!$this->db->trans_status())
		{
			$this->db->trans_rollback();
			header('http/1.0 500 error on save request');
		}else
		{
		    $this->db->trans_commit();
		}

		// INSERT KELENGKAPAN PERMINTAAN SERTIFIKASI
		$pengajuan = $this->insert_pengajuan_kelengkapan_dokumen( array('id_a0' => $this->a0_id, 'id_company' => $data['id_company']) );
		$id_pengajuan = $pengajuan->insert_id();
		return array('id_permintaan_sertifikasi' => $id_pengajuan, 'id_company' => $data['id_company'], 'a0_id' => $this->a0_id , 'sertification_requested' => $sertification_item, 'data' => $data);

	}

	private function pre_audit_khusus($data)
	{
		$a  = array();
		foreach ($data as $key => $value) {
			if(is_array($value))
			{
				$value['type'] = $key;
				$value['certificateTarget'] = $data['certificateTarget'];
				if($value['is_self_announcement'] === 'false')
				{
					$a[] = $value;	
				}
			}
		}
		
		return $a;
	}

	public function save_certification($data, $id_company)
	{

		if( $data['type']==='JECA-004' && $data['is_self_announcement'] == "false")
		{
			$a0_cat = $this->save_a0_cat($this->a0_id, 'JECA-004', @$data['certificateTarget']);
			$this->save_certification_JECA($data, $a0_cat);
			return $a0_cat;
		}

		if(  $data['type']==='YQ-005' && $data['is_self_announcement'] == "false")
		{
			$a0_cat = $this->save_a0_cat($this->a0_id, 'YQ-005', @$data['certificateTarget']);
			$this->save_certification_YQ($data, $a0_cat);
			return $a0_cat;
		}


		// $brand = [];
		if( $data['type'] == 'JPA-009' && $data['is_self_announcement'] == "false" )
		{

		// 	$dataBrand = [];
			$a0_cat = $this->save_a0_cat($this->a0_id, 'JPA-009', @$data['certificateTarget']);
			if( count($data['brand']) > 0 )
			{
				foreach ($data['brand'] as $a1 => $a2) {
					$a2['id_company'] = $id_company;
					// simpan lampiran 
					$lampiranContent = $a2['lampiran']; $idLampiran = null;
					if($lampiranContent !== '')
					{
						$idLampiran = $this->save_lampiran($lampiranContent);
					}

					// explode brand name
					$brandname = explode(',', $a2['brand_name']);
					foreach ($brandname as $key => $value) {
						// save brand item
						$insertID = $this->company_model->add_brand($a2['id_company'], $value, '');
						$this->save_certification_JPA($data, $a0_cat, $insertID, $idLampiran);
					}
					
				}

			return $a0_cat;
			}
			//else
			// {
				// $this->save_certification_JPA($data['JPA-009'], $a0_cat);
			// }

		}


	}

	/*
	# save a0
	* function to insert data a0 and update token.
	# requirements
	  - id_company

	# function status : used
	*/
	public function save_a0($id_company)
	{
		$this->load->library('hash');
		$a0_added_on = date('Y-m-d H:i:s');
		$this->db->query('insert into a0 (id_company, a0_added_on) values (?,?)' ,  array($id_company, $a0_added_on) );

		$this->a0_id = $this->db->insert_id();
		// create hash
		$hashKey = base64_encode($id_company.'.'.$this->a0_id);
		$this->hash_company = $this->hash->encrypt($hashKey);

		// update hash
		$this->db->query('Update a0 set token="'.$this->hash_company.'" where id_a0='.$this->a0_id);

		return $this->a0_id;
	}

	/*
	* fungsi ini nantinya di foreach berdasarkan audit_reference;
	# requrements
	  - type [JPA-009 / JECA-004 / YQ-005]
	*/
	public function save_a0_cat($a0_id = null, $type, $certificate = NULL)
	{
		$a0_id = isset($a0_id)? $a0_id : $this->a0_id;
		if( !isset($certificate) || is_null( $certificate ) || empty($certificate) )
		{
			$res = $this->db->query('insert into a0_cat (id_a0, type, added_time) values (?,?,?)', array( $a0_id, $type, date('Y-m-d H:i:s') ) );
		}else
		{
			$res = $this->db->query('insert into a0_cat (id_a0, type, ref, id_certificate, added_time) values (?,?,?,?,?)', array( $a0_id, $type, 'exist', $certificate, date('Y-m-d H:i:s')) );
		}
		$this->a0_cat = $this->db->insert_id();
		return $this->a0_cat;
	}


	public function save_certification_JPA($jpa, $a0_cat, $brand = 0, $idLampiran = null)
	{

			
		$scope 	= '';//(isset($jpa['scope']) && is_array($jpa['scope']) && count($jpa['scope']) > 0)? implode(',', $jpa['scope']) : '';

		$nace 	= '';//(isset($jpa['nace']) && is_array($jpa['nace']) && count($jpa['nace']) > 0)? implode(',', $jpa['nace']) : '';
		
		$jpa['notes'] = implode('|', explode(',', $jpa['notes']) );

		$product_line 	= (isset($jpa['product_line']) && is_array($jpa['product_line']) && count($jpa['product_line']) > 0 ) ? implode(',', $jpa['product_line']) : $jpa['product_line'];
		$product_line 	= !empty($jpa['notes']) || $jpa['notes'] !== ''? $product_line.'.'.$jpa['notes'] : $product_line;
		
		$certification 	= (isset($jpa['certification']))? implode(',', $jpa['certification']) : '';

		$risk = isset($data['risk'])? $data['risk'] : 'Low';

		$this->save_certification_request( $a0_cat, $certification, $brand, $scope, $nace,  $product_line, $idLampiran );

		
	}


	public function save_certification_JECA($data, $a0_cat, $idLampiran = NULL)
	{

		$scope 			= (isset($data['scope']) && is_array($data['scope']) && count($data['scope']) > 0 ) 	? implode(',', $data['scope']) : '';
		$nace 			= '';//(isset($data['nace']) && is_array($data['nace']) && count($data['nace']) > 0 ) 		? implode(',', $data['nace']) : '';

		$product_line 	= (isset($data['product_line']) && is_array($data['product_line']) && count($data['product_line']) > 0 ) 		? implode(',', $data['product_line']) : '';
		$certification 	= (isset($data['certification']) && !empty($data['certification']) && is_array($data['certification']) && count($data['certification']) > 0 ) 	? implode(',', $data['certification']) :  '';
		
		$risk = isset($data['risk'])? $data['risk'] : 'Low';

		$this->save_certification_request( $a0_cat, $certification, 0, $scope, $nace, $product_line );

	}

	public function save_certification_YQ($data, $a0_cat, $idLampiran = NULL)
	{

		$scope 			= (isset($data['scope']) && is_array($data['scope']) && count($data['scope']) > 0 ) ?  implode(',', $data['scope']) : '';
		$nace 			= (isset($data['nace']) && is_array($data['nace']) && count($data['nace']) > 0 ) 	?  implode(',', $data['nace']) : '';
		$product_line 	= '';//(isset($data['product_line']) && is_array($data['product_line']) && count($data['product_line']) > 0 ) ?  implode(',', $data['product_line']) : '';
		$certification 	= (isset($data['certification']) && is_array($data['certification']) && count($data['certification']) > 0 ) 	? implode(',', $data['certification']) :  '';
		
		$risk = isset($data['risk'])? $data['risk'] : 'Low';

		$this->save_certification_request( $a0_cat, $certification,  0, $scope, $nace, $product_line );

	}


	/*
	* function save certification request
	# requirements
	  - id a0_cat
	  - audit_reference
	  - id_brand : !isset == 0;
	  - id_commodity
	  - subcommodity
	*/
	public function save_certification_request($a0_cat, $audit_reference, $id_brand = 0, $scope, $nace, $product_line, $id_lampiran = NULL, $risk = 'Low' )
	{
		$this->db->query('insert into certification_request (id_a0_cat, audit_reference, id_brand, scope, nace, product_line, id_lampiran) values (?,?,?,?,?,?,?)', array( $a0_cat, $audit_reference, $id_brand, $scope, $nace, $product_line, $id_lampiran) );
		return $this->db->insert_id();
	} 

	/*
	|
	|
	|
	*/
	public function save_lampiran($content)
	{
		$this->dataakses->SQL('INSERT into lampiran(content_lampiran) values (?) ', 's', $content);
		$idLampiran = $this->dataakses->insert_id();
		$md5 = md5('lampiran.'.$idLampiran);

		$this->dataakses->SQL('UPDATE lampiran set lampiran_token = ? where id_lampiran = ? ', 'si', $md5, $idLampiran);
	
		// $this->db->where('id_lampiran', $idLampiran);
		// $this->db->update('lampiran', array('lampiran_token' => $md5 )); 
		
		return $idLampiran;
	}

	/*
	* function send email assessment date to related company
	*/
	public function send_email_assessment_date($idcompany, $a0_id, $data)
	{
		$this->load->model('tools');
		$this->load->model('company_model');
		$datacompany 	= $this->company_model->get_company($idcompany);
		$a0 			= $this->get_a0($a0_id);
		$token 			= $this->tools->encode_token_link($a0['token']);

		$url 		= site_url('assessment/confirmation/'.$a0_id.'/'.$token);
		$subject 	= 'Confirmation Assessment date';
		
		
		$time = strtotime( date('Y-m-d H:i:s') );
		$mailRef = '<div style="display:none;">#ref '.$time.'</div>';
		$companyName = $datacompany['company_name'];
		$mailContent = $this->load->view('templates/email/template--email-info--request-new-certification',array('companyName' => $companyName, 'timestamp' => $time),true);

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Yoqa Costumer Service <costumer.service@yoqa.com>' . "\r\n";

		
		if($this->send_email_assessment===TRUE)
		{
			if( !mail( $datacompany['email'], $subject, $mailRef.$mailContent.$mailRef, $headers) )
			{
				show_error('send email to coordinator is unsuccessfull. please check your code!',500);
				header("HTTP/1.0 500 send email to coordinator is unsuccessfull. please check your code!");
			}
		}

		$this->save_email_log($a0_id, $datacompany['email'], $subject, $mailContent);

	}

	/*
	* save email log and update email_log_id in a0

	*/
	public function save_email_log($id, $recipients, $subject, $mailContent, $type = 'newassessment')
	{
		$this->dataakses->SQL('INSERT into email_log(email_recipients, email_subject, email_text) values(?,?,?)', 'sss', $recipients, $subject, $mailContent);
		$mailid = $this->dataakses->insert_id();
		switch ($type) {
			case 'newassessment':
				# code...
				$this->dataakses->SQL('UPDATE a0 set email_log_id = '.$mailid.' where id_a0 = '.$id);
				break;
			case 'collective':
				$this->dataakses->SQL('UPDATE assessment_collective set email_log_id = '.$mailid.' where id_assessment_group = '.$id);
				
				break;

			case 'reassessment':
				$this->dataakses->SQL('UPDATE rs_schedule set email_log_id = '.$mailid.' where id_rs_schedule = '.$id);

				break;	
			default:
				# code...
				break;
		}
		
	}
	
	///////////////////////////////////////////// END COMPANY ADD CERTIFICATION ////////////////////////////////////////

	/*
	* update certification
	* params
	* 1. array( $id_a0_cat @int, $new_status @[success, fail, process, remidial], $explanation @string, $type @['YQ','JECA','JPA'])
	*/
	public function create_certificate($data)
	{

		/*batalkan jika tidak ada status yang dipilih*/
		if(empty($data['new_status']))
		{
			header("HTTP/1.0 500 Silahkan pilih salah satu status!");
			return false;
		}
		//////////////////////////////////////////////

		$this->load->model('assessment_model');
		$this->load->model('company_model');
		$this->load->model('tools');
		$this->load->database();

		// /*get specific company*/
		$a0_cat 		= $this->assessment_model->detail_a0_cat($data['id_a0_cat']);
		$a0 			= $this->assessment_model->data_a0('*', array('id_a0'=> $a0_cat['id_a0']), 1);
		$certificate 	= $this->draft_data_certificate( $a0_cat );
		$company 		= $this->company_model->get_company($a0_cat['id_company']);
		$mailContent	= '';
		$resurvey = $this->resurvey_counter($data['type']);

		$result = array();

		if(!empty($data['explanation']))
		{

			/*
			# I N S E R T  N O T E S ///////////////////////////////////////////////////////////////
			* requirement
				- id_a0_cat *
				- explanation *
				- new status *
				- attachment 
				- notes_for_type

				* mean required
			*/
			$this->load->model('notes_model');
			$dataNotes = array(  
				'id_company' 			=> $a0_cat['id_company'],
				'notes_reference_id' 	=> $data['id_a0_cat'],
				'notes_for_type' 		=> 0,
				'explanation' 			=> $data['explanation'],
				'new_status' 			=> $data['new_status'],
			);

			$this->notes_model->create_confirmation_assessment_notes($dataNotes, $_FILES);
			////////////////////////////////////////////////////////////////////////////////////////

		}

		/*jika referensi exist / audit khusus.*/
		if($a0_cat['ref'] == 'exist')
		{
			// UPDATE id certificate in a0_cat
			$this->dataakses->SQL('UPDATE a0_cat set status="'.$data['new_status'].'" where id_a0_cat= '.$data['id_a0_cat']);
			switch ($data['new_status']) {
				case 'success':
					$this->create_certificate_pdf( $data['id_a0_cat'] );
					

					$mailContent = '<div>Yth, Perusahaan '.$company['company_name'].'</div>
					<div>Dengan Datang nya email ini, kami memberitahukan bahwa berdasarkan hasil Sertifikasi yang telah dilakukan pada '.$a0['assessment_date'].', kami dari LSBBKKP telah mengesahkan Audit Khusus anda dengan status :  </div> <br> <center><span style="padding:10px; background:#4285f4;color:white;text-decoration: none;"> '.$data['new_status'].' </span></center>
					<p>Anda dapat melihat sertifikat dan mendownload nya anda melalui tautan berikut : <a href="'.site_url('certification/view/'.md5(uniqid()).'/'.$a0_cat['id_a0_cat']).'"> Lihat Sertifikat </a> </p>
					';
					break;

				case 'fail':
					$mailContent = '<div>Yth, Perusahaan '.$company['company_name'].'</div>
					<div>Dengan Datang nya email ini, kami memberitahukan bahwa berdasarkan hasil Sertifikasi yang telah dilakukan pada '.$a0['assessment_date'].', kami dari LSBBKKP telah mengesahkan Audit Khusus anda dengan status :  </div> <br> <center><span style="padding:10px; background:#4285f4;color:white;text-decoration: none;"> '.$data['new_status'].' </span></center>
					<p>Silahkan hubungi LSBBKKP untuk keterangan lebih lanjut!</p>
					';
					break;
				case 'remidial': 
					$mailContent = '<div>Yth, Perusahaan '.$company['company_name'].'</div>
					<div>Dengan Datang nya email ini, kami memberitahukan bahwa berdasarkan hasil Sertifikasi yang telah dilakukan pada '.$a0['assessment_date'].', kami dari LSBBKKP telah mengesahkan Audit Khusus anda dengan status :  </div> <br> <center><span style="padding:10px; background:#4285f4;color:white;text-decoration: none;"> '.$data['new_status'].' </span></center>
					<p> Silahkan anda perbaiki kekurangan dari sistem anda. dan hubungi LSBBKKP untuk melakukan assistensi. </p>
					';
					break;
			}
		}else
		{

			/*
			jika status yang baru adalah success
			*/
			switch ($data['new_status']) {
				case 'success':
					
					$this->dataakses->commitOff();

					$this->load->model('company_model');

					$data['certificate_note'] = isset($data['certificate_note'])? $data['certificate_note'] : '';

					// insert new certificate
					$md5Certificate = md5($certificate['next_certificate'].'.'.$data['id_a0_cat']);

					$this->dataakses->SQL('INSERT INTO certificate (id_certificate, id_a0_cat, certificate_md5, certificate_note) values (?,?,?,?)', 'siss', $certificate['next_certificate'], $data['id_a0_cat'], $md5Certificate, $data['certificate_note']);

					// UPDATE id certificate in a0_cat
					$this->dataakses->SQL('UPDATE a0_cat set id_certificate="'.$certificate['next_certificate'].'", status="'.$data['new_status'].'" where id_a0_cat= '.$data['id_a0_cat']);

					// issued certificate
					$this->dataakses->SQL('INSERT INTO issued (id_certificate, issued_date) values (?,?)', 'ss', $certificate['next_certificate'], date('Y-m-d'));
					
					$this->issued_id = $this->dataakses->insert_id();
					
					// create plan resurvey 
					
					$data['issued'] = date('Y-m-d');

					foreach ($resurvey as $key => $value) {
						# code...
						$roman = $this->tools->romanic_number($value['resurvey_counter']);
						$this->dataakses->SQL('INSERT INTO rs (id_issued, deadline_date, rs_description) values (?,?,?)', 'iss', $this->issued_id, $value['resurvey_date'], $roman);
					}
		
					// end of is ref is not 'exist'
					$this->dataakses->commitOn();

					// dc1 = dir clients #1
					$dc1 = $this->company_model->folder_company($a0_cat['id_company']);

					if($dc1['is_dir'] === TRUE)
					{
						
						$this->create_certificate_pdf( $data['id_a0_cat'] );

					}
					$mailContent = '<div>Yth, Perusahaan '.$company['company_name'].'</div>
					<div>Dengan Datang nya email ini, kami memberitahukan bahwa berdasarkan hasil Sertifikasi yang telah dilakukan pada '.$a0['assessment_date'].', kami dari LSBBKKP telah mengesahkan sertifikasi anda dengan status :  </div> <br> <center><span style="padding:10px; background:#4285f4;color:white;text-decoration: none;"> '.$data['new_status'].' </span></center>
					<p>Anda dapat melihat sertifikat dan mendownload nya anda melalui tautan berikut : <a href="'.site_url('certification/view/'.$md5Certificate.'/'.$a0_cat['id_a0_cat']).'"> Lihat Sertifikat </a> </p>
					';
					break;
				case 'fail':
					$mailContent = '<div>Yth, Perusahaan '.$company['company_name'].'</div>
					<div>Dengan Datang nya email ini, kami memberitahukan bahwa berdasarkan hasil Sertifikasi yang telah dilakukan pada '.$a0['assessment_date'].', kami dari LSBBKKP telah mengesahkan sertifikasi anda dengan status :  </div> <br> <center><span style="padding:10px; background:#4285f4;color:white;text-decoration: none;"> '.$data['new_status'].' </span></center>
					<p>Silahkan hubungi LSBBKKP untuk keterangan lebih lanjut!</p>
					';
					break;
				case 'remidial': 
					$mailContent = '<div>Yth, Perusahaan '.$company['company_name'].'</div>
					<div>Dengan Datang nya email ini, kami memberitahukan bahwa berdasarkan hasil Sertifikasi yang telah dilakukan pada '.$a0['assessment_date'].', kami dari LSBBKKP telah mengesahkan sertifikasi anda dengan status :  </div> <br> <center><span style="padding:10px; background:#4285f4;color:white;text-decoration: none;"> '.$data['new_status'].' </span></center>
					<p> Silahkan anda perbaiki kekurangan dari sistem anda. dan hubungi LSBBKKP untuk melakukan assistensi. </p>
					';
					break;
				default:
					# code...
					$this->dataakses->SQL('UPDATE a0_cat set status="'.$data['new_status'].'" where id_a0_cat= '.$data['id_a0_cat']);
					break;
			}

		} 
			


			// send email after confirmation

			$companyName 	= $company['company_name'];
			$time 			= strtotime( date('Y-m-d H:i:s') );
			$mailRef 		= '<div style="display:none;">#ref '.$time.'</div>';

			
			if( isset($data['explanation']) && $data['explanation'] !== '' )
			{
				$mailContent .= '<div style="padding-top: 10px;padding-bottom: 10px; padding-left: 4px; border-left: solid 2px #eee;"> <strong> Dengan Catatan </strong> : <br>'.$data['explanation'].'</div>';
			}

			

			if($this->send_email_on_create_certificate===TRUE)
			{

				/*send email*/
				$this->load->library('mail');
				$this->mail->from('LSBBKKP Costumer Services', 'LSBBKKP.services@LSBBKKP.com');
				$this->mail->replyTo('noreply@LSBBKKP.com');
				$this->mail->subject('Pemberitahuan Hasil assessment');
				$this->mail->to($company['email']);
				$this->mail->message($mailContent);

				if(!$this->mail->send() )
				{
					show_error('send email to coordinator is unsuccessfull. please check your code!',500);
					header("HTTP/1.0 500 send email to coordinator is unsuccessfull. please check your code!");
				};

				
			}else
			{
			}
			$this->dataakses->commitOn();



		return $certificate;
	}

	/*fungsi untuk menjalankan pengiriman email saat create sertificate*/
	public function send_email_for_create_certificate()
	{
		
		
	}

	protected function issued_certificate($data)
	{

		$this->dataakses->SQL('INSERT INTO issued (id_certificate, issued_date) values (?,?)', 'ss', $data['next_certificate'], date('Y-m-d'));
		$this->issued_id = $this->dataakses->insert_id();

	}

	// RESURVEY ///////////////////
	public function resurvey_date($data)
	{

		$data['issued'] = date('Y-m-d');
		$counter = $this->resurvey_counter($data);
		foreach ($counter as $key => $value) {
			# code...
			$this->dataakses->SQL('INSERT INTO rs (id_issued, deadline_date) values (?,?)', 'is', $this->issued_id, $value['resurvey_date']);
		}

	}

	protected function resurvey_schedule($data)
	{
		$this->load->library('hash');
		if( is_array($data) == FALSE )
		{
			exit('data required an array in save certification company');
		}

		// base64 encode certificate e.g base64_encode(JPA-009/1); 
		$hashKey = base64_encode($data['certificate']);
		$this->hash_rs = $this->hash->encrypt($hashKey);
		
		
		$this->dataakses->SQL('INSERT INTO rs_schedule (token) values (?)', 's', $this->hash_rs);
		$this->rs_schedule = $this->dataakses->insert_id();

	}

	/*
	* resurvey counter
	* - $id_a0_cat
	* - $issued
	*/
	public function resurvey_counter($type)
	{
		$data 	= $this->db->get_where('certification_type', array('type' => $type) );
		$data 	= $data->row_array();

		$issued = isset($data['issued'])? $data['issued'] : date('Y-m-d');
		$rasio = ($data['use_period'] - $data['grace_period'])/$data['resurvey_attempt'];
		$return = array();

		for ($i=1; $i <= $data['resurvey_attempt'] ; $i++) { 

			$resurveyCount = floor($i*$rasio); // floor atau ceil?
			$resurveyDate = date( 'Y-m-d', strtotime( '+'.$resurveyCount.' months', strtotime($issued) ));
			array_push( $return, array('resurvey_counter' => $i, 'resurvey_date' => $resurveyDate) );
		}
		return $return;
	}
	/*
	|
	|
	|
	*/
	function resurvey_creator($data)
	{
		$issued = isset($data['issued'])? $data['issued'] : date('Y-m-d');
		$rasio = ($data['use_period'] - $data['grace_period'])/$data['resurvey_attempt'];
		$return = array();

		for ($i=1; $i <= $data['resurvey_attempt'] ; $i++) { 

			$resurveyCount = floor($i*$rasio); // floor atau ceil?
			$resurveyDate = date( 'Y-m-d', strtotime( '+'.$resurveyCount.' months', strtotime($issued) ));
			array_push( $return, array('resurvey_counter' => $i, 'resurvey_date' => $resurveyDate) );
		}
		return $return;
	}

	public function resurvey_generator_for_existing_certification($tanggal_terbit, $tanggal_berakhir, $type)
	{
		$data 	= $this->db->get_where('certification_type', array('type' => $type) );
		$data 	= $data->row_array();

		// JADIKAN SECONDS
		$_config['tglTerbitStr'] 		= strtotime($tanggal_terbit);
		// JADIKAN SECONDS
		$_config['tglBerakhirStr'] 		= strtotime($tanggal_berakhir);
		// BUAT VARIABLE TANGGAL SEKARANG
		$_config['tglSekarang'] 		= date('Y-m-d H:i:s');
		// CARI SECOND DARI TANGGAL TERBIT PERTAMA KALI DAN TANGGAL SELESAI PALING TERAKHIR
		$_config['tglBetween'] 			= $_config['tglBerakhirStr'] - $_config['tglTerbitStr'];
		// JADIKAN FORMAT BULAN
		$_config['tglBetween_inMonths'] = floor( $_config['tglBetween'] / (60*60*24*30) );
		// HITUNG JUMLAH RESURVEY_ATTEMPT BERDASARKAN TYPE
		$_config['resurvey_attempt'] 	= ( floor( $_config['tglBetween_inMonths'] / $data['use_period'] ) ) * $data['resurvey_attempt'];

		// ---- BAGIAN DATA YANG AKAN DI PARSING JADI DATA SURVEILEN ------
		$_data['use_period'] 		= $_config['tglBetween_inMonths'];
		$_data['resurvey_attempt'] 	= $_config['resurvey_attempt'];
		$_data['grace_period'] 		= $data['grace_period'];
		$_data['expired_period'] 	= $data['expired_period'];
		$_data['issued'] 			= $tanggal_terbit;
		

		$rs = $this->resurvey_creator($_data);
		
		$m = 1;
		foreach ($rs as $key => $value) {
			$_rs[$m][] = $value;
			if(count($_rs[$m]) == $data['resurvey_attempt'])
			{
				$m++;
			}

		}

		return $_rs;

	}

	/*
	* function to get max certificate based on type.
	* and return some array might usefull for next process.
	*/
	public function draft_data_certificate($data)
	{
		$result = array();
		$this->dataakses->SQL('SELECT certificate.id_certificate FROM certificate join a0_cat using(id_a0_cat) where type = "'.$data['type'].'"');
		$certificate 	= $this->dataakses->row_array();
		
		// full data certificate
		$a0 = $this->dataakses->result_array();

		if(count($a0) > 0)
		{

			// create new array
			$a1 = array();

			foreach ($a0 as $key => $value) {
				$id = explode('/', $value['id_certificate']);
				$id = array_pop($id);
				$id = (int)$id;
				array_push($a1, $id);
			}

			// sort 
			sort($a1);

			// get latest 
			$a1 = array_pop($a1);

			$result['last'] = $a1;
		}else
		{
			$result['last'] = 0;
		}


		// jika null, maka di isi 0
		// $certificate['current_certificate'] = is_null($certificate['current_certificate'])? $data['type'].'/0' : $certificate['current_certificate'];

		// $x = explode('/', $certificate['current_certificate']);
		// $type = $x[0];
		// $id = $x[1];
		// $next_id = $id+1;

		$next_id = $result['last'] + 1;


		$result['next_certificate_id'] = $next_id;
		$result['next_certificate'] = $data['type'].'/'.$next_id; // e.g JPA-005/1

		return $result;
	}

	/*//////////////////// GET CERTIFICATIOn ACTIVE ///////////////////*/

	/*
	* get certification status == active based on data id company
	*
	* function status: used
	*/
	public function get_certification_active_in_company($data)
	{
		return $this->db->query('SELECT 
			MAX(certificate.id_certificate) AS no_certificate, 
			GROUP_CONCAT(name) AS certification_requested,
			name, 
			certificate_status, 
			issued_date, 
			audit_reference, 
			certificate_md5, 
			a0.*,
			kelengkapan_permintaan_sertifikasi.*,
			a0_cat.id_a0_cat, 
			certification_category.type 
			
		FROM a0_cat 
		LEFT JOIN certificate USING(id_certificate) 
		JOIN a0 USING(id_a0) 

		JOIN company USING(id_company) 
		JOIN certification_request ON certification_request.`id_a0_cat` = a0_cat.`id_a0_cat`
		JOIN certification_category USING(audit_reference) 
		LEFT JOIN issued ON certificate.id_certificate = issued.id_certificate 
		JOIN kelengkapan_permintaan_sertifikasi USING(id_a0)
		WHERE 
		a0.`pass_the_review` = 1 AND 

		(certificate_status != "revoke" OR certificate_status != "resign") 
		OR (a0_cat.`status` != "fail" )
		AND a0.`assessment_date` IS NOT NULL 

		AND a0.id_company = ? GROUP BY TYPE, a0.id_a0
		ORDER BY a0.id_a0',  array($data['id_company']) );
	}

	/*
	* ambil semua sertifikat max
	*
	* function status: used
	*/
	public function get_certification($status)
	{
		return $this->dataakses->SQL('SELECT max(certificate.id_certificate) as no_certificate,name, certificate_status, issued_date, audit_reference, certification_category.type FROM certificate join a0_cat using(id_a0_cat) join a0 using(id_a0) join company using(id_company) join certification_request using(id_a0_cat) join certification_category using(audit_reference) join issued on certificate.id_certificate = issued.id_certificate where certificate_status = "'.$status.'" group by certificate.id_a0_cat');
	}


	/*//////////////////// GET CERTIFICATIOn available ///////////////////*/

	public function get_certification_available_in_brand($data)
	{
		return $this->dataakses->SQL('SELECT * FROM certification_category where NOT EXISTS (select * from a0 join a0_cat using(id_A0) where id_brand = '.$data['id_brand'].' and certification_category.audit_reference = a0_cat.audit_reference and assessment_date < DATE(NOW()) and status = "success") or EXISTS (SELECT * FROM a0_cat join a0 using(id_a0) join certificate using(id_a0_cat) where id_brand = '.$data['id_brand'].' and certification_category.audit_reference = a0_cat.audit_reference and certificate.certificate_status != "active" ) ' );
	}

	/*
	* check compatibility certification
	* parameters needed
	* type, dibrakom[ id_divisi, id_brand, brand.id_commodity ], audit_reference
	*/
	public function get_compatibility_dibrakom_with_certification($data)
	{
		$result = array();
		$result['id_dibrakom'] = $data['dibrakom'];
		$result['audit_reference'] = $data['audit_reference'];
		
		switch ($data['type']) {
			case 'YQ-005':
				# code...
				$this->dataakses->SQL(' SELECT a0.id_company, type, status, dibrakom, company_name, divisi_name FROM a0 join a0_cat using(id_a0) join certification_request using(id_a0_cat) join company using(id_company) join divisi on certification_request.dibrakom = divisi.id_divisi where dibrakom = '.$data['dibrakom'].' and audit_reference = '.$data['audit_reference'].' and ( (a0.assessment_date IS  NULL && a0_cat.status = "process") || a0.assessment_date > DATE(NOW()) ) ');
				$result['is_exist'] = (count($this->dataakses->result_array()) > 0)? true : false;
				return $result;
				break;

			case 'JPA-009':
				$this->dataakses->SQL('SELECT a0.id_company, type, status, dibrakom, company_name, brand_name FROM a0 join a0_cat using(id_a0) join certification_request using(id_a0_cat) join company using(id_company) join brand on certification_request.dibrakom = brand.id_brand where dibrakom = '.$data['dibrakom'].' and audit_reference = '.$data['audit_reference'].' and ( (a0.assessment_date IS  NULL && a0_cat.status = "process") || a0.assessment_date > DATE(NOW()) )');
				$result['is_exist'] = (count($this->dataakses->result_array()) > 0)? true : false;
				return $result;
				break;

			case 'JECA-004':
				# code...
				$this->dataakses->SQL(' SELECT a0.id_company, type, status, dibrakom, company_name, commodity_name FROM a0 join a0_cat using(id_a0) join certification_request using(id_a0_cat) join company using(id_company) join brand on certification_request.dibrakom = brand.id_commodity where dibrakom = '.$data['dibrakom'].' and audit_reference = '.$data['audit_reference'].' and ( (a0.assessment_date IS  NULL && a0_cat.status = "process") || a0.assessment_date > DATE(NOW()) ) ');
				$result['is_exist'] = (count($this->dataakses->result_array()) > 0)? true : false;
				return $result;
				break;
				
		}
	}

	public function certification_update_status($id_certificate, $status = 'success')
	{
		$this->dataakses->SQL('UPDATE certificate set certificate_status = "'.$status.'" where id_certificate = "'.$data['id_certificate'].'"');
	}

	/*
	* resurvey
	*/

	/*
	* update data RS.
	* function to update reassessment / untuk me-re-registrasikan sertifikat melalui rs. (or what the hell you call it!)
	* parameters
		- id_rs
		- id_issued
		- id_certificate
		- status [remidial, fail, success, process]
	*/

	public function resurvey($data)
	{

		// get data rs
		$this->dataakses->commitOff();

		$this->dataakses->SQL('SELECT id_issued, id_company, id_rs, id_rs_schedule, deadline_date, id_a0_cat, certificate.id_certificate, status, survey_date , a0_cat.type  
			FROM rs 
			join rs_schedule using(id_rs_schedule) 
			join issued using(id_issued) 
			join certificate using(id_certificate) 
			join a0_cat using(id_a0_cat)  
			join a0 using(id_a0)  
			where id_rs = '.$data['id_rs'].' and id_issued='.$data['id_issued']);

		$data_rs = $this->dataakses->row_array();

		// just update if done
		$data['id_certificate'] = $data_rs['id_certificate'];
		$this->update_rs_status($data);


		
		$this->dataakses->SQL('SELECT * FROM `rs` where id_rs > '.$data_rs['id_rs'].' and id_issued = '.$data['id_issued'].' limit 1');
		$next_rs = $this->dataakses->result_array();
		$counter = $this->resurvey_counter($data_rs['type']);

		if( count($next_rs) < 1)
		{
			// (?) apakah update issued nya masuk deadline atau sekarang
			// $this->dataakses->SQL('UPDATE issued set issued_date = DATE(NOW()) where id_issued = '.$data_rs['id_issued']);
				$this->dataakses->SQL('INSERT INTO issued (id_certificate, issued_date) values (?,?)', 'ss', $data_rs['id_certificate'], date('Y-m-d'));
			
			// new issued rs
			$counter = $this->resurvey_counter($data_rs['type']);
			// $counter = $this->resurvey_counter(array( 'issued' => $data_rs['deadline_date'], 'id_a0_cat' => $data_rs['id_a0_cat'] ) );

			$this->dataakses->commitOff();
			foreach ($counter as $key => $value) {
				# code...
				$this->dataakses->SQL('INSERT INTO rs (id_issued, deadline_date) values (?,?)', 'is', $data_rs['id_issued'], $value['resurvey_date']);
			}
			$this->dataakses->commitOn();


			// buat pdf baru
			$this->create_certificate_pdf( $data_rs['id_a0_cat'] );

		}

		/*
		* function save certification request
		# requirements
		  - id a0_cat
		  - audit_reference
		  - id_brand : !isset == 0;
		  - id_commodity
		  - subcommodity
		*/
		$this->load->model('notes_model');
		$dataNotes = array(  
			'id_company' => $data_rs['id_company'],
			'notes_reference_id' => $data['id_rs'],
			'notes_for_type' => 1,
			'explanation' => $data['explanation'],
			'new_status' => $data['status'],
		);
		
		// print_r($dataNotes);
		$this->notes_model->create_confirmation_assessment_notes($dataNotes, $_FILES);

		$this->dataakses->commitOn();
	}

	/*
	|------------------------------------------------------------------
	| Function Update rs Status
	|------------------------------------------------------------------
	| Requirements
	| - status
	| - id_rs
	| - id_issued
	*/
	public function update_rs_status($data)
	{

		$this->dataakses->SQL('UPDATE rs set rs_status = "'.$data['status'].'" where id_rs = '.$data['id_rs'].' and id_issued = '.$data['id_issued']);

		switch ($data['status']) {

			case 'success':
				$this->dataakses->SQL('UPDATE certificate set certificate_status = "active" where id_certificate = "'.$data['id_certificate'].'"');
				
				break;

			case 'fail':

				$this->dataakses->SQL('UPDATE certificate set certificate_status = "revoke" where id_certificate = "'.$data['id_certificate'].'"');
				
				break;

			case 'remidial':

				$this->dataakses->SQL('UPDATE certificate set certificate_status = "icebox" where id_certificate = "'.$data['id_certificate'].'"');
				
				break;
			
			default:
				# code...
				break;
		}
	}

	/*
	* function get a0 in status progress 
	* function to get data a0
	* 
	*/
	public function get__data_request_assessment_in_progress()
	{
		return $this->dataakses->SQL("SELECT id_a0, id_a0_cat, a0_added_on, company.*, DATE(a0_added_on) as a0_added_on_modified, token, assessment_date, type FROM company join a0 using(id_company) join a0_cat using(id_a0) where status = 'progress' ");
	}

	/*
	* function get all request assessment. ALL!
	* 
	* function status : *used
	*/
	public function get__data_request_assessment()
	{
		return $this->dataakses->SQL("SELECT id_a0, id_a0_cat, a0_added_on, company.*, DATE(a0_added_on) as a0_added_on_modified, token, assessment_date, type FROM company join a0 using(id_company) join a0_cat using(id_a0) ");
	}


	/*
	* function create_certificate_pdf 
	* function to create certificate in PDF Formats
	* params @id_a0_cat
	*/
	public function create_certificate_pdf($id_a0_cat)
	{
		$this->result_array = array();

		$this->load->model('company_model');
		$this->load->model('assessment_model');
		/*jika tidak ada data, atau ada data namun id_certificate nya null, tampilkan error*/
		$data = $this->assessment_model->get_detail_assessment($id_a0_cat);
		if( is_null($data['a0_cat']['id_certificate']))
		{
			header('HTTP/1.0 500 Sertifikat tidak ditemukan! ');
			return false;
		}




		$dir = $this->company_model->folder_company($data['company']['id_company']);
		// print_r($data); return false;

		// create qrcode
		$this->load->library('ciqrcode');
		$sha1Certificate = sha1($id_a0_cat);
		
		$options = [
		    'cost' => 12,
		];
		$qrcodeHash = password_hash( $data['a0_cat']['id_certificate'], PASSWORD_BCRYPT, $options);
		$cfnm = $data['certificate']['certificate_md5'];
		// $cfnm = str_replace('/', '.', $data['a0_cat']['id_certificate']);
		$fileloc = site_url('certification/view/'.$cfnm.'/'.$id_a0_cat);
		
		if( !is_file($dir['certificate'].$sha1Certificate.'.png') )
		{
			$params['data'] = $fileloc; // url go to certificate
			$params['level'] = 'H';
			$params['size'] = 10;
			$params['savename'] = $dir['certificate'].$sha1Certificate.'.png';

			$this->ciqrcode->generate($params);
		}
		

		switch ($data['a0_cat']['type']) {
			case 'YQ-005':
				$this->template_certificate_for_yq($data);
				break;
			case 'JECA-004':
				$this->template_certificate_for_jeca($data);
				break;
			case 'JPA-009':
				$this->template_certificate_for_jpa($data);
				break;
		}
	}

	protected function template_certificate_for_yq($data)
	{
		$dir = $this->company_model->folder_company($data['company']['id_company']);
		$this->load->library('pdfgenerator', array('saveTo' => $dir['certificate']) );
		
		// cfnm = certificate file name;
		$cfnm = $data['certificate']['certificate_md5'];
		$logoKAN = base_url('application/components/images/KAN.png');
		$kemenper = base_url('application/components/images/kemenper.png');
		$qrcodeCertificate = base_url('application/clients/'.$data['company']['id_company'].'/certificates/'.sha1($data['a0_cat']['id_a0_cat']).'.png');
		$companyName = $data['company']['company_name'];
		$certificateNo = $data['certificate']['id_certificate'];
		$tanggalPenetapan = date('d F Y', strtotime($data['issued'][0]['issued_date']));
		$use_period = $this->dataakses->SQL('SELECT use_period FROM certification_type where type = ?', 's', $data['a0_cat']['type'])[0]['use_period'];
		$expired = date('d F Y', strtotime("+".$use_period." months", strtotime($data['issued_terakhir']['issued_date'])));
		
		$isoRequested = '';
		foreach ($data['audit_reference']['certificate'] as $key => $value) {
			$isoRequested .='<div style="margin-top:20px;font-size:50px;">'.$value.'</div>
                    <div style="font-size:20px;">SNI '.$value.'</div>';
		}

		$textNace = '';
		if(isset($data['nace']))
		{	
			foreach ($data['nace'] as $key => $value) {
				$textNace .= '<div> <strong>('.$value['nace_item'].')</strong> '.$value['nace_name'].'</div>';
			}
		}
		$perubahan = (isset($data['audit_khusus']) && count($data['audit_khusus']) < 1)? ' - ' : date('j M Y', strtotime($data['audit_khusus_terakhir']['modified_time']));

		$html = '
		<div style="font-family:arial;position:relative;margin:auto;">
            <div class="header" style="width:100%;">
                <div>
                    <div style="width:66%;font-size:18px;display:inline-block;padding:0px 10px;">LEMBAGA SERTIFIKASI SISTEM MANAJEMEN MUTU<br> BALAI BESAR KULIT, KARET DAN PLASTIK - YOQA</div>
                    <div style="width:29%;display:inline-block;"><img src="'.$kemenper.'" width="80%" style="float:right;" ></div>
                </div>
            </div>
            <hr>
            <div style="width:100%; height:100px; position:fixed;bottom:0;padding-top:10px;font-size:16px; text-align:center;">
            	<hr>
                <center><div style="">Jl. Sokonandi No.9 Yogyakarta 55166 - INDONESIA<br>Tel (+62274) 547967 / Fax. (+62274) 558160 <br> surel: lssm_yoqa@yahoo.com </div> </center>
                <img src="'.$qrcodeCertificate.'" width="100px;" style="position: absolute; top:30px; right:10px;" >
                <img src="'.$logoKAN.'"style="width:100px; position:absolute; top:30px; left:10px;" >
            </div>

            <div style="margin-top: 40px;line-height:1.3;">
                <div style="text-align:right; margin-right:80px;">
                    <div style="font-size:50px;">SERTIFIKAT</div>
                    <div style="font-size:14px;">Kami menyatakan bahwa : </div>
                    <div style="font-size:30px;font-weight:700;margin-top:25px;">'.$companyName.'</div>
                    <div style="font-size:20px;">Tanggal penetapan awal : '.$tanggalPenetapan.'</div>
                    <div style="font-size:17px;">No. Ref : LSBBKKP/COM/'.$data['company']['id_company'].'</div>
                    
                    <div style="font-size:29px;font-weight:700;">'.$certificateNo.'</div>

                    <p style="margin-top:40px">Telah menerapkan Sistem Manajemen Mutu sesuai dengan </p>'.$isoRequested.'
                    
                    <p style="margin-top:20px"> '.$data['certificate']['certificate_note'].' </p>
                    <p style="margin-top:20px"> Ruang lingkup sertifikasi dijelaskan dalam lampiran! </p>

                    <div style="margin-top:40px;font-size:16px;">Tanggal Terbit : '.$tanggalPenetapan.'</div>
                    <div style="font-size:16px;">Tanggal Perubahan : '.$perubahan.' </div>
                    <div style="font-size:16px;">Berlaku hingga : '.$expired.'</div>

                    <div style=" margin-top:100px; border-top: 1px solid black; width:180px; position:absolute; right:40px;">Ketua Dewan Pemimpin</div>
                </div>
            </div>
        </div>
		';
		// lampiran YQ
		$html .= '
		<div style="font-family:arial;position:relative;margin:auto;page-break-before:always;">
            
            <div style="margin-top: 40px;line-height:1.3; position:relative;">
                <div style="position:absolute; top:0; left:0; ">Lampiran : </div>
                <div style="margin-left: 90px;">
                    <div>Sertifikasi Sistem Manajemen Mutu</div>
                    <div>Sertifikasi No. '.$certificateNo.'</div>
                    <div>Berlaku dari</div>
                    <div>tanggal <strong>'. $tanggalPenetapan.'</strong> sampai dengan <strong>'.$expired.'</strong> </div>
                    <div style="margin:25px 0px;">RUANG LINGKUP SERTIFIKASI</div>
                    <div>Nama Perusahaan :</div>
                    <div style="font-size:25px;font-weight:bold;margin:10px 0px 30px 0px;">'.$data['company']['company_name'].'</div>
                    <div  style="margin:15px 0px;">
                        <div><strong>Alamat : </strong></div>
                        <div>'.$data['company']['company_address'].', '.$data['company']['company_region'].' - '.$data['company']['company_post'].',</div>
                        <div>'.$data['company']['company_province'].' - '.$data['company']['country_name'].'</div>
                    </div>
                    <div style="margin:15px 0px;"> 
                        <table>
                            <tr> <td>Telepon </td> <td>:</td> <td>'.$data['company']['telephone'].'</td> </tr>
                            <tr> <td>Faksimil </td> <td>:</td> <td>'.$data['company']['company_fax'].'</td> </tr>
                        </table>
                    </div>
                    <div style="margin:15px 0px;"> 
                        <div> <strong>Ruang Lingkup :</strong> '.$data['text_scope'].' </div>
                    </div>
                    
                    <div style="margin:15px 0px;"> 
                        <div><strong>Kode Nace :</strong></div>
                        <div>'.$textNace.'</div>
                    </div>
                    
                    <div style="margin-top:130px; text-align:center; position: absolute; right:20px; border-top: 1px solid black; width:180px; ">Ketua Dewan Pemimpin</div>
                </div>
            </div>
           
        </div>
		';


		$this->pdfgenerator->pdf_create($html, $cfnm, array(), FALSE);

	}

	public function template_certificate_for_jeca($data)
	{
		$dir = $this->company_model->folder_company($data['company']['id_company']);
		$this->load->library('pdfgenerator', array('saveTo' => $dir['certificate']) );

		// cfnm = certificate file name;
		$cfnm = $data['certificate']['certificate_md5'];
		// $cfnm = str_replace('/', '.', $data['a0_cat']['id_certificate']);
		$logoKAN = base_url('application/components/images/KAN.png');
		$kemenper = base_url('application/components/images/kemenper.png');
		$qrcodeCertificate = base_url('application/clients/'.$data['company']['id_company'].'/certificates/'.sha1($data['a0_cat']['id_a0_cat']).'.png');
		$companyName = $data['company']['company_name'];
		$certificateNo = $data['certificate']['id_certificate'];
		$tanggalPenetapan = date('d F Y', strtotime($data['issued'][0]['issued_date']));
		
		$use_period = $this->dataakses->SQL('SELECT use_period FROM certification_type where type = ?', 's', $data['a0_cat']['type'])[0]['use_period'];
		$expired = date('d F Y', strtotime("+".$use_period." months", strtotime($data['issued_terakhir']['issued_date'])));
		$perubahan = (isset($data['audit_khusus']) && count($data['audit_khusus']) < 1)? ' - ' : date('j M Y', strtotime($data['audit_khusus_terakhir']['modified_time']));
		
		$html = '
			<div style="font-family:arial;position:relative;margin:auto;">
	            <div style="width:100%;">
	                <div>
	                    <div style="width:66%;font-size:18px;display:inline-block;padding:0px 10px;">LEMBAGA SERTIFIKASI SISTEM MANAJEMEN MUTU<br> BALAI BESAR KULIT, KARET DAN PLASTIK - YOQA</div>
	                    <div style="width:29%;display:inline-block;"><img src="'.$kemenper.'" width="80%" style="float:right;" ></div>
	                </div>
	            </div>
	            <hr>
	            <div style="margin-top: 40px;line-height:1.3;">
	                <center>
		                <div style="font-size:50px;letter-spacing:12px;text-transform:uppercase;">Sertifikat</div>
		                <div style="float: right;">Tanggal penetapan awal: '.$tanggalPenetapan.'</div>
		                <div style="text-align:left !important;">No. Ref : LSBBKKP/COM/'.$data['company']['id_company'].'</div>
		                <div style="font-weight:bold; font-size:31px; margin-top:15px;">'.$certificateNo.'</div>
		                <div style="margin-top:20px;">Kami Menyatakan bahwa : </div>
		                <div style="font-size:40px;margin-top:15px;">'.$companyName.'</div>
		                <div style="">'.$data['company']['company_name'].'</div>
		                <div style="">'.$data['company']['company_address'].', '.$data['company']['company_region'].'</div>
		                <div style="">'.$data['company']['company_province'].' - '.$data['company']['company_post'].'</div>
		                <div style=""> '.$data['company']['company_province'].' -  '.$data['company']['country_name'].'</div>

		                <div style="margin-top:30px;">telah menerapkan Sistem Manajemen Lingkungan sesuai dengan </div>

		                <div style="margin-top:30px;font-size:30px;font-weight:bold;"> '.implode(', ', $data['audit_reference']['certificate']).'</div>
		                <div style="font-weight:bold;">'.implode('SNI ,', $data['audit_reference']['certificate']).'</div>
		                
		               
		            
		            </center>

	                <div style="margin-top:60px;">
	                    <table>
	                        <tr>
	                            <td>Ruang Lingkup</td>
	                            <td>:</td>
	                            <td>'.$data['text_scope'].'</td>
	                        </tr>
	                        
	                        <tr>
	                            <td>Tanggal Terbit</td>
	                            <td>:</td>
	                            <td>'.$data['issued_terakhir']['issued_date'].'</td>
	                        </tr>
	                        <tr>
	                            <td>Tanggal Perubahan</td>
	                            <td>:</td>
	                            <td> '.$perubahan.' </td>
	                        </tr>
	                        <tr>
	                            <td>Berlaku Hingga</td>
	                            <td>:</td>
	                            <td>'.$expired.'</td>
	                        </tr>
	                    </table>
	                </div>
	                
                    <div style=" margin:60px auto;width:180px;border-top:1px solid black;text-align:center;">Ketua Dewan Pimpinan</div>

	            </div>
	            <div style="width:100%; height:100px; position:absolute;bottom:0;padding-top:10px;font-size:16px; text-align:center;">
	            	<hr>
	                <center><div style="">Jl. Sokonandi No.9 Yogyakarta 55166 - INDONESIA<br>Tel (+62274) 547967 / Fax. (+62274) 558160 <br> surel: lssm_yoqa@yahoo.com </div> </center>
	                <img src="'.$qrcodeCertificate.'" width="100px;" style="position: absolute; top:30px; right:10px;" >
	                <img src="'.$logoKAN.'"style="width:100px; position:absolute; top:30px; left:10px;" >
	                
	            </div>
	        </div>
		';
		
		$this->pdfgenerator->pdf_create($html, $cfnm, array(), FALSE);
	}

	public function template_certificate_for_jpa($data)
	{
		$dir = $this->company_model->folder_company($data['company']['id_company']);
		$this->load->library('pdfgenerator', array('saveTo' => $dir['certificate']) );

		// cfnm = certificate file name;
		$cfnm = $data['certificate']['certificate_md5'];
		// $cfnm = str_replace('/', '.', $data['a0_cat']['id_certificate']);
		$logoKAN = base_url('application/components/images/KAN.png');
		$kemenper = base_url('application/components/images/kemenper.png');
		$qrcodeCertificate = base_url('application/clients/'.$data['company']['id_company'].'/certificates/'.sha1($data['a0_cat']['id_a0_cat']).'.png');
		$companyName = $data['company']['company_name'];
		$certificateNo = $data['certificate']['id_certificate'];
		$tanggalPenetapan = date('d F Y', strtotime($data['issued'][0]['issued_date']));

		$use_period = $this->dataakses->SQL('SELECT use_period FROM certification_type where type = ?', 's', $data['a0_cat']['type'])[0]['use_period'];
		$expired = date('d F Y', strtotime("+".$use_period." months", strtotime($data['issued_terakhir']['issued_date'])));
		$perubahan = (isset($data['audit_khusus']) && count($data['audit_khusus']) < 1)? ' - ' : date('j M Y', strtotime($data['audit_khusus_terakhir']['modified_time']));
		
		$html = '
			<div style="font-family:arial;position:relative;margin:auto;">
	            <div style="width:100%;">
	                <div>
	                    <div style="width:66%;font-size:18px;display:inline-block;padding:0px 10px;">LEMBAGA SERTIFIKASI SISTEM MANAJEMEN MUTU<br> BALAI BESAR KULIT, KARET DAN PLASTIK - YOQA</div>
	                    <div style="width:29%;display:inline-block;"><img src="'.$kemenper.'" width="80%" style="float:right;" ></div>
	                </div>
	            </div>
	            <hr>
	            <div style="margin-top: 40px;line-height:1.3;text-align:center;">
	                <div style="font-size:50px;letter-spacing:12px;text-transform:uppercase;">Sertifikat</div>
	                <div style="text-align:left !important;">No. Ref : LSBBKKP/COM/'.$data['company']['id_company'].' </div>
	                <div style="font-weight:bold; font-size:31px; margin-top:15px;">'.$certificateNo.'</div>
	                <div style="margin-top:15px;">Lembaga Sertifikasi Produk LSPro - BBKKP JOGJA PRODUCT ASSURANCE</div>
	                <div style="">memberikan sertifikasi kepada :</div>
	                <div style="font-size:40px;margin-top:10px;">'.$data['company']['company_name'].'</div>
	                <div style="">'.$data['company']['company_address'].', '.$data['company']['company_region'].'</div>
	                <div style="">'.$data['company']['company_province'].' - '.$data['company']['company_post'].'</div>
	                <div style=""> '.$data['company']['company_province'].' -  '.$data['company']['country_name'].'</div>

	                <div>Spesifikasi produk: </div>
	                <div>Merk : '.$data['text_brand'].' </div>
	                <div>Standard Product : '.implode(', ', $data['audit_reference']['certificate']).' </div>
	                <div>Sistem Sertifikasi Produk : - </div>
	                <div style="margin-top:30px;">Pemegang sertifikat ini diberikan HAK menggunakan<br>logo LSPro - BBKKP JPA dan tanda SNI pada produk sesuai ketentuan.</div>

	                <div style="margin-top:30px;">Tanggal Terbit : '.$tanggalPenetapan.'<br>Tanggal Perubahan : '.$perubahan.' <br>Berlaku hingga: '.$expired.'</div>
	                
	                
                    <div style=" margin:60px auto;width:180px;border-top:1px solid black;text-align:center;">Ketua Dewan Pimpinan</div>

	            </div>
	            <div style="width:100%; height:100px; position:absolute;bottom:0;padding-top:10px;font-size:16px; text-align:center;">
	            	<hr>
	                <center><div style="">Jl. Sokonandi No.9 Yogyakarta 55166 - INDONESIA<br>Tel (+62274) 547967 / Fax. (+62274) 558160 <br> surel: lssm_yoqa@yahoo.com </div> </center>
	                <img src="'.$qrcodeCertificate.'" width="100px;" style="position: absolute; top:30px; right:10px;" >
	                <img src="'.$logoKAN.'"style="width:100px; position:absolute; top:30px; left:10px;" >
	                
	            </div>
	        </div>
		';
		
		$this->pdfgenerator->pdf_create($html, $cfnm, array(), FALSE);
	}

	protected function generate_qrcode_certificate($id_a0_cat, $id_company)
	{
		$this->load->library('ciqrcode');
		$dataCertificate = sha1($id_a0_cat);
		$params['data'] = $id_company.'|'.$dataCertificate;
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = APPPATH.'clients/'.$id_company.'/certificates'.'/'.$dataCertificate.'.png';
		$this->ciqrcode->generate($params);
	}


	public function update_audit_reference($update_data, $where)
	{
		$this->db->trans_start();
		$this->db->where($where);
		$this->db->update('certification_category', $update_data);
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE)
		{
			give_error('Kesalahan dalam memperbarui data '.$update_data['name'].'. Silahkan refresh browser anda dan ulangi lagi atau hubungi pengembang Aplikasi.');
		} 
	}

	/*
	|--------------------------
	| Update Certificate
	|--------------------------
	*/
	public function update_certificate($update, $where)
	{
		$this->db->where($where);
		$this->db->update('certificate', $update); 
	}

	/*
	|--------------------------
	| Update a0
	|--------------------------
	*/
	public function update_a0($update, $where)
	{
		$this->db->where($where);
		$this->db->update('a0', $update); 
	}

	/*
	|--------------------------
	| Update a0_cat
	|--------------------------
	*/
	public function update_a0_cat($update, $where)
	{
		$this->db->where($where);
		$this->db->update('a0_cat', $update); 
	}

	/*
	|--------------------------
	| Update Certification Request
	|--------------------------
	*/
	public function update_certification_request($update, $where)
	{
		$this->db->where($where);
		$this->db->update('certification_request', $update); 
	}
	public function update_old_reference($update, $where)
	{
		$this->db->where($where);
		$this->db->update('old_ref_certificate', $update); 
	}

	/*
	|
	| UPDATE KELENGKAPAN DOKUMEN
	|
	*/
	public function update_kelengkapan_dokumen($update, $where)
	{
		$this->db->where($where);
		$this->db->update('kelengkapan_permintaan_sertifikasi', $update); 
	}
	/*
	|
	| UPDATE detail KELENGKAPAN DOKUMEN
	|
	*/
	public function update_detail_kelengkapan_dokumen($update, $where)
	{
		$this->db->where($where);
		$this->db->update('detail_kelengkapan_permintaan_sertifikasi', $update); 
	}

	// R E M O V E
	public function remove_data_requirement_kelengkapan_dokumen($where)
	{
		$this->db->delete('master_kelengkapan_permintaan', $where); 
	}
	public function remove_detail_kelengkapan_permintaan_sertifikasi($where)
	{
		$this->db->delete('detail_kelengkapan_permintaan_sertifikasi', $where); 
	}
	
	// I N S E R T 
	public function insert_pengajuan_kelengkapan_dokumen($data)
	{
		$this->db->insert('kelengkapan_permintaan_sertifikasi', $data);
		return $this->db;
	} 

	public function insert_detail_pengajuan_kelengkapan_dokumen($data)
	{
		$this->db->insert('detail_kelengkapan_permintaan_sertifikasi', $data);
		return $this->db;
	} 
	public function insert_detail_pengajuan_kelengkapan_dokumen_bulk($data)
	{
		$this->db->insert_batch('detail_kelengkapan_permintaan_sertifikasi', $data);
		return $this->db;
	} 
}
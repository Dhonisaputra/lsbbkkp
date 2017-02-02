<?php
/**
* 
*/
class Auditor_model extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->library('dataakses');
		$this->load->database();

	}

	/*
	|---------------------
	| Get data auditor
	|---------------------
	*/
	public function data_auditor($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('auditor');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}

	/*
	|---------------
	| Fucntion get auditor yang kompeten dan tersedia pada tanggal tertentu
	|--------------
	| @params
	|	- assessment_date @date
	| 	- competency @array @minimal = 1
	*/
	public function data_competent_and_available_auditor($data)
	{

		if( !is_array($data['assessment_date']) ){$data['assessment_date'] = array($data['assessment_date']);}
		if( !is_array($data['competency']) ){$data['competency'] = array($data['competency']);}
		if( !is_array($data['assessment_date_range']) ){$data['assessment_date_range'] = array($data['assessment_date_range']);}

		$competency = array();
		$assessment_date = array();
		foreach ($data['assessment_date'] as $key => $value) {
			$auditlen = $data['assessment_date_range'][$key]; // lama audit

			$assessment_date[] = '( 
				("'.$value.'" BETWEEN DATE_ADD(audit_start,  INTERVAL -1 DAY) AND DATE_ADD(audit_end,  INTERVAL 2 DAY) ) 
				OR (audit_start BETWEEN "'.$value.'" AND DATE_ADD("'.$value.'", INTERVAL '.$auditlen.' DAY) ) 
				OR (audit_end BETWEEN "'.$value.'" AND DATE_ADD("'.$value.'", INTERVAL '.$auditlen.' DAY)   ) 
			)';
		}
		foreach ($data['competency'] as $key => $value) {
			$competency[] = 'auditor_competency.competency = "'.$value.'"';
		}

		$competency = implode(' or ', $competency);
		$assessment_date = implode(' or ', $assessment_date);

		$sql = 'SELECT auditor.*, jabatan.* , GROUP_CONCAT(certification_category.`name` SEPARATOR ",") group_system ,GROUP_CONCAT(certification_category.`type` SEPARATOR ",") AS group_type
			FROM auditor 
			JOIN auditor_competency USING(id_auditor) 
			JOIN certification_category ON auditor_competency.`competency` = certification_category.`audit_reference` 
			join jabatan on auditor.jabatan = jabatan.id_jabatan
			WHERE 

			id_auditor NOT IN(
				SELECT id_auditor 
				FROM auditor_log 
				WHERE '.$assessment_date.'
			)
			AND id_auditor IN(
				SELECT auditor_competency.id_auditor 
				FROM auditor_competency 
				WHERE auditor.`id_auditor` = auditor_competency.`id_auditor` 
				AND '.$competency.'
			)
			GROUP BY id_auditor
		';
		return $this->db->query($sql);
	}

	/*
	|---------------------
	| Get auditor competency
	|---------------------
	*/
	public function data_auditor_competency($select = '*', $where = array())
	{
		$this->db->select($select);
		$this->db->from('auditor_competency');
		$this->db->join('certification_category', 'auditor_competency.competency = certification_category.audit_reference');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function unrequested_competency($id_auditor)
	{
		$sql = 'SELECT * FROM certification_category WHERE NOT EXISTS(SELECT * FROM `auditor_competency` WHERE id_auditor = ? AND `certification_category`.`audit_reference` = `auditor_competency`.`competency`)';
		return $this->db->query($sql, array($id_auditor));
		
	}

	public function get_data_auditor_login($data)
	{
		$get = $this->dataakses->SQL('SELECT *, auditor_password as password FROM auditor join keychain on auditor.auditor_keychain = keychain.keychain_id where email = ? or phone_number = ?', 'ss', $data['username'], $data['username']);
		return $get;
	}

	public function check_data_login($data)
	{
		require_once(APPPATH.'libraries/profiling/Pengguna.php');
		$u = new Pengguna();
		$get = $this->get_data_auditor_login($data);
		if( count($get) == 1 )
		{
			$get = $get[0];
			$auditor = $u->user_authentication($data['password'], $get['auditor_password'], $get['fkey'], $get['skey']);
			return array('is_authentic' => $auditor, 'auditor' => $get); 
		}
	}

	public function data_auditor_log($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('auditor_log');
		$this->db->join('auditor', 'auditor.id_auditor = auditor_log.id_auditor');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}

	public function get_auditor($where = array(), $returnAs = 'row')
	{
		if(count($where) < 1)
		{
			return $this->dataakses->SQL('SELECT * FROM auditor join jabatan on auditor.jabatan = jabatan.id_jabatan order by jabatan asc');
		}else
		{
			$this->load->database();
			$this->db->select('*');
			$this->db->from('auditor');
			$this->db->join('jabatan', 'auditor.jabatan = jabatan.id_jabatan');
			$this->db->where($where);
			$data = $this->db->get();
			switch ($returnAs) {
				case 'row':
					return $data->row_array();
					# code...
					break;
				case 'result':
					return $data->result_array();
					# code...
					break;

				case 'raw':
					return $data;
					# code...
					break;
				
				default:
					# code...
					break;
			}
		}
	}

	public function get_auditor_log($where = FALSE)
	{
		$this->db->select('*');
		$this->db->from('auditor_log');
		$this->db->join('auditor', 'auditor_log.id_auditor = auditor.id_auditor');
		$this->db->join('jabatan', 'auditor_log.auditor_as = jabatan.id_jabatan');

		if($where !== FALSE)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return $data;
	}

	public function get_jabatan($where = array())
	{
		$this->load->database();
		$this->db->select('*');
		$this->db->from('jabatan');

		if( count($where) > 0 )
		{
			$this->db->where($where);
		}

		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_auditor_assigned($id_a0)
	{
		return $this->dataakses->SQL('SELECT * FROM auditor join jabatan on auditor.jabatan = jabatan.id_jabatan join auditor_log using(id_auditor) where auditor_log.id_assessment = '.$id_a0);
	}
	public function data_auditor_education($select = '*', $where = array())
	{
		$this->db->select($select);
		$this->db->from('auditor_riwayat_pendidikan');

		if( count($where) > 0 )
		{
			$this->db->where($where);
		}

		return $this->db->get();
	}
	public function get_auditor_education($id_auditor)
	{
		$this->dataakses->SQL('SELECT * FROM auditor_riwayat_pendidikan where id_auditor = ? order by tahun_lulus ASC', 'i', $id_auditor);
		return $this->dataakses->result_array();
	}

	public function get_log_audit($id_auditor)
	{
		$d0 = $this->dataakses->SQL('SELECT * FROM auditor_log join jabatan on auditor_log.auditor_as = jabatan.id_jabatan where id_auditor = ?', 'i', $id_auditor);
		
		if(count($d0) > 0)
		{

			foreach ($d0 as $key => $value) {
				$data = $this->get_place_log_audit($value['id_assessment'], $value['assessment_type']);
				$d0[$key]['company_name'] = $data['company_name'];
				$d0[$key]['company_location'] = $data['company_address'];
				$d0[$key]['audit_date'] = isset($data['assessment_date'])? $data['assessment_date'] : $data['survey_date'];
				// echo $value['assessment_type']."\n";
			}
		}
		return $d0;
	}
	public function get_place_log_audit($id_assessment, $type)
	{
		// echo $type."\n";
		$this->load->model('assessment_model');
		if( $type == 'assessment' )
		{
			$d0 = $this->db->query('SELECT * FROM a0 join company on company.id_company = a0.id_company where id_a0 = ?',  array($id_assessment));
			$d0 = $d0->row_array();
			return $d0;

		}elseif( $type == 'reassessment' )
		{
			$d0 = $this->db->query('SELECT * FROM rs JOIN issued using(id_issued) join certificate using(id_certificate) join a0_cat using(id_a0_cat) join a0 using(id_a0) join company using(id_company) where id_rs = ?',  array($id_assessment));
			$d0 = $d0->row_array();
			return $d0;
		}
	}
	// D E L E T E ///////////////////////////////////////////

	public function delete_auditor_assigned($id_a0, $id_auditor, $type)
	{
		$this->dataakses->SQL('DELETE FROM auditor_log where assessment_type="'.$type.'" and  id_assessment = '.$id_a0.' and id_auditor = '.$id_auditor);
	}

	public function delete_auditor_log($where = FALSE)
	{
		$this->load->database();
		if($where !== FALSE)
		{
			$this->db->delete('auditor_log', $where); 
		}
	}

	public function delete_auditor_competency($where = FALSE)
	{
		$this->load->database();
		if($where !== FALSE)
		{
			$this->db->delete('auditor_competency', $where); 
		}
	}

	public function delete_log_pendidikan_auditor($where)
	{
		$this->load->database();
		$this->db->where($where);
		$this->db->delete('auditor_riwayat_pendidikan'); 
	}

	public function delete_auditor($where)
	{
		$this->load->database();
		$this->db->where($where);
		$this->db->delete('auditor'); 
	}

	public function auto_choose_auditor($jumlah, $type, $data_auditor)
	{

	}

	/*
	|
	| I N S E R T 
	|
	*/
	public function prepare_save_auditor_assignment($data)
	{
		// check data confirmed new assessment.
		// !tanya = rencana. apakah perlu validasi "yang belum ada di auditor log" ? 
		foreach ($data['data'] as $key => $value) 
		{
			if( $value['type'] == 1 )
			{
				$this->prepare_save_auditor_assignment_new_assessment($value);
			}elseif( $value['type'] == 0 )
			{
				$this->prepare_save_auditor_assignment_re_assessment($value);
			}
		}
		// print_r($data);
	}

	/*
	|------------------------------------------
	|
	|------------------------------------------
	| Requirement [type_schedule, id(id_rs), ]
	*/
	public function prepare_save_auditor_assignment_re_assessment($data)
	{
			// get data assessment date not null
			$rs = $this->db->query('SELECT * FROM rs join rs_schedule on rs.id_rs_schedule = rs_schedule.id_rs_schedule where id_rs = ?', array( $data['id'] ));
			$rs = $rs->row_array();


			
			// foreach for company with a0 assessment date not null

			foreach ($data['auditor'] as $key => $auditor) {
				$id_rs = $rs['id_rs'];
				
				// get is exist current id_a0 in auditor log?
				$isexist = $this->dataakses->SQL('SELECT * FROM auditor_log where assessment_type = "reassessment" and id_assessment = '.$id_rs.' and id_auditor = '.$auditor); 

				$asLeader = ($auditor == $data['leader'])? 1 : 0;

				
				// jika belum ada
				if(  count($isexist) < 1 )
				{
					$this->save_auditor_assignment($id_rs, $auditor, 'reassessment', $asLeader);
				}
			}
		
	}

	public function prepare_save_auditor_assignment_new_assessment($data)
	{
		// foreach ($data['assignment'] as $key => $value) {
			
			// get data assessment date not null
			$this->db->select('*');
			$this->db->from('a0');
			$this->db->where(array('id_company' => $data['company'], 'id_a0' => $data['id']) );
			$this->db->where('assessment_date IS NOT NULL');
			$dataquery = $this->db->get()->result_array();

			// foreach for company with a0 assessment date not null
			foreach ($dataquery as $a => $b) {

				foreach ($data['auditor'] as $key => $auditor) {
					$id_a0 = $b['id_a0'];
					$asLeader = ($auditor == $data['leader'])? 1 : 0;
					// get is exist current id_a0 in auditor log?
					$isexist = $this->dataakses->SQL('SELECT * FROM auditor_log where assessment_type = "assessment" and id_assessment = ? and id_auditor = ?', 'ii', $id_a0, $auditor); 

					print_r($isexist);
					// jika belum ada
					if(  count($isexist) < 1 )
					{
						$this->save_auditor_assignment($b['id_a0'], $auditor, 'assessment', $asLeader);
					}
				}
			}
			// print_r($dataquery->result_array());
		// }
	}

	/*
	type = [assessment / reassessment]
	*/
	public function save_auditor_assignment($id_assessment, $id_auditor, $type = 'assessment', $isLeader)
	{
		$this->load->model('assessment_model');
		if($type == 'assessment')
		{
			$a0_cat 	 = $this->assessment_model->data_a0_cat('*',array('id_a0' => $id_assessment), 0);
			$a0 		 = $this->assessment_model->data_a0('*',array('id_a0' => $id_assessment), 0);
			$audit_start = $a0['assessment_date'];
			$audit_end 	 = date('Y-m-d', strtotime($audit_start)+($a0_cat['a0_cat_audit_length']*24*60*60));
		}else
		{
			$rs 	 	 = $this->assessment_model->data_rs('*',array('id_rs' => $id_assessment), 0);
			$rs_schedule = $this->assessment_model->data_rs_schedule('*',array('id_rs_schedule' => $rs['id_rs_schedule']), 0);
			$audit_start = $rs_schedule['survey_date'];
			$audit_end 	 = date('Y-m-d', strtotime($audit_start)+($a0_cat['a0_cat_audit_length']*24*60*60));			
		}

		$audit_days = $this->assessment_model->forecasting_next_date($a0_cat['a0_cat_audit_length'], $audit_start);
		$firstDate = array_shift($audit_days['work_days']);
		$lastDate = (count($audit_days['work_days']) > 0)? array_pop($audit_days['work_days']) : $firstDate;

		$this->dataakses->SQL('SELECT * FROM auditor join jabatan on auditor.jabatan = jabatan.id_jabatan where id_auditor = '.$id_auditor);
		$auditor = $this->dataakses->row_array();
		
		if(count($auditor) > 0)
		{
			$this->dataakses->SQL('INSERT into auditor_log(id_auditor, id_assessment, auditor_as, assessment_type, audit_start, audit_end, is_leader) values(?,?,?,?,?,?,?)', 'iissssi', $id_auditor, $id_assessment, $auditor['id_jabatan'], $type, $firstDate, $lastDate, $isLeader );
		}
	}

	/*
	* function add auditor education
	*/
	public function add_auditor_education($data)
	{
		// foreach ($data['tahunlulus'] as $key => $value) {
		// 	$this->dataakses->SQL('INSERT into auditor_riwayat_pendidikan(id_auditor, pendidikan, jurusan, tahun_lulus, jenjang) values(?,?,?,?,?) ', 'issss', $data['id_auditor'], $data['instansi_pendidikan'][$key], $data['jurusan'][$key], $data['tahunlulus'][$key], $data['jenjang'][$key] );
		// }
		$this->load->database();
		$this->db->insert('auditor_riwayat_pendidikan', $data); 
		$insert_id = $this->db->insert_id();
		return array('id_riwayat_pendidikan_auditor' => $insert_id );
	}

	public function insert_new_auditor($data)
	{
		$this->load->database();
		$this->db->insert('auditor', $data); 
		return $this->db->insert_id();
	}

	public function insert_new_competency($data)
	{
		$this->load->database();
		$this->db->insert('auditor_competency', $data); 
		return $this->db->insert_id();
	}

	public function insert_auditor_log($data)
	{
		$this->load->database();
		$this->db->insert('auditor_log', $data); 
		return $this->db->insert_id();
	}

	public function insert_auditor_for_existing_certificate($batch_data)
	{
		$this->db->insert_batch('auditor_log', $batch_data);
	}

	/*
	| U P D A T E -----------------------------------------------------------
	*/

	public function update_auditor_education($update, $where)
	{
		$this->load->database();
		$this->db->where($where);
		$this->db->update('auditor_riwayat_pendidikan', $update); 
	}

	public function update_auditor($update, $where)
	{
		$this->load->database();
		$this->db->where($where);
		$this->db->update('auditor', $update); 
	}

	public function update_auditor_competency($update, $where)
	{
		$this->load->database();
		$this->db->where($where);
		$this->db->update('auditor_competency', $update); 
	}

	public function update_auditor_log($update, $where)
	{
		$this->load->database();
		$this->db->where($where);
		$this->db->update('auditor_log', $update); 
	}
}
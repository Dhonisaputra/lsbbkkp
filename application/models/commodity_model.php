<?php

/**
* 
*/
class Commodity_model extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->library('dataakses');
		$this->load->library('lib_login');
	}

	/*
	|---------------------
	| Get data brand
	|---------------------
	*/
	public function data_scope($select = '*', $where = array(), $row_array=-1)
	{
		$this->load->database();
		$this->db->select($select);
		$this->db->from('commodity');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}

	public function get_commodity()
	{
		return $this->dataakses->SQL('SELECT * FROM commodity');
	}

	public function add_commodity($data)
	{
		$this->dataakses->SQL('INSERT into commodity(commodity_name) values(?)', 's', $data['commodity_name'] );
	}

	// U P D A T E ---------------------------------

	/*
	|----------------
	| Function Update Scope
	|----------------
	| Requirement = id_scope/id_commodity, status_revoke[0/1]
	*/
	public function status_revoke_scope($data)
	{
		$this->dataakses->SQL('UPDATE commodity set revoke_scope = ?, revoked_by = ? where id_commodity = ?', 'iii', $data['status_revoke'], $this->lib_login->user(), $data['id_scope'] );

	}

	public function update_scope($data)
	{
		$this->dataakses->SQL('UPDATE commodity set commodity_name = ? where id_commodity = ?', 'si', $data['commodity_name'], $data['id_scope'] );

	}


}
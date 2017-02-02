<?php
/**
* 
*/
class Invoice_model extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('dataakses');
	}

	/*
	|---------------------
	| Get data invoice
	|---------------------
	*/
	public function data_invoice($select, $where)
	{
		$this->db->select($select);
		$this->db->from('invoice');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		return $this->db->get();
	}

	/*
	|---------------------
	| Get data invoice detail
	|---------------------
	*/
	public function data_invoice_detail($select, $where)
	{
		$this->db->select($select);
		$this->db->from('invoice_detail');
		$this->db->join('master_files', 'invoice_detail.bill = master_files.file_id','left');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		return $this->db->get();
	}

	/*
	|---------------------
	| Get data invoice detail
	|---------------------
	*/
	public function data_invoice_full($select, $where)
	{
		$this->db->select($select);
		$this->db->from('invoice');
		$this->db->join('invoice_detail', 'invoice.id_invoice = invoice_detail.id_invoice');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		return $this->db->get();
	}

	/*
	|
	| I N S E R T 
	|
	*/
	public function insert_invoice($data)
	{
		$this->db->insert('invoice', $data);
		return $this->db;
	} 

	public function insert_invoice_detail($data)
	{
		$this->db->insert('invoice_detail', $data);
		return $this->db;
	} 

	/*
	|
	| U P D A T E
	|
	*/
	public function update_invoice($update, $where){

		$this->db->where($where);
		$this->db->update('invoice', $update); 
	}

	public function update_invoice_detail($update, $where){

		$this->db->where($where);
		$this->db->update('invoice_detail', $update); 
	}

	/* 
	|
	| R E M O V E
	|
	*/
	public function remove_invoice($where)
	{
		$this->db->delete('invoice', $where); 
	}
	public function remove_invoice_detail($where)
	{
		$this->db->delete('invoice_detail', $where); 
	}
}
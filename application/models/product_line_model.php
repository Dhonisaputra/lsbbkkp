<?php
/**
* 
*/
class Product_line_model extends CI_MOdel
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
	| Get data product line master
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
	|---------------------
	| Get data product line master
	|---------------------
	*/
	public function data_product_line_subcategory($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('product_line_subcategory');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}

	/*
	|---------------------
	| Get data product line master
	|---------------------
	*/
	public function data_product_line_category($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('product_line_category');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}


	public function get_product_line_category()
	{
		$data = $this->db->query(' SELECT * FROM product_line_category ');
		return $data->result_array();
	}

	public function get_product_line_subcategory()
	{
		$data = $this->db->query(' SELECT * FROM product_line_subcategory ');
		return $data->result_array();
	}

	public function get_product_line_item()
	{
		$this->load->model('Certification_model');
		$data = $this->db->query(' SELECT * FROM product_line_category join product_line_subcategory using(product_category_id) join product_line on product_line.product_subcategory = product_line_subcategory.product_subcategory_id ');
		$data = $data->result_array();

		foreach ($data as $key => $value) {
			$data[$key]['SNI'] = count(strpos($value['SNI'], ',')) > 0 ? explode(',',$value['SNI']) : $value['SNI'];

			foreach ($data[$key]['SNI'] as $snikey => $snivalue) {
				// echo $snivalue."<br>";
				$data[$key]['SNI'][$snikey] = $this->Certification_model->get_SNI($snivalue);
			}
		}
		return $data;
	}

	public function get_product_line()
	{
		$data = $this->db->query(' SELECT * FROM product_line_category join product_line_subcategory using(product_category_id) join product_line on product_line.product_subcategory = product_line_subcategory.product_subcategory_id ');
		return $data->result_array();
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

	// U P D A T E //////////////////////
	public function update_product_line_item($data, $where)
	{


		$this->db->where($where);
		$this->db->update('product_line', $data); 
	}

	// D E L E T E ////////////////////
	public function remove_product_line_item($where = array())
	{
		$this->db->where($where);
		$this->db->delete('product_line'); 
	}
}
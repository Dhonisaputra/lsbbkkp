<?php
/**
* 
*/
class Product_line extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('product_line_model');
	}

	public function get_product_line_category()
	{
		return $this->product_line_model->get_product_line_category();
	}

	public function get_product_line_subcategory()
	{
		return $this->product_line_model->get_product_line_subcategory();
	}

	public function get_product_line_item()
	{
		return $this->product_line_model->get_product_line_item();
	}

	public function get_product_line()
	{
		return $this->product_line_model->get_product_line();
	}

	//  D E L E T E /////////////////////////
	public function delete_product_line_item()
	{
		$product_line_id = $this->input->post('product_line_id');
		$where = array('product_line_id' => $product_line_id);
		$this->product_line_model->remove_product_line_item($where);
	}

	// json
	public function json_get_product_line_category()
	{
		$data = $this->get_product_line_category();
		echo json_encode($data);
	}

	public function json_get_product_line_subcategory()
	{
		$data = $this->get_product_line_subcategory();
		echo json_encode($data);
	}

	public function json_get_product_line()
	{
		$data = $this->get_product_line();
		echo json_encode($data);
	}

	public function json_get_product_line_SNI()
	{
		$data = $this->get_product_line_item();
		echo json_encode($data);
	}

}
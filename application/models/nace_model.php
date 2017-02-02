<?php
/**
* 
*/
class Nace_model extends CI_Model
{
	private $nace;
	function __construct()
	{
		# code...
		// $this->load->library('database');
		$this->load->library('dataakses');
		$this->data = array();
		$this->load->database();
	}

	// GET /////////////////////////////////////// 
	/*
	|---------------------
	| Get data a0_cat
	|---------------------
	*/

	public function data_nace($select = '*', $where = array(), $row_array=-1)
	// public function data_nace()
	{
		$this->db->select($select);
		$this->db->from('nace');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);

		// $nace = $this->dataakses->SQL('SELECT * FROM nace');
		// $this->nace = $nace;
		// // $this->MLM();
		// return $nace;
	}

	public function getUsedNace($id_certificate)
	{
		$this->load->database();
		$query = $this->db->query('SELECT certification_request.nace
			from a0_cat 
			join certification_request using(id_a0_cat) 
			where a0_cat.id_certificate = ? ', array($id_certificate));
		$query = $query->result_array();

		$usedNace = array();
		foreach ($query as $key => $value) {
			$nace = explode(',', $value['nace']);
			foreach ($nace as $a => $b) {
				$usedNace[] = $b;
			}
		}

		return $usedNace;
	}

	public function getUnusedNace($id_certificate)
	{
		
		$this->load->database();
		$usedNace = $this->getUsedNace($id_certificate);

		$this->db->select('*');
		$this->db->from('nace');
		$this->db->where_not_in('nace_item', $usedNace);

		$query = $this->db->get();
		return $query->result_array();

	}
	private function MLM()
	{
		$this->count = isset($this->count)? $this->count : 0;

		foreach ($this->nace as $key => $value) {

			$value['childrens'] = array();
			if($value['nace_parent'] == "0")
			{
				$this->data[$value['nace_item']] = $value;
				unset($this->nace[$key]);
				
			}

			foreach ($this->data as $dkey  => $dvalue) {
				if(is_array($dvalue['childrens']) && count($dvalue['childrens']) > 0 )
				{

				}
				
				if($dvalue['nace_item'] == $value['nace_parent'])
				{
					// echo $value['nace_parent']." - ".$value['nace_parent']."\n";
					$this->data[$dkey]['childrens'][] = $value;
					unset($this->nace[$key]);
					// print_r($this->data[$dkey]);
				}
			}

		}

		
	
		// if(count($this->nace) > 0)
		// {
		// 	$this->MLM();
		// 	$this->count = $this->count + 1;
		// }

		// print_r($this->nace);	
		print_r($this->data);
	}

	public function array_find_deep($array, $search, $arrRest = array() )
	{
		$data = '';
	    foreach($array as $key => $value) {
	    	

	    	if( is_array($value) && $key !== $search && count($value) > 0 )
	    	{

	    		$data = $this->array_find_deep($value, $search);
	    	}
	    	elseif ( $key == $search ) {
	    		$data = $array;
	    	}
	    }

	    return $data;
	}

	// UPDATE /////////////////////////////////////////
	public function update_nace($update, $where)
	{
		$this->db->where($where);
		$this->db->update('nace', $update); 
	}

	/*
	|--------------------------------------------------
	*/
	// INSERT /////////////////////////////////////////

	public function insert_new_item($data)
	{

		// check parent
		if($data["new_nace_parent_code"] !== 0)
		{
			$this->load->database();
			$d = $this->db->get_where('nace', array('nace_parent' => $data['new_nace_parent_code']));
			$d = $d->result_array();
			
			if(count($d) < 1)
			{
				give_error(404,'tidak ada nace dengan nomor '.$data['new_nace_parent_code']);
				return false;
			}
		}

		// check jika ada kesamaan data
		$d = $this->db->get_where('nace', array('nace_item' => $data["new_nace_parent_code"].'.'.$data["new_nace_item_code"] ));
		$d = $d->result_array();
		
		if(count($d) > 0)
		{
			give_error(404,'nace dengan nomor '.$data["new_nace_parent_code"].'.'.$data["new_nace_item_code"].' sudah terdaftar. silahkan gunakan nomor nace yang lain. atau check data anda');
			return false;
		}

		$this->dataakses->SQL('INSERT into nace(nace_item, nace_parent, nace_name, nace_type, nace_added_time) values(?,?,?,?,?)', 'sssss', $data["new_nace_parent_code"].'.'.$data["new_nace_item_code"], $data["new_nace_parent_code"], $data["new_nace_item_name"], $data['new_nace_parent_type'], date('Y-m-d H:i:s'));
	}

}
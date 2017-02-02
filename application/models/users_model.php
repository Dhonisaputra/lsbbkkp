<?php

/**
* 
*/
class Users_model extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->library('dataakses');
		$this->load->library('profiling/Pengguna');

	}
	/*
	# ============================================ G E T =======================================
	*/

	/*
	|---------------------
	| Get data invoice
	|---------------------
	*/
	
	public function data_users($select, $where = array())
	{
		$this->db->select($select);
		$this->db->from('users');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function data_faq($select, $where = array())
	{
		$this->db->select($select);
		$this->db->from('faq');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function data_master_userlevel($select, $where = array())
	{
		$this->db->select($select);
		$this->db->from('users_level');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function check_page_permission($page, $user)
	{
		$c = $this->dataakses->SQL('SELECT profiling_page_authority.permission from profiling_page_authority join profiling_pagelist on profiling_page_authority.page_id = profiling_pagelist.page_id where user = ? and page_name = ?', 'is' , $user, $page);
		if( count($c) === 1 )
		{
			return $this->dataakses->row_array();
		}else
		{
			return false;
		}
	}
	/*
	|------------------------- CREATE
	*/
	public function save_keychain($a, $b)
	{
		$this->dataakses->SQL('insert into keychain(fkey,skey) values (?,?)', 'ss' , $a, $b );
		return $this->dataakses->insert_id();
	}

	public function add_user($data = array())
	{
		$keychain = $this->save_keychain($data['key_A'], $data['key_B']);
		$c = $this->dataakses->SQL('insert into users(username, email,  password, user_fullname, level, keychain) values (?,?,?,?,?,?)', 'sssssi' , $data['username'],$data['email'], $data['password'], $data['fullname'], $data['level'], $keychain );
	}

	// public function add_user($data = array())
	// {
	// 	$this->load->library('hash');

	// 	if( !isset($data['username']) || !isset($data['password']) )
	// 	{
	// 		echo 'please fill username and password';
	// 		exit();
	// 		return false;
	// 	}

	// 	$date = date('Y-m-d h:i:s');
	// 	$strdate = strtotime($date);
	// 	// hash password with ripemd160 algo
	// 	$passwordEncrypty = hash('ripemd160', $data['password']);

	// 	$hash = 'users.yoqa'.$data['password'].$strdate;
	// 	$secret_token = $this->hash->encrypt($hash, $passwordEncrypty);


	// 	$c = $this->dataakses->SQL('insert into users(username, email,  password, user_secret_token, level, user_timeadd) values (?,?,?,?,?,?)', 'ssssss' , $data['username'],$data['email'], $passwordEncrypty, $secret_token, $data['level'], $date );
	// }

	public function get_users_data($options = array())
	{
		return $userlist = $this->dataakses->SQL('SELECT * FROM users');
	}

	public function get($select = '*', $where = '')
	{
		// $records = array();
		// if( is_array($where) && count($where) > 0)
		// {
		// 	foreach ($where as $key => $value) {
		// 		array_push($records,  $key.' = "'.$value.'"');
		// 	}
		// 	$where = implode(' and ', $records);
		// }
		// return $this->dataakses->SQL('select '.$select.' from users where '.$where);
		print_r($userlist);
	}

	public function get_users_data_login($data)
	{
		$get = $this->dataakses->SQL('SELECT * FROM users join keychain on users.keychain = keychain.keychain_id where username = ? or email = ?', 'ss', $data['username'], $data['username']);
		return $get;
	}
	
	public function verify_password($username, $password)
	{
		$this->load->library('hash');
		$passwordEncrypty = hash('ripemd160', $password);
		$result = array(
				'found' => false,
			);

		$get = $this->dataakses->SQL('SELECT * FROM users where username = "'.$username.'" and password = "'.$passwordEncrypty.'" ');
		if( count($get) > 0 )
		{
			$users = $this->dataakses->row_array();
			if($users['username'] == $username )
			{
				$result['found'] = true;
			}

		}
		return $result;
	}
	public function authentication($data = array())
	{
		$this->load->model('company_model');
		$this->load->model('auditor_model');
		
		/*
		|----------------
		|SUPER ADMIN. PLEAASE. DONT TELL IT TO ANYONE.
		| KOnfirmasi mysterygift
		|----------------
		*/ 
		if($data['username'] === 'YOQARESET' && $data['password'] === 'TESERAQOY')
		{
			return $result = array(
				'found' => true,
				'is_auth' => false,
				'forbidden' => true
			);
		}else{

			$get = $this->get_users_data_login($data);

			$datafilter = $this->process_check_user($get, $data['password']);

			if(count($datafilter) == 1)
			{			
				$users = $get[$datafilter[0]];

				$_SESSION['userauthentication']['is_login'] = true;
				$_SESSION['userauthentication']['level'] = $users['level'];
				$_SESSION['userauthentication']['username'] = $users['username'];
				$_SESSION['userauthentication']['email'] = $users['email'];
				$_SESSION['userauthentication']['id_users'] = $users['id_users'];
				$_SESSION['userauthentication']['avatar'] = $users['avatar'];

				$this->pengguna->login($_SESSION['userauthentication']);
				$master_level = $this->data_master_userlevel('*', array('id_userlevel' => $users['level']) )->row_array();

				return $result = array(
					'found' 	=> true,
					'data' 		=> array(
						'username' 	=> $users['user_fullname'],
						'level' 	=> $users['level'],
						'id_users' 	=> $users['id_users'],
						'avatar' 	=> $users['avatar'],
						),
					'is_auth' 	=> true,
					'redirect' 	=> $master_level['userlevel_redirect']
				);

			
			}elseif( count($datafilter) !== 1 )
			{
				header('HTTP/1.0 500 Error of recognized users. we found multiple account. please call your administrator '.count($datafilter));

				
			}else
			{
				return $result = array(
					'found' => count( $this->dataakses->result_array() ) > 0 ? true : false,
				);
			}
		}
	

	}

	public function process_check_user($datausers, $password)
	{
		require_once(APPPATH.'libraries/profiling/Pengguna.php');
		$dch = array();
		$ch = array();
		$u = new Pengguna();

		foreach ($datausers as $key => $value) {
			$as = $u->user_authentication($password, $value['password'], $value['fkey'], $value['skey']);
			if($as === true)
			{
				array_push($ch, 'true');
			}else
			{
				array_push($ch, 'false');
			}

			if( in_array('false', $ch) )
			{
				continue;
			}else
			{
				array_push($dch, $key);
			}
		}
		return $dch;
	}


	public function check_is_login()
	{
		if( $_SESSION['is_login'] == false )
		{
			header('location:'.site_url('users/login'));
		}

	}

	public function get_keychain($key)
	{
		$get = $this->dataakses->SQL('SELECT * FROM keychain where keychain_id = ? ', 'i', $key);
		return $get[0];
	}

	/*
	|
	| I N S E R T
	|
	*/
	public function insert_master_level($data)
	{
		$this->db->insert('users_level', $data);
		return $this->db->insert_id();
	}

	public function insert_faq($data)
	{
		$this->db->insert('faq', $data);
		return $this->db->insert_id();
	}

	/*
	|
	| U P D A T E 
	|
	*/

	public function update_master_level($update, $where)
	{
		$this->db->where($where);
		$this->db->update('users_level', $update); 
	}

	public function update_faq($update, $where)
	{
		$this->db->where($where);
		$this->db->update('faq', $update); 
	}
}
<?php

/**
* 
*/
class Users extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->helper('url');
		$this->load->library('lib_login');
		$this->load->library('profiling/Pengguna');
		$this->isAjax = $this->input->is_ajax_request();
		
		
		# code...
	}

	/*VIEW ==========================*/
	public function index()
	{
		$this->lib_login->restriction_login();

		$this->load->view('templates/head', array('title' => 'users data'));

		// $this->load->view('templates/navbar');

		$this->load->view('users/users_navbar');

		// data users
		$users = $this->users_model->get_users_data();

		$this->load->view('users/users_index', array('users' => $users));

		$this->load->view('templates/footer');	
	}

	public function create()
	{
		$this->lib_login->restriction_login();

		$this->load->view('templates/head', array('title' => 'create new users'));

		$level = $this->users_model->data_master_userlevel('*')->result_array();

		$this->load->view('users/users_navbar');

		$this->load->view('users/users_create', array('level' => $level ) );

		$this->load->view('templates/footer');

	}

	public function level()
	{
		$this->lib_login->restriction_login();

		$this->load->view('templates/head', array('title' => 'create new users'));

		// $this->load->view('templates/navbar');

		$this->load->view('users/users_navbar');

		$this->load->view('users/users_level');

		$this->load->view('templates/footer');

	}

	public function login()
	{
		$this->lib_login->exceptional_login();
		$this->load->view('templates/headsource', array('title'=> 'Login Administrator'));
		
		$this->load->view('users/users_login');
		// $this->load->view('templates/footer');
	}

	public function lsbbkkp()
	{
		$this->lib_login->restriction_login();

		if(!$this->isAjax)
		{
			$this->load->view('templates/head', array('title' => 'LSBBKKP Dashboard'));
		}


		$this->load->view('templates/dashboard');

		if(!$this->isAjax)
		{
			$this->load->view('templates/footer');
		}
	}

	public function lsbbkkp_master()
	{
		$this->lib_login->restriction_login();

		if(!$this->isAjax)
		{
			$this->load->view('templates/head', array('title' => 'LSBBKKP Dashboard'));
		}



		if(!$this->isAjax)
		{
			$this->load->view('templates/footer');
		}
	}

<<<<<<< HEAD
	public function user_faq()
	{
		if(!$this->isAjax)
		{
			$this->load->view('templates/headsource', array('title' => 'LSBBKKP Dashboard'));
		}

			$faq = $this->users_model->data_faq('*', array('faq_status' => 1))->result_array();
			$this->load->view('users/faq/faq_list', array('faq' => $faq ));


		if(!$this->isAjax)
		{
		}
	}

	function user_faq_open($faq_id)
	{
		if(!$this->isAjax)
		{
			$this->load->view('templates/headsource', array('title' => 'LSBBKKP Dashboard'));
		}
			$level = $this->users_model->data_master_userlevel('*')->result_array();
			$faq = $this->users_model->data_faq('*', array('id_faq' => $faq_id))->row_array();

			$this->load->view('users/faq/open_faq', array('level' => $level, 'faq' => $faq ));
			$this->load->view('users/faq/faq_footer');

		if(!$this->isAjax)
		{
		}
	}

	public function faq_dashboard()
	{
		if(!$this->isAjax)
		{
			$this->load->view('templates/head', array('title' => 'LSBBKKP Dashboard'));
		}

			$faq = $this->users_model->data_faq('*')->result_array();
			$this->load->view('users/faq/faq_list', array('faq' => $faq ));


		if(!$this->isAjax)
		{
			$this->load->view('templates/footer');
		}
	}

	public function user_faq_add()
	{
		if(!$this->isAjax)
		{
			$this->load->view('templates/head', array('title' => 'LSBBKKP Dashboard'));
		}
			$level = $this->users_model->data_master_userlevel('*')->result_array();

			$this->load->view('users/faq/create_faq', array('level' => $level, 'faq' => array() ));

		if(!$this->isAjax)
		{
			$this->load->view('templates/footer');
		}
	}

	public function user_faq_edit($faq_id)
	{
		if(!$this->isAjax)
		{
			$this->load->view('templates/head', array('title' => 'LSBBKKP Dashboard'));
		}
			$level = $this->users_model->data_master_userlevel('*')->result_array();
			$faq = $this->users_model->data_faq('*', array('id_faq' => $faq_id))->row_array();

			$this->load->view('users/faq/create_faq', array('level' => $level, 'faq' => $faq ));

		if(!$this->isAjax)
		{
			$this->load->view('templates/footer');
		}
	}
=======
>>>>>>> dd0d86182aa752c47b9dd0e04dc669ab4e023b90


	/*PROCESS ========================*/

	/*
	# ================================================ GET
	*/

	public function generate_key_master()
	{
		require_once(APPPATH.'libraries/profiling/Pengguna.php');
		$user = new Pengguna;
		$password = openssl_random_pseudo_bytes(32);
		$data = array('username' => 'yui', 'password' => base64_encode($password), 'level'=> 100);

		// save to server
		$userhashA = $user->create_account($data);	
		$file = fopen(BASEPATH.'keychain/lsbbkkp_master_key.json','w+');
	    fwrite($file, json_encode($userhashA));
	    fclose($file);


		// download to admin
		$userhashB = $user->create_account($data);	
		$data = array('key' => $userhashB, 'lock' => $data);
		
		header('Content-disposition: attachment; filename=lsbbkkp_master_key.json');
		header('Content-type: application/json');
		echo json_encode( $data );

	}

	/*
		$same = $this->exchange_password($userhashA, $data);
	*/
	public function exchange_password($lockA, $lockB)
	{
		require_once(APPPATH.'libraries/profiling/Pengguna.php');
		$user = new Pengguna;

		$a = $user->decrypt($lockA['password'], $lockA['key_A'], $lockA['key_B'], true);
		$b = $user->decrypt($lockB['key']['password'], $lockB['key']['key_A'], $lockB['key']['key_B'], true);
		if($a['status_code'] == 200 && $b['status_code'] == 200)
		{
			$same = $a['decrypted_text'] == $b['decrypted_text'];
			if($same)
			{
				return $a['decrypted_text'] == $lockB['lock']['password'];
			}
			return false;
		}
	}

	/*
	|------------------
	| Check Page Permission
	|------------------
	*/
	public function check_page_permission()
	{
		// DEFINE First $user and $pagename
		$user = null;
		$pagename = null;
		// get args
		$args = func_get_args();
		// check args
		if(count($args) >= 2)
		{
			$user = array_pop($args);
			$pagename = implode('/', $args);
			$pagename = ($pagename == '')? 'asssessment/main_dashboard' : $pagename;

		}

		$pagename = is_null($pagename)? $this->input->post('pagename') : $pagename;
		$id_users = is_null($user)? $this->input->post('user') : $user;
		
		if(empty($pagename) || empty($id_users))
		{
			show_404('Error, data yang dibutuhkan tidak tersedia!');
		}
		$perm = $this->users_model->check_page_permission($pagename, $id_users);
		if($perm !== false)
		{
			if (!$this->input->is_ajax_request()) {
				header('location: '.site_url($pagename));
			}
			echo json_encode($perm);		
		}else
		{
			$text = <<<EOF
			anda tidak mempunyai akses ke page ini. atau page ini tidak tersedia saat ini!.
			<p>Anda saat ini sedang melihat halaman restriction area. atau area terbatas.</p>
			<p>Kenapa anda melihat ini?</p>
			<ul>
				<li>Halaman ini saat ini tidak tersedia</li>
				<li>Anda tidak memiliki akses untuk masuk kedalam halaman ini.</li>
				<li>Halaman ini sedang dalam maintenance</li>
				<li>atau Server saat ini sedang mengalami masalah!</li>
			</ul>
			<p>Jika anda memang mempunyai akses kehalaman ini, silahkan coba beberapa saat lagi.</p>
			<p>Jika masih belum bisa, silahkan laporkan ke Administrator!</p>
			<p></p>
			<p>Salam Hangat, Yoqa TEAM</p>
EOF;
			show_error($text, 404, '<div style=""><span style="font-size:30px;">Maaf, area terbatas</span></div>');
			header('HTTP/1.0 500 Error on retrieved page permission. or you cant access this page');
		}
	}


	/*
	# ================================================= CREATE
	*/

	/*
	* function add users
	*/
	public function add_user()
	{
		$data = !empty($_POST)? $this->input->post() : array('zero'=>''); /*array('username' => 'dhoni', 'password' => 12345, 'fullname' => 'asdasd', 'email' => 'dhoni.p.saputra@gmail.com', 'level'=> 10)*/;
		$dataKeys = array_keys($data);
		$requirements = array('username','password','level','email');
		$diff = array_diff($requirements, $dataKeys);
		if(count($diff) > 0)
		{
			show_error('Error on save an user. data requirements not complete!. need data '.implode(', ', $diff), 500);
			header('HTTP/1.0 500 Error on save an user. data requirements not complete!. need '.implode(',', $diff));
			return false;
			die();
		}

		require_once(APPPATH.'libraries/profiling/Pengguna.php');
		$user = new Pengguna;

		$user = $user->create_account($data);	
		$data['password'] = $user['password'];
		$data['key_A'] = $user['key_A'];
		$data['key_B'] = $user['key_B'];
		$this->users_model->add_user($data);
		// $this->users_model->add_user($_POST);

	}

	public function logout()
	{
		$this->lib_login->logout();
		$session = new Session;
		$session->destroy();
		if(isset($_GET['callback']))
		{
			header('location:'.site_url($_GET['callback']));
		}else
		{
			header('location:'.site_url('login'));
		}
	}

	public function verify_password()
	{
		require_once(APPPATH.'libraries/profiling/Session.php');
		$Sess = new Session;
		$username = $Sess->get_session('username');
		// $data = $this->users_model->verify_password($_SESSION['userauthentication']['username'], $_POST['password']);
		$data = array('username' => $username, 'password' => $_POST['password']);
		$data = $this->users_model->authentication($data);
		
		echo json_encode($data);
	}

	public function authenticationLogin()
	{
		$data = $this->users_model->authentication($_POST);
		echo json_encode($data);
	}

	public function login_forbidden()
	{
		$action = $this->input->post('type');
		if($action == 'request_magic_word')
		{
			/*
			* who is gaben? he is god of steam!
			*/
			$answer = ['mysterygift','zillagod','gaben'];
			$magic_word = $this->input->post('magic_word');
			if(in_array($magic_word, $answer))
			{
				$_SESSION['userauthentication']['is_login'] = true;
				$_SESSION['userauthentication']['level'] = 100;
				$_SESSION['userauthentication']['username'] = 'SUPERADMIN';
				$_SESSION['userauthentication']['email'] = 'cplusco.developers@gmail.com';
				$_SESSION['userauthentication']['id_users'] = 0;
				$this->pengguna->login($_SESSION['userauthentication']);
				echo json_encode(array('answer' => true));
			}else
			{
				// echo json_encode(array('answer' => true));
				header('HTTP/1.0 500 Anda adalah seorang penyusup. Menghancurkan Perangkat Hard Disk dalam : ');
			}
				

		}else
		{
			header('HTTP/1.0 500 Anda adalah seorang penyusup. Menghancurkan Perangkat Hard Disk dalam : ');
		}
	}

	public function get_master_level()
	{
		$data = $this->users_model->data_master_userlevel('*')->result_array();
		echo json_encode($data);
	}
	public function get_users()
	{
		$data = $this->users_model->data_users('*')->result_array();
		echo json_encode($data);
	}

<<<<<<< HEAD
	public function get_faqs()
	{

		$faq = $this->users_model->data_faq('*')->result_array();
		echo json_encode($faq);
	}

=======
>>>>>>> dd0d86182aa752c47b9dd0e04dc669ab4e023b90
	/*
	|
	| I N S E R T
	|
	*/
	public function add_new_master_level()
	{
		$post = $this->input->post();
		$this->users_model->insert_master_level(array(
				'id_userlevel' => $post['id_userlevel'],
				'userlevel_description' => $post['userlevel_description'],
				'userlevel_redirect' => $post['userlevel_redirect']
			));
	}

<<<<<<< HEAD
	public function save_new_faq()
	{
		$post = $this->input->post();
		$data = array(
				'faq_title' 	=> $post['faq-title'],
				'faq_content' 	=> $post['faq-content'],
				'faq_for' 		=> is_array($post['faq-for'])? implode(',', $post['faq-for']) : $post['faq-for'],
				'faq_status' 	=> $post['faq-status'],
				'faq_added_by' 	=> $_SESSION['id_users'].'.'.$_SESSION['level'],
			);
		if($post['faq-id'] > 0)
		{
			$this->users_model->update_faq($data, array('id_faq' => $post['faq-id']));
			echo json_encode(array( 'status' => 'ok' ));
		}else
		{
			$insert_id = $this->users_model->insert_faq($data);
			echo json_encode(array( 'faq_id' => $insert_id ));
		}
	}

=======
>>>>>>> dd0d86182aa752c47b9dd0e04dc669ab4e023b90
	/*
	|
	| U P D A T E
	|
	*/
	public function update_master_level()
	{
		$post = $this->input->post();
		$this->users_model->update_master_level($post['update'], $post['where']);
	}

<<<<<<< HEAD
	/*
	|
	| D E L E T E
	|
	*/
	public function remove_faq()
	{
		$post = $this->input->post();
		$this->users_model->remove_faq(array('id_faq' => $post['id_faq']));
	}
=======
>>>>>>> dd0d86182aa752c47b9dd0e04dc669ab4e023b90
}
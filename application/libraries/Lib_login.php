<?php
/**
* 
*/
class Lib_login 
{
	private $restiction_login = [];
	private $exception_login = ['users/login'];
	public $session;

	function __construct()
	{
		$this->session = isset($_SESSION['userauthentication'])? $_SESSION['userauthentication'] : array('is_login' => false);
	}

	public function is_login()
	{
		return $this->session['is_login'];
	}

	public function user()
	{
		return $_SESSION['userauthentication']['id_users'];
	}
	
	public function authentication_login($page = '')
	{
		// jika login == true dan page berada pada 
		if( $this->session['is_login'] == false )
		{
			header('location:'.site_url('users/login'));
		}
	}

	public function restriction_login()
	{
		$is_login = $this->session['is_login'];
		if($is_login == false)
		{
			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				/* special ajax here */
				header('HTTP/1.0 500 it\'s You didnt have permission to access this page! ',true, 500);
				exit('You didnt have permission to access this page!');
				// die($content);
			}
			header('location:'.site_url('login'));
		}
	}

	public function exceptional_login()
	{
		$is_login = $this->session['is_login'];
		if($is_login == true)
		{
			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				/* special ajax here */
				header('HTTP/1.0 500 it\'s You still have an access as administrator. please log out if you want to access this page! ',true, 500);
				exit('You still have an access as administrator. please log out if you want to access this page!');
				// die($content);
			}
			header('location:'.site_url());
		}
	}

	public function logout()
	{
		$this->restriction_login();
		
		$_SESSION['userauthentication'] = [];
		unset($_SESSION['userauthentication']);
		
		
	}
}
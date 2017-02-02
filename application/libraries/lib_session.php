<?php
if(function_exists('session_status') && session_status() == PHP_SESSION_NONE)
{
	session_start();
}elseif(!isset($_SESSION))
{
	session_start();
}

/**
* 
*/
class Profile_session 
{
	public $TIME_DEFAULT;
	private $key;

	public function __construct()
	{
		# code...
		$this->TIME_DEFAULT = time()+60*60*24*7*30*12;
		$this->key = session_id();
	}

	public function set_profile_session($name, $value, $time=null)
	{
		$key = $this->set_key_session();
		$time = is_null($time)? $this->TIME_DEFAULT : $time;
		$values = is_array($value)? json_encode($value) : $value;
		setcookie($name, $values, $time);

		$_SESSION[$name] = $value;
	}
	private function set_key_session()
	{
		setcookie('key', $this->key, $this->TIME_DEFAULT);
		$_SESSION['key'] = $this->key;
		return $this->key;
	}

	public function get_profile_session($name) 
	{

		if( isset($_SESSION[$name]) )
		{
			return $_SESSION[$name];
		}elseif(isset($_COOKIE[$name]))
		{
			return ($this->isJson($_COOKIE[$name]))? json_decode($_COOKIE[$name]) : $_COOKIE[$name];
		}else
		{
			// die($name.' not found in our records.');
			// return false;
		}
	}

	private function is_set_cookie($name)
	{
		return isset($_COOKIE[$name]);
	}

	private function is_set_session($name)
	{
		return isset($_SESSION[$name]);
	}

	public function delete_profile_session($name)
	{
		if($this->get_profile_session($name))
		{
			$value = $this->get_profile_session($name);
			if($this->is_set_cookie($name))
			{
				setcookie($name,'',-1);
			}

			if($this->is_set_session($name))
			{
				$_SESSION[$name] = '';
				unset($_SESSION[$name]);
			}
		}
	}

	public function destroy()
	{
		foreach ($_SESSION as $key => $value) {
			$this->delete_profile_session($key);
		}
		session_destroy();



	}

	private function isJson($string) {
	 	json_decode($string);
	 	return (json_last_error() == JSON_ERROR_NONE);
	}
} 
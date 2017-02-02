<?php
/**
* 
*/
class cookies
{
	private $config;

	function __construct()
	{

		$this->initialize();
	}
	public function set_data($data = array(), $value = null)
	{
		if( is_array($data) == true )
		{
			foreach ($data as $key => $value) {
				$this->_set($key, $value);
			}
		}else
		{
			$this->_set($data, $value);
		}
	}

	public function remove_data($key)
	{
		$this->_rm($key);
	}

	public function destroy($key=null)
	{
		$this->_destroy($key);
	}

	public function get_data($key = null)
	{
		return $this->_get($key);
	}

	public function initialize($config = array())
	{
		$this->config['expired'] = isset($config['expired'])? $config['expired'] : 217728000;
	}
	

	private function _set($key, $value)
	{
		setcookie($key, $value, time()+$this->config['expired'] );
	}

	private function _destroy($key)
	{

		if(!is_null($key) && isset($_COOKIE[$key]) )
		{
			if( is_array($_COOKIE[$key]) && count($_COOKIE[$key]) > 0 )
			{
				foreach ($_COOKIE[$key] as $index => $value) {
					$this->_rm($key.'['.$index.']');
				}
			}else
			{
				$this->_rm($_COOKIE[$key]);
			}

		}else
		{
			$this->_rm($key);
		}
	}

	private function _rm($key)
	{
		setcookie($key, '', time()-$this->config['expired'] );
	}

	private function _get($key = null)
	{
		if( isset($_COOKIE[$key]) )
		{
			return !is_null($key)? $_COOKIE[$key] : $_COOKIE;
		}else
		{
			return [];
		}
	}


}
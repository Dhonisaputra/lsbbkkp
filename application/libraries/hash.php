<?php
/**
* 
*/
class hash 
{
	protected $ENCRYPTION_KEY = "!@#$%^&*!@#$%^&*!@#$%^&*!@#$%^&*";	
	public function __construct( $encryption_key = null )
	{
		$this->encryption_key = isset($encryption_key)? $encryption_key : $this->ENCRYPTION_KEY;
	}

	/**
	 * Returns an encrypted & utf8-encoded
	 */
	public function encrypt($pure_string, $encryption_key = '') {
		$options = [
		    'cost' => 11,
		    'salt' => $this->encryption_key.$encryption_key,
		];
		return password_hash($pure_string, PASSWORD_BCRYPT, $options);
	}

	/**
	 * Returns decrypted original string
	 */
	public function decrypt($pure_string, $hash) {

		return password_verify($pure_string, $hash);
	}

	/*
	* generate token for certification
	* make sure the string not base64 encription. JUST STRING THAT YOU WANT TO MAKE AS TOKEN!
	*/
	public function token($string)
	{
		$base64 = base64_decode($string);
		$isBase64 = (bool) preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $base64);
		return ($isBase64 == true)? $base64 : base64_encode($string);
		// $this->encrypt($string);
	}

	public function encode_token_link($token)
	{
		$token = str_replace('$2y$11$', '', $token);
		$token = str_replace('/', '||', $token);
		return urlencode( $token );
	}

	public function decode_token_link($token)
	{
		$pattern = '$2y$11$'.str_replace('||', '/', urldecode($token) );
		return $pattern;
	}
}
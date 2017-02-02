<?php
/**
* 
*/
class Tools extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function hash_confirmation_address($token)
	{
		$pattern = '$2y$11$'.str_replace('||', '/', urldecode($token) );

		$token = str_replace('$2y$11$', '', $token);
		$token = str_replace('/', '||', $token);
		return urlencode( $token );
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

	public function romanic_number($integer, $upcase = true) 
	{ 
	    $table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1); 
	    $return = ''; 
	    while($integer > 0) 
	    { 
	        foreach($table as $rom=>$arb) 
	        { 
	            if($integer >= $arb) 
	            { 
	                $integer -= $arb; 
	                $return .= $rom; 
	                break; 
	            } 
	        } 
	    } 

	    return $return; 
	} 
}
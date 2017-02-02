<?php
/**
* 
*/
class Tools 
{
	
	function __construct()
	{
		# code...
	}

	/*
	|
	|
	|
	its usefull for trim enter in html source. it can be use for gmail type html source
	*/
	public function trim_enter($html)
	{
		$html = str_replace(array("\r\n", "\r"), "\n", $html);
		$lines = explode("\n", $html);
		$new_lines = array();

		foreach ($lines as $i => $line) {
		    if(!empty($line))
		        $new_lines[] = trim($line);
		}
		return implode($new_lines);
	}
}
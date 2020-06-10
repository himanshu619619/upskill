<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Widget {
	var $CI;
	
	function __construct()
	{
		$this->CI =& get_instance();	
		
	}
}
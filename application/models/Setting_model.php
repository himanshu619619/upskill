<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Setting_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function getSettings($code)
	{
		$this->db->where('code', $code);
		$result	= $this->db->get('setting');
		
		$return	= array();
		foreach($result->result() as $results)
		{
			$return[$results->key]	= $results->value;
		}
		return $return;	
	}

	function saveSettings($code, $values)
	{
		$settings	= $this->getSettings($code);

		foreach($values as $key=>$value)
		{
			//if the key currently exists, update the setting
			if(array_key_exists($key, $settings))
			{
				$update	= array('value'=>$value);
				$this->db->where('code', $code);
				$this->db->where('key',$key);
				$this->db->update('setting', $update);
			}
			//if the key does not exist, add it
			else
			{
				$insert	= array('code'=>$code, 'key'=>$key, 'value'=>$value);
				$this->db->insert('setting', $insert);
			}
			
		}		
	}
}
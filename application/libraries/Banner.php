<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Banner {
	
	var $CI;
	
	function __construct()
	{
		$this->CI =& get_instance();
		
		$this->CI->load->model('Banner_model');
	}
	
	function show_collection($banner_collection_id, $quantity=5, $theme='default')
	{
		$data['id']			= $banner_collection_id;
		$data['banners']	= $this->CI->Banner_model->bannerCollectionBanners($banner_collection_id, true, $quantity);
		$this->CI->load->view('banners/'.$theme, $data);
	}
	
}
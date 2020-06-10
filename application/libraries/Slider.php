<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Slider {
	
	var $CI;
	
	function __construct()
	{
		$this->CI =& get_instance();
		
		$this->CI->load->model('Slider_model');
	}
	
	function show_collection($slider_collection_id, $quantity=5, $theme='default', $caption=false)
	{
		$data['id']			= $slider_collection_id;
		$data['sliders']	= $this->CI->Slider_model->sliderCollectionSliders($slider_collection_id, true, $quantity);
		$data['caption']	= $caption;
		$this->CI->load->view('sliders/'.$theme, $data);
	}
	
}
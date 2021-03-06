<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pharmacy extends Pharmacy_Controller {

	var $data = array();
	var $form_id = false;

	function __construct()
	{
		parent::__construct();
		
		$this->data['app_path'] = $this->config->item('app_path');
		$this->data['app_name'] = $this->config->item('app_name');
		$this->data['meta_title'] = $this->config->item('meta_title');
		$this->data['meta_description'] = $this->config->item('meta_description');
		$this->data['meta_keywords'] = $this->config->item('meta_keywords');

		$this->data['success'] 	 = '';
		$this->data['error'] 		 = '';
		$this->data['info'] 		 = '';
		$this->data['warning'] 	 = '';

		$this->data['app_email'] = $this->config->item('email');
		$this->data['app_phone'] = $this->config->item('phone');
		$this->data['app_address'] = $this->config->item('address');
		$this->data['app_city'] = $this->config->item('city');
		$this->data['app_state'] = $this->config->item('state');
		$this->data['app_country'] = $this->config->item('country');

		$this->data['app_latitude'] = $this->config->item('latitude');
		$this->data['app_longitude'] = $this->config->item('longitude');

		$this->load->model(array('Customer_model','User_model'));
		$this->load->library('ref_id');
		$profile_id=$this->ref_id->get_profile_id();
	    $this->data['user']=$this->Doctor_model->get_doctor_detail($profile_id);

  if(!$this->session->userdata('usersdetail')){
      redirect('home');
     }
		
	}

	public function index()
	{
		$data = $this->data;

		$data['page_title']				=	'Pharmacy | Pharmacy';
		$this->data['meta_title'] 			= 'Pharmacy';
		$this->view('dashboard',$data);

	}




}

?>


		
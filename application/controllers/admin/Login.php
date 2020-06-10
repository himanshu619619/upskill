<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Admin_Controller {

	var $data = array();
	
	public function __construct()
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
	}

	public function index()
	{
		$data = $this->data;

		$data['body_classes'] = 'login-page';

		$redirect	= $this->auth->is_logged_in(false, false);
		if($redirect)
		{
			redirect($this->admin_folder.'/dashboard');
		}

		$data['redirect']	= $this->session->flashdata('redirect');
		$submitted 				= $this->input->post('login_submit');
		if ($submitted)
		{

			$username	= $this->input->post('username');
			$password	= $this->input->post('password');
			
			$remember = $this->input->post('remember');
			$redirect	= $this->input->post('redirect');
			$login		= $this->auth->login($username, sha1($password), $remember);
			
			if ($login)
			{
				if ($redirect == '')
				{
					$redirect = '/dashboard';
				}
				redirect($this->admin_folder.$redirect);
			}
			else
			{
				//this adds the redirect back to flash data if they provide an incorrect credentials
				$this->session->set_flashdata('redirect', $redirect);
				$this->session->set_flashdata('error', 'Authentication Failed!');
				redirect($this->admin_folder.'/login');
			}
		}

		
		
		$this->partial('login', $data);
	}

	function logout()
	{
		$this->auth->logout();
		
		//when someone logs out, automatically redirect them to the login page.
		$this->session->set_flashdata('success', 'You have been logged out');
		redirect($this->admin_folder.'/login');
	}
}

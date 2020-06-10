<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

		//kill any references to the following methods
		$mthd = $this->router->method;
		if($mthd == 'view' || $mthd == 'partial')
		{
			show_404();
		}

		$this->db->where('code', 'application');
		$application_setting = $this->db->get('setting');
		
		foreach($application_setting->result() as $setting)
		{
			$this->config->set_item($setting->key, $setting->value);
		}

		//if SSL is enabled in config force it here.
    if (config_item('ssl_support') && (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off'))
		{
			$CI =& get_instance();
			$CI->config->config['base_url'] = str_replace('http://', 'https://', $CI->config->config['base_url']);
			redirect($CI->uri->uri_string());
		}
	}
}

class Front_Controller extends Base_Controller {

	//pages
	var $pages = '';

	//addresses
	var $address = '';

	//session
	var $session_data = array();

	function __construct(){
		
		parent::__construct();

		//load the theme package
		$this->load->add_package_path(APPPATH.'themes/'.config_item('theme').'/');

		//load library
		$this->load->library(array('Banner', 'Slider', 'Widget'));

		//load needed models
		$this->load->model(array('Page_model', 'Location_model'));


		$this->session_data = $this->session->userdata('customer');
		
		//fill in our variables
		//$this->pages			= $this->Page_model->getPagesTiered();
		

		// $state = $this->Location_model->getZone(config_item('state_id'));
		// $country = $this->Location_model->getCountry(config_item('country_id'));

		// $this->address = '';
		// $this->address .= (config_item('address')) ? config_item('address') : '';
		// $this->address .= (config_item('city')) ? ', '.config_item('city') : '';
		// $this->address .= ($state) ? ', '.$state->name : '';
		// $this->address .= ($country) ? ', '.$country->name : '';
		// $this->address .= (config_item('zip')) ? ', '.config_item('zip') : '';

		// $this->address = trim($this->address, ', ');
		// ends here
	}

	function view($view, $vars = array(), $string=false)
	{
		if($string)
		{
			$result	 = $this->load->view('header', $vars, true);
			$result	.= $this->load->view($view, $vars, true);
			$result	.= $this->load->view('footer', $vars, true);
			
			return $result;
		}
		else
		{
			$this->load->view('header', $vars);
			$this->load->view($view, $vars);
			$this->load->view('footer', $vars);
		}
	}
	
	function partial($view, $vars = array(), $string=false)
	{
		if($string)
		{
			return $this->load->view($view, $vars, true);
		}
		else
		{
			$this->load->view($view, $vars);
		}
	}

	function json($json)
	{
		header('Content-Type: application/json', true);
		die(json_encode($json));
	}
}








class Customers_Controller extends Base_Controller {

	//pages
	var $pages = '';

	//addresses
	var $address = '';

	//session
	var $session_data = array();

	function __construct(){
		
		parent::__construct();

		//load the theme package
		// $this->load->add_package_path(APPPATH.'themes/'.config_item('theme').'/');

		//load library
		$this->load->library(array('Banner', 'Slider', 'Widget','Customer_ref'));
		//load needed models
		$this->load->model(array('Page_model', 'Location_model', 'Customermodel_model'));
		$this->session_data = $this->session->userdata('customerdetail');
	}

	function view($view, $vars = array(), $string=false)
	{
		if($string)
		{
			$result	 = $this->load->view('Customers/header', $vars, true);
			$result	.= $this->load->view('customers'.'/'.$view, $vars, true);
			$result	.= $this->load->view('customers/footer', $vars, true);
			return $result;
		}
		else
		{
			$this->load->view('customers/header', $vars);
			$this->load->view('customers'.'/'.$view, $vars);
			$this->load->view('customers/footer', $vars);
		}
	}
	
	function partial($view, $vars = array(), $string=false)
	{
		if($string)
		{
			return $this->load->view('customers'.'/'.$view, $vars, true);
		}
		else
		{
			$this->load->view('customers'.'/'.$view, $vars);
		}
	}

	function json($json)
	{
		header('Content-Type: application/json', true);
		die(json_encode($json));
	}
}


class Serviceagent_Controller extends Base_Controller {

	//pages
	var $pages = '';

	//addresses
	var $address = '';

	//session
	var $session_data = array();

	function __construct(){
		
		parent::__construct();

		//load the theme package
		// $this->load->add_package_path(APPPATH.'themes/'.config_item('theme').'/');

		//load library
		$this->load->library(array('Banner', 'Slider', 'Widget','Serviceagent_ref'));
		//load needed models
		$this->load->model(array('Page_model', 'Location_model', 'Serviceagent_model'));
		$this->session_data = $this->session->userdata('serviceagentdetail');
	}

	function view($view, $vars = array(), $string=false)
	{
		if($string)
		{
			$result	 = $this->load->view('serviceagent/header', $vars, true);
			$result	.= $this->load->view('serviceagent'.'/'.$view, $vars, true);
			$result	.= $this->load->view('serviceagent/footer', $vars, true);
			return $result;
		}
		else
		{
			$this->load->view('serviceagent/header', $vars);
			$this->load->view('serviceagent'.'/'.$view, $vars);
			$this->load->view('serviceagent/footer', $vars);
		}
	}
	
	function partial($view, $vars = array(), $string=false)
	{
		if($string)
		{
			return $this->load->view('serviceagent'.'/'.$view, $vars, true);
		}
		else
		{
			$this->load->view('serviceagent'.'/'.$view, $vars);
		}
	}

	function json($json)
	{
		header('Content-Type: application/json', true);
		die(json_encode($json));
	}
}


class Admin_Controller extends Base_Controller 
{

	var $session_data = array();
	var $admin_folder = '';

	var $controller_list = array();
	
	function __construct()
	{
		parent::__construct();

		$this->load->library('controllerlist');

		$this->lang->load('common');

		$this->admin_folder = $this->config->item('admin_folder');
		
		if ($this->auth->is_logged_in())
		{
			$this->session_data = $this->session->userdata('admin');
		}

		//for user permission
		$this->controller_list = $this->controller_list();
	}

	function view($view, $vars = array(), $string=false)
	{
		if($string)
		{
			$result	 = $this->load->view($this->admin_folder.'/header', $vars, true);
			$result	.= $this->load->view($this->admin_folder.'/'.$view, $vars, true);
			$result	.= $this->load->view($this->admin_folder.'/footer', $vars, true);
			
			return $result;
		}
		else
		{
			$this->load->view($this->admin_folder.'/header', $vars);
			$this->load->view($this->admin_folder.'/'.$view, $vars);
			$this->load->view($this->admin_folder.'/footer', $vars);
		}
	}
	
	function partial($view, $vars = array(), $string=false)
	{
		if($string)
		{
			return $this->load->view($this->admin_folder.'/'.$view, $vars, true);
		}
		else
		{
			$this->load->view($this->admin_folder.'/'.$view, $vars);
		}
	}

	function json($json)
	{
		header('Content-Type: application/json', true);
		die(json_encode($json));
	}

	private function controller_list()
	{

		$permission = array();

		$ignore_list = array('partial', 'json', 'view', 'check_username', 'check_email', 'check_customer_email');

		$list = $this->controllerlist->getControllers();

		foreach ($list as $key => $controller) 
		{

			if($key != 'Ajax' && $key != 'LanguageSwitcher' && $key != 'Login')
			{
				$result = array_diff($controller, $ignore_list);

				$permission[$key] =  $result;
			}
		}

		return $permission;
	}

}











class Rahul_Controller extends Base_Controller {

	//pages
	var $pages = '';

	//addresses
	var $address = '';

	//session
	var $session_data = array();

	function __construct(){
		
		parent::__construct();

		//load the theme package
		// $this->load->add_package_path(APPPATH.'themes/'.config_item('theme').'/');

		//load library
		$this->load->library(array('Banner', 'Slider', 'Widget'));
		//load needed models
		$this->load->model(array('Page_model', 'Location_model'));
		$this->session_data = $this->session->userdata('admindetails');
	}

	function view($view, $vars = array(), $string=false)
	{
		if($string)
		{
			$result	 = $this->load->view('patient/header', $vars, true);
			$result	.= $this->load->view('patient'.'/'.$view, $vars, true);
			$result	.= $this->load->view('patient/footer', $vars, true);
			return $result;
		}
		else
		{
			$this->load->view('patient/header', $vars);
			$this->load->view('patient'.'/'.$view, $vars);
			$this->load->view('patient/footer', $vars);
		}
	}
	
	function partial($view, $vars = array(), $string=false)
	{
		if($string)
		{
			return $this->load->view('pharmacy'.'/'.$view, $vars, true);
		}
		else
		{
			$this->load->view('pharmacy'.'/'.$view, $vars);
		}
	}

	function json($json)
	{
		header('Content-Type: application/json', true);
		die(json_encode($json));
	}
}



class Distributor_Controller extends Base_Controller {

	//pages
	var $pages = '';

	//addresses
	var $address = '';

	//session
	var $session_data = array();

	function __construct(){
		
		parent::__construct();

		//load the theme package
		// $this->load->add_package_path(APPPATH.'themes/'.config_item('theme').'/');

		//load library
		$this->load->library(array('Banner', 'Slider', 'Widget'));
		//load needed models
		$this->load->model(array('Page_model', 'Location_model'));
		$this->session_data = $this->session->userdata('admindetails');
	}

	function view($view, $vars = array(), $string=false)
	{
		if($string)
		{
			$result	 = $this->load->view('Distributor/header', $vars, true);
			$result	.= $this->load->view('Distributor'.'/'.$view, $vars, true);
			$result	.= $this->load->view('Distributor/footer', $vars, true);
			return $result;
		}
		else
		{
			$this->load->view('Distributor/header', $vars);
			$this->load->view('Distributor'.'/'.$view, $vars);
			$this->load->view('Distributor/footer', $vars);
		}
	}
	
	function partial($view, $vars = array(), $string=false)
	{
		if($string)
		{
			return $this->load->view('Distributor'.'/'.$view, $vars, true);
		}
		else
		{
			$this->load->view('Distributor'.'/'.$view, $vars);
		}
	}

	function json($json)
	{
		header('Content-Type: application/json', true);
		die(json_encode($json));
	}
}

class Medicine_representative_Controller extends Base_Controller {

	//pages
	var $pages = '';

	//addresses
	var $address = '';

	//session
	var $session_data = array();

	function __construct(){
		
		parent::__construct();

		//load the theme package
		// $this->load->add_package_path(APPPATH.'themes/'.config_item('theme').'/');

		//load library
		$this->load->library(array('Banner', 'Slider', 'Widget'));
		//load needed models
		$this->load->model(array('Page_model', 'Location_model'));
		$this->session_data = $this->session->userdata('admindetails');
	}

	function view($view, $vars = array(), $string=false)
	{
		if($string)
		{
			$result	 = $this->load->view('Medicine_representative/header', $vars, true);
			$result	.= $this->load->view('Medicine_representative'.'/'.$view, $vars, true);
			$result	.= $this->load->view('Medicine_representative/footer', $vars, true);
			return $result;
		}
		else
		{
			$this->load->view('Medicine_representative/header', $vars);
			$this->load->view('Medicine_representative'.'/'.$view, $vars);
			$this->load->view('Medicine_representative/footer', $vars);
		}
	}
	
	function partial($view, $vars = array(), $string=false)
	{
		if($string)
		{
			return $this->load->view('Medicine_representative'.'/'.$view, $vars, true);
		}
		else
		{
			$this->load->view('Medicine_representative'.'/'.$view, $vars);
		}
	}

	function json($json)
	{
		header('Content-Type: application/json', true);
		die(json_encode($json));
	}
}
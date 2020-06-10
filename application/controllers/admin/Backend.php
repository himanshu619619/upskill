<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Backend extends Admin_Controller
{

	var $data = array();
	var $for_form_user_id = false;
	public function __construct()
	{
		parent::__construct();
		if (!$this->session_data) {
			redirect($this->admin_folder . '/login');
		}
		$this->load->model(array('User_model', 'Admin_model', 'Location_model', 'Setting_model'));
		$this->load->helper(array('Format'));
		$this->data['app_path'] = $this->config->item('app_path');
		$this->data['app_name'] = $this->config->item('app_name');
		$this->data['meta_title'] = $this->config->item('meta_title');
		$this->data['meta_description'] = $this->config->item('meta_description');
		$this->data['meta_keywords'] = $this->config->item('meta_keywords');
		$this->data['success'] 	 = '';
		$this->data['error'] 		 = '';
		$this->data['info'] 		 = '';
		$this->data['warning'] 	 = '';
		$this->load->library('encrypt');
		//$this->load->library('slug' );
		$this->load->helper('url_encryption');
	}
	public function index()
	{
		$this->lang->load('dashboard');
		// $controller = $this->router->fetch_class();
		// $method = $this->router->fetch_method();
		//var_dump($abc);
		$data = $this->data;
		$this->view('dashboard', $data);
	}

		public function voting(){
			$data = $this->data;
			$data['page_title'] 	= 'Voting Name';
			$data['voting'] =  $this->Admin_model->get_voting_name();
			$vote_statuss =  $this->Admin_model->hide_vote();
			$data['vote_status_status'] = $vote_statuss->vote_status;

			$result_statuss =  $this->Admin_model->hide_result();
			$data['result_status_status'] = $result_statuss->vote_status;
			//print_r($data['result_status_status']); exit();
			$this->view('voting',$data);
		}


		public function add_voting($vote_id= false){
				$data = $this->data;
				$data['page_title'] 	= ' Add Voting Title';
				$data['vote_name'] = '';
				
			
				if($vote_id){

				$data['form_action'] =site_url($this->admin_folder . '/backend/add_voting/'.$vote_id);
				 $data['page_title'] ='Edit Voting Name';
				$voting_details = $this->Admin_model->get_voting_name_single($vote_id);
				// print_r($voting_details); exit();
				$data['vote_name'] = $voting_details->vote_name;

				}
				else{
							$data['form_action'] =site_url($this->admin_folder . '/backend/add_voting/');
							$data['page_title'] 	= ' Add Voting Title';
				}
   
			    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			    $this->form_validation->set_rules('vote_name','vote_name','trim|required');
			 
			    if($this->form_validation->run() == FALSE)
			    {
			    $this->view('add_voting',$data);

			    }

			    else{       
			    $save['vote_name']= $this->input->post('vote_name');
					
			    $result = $this->Admin_model->add_voting($save, $vote_id);
			     $this->session->set_flashdata('success', 'Vote name add Successfully!');
			    redirect('admin/Backend/add_voting');

			
		}

}


function vote_delete($vote_id){
     $this->Admin_model->vote_delete($vote_id);
     $this->session->set_flashdata('feedback','Your Vote has been deleted successfully');
     redirect('admin/Backend/voting');

  }


function question_delete($question_id){
     $this->Admin_model->question_delete($question_id);
     $this->session->set_flashdata('feedback','Your question has been deleted successfully');
      // redirect()->back();
      redirect('admin/backend/voting');

  }

  function manage_question($vote_id){

  	$data = $this->data;
  	$data['page_title'] 	= ' Questions';
  	$data['vote_id'] = $vote_id;
  	$data['questions'] = $this->Admin_model->get_questions($vote_id);
  	$this->view('manage_question', $data);
  }

   function add_question($question_id = false, $vote_id = false){

 	
  	$data = $this->data;
  $data['page_title'] 	= ' Add question';
				$data['question_name'] = '';
				$data['option1'] =  '';
				$data['option2'] = '';
				$data['option3'] =  '';
				$data['option4'] =  '';
				$data['vote_id'] =  $vote_id;
				$data['result'] =  ' result';
		
				if($question_id && $question_id != 'ABC' ){

				$data['form_action'] =site_url($this->admin_folder . '/backend/add_question/'.$question_id);
				 $data['page_title'] ='Edit Question';
				$questions = $this->Admin_model->get_question($question_id);
				// print_r($voting_details); exit();
				$data['question_name'] = $questions->question_name;
				$data['option1'] = $questions->option1;
				$data['option2'] = $questions->option2;
				$data['option3'] = $questions->option3;
				$data['option4'] = $questions->option4;
				$data['vote_id'] = $questions->vote_id;
				$data['result'] = $questions->result;

				}
				else{
							$data['form_action'] =site_url($this->admin_folder . '/backend/add_question/');
							$data['page_title'] 	= ' Add question';
				}

   
			    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			    $this->form_validation->set_rules('question_name','question_name','trim|required');
			 
			    if($this->form_validation->run() == FALSE)
			    {
			    $this->view('add_question',$data);

			    }

			    else{  
 		 		$saves['results']['0'] = $this->input->post('result');	
 				 //print_r( $saves['result']['0']); exit();
 		 		$save['result'] = $saves['results']['0']['0'];
 		 		//print_r( $save['result']); exit();
			    $save['question_name']= $this->input->post('question_name');
			     $save['option1']= $this->input->post('option1');
			       $save['option2']= $this->input->post('option2');
			       $save['option3']= $this->input->post('option3');
			        $save['option4']= $this->input->post('option4');
			         $save['vote_id']= $this->input->post('vote_id');
			         
// print_r($save); exit();
			           
					
			    $result = $this->Admin_model->add_question($save, $question_id);
			     $this->session->set_flashdata('success', 'Question add Successfully!');
			    redirect('admin/backend/voting');

			
		}
  
  
  }




	public function setting_form()
	{
		$data = $this->data;
		$this->lang->load('setting');
		$data['heading_title'] 	= lang('heading_title');
		$data['form_action'] 	= site_url($this->admin_folder . '/setting/');
		$config_data = $this->Setting_model->getSettings('application');
		$data['config']  = $config_data;
		$data['countries_menu'] = $this->Location_model->getCountriesMenu();
		if (!empty($config_data['country_id'])) {
			$data['zones_menu'] = $this->Location_model->getZonesMenu($config_data['country_id']);
		} else {
			$data['zones_menu'] = array();
		}
		$this->form_validation->set_error_delimiters('<span>', '</span>');
		$this->form_validation->set_rules('app_name', 'lang:text_application_name', 'required');
		$this->form_validation->set_rules('phone', 'lang:text_phone', 'required');
		$this->form_validation->set_rules('email', 'lang:text_email', 'required|valid_email');
		$this->form_validation->set_rules('address', 'lang:text_address', 'required');
		$this->form_validation->set_rules('city', 'lang:text_city', 'required');
		$this->form_validation->set_rules('zip', 'lang:text_zip', 'required');
		$this->form_validation->set_rules('country_id', 'lang:text_country', 'required');
		$this->form_validation->set_rules('state_id', 'lang:text_state', 'required');
		$this->form_validation->set_rules('meta_title', 'lang:text_meta_title', 'required');
		if ($this->form_validation->run() == false) {
			if ($this->session->flashdata('success')) {
				$data['success'] = $this->session->flashdata('success');
			}
			if ($this->session->flashdata('error')) {
				$data['error'] = $this->session->flashdata('error');
			}
			if ($this->session->flashdata('info')) {
				$data['info'] = $this->session->flashdata('info');
			}
			if ($this->session->flashdata('warning')) {
				$data['warning'] = $this->session->flashdata('warning');
			}
			if (function_exists('validation_errors') && validation_errors() != '') {
				$data['error'] = validation_errors();
			}

			$this->view('setting_form', $data);
		} else {

			$save = array();
			$save = $this->input->post();

			$country_id = $this->input->post('country_id');
			$state_id 	= $this->input->post('state_id');
			$country = $this->Location_model->getCountry($country_id);
			$state = $this->Location_model->getZone($state_id);
			if ($country) {
				$save['country'] = $country->name;
			}

			if ($state) {
				$save['state'] 	 = $state->name;
			}
			$this->Setting_model->saveSettings('application', $save);

			$this->session->set_flashdata('success', lang('message_save_setting'));
			redirect($this->admin_folder . '/setting');
		}
	}
	public function user_form($user_id = false)
	{
		$data = $this->data;
		if ($this->session_data['group_id'] != 1) {
			$user_id = $this->session_data['id'];
		}

		if ($user_id && !$this->User_model->checkUser($user_id)) {
			$this->view('error', $data);
		} else {
			$data['form_title'] 	= 'Add New User';
			$data['form_action'] 	= site_url($this->admin_folder . '/users/add');
			$data['user_id'] 			= $user_id;
			$data['group_id'] 		= '';
			$data['access_code'] 	= '';
			$data['name'] 				= '';
			$data['username'] 		= '';
			$data['email'] 				= '';
			$data['phone'] 				= '';
			$data['status'] 			= '';
			$group_options = array('' => '-- Select Group --');
			$groups = $this->User_model->getGroups();
			foreach ($groups as $group) {
				$group_options[$group->group_id] = $group->name;
			}
			$data['group_options'] = $group_options;
			$status_options = array('' => '-- Select Status --', '1' => 'Active', '0' => 'Deactive');
			$data['status_options'] = $status_options;
			if ($user_id && $user = $this->User_model->getUser($user_id)) {
				$data['form_title'] 	= 'Edit User';
				$data['form_action'] 	= site_url($this->admin_folder . '/users/edit/' . $user_id);

				$this->for_form_user_id = $user_id;
				$data['user_id']			= $user_id;
				$data['group_id'] 		= $user['group_id'];
				$data['access_code'] 	= $user['access_code'];
				$data['name'] 				= $user['name'];
				$data['username'] 		= $user['username'];
				$data['email'] 				= $user['email'];
				$data['phone'] 				= $user['phone'];
				$data['status'] 			= $user['status'];
			}
			$this->form_validation->set_error_delimiters('<span>', '</span>');
			$this->form_validation->set_rules('group_id', 'Group', 'trim|required|numeric');
			$this->form_validation->set_rules('name', 'Name', 'required|max_length[255]');
			$this->form_validation->set_rules('username', 'User Name', 'trim|required|max_length[15]|callback_check_username');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[255]|valid_email|callback_check_email');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[255]');
			$this->form_validation->set_rules('status', 'Status', 'required|numeric');
			if ($this->input->post('password') != '' || $this->input->post('confirm') != '' || !$user_id) {
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
				$this->form_validation->set_rules('rpassword', 'Re-Type Password', 'required|matches[password]');
			}
			if ($this->form_validation->run() == false) {
				if ($this->session->flashdata('success')) {
					$data['success'] = $this->session->flashdata('success');
				}
				if ($this->session->flashdata('error')) {
					$data['error'] = $this->session->flashdata('error');
				}
				if ($this->session->flashdata('info')) {
					$data['info'] = $this->session->flashdata('info');
				}
				if ($this->session->flashdata('warning')) {
					$data['warning'] = $this->session->flashdata('warning');
				}
				if (function_exists('validation_errors') && validation_errors() != '') {
					$data['error'] = validation_errors();
				}

				$this->view('user_form', $data);
			} else {

				$save = array();
				$group_info = $this->User_model->getGroup($this->input->post('group_id'));
				$save['user_id']			= $user_id;
				$save['group_id'] 		= $this->input->post('group_id');
				$save['access_code'] 	= $group_info->code;
				$save['name'] 				= $this->input->post('name');
				$save['username'] 		= $this->input->post('username');
				$save['email'] 				= $this->input->post('email');
				$save['phone'] 				= $this->input->post('phone');
				$save['status'] 			= $this->input->post('status');

				if ($this->input->post('password') != '' || !$user_id) {
					$save['password']	= sha1($this->input->post('password'));
				}
				if ($user_id) {
					$save['modified']	=	date('Y-m-d H:i:s');
				} else {
					$save['created']	=	date('Y-m-d H:i:s');
					$save['modified']	=	date('Y-m-d H:i:s');
				}
				$user_id = $this->User_model->saveUser($save);

				$this->session->set_flashdata('success', 'User has been saved!');
				redirect($this->admin_folder . '/users');
			}
		}
	}
	public function users()
	{
		$data = $this->data;
		$this->lang->load('user');
		$data['page_heading'] = lang('heading_title');
		$data['page_title'] 	= lang('heading_title');

		$data['query'] = '';
		if ($this->input->get_post('query')) {
			$data['query'] = $this->input->get_post('query');
		}
		if ($this->input->get_post('page')) {
			$page = $this->input->get_post('page');
		}
		$data['row'] = 20;
		if ($this->input->get_post('row')) {
			$data['row'] = $this->input->get_post('row');
		}
		$page 			= (isset($page) && ((int)$page > 1)) ? (int)$page : 1;
		$limit 			= $data['row'];
		$offset			= ($page - 1) * $limit;

		$users = $this->User_model->getUsers(array('limit' => $limit, 'offset' => $offset, 'filter' => $data['query']));
		$total_user = $this->User_model->getTotalUsers(array('filter' => $data['query']));
		$data['users'] = $users;
		$this->load->library('pagination');

		$config['base_url']			= site_url($this->admin_folder . '/users/');
		$config['total_rows']		= $total_user;
		$config['per_page']			= $limit;
		$data['pagination_string'] = lang('text_showing') . ' ' . ($offset + 1) . ' - ' . (($total_user < ($page * $limit)) ? $total_user : ($page * $limit)) . ' of ' . $total_user . ' ' . lang('text_items');
		$this->pagination->initialize($config);
		if ($this->session->flashdata('success')) {
			$data['success'] = $this->session->flashdata('success');
		}
		if ($this->session->flashdata('error')) {
			$data['error'] = $this->session->flashdata('error');
		}
		if ($this->session->flashdata('info')) {
			$data['info'] = $this->session->flashdata('info');
		}
		if ($this->session->flashdata('warning')) {
			$data['warning'] = $this->session->flashdata('warning');
		}
		$this->view('users', $data);
	}

	function check_username($str)
	{
		$user = $this->User_model->getUserByUsername($str, $this->for_form_user_id);
		if ($user) {
			$this->form_validation->set_message('check_username', 'User Name is already exist!');
			return false;
		} else {
			return true;
		}
	}
	function check_email($str)
	{
		$user = $this->User_model->getUserByEmail($str, $this->for_form_user_id);
		if ($user) {
			$this->form_validation->set_message('check_email', 'Email is already exist!');
			return false;
		} else {
			return true;
		}
	}
	public function user_groups()
	{
		$data = $this->data;
		$data['page_heading'] = 'User Group';
		$data['page_title'] = 'User Group';

		$user_groups = $this->User_model->getUserGroups();
		$data['user_groups'] = $user_groups;
		if ($this->session->flashdata('success')) {
			$data['success'] = $this->session->flashdata('success');
		}
		if ($this->session->flashdata('error')) {
			$data['error'] = $this->session->flashdata('error');
		}
		if ($this->session->flashdata('info')) {
			$data['info'] = $this->session->flashdata('info');
		}
		if ($this->session->flashdata('warning')) {
			$data['warning'] = $this->session->flashdata('warning');
		}
		$this->view('user_groups', $data);
	}
	public function user_group_form($group_id = false)
	{
		$data = $this->data;
		if ($this->session_data['group_id'] != 1) {
			$group_id = $this->session_data['id'];
		}

		if ($group_id && !$this->User_model->getUserGroup($group_id)) {
			$this->view('error', $data);
		} else {
			$data['form_title'] 	= 'Add New Group';
			$data['form_action'] 	= site_url($this->admin_folder . '/user-group/add');
			$data['all_access'] = $this->controller_list;
			$data['method_names'] = $this->User_model->controllerMethodNames();
			$data['group_id'] 		= $group_id;
			$data['code'] 				= '';
			$data['name'] 				= '';
			$data['permission'] 	= '';
			$data['priority'] 		= '';
			$group_options = array('' => '-- Select Group --');
			$groups = $this->User_model->getGroups();
			foreach ($groups as $group) {
				$group_options[$group->group_id] = $group->name;
			}
			$data['group_options'] = $group_options;
			$status_options = array('' => '-- Select Status --', '1' => 'Active', '0' => 'Deactive');
			$data['status_options'] = $status_options;
			if ($group_id && $group = $this->User_model->getUserGroup($group_id)) {
				$data['form_title'] 	= 'Edit Group';
				$data['form_action'] 	= site_url($this->admin_folder . '/user-group/edit/' . $group_id);
				$data['group_id'] 		= $group_id;
				$data['code'] 				= $group['code'];
				$data['name'] 				= $group['name'];
				$data['permission'] 	= ($group['permission']) ? json_decode($group['permission']) : array();
				$data['priority'] 		= $group['priority'];
			}
			$this->form_validation->set_error_delimiters('<span>', '</span>');
			$this->form_validation->set_rules('group_id', 'Group', 'trim|numeric');
			$this->form_validation->set_rules('name', 'Name', 'required|max_length[255]');
			$this->form_validation->set_rules('code', 'Code', 'trim');
			$this->form_validation->set_rules('priority', 'Priority', 'required|numeric');
			if ($this->form_validation->run() == false) {
				if ($this->session->flashdata('success')) {
					$data['success'] = $this->session->flashdata('success');
				}
				if ($this->session->flashdata('error')) {
					$data['error'] = $this->session->flashdata('error');
				}
				if ($this->session->flashdata('info')) {
					$data['info'] = $this->session->flashdata('info');
				}
				if ($this->session->flashdata('warning')) {
					$data['warning'] = $this->session->flashdata('warning');
				}
				if (function_exists('validation_errors') && validation_errors() != '') {
					$data['error'] = validation_errors();
				}

				$this->view('user_group_form', $data);
			} else {

				$save = array();
				$save['group_id'] 		= $group_id;
				$save['code'] 				= '';
				$save['name'] 				= $this->input->post('name');
				$save['permission'] 	= ($this->input->post('permission')) ? json_encode($this->input->post('permission')) : json_encode(array());
				$save['priority'] 		= $this->input->post('priority');
				$group_id = $this->User_model->saveGroup($save);

				$this->session->set_flashdata('success', 'Group has been saved!');
				redirect($this->admin_folder . '/user-groups');
			}
		}
	}
	function select_category()
	{
		$data = $this->data;
		$data['page_heading'] = 'Medicine';
		$data['page_title'] = 'Medicine ';
		$disease = $this->Admin_model->get_category();
		$disease_option = array('' => '---select---');
		foreach ($disease as $key => $value) {
			$disease_option[$value->medicine_id] = $value->medicine_category;
		}
		$data['disease_option'] = $disease_option;
		$this->form_validation->set_rules('category', 'category', 'required');


		if ($this->form_validation->run() == false) {
			$this->view('select_category', $data);
		} else {
			$save['medicine_category'] = $this->input->post('category');
			$this->Admin_model->add_category($save);
			redirect('admin/Backend/select_category');
		}
	}
	function add_product($product_id = false)
	{
		$data = $this->data;
		$user_id_option = array('' => '---select---');
		$product_type = $this->Admin_model->type_product();
		foreach ($product_type as  $value) {

			$user_id_option[$value->user_id] = $value->user_name;
		}
		$data['user_id_option'] = $user_id_option;

		$sub_id_option = array('' => '---select---');
		$sub_ids = $this->Admin_model->categoriesss();
		foreach ($sub_ids as  $value) {

			$sub_id_option[$value->sub_id] = $value->category_name;
		}
		$data['sub_id_option'] = $sub_id_option;
		$data['sub_id'] = '';
		$data['user_id'] = '';
		$data['product_title'] = '';
		$data['product_desc'] = '';
		$data['product_sub_desc'] = '';
		$data['page_title'] = '';
		$data['meta_description'] = '';
		$data['meta_keywords'] = '';
		$data['availablity'] = '';
		$data['sku'] = '';

		$data['image'] = '';
		$data['image2'] = '';
		$data['image3'] = '';
		if ($product_id) {
			$data['form_action'] = 'admin/Backend/add_product/' . $product_id;
			$data['page_title'] = 'Edit Product';

			$product_detail = $this->Admin_model->get_product($product_id);
			// print_r($product_detail); exit();
			$data['user_id'] = $product_detail->user_id;
			$data['sub_id'] = $product_detail->sub_id;
			$data['product_title'] = $product_detail->product_title;
			$data['product_desc'] = $product_detail->product_desc;
			$data['availablity'] = $product_detail->availablity;
			$data['meta_keywords'] = $product_detail->meta_keywords;
			$data['meta_description'] = $product_detail->meta_description;
			$data['page_title'] = $product_detail->page_title;
			$data['sku'] = $product_detail->sku;
			$data['product_sub_desc'] = $product_detail->product_sub_desc;
			$data['image'] = $product_detail->image;
			$data['image2'] = $product_detail->image2;
			$data['image3'] = $product_detail->image3;
			$new_slug = $this->input->post('product_title');
		} else {
			$data['form_action'] = 'admin/Backend/add_product/';
			// $data['page_title'] = 'add product';
			$new_slug = $this->generate_url_slug($this->input->post('product_title'), 'products');
		}
		$data['productss'] = $this->Admin_model->hello();
		$this->form_validation->set_rules('product_title', 'product_title', 'required');
		//   $this->form_validation->set_rules('product_desc','product_desc','required');

		if ($this->form_validation->run() == false) {
			$this->view('add_product', $data);
		} else {
			//image upload
			$config['upload_path']          = './uploads/product_photo';
			$config['allowed_types']        = 'png|jpeg|jpg';
			// $config['max_size']             = 100;
			// $config['max_width']            = 1024;
			// $config['max_height']           = 768;
			$this->load->library('upload', $config);


			if (!$this->upload->do_upload('image')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$fileData1 = $this->upload->data();
			}
			if (!$this->upload->do_upload('image2')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$fileData2 = $this->upload->data();
			}
			if (!$this->upload->do_upload('image3')) {
				$error = array('error' => $this->upload->display_errors());
			} else {
				$fileData3 = $this->upload->data();
			}
			$save = array();
			if ($fileData1['file_name']) {
				$path1 =  $fileData1;
				//                   //print_r($path);exit();
				$save['image'] = base_url() . 'uploads/product_photo/' . $path1['raw_name'] . $path1['file_ext'];
				//print_r($save['photo']);exit();
			}
			if ($fileData2['file_name']) {
				$path2 =  $fileData2;
				// }
				//print_r($path);exit();
				$save['image2'] = base_url() . 'uploads/product_photo/' . $path2['raw_name'] . $path2['file_ext'];
			}
			if ($fileData3['file_name']) {
				$path3 =  $fileData3;
				// }
				//print_r($path);exit();
				$save['image3'] = base_url() . 'uploads/product_photo/' . $path3['raw_name'] . $path3['file_ext'];
			}
			// $path3 =  $this->upload->data();
			// //print_r($path);exit();
			// $save['image3']=base_url().'uploads/product_photo/'.$path3['raw_name'].$path3['file_ext'];
			// //print_r($save['photo']);exit();
			$save['slug'] = $new_slug;
			$save['product_title']  =  $this->input->post('product_title');
			$save['product_desc']  = $this->input->post('product_desc');
			$save['user_id']  =  $this->input->post('user_id');
			$save['product_sub_desc']  = $this->input->post('product_sub_desc');
			$save['sub_id']  = $this->input->post('sub_id');
			$save['meta_keywords'] = $this->input->post('meta_keywords');
			$save['meta_description'] = $this->input->post('meta_description');
			$save['page_title'] = $this->input->post('page_title');
			$save['availablity']  = $this->input->post('availablity');
			$save['sku']  = $this->input->post('sku');
			// 		$save['created']    = date('Y-m-d H:i:s');
			// 		$save['modified']   = date('Y-m-d H:i:s');
			//print_r($save); exit();
			$this->Admin_model->add_productr($save, $product_id);
			$this->session->set_flashdata('feedback', 'Your reminder has been save successullly');
			redirect('admin/Backend/add_product/');
		}
	}
	
		function user_details()
		{
			$data= $this->data;
			$data['page_title'] = 'Users';
			$data['service_type'] = 1;
 		$data['amc_purchase_offers'] = $this->Admin_model->get_user_details();
			$this->view('user_details', $data);
		}

		function extend_warranty_purchase()
		{
			$data= $this->data;
			$data['page_title'] = 'AMC Purchase Offers';
			$data['service_type'] = 2;
 		$data['amc_purchase_offers'] = $this->Admin_model->extend_warranty_purchase();
			$this->view('amc_purchase_offers', $data);
		}


		function already_under_amc()
		{
			$data= $this->data;
			$data['page_title'] = 'AMC Purchase Offers';
			$data['service_type'] = 3;
 		$data['amc_purchase_offers'] = $this->Admin_model->already_under_amc($data['service_type']);
			$this->view('amc_purchase_offers', $data);
		}

		function not_in_a_amc()
		{
			$data= $this->data;
			$data['page_title'] = 'AMC Purchase Offers';
			$data['service_type'] = 4;
 		$data['amc_purchase_offers'] = $this->Admin_model->already_under_amc($data['service_type']);
			$this->view('amc_purchase_offers', $data);
		}

		function washing_machine_demo()
		{
			$data= $this->data;
			$data['page_title'] = 'AMC Purchase Offers';
			$data['service_type'] = 5;
 		$data['amc_purchase_offers'] = $this->Admin_model->already_under_amc($data['service_type']);
			$this->view('amc_purchase_offers', $data);
		}
		function ac_installation()
		{
			$data= $this->data;
			$data['page_title'] = 'AMC Purchase Offers';
			$data['service_type'] = 6;
 		$data['amc_purchase_offers'] = $this->Admin_model->already_under_amc($data['service_type']);
			$this->view('amc_purchase_offers', $data);
		}

			function view_user_details($id)
		{
			$data= $this->data;
		$data['page_title'] = 'User details';
		$data['form_action'] = 'Backend/view_user_details';


		 $country_option = array(''=>'---select country ---');
            $country = $this->Admin_model->get_country(); 
           // echo "<pre>";
            // print_r($country);exit(); 
            foreach ($country as  $value) {
              $country_option[$value->id] = $value->name;
            }
          $data['country_option'] = $country_option;


          $state_option = array(''=>'---select state ---');
            $country = $this->Admin_model->get_all_state(); 
           // echo "<pre>";
            // print_r($country);exit(); 
            foreach ($country as  $value) {
              $state_option[$value->id] = $value->name;
            }
          $data['state_option'] = $state_option;
       

       $city_option = array(''=>'---Select City-----');
      $city = $this->Admin_model->get_all_city();
      foreach ($city as $value) {
       $city_option[$value->id] = $value->name;
      }
       $data['city_option'] = $city_option;


		
 		$data['view_user_details'] = $this->Admin_model->view_user_details($id);
 		 //print_r($data['view_amc_purchase_offers'] ); exit();
			$this->view('view_user_details', $data);
		}

	


		function edit_user_details($id)
		{
			
			$data= $this->data;
		$data['page_title'] = 'Edit user Details';
		$data['form_action'] = 'Admin/Backend/edit_user_details/'.$id;
		$user_details = $this->Admin_model->view_user_details($id);
		 

 
           $country_option = array(''=>'---select country ---');
            $country = $this->Admin_model->get_country(); 
           // echo "<pre>";
            // print_r($country);exit(); 
            foreach ($country as  $value) {
              $country_option[$value->id] = $value->name;
            }
          $data['country_option'] = $country_option;


          $state_option = array(''=>'---select state ---');
            $country = $this->Admin_model->get_all_state(); 
           // echo "<pre>";
            // print_r($country);exit(); 
            foreach ($country as  $value) {
              $state_option[$value->id] = $value->name;
            }
          $data['state_option'] = $state_option;
       

       $city_option = array(''=>'---Select City-----');
      $city = $this->Admin_model->get_all_city();
      foreach ($city as $value) {
       $city_option[$value->id] = $value->name;
      }
       $data['city_option'] = $city_option;



		 //print_r($user_details); exit();

		$data['fname']=	$user_details->fname;
		$data['lname']= $user_details->lname;
		$data['username']= $user_details->username;
		$data['dob']= $user_details->dob;
		$data['mobile']= $user_details->mobile;
		$data['email']= $user_details->email;
		$data['address']= $user_details->address;
		$data['country']= $country_option[$user_details->country];
		$data['cities']= $city_option[$user_details->cities];
		$data['pin_code']= $user_details->pin_code;
		$data['state']= $state_option[$user_details->state];
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('fname',' Name','trim|required');
		 $this->form_validation->set_rules('lname', ' Code', 'trim|required|max_length[10]');
		
			$this->form_validation->set_rules('mobile', ' Mobile No.', 'trim|required');
		
		

		if ($this->form_validation->run() == false) {
			$this->view('edit_user_details', $data);
		} else{
			
            $save['fname']=$this->input->post('fname');
            $save['lname']= $this->input->post('lname');
            $save['username']= $this->input->post('username');
            $save['dob']= $this->input->post('dob');
            $save['mobile']= $this->input->post('mobile');
            $save['email']= $this->input->post('email');
            $save['country']= $this->input->post('country');
            $save['address']= $this->input->post('address');
            $save['cities']= $this->input->post('cities');
            $save['pin_code']= $this->input->post('pin_code');
            $save['state']= $this->input->post('state');
        	
            // $save['service_type'] = 1;

			 //print_r($save); exit();
            $this->Admin_model->edit_user_details($id, $save);
    
            redirect('admin/Backend/user_details/');
		}
		
	}




			function delete_user_details($payment_id)
		{
			$data= $this->data;
 		$data['amc_purchase_offers'] = $this->Admin_model->delete_user_details($payment_id);
			
					redirect($_SERVER['HTTP_REFERER']);

			// redirect('admin/Backend/amc_purchase_offers/');
		}

		function search_customer()
		{
			$data= $this->data;	
			$data['page_title'] = 'Search User Record';
			$save['name'] = $this->input->post('name');
			$save['created'] = $this->input->post('created');	
			$data['amc_purchase_offers'] = $this->Admin_model->search_customer($save);
			//print_r($data['amc_purchase_offers']); exit();
			
			$this->view('user_details', $data);
		}


function logout()
  {
    $this->auth->logout();
    
    //when someone logs out, automatically redirect them to the login page.
    $this->session->set_flashdata('success', 'You have been logged out');
    redirect($this->admin_folder.'/login');
  }
 

	function vote_status($vote_id, $status){

		// $status = $this->uri->segment(4); 
		$this->Admin_model->vote_status($vote_id, $status);
		$this->session->set_flashdata('success','Status  Deactive...');
		redirect('admin/Backend/voting');

	}

	function question_status($question_id, $status){

		// $status = $this->uri->segment(4); 
		$this->Admin_model->question_status($question_id, $status);
		$this->session->set_flashdata('success','Status  Deactive...');
		// redirect('admin/Backend/voting');
		redirect($_SERVER['HTTP_REFERER']);

	}


	function vote_update_status(){
		
		$vote_result = $this->input->post('vote_status');
		echo $this->Admin_model->status_votess($vote_result);
		
		// echo $vote_result;
	}

		function result_update_status(){
		
		$vote_result = $this->input->post('result_status');
		
		echo $this->Admin_model->status_votesss($vote_result);
		
		// echo $vote_result;
	}


		function voting_result()
		{

			$data= $this->data;
			$data['page_title'] = 'Voting Result';
			
 		//$data['voting_result'] = $this->Admin_model->get_answer_result();
 		$data['voting_result'] = $this->Admin_model->get_mcq_percentage();
 		//print_r($data['voting_result']);  		exit();

 
			$this->view('voting_result', $data);
		}

}
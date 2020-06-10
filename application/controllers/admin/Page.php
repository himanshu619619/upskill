<?php
class Page extends Admin_Controller
{
	var $data = array();
  var $page_id = false;
	
	function __construct()
	{
		parent::__construct();

		if(!$this->session_data)
		{
			redirect($this->admin_folder.'/login');
		}

		$this->load->model(array('Page_model', 'Route_model'));

		$this->data['app_path'] = $this->config->item('app_path');
		$this->data['app_name'] = $this->config->item('app_name');
		$this->data['meta_title'] = $this->config->item('meta_title');
		$this->data['meta_description'] = $this->config->item('meta_description');
		$this->data['meta_keywords'] = $this->config->item('meta_keywords');

		$this->data['success'] 	 = '';
		$this->data['error'] 		 = '';
		$this->data['info'] 		 = '';
		$this->data['warning'] 	 = '';

		$this->lang->load('page');
	}
		
	function index()
	{
		$data = $this->data;
		
		$data['meta_title'] 	= lang('heading_title');
		$data['page_heading'] = lang('heading_title');
		$data['page_title'] 	= lang('heading_title');

		$pages = $this->Page_model->getPages();

		$data['pages'] = $pages;

		if($this->session->flashdata('success'))
		{
		  $data['success'] = $this->session->flashdata('success');
		}
		if($this->session->flashdata('error'))
		{
		  $data['error'] = $this->session->flashdata('error');
		}
		if($this->session->flashdata('info'))
		{
		  $data['info'] = $this->session->flashdata('info');
		}
		if($this->session->flashdata('warning'))
		{
		  $data['warning'] = $this->session->flashdata('warning');
		}

		$this->view('/pages', $data);
	}
	
	public function page_form($page_id = false)
	{
		$data = $this->data;

		$data['page_heading'] = lang('heading_title');
		$data['meta_title'] 	= lang('heading_title');

		if($page_id && !$this->Page_model->getPage($page_id))
		{
			$this->view('error', $data);
		}
		else
		{
			$data['form_title'] 	= lang('text_new_page'); 
			$data['form_action'] 	= site_url($this->admin_folder.'/pages/add');

			$data['page_id']					= '';
			$data['name']							= '';
			$data['slug']							= '';
			$data['priority']					= 0;
			$data['parent_id']				= 0;
			$data['content']					= '';
			$data['seo_title']				= '';
			$data['seo_keywords']			= '';
			$data['seo_description']	= '';
			$data['status']						= 1;
			$data['deletable']				= 0;

			$data['pages'] = $this->Page_model->getPages();

			if($page_id && $page = $this->Page_model->getPage($page_id))
			{
				$data['form_title'] 	= 'Edit Page'; 
				$data['form_action'] 	= site_url($this->admin_folder.'/pages/edit/'.$page_id);
					
				$data['page_id']					= $page['page_id'];
				$data['parent_id']				= $page['parent_id'];
				$data['name']							= $page['name'];
				$data['priority']					= $page['priority'];
				$data['content']					= $page['content'];
				$data['seo_title']				= $page['meta_title'];
				$data['seo_keywords']			= $page['meta_keywords'];
				$data['seo_description']	= $page['meta_description'];
				$data['slug']							= $page['slug'];
				$data['status']						= $page['status'];
				$data['deletable']				= $page['deletable'];
			}

			$this->form_validation->set_error_delimiters('<span>', '</span>');

			$this->form_validation->set_rules('name', 'lang:text_name', 'trim|required');
			$this->form_validation->set_rules('slug', 'lang:text_slug', 'trim');
			$this->form_validation->set_rules('seo_title', 'lang:text_meta_title', 'trim');
			$this->form_validation->set_rules('seo_keywords', 'lang:text_meta_keywords', 'trim');
			$this->form_validation->set_rules('seo_description', 'lang:text_meta_description', 'trim');
			$this->form_validation->set_rules('priority', 'lang:text_priority', 'trim|integer');
			$this->form_validation->set_rules('parent_id', 'lang:text_parent', 'trim|integer');
			$this->form_validation->set_rules('content', 'lang:text_content', 'trim|required');
			$this->form_validation->set_rules('status', 'lang:text_status', 'trim|integer');

			if($this->form_validation->run() == false)
			{
				if($this->session->flashdata('success'))
				{
				  $data['success'] = $this->session->flashdata('success');
				}
				if($this->session->flashdata('error'))
				{
				  $data['error'] = $this->session->flashdata('error');
				}
				if($this->session->flashdata('info'))
				{
				  $data['info'] = $this->session->flashdata('info');
				}
				if($this->session->flashdata('warning'))
				{
				  $data['warning'] = $this->session->flashdata('warning');
				}
				if(function_exists('validation_errors') && validation_errors() != '')
				{
					$data['error'] = validation_errors();
				}
				
				$this->view('page_form', $data);
			}
			else
			{	
				$save = array();

				$this->load->helper('text');

				$slug = $this->input->post('slug');
				
				if(empty($slug) || $slug=='')
				{
					$slug = $this->input->post('name');
				}
				
				$slug	= url_title(convert_accented_characters($slug), 'dash', TRUE);
				
				if($page_id)
				{
					$slug		= $this->Route_model->validateSlug($slug, $page['route_id']);
					$route_id	= $page['route_id'];
				}
				else
				{
					$slug	= $this->Route_model->validateSlug($slug);
					$route['slug'] = $slug;	
					$route_id = $this->Route_model->save($route);
				}


				$save['page_id']					= $page_id;
				$save['parent_id']				= $this->input->post('parent_id');
				$save['name']							= $this->input->post('name'); 
				$save['priority']					= $this->input->post('priority');
				$save['content']					= $this->input->post('content');
				$save['meta_title']				= $this->input->post('seo_title');
				$save['meta_keywords']		= $this->input->post('seo_keywords');
				$save['meta_description']	= $this->input->post('seo_description');
				$save['status']						= $this->input->post('status');
				$save['route_id']					= $route_id;
				$save['slug']							= $slug;
				
				if($page_id)
				{
					$save['modified']				= date('Y-m-d H:i:s');
				}
				else
				{
					$save['created']				= date('Y-m-d H:i:s');
					$save['modified']				= date('Y-m-d H:i:s');
				}
				
				//save the page
				$page_id	= $this->Page_model->savePage($save);
				
				//save the route
				$route['route_id'] = $route_id;
				$route['slug']	= $slug;
				$route['route']	= 'frontend/page/'.$page_id;
				
				$this->Route_model->save($route);
				
				$this->session->set_flashdata('message', lang('message_save_page'));
				redirect($this->admin_folder.'/pages');
			}
		}
	}

	public function link_form($page_id = false)
	{
		$data = $this->data;
		$data['meta_title'] 	= lang('heading_title');
		$data['page_heading'] = lang('heading_title');

		if($page_id && !$this->Page_model->getPage($page_id))
		{
			$this->view('error', $data);
		}
		else
		{
			$data['form_title'] 	= lang('text_new_link'); 
			$data['form_action'] 	= site_url($this->admin_folder.'/pages/link/add');

			$data['page_id']		= '';
			$data['name']				= '';
			$data['url']				= '';
			$data['new_window']	= false;
			$data['priority']		= 0;
			$data['parent_id']	= 0;
			$data['status']			= 1;

			$data['pages'] = $this->Page_model->getPages();

			if($page_id && $page = $this->Page_model->getPage($page_id))
			{
				$data['form_title'] 	= 'Edit Link'; 
				$data['form_action'] 	= site_url($this->admin_folder.'/pages/link/edit/'.$page_id);
					
				$data['page_id']		= $page['page_id'];
				$data['parent_id']	= $page['parent_id'];
				$data['name']				= $page['name'];
				$data['url']				= $page['url'];
				$data['new_window']	= (bool)$page['new_window'];
				$data['priority']		= $page['priority'];
				$data['status']			= $page['status'];
			}

			$this->form_validation->set_error_delimiters('<span>', '</span>');

			$this->form_validation->set_rules('name', 'lang:text_name', 'trim|required');
			$this->form_validation->set_rules('url', 'lang:text_url', 'trim|required');
			$this->form_validation->set_rules('priority', 'lang:text_priority', 'trim|integer');
			$this->form_validation->set_rules('new_window', 'lang:text_new_window', 'trim|integer');
			$this->form_validation->set_rules('parent_id', 'lang:text_parent', 'trim|integer');
		

			if($this->form_validation->run() == false)
			{
				if($this->session->flashdata('success'))
				{
				  $data['success'] = $this->session->flashdata('success');
				}
				if($this->session->flashdata('error'))
				{
				  $data['error'] = $this->session->flashdata('error');
				}
				if($this->session->flashdata('info'))
				{
				  $data['info'] = $this->session->flashdata('info');
				}
				if($this->session->flashdata('warning'))
				{
				  $data['warning'] = $this->session->flashdata('warning');
				}
				if(function_exists('validation_errors') && validation_errors() != '')
				{
					$data['error'] = validation_errors();
				}
				
				$this->view('link_form', $data);
			}
			else
			{				
				$save = array();

				$save = array();
				$save['page_id']		= $page_id;
				$save['parent_id']	= $this->input->post('parent_id');
				$save['name']				= $this->input->post('name');
				$save['url']				= $this->input->post('url');
				$save['priority']		= $this->input->post('priority');
				$save['new_window']	= ($this->input->post('new_window')) ? $this->input->post('new_window') : '0';
				$save['status']			= $this->input->post('status');
				
				if($page_id)
				{
					$save['modified']				= date('Y-m-d H:i:s');
				}
				else
				{
					$save['created']				= date('Y-m-d H:i:s');
					$save['modified']				= date('Y-m-d H:i:s');
				}
				
				//save the page
				$page_id	= $this->Page_model->savePage($save);

				$this->session->set_flashdata('message', lang('message_save_link'));
				redirect($this->admin_folder.'/pages');
			}
		}
	}
	
	function delete($page_id)
	{
		
		$page	= $this->Page_model->get_page($page_id);
		
		if($page)
		{
			$this->load->model('Route_model');
			
			$this->Route_model->delete($page->route_id);
			$this->Page_model->delete_page($page_id);
			$this->session->set_flashdata('message', lang('message_deleted_page'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
		
		redirect($this->config->item('admin_folder').'/pages');
	}
}	
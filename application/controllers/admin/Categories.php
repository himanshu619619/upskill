<?php
class Categories extends Admin_Controller { 
  
  var $data = array();

  function __construct()
  {       
    parent::__construct();
    
    $this->load->model(array('Category_model', 'Route_model'));

    $this->data['app_path'] = $this->config->item('app_path');
    $this->data['app_name'] = $this->config->item('app_name');
    $this->data['meta_title'] = $this->config->item('meta_title');
    $this->data['meta_description'] = $this->config->item('meta_description');
    $this->data['meta_keywords'] = $this->config->item('meta_keywords');

    $this->data['success']   = '';
    $this->data['error']     = '';
    $this->data['info']      = '';
    $this->data['warning']   = '';

    $this->lang->load('category');
  }
  
  function index()
  {
    $data = $this->data;

    $data['page_heading'] = lang('heading_title');
    $data['page_title'] = lang('heading_title');
    $data['meta_title'] = lang('heading_title');
    $data['categories'] = $this->Category_model->get_categories_tiered(true);
    
    $this->view('categories', $data);
  }
  
  function form($id = false)
  {
    $data = $this->data;

    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    
    $data['page_heading']          = lang('heading_form');
    $data['page_title']            = lang('heading_form');
    $data['meta_title']            = lang('heading_title');
    $data['heading_title']         = lang('heading_form');
    $data['heading_sub_title']     = lang('heading_form');
    $data['categories']            = $this->Category_model->get_categories_tiered(true);

    //default values are empty if the customer is new
    $data['id']                 = '';
    $data['name']               = '';
    $data['slug']               = '';
    $data['description']        = '';
    $data['excerpt']            = '';
    $data['sequence']           = '';
    $data['image']              = '';
    $data['meta_title']         = '';
    $data['meta_keywords']      = '';
    $data['meta_description']   = '';
    $data['parent_id']          = 0;
    $data['status']             = 1;
    $data['error']              = '';
    
    if ($id)
    {   
      $category = $this->Category_model->get_category($id);

      //if the category does not exist, redirect them to the category list with an error
      if (!$category)
      {
        $this->session->set_flashdata('error', lang('error_no_category'));
        redirect($this->admin_folder.'/categories');
      }
      
      //helps us with the slug generation
      $this->category_name = $this->input->post('slug', $category->slug);
      
      //set values to db values
      $data['id']                 = $category->id;
      $data['name']               = $category->name;
      $data['slug']               = $category->slug;
      $data['description']        = $category->description;
      $data['excerpt']            = $category->excerpt;
      $data['sequence']           = $category->sequence;
      $data['parent_id']          = $category->parent_id;
      $data['image']              = $category->image;
      $data['meta_title']         = $category->meta_title;
      $data['meta_keywords']      = $category->meta_keywords;
      $data['meta_description']   = $category->meta_description;
      $data['status']             = $category->status;     
    }
    
    $this->form_validation->set_error_delimiters('<span>', '</span>');

    $this->form_validation->set_rules('name', 'lang:text_name', 'trim|required|max_length[64]');
    $this->form_validation->set_rules('slug', 'lang:text_slug', 'trim');
    $this->form_validation->set_rules('description', 'lang:Description', 'trim');
    $this->form_validation->set_rules('excerpt', 'lang:text_excerpt', 'trim');
    $this->form_validation->set_rules('sequence', 'lang:text_sequence', 'trim|integer');
    $this->form_validation->set_rules('meta_title', 'lang:text_seo_title', 'trim');
    $this->form_validation->set_rules('meta_keywords', 'lang:text_seo_keyword', 'trim');
    $this->form_validation->set_rules('meta_description', 'lang:text_seo_description', 'trim');
    $this->form_validation->set_rules('status', 'lang:text_status', 'trim|numeric');
    
    // validate the form
    if ($this->form_validation->run() == FALSE)
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

      $this->view('category_form', $data);
    }
    else
    {
      $this->load->helper('text');
      
      //first check the slug field
      $slug = $this->input->post('slug');
      
      //if it's empty assign the name field
      if(empty($slug) || $slug == '')
      {
        $slug = $this->input->post('name');
      }

      if(!$id && ($parent_id = intval($this->input->post('parent_id'))))
      {
        $parent_category = $this->Category_model->get_category($parent_id);
        $slug = $parent_category->slug . '-' . $slug;
      }
      
      $slug = url_title(convert_accented_characters($slug), 'dash', TRUE);
      
      //validate the slug
      if($id)
      {
        $slug   = $this->Route_model->validateSlug($slug, $category->route_id);
        $route_id   = $category->route_id;
      }
      else
      {
        $slug   = $this->Route_model->validateSlug($slug);
          
        $route['slug']  = $slug;
        $route_id   = $this->Route_model->save($route);
      }
      
      $save['id']                 = $id;
      $save['name']               = $this->input->post('name');
      $save['description']        = ($this->input->post('description') != '') ? $this->input->post('description') : NULL;
      $save['excerpt']            = ($this->input->post('excerpt') != '') ? $this->input->post('excerpt') : NULL;
      $save['parent_id']          = 0;
      $save['sequence']           = intval($this->input->post('sequence'));
      $save['meta_title']         = ($this->input->post('meta_title') != '') ? $this->input->post('meta_title') : NULL;
      $save['meta_keywords']      = ($this->input->post('meta_keywords') != '') ? $this->input->post('meta_keywords') : NULL;
      $save['meta_description']   = ($this->input->post('meta_description') != '') ? $this->input->post('meta_description') : NULL;
      $save['status']             = $this->input->post('status');
      $save['route_id']           = intval($route_id);
      $save['slug']               = $slug;

      //var_dump($save);
      //die;

      if($id)
      {
        $save['modified']         = date('Y-m-d H:i:s');
      }
      else
      {
        $save['created']         = date('Y-m-d H:i:s');
      }
      
      $category_id = $this->Category_model->save($save);

      //save the route
      $route['route_id'] = $route_id;
      $route['slug']  = $slug;
      $route['route'] = 'frontend/category/'.$category_id;
      
      $this->Route_model->save($route);
      
      $this->session->set_flashdata('success', lang('message_save_category'));
      
      //go back to the category list
      redirect($this->admin_folder.'/categories');
    }
  }

  function delete($id)
  {      
    $category   = $this->Category_model->get_category($id);

    if ($category)
    {
      $this->Route_model->delete($category->route_id);
      $this->Category_model->delete($id);
      
      $this->session->set_flashdata('success', lang('message_delete_category'));
      redirect($this->admin_folder.'/categories');
    }
    else
    {
      $this->session->set_flashdata('error', lang('error_no_category'));
    }
  }
}
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Pagination extends CI_Pagination
{
	function __construct()
	{
		parent::__construct();

		$this->full_tag_open		= '<ul class="pagination pagination-sm m-t-none m-b-none">';
		$this->full_tag_close		= '</ul>';

		$this->first_tag_open		= '<li>';
		$this->first_tag_close	= '</li>';

    $this->first_link 			= 'First';
    $this->last_link 				= 'Last';
    
    $this->next_link 				= '<i class="fa fa-chevron-right"></i>';
    $this->prev_link 				= '<i class="fa fa-chevron-left"></i>';
   
    $this->last_tag_open 		= '<li>';
    $this->last_tag_close 	= '</li>';

    
    $this->next_tag_open 		= '<li>';
    $this->next_tag_close 	= '</li>';


    $this->prev_tag_open 		= '<li>';
    $this->prev_tag_close 	= '</li>';

    $this->cur_tag_open 		= '<li class="active"><a href="">';
    $this->cur_tag_close 		= '</a></li>';

    $this->num_tag_open 		= '<li>';
    $this->num_tag_close		= '</li>';

    $this->num_links 				= 1;
  	$this->use_page_numbers	= true;

  	$this->reuse_query_string 	= TRUE;
		$this->page_query_string 		= TRUE;
		$this->query_string_segment = 'page';
	}
}

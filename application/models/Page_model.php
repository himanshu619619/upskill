<?php
Class Page_model extends CI_Model
{

	/********************************************************************
	Page functions
	********************************************************************/
	function getPages($parent = 0)
	{
		$this->db->order_by('priority', 'ASC');
		$this->db->where('parent_id', $parent);
		$result = $this->db->get('page')->result();
		
		$return	= array();
		foreach($result as $page)
		{
			if($this->uri->segment(1) == $page->slug) {
				$page->active = true;
			} else {
				$page->active = false;
			}

			$return[$page->page_id]	 = array(
					'page_id' => $page->page_id,
					'parent_id' => $page->parent_id,
					'route_id' => $page->route_id,
					'name' => $page->name,
					'slug' => $page->slug,
					'url' => $page->url,
					'status' => $page->status,
					'deletable' => $page->deletable,
					'created' => $page->created,
					'children' => $this->getPages($page->page_id)
				);
		}
		
		return $return;
	}

	function getPagesTiered()
    {
		$this->db->order_by('priority', 'ASC');
		$this->db->order_by('title', 'ASC');
		$pages = $this->db->get('page')->result();
		
		$results	= array();
		foreach($pages as $page)
		{
			$results[$page->parent_id][$page->page_id] = array(
					'page_id' => $page->page_id,
					'parent_id' => $page->parent_id,
					'route_id' => $page->route_id,
					'name' => $page->name,
					'slug' => $page->slug,
					'url' => $page->url,
					'status' => $page->status,
					'deletable' => $page->deletable,
					'created' => $page->created,
					'children' => $this->getPages($page->page_id)
				);
		}
		
		return $results;
	}

	function getPage($page_id)
	{
		$this->db->where('page_id', $page_id);
		$result = $this->db->get('page')->row();
		
		$page = array();
		if($result)
		{
			$page = array(
					'page_id' => $result->page_id,
					'parent_id' => $result->parent_id,
					'route_id' => $result->route_id,
					'content' => $result->content,
					'name' => $result->name,
					'slug' => $result->slug,
					'meta_title' => $result->meta_title,
					'meta_keywords' => $result->meta_keywords,
					'meta_description' => $result->meta_description,
					'url' => $result->url,
					'new_window' => $result->new_window,
					'priority' => $result->priority,
					'status' => $result->status,
					'deletable' => $result->deletable,
					'modified' => $result->modified,
					'created' => $result->created,
				);
		}
		
		return $page;
	}
	
	function getSlug($page_id)
	{
		$page = $this->get_page($page_id);
		if($page) 
		{
			return $page->slug;
		}
	}
	
	function savePage($data)
	{
		if($data['page_id'])
		{
			$this->db->where('page_id', $data['page_id']);
			$this->db->update('page', $data);
			return $data['page_id'];
		}
		else
		{
			$this->db->insert('page', $data);
			return $this->db->insert_id();
		}
	}
	
	function deletePage($page_id)
	{
		//delete the page
		$this->db->where('page_id', $page_id);
		$this->db->delete('page');
	
	}
	
	function getPageBySlug($slug)
	{
		$this->db->where('slug', $slug);
		$result = $this->db->get('page')->row();
		
		$page = array();
		if($result)
		{
			$page = array(
				'page_id' => $result->page_id,
				'parent_id' => $result->parent_id,
				'route_id' => $result->route_id,
				'content' => $result->content,
				'name' => $result->name,
				'slug' => $result->slug,
				'meta_title' => $result->meta_title,
				'meta_keywords' => $result->meta_keywords,
				'meta_description' => $result->meta_description,
				'url' => $result->url,
				'new_window' => $result->new_window,
				'priority' => $result->priority,
				'status' => $result->status,
				'deletable' => $result->deletable,
				'modified' => $result->modified,
				'created' => $result->created,
			);
		}
		return $page;
	}
}
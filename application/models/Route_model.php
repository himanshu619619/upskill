<?php

class Route_model extends CI_Model {

	function __construct()
	{
		parent::__construct();		
	}
	

	// save or update a route and return the route_id
	function save($route)
	{
		if(!empty($route['route_id']))
		{
			$this->db->where('route_id', $route['route_id']);
			$this->db->update('route', $route);
			
			return $route['route_id'];
		}
		else
		{
			$this->db->insert('route', $route);
			return $this->db->insert_id();
		}
	}
	
	function checkSlug($slug, $route_id=false)
	{
		if($route_id)
		{
			$this->db->where('route_id !=', $route_id);
		}
		$this->db->where('slug', $slug);
		
		return (bool) $this->db->count_all_results('route');
	}
	
	function validateSlug($slug, $route_id=false, $count=false)
	{
		if($this->checkSlug($slug.$count, $route_id))
		{
			if(!$count)
			{
				$count	= 1;
			}
			else
			{
				$count++;
			}
			return $this->validateSlug($slug, $route_id, $count);
		}
		else
		{
			return $slug.$count;
		}
	}
	
	function delete($route_id)
	{
		$this->db->where('route_id', $route_id);
		$this->db->delete('route');
	}
}
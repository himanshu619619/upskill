<?php
class Location_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	}
	
	//zone areas
	function saveZoneArea($data)
	{
		if(!$data['country_zone_area_id']) 
		{
			$this->db->insert('country_zone_area', $data);
			return $this->db->insert_id();
		} 
		else 
		{
			$this->db->where('country_zone_area_id', $data['country_zone_area_id']);
			$this->db->update('country_zone_area', $data);
			return $data['country_zone_area_id'];
		}
	}
	
	function deleteZoneAreas($country_id)
	{
		$this->db->where('zone_id', $country_id)->delete('country_zone_area');
	}
	
	function deleteZoneArea($country_zone_area_id)
	{
		$this->db->where('country_zone_area_id', $country_zone_area_id);
		$this->db->delete('country_zone_area');
	}
	
	function getZoneAreas($country_id) 
	{
		$this->db->where('zone_id', $country_id);
		return $this->db->get('country_zone_area')->result();
	}
	
	function getZoneArea($country_zone_area_id)
	{
		$this->db->where('country_zone_area_id', $country_zone_area_id);
		return $this->db->get('country_zone_area')->row();
	}
	
	//zones
	function saveZone($data)
	{
		if(!$data['country_zone_id']) 
		{
			$this->db->insert('country_zone', $data);
			return $this->db->insert_id();
		} 
		else 
		{
			$this->db->where('country_zone_id', $data['country_zone_id']);
			$this->db->update('country_zone', $data);
			return $data['country_zone_id'];
		}
	}
	
	function deleteZones($country_id)
	{
		$this->db->where('country_id', $country_id)->delete('country_zone');
	}
	
	function deleteZone($country_zone_id)
	{
		$this->delete_zone_areas($country_zone_id);
		
		$this->db->where('country_zone_id', $country_zone_id);
		$this->db->delete('country_zone');
	}
	
	function getZones($country_id) 
	{
		$this->db->where('country_id', $country_id);
		return $this->db->get('country_zone')->result();
	}
	
	
	function getZone($country_zone_id)
	{
		$this->db->where('country_zone_id', $country_zone_id);
		return $this->db->get('country_zone')->row();
	}
	
	//countries
	function saveCountry($data)
	{
		if(!$data['country_id']) 
		{
			$this->db->insert('country', $data);
			return $this->db->insert_id();
		} 
		else 
		{
			$this->db->where('country_id', $data['country_id']);
			$this->db->update('country', $data);
			return $data['country_id'];
		}
	}
	
	function organizeCountries($countries)
	{
		//now loop through the products we have and add them in
		$sequence = 0;
		foreach ($countries as $country)
		{
			$this->db->where('id',$country)->update('country', array('sequence'=>$sequence));
			$sequence++;
		}
	}
	
	function getCountries()
	{
		return $this->db->order_by('name', 'ASC')->get('country')->result();
	}
	
	function getCountryByZoneId($id)
	{
		$zone	= $this->getZone($id);
		return $this->getCountry($zone->country_id);
	}
	
	function getCountryByIsoCode($iso_code, $code_len = 2)
	{
		if($code_len == 3)
			$this->db->where('iso_code_3', $iso_code);
		else		
			$this->db->where('iso_code_2', $iso_code);
			
		return $this->db->get('country')->row();
	}
	
	function getCountry($country_id)
	{
		$this->db->where('country_id', $country_id);
		return $this->db->get('country')->row();
	}
	
	
	function deleteCountry($country_id)
	{
		$this->db->where('country_id', $country_id);
		$this->db->delete('country');
	}
	
	
	function getCountriesMenu()
	{	
		$countries	= $this->db->order_by('name', 'ASC')->where('status', 1)->get('country')->result();
		$return		= array();
		foreach($countries as $c)
		{
			$return[$c->country_id] = $c->name;
		}
		return $return;
	}
	
	function getZonesMenu($country_id)
	{
		$zones	= $this->db->where(array('status'=>1, 'country_id'=>$country_id))->get('country_zone')->result();
		$return	= array();
		foreach($zones as $z)
		{
			$return[$z->country_zone_id] = $z->name;
		}
		return $return;
	}
	
	function hasZones($country_id)
	{
		if(!$country_id)
		{
			return false;
		}
		$count = $this->db->where('country_id', $country_id)->count_all_results('country_zone');
		if($count > 0)
		{
			return true;
		} else {
			return false;
		}
	}
	
}	
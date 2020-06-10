<?php
class Slider_model extends CI_Model
{
	function slider_collections()
	{
		return $this->db->order_by('name', 'ASC')->get('slider_collections')->result();
	}
	
	function slider_collection($slider_collection_id)
	{
		return $this->db->where('slider_collection_id', $slider_collection_id)->get('slider_collections')->row();
	}
	
	function slider_collection_sliders($slider_collection_id, $limit=5)
	{
		$this->db->where('slider_collection_id', $slider_collection_id);
		$sliders	= $this->db->order_by('sequence', 'ASC')->get('sliders')->result();
		return $sliders;
	}
	
	function slider($slider_id)
	{
		$this->db->where('slider_id', $slider_id);
		$result = $this->db->get('sliders');
		$result = $result->row();
		if ($result)
		{
			return $result;
		}
		else
		{ 
			return array();
		}
	}
	
	function save_slider($data)
	{
		if(isset($data['slider_id']))
		{
			$this->db->where('slider_id', $data['slider_id']);
			$this->db->update('sliders', $data);
		}
		else
		{
			$data['sequence'] = $this->get_next_sequence($data['slider_collection_id']);
			$this->db->insert('sliders', $data);
		}
	}
	
	function save_slider_collection($data)
	{
		if(isset($data['slider_collection_id']) && (bool)$data['slider_collection_id'])
		{
			$this->db->where('slider_collection_id', $data['slider_collection_id']);
			$this->db->update('slider_collections', $data);
		}
		else
		{
			$this->db->insert('slider_collections', $data);
		}
	}
	
	function get_homepage_sliders($limit = false)
	{
		$sliders	= $this->db->order_by('sequence ASC')->get('sliders')->result();
		return $sliders;
	}
	
	function delete_slider($slider_id)
	{
		$this->db->where('slider_id', $slider_id);
		$this->db->delete('sliders');
	}
	
	function delete_slider_collection($slider_collection_id)
	{
		$this->db->where('slider_collection_id', $slider_collection_id);
		$this->db->delete('sliders');
		
		$this->db->where('slider_collection_id', $slider_collection_id);
		$this->db->delete('slider_collections');
	}
	
	function get_next_sequence($slider_collection_id)
	{
		$this->db->where('slider_collection_id', $slider_collection_id);
		$this->db->select('sequence');
		$this->db->order_by('sequence DESC');
		$this->db->limit(1);
		$result = $this->db->get('sliders');
		$result = $result->row();
		if ($result)
		{
			return $result->sequence + 1;
		}
		else
		{
			return 0;
		}
	}

	function organize($sliders)
	{
		foreach ($sliders as $sequence => $id)
		{
			$data = array('sequence' => $sequence);
			$this->db->where('slider_id', $id);
			$this->db->update('sliders', $data);
		}
	}
}
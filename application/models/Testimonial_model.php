<?php
Class Testimonial_model extends CI_Model
{

	/********************************************************************
	testimonial functions
	********************************************************************/
	function testimonials($data=array())
	{
		//approved
		if(isset($data['approved']))
		{
			$this->db->where('approved', $data['approved']);
		}

		//status
		if(isset($data['status']))
		{
			$this->db->where('status', $data['status']);
		}

		//limit
		if(isset($data['limit']))
		{
			$this->db->limit($data['limit']);
		}
		
		//offset
		if(isset($data['offset']))
		{
			$this->db->offset($data['offset']);
		}

		//order_by
		if(isset($data['order_by']) && isset($data['sort_order']))
		{
			$this->db->order_by($data['order_by'], $data['sort_order']);
		}
		else
		{
			$this->db->order_by('testimonial_id', 'DESC');
		}
		
		$results = $this->db->get('testimonials')->result();
		
		$testimonials = array();

		if(!empty($results)) 
		{
			foreach ($results as $result) {
				$testimonials[] = array(
						'testimonial_id' => $result->testimonial_id,
						'user_id' 			 => $result->user_id,
						'author' 				 => $result->author,
						'content' 			 => $result->content,
						'approved' 			 => $result->approved,
						'status' 				 => $result->status,
						'created' 			 => $result->created,
						'modified' 			 => $result->modified
					);
			}
		}
		return $testimonials;
	}

	function getTotalTestimonials()
	{
		if(isset($data['approved']))
		{
			$this->db->where('approved', $data['approved']);
		}

		//status
		if(isset($data['status']))
		{
			$this->db->where('status', $data['status']);
		}

		return $this->db->count_all_results('client');
	}

	function getTestimonial($testimonial_id)
	{
		$this->db->where('testimonial_id', $testimonial_id);
		$result = $this->db->get('testimonials')->row();
		
		$testimonial = array();
		if($result)
		{
			$testimonial = array(
					'testimonial_id' => $result->testimonial_id,
					'user_id' 			 => $result->user_id,
					'author' 				 => $result->author,
					'content' 			 => $result->content,
					'approved' 			 => $result->approved,
					'status' 				 => $result->status,
					'created' 			 => $result->created,
					'modified' 			 => $result->modified
				);
		}
		return $result;
	}
	
	function saveTestimonial($data)
	{
		if($data['testimonial_id'])
		{
			$this->db->where('testimonial_id', $data['testimonial_id']);
			$this->db->update('testimonials', $data);
			return $data['testimonial_id'];
		}
		else
		{
			$this->db->insert('testimonials', $data);
			return $this->db->insert_id();
		}
	}
	
	function deleteTestimonial($testimonial_id)
	{
		//delete the testimonial
		$this->db->where('testimonial_id', $testimonial_id);
		$this->db->delete('testimonials');
	}
}
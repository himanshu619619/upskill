<?php
Class Newsletter_model extends CI_Model
{
	function __construct()
	{
			parent::__construct();
	}
	
	function get_subscribers($limit=0, $offset=0, $order_by='id', $direction='DESC')
	{
		$this->db->order_by($order_by, $direction);
		if($limit>0)
		{
			$this->db->limit($limit, $offset);
		}

		$result	= $this->db->get('subscribers');
		return $result->result();
	}
	
	function save_subscriber($data)
	{
		if($data['id'])
		{
			$this->db->where('id', $data['id']);
			$this->db->update('subscribers', $data);
			return $data['id'];
		}
		else
		{
			$this->db->insert('subscribers', $data);
			return $this->db->insert_id();
		}
	}
	
	function count_subscribers()
	{
		return $this->db->count_all_results('subscribers');
	}
	
	function get_subscriber($id)
	{
		$result	= $this->db->get_where('subscribers', array('id'=>$id));
		return $result->row();
	}
	
	function subscribers($data=array(), $return_count=false)
	{
		if(empty($data))
		{
			//if nothing is provided return the whole shabang
			$this->get_subscribers();
		}
		else
		{
			//grab the limit
			if(!empty($data['rows']))
			{
				$this->db->limit($data['rows']);
			}
			
			//grab the offset
			if(!empty($data['page']))
			{
				$this->db->offset($data['page']);
			}
			
			//do we order by something other than group_id?
			if(!empty($data['order_by']))
			{
				//if we have an order_by then we must have a direction otherwise KABOOM
				$this->db->order_by($data['order_by'], $data['sort_order']);
			}
			
			//do we have a search submitted?
			if(!empty($data['term']))
			{
				$search	= json_decode($data['term']);
				//if we are searching dig through some basic fields
				if(!empty($search->term))
				{
					$this->db->like('firstname', $search->term);
					$this->db->or_like('lastname', $search->term);
					$this->db->or_like('email', $search->term);
				}
				
			}
			
			if($return_count)
			{
			 return $this->db->count_all_results('subscribers');
			}
			else
			{
				$this->db->select('subscribers.*');
				$this->db->from('subscribers');
				$this->db->order_by('subscribers.id', 'DESC');
				return $result = $this->db->get()->result();
			}
		}
	}
	
	function delete_subscriber($id)
	{
		//this deletes the users record
		$this->db->where('id', $id);
		$this->db->delete('subscribers');
	}
	
	function check_email($str)
	{
		$this->db->select('email');
		$this->db->from('subscribers');
		$this->db->where('email', $str);
		
		$count = $this->db->count_all_results();
		
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function unsubscribe_newsletter($data)
	{
		$this->db->where('email', $data['email'])->update('subscribers', $data);
		return true;
	}
}

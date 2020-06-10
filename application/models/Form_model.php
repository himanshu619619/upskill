<?php
Class Form_model extends CI_Model
{
	public function getForms($data=array())
	{	  
    if(!empty($data['status']))
    {
      $this->db->where('status', $data['status']);
    }

    if(!empty($data['user_id']))
    {
      $this->db->where('user_id', $data['user_id']);
    }

    if(!empty($data['vessel_id']))
    {
      $this->db->where('vessel_id', $data['vessel_id']);
    }

    if(!empty($data['code']))
    {
      $this->db->where('code', $data['code']);
    }

    if(!empty($data['limit']))
    {
      $this->db->limit($data['limit']);
    }
    
    if(isset($data['offset']))
    {
      $this->db->offset($data['offset']);
    }

    if(isset($data['order_by']) && isset($data['sort_order']))
    {
      $this->db->order_by($data['order_by'], $data['sort_order']);
    }
    else
    {
      $this->db->order_by('form_id', 'DESC');
    }     
    
    $query = $this->db->get('form');

    $forms = array();
    foreach ($query->result() as $row)
    {
    	$user_name   = '';
      $vessel_name = '';

      $user = $this->User_model->getUser($row->user_id);
      if($user)
      {
        $user_name = $user['name'];
      }

      $vessel = $this->Vessel_model->getVessel($row->vessel_id);
      if($vessel)
      {
        $vessel_name = $vessel['name'];
      }

      $forms[] = array(
        'form_id'   => $row->form_id,
        'user_id'   => $row->user_id,
        'user_name' => $user_name,
        'vessel_id' => $row->vessel_id,
        'vessel_name' => $vessel_name,
        'name'      => $row->name,
        'code'      => $row->code,
        'content'   => $row->content,
        'status'    => $row->status,
        'submitted' => $row->submitted,
        'created'   => $row->created,
        'modified'  => $row->modified
      );
    } 
    return $forms;
	}

	public function getTotalForms($data = array())
	{
	 	if(!empty($data['status']))
    {
      $this->db->where('status', $data['status']);
    }

    if(!empty($data['user_id']))
    {
      $this->db->where('user_id', $data['user_id']);
    }

    if(!empty($data['ship_id']))
    {
      $this->db->where('ship_id', $data['ship_id']);
    }

    if(!empty($data['code']))
    {
      $this->db->where('code', $data['code']);
    }

	  return $this->db->count_all_results('form');
	}

	public function getForm($form_id, $user_id = false)
	{
    if($user_id)
    {
      $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('form')." WHERE form_id = '".(int)$form_id."' AND user_id = '".(int)$user_id."'");
    }
	  else
    {
      $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('form')." WHERE form_id = '".(int)$form_id."'");   
    }

	  $vessel = array();
	  if($row = $query->row())
	  {
      $user_name   = '';
      $vessel_name = '';

      $user = $this->User_model->getUser($row->user_id);
      if($user)
      {
        $user_name = $user['name'];
      }

      $vessel = $this->Vessel_model->getVessel($row->vessel_id);
      if($vessel)
      {
        $vessel_name = $vessel['name'];
      }

	    $vessel = array(
	      'form_id'   => $row->form_id,
        'user_id'   => $row->user_id,
        'user_name' => $user_name,
        'vessel_id' => $row->vessel_id,
        'vessel_name' => $vessel_name,
	      'name'		  => $row->name,
	      'code'      => $row->code,
        'content'   => $row->content,
        'status'    => $row->status,
        'submitted' => $row->submitted,
        'created'   => $row->created,
        'modified'  => $row->modified
	    );
	  }
	  
	  return $vessel;
	}

	public function saveForm($data = array())
	{
	  if(isset($data['form_id']) && ($data['form_id'] != ''))
	  {
	    $this->db->where('form_id', $data['form_id']);
	    $this->db->update('form', $data);
	    $form_id = $data['form_id'];
	  }
	  else
	  {
	    $this->db->insert('form', $data);
	    $form_id = $this->db->insert_id();
	  }
	  
	  return $form_id;
	}

	public function deleteForm($form_id)
	{
	  $this->db->where('form_id', $form_id);
	  $this->db->delete('form');
	}

	public function formCodes()
	{
		return array(
				'DBLF' 	=> 'Daily Boat Log Form',
				'VPF'  	=> 'Voyage Plan Form',
				'PTIF'	=> 'Pre-Transfer Inspection Form',
				'WORF' 	=> 'Work Order Request Form',
				'DRF' 	=> 'Drill Report Form',
				'IRF' 	=> 'Incident Report Form',
				'PEDF'	=> 'Performance Evaluation - Deckhand Form',
				'PECF' 	=> 'Performance Evaluation – Captain / Relief Captain / Pilot Form',
				'PEDF' 	=> 'Performance Evaluation - Deckhand Form',
				'PETF' 	=> 'Performance Evaluation - Tankerman Form'
			);
	}
}
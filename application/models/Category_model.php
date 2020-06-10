<?php
Class Category_model extends CI_Model
{

  function get_categories($parent = false)
  {
    if ($parent !== false)
    {
      $this->db->where('parent_id', $parent);
    }
    $this->db->select('id');
    $this->db->order_by('categories.sequence', 'ASC');
    
    //this will alphabetize them if there is no sequence
    $this->db->order_by('name', 'ASC');
    $result = $this->db->get('categories');
    
    $categories = array();
    foreach($result->result() as $cat)
    {
      $categories[]   = $this->get_category($cat->id);
    }
    
    return $categories;
  }
  
  function get_categories_tiered($admin = false)
  {
    if(!$admin) $this->db->where('status', 1);
    
    $this->db->order_by('sequence');
    $this->db->order_by('name', 'ASC');
    $categories = $this->db->get('categories')->result();
    
    $results    = array();
    foreach($categories as $category) {

      // Set a class to active, so we can highlight our current category
      if($this->uri->segment(1) == $category->slug) {
        $category->active = true;
      } else {
        $category->active = false;
      }

      $results[$category->parent_id][$category->id] = $category;
    }
    
    return $results;
  }
  
  function get_category($id)
  {
    return $this->db->get_where('categories', array('id'=>$id))->row();
  }
  
  function save($category)
  {
    if ($category['id'])
    {
      $this->db->where('id', $category['id']);
      $this->db->update('categories', $category);
      
      return $category['id'];
    }
    else
    {
      $this->db->insert('categories', $category);
      return $this->db->insert_id();
    }
  }
  
  function delete($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('categories');
  }

  function check_slug($slug, $id=false)
  {
    if($id)
    {
        $this->db->where('id !=', $id);
    }
    $this->db->where('slug', $slug);
    
    return (bool) $this->db->count_all_results('categories');
  }

  function validate_slug($slug, $id=false, $count=false)
  {
    if($this->check_slug($slug.$count, $id))
    {
      if(!$count)
      {
          $count  = 1;
      }
      else
      {
          $count++;
      }
      return $this->validate_slug($slug, $id, $count);
    }
    else
    {
      return $slug.$count;
    }
  }
}
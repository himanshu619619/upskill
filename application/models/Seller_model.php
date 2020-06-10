<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Seller_model extends CI_Model {
  
  public function getGroups($data=array())
  {
    if(!empty($data['access']) && ($data['access'] != 'A'))
    {
      $this->db->where('code !=', 'A');
      $this->db->where('code !=', 'S');
    }

    $this->db->order_by('priority', 'ASC');
    return $this->db->get('group')->result();
  }

  public function getGroup($id)
  {
    return $this->db->where('group_id', $id)->get('group')->row();
  }

  public function getSellers($data=array())
  {
    if(empty($data))
    {
      return $this->getAllSellers();
    }
    else
    {
      if(!empty($data['group_id']))
      {
        $this->db->where('group_id', $data['group_id']);
      }

      if(!empty($data['status']))
      {
        $this->db->where('status', $data['status']);
      }

      if(!empty($data['category_id']))
      {
        $this->db->where('category_id', (int)$data['category_id']);
      }

      if(!empty($data['filter']))
      {
        $this->db->where("(firstname LIKE '%".$data['filter']."%' OR email LIKE '%".$data['filter']."%' OR lastname LIKE '%".$data['filter']."%')", null);
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
        $this->db->order_by('seller_id', 'DESC');
      }     
      
      $query = $this->db->get('seller');

      $users = array();
      foreach ($query->result() as $row)
      {     

        $users[] = array(
          'seller_id'         => $row->seller_id,
          'category_id'       => $row->category_id,
          'name'              => $row->firstname .' '.$row->lastname,
          'email'             => $row->email,
          'phone'             => $row->phone,
          'status'            => $row->status,
        );
      } 
      return $users;
    }
  }

  public function getTotalSellers($data = array())
  {
    if(!empty($data['status']))
    {
      $this->db->where('status', $data['status']);
    }

    if(!empty($data['filter']))
    {
      $this->db->where("(firstname LIKE '%".$data['filter']."%' OR email LIKE '%".$data['filter']."%' OR lastname LIKE '%".$data['filter']."%')", null);
    }

    return $this->db->count_all_results('seller');
  }

  public function getAllSellers()
  {
    $this->db->order_by('seller_id', 'ASC');
    $result = $this->db->get('seller')->result_array();
    
    return $result;
  }

  public function getSeller($seller_id)
  {
    $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('seller')." WHERE seller_id = '".(int)$seller_id."'");

    $user = array();
    if($row = $query->row())
    {
      $user = array(
        'seller_id'         => $row->seller_id,
        'category_id'       => $row->category_id,
        'firstname'         => $row->firstname,
        'lastname'          => $row->lastname,
        'email'             => $row->email,
        'phone'             => $row->phone,
        'image'             => $row->image,
        'address1'          => $row->address1,
        'address2'          => $row->address2,
        'city'              => $row->city,
        'zip'               => $row->zip,
        'zone'              => $row->zone,
        'zone_id'           => $row->zone_id,
        'country'           => $row->country,
        'country_code'      => $row->country_code,
        'country_id'        => $row->country_id,
        'status'            => $row->status,
      );
    }
    
    return $user;
  }

  public function getSellerBySellername($username, $seller_id = 0)
  {
    if($seller_id)
    {
      $this->db->where('seller_id <>', $seller_id);
    }
    
    return $this->db->where('username', $username)->get('seller')->row();
  }

  public function getSellerByEmail($email, $seller_id = 0)
  {
    if($seller_id)
    {
      $this->db->where('seller_id <>', $seller_id);
    }
    
    return $this->db->where('email', $email)->get('seller')->row();
  }

  public function saveSeller($data = array())
  {
    if(isset($data['seller_id']) && ($data['seller_id'] != ''))
    {
      $this->db->where('seller_id', $data['seller_id']);
      $this->db->update('seller', $data);
      $seller_id = $data['seller_id'];
    }
    else
    {
      $this->db->insert('seller', $data);
      $seller_id = $this->db->insert_id();
    }
    
    return $seller_id;
  }

  public function delete($seller_id)
  {
    $this->db->where('seller_id', $seller_id);
    $this->db->delete('seller');
  }

  private function generateCookie($data, $expire)
  {
    setcookie(config_item('cookie_prefix').'MDU', $data, $expire, config_item('cookie_path'), config_item('cookie_domain'));
  }
  
  private function aes256Encrypt($data)
  {
    $key = config_item('encryption_key');
    if(32 !== strlen($key))
    {
      $key = hash('SHA256', $key, true);
    }
    $padding = 16 - (strlen($data) % 16);
    $data .= str_repeat(chr($padding), $padding);
    return mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16));
  }

  private function aes256Decrypt($data)
  {
    $key = config_item('encryption_key');
    if(32 !== strlen($key))
    {
      $key = hash('SHA256', $key, true);
    }
    $data = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, str_repeat("\0", 16));
    $padding = ord($data[strlen($data) - 1]); 
    return substr($data, 0, -$padding); 
  }

  function login($username, $password, $remember=false)
  {
    $this->db->select('*');
    $this->db->where('username', $username);
    $this->db->where('status', 1);
    $this->db->where('password',  sha1($password));
    $this->db->limit(1);
    $result   = $this->db->get('seller');
    $user = $result->row_array();
    
    if($user)
    {
      $user_data = array();
      $user_data['seller'] = array();
      $user_data['seller'] = $user;

      if($user['group_id']!=0) 
      {
        $group = $this->getGroup($user['group_id']);
        if($group)
        {
          $user_data['seller']['group'] = $group;
        }
      }
      
      if($remember)
      {
        $loginCred = json_encode(array('username'=>$username, 'password'=>$password));
        $loginCred = base64_encode($this->aes256Encrypt($loginCred));
        $this->generateCookie($loginCred, strtotime('+6 months'));
      }

      $this->CI->session->set_userdata($user_data);
  
      return true;
    }
    else
    {
      return false;
    }
  }
  
  function is_logged_in($redirect = false, $default_redirect = 'login')
  {
    $user = $this->CI->session->userdata('seller');

    if(!$user)
    {
      if(isset($_COOKIE[config_item('cookie_prefix').'MDU']))
      {
        $info = $this->aes256Decrypt(base64_decode($_COOKIE[config_item('cookie_prefix').'MDU']));
        $cred = json_decode($info, true);

        if(is_array($cred))
        {
          if( $this->login($cred['email'], $cred['password']) )
          {
              return $this->is_logged_in($redirect, $default_redirect);
          }
        }
      }

      if ($redirect)
      {
          $this->session->set_flashdata('redirect', $redirect);
      }
      
      if ($default_redirect)
      {   
          redirect($default_redirect);
      }
        
      return false;
    }
    else
    {
        return true;
    }
  }

  public function checkSeller($seller_id)
  {
    $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('seller')." WHERE seller_id = '".(int)$seller_id."'");
    
    if($row = $query->row())
    {
      return true;
    }
    else
    {
      return false;;
    }
  }


  public function getCustomers($data=array())
  {
    if(empty($data))
    {
      return $this->getAllCustomers();
    }
    else
    {
      $this->db->select('customers.*, seller.firstname as seller_firstname, seller.lastname as seller_lastname');

      if(!empty($data['seller_id']))
      {
        $this->db->where('customers.seller_id', $data['seller_id']);
      }

      if(!empty($data['status']))
      {
        $this->db->where('status', $data['status']);
      }

      if(!empty($data['filter']))
      {
        $this->db->where("(firstname LIKE '%".$data['filter']."%' OR email LIKE '%".$data['filter']."%' OR lastname LIKE '%".$data['filter']."%')", null);
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
        $this->db->order_by('id', 'DESC');
      }
      
      $this->db->join('seller', 'seller.seller_id = customers.seller_id', 'right');
      $query = $this->db->get('customers');

      $customers = array();
      foreach ($query->result() as $row)
      {
        $customers[] = array(
          'id'          => $row->id,
          'name'        => $row->firstname .' '.$row->lastname,
          'seller_name' => $row->seller_firstname .' '.$row->seller_lastname,
          'email'       => $row->email,
          'phone'       => $row->phone,
          'status'      => $row->status,
        );
      }

      return $customers;
    }
  }

  public function getAllCustomers()
  {
    $this->db->order_by('id', 'ASC');
    $result = $this->db->get('customers')->result();
    
    return $result;
  }

  public function getTotalCustomers($data = array())
  {
    if(!empty($data['status']))
    {
      $this->db->where('status', $data['status']);
    }

    if(!empty($data['seller_id']))
    {
      $this->db->where('seller_id', $data['seller_id']);
    }

    if(!empty($data['filter']))
    {
      $this->db->where("(firstname LIKE '%".$data['filter']."%' OR email LIKE '%".$data['filter']."%' OR lastname LIKE '%".$data['filter']."%')", null);
    }

    return $this->db->count_all_results('customers');
  }


  public function getCustomer($customer_id)
  {
    $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('customers')." WHERE id = '".(int)$customer_id."'");

    $customer = array();

    if($row = $query->row())
    {
      $customer = array(
        'seller_id'    => $row->seller_id,
        'firstname'    => $row->firstname,
        'lastname'     => $row->lastname,
        'email'        => $row->email,
        'phone'        => $row->phone,
        'image'        => $row->image,
        'address1'     => $row->address1,
        'address2'     => $row->address2,
        'city'         => $row->city,
        'zip'          => $row->zip,
        'zone'         => $row->zone,
        'zone_id'      => $row->zone_id,
        'country'      => $row->country,
        'country_code' => $row->country_code,
        'country_id'   => $row->country_id,
        'status'       => $row->status,
      );
    }
    
    return $customer;
  }

  public function saveCustomer($data = array())
  {
    if(isset($data['id']) && ($data['id'] != ''))
    {
      $this->db->where('id', $data['id']);
      $this->db->update('customers', $data);
      $id = $data['id'];
    }
    else
    {
      $this->db->insert('customers', $data);
      $id = $this->db->insert_id();
    }
    
    return $id;
  }

  public function deleteCustomer($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('customers');
  }

  public function getCustomerByEmail($email, $id = 0)
  {
    if($id)
    {
      $this->db->where('id <>', $id);
    }
    
    return $this->db->where('email', $email)->get('customers')->row();
  }

  public function getSellerServices($data=array())
  {
    if(!empty($data['seller_id']))
    {
      $this->db->where('seller_id', $data['seller_id']);
    }

    if(!empty($data['status']))
    {
      $this->db->where('status', $data['status']);
    }

    if(!empty($data['filter']))
    {
      $this->db->where("(name LIKE '%".$data['filter']."%' OR description LIKE '%".$data['filter']."%')", null);
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
      $this->db->order_by('service_id', 'DESC');
    }
    
    $query = $this->db->get('services');

    $services = array();
    foreach ($query->result() as $row)
    {
      $services[] = array(
        'service_id'  => $row->service_id,
        'name'        => $row->name,
        'service_type' => $row->service_type,
        'price'       => format_currency($row->price),
        'slot_length' => (int)$row->slot_length,
        'availability'=> $row->availability,
        'status'      => $row->status,
        'created'     => format_date($row->created)
      );
    }

    return $services;
  }

  public function getTotalSellerServices($data = array())
  {
    if(!empty($data['status']))
    {
      $this->db->where('status', $data['status']);
    }

    if(!empty($data['seller_id']))
    {
      $this->db->where('seller_id', $data['seller_id']);
    }

    if(!empty($data['filter']))
    {
      $this->db->where("(name LIKE '%".$data['filter']."%' OR description LIKE '%".$data['filter']."%')", null);
    }

    return $this->db->count_all_results('services');
  }

  public function getService($service_id)
  {
    $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('services')." WHERE service_id = '".(int)$service_id."'");

    $service = array();

    if($row = $query->row())
    {
      $service = array(
        'seller_id'    => $row->seller_id,
        'service_id'   => $row->service_id,
        'name'         => $row->name,
        'description'  => $row->description,
        'service_type' => $row->service_type,
        'price'        => $row->price,
        'slot_length'  => $row->slot_length,
        'availability' => $row->availability,
        'status'       => $row->status,
        'created'      => $row->created
      );
    }
    
    return $service;
  }

  public function saveService($data = array())
  {
    if(isset($data['service_id']) && ($data['service_id'] != ''))
    {
      $this->db->where('service_id', $data['service_id']);
      $this->db->update('services', $data);
      $service_id = $data['service_id'];
    }
    else
    {
      $this->db->insert('services', $data);
      $service_id = $this->db->insert_id();
    }
    
    return $service_id;
  }

  public function deleteService($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('services');
  }

}
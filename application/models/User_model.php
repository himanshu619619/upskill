<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class User_model extends CI_Model {
  
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

  public function getUsers($data=array())
  {
    if(empty($data) && !$return_count)
    {
      return $this->getAllUsers();
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

      if(!empty($data['filter']))
      {
        $this->db->where("(name LIKE '%".$data['filter']."%' OR email LIKE '%".$data['filter']."%' OR username LIKE '%".$data['filter']."%')", null);
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
        $this->db->order_by('user_id', 'DESC');
      }     
      
      $query = $this->db->get('user');

      $users = array();
      foreach ($query->result() as $row)
      {
        $group_name        = '';
        
        $group = $this->getGroup($row->group_id);
        if($group)
        {
          $group_name = $group->name;
        }        

        $users[] = array(
          'user_id'           => $row->user_id,
          'group_id'          => $row->group_id,
          'group_name'        => $group_name,
          'access_code'       => $row->access_code,
          'name'              => $row->name,
          'username'          => $row->username,
          'email'             => $row->email,
          'phone '            => $row->phone  ,
          'status'            => $row->status,
        );
      } 
      return $users;
    }
  }

  public function getTotalUsers($data = array())
  {
    if(!empty($data['status']))
    {
      $this->db->where('status', $data['status']);
    }

    if(!empty($data['group_id']))
    {
      $this->db->where('group_id', $data['group_id']);
    }

    if(!empty($data['filter']))
    {
      $this->db->where("(name LIKE '%".$data['filter']."%' OR email LIKE '%".$data['filter']."%' OR username LIKE '%".$data['filter']."%')", null);
    }

    return $this->db->count_all_results('user');
  }

  public function getAllUsers()
  {
    $this->db->order_by('user_id', 'ASC');
    $result = $this->db->get('user')->result();
    
    return $result;
  }

  public function getUser($user_id)
  {
    $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('user')." WHERE user_id = '".(int)$user_id."'");

    $user = array();
    if($row = $query->row())
    {
      $group_name        = '';
      
      $group = $this->getGroup($row->group_id);
      if($group)
      {
        $group_name = $group->name;
      }

      $user = array(
        'user_id'           => $row->user_id,
        'group_id'          => $row->group_id,
        'group_name'        => $group_name,
        'access_code'       => $row->access_code,
        'name'              => $row->name,
        'username'          => $row->username,
        'email'             => $row->email,
        'phone'             => $row->phone,
        'status'            => $row->status,
      );
    }
    
    return $user;
  }

  public function getUserGroups()
  {
    $this->db->order_by('priority', 'ASC');
    $result = $this->db->get('group')->result();
    
    return $result;
  }

  public function getUserGroup($group_id)
  {
    $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('group')." WHERE group_id = '".(int)$group_id."'");

    $user_group = array();

    if($row = $query->row())
    {
      $user_group = array(
        'group_id'  => $row->group_id,
        'code'      => $row->code,
        'name'      => $row->name,
        'permission' => $row->permission,
        'priority'  => $row->priority
      );
    }
    
    return $user_group;
  }

  public function getUserByUsername($username, $user_id = 0)
  {
    if($user_id)
    {
      $this->db->where('user_id <>', $user_id);
    }
    
    return $this->db->where('username', $username)->get('user')->row();
  }

  public function getUserByEmail($email, $user_id = 0)
  {
    if($user_id)
    {
      $this->db->where('user_id <>', $user_id);
    }
    
    return $this->db->where('email', $email)->get('user')->row();
  }

  public function saveUser($data = array())
  {
    if(isset($data['user_id']) && ($data['user_id'] != ''))
    {
      $this->db->where('user_id', $data['user_id']);
      $this->db->update('user', $data);
      $user_id = $data['user_id'];
    }
    else
    {
      $this->db->insert('user', $data);
      $user_id = $this->db->insert_id();
    }
    
    return $user_id;
  }

  public function saveGroup($data = array())
  {
    if(isset($data['group_id']) && ($data['group_id'] != ''))
    {
      $this->db->where('group_id', $data['group_id']);
      $this->db->update('group', $data);
      $group_id = $data['group_id'];
    }
    else
    {
      $this->db->insert('group', $data);
      $group_id = $this->db->insert_id();
    }
    
    return $group_id;
  }

  public function delete($user_id)
  {
    $this->db->where('user_id', $user_id);
    $this->db->delete('user');
  }

  private function generateCookie($data, $expire)
  {
    setcookie(config_item('cookie_prefix').'DIPO', $data, $expire, config_item('cookie_path'), config_item('cookie_domain'));
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

  function save($user)
  {
    if($user['id'])
    {
      $this->db->where('id', $user['id']);
      $this->db->update('user', $user);
      return $user['id'];
    }
    else
    {
      $this->db->insert('user', $user);
      return $this->db->insert_id();
    }
  }

  function login($username, $password, $remember=false)
  {
    $this->db->select('*');
    $this->db->where('username', $username);
    $this->db->where('status', 1);
    $this->db->where('password',  sha1($password));
    $this->db->limit(1);
    $result   = $this->db->get('user');
    $user = $result->row_array();
    
    if($user)
    {
      $user_data = array();
      $user_data['user'] = array();
      $user_data['user'] = $user;

      if($user['group_id']!=0) 
      {
        $group = $this->getGroup($user['group_id']);
        if($group)
        {
          $user_data['user']['group'] = $group;
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
    $user = $this->session->userdata('user');

    if(!$user)
    {
      if(isset($_COOKIE[config_item('cookie_prefix').'DIPO']))
      {
        $info = $this->aes256Decrypt(base64_decode($_COOKIE[config_item('cookie_prefix').'DIPO']));
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

  public function checkUser($user_id)
  {
    $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('user')." WHERE user_id = '".(int)$user_id."'");
    
    if($row = $query->row())
    {
      return true;
    }
    else
    {
      return false;;
    }
  }

  function checkEmail($str, $id=false)
  {
    $this->db->select('email');
    $this->db->from('user');
    $this->db->where('email', $str);
    
    if($id)
    {
      $this->db->where('id !=', $id);
    }

    $count = $this->db->count_all_results();
    
    if($count > 0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  public function controllerMethodNames()
  {
    $list = array(
      //Backend Controller
      'backend/index' => 'Dashboard',
      'backend/setting_form' => 'Manage Setting',
      'backend/user_form' => 'Add/Edit User',
      'backend/users' => 'User List',
      'backend/user_groups' => 'Group List',
      'backend/user_group_form' => 'Add/Edit Group',

      //Categories Controller
      'categories/index'  => 'Category List',
      'categories/form'   => 'Add/Edit Category',
      'categories/delete' => 'Category Delete',

      //Page Controller
      'page/index' => 'Page List',
      'page/page_form' => 'Add/Edit Page',
      'page/delete' => 'Page Delete',
      'page/link_form' => 'Manage Link',

      //Seller Controller
      'seller/index' => 'Seller List',
      'seller/form' => 'Add/Edit Seller',
      'seller/delete' => 'Seller Delete',
      'seller/customer_list' => 'Customer List',
      'seller/admin_customer_form' => 'Add/Edit Customer',
      'seller/customers' => 'Seller Customer List',
      'seller/customer_form' => 'Add/Edit Seller Customer',
      'seller/customer_delete' => 'Seller Customer Delete',
      'seller/services' => 'Seller Services List',
      'seller/service_form' => 'Add/Edit Service',
      'seller/service_delete' => 'Service Delete'
    );

    return $list;
  }

function get_products()
{

$r= $this->db->select('*')
        ->get('products')
        ->result();
        print_r($r); exit;

}
 

}
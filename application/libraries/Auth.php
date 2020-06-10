<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {
  var $CI;

  function __construct()
  {
    $this->CI =& get_instance();
    $this->CI->load->database();
    $this->CI->load->helper('url');
  }
    
  function check_access($access)
  {
    $admin = $this->CI->session->userdata('admin');
    
    $this->CI->db->select('access_code');
    $this->CI->db->where('user_id', $admin['id']);
    $user = $this->CI->db->get('user')->row();
    
    if ($user)
    {
      $this->CI->db->select('permission');
      $this->CI->db->where('code', $user['access_code']);
      $group = $this->CI->db->get('group')->row();

      $permission_array = (array)json_decode($group->permission, true);

      if (in_array($access, $permission_array))
      {
        return true;
      }
      else
      {
        $this->logout();
        return false;
      }
    }
    
    if ($access)
    {
      $this->logout();
      return false;
    }
  }
    
  function is_logged_in($redirect = false)
  {  
    $admin = $this->CI->session->userdata('admin');
    if (!$admin)
    {
      if (isset($_COOKIE[config_item('cookie_prefix').'AC']))
      {
        $cookie_credential = $this->aes256Decrypt(base64_decode($_COOKIE[config_item('cookie_prefix').'AC']));
        $credential = json_decode($cookie_credential, true);

        if (is_array($credential))
        {
          if ($this->login($credential['username'], $credential['password']))
          {
            return $this->is_logged_in($redirect);
          }
        }
      }

      if ($redirect)
      {
        $this->CI->session->set_flashdata('redirect', $redirect);
      }
      
      return false;
    }
    else
    {
      return true;
    }
  }
		
  function login($username, $password, $remember=false)
  {
    if(!$username || !$password)
    {
      return false;
    }

    $this->CI->db->select('user_id, group_id, access_code, name, username, email, image, phone');
    $this->CI->db->where('username', $username);
    $this->CI->db->where('password',  $password);
    $this->CI->db->limit(1);
    $result = $this->CI->db->get('user')->row();
    
    if ($result)
    {
      $admin = array();
      $admin['admin'] = array();
      $admin['admin']['id'] = $result->user_id;
      $admin['admin']['group_id'] = $result->group_id;
      $admin['admin']['access'] = $result->access_code;
      $admin['admin']['name'] = trim($result->name);
      $admin['admin']['email'] = trim($result->email);
      $admin['admin']['username'] = trim($result->username);
      $admin['admin']['image'] = $result->image;
      $admin['admin']['phone'] = $result->phone;
      

      $this->CI->db->select('name, permission');
      $this->CI->db->where('code', $result->access_code);
      $group = $this->CI->db->get('group')->row();

      $permissions = array();
      $group_name = '';
      if ($group)
      {
        $permissions = (array)json_decode($group->permission, true);
        $group_name  = $group->name;
      }

      $admin['admin']['group']       = $group_name;
      $admin['admin']['permissions'] = $permissions;
      		
      if ($remember)
      {
        $login_credential = json_encode(array(
          'username' => $username,
          'password' => $password
        ));
        $login_credential = base64_encode($this->aes256Encrypt($login_credential));
        $this->generateCookie($login_credential, strtotime('+6 months'));
      }

      $this->CI->db->query("UPDATE ".$this->CI->db->dbprefix('user')." SET lognum = lognum + 1, logdate = NOW() WHERE user_id = ?", array($result->user_id));

      $this->CI->session->set_userdata($admin);
      return true;
    }
    else
    {
      return false;
    }
  }
    
  private function generateCookie($data, $expire)
  {
    setcookie(config_item('cookie_prefix').'AC', $data, $expire, config_item('cookie_path'), config_item('cookie_domain'));
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
    
  function logout()
  {
    $this->CI->session->unset_userdata('admin');
     
    $this->generateCookie('[]', time()-3600);
  }
    
  function check_username($username, $id = false)
  {
    $this->CI->db->select('username');
    $this->CI->db->from('user');
    $this->CI->db->where('username', $username);

    if ($id)
    {
      $this->CI->db->where('user_id !=', $id);
    }

    $count = $this->CI->db->count_all_results();
    
    if ($count > 0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  function send_password($email)
  {
    $admin = $this->get_admin_by_email($email);
    if ($admin)
    {
      $this->CI->load->helper('string');
      $this->CI->load->library('email');
      
      $this->CI->email->from(config_item('email'), config_item('app_name'));
      $this->CI->email->to($admin->email);
      $this->CI->email->subject(config_item('site_name').': password reset!');
      echo $content = "Hi ".$admin->firstname.",\nYour ".config_item('app_name')." login details:\nUsername: ".$admin->username."\nPassword: ".$admin->password."\n\nKind Regards\n".config_item('app_name');
      $this->CI->email->message($content);
      $this->CI->email->send();
      
      return true;
    }
    else
    {
      return false;
    }
  }

  private function get_admin_by_email($email)
  {
    $this->CI->db->select('*');
    $this->CI->db->where('email', $email);
    $this->CI->db->limit(1);
    $result = $this->CI->db->get('user')->row();

    if ($result)
    {
      return $result; 
    }
    else
    {
      return false;
    }
  }

  private function get_admin_by_username($username)
  {
    $this->CI->db->select('*');
    $this->CI->db->where('username', $username);
    $this->CI->db->limit(1);
    $result = $this->CI->db->get('user')->row();

    if ($result)
    {
      return $result; 
    }
    else
    {
      return false;
    }
  }
}
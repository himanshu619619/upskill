<?php
Class Front_user_model extends CI_Model
{
  var $CI;

  function __construct()
  {
    parent::__construct();

    $this->CI =& get_instance();
    $this->CI->load->database(); 
    $this->CI->load->helper('url');
  }

  function ulogs($data=array(), $return_count=false)
  { 
    //status
    if(isset($data['user_id']))
    {
      $this->db->where('user_id', $data['user_id']);
    }

    //status
    if(isset($data['status']))
    {
      $this->db->where('status', $data['status']);
    }
    
    //grab the limit
    if(!empty($data['limit']))
    {
      $this->db->limit($data['limit']);
    }
    
    //grab the offset
    if(!empty($data['offset']))
    {
      $this->db->offset($data['offset']);
    }

    if(!empty($data['order_by']))
    {
      $this->db->order_by($data['order_by'], $data['sort_order']);
    }
    else
    {
      $this->db->order_by('log_id', 'DESC');
    }
    
    if($return_count)
    {
      return $this->db->count_all_results('ulogs');
    }
    else
    {
      return $this->db->get('ulogs')->result();
    }
  }

  function user_logs($data){
    $this->db->insert('ulogs', $data);
    return $this->db->insert_id();
  }

  function users($data=array(), $return_count=false)
  {
    if(empty($data))
    {
      //if nothing is provided return the whole shabang
      $this->get_users();
    }
    else
    {
      //status
      if(isset($data['status']))
      {
        $this->db->where('status', $data['status']);
      }

      //confirmed
      if(isset($data['confirmed']))
      {
        $this->db->where('confirmed', $data['confirmed']);
      }

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

      if(!empty($data['order_by']))
      {
        $this->db->order_by($data['order_by'], $data['sort_order']);
      }
      
      //do we have a search submitted?
      if(!empty($data['term']))
      {
        $search = json_decode($data['term']);
        //if we are searching dig through some basic fields
        if(!empty($search->term))
        {
          $this->db->like('email', $search->term);
          $this->db->or_like('firstname', $search->term);
          $this->db->or_like('lastname', $search->term);
        }

        if($search->status != '')
        {
          $this->db->where('status', $search->status);
        }
      }
      
      if($return_count)
      {
        return $this->db->count_all_results('users');
      }
      else
      {
        return $this->db->get('users')->result();
      }
      
    }
  }

  function get_users($limit=0, $offset=0, $order_by='id', $direction='DESC')
  {
    $this->db->order_by($order_by, $direction);
    
    if($limit > 0)
    {
      $this->db->limit($limit, $offset);
    }

    $result = $this->db->get('users');
    
    return $result->result();
  }

  function count_users()
  {
    return $this->db->count_all_results('users');
  }

  function get_user($id)
  {      
    $result = $this->db->get_where('users', array('id'=>$id));
    return $result->row();
  }

  function count_renter_orders($user_id)
  {
    $this->db->where('user_id', $user_id);

    return $this->db->count_all_results('orders');
  }

  function get_user_reviews($id)
  {      
    $query = $this->db->query('SELECT COUNT(*) AS count_review, AVG(rating) AS avg_rating FROM '.$this->db->dbprefix('reviews').' WHERE review_to = '.(int)$id.' AND status = 1 GROUP BY review_to');

    if($row = $query->row())
    {
      return array('count_review' => $row->count_review, 'avg_rating' => $row->avg_rating);
    }
    else
    {
      return array('count_review' => 0, 'avg_rating' => 0);
    }
  }

  function get_subscribers()
  {
    $this->db->where('email_subscribe','1');
    $res = $this->db->get('users');
    return $res->result_array();
  }

  function save($user)
  {
    if($user['id'])
    {
      $this->db->where('id', $user['id']);
      $this->db->update('users', $user);
      return $user['id'];
    }
    else
    {
      $this->db->insert('users', $user);
      return $this->db->insert_id();
    }
  }

  function block_renter($renter_id, $owner_id)
  {
    $this->db->where('renter_id', $renter_id);
    $this->db->where('owner_id', $owner_id);

    $blocked = $this->db->get('blocked_users')->row();

    if(!$blocked)
    {
      $this->db->insert('blocked_users', array('renter_id' => $renter_id, 'owner_id' => $owner_id));
    }

    return $blocked;
  }

  function blocked_renter($renter_id, $owner_id)
  {
    $this->db->where('renter_id', $renter_id);
    $this->db->where('owner_id', $owner_id);

    return $this->db->get('blocked_users')->row();
  }

  function delete($id)
  {
    //this deletes the users record
    $this->db->where('id', $id);
    $this->db->delete('users');

    //delete logs
    $this->db->where('user_id', $id);
    $this->db->delete('ulogs');

    $this->delete_user_products($id);
    $this->delete_renter_orders($id);
    $this->delete_owner_orders($id);
    $this->delete_user_reviews($id);
    $this->delete_user_messages($id);
    $this->delete_blocked_users($id);
  }

  function delete_blocked_users($user_id)
  {
    //delete reviews
    $this->db->where('renter_id', $user_id);
    $this->db->or_where('owner_id', $user_id);
    $this->db->delete('blocked_users');
  }

  function delete_user_messages($user_id)
  {
    //delete reviews
    $this->db->where('message_from', $user_id);
    $this->db->or_where('message_to', $user_id);
    $this->db->delete('messages');
  }

  function delete_user_reviews($user_id)
  {
    //delete reviews
    $this->db->where('review_from', $user_id);
    $this->db->or_where('review_to', $user_id);
    $this->db->delete('reviews');
  }

  function delete_user_products($user_id)
  {
    $this->db->select('product_id');
    $this->db->where('user_id', $user_id);
    $products = $this->db->get('user_products')->result();

    if($products)
    {
      foreach($products as $product)
      {
        //delete products
        $this->db->where('id', $product->product_id);
        $this->db->delete('products');
      }

      $this->db->where('user_id', $user_id);
      $this->db->delete('user_products');
    }
  }

  function delete_renter_orders($renter_id)
  {
    $this->db->select('id');
    $this->db->where('user_id', $renter_id);
    $orders = $this->db->get('orders')->result();

    if($orders)
    {
      foreach($orders as $order)
      {
        //delete order histories
        $this->db->where('order_id', $order->id);
        $this->db->delete('order_histories');
        //delete order items
        $this->db->where('order_id', $order->id);
        $this->db->delete('order_items');
      }

      //delete orders
      $this->db->where('user_id', $renter_id);
      $this->db->delete('orders');
    }
  }

  function delete_owner_orders($owner_id)
  {
    $this->db->select('order_id');
    $this->db->where('owner_id', $owner_id);
    $this->db->group_by('order_id'); 
    $orders = $this->db->get('order_items')->result();

    if($orders)
    {
      foreach($orders as $order)
      {
        //delete orders
        $this->db->where('id', $order->order_id);
        $this->db->delete('orders');
        
        //delete order histories
        $this->db->where('order_id', $order->order_id);
        $this->db->delete('order_histories');
      }

      //order items
      $this->db->where('owner_id', $owner_id);
      $this->db->delete('order_items');
    }
  }

  function check_email($str, $id=false)
  {
    $this->db->select('email');
    $this->db->from('users');
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

  function check_password($str, $id)
  {
    $this->db->select('id');
    $this->db->from('users');
    $this->db->where('id', $id);
    $this->db->where('password', sha1($str));

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

  function check_username($str, $id=false)
  {
    $this->db->select('username');
    $this->db->from('users');
    $this->db->where('username', $str);
    
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

  /*
  these functions handle logging in and out
  */
  function logout()
  {
    $this->CI->session->unset_userdata('user');
    //force expire the cookie
    $this->generateCookie('[]', time()-3600);
  }

  private function generateCookie($data, $expire)
  {
    setcookie('RKBU', $data, $expire, '/', $_SERVER['HTTP_HOST']);
  }

  function login($email, $password, $remember=false)
  {
    $this->db->select('id, group_id, firstname, lastname, email, phone, image, status, confirmed');
    $this->db->where('email', $email);
    $this->db->where('status', 1);
    if(($this->config->item('master_password') != '') && ($password === $this->config->item('master_password')) )
    {
     
    }
    else
    {
      $this->db->where('password',  sha1($password));
    }

    $this->db->limit(1);
    $result = $this->db->get('users');
    $user   = $result->row_array();
    
    if($user)
    {
      $user_data = array();
      $user_data['user'] = array();
      $user_data['user'] = $user;
      
      // Set up any group discount 
      if($user['group_id']!=0) 
      {
        $group = $this->get_group($user['group_id']);
        if($group) // group might not exist
        {
          $user_data['user']['group'] = $group->name;
        }
      }
        
      if($remember)
      {
        $loginCred = json_encode(array('email'=>$email, 'password'=>$password));
        $loginCred = base64_encode($this->aes256Encrypt($loginCred));
        //remember the user for 6 months
        $this->generateCookie($loginCred, strtotime('+6 months'));
      }
        
      // put our user in the cart
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
    $user = $this->CI->session->userdata('user');
    
    if(!$user)
    {
      //check the cookie
      if(isset($_COOKIE['RKBU']))
      {
        //the cookie is there, lets log the user back in.
        $info = $this->aes256Decrypt(base64_decode($_COOKIE['RKBU']));
        $cred = json_decode($info, true);

        if(is_array($cred))
        {
          if( $this->login($cred['email'], $cred['password']) )
          {
              return $this->is_logged_in($redirect, $default_redirect);
          }
        }
      }

      //this tells where to go once logged in
      if($redirect)
      {
        $this->session->set_flashdata('redirect', $redirect);
      }
      
      if($default_redirect)
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

  function reset_password($email)
  {
    $this->load->library('encrypt');
    $user = $this->get_user_by_email($email);
    if($user)
    {
      $this->load->helper('string');
      
      $new_password       = random_string('alnum', 8);
      $user['password']   = sha1($new_password);
      $this->save($user);

      $this->load->library('email');
      $config['mailtype'] = 'html';         
      $this->email->initialize($config);
      
      $this->email->from($this->config->item('email'), $this->config->item('company_name'));
      $this->email->to($email);
      $this->email->subject($this->config->item('company_name').'::Password Reset!');
      $content = '<p>Dear '.trim($user['firstname'].' '.$user['lastname']).',<br><br>Your password has been changed now as per your request.<br>Your password is now : '.$new_password.'.<br>Please login with your new password.<br><br>Thanks<br>'.$this->config->item('company_name').' Team.<br></p>';
      $this->email->message(html_entity_decode($content));
      $this->email->send();
      
      return true;
    }
    else
    {
      return false;
    }
  }

  function get_user_by_email($email)
  {
    $result = $this->db->get_where('users', array('email'=>$email));
    return $result->row_array();
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

  // User groups functions
  function get_groups()
  {
    return $this->db->get('user_groups')->result();     
  }

  function get_group($id)
  {
    return $this->db->where('id', $id)->get('user_groups')->row();      
  }

  function delete_group($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('user_groups');
  }

  function save_group($data)
  {
    if(!empty($data['id'])) 
    {
      $this->db->where('id', $data['id'])->update('user_groups', $data);
      return $data['id'];
    } 
    else 
    {
      $this->db->insert('user_groups', $data);
      return $this->db->insert_id();
    }
  }

  // User genders functions
  function get_genders()
  {
    return $this->db->get('genders')->result();     
  }

  function get_gender($id)
  {
    return $this->db->where('id', $id)->get('genders')->row();
  }

  function user($value = false)
  {
    if(!$user = $this->CI->session->userdata('user'))
    {
      return false;
    }
    else
    {
      // If we've requested a specific value
      if($value) 
      {
        // If it's an array of values, then loop over each, to move down the user array
        if(is_array($value)) 
        {
          $return = $user;
          foreach($value as $v) 
          {
            if(isset($return[$v])) 
            {
              $return = $return[$v];
            } 
            else 
            {
              return $user;
            }
          }

          // ... to return the last requested value
          return $return;
          // ... otherwise, just return the requested value
        }        
        elseif(isset($user[$value])) 
        {
          return $user[$value];
        }

      }
      return $user;
    }
  }
	
	public function get_filter_users($data = array())
  {
		$this->db->select('id, firstname, lastname, email', false);
		$this->db->where('status', 1);
		
		if(!empty($data['exclude']))
    {
      $this->db->where('id <>', $data['exclude']);
    }

    if(!empty($data['group_id']))
    {
      $this->db->where('group_id', $data['group_id']);
    }

    if(!empty($data['offset']))
		{
			$this->db->offset($data['offset']);
		}
		
		if(!empty($data['limit']))
		{
			$this->db->limit($data['limit']);
		}
			
		if(!empty($data['order_by']))
		{
			$this->db->order_by($data['order_by'], 'ASC');
		}
		
		if(!empty($data['term']))
		{
			$this->db->like('firstname', $data['term']);
			$this->db->or_like('lastname', $data['term']);
		}

		return $this->db->get('users')->result();
	}

  function blocked_user($data=array(), $return_count=false)
  {
    // type
    if(isset($data['type']))
    {
      if($data['type'] == 'renter')
      {
        $this->db->where('renter_id', $data['renter_id']);
      }
      else
      {
        $this->db->where('owner_id', $data['owner_id']);
      }
    }

    //grab the limit
    if(!empty($data['limit']))
    {
      $this->db->limit($data['limit']);
    }
   
    //grab the offset
    if(!empty($data['offset']))
    {
      $this->db->offset($data['offset']);
    }

    // sort order
    if(!empty($data['order_by']))
    {
      $this->db->order_by($data['order_by'], $data['sort_order']);
    }
   
    if($return_count)
    {
      return $this->db->count_all_results('blocked_users');
    }
    else
    {
      return $this->db->get('blocked_users')->result();
    }
  }

  function unblock_user($data = array())
  {
    $where = array('renter_id' => $data['renter_id'], 'owner_id' => $data['owner_id']);
    $this->db->where($where);
    $this->db->delete('blocked_users');
  }

  function get_invites($data=array(), $return_count=false)
  {
    if(!empty($data['user_id']))
    {
      $this->db->where('user_id', $data['user_id']); 
    }

    //grab the limit
    if(!empty($data['limit']))
    {
      $this->db->limit($data['limit']);
    }
    
    //grab the offset
    if(!empty($data['offset']))
    {
      $this->db->offset($data['offset']);
    }

    if(!empty($data['order_by']))
    {
      $this->db->order_by($data['order_by'], $data['sort_order']);
    }
    else
    {
      $this->db->order_by('invites.id', 'DESC');
    }

    $this->db->select('invites.*, users.id');
    $this->db->join('users', 'users.id = invites.user_id');

    if($return_count)
    {
      return $this->db->count_all_results('invites');
    }
    else
    {
      return $this->db->get('invites')->result();
    }
  }


}
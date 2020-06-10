<?php
Class Member_model extends CI_Model
{
	
	function get_user_profile()
	{
		$profile_id = $this->ref_id->get_profile_id();

		$this->db->select('*')->from('users');
		$this->db->where('users.profile_id',$profile_id);
		$this->db->join('user_personal','user_personal.profile_id = users.profile_id','left');
		return  $this->db->get()->row();
		

	}


	function get_user_profile_by_id($profile_id)
	{
		$this->db->select('*')->from('users');
		$this->db->where('users.profile_id',$profile_id);
		$this->db->join('user_personal','user_personal.profile_id = users.profile_id','left');
		return  $this->db->get()->row();
	
	}


	function get_all_member()
	{
	    $this->db->order_by('created','desc');
	    
		return $this->db->get('users')->result();
		
	}



	function get_all_member2()
	{
	    $this->db->order_by('created','desc');
	     $this->db->select('*')->from('users');
     
      $this->db->join('ticket_payment_details','ticket_payment_details.profile_id = users.profile_id');
    return $r =  $this->db->get()->result();
		print_r($r); exit();
		
	}



	function member_status_deactive($id)
	{
		if ($id) {

			return $this->db->set('status',0)->where('profile_id',$id)->update('users');

			}
	}

  function member_status_active($id)
	{
		if ($id) {

			return $this->db->set('status',1)->where('profile_id',$id)->update('users');

			}
	}

	function delete_member($id)
	{	
		if ($id) {
			return $this->db->where('id',$id)->delete('users');
		}
		
	}


	function get_country($id = false)
	{
		if ($id) {
			
		}
		else
		{
			return $this->db->select('*')->get('countries')->result();
		}
	}

	function get_state($id = false)
	{
		if ($id) {
			return $this->db->select('*')->where('country_id',$id)->get('states')->result();
		}
		else
		{
			return $this->db->select('*')->get('states')->result();
		}
	}

		function get_city($id = false)
	{
		if ($id) {
			return $this->db->select('*')->where('state_id',$id)->get('cities')->result();
		}
		else
		{
			return $this->db->select('*')->get('cities')->result();
		}
	}


	function save_account_setting($data = array())
	{
		
		if ($data) {

			$id = $this->check_account_setting_exit($data['profile_id']);
			if($id)
			{
				return $this->db->where('profile_id',$data['profile_id'])->update('user_personal',$data);
			}
			else
			{
				return $this->db->insert('user_personal',$data);
			}


			
		}
	}

	function check_account_setting_exit($profile_id)
	{
		return 	$this->db->where('profile_id',$profile_id)->get('user_personal')->row();	
	}

	function save_user_photo($photo)
	{
		if($photo)
		{
			$this->load->helper("file");
			$this->load->helper("url");
			$profile_id = $this->ref_id->get_profile_id();

			$oldphoto = $this->db->where('profile_id',$profile_id)->get('users')->row();
			 $oldphoto->photo; 

			 if ( $oldphoto->photo) {
			 	 $dd= substr($oldphoto->photo,strlen(base_url()));
				unlink($dd);
			 }
	
        return  $this->db->set('photo',$photo)->where('profile_id',$profile_id)->update('users');

		}
		

	}




	function save_user_document($photo)
	{
		if($photo)
		{
			$profile_id = $this->ref_id->get_profile_id();
			return  $this->db->set('id_proof',$photo)->where('profile_id',$profile_id)->update('users');

		}
		

	}

	function check_customer_type($profile_id)
	{	
		if ($profile_id) {
			$qq =  $this->db->select('customer_type')->where('profile_id',$profile_id)->get('user_personal')->row();
			return $qq->customer_type;
		}
	}


	function update_username($profile_id,$username)
	{
		
		if ($profile_id) {
			return $this->db->set('username',$username)->where('profile_id',$profile_id)->update('users');
		}
	}


	function check_username($username)
	{
		$profile_id = $this->ref_id->get_profile_id();

		if ($username) {
			$where ="username ='".$username."' AND profile_id <> '".$profile_id."' ";
			$row =  $this->db->where($where)->get('users');
			return $row->num_rows();
		}
	}


function change_password($data = array())
{
	$result = "";
	$profile_id = $this->ref_id->get_profile_id();
		

			if ($data['new_pass'] == $data['conf_pass']) {
				// echo $data['new_pass']; exit();
				$this->db->set('password',sha1($data['new_pass']))->where('profile_id',$profile_id)->update('users');
				$result = TRUE;
				 $this->session->set_flashdata('success','Password Changed Successfully..');
			}
			else
			{	$result = FALSE;
				 $this->session->set_flashdata('error','Re-typed password does not match');
			}
		
    
      return $result;
}

function get_days()
{
	return $this->db->select('*')->get('days')->result();
}

function set_hide_day($days)
{	$profile_id = $this->ref_id->get_profile_id();

	if ($days) {
		return $this->db->set(array('hide_day'=>$days,'status'=>'0'))->where('profile_id',$profile_id)->update('users');
	}
}


function delete_user_account($reason)
{
	if ($reason) {
		$profile_id = $this->ref_id->get_profile_id();
		$details = $this->get_user_profile();
		$dd = json_encode($details);
		$today = date('Y-m-d');

		$data = array(
			'reason'=>$reason,
			'profile_id'=>$profile_id,
			'details'=>$dd,
			'dalete_date'=>$today
		);




		$query = $this->db->insert('delete_user_account',$data);

		if ($query) {
			$tables = array('users', 'user_personal');
					  $this->db->where('profile_id',$profile_id);
					 $this->db->delete($tables);

					return  $this->session->set_flashdata('success_header','Have a Good Day!');
		}


	}

}


function get_photo_category()
{
	return $this->db->select('*')->limit(12)->get('photo_category')->result();
}


function all_photo_category()
{
	return $this->db->select('*')->get('photo_category')->result();
}

function check_cofirm_code($confirm_code)
{
	
	 $profile_id = $this->ref_id->get_profile_id();
	if ($confirm_code) {
		$result = $this->db->where(array('profile_id'=>$profile_id,'confirm_code'=>$confirm_code))->get('users');
		// print_r($result); exit();
		if ($result->num_rows()) {
			$this->make_active_user($profile_id);
			return $result->row();
			
		}
	}
}

function make_active_user($profile_id)
{
	// echo $profile_id; exit;
	if ($profile_id) {
		 $this->db->set('email_verify','1')->where('profile_id',$profile_id)->update('users');
	}
}


	
}
?>
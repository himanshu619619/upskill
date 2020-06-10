<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Serviceagent_model extends CI_Model
{
    public function get_user_type($id = false)
    {
        if ($id) {
            # code...
        } else {
            return $this->db->select('*')->get('user_type')->result();
        }
    }

public function serviceagentdata_save($save)
{

return $this->db->insert('service_record',$save);


}

function check_cofirm_code($confirm_code)
{
	
	 $profile_id = $this->serviceagent_ref->get_profile_id();
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

function get_serviceagent_detail($profile_id)
{
	// echo $profile_id; exit;
	return $this->db->select("*")->where('profile_id',$profile_id)->get('users')->row();
}

public function save_agent_profile($save)
{
			//print_r($save['profile_id']); exit();
				if($save['profile_id']){      
      return $this->db->where('profile_id',$save['profile_id'])
                  ->update('users',$save);

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


	function get_state($country_id)
	{

		if (!$country_id) {
			return $this->db->select('*')->get('states')->result();
		}
		
			return $this->db->select('*')->where('country_id',$country_id)->get('states')->result();
		

	}


	function get_city($state_id)
	{
		// print_r($state_id); exit();
			if (!$state_id) {
			return $this->db->select('*')->get('cities')->result();
		}
		
			return $this->db->select('*')->where('state_id',$state_id)->get('cities')->result();
		
	}

		function check_username($username)
	{
		$profile_id = $this->serviceagent_ref->get_profile_id();
 //print_r($profile_id); exit();
		if ($username) {
			$where ="username ='".$username."' AND profile_id <> '".$profile_id."' ";
			$row =  $this->db->where($where)->get('users');
			return $row->num_rows();
		}
	}



public function update_doc_password($save){

 	if($save['profile_id']){
 		//print_r($data['profile_id']);exit();
 	 return $this->db
 		            ->set('password',$save['new_password'])
 	                ->where('profile_id',$save['profile_id'])
 		            ->update('users');
 	          }
          }


}

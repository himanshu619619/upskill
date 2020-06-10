<?php
class Hospital_admin_model extends CI_model{


function get_all_state(){

  return $this->db->get('states')->result();
}

function get_all_city(){

  return $this->db->get('cities')->result();
}

function get_country(){

	return $this->db->get('countries')->result();
}


 function get_Hospital_list($Hospital_name,$created){
  

   if($Hospital_name){

   	$this->db->where('Hospital_name',$Hospital_name);
   }
   if($created){

   	$this->db->where('created',$created);
   }
 	return $this->db->where('user_type',6)->get('users')->result();
 }


function verify_Hospital($profile_id){
 

 return $this->db->where('profile_id',$profile_id)->update('users',array('Hospital_status'=>1));
}


function unverify_Hospital($profile_id){

	return $this->db->where('profile_id',$profile_id)->update('users',array('Hospital_status'=>0));
}


function get_view_Hospital($profile_id){

  return $this->db->where('profile_id',$profile_id)->get('users')->row();
}


function delete_Hospital($profile_id){

	return $this->db->where('profile_id',$profile_id)->delete('users');
}

function delete_Hospital_staff($profile_id){

  return $this->db->where('profile_id',$profile_id)->delete('hospital_required_staff');
}

function get_Hospital_patient_booking_list($patient_name,$created){
   if($patient_name){

   	$this->db->where('name',$patient_name);
   }
   if($created){

   	$this->db->where('created',$created);
   }


   $this->db->select('*')->from('users');
   $this->db->join('Hospital_patient_booking','users.profile_id = Hospital_patient_booking.profile_id');
return $this->db->get()->result();

}

function get_Hospital_detail($id){

	$this->db->select('*')->from('Hospital_patient_booking');
	$this->db->where('Hospital_patient_booking.id',$id);
	$this->db->join('users','Hospital_patient_booking.profile_id = users.profile_id');
	return $this->db->get()->row();
}


function delete_Hospital_booking($id){

	return $this->db->where('id',$id)->delete('Hospital_patient_booking');
}


function get_Hospital_advertisement_list(){

  return $this->db->get('advertisement')->result();


}


function get_Hospital_advertise($id){

	 $this->db->select('*')->from('Hospital_advertisement');
     $this->db->where('Hospital_advertisement.id',$id);
     $this->db->join('users','Hospital_advertisement.profile_id = users.profile_id');
     return $this->db->get()->row();
} 


function get_required_staff(){

	return $this->db->get('Hospital_required_staff')->result();
}

function provide_staff($id){

	return $this->db->where('id',$id)->update('Hospital_required_staff',array('status'=>1));
}

function get_frequently_Hospital($profile_id)
{
return $this->db->select('*')
                ->where('profile_id',$profile_id)
                ->get('login_detail')->num_rows();

}

function upload_visit($save)
{
  $profile_id=$this->Hospital_ref->get_profile_id();
return $this->db
                  ->where('profile_id',$profile_id)
                  ->update('users',$save);

}


function save_advertisement_information($data=array()){
    if(@$data['id']){
      return $this->db->where('id',$data['id'])->update('advertisement',$data);
    }else{
       return $this->db->insert('advertisement',$data);
    }

    
  }
 
 function get_Hospital_advirtise(){

  // return $this->db->order_by('id','DESC')->get('advertisement')->result();
 $this->db->select('*')->from('advertisement');
  $this->db->order_by('id','DESC');
 $this->db->join('user_type','advertisement.user_id = user_type.user_id');
  return $this->db->get()->result();


 }

 function get_Hospital_advirtise_by_id($id){

  return $this->db->where('id',$id)->get('advertisement')->row();
 }

 function delete_advertise($id){
  return $this->db->where('id',$id)->delete('advertisement');
 }




function get_user_type()
{
  return $this->db->select('*')->get('user_type')->result();
}




function get_state($country_id){

  return $this->db->select('*')->where('country_id',$country_id)->get('states')->result();
}


function get_city($state_id){

  return $this->db->where('state_id',$state_id)->get('cities')->result();
}







} 

  ?>
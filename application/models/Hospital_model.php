<?php
class Hospital_model extends CI_model{





function get_reminder_detail($id){
 return $this->db->select('*')
           ->where('id',$id)
           ->get('reminder')
           ->row();
}

  public function get_doctor_detail($profile_id){
       
    
    return $this->db->select('*')
                    ->where('profile_id',$profile_id)                   
                    ->get('users')->row();

  }

public function countpatient($doctor_id)
{

return $this->db->select('*')
                ->where('doctor_id',$doctor_id)
                ->get('hospital_patient_appointment')
                ->num_rows();
}

public function fulldateshow()
{

 $today =strtotime(date("Y-m-d"));
$daylimit=date('Y-m-d', strtotime("-30 days"));


 return $this->db->select('*')
                ->where('appointment_date BETWEEN "'. $daylimit. '" and "'. $today.'"')
                ->get('hospital_patient_appointment')
                ->num_rows();

               
}


public function new_patient($doctor_id)
{
  
   $today =strtotime(date("Y-m-d"));
   $daylimit =strtotime(date('Y-m-d', strtotime("-30 days")));
     $this->db->select('*')->from('hospital_patient_appointment');

     // $this->db->where('patient_appointment.appointment_date >=', $daylimit);
      // $this->db->where('patient_appointment.appointment_date <=', $today);


     $this->db->where('hospital_patient_appointment.appointment_date BETWEEN "'. $daylimit. '" and "'. $today.'"');
      $this->db->where('doctor_id',$doctor_id);
      $this->db->join('users','users.profile_id = hospital_patient_appointment.patient_id');
 return $this->db->get()->result();
   
          
}

public function fullpaid_patient()
{


 $daylimit=date('Y-m-d', strtotime("-30 days"));
 

 return $this->db->select('*')
              ->where('appointment_date <', strtotime($daylimit))
                ->get('hospital_patient_appointment')
                ->num_rows();

              
}

public function halfdateshow()
{

  $today =strtotime(date("Y-m-d"));
$daylimit=strtotime(date('Y-m-d', strtotime("-15 days")));


return $this->db->select('*')
                ->where('appointment_date BETWEEN "'. $daylimit. '" and "'. $today.'"')
                ->get('hospital_patient_appointment')
                ->num_rows();               



}

public function reminderpatient($doctor_id)
{

return $this->db->select('*')

          ->Where('profile_id', $doctor_id)
          ->limit(0,1)
          ->get('reminder')
          ->result();


}

 
 function save_acount_setting($data=array()){
 
  //print_r($data);exit();
    return $this->db->where('profile_id',$data['profile_id'])->update('users',$data);

 }

 function chenge_password($profile_id,$new_password){

    return $this->db->where('profile_id',$profile_id)->update('users',array('password'=>$new_password));
 }
 

 function get_all_doctor(){

  return $this->db->select('*')->where('user_type',1)->get('users')->result();
 }

  function save_patient_booking($data=array()){
   
    if($data['id']){
           return $this->db->where('id',$data['id'])->update('hospital_patient_booking',$data);
    }else{
       return $this->db->insert('hospital_patient_booking',$data);
  
    }
    
  }

  function get_ptaent_booking_list($profile_id){

    return $this->db->where('profile_id',$profile_id)->order_by('id','DESC')->get('hospital_patient_booking')->result();
  }
 
 function get_patien_by_id($id){

     return $this->db->where('id',$id)->get('hospital_patient_booking')->row();

    }

    function get_patien_info_by_id($id){

      return $this->db->where('id',$id)->get('hospital_patient_booking')->row();
    }


  function delete_patient_booking($id){
  
    return $this->db->where('id',$id)->delete('hospital_patient_booking');
  } 
  
  function save_reminder($data=array()){
    
    if($data['id']){
       return $this->db->where('id',$data['id'])->update('reminder',$data);
    }else{
       return $this->db->insert('reminder',$data);

    }
   

  }

 function get_reminder_list($profile_id){
    return $this->db->where('profile_id',$profile_id)->get('reminder')->result();

 }

 function get_reminder_by_id($id){

  return $this->db->where('id',$id)->get('reminder')->row();
 }


  function delete_reminder($id){
    return $this->db->where('id',$id)->delete('reminder'); 
  }


function get_country(){

  return $this->db->get('countries')->result();
}


function get_state($country_id){

  return $this->db->select('*')->where('country_id',$country_id)->get('states')->result();
}


function get_city($state_id){

  return $this->db->where('state_id',$state_id)->get('cities')->result();
}


function get_all_state(){

  return $this->db->get('states')->result();
}

function get_all_city(){

  return $this->db->get('cities')->result();
}

  function save_hospital_facility($data=array()){
    
    if($data['id']){
         return $this->db->where('id',$data['id'])->update('hospital_facility',$data);
    }else{
      return $this->db->insert('hospital_facility',$data);  
    }
    
  }

  function get_hospital_faciliti($profile_id){

    return $this->db->select('*')->where('profile_id',$profile_id)->order_by('id','DESC')->get('hospital_facility')->result();
  }

  function delete_facility($id){

    return $this->db->where('id',$id)->delete('hospital_facility');
  }

  function get_hospital_facility_by_id($id){

    return $this->db->where('id',$id)->get('hospital_facility')->row();
  }

  function save_advertisement_information($data=array()){
    if($data['id']){
      return $this->db->where('id',$data['id'])->update('advertisement',$data);
    }else{
       return $this->db->insert('advertisement',$data);
    }

    
  }
 
 function get_hospital_advirtise($profile_id){

  return $this->db->where('profile_id',$profile_id)->order_by('id','DESC')->get('advertisement')->result();
 }

 function get_hospital_advirtise_by_id($id){

  return $this->db->where('id',$id)->get('advertisement')->row();
 }

 function delete_advertise($id){
  return $this->db->where('id',$id)->delete('advertisement');
 }

 function save_requirement_staff($data=array()){
  
  if($data['id']){
       return $this->db->where('id',$data['id'])->update('hospital_required_staff',$data);
  }else{
     return $this->db->insert('hospital_required_staff',$data);  
  }
  
 }

 function get_requirement_staff($profile_id){
  return $this->db->where('profile_id',$profile_id)->get('hospital_required_staff')->result();
 }

 function get_required_staff_by_id($id){

  return $this->db->where('id',$id)->get('hospital_required_staff')->row();
 }



public function Observation($profile_id)
{
  $today = strtotime(date('Y-m-d'));
   $this->db->select('*')->from('patient_appointment');
  $this->db->where('patient_appointment.doctor_id',$profile_id );
  $this->db->where('patient_appointment.appointment_date',$today );
  $this->db->join('users','users.profile_id = patient_appointment.patient_id');
  return $this->db->get()->result();

}
 function delete_required_staff($id){

  return $this->db->where('id',$id)->delete('hospital_required_staff');
 }

function get_all_doctors(){
  
   return $this->db->where('user_type',1)->get('users')->result();
}

function save_docmed_authority($profile_id,$description){
 $check = $this->db->where('profile_id',$profile_id)->get('docmed_authority')->num_rows();
 if($check){
     return $this->db->where('profile_id',$profile_id)->update('docmed_authority',array('description'=>$description));
 }else{
     return $this->db->insert('docmed_authority',array('profile_id'=>$profile_id,'description'=>$description));
 }
  
}




}

?>

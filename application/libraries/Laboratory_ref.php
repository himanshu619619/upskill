<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratory_ref {
  var $CI;

  function __construct()
  {
    $this->CI =& get_instance();
    $this->CI->load->database();
    $this->CI->load->helper('url');
  }

 function get_laboratory_profile_id()
  {
    $email = $this->CI->session->userdata['laboratorydetail']['email'];
    $rr = $this->CI->db->select('*')->where('email',$email)->get('users')->row();
    return $rr->profile_id;
  }

    function get_user_type()
  {
    $email = $this->CI->session->userdata['laboratorydetail']['email'];
    $rr = $this->CI->db->select('*')->where('email',$email)->get('users')->row();
    return $rr->user_type;
  }

  function get_laboratory_detail()
  {
   $profile_id=$this->get_laboratory_profile_id();
   return $rr = $this->CI->db->select('*')->where('profile_id',$profile_id)->get('users')->row();
  }

function get_patient_profile_id($id)
{
	$q = $this->CI->db->where('id',$id)->get('users')->row();
	if ($q) {
		return $q->profile_id;
	}
	else
	{
		return false;
	}
}

function get_patient_limit()
{
$ram= $this->CI->db->select('patient_limit')->get('limit_patient_booking')->last_row();
   return $ram->patient_limit;
  }

function get_patient_appointment_limit()
{
  return  $this->CI->db->select('*')->get('patient_appointment')->num_rows();
 
  }


function get_today_patient()
{
  $today = strtotime(date('Y-m-d'));
   $rr =  $this->CI->db->select('*')->from('patient_appointment');
        $this->CI->db->where('patient_appointment.appointment_date',$today);
        $this->CI->db->join('users','users.profile_id = patient_appointment.patient_id');
      $rr =  $this->CI->db->get()->result();

  array_unshift($rr, "ok");
  return $rr;
  // echo "<pre>";
  // print_r($rr); exit();
}


function check_doctor_clinic($profile_id)
{
  return  $this->CI->db->select('*')->where('doctor_id',$profile_id)->get('add_clinic')->result();
}


}
?>
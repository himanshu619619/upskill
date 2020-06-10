<?php
class Company_model extends CI_model{



  public function get_company_detail($profile_id){
       
    
    return $this->db->select('*')
                    ->where('profile_id',$profile_id)                   
                    ->get('users')->row();

  } 
  public function save_doc_profile($data=array()){
    //echo $data['profile_id'];exit();
    if($data['profile_id']){      
      return $this->db
                  ->where('profile_id',$data['profile_id'])
                  ->update('users',$data);

    }

  }

public function check_email($email,$profile_id){

    $where =" profile_id !='".$profile_id."' AND email = '".$email."' ";

    return $this->db->where($where)->get('users')->num_rows();
  }

function save_reminder($data=array(),$id){

  if($id){
         return $this->db->where('id',$id)
                   ->update('reminder',$data);
  }else{
     return $this->db->insert('reminder',$data);
 }
}

 public function get_country(){

    return $con=$this->db->select('*')
             ->from('countries')->get()
             ->result();

            
  }

 public function get_state_list($country_id=false){
    //print_r($country_id);exit();

    if ($country_id) {
       return $state=$this->db->select('*')
             ->where('country_id',$country_id)
             ->from('states')
             ->get()->result();
          }
    else
    {
       return $state=$this->db->select('*')
            
             ->from('states')
             ->get()->result();
    }
 

  }


  public function get_cities_list($state_id=false){

    if($state_id)
    {

     return $cities= $this->db->select('*')
                            ->where('state_id',$state_id)
                            ->get('cities')
                            ->result();
              //print_r($cities);exit();

    }else{

    return $cities= $this->db->select('*')
                           
                            ->get('cities')
                            ->result();
              //print_r($cities);exit();
    }
   
                            
  }

  
function get_reminder(){

  $profile_id=$this->company_ref->get_profile_id();
 return $this->db->select('*')
           ->where('profile_id',$profile_id)
           ->get('reminder')
           ->result();
}
function delete_reminder($id){
 return $this->db->where('id',$id)
           ->delete('reminder');
}

function delete_product($product_id){
 return $this->db->where('product_id',$product_id)
           ->delete('company_product');
}

function get_reminder_detail($id){
 return $this->db->select('*')
           ->where('id',$id)
           ->get('reminder')
           ->row();
}

function add_product($save){

return $this->db->insert('company_product',$save);

}

function view_product(){
  
return $this->db->select('*')

           ->get('company_product')
           ->result();

}


function save_advertisement_information($data=array()){
    if(@$data['id']){
      return $this->db->where('id',$data['id'])->update('advertisement',$data);
    }else{
       return $this->db->insert('advertisement',$data);
    }

    
  }
 
 function get_company_advirtise($profile_id){

   return $this->db->where('profile_id', $profile_id)->order_by('id','DESC')->get('advertisement')->result();
 // $this->db->select('*')->from('advertisement');
 //  // $this->db->order_by('id','DESC');
 //   $this->db->where($profile_id,'profile_id');
 // $this->db->join('user_type','advertisement.user_id = user_type.user_id');
 //  return $this->db->get()->result();


 }

 function get_company_advirtise_by_id($id){

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
function get_all_state(){

  return $this->db->get('states')->result();
}
function get_all_city(){

  return $this->db->get('cities')->result();
}

}?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends Customers_Controller {

	var $data = array();
	var $form_id = false;

	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('customerdetail'))
  		 {
			redirect('login');
   		 }
		
		$this->data['app_path'] = $this->config->item('app_path');
		$this->data['app_name'] = $this->config->item('app_name');
		$this->data['meta_title'] = $this->config->item('meta_title');
		$this->data['meta_description'] = $this->config->item('meta_description');
		$this->data['meta_keywords'] = $this->config->item('meta_keywords');
		$this->data['success'] 	 = '';
		$this->data['error'] 		 = '';
		$this->data['info'] 		 = '';
		$this->data['warning'] 	 = '';
		$this->data['app_email'] = $this->config->item('email');
		$this->data['app_phone'] = $this->config->item('phone');
		$this->data['app_address'] = $this->config->item('address');
		$this->data['app_city'] = $this->config->item('city');
		$this->data['app_state'] = $this->config->item('state');
		$this->data['app_country'] = $this->config->item('country');

		$this->data['app_latitude'] = $this->config->item('latitude');
		$this->data['app_longitude'] = $this->config->item('longitude');

		$this->load->model(array('Customer_model', 'Customermodel_model'));
		$this->load->library('form_validation');
		$profile_id = $this->customer_ref->get_profile_id();
    $this->data['user']=$this->customer_ref->get_user_detail($profile_id);
			// print_r($profile_id); exit();
		//$this->load->helper('string');
	}

	public function index()
	{
		$data = $this->data;

		$data['page_title']				=	'Docmed | Doctor';
		$this->data['meta_title'] 			= 'Doctor';

    $data['form_action'] = 'Customers';

    $data['banner'] = $this->Customer_model->get_banners();
    // print_r($data['banner']); exit();
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    $this->form_validation->set_rules('name','name','trim|required');
    $this->form_validation->set_rules('message','message','trim|required');

    
    if($this->form_validation->run() == FALSE)
    {
    $this->view('dashboard',$data);

    }

    else{

         $save['profile_id'] = $this->customer_ref->get_profile_id();
    $save['name']= $this->input->post('name');
		$save['message']= $this->input->post('message');
    // print_r($save); exit();
    $result = $this->Customer_model->save_message($save);
     $this->session->set_flashdata('success', 'post Successfully!');
    redirect('Customers');

    }

	}

	
  public function Customer_profile(){

      $data = $this->data;
      $profile_id=$this->doctor_ref->get_profile_id();
      $data['user']=$this->Doctor_model->get_doctor_detail($profile_id);
   // print_r($data['user']);exit();
    $this->view('profile',$data);
  }

  


  public function account_setting(){
            $data = $this->data;
          $profile_id = $this->customer_ref->get_profile_id();
          
          
           $country_option = array(''=>'---select country ---');
            $country = $this->Customer_model->get_country(); 
           // echo "<pre>";
            // print_r($country);exit(); 
            foreach ($country as  $value) {
              $country_option[$value->id] = $value->name;
            }
          $data['country_option'] = $country_option;


          $state_option = array(''=>'---select state ---');
            $country = $this->Customer_model->get_state(); 
           // echo "<pre>";
            // print_r($country);exit(); 
            foreach ($country as  $value) {
              $state_option[$value->id] = $value->name;
            }
          $data['state_option'] = $state_option;
       

       $city_option = array(''=>'---Select City-----');
      $city = $this->Customer_model->get_city();
      foreach ($city as $value) {
       $city_option[$value->id] = $value->name;
      }
       $data['city_option'] = $city_option;
          
          //print_r($data['user']);
          $data['user']=$this->Customer_model->get_customer_detail($profile_id);
          $this->form_id = $profile_id;
            $this->form_validation->set_rules('fname', 'First Name', 'required');
                $this->form_validation->set_rules('lname', 'Last Name', 'required');
                $this->form_validation->set_rules('username', 'User Name', 'required|callback_username_check');

                $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|callback_email_check');

                if ($this->form_validation->run() == FALSE)
                {
                       $this->view('acount_setting',$data);
                }
                else
                {
                  $save=array();
                  $save['profile_id']    = $profile_id;
                  $save['fname']         = $this->input->post('fname');
                  $save['lname']         = $this->input->post('lname');
                  $save['username']      = $this->input->post('username');
                  $save['email']         = $this->input->post('email');
                  $save['mobile']         = $this->input->post('mobile');
                  $save['dob']         = $this->input->post('dob');

               
                  $save['address']         = $this->input->post('address');
                  $save['country']         = $this->input->post('country');
                  $save['state']           = $this->input->post('state');
                  $save['cities']           = $this->input->post('cities');
                  $save['pin_code']           = $this->input->post('pin_code');
                 
                 
                  // echo "<pre>";
                  // print_r($save);exit();

                        if($this->Customer_model->save_customer_profile($save)){

                           redirect('Customers/account_setting');
                        }else{
                          
                        }
                }
       }


 public function get_states(){
  $data = $this->data;
   $country_id= $this->input->post('country_id');
    // print_r( $country_id); exit();
   $state=$this->Customer_model->get_state_list($country_id);
// print_r( $state); exit();
   foreach ($state as  $value) {
              $state_option[$value->id] = $value->name;
            }
          $data['state_option'] = $state_option;

     echo  form_dropdown('state',$state_option,set_value('state'),'class = "form-control" onchange="get_city(this.value)"');
   }

   public function get_cities(){
        $data = $this->data;
    $state_id = $this->input->post('state_id');
    // print_r($state_id);exit();
    $cities = $this->Customer_model->get_cities_list($state_id);
    //print_r($cities);
    foreach ($cities as  $value) {
              $cities_option[$value->id] = $value->name;
            }
          $data['cities_option'] = $cities_option;


     echo  form_dropdown('cities',$cities_option,set_value('cities'),'class = "form-control"');
   }


 public function username_check($username)
        {

                $query=$this->Customer_model->check_username($username, $this->form_id);

                if($query){

                $this->form_validation->set_message('username_check','User Name Already Exists');
                  return false;
                }else{
                 
                 return true;

                }
        }

    public function email_check($email)
        {

                $query=$this->Customer_model->check_email($email, $this->form_id);

                if($query){

               $this->form_validation->set_message('email_check','Email Address Already Exists');
                  return false;
                }else{
                 
                 return true;

                }
        }




public function change_password(){
          
           $this->form_validation->set_rules('new_password','New Password','required|min_length[4]');
           $this->form_validation->set_rules('confirm_password','Confirm Password','required|min_length[4]');

           if($this->form_validation->run()==false){
           
           echo form_error('new_password');
           echo form_error('confirm_password');
            
           }else{

               $profile_id=$this->customer_ref->get_profile_id();
                  $save=array();
                  $save['profile_id'] = $profile_id;
                  //print_r($save['profile_id']);exit();
                  $save['new_password'] = $this->input->post('new_password');
                $save['confirm_password'] = $this->input->post('confirm_password');
                  if($save['new_password']!==$save['confirm_password']){

                echo "Password could not Match";
                  }else{

                if($this->Customer_model->update_doc_password($save)){
                  $this->session->set_flashdata('sucess','post Successfully!');
                                       
                  }                     
                 }                
                }
           }



      public function logout()
  {
    $this->auth->logout();
    
    //when someone logs out, automatically redirect them to the login page.
    $this->session->set_flashdata('success', 'You have been logged out');
    redirect('Frontend');
  }



         public function photo_upload()
            {
                $config['upload_path']          = './uploads/user_photo';
                $config['allowed_types']        = 'gif|jpg|png';
                // $config['max_size']             = 100;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('photo'))
                {
                        $error = $this->upload->display_errors();
                       // echo $error;exit();
                        return redirect('Customers/account_setting');
                }
                else
                { 
                        $save=array();
                        $save['profile_id']=$this->customer_ref->get_profile_id();
                        $path =  $this->upload->data();
                        //print_r($path);exit();
                        // $save['photo']=base_url().'uploads/user_photo/'.$path['raw_name'].$path['file_ext'];
                          $save['photo']= $path['raw_name'].$path['file_ext'];
                        //print_r($save['photo']);exit();
                        
                       
                    $this->Customer_model->save_user_photo($save);
                    return redirect('Customers/account_setting');
                      
                        
                }
        }


        function give_vote(){

         $data =  $this->data;
            $data['page_title'] =  'MCQ';
         $data['form_action'] = 'Customers/give_vote';
        $data['all_questions'] = $this->Customer_model->get_all_questions();
          //print_r( $data['all_questions']); exit();
        $profile_id = $this->customer_ref->get_profile_id();
        $data['completed_status'] = $this->Customer_model->get_completed_status($profile_id);
         //print_r( $data['completed_status']); exit();
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        foreach ($data['all_questions'] as $value) {
         $this->form_validation->set_rules($value->question_id,'$value->question_id','trim|required');
        }
       
 
        if($this->form_validation->run() == FALSE)
        {
            $this->view('give_vote',$data);
         }

          else{
     
         $save['profile_id'] = $this->customer_ref->get_profile_id();
         $save['result']  = $this->input->post();
         $result = $this->Customer_model->save_answers($save);
        $this->session->set_flashdata('success', 'post Successfully!');
        redirect('Customers/give_vote');

    }

       //  $this->view('give_vote', $data);
        }


        function vote_result(){

         $data =  $this->data;


         $this->view('vote_result', $data);
        }


}
?>

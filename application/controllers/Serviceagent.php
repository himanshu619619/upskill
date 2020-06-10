<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Serviceagent extends Serviceagent_Controller {

	var $data = array();
	var $form_id = false;

	function __construct()
	{
		parent::__construct();
	 if(!$this->session->userdata('serviceagentdetail'))
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
		$profile_id = $this->serviceagent_ref->get_profile_id();
    
    $this->data['user'] = $this->serviceagent_ref->get_user_detail($profile_id);
		// print_r($this->data['user']); exit();
		//$this->load->helper('string');
	}

	public function index()
	{
		$data = $this->data;

		$data['page_title']				=	'Amass | Service Agent';
		$this->data['meta_title'] 			= 'Service Agent';
    $data['form_action'] = 'serviceagent/AMC_purchase';


		$this->view('AMC_purchase',$data);

	}

	
  public function serviceagent_profile(){

      $data = $this->data;
      $profile_id=$this->serviceagent_ref->get_profile_id();
      $data['user']=$this->Serviceagent_model->get_serviceagent_detail($profile_id);
   // print_r($data['user']);exit();
    $this->view('profile',$data);
  }

   public function AMC_purchase(){

      $data = $this->data;
      $data['page_title']       = 'Add Details (AMC purchase)';
      $profile_id=$this->serviceagent_ref->get_profile_id();
      $data['form_action'] = 'serviceagent/AMC_purchase';

      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      $this->form_validation->set_rules('customer_name','Customer Name','trim|required');
      $this->form_validation->set_rules('customer_code', 'Customer Code', 'trim|required|max_length[10]');
      $this->form_validation->set_rules('model', 'Model', 'trim|required');
      $this->form_validation->set_rules('technecian', 'Technecian Mobile No.', 'trim|required');
      $this->form_validation->set_rules('customer_mobile', 'customer mobile', 'trim|required|max_length[12]|is_unique[users.mobile]',array('is_unique' => 'User number Already Exist'));
    
if($this->form_validation->run() == FALSE)
    {
    
      $this->view('AMC_purchase',$data);
    }
    else

    {

//image upload
      $config['upload_path']          = './uploads/customer_photo';
      $config['allowed_types']        = 'png|jpeg|jpg';
      // $config['max_size']             = 100;
      // $config['max_width']            = 1024;
      // $config['max_height']           = 768;
      $this->load->library('upload', $config);
   $save = array();

      if (!$this->upload->do_upload('icr_picture')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData1 = $this->upload->data();
      }
      if (!$this->upload->do_upload('chq_picture')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData2 = $this->upload->data();
      }
      if (!$this->upload->do_upload('picture_machine')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData3 = $this->upload->data();
      }
      $save = array();
      if ($fileData1['file_name']) {
        $path1 =  $fileData1;
        //                   //print_r($path);exit();
        $save['icr_picture'] = $path1['raw_name'] . $path1['file_ext'];
        //print_r($save['photo']);exit();
      }
      if ($fileData2['file_name']) {
        $path2 =  $fileData2;
        // }
        //print_r($path);exit();
        $save['chq_picture'] = $path2['raw_name'] . $path2['file_ext'];
      }
      if ($fileData3['file_name']) {
        $path3 =  $fileData3;
        // }
        //print_r($path);exit();
        $save['picture_machine'] = $path3['raw_name'] . $path3['file_ext'];
      }

   
     $save['customer_code']=$this->input->post('customer_code');
     $save['customer_name']= $this->input->post('customer_name');
     $save['customer_address']= $this->input->post('customer_address');
     $save['customer_city']= $this->input->post('customer_city');
      $save['pin_code']= $this->input->post('pin_code');
     $save['customer_mobile']= $this->input->post('customer_mobile');
     $save['product_category']= $this->input->post('product_category');
     $save['machine_serial']= $this->input->post('machine_serial');
     $save['customer_email']= $this->input->post('customer_email');
     $save['icr_amount']= $this->input->post('icr_amount');
     $save['model']= $this->input->post('model');
     $save['brand']= $this->input->post('brand');
     $save['date_of_purchase']= $this->input->post('date_of_purchase');
     // $save['picture_machine']= $this->input->post('picture_machine');
     $save['certified']= $this->input->post('certified');
     $save['machine_status']= $this->input->post('machine_status');
     $save['technecian']= $this->input->post('technecian');
     $save['icr_no']= $this->input->post('icr_no');
     $save['icr_date']= $this->input->post('icr_date');
     $save['free_cost']= $this->input->post('free_cost');
     // $save['icr_picture']= $this->input->post('icr_picture');
     $save['amc_Date']= $this->input->post('amc_Date');
     $save['amc_end_date']= $this->input->post('amc_end_date');
     $save['payment_mode']= $this->input->post('payment_mode');
     $save['chq_no']= $this->input->post('chq_no');
     // $save['chq_picture']= $this->input->post('chq_picture');
     $save['chq_amount']= $this->input->post('chq_amount');
     $save['technecian_name']= $this->input->post('technecian_name');
      $save['service_type'] = 1;
      $save['profile_id'] =$profile_id;

     
      $result = $this->Serviceagent_model->serviceagentdata_save($save);


      ($result ? $this->session->set_flashdata('success', 'Your Record Add Successfully' ) : '');
        redirect('serviceagent/AMC_purchase');

    }
   
        
  }


  public function account_setting(){
            $data = $this->data;
          $profile_id=$this->serviceagent_ref->get_profile_id();
          
          
           $country_option = array(''=>'-----------select country --------');
            $country = $this->Serviceagent_model->get_country(); 
          
            foreach ($country as  $value) {
              $country_option[$value->id] = $value->name;
            }
          $data['country_option'] = $country_option;
       
            $state_option = array(''=>'------------Select State-------------');
            //   $getstate = $this->Serviceagent_model->get_state();
            // foreach($getstate as $value)
            // {
            // $state_option[$value->id] = $value->name;

            // }
            // $data['state_option'] = $state_option;

            $city_option = array(''=>'------------Select Cities-------------');
         

          
          //print_r($data['user']);
          $data['user']=$this->Serviceagent_model->get_serviceagent_detail($profile_id);
          $this->form_id = $profile_id;
            $this->form_validation->set_rules('fname', 'First Name', 'required');
                $this->form_validation->set_rules('lname', 'Last Name', 'required');
                $this->form_validation->set_rules('username', 'User Name', 'required|callback_username_check');

           

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
                 

                  $save['qualification'] = $this->input->post('qualification');
                  $save['address']         = $this->input->post('address');
                  $save['country']         = $this->input->post('country');
                  $save['state']           = $this->input->post('state');
                  $save['cities']           = $this->input->post('cities');
                  $save['pin_code']           = $this->input->post('pin_code');
                 
                 
                  // echo "<pre>";
                   //print_r($save);exit();

                        if($this->Serviceagent_model->save_agent_profile($save)){

                           redirect('serviceagent/account_setting');
                        }else{
                          
                        }
                }
       }


 public function get_states(){
  $data = $this->data;
   $country_id= $this->input->post('country_id');
    // print_r( $country_id); exit();
   $state=$this->Serviceagent_model->get_state($country_id);
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
    $cities = $this->Serviceagent_model->get_city($state_id);
    //print_r($cities);
    foreach ($cities as  $value) {
              $cities_option[$value->id] = $value->name;
            }
          $data['cities_option'] = $cities_option;


     echo  form_dropdown('cities',$cities_option,set_value('cities'),'class = "form-control"');
   }
 public function username_check($username)
        {

                $query=$this->Serviceagent_model->check_username($username, $this->form_id);

                if($query){

                $this->form_validation->set_message('username_check','User Name Already Exists');
                  return false;
                }else{
                 
                 return true;

                }
        }

    public function email_check($email)
        {

                $query=$this->Serviceagent_model->check_email($email, $this->form_id);

                if($query){

               $this->form_validation->set_message('email_check','Email Address Already Exists');
                  return false;
                }else{
                 
                 return true;

                }
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
                        return redirect('serviceAgent/account_setting');
                }
                else
                { 
                        $save=array();
                        $save['profile_id']=$this->serviceAgent_ref->get_profile_id();
                        $path =  $this->upload->data();
                        //print_r($path);exit();
                        $save['photo']=base_url().'uploads/user_photo/'.$path['raw_name'].$path['file_ext'];
                        //print_r($save['photo']);exit();
                        
                       
                    $this->Serviceagent_model->save_user_photo($save);
                    return redirect('serviceAgent/account_setting');
                      
                        
                }
        }


  function logout()
  {
    $this->session->unset_userdata('servieagentdetail');
    redirect('login');
  }


function email_verify()
{   

  $code =  $this->input->post('confirm_code'); 
  $user = $this->Serviceagent_model->check_cofirm_code($code);

  if (!$user) {
    $this->session->set_flashdata('error','Invalid Confirmation Code');
    redirect('user/User');
  }

  $this->session->set_flashdata('success','Please complete your account setting now !');

  // welcocme email
          $this->load->library('email');
          $config['mailtype'] = 'html';
          $welcomemsg ="<h4><img src='".base_url('assets/images/logo1.png')."' > </h4>";

          $welcomemsg .="<h4>Greetings ! </h4>Hi  ".$user->fname." !<h4><br>";

          $welcomemsg .="<h4>Welcome to <i>Amass!</i> </h4><br><br> <p> Thanks so much for joining us.  </p> <br>  ";

       
          $welcomemsg .="<p>Have any questions? Just shoot us an email! We’re always here to help.</p>";
          $welcomemsg .="<p>Cheerfully yours,</P><p><i>The PaintingPic Team</i></p>";

          $this->email->initialize($config);
          $this->email->from('himanshu@7continentsmedia.com');
          $this->email->to($user->email);
          $this->email->bcc('himanshu@7continentsmedia.com');
          $this->email->subject('New User Registration');
          $this->email->message($welcomemsg);
          
          $this->email->send();


  // end of welcome email
  redirect('serviceagent/AMC_purchase');
}


public function change_password(){
          
           $this->form_validation->set_rules('new_password','New Password','required|min_length[4]');
           $this->form_validation->set_rules('confirm_password','Confirm Password','required|min_length[4]');

           if($this->form_validation->run()==false){
           
           echo form_error('new_password');
           echo form_error('confirm_password');
            
           }else{

               $profile_id=$this->serviceagent_ref->get_profile_id();
                  $save=array();
                  $save['profile_id'] = $profile_id;
                  //print_r($save['profile_id']);exit();
                  $save['new_password'] = $this->input->post('new_password');
                $save['confirm_password'] = $this->input->post('confirm_password');
                  if($save['new_password']!==$save['confirm_password']){

                echo "Password could not Match";
                  }else{

                if($this->Serviceagent_model->update_doc_password($save)){
                                       
                  }                     
                 }                
                }
           }



 public function extent_warrenty()
 {

  $data = $this->data;
  $data['page_title'] = 'Extent Warrenty Purchase';
 
      $profile_id=$this->serviceagent_ref->get_profile_id();
      $data['form_action'] = 'serviceagent/extent_warrenty';

      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      $this->form_validation->set_rules('customer_name','Customer Name','trim|required');
      $this->form_validation->set_rules('customer_code', 'Customer Code', 'trim|required|max_length[10]');
      $this->form_validation->set_rules('model', 'Model', 'trim|required');
      $this->form_validation->set_rules('technecian', 'Technecian Mobile No.', 'trim|required');
      $this->form_validation->set_rules('customer_mobile', 'customer mobile', 'trim|required|max_length[12]|is_unique[users.mobile]',array('is_unique' => 'User number Already Exist'));
    
if($this->form_validation->run() == FALSE)
    {
    
      $this->view('extent_warrenty',$data);
    }
    else

    {

//image upload
      
      $config['upload_path']          = './uploads/customer_photo';
      $config['allowed_types']        = 'png|jpeg|jpg';
      // $config['max_size']             = 100;
      // $config['max_width']            = 1024;
      // $config['max_height']           = 768;

                      // thumbnail space in future 
                   


      $this->load->library('upload', $config);
   $save = array();

      if (!$this->upload->do_upload('icr_picture')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData1 = $this->upload->data();
      }
      if (!$this->upload->do_upload('chq_picture')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData2 = $this->upload->data();
      }
      if (!$this->upload->do_upload('picture_machine')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData3 = $this->upload->data();
      }

      if (!$this->upload->do_upload('dealer_invoice_pic')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData4 = $this->upload->data();
      }
      $save = array();
      if ($fileData1['file_name']) {
        $path1 =  $fileData1;
        //                   //print_r($path);exit();
        $save['icr_picture'] = $path1['raw_name'] . $path1['file_ext'];

                   
      }
      if ($fileData2['file_name']) {
        $path2 =  $fileData2;
        // }
        //print_r($path);exit();
        $save['chq_picture'] =$path2['raw_name'] . $path2['file_ext'];
      }
      if ($fileData3['file_name']) {
        $path3 =  $fileData3;
        // }
        //print_r($path);exit();
        $save['picture_machine'] =$path3['raw_name'] . $path3['file_ext'];
      }

 if ($fileData4['file_name']) {
        $path4 =  $fileData4;
        // }
        //print_r($path);exit();
        $save['dealer_invoice_pic'] =$path4['raw_name'] . $path4['file_ext'];
      }
   
     $save['customer_code']=$this->input->post('customer_code');
     $save['customer_name']= $this->input->post('customer_name');
     $save['customer_address']= $this->input->post('customer_address');
     $save['customer_city']= $this->input->post('customer_city');
      $save['pin_code']= $this->input->post('pin_code');
      $save['icr_amount']= $this->input->post('icr_amount');
      $save['dealer_date']= $this->input->post('dealer_date');
      $save['compay_warranty_end']= $this->input->post('compay_warranty_end');
      $save['compay_warranty_start']= $this->input->post('compay_warranty_start');
      $save['customer_email']= $this->input->post('customer_email');
     $save['customer_mobile']= $this->input->post('customer_mobile');
     $save['product_category']= $this->input->post('product_category');
     $save['machine_serial']= $this->input->post('machine_serial');
     $save['model']= $this->input->post('model');
     $save['brand']= $this->input->post('brand');
     $save['date_of_purchase']= $this->input->post('date_of_purchase');
     // $save['picture_machine']= $this->input->post('picture_machine');
     $save['certified']= $this->input->post('certified');
     $save['machine_status']= $this->input->post('machine_status');
     $save['technecian']= $this->input->post('technecian');
     $save['icr_no']= $this->input->post('icr_no');
     $save['icr_date']= $this->input->post('icr_date');
     $save['free_cost']= $this->input->post('free_cost');
     // $save['icr_picture']= $this->input->post('icr_picture');
     $save['amc_Date']= $this->input->post('amc_Date');
     $save['amc_end_date']= $this->input->post('amc_end_date');
     $save['payment_mode']= $this->input->post('payment_mode');
     $save['chq_no']= $this->input->post('chq_no');
     // $save['chq_picture']= $this->input->post('chq_picture');
     $save['chq_amount']= $this->input->post('chq_amount');
     $save['technecian_name']= $this->input->post('technecian_name');
      $save['service_type'] = 2;
      $save['profile_id'] =$profile_id;
     
      $result = $this->Serviceagent_model->serviceagentdata_save($save);


      ($result ? $this->session->set_flashdata('success', 'Your Record Add Successfully' ) : '');
        redirect('serviceagent/extent_warrenty');

    }
 }

public function already_under_amc()
 {

  $data = $this->data;
  $data['page_title'] = 'Already Under AMC';
 
      $profile_id=$this->serviceagent_ref->get_profile_id();
      $data['form_action'] = 'serviceagent/already_under_amc';

      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      $this->form_validation->set_rules('customer_name','Customer Name','trim|required');
      $this->form_validation->set_rules('customer_code', 'Customer Code', 'trim|required|max_length[10]');
      $this->form_validation->set_rules('model', 'Model', 'trim|required');
      $this->form_validation->set_rules('technecian', 'Technecian Mobile No.', 'trim|required');
      $this->form_validation->set_rules('customer_mobile', 'customer mobile', 'trim|required|max_length[12]|is_unique[users.mobile]',array('is_unique' => 'User number Already Exist'));
    
if($this->form_validation->run() == FALSE)
    {
    
      $this->view('already_under_amc',$data);
    }
    else

    {

//image upload
      $config['upload_path']          = './uploads/customer_photo';
      $config['allowed_types']        = 'png|jpeg|jpg';
      // $config['max_size']             = 100;
      // $config['max_width']            = 1024;
      // $config['max_height']           = 768;
      $this->load->library('upload', $config);
   $save = array();

      if (!$this->upload->do_upload('icr_picture')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData1 = $this->upload->data();
      }
      if (!$this->upload->do_upload('chq_picture')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData2 = $this->upload->data();
      }
      if (!$this->upload->do_upload('picture_machine')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData3 = $this->upload->data();
      }

      if (!$this->upload->do_upload('dealer_invoice_pic')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData4 = $this->upload->data();
      }
      $save = array();
      if ($fileData1['file_name']) {
        $path1 =  $fileData1;
        //                   //print_r($path);exit();
        $save['icr_picture'] = $path1['raw_name'] . $path1['file_ext'];
        //print_r($save['photo']);exit();
      }
      if ($fileData2['file_name']) {
        $path2 =  $fileData2;
        // }
        //print_r($path);exit();
        $save['chq_picture'] = $path2['raw_name'] . $path2['file_ext'];
      }
      if ($fileData3['file_name']) {
        $path3 =  $fileData3;
        // }
        //print_r($path);exit();
        $save['picture_machine'] = $path3['raw_name'] . $path3['file_ext'];
      }

 if ($fileData4['file_name']) {
        $path4 =  $fileData4;
        // }
        //print_r($path);exit();
        $save['dealer_invoice_pic'] = $path4['raw_name'] . $path4['file_ext'];
      }
   
     $save['customer_code']=$this->input->post('customer_code');
     $save['customer_name']= $this->input->post('customer_name');
     $save['customer_address']= $this->input->post('customer_address');
     $save['customer_city']= $this->input->post('customer_city');
      $save['pin_code']= $this->input->post('pin_code');
      $save['icr_amount']= $this->input->post('icr_amount');
      $save['dealer_date']= $this->input->post('dealer_date');
      $save['compay_warranty_end']= $this->input->post('compay_warranty_end');
      $save['compay_warranty_start']= $this->input->post('compay_warranty_start');
      $save['customer_email']= $this->input->post('customer_email');
     $save['customer_mobile']= $this->input->post('customer_mobile');
     $save['product_category']= $this->input->post('product_category');
     $save['machine_serial']= $this->input->post('machine_serial');
     $save['model']= $this->input->post('model');
     $save['brand']= $this->input->post('brand');
     $save['date_of_purchase']= $this->input->post('date_of_purchase');
     // $save['picture_machine']= $this->input->post('picture_machine');
     $save['certified']= $this->input->post('certified');
     $save['machine_status']= $this->input->post('machine_status');
     $save['technecian']= $this->input->post('technecian');
     $save['icr_no']= $this->input->post('icr_no');
     $save['icr_date']= $this->input->post('icr_date');
     $save['free_cost']= $this->input->post('free_cost');
     // $save['icr_picture']= $this->input->post('icr_picture');
     $save['amc_Date']= $this->input->post('amc_Date');
     $save['amc_end_date']= $this->input->post('amc_end_date');
     $save['payment_mode']= $this->input->post('payment_mode');
     $save['chq_no']= $this->input->post('chq_no');
     // $save['chq_picture']= $this->input->post('chq_picture');
     $save['chq_amount']= $this->input->post('chq_amount');
     $save['technecian_name']= $this->input->post('technecian_name');
      $save['service_type'] = 3;
      $save['profile_id'] =$profile_id;
     
      $result = $this->Serviceagent_model->serviceagentdata_save($save);


      ($result ? $this->session->set_flashdata('success', 'Your Record Add Successfully' ) : '');
        redirect('serviceagent/already_under_amc');

    }
 }


public function not_in_amc()
 {

  $data = $this->data;
  $data['page_title'] = 'Not in AMC';
 
      $profile_id=$this->serviceagent_ref->get_profile_id();
      $data['form_action'] = 'serviceagent/not_in_amc';

      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      $this->form_validation->set_rules('customer_name','Customer Name','trim|required');
      $this->form_validation->set_rules('customer_code', 'Customer Code', 'trim|required|max_length[10]');
      $this->form_validation->set_rules('model', 'Model', 'trim|required');
      $this->form_validation->set_rules('technecian', 'Technecian Mobile No.', 'trim|required');
      $this->form_validation->set_rules('customer_mobile', 'customer mobile', 'trim|required|max_length[12]|is_unique[users.mobile]',array('is_unique' => 'User number Already Exist'));
    
if($this->form_validation->run() == FALSE)
    {
    
      $this->view('not_in_amc',$data);
    }
    else

    {

//image upload
      $config['upload_path']          = './uploads/customer_photo';
      $config['allowed_types']        = 'png|jpeg|jpg';
      // $config['max_size']             = 100;
      // $config['max_width']            = 1024;
      // $config['max_height']           = 768;
      $this->load->library('upload', $config);
   $save = array();

      if (!$this->upload->do_upload('icr_picture')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData1 = $this->upload->data();
      }
      if (!$this->upload->do_upload('chq_picture')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData2 = $this->upload->data();
      }
      if (!$this->upload->do_upload('picture_machine')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData3 = $this->upload->data();
      }

      if (!$this->upload->do_upload('dealer_invoice_pic')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData4 = $this->upload->data();
      }
      $save = array();
      if ($fileData1['file_name']) {
        $path1 =  $fileData1;
        //                   //print_r($path);exit();
        $save['icr_picture'] = $path1['raw_name'] . $path1['file_ext'];
        //print_r($save['photo']);exit();
      }
      if ($fileData2['file_name']) {
        $path2 =  $fileData2;
        // }
        //print_r($path);exit();
        $save['chq_picture'] = $path2['raw_name'] . $path2['file_ext'];
      }
      if ($fileData3['file_name']) {
        $path3 =  $fileData3;
        // }
        //print_r($path);exit();
        $save['picture_machine'] = $path3['raw_name'] . $path3['file_ext'];
      }

 if ($fileData3['file_name']) {
        $path4 =  $fileData4;
        // }
        //print_r($path);exit();
        $save['dealer_invoice_pic'] = $path4['raw_name'] . $path4['file_ext'];
      }
   
     $save['customer_code']=$this->input->post('customer_code');
     $save['customer_name']= $this->input->post('customer_name');
     $save['customer_address']= $this->input->post('customer_address');
     $save['customer_city']= $this->input->post('customer_city');
      $save['pin_code']= $this->input->post('pin_code');
      $save['icr_amount']= $this->input->post('icr_amount');
      $save['dealer_date']= $this->input->post('dealer_date');
      $save['compay_warranty_end']= $this->input->post('compay_warranty_end');
      $save['compay_warranty_start']= $this->input->post('compay_warranty_start');
      $save['customer_email']= $this->input->post('customer_email');
     $save['customer_mobile']= $this->input->post('customer_mobile');
     $save['product_category']= $this->input->post('product_category');
     $save['machine_serial']= $this->input->post('machine_serial');
     $save['model']= $this->input->post('model');
     $save['brand']= $this->input->post('brand');
     $save['date_of_purchase']= $this->input->post('date_of_purchase');
     // $save['picture_machine']= $this->input->post('picture_machine');
     $save['certified']= $this->input->post('certified');
     $save['machine_status']= $this->input->post('machine_status');
     $save['technecian']= $this->input->post('technecian');
     $save['icr_no']= $this->input->post('icr_no');
     $save['icr_date']= $this->input->post('icr_date');
     $save['free_cost']= $this->input->post('free_cost');
     // $save['icr_picture']= $this->input->post('icr_picture');
     $save['amc_Date']= $this->input->post('amc_Date');
     $save['amc_end_date']= $this->input->post('amc_end_date');
     $save['payment_mode']= $this->input->post('payment_mode');
     $save['chq_no']= $this->input->post('chq_no');
     // $save['chq_picture']= $this->input->post('chq_picture');
     $save['chq_amount']= $this->input->post('chq_amount');
     $save['technecian_name']= $this->input->post('technecian_name');
      $save['service_type'] = 4;
      $save['profile_id'] =$profile_id;
     
      $result = $this->Serviceagent_model->serviceagentdata_save($save);


      ($result ? $this->session->set_flashdata('success', 'Your Record Add Successfully' ) : '');
        redirect('serviceagent/not_in_amc');

    }
 }


 public function washing_machine_demo()
 {

  $data = $this->data;
  $data['page_title'] = 'Washing Machine Demo';
 
      $profile_id=$this->serviceagent_ref->get_profile_id();
      $data['form_action'] = 'serviceagent/washing_machine_demo';

      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      $this->form_validation->set_rules('customer_name','Customer Name','trim|required');
      $this->form_validation->set_rules('customer_code', 'Customer Code', 'trim|required|max_length[10]');
      $this->form_validation->set_rules('model', 'Model', 'trim|required');
      $this->form_validation->set_rules('technecian', 'Technecian Mobile No.', 'trim|required');
      $this->form_validation->set_rules('customer_mobile', 'customer mobile', 'trim|required|max_length[12]|is_unique[users.mobile]',array('is_unique' => 'User number Already Exist'));
    
if($this->form_validation->run() == FALSE)
    {
    
      $this->view('washing_machine_demo',$data);
    }
    else

    {

//image upload
      $config['upload_path']          = './uploads/customer_photo';
      $config['allowed_types']        = 'png|jpeg|jpg';
      // $config['max_size']             = 100;
      // $config['max_width']            = 1024;
      // $config['max_height']           = 768;
      $this->load->library('upload', $config);
   $save = array();

      if (!$this->upload->do_upload('icr_picture')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData1 = $this->upload->data();
      }
      if (!$this->upload->do_upload('chq_picture')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData2 = $this->upload->data();
      }
      if (!$this->upload->do_upload('picture_machine')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData3 = $this->upload->data();
      }

      if (!$this->upload->do_upload('dealer_invoice_pic')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData4 = $this->upload->data();
      }
      $save = array();
      if ($fileData1['file_name']) {
        $path1 =  $fileData1;
        //                   //print_r($path);exit();
        $save['icr_picture'] = $path1['raw_name'] . $path1['file_ext'];
        //print_r($save['photo']);exit();
      }
      if ($fileData2['file_name']) {
        $path2 =  $fileData2;
        // }
        //print_r($path);exit();
        $save['chq_picture'] = $path2['raw_name'] . $path2['file_ext'];
      }
      if ($fileData3['file_name']) {
        $path3 =  $fileData3;
        // }
        //print_r($path);exit();
        $save['picture_machine'] = $path3['raw_name'] . $path3['file_ext'];
      }

 if ($fileData3['file_name']) {
        $path4 =  $fileData4;
        // }
        //print_r($path);exit();
        $save['dealer_invoice_pic'] = $path4['raw_name'] . $path4['file_ext'];
      }
   
     $save['customer_code']=$this->input->post('customer_code');
     $save['customer_name']= $this->input->post('customer_name');
     $save['customer_address']= $this->input->post('customer_address');
     $save['customer_city']= $this->input->post('customer_city');
      $save['pin_code']= $this->input->post('pin_code');
      $save['icr_amount']= $this->input->post('icr_amount');
      $save['dealer_date']= $this->input->post('dealer_date');
      $save['compay_warranty_end']= $this->input->post('compay_warranty_end');
      $save['compay_warranty_start']= $this->input->post('compay_warranty_start');
      $save['customer_email']= $this->input->post('customer_email');
     $save['customer_mobile']= $this->input->post('customer_mobile');
     $save['product_category']= $this->input->post('product_category');
     $save['machine_serial']= $this->input->post('machine_serial');
     $save['model']= $this->input->post('model');
     $save['brand']= $this->input->post('brand');
     $save['date_of_purchase']= $this->input->post('date_of_purchase');
     // $save['picture_machine']= $this->input->post('picture_machine');
     $save['certified']= $this->input->post('certified');
     $save['machine_status']= $this->input->post('machine_status');
     $save['technecian']= $this->input->post('technecian');
     $save['icr_no']= $this->input->post('icr_no');
     $save['icr_date']= $this->input->post('icr_date');
     $save['free_cost']= $this->input->post('free_cost');
     // $save['icr_picture']= $this->input->post('icr_picture');
     $save['amc_Date']= $this->input->post('amc_Date');
     $save['amc_end_date']= $this->input->post('amc_end_date');
     $save['payment_mode']= $this->input->post('payment_mode');
     $save['chq_no']= $this->input->post('chq_no');
     // $save['chq_picture']= $this->input->post('chq_picture');
     $save['chq_amount']= $this->input->post('chq_amount');
     $save['technecian_name']= $this->input->post('technecian_name');
      $save['service_type'] = 5;
      $save['profile_id'] =$profile_id;
     
      $result = $this->Serviceagent_model->serviceagentdata_save($save);


      ($result ? $this->session->set_flashdata('success', 'Your Record Add Successfully' ) : '');
        redirect('serviceagent/washing_machine_demo');

    }
 }

 public function ac_installation()
 {

  $data = $this->data;
  $data['page_title'] = 'Ac INstallation';
 
      $profile_id=$this->serviceagent_ref->get_profile_id();
      $data['form_action'] = 'serviceagent/ac_installation';

      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      $this->form_validation->set_rules('customer_name','Customer Name','trim|required');
      $this->form_validation->set_rules('customer_code', 'Customer Code', 'trim|required|max_length[10]');
      $this->form_validation->set_rules('model', 'Model', 'trim|required');
      $this->form_validation->set_rules('technecian', 'Technecian Mobile No.', 'trim|required');
      $this->form_validation->set_rules('customer_mobile', 'customer mobile', 'trim|required|max_length[12]|is_unique[users.mobile]',array('is_unique' => 'User number Already Exist'));
    
if($this->form_validation->run() == FALSE)
    {
    
      $this->view('ac_installation',$data);
    }
    else

    {

//image upload
      $config['upload_path']          = './uploads/customer_photo';
      $config['allowed_types']        = 'png|jpeg|jpg';
      // $config['max_size']             = 100;
      // $config['max_width']            = 1024;
      // $config['max_height']           = 768;
      $this->load->library('upload', $config);
   $save = array();

      if (!$this->upload->do_upload('icr_picture')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData1 = $this->upload->data();
      }
      if (!$this->upload->do_upload('chq_picture')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData2 = $this->upload->data();
      }
      if (!$this->upload->do_upload('picture_machine')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData3 = $this->upload->data();
      }

      if (!$this->upload->do_upload('dealer_invoice_pic')) {
        $error = array('error' => $this->upload->display_errors());
      } else {
        $fileData4 = $this->upload->data();
      }
      $save = array();
      if ($fileData1['file_name']) {
        $path1 =  $fileData1;
        //                   //print_r($path);exit();
        $save['icr_picture'] = $path1['raw_name'] . $path1['file_ext'];
        //print_r($save['photo']);exit();
      }
      if ($fileData2['file_name']) {
        $path2 =  $fileData2;
        // }
        //print_r($path);exit();
        $save['chq_picture'] = $path2['raw_name'] . $path2['file_ext'];
      }
      if ($fileData3['file_name']) {
        $path3 =  $fileData3;
        // }
        //print_r($path);exit();
        $save['picture_machine'] = $path3['raw_name'] . $path3['file_ext'];
      }

 if ($fileData4['file_name']) {
        $path4 =  $fileData4;
        // }
        //print_r($path);exit();
        $save['dealer_invoice_pic'] = $path4['raw_name'] . $path4['file_ext'];
      }
   
     $save['customer_code']=$this->input->post('customer_code');
     $save['customer_name']= $this->input->post('customer_name');
     $save['customer_address']= $this->input->post('customer_address');
     $save['customer_city']= $this->input->post('customer_city');
      $save['pin_code']= $this->input->post('pin_code');
      $save['icr_amount']= $this->input->post('icr_amount');
      $save['dealer_date']= $this->input->post('dealer_date');
      $save['compay_warranty_end']= $this->input->post('compay_warranty_end');
      $save['compay_warranty_start']= $this->input->post('compay_warranty_start');
      $save['customer_email']= $this->input->post('customer_email');
     $save['customer_mobile']= $this->input->post('customer_mobile');
     $save['product_category']= $this->input->post('product_category');
     $save['machine_serial']= $this->input->post('machine_serial');
     $save['model']= $this->input->post('model');
     $save['brand']= $this->input->post('brand');
     $save['date_of_purchase']= $this->input->post('date_of_purchase');
     // $save['picture_machine']= $this->input->post('picture_machine');
     $save['certified']= $this->input->post('certified');
     $save['machine_status']= $this->input->post('machine_status');
     $save['technecian']= $this->input->post('technecian');
     $save['icr_no']= $this->input->post('icr_no');
     $save['icr_date']= $this->input->post('icr_date');
     $save['free_cost']= $this->input->post('free_cost');
     // $save['icr_picture']= $this->input->post('icr_picture');
     $save['amc_Date']= $this->input->post('amc_Date');
     $save['amc_end_date']= $this->input->post('amc_end_date');
     $save['payment_mode']= $this->input->post('payment_mode');
     $save['chq_no']= $this->input->post('chq_no');
     // $save['chq_picture']= $this->input->post('chq_picture');
     $save['chq_amount']= $this->input->post('chq_amount');
     $save['technecian_name']= $this->input->post('technecian_name');
      $save['service_type'] = 6;
      $save['profile_id'] =$profile_id;
     
      $result = $this->Serviceagent_model->serviceagentdata_save($save);


      ($result ? $this->session->set_flashdata('success', 'Your Record Add Successfully' ) : '');
        redirect('serviceagent/ac_installation');

    }
 }


}
?>

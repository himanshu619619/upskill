<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends Admin_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('format_helper', 'email'));
	}

	public function index()
	{
		$json = array();
		
		$this->json($json);
	}

	public function contact_form()
	{
		$json = array();

		$post_data = $this->input->post();

		$name 		= $post_data['name'];
		$email 		= $post_data['email'];
		$message 	= $post_data['message'];

		if($message == '')
		{
			$json['error'] = 'Please enter the message.';
		}
		if($email == '')
		{
			$json['error'] = 'Please enter your email.';
		}
		if(($email != '') && (!valid_email($email)))
		{
			$json['error'] = 'Please enter valid email.';	
		}
		if($name == '')
		{
			$json['error'] = 'Please enter your name.';
		}

		if(!isset($json['error']))
		{
			//Email to site owner

			$subject			 = "Enquiry From Web Site :: ".$name;
			$email_content = "Hi, an enquiry has been submitted from website following are the details: <br/><strong>Name</strong> : ".$name."<br/><strong>Email :</strong> ".$email."<br/><strong>Message :</strong>".$message;
			$this->load->library('email');
			
			$config['mailtype'] = 'html';
			
			$this->email->initialize($config);
			
			$this->email->from($this->config->item('email'), $this->config->item('app_name'));
			$this->email->to($this->config->item('email'));
			$this->email->subject($subject);
			$this->email->message(html_entity_decode($email_content ));
			$this->email->send();
			//echo $email_content;
			$json['success'] = 'Form has been submitted successfully!';
 		}

		$this->json($json);	
	}

	function validate()
	{
		$this->load->library('form_validation');

		$post_data = $this->input->post();
		
		$response = array();
		
		if(!$this->form_validation->required(trim($post_data['email'])))
		{
			$response["email"] = array("can't be blank!", "is invalid!", "does not appear to be valid!");
		}
		elseif(!$this->form_validation->valid_email(trim($post_data['email'])))
		{
			$response["email"] = array("is invalid!", "does not appear to be valid!");;
		}
		elseif(!$this->check_email(trim($post_data['email'])))
		{
			$response["email"] = array("does not appear to be valid!");
		}
		
		if(!$this->form_validation->required(trim($post_data['firstname'])))
		{
			$response["firstname"] = array("can't be blank!");
		}

		if(!$this->form_validation->required(trim($post_data['lastname'])))
		{
			$response["lastname"] = array("can't be blank!");
		}
		
		if(!$this->form_validation->required(trim($post_data['password'])))
		{
			$response["password"] = array("can't be blank!", "should be at least 4 characters!");
		}
		elseif(strlen(trim($post_data['password'])) < 4)
		{
			$response["password"] = array("should be at least 4 characters!");
		}
		
		header('Content-Type: application/json');
		die(json_encode($response));
	}

	function get_autosuggest_locations()
	{
		$json = array();

		if($this->input->get_post('q'))
		{
			$query 		= $this->input->get_post('q');

			if(strlen($query) < 2)
			{
				$json['error'] = 'Please input atleast two characters to search locations.';
			}

			if(!isset($json['error']))
			{
				$market 	= 'IN';
				$currency = 'INR';
				$locale 	= 'en-IN';
				
				$apiKey 	= 'vi763634574242990561233384462275';
				$pull_url = 'http://partners.api.skyscanner.net/apiservices/autosuggest/v1.0/'.$market.'/'.$currency.'/'.$locale.'/?query='.$query.'&apiKey='.$apiKey;

				//  Initiate curl
				$ch_r = curl_init();
				// Disable SSL verification
				curl_setopt($ch_r, CURLOPT_SSL_VERIFYPEER, false);
				// Will return the response, if false it print the response
				curl_setopt($ch_r, CURLOPT_RETURNTRANSFER, true);
				// Set the url
				curl_setopt($ch_r, CURLOPT_URL,$pull_url);
				// Execute
				$result=curl_exec($ch_r);
				// Closing
				curl_close($ch_r);
				$result_array = json_decode($result, true);
				//print_r($result_array);
				if(isset($result_array['Places']))
				{

					$places = $result_array['Places'];

					if(!empty($places))
					{
						$autocomplete_array = array();
						foreach ($places as $place) 
						{
					    array_push($autocomplete_array ,array('id' => $place['PlaceId'], 'text' => $place['PlaceName'].', '.$place['CountryName']));
						}
						$this->json($autocomplete_array);
					}
					else
					{
						$json['error'] = 'No result found!.';
					}
				}
				else
				{
					$json['error'] = 'Unexpected error, please try again later.';
				}
			}
		}
		else
		{
			$json['error'] = 'Invalid Inputs.';
		}

		$this->json($json);
	}
	
}

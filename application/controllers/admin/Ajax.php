<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends Admin_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('format_helper');
	}

	public function index()
	{
		$json = array();
		
		$this->json($json);
	}

	public function get_zone_menu()
	{
		$this->load->model('Location_model');

		$country_id	= $this->input->post('id');
		$zones	= $this->Location_model->getZonesMenu($country_id);
		$html = '';
		foreach($zones as $id=>$z) { 
		$html .= '<option value="'.$id.'">'.$z.'</option>';
		} 
		echo $html;
		exit();
		
	}
	
	public function slots($service_id = false)
	{
		$data['title'] = $this->input->post('name') .' Availability';

		$this->load->model('Seller_model');

		if($service_id && ($service = $this->Seller_model->getService($service_id)))
		{
			$data['id'] = $service_id;
			$data['slotLength'] = $service['slot_length'];
			$data['slotType'] 	= $service['service_type'];

			$slot_array = array(
				array('id' => 1, 'name' => 'Monday', 'value' => array(), 'checked' => false, 'startTime' => '', 'endTime' => ''),
				array('id' => 2, 'name' => 'Tuesday', 'value' => array(), 'checked' => false, 'startTime' => '', 'endTime' => ''),
				array('id' => 3, 'name' => 'Wednessday', 'value' => array(), 'checked' => false, 'startTime' => '', 'endTime' => ''),
				array('id' => 4, 'name' => 'Thursday', 'value' => array(), 'checked' => false, 'startTime' => '', 'endTime' => ''),
				array('id' => 5, 'name' => 'Friday', 'value' => array(), 'checked' => false, 'startTime' => '', 'endTime' => ''),
				array('id' => 6, 'name' => 'Saturday', 'value' => array(), 'checked' => false, 'startTime' => '', 'endTime' => ''),
				array('id' => 7, 'name' => 'Sunday', 'value' => array(), 'checked' => false, 'startTime' => '', 'endTime' => '')
			);

			if($service['availability'])
			{
				$slot_array = json_decode($service['availability']);
			}

			$data['slot_array'] = json_encode($slot_array);

			$this->load->view($this->admin_folder.'/slots', $data);
		}
	}

	public function save_slots($service_id = false)
	{
		$this->load->model('Seller_model');

		if($service_id && ($service = $this->Seller_model->getService($service_id)))
		{
			$information = $this->input->post('info');

			$savable_data = array();

			if($information)
			{
				foreach ($information as $info) 
				{

					$array = array('id' => $info['id'], 'name' => $info['name'], 'checked' => false, 'value' => array(), 'startTime' => '', 'endTime' => '');

					if(isset($info['checked']))
					{
						$array['checked'] = true;
						$array['startTime'] = $info['startTime'];
						$array['endTime'] = $info['endTime'];

						if(($service['service_type'] == 'multiple') && isset($info['child']))
						{
							$child = array();

							foreach ($info['child'] as $child_data) {
								$child[] = $child_data;
							}

							$array['value'] = $child;
						}
					}

					$savable_data[] = $array;
				}
			}

			if($savable_data)
			{

				$save = array();

				$save['service_id'] = $service_id;
				$save['availability'] = json_encode($savable_data);
				$save['modified'] = date('Y-m-d H:i:s');

				$this->Seller_model->saveService($save);

				$message = json_encode(array('success' => true, 'message' => 'Availability has been saved.'));
			}
			else
			{
				$message = json_encode(array('success' => false, 'message' => 'Somthing went wrong. Try again.'));
			}
		}
		else
		{
			$message = json_encode(array('success' => false, 'message' => 'Somthing went wrong. Try again.'));
		}

		header('Content-Type: application/json');
		echo $message;
		exit();
	}
}

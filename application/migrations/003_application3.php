<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_application3 extends CI_Migration {
	
	public function up()
	{
		/********************************************
    *
    * Dumping data for table setting
    *
    *********************************************/
    if($this->db->table_exists('setting'))
    { 
      $setting = array(
        array(
          'setting_id' => 1,          
          'code' => 'application',
          'key' => 'app_path',
          'value' => '/amass/',
        ),
        array(
          'setting_id' => 2,          
          'code' => 'application',
          'key' => 'app_name',
          'value' => 'amass',
        ),
        array(
          'setting_id' => 3,          
          'code' => 'application',
          'key' => 'meta_title',
          'value' => 'amass',
        ),
        array(
          'setting_id' => 4,          
          'code' => 'application',
          'key' => 'meta_description',
          'value' => 'amass',
        ),
        array(
          'setting_id' => 5,          
          'code' => 'application',
          'key' => 'meta_keywords',
          'value' => 'amass',
        ),
        array(
          'setting_id' => 6,          
          'code' => 'application',
          'key' => 'email',
          'value' => 'rakeshmaurya79@gmail.com',
        ),
        array(
          'setting_id' => 7,          
          'code' => 'application',
          'key' => 'phone',
          'value' => 'xxx-xxx-xxxx',
        ),
        array(
          'setting_id' => 8,          
          'code' => 'application',
          'key' => 'currency_iso',
          'value' => 'USD',
        ),
        array(
          'setting_id' => 9,          
          'code' => 'application',
          'key' => 'currency_symbol',
          'value' => '$',
        ),
        array(
          'setting_id' => 10,          
          'code' => 'application',
          'key' => 'decimal_place',
          'value' => 2,
        ),
        array(
          'setting_id' => 11,
          'code' => 'application',
          'key' => 'url',
          'value' => '',
        ),
        array(
          'setting_id' => 12,
          'code' => 'application',
          'key' => 'theme',
          'value' => 'default',
        ),
        array(
          'setting_id' => 13,
          'code' => 'application',
          'key' => 'admin_folder',
          'value' => 'admin',
        ),
        array(
          'setting_id' => 14,
          'code' => 'application',
          'key' => 'ssl_support',
          'value' => false,
        ),
        array(
          'setting_id' => 15,
          'code' => 'application',
          'key' => 'address',
          'value' => '',
        ),
        array(
          'setting_id' => 16,
          'code' => 'application',
          'key' => 'city',
          'value' => '',
        ),
        array(
          'setting_id' => 17,
          'code' => 'application',
          'key' => 'state',
          'value' => '',
        ),
        array(
          'setting_id' => 18,
          'code' => 'application',
          'key' => 'state_id',
          'value' => '',
        ),
        array(
          'setting_id' => 19,
          'code' => 'application',
          'key' => 'latitude',
          'value' => '',
        ),
        array(
          'setting_id' => 20,
          'code' => 'application',
          'key' => 'longitude',
          'value' => '',
        ),
        array(
          'setting_id' => 21,
          'code' => 'application',
          'key' => 'country',
          'value' => '',
        ),
        array(
          'setting_id' => 22,
          'code' => 'application',
          'key' => 'country_id',
          'value' => '',
        ),
        array(
          'setting_id' => 23,
          'code' => 'application',
          'key' => 'zip',
          'value' => '',
        ),
        array(
          'setting_id' => 24,
          'code' => 'application',
          'key' => 'facebook',
          'value' => '',
        ),
        array(
          'setting_id' => 25,
          'code' => 'application',
          'key' => 'twitter',
          'value' => '',
        ),
        array(
          'setting_id' => 26,
          'code' => 'application',
          'key' => 'google',
          'value' => '',
        ),
        array(
          'setting_id' => 27,
          'code' => 'application',
          'key' => 'google_analytics',
          'value' => '',
        )
      );

      $this->db->insert_batch('setting', $setting);
    }
    
	}
	
	public function down()
	{
		// Migration 3 has no rollback 
	}

}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_application1 extends CI_Migration {
	
	public function up()
	{
		$this->_table_group();
		$this->_table_user();
		$this->_table_canned_message();
		$this->_table_country();
		$this->_table_country_zone();
		$this->_table_country_zone_area();
		$this->_table_route();
		$this->_table_setting();
		$this->_table_page();
		$this->_table_categories();
	}
	
	public function down()
	{
		// Migration 1 has no rollback 
	}
	
	/**********************************************
	**                                           **
	**                                           **
	** The following private methods are for     **
	** checking the existence of and generating  **
	** the base tables that app operates on   	 **
	**                                           **
	**                                           **
	***********************************************/

	/********************************************
	*
	* Generate admin group table
	*
	*********************************************/
	private function _table_group()
	{
		if(!$this->db->table_exists('group'))
		{

			// create the table
			$this->dbforge->add_field(array(
				'group_id' => array( 
					'type' => 'int',
					'constraint' => 9,
					'unsigned' => true,
					'auto_increment' => true
				),
				'code' => array(
					'type' => 'varchar',
					'constraint' => 255,
					'null' => false
				),
				'name' => array(
					'type' => 'varchar',
					'constraint' => 255,
					'null' => false
				),				
				'permission' => array(
					'type' => 'text',
					'null' => false
				),
				'priority' => array( 
					'type' => 'int',
					'constraint' => 9,
					'default' => 0
				),
			));

			$this->dbforge->add_key('group_id', true);
			$this->dbforge->create_table('group', true);

			$groups = array(
				array(
					'group_id' => 1,
					'code' => 'A',
					'name' => 'Administrator',
					'permission' => json_encode(array('AA')),
					'priority' => 0,
				)
			);

			$this->db->insert_batch('group', $groups);
		}
	}

	/********************************************
	*
	* Generate user table
	*
	*********************************************/
	private function _table_user()
	{
		if(!$this->db->table_exists('user'))
		{
			// create the table
			$this->dbforge->add_field(array(
				'user_id' => array( 
					'type' => 'int',
					'constraint' => 9,
					'unsigned' => true,
					'auto_increment' => true
				),
				'group_id' => array( 
					'type' => 'int',
					'constraint' => 9,
					'unsigned' => true
				),				
				'access_code' => array(
					'type' => 'varchar',
					'constraint' => 1,
					'null' => false,
					'default' => 'A'
				),
				'name' => array(
					'type' => 'varchar',
					'constraint' => 255,
					'null' => false
				),
				'username' => array(
					'type' => 'varchar',
					'constraint' => 255,
					'null' => false
				),
				'email' => array(
					'type' => 'varchar',
					'constraint' => 255,
					'null' => true
				),
				'phone' => array(
					'type' => 'varchar',
					'constraint' => 255,
					'null' => true
				),
				'password' => array(
					'type' => 'varchar',
					'constraint' => 40,
					'null' => false
				),
				'image' => array(
					'type' => 'varchar',
					'constraint' => 255,
					'null' => true
				),
				'logdate' => array(
					'type'=> 'datetime',
					'null' => true
				),
				'lognum' => array(
					'type' => 'int',
					'constraint' => 9,
					'unsigned' => true,
					'null' => true
				),				
				'status' => array(
					'type'=> 'tinyint',
					'constraint' => 1,
					'null' => false,
					'default' => 1,
					'comment' => '1: Active, 0: De-Active'
				),				
				'created' => array(
					'type'=> 'datetime',
					'null' => false
				),
				'modified' => array(
					'type'=> 'datetime',
					'null' => true
				)
			));

			$this->dbforge->add_key('user_id', true);
			$this->dbforge->create_table('user', true);
			
			$users = array(
				array(
					'user_id' => 1,
					'group_id' => 1,
					'access_code' => 'A',
					'name' => 'Administrator',
					'username' => 'admin',
					'email' => 'rakeshmaurya79@.com',
					'phone' => 'xxx-xxx-xxxx',
					'password' => sha1('admin@7756'),
					'image' => NULL,
					'logdate' => NULL,
					'lognum' => 0,
					'status' => 1,				
					'created' => date('Y-m-d H:i:s'),
					'modified' => NULL
				)
			);

			$this->db->insert_batch('user', $users);
		}
	}	

	/********************************************
	*
	* Generate canned_message table
	*
	*********************************************/
	private function _table_canned_message()
	{
		if (!$this->db->table_exists('canned_message'))
		{

			$this->dbforge->add_field(array(
				'canned_message_id' => array(
					'type' => 'int',
					'constraint' => 9,
					'unsigned' => true,
					'auto_increment' => true
				),
				'name' => array(
					'type' => 'varchar',
					'constraint' => 50,
					'null' => true
				),
				'subject' => array(
					'type' => 'varchar',
					'constraint' => 100,
					'null' => true
				),
				'content' => array(
					'type' => 'text'
				),
				'deletable' => array(
					'type' => 'tinyint',
					'constraint' => 1,
					'null' => false,
					'default' => 0
				),
				'created' => array(
					'type'=> 'datetime',
					'null' => false
				 ),
				'modified' => array(
					'type'=> 'datetime',
					'null' => true
				)
			));

			$this->dbforge->add_key('canned_message_id', true);
			$this->dbforge->create_table('canned_message', true);
		}
	}

	/********************************************
	*
	* Generate country table
	*
	*********************************************/
	private function _table_country()
	{
		
		if(!$this->db->table_exists('country'))
		{
			$this->dbforge->add_field(array(
				'country_id' => array(
					'type' => 'int',
					'constraint' => 9,
					'unsigned' => true,
					'auto_increment' => true
				),
				'name' => array(
					'type' => 'varchar',
					'constraint' => 128,
					'null' => false
				),
				'iso_code_2' => array(
					'type' => 'varchar',
					'constraint' => 2 ,
					'null' => false
				),
				'iso_code_3' => array(
					'type' => 'varchar',
					'constraint' => 3 ,
					'null' => false
				),
				'status' => array(
					'type' => 'int',
					'constraint' => 1 ,
					'null' => false, 
					'default' => 1
				)
			));

			$this->dbforge->add_key('country_id', true);
			$this->dbforge->create_table('country');

			// Seed

			$records = $this->load->view('templates/countries.txt', array(), true);
			$records = explode("\n", $records);

			$batch = array();
			foreach($records as $r)
			{
				$r = explode('|', $r);

				$batch[] = array(
					'country_id'=>$r[0], 
					'name'=>$r[2], 
					'iso_code_2'=>$r[3],
					'iso_code_3'=>$r[4], 
					'status'=>$r[5]
				);
			}

			$this->db->insert_batch('country', $batch);
		}
	}

	/********************************************
	*
	* Generate country zone table
	*
	*********************************************/
	private function _table_country_zone()
	{

		if(!$this->db->table_exists('country_zone'))
		{   
			$this->dbforge->add_field(array(
				'country_zone_id' => array(
					'type' => 'int', 
					'constraint' => 9, 
					'unsigned' => true,
					'auto_increment' => true
				),
				'country_id' => array(
					'type' => 'int', 
					'constraint' => 9,
					'unsigned' => true, 
					'null' => false
				),
				'code' => array(
					'type' => 'varchar', 
					'constraint' => 32, 
					'null' => true
				),
				'name' => array(
					'type' => 'varchar', 
					'constraint' => 128, 
					'null' => false
				),
				'status' => array(
					'type' => 'int', 
					'constraint' => 1, 
					'null' => false,
					'default' => 1
				)
			));

			$this->dbforge->add_key('country_zone_id', true);
			$this->dbforge->create_table('country_zone');

			// Seed

			$records = $this->load->view('templates/country_zones.txt', array(), true);
			$records = explode("\n", $records);

			foreach($records as $r)
			{
				$r = explode('|', $r);

				$insert = array(
					'country_zone_id'=>$r[0], 
					'country_id' => $r[1],
					'code' => $r[2],
					'name' => $r[3],
					'status' => $r[4]
				);

				// Run this one one at a time, since the list is probably too large for a batch
				$this->db->insert('country_zone', $insert);
			}

		}
	}

	/********************************************
	*
	* Generate country zone area table
	*
	*********************************************/
	private function _table_country_zone_area()
	{
		if(!$this->db->table_exists('country_zone_area'))
		{
			$this->dbforge->add_field(array(
				'country_zone_area_id' =>array(
					'type'=>'int',
					'constraint' => 9,
					'unsigned' => true,
					'auto_increment' => true
				),
				'zone_id' =>array(
					'type'=>'int',
					'constraint' => 9,
					'unsigned' => true,
					'null' => false
				),
				'code' =>array(
					'type'=>'varchar',
					'constraint' => 15,
					'null' => false
				)
			));

			$this->dbforge->add_key('country_zone_area_id', true);
			$this->dbforge->create_table('country_zone_area', true);
		}
	}

	/********************************************
	*
	* Generate route table
	*
	*********************************************/
	private function _table_route()
	{
		if(!$this->db->table_exists('route'))
		{
			$this->dbforge->add_field(array(
				'route_id' => array(
					'type' => 'int',
					'constraint' => 9,
					'unsigned' => true,
					'auto_increment' => true
				),
				'slug' => array(
					'type' => 'varchar',
					'constraint' => 255,
					'null' => false
				),
				'route' => array(
					'type' => 'varchar',
					'constraint' => 32
				)
			));

			$this->dbforge->add_key('route_id', true);
			$this->dbforge->create_table('route', true);
		}
	}

	/********************************************
	*
	* Generate setting table
	*
	*********************************************/
	private function _table_setting()
	{
		if(!$this->db->table_exists('setting'))
		{
			$this->dbforge->add_field(array(
				'setting_id' => array(
					'type' => 'int',
					'constraint' => 9,
					'unsigned' => true,
					'auto_increment' => true
				),
				'code' => array(
					'type' => 'varchar',
					'constraint' => 255,
					'null' => false
				),
				'key' => array(
					'type' => 'varchar',
					'constraint' => 255,
					'null' => false
				),
				'value' => array(
					'type' => 'longtext',
					'null' => false
				)
			));

			$this->dbforge->add_key('setting_id', true);
			$this->dbforge->create_table('setting', true);
		}
	}

		/********************************************
	*
	* Generate page table
	*
	*********************************************/
	private function _table_page()
	{
		if(!$this->db->table_exists('page'))
		{
			$this->dbforge->add_field(array(
				'page_id' => array(
					'type' => 'int',
					'constraint' => 9,
					'unsigned' => true,
					'auto_increment' => true
				),
				'parent_id' => array(
					'type' => 'int',
					'constraint' => 9,
					'unsigned' => true,
					'null' => false
				),
				'route_id' => array(
					'type' => 'int',
					'constraint' => 9,
					'null' => false
				),
				'name' => array(
					'type' => 'varchar',
					'constraint' => 128,
					'null' => false
				),				
				'slug' => array(
					'type' => 'varchar',
					'constraint' => 255,
					'null' => false
				),				
				'content' => array(
					'type' => 'longtext',
					'null' => false
				),				
				'meta_title' => array(
					'type' => 'text',
					'null' => true
				),
				'meta_keywords' => array(
					'type' => 'text',
					'null' => true
				),
				'meta_description' => array(
					'type' => 'text',
					'null' => true
				),
				'url' => array(
					'type' => 'varchar',
					'constraint' => 255,
					'null' => true
				),
				'new_window' => array(
					'type' => 'tinyint',
					'constraint' => 1,
					'null' => false,
					'default' => 0
				),				
				'status' => array(
					'type'=> 'tinyint',
					'constraint' => 1,
					'null' => false,
					'default' => 1
			 	),
			 	'deletable' => array(
					'type'=> 'tinyint',
					'constraint' => 1,
					'null' => false,
					'default' => 0
			 	),
			 	'priority' => array(
					'type' => 'int',
					'constraint' => 9,
					'null' => false,
					'default' => 0
				),
				'created' => array(
					'type'=> 'datetime',
					'null' => false
				),
				'modified' => array(
					'type'=> 'datetime',
					'null' => true
				)
			));

			$this->dbforge->add_key('page_id', true);
			$this->dbforge->create_table('page', true);
		}
	}

	/********************************************
  *
  * Generate categories table
  *
  *********************************************/
  private function _table_categories()
	{
	  if(!$this->db->table_exists('categories'))
	  {
	    $this->dbforge->add_field(array(
	      'id' => array(
	        'type' => 'int',
	        'constraint' => 9,
	        'unsigned' => true,
	        'auto_increment' => true
	      ),
	      'parent_id' => array(
	        'type' => 'int',
	        'constraint' => 9,
	        'unsigned' => true,
	        'null' => false,
	        'default' => 0
	      ),
	      'name' => array(
	        'type' => 'varchar',
	        'constraint' => 128,
	        'null' => false
	      ),
	      'slug' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => false
	      ),
	      'route_id' => array(
	        'type' => 'int',
	        'constraint' => 9,
	        'null' => false
	      ),
	      'excerpt' => array(
	        'type' => 'text',
	        'null' => true
	      ),
	      'description' => array(
	        'type' => 'text',
	        'null' => true
	      ),        
	      'meta_title' => array(
	        'type' => 'text',
	        'null' => true
	      ),
	      'meta_keywords' => array(
	        'type' => 'text',
	        'null' => true
	      ),
	      'meta_description' => array(
	        'type' => 'text',
	        'null' => true
	      ),
	      'image' => array(
	        'type' => 'varchar',
	        'constraint' => 255,
	        'null' => true
	      ),        
	      'sequence' => array(
	        'type' => 'int',
	        'constraint' => 5,
	        'unsigned' => true,
	        'default' => 0,
	        'null' => false
	      ),
	      'status' => array(
	        'type'=> 'tinyint',
	        'constraint' => 1,
	        'null' => false,
	        'default' => 1
	      ),
	      'created' => array(
	        'type'=> 'datetime',
	        'null' => false
	      ),
	      'modified' => array(
	        'type'=> 'datetime',
	        'null' => true
	      )
	    ));

	    $this->dbforge->add_key('id', true);
	    $this->dbforge->create_table('categories', true);
	  }
	}

}
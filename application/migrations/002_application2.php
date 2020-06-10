<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_application2 extends CI_Migration {
	
	public function up()
	{
		/********************************************
		*
		* Generate banner collection table
		*
		*********************************************/
		if (!$this->db->table_exists('banner_collection'))
    {
      $this->dbforge->add_field(array(
        'banner_collection_id' => array(
          'type' => 'int',
          'constraint' => 4,
          'unsigned' => true,
          'auto_increment' => true
        ),
        'name' => array(
          'type' => 'varchar',
          'constraint' => 255
        )
      ));
          
      $this->dbforge->add_key('banner_collection_id', true);
      $this->dbforge->create_table('banner_collection', true);
  
      $records = array(array('name' => 'Home Banners'));
      $this->db->insert_batch('banner_collection', $records);
    }
    
    /********************************************
		*
		* Generate banner table
		*
		*********************************************/
    if(!$this->db->table_exists('banner'))
    {
      $this->dbforge->add_field(array(
        'banner_id' => array(
          'type' => 'int',
          'constraint' => 9,
          'unsigned' => true,
          'auto_increment' => true
        ),
        'banner_collection_id' => array(
          'type' => 'int',
          'constraint' => 9,
          'unsigned' => true,
          'null' => false
        ),
        'name' => array(
          'type' => 'varchar',
          'constraint' => 128,
          'null' => false
        ),
        'enable_date' => array(
          'type' => 'date',
          'null' => true
        ),
        'disable_date' => array(
          'type' => 'date',
          'null' => true
        ),
        'code' => array(
          'type' => 'text',
          'null' => true
        ),
        'image' => array(
          'type' => 'varchar',
          'constraint' => 64,
          'null' => true
        ),
        'link' => array(
          'type' => 'varchar',
          'constraint' => 128,
          'null' => true
        ),
        'new_window' => array(
          'type' => 'tinyint',
          'constraint' => 1,
          'null' => false,
          'default' => 0
        ),
        'sequence' => array(
          'type' => 'int',
          'constraint' => 9,
          'null' => false,
          'default' => 0
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

      $this->dbforge->add_key('banner_id', true);
      $this->dbforge->create_table('banner', true);
    }

    /********************************************
		*
		* Generate slider collection table
		*
		*********************************************/
    if (!$this->db->table_exists('slider_collection'))
    {
      $this->dbforge->add_field(array(
        'slider_collection_id' => array(
          'type' => 'INT',
          'constraint' => 4,
          'unsigned' => TRUE,
          'auto_increment' => TRUE
        ),
        'name' => array(
          'type' => 'varchar',
          'constraint' => 255
        )
      ));
          
      $this->dbforge->add_key('slider_collection_id', TRUE);
      $this->dbforge->create_table('slider_collection', TRUE);
  
      $records = array(array('name'=>'Home Sliders'));
      $this->db->insert_batch('slider_collection', $records);
    }
    
    /********************************************
		*
		* Generate slider table
		*
		*********************************************/
    if(!$this->db->table_exists('slider'))
    {
      $this->dbforge->add_field(array(
        'slider_id' => array(
          'type' => 'int',
          'constraint' => 9,
          'unsigned' => true,
          'auto_increment' => true
        ),
        'slider_collection_id' => array(
          'type' => 'int',
          'constraint' => 9,
          'unsigned' => true,
          'null' => false
        ),
        'name' => array(
          'type' => 'text',
          'null' => true
        ),
        'content' => array(
          'type' => 'text',
          'null' => true
        ),
        'image' => array(
          'type' => 'varchar',
          'constraint' => 64,
          'null' => false
        ),
        'link' => array(
          'type' => 'varchar',
          'constraint' => 128,
          'null' => true
        ),
        'new_window' => array(
          'type' => 'tinyint',
          'constraint' => 1,
          'null' => false,
          'default' => 0
        ),
        'sequence' => array(
          'type' => 'int',
          'constraint' => 9,
          'null' => false,
          'default' => 0
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

      $this->dbforge->add_key('slider_id', true);
      $this->dbforge->create_table('slider', true);
    }

    /********************************************
    *
    * Generate testimonial table
    *
    *********************************************/
    if(!$this->db->table_exists('testimonial'))
    {
      $this->dbforge->add_field(array(
        'testimonial_id' => array(
          'type' => 'int',
          'constraint' => 9,
          'unsigned' => true,
          'auto_increment' => true
        ),
        'user_id' => array(
          'type' => 'int',
          'constraint' => 9,
          'unsigned' => true,
          'null' => true
        ),
        'author' => array(
          'type' => 'varchar',
          'constraint' => 255,
          'null' => false
        ),
        'content' => array(
          'type' => 'text',
          'null' => false
        ),
        'approved' => array(
          'type'=> 'tinyint',
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
        'created' => array( 
          'type'=> 'datetime',
          'null' => false
        ),
        'modified' => array( 
          'type'=> 'datetime',
          'null' => true
        )
      ));

      $this->dbforge->add_key('testimonial_id', true);
      $this->dbforge->create_table('testimonial', true);
    }
    
	}
	
	public function down()
	{
		// Migration 2 has no rollback 
	}

}
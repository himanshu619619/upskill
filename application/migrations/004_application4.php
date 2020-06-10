<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_application4 extends CI_Migration {
	
	public function up()
	{

    /********************************************
      *
      * Generate customer table
      *
      *********************************************/		

    if(!$this->db->table_exists('customer'))
    {
      // create the table
      $this->dbforge->add_field(
        array(
          'id' => array( 
            'type' => 'int',
            'constraint' => 9,
            'unsigned' => true,
            'auto_increment' => true
          ),
          'firstname' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
          ),
          'lastname' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => true
          ),
          'email' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
          ),
          'phone' => array(
            'type' => 'varchar',
            'constraint' => 50,
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
        )
      );

      $this->dbforge->add_key('id', true);
      $this->dbforge->create_table('customer', true);
    }
    
    /********************************************
		*
		* Generate customer address table
		*
		*********************************************/
    if(!$this->db->table_exists('customer_address'))
    {
      $this->dbforge->add_field(
        array(
          'id' => array(
            'type' => 'int',
            'constraint' => 9,
            'unsigned' => true,
            'auto_increment' => true
          ),
          'customer_id' => array(
            'type' => 'int',
            'constraint' => 9,
            'unsigned' => true,
            'null' => false
          ),
          'address1' => array(
            'type' => 'text',
            'null' => false
          ),
          'address2' => array(
            'type' => 'text',
            'null' => true
          ),
          'city' => array(
            'type' => 'varchar',
            'constraint' => 255,
            'null' => false
          ),
          'state' => array(
            'type' => 'varchar',
            'constraint' => 128,
            'null' => false
          ),
          'state_id' => array(
            'type' => 'int',
            'constraint' => 9,
            'null' => false
          ),
          'state_code' => array(
            'type' => 'varchar',
            'constraint' => 10,
            'null' => false
          ),
          'country' => array(
            'type' => 'varchar',
            'constraint' => 128,
            'null' => false
          ),
          'country_id' => array(
            'type' => 'int',
            'constraint' => 9,
            'null' => false
          ),
          'country_code' => array(
            'type' => 'varchar',
            'constraint' => 10,
            'null' => false
          ),
  				'created' => array( 
  					'type'=> 'datetime',
  					'null' => false
  				),
  				'modified' => array( 
  				  'type'=> 'datetime',
  				  'null' => true
  				)
        )
      );

      $this->dbforge->add_key('id', true);
      $this->dbforge->create_table('customer_address', true);
    }

    
	}
	
	public function down()
	{
		// Migration 4 has no rollback 
	}

}
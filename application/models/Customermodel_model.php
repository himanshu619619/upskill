<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customermodel_model extends CI_Model
{
    public function get_user_type($id = false)
    {
        if ($id) {
            # code...
        } else {
            return $this->db->select('*')->get('user_type')->result();
        }
    }
}

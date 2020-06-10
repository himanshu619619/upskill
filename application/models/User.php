<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class User extends CI_Model
{
    public function __construct()
    {
        // $this->tableName = 'api_users';
        // $this->primaryKey = 'id';
    }
    public function checkUser($data = array())
    {
        $qq = $this->db->where(array('email'=>$data['email']))->get('users');
        $checkemail = $qq->num_rows();

        if ($checkemail) {
            // echo "not"; exit();
            $result = $qq->row_array();
            $data['modified'] = date("Y-m-d H:i:s");
            return  $this->db->where('profile_id', $result['profile_id'])->update('users', $data);
        } else {
            // echo "yes"; exit();
            $data['user_type'] = 4;
            $data['created'] = date('Y-m-d H:i:s');
            $data['modified'] = date("Y-m-d H:i:s");
            $this->db->insert('users', $data);
            $id = $this->db->insert_id();
            $profile_id = "DM".$id.rand(10, 99);
            return  $this->db->set(array('profile_id'=>$profile_id,'username'=>$profile_id))->where('id', $id)->update('users');
              
        }




    }

    
}

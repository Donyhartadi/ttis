<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function getByUsername($username)
    {
        return $this->db->get_where('users', ['username' => $username])->row();
    }


    public function insertUser($data)
{
    $this->db->insert('users', $data);
}

}

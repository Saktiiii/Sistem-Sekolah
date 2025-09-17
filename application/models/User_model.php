<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_user($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password); // kalau password plain text
        return $this->db->get('users')->row();
    }
}

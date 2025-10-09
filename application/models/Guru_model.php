<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_model extends CI_Model {
    
    public function get_by_user_id($user_id)
    {
        $this->db->where('users_id', $user_id);
        return $this->db->get('guru')->row();
    }
    
    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('guru')->row();
    }
}
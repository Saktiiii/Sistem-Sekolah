<?php
class User_model extends CI_Model {

    public function get_user($username)
    {
        return $this->db->get_where('users', ['username' => $username])->row();
    }
    public function get_available_siswa_users()
{
    $this->db->select('u.id, u.username');
    $this->db->from('users u');
    $this->db->where('u.role', 'siswa');
    $this->db->where('u.id NOT IN (SELECT users_id FROM siswa)');
    return $this->db->get()->result_array();
}
    
    public function get_by_username($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('users')->row();
    }

}

<?php
class Ortu_model extends CI_Model {
    public function get_by_user($user_id) {
        return $this->db->get_where('ortu', ['user_id' => $user_id])->row();
    }
}
?>
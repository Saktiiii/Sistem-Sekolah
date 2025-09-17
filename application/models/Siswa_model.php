<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model {

    public function get_all()
    {
        return $this->db->get('siswa')->result();
    }
}

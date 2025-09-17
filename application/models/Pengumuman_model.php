<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman_model extends CI_Model {
    public function get_all() {
        return $this->db->order_by('tanggal_posting', 'DESC')
                        ->get('pengumuman')
                        ->result();
    }
}

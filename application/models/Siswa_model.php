<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function insert($data)
    {
        return $this->db->insert('siswa', $data);
    }
}

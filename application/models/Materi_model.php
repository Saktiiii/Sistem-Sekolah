<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi_model extends CI_Model {
    protected $table = 'materi';
    public function __construct(){ parent::__construct(); }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_by_kelas($kelas_id) {
        return $this->db->get_where($this->table, ['kelas_id' => $kelas_id])->result();
    }
}

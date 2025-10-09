<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_model extends CI_Model {
    protected $table = 'nilai';
    public function __construct(){ parent::__construct(); }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}

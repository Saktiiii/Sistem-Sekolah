<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends CI_Model {
    
    public function get_all()
    {
        $this->db->select('k.*, j.nama as nama_jurusan, g.nama as nama_wali_kelas');
        $this->db->from('kelas k');
        $this->db->join('jurusan j', 'k.jurusan_id = j.id', 'left');
        $this->db->join('guru g', 'k.wali_kelas_id = g.id', 'left');
        $this->db->order_by('k.tingkat', 'ASC');
        $this->db->order_by('k.nama_kelas', 'ASC');
        return $this->db->get()->result();
    }
    
    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('kelas')->row();
    }
}
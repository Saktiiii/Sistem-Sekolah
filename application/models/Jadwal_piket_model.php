<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_piket_model extends CI_Model {

    protected $table = 'jadwal_piket';

    public function get_by_kelas($kelas_id, $area = 'kelas')
    {
        $this->db->select('jadwal_piket.*, siswa.nama AS nama_siswa');
        $this->db->from($this->table);
        $this->db->join('siswa', 'siswa.id = jadwal_piket.penanggung_jawab_id', 'left');
        $this->db->where('jadwal_piket.kelas_id', $kelas_id);
        $this->db->where('jadwal_piket.area', $area);
        $this->db->order_by("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')");
        return $this->db->get()->result_array();
    }

    public function insert_data($data)
    {
        return $this->db->insert($this->table, $data);
    }
}

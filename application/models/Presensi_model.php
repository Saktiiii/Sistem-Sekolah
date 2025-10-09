<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presensi_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_presensi_by_siswa($siswa_id, $tanggal = null) {
        $this->db->select('p.*, j.hari, mp.nama_mapel, g.nama as nama_guru');
        $this->db->from('presensi p');
        $this->db->join('jadwal j', 'p.jadwal_id = j.id');
        $this->db->join('mata_pelajaran mp', 'j.mata_pelajaran_id = mp.id');
        $this->db->join('guru g', 'j.guru_id = g.id');
        $this->db->where('p.siswa_id', $siswa_id);
        
        if ($tanggal) {
            $this->db->where('p.tanggal', $tanggal);
        }
        
        $this->db->order_by('p.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    public function get_presensi_harian($tanggal) {
        $this->db->select('p.*, s.nama as nama_siswa, s.nis, k.nama_kelas, j.hari, mp.nama_mapel');
        $this->db->from('presensi p');
        $this->db->join('siswa s', 'p.siswa_id = s.id');
        $this->db->join('kelas k', 's.kelas_id = k.id');
        $this->db->join('jadwal j', 'p.jadwal_id = j.id');
        $this->db->join('mata_pelajaran mp', 'j.mata_pelajaran_id = mp.id');
        $this->db->where('p.tanggal', $tanggal);
        return $this->db->get()->result();
    }

    public function insert_presensi($data) {
        return $this->db->insert('presensi', $data);
    }

    public function update_presensi($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('presensi', $data);
    }
}
?>
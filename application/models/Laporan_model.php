<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function get_kelas_list() {
        return $this->db->order_by('nama_kelas','ASC')->get('kelas')->result();
    }

    public function get_siswa_by_kelas($kelas_id) {
        if (empty($kelas_id)) return [];
        $this->db->select('s.id, s.nama, s.nis, s.jenis_kelamin, s.kelas_id');
        $this->db->from('siswa s');
        $this->db->where('s.kelas_id', $kelas_id);
        $this->db->order_by('s.nama','ASC');
        return $this->db->get()->result();
    }

    public function get_nilai_by_siswa($siswa_id) {
        if (!$this->db->table_exists('nilai')) return [];
        $this->db->select('n.*, mp.nama_mapel');
        $this->db->from('nilai n');
        $this->db->join('mata_pelajaran mp', 'n.mata_pelajaran_id = mp.id', 'left');
        $this->db->where('n.siswa_id', $siswa_id);
        // optional: filter by tahun_ajaran / semester jika diperlukan
        return $this->db->get()->result();
    }

    public function get_avg_by_siswa($siswa_id) {
        if (!$this->db->table_exists('nilai')) return null;
        $this->db->select('AVG(n.nilai_total) as avg_nilai');
        $this->db->from('nilai n');
        $this->db->where('n.siswa_id', $siswa_id);
        $row = $this->db->get()->row();
        return $row ? (float)$row->avg_nilai : null;
    }

    public function get_absensi_summary($siswa_id) {
        if (!$this->db->table_exists('absensi')) return [];
        $this->db->select('status, COUNT(*) as jumlah');
        $this->db->from('absensi');
        $this->db->where('siswa_id', $siswa_id);
        $this->db->group_by('status');
        $res = $this->db->get()->result();

        $summary = [];
        foreach ($res as $r) {
            $summary[$r->status] = (int)$r->jumlah;
        }
        return $summary;
    }

    public function get_tugas_summary($siswa_id) {
        // try common table names 'tugas' or 'tugas_siswa'
        if ($this->db->table_exists('tugas')) {
            $this->db->select('nama_tugas, nilai, tanggal, tugas_ke');
            $this->db->from('tugas');
            $this->db->where('siswa_id', $siswa_id);
            return $this->db->get()->result();
        } elseif ($this->db->table_exists('tugas_siswa')) {
            $this->db->select('*')->from('tugas_siswa')->where('siswa_id', $siswa_id);
            return $this->db->get()->result();
        }
        return [];
    }

    // Helper: get kelas name
    public function get_kelas($kelas_id) {
        return $this->db->get_where('kelas', ['id' => $kelas_id])->row();
    }
}

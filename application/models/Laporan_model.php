<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_kelas_list()
    {
        return $this->db->order_by('nama_kelas', 'ASC')->get('kelas')->result();
    }

    public function get_siswa_by_kelas($kelas_id)
    {
        if (empty($kelas_id))
            return [];
        $this->db->select('s.id, s.nama, s.nis, s.jenis_kelamin, s.kelas_id');
        $this->db->from('siswa s');
        $this->db->where('s.kelas_id', $kelas_id);
        $this->db->order_by('s.nama', 'ASC');
        return $this->db->get()->result();
    }

    public function get_nilai_by_siswa($siswa_id)
    {
        if (!$this->db->table_exists('nilai'))
            return [];
        $this->db->select('n.*, mp.nama_mapel');
        $this->db->from('nilai n');
        $this->db->join('mata_pelajaran mp', 'n.mata_pelajaran_id = mp.id', 'left');
        $this->db->where('n.siswa_id', $siswa_id);
        // optional: filter by tahun_ajaran / semester jika diperlukan
        return $this->db->get()->result();
    }

    public function get_avg_by_siswa($siswa_id)
    {
        if (!$this->db->table_exists('nilai'))
            return null;
        $this->db->select('AVG(n.nilai_total) as avg_nilai');
        $this->db->from('nilai n');
        $this->db->where('n.siswa_id', $siswa_id);
        $row = $this->db->get()->row();
        return $row ? (float) $row->avg_nilai : null;
    }

    public function get_absensi_summary($siswa_id)
    {
        if (!$this->db->table_exists('absensi'))
            return [];
        $this->db->select('status, COUNT(*) as jumlah');
        $this->db->from('absensi');
        $this->db->where('siswa_id', $siswa_id);
        $this->db->group_by('status');
        $res = $this->db->get()->result();

        $summary = [];
        foreach ($res as $r) {
            $summary[$r->status] = (int) $r->jumlah;
        }
        return $summary;
    }

    public function get_tugas_summary($siswa_id)
    {
        if ($this->db->table_exists('tugas_siswa') && $this->db->table_exists('tugas')) {
            $this->db->select('t.judul AS nama_tugas, ts.nilai, ts.tanggal, ts.tugas_ke'); // Adjust field names in tugas_siswa as needed (e.g., assume ts has tugas_id, siswa_id, nilai, tanggal, tugas_ke)
            $this->db->from('tugas t');
            $this->db->join('tugas_siswa ts', 't.id = ts.tugas_id', 'inner');
            $this->db->where('ts.siswa_id', $siswa_id);
            return $this->db->get()->result();
        } elseif ($this->db->table_exists('tugas')) {
            $this->db->select('kelas_id')->from('siswa')->where('id', $siswa_id)->limit(1);
            $kelas_query = $this->db->get()->row();
            if ($kelas_query) {
                $this->db->select('judul AS nama_tugas, batas_pengumpulan AS tanggal'); // No nilai/tugas_ke without submissions
                $this->db->from('tugas');
                $this->db->where('kelas_id', $kelas_query->kelas_id);
                return $this->db->get()->result();
            }
            return [];
        }
        return [];
    }

    // Helper: get kelas name
    public function get_kelas($kelas_id)
    {
        return $this->db->get_where('kelas', ['id' => $kelas_id])->row();
    }
}

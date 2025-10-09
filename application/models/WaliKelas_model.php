<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Walikelas_model extends CI_Model {

    public function getKelasByWali($guru_id)
    {
        return $this->db->select('k.*, j.nama AS nama_jurusan, g.nama AS nama_wali_kelas')
            ->from('kelas k')
            ->join('jurusan j', 'j.id = k.jurusan_id', 'left')
            ->join('guru g', 'g.id = k.wali_kelas_id', 'left')
            ->where('k.wali_kelas_id', $guru_id)
            ->get()
            ->row_array();
    }

    public function getSiswaKelas($kelas_id)
    {
        return $this->db->select('*')
            ->from('siswa')
            ->where('kelas_id', $kelas_id)
            ->get()
            ->result_array();
    }

    // Siswa dengan rata-rata nilai > 90
    public function getSiswaBerprestasi($kelas_id)
    {
        return $this->db->query("
            SELECT s.id, s.nama, s.nis, s.jenis_kelamin, 
                   ROUND(AVG(n.nilai_total), 2) AS rata_rata_nilai,
                   IFNULL(SUM(CASE WHEN p.status = 'alpha' THEN 1 ELSE 0 END), 0) AS total_alpha
            FROM siswa s
            LEFT JOIN nilai n ON n.siswa_id = s.id
            LEFT JOIN presensi p ON p.siswa_id = s.id
            WHERE s.kelas_id = ?
            GROUP BY s.id
            HAVING rata_rata_nilai > 90
            ORDER BY rata_rata_nilai DESC
        ", [$kelas_id])->result_array();
    }

    // Siswa dengan alpha > 7
    public function getSiswaBermasalah($kelas_id)
    {
        return $this->db->query("
            SELECT s.id, s.nama, s.nis, s.jenis_kelamin, 
                   ROUND(AVG(n.nilai_total), 2) AS rata_rata_nilai,
                   SUM(CASE WHEN p.status = 'alpha' THEN 1 ELSE 0 END) AS total_alpha
            FROM siswa s
            LEFT JOIN nilai n ON n.siswa_id = s.id
            LEFT JOIN presensi p ON p.siswa_id = s.id
            WHERE s.kelas_id = ?
            GROUP BY s.id
            HAVING total_alpha > 7
            ORDER BY total_alpha DESC
        ", [$kelas_id])->result_array();
    }

    // Rekap absensi per siswa
    public function getRekapAbsensi($kelas_id)
    {
        return $this->db->query("
            SELECT s.id, s.nama, s.jenis_kelamin,
                   COUNT(p.id) AS total_pertemuan,
                   SUM(p.status = 'hadir') AS hadir,
                   SUM(p.status = 'izin') AS izin,
                   SUM(p.status = 'sakit') AS sakit,
                   SUM(p.status = 'alpha') AS alpha
            FROM siswa s
            LEFT JOIN presensi p ON p.siswa_id = s.id
            WHERE s.kelas_id = ?
            GROUP BY s.id
        ", [$kelas_id])->result_array();
    }

    public function getDetailSiswa($siswa_id)
    {
        $siswa = $this->db->select('s.*, k.nama_kelas')
            ->from('siswa s')
            ->join('kelas k', 'k.id = s.kelas_id', 'left')
            ->where('s.id', $siswa_id)
            ->get()
            ->row_array();

        $orang_tua = $this->db->get_where('orang_tua', ['siswa_id' => $siswa_id])->row_array();

        $prestasi = $this->db->select('m.nama_mapel, n.nilai_total')
            ->from('nilai n')
            ->join('mata_pelajaran m', 'm.id = n.mata_pelajaran_id', 'left')
            ->where('n.siswa_id', $siswa_id)
            ->order_by('n.nilai_total', 'DESC')
            ->get()
            ->result_array();

        return [
            'siswa' => $siswa,
            'orang_tua' => $orang_tua,
            'prestasi' => $prestasi
        ];
    }
}

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
// =======================
// ADMINISTRASI KELAS
// =======================

// Ambil jadwal pelajaran berdasarkan kelas
public function getJadwal($kelas_id, $hari = null)
{
    $this->db->select("
        j.id,
        j.hari,
        j.jam_mulai,
        j.jam_selesai,
        SEC_TO_TIME(TIME_TO_SEC(j.jam_selesai) - TIME_TO_SEC(j.jam_mulai)) AS durasi,
        m.nama_mapel AS mata_pelajaran,
        g.nama AS guru
    ");
    $this->db->from('jadwal j');
    $this->db->join('mata_pelajaran m', 'm.id = j.mata_pelajaran_id', 'left');
    $this->db->join('guru g', 'g.id = j.guru_id', 'left');
    $this->db->where('j.kelas_id', $kelas_id);

    // pastikan huruf besar/kecil cocok dengan database
    if (!empty($hari)) {
        $this->db->where('LOWER(j.hari)', strtolower($hari));
    }

    $this->db->order_by('FIELD(j.hari, "Senin","Selasa","Rabu","Kamis","Jumat")', '', false);
    $this->db->order_by('j.jam_mulai', 'ASC');

    $query = $this->db->get();
    // Debug optional: aktifkan baris di bawah jika masih salah
    // echo $this->db->last_query(); exit;

    return $query->result_array();
}




// Ambil jadwal piket berdasarkan kelas
public function getJadwalPiket($kelas_id)
{
    return $this->db->get_where('jadwal_piket', ['kelas_id' => $kelas_id])->result_array();
}

// Ambil kegiatan kelas berdasarkan kelas
public function getKegiatanKelas($kelas_id)
{
    return $this->db->get_where('kegiatan_kelas', ['kelas_id' => $kelas_id])->result_array();
}

}

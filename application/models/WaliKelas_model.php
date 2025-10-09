<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WaliKelas_model extends CI_Model {

    public function get_kelas_by_wali($guru_id) {
        return $this->db->select('k.*, j.nama as nama_jurusan, g.nama as nama_wali_kelas')
                        ->from('kelas k')
                        ->join('jurusan j', 'j.id = k.jurusan_id')
                        ->join('guru g', 'g.id = k.wali_kelas_id')
                        ->where('k.wali_kelas_id', $guru_id)
                        ->get()
                        ->row_array();
    }

    public function get_siswa_by_kelas($kelas_id) {
        return $this->db->select('s.*, u.username')
                        ->from('siswa s')
                        ->join('users u', 'u.id = s.users_id')
                        ->where('s.kelas_id', $kelas_id)
                        ->order_by('s.nama', 'ASC')
                        ->get()
                        ->result_array();
    }

public function get_siswa_berprestasi($kelas_id) {
    // Siswa dengan nilai rata-rata >= 80 dan sedikit alpha
    return $this->db->select('s.*, 
                            AVG(n.nilai_total) as rata_rata_nilai,
                            COUNT(CASE WHEN p.status = "alpha" THEN 1 END) as total_alpha')
                    ->from('siswa s')
                    ->join('nilai n', 'n.siswa_id = s.id', 'left')
                    ->join('presensi p', 'p.siswa_id = s.id', 'left')
                    ->where('s.kelas_id', $kelas_id)
                    ->group_by('s.id')
                    ->having('AVG(n.nilai_total) >=', 80)
                    ->having('COUNT(CASE WHEN p.status = "alpha" THEN 1 END) <=', 3)
                    ->order_by('rata_rata_nilai', 'DESC')
                    ->get()
                    ->result_array();
}

public function get_siswa_bermasalah($kelas_id) {
    // Siswa dengan nilai rendah atau banyak alpha
    return $this->db->select('s.*, 
                            AVG(n.nilai_total) as rata_rata_nilai,
                            COUNT(CASE WHEN p.status = "alpha" THEN 1 END) as total_alpha')
                    ->from('siswa s')
                    ->join('nilai n', 'n.siswa_id = s.id', 'left')
                    ->join('presensi p', 'p.siswa_id = s.id', 'left')
                    ->where('s.kelas_id', $kelas_id)
                    ->group_by('s.id')
                    ->having('AVG(n.nilai_total) <', 75)
                    ->or_having('COUNT(CASE WHEN p.status = "alpha" THEN 1 END) >', 5)
                    ->order_by('total_alpha', 'DESC')
                    ->get()
                    ->result_array();
}

    public function get_rekap_absensi($kelas_id) {
        return $this->db->select('s.id, s.nama, s.nis,
                                COUNT(p.id) as total_pertemuan,
                                COUNT(CASE WHEN p.status = "hadir" THEN 1 END) as hadir,
                                COUNT(CASE WHEN p.status = "izin" THEN 1 END) as izin,
                                COUNT(CASE WHEN p.status = "sakit" THEN 1 END) as sakit,
                                COUNT(CASE WHEN p.status = "alpha" THEN 1 END) as alpha')
                        ->from('siswa s')
                        ->join('presensi p', 'p.siswa_id = s.id', 'left')
                        ->where('s.kelas_id', $kelas_id)
                        ->group_by('s.id')
                        ->get()
                        ->result_array();
    }

    public function get_statistik_kelas($kelas_id) {
        $total_siswa = $this->db->where('kelas_id', $kelas_id)->count_all_results('siswa');
        
        $siswa_berprestasi = $this->db->select('s.id')
                                    ->from('siswa s')
                                    ->join('nilai n', 'n.siswa_id = s.id')
                                    ->where('s.kelas_id', $kelas_id)
                                    ->group_by('s.id')
                                    ->having('AVG(n.nilai_total) >=', 85)
                                    ->get()
                                    ->num_rows();
        
        $siswa_bermasalah = $this->db->select('s.id')
                                   ->from('siswa s')
                                   ->join('presensi p', 'p.siswa_id = s.id', 'left')
                                   ->join('nilai n', 'n.siswa_id = s.id', 'left')
                                   ->where('s.kelas_id', $kelas_id)
                                   ->group_by('s.id')
                                   ->having('COUNT(CASE WHEN p.status = "alpha" THEN 1 END) > 5 OR AVG(n.nilai_total) < 70')
                                   ->get()
                                   ->num_rows();
        
        $rata_kehadiran = $this->db->select('(COUNT(CASE WHEN status = "hadir" THEN 1 END) * 100 / COUNT(*)) as persentase')
                                 ->from('presensi p')
                                 ->join('siswa s', 's.id = p.siswa_id')
                                 ->where('s.kelas_id', $kelas_id)
                                 ->get()
                                 ->row_array();
        
        return [
            'total_siswa' => $total_siswa,
            'siswa_berprestasi' => $siswa_berprestasi,
            'siswa_bermasalah' => $siswa_bermasalah,
            'rata_kehadiran' => $rata_kehadiran['persentase'] ?? 0
        ];
    }

    public function get_detail_siswa($siswa_id) {
        $siswa = $this->db->select('s.*, k.nama_kelas, j.nama as jurusan, u.username')
                         ->from('siswa s')
                         ->join('kelas k', 'k.id = s.kelas_id')
                         ->join('jurusan j', 'j.id = k.jurusan_id')
                         ->join('users u', 'u.id = s.users_id')
                         ->where('s.id', $siswa_id)
                         ->get()
                         ->row_array();
        
        if ($siswa) {
            $orang_tua = $this->db->where('siswa_id', $siswa_id)->get('orang_tua')->row_array();
            
            $prestasi = $this->db->select('mp.nama_mapel, n.nilai_total')
                                ->from('nilai n')
                                ->join('mata_pelajaran mp', 'mp.id = n.mata_pelajaran_id')
                                ->where('n.siswa_id', $siswa_id)
                                ->where('n.nilai_total >=', 85)
                                ->get()
                                ->result_array();
            
            return [
                'siswa' => $siswa,
                'orang_tua' => $orang_tua,
                'prestasi' => $prestasi
            ];
        }
        
        return null;
    }

    public function tambah_prestasi($data) {
        return $this->db->insert('prestasi_siswa', $data);
    }
}
?>
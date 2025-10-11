<?php
class Ortu_model extends CI_Model
{
    public function get_dashboard_anak($siswa_id, $kelas_id)
    {
        // Peringkat Kelas
        $this->db->select('s.id, AVG(n.nilai_total) AS rata_rata');
        $this->db->from('siswa s');
        $this->db->join('nilai n', 'n.siswa_id = s.id', 'left');
        $this->db->where('s.kelas_id', $kelas_id);
        $this->db->group_by('s.id');
        $this->db->order_by('rata_rata', 'DESC');
        $peringkat = $this->db->get()->result();

        // Hitung peringkat anak
        $rank = 0;
        foreach ($peringkat as $index => $row) {
            if ($row->id == $siswa_id) {
                $rank = $index + 1;
                break;
            }
        }
        $total_siswa = count($peringkat);

        // Total Pelanggaran
        $total_pelanggaran = 0;
        if ($this->db->table_exists('pelanggaran_siswa')) {
            $this->db->where('siswa_id', $siswa_id);
            $total_pelanggaran = $this->db->count_all_results('pelanggaran_siswa');
        }


        // Total Absensi
        $this->db->where('siswa_id', $siswa_id);
        $this->db->where('status !=', 'hadir');
        $total_absensi = $this->db->count_all_results('presensi');

        return [
            'peringkat' => $rank,
            'total_siswa' => $total_siswa,
            'total_pelanggaran' => $total_pelanggaran,
            'total_absensi' => $total_absensi
        ];
    }

    public function get_by_user($user_id)
    {
        return $this->db->get_where('orang_tua', ['users_id' => $user_id])->row();
    }


    public function get_all($users_id)
    {
        $this->db->select('
        siswa.nis,
        siswa.nama,
        siswa.alamat,
        siswa.jenis_kelamin,
        kelas.nama_kelas AS kelas,
        jurusan.nama AS jurusan
    ');
        $this->db->from('siswa');
        $this->db->join('kelas', 'kelas.id = siswa.kelas_id', 'left');
        $this->db->join('jurusan', 'jurusan.id = kelas.jurusan_id', 'left');
        $this->db->join('orang_tua', 'orang_tua.siswa_id = siswa.id', 'inner');
        $this->db->where('orang_tua.users_id', $users_id); // filter berdasarkan orang tua login
        return $this->db->get()->row();
    }

    public function get_siswa_bermasalah()
    {
        $this->db->select('s.id, s.nama, s.nis, s.jenis_kelamin, s.kelas_id, p.status, p.keterangan, p.tanggal');
        $this->db->from('siswa s');
        $this->db->join('presensi p', 'p.siswa_id = s.id', 'left');
        $this->db->where_in('p.status', ['alpha', 'sakit', 'izin']); // ambil yang tidak hadir
        $this->db->order_by('p.tanggal', 'DESC');
        return $this->db->get()->result();
    }
    public function get_detail_siswa($id)
    {
        $this->db->select('s.*');
        $this->db->from('siswa s');
        $this->db->where('s.id', $id);
        $siswa = $this->db->get()->row();

        $this->db->select('p.*');
        $this->db->from('presensi p');
        $this->db->where('p.siswa_id', $id);
        $this->db->order_by('p.tanggal', 'DESC');
        $siswa->presensi = $this->db->get()->result();

        return $siswa;
    }
    public function get_all_absensi()
    {
        $this->db->select('presensi.*, siswa.nama, siswa.nis, siswa.jenis_kelamin, siswa.kelas_id');
        $this->db->from('presensi');
        $this->db->join('siswa', 'siswa.id = presensi.siswa_id');
        $this->db->order_by('presensi.tanggal', 'DESC');
        return $this->db->get()->result();
    }
    public function get_absensi_anak($users_id)
    {
        $this->db->select('presensi.*, siswa.nama, siswa.nis, siswa.jenis_kelamin, kelas.nama_kelas AS kelas');
        $this->db->from('presensi');
        $this->db->join('siswa', 'siswa.id = presensi.siswa_id', 'inner');
        $this->db->join('kelas', 'kelas.id = siswa.kelas_id', 'left');
        $this->db->join('orang_tua', 'orang_tua.siswa_id = siswa.id', 'inner');
        $this->db->where('orang_tua.users_id', $users_id); // filter anak ortu login
        $this->db->order_by('presensi.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    // Ambil semua pesan antara orang tua dan wali kelas
    public function getPesan($orang_tua_id, $guru_id, $siswa_id)
    {
        $this->db->where('orang_tua_id', $orang_tua_id);
        $this->db->where('guru_id', $guru_id);
        $this->db->where('siswa_id', $siswa_id);
        $this->db->order_by('created_at', 'ASC');
        return $this->db->get('pesan')->result();
    }
    // Simpan pesan baru
    public function kirimPesan($data)
    {
        return $this->db->insert('pesan', $data);
    }
    public function getOrangTua($id)
    {
        return $this->db->get_where('orang_tua', ['id' => $id])->row();
    }
    public function getSiswa($id)
    {
        return $this->db->get_where('siswa', ['id' => $id])->row();
    }
    public function getGuru($id)
    {
        return $this->db->get_where('guru', ['id' => $id])->row();
    }
    // Ambil siswa berdasarkan orang tua
    public function get_siswa_by_ortu($id_ortu)
    {
        $this->db->select('s.*, k.nama_kelas');
        $this->db->from('siswa s');
        $this->db->join('orang_tua ot', 'ot.siswa_id = s.id', 'inner');
        $this->db->join('kelas k', 'k.id = s.kelas_id', 'left');
        $this->db->where('ot.id', $id_ortu); // FILTER PENTING
        $this->db->limit(1);
        return $this->db->get()->row();
    }





    // Ambil wali kelas (jika perlu)
    public function get_wali_kelas($id_ortu)
    {
        $this->db->select('g.*');
        $this->db->from('guru g');
        $this->db->join('kelas k', 'k.wali_kelas_id = g.id');
        $this->db->join('siswa s', 's.kelas_id = k.id');
        $this->db->join('orang_tua ot', 'ot.siswa_id = s.id');
        $this->db->where('ot.id', $id_ortu);
        return $this->db->get()->row();
    }
    // Ambil pengumuman umum saja
    public function get_pengumuman_umum()
    {
        $this->db->select('
            p.id, p.judul, p.isi, p.tanggal_pembuatan, p.status, 
            g.nama AS pembuat_nama
        ');
        $this->db->from('pengumuman p');
        $this->db->join('guru g', 'g.id = p.dibuat_oleh', 'left');
        $this->db->where('p.status', 'umum'); // Hanya pengumuman umum
        $this->db->order_by('p.tanggal_pembuatan', 'DESC');
        return $this->db->get()->result();
    }

}
?>
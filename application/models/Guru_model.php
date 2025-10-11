<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_model extends CI_Model
{
    public function get_by_user($user_id)
    {
        // Ambil orang tua berdasarkan users_id (bukan id)
        return $this->db->get_where('orang_tua', ['users_id' => $user_id])->row();
    }


    public function get_by_user_id($user_id)
    {
        $this->db->where('users_id', $user_id);
        return $this->db->get('guru')->row();
    }

    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('guru')->row();
    }

    // akademik
    public function get_tahun_ajaran_aktif()
    {
        return $this->db->get_where('tahun_ajaran', ['aktif' => 1])->row();
    }
    public function get_jadwal_mengajar($guru_id)
    {
        $this->db->select('j.*, k.nama_kelas, m.nama_mapel AS mapel, t.tahun, t.semester');
        $this->db->from('jadwal j');
        $this->db->join('kelas k', 'k.id = j.kelas_id', 'left');
        $this->db->join('mata_pelajaran m', 'm.id = j.mata_pelajaran_id', 'left');
        $this->db->join('tahun_ajaran t', 't.id = j.tahun_ajaran_id', 'left');
        $this->db->where('j.guru_id', $guru_id);
        return $this->db->get()->result();
    }
    public function get_kelas_guru($guru_id)
    {
        $this->db->distinct(); // aktifkan DISTINCT
        $this->db->select('k.id, k.nama_kelas');
        $this->db->from('jadwal j');
        $this->db->join('kelas k', 'k.id = j.kelas_id', 'left');
        $this->db->where('j.guru_id', $guru_id);
        return $this->db->get()->result();
    }

    public function get_materi_guru($guru_id)
    {
        return $this->db->get_where('materi', ['guru_id' => $guru_id])->result();
    }
    public function get_tugas_guru($guru_id)
    {
        return $this->db->get_where('tugas', ['guru_id' => $guru_id])->result();
    }
    public function insert_nilai($data)
    {
        return $this->db->insert('nilai', $data);
    }
    public function insert_materi($data)
    {
        return $this->db->insert('materi', $data);
    }
    public function insert_tugas($data)
    {
        return $this->db->insert('tugas', $data);
    }

    // EKSTRAKURIKULER
    public function get_ekskul_by_guru($guru_id)
    {
        return $this->db->get_where('ekstrakurikuler', ['pembina_id' => $guru_id])->result();
    }
    public function get_anggota_ekskul($ekskul_id)
    {
        $this->db->select('a.*, s.nama, s.nis');
        $this->db->from('anggota_ekskul a');
        $this->db->join('siswa s', 's.id = a.siswa_id');
        $this->db->where('a.ekskul_id', $ekskul_id);
        return $this->db->get()->result();
    }
    public function get_penghargaan_ekskul($ekskul_id)
    {
        return $this->db->get_where('penghargaan_ekskul', ['ekskul_id' => $ekskul_id])->result();
    }
    public function get_jadwal_ekskul($ekskul_id)
    {
        return $this->db->get_where('jadwal_ekskul', ['ekskul_id' => $ekskul_id])->result();
    }

    // Tambah data baru
    public function tambah_anggota($data)
    {
        return $this->db->insert('anggota_ekskul', $data);
    }
    public function tambah_penghargaan($data)
    {
        return $this->db->insert('penghargaan_ekskul', $data);
    }
    public function tambah_jadwal($data)
    {
        return $this->db->insert('jadwal_ekskul', $data);
    }
    // pengumuman
    // Ambil semua pengumuman milik guru ini
    public function get_pengumuman_by_guru($guru_id)
    {
        $this->db->select('p.*, k.nama_kelas');
        $this->db->from('pengumuman p');
        $this->db->join('kelas k', 'k.id = p.id_kelas', 'left');
        $this->db->where('p.dibuat_oleh', $guru_id);
        $this->db->order_by('p.tanggal_pembuatan', 'DESC');
        return $this->db->get()->result();
    }
    // Tambah pengumuman baru
    public function tambah_pengumuman($data)
    {
        return $this->db->insert('pengumuman', $data);
    }
    // Hapus pengumuman
    public function hapus_pengumuman($id, $guru_id)
    {
        // keamanan: hanya bisa hapus milik sendiri
        $this->db->where('id', $id);
        $this->db->where('dibuat_oleh', $guru_id);
        return $this->db->delete('pengumuman');
    }
    // Ambil daftar kelas untuk dropdown
    public function get_kelas()
    {
        return $this->db->get('kelas')->result();
    }
    // Laporan
    // Nilai siswa per kelas
    public function get_nilai_by_kelas($kelas_id)
    {
        $this->db->select('nilai.*, siswa.nama as nama_siswa, mata_pelajaran.nama_mapel');
        $this->db->from('nilai');
        $this->db->join('siswa', 'siswa.id = nilai.siswa_id');
        $this->db->join('mata_pelajaran', 'mata_pelajaran.id = nilai.mata_pelajaran_id');

        // Fix: Specify the table where kelas_id exists (it's in the 'siswa' table)
        $this->db->where('siswa.kelas_id', $kelas_id);

        return $this->db->get()->result();
    }
    public function get_all_kelas()
    {
        return $this->db->get('kelas')->result();
    }

    // Absensi siswa per kelas
    public function get_absensi_by_kelas($kelas_id)
    {
        $this->db->select('presensi.*, siswa.nama as nama_siswa, jadwal.hari, jadwal.jam_mulai, jadwal.jam_selesai');
        $this->db->from('presensi');
        $this->db->join('siswa', 'siswa.id = presensi.siswa_id');
        $this->db->join('jadwal', 'jadwal.id = presensi.jadwal_id');
        $this->db->where('jadwal.kelas_id', $kelas_id);
        $this->db->order_by('presensi.tanggal', 'ASC');
        return $this->db->get()->result();
    }

    // Tugas siswa per kelas
    public function get_tugas_by_kelas($kelas_id)
    {
        $this->db->select('tugas.*, mata_pelajaran.nama_mapel');
        $this->db->from('tugas');
        $this->db->join('mata_pelajaran', 'mata_pelajaran.id = tugas.mata_pelajaran_id');
        $this->db->where('kelas_id', $kelas_id);
        $this->db->order_by('tugas.batas_pengumpulan', 'ASC');
        return $this->db->get()->result();
    }

    // absensi
    public function insert_absen($data)
    {
        return $this->db->insert('absensi_guru', $data);
    }
    public function get_all_absensi()
    {
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get('absensi_guru')->result();
    }
    // Ambil absensi berdasarkan NIP
    public function get_absensi_by_guru($nip)
    {
        $this->db->where('nip', $nip);
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get('absensi_guru')->result_array();
    }

    // Ambil daftar guru unik
    public function get_all_guru()
    {
        $this->db->select('nama, nip');
        $this->db->distinct();
        return $this->db->get('absensi_guru')->result_array();
    }
}
<?php
class Ortu_model extends CI_Model
{
    public function get_by_user($user_id)
    {
        return $this->db->get_where('ortu', ['user_id' => $user_id])->row();
    }
    public function get_all()
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
        return $this->db->get()->result();
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
}
?>
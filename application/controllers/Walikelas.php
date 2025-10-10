<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Walikelas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model(['Walikelas_model', 'User_model', 'Siswa_model']);
        $this->load->library('session');
    }

    // =======================
    // HALAMAN DATA KELAS
    // =======================
    public function data_kelas()
    {
        $guru_id = $this->session->userdata('guru_id');

        if (!$guru_id) {
            show_error('Akses ditolak. Anda bukan wali kelas.');
            return;
        }

        $kelas = $this->Walikelas_model->getKelasByWali($guru_id);

        if (!$kelas) {
            $data['kelas'] = null;
            $this->load->view('walikelas/data_kelas', $data);
            return;
        }

        $kelas_id = $kelas['id'];

        $data['kelas'] = $kelas;
        $data['siswa_kelas'] = $this->Walikelas_model->getSiswaKelas($kelas_id);
        $data['siswa_berprestasi'] = $this->Walikelas_model->getSiswaBerprestasi($kelas_id);
        $data['siswa_bermasalah'] = $this->Walikelas_model->getSiswaBermasalah($kelas_id);
        $data['rekap_absensi'] = $this->Walikelas_model->getRekapAbsensi($kelas_id);
        $data['available_users'] = $this->User_model->get_available_siswa_users();

        $this->load->view('walikelas/data_kelas', $data);
    }

    // =======================
    // DETAIL SISWA (UNTUK PANEL)
    // =======================
    public function get_detail_siswa($id)
    {
        $data = $this->Walikelas_model->getDetailSiswa($id);
        echo json_encode(['success' => $data ? true : false, 'data' => $data]);
    }

    // =======================
    // TAMBAH SISWA (MODAL)
    // =======================
    public function tambah_siswa()
    {
        $this->output->set_content_type('application/json');
        $guru_id = $this->session->userdata('guru_id');

        if (!$guru_id) {
            echo json_encode(['success' => false, 'message' => 'Anda bukan wali kelas']);
            return;
        }

        $kelas = $this->Walikelas_model->getKelasByWali($guru_id);
        if (!$kelas) {
            echo json_encode(['success' => false, 'message' => 'Kelas tidak ditemukan']);
            return;
        }

        $data = [
            'users_id'      => $this->input->post('users_id'),
            'nama'          => $this->input->post('nama'),
            'nis'           => $this->input->post('nis'),
            'alamat'        => $this->input->post('alamat'),
            'telepon'       => $this->input->post('telepon'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'kelas_id'      => $kelas['id']
        ];

        if (empty($data['users_id'])) {
            echo json_encode(['success' => false, 'message' => 'User siswa belum dipilih']);
            return;
        }

        $insert = $this->Siswa_model->insert($data);
        echo json_encode(['success' => $insert ? true : false, 'message' => $insert ? 'Siswa berhasil ditambahkan' : 'Gagal menambah siswa']);
    }

    // =======================
    // FORM EDIT SISWA
    // =======================
    public function form_edit_siswa($id)
    {
        $data['siswa'] = $this->db->get_where('siswa', ['id' => $id])->row_array();
        if (!$data['siswa']) {
            show_error('Data siswa tidak ditemukan');
            return;
        }

        $this->load->view('walikelas/form_edit_siswa', $data);
    }

    // =======================
    // PROSES EDIT SISWA ABSENSI
    // =======================
// =======================
// GET DATA ABSENSI (UNTUK EDIT MODAL)
// =======================
public function get_absensi($id)
{
    $this->output->set_content_type('application/json');

    // Ambil data siswa dan absensinya
    $this->db->select('s.id, s.nama, 
        a.total_pertemuan, a.hadir, a.izin, a.sakit, a.alpha');
    $this->db->from('siswa s');
    $this->db->join('absensi a', 'a.siswa_id = s.id', 'left');
    $this->db->where('s.id', $id);
    $data = $this->db->get()->row_array();

    echo json_encode(['success' => $data ? true : false, 'data' => $data]);
}

// =======================
// UPDATE ABSENSI (DARI MODAL)
// =======================
public function update_absensi()
{
    $this->output->set_content_type('application/json');

    $id = $this->input->post('id');
    $data = [
        'total_pertemuan' => $this->input->post('total_pertemuan'),
        'hadir'           => $this->input->post('hadir'),
        'izin'            => $this->input->post('izin'),
        'sakit'           => $this->input->post('sakit'),
        'alpha'           => $this->input->post('alpha')
    ];

    // Pastikan absensi sudah ada
    $absen = $this->db->get_where('absensi', ['siswa_id' => $id])->row_array();

    if ($absen) {
        $this->db->where('siswa_id', $id);
        $update = $this->db->update('absensi', $data);
    } else {
        $data['siswa_id'] = $id;
        $update = $this->db->insert('absensi', $data);
    }

    echo json_encode(['success' => $update ? true : false]);
}


    // =======================
    // PROSES EDIT SISWA
    // =======================
// Ambil data siswa untuk edit (AJAX)
public function get_siswa($id)
{
    $this->output->set_content_type('application/json');
    $siswa = $this->db->get_where('siswa', ['id' => $id])->row_array();
    echo json_encode(['success' => $siswa ? true : false, 'data' => $siswa]);
}

// Update siswa dari modal edit
public function update_siswa()
{
    $this->output->set_content_type('application/json');

    $id = $this->input->post('id');
    $data = [
        'nama'          => $this->input->post('nama'),
        'nis'           => $this->input->post('nis'),
        'alamat'        => $this->input->post('alamat'),
        'telepon'       => $this->input->post('telepon'),
        'jenis_kelamin' => $this->input->post('jenis_kelamin')
    ];

    $this->db->where('id', $id);
    $update = $this->db->update('siswa', $data);

    echo json_encode(['success' => $update ? true : false]);
}

public function get_rekap_absensi_by_siswa($id)
{
    $data = $this->db->query("
        SELECT 
            COUNT(id) AS total_pertemuan,
            SUM(status = 'hadir') AS hadir,
            SUM(status = 'izin') AS izin,
            SUM(status = 'sakit') AS sakit,
            SUM(status = 'alpha') AS alpha
        FROM presensi
        WHERE siswa_id = ?
    ", [$id])->row_array();

    if (!$data) {
        $data = [
            'total_pertemuan' => 0,
            'hadir' => 0,
            'izin' => 0,
            'sakit' => 0,
            'alpha' => 0
        ];
    }

    echo json_encode(['success' => true, 'data' => $data]);
}



    // =======================
    // HAPUS SISWA
    // =======================
    public function hapus_siswa($id)
    {
        $guru_id = $this->session->userdata('guru_id');
        if (!$guru_id) {
            show_error('Akses ditolak. Anda bukan wali kelas.');
            return;
        }

        $siswa = $this->db->get_where('siswa', ['id' => $id])->row_array();
        if (!$siswa) {
            $this->session->set_flashdata('error', 'Data siswa tidak ditemukan.');
            redirect('walikelas/data_kelas');
            return;
        }

        $this->db->delete('siswa', ['id' => $id]);
        $this->session->set_flashdata('success', 'Data siswa berhasil dihapus.');
        redirect('walikelas/data_kelas');
    }

    // =======================
// HALAMAN KIRIM PENGUMUMAN
// =======================
public function kirim_pengumuman()
{
    $guru_id = $this->session->userdata('guru_id');
    if (!$guru_id) {
        show_error('Akses ditolak. Anda bukan wali kelas.');
        return;
    }

    // ambil kelas yang diampu guru
    $data['kelas'] = $this->Walikelas_model->getKelasByWali($guru_id);
    $this->load->view('walikelas/kirim_pengumuman', $data);
}

public function simpan_pengumuman()
{
    $this->output->set_content_type('application/json');
    $judul = $this->input->post('judul');
    $isi = $this->input->post('isi');
    $status = $this->input->post('status');
    $id_kelas = $this->input->post('id_kelas');
    $dibuat_oleh = $this->session->userdata('guru_id');

    if (!$judul || !$isi) {
        echo json_encode(['success' => false, 'message' => 'Judul dan isi harus diisi']);
        return;
    }

    // Simpan file jika ada
    $lampiran = null;
    if (!empty($_FILES['lampiran']['name'])) {
        $config['upload_path'] = './uploads/pengumuman/';
        $config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg|png';
        $config['max_size'] = 5120; // 5MB
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('lampiran')) {
            $lampiran = $this->upload->data('file_name');
        } else {
            echo json_encode(['success' => false, 'message' => $this->upload->display_errors()]);
            return;
        }
    }

    $data = [
        'judul' => $judul,
        'isi' => $isi,
        'lampiran' => $lampiran,
        'tanggal_pembuatan' => date('Y-m-d H:i:s'),
        'dibuat_oleh' => $dibuat_oleh,
        'status' => $status,
        'id_kelas' => $status == 'kelas' ? $id_kelas : null
    ];

    $insert = $this->db->insert('pengumuman', $data);

    echo json_encode(['success' => $insert ? true : false, 'message' => $insert ? 'Pengumuman berhasil dikirim' : 'Gagal mengirim pengumuman']);
}

// =======================
// AMBIL RIWAYAT PENGUMUMAN
// =======================
public function get_riwayat_pengumuman()
{
    $this->output->set_content_type('application/json');

    $guru_id = $this->session->userdata('guru_id');
    if (!$guru_id) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
        return;
    }

    // Ambil semua pengumuman milik guru ini (umum dan kelas)
    $this->db->select('id, judul, isi, lampiran, tanggal_pembuatan, status');
    $this->db->from('pengumuman');
    $this->db->where('dibuat_oleh', $guru_id);
    $this->db->order_by('tanggal_pembuatan', 'DESC');
    $result = $this->db->get()->result_array();

    echo json_encode(['success' => true, 'data' => $result]);
}

    // =======================
// HALAMAN KIRIM PENGUMUMAN
// =======================
public function administrasi_kelas()
{
    $guru_id = $this->session->userdata('guru_id');
    if (!$guru_id) {
        show_error('Akses ditolak. Anda bukan wali kelas.');
        return;
    }

    // ambil kelas yang diampu guru
    $data['kelas'] = $this->Walikelas_model->getKelasByWali($guru_id);
    $this->load->view('walikelas/administrasi_kelas', $data);
}

// =======================
// HALAMAN LAPOR PERKEMBANGAN
// =======================
public function lapor_perkembangan()
{
    $guru_id = $this->session->userdata('guru_id');
    if (!$guru_id) {
        show_error('Akses ditolak. Anda bukan wali kelas.');
        return;
    }

    // ambil data siswa kelas wali
    $kelas = $this->Walikelas_model->getKelasByWali($guru_id);
    $data['siswa_kelas'] = $this->Walikelas_model->getSiswaKelas($kelas['id']);

    $this->load->view('walikelas/lapor_perkembangan', $data);
}

// =======================
// HALAMAN LAPORAN
// =======================
public function laporan()
{
    $guru_id = $this->session->userdata('guru_id');
    if (!$guru_id) {
        show_error('Akses ditolak. Anda bukan wali kelas.');
        return;
    }

    // ambil data laporan sederhana (nanti bisa diubah ke query real)
    $kelas = $this->Walikelas_model->getKelasByWali($guru_id);
    $data['laporan'] = $this->Walikelas_model->getLaporanKelas($kelas['id']); // sementara nanti bisa disesuaikan

    $this->load->view('walikelas/laporan', $data);
}

}

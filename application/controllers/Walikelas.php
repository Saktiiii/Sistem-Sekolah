<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Walikelas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Walikelas_model');
$this->load->model('User_model');
$data['available_users'] = $this->User_model->get_available_siswa_users();

    }

    public function data_kelas()
    {
        // Ambil ID guru dari sesi login
        $guru_id = $this->session->userdata('guru_id') ?? 1;

        // Ambil data kelas wali
        $kelas = $this->Walikelas_model->getKelasByWali($guru_id);

        if (!$kelas) {
            $data['kelas'] = null;
            $this->load->view('walikelas/data_kelas', $data);
            return;
        }

        $kelas_id = $kelas['id'];

        // Ambil data siswa, nilai, dan absensi
        $data['kelas'] = $kelas;
        $data['siswa_kelas'] = $this->Walikelas_model->getSiswaKelas($kelas_id);
        $data['siswa_berprestasi'] = $this->Walikelas_model->getSiswaBerprestasi($kelas_id);
        $data['siswa_bermasalah'] = $this->Walikelas_model->getSiswaBermasalah($kelas_id);
        $data['rekap_absensi'] = $this->Walikelas_model->getRekapAbsensi($kelas_id);

        $this->load->view('walikelas/data_kelas', $data);
    }

    // Endpoint untuk ambil detail siswa (dipakai di showStudentInfo)
    public function get_detail_siswa($id)
    {
        $data = $this->Walikelas_model->getDetailSiswa($id);

        if ($data) {
            echo json_encode(['success' => true, 'data' => $data]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
    public function hapus_siswa($id)
{
    // Pastikan user wali kelas
    $guru_id = $this->session->userdata('guru_id');
    if (!$guru_id) {
        show_error('Akses ditolak. Anda bukan wali kelas.');
        return;
    }

    // Cek data siswa
    $siswa = $this->db->get_where('siswa', ['id' => $id])->row_array();
    if (!$siswa) {
        $this->session->set_flashdata('error', 'Data siswa tidak ditemukan.');
        redirect('walikelas/data_kelas');
        return;
    }

    // Hapus data siswa
    $this->db->delete('siswa', ['id' => $id]);

    // Pesan sukses
    $this->session->set_flashdata('success', 'Data siswa berhasil dihapus.');
    redirect('walikelas/data_kelas');
}

public function tambah_siswa()
{
    $this->output->set_content_type('application/json');
    $this->load->model('Siswa_model');
    $this->load->model('Walikelas_model');

    $guru_id = $this->session->userdata('guru_id') ?? $this->session->userdata('user_id');
    $kelas = $this->Walikelas_model->getKelasByWali($guru_id);

    if (!$kelas) {
        echo json_encode(['success' => false, 'message' => 'Anda bukan wali kelas']);
        return;
    }

    $data = [
        'users_id'       => $this->input->post('users_id'),
        'nama'          => $this->input->post('nama'),
        'nis'           => $this->input->post('nis'),
        'alamat'        => $this->input->post('alamat'),
        'telepon'       => $this->input->post('telepon'),
        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
        'kelas_id'      => $kelas['id']
    ];

    if (empty($data['users_id'])) {
        echo json_encode(['success' => false, 'message' => 'User belum dipilih']);
        return;
    }

    $insert = $this->Siswa_model->insert($data);

    if ($insert) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menambah siswa']);
    }
}



}

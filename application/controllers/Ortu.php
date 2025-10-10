<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ortu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'ortu') {
        //     redirect('auth');
        // }

        // load model
        $this->load->model('Pengumuman_model', 'pengumuman');
        $this->load->model('Ortu_model');
    }

    public function dashboard()
    {
        $this->load->view('ortu/dashboard');
    }

    public function data_siswa()
    {
        $this->load->model('Ortu_model');
        $data['siswa'] = $this->Ortu_model->get_all();
        $this->load->view('ortu/data_siswa', $data);
    }

    // public function get_pengumuman()
    // {
    //     // panggil alias 'pengumuman'
    //     $data['pengumuman'] = $this->pengumuman->get_all();
    //     $this->load->view('ortu/pengumuman', $data);
    // }

    public function logout()
    {
        // Hapus semua session
        $this->session->sess_destroy();

        // Kembali ke halaman login
        redirect('auth');
    }

    // laporan
    public function laporan()
    {
        $data['siswa_bermasalah'] = $this->Ortu_model->get_siswa_bermasalah();
        $this->load->view('ortu/laporan', $data);
    }

    public function detail($id)
    {
        $data['siswa'] = $this->Ortu_model->get_detail_siswa($id);
        $this->load->view('ortu/laporan_detail', $data);
    }

    // daftar absensi
    public function absensi()
    {
        $data['title'] = 'Daftar Absensi Siswa';
        $data['absensi'] = $this->Ortu_model->get_all_absensi();

        $this->load->view('ortu/absensi', $data);
    }
    // komunikasi
    public function komunikasi($orang_tua_id = 1)
    {
        // Ambil data orang tua
        $orang_tua = $this->Ortu_model->getOrangTua($orang_tua_id);

        // Ambil siswa yang terkait dengan orang tua tersebut
        $siswa = $this->Ortu_model->getSiswa($orang_tua->siswa_id);

        // Ambil guru (wali kelas) berdasarkan kelas_id dari siswa
        $guru = $this->Ortu_model->getGuru($siswa->kelas_id);

        $data['orang_tua'] = $orang_tua;
        $data['siswa'] = $siswa;
        $data['guru'] = $guru;
        $data['pesan'] = $this->Ortu_model->getPesan($orang_tua->id, $guru->id, $siswa->id);

        $this->load->view('ortu/komunikasi', $data);
    }

    public function kirim()
    {
        $orang_tua_id = $this->input->post('orang_tua_id');
        $guru_id = $this->input->post('guru_id');
        $siswa_id = $this->input->post('siswa_id');
        $isi = $this->input->post('isi');

        $data = [
            'orang_tua_id' => $orang_tua_id,
            'guru_id' => $guru_id,
            'siswa_id' => $siswa_id,
            'pengirim' => 'orang_tua', // nanti bisa 'guru' jika guru login
            'isi' => $isi
        ];

        $this->Ortu_model->kirimPesan($data);
        redirect('ortu/komunikasi/' . $orang_tua_id);
    }
    public function pengumuman()
    {
        // Ambil ID user yang sedang login
        $user_id = $this->session->userdata('user_id');

        // Ambil data orang tua berdasarkan user_id
        $orang_tua = $this->Ortu_model->get_by_user($user_id);

        // Pastikan data orang tua ditemukan
        if (!$orang_tua) {
            show_error('Data orang tua tidak ditemukan.');
            return;
        }

        // Ambil data wali kelas berdasarkan id_ortu
        $guru = $this->Ortu_model->get_wali_kelas($orang_tua->id);

        // Ambil data pengumuman
        $pengumuman = $this->Ortu_model->get_pengumuman();

        // Kirim semua data ke view
        $data = [
            'orang_tua' => $orang_tua,
            'guru' => $guru,
            'pengumuman' => $pengumuman
        ];

        $this->load->view('ortu/pengumuman', $data);
    }

}

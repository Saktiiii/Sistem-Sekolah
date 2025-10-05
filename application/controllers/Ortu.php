<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ortu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'ortu') {
            redirect('auth');
        }

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
        $this->load->model('Siswa_model');
        $data['siswa'] = $this->Siswa_model->get_all();
        $this->load->view('ortu/data_siswa', $data);
    }

    public function pengumuman()
    {
        // panggil alias 'pengumuman'
        $data['pengumuman'] = $this->pengumuman->get_all();
        $this->load->view('ortu/pengumuman', $data);
    }

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
}

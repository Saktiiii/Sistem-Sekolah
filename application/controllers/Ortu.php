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
        $user_id = $this->session->userdata('user_id'); // 6
        $orang_tua = $this->Ortu_model->get_by_user($user_id);
        $siswa = $this->Ortu_model->get_siswa_by_ortu($orang_tua->id);

        // 1. Ambil user_id dari session (ortu yang login)
        $user_id = $this->session->userdata('user_id');

        // 2. Ambil data orang tua berdasarkan user_id
        $orang_tua = $this->Ortu_model->get_by_user($user_id);

        if (!$orang_tua) {
            show_error('Data orang tua tidak ditemukan.');
            return;
        }

        // 3. Ambil data siswa sesuai ID orang tua
        $siswa = $this->Ortu_model->get_siswa_by_ortu($orang_tua->id);

        // 4. Siapkan data dashboard anak
        $dashboard = [
            'peringkat' => '-',
            'total_siswa' => '-',
            'total_absensi' => 0
        ];

        if ($siswa) {
            // Ambil peringkat & total siswa di kelas
            // Ambil total absensi anak
            $dashboard = $this->Ortu_model->get_dashboard_anak($siswa->id, $siswa->kelas_id);
        }

        // 5. Kirim data ke view
        $data = [
            'orang_tua' => $orang_tua,
            'siswa' => $siswa,
            'dashboard' => $dashboard
        ];

        $this->load->view('ortu/dashboard', $data);
    }



    public function data_siswa()
    {
        $this->load->model('Ortu_model');
        $data['siswa'] = $this->Ortu_model->get_all();
        $this->load->view('ortu/data_siswa', $data);
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
        // 1. Ambil ID user yang sedang login
        $user_id = $this->session->userdata('user_id');

        // 2. Ambil data orang tua
        $orang_tua = $this->Ortu_model->get_by_user($user_id);
        if (!$orang_tua) {
            show_error('Data orang tua tidak ditemukan.');
            return;
        }

        // 3. Ambil data siswa (opsional, jika ingin tampil di view)
        $siswa = $this->Ortu_model->get_siswa_by_ortu($orang_tua->id);

        // 4. Ambil pengumuman umum saja
        $pengumuman = $this->Ortu_model->get_pengumuman_umum();

        // 5. Kirim data ke view
        $data = [
            'orang_tua' => $orang_tua,
            'siswa' => $siswa,
            'pengumuman' => $pengumuman
        ];

        $this->load->view('ortu/pengumuman', $data);
    }

}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model');
        $this->load->model('Guru_model');
        $this->load->model('Akademik_model');
        $this->load->model('Jadwal_model');
        $this->load->model('Kelas_model');
        $this->load->model('Nilai_model');
        $this->load->model('Materi_model');
        $this->load->model('Laporan_model');
        $this->load->model('Pengumuman_model');

        // Absensi model baru
        $this->load->model('Absensi_model');

        $this->load->library('session');
        $this->load->helper(array('url', 'security', 'form'));
        $this->load->database();
    }
    public function index()
    {
        if ($this->session->userdata('logged_in') && $this->session->userdata('role') === 'guru') {
            redirect('guru/akademik');
            return;
        }
        $this->load->view('auth/login');
    }
    // AKADEMIK (halaman utama)
    public function akademik()
    {
        $guru_id = $this->session->userdata('guru_id');

        // Data dari model
        $data['jadwal'] = $this->Guru_model->get_jadwal_mengajar($guru_id);
        $data['kelas'] = $this->Guru_model->get_kelas_guru($guru_id);
        $data['materi'] = $this->Guru_model->get_materi_guru($guru_id);
        $data['tugas'] = $this->Guru_model->get_tugas_guru($guru_id);
        $data['tahun_aktif'] = $this->Guru_model->get_tahun_ajaran_aktif();

        $this->load->view('guru/akademik', $data);
    }
    public function simpan_nilai()
    {
        $data = [
            'siswa_id' => $this->input->post('siswa_id'),
            'mata_pelajaran_id' => $this->input->post('mata_pelajaran_id'),
            'kelas_id' => $this->input->post('kelas_id'),
            'guru_id' => $this->session->userdata('guru_id'),
            'tahun_ajaran_id' => $this->input->post('tahun_ajaran_id'),
            'nilai_uts' => $this->input->post('nilai_uts'),
            'nilai_uas' => $this->input->post('nilai_uas'),
            'nilai_tugas' => $this->input->post('nilai_tugas'),
            'nilai_total' => ($this->input->post('nilai_uts') + $this->input->post('nilai_uas') + $this->input->post('nilai_tugas')) / 3
        ];
        $this->Guru_model->insert_nilai($data);
        redirect('guru/akademik');
    }
    public function upload_materi()
    {
        $data = [
            'guru_id' => $this->session->userdata('guru_id'),
            'kelas_id' => $this->input->post('kelas_id'),
            'mata_pelajaran_id' => $this->input->post('mata_pelajaran_id'),
            'judul' => $this->input->post('judul'),
            'deskripsi' => $this->input->post('deskripsi'),
            'link_video' => $this->input->post('link_video'),
        ];

        if (!empty($_FILES['file']['name'])) {
            $config['upload_path'] = './uploads/materi/';
            $config['allowed_types'] = 'pdf|ppt|pptx|doc|docx';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $data['file'] = $this->upload->data('file_name');
            }
        }

        $this->Guru_model->insert_materi($data);
        redirect('guru/akademik');
    }

    public function upload_tugas()
    {
        $data = [
            'guru_id' => $this->session->userdata('guru_id'),
            'kelas_id' => $this->input->post('kelas_id'),
            'mata_pelajaran_id' => $this->input->post('mata_pelajaran_id'),
            'judul' => $this->input->post('judul'),
            'deskripsi' => $this->input->post('deskripsi'),
            'batas_pengumpulan' => $this->input->post('batas_pengumpulan')
        ];

        if (!empty($_FILES['file']['name'])) {
            $config['upload_path'] = './uploads/tugas/';
            $config['allowed_types'] = 'pdf|doc|docx';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $data['file'] = $this->upload->data('file_name');
            }
        }

        $this->Guru_model->insert_tugas($data);
        redirect('guru/akademik');
    }

    // Ekstrakurikuler
    public function ekstrakurikuler()
    {
        $guru_id = $this->session->userdata('guru_id');

        // Ambil semua ekskul yang dibina guru
        $data['ekskul'] = $this->Guru_model->get_ekskul_by_guru($guru_id);
        $data['anggota'] = [];
        $data['penghargaan'] = [];
        $data['jadwal'] = [];

        // Jika user memilih salah satu ekskul
        $ekskul_id = $this->input->get('id');
        if ($ekskul_id) {
            $data['anggota'] = $this->Guru_model->get_anggota_ekskul($ekskul_id);
            $data['penghargaan'] = $this->Guru_model->get_penghargaan_ekskul($ekskul_id);
            $data['jadwal'] = $this->Guru_model->get_jadwal_ekskul($ekskul_id);
        }

        $this->load->view('guru/ekstrakurikuler', $data);
    }
    // Tambah data
    public function tambah_anggota()
    {
        $data = [
            'ekskul_id' => $this->input->post('ekskul_id'),
            'siswa_id' => $this->input->post('siswa_id'),
            'jabatan' => $this->input->post('jabatan')
        ];
        $this->Guru_model->tambah_anggota($data);
        redirect('guru/ekstrakurikuler?id=' . $data['ekskul_id']);
    }

    public function tambah_penghargaan()
    {
        $data = [
            'ekskul_id' => $this->input->post('ekskul_id'),
            'nama_penghargaan' => $this->input->post('nama_penghargaan'),
            'tingkat' => $this->input->post('tingkat'),
            'tahun' => $this->input->post('tahun'),
            'keterangan' => $this->input->post('keterangan')
        ];
        $this->Guru_model->tambah_penghargaan($data);
        redirect('guru/ekstrakurikuler?id=' . $data['ekskul_id']);
    }

    public function tambah_jadwal()
    {
        $data = [
            'ekskul_id' => $this->input->post('ekskul_id'),
            'hari' => $this->input->post('hari'),
            'jam_mulai' => $this->input->post('jam_mulai'),
            'jam_selesai' => $this->input->post('jam_selesai'),
            'tempat' => $this->input->post('tempat')
        ];
        $this->Guru_model->tambah_jadwal($data);
        redirect('guru/ekstrakurikuler?id=' . $data['ekskul_id']);
    }
    // laporan
    // Rekap Nilai Kelas
    public function laporan()
    {
        $kelas_id = $this->input->get('kelas_id'); // Ambil dari GET

        $data['kelas'] = $this->Guru_model->get_all_kelas();
        if ($kelas_id) {
            $data['nilai'] = $this->Guru_model->get_nilai_by_kelas($kelas_id);
            $data['selected_kelas'] = $kelas_id;
        } else {
            $data['nilai'] = [];
            $data['selected_kelas'] = null;
        }

        $this->load->view('guru/laporan', $data);
    }

    // Laporan Absensi
    public function laporan_absensi()
    {
        $kelas_id = $this->input->get('kelas_id'); // ambil dari GET

        $data['kelas'] = $this->Guru_model->get_all_kelas();
        if ($kelas_id) {
            $data['absensi'] = $this->Guru_model->get_absensi_by_kelas($kelas_id);
            $data['selected_kelas'] = $kelas_id;
        } else {
            $data['absensi'] = [];
            $data['selected_kelas'] = null;
        }

        $this->load->view('guru/laporan', $data);
    }

    // Laporan Tugas
    public function laporan_tugas()
    {
        $kelas_id = $this->input->get('kelas_id'); // ambil dari GET

        $data['kelas'] = $this->Guru_model->get_all_kelas();
        if ($kelas_id) {
            $data['tugas'] = $this->Guru_model->get_tugas_by_kelas($kelas_id);
            $data['selected_kelas'] = $kelas_id;
        } else {
            $data['tugas'] = [];
            $data['selected_kelas'] = null;
        }

        $this->load->view('guru/laporan', $data);
    }

    // absensi guru
    // Form absen
    public function absensi() {
        $data['absensi'] = $this->Guru_model->get_all_absensi();
        $this->load->view('guru/absensi', $data);
    }
    // Simpan absen
    public function absen() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('waktu', 'Waktu', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'nip' => $this->input->post('nip'),
                'tanggal' => $this->input->post('tanggal'),
                'waktu' => $this->input->post('waktu'),
            ];

            $this->Guru_model->insert_absen($data);
            $this->session->set_flashdata('success', 'Absensi berhasil disimpan');
            redirect('absensi_guru');
        }
    }
    // Halaman utama semua absensi
    // public function lihat_absensi()
    // {
    //     $data['title'] = 'Daftar Absensi Guru';
    //     $data['absensi'] = $this->AbsensiGuru_model->get_all_absensi();
    //     $data['guru'] = $this->AbsensiGuru_model->get_all_guru();
    //     $this->load->view('guru/absensi', $data);
    // }

    // Lihat absensi berdasarkan guru
    public function by_guru($nip)
    {
        $data['title'] = 'Absensi Guru';
        $data['absensi'] = $this->AbsensiGuru_model->get_absensi_by_guru($nip);
        $this->load->view('guru/absensi', $data);
    }


    public function tambah_siswa()
    {
        if ($_POST) {
            $siswa_data = array(
                'nis' => $this->input->post('nis'),
                'nama' => $this->input->post('nama'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'kelas_id' => $this->input->post('kelas_id'),
                'alamat' => $this->input->post('alamat'),
                'telepon' => $this->input->post('telepon')
            );

            $this->Akademik_model->add_siswa($siswa_data);
            redirect('guru/ekskul');
        }
    }

    public function tambah_ekskul()
    {
        if ($_POST) {
            $data = array(
                'nama_ekskul' => $this->input->post('nama_ekskul'),
                'jumlah_anggota' => $this->input->post('jumlah_anggota'),
                'jumlah_penghargaan' => $this->input->post('jumlah_penghargaan'),
                'penghargaan_terakhir' => $this->input->post('penghargaan_terakhir'),
                'status' => $this->input->post('status')
            );

            $this->Akademik_model->add_ekskul($data);
            redirect('guru/ekskul');
        }
    }

    public function hapus_ekskul($id)
    {
        $this->Akademik_model->delete_ekskul($id);
        redirect('guru/ekskul');
    }

    // -------------------------
    // SISWA BY KELAS (mengambil username dari tabel users)
    // -------------------------
    public function siswa_by_kelas($kelas_id = null)
    {
        header('Content-Type: application/json; charset=utf-8');

        if (!$this->session->userdata('logged_in')) {
            http_response_code(401);
            echo json_encode(['error' => 'not authorized']);
            return;
        }
        if (!$kelas_id) {
            echo json_encode([]);
            return;
        }

        $kelas_id = (int) $kelas_id;
        $this->db->select('s.id, s.nis, s.nama, s.jenis_kelamin, u.username');
        $this->db->from('siswa s');
        $this->db->join('users u', 's.users_id = u.id', 'left');
        $this->db->where('s.kelas_id', $kelas_id);
        $this->db->order_by('s.nama', 'ASC');
        $siswa = $this->db->get()->result();

        echo json_encode($siswa);
    }

    // -------------------------
    // NILAI APIs (get, update, delete)
    // -------------------------
    public function get_nilai($siswa_id)
    {
        header('Content-Type: application/json; charset=utf-8');

        if (!$this->session->userdata('logged_in')) {
            http_response_code(401);
            echo json_encode(['error' => 'not authorized']);
            return;
        }

        $this->db->where('siswa_id', $siswa_id);
        $nilai = $this->db->get('nilai')->row();

        if ($nilai) {
            echo json_encode($nilai);
        } else {
            echo json_encode(new stdClass());
        }
    }

    public function update_nilai()
    {
        header('Content-Type: application/json; charset=utf-8');

        if ($this->input->method() !== 'post' || !$this->session->userdata('logged_in')) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Bad request']);
            return;
        }

        $siswa_id = $this->input->post('siswa_id', TRUE);
        $nilai_value = $this->input->post('nilai', TRUE);
        $keterangan = $this->input->post('keterangan', TRUE);
        $tahun_ajaran = $this->input->post('tahun_ajaran', TRUE);

        if (!$siswa_id) {
            echo json_encode(['status' => 'error', 'message' => 'siswa_id dibutuhkan']);
            return;
        }

        // Cek apakah nilai sudah ada
        $this->db->where('siswa_id', $siswa_id);
        $existing_nilai = $this->db->get('nilai')->row();

        $data = [
            'siswa_id' => $siswa_id,
            'mata_pelajaran_id' => 1, // default, ubah jika perlu
            'semester' => 'Ganjil',
            'tahun_ajaran' => $tahun_ajaran ? $tahun_ajaran : '2025/2026',
            'nilai_uts' => $nilai_value,
            'nilai_uas' => $nilai_value,
            'nilai_tugas' => $nilai_value,
            'nilai_total' => $nilai_value,
            'keterangan' => $keterangan,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($existing_nilai) {
            // Update nilai yang sudah ada
            $this->db->where('siswa_id', $siswa_id);
            $result = $this->db->update('nilai', $data);
        } else {
            // Insert nilai baru
            $data['created_at'] = date('Y-m-d H:i:s');
            $result = $this->db->insert('nilai', $data);
        }

        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan nilai']);
        }
    }

    public function delete_nilai($siswa_id)
    {
        header('Content-Type: application/json; charset=utf-8');

        if (!$this->session->userdata('logged_in')) {
            http_response_code(401);
            echo json_encode(['status' => 'error', 'message' => 'not authorized']);
            return;
        }

        if (!$siswa_id) {
            echo json_encode(['status' => 'error', 'message' => 'siswa_id dibutuhkan']);
            return;
        }

        $this->db->where('siswa_id', $siswa_id);
        $result = $this->db->delete('nilai');

        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus nilai']);
        }
    }

    // -------------------------
    // PENGUMUMAN (view + API)
    // -------------------------
    // tampilkan halaman pengumuman (view)
// Halaman utama daftar pengumuman
    public function pengumuman()
    {
        $guru_id = $this->session->userdata('guru_id'); // pastikan session ini terset
        $data['pengumuman'] = $this->Guru_model->get_pengumuman_by_guru($guru_id);
        $data['kelas'] = $this->Guru_model->get_kelas();
        $this->load->view('guru/pengumuman', $data);
    }

    // Simpan pengumuman baru
    public function simpan_pengumuman()
    {
        $guru_id = $this->session->userdata('guru_id');

        $data = [
            'judul' => $this->input->post('judul'),
            'isi' => $this->input->post('isi'),
            'tanggal_pembuatan' => date('Y-m-d H:i:s'),
            'dibuat_oleh' => $guru_id,
            'status' => $this->input->post('status'),
            'id_kelas' => $this->input->post('status') == 'kelas' ? $this->input->post('id_kelas') : NULL
        ];

        $this->Guru_model->tambah_pengumuman($data);
        redirect('guru/pengumuman');
    }

    // Hapus pengumuman
    public function hapus_pengumuman($id)
    {
        $guru_id = $this->session->userdata('guru_id');
        $this->Guru_model->hapus_pengumuman($id, $guru_id);
        redirect('guru/pengumuman');
    }
}
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
    public function laporan_nilai($kelas_id = null) {
        $data['kelas'] = $this->Kelas_model->get_all();
        if ($kelas_id) {
            $data['nilai'] = $this->Laporan_model->get_nilai_by_kelas($kelas_id);
            $data['selected_kelas'] = $kelas_id;
        } else {
            $data['nilai'] = [];
            $data['selected_kelas'] = null;
        }
        $this->load->view('guru/laporan', $data);
    }
    // Laporan Absensi
    public function laporan_absensi($kelas_id = null) {
        $data['kelas'] = $this->Kelas_model->get_all();
        if ($kelas_id) {
            $data['absensi'] = $this->Laporan_model->get_absensi_by_kelas($kelas_id);
            $data['selected_kelas'] = $kelas_id;
        } else {
            $data['absensi'] = [];
            $data['selected_kelas'] = null;
        }
        $this->load->view('guru/laporan', $data);
    }
     // Laporan Tugas
    public function laporan_tugas($kelas_id = null) {
        $data['kelas'] = $this->Kelas_model->get_all();
        if ($kelas_id) {
            $data['tugas'] = $this->Laporan_model->get_tugas_by_kelas($kelas_id);
            $data['selected_kelas'] = $kelas_id;
        } else {
            $data['tugas'] = [];
            $data['selected_kelas'] = null;
        }
        $this->load->view('guru/laporan', $data);
    }


    // -------------------------
    // ABSENSI (oleh Guru untuk Siswa)
    // -------------------------
    public function absensi()
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'guru') {
            $this->session->set_flashdata('error', 'Silakan login dulu.');
            redirect('guru');
            return;
        }

        $guru_id = $this->session->userdata('guru_id');
        $kelas_id = $this->input->get('kelas_id') ? (int) $this->input->get('kelas_id') : null;
        $tanggal = $this->input->get('tanggal') ? $this->input->get('tanggal') : date('Y-m-d');

        // ambil daftar siswa (filter berdasarkan kelas jika diberikan)
        $this->db->select('s.*');
        $this->db->from('siswa s');
        if ($kelas_id)
            $this->db->where('s.kelas_id', $kelas_id);
        $this->db->order_by('s.nama', 'ASC');
        $students = $this->db->get()->result();

        // ambil absensi (model mendeteksi tabel absensi yang tersedia)
        $absensis = $this->Absensi_model->get_attendance($kelas_id, $tanggal);

        $data = [
            'username' => $this->session->userdata('username'),
            'guru' => $this->Guru_model->get_by_user_id($this->session->userdata('user_id')),
            'students' => $students,
            'absensis' => $absensis,
            'selected_kelas_id' => $kelas_id,
            'selected_tanggal' => $tanggal,
            'profile_logo' => 'assets/image/logosmk.png'
        ];

        // view berada di views/guru/absensi.php
        $this->load->view('guru/absensi', $data);
    }

    /**
     * Proses submit absen siswa oleh guru (insert atau update tergantung existing record)
     * Form POST harus mengirim minimal: siswa_id, tanggal, status (optional), waktu (optional), kelas_id (optional)
     */
    public function absen_submit()
    {
        if ($this->input->method() !== 'post' || !$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'Permintaan tidak valid.');
            redirect('guru/absensi');
            return;
        }

        $siswa_id = $this->input->post('siswa_id', TRUE);
        $kelas_id = $this->input->post('kelas_id', TRUE);
        $tanggal = $this->input->post('tanggal', TRUE) ? date('Y-m-d', strtotime($this->input->post('tanggal', TRUE))) : date('Y-m-d');
        $status = $this->input->post('status', TRUE) ? $this->input->post('status', TRUE) : 'Hadir';
        $waktu = $this->input->post('waktu', TRUE); // bisa diisi jam datang/pulang

        if (!$siswa_id) {
            $this->session->set_flashdata('error', 'Pilih siswa terlebih dahulu.');
            redirect('guru/absensi');
            return;
        }

        // Cek record hari ini untuk siswa tersebut
        $existing = $this->Absensi_model->get_by_student_and_date($siswa_id, $tanggal);

        // Siapkan payload umum (model hanya akan menyimpan kolom yang ada pada tabel)
        $payload = [
            'siswa_id' => $siswa_id,
            'guru_id' => $this->session->userdata('guru_id'),
            'kelas_id' => $kelas_id,
            'tanggal' => $tanggal,
            'status' => $status,
        ];

        // jika ada waktu (time) kirim sebagai 'datang' dan juga 'pulang' bergantung param 'action'
        // supaya fleksibel, terima param 'action' = 'datang' atau 'pulang' (default: datang)
        $action = $this->input->post('action', TRUE) ? $this->input->post('action', TRUE) : 'datang';
        if ($waktu) {
            if ($action === 'pulang') {
                $payload['pulang'] = $waktu;
            } else {
                // default set datang
                $payload['datang'] = $waktu;
            }
        }

        if ($existing) {
            // update
            $this->Absensi_model->update($existing->id, $payload);
            $this->session->set_flashdata('success', 'Absensi siswa berhasil diperbarui.');
        } else {
            // insert
            $this->Absensi_model->insert($payload);
            $this->session->set_flashdata('success', 'Absensi siswa berhasil dicatat.');
        }

        redirect('guru/absensi?kelas_id=' . ($kelas_id ? $kelas_id : '') . '&tanggal=' . $tanggal);
    }


    // -------------------------
    // EKS KUL (dari kode Anda)
    // -------------------------
    public function ekskul()
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'guru') {
            $this->session->set_flashdata('error', 'Silakan login dulu.');
            redirect('auth');
            return;
        }

        $guru = $this->Guru_model->get_by_user_id($this->session->userdata('user_id'));

        if (!is_object($guru) || empty($guru->nama)) {
            $guru = (object) [
                'nama' => $this->session->userdata('username') ?? 'Guru',
                'nip' => '',
            ];
        }

        $data = [
            'guru' => $guru,
            'total_siswa' => $this->Akademik_model->get_total_siswa(),
            'active_siswa' => $this->Akademik_model->get_active_siswa_count(),
            'popular_ekskul' => $this->Akademik_model->get_popular_ekskul(),
            'siswa_list' => $this->Akademik_model->get_all_siswa_with_ekskul(),
            'ekskul_list' => $this->Akademik_model->get_all_ekskul(),
            'kelas_list' => $this->Akademik_model->get_all_kelas(),
        ];

        $this->load->view('guru/ekskul', $data);
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
    // JADWAL API (menggunakan guru_id dari session)
    // -------------------------
    public function jadwal_api()
    {
        header('Content-Type: application/json; charset=utf-8');

        if (!$this->session->userdata('logged_in')) {
            http_response_code(401);
            echo json_encode(['error' => 'not authorized']);
            return;
        }

        $hari = $this->input->get('hari') ? $this->input->get('hari') : null;
        $guru_id = $this->session->userdata('guru_id');

        if (!$guru_id) {
            echo json_encode([]);
            return;
        }

        // gunakan method Anda jika ada: get_jadwal_by_guru
        if (method_exists($this->Jadwal_model, 'get_jadwal_by_guru')) {
            $jadwal = $this->Jadwal_model->get_jadwal_by_guru($guru_id, $hari);
        } else {
            // fallback generic: cari di tabel jadwal
            $this->db->select('jadwal.*, kelas.nama as kelas, mata_pelajaran.nama as mata_pelajaran');
            $this->db->from('jadwal');
            $this->db->join('kelas', 'kelas.id=jadwal.kelas_id', 'left');
            $this->db->join('mata_pelajaran', 'mata_pelajaran.id=jadwal.mata_pelajaran_id', 'left');
            $this->db->where('jadwal.guru_id', $guru_id);
            if ($hari)
                $this->db->where('jadwal.hari', $hari);
            $this->db->order_by('jadwal.jam_mulai', 'ASC');
            $jadwal = $this->db->get()->result();
        }

        echo json_encode($jadwal);
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

    // -------------------------
    // LAPORAN
    // -------------------------
    public function laporan()
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'guru') {
            $this->session->set_flashdata('error', 'Silakan login dulu.');
            redirect('guru');
            return;
        }

        $this->load->model('Laporan_model');

        $kelas_list = $this->Laporan_model->get_kelas_list();

        // pilih kelas via GET parameter atau default pertama
        $kelas_id = $this->input->get('kelas_id') ? (int) $this->input->get('kelas_id') : (!empty($kelas_list) ? $kelas_list[0]->id : null);

        $siswa_list = [];
        $detail = []; // akan berisi data per siswa (nilai, avg, absensi, tugas)
        $kelas_info = null;

        if ($kelas_id) {
            $siswa_list = $this->Laporan_model->get_siswa_by_kelas($kelas_id);
            $kelas_info = $this->Laporan_model->get_kelas($kelas_id);

            foreach ($siswa_list as $s) {
                $nilai_rows = $this->Laporan_model->get_nilai_by_siswa($s->id);
                $avg = $this->Laporan_model->get_avg_by_siswa($s->id);
                $absensi = $this->Laporan_model->get_absensi_summary($s->id);
                $tugas = $this->Laporan_model->get_tugas_summary($s->id);

                $detail[$s->id] = [
                    'nilai_rows' => $nilai_rows,
                    'avg' => $avg,
                    'absensi' => $absensi,
                    'tugas' => $tugas
                ];
            }
        }

        $data = [
            'guru' => isset($this->guru) ? $this->guru : $this->Guru_model->get_by_user_id($this->session->userdata('user_id')),
            'kelas_list' => $kelas_list,
            'selected_kelas_id' => $kelas_id,
            'kelas_info' => $kelas_info,
            'siswa_list' => $siswa_list,
            'detail' => $detail
        ];

        $this->load->view('guru/laporan', $data);



    }
}
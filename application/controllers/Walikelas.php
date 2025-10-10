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


    public function get_jadwal_by_hari()
{
    $kelas_id = $this->input->get('kelas_id');
    $hari = $this->input->get('hari');
    
    $this->db->select('jadwal.id, mata_pelajaran.nama_mapel AS mata_pelajaran, guru.nama AS guru, jadwal.jam_mulai, jadwal.jam_selesai');
    $this->db->from('jadwal');
    $this->db->join('mata_pelajaran', 'mata_pelajaran.id = jadwal.mata_pelajaran_id', 'left');
    $this->db->join('guru', 'guru.id = jadwal.guru_id', 'left');
    $this->db->where('jadwal.kelas_id', $kelas_id);
    $this->db->where('jadwal.hari', $hari);
    $this->db->order_by('jadwal.jam_mulai', 'ASC');

    echo json_encode($this->db->get()->result_array());
}

public function hapus_jadwal($id)
{
    $hapus = $this->db->delete('jadwal', ['id' => $id]);
    echo json_encode([
        'success' => $hapus,
        'message' => $hapus ? '✅ Jadwal berhasil dihapus.' : '❌ Gagal menghapus jadwal.'
    ]);
}

    // =======================
    // DETAIL SISWA
    // =======================
    public function get_detail_siswa($id)
    {
        $data = $this->Walikelas_model->getDetailSiswa($id);
        echo json_encode(['success' => $data ? true : false, 'data' => $data]);
    }

    // =======================
    // TAMBAH SISWA
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
        echo json_encode([
            'success' => $insert ? true : false,
            'message' => $insert ? 'Siswa berhasil ditambahkan' : 'Gagal menambah siswa'
        ]);
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
    // GET ABSENSI SISWA
    // =======================
    public function get_absensi($id)
    {
        $this->output->set_content_type('application/json');

        $this->db->select('s.id, s.nama, a.total_pertemuan, a.hadir, a.izin, a.sakit, a.alpha');
        $this->db->from('siswa s');
        $this->db->join('absensi a', 'a.siswa_id = s.id', 'left');
        $this->db->where('s.id', $id);
        $data = $this->db->get()->row_array();

        echo json_encode(['success' => $data ? true : false, 'data' => $data]);
    }

    // =======================
    // UPDATE ABSENSI SISWA
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
    // UPDATE SISWA
    // =======================
    public function get_siswa($id)
    {
        $this->output->set_content_type('application/json');
        $siswa = $this->db->get_where('siswa', ['id' => $id])->row_array();
        echo json_encode(['success' => $siswa ? true : false, 'data' => $siswa]);
    }

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

    // =======================
    // REKAP ABSENSI SISWA
    // =======================
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
    // KIRIM PENGUMUMAN
    // =======================
    public function kirim_pengumuman()
    {
        $guru_id = $this->session->userdata('guru_id');
        if (!$guru_id) {
            show_error('Akses ditolak. Anda bukan wali kelas.');
            return;
        }

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

        $lampiran = null;
        if (!empty($_FILES['lampiran']['name'])) {
            $config['upload_path'] = './uploads/pengumuman/';
            $config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg|png';
            $config['max_size'] = 5120;
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
        echo json_encode(['success' => $insert ? true : false]);
    }

    public function get_riwayat_pengumuman()
    {
        $this->output->set_content_type('application/json');

        $guru_id = $this->session->userdata('guru_id');
        if (!$guru_id) {
            echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
            return;
        }

        $this->db->select('id, judul, isi, lampiran, tanggal_pembuatan, status');
        $this->db->from('pengumuman');
        $this->db->where('dibuat_oleh', $guru_id);
        $this->db->order_by('tanggal_pembuatan', 'DESC');
        $result = $this->db->get()->result_array();

        echo json_encode(['success' => true, 'data' => $result]);
    }

    // =======================
    // ADMINISTRASI KELAS (tabel jadwal)
    // =======================
public function administrasi_kelas()
{
    $guru_id = $this->session->userdata('guru_id');
    if (!$guru_id) {
        show_error('Akses ditolak. Anda bukan wali kelas.');
        return;
    }

    // 🔹 Ambil kelas berdasarkan wali
    $kelas = $this->Walikelas_model->getKelasByWali($guru_id);
    if (!$kelas) {
        show_error('Kelas tidak ditemukan untuk guru ini.');
        return;
    }

    $kelas_id = $kelas['id'];
    $hari = $this->input->get('hari');

    // ==========================
    // 🔹 Ambil data utama
    // ==========================
    $data['kelas'] = $kelas;
    $data['hari_terpilih'] = $hari;
    $data['jadwal'] = $this->Walikelas_model->getJadwal($kelas_id, $hari);
    $data['jadwal_piket'] = $this->Walikelas_model->getJadwalPiket($kelas_id);
    $data['kegiatan_kelas'] = $this->Walikelas_model->getKegiatanKelas($kelas_id);

    // ==========================
    // 🔹 Tambahan dropdown data
    // ==========================
    $data['mata_pelajaran'] = $this->db->get('mata_pelajaran')->result_array();
    $data['guru'] = $this->db->get('guru')->result_array();
    $data['siswa'] = $this->db->get('siswa')->result_array(); // untuk dropdown piket

    // ==========================
    // 🔹 Fallback jika data kosong
    // ==========================
    if (!isset($data['jadwal'])) $data['jadwal'] = [];
    if (!isset($data['jadwal_piket'])) $data['jadwal_piket'] = [];
    if (!isset($data['kegiatan_kelas'])) $data['kegiatan_kelas'] = [];

    // ==========================
    // 🔹 Ambil data jadwal piket terpisah (kelas & lab)
    // ==========================
    $this->load->model('Jadwal_piket_model');
    $data['piket_kelas'] = $this->Jadwal_piket_model->get_by_kelas($kelas_id, 'kelas');
    $data['piket_lab']   = $this->Jadwal_piket_model->get_by_kelas($kelas_id, 'lab');

    // ==========================
    // 🔹 Tampilkan halaman view
    // ==========================
    $this->load->view('walikelas/administrasi_kelas', $data);
}

public function tambah_piket()
{
    $this->load->model('Jadwal_piket_model');

    $data = [
        'kelas_id' => $this->input->post('kelas_id'),
        'hari' => $this->input->post('hari'),
        'penanggung_jawab_id' => $this->input->post('penanggung_jawab_id'),
        'area' => $this->input->post('area'),
    ];

    // Cek apakah sudah ada piket di hari dan area yang sama
    $cek = $this->db->get_where('jadwal_piket', [
        'kelas_id' => $data['kelas_id'],
        'hari' => $data['hari'],
        'area' => $data['area']
    ])->row_array();

    if ($cek) {
        echo json_encode(['success' => false, 'message' => 'Hari dan area tersebut sudah memiliki jadwal piket.']);
        return;
    }

    $insert = $this->Jadwal_piket_model->insert_data($data);
    echo json_encode([
        'success' => $insert ? true : false,
        'message' => $insert ? '✅ Jadwal piket berhasil ditambahkan!' : '❌ Gagal menambahkan jadwal piket.'
    ]);
}


public function tambah_jadwal()
{
    $this->output->set_content_type('application/json');

    $hari          = $this->input->post('hari');
    $mata_pelajaran_id = $this->input->post('mata_pelajaran_id');
    $guru_id       = $this->input->post('guru_id');
    $jam_mulai     = $this->input->post('jam_mulai');
    $jam_selesai   = $this->input->post('jam_selesai');
    $kelas_id      = $this->input->post('kelas_id');

    // 🔹 Cek apakah sudah ada jadwal di waktu yang sama untuk kelas & hari itu
    $cek_duplikat = $this->db->query("
        SELECT * FROM jadwal 
        WHERE kelas_id = ? 
          AND hari = ? 
          AND (
              (jam_mulai <= ? AND jam_selesai > ?) OR
              (jam_mulai < ? AND jam_selesai >= ?)
          )
    ", [$kelas_id, $hari, $jam_mulai, $jam_mulai, $jam_selesai, $jam_selesai])->row_array();

    if ($cek_duplikat) {
        echo json_encode([
            'success' => false,
            'message' => 'Jam tersebut sudah terpakai pada hari yang sama. Silakan pilih jam lain.'
        ]);
        return;
    }

    // 🔹 Jika tidak ada bentrok, simpan ke tabel jadwal
    $data = [
        'kelas_id'          => $kelas_id,
        'mata_pelajaran_id' => $mata_pelajaran_id,
        'guru_id'           => $guru_id,
        'hari'              => $hari,
        'jam_mulai'         => $jam_mulai,
        'jam_selesai'       => $jam_selesai,
        'created_at'        => date('Y-m-d H:i:s'),
        'updated_at'        => date('Y-m-d H:i:s')
    ];

    $insert = $this->db->insert('jadwal', $data);

    echo json_encode([
        'success' => $insert ? true : false,
        'message' => $insert ? 'Jadwal berhasil ditambahkan.' : 'Gagal menambahkan jadwal.'
    ]);
}




    // =======================
    // LAPOR PERKEMBANGAN
    // =======================
    public function lapor_perkembangan()
    {
        $guru_id = $this->session->userdata('guru_id');
        if (!$guru_id) {
            show_error('Akses ditolak. Anda bukan wali kelas.');
            return;
        }

        $kelas = $this->Walikelas_model->getKelasByWali($guru_id);
        $data['siswa_kelas'] = $this->Walikelas_model->getSiswaKelas($kelas['id']);

        $this->load->view('walikelas/lapor_perkembangan', $data);
    }

    // =======================
    // LAPORAN KELAS
    // =======================
    public function laporan()
    {
        $guru_id = $this->session->userdata('guru_id');
        if (!$guru_id) {
            show_error('Akses ditolak. Anda bukan wali kelas.');
            return;
        }

        $kelas = $this->Walikelas_model->getKelasByWali($guru_id);
        $data['laporan'] = $this->Walikelas_model->getLaporanKelas($kelas['id']);

        $this->load->view('walikelas/laporan', $data);
    }
}

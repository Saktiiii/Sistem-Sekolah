<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WaliKelas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('WaliKelas_model');
        $this->load->library('session');
        
        // NONAKTIFKAN CEK LOGIN DULU UNTUK TESTING
        // if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'guru') {
        //     redirect('auth/login');
        // }
    }

    public function index() {
        $this->data_kelas();
    }

    public function data_kelas() {
        $data['title'] = 'Data Kelas - Wali Kelas';
        
        // UNTUK TESTING: Ganti guru_id sesuai yang mau di-test
        // Coba antara 1 (Budi Santoso) atau 2 (Siti Aminah)
        $guru_id = 1; // GANTI INI: 1 atau 2
        
        // Debug info
        echo "<!-- DEBUG: Guru ID = $guru_id -->";
        
        // Ambil data kelas yang diampu oleh guru ini sebagai wali kelas
        $data['kelas'] = $this->WaliKelas_model->get_kelas_by_wali($guru_id);
        
        if (empty($data['kelas'])) {
            // Tampilkan error detail
            echo "<!-- DEBUG: Data kelas kosong untuk guru_id $guru_id -->";
            $this->load->view('walikelas/error', $data);
            return;
        }
        
        // Debug info
        echo "<!-- DEBUG: Kelas ditemukan: " . $data['kelas']['nama_kelas'] . " -->";
        
        $kelas_id = $data['kelas']['id'];
        
        // Ambil semua data yang diperlukan
        $data['siswa_kelas'] = $this->WaliKelas_model->get_siswa_by_kelas($kelas_id);
        $data['siswa_berprestasi'] = $this->WaliKelas_model->get_siswa_berprestasi($kelas_id);
        $data['siswa_bermasalah'] = $this->WaliKelas_model->get_siswa_bermasalah($kelas_id);
        $data['rekap_absensi'] = $this->WaliKelas_model->get_rekap_absensi($kelas_id);
        $data['statistik'] = $this->WaliKelas_model->get_statistik_kelas($kelas_id);
        
        // Debug info
        echo "<!-- DEBUG: Jumlah siswa = " . count($data['siswa_kelas']) . " -->";
        echo "<!-- DEBUG: Jumlah berprestasi = " . count($data['siswa_berprestasi']) . " -->";
        echo "<!-- DEBUG: Jumlah bermasalah = " . count($data['siswa_bermasalah']) . " -->";
        
        $this->load->view('walikelas/data_kelas', $data);
    }

    public function get_detail_siswa($siswa_id) {
        $detail_siswa = $this->WaliKelas_model->get_detail_siswa($siswa_id);
        
        if ($detail_siswa) {
            echo json_encode([
                'success' => true,
                'data' => $detail_siswa
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Data siswa tidak ditemukan'
            ]);
        }
    }

    public function export_absensi($type = 'pdf') {
        // UNTUK TESTING: Ganti guru_id sesuai yang mau di-test
        $guru_id = 1; // GANTI INI: 1 atau 2
        
        $kelas = $this->WaliKelas_model->get_kelas_by_wali($guru_id);
        
        if ($kelas) {
            $data['rekap_absensi'] = $this->WaliKelas_model->get_rekap_absensi($kelas['id']);
            $data['kelas'] = $kelas;
            
            if ($type == 'pdf') {
                // Simple PDF export
                $html = '<h1>Rekap Absensi ' . $kelas['nama_kelas'] . '</h1>';
                $html .= '<table border="1" style="width:100%"><tr><th>Nama</th><th>Hadir</th><th>Izin</th><th>Sakit</th><th>Alpha</th></tr>';
                foreach ($data['rekap_absensi'] as $absensi) {
                    $html .= '<tr>';
                    $html .= '<td>' . $absensi['nama'] . '</td>';
                    $html .= '<td>' . $absensi['hadir'] . '</td>';
                    $html .= '<td>' . $absensi['izin'] . '</td>';
                    $html .= '<td>' . $absensi['sakit'] . '</td>';
                    $html .= '<td>' . $absensi['alpha'] . '</td>';
                    $html .= '</tr>';
                }
                $html .= '</table>';
                
                // Output PDF
                $this->load->library('pdf');
                $this->pdf->loadHtml($html);
                $this->pdf->setPaper('A4', 'landscape');
                $this->pdf->render();
                $this->pdf->stream("rekap_absensi_" . $kelas['nama_kelas'] . ".pdf");
            } else {
                // Excel export
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="rekap_absensi_' . $kelas['nama_kelas'] . '.xls"');
                
                echo '<table border="1">';
                echo '<tr><th>Nama</th><th>Hadir</th><th>Izin</th><th>Sakit</th><th>Alpha</th></tr>';
                foreach ($data['rekap_absensi'] as $absensi) {
                    echo '<tr>';
                    echo '<td>' . $absensi['nama'] . '</td>';
                    echo '<td>' . $absensi['hadir'] . '</td>';
                    echo '<td>' . $absensi['izin'] . '</td>';
                    echo '<td>' . $absensi['sakit'] . '</td>';
                    echo '<td>' . $absensi['alpha'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
                exit;
            }
        } else {
            echo "Tidak ada data kelas untuk diexport";
        }
    }

    // Method untuk testing
    public function test() {
        echo "<h1>Test WaliKelas Controller</h1>";
        
        // Test koneksi database
        $this->load->database();
        if ($this->db->conn_id) {
            echo "✅ Database connected<br>";
        } else {
            echo "❌ Database connection failed<br>";
        }
        
        // Test model
        $guru_id = 1;
        $kelas = $this->WaliKelas_model->get_kelas_by_wali($guru_id);
        
        echo "Guru ID: $guru_id<br>";
        echo "Data Kelas: ";
        print_r($kelas);
        echo "<br>";
        
        if ($kelas) {
            $kelas_id = $kelas['id'];
            echo "Kelas ID: $kelas_id<br>";
            
            $siswa = $this->WaliKelas_model->get_siswa_by_kelas($kelas_id);
            echo "Jumlah Siswa: " . count($siswa) . "<br>";
            
            echo "<a href='" . site_url('walikelas/data_kelas') . "'>Ke Dashboard</a>";
        } else {
            echo "❌ Guru tidak memiliki kelas<br>";
            echo "<a href='" . site_url('walikelas/data_kelas') . "?guru_id=2'>Coba Guru ID 2</a>";
        }
    }

    // Method untuk ganti guru via URL
    public function set_guru($guru_id) {
        $data['title'] = 'Data Kelas - Wali Kelas';
        
        $data['kelas'] = $this->WaliKelas_model->get_kelas_by_wali($guru_id);
        
        if (empty($data['kelas'])) {
            echo "Guru ID $guru_id tidak memiliki kelas sebagai wali kelas!<br>";
            echo "<a href='" . site_url('walikelas/set_guru/1') . "'>Coba Guru 1 (Budi)</a><br>";
            echo "<a href='" . site_url('walikelas/set_guru/2') . "'>Coba Guru 2 (Siti)</a>";
            return;
        }
        
        $kelas_id = $data['kelas']['id'];
        $data['siswa_kelas'] = $this->WaliKelas_model->get_siswa_by_kelas($kelas_id);
        $data['siswa_berprestasi'] = $this->WaliKelas_model->get_siswa_berprestasi($kelas_id);
        $data['siswa_bermasalah'] = $this->WaliKelas_model->get_siswa_bermasalah($kelas_id);
        $data['rekap_absensi'] = $this->WaliKelas_model->get_rekap_absensi($kelas_id);
        $data['statistik'] = $this->WaliKelas_model->get_statistik_kelas($kelas_id);
        
        $this->load->view('walikelas/data_kelas', $data);
    }
}
?>
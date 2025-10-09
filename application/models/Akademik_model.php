<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akademik_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Get all siswa dengan data ekskul
    public function get_all_siswa_with_ekskul() {
        $this->db->select('siswa.*, kelas.nama_kelas');
        $this->db->from('siswa');
        $this->db->join('kelas', 'siswa.kelas_id = kelas.id', 'left');
        $this->db->order_by('siswa.nama', 'ASC');
        return $this->db->get()->result();
    }

    // Get all ekstrakurikuler
    public function get_all_ekskul() {
        return $this->db->get('ekstrakurikuler')->result();
    }

    // Add new siswa
    public function add_siswa($data) {
        $this->db->insert('siswa', $data);
        return $this->db->insert_id();
    }

    // Add new ekskul
    public function add_ekskul($data) {
        return $this->db->insert('ekstrakurikuler', $data);
    }

    // Get siswa by kelas
    public function get_siswa_by_kelas($kelas_id) {
        $this->db->where('kelas_id', $kelas_id);
        return $this->db->get('siswa')->result();
    }

    // Get total siswa count
    public function get_total_siswa() {
        return $this->db->count_all('siswa');
    }

    // Get active siswa count - semua siswa dianggap aktif
    public function get_active_siswa_count() {
        return $this->db->count_all('siswa');
    }

    // Get popular ekskul - data dummy untuk sementara
    public function get_popular_ekskul() {
        return (object) array('nama_ekskul' => 'Paskibra');
    }

    // Get kelas list
    public function get_all_kelas() {
        return $this->db->get('kelas')->result();
    }
}
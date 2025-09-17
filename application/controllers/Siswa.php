<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Siswa_model');
    }

    public function index() {
        $data['siswa'] = $this->Siswa_model->get_all();
        $this->load->view('siswa/index', $data);
    }

    public function tambah() {
        if ($this->input->post()) {
            $insert = [
                'nis' => $this->input->post('nis'),
                'nama' => $this->input->post('nama'),
                'kelas' => $this->input->post('kelas'),
                'alamat' => $this->input->post('alamat'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            ];
            $this->db->insert('siswa', $insert);
            redirect('siswa');
        }
        $this->load->view('siswa/tambah');
    }

    public function edit($id) {
        $data['s'] = $this->Siswa_model->get_by_id($id);

        if ($this->input->post()) {
            $update = [
                'nis' => $this->input->post('nis'),
                'nama' => $this->input->post('nama'),
                'kelas' => $this->input->post('kelas'),
                'alamat' => $this->input->post('alamat'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            ];
            $this->db->where('id', $id)->update('siswa', $update);
            redirect('siswa');
        }

        $this->load->view('siswa/edit', $data);
    }

    public function hapus($id) {
        $this->db->delete('siswa', ['id' => $id]);
        redirect('siswa');
    }
}
?>
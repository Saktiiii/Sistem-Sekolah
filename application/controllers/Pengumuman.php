<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pengumuman_model');
    }

    public function index() {
        $data['pengumuman'] = $this->Pengumuman_model->get_published();
        $this->load->view('pengumuman/index', $data);
    }

    public function tambah() {
        if ($this->input->post()) {
            $insert = [
                'judul' => $this->input->post('judul'),
                'isi' => $this->input->post('isi'),
                'published' => $this->input->post('published') ? 1 : 0
            ];
            $this->db->insert('pengumuman', $insert);
            redirect('pengumuman');
        }
        $this->load->view('pengumuman/tambah');
    }

    public function edit($id) {
        $data['p'] = $this->db->get_where('pengumuman', ['id' => $id])->row();

        if ($this->input->post()) {
            $update = [
                'judul' => $this->input->post('judul'),
                'isi' => $this->input->post('isi'),
                'published' => $this->input->post('published') ? 1 : 0
            ];
            $this->db->where('id', $id)->update('pengumuman', $update);
            redirect('pengumuman');
        }

        $this->load->view('pengumuman/edit', $data);
    }

    public function hapus($id) {
        $this->db->delete('pengumuman', ['id' => $id]);
        redirect('pengumuman');
    }
}
?>
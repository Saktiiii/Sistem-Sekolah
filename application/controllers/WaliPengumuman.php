<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WaliPengumuman extends CI_Controller {

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->library('session');

    //     if(!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'guru') {
    //         redirect('auth/login');
    //     }
    // }

    public function walikelas()
    {
        $this->load->helper('url');
        $this->load->view('walikelas/kirim_pengumuman');
    }
}

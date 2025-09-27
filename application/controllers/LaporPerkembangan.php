<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporPerkembangan extends CI_Controller {

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->library('session');

    //     if(!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'guru') {
    //         redirect('auth/login');
    //     }
    // }

    public function view()
    {
        $this->load->helper('url');
        $this->load->view('walikelas/lapor_perkembangan');
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        if(!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'ortu') {
            redirect('auth/login');
        }
    }

    public function ortu()
    {
        $this->load->view('ortu/dashboard');
    }
}

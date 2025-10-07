<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        $this->load->view('auth/login'); // form login
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->User_model->get_user($username, $password);

        if ($user && $user->role == 'ortu') {
            $this->session->set_userdata([
                'user_id' => $user->id,
                'role'    => $user->role,
                'logged_in' => TRUE
            ]);
            redirect('ortu/dashboard');
        } else {
            $this->session->set_flashdata('error', 'Login gagal!');
            redirect('auth');
        }
    }

    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}

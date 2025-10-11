<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function index()
    {
        // Jika sudah login arahkan sesuai role
        if ($this->session->userdata('logged_in')) {
            $this->_redirect_by_role($this->session->userdata('role'));
            return;
        }

        $this->load->view('auth/login');
    }

    public function login()
    {
        $username = $this->input->post('username', TRUE);
        $password = md5($this->input->post('password', TRUE)); // pakai md5

        $user = $this->User_model->get_user($username);

        // Cek user dan password md5
        if ($user && $user->password === $password) {

            // Set session umum
            $this->session->set_userdata([
                'users_id'   => $user->id,
                'username'  => $user->username,
                'role'      => $user->role,
                'logged_in' => TRUE
            ]);

            // Kalau guru, simpan juga guru_id
            if ($user->role === 'guru') {
                $this->load->database();
                $guru = $this->db->get_where('guru', ['users_id' => $user->id])->row();
                if ($guru) {
                    $this->session->set_userdata('guru_id', $guru->id);
                }
            }

            $this->_redirect_by_role($user->role);
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah.');
            redirect('auth');
        }
    }

    private function _redirect_by_role($role)
    {
        switch ($role) {
            case 'admin':
                redirect('admin/dashboard');
                break;
            case 'guru':
                redirect('walikelas/data_kelas');
                break;
            case 'ortu':
                redirect('ortu/dashboard');
                break;
            case 'siswa':
                redirect('siswa/dashboard');
                break;
            default:
                $this->logout();
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}

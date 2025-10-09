<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }

    // Halaman login
    public function index()
    {
        // Jika sudah login, arahkan ke dashboard sesuai role
        if ($this->session->userdata('logged_in')) {
            $this->_redirect_by_role($this->session->userdata('role'));
            return;
        }

        $this->load->view('auth/login');
    }

    // Proses login
    public function login()
    {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        // Ambil data user berdasarkan username
        $user = $this->User_model->get_user($username);

        if ($user) {
            // Cek apakah password cocok (bcrypt atau md5)
            if (password_verify($password, $user->password) || $user->password === md5($password)) {

                // Simpan data session
                $this->session->set_userdata([
                    'user_id'   => $user->id,
                        'guru_id'   => $user->id, // penting untuk akses wali kelas
                    'username'  => $user->username,
                    'role'      => $user->role,
                    'logged_in' => TRUE
                ]);

                // Arahkan ke dashboard sesuai role
                $this->_redirect_by_role($user->role);
                return;
            }
        }

        // Jika gagal
        $this->session->set_flashdata('error', 'Username atau password salah.');
        redirect('auth');
    }

    // Arahkan user sesuai role
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
            default:
                $this->logout();
                break;
        }
    }

    // Logout
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
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
        $password = md5($this->input->post('password'));

        $user = $this->User_model->get_user($username, $password);

        if ($user) {
            $session_data = [
                'users_id' => $user->id,
                'role' => $user->role,
                'logged_in' => TRUE
            ];

            // Tambahkan ID spesifik berdasarkan role
            if ($user->role == 'guru') {
                $guru = $this->db->get_where('guru', ['users_id' => $user->id])->row();
                if ($guru)
                    $session_data['guru_id'] = $guru->id;
            } elseif ($user->role == 'siswa') {
                $siswa = $this->db->get_where('siswa', ['users_id' => $user->id])->row();
                if ($siswa)
                    $session_data['siswa_id'] = $siswa->id;
            } elseif ($user->role == 'ortu') {
                $ortu = $this->db->get_where('orang_tua', ['users_id' => $user->id])->row();
                if ($ortu) {
                    $session_data['ortu_id'] = $ortu->id;   // untuk referensi ortu
                }
                $session_data['user_id'] = $user->id; // **tambahkan ini**
            }


            $this->session->set_userdata($session_data);

            // Redirect sesuai role
            switch ($user->role) {
                case 'guru':
                    redirect('guru/akademik');
                    break;
                case 'siswa':
                    redirect('siswa/dashboard');
                    break;
                case 'ortu':
                    redirect('ortu/dashboard');
                    break;
                case 'wali_kelas':
                    redirect('wali/dashboard');
                    break;
                default:
                    $this->session->set_flashdata('error', 'Role tidak dikenali.');
                    redirect('auth');
            }
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

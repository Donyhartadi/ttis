<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model'); // buat juga model ini
    }

    public function index()
    {
        redirect('auth/login');
    }

    public function login()
    {
        if ($this->input->method() === 'post') {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);

            $user = $this->User_model->getByUsername($username);

            if ($user && password_verify($password, $user->password)) {
                $this->session->set_userdata([
                    'user_id'  => $user->id_user,
                    'username' => $user->username,
                    'role'     => $user->role, // tambahkan ini
                    'logged_in'=> TRUE
                  ]);
                  
                redirect('admin');
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah.');
                redirect('auth/login');
            }
        }

        $this->load->view('auth/login');
        
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
    public function register()
{
    if ($this->input->method() === 'post') {
        $username   = $this->input->post('username', TRUE);
        $password   = $this->input->post('password');
        $password2  = $this->input->post('password2');

        if ($password !== $password2) {
            $this->session->set_flashdata('error', 'Password tidak cocok.');
            redirect('auth/register');
        }

        // Cek apakah username sudah ada
        $existing = $this->User_model->getByUsername($username);
        if ($existing) {
            $this->session->set_flashdata('error', 'Username sudah digunakan.');
            redirect('auth/register');
        }

        // Simpan user
        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => 'U' // Default role User
        ];

        $this->User_model->insertUser($data);

        $this->session->set_flashdata('success', 'Pendaftaran berhasil, silakan login.');
        redirect('auth/login');
    }

    $this->load->view('auth/register');
}

}

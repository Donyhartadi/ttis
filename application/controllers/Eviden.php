<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Eviden extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url']);
        $this->load->library('session');
    }

    public function view($filename = null)
    {
        // Cek apakah user sudah login
        if (!$this->session->userdata('logged_in')) {
            show_404(); // Atau redirect('auth/login');
        }

        // Cegah directory traversal
        $filename = basename($filename);

        // Path ke file
        $path = APPPATH . 'uploads/eviden/' . $filename;

        // Cek apakah file ada
        if (!file_exists($path)) {
            show_404();
        }

        // Deteksi mime-type
        $mime = mime_content_type($path);
        header('Content-Type: ' . $mime);
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit;
    }
}

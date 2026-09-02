<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rfc2350 extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rfc2350_model');
        $this->load->helper(['form', 'url']);
        $this->load->library(['form_validation', 'upload']);
    }

    // Halaman publik RFC 2350
    public function index()
    {
        // Query langsung untuk memastikan data ter-load
        $this->db->where('status', 'aktif');
        $this->db->order_by('tanggal_publikasi', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('rfc2350');
        $rfc = $query->row();
        
        // Debug output - print ke response
        echo '<!-- DB Query: ' . $this->db->last_query() . ' -->';
        echo '<!-- DB Result rows: ' . $query->num_rows() . ' -->';
        echo '<!-- RFC is empty? ' . (empty($rfc) ? 'YES' : 'NO') . ' -->';
        if (!empty($rfc)) {
            echo '<!-- RFC nama_file: ' . $rfc->nama_file . ' -->';
        }
        
        $data = array(
            'rfc' => $rfc,
            'title' => 'RFC 2350'
        );
        
        $this->load->view('templates/public/header', $data);
        $this->load->view('templates/public/top', $data);
        $this->load->view('rfc2350', $data);
        $this->load->view('templates/public/footer', $data);
    }

    // ===== ADMIN AREA =====

    // Halaman admin kelola RFC 2350
    public function admin()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        if ($this->session->userdata('role') != 'A') {
            show_error('Akses ditolak. Halaman ini hanya untuk admin.');
        }

        $data['rfc_list'] = $this->Rfc2350_model->get_all();
        $data['rfc_aktif'] = $this->Rfc2350_model->get_aktif();
        
        $this->load->view('templates/header');
        $this->load->view('templates/top');
        $this->load->view('rfc2350/admin', $data);
        $this->load->view('templates/footer');
    }

    // Upload dokumen RFC baru
    public function admin_upload()
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'A') {
            redirect('auth/login');
        }

        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('versi', 'Versi', 'required|trim');
        $this->form_validation->set_rules('tanggal_publikasi', 'Tanggal Publikasi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('rfc2350/admin');
        }

        // Konfigurasi upload
        $upload_path = './assets/files/rfc2350/';
        
        // Buat folder jika belum ada
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        $config['upload_path']      = $upload_path;
        $config['allowed_types']    = 'pdf';
        $config['max_size']         = 20480; // 20MB
        $config['file_name']        = 'RFC2350_' . date('YmdHis');
        $config['encrypt_name']     = FALSE;
        $config['overwrite']        = FALSE;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file_pdf')) {
            $error = $this->upload->display_errors('', '');
            log_message('error', 'RFC2350 Upload Error: ' . $error);
            $this->session->set_flashdata('error', 'Upload gagal: ' . $error);
            redirect('rfc2350/admin');
        }

        $upload_data = $this->upload->data();

        // Set dokumen lama jadi arsip, dokumen baru jadi aktif
        $this->db->update('rfc2350', ['status' => 'arsip']);

        $data = [
            'judul'             => $this->input->post('judul'),
            'deskripsi'         => $this->input->post('deskripsi'),
            'versi'             => $this->input->post('versi'),
            'tanggal_publikasi' => $this->input->post('tanggal_publikasi'),
            'nama_file'         => $upload_data['file_name'],
            'ukuran_file'       => $upload_data['file_size'],
            'diupload_oleh'     => $this->session->userdata('id'),
            'status'            => 'aktif'
        ];

        if ($this->Rfc2350_model->insert($data)) {
            $this->session->set_flashdata('success', 'Dokumen RFC 2350 berhasil diupload!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan data ke database.');
        }

        redirect('rfc2350/admin');
    }

    // Set dokumen sebagai aktif
    public function admin_set_aktif($id)
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'A') {
            redirect('auth/login');
        }

        if ($this->Rfc2350_model->set_aktif($id)) {
            $this->session->set_flashdata('success', 'Dokumen berhasil diaktifkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengaktifkan dokumen.');
        }

        redirect('rfc2350/admin');
    }

    // Delete dokumen
    public function admin_delete($id)
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'A') {
            redirect('auth/login');
        }

        $rfc = $this->Rfc2350_model->get($id);
        
        if (!$rfc) {
            $this->session->set_flashdata('error', 'Dokumen tidak ditemukan.');
            redirect('rfc2350/admin');
        }

        // Hapus file fisik
        $file_path = './assets/files/rfc2350/' . $rfc->nama_file;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Hapus dari database
        if ($this->Rfc2350_model->delete($id)) {
            $this->session->set_flashdata('success', 'Dokumen berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus dokumen.');
        }

        redirect('rfc2350/admin');
    }
}

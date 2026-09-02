<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kontak_model');
        $this->load->helper(['form', 'url']);
        $this->load->library(['form_validation', 'upload']);
    }

    // Halaman kontak publik
    public function index()
    {
        $data['kontak'] = $this->Kontak_model->get_kontak_info();
        $data['publickeys'] = $this->Kontak_model->get_all_publickey();
        $data['operators'] = $this->Kontak_model->get_all_operator();
        $data['dokumen'] = $this->Kontak_model->get_all_dokumen();
        $data['title'] = "Kontak Kami";
        
        $this->load->view('templates/public/header', $data);
        $this->load->view('templates/public/top');
        $this->load->view('kontak/index', $data);
        $this->load->view('templates/public/footer');
    }

    // Download dokumen publik
    public function download($id)
    {
        $dokumen = $this->Kontak_model->get_dokumen($id);
        
        if (!$dokumen) {
            show_404();
        }

        $file_path = './assets/uploads/kontak/dokumen/' . $dokumen->nama_file;
        
        if (file_exists($file_path)) {
            // Increment download counter
            $this->Kontak_model->increment_download($id);
            
            $this->load->helper('download');
            force_download($file_path, NULL);
        } else {
            show_404();
        }
    }

    // ===== ADMIN AREA =====

    // Halaman admin untuk mengatur kontak
    public function admin_setting()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        if ($this->session->userdata('role') != 'A') {
            show_error('Akses ditolak. Halaman ini hanya untuk admin.');
        }

        $data['kontak'] = $this->Kontak_model->get_kontak_info();
        
        $this->load->view('templates/header');
        $this->load->view('templates/top');
        $this->load->view('kontak/admin_setting', $data);
        $this->load->view('templates/footer');
    }

    // Update setting kontak oleh admin
    public function admin_update()
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'A') {
            redirect('auth/login');
        }

        $data = [
            'alamat' => $this->input->post('alamat'),
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
            'email' => $this->input->post('email'),
            'jam_operasional' => $this->input->post('jam_operasional')
        ];

        if ($this->Kontak_model->update_kontak_info($data)) {
            $this->session->set_flashdata('success', 'Informasi kontak berhasil diupdate!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate informasi kontak.');
        }

        redirect('kontak/admin_setting');
    }

    // ===== OPERATOR =====

    // Daftar operator
    public function admin_operator()
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'A') {
            redirect('auth/login');
        }

        $data['operators'] = $this->Kontak_model->get_all_operator();
        
        $this->load->view('templates/header');
        $this->load->view('templates/top');
        $this->load->view('kontak/admin_operator', $data);
        $this->load->view('templates/footer');
    }

    // Tambah operator
    public function admin_operator_add()
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'A') {
            redirect('auth/login');
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('no_whatsapp', 'Nomor WhatsApp', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('error', $errors ? $errors : 'Validasi gagal');
            redirect('kontak/admin_operator');
            return;
        }

        $data = [
            'nama' => $this->input->post('nama', TRUE),
            'jabatan' => $this->input->post('jabatan', TRUE),
            'no_whatsapp' => $this->input->post('no_whatsapp', TRUE),
            'urutan' => $this->input->post('urutan') ? (int)$this->input->post('urutan') : 0
        ];

        try {
            if ($this->Kontak_model->insert_operator($data)) {
                $this->session->set_flashdata('success', 'Operator berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan operator ke database.');
            }
        } catch (Exception $e) {
            log_message('error', 'Error adding operator: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        redirect('kontak/admin_operator');
    }

    // Edit operator
    public function admin_operator_edit($id)
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'A') {
            redirect('auth/login');
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('no_whatsapp', 'Nomor WhatsApp', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('kontak/admin_operator');
        }

        $data = [
            'nama' => $this->input->post('nama'),
            'jabatan' => $this->input->post('jabatan'),
            'no_whatsapp' => $this->input->post('no_whatsapp'),
            'urutan' => $this->input->post('urutan') ?: 0
        ];

        if ($this->Kontak_model->update_operator($id, $data)) {
            $this->session->set_flashdata('success', 'Operator berhasil diupdate!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate operator.');
        }

        redirect('kontak/admin_operator');
    }

    // Hapus operator
    public function admin_operator_delete($id)
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'A') {
            redirect('auth/login');
        }

        if ($this->Kontak_model->delete_operator($id)) {
            $this->session->set_flashdata('success', 'Operator berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus operator.');
        }

        redirect('kontak/admin_operator');
    }

    // ===== DOKUMEN =====

    // Daftar dokumen
    public function admin_dokumen()
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'A') {
            redirect('auth/login');
        }

        $data['dokumen'] = $this->Kontak_model->get_all_dokumen();
        
        $this->load->view('templates/header');
        $this->load->view('templates/top');
        $this->load->view('kontak/admin_dokumen', $data);
        $this->load->view('templates/footer');
    }

    // Upload dokumen
    public function admin_dokumen_upload()
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'A') {
            redirect('auth/login');
        }

        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('error', $errors ? $errors : 'Validasi gagal');
            redirect('kontak/admin_dokumen');
            return;
        }

        // Upload PDF
        $config['upload_path'] = './assets/uploads/kontak/dokumen/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 20240; // 10MB
        $config['file_name'] = 'dokumen_' . time();
        $config['encrypt_name'] = FALSE;
        $config['overwrite'] = FALSE;

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file_pdf')) {
            $error = $this->upload->display_errors('', '');
            log_message('error', 'Document upload failed: ' . $error);
            $this->session->set_flashdata('error', 'Upload gagal: ' . $error . ' (Pastikan file bertipe PDF)');
            redirect('kontak/admin_dokumen');
            return;
        }

        $upload_data = $this->upload->data();

        $data = [
            'judul' => $this->input->post('judul', TRUE),
            'deskripsi' => $this->input->post('deskripsi', TRUE),
            'nama_file' => $upload_data['file_name'],
            'ukuran_file' => $upload_data['file_size']
        ];

        try {
            if ($this->Kontak_model->insert_dokumen($data)) {
                $this->session->set_flashdata('success', 'Dokumen berhasil diupload!');
            } else {
                // Hapus file jika insert gagal
                @unlink($config['upload_path'] . $upload_data['file_name']);
                $this->session->set_flashdata('error', 'Gagal menyimpan dokumen ke database.');
            }
        } catch (Exception $e) {
            // Hapus file jika error
            @unlink($config['upload_path'] . $upload_data['file_name']);
            log_message('error', 'Error uploading document: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        redirect('kontak/admin_dokumen');
    }

    // Hapus dokumen
    public function admin_dokumen_delete($id)
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'A') {
            redirect('auth/login');
        }

        // Get file info sebelum dihapus
        $dokumen = $this->Kontak_model->get_dokumen($id);
        
        if ($this->Kontak_model->delete_dokumen($id)) {
            // Hapus file PDF juga
            if ($dokumen && $dokumen->nama_file) {
                $file_path = './assets/uploads/kontak/dokumen/' . $dokumen->nama_file;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $this->session->set_flashdata('success', 'Dokumen berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus dokumen.');
        }

        redirect('kontak/admin_dokumen');
    }

    // ===== PUBLIC KEY =====

    // Download public key
    public function download_publickey($id)
    {
        $publickey = $this->Kontak_model->get_publickey($id);
        
        if (!$publickey) {
            show_404();
        }

        $file_path = './assets/uploads/kontak/publickey/' . $publickey->nama_file;
        
        if (file_exists($file_path)) {
            // Increment download counter
            $this->Kontak_model->increment_publickey_download($id);
            
            $this->load->helper('download');
            force_download($file_path, NULL);
        } else {
            show_404();
        }
    }

    // Admin: Daftar public key
    public function admin_publickey()
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'A') {
            redirect('auth/login');
        }

        $data['publickeys'] = $this->Kontak_model->get_all_publickey();
        
        $this->load->view('templates/header');
        $this->load->view('templates/top');
        $this->load->view('kontak/admin_publickey', $data);
        $this->load->view('templates/footer');
    }

    // Admin: Upload public key
    public function admin_publickey_upload()
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'A') {
            redirect('auth/login');
        }

        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('error', $errors ? $errors : 'Validasi gagal');
            redirect('kontak/admin_publickey');
            return;
        }

        // Upload file public key
        $config['upload_path'] = './assets/uploads/kontak/publickey/';
        $config['allowed_types'] = 'asc|gpg|txt|key|pgp';
        $config['max_size'] = 1024; // 1MB
        $config['file_name'] = 'publickey_' . time();
        $config['encrypt_name'] = FALSE;
        $config['overwrite'] = FALSE;

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file_publickey')) {
            $error = $this->upload->display_errors('', '');
            log_message('error', 'Public key upload failed: ' . $error);
            $this->session->set_flashdata('error', 'Upload gagal: ' . $error . ' (Pastikan file bertipe .asc, .gpg, .txt, .key, atau .pgp)');
            redirect('kontak/admin_publickey');
            return;
        }

        $upload_data = $this->upload->data();

        $data = [
            'judul' => $this->input->post('judul', TRUE),
            'deskripsi' => $this->input->post('deskripsi', TRUE),
            'nama_file' => $upload_data['file_name'],
            'ukuran_file' => $upload_data['file_size']
        ];

        try {
            if ($this->Kontak_model->insert_publickey($data)) {
                $this->session->set_flashdata('success', 'Public key berhasil diupload!');
            } else {
                @unlink($config['upload_path'] . $upload_data['file_name']);
                $this->session->set_flashdata('error', 'Gagal menyimpan public key ke database.');
            }
        } catch (Exception $e) {
            @unlink($config['upload_path'] . $upload_data['file_name']);
            log_message('error', 'Error uploading publickey: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        redirect('kontak/admin_publickey');
    }

    // Admin: Delete public key
    public function admin_publickey_delete($id)
    {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'A') {
            redirect('auth/login');
        }

        $publickey = $this->Kontak_model->get_publickey($id);
        
        if ($this->Kontak_model->delete_publickey($id)) {
            // Hapus file juga
            if ($publickey && $publickey->nama_file) {
                $file_path = './assets/uploads/kontak/publickey/' . $publickey->nama_file;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            $this->session->set_flashdata('success', 'Public key berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus public key.');
        }

        redirect('kontak/admin_publickey');
    }
}

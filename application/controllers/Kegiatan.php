<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {

  public function __construct() {
    parent::__construct();

    // Cek login
    if (!$this->session->userdata('logged_in')) {
      redirect('auth/login');
    }

    // Cek role admin
    if ($this->session->userdata('role') != 'A') {
      show_error('Akses ditolak. Halaman ini hanya untuk admin.');
    }

		$this->load->model(['Kegiatan_model', 'Absensi_model']);
    $this->load->helper(['url', 'form', 'text']);
    $this->load->library(['session']);
  }

  public function index() {
    $this->load->library('pagination');
        // Pagination style
        $config['full_tag_open'] = '<ul class="pagination justify-content-center mt-4">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = ['class' => 'page-link'];
    // Ambil keyword pencarian
    $keyword = $this->input->get('q');
    $page = (int) $this->input->get('per_page');

    // Konfigurasi pagination
    $config['base_url'] = site_url('kegiatan/index?q=' . urlencode($keyword));
    $config['total_rows'] = $this->Kegiatan_model->count_all($keyword);
    $config['per_page'] = 10;
    $config['page_query_string'] = TRUE;

    $this->pagination->initialize($config);

    // Ambil data sesuai page
    $data['kegiatan'] = $this->Kegiatan_model->get_all($config['per_page'], $page, $keyword);
    $data['pagination'] = $this->pagination->create_links();
    $data['keyword'] = $keyword;

    $this->load->view('templates/header');
    $this->load->view('templates/top');
    $this->load->view('admin/kegiatan/index', $data);
    $this->load->view('templates/footer');
}


  public function tambah() {
    if ($this->input->post()) {
      $data = [
        'nama_kegiatan'  => $this->input->post('nama_kegiatan', TRUE),
        'waktu_kegiatan' => $this->input->post('waktu_kegiatan', TRUE),
        'keterangan'     => $this->input->post('keterangan', TRUE),
      ];

      // Upload gambar (opsional)
      if (!empty($_FILES['gambar']['name'])) {
        $config['upload_path']   = './assets/uploads/kegiatan/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['file_name']     = time();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
          $data['gambar'] = $this->upload->data('file_name');
        }
      }

      // Upload lampiran (opsional)
      if (!empty($_FILES['lampiran']['name'])) {
        $config['upload_path']   = './assets/uploads/lampiran/';
        $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|zip|rar';
        $config['max_size']      = 5120; // 5MB
        $config['file_name']     = time();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('lampiran')) {
          $data['lampiran'] = $this->upload->data('file_name');
        }
      }

      $this->Kegiatan_model->insert($data);
      $this->session->set_flashdata('success', 'Kegiatan berhasil ditambahkan.');
      redirect('kegiatan');
    }

    $this->load->view('templates/header');
    $this->load->view('templates/top');
    $this->load->view('admin/kegiatan/kegiatan_form');
    $this->load->view('templates/footer');
  }

  public function edit($id) {
    $kegiatan = $this->Kegiatan_model->get($id);
    if (!$kegiatan) show_404();

    if ($this->input->post()) {
      $data = [
        'nama_kegiatan'  => $this->input->post('nama_kegiatan', TRUE),
        'waktu_kegiatan' => $this->input->post('waktu_kegiatan', TRUE),
        'keterangan'     => $this->input->post('keterangan', TRUE),
      ];

      // Gambar baru (opsional)
      if (!empty($_FILES['gambar']['name'])) {
        $config['upload_path']   = './assets/uploads/kegiatan/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['file_name']     = time();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
          // hapus gambar lama
          if (!empty($kegiatan->gambar) && file_exists('./assets/uploads/kegiatan/' . $kegiatan->gambar)) {
            unlink('./assets/uploads/kegiatan/' . $kegiatan->gambar);
          }
          $data['gambar'] = $this->upload->data('file_name');
        }
      }

      // Lampiran baru (opsional)
      if (!empty($_FILES['lampiran']['name'])) {
        $config['upload_path']   = './assets/uploads/lampiran/';
        $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|zip|rar';
        $config['max_size']      = 5120;
        $config['file_name']     = time();
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('lampiran')) {
          // hapus lampiran lama
          if (!empty($kegiatan->lampiran) && file_exists('./assets/uploads/lampiran/' . $kegiatan->lampiran)) {
            unlink('./assets/uploads/lampiran/' . $kegiatan->lampiran);
          }
          $data['lampiran'] = $this->upload->data('file_name');
        }
      }

      $this->Kegiatan_model->update($id, $data);
      $this->session->set_flashdata('success', 'Kegiatan berhasil diperbarui.');
      redirect('kegiatan/detail/' . $id);
    }

    $data['kegiatan'] = $kegiatan;
    $this->load->view('templates/header');
    $this->load->view('templates/top');
    $this->load->view('admin/kegiatan/kegiatan_form', $data);
    $this->load->view('templates/footer');
  }

  public function hapus($id) {
    $kegiatan = $this->Kegiatan_model->get($id);

    if ($kegiatan) {
      if (!empty($kegiatan->gambar) && file_exists('./assets/uploads/kegiatan/' . $kegiatan->gambar)) {
        unlink('./assets/uploads/kegiatan/' . $kegiatan->gambar);
      }
      if (!empty($kegiatan->lampiran) && file_exists('./assets/uploads/lampiran/' . $kegiatan->lampiran)) {
        unlink('./assets/uploads/lampiran/' . $kegiatan->lampiran);
      }
      $this->Kegiatan_model->delete($id);
    }

    $this->session->set_flashdata('success', 'Kegiatan berhasil dihapus.');
    redirect('kegiatan');
  }

  public function detail($id) {
    $kegiatan = $this->Kegiatan_model->get($id);
    if (!$kegiatan) show_404();

    $data['kegiatan'] = $kegiatan;

    $this->load->view('templates/header');
    $this->load->view('templates/top');
    $this->load->view('admin/kegiatan/detail', $data);
    $this->load->view('templates/footer');
  }
  
  public function absensi($id) {
    $kegiatan = $this->Kegiatan_model->get($id);
    if (!$kegiatan) show_404();

    $data['kegiatan'] = $kegiatan;
    $data['absensi']  = $this->Absensi_model->get_by_kegiatan($id);

    $this->load->view('templates/header');
    $this->load->view('admin/kegiatan/absensi_list', $data);
    $this->load->view('templates/footer');
}

public function toggle_absensi($id) {
  $kegiatan = $this->Kegiatan_model->get($id);
  if (!$kegiatan) {
      show_404();
  }

  $new_status = ($kegiatan->is_absensi_open == 1) ? 0 : 1;
  $this->Kegiatan_model->update($id, ['is_absensi_open' => $new_status]);

  $msg = $new_status ? 'Absensi dibuka kembali.' : 'Absensi ditutup.';
  $this->session->set_flashdata('success', $msg);

  redirect('kegiatan/detail/'.$id);
}


}

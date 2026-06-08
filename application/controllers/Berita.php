<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

  public function __construct() {
    parent::__construct();

    if (!$this->session->userdata('logged_in')) {
      redirect('auth/login');
    }

    if ($this->session->userdata('role') != 'A') {
      show_error('Akses ditolak. Halaman ini hanya untuk admin.');
    }
    $this->load->model('Berita_model');
    $this->load->helper(['url', 'form', 'text']);
    $this->load->library('session');
  }

  public function index() {
    $q = $this->input->get('q');
    $data['berita'] = $this->Berita_model->get_all($q);
    $data['q'] = $q;
    $this->load->view('templates/header');
    $this->load->view('templates/top');
    $this->load->view('admin/berita/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah() {
    if ($this->input->post()) {
      $data = [
        'judul'     => $this->input->post('judul'),
        'isi'       => $this->input->post('isi'),
        'kategori'  => $this->input->post('kategori'),
        'status'    => $this->input->post('status') ?: 'publish',
        'tanggal'   => date('Y-m-d'),
        'slug'      => url_title($this->input->post('judul'), 'dash', true),
        'ringkasan' => word_limiter(strip_tags($this->input->post('isi')), 30),
      ];

      if (!empty($_FILES['gambar']['name'])) {
        $this->load->library('upload');
        $this->upload->initialize([
          'upload_path'   => './assets/uploads/berita/',
          'allowed_types' => 'jpg|jpeg|png|webp',
          'file_name'     => time(),
        ]);
        if ($this->upload->do_upload('gambar')) {
          $data['gambar'] = $this->upload->data('file_name');
        }
      }

      $this->Berita_model->insert($data);
      $this->session->set_flashdata('success', 'Berita berhasil ditambahkan.');
      redirect('berita');
    }

    $this->load->view('templates/header');
    $this->load->view('templates/top');
    $this->load->view('admin/berita/berita_form');
    $this->load->view('templates/footer');
  }

  public function edit($id) {
    $berita = $this->Berita_model->get($id);
    if (!$berita) show_404();

    if ($this->input->post()) {
      $data = [
        'judul'     => $this->input->post('judul'),
        'isi'       => $this->input->post('isi'),
        'kategori'  => $this->input->post('kategori'),
        'status'    => $this->input->post('status') ?: 'publish',
        'slug'      => url_title($this->input->post('judul'), 'dash', true),
        'ringkasan' => word_limiter(strip_tags($this->input->post('isi')), 30),
      ];

      if (!empty($_FILES['gambar']['name'])) {
        $this->load->library('upload');
        $this->upload->initialize([
          'upload_path'   => './assets/uploads/berita/',
          'allowed_types' => 'jpg|jpeg|png|webp',
          'file_name'     => time(),
        ]);
        if ($this->upload->do_upload('gambar')) {
          if (!empty($berita->gambar)) {
            $old = './assets/uploads/berita/' . $berita->gambar;
            if (file_exists($old)) @unlink($old);
          }
          $data['gambar'] = $this->upload->data('file_name');
        }
      }

      $this->Berita_model->update($id, $data);
      $this->session->set_flashdata('success', 'Berita berhasil diperbarui.');
      redirect('berita');
    }

    $data['berita'] = $berita;
    $this->load->view('templates/header');
    $this->load->view('templates/top');
    $this->load->view('admin/berita/berita_form', $data);
    $this->load->view('templates/footer');
  }

  public function hapus($id) {
    $berita = $this->Berita_model->get($id);
    if ($berita && !empty($berita->gambar)) {
      $file = './assets/uploads/berita/' . $berita->gambar;
      if (file_exists($file)) @unlink($file);
    }
    $this->Berita_model->delete($id);
    $this->session->set_flashdata('success', 'Berita berhasil dihapus.');
    redirect('berita');
  }

  public function detail($slug) {
    $berita = $this->Berita_model->get_by_slug($slug);
    if (!$berita) show_404();

    $data['berita'] = $berita;
    $this->load->view('templates/header');
    $this->load->view('templates/top');
    $this->load->view('admin/berita/detail', $data);
    $this->load->view('templates/footer');
  }

}

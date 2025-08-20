<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('text');

    if (!$this->session->userdata('logged_in')) {
      redirect('auth/login');
    }

    // Cek role admin
    if ($this->session->userdata('role') != 'A') {
      show_error('Akses ditolak. Halaman ini hanya untuk admin.');
    }
  }

  public function index()
  {
      $this->load->model('Laporan_model');
      $this->load->model('Berita_model');
  
      $laporan_per_bulan = $this->Laporan_model->laporan_per_bulan();
      $data['berita_bulanan'] = $this->Berita_model->getJumlahBeritaPerBulan();
  
      $data['labels'] = array_column($laporan_per_bulan, 'bulan');
      $data['jumlah'] = array_column($laporan_per_bulan, 'jumlah');
      $data['label_berita'] = array_column($data['berita_bulanan'], 'bulan');
      $data['jumlah_berita'] = array_map('intval', array_column($data['berita_bulanan'], 'jumlah'));

      $data['total_menunggu'] = $this->Laporan_model->count_by_status('menunggu');
      $data['total_diproses'] = $this->Laporan_model->count_by_status('diproses');
      $data['total_selesai'] = $this->Laporan_model->count_by_status('selesai');

  
      $this->load->view('templates/header');
      $this->load->view('templates/top');
      $this->load->view('admin/dashboard', $data);
      $this->load->view('templates/footer');
  }
  


}

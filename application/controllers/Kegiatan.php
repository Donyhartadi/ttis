<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Kegiatan extends CI_Controller {

  public function __construct() {
    parent::__construct();

    if (!$this->session->userdata('logged_in')) {
      redirect('auth/login');
    }
    if ($this->session->userdata('role') != 'A') {
      show_error('Akses ditolak. Halaman ini hanya untuk admin.');
    }

    $this->load->model(['Kegiatan_model', 'Absensi_model']);
    $this->load->helper(['url', 'form', 'text']);
    $this->load->library(['session']);
  }

  public function index() {
    $this->load->library('pagination');

    $config['full_tag_open']   = '<ul class="pagination justify-content-center mt-4">';
    $config['full_tag_close']  = '</ul>';
    $config['cur_tag_open']    = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']   = '</span></li>';
    $config['num_tag_open']    = '<li class="page-item">';
    $config['num_tag_close']   = '</li>';
    $config['attributes']      = ['class' => 'page-link'];

    $keyword = $this->input->get('q');
    $page    = (int) $this->input->get('per_page');

    $config['base_url']            = site_url('kegiatan/index?q=' . urlencode($keyword));
    $config['total_rows']          = $this->Kegiatan_model->count_all($keyword);
    $config['per_page']            = 10;
    $config['page_query_string']   = TRUE;

    $this->pagination->initialize($config);

    $data['kegiatan']   = $this->Kegiatan_model->get_all($config['per_page'], $page, $keyword);
    $data['pagination'] = $this->pagination->create_links();
    $data['keyword']    = $keyword;

    $this->load->view('templates/header');
    $this->load->view('templates/top');
    $this->load->view('admin/kegiatan/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah() {
    if ($this->input->post()) {
        $data = [
            'nama_kegiatan'   => $this->input->post('nama_kegiatan', TRUE),
            'waktu_kegiatan'  => $this->input->post('waktu_kegiatan', TRUE),
            'keterangan'      => $this->input->post('keterangan', TRUE),
            'sertifikat_link' => $this->input->post('sertifikat_link', TRUE) // Tambahan
        ];

        // Upload gambar
        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path']   = './assets/uploads/kegiatan/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['file_name']     = time();
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $data['gambar'] = $this->upload->data('file_name');
            }
        }

        // Upload multi-lampiran
        $files = $_FILES;
        $lampiran_files = [];
        if (!empty($_FILES['lampiran']['name'][0])) {
            $count = count($_FILES['lampiran']['name']);
            for ($i = 0; $i < $count; $i++) {
                $_FILES['lampiran']['name']     = $files['lampiran']['name'][$i];
                $_FILES['lampiran']['type']     = $files['lampiran']['type'][$i];
                $_FILES['lampiran']['tmp_name'] = $files['lampiran']['tmp_name'][$i];
                $_FILES['lampiran']['error']    = $files['lampiran']['error'][$i];
                $_FILES['lampiran']['size']     = $files['lampiran']['size'][$i];

                $config['upload_path']   = './assets/uploads/lampiran/';
                $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|zip|rar|jpg|jpeg|png';
                $config['max_size']      = 5120;
                $config['encrypt_name']  = TRUE;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('lampiran')) {
                    $lampiran_files[] = $this->upload->data('file_name');
                }
            }
        }

        if (!empty($lampiran_files)) {
            $data['lampiran'] = json_encode($lampiran_files);
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
          'nama_kegiatan'   => $this->input->post('nama_kegiatan', TRUE),
          'waktu_kegiatan'  => $this->input->post('waktu_kegiatan', TRUE),
          'keterangan'      => $this->input->post('keterangan', TRUE),
          'sertifikat_link' => $this->input->post('sertifikat_link', TRUE) // Tambahan
      ];

      // ✅ Jika user centang hapus semua lampiran
      if ($this->input->post('hapus_lampiran')) {
          if (!empty($kegiatan->lampiran)) {
              $old_files = json_decode($kegiatan->lampiran, true);
              foreach ($old_files as $old) {
                  $path = './assets/uploads/lampiran/' . $old;
                  if (file_exists($path)) unlink($path);
              }
          }
          $data['lampiran'] = NULL; // kosongkan di DB
      }

      // Upload gambar baru
      if (!empty($_FILES['gambar']['name'])) {
          $config['upload_path']   = './assets/uploads/kegiatan/';
          $config['allowed_types'] = 'jpg|jpeg|png|webp';
          $config['file_name']     = time();
          $this->load->library('upload', $config);

          if ($this->upload->do_upload('gambar')) {
              if (!empty($kegiatan->gambar) && file_exists('./assets/uploads/kegiatan/' . $kegiatan->gambar)) {
                  unlink('./assets/uploads/kegiatan/' . $kegiatan->gambar);
              }
              $data['gambar'] = $this->upload->data('file_name');
          }
      }

      // Upload lampiran baru
      $files = $_FILES;
      $lampiran_files = [];
      if (!empty($_FILES['lampiran']['name'][0])) {
          $count = count($_FILES['lampiran']['name']);
          for ($i = 0; $i < $count; $i++) {
              $_FILES['lampiran']['name']     = $files['lampiran']['name'][$i];
              $_FILES['lampiran']['type']     = $files['lampiran']['type'][$i];
              $_FILES['lampiran']['tmp_name'] = $files['lampiran']['tmp_name'][$i];
              $_FILES['lampiran']['error']    = $files['lampiran']['error'][$i];
              $_FILES['lampiran']['size']     = $files['lampiran']['size'][$i];

              $config['upload_path']   = './assets/uploads/lampiran/';
              $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|zip|rar|jpg|jpeg|png';
              $config['max_size']      = 5120;
              $config['encrypt_name']  = TRUE;

              $this->load->library('upload', $config);

              if ($this->upload->do_upload('lampiran')) {
                  $lampiran_files[] = $this->upload->data('file_name');
              }
          }
      }

      if (!empty($lampiran_files)) {
          // 🚮 Kalau ada upload baru, hapus semua lampiran lama dulu
          if (!empty($kegiatan->lampiran)) {
              $old_files = json_decode($kegiatan->lampiran, true);
              foreach ($old_files as $old) {
                  $path = './assets/uploads/lampiran/' . $old;
                  if (file_exists($path)) unlink($path);
              }
          }
          $data['lampiran'] = json_encode($lampiran_files);
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
      if (!empty($kegiatan->lampiran)) {
        $old_files = json_decode($kegiatan->lampiran, true);
        foreach ($old_files as $old) {
          $path = './assets/uploads/lampiran/' . $old;
          if (file_exists($path)) unlink($path);
        }
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


  public function export_excel($kegiatan_id)
  {
      // load model absensi
      $this->load->model('Absensi_model');
      $dataAbsensi = $this->Absensi_model->get_by_kegiatan($kegiatan_id);
  
      // load library Excel
      $this->load->library('excel'); // bisa pakai PhpSpreadsheet
  
      $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
  
      // Header kolom
      $sheet->setCellValue('A1', 'No');
      $sheet->setCellValue('B1', 'Nama Peserta');
      $sheet->setCellValue('C1', 'Unit Kerja');
      $sheet->setCellValue('D1', 'Email');
      $sheet->setCellValue('E1', 'Saran & Masukan');
      $sheet->setCellValue('F1', 'Waktu Absen');
      $sheet->setCellValue('G1', 'Kepuasan');
  
      // Isi data
      $rowNumber = 2;
      $no = 1;
      foreach ($dataAbsensi as $row) {
          $sheet->setCellValue('A'.$rowNumber, $no++);
          $sheet->setCellValue('B'.$rowNumber, $row->nama_peserta);
          $sheet->setCellValue('C'.$rowNumber, $row->asal_opd);
          $sheet->setCellValue('D'.$rowNumber, $row->email);
          $sheet->setCellValue('E'.$rowNumber, $row->saran_masukan);
          $sheet->setCellValue('F'.$rowNumber, $row->waktu_absen);
          $sheet->setCellValue('G'.$rowNumber, $row->kepuasan);
          $rowNumber++;
      }
  
      // Download file
      $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
      $filename = "Daftar_Absensi_".date('Ymd_His').".xlsx";
  
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$filename.'"');
      header('Cache-Control: max-age=0');
  
      $writer->save('php://output');
  }
  

}

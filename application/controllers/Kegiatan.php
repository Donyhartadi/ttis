<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
      // Auth check
      if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'A') {
          redirect('auth/login');
      }

      $kegiatan_id = (int) $kegiatan_id;
      $kegiatan    = $this->Kegiatan_model->get($kegiatan_id);
      if (!$kegiatan) show_404();

      $dataAbsensi = $this->Absensi_model->get_by_kegiatan($kegiatan_id);

      // Load Composer autoload explicitly (CI3 + Windows path fix)
      require_once APPPATH . 'third_party' . DIRECTORY_SEPARATOR . 'PhpSpreadsheet-5.1.0' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

      $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setTitle('Absensi');

      // ── Judul laporan ──
      $sheet->mergeCells('A1:G1');
      $sheet->setCellValue('A1', 'DAFTAR ABSENSI PESERTA');
      $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(13);
      $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $sheet->mergeCells('A2:G2');
      $sheet->setCellValue('A2', $kegiatan->nama_kegiatan);
      $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(11);
      $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $sheet->mergeCells('A3:G3');
      $sheet->setCellValue('A3', 'Tanggal: ' . date('d M Y H:i', strtotime($kegiatan->waktu_kegiatan)));
      $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      // ── Header kolom ──
      $headers = ['No', 'Nama Peserta', 'Unit Kerja / OPD', 'Email', 'Saran & Masukan', 'Waktu Absen', 'Kepuasan'];
      $cols    = ['A','B','C','D','E','F','G'];
      foreach ($headers as $i => $h) {
          $sheet->setCellValue($cols[$i].'5', $h);
      }
      $headerStyle = [
          'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
          'fill'      => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                          'startColor' => ['rgb' => '1A3C5A']],
          'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
          'borders'   => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
      ];
      $sheet->getStyle('A5:G5')->applyFromArray($headerStyle);

      // ── Isi data ──
      $rowNum = 6;
      $no = 1;
      foreach ($dataAbsensi as $row) {
          $sheet->setCellValue('A'.$rowNum, $no++);
          $sheet->setCellValue('B'.$rowNum, $row->nama_peserta);
          $sheet->setCellValue('C'.$rowNum, $row->asal_opd);
          $sheet->setCellValue('D'.$rowNum, $row->email);
          $sheet->setCellValue('E'.$rowNum, $row->saran_masukan);
          $sheet->setCellValue('F'.$rowNum, $row->waktu_absen ? date('d-m-Y H:i', strtotime($row->waktu_absen)) : '-');
          $sheet->setCellValue('G'.$rowNum, $row->kepuasan ?? '-');
          $sheet->getStyle('A'.$rowNum.':G'.$rowNum)->getBorders()
              ->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
          // zebra stripe
          if ($no % 2 == 0) {
              $sheet->getStyle('A'.$rowNum.':G'.$rowNum)->getFill()
                  ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                  ->getStartColor()->setRGB('EBF4FB');
          }
          $rowNum++;
      }

      // ── Auto-width kolom ──
      foreach ($cols as $col) {
          $sheet->getColumnDimension($col)->setAutoSize(true);
      }
      // batas lebar kolom E (saran) agar tidak terlalu lebar
      $sheet->getColumnDimension('E')->setWidth(40);
      $sheet->getStyle('E6:E'.$rowNum)->getAlignment()->setWrapText(true);

      // ── Download ──
      $writer   = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
      $nama_file = 'Absensi_' . preg_replace('/[^A-Za-z0-9_]/', '_', $kegiatan->nama_kegiatan) . '_' . date('Ymd') . '.xlsx';

      // Bersihkan output buffer agar tidak ada karakter sebelum header
      while (ob_get_level()) ob_end_clean();

      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="' . $nama_file . '"');
      header('Cache-Control: max-age=0');
      header('Pragma: public');

      $writer->save('php://output');
      exit;
  }
}
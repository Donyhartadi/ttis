<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'upload', 'form_validation']);
        $this->load->model('Laporan_model');
    }

    public function simpan()
{
    // === VALIDASI FORM ===
    $this->form_validation->set_rules('nama_pelapor', 'Nama Pelapor', 'required|trim');
    $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|numeric|trim');
    $this->form_validation->set_rules('judul_laporan', 'Jenis Laporan', 'required');
    $this->form_validation->set_rules('link', 'Link', 'required|trim');
    $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('error', validation_errors());
        redirect($_SERVER['HTTP_REFERER']);
        return;
    }

    // === VALIDASI CAPTCHA ===
    $recaptcha = $this->input->post('g-recaptcha-response');
    $secretKey = '6LcCUoMrAAAAAM1sdeEF6NHAWXHONPAALwO6yi2z'; // ganti dengan secret dari Google

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptcha}");
    $responseKeys = json_decode($response, true);

    if (!$responseKeys["success"]) {
        $this->session->set_flashdata('error', 'Verifikasi CAPTCHA belum diselesaikan.');
        redirect($_SERVER['HTTP_REFERER']);
        return;
    }

    // === UPLOAD FILE ===
    $config['upload_path'] = APPPATH . 'uploads/eviden/';
    $config['allowed_types'] = 'jpg|png|pdf';
    $config['max_size'] = 4096;

    $this->upload->initialize($config);

    if (!$this->upload->do_upload('eviden')) {
        $this->session->set_flashdata('error', $this->upload->display_errors());
        redirect($_SERVER['HTTP_REFERER']);
        return;
    }

    $upload_data = $this->upload->data();

    // === SIMPAN KE DATABASE ===
    $kode_resi = $this->generateResi();
    $data = [
        'kode_resi'       => $kode_resi,
        'nama_pelapor'    => $this->input->post('nama_pelapor', true),
        'no_hp'           => $this->input->post('no_hp', true),
        'judul_laporan'   => $this->input->post('judul_laporan', true),
        'link'            => $this->input->post('link', true),
        'deskripsi'       => $this->input->post('deskripsi', true),
        'eviden'          => $upload_data['file_name'],
        'status_laporan' => 'belum',
        'waktu_laporan'   => date('Y-m-d H:i:s')
    ];

    if ($this->Laporan_model->simpanLaporan($data)) {
        $this->session->set_flashdata('success', 'Laporan berhasil dikirim.');
        $this->session->set_flashdata('kode_resi', $kode_resi);
    } else {
        $this->session->set_flashdata('error', 'Gagal menyimpan laporan. Silakan coba lagi.');
    }
    redirect(base_url('welcome'));
    
}


    public function index()
    {
        // Hanya admin
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'A') {
            redirect('auth/login');
        }

        $this->load->library('pagination');
        $q = $this->input->get('q');

        $config['base_url'] = site_url('laporan/index');
        $config['total_rows'] = $this->Laporan_model->count_filtered($q);
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'start';

        // Pagination style
        $config['full_tag_open'] = '<ul class="pagination justify-content-center mt-4">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = ['class' => 'page-link'];

        $this->pagination->initialize($config);

        $start = (int)$this->input->get('start');
        $data['pagination'] = $this->pagination->create_links();
        $data['laporan'] = $this->Laporan_model->get_paginated($q, $config['per_page'], $start);
        $data['q'] = $q;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/top', $data);
        $this->load->view('admin/laporan', $data);
        $this->load->view('templates/footer', $data);
    }

    public function update_status($id)
    {
        $this->db->where('id_laporan', $id);
        $this->db->update('laporan', ['status_laporan' => 'sudah']);
        $this->session->set_flashdata('success', 'Status laporan berhasil diperbarui.');
        redirect('laporan');
    }


    // Laporan.php (Controller)
public function cetak()
{
    // Hanya admin
    if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'A') {
        redirect('auth/login');
    }

    $data['laporan'] = []; // kosong awal
    $this->load->view('templates/header');
    $this->load->view('templates/top');
    $this->load->view('admin/cetak_laporan', $data);
    $this->load->view('templates/footer');
}

public function cetak_filter()
{
    $tgl_awal  = $this->input->post('tanggal_awal');
    $tgl_akhir = $this->input->post('tanggal_akhir');

    $this->db->where('DATE(waktu_laporan) >=', $tgl_awal);
    $this->db->where('DATE(waktu_laporan) <=', $tgl_akhir);
    $laporan = $this->db->get('laporan')->result();

    $data['laporan'] = $laporan;
    $data['tgl_awal'] = $tgl_awal;
    $data['tgl_akhir'] = $tgl_akhir;

    $this->load->view('templates/header');
    $this->load->view('templates/top');
    $this->load->view('admin/cetak_laporan', $data);
    $this->load->view('templates/footer');
}


private function generateResi()
{
    $random = strtoupper(substr(md5(time() . rand()), 0, 8));
    return 'LAP-' . $random;
}

public function cek_resi()
{
    $kode_resi = $this->input->post('kode_resi', true);
    $data['hasil'] = null;

    if ($kode_resi) {
        $data['hasil'] = $this->Laporan_model->getByResi($kode_resi);
    }

    $this->load->view('welcome', $data); // ganti dengan nama view HTML yang kamu kirim tadi
}


public function cek_resi_ajax()
{
    $kode_resi = $this->input->post('kode_resi');
    $hasil = $this->Laporan_model->get_by_resi($kode_resi);

    if ($hasil) {
        echo json_encode(['status' => 'ok', 'data' => $hasil]);
    } else {
        echo json_encode(['status' => 'fail', 'message' => 'Kode resi tidak ditemukan.']);
    }
}


public function update_status_lanjutan($id)
{
    $status = $this->input->post('status', true);

    if (!in_array($status, ['Menunggu', 'Diproses', 'Selesai'])) {
        $this->session->set_flashdata('error', 'Status tidak valid.');
        redirect('laporan');
        return;
    }

    $this->db->where('id_laporan', $id);
    $this->db->update('laporan', ['status' => $status]);

    $this->session->set_flashdata('success', 'Status laporan berhasil diperbarui.');
    redirect('laporan');
}

}

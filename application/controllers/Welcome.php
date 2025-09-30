<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$data['title'] = "TTIS";
		$this->load->view('templates/public/header', $data);
		$this->load->view('templates/public/top');
		$this->load->view('welcome');
		$this->load->view('templates/public/footer');
		
	}

	public function lapor()
	{
		$data['title'] = "Lapor";
		$this->load->view('templates/public/header', $data);
		$this->load->view('templates/public/top');
		$this->load->view('lapor');
		$this->load->view('templates/public/footer');
		
	}


	public function berita()
	{
		$this->load->model('Berita_model'); // Pastikan model dimuat
		$this->load->helper('text');
		$data['berita'] = $this->Berita_model->get_all(); // Ambil semua berita
	
		$data['title'] = "Berita";
		$this->load->view('templates/public/header', $data);
		$this->load->view('templates/public/top');
		$this->load->view('berita', $data); // arahkan ke view berita
		$this->load->view('templates/public/footer');
	}

	public function detail($slug) {
		$this->load->model('Berita_model');
		$berita = $this->Berita_model->get_by_slug($slug);
		if (!$berita) show_404();
	  
		$data['berita'] = $berita;
		$this->load->view('templates/public/header');
		$this->load->view('templates/public/top');
		$this->load->view('berita_detail',$data);
		$this->load->view('templates/public/footer');
	}
	
	public function kegiatan() {
		$this->load->model('Kegiatan_model');
		$this->load->library('pagination');
		$this->load->helper(['url', 'form', 'text']);
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
	
		$this->load->view('templates/public/header');
		$this->load->view('templates/public/top');
		$this->load->view('kegiatan/list', $data);
		$this->load->view('templates/public/footer');
	}
	
// Detail kegiatan
public function detail_kegiatan($id) {
    $this->load->model(['Kegiatan_model', 'Absensi_model']);
    $kegiatan = $this->Kegiatan_model->get($id);
    if (!$kegiatan) show_404();

    $data['kegiatan'] = $kegiatan;
    $data['absensi']  = $this->Absensi_model->get_by_kegiatan($id);

    $this->load->view('templates/public/header');
    $this->load->view('templates/public/top');
    $this->load->view('kegiatan/detail', $data);
    $this->load->view('templates/public/footer');
}

// Absen
public function absen($id) {
    $this->load->model(['Kegiatan_model', 'Absensi_model']);
    $this->load->library('form_validation');

    $kegiatan = $this->Kegiatan_model->get($id);
    if (!$kegiatan) show_404();

    // 🚫 Cek apakah absensi dibuka
    if (empty($kegiatan->is_absensi_open) || !$kegiatan->is_absensi_open) {
        $this->session->set_flashdata('error', 'Absensi untuk kegiatan ini sudah ditutup.');
        redirect('welcome/detail/'.$id);
        return;
    }

    // Rules validasi
    $this->form_validation->set_rules('nama_peserta', 'Nama Lengkap', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('asal_opd', 'Asal Unit Kerja', 'required');
    $this->form_validation->set_rules('kepuasan', 'Kepuasan', 'required');

    if ($this->input->post()) {
        if ($this->form_validation->run() === TRUE) {

            // 🔎 Ambil respon captcha
            $captchaResponse = $this->input->post('g-recaptcha-response');

            // 🚨 Kalau user belum centang captcha
            if (empty($captchaResponse)) {
                $data['captcha_error'] = '⚠️ Silakan centang captcha terlebih dahulu.';
            } else {
                // ✅ Verifikasi ke Google
                $secretKey = '6LcCUoMrAAAAAM1sdeEF6NHAWXHONPAALwO6yi2z';

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
                    'secret'   => $secretKey,
                    'response' => $captchaResponse,
                    'remoteip' => $this->input->ip_address(),
                ]));
                $verifyResponse = curl_exec($ch);
                curl_close($ch);

                $responseData = json_decode($verifyResponse);

                if (!$responseData || empty($responseData->success)) {
                    $data['captcha_error'] = '⚠️ Verifikasi captcha gagal. Silakan coba lagi.';
                } else {
                    // ✅ Simpan absensi
                    $dataInsert = [
                        'kegiatan_id'   => $id,
                        'nama_peserta'  => $this->input->post('nama_peserta', true),
                        'email'         => $this->input->post('email', true),
                        'asal_opd'      => $this->input->post('asal_opd', true),
                        'saran_masukan' => $this->input->post('saran_masukan', true),
                        'kepuasan'      => $this->input->post('kepuasan', true),
                    ];
                    $this->Absensi_model->insert($dataInsert);

                    $this->session->set_flashdata('successAbsen', 'Absensi berhasil dicatat ✅');
                    redirect('welcome/detail_kegiatan/'.$id);
                    return;
                }
            }
        }
    }

    $data['kegiatan'] = $kegiatan;
    $this->load->view('templates/public/header');
    $this->load->view('templates/public/top');
    $this->load->view('kegiatan/absen_form', $data);
}
}

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
		$this->load->view('templates/public/header');
		$this->load->view('templates/public/top');
		$this->load->view('welcome');
		$this->load->view('templates/public/footer');
		
	}

	public function lapor()
	{
		$this->load->view('templates/public/header');
		$this->load->view('templates/public/top');
		$this->load->view('lapor');
		$this->load->view('templates/public/footer');
		
	}


	public function berita()
	{
		$this->load->model('Berita_model'); // Pastikan model dimuat
		$this->load->helper('text');
		$data['berita'] = $this->Berita_model->get_all(); // Ambil semua berita
	
		$this->load->view('templates/public/header');
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
    $kegiatan = $this->Kegiatan_model->get($id);
    if (!$kegiatan) show_404();

    // 🚫 Cek apakah absensi dibuka atau ditutup
    if (empty($kegiatan->is_absensi_open) || !$kegiatan->is_absensi_open) {
        $this->session->set_flashdata('error', 'Absensi untuk kegiatan ini sudah ditutup.');
        redirect('welcome/detail_kegiatan/'.$id);
        return;
    }

    if ($this->input->post()) {
        // ✅ Verifikasi reCAPTCHA
        $captchaResponse = $this->input->post('g-recaptcha-response');
        $secretKey = '6LcCUoMrAAAAAM1sdeEF6NHAWXHONPAALwO6yi2z'; // ganti dengan SECRET KEY dari Google
        $verifyResponse = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captchaResponse}"
        );
        $responseData = json_decode($verifyResponse);

        if (!$responseData->success) {
            $this->session->set_flashdata('error', 'Verifikasi captcha gagal. Silakan coba lagi.');
            redirect('welcome/detail_kegiatan/'.$id);
            return;
        }

        // ✅ Simpan absensi kalau captcha valid
        $data = [
            'kegiatan_id'   => $id,
            'nama_peserta'  => $this->input->post('nama_peserta', true),
            'email'         => $this->input->post('email', true),
            'saran_masukan' => $this->input->post('saran_masukan', true),
            'kepuasan'      => $this->input->post('kepuasan', true),
        ];
        $this->Absensi_model->insert($data);

        $this->session->set_flashdata('successAbsen', 'Absensi berhasil dicatat.');
        redirect('welcome/detail_kegiatan/'.$id);
    }

    $data['kegiatan'] = $kegiatan;
    $this->load->view('templates/public/header');
    $this->load->view('templates/public/top');
    $this->load->view('kegiatan/absen_form', $data);
    $this->load->view('templates/public/footer');
}


}

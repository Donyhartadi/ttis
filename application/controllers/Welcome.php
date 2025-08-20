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
		$this->load->view('templates/header');
		$this->load->view('templates/public/top');
		$this->load->view('berita_detail',$data);
		$this->load->view('templates/public/footer');
	  }
	
}

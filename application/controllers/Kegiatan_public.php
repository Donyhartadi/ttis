<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan_public extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kegiatan_model');
        $this->load->helper(['url', 'text']);
        $this->load->library('pagination');
    }

    // Daftar kegiatan
    public function index() {
        $keyword = $this->input->get('q');
        $page    = (int) $this->input->get('per_page');

        // Konfigurasi pagination
        $config['base_url']            = site_url('kegiatan_public/index?q=' . urlencode($keyword));
        $config['total_rows']          = $this->Kegiatan_model->count_all($keyword);
        $config['per_page']            = 6;
        $config['page_query_string']   = TRUE;

        // Styling bootstrap
        $config['full_tag_open']   = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']  = '</ul></nav>';
        $config['first_link']      = 'Pertama';
        $config['first_tag_open']  = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_link']       = 'Terakhir';
        $config['last_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close']  = '</span></li>';
        $config['next_link']       = '›';
        $config['next_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close']  = '</span></li>';
        $config['prev_link']       = '‹';
        $config['prev_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close']  = '</span></li>';
        $config['cur_tag_open']    = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']   = '</span></li>';
        $config['num_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']   = '</span></li>';

        $this->pagination->initialize($config);

        $data['kegiatan']   = $this->Kegiatan_model->get_all($config['per_page'], $page, $keyword);
        $data['pagination'] = $this->pagination->create_links();
        $data['keyword']    = $keyword;

        $this->load->view('templates/header');
        $this->load->view('kegiatan/public/list', $data);
        $this->load->view('templates/footer');
    }

    // Detail kegiatan
    public function detail($id) {
        $kegiatan = $this->Kegiatan_model->get($id);
        if (!$kegiatan) show_404();

        $data['kegiatan'] = $kegiatan;

        $this->load->view('templates/header');
        $this->load->view('kegiatan/public/detail', $data);
        $this->load->view('templates/footer');
    }
}

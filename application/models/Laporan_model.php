<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function simpanLaporan($data)
    {
        return $this->db->insert('laporan', $data);
    }

    public function getAll()
{
    return $this->db->order_by('waktu_laporan', 'DESC')->get('laporan')->result();
}
public function search_all($keyword = null)
{
    if ($keyword) {
        $this->db->group_start();
        $this->db->like('nama_pelapor', $keyword);
        $this->db->or_like('judul_laporan', $keyword);
        $this->db->or_like('deskripsi', $keyword);
        $this->db->group_end();
    }

    $this->db->order_by('waktu_laporan', 'DESC');
    return $this->db->get('laporan')->result();
}

public function count_filtered($keyword = null)
{
    if ($keyword) {
        $this->db->group_start();
        $this->db->like('nama_pelapor', $keyword);
        $this->db->or_like('judul_laporan', $keyword);
        $this->db->or_like('deskripsi', $keyword);
        $this->db->group_end();
    }
    return $this->db->count_all_results('laporan');
}

public function get_paginated($keyword = null, $limit = 6, $start = 0)
{
    if ($keyword) {
        $this->db->group_start();
        $this->db->like('nama_pelapor', $keyword);
        $this->db->or_like('judul_laporan', $keyword);
        $this->db->or_like('deskripsi', $keyword);
        $this->db->group_end();
    }
    $this->db->order_by('waktu_laporan', 'DESC');
    return $this->db->get('laporan', $limit, $start)->result();
}



public function laporan_per_bulan($limit = 6)
{
    $this->db->select("DATE_FORMAT(waktu_laporan, '%Y-%m') as bulan, COUNT(*) as jumlah");
    $this->db->from('laporan');
    $this->db->group_by("DATE_FORMAT(waktu_laporan, '%Y-%m')");
    $this->db->order_by('bulan', 'DESC');
    $this->db->limit($limit);
    $query = $this->db->get();
    return array_reverse($query->result_array()); // biar urut dari bulan lama ke terbaru
}

public function count_by_status($status)
{
    return $this->db->where('status', $status)->count_all_results('laporan');
}

public function filter_by_date($tgl_awal, $tgl_akhir)
{
    $this->db->where('waktu_laporan >=', $tgl_awal . ' 00:00:00');
    $this->db->where('waktu_laporan <=', $tgl_akhir . ' 23:59:59');
    return $this->db->get('laporan')->result();
}

public function getByResi($kode_resi)
{
    return $this->db->get_where('laporan', ['kode_resi' => $kode_resi])->row_array();
}

public function get_by_resi($kode_resi)
{
    return $this->db->get_where('laporan', ['kode_resi' => $kode_resi])->row_array();
}

}

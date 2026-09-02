<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rfc2350_model extends CI_Model {

    private $table = 'rfc2350';

    // Get dokumen RFC aktif
    public function get_aktif()
    {
        $this->db->where('status', 'aktif');
        $this->db->order_by('tanggal_publikasi', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        
        $result = $query->row();
        
        // Debug
        log_message('info', 'Rfc2350_model->get_aktif() query: ' . $this->db->last_query());
        log_message('info', 'Rfc2350_model->get_aktif() result: ' . (!empty($result) ? $result->nama_file : 'EMPTY'));
        
        return $result;
    }

    // Get dokumen by ID
    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        
        return $query->row();
    }

    // Get semua dokumen (termasuk arsip)
    public function get_all()
    {
        $this->db->order_by('tanggal_publikasi', 'DESC');
        $query = $this->db->get($this->table);
        
        return $query->result();
    }

    // Insert dokumen baru
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Update dokumen
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Delete dokumen
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    // Set dokumen sebagai aktif (dan yang lain jadi arsip)
    public function set_aktif($id)
    {
        // Set semua jadi arsip
        $this->db->update($this->table, ['status' => 'arsip']);
        
        // Set yang dipilih jadi aktif
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['status' => 'aktif']);
    }
}

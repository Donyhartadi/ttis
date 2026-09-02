<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak_model extends CI_Model {

    private $table_info = 'kontak_info';
    private $table_operator = 'kontak_operator';
    private $table_dokumen = 'kontak_dokumen';
    private $table_publickey = 'kontak_publickey';

    // ===== KONTAK INFO =====
    
    // Get informasi kontak (alamat, map)
    public function get_kontak_info()
    {
        $query = $this->db->get($this->table_info);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        
        // Return default jika belum ada data
        return (object) [
            'id' => 0,
            'alamat' => '',
            'latitude' => '',
            'longitude' => '',
            'email' => '',
            'jam_operasional' => '',
            'google_maps_api_key' => ''
        ];
    }

    // Update informasi kontak
    public function update_kontak_info($data)
    {
        // Cek apakah sudah ada data
        $existing = $this->db->get($this->table_info)->row();
        
        if ($existing) {
            return $this->db->where('id', $existing->id)->update($this->table_info, $data);
        } else {
            return $this->db->insert($this->table_info, $data);
        }
    }

    // ===== OPERATOR =====
    
    // Get semua operator
    public function get_all_operator()
    {
        return $this->db->order_by('urutan', 'ASC')->order_by('id', 'ASC')->get($this->table_operator)->result();
    }

    // Get satu operator
    public function get_operator($id)
    {
        return $this->db->get_where($this->table_operator, ['id' => $id])->row();
    }

    // Insert operator baru
    public function insert_operator($data)
    {
        return $this->db->insert($this->table_operator, $data);
    }

    // Update operator
    public function update_operator($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table_operator, $data);
    }

    // Delete operator
    public function delete_operator($id)
    {
        return $this->db->where('id', $id)->delete($this->table_operator);
    }

    // ===== DOKUMEN =====
    
    // Get semua dokumen
    public function get_all_dokumen()
    {
        return $this->db->order_by('tanggal_upload', 'DESC')->get($this->table_dokumen)->result();
    }

    // Get satu dokumen
    public function get_dokumen($id)
    {
        return $this->db->get_where($this->table_dokumen, ['id' => $id])->row();
    }

    // Insert dokumen baru
    public function insert_dokumen($data)
    {
        return $this->db->insert($this->table_dokumen, $data);
    }

    // Update dokumen
    public function update_dokumen($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table_dokumen, $data);
    }

    // Delete dokumen
    public function delete_dokumen($id)
    {
        return $this->db->where('id', $id)->delete($this->table_dokumen);
    }

    // Increment download counter
    public function increment_download($id)
    {
        $this->db->set('jumlah_download', 'jumlah_download + 1', FALSE);
        return $this->db->where('id', $id)->update($this->table_dokumen);
    }

    // ===== PUBLIC KEY =====
    
    // Get semua public key
    public function get_all_publickey()
    {
        return $this->db->order_by('tanggal_upload', 'DESC')->get($this->table_publickey)->result();
    }

    // Get satu public key
    public function get_publickey($id)
    {
        return $this->db->get_where($this->table_publickey, ['id' => $id])->row();
    }

    // Insert public key baru
    public function insert_publickey($data)
    {
        return $this->db->insert($this->table_publickey, $data);
    }

    // Update public key
    public function update_publickey($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table_publickey, $data);
    }

    // Delete public key
    public function delete_publickey($id)
    {
        return $this->db->where('id', $id)->delete($this->table_publickey);
    }

    // Increment download counter
    public function increment_publickey_download($id)
    {
        $this->db->set('jumlah_download', 'jumlah_download + 1', FALSE);
        return $this->db->where('id', $id)->update($this->table_publickey);
    }
}

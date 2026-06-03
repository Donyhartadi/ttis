<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan_model extends CI_Model {

    private $table = 'kegiatan';

    public function get_all($limit = 0, $offset = 0, $keyword = null) {
        if ($keyword) {
            $this->db->group_start()
                     ->like('nama_kegiatan', $keyword)
                     ->or_like('keterangan', $keyword)
                     ->group_end();
        }
        if ($limit > 0) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }
    
    public function count_all($keyword = null) {
        if ($keyword) {
            $this->db->group_start()
                     ->like('nama_kegiatan', $keyword)
                     ->or_like('keterangan', $keyword)
                     ->group_end();
        }
        return $this->db->count_all_results($this->table);
    }

    public function get($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function get_by_slug($slug) {
        return $this->db->get_where($this->table, ['slug' => $slug])->row();
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_model extends CI_Model {

    private $table = 'absensi';

    public function get_by_kegiatan($kegiatan_id) {
        return $this->db->where('kegiatan_id', $kegiatan_id)
                        ->order_by('waktu_absen', 'DESC')
                        ->get($this->table)
                        ->result();
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita_model extends CI_Model {

  private $table = 'berita';

  public function get_all() {
    return $this->db->order_by('id', 'DESC')->get($this->table)->result();
  }

  public function get($id) {
    return $this->db->get_where($this->table, ['id' => $id])->row();
  }

  public function insert($data) {
    return $this->db->insert($this->table, $data);
  }

  public function update($id, $data) {
    return $this->db->where('id', $id)->update($this->table, $data);
  }

  public function delete($id) {
    return $this->db->where('id', $id)->delete($this->table);
  }

  public function get_by_slug($slug) {
    return $this->db->get_where('berita', ['slug' => $slug])->row();
  }
  
  public function getJumlahBeritaPerBulan()
  {
      $this->db->select("DATE_FORMAT(tanggal, '%M %Y') AS bulan, COUNT(*) AS jumlah");
      $this->db->from('berita');
      $this->db->where('status', 'publish');
      $this->db->group_by(['YEAR(tanggal)', 'MONTH(tanggal)']);
      $this->db->order_by('tanggal', 'ASC');

      return $this->db->get()->result();
  }

}

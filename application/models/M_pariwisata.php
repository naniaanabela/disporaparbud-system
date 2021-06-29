<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pariwisata extends CI_Model {
  public function check($tahun, $objek_wisata) {
    $query = $this->db->get_where('v_pariwisata', array('tahun' => $tahun, 'objek_wisata' => $objek_wisata));

    if($query->num_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function get_data($id_pariwisata, $column) {
    $query = $this->db->get_where('v_pariwisata', array('id_pariwisata' => $id_pariwisata))->row();

    return $query->$column;
  }
}
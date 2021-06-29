<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_clustering extends CI_Model {
  public function get_hasil($id_perhitungan) {
    $this->db->order_by('iterasi', 'DESC');
    $this->db->limit(1);
    $this->db->where('id_perhitungan', $id_perhitungan);
    $query = $this->db->get('v_detail_perhitungan')->row();

    return unserialize($query->hasil_akhir);
  }

  public function get_hasil_persentase($id_perhitungan) {
    $this->db->order_by('iterasi', 'DESC');
    $this->db->limit(1);
    $this->db->where('id_perhitungan', $id_perhitungan);
    $query = $this->db->get('v_detail_perhitungan')->row();

    $result = "";

    $hasil_akhir = unserialize($query->hasil_akhir);

    for($i=1; $i<=$query->jumlah_cluster; $i++) {
      $jumlah_objek_wisata = 0;

      foreach($hasil_akhir as $row) {
        if($row['cluster'] === 'w' . $i) {
          $jumlah_objek_wisata += 1;
        }
      }

      $persentase = ($jumlah_objek_wisata * 100) / count($hasil_akhir);

      if($i == 1) {
        $result .= "[" . $persentase . ",";
      } else if($i == $query->jumlah_cluster) {
        $result .= $persentase . "]";
      } else {
        $result .= $persentase . ",";
      }
    }

    return $result;
  }
}
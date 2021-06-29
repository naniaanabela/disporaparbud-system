<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor extends CI_Controller {
  public function __construct() {
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		
		// Check session
    if(!is_login()) {
      redirect('login');
    }
	}

  public function index() {
    $this->db->select('tahun');
    $this->db->group_by('tahun');
    $semua_tahun = $this->db->get('v_pariwisata')->result();

    $arr_tahun = array();
    $arr_sapras = array();
    $arr_datar = array();
    $arr_wisnus = array();
    $arr_wisman = array();
    $min_tahun = date('Y');

    if(count($semua_tahun) > 0) {
      foreach($semua_tahun as $row) {
        $arr_tahun[] = $row->tahun;
        $total_sapras = 0;
        $total_datar = 0;
        $total_wisnus = 0;
        $total_wisman = 0;

        $semua_pariwisata = $this->db->get_where('v_pariwisata', array('tahun' => $row->tahun))->result();

        foreach($semua_pariwisata as $row2) {
          $total_sapras += $row2->sarana_prasarana;
          $total_datar += $row2->daya_tarik;
          $total_wisnus += $row2->wisnus;
          $total_wisman += $row2->wisman;
        }

        $arr_sapras[$row->tahun] = round($total_sapras / count($semua_pariwisata), 2);
        $arr_datar[$row->tahun] = round($total_datar / count($semua_pariwisata), 0);
        $arr_wisnus[] = round($total_wisnus / count($semua_pariwisata), 0);
        $arr_wisman[] = round($total_wisman / count($semua_pariwisata), 0);
      }

      $min_tahun = min($arr_tahun);
    }

    $parser['min_tahun'] = $min_tahun;
    $parser['data_sapras'] = $arr_sapras;
    $parser['data_datar'] = $arr_datar;
    $parser['data_wisnus'] = json_encode($arr_wisnus);
    $parser['data_wisnus'] = json_encode($arr_wisnus);
    $parser['data_wisman'] = json_encode($arr_wisman);

    $this->load->view('dasbor/index', $parser);
  }
}

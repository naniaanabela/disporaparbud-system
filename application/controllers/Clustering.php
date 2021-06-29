<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clustering extends CI_Controller {
  public function __construct() {
		parent::__construct();

    $this->load->model('m_pariwisata');
    $this->load->model('m_clustering');

		date_default_timezone_set('Asia/Jakarta');
		
		$this->session->set_userdata('title', 'Clustering'); //session adalah menyimpan data ke server, biar datanya bisa di panggil
		$this->session->set_userdata('subtitle', 'Kelola data clustering.');

    // Check session
    if(!is_login()) {
      redirect('login');
    }
	}

  public function get_max_value($arr, $key) { //fungsi mendapatkan nilai maksimal
    $max = 0;

    foreach($arr as $row) { 
      if($row[$key] > $max) {
        $max = $row[$key];
      }
    }

    return $max;
  }

  public function get_min_value($arr, $key) {
    $min = "";

    foreach($arr as $row) {
      if($min === '') {
        $min = $row[$key];
      } else {
        if($row[$key] < $min) {
          $min = $row[$key];
        }
      }
    }

    return $min;
  }

  public function get_average($data, $kriteria, $cluster) {
    $arr = array();
    $avg = 0;
    $sum = 0;

    foreach($data as $row) {
      if($row['cluster'] === $cluster) {
        array_push($arr, $row);
      }
    }

    foreach($arr as $row) {
      $sum += $row[$kriteria];
    }

    $avg = ($sum !== 0 ? $sum / count($arr) : 0);

    return $avg;
  }

  public function get_filter_data($arr, $cluster) { //fungsi untuk membuat data array yang berisikan data cluster
    $result = array();

    foreach($arr as $row) {
      if($row['cluster'] == $cluster) {
        array_push($result, $row);
      }
    }

    return $result;
  }

  public function get_data_value($arr, $id_pariwisata, $key) {
    $value = "";

    foreach($arr as $row) {
      if($row['id_pariwisata'] === $id_pariwisata) {
        $value = $row[$key];
      }
    }

    return $value;
  }

  public function get_value_bi($avg, $cluster, $except, $z) {
    $arr = array();

    for($i=0; $i<$cluster; $i++) {
      if($i !== $except) {
        $arr[] = $avg[$i][$z];
      }
    }

    return min($arr);
  }

  public function get_value_total_bi($avg, $cluster, $except) {
    $arr = array();

    for($i=0; $i<$cluster; $i++) {
      if($i !== $except) {
        $arr[] = $avg[$i];
      }
    }

    return min($arr);
  }

  public function index() {
    $semua_perhitungan = $this->db->get('v_perhitungan')->result();

    $parser['semua_perhitungan'] = $semua_perhitungan;

    $this->load->view('clustering/list', $parser);
  }

  public function generate() {
    $this->session->set_userdata('title', 'Perhitungan Cluster'); 
    $this->session->set_userdata('subtitle', 'Lakukan perhitungan clustering dengan metode Self Organizing Map (SOM).');

    $this->db->group_by('tahun');
    $semua_tahun = $this->db->get('v_pariwisata')->result();

    $parser['semua_tahun'] = $semua_tahun;

    $this->load->view('clustering/generate', $parser);
  }

  public function do_generate() {
    // Input
    $tahun = $this->input->post('tahun');
    $jumlah_cluster = $this->input->post('jumlah_cluster');
    $learning_rate = $this->input->post('learning_rate');
    $jumlah_iterasi = $this->input->post('jumlah_iterasi');

    $iterasi_sukses = 0;
    $semua_pariwisata = $this->db->get_where('tb_pariwisata', array('tahun' => $tahun))->result();

    // Data Olah
    $data_olah = array();
    
    foreach($semua_pariwisata as $row) {
      $temp = array(
        'id_pariwisata' => $row->id_pariwisata,
        'tahun' => $row->tahun,
        'objek_wisata' => $row->objek_wisata,
        'wisnus' => $row->wisnus,
        'wisman' => $row->wisman,
        'sarana_prasarana' => $row->sarana_prasarana,
        'daya_tarik' => $row->daya_tarik
      );

      array_push($data_olah, $temp);
    }

    // Max nilai
    $max_wisnus = $this->get_max_value($data_olah, 'wisnus');
    $max_wisman = $this->get_max_value($data_olah, 'wisman');
    $max_sarana_prasarana = $this->get_max_value($data_olah, 'sarana_prasarana');
    $max_daya_tarik = $this->get_max_value($data_olah, 'daya_tarik');

    // Normalisasi
    $normalisasi = array();

    foreach($semua_pariwisata as $row) {
      $temp = array(
        'id_pariwisata' => $row->id_pariwisata,
        'tahun' => $row->tahun,
        'objek_wisata' => $row->objek_wisata,
        'wisnus' => ($row->wisnus / $max_wisnus),
        'wisman' => ($row->wisman / $max_wisman),
        'sarana_prasarana' => ($row->sarana_prasarana / $max_sarana_prasarana),
        'daya_tarik' => ($row->daya_tarik / $max_daya_tarik)
      );

      array_push($normalisasi, $temp); //dimasukkan ke dalam variabel normalisasi, isinya temp
    }

    // Simpan perhitungan
    $data_perhitungan = array(
      'data_olah' => serialize($data_olah),
      'normalisasi' => serialize($normalisasi),
      'tahun' => $tahun,
      'jumlah_cluster' => $jumlah_cluster,
      'learning_rate' => $learning_rate,
      'jumlah_iterasi' => $jumlah_iterasi,
      'ditambahkan_oleh' => $this->session->userdata('id_administrator') // nanti ambil dari session login
    );

    $insert_perhitungan = $this->db->insert('tb_perhitungan', $data_perhitungan);

    if($insert_perhitungan) {
      $id_perhitungan = $this->db->insert_id(); //fungsi dari CI otomatis mencari primary key

      // Bobot Awal
      $bobot_awal = array();

      for($w=1; $w<=$jumlah_cluster; $w++) {
        $bobot_awal['w' . $w]['wisnus'] = $this->input->post('wisnus_w' . $w);
        $bobot_awal['w' . $w]['wisman'] = $this->input->post('wisman_w' . $w);
        $bobot_awal['w' . $w]['sarana_prasarana'] = $this->input->post('sarana_prasarana_w' . $w);
        $bobot_awal['w' . $w]['daya_tarik'] = $this->input->post('daya_tarik_w' . $w);
      }
      
      
      // Iterasi
      for($i=1; $i<=$jumlah_iterasi; $i++) {
        $bobot_awal_temp = $bobot_awal;
        $euclidean_distance = array();
        $bobot_akhir = array();
        $hasil_akhir = array();

        foreach($normalisasi as $key => $value) {
          $jarak_minimum = 0;

          // Euclidean Distance
          for($w=1; $w<=$jumlah_cluster; $w++) {
            $euclidean_distance[$value['id_pariwisata']]['w' . $w] = sqrt( (pow(($bobot_awal['w' . $w]['wisnus'] - $value['wisnus']), 2)) + (pow(($bobot_awal['w' . $w]['wisman'] - $value['wisman']), 2)) + (pow(($bobot_awal['w' . $w]['sarana_prasarana'] - $value['sarana_prasarana']), 2)) + (pow(($bobot_awal['w' . $w]['daya_tarik'] - $value['daya_tarik']), 2)) );

            // Jarak Minimum
            if($w === 1) {
              $jarak_minimum = $euclidean_distance[$value['id_pariwisata']]['w' . $w];
            } else {
              if($euclidean_distance[$value['id_pariwisata']]['w' . $w] < $jarak_minimum) {
                $jarak_minimum = $euclidean_distance[$value['id_pariwisata']]['w' . $w];
              }
            }
          }

          $euclidean_distance[$value['id_pariwisata']]['jarak_minimum'] = $jarak_minimum;

          // Bobot Akhir
          for($w=1; $w<=$jumlah_cluster; $w++) {
            $bobot_akhir[$value['id_pariwisata']]['w' . $w]['wisnus'] = ( $euclidean_distance[$value['id_pariwisata']]['jarak_minimum'] === $euclidean_distance[$value['id_pariwisata']]['w' . $w] ? ($bobot_awal['w' . $w]['wisnus'] + ($learning_rate * ($value['wisnus'] - $bobot_awal['w' . $w]['wisnus']))) : $bobot_awal['w' . $w]['wisnus'] );
            
            $bobot_akhir[$value['id_pariwisata']]['w' . $w]['wisman'] = ( $euclidean_distance[$value['id_pariwisata']]['jarak_minimum'] === $euclidean_distance[$value['id_pariwisata']]['w' . $w] ? ($bobot_awal['w' . $w]['wisman'] + ($learning_rate * ($value['wisman'] - $bobot_awal['w' . $w]['wisman']))) : $bobot_awal['w' . $w]['wisman'] );
            
            $bobot_akhir[$value['id_pariwisata']]['w' . $w]['sarana_prasarana'] = ( $euclidean_distance[$value['id_pariwisata']]['jarak_minimum'] === $euclidean_distance[$value['id_pariwisata']]['w' . $w] ? ($bobot_awal['w' . $w]['sarana_prasarana'] + ($learning_rate * ($value['sarana_prasarana'] - $bobot_awal['w' . $w]['sarana_prasarana']))) : $bobot_awal['w' . $w]['sarana_prasarana'] );
            
            $bobot_akhir[$value['id_pariwisata']]['w' . $w]['daya_tarik'] = ( $euclidean_distance[$value['id_pariwisata']]['jarak_minimum'] === $euclidean_distance[$value['id_pariwisata']]['w' . $w] ? ($bobot_awal['w' . $w]['daya_tarik'] + ($learning_rate * ($value['daya_tarik'] - $bobot_awal['w' . $w]['daya_tarik']))) : $bobot_awal['w' . $w]['daya_tarik'] );

            // Update Bobot Awal
            $bobot_awal['w' . $w]['wisnus'] = $bobot_akhir[$value['id_pariwisata']]['w' . $w]['wisnus'];
            $bobot_awal['w' . $w]['wisman'] = $bobot_akhir[$value['id_pariwisata']]['w' . $w]['wisman'];
            $bobot_awal['w' . $w]['sarana_prasarana'] = $bobot_akhir[$value['id_pariwisata']]['w' . $w]['sarana_prasarana'];
            $bobot_awal['w' . $w]['daya_tarik'] = $bobot_akhir[$value['id_pariwisata']]['w' . $w]['daya_tarik'];
          }

          // Hasil Akhir
          for($w=1; $w<=$jumlah_cluster; $w++) {
            if($euclidean_distance[$value['id_pariwisata']]['jarak_minimum'] === $euclidean_distance[$value['id_pariwisata']]['w' . $w]) {
              $value['cluster'] = "w" . $w;
            }
          }

          array_push($hasil_akhir, $value);
        }

        // Simpan detail perhitungan
        $data_detail_perhitungan = array(
          'id_perhitungan' => $id_perhitungan,
          'iterasi' => $i,
          'bobot_awal' => serialize($bobot_awal_temp),
          'euclidean_distance' => serialize($euclidean_distance),
          'bobot_akhir' => serialize($bobot_akhir),
          'hasil_akhir' => serialize($hasil_akhir)
        );

        $insert_detail_perhitungan = $this->db->insert('tb_detail_perhitungan', $data_detail_perhitungan);

        if($insert_detail_perhitungan) {
          $iterasi_sukses += 1;
        }
      }

      // Cek Iterasi
      if($iterasi_sukses == $jumlah_iterasi) {
        $this->session->set_flashdata('status', 'Sukses');
        $this->session->set_flashdata('message', 'Clustering berhasil ditambahkan.');

        redirect('clustering');
      } else {
        // Hapus perhitungan
        $this->db->delete('tb_perhitungan', array('id_perhitungan' => $id_perhitungan));

        $this->session->set_flashdata('status', 'Gagal');
        $this->session->set_flashdata('message', 'Clustering gagal ditambahkan.');

        redirect('clustering');  
      }
    } else {
      $this->session->set_flashdata('status', 'Gagal');
      $this->session->set_flashdata('message', 'Clustering gagal ditambahkan.');

      redirect('clustering');
    }
  }

  public function do_delete($id_perhitungan='') {
    if($id_perhitungan === '') {
      $this->session->set_flashdata('status', 'Gagal');
      $this->session->set_flashdata('message', 'Clustering gagal dihapus.');

      redirect('clustering');
    }

    $delete = $this->db->delete('tb_perhitungan', array('id_perhitungan' => $id_perhitungan));

    if($delete) {
      $this->session->set_flashdata('status', 'Sukses');
      $this->session->set_flashdata('message', 'Clustering berhasil dihapus.');

      redirect('clustering');
    } else {
      $this->session->set_flashdata('status', 'Gagal');
      $this->session->set_flashdata('message', 'Clustering gagal dihapus.');

      redirect('clustering');
    }
  }

  public function result($id_perhitungan='') {
    if($id_perhitungan === '') {
      $this->session->set_flashdata('status', 'Gagal');
      $this->session->set_flashdata('message', 'Tidak dapat menemukan data hasil clustering.');

      redirect('clustering');
    }

    $perhitungan = $this->db->get_where('v_perhitungan', array('id_perhitungan' => $id_perhitungan))->row();
    $detail_perhitungan = $this->db->get_where('v_detail_perhitungan', array('id_perhitungan' => $id_perhitungan))->result();

    $this->session->set_userdata('title', 'Hasil Clustering');
		$this->session->set_userdata('subtitle', 'Dilakukan pada tanggal ' . date('M d, Y H:i A', strtotime($perhitungan->tanggal_perhitungan)));

    // Menentukan rekomendasawaaaaaaaa
    $jumlah_cluster = $perhitungan->jumlah_cluster;

    // Kriteria
    $kriteria['wisnus'] = array('atribut' => 'B', 'bobot' => 0.3);
    $kriteria['wisman'] = array('atribut' => 'B', 'bobot' => 0.2);
    $kriteria['sarana_prasarana'] = array('atribut' => 'B', 'bobot' => 0.8);
    $kriteria['daya_tarik'] = array('atribut' => 'B', 'bobot' => 0.15);

    // Data Olah
    $data_olah = array();

    foreach($this->m_clustering->get_hasil($id_perhitungan) as $row) {
      $temp = array(
        'id_pariwisata' => $row['id_pariwisata'],
        'tahun' => $row['tahun'],
        'objek_wisata' => $row['objek_wisata'],
        'wisnus' => $this->m_pariwisata->get_data($row['id_pariwisata'], 'wisnus'),
        'wisman' => $this->m_pariwisata->get_data($row['id_pariwisata'], 'wisman'),
        'sarana_prasarana' => $this->m_pariwisata->get_data($row['id_pariwisata'], 'sarana_prasarana'),
        'daya_tarik' => $this->m_pariwisata->get_data($row['id_pariwisata'], 'daya_tarik'),
        'cluster' => $row['cluster']
      );

      array_push($data_olah, $temp);
    }

    // Prioritas Cluster
    
    // Cluster Awal
    $arr_cluster = array();

    for($i=1; $i<=$jumlah_cluster; $i++) {
      $arr_cluster['w' . $i]['wisnus'] = $this->get_average($data_olah, 'wisnus', 'w' . $i);
      $arr_cluster['w' . $i]['wisman'] = $this->get_average($data_olah, 'wisman', 'w' . $i);
      $arr_cluster['w' . $i]['sarana_prasarana'] = $this->get_average($data_olah, 'sarana_prasarana', 'w' . $i);
      $arr_cluster['w' . $i]['daya_tarik'] = $this->get_average($data_olah, 'daya_tarik', 'w' . $i);

      //var_dump($arr_cluster); die;
    }

    // Cluster Normalisasi
    $arr_cluster_normalisasi = array();

    for($i=1; $i<=$jumlah_cluster; $i++) {
      if($arr_cluster['w' . $i]['wisnus'] !== 0) {
        $arr_cluster_normalisasi['w' . $i]['wisnus'] = ($kriteria['wisnus']['atribut'] === 'B' ? ($arr_cluster['w' . $i]['wisnus'] / $this->get_max_value($arr_cluster, 'wisnus')) : ($this->get_min_value($arr_cluster, 'wisnus') / $arr_cluster['w' . $i]['wisnus']));
      } else {
        $arr_cluster_normalisasi['w' . $i]['wisnus'] = 0;
      }

      if($arr_cluster['w' . $i]['wisnus'] !== 0) {
        $arr_cluster_normalisasi['w' . $i]['wisman'] = ($kriteria['wisman']['atribut'] === 'B' ? ($arr_cluster['w' . $i]['wisman'] / $this->get_max_value($arr_cluster, 'wisman')) : ($this->get_min_value($arr_cluster, 'wisman') / $arr_cluster['w' . $i]['wisman']));
      } else {
        $arr_cluster_normalisasi['w' . $i]['wisman'] = 0;
      }

      if($arr_cluster['w' . $i]['sarana_prasarana'] !== 0) {
        $arr_cluster_normalisasi['w' . $i]['sarana_prasarana'] = ($kriteria['sarana_prasarana']['atribut'] === 'C' ? ($arr_cluster['w' . $i]['sarana_prasarana'] / $this->get_max_value($arr_cluster, 'sarana_prasarana')) : ($this->get_min_value($arr_cluster, 'sarana_prasarana') / $arr_cluster['w' . $i]['sarana_prasarana']));
      } else {
        $arr_cluster_normalisasi['w' . $i]['sarana_prasarana'] = 0;
      }

      if($arr_cluster['w' . $i]['daya_tarik'] !== 0) {
        $arr_cluster_normalisasi['w' . $i]['daya_tarik'] = ($kriteria['daya_tarik']['atribut'] === 'B' ? ($arr_cluster['w' . $i]['daya_tarik'] / $this->get_max_value($arr_cluster, 'daya_tarik')) : ($this->get_min_value($arr_cluster, 'daya_tarik') / $arr_cluster['w' . $i]['daya_tarik']));
      } else {
        $arr_cluster_normalisasi['w' . $i]['daya_tarik'] = 0;
      }
    }

    // Cluster Order
    $arr_cluster_order = array();

    for($i=1; $i<=$jumlah_cluster; $i++) {
      $arr_cluster_order['w' . $i] = ($arr_cluster_normalisasi['w' . $i]['wisnus'] * $kriteria['wisnus']['bobot']) + ($arr_cluster_normalisasi['w' . $i]['wisman'] * $kriteria['wisman']['bobot']) + ($arr_cluster_normalisasi['w' . $i]['sarana_prasarana'] * $kriteria['sarana_prasarana']['bobot']) + ($arr_cluster_normalisasi['w' . $i]['daya_tarik'] * $kriteria['daya_tarik']['bobot']);
    }

    $temp_cluster_order = $arr_cluster_order;
    $urutan_cluster = 1;

    arsort($temp_cluster_order);
    foreach($temp_cluster_order as $key => $value) {
      $arr_cluster_order[$key] = array('total' => $value, 'urutan' => $urutan_cluster++);
    }

    // Update Urutan Cluster
    for($i=0; $i<count($data_olah); $i++) {
      $data_olah[$i]['urutan_cluster'] = $arr_cluster_order[$data_olah[$i]['cluster']]['urutan'];
    }

    // Objek Wisata
    for($i=1; $i<=$jumlah_cluster; $i++) {
      $arr = $this->get_filter_data($data_olah, 'w' . $i);
      
      // Objek Normalisasi
      $arr_objek_normalisasi = array();

      foreach($arr as $row) {
        $arr_objek_normalisasi[$row['id_pariwisata']]['wisnus'] = ($kriteria['wisnus']['atribut'] === 'B' ? ($this->get_data_value($data_olah, $row['id_pariwisata'], 'wisnus') / $this->get_max_value($arr, 'wisnus')) : ($this->get_min_value($arr, 'wisnus') / $this->get_data_value($data_olah, $row['id_pariwisata'], 'wisnus')));
        $arr_objek_normalisasi[$row['id_pariwisata']]['wisman'] = ($kriteria['wisman']['atribut'] === 'B' ? ($this->get_data_value($data_olah, $row['id_pariwisata'], 'wisman') / $this->get_max_value($arr, 'wisman')) : ($this->get_min_value($arr, 'wisman') / $this->get_data_value($data_olah, $row['id_pariwisata'], 'wisman')));
        $arr_objek_normalisasi[$row['id_pariwisata']]['sarana_prasarana'] = ($kriteria['sarana_prasarana']['atribut'] === 'B' ? ($this->get_data_value($data_olah, $row['id_pariwisata'], 'sarana_prasarana') / $this->get_max_value($arr, 'sarana_prasarana')) : ($this->get_min_value($arr, 'sarana_prasarana') / $this->get_data_value($data_olah, $row['id_pariwisata'], 'sarana_prasarana')));
        $arr_objek_normalisasi[$row['id_pariwisata']]['daya_tarik'] = ($kriteria['daya_tarik']['atribut'] === 'B' ? ($this->get_data_value($data_olah, $row['id_pariwisata'], 'daya_tarik') / $this->get_max_value($arr, 'daya_tarik')) : ($this->get_min_value($arr, 'daya_tarik') / $this->get_data_value($data_olah, $row['id_pariwisata'], 'daya_tarik')));
      }

      // Objek Order
      $arr_objek_order = array();

      foreach($arr as $row) {
        $arr_objek_order[$row['id_pariwisata']] = ($arr_objek_normalisasi[$row['id_pariwisata']]['wisnus'] * $kriteria['wisnus']['bobot']) + ($arr_objek_normalisasi[$row['id_pariwisata']]['wisman'] * $kriteria['wisman']['bobot']) + ($arr_objek_normalisasi[$row['id_pariwisata']]['sarana_prasarana'] * $kriteria['sarana_prasarana']['bobot']) + ($arr_objek_normalisasi[$row['id_pariwisata']]['daya_tarik'] * $kriteria['daya_tarik']['bobot']);
      }

      $temp_objek_order = $arr_objek_order;
      $urutan_objek = 1;
      $arr_indexs = array();

      arsort($temp_objek_order);
      foreach($temp_objek_order as $key => $value) {
        $arr_objek_order[$key] = array('total' => $value, 'urutan' => $urutan_objek);
        $arr_indexs[] = $key;

        $urutan_objek++;
      }

      // Update Urutan Objek
      for($k=0; $k<count($data_olah); $k++) {
        if(in_array($data_olah[$k]['id_pariwisata'], $arr_indexs)) {
          $data_olah[$k]['urutan_objek'] = $arr_objek_order[$data_olah[$k]['id_pariwisata']]['urutan'];
        }
      }
    }

    $parser['controller'] = $this;
    $parser['perhitungan'] = $perhitungan;
    $parser['detail_perhitungan'] = $detail_perhitungan;
    $parser['hasil_clustering'] = $this->m_clustering->get_hasil($id_perhitungan);
    $parser['hasil_clustering_persentase'] = $this->m_clustering->get_hasil_persentase($id_perhitungan);
    $parser['hasil_rekomendasi'] = $data_olah;
    // aldo disini
    $parser['jumlah_clustering'] = $jumlah_cluster;
    $parser['avghasil'] = $arr_cluster;

    $this->load->view('clustering/result', $parser);    
  }

  public function check($id_perhitungan='') {
    if($id_perhitungan === '') {
      $this->session->set_flashdata('status', 'Gagal');
      $this->session->set_flashdata('message', 'Tidak dapat menemukan data hasil clustering.');

      redirect('clustering');
    }

    $this->session->set_userdata('title', 'Pengujian Clustering');
		$this->session->set_userdata('subtitle', 'Pengujian clustering dilakukan dengan metode Silhouette Coefficient (SC).');

    $perhitungan = $this->db->get_where('v_perhitungan', array('id_perhitungan' => $id_perhitungan))->row();
    $detail_perhitungan = $this->db->get_where('v_detail_perhitungan', array('id_perhitungan' => $id_perhitungan, 'iterasi' => $perhitungan->jumlah_iterasi))->row();

    $parser['controller'] = $this;
    $parser['perhitungan'] = $perhitungan;
    $parser['detail_perhitungan'] = $detail_perhitungan;

    $this->load->view('clustering/check', $parser);    
  }
}

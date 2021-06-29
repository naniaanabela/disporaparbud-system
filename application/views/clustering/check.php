<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DISPORAPARBUD Kab. Probolinggo</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>themes/assets/css/demo_1/style.css">
    <!-- End Layout styles -->
    <link rel="stylesheet" href="<?php echo base_url('themes/assets/css/custom.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png'); ?>" />
  </head>
  <body>
    <div class="container-scroller">
      <?php $this->load->view('template_parts/navbar'); ?>

      <div class="container-fluid page-body-wrapper">
        <?php $this->load->view('template_parts/sidebar'); ?>

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h1 class="card-title" style="font-size: 24px; margin-bottom: 5px;"><?php echo ($this->session->has_userdata('title') ? $this->session->userdata('title') : 'Title'); ?></h1>
                    <p class="card-description text-muted"><?php echo ($this->session->has_userdata('subtitle') ? $this->session->userdata('subtitle') : 'Sub Title'); ?></p>

                    <div class="pc-tab">
                      <?php
                        $exists_arr = array(); //deklarasi variabel
                        $check_arr = array(); //deklarasi variabel

                        for($j=1; $j<=$perhitungan->jumlah_cluster; $j++) { //looping berdasarkan jumlah cluster
                          $temp_arr = $controller->get_filter_data(unserialize($detail_perhitungan->hasil_akhir), 'w' . $j); //mengconvert data serialize ke dalam bentuk array

                          $check_arr[] = count($temp_arr); //menghitung jumlah array

                          if(count($temp_arr) > 0) {
                            $exists_arr[] = $temp_arr; //memasukkan nilai ke variabel exists
                          }
                        }
                      ?>


                      <?php for($i=1; $i<=count($exists_arr); $i++) { //looping berdasarkan jumlah data ?> 
                      <input id="<?php echo "tab" . $i; ?>" type="radio" name="pct" <?php echo ($i === 1 ? 'checked="checked"' : ''); ?> />
                      <?php } ?>
                      <nav>
                        <ul>
                          <?php for($i=1; $i<=count($exists_arr); $i++) { ?> 
                          <li class="<?php echo "tab" . $i; ?>">
                            <label for="<?php echo "tab" . $i; ?>" <?php echo (count($exists_arr) <= 1 ? 'style="background: #dddddd; border-color: #dddddd; pointer-events: none; box-shadow: 0 0 0 transparent;"' : ''); ?>><?php echo "SC. Cluster " . $i; ?></label>
                          </li>
                          <?php } ?>
                        </ul>
                      </nav>

                      <div class="row" style="width: 100%;">
                        <div class="col-md-12 grid-margin">
                          <div class="card" style="box-shadow: 0 0 0 transparent; border-color: transparent;">
                            <div class="card-body" style="padding: 10px 0;">
                              <div class="row">
                                <div class="col-lg-3 col-md-6">
                                  <div class="d-flex">
                                    <div class="wrapper">
                                      <h5 class="mb-2 font-weight-medium text-primary">Tahun</h5>
                                      <h3 class="mb-0 font-weight-semibold"><?php echo $perhitungan->tahun; ?></h3>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                                  <div class="d-flex">
                                    <div class="wrapper">
                                      <h5 class="mb-2 font-weight-medium text-primary">Learning Rate</h5>
                                      <h3 class="mb-0 font-weight-semibold"><?php echo $perhitungan->learning_rate; ?></h3>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                                  <div class="d-flex">
                                    <div class="wrapper">
                                      <h5 class="mb-2 font-weight-medium text-primary">Jumlah Cluster</h5>
                                      <h3 class="mb-0 font-weight-semibold"><?php echo $perhitungan->jumlah_cluster; ?></h3>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                                  <div class="d-flex">
                                    <div class="wrapper">
                                      <h5 class="mb-2 font-weight-medium text-primary">Jumlah Iterasi</h5>
                                      <h3 class="mb-0 font-weight-semibold"><?php echo $perhitungan->jumlah_iterasi; //mengambil data dari tabel view perhitungan ?></h3> 
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <section>
                        <?php for($i=1; $i<=count($exists_arr); $i++) { //menghitung jumlah data yang telah di masukan dalam array?> 
                        <div class="<?php echo "tab" . $i; ?>"> 
                          <?php
                            $key_data = $exists_arr[($i - 1)]; //memanggil data dari var exist array di mulai dari data ke 0 misal $i ke 1 - 1 = array ke 0
                            $avg_data = array(); //deklarasi var. rata2
                            $avg_bi = array(); //deklarasi var bi
                            
                            if(count($exists_arr) <= 1) { 
                              echo "<p>Hasil perhitungan ini tidak dapat dilakukan pengujian clustering karena jumlah cluster <strong>tidak terpenuhi</strong>.</p>";
                              //ngecek apakah data lebih dari 1, jika kurang dari sama dengan 1 muncul warning
                              break;
                            }
                          ?>

                          <?php for($j=1; $j<=count($exists_arr); $j++) { //looping dari data exist array ?>
                          <?php $arr_data = $exists_arr[($j - 1)]; //manggil data exist array ?> 
                          <div class="row">
                            <div class="col-md-12 grid-margin">
                              <div class="card">
                                <div class="card-body">
                                  <div class="d-flex justify-content-between">
                                    <h4 class="card-title mb-2" style="font-size: 20px;"><?php echo "Cluster " . $j; ?></h4>
                                  </div>
                                  <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                      <thead>
                                        <tr>
                                          <th>Objek Wisata</th>
                                          <th>wisnus</th>
                                          <th>wisman</th>
                                          <th>sarpras</th>
                                          <th>daya tarik</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php foreach($arr_data as $row) { ?>
                                        <tr>
                                          <td><?php echo $this->m_pariwisata->get_data($row['id_pariwisata'], 'objek_wisata'); ?></td>
                                          <td><?php echo round($controller->get_data_value(unserialize($perhitungan->data_olah), $row['id_pariwisata'], 'wisnus'), 5); ?></td>
                                          <td><?php echo round($controller->get_data_value(unserialize($perhitungan->data_olah), $row['id_pariwisata'], 'wisman'), 5); ?></td>
                                          <td><?php echo round($controller->get_data_value(unserialize($perhitungan->data_olah), $row['id_pariwisata'], 'sarana_prasarana'), 5); ?></td>
                                          <td><?php echo round($controller->get_data_value(unserialize($perhitungan->data_olah), $row['id_pariwisata'], 'daya_tarik'), 5); ?></td>
                                        </tr>
                                        <?php } ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12 grid-margin">
                              <div class="card">
                                <div class="card-body">
                                  <div class="d-flex justify-content-between">
                                    <h4 class="card-title mb-2" style="font-size: 20px;"><?php echo "Normalisasi Cluster " . $j; ?></h4>
                                  </div>
                                  <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                      <thead>
                                        <tr>
                                          <th></th>
                                          <?php for($z=0; $z<count($key_data); $z++) { //menghitung key data ?> 
                                          <th><?php echo ($z + 1); ?></th> 
                                          <?php } ?>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $avg_arr = array(); //deklarasi var 
                                          
                                          if(count($arr_data) > 0) { //kalau data lebih dari 0, menghitung data
                                            for($y=0; $y<count($arr_data); $y++) { //looping berdasarkan jumlah data
                                              echo '<tr>';
                                              echo '<td></td>';
                                    
                                              for($z=0; $z<count($key_data); $z++) { //looping berdasarkan jumlah key data
                                                $temp_value = sqrt( (pow(($controller->get_data_value(unserialize($perhitungan->data_olah), $arr_data[$y]['id_pariwisata'], 'wisnus') - $controller->get_data_value(unserialize($perhitungan->data_olah), $key_data[$z]['id_pariwisata'], 'wisnus')), 2)) + (pow(($controller->get_data_value(unserialize($perhitungan->data_olah), $arr_data[$y]['id_pariwisata'], 'wisman') - $controller->get_data_value(unserialize($perhitungan->data_olah), $key_data[$z]['id_pariwisata'], 'wisman')), 2)) + (pow(($controller->get_data_value(unserialize($perhitungan->data_olah), $arr_data[$y]['id_pariwisata'], 'sarana_prasarana') - $controller->get_data_value(unserialize($perhitungan->data_olah), $key_data[$z]['id_pariwisata'], 'sarana_prasarana')), 2)) + (pow(($controller->get_data_value(unserialize($perhitungan->data_olah), $arr_data[$y]['id_pariwisata'], 'daya_tarik') - $controller->get_data_value(unserialize($perhitungan->data_olah), $key_data[$z]['id_pariwisata'], 'daya_tarik')), 2)) );
                                                //menghitung berdasarkan jumlah variabel

                                                $avg_arr[$z] = (isset($avg_arr[$z]) ? $avg_arr[$z] : 0) + $temp_value; //menjumlahkan nilai dari hasil perhitungan sebelumnya

                                                echo '<td>' . round($temp_value, 5) . '</td>'; //menampilkan hasil perhitungan dengan 5 angka di belakang koma
                                              }

                                              echo '</tr>';
                                            }
                                          } else {
                                            for($z=0; $z<count($key_data); $z++) {
                                              $avg_arr[$z] = 0; //jika data kurang dari 0 maka tidak menampilkan apa-apa. avg_arr untuk nge set data menjadi 0
                                            }
                                          }
                                        ?>
                                      </tbody>
                                      <tfoot>
                                        <tr>
                                          <th>Rata-rata</th>
                                          <?php
                                            $total_avg = 0; //deklarasi 

                                            if(count($arr_data) > 0)  {
                                              for($z=0; $z<count($key_data); $z++) { //looping berdasarkan jumlah data 
                                                $temp_value = ($avg_arr[$z] / count($arr_data)); //menghitung rata2 di bagi jumlah data
                                                $total_avg += $temp_value; //memasukkan hasil perhitungan rata2
                                                $avg_data[($j - 1)][$z] = $temp_value; //nge set data dari perhitungan rata2 dimasukkan ke array avg data

                                                echo '<th>' . round($temp_value, 5) . '</th>';  
                                              }
                                            } else {
                                              for($z=0; $z<count($key_data); $z++) { 
                                                $avg_data[($j - 1)][$z] = 0;
                                              }
                                            }
                                          ?>
                                        </tr>
                                        <?php
                                          $temp_avg_bi = ($total_avg !== 0 ? $total_avg / count($key_data) : 0);
                                          $avg_bi[($j - 1)] = $temp_avg_bi; //melakukan perhitungan total rata2 
                                        ?>
                                        <tr>
                                          <th>Total Rata-rata</th>
                                          <th colspan="<?php echo count($key_data); ?>"><?php echo round($temp_avg_bi, 5); ?></th>
                                        </tr>
                                      </tfoot>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-12 mb-4">
                              <hr />
                            </div>
                          </div>
                          <?php } ?>

                          <div class="row">
                            <div class="col-md-12 grid-margin">
                              <div class="card">
                                <div class="card-body">
                                  <div class="d-flex justify-content-between">
                                    <h4 class="card-title mb-2" style="font-size: 20px;"><?php echo "SC Cluster " . $i; ?></h4>
                                  </div>
                                  <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                      <thead>
                                        <tr>
                                          <th>Objek Wisata</th>
                                          <th>C1</th>
                                          <th>C2</th>
                                          <th>C3</th>
                                          <th>C4</th>
                                          <th>a(i)</th>
                                          <th>b(i)</th>
                                          <th>s(i)</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $t = 0;
                                          $total_a = 0;
                                        ?>
                                        <?php foreach($key_data as $row) { ?>
                                        <?php
                                          $a = $avg_data[($i - 1)][$t];
                                          $b = $controller->get_value_bi($avg_data, count($exists_arr), ($i - 1), $t);
                                          $s = ($b - $a) / max($a, $b);

                                          $total_a += $a; //menampung hasil ke variabel total
                                        ?>
                                        <tr>
                                          <td><?php echo $this->m_pariwisata->get_data($row['id_pariwisata'], 'objek_wisata'); ?></td>
                                          <td><?php echo round($controller->get_data_value(unserialize($perhitungan->data_olah), $row['id_pariwisata'], 'wisnus'), 5); ?></td>
                                          <td><?php echo round($controller->get_data_value(unserialize($perhitungan->data_olah), $row['id_pariwisata'], 'wisman'), 5); ?></td>
                                          <td><?php echo round($controller->get_data_value(unserialize($perhitungan->data_olah), $row['id_pariwisata'], 'sarana_prasarana'), 5); ?></td>
                                          <td><?php echo round($controller->get_data_value(unserialize($perhitungan->data_olah), $row['id_pariwisata'], 'daya_tarik'), 5); ?></td>
                                          <td><?php echo round($a, 5); ?></td>
                                          <td><?php echo round($b, 5); ?></td>
                                          <td><?php echo round($s, 5); ?></td>
                                        </tr>
                                        <?php $t++; ?>
                                        <?php } ?>
                                      </tbody>

                                      <?php
                                        $total_bi = $controller->get_value_total_bi($avg_bi, count($exists_arr), ($i - 1));
                                        $total_si = ($total_bi - (($total_a / count($key_data)))) / max(($total_a / count($key_data)), $total_bi);
                                      ?>
                                      <tfoot>
                                        <tr>
                                          <th colspan="5">Total Rata-rata</th>
                                          <th><?php echo round(($total_a / count($key_data)), 5); ?></th>
                                          <th><?php echo round($total_bi, 5); ?></th>
                                          <th><?php echo round($total_si, 5); ?></th>
                                        </tr>
                                      </tfoot>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php } ?>
                      </section>
                    </div> 
                  </div>
                </div>
              </div>

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Keterangan:</h4>
                    <ul>
                      <li><strong>C1</strong> adalah kode kriteria untuk <strong>Wisatawan Nusantara</strong>.</li>
                      <li><strong>C2</strong> adalah kode kriteria untuk <strong>Wisatawan Mancanegara</strong>.</li>
                      <li><strong>C3</strong> adalah kode kriteria untuk <strong>Sarana Prasarana</strong>.</li>
                      <li><strong>C4</strong> adalah kode kriteria untuk <strong>Daya Tarik</strong>.</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          
          <?php $this->load->view('template_parts/footer'); ?>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo base_url(); ?>themes/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?php echo base_url(); ?>themes/assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="<?php echo base_url(); ?>themes/assets/js/shared/off-canvas.js"></script>
    <script src="<?php echo base_url(); ?>themes/assets/js/shared/misc.js"></script>
    <!-- endinject -->

    <script src="<?php echo base_url(); ?>themes/assets/js/highcharts.js"></script>
    <script src="<?php echo base_url(); ?>themes/assets/js/exporting.js"></script>
    <script src="<?php echo base_url(); ?>themes/assets/js/export-data.js"></script>
    <script src="<?php echo base_url(); ?>themes/assets/js/accessibility.js"></script>
  </body>
</html>
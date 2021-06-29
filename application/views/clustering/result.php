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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
  </head>
  <body>
    <div class="container-scroller">
      <?php $this->load->view('template_parts/navbar'); ?>
      <div class="container-fluid page-body-wrapper">
        <?php $this->load->view('template_parts/sidebar'); ?>
        <!-- partial -->
        <input type="hidden" id="dataPieChart" value="<?php echo $hasil_clustering_persentase; ?>" />
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h1 class="card-title" style="font-size: 24px; margin-bottom: 5px;"><?php echo ($this->session->has_userdata('title') ? $this->session->userdata('title') : 'Title'); ?></h1>
                    <p class="card-description text-muted"><?php echo ($this->session->has_userdata('subtitle') ? $this->session->userdata('subtitle') : 'Sub Title'); ?></p>
                    <div class="pc-tab">
                      <input checked="checked" id="tab1" type="radio" name="pct" />
                      <input id="tab2" type="radio" name="pct" />
                      <input id="tab3" type="radio" name="pct" />
                      <nav>
                        <ul>
                          <li class="tab1">
                            <label for="tab1">Hasil Clustering</label>
                          </li>
                          <li class="tab2">
                            <label for="tab2">Perhitungan (SOM)</label>
                          </li>
                          <li class="tab3">
                            <label for="tab3">Rekomendasi Cluster</label>
                          </li>
                        </ul>
                      </nav>
                      <section>
                        <div class="tab1">
                          <figure class="highcharts-figure">
                            <div id="container"></div>
                          </figure>

                          <div class="col-md-12">
                          <div class="row">
                            <?php $i = 1 ?>
                            <?php foreach($avghasil as $data){ ?>
                  
                              <!-- <div class="col-md-12"> -->
                              <div class="col-sm-4">
                                <h4>Cluster <?php echo $i ?></h4>
                             
                                <table>
                                    <tr>
                                      <td>Rata - Rata</td>
                                    </tr>
                                    <tr>
                                      <td>wisnus </td>
                                      <td> &nbsp;:&nbsp; </td>
                                      <td><?php echo $data['wisnus'] ?></td>
                                    </tr>
                                    <tr>
                                      <td>wisman </td>
                                      <td> &nbsp;:&nbsp; </td>
                                      <td><?php echo $data['wisman'] ?></td>
                                    </tr>
                                    <tr>
                                      <td>sarana prasarana </td>
                                      <td> &nbsp;:&nbsp; </td>
                                      <td><?php echo $data['sarana_prasarana'] ?></td>
                                    </tr>
                                    <tr>
                                      <td>daya tarik </td>
                                      <td> &nbsp;:&nbsp; </td>
                                      <td><?php echo $data['daya_tarik'] ?></td>
                                    </tr>
                                </table>
                              </div>
                            <!-- </div> -->
                            <?php $i++ ?>
                            <?php } ?>
                          </div></div>
                          

                          <br></br>
                          <table class="table table-striped" id = hasilClustering>
                            <thead>
                              <tr>
                                <th>Tahun</th>
                                <th>Objek Wisata</th>
                                <th>Cluster</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($hasil_clustering as $row) { ?>
                              <tr>
                                <td><?php echo $row['tahun']; ?></td>
                                <td><?php echo $row['objek_wisata']; ?></td>
                                <td><?php echo get_cluster_name($row['cluster']); ?></td>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                        <div class="tab2">
                          <div class="row">
                            <div class="col-md-12 grid-margin">
                              <div class="card" style="box-shadow: 0 0 0 transparent; border-color: transparent;">
                                <div class="card-body" style="padding: 10px 0;">
                                  <div class="row">
                                    <div class="col-lg-3 col-md-6">
                                      <div class="d-flex">
                                        <div class="wrapper">
                                          <h3 class="mb-0 font-weight-semibold"><?php echo $perhitungan->tahun; ?></h3>
                                          <h5 class="mb-2 font-weight-medium text-primary">Tahun</h5>
                                          <!-- <p class="mb-0 text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> -->
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                                      <div class="d-flex">
                                        <div class="wrapper">
                                          <h3 class="mb-0 font-weight-semibold"><?php echo $perhitungan->learning_rate; ?></h3>
                                          <h5 class="mb-2 font-weight-medium text-primary">Learning Rate</h5>
                                          <!-- <p class="mb-0 text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> -->
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                                      <div class="d-flex">
                                        <div class="wrapper">
                                          <h3 class="mb-0 font-weight-semibold"><?php echo $perhitungan->jumlah_cluster; ?></h3>
                                          <h5 class="mb-2 font-weight-medium text-primary">Jumlah Cluster</h5>
                                          <!-- <p class="mb-0 text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> -->
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                                      <div class="d-flex">
                                        <div class="wrapper">
                                          <h3 class="mb-0 font-weight-semibold"><?php echo $perhitungan->jumlah_iterasi; ?></h3>
                                          <h5 class="mb-2 font-weight-medium text-primary">Jumlah Iterasi</h5>
                                          <!-- <p class="mb-0 text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> -->
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12 grid-margin">
                              <div class="card">
                                <div class="card-body">
                                  <div class="d-flex justify-content-between">
                                    <h4 class="card-title mb-2" style="font-size: 20px;">Data Olah</h4>
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
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php foreach(unserialize($perhitungan->data_olah) as $row) { ?>
                                        <tr>
                                          <td><?php echo $row['objek_wisata']; ?></td>
                                          <td><?php echo round($row['wisnus'], 5); ?></td>
                                          <td><?php echo round($row['wisman'], 5); ?></td>
                                          <td><?php echo round($row['sarana_prasarana'], 5); ?></td>
                                          <td><?php echo round($row['daya_tarik'], 5); ?></td>
                                        </tr>
                                        <?php } ?>
                                      </tbody>
                                      <tfoot>
                                        <tr>
                                          <th>MAX</th>
                                          <th><?php echo $controller->get_max_value(unserialize($perhitungan->data_olah), 'wisnus'); ?></th>
                                          <th><?php echo $controller->get_max_value(unserialize($perhitungan->data_olah), 'wisman'); ?></th>
                                          <th><?php echo $controller->get_max_value(unserialize($perhitungan->data_olah), 'sarana_prasarana'); ?></th>
                                          <th><?php echo $controller->get_max_value(unserialize($perhitungan->data_olah), 'daya_tarik'); ?></th>
                                        </tr>
                                      </tfoot>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12 grid-margin">
                              <div class="card">
                                <div class="card-body">
                                  <div class="d-flex justify-content-between">
                                    <h4 class="card-title mb-2" style="font-size: 20px;">Normalisasi</h4>
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
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php foreach(unserialize($perhitungan->normalisasi) as $row) { ?>
                                        <tr>
                                          <td><?php echo $row['objek_wisata']; ?></td>
                                          <td><?php echo round($row['wisnus'], 5); ?></td>
                                          <td><?php echo round($row['wisman'], 5); ?></td>
                                          <td><?php echo round($row['sarana_prasarana'], 5); ?></td>
                                          <td><?php echo round($row['daya_tarik'], 5); ?></td>
                                        </tr>
                                        <?php } ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php foreach($detail_perhitungan as $row) { ?>
                            <div class="col-md-12 grid-margin">
                              <hr>
                            </div>
                            <div class="col-md-12 grid-margin">
                              <div class="card">
                                <div class="card-body">
                                  <div class="d-flex justify-content-between">
                                    <h4 class="card-title mb-2" style="font-size: 20px;"><?php echo "Iterasi #" . $row->iterasi . ": Bobot Awal"; ?></h4>
                                  </div>
                                  <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                      <thead>
                                        <tr>
                                          <th>Bobot Awal</th>
                                          <th>C1</th>
                                          <th>C2</th>
                                          <th>C3</th>
                                          <th>C4</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php foreach(unserialize($row->bobot_awal) as $cluster => $bobot) { ?>
                                        <tr>
                                          <th><?php echo strtoupper($cluster); ?></th>
                                          <td><?php echo round($bobot['wisnus'], 5); ?></td>
                                          <td><?php echo round($bobot['wisman'], 5); ?></td>
                                          <td><?php echo round($bobot['sarana_prasarana'], 5); ?></td>
                                          <td><?php echo round($bobot['daya_tarik'], 5); ?></td>
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
                                    <h4 class="card-title mb-2" style="font-size: 20px;"><?php echo "Iterasi #" . $row->iterasi . ": Euclidean Distance"; ?></h4>
                                  </div>
                                  <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                      <thead>
                                        <tr>
                                          <th>Objek Wisata</th>
                                          <?php for($i=1; $i<=$perhitungan->jumlah_cluster; $i++) { ?>
                                          <th><?php echo "W" . $i; ?></th>
                                          <?php } ?>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php foreach(unserialize($row->euclidean_distance) as $id_pariwisata => $euclidean) { ?>
                                        <tr>
                                          <td><?php echo $this->m_pariwisata->get_data($id_pariwisata, 'objek_wisata'); ?></td>
                                          <?php for($i=1; $i<=$perhitungan->jumlah_cluster; $i++) { ?>
                                          <td><?php echo round($euclidean['w' . $i], 5); ?></td>
                                          <?php } ?>
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
                                    <h4 class="card-title mb-2" style="font-size: 20px;"><?php echo "Iterasi #" . $row->iterasi . ": Update Bobot"; ?></h4>
                                  </div>
                                  <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                      <thead>
                                        <tr>
                                          <th rowspan="2">Objek Wisata</th>
                                          <?php for($i=1; $i<=$perhitungan->jumlah_cluster; $i++) { ?>
                                          <th class="text-center" colspan="4"><?php echo "W" . $i; ?></th>
                                          <?php } ?>
                                        </tr>
                                        <tr>
                                          <?php for($i=1; $i<=$perhitungan->jumlah_cluster; $i++) { ?>
                                          <th>C1</th>
                                          <th>C2</th>
                                          <th>C3</th>
                                          <th>C4</th>
                                          <?php } ?>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php foreach(unserialize($row->bobot_akhir) as $id_pariwisata => $cluster) { ?>
                                        <tr>
                                          <td><?php echo $this->m_pariwisata->get_data($id_pariwisata, 'objek_wisata'); ?></td>
                                          <?php for($i=1; $i<=$perhitungan->jumlah_cluster; $i++) { ?>
                                          <td><?php echo round($cluster['w' . $i]['wisnus'], 5); ?></td>
                                          <td><?php echo round($cluster['w' . $i]['wisman'], 5); ?></td>
                                          <td><?php echo round($cluster['w' . $i]['sarana_prasarana'], 5); ?></td>
                                          <td><?php echo round($cluster['w' . $i]['daya_tarik'], 5); ?></td>
                                          <?php } ?>
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
                                    <h4 class="card-title mb-2" style="font-size: 20px;"><?php echo "Iterasi #" . $row->iterasi . ": Hasil Cluster"; ?></h4>
                                  </div>
                                  <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                      <thead>
                                        <tr>
                                          <th>Objek Wisata</th>
                                          <th>Cluster</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php foreach(unserialize($row->hasil_akhir) as $hasil_akhir) { ?>
                                        <tr>
                                          <td><?php echo $this->m_pariwisata->get_data($hasil_akhir['id_pariwisata'], 'objek_wisata'); ?></td>
                                          <td><?php echo strtoupper($hasil_akhir['cluster']); ?></td>
                                        </tr>
                                        <?php } ?>
                                      </tbody>
                                    </table>
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
                                    <li><strong>W1, W2, ..., Wn</strong> adalah keterangan <strong>jumlah cluster</strong>.</li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <?php } ?>
                          </div>
                        </div>
                        <div class="tab3">
                          
                          <div class="col-md-12 grid-margin">
                            <div class="card">
                              <div class="card-body">
                                <table id="rekomendasi" class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th>Tahun</th>
                                      <th>Objek Wisata</th>
                                      <th>Cluster</th>
                                      <th>Prioritas</th>
                                      <th>wisman</th>
                                      <th>wisnus</th>
                                      <th>sarpras</th>
                                      <th>dayatarik</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $rekomendasi_sorted = array();
                                      foreach($hasil_rekomendasi as $k => $v) {
                                        $rekomendasi_sorted['urutan_cluster'][$k] = $v['urutan_cluster'];
                                        $rekomendasi_sorted['urutan_objek'][$k] = $v['urutan_objek'];
                                      }
                                      
                                      array_multisort($rekomendasi_sorted['urutan_cluster'], SORT_ASC, $rekomendasi_sorted['urutan_objek'], SORT_ASC, $hasil_rekomendasi);
                                    ?>
                                    <?php foreach($hasil_rekomendasi as $row) { ?>
                                    <tr>
                                      <td><?php echo $row['tahun']; ?></td>
                                      <td><?php echo $row['objek_wisata']; ?></td>
                                      <td><?php echo get_cluster_name($row['cluster']); ?></td>
                                      <td><?php echo "Rekomendasi Prioritas " . $row['urutan_cluster']; ?></td>
                                      <td><?php echo $row['wisnus']; ?></td>
                                      <td><?php echo $row['wisman']; ?></td>
                                      <td><?php echo $row['sarana_prasarana']; ?></td>
                                      <td><?php echo $row['daya_tarik']; ?></td>
                                    </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
      

                        </div>
                      </section>
                    </div> 
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
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script>
      $(document).ready(function() {
        var _arr = JSON.parse($('#dataPieChart').val());
        var _data = [];
        var _i = 1;
        $.each($(_arr), function(key, value) {
          if(_i === 1) {
            _data.push({name: 'Cluster ' + _i, y: value, sliced: true, selected: true});
          } else {
            _data.push({name: 'Cluster ' + _i, y: value});
          }
          _i++;
        });
        // Build the chart
        Highcharts.chart('container', {
          chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
          },
          title: {
            text: 'Persentase Hasil Clustering'
          },
          tooltip: {
            pointFormat: '<b>{point.percentage:.1f}%</b>'
          },
          accessibility: {
            point: {
              valueSuffix: '%'
            }
          },
          plotOptions: {
            pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: {
                enabled: false
              },
              showInLegend: true
            }
          },
          series: [{
            colorByPoint: true,
            data: _data
          }]
        });
        var table = $("#rekomendasi").DataTable({
          dom: "<'row'<'col-sm-4'l><'col-sm-4 toolbar'><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        });

        var table = $("#hasilClustering").DataTable({
          dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
              {
                extend : 'print',
                text : 'Print Hasil Clustering'
              }
            ],
        });


        var txt_cluster = '';
        for (let index = 1; index <= <?= $jumlah_clustering ?>; index++) {
          txt_cluster += '<option value="Cluster '+index+'">Cluster '+index+'</option>'
        }
        $("div.toolbar").html(`<select class="filter form-control" id="filter-cluster">
          <option value="">Semua Cluster</option>
          <option value="Cluster 1">Cluster 1</option>
          <option value="Cluster 2">Cluster 2</option>
          <option value="Cluster 3">Cluster 3</option>
          `+txt_cluster+`
        </select>`);
        $("#filter-cluster").on('change',function(){
          console.log(this.value);
          table
            .columns(2)
            .search( this.value )
            .draw();
        })
      })
    </script>
    
  </body>
</html>
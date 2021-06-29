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
        <input type="hidden" id="minTahun" value="<?php echo $min_tahun; ?>" />
        <input type="hidden" id="dataWisnus" value="<?php echo $data_wisnus; ?>" />
        <input type="hidden" id="dataWisman" value="<?php echo $data_wisman; ?>" />
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="wrapper-title">
                      <h1 class="card-title" style="font-size: 38px; margin-bottom: 5px; text-transform: uppercase;">
                        Selamat Datang "<?php echo $this->session->userdata('nama_lengkap'); ?>"<br /> DISPORAPARBUD KABUPATEN PROBOLINGGO
                      </h1>
                      <p class="card-description mt-4" style="font-size: 16px;">Di Sistem Clustering Objek Wisata Penentuan Prioritas Pengembangan Wisata Menggunakan Metode <i>Self Organizing Maps<i> (SOM)</p>
                    </div>

                    <div class="row">
                      <div class="col-12">
                        <figure class="highcharts-figure">
                          <div id="container1"></div>
                        </figure>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <figure class="highcharts-figure">
                          <div id="container2"></div>
                          
                          <table id="datatable2" style="display: none;">
                            <thead>
                              <tr>
                                <th></th>
                                <th>Sarana Prasarana</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($data_sapras as $key => $value) { ?>
                              <tr>
                                <th><?php echo $key; ?></th>
                                <td><?php echo $value; ?></td>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </figure>
                      </div>

                      <div class="col-md-6">
                        <figure class="highcharts-figure">
                          <div id="container3"></div>
                          
                          <table id="datatable3" style="display: none;">
                            <thead>
                              <tr>
                                <th></th>
                                <th>Daya Tarik</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($data_datar as $key => $value) { ?>
                              <tr>
                                <th><?php echo $key; ?></th>
                                <td><?php echo $value; ?></td>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </figure>
                      </div>
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

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
      $(document).ready(function() {
        var _min_tahun = parseInt($('#minTahun').val());
        var _data_wisnus = JSON.parse($('#dataWisnus').val());
        var _data_wisman = JSON.parse($('#dataWisman').val());

        Highcharts.chart('container1', {
          title: {
            text: 'Rata-rata Kunjungan Objek Wisata'
          },

          subtitle: {
            text: 'Sumber: Dinas Pemuda Olahraga Pariwisata dan Kebudayaan (Disporaparbud) Kabupaten Probolinggo'
          },

          yAxis: {
            title: {
              text: 'Jumlah Pengunjung'
            }
          },

          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
          },

          plotOptions: {
            series: {
              label: {
                connectorAllowed: false
              },
              pointStart: _min_tahun
            }
          },

          series: [{
            name: 'Wisatawan Nusantara',
            data: _data_wisnus
          }, {
            name: 'Wisatawan Mancanegara',
            data: _data_wisman
          }],

          responsive: {
            rules: [{
              condition: {
                maxWidth: 500
              },
              chartOptions: {
                legend: {
                  layout: 'horizontal',
                  align: 'center',
                  verticalAlign: 'bottom'
                }
              }
            }]
          }
        });

        Highcharts.chart('container2', {
          data: {
            table: 'datatable2'
          },
          chart: {
            type: 'column'
          },
          title: {
            text: 'Sarana Prasarana Objek Wisata'
          },
          yAxis: {
            allowDecimals: false,
            title: {
              text: 'Nilai'
            }
          },
          tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
          }
        });

        Highcharts.chart('container3', {
          data: {
            table: 'datatable3'
          },
          chart: {
            type: 'column'
          },
          title: {
            text: 'Daya Tarik Objek Wisata'
          },
          yAxis: {
            allowDecimals: false,
            title: {
              text: 'Nilai'
            }
          },
          tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
          }
        });
      })
    </script>
  </body>
</html>
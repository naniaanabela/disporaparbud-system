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

                    <?php if(count($semua_tahun) > 0) { ?>
                    <form action="<?php echo site_url('clustering/do_generate'); ?>" method="POST" class="form-sample">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Data Tahun</label>
                            <div class="col-sm-9">
                              <select required="required" autocomplete="off" name="tahun" class="form-control" tabindex="1">
                                <?php foreach($semua_tahun as $row) { ?>
                                <option value="<?php echo $row->tahun; ?>"><?php echo $row->tahun; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Learning Rate</label>
                            <div class="col-sm-9">
                              <select required="required" name="learning_rate" class="form-control" autocomplete="off">
                                <option value="0.4">0.4</option>
                                <option value="0.5" selected="selected">0.5</option>
                                <option value="0.6">0.6</option>
                                <option value="0.7">0.7</option>
                                <option value="0.8">0.8</option>
                                <option value="0.9">0.9</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jumlah Cluster</label>
                            <div class="col-sm-9">
                              <input id="jumlahCluster" type="number" required="required" autocomplete="off" name="jumlah_cluster" value="3" step="1" min="1" class="form-control" tabindex="2" readonly>
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jumlah Iterasi</label>
                            <div class="col-sm-9">
                              <input type="number" required="required" autocomplete="off" name="jumlah_iterasi" value="3" step="1" min="1" class="form-control" tabindex="4">
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Bobot Awal</th>
                                <th>C1</th>
                                <th>C2</th>
                                <th>C3</th>
                                <th>C4</th>
                              </tr>
                            </thead>
                            <tbody id="bobotAwal">
                              <tr>
                                <th>W1</th>
                                <td><input type="number" required="required" autocomplete="off" name="wisnus_w1" value="0.86" step="0.01" class="form-control" style="width: 100px;" tabindex="5"></td>
                                <td><input type="number" required="required" autocomplete="off" name="wisman_w1" value="0.35" step="0.01" class="form-control" style="width: 100px;" tabindex="5"></td>
                                <td><input type="number" required="required" autocomplete="off" name="sarana_prasarana_w1" value="0.25" step="0.01" class="form-control" style="width: 100px;" tabindex="5"></td>
                                <td><input type="number" required="required" autocomplete="off" name="daya_tarik_w1" value="0.53" step="0.01" class="form-control" style="width: 100px;" tabindex="5"></td>
                              </tr>
                              <tr>
                                <th>W2</th>
                                <td><input type="number" required="required" autocomplete="off" name="wisnus_w2" value="0.62" step="0.01" class="form-control" style="width: 100px;" tabindex="6"></td>
                                <td><input type="number" required="required" autocomplete="off" name="wisman_w2" value="0.21" step="0.01" class="form-control" style="width: 100px;" tabindex="6"></td>
                                <td><input type="number" required="required" autocomplete="off" name="sarana_prasarana_w2" value="0.38" step="0.01" class="form-control" style="width: 100px;" tabindex="6"></td>
                                <td><input type="number" required="required" autocomplete="off" name="daya_tarik_w2" value="0.42" step="0.01" class="form-control" style="width: 100px;" tabindex="6"></td>
                              </tr>
                              <tr>
                                <th>W3</th>
                                <td><input type="number" required="required" autocomplete="off" name="wisnus_w3" value="0.29" step="0.01" class="form-control" style="width: 100px;" tabindex="7"></td>
                                <td><input type="number" required="required" autocomplete="off" name="wisman_w3" value="0.14" step="0.01" class="form-control" style="width: 100px;" tabindex="7"></td>
                                <td><input type="number" required="required" autocomplete="off" name="sarana_prasarana_w3" value="0.86" step="0.01" class="form-control" style="width: 100px;" tabindex="7"></td>
                                <td><input type="number" required="required" autocomplete="off" name="daya_tarik_w3" value="0.15" step="0.01" class="form-control" style="width: 100px;" tabindex="7"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>

                        <div class="col-md-12 mt-3">
                          <button type="submit" class="btn btn-dark">Kirim</button>
                        </div>
                      </div>
                    </form>
                    <?php } else { ?>
                    <p>Tidak ada data untuk dilakukan clustering. Mohon periksa kembali data Anda, terima kasih.</p>
                    <a href="<?php echo site_url('clustering/'); ?>" type="button" class="btn btn-danger">Kembali</a>
                    <?php } ?>
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

    <script src="<?php echo base_url(); ?>themes/assets/js/jquery-3.6.0.min.js"></script>

    <script>
      $(document).ready(function() {
        loadInputBobotAwal = function(_jumlah_cluster) {
          for(var i=1; i<=_jumlah_cluster; i++) {
            $('#bobotAwal').append('<tr>'+
                                '<th>W' + i + '</th>'+
                                '<td><input type="number" required="required" autocomplete="off" name="wisnus_w' + i + '" value="" step="0.00001" class="form-control" style="width: 100px;" tabindex="' + (i + 4) + '"></td>'+
                                '<td><input type="number" required="required" autocomplete="off" name="wisman_w' + i + '" value="" step="0.00001" class="form-control" style="width: 100px;" tabindex="' + (i + 4) + '"></td>'+
                                '<td><input type="number" required="required" autocomplete="off" name="sarana_prasarana_w' + i + '" value="" step="0.00001" class="form-control" style="width: 100px;" tabindex="' + (i + 4) + '"></td>'+
                                '<td><input type="number" required="required" autocomplete="off" name="daya_tarik_w' + i + '" value="" step="0.00001" class="form-control" style="width: 100px;" tabindex="' + (i + 4) + '"></td>'+
                              '</tr>');
          }
        }

        $('#jumlahCluster').on('change', (function() {
          var _jumlah_cluster = $(this).val();
          
          $('#bobotAwal').html('');

          loadInputBobotAwal(_jumlah_cluster);
        }))
      })
    </script>
  </body>
</html>
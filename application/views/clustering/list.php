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
              <?php if(!empty($this->session->flashdata('message'))) { ?>
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title <?php echo ($this->session->flashdata('status') === 'Sukses' ? 'text-success' : 'text-danger'); ?>"><?php echo $this->session->flashdata('status'); ?></h4>
                    <p class="card-description text-muted"><?php echo $this->session->flashdata('message'); ?></p>
                  </div>
                </div>
              </div>
              <?php } ?>

              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h1 class="card-title" style="font-size: 24px; margin-bottom: 5px;"><?php echo ($this->session->has_userdata('title') ? $this->session->userdata('title') : 'Title'); ?></h1>
                    <p class="card-description"><?php echo ($this->session->has_userdata('subtitle') ? $this->session->userdata('subtitle') : 'Sub Title'); ?></p>

                    <div style="float: right; margin-top: -66px;">
                      <a href="<?php echo site_url('clustering/generate/'); ?>" type="button" class="btn btn-dark">Tambah Baru</a>
                    </div>

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Tanggal</th>
                          <th>Tahun</th>
                          <th>Cluster</th>
                          <th>Learning Rate</th>
                          <th>Iterasi</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(count($semua_perhitungan) > 0) { ?>
                        <?php foreach($semua_perhitungan as $row) { ?>
                        <tr>
                          <td><?php echo date('M d, Y H:i A', strtotime($row->tanggal_perhitungan)); ?></td>
                          <td><?php echo $row->tahun; ?></td>
                          <td><?php echo $row->jumlah_cluster; ?></td>
                          <td><?php echo $row->learning_rate; ?></td>
                          <td><?php echo $row->jumlah_iterasi; ?></td>
                          <td>
                            <a href="<?php echo site_url('clustering/result/' . $row->id_perhitungan . '/'); ?>" type="button" class="btn btn-primary">Hasil</a>
                            <a href="<?php echo site_url('clustering/check/' . $row->id_perhitungan . '/'); ?>" type="button" class="btn btn-success">Pengujian</a>
                            <a href="<?php echo site_url('clustering/do_delete/' . $row->id_perhitungan); ?>" type="button" class="btn btn-danger" onclick="if(confirm('Apakah Anda yakin ingin menghapus data ini?') !== true){return false;}">Hapus</a>
                          </td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                          <td class="text-center" colspan="7">Tidak ada data.</td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
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
  </body>
</html>
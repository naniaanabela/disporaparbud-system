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
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h1 class="card-title" style="font-size: 24px; margin-bottom: 5px;"><?php echo ($this->session->has_userdata('title') ? $this->session->userdata('title') : 'Title'); ?></h1>
                    <p class="card-description text-muted"><?php echo ($this->session->has_userdata('subtitle') ? $this->session->userdata('subtitle') : 'Sub Title'); ?></p>
                    
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Tahun</th>
                          <th>Objek<br />Wisata</th>
                          <th>Wisata<br />Nusantara</th>
                          <th>Wisata<br />Mancanegara</th>
                          <th>Sarana<br />Prasarana</th>
                          <th>Daya<br />Tarik</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(count($result) > 0) { ?>
                        
                        <?php foreach($result as $row) { ?>
                        <tr>
                          <td><?php echo $row['tahun']; ?></td>
                          <td><?php echo $row['objek_wisata']; ?></td>
                          <td><?php echo $row['wisnus']; ?></td>
                          <td><?php echo $row['wisman']; ?></td>
                          <td><?php echo $row['sarana_prasarana']; ?></td>
                          <td><?php echo $row['daya_tarik']; ?></td>
                          <td><?php echo $row['status']; ?></td>
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
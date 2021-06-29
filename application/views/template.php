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
    <?php foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>

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
                    <?php echo $output; ?>
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

    <?php foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
  </body>
</html>
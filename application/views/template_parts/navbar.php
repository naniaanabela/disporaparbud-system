      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
          <a class="navbar-brand brand-logo" href="<?php echo site_url('dasbor/'); ?>">
            <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="<?php echo site_url('dasbor/'); ?>">
            <img src="<?php echo base_url('assets/images/favicon.png'); ?>" alt="logo" />
          </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="<?php echo base_url('assets/images/user.png'); ?>" alt="profile"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="<?php echo base_url('assets/images/user.png'); ?>" alt="profile">
                  <p class="mb-1 mt-3 font-weight-semibold"><?php echo $this->session->userdata('nama_lengkap'); ?></p>
                  <p class="font-weight-light text-muted mb-0">Administrator</p>
                </div>
                <a href="<?php echo site_url('logout/'); ?>" class="dropdown-item">Logout<i class="dropdown-item-icon ti-power-off"></i></a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
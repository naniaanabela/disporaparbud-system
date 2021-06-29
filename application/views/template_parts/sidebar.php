        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <div class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" src="<?php echo base_url('assets/images/user.png'); ?>" alt="profile">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"><?php echo $this->session->userdata('nama_lengkap'); ?></p>
                  <p class="designation">Administrator</p>
                </div>
              </div>
            </li>
            <li class="nav-item nav-category">Menu</li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('dasbor/'); ?>">
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('administrator/'); ?>">
                <span class="menu-title">Administrator</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-pariwisata" aria-expanded="false" aria-controls="ui-pariwisata">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">Pariwisata</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-pariwisata">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('pariwisata/'); ?>">Semua Data</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('pariwisata/import/'); ?>">Impor Excel</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('clustering/'); ?>">
                <span class="menu-title">Clustering</span>
              </a>
            </li>
          </ul>
        </nav>
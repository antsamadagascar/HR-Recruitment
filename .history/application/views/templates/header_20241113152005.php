<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$utilisateur = $this->session->userdata('utilisateur');
?>

<body>
     <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
        <a href="<?php echo base_url('Home_Controller/dashboard') ?>" class="logo d-flex align-items-center">
            <img src="<?php echo base_url('template/assets/img/logo.png'); ?>" alt="">
            <span class="d-none d-lg-block">NiceAdmin</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
          <ul class="d-flex align-items-center"></ul>

            <li class="nav-item dropdown pe-3">

              <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $utilisateur->username; ?></span>
              </a><!-- End Profile Iamge Icon -->

              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                  <h6><?php echo $utilisateur->nom; ?></h6>
                  <!-- <span><?php echo $utilisateur->metier_nom; ?></span> -->
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <li>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <i class="bi bi-person"></i>
                    <span>My Profile</span>
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <li>
                  <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('Connection_Controller/signout'); ?>">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                  </a>
                </li>

              </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

          </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
    /* Badge de notifications */
.badge.bg-danger {
    background-color: #dc3545;
    color: white;
    margin-left: 20px;
    font-size: 8px;
    padding: 0.5rem 0.7rem;
    border-radius: 10px;
}

</style>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-heading">ACTIONS</li>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('Notifications_Controller/notifRc'); ?>">
            <i class="bi bi-bell"></i><span>Notifications</span>
            <?php 
            if (isset($notifications_count) && $notifications_count > 0): ?>
                <span class="badge bg-danger"><?php echo $notifications_count; ?></span>
            <?php endif; ?>
        </a>
    </li>

    <li class="nav-heading">Listes Des Demandes</li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Annonce Recrutement</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="<?php echo base_url('Annonce'); ?>">
                <i class="bi bi-circle"></i><span>Listes Des Annonces</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('Annonce/create'); ?>">
                <i class="bi bi-circle"></i><span>Envoyer Un Annonce</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url('Notifications_Controller/create'); ?>">
                <i class="bi bi-circle"></i><span>Rappel aux  candidat </span>
                </a>
            </li>

            
            <li>
                <a href="<?php echo base_url('Contact_Controller'); ?>">
                <i class="bi bi-circle"></i><span>Gmail</span>
                </a>
            </li>

        </ul>
    </li><!-- End Tables Nav -->

    
    
   

</ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1><?php echo $pagetitle;?></h1>
    </div><!-- End Page Title -->

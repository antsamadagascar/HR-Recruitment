<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link " href="<?php echo base_url('Home_Controller/dashboard'); ?>">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
        </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-heading">CRUD</li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('Notifications_Controller/notifRe'); ?>">
            <i class="bi bi-bell"></i><span>Notifications</span>
            <?php 
            if (isset($notifications_count) && $notifications_count > 0): ?>
                <span class="badge bg-danger"><?php echo $notifications_count; ?></span>
            <?php endif; ?>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Besoins Entreprise</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="<?php echo base_url('Branche_Controller') ?>">
                <i class="bi bi-circle"></i><span>Branche</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('Poste_Controller'); ?>">
                <i class="bi bi-circle"></i><span>Poste</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('ProfilRequis_Controller'); ?>">
                <i class="bi bi-circle"></i><span>Profil</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('BesoinsEnTalent_Controller') ?>">
                <i class="bi bi-circle"></i><span>Besoins En Talent</span>
                </a>
            </li>
        </ul>
    </li><!-- End Forms Nav -->

   

    <li class="nav-heading">Additionals</li>

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#couts-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-calculator"></i><span>Evaluations </span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="couts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        </li>
            <li>
                <a href="<?php echo base_url('ProfilRequis_Controller/afficherProfilValiderRH'); ?>">
                <i class="bi bi-circle"></i><span>CV valider RH</span>
                </a>
            </li>    
            <li>
                <a href="<?php echo base_url('EvaluationCandidat_Controller'); ?>">
                <i class="bi bi-circle"></i><span>Notes Candidats</span>
                </a>
            <li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('ChatQuestion_Controller'); ?>">
                    <i class="bi bi-file-earmark-lock"></i><span>Modèles de questions d'un IA</span>
                </a>
            </li>
        </ul>
    </li><!-- End Additionals Page Nav -->

 
   

</ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1><?php echo $pagetitle;?></h1>
    </div><!-- End Page Title -->
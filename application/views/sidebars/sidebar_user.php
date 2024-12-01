<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Récupérer la valeur de la session isEmploye
$isEmploye = $this->session->userdata('isEmploye') ? true : false;
$cvValideNonEmbauche = $this->session->userdata('cv_valide_non_embauche');
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
        <a class="nav-link" href="<?php echo site_url('Notifications_Controller/index'); ?>">
            <i class="bi bi-bell"></i><span>Notifications</span>
            <?php 
            if (isset($notifications_count) && $notifications_count > 0): ?>
                <span class="badge bg-danger"><?php echo $notifications_count; ?></span>
            <?php endif; ?>
        </a>
    </li>

            
      <!--Postulation conge-->
      <li class="nav-heading">Postulation</li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#postulation-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>cv</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="postulation-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="<?php echo site_url('Home_Controller/dashboard'); ?>">
                <i class="bi bi-circle"></i><span>Postuler mon cv</span>
                </a>
            </li>    
        </ul>
    </li><!-- End Tables Nav -->

      <!--demande conge-->
      <?php if ($cvValideNonEmbauche === true): ?>
      <li class="nav-heading">Entretien</li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#entretien-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Test</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="entretien-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a  href="<?php echo site_url('ChatBotController') ?>">
                <i class="bi bi-circle"></i><span>Test de Niveau</span>
                </a>
            </li>
        
        </ul>
    </li><!-- End Tables Nav -->
    <?php endif; ?>
    <?php if ($isEmploye === true):  ?>
    <!--demande contrats-->
    <li class="nav-heading">Contrats</li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#contrat-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>contrats</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="contrat-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="<?php echo site_url('Contrat_Controller'); ?>">
                <i class="bi bi-circle"></i><span>Mes contrats</span>
                </a>
            </li>
    
        </ul>
    </li><!-- End Tables Nav -->

    <!--demande conge-->
    <li class="nav-heading">Portails en Self-Service</li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#conge-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Congés</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="conge-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="<?php echo base_url('Conge_Controller'); ?>">
                <i class="bi bi-circle"></i><span>Demande Congés</span>
                </a>
            </li>

           <li>
                <a href="<?php echo base_url('Conge_Controller/consulter_solde'); ?>">
                <i class="bi bi-circle"></i><span>Solde de congés</span>
                </a>
            </li>
    
        </ul>
    </li><!-- End Tables Nav -->
    <?php endif; ?>
</ul>


</aside><!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1><?php echo $pagetitle;?></h1>
    </div><!-- End Page Title -->

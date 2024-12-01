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
        <a class="nav-link" href="<?php echo site_url('Notifications_Controller/notifRh'); ?>">
            <i class="bi bi-bell"></i><span>Notifications</span>
            <?php 
            if (isset($notifications_count) && $notifications_count > 0): ?>
                <span class="badge bg-danger"><?php echo $notifications_count; ?></span>
            <?php endif; ?>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Demande </span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="<?php echo base_url('Demande_Controller/validation_besoin') ?>">
                <i class="bi bi-circle"></i><span>Besoins RE</span>
                </a>
            </li>

            </li>
        </ul>
    </li><!-- End Forms Nav -->
    
    <li class="nav-heading">CV</li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Annonce Recrutement</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="<?php echo base_url('ProfilRequis_Controller/afficherProfilGenerale'); ?>">
                <i class="bi bi-circle"></i><span>Listes CV </span>
                </a>
            </li>
    
        </ul>
    </li><!-- End Tables Nav -->

    <li class="nav-heading">Embauche</li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#embauche-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Contrats</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="embauche-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="<?php echo base_url('Embauche_Controller/create'); ?>">
                <i class="bi bi-circle"></i><span>Embauche</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url('Contrat_Controller/list'); ?>">
                <i class="bi bi-circle"></i><span>Liste Contrats</span>
                </a>
            </li>
    
        </ul>
    </li><!-- End Tables Nav -->

    <li class="nav-heading">Employee</li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#employe-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Employe</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="employe-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="<?php echo base_url('Employe_Controller'); ?>">
                <i class="bi bi-circle"></i><span>Listes de employees</span>
                </a>
            </li>

        </ul>
    </li><!-- End Tables Nav -->

    <li class="nav-heading">Congés</li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#conge-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Congés</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="conge-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
         <li>
                <a href="<?php echo base_url('Conge_Controller/afficher_suivi_conges'); ?>">
                <i class="bi bi-circle"></i><span> Suivi Congés Employés </span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url('Conge_Controller/lister_demandes_conges'); ?>">
                <i class="bi bi-circle"></i><span>Liste Congés En Attente</span>
                </a>
            </li>
    
        </ul>
    </li><!-- End Tables Nav -->

    



    
</ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

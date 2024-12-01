<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-heading">ACTIONS</li>

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Liste des annonces</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Postuler</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Test de niveau</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="<?php echo base_url('Table_Controller/type_centre'); ?>">
                <i class="bi bi-circle"></i><span>Type de Centre</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('Table_Controller/centre'); ?>">
                <i class="bi bi-circle"></i><span>Centre</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('Table_Controller/unite_oeuvre'); ?>">
                <i class="bi bi-circle"></i><span>Unite d'Oeuvre</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('Table_Controller/categorie_charge'); ?>">
                <i class="bi bi-circle"></i><span>Catégorie de Charge</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('Table_Controller/type_charge'); ?>">
                <i class="bi bi-circle"></i><span>Type de Charge</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('Table_Controller/nature_charge'); ?>">
                <i class="bi bi-circle"></i><span>Nature de Charge</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('Table_Controller/rubrique_charge'); ?>">
                <i class="bi bi-circle"></i><span>Rubrique de Charge</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('Table_Controller/charge'); ?>">
                <i class="bi bi-circle"></i><span>Charge</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('Table_Controller/vente'); ?>">
                <i class="bi bi-circle"></i><span>Vente</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('Table_Controller/production'); ?>">
                <i class="bi bi-circle"></i><span>Production</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('Table_Controller/metier'); ?>">
                <i class="bi bi-circle"></i><span>Métier</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('Table_Controller/utilisateur'); ?>">
                <i class="bi bi-circle"></i><span>Utilisateur</span>
                </a>
            </li>
        </ul>
    </li><!-- End Tables Nav -->

    <li class="nav-heading">Additionals</li>

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#couts-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-calculator"></i><span>Coûts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="couts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="<?php echo base_url('Filtre_Controller/choix_centre'); ?>">
                <i class="bi bi-circle"></i><span>Coûts par Centre</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('Filtre_Controller/choix_nature_charge'); ?>">
                <i class="bi bi-circle"></i><span>Coûts Intermédiaires</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('Result_Controller/cout_revient'); ?>">
                <i class="bi bi-circle"></i><span>Coûts de Revient</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('Result_Controller/cout_total'); ?>">
                <i class="bi bi-circle"></i><span>Coûts Total</span>
                </a>
            </li>
        </ul>
    </li><!-- End Additionals Page Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" href="<?php echo base_url('Result_Controller/seuil_rentabilite') ?>">
        <i class="bi bi-piggy-bank"></i>
        <span>Seuil de Rentabilité</span>
        </a>
    </li>
    

</ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1><?php echo $pagetitle;?></h1>
    </div><!-- End Page Title -->
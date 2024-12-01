<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("templates/head");
$this->load->view("templates/header");
$this->load->view("sidebars/sidebar_re");
$this->load->view($contents);
$this->load->view("templates/footer");
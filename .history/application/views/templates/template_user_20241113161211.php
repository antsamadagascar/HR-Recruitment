<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view("templates/head");
$this->load->view("templates/header");
$this->load->view("side/sidebar_user");
$this->load->view($contents);
$this->load->view("templates/footer");
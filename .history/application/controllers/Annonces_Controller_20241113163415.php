<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annonces_Controller extends CI_Controller {

    public function index()
	{
		
		$this->load->view("templates/head", $data);
		$this->load->view('connection/login_view', $data);
		$this->load->view("templates/footer");
	}
}
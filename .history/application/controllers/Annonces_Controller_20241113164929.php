<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annonces_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$utilisateur = $this->session->userdata('utilisateur');
		if (!isset($utilisateur)) {
			$data['title'] = 'Alert';
			$data['pagetitle'] = 'Alert';
			$data['alert'] = 'Vous n\'êtes pas censé entrer directement dans cette page...';
			$data['action'] = 'Connection_Controller';
			$this->load->view("templates/head", $data);
			$this->load->view('alert_view', $data);
			$this->load->view("templates/footer"); 
		}
	}
    public function index()
	{
		$this->load->view('table/annonces_tables');
	}
}
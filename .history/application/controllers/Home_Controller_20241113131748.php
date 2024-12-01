<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_Controller extends CI_Controller {

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

	public function index() {
        $data['title'] = 'Alert';
        $data['pagetitle'] = 'Alert';
		$data['contents'] = 'alert_view';
		$data['alert'] = 'Vous n\'êtes pas censé entrer directement dans cette page...';
		$data['action'] = 'Connection_Controller';
		$this->load->view("templates/head", $data);
		$this->load->view('alert_view', $data);
		$this->load->view("templates/footer");
    }

	public function dashboard() {
		$utilisateur = $this->session->userdata('utilisateur');
		if ($utilisateur->etat < 0) {
			# UTILISATEUR
		}
		if ($utilisateur->etat < 0) {
			# code...
		}
		if ($utilisateur->etat < 0) {
			# code...
		}

		$data['chiffre_affaire'] = 'Dashboard';
		$data['total_charge_fixe'] = 'Dashboard';
		$data['total_charge_variable'] = 'Dashboard';
		$data['seuil_rentabilite'] = 'Dashboard';

		// definition des donnees variables du template
		$data['title'] = 'Dashboard';
		$data['pagetitle'] = 'Dashboard';

		// on charge la view qui contient le corps de la page
		$data['contents'] = 'home/dashboard_view';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
	}
}

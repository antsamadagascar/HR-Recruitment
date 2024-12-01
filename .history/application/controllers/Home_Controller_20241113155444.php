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
		$user = $this->session->userdata('utilisateur'); // Récupération de l'utilisateur connecté
		
		// Définition des données variables du template
		$data['user'] = $user;
	
		// Vérification de l'état de l'utilisateur et chargement de la vue appropriée
		if ($user->etat < 0) {
			$data['title'] = 'User page';
			$data['pagetitle'] = 'User page';
			$data['contents'] = 'home/user_dashboard_view'; // Vue pour un utilisateur simple
			$this->load->view('templates/template_', $data);
		} elseif ($user->etat == 0) {
			// Administrateur
			$data['contents'] = 'home/admin_dashboard_view'; // Vue pour un administrateur
			$this->load->view('templates/template', $data);
		} elseif ($user->etat > 0) {
			// Ressources humaines
			$data['contents'] = 'home/rh_dashboard_view'; // Vue pour les ressources humaines
			$this->load->view('templates/template', $data);
		} else {
			// Par défaut (si l'état est inconnu ou invalide)
			$data['contents'] = 'home/default_dashboard_view'; // Vue par défaut
			$this->load->view('templates/template', $data);
		}
	}
	
}

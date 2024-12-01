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
		$user = $this->session->userdata('utilisateur'); 

		$data['user'] = $user;

		$idCandidat = $user->id;
		$data['notifications_count'] = $this->Notifications_Model->get_count_notifications($idCandidat);
	
		print_r($user->id);
		// Candidat
		if ($user->etat < 0) {
			$data['title'] = 'User page';
			$data['pagetitle'] = 'User page';
			$data['contents'] = 'home/user_dashboard_view';
			$data['branches'] = $this->Branche_Model->get_all_branche(); 
		
			$this->load->view('templates/template_user', $data); 
		}
		elseif ($user->etat == 0) {
			// Administrateur
			$data['contents'] = 'home/admin_dashboard_view'; 
			$this->load->view('templates/template', $data);
		} elseif ($user->etat == 1) {
			// Ressources humaines\
			$data['title'] = 'Responsable Resources Humaine';
			$data['pagetitle'] = 'Responsable Resources Humaine';
			$data['contents'] = 'home/rh_dashboard_view'; 
			$this->load->view('templates/template_rh', $data);
		}
		elseif ($user->etat == 2) {
			// responsable communication
			$data['title'] = 'Responsable Communication';
			$data['pagetitle'] = 'Responsable Communication';
			$data['contents'] = 'home/rc_dashboard_view'; 
			$this->load->view('templates/template_rc', $data);
		} 
		elseif ($user->etat == 3) {
			// Responsable Equipe
			$data['title'] = 'Responsable Equipe';
			$data['pagetitle'] = 'Responsable Equipe';
			$data['contents'] = 'home/re_dashboard_view'; 
			$this->load->view('templates/template_re', $data);
		} 
		else {
			// Par défaut (si l'état est inconnu ou invalide)
			$data['contents'] = 'home/default_dashboard_view'; 
			$this->load->view('templates/template', $data);
		}
	}
	
}

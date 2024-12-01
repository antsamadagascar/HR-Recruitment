<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Connection_Controller extends CI_Controller {

    public function index()
	{
		$data['title'] = 'Login';
		$data['action'] = 'Connection_Controller/login';
		$this->load->view("templates/head", $data);
		$this->load->view('connection/login_view', $data);
		$this->load->view("templates/footer");
	}

	public function login() {
		$email = $this->input->post('email');
		$mot_de_passe = $this->input->post('mot_de_passe');
		$this->Functions->login($email, $mot_de_passe);
	}

	public function signout() {
		$this->session->unset_userdata('utilisateur');
		$data['title'] = 'Info';
		$data['alert'] = 'Vous avez été déconnecté avec succès. A bientôt...';
		$data['action'] = 'Connection_Controller';
		$this->load->view("templates/head", $data);
		$this->load->view('alert_view', $data);
		$this->load->view("templates/footer");
	}

}
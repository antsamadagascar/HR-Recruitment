<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Functions extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function login($email, $mot_de_passe) {
        $this->db->where('email', $email);
        $this->db->where('mot_de_passe', sha1($mot_de_passe));
        $query = $this->db->get('utilisateur');

        $utilisateur = $query->result();
        if (count($utilisateur) != 1) {
			$data['title'] = 'Alert';
			$data['alert'] = 'Cet utilisateur n\'existe pas. Veuillez contacter l\'Administrateur de Base de Donnée pour vous créer un utilisateur ...';
			$data['action'] = 'Connection_Controller';
            $this->load->view("templates/head", $data);
            $this->load->view('alert_view', $data);
            $this->load->view("templates/footer");

		} else {
            $user = $utilisateur[0];
			$this->session->set_userdata('utilisateur', $user);
			$data['title'] = 'Info';
			$data['alert'] = 'Vous avez été connecté avec succès à l\'utilisateur ' . $user->username . '...';
			$data['action'] = 'Home_Controller/dashboard';
            $this->load->view("templates/head", $data);
            $this->load->view('alert_view', $data);
            $this->load->view("templates/footer");
        }
    }

}
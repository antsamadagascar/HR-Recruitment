<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Functions extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function login($email, $mot_de_passe) {
        // Vérification des identifiants
        $this->db->where('email', $email);
        $this->db->where('motdepasse', md5($mot_de_passe));
        $query = $this->db->get('candidat');

        $utilisateur = $query->result();
        if (count($utilisateur) != 1) {
            // Si l'utilisateur n'existe pas
            $data['title'] = 'Alert';
            $data['alert'] = 'Cet utilisateur n\'existe pas. Veuillez contacter l\'Administrateur de Base de Donnée pour vous créer un utilisateur ...';
            $data['action'] = 'Connection_Controller';
            $this->load->view("templates/head", $data);
            $this->load->view('alert_view', $data);
            $this->load->view("templates/footer");
        } else {
            // Si l'utilisateur existe
            $user = $utilisateur[0];

            // Ajouter l'utilisateur à la session
            $this->session->set_userdata('utilisateur', $user);
            $this->load->Model('Employe_Model');
            
            // Vérifier si l'utilisateur est un employé
            $isEmploye = $this->Employe_Model->checkIsEmploye($user->id);
            $this->session->set_userdata('isEmploye', $isEmploye);

            // Vérifier si le CV est validé et non embauché
            $cvValideEtNonEmbauche = $this->Employe_Model->checkCvValideEtNonEmbauche($user->id);
            $this->session->set_userdata('cv_valide_non_embauche', $cvValideEtNonEmbauche);
            // Affichage de l'alerte de succès
            $data['title'] = 'Info';
            $data['alert'] = 'Vous avez été connecté avec succès en tant que ' . $user->nom . ' (ID: ' . $user->id . ').';
            $data['action'] = 'Home_Controller/dashboard';
            $this->load->view("templates/head", $data);
            $this->load->view('alert_view', $data);
            $this->load->view("templates/footer");
        }
    }

}


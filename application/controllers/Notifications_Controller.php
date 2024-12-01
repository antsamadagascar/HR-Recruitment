<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url'); 
        $this->load->model('Notifications_Model');
        $this->load->library('session');

    }
    public function index() {
        $utilisateur = $this->session->userdata('utilisateur');
        $idCandidat = $utilisateur->id;
        $data['pagetitle'] = 'notifications candidat';
        $data['contents']= 'notifications/notifications';
        $data['message'] ='coucou';
        $data['notifications'] = $this->Notifications_Model->get_notification($idCandidat);
        $this->load->view('templates/template_user', $data);
    
    }

    public function create() {
        $data['candidatsValides'] = $this->Candidat_Model->get_all_candidat_validate_cv(); 
        $data['pagetitle'] = 'Notifications';
        $data['contents'] = 'notifications/create'; 

        $this->load->view('templates/template_rc', $data);
    }

    
    public function sendNotification() {
        if ($this->input->post()) {
            $candidat_id = $this->input->post('idcandidat');
            $message = $this->input->post('message');
    
            if (!$candidat_id || !$message) {
                $this->session->set_flashdata('error', 'Tous les champs doivent être remplis.');
                redirect('notifications_Controller/create');
            }
    
            $data = [
                'idcandidat' => $candidat_id,
                'message' => $message,
                'datenotification' => date('Y-m-d H:i:s'),  
                'islue' => false
            ];
    
            try {
                $this->Notifications_Model->insert_notifications($data);
                $this->session->set_flashdata('success', 'Notification envoyée avec succès.');
                redirect('notifications_Controller/create');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', 'Erreur lors de l\'envoi de la notification : ' . $e->getMessage());
                redirect('notifications_Controller/create');
            }
        }
    }
      
    public function notifRe() {
        $utilisateur = $this->session->userdata('utilisateur');
        $idCandidat = $utilisateur->id;
        $data['pagetitle'] = 'notifications Responsable equipe';
        $data['contents']= 'notifications/notifications';
        $data['message'] ='coucou';
        $data['notifications'] = $this->Notifications_Model->get_notification($idCandidat);
        $this->load->view('templates/template_re', $data);
    
    }

    public function notifRh() {
        $utilisateur = $this->session->userdata('utilisateur');
        $idCandidat = $utilisateur->id;
        $data['pagetitle'] = 'Notifications Responsable RH';
        $data['contents']= 'notifications/notifications';
        $data['message'] ='coucou';
        $data['notifications'] = $this->Notifications_Model->get_notification($idCandidat);
        $this->load->view('templates/template_rh', $data);
    
    }

    public function notifRc() {
        $utilisateur = $this->session->userdata('utilisateur');
        $idCandidat = $utilisateur->id;
        $data['pagetitle'] = 'Notifications Responsable Communication';
        $data['contents']= 'notifications/notifications';
        $data['message'] ='coucou';
        $data['notifications'] = $this->Notifications_Model->get_notification($idCandidat);
        $this->load->view('templates/template_rc', $data);
    
    }

    public function mark_all_read() {
        $utilisateur = $this->session->userdata('utilisateur');
        $idCandidat = $utilisateur->id;
    
        if (!$idCandidat) {
            $this->session->set_flashdata('error', 'Utilisateur non identifié.');
            redirect('notifications');
        }
    
        try {
            // Marquer toutes les notifications comme lues pour ce candidat
            $this->Notifications_Model->marquer_tout_comme_lu($idCandidat);
    
            // Message de succès
            $this->session->set_flashdata('success', 'Toutes les notifications ont été marquées comme lues.');
    
            // Récupérer les informations de l'utilisateur
            $user = $this->session->userdata('utilisateur');
            $etat = $user->etat; // Le rôle de l'utilisateur (Candidat, Administrateur, RH, etc.)
    
            // Rediriger en fonction du rôle de l'utilisateur
            if ($etat <1) {
                // Candidat
                redirect('notifications_Controller');
            } elseif ($etat == 0) {
                // Administrateur
                redirect('notifications_Controller/notifAdmin');
            } elseif ($etat == 1) {
                // Ressources humaines
                redirect('notifications_Controller/notifrh');
            } elseif ($etat == 2) {
                // Responsable communication
                redirect('notifications_Controller/notifrc');
            } elseif ($etat == 3) {
                // Responsable équipe
                redirect('notifications_Controller/notifre');
            } 
            else {
                // Par défaut (si l'état est inconnu ou invalide)
                redirect('default/dashboard');
            }
        } catch (Exception $e) {
            // Gestion des erreurs
            $this->session->set_flashdata('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
  
        }
    }

    
}

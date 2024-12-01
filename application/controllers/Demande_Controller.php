<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demande_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('BesoinsEnTalent_Model');  // Chargement du modèle
    }

    // Fonction pour afficher les demandes de besoins en talent
    public function validation_besoin() {
        $data['pagetitle'] = 'Validation des Besoins en Talent'; 
        $data['contents'] = 'demande/validation_besoin'; 
        
    // Insérer la notification
    $notificationDataRc = [
        'idcandidat' => 4  ,  //(RC)
        'message' => 'Le responsqble Rh vous a demander de faire une annonces sur ce besoins en talent verifier votre interface de demande! ',
        'datenotification' => date('Y-m-d')
    ];
    $this->Notifications_Model->insert_notifications($notificationDataRc);
        // Récupérer les demandes de besoins en talent (isdemande = false)
        $data['besoins_en_talent'] = $this->BesoinsEnTalent_Model->get_demande_besoin_talent();
        
        // Charger la vue avec les données
        $this->load->view('templates/template_rh', $data);
    }

    public function traiter_besoin($id) {
    $utilisateur = $this->session->userdata('utilisateur'); 
    
    // Données à mettre à jour : statut = 1 (accepté) et isdemande = true
    $data = array(
        'status' => 1,      // Accepté
        'isdemande' => true // Demande acceptée
    );
    
    // Insérer la notification
    $notificationData = [
        'idcandidat' => 3   ,  //(RE)
        'message' => 'Votre demande de besoins a été acceptée avec succès par le responsable ' . $utilisateur->nom,
        'datenotification' => date('Y-m-d')
    ];
    $this->Notifications_Model->insert_notifications($notificationData);

    // Mettre à jour les données dans la table BesoinsEnTalent
    $this->BesoinsEnTalent_Model->update_besoinsentalent($id, $data);
    
    // Redirection après l'action
    redirect('demande_Controller/validation_besoin');
}

public function refuse_besoin($id) {
    $utilisateur = $this->session->userdata('utilisateur');
    
    // Données à mettre à jour : statut = 2 (refusé) et isdemande = false
    $data = array(
        'status' => 2,      // Refusé
        'isdemande' => false // Demande refusée
    );

    // Débogage des données
    var_dump($data);  // Affiche les données envoyées

    // Insérer la notification
    $notificationRE = [
        'idcandidat' => 3,  // (RE)
        'message' => 'Votre demande de besoin a été refusée par le responsable ' . $utilisateur->nom,
        'datenotification' => date('Y-m-d')
    ];
    $this->Notifications_Model->insert_notifications($notificationRE);

    // Insérer la notification
    $notificationRC = [
        'idcandidat' => 4,  // (RC)
        'message' => 'Vous avez recu un demande d\'annonce venant du responsable Resource humaines ' . $utilisateur->nom,
        'datenotification' => date('Y-m-d')
    ];
    // Mettre à jour les données dans la table BesoinsEnTalent
    $this->Notifications_Model->insert_notifications($notificationRC);
    $this->BesoinsEnTalent_Model->update_besoinsentalent($id, $data);
    
    // Redirection après l'action
    redirect('demande_Controller/validation_besoin');
}


public function liste_annonces_valider_rh() {
    try {
        // Charger les données depuis la vue SQL via le modèle
        $this->load->model('Annonce_Model'); // Charger le modèle si ce n'est pas déjà fait
        $annonces = $this->Annonce_Model->get_all_annonce_valider_par_rh();

        // Charger la vue et transmettre les données
        $data['annonces'] = $annonces;
        $this->load->view('annonces/create', $data);
    } catch (Exception $e) {
        // Gérer les erreurs
        show_error('Erreur lors du chargement des annonces validées : ' . $e->getMessage());
    }
}


}
?>

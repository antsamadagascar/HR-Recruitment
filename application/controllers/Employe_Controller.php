<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employe_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Employe_Model'); 
    }

    public function index() {
    $data['title'] = 'Listes Employés';
    $data['pagetitle'] = 'Droits Conges des Employe';
    $data['contents'] = 'employe/list'; 
    // Récupérer tous les employés
    $employes = $this->Employe_Model->listeEmploye();

    // Ajouter la vérification de congé pour chaque employé
    foreach ($employes as &$employe) {
        $employe['conge_attribue'] = $this->Employe_Model->verifierDroitConge($employe['idcandidat']);
    }

    $data['employes'] = $employes;

    // Charger la vue avec les employés et leurs statuts de congé
    $this->load->view('templates/template_rh', $data);
}


    public function calculerConges() {
        // Récupérer l'ID de l'employé depuis le formulaire
        $employeId = $this->input->post('employeId');
    
        try {
            // Calculer les droits de congés en utilisant l'année actuelle automatiquement
            $droitsConges = $this->Employe_Model->calculerDroitsConges($employeId);
    
            // Message de succès
            $this->session->set_flashdata('success', "Les droits de congés pour l'employé $employeId ont été attribués avec succès pour l'année actuelle.");
        } catch (Exception $e) {
            // Message d'erreur
            $this->session->set_flashdata('error', "Erreur lors de l'attribution des droits de congés : " . $e->getMessage());
        }
    
        // Redirection vers la page des employés
        redirect('employe_controller/index');
    }
    
}
?>

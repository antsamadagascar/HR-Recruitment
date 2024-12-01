<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conge_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Conge_Model');
        $this->load->model('Type_Conge_Model');
    }

    public function index() {
        $user = $this->session->userdata('utilisateur'); 
        $idemploye = $user->id; 
        
        $data['idemploye'] = $idemploye;
        $data['typeConge'] = $this->Type_Conge_Model->get_all_TypeConge();
        $data['pagetitle'] = 'Section Congés';
        $data['contents'] = 'conge/demande';
        
        $this->load->view('templates/template_user', $data);
    }

    public function lister_demandes_conges() {
        $data['demandes'] = $this->Conge_Model->get_all_demandes();
 
        $data['pagetitle'] = 'Liste des demandes de congés';
        $data['contents'] = 'conge/liste_conges';

        $this->load->view('templates/template_rh', $data);
    }
    
    

    public function demande() {
        if ($this->input->post()) {
            $data = [
                'idemploye' => $this->input->post('idemploye'),
                'idtypeconge' => $this->input->post('idtypeconge'),
                'datedebut' => $this->input->post('datedebut'),
                'datefin' => $this->input->post('datefin'),
                'nombrejours' => $this->input->post('nbrjours'),
                'motif' => $this->input->post('motif'),
            ];
    
            try {
                $this->Conge_Model->insert_demande_conge($data);
                $this->session->set_flashdata('success', 'Congé ajouté avec succès.');
                redirect('Conge_Controller');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', 'Erreur : ' . $e->getMessage());
                redirect('Conge_Controller/demande');
            }
        } else {
            $data['typeConge'] = $this->Type_Conge_Model->get_all_TypeConge();
            $data['pagetitle'] = 'Section Congé';
            $data['contents'] = 'conge/demande';
            $this->load->view('templates/template_user', $data);
        }
    }
    

  
    public function valider($id) {
        $user = $this->session->userdata('utilisateur');
        $idapprobateur = $user->id; 
    
        try {
            // Appeler la fonction de validation et obtenir le message retourné
            $message = $this->db->query("SELECT validerDemandeConge($id, $idapprobateur)")->row()->validerdemandeconge;
    
            // Définir le message dans la session
            if ($message === 'Demande de congé approuvée avec succès.') {
                $this->session->set_flashdata('success', $message);
            } else {
                $this->session->set_flashdata('error', $message);
            }
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Erreur : ' . $e->getMessage());
        }
    
        // Rediriger vers la page des demandes de congé
        redirect('Conge_Controller/lister_demandes_conges');
    }
    
    
    public function afficher_suivi_conges() {
        $data['pagetitle'] = 'Suivi et Gestion des Congés';
        $data['contents']= 'conge/suivi_conges';
        $query = $this->db->get('vuedroitsconge');
        $data['conges'] = $query->result(); 
        $this->load->view('templates/template_rh', $data);
    }

    public function consulter_solde() {
        $data['pagetitle'] = 'Suivi Solde Congés';
        $data['contents']= 'conge/solde_conges';

        $user = $this->session->userdata('utilisateur');
        $employeId = $user->id; 
        $query = $this->db->query("SELECT * FROM v_suivi_conge_employes WHERE employe_id = ?", [$employeId]);
        $data['soldes'] = $query->result();
        $this->load->view('templates/template_user', $data);
    }
    
}
?>

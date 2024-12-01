<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EvaluationCandidat_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('EvaluationCandidat_Model');
    }

    public function index() {
		$data['pagetitle'] = 'Evaluation Notes Candidats';	
        $data['contents'] = 'evaluationCandidat/list';
        $data['evaluationcandidat'] = $this->EvaluationCandidat_Model->get_all_evaluationcandidat();
        $this->load->view('templates/template_re', $data);
    }

    public function create() {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->EvaluationCandidat_Model->insert_evaluationcandidat($data);
                $this->session->set_flashdata('success', 'EvaluationCandidat ajouté avec succès.');
                redirect('evaluationcandidat_Controller/create');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $this->load->view('admin/crud/evaluationcandidat/create');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->EvaluationCandidat_Model->update_evaluationcandidat($id, $data);
                $this->session->set_flashdata('success', 'EvaluationCandidat mis à jour avec succès.');
                redirect('evaluationcandidat_Controller/list');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['item'] = $this->EvaluationCandidat_Model->get_evaluationcandidat($id);
        $this->load->view('admin/crud/evaluationcandidat/edit', $data);
    }

    public function delete($id) {
        try {
            $this->EvaluationCandidat_Model->delete_evaluationcandidat($id);
            $this->session->set_flashdata('success', 'EvaluationCandidat supprimé avec succès.');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        redirect('evaluationcandidat_Controller/list');
    }

    public function update_status($id, $action) {
        // Vérifier si l'action est valide
        if ($action !== 'valid' && $action !== 'refuse') {
            $this->session->set_flashdata('error', 'Action invalide.');
            redirect('evaluationcandidat_Controller');
        }
    
        // Appeler la méthode du modèle pour mettre à jour la colonne isValide
        $isUpdated = $this->EvaluationCandidat_Model->update_validation_status($id, $action);
    
        // Si l'action est "valid", envoyer une notification au RC (idCandidat = 4)
        if ($isUpdated && $action === 'valid') {
            // Récupérer les informations du candidat validé
            $candidat = $this->Candidat_Model->get_candidat($id);
    
            if ($candidat) {
                // Préparer le message de la notification avec le nom et prénom du candidat
                $message = "Le candidat " . $candidat->nom . " " . $candidat->prenom . " a été validé avec succès. Veuillez organiser l'entretien pour ce candidat.";
    
                // Préparer les données de la notification
                $data = array(
                    'idcandidat' => 4, // RC ID (peut être dynamique selon votre logique)
                    'message' => $message,
                    'datenotification' => date('Y-m-d'),
                    'islue' => false
                );
    
                // Appeler la méthode pour insérer la notification
                $this->Notifications_Model->insert_notifications($data);
    
                // Message de succès
                $this->session->set_flashdata('success', 'Le statut a été mis à jour et une notification a été envoyée au RC.');
            } else {
                $this->session->set_flashdata('error', 'Le candidat spécifié n\'a pas été trouvé.');
            }
        } elseif ($isUpdated && $action === 'refuse') {
            // Message de refus
            $this->session->set_flashdata('success', 'Le statut a été mis à jour. Le candidat a été refusé.');
        } else {
            // Si l'update échoue
            $this->session->set_flashdata('error', 'Erreur lors de la mise à jour du statut.');
        }
    
        // Rediriger vers la page d'affichage des évaluations
        redirect('evaluationcandidat_Controller/index');
    }
    
    
}
?>

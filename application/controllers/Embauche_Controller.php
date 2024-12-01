<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Embauche_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Embauche_Model');


    }

    public function index() {
        $data['embauche'] = $this->Embauche_Model->get_all_embauche();
        $this->load->view('embauche_Controller/list', $data);
    }

    public function create() {
        $data['title'] = 'Embauche Candidats';
        $data['pagetitle'] = 'Embauche Candidats';
        $data['contents'] = 'embauche/create';

        $data['candidats'] = $this->Embauche_Model->get_candidats_valides();
        $data['contrats'] = $this->Contrat_Model->get_contrat();
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Embauche_Model->insert_embauche($data);
                $this->session->set_flashdata('success', 'Embauche ajouté avec succès.');
                redirect('embauche_Controller/create');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $this->load->view('templates/template_rh',$data);
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Embauche_Model->update_embauche($id, $data);
                $this->session->set_flashdata('success', 'Embauche mis à jour avec succès.');
                redirect('embauche_Controller/list');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['item'] = $this->Embauche_Model->get_embauche($id);
        $this->load->view('embauche_Controller/edit', $data);
    }

    public function delete($id) {
        try {
            $this->Embauche_Model->delete_embauche($id);
            $this->session->set_flashdata('success', 'Embauche supprimé avec succès.');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        redirect('embauche_Controller/list');
    }

    // Méthode pour mettre à jour le contrat
    public function update_contrat_candidat() {
        // Vérifier si l'action et l'ID sont passés via POST
        $idEmb = $this->input->post('idembauche');
        $action = $this->input->post('action');

        // Vérification pour s'assurer que les données sont bien reçues
  
        // Vérifier si les données sont présentes
        if ($idEmb && $action) {
            // Appeler la méthode du modèle pour mettre à jour le contrat
            $updateStatus = $this->Embauche_Model->update_contrat($idEmb, $action);

            // Vérifier si l'update a réussi
            if ($updateStatus) {
                // Rediriger ou envoyer une réponse de succès
                $this->session->set_flashdata('success', 'Le contrat a été mis à jour avec succès.');
            } else {
                // Si l'action échoue, afficher un message d'erreur
                $this->session->set_flashdata('error', 'Erreur lors de la mise à jour du contrat.');
            }
        } else {
            // Si l'ID ou l'action sont manquants, afficher un message d'erreur
            $this->session->set_flashdata('error', 'ID ou action manquants.');
        }

        // Redirection vers la page des contrats
        redirect('contrat_Controller');
    }
}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidature_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Candidature_Model');
    }

    public function index() {
        $data['candidature'] = $this->Candidature_Model->get_all_candidature();
        $this->load->view('admin/crud/candidature/list', $data);
    }

    public function create() {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Candidature_Model->insert_candidature($data);
                $this->session->set_flashdata('success', 'Candidature ajouté avec succès.');
                redirect('Candidature_Controller/create');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $this->load->view('admin/crud/candidature/create');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Candidature_Model->update_candidature($id, $data);
                $this->session->set_flashdata('success', 'Candidature mis à jour avec succès.');
                redirect('Candidature_Controller/list');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['item'] = $this->Candidature_Model->get_candidature($id);
        $this->load->view('admin/crud/candidature/edit', $data);
    }

    public function delete($id) {
        try {
            $this->Candidature_Model->delete_candidature($id);
            $this->session->set_flashdata('success', 'Candidature supprimé avec succès.');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        redirect('Candidature_Controller/list');
    }

    
    public function updateCandidatStatus()
    {
        $this->load->model('Candidature_Model');

        $data = json_decode($this->input->raw_input_stream, true);

        $candidatId = $data['candidatId'] ?? null;
        $status = $data['status'] ?? null;

        if (!$candidatId || !$status) {
            echo json_encode(['success' => false, 'message' => 'Données invalides']);
            return;
        }

        $success = $this->Candidature_Model->updateCandidatStatus($candidatId, $status);

        if ($success) {
            echo json_encode(['success' => true, 'message' => "Statut mis à jour avec succès"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Échec de la mise à jour"]);
        }
        $this->load->view('templates/template_rh');
    }
}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Competence_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Competence_Model');
    }

    public function index() {
        $data['competence'] = $this->Competence_Model->get_all_competence();
        $this->load->view('admin/crud/competence/list', $data);
    }

    public function create() {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Competence_Model->insert_competence($data);
                $this->session->set_flashdata('success', 'Competence ajouté avec succès.');
                redirect('Competence_Controller/create');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $this->load->view('admin/crud/competence/create');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Competence_Model->update_competence($id, $data);
                $this->session->set_flashdata('success', 'Competence mis à jour avec succès.');
                redirect('Competence_Controller/list');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['item'] = $this->Competence_Model->get_competence($id);
        $this->load->view('admin/crud/competence/edit', $data);
    }

    public function delete($id) {
        try {
            $this->Competence_Model->delete_competence($id);
            $this->session->set_flashdata('success', 'Competence supprimé avec succès.');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        redirect('Competence_Controller/list');
    }

}
?>

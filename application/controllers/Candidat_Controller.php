<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidat_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Candidat_Model');
    }

    public function index() {
        $data['candidat'] = $this->Candidat_Model->get_all_candidat();
        $this->load->view('admin/crud/candidat/list', $data);
    }

    public function create() {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Candidat_Model->insert_candidat($data);
                $this->session->set_flashdata('success', 'Candidat ajouté avec succès.');
                redirect('Candidat_Controller/create');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $this->load->view('admin/crud/candidat/create');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Candidat_Model->update_candidat($id, $data);
                $this->session->set_flashdata('success', 'Candidat mis à jour avec succès.');
                redirect('Candidat_Controller/list');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['item'] = $this->Candidat_Model->get_candidat($id);
        $this->load->view('admin/crud/candidat/edit', $data);
    }

    public function delete($id) {
        try {
            $this->Candidat_Model->delete_candidat($id);
            $this->session->set_flashdata('success', 'Candidat supprimé avec succès.');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        redirect('Candidat_Controller/list');
    }

}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contrat_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Contrat_Model');
    }

    public function index() {
        $utilisateur = $this->session->userdata('utilisateur');
        $candidatId= $utilisateur->id;
        $data['pagetitle'] = 'contrat candidat';
        $data['contents'] = 'contrats/contrat_employer';
        $data['contrat'] = $this->Contrat_Model->get_contrat_by_candidatId($candidatId);
        $this->load->view('templates/template_user', $data);

    }

    public function list() {
        $utilisateur = $this->session->userdata('utilisateur');
        $candidatId= $utilisateur->id;
        $data['pagetitle'] = 'contrat candidat';
        $data['contents'] = 'contrats/contrats-list';
        $data['contrat'] = $this->Contrat_Model->get_all_contrat();
        $this->load->view('templates/template_rh', $data);

    }


    public function create() {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Contrat_Model->insert_contrat($data);
                $this->session->set_flashdata('success', 'Contrat ajouté avec succès.');
                redirect('Contrat_Controller/create');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $this->load->view('admin/crud/contrat/create');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Contrat_Model->update_contrat($id, $data);
                $this->session->set_flashdata('success', 'Contrat mis à jour avec succès.');
                redirect('Contrat_Controller/list');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['item'] = $this->Contrat_Model->get_contrat($id);
        $this->load->view('admin/crud/contrat/edit', $data);
    }

    public function delete($id) {
        try {
            $this->Contrat_Model->delete_contrat($id);
            $this->session->set_flashdata('success', 'Contrat supprimé avec succès.');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        redirect('Contrat_Controller/list');
    }

}
?>

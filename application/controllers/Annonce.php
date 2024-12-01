<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annonce extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Annonce_Model');
        $this->load->model('BesoinsEnTalent_Model');
    }

    public function index() {
        $data['title'] = 'Listes Annonce';
		$data['pagetitle'] = 'Listes Annonce';
        $data['contents'] = 'annonces/list';
  
        $data['annonce'] = $this->Annonce_Model->get_all_annonce();
        $this->load->view('templates/template_rc', $data);
    }

    public function create() {
        $data['title'] = 'creer Annonce';
		$data['pagetitle'] = 'creer Annonce';
        $data['contents'] = 'annonces/create';
        $annonces = $this->Annonce_Model->get_all_annonce_valider_par_rh();
        $data['annonces'] = $annonces;
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Annonce_Model->insert_annonce($data);
                $this->session->set_flashdata('success', 'Annonce ajouté avec succès.');
                redirect('Annonce');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['besoin_talents'] = $this->BesoinsEnTalent_Model->get_all_besoinsentalent();
        $this->load->view('templates/template_rc', $data);
    }

    public function edit($id) {
        $data['title'] = 'delete Annonce';
		$data['pagetitle'] = 'delete Annonce';
        $data['contents'] = 'annonces/edit';
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Annonce_Model->update_annonce($id, $data);
                $this->session->set_flashdata('success', 'Annonce mis à jour avec succès.');
                redirect('Annonce');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['besoin_talents'] = $this->BesoinsEnTalent_Model->get_all_besoinsentalent();
        $data['item'] = $this->Annonce_Model->get_annonce_by_idAnnonce($id);
        $this->load->view('templates/template_rc', $data);
    }

    public function delete($id) {
        try {
            $this->Annonce_Model->delete_annonce($id);
            $this->session->set_flashdata('success', 'Annonce supprimé avec succès.');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        redirect('Annonce');
    }

}
?>

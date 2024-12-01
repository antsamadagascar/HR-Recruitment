<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfilRequis_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ProfilRequis_Model');
        $this->load->helpers('ats_helper');
        
    }

    public function index() {
        $data['pagetitle'] = 'Section Poste';
        $data['contents']= 'profilrequis/list';
        $data['profilrequis'] = $this->ProfilRequis_Model->get_all_profilrequis();
        $this->load->view('templates/template_re', $data);
    }

    public function create() {
        $data['pagetitle'] = 'Section Poste';
        $data['contents']= 'profilrequis/create';
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->ProfilRequis_Model->insert_profilrequis($data);
                $this->session->set_flashdata('success', 'ProfilRequis ajouté avec succès.');
                redirect('profilrequis_Controller');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['postes'] = $this->Poste_Model->get_all_poste();  
        $this->load->view('templates/template_re', $data);
    }

        public function edit($id) {
            $data['pagetitle'] = 'Section Poste';
            $data['contents']= 'profilrequis/edit';
            if ($this->input->post()) {
                $data = $this->input->post();
                try {
                    $this->ProfilRequis_Model->update_profilrequis($id, $data);
                    $this->session->set_flashdata('success', 'ProfilRequis mis à jour avec succès.');
                    redirect('profilrequis_Controller');
                } catch (Exception $e) {
                    $this->session->set_flashdata('error', $e->getMessage());
                }
            }
            $data['postes'] = $this->Poste_Model->get_all_poste();  
            $data['item'] = $this->ProfilRequis_Model->get_profilrequis($id);
            $this->load->view('templates/template_re', $data);
        }

    public function delete($id) {
        try {
            $this->ProfilRequis_Model->delete_profilrequis($id);
            $this->session->set_flashdata('success', 'ProfilRequis supprimé avec succès.');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        redirect('profilrequis_Controller');
    }


    public function afficherProfilGenerale() {
        $data['pagetitle'] = 'SYSTEME ATS';
        $data['contents']= 'profilrequis/profil_recrutement';
   
        $data['profilRequis'] = $this->ProfilRequis_Model->getProfilRequisEntreprise();
        $data['profilCandidats'] = $this->ProfilRequis_Model->getProfilCandidats();
  
        $data['profilRequis'] = array_map(function($item) {
            return is_object($item) ? get_object_vars($item) : $item;
        }, $data['profilRequis']);
        
        $data['profilCandidats'] = array_map(function($item) {
            return is_object($item) ? get_object_vars($item) : $item;
        }, $data['profilCandidats']);
        $this->load->view('templates/template_rh', $data);
        
    }

    public function afficherProfilValiderRH() {
        $data['pagetitle'] = 'Listes des Cv Valider par RH';
        $data['contents']= 'profilrequis/profil_valider_rh';
   
        $data['profilCandidats'] = $this->ProfilRequis_Model->getProfilCandidatsValiderParRh();
        $this->load->view('templates/template_re', $data);
    }
}
?>

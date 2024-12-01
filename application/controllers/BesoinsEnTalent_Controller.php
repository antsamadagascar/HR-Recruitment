<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BesoinsEnTalent_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('BesoinsEnTalent_Model');
    }

    public function index() {
        $data['pagetitle'] = 'Section Besoin En Talent';
        $data['contents']= 'besoinsentalent/list';
        $data['profilrequis'] = $this->ProfilRequis_Model->get_all_profilrequis();
        $data['besoinsentalent'] = $this->BesoinsEnTalent_Model->get_all_besoinsentalent();
        $this->load->view('templates/template_re', $data);
    }

    public function create() {
        $utilisateur = $this->session->userdata('utilisateur'); 
        $idUser = $utilisateur->id;
        
        $data['pagetitle'] = 'Section Besoin En Talent';
        $data['contents'] = 'besoinsentalent/create';
    
        if ($this->input->post()) {
            $data = $this->input->post(); 
            
            try {
                $this->BesoinsEnTalent_Model->insert_besoinsentalent($data);
    
                $notificationData = [
                    'idcandidat' => 2, 
                    'message' => 'Un nouveau besoin en talent a été demander par  ' . $utilisateur->nom,
                    'datenotification' => date('Y-m-d') 
                ];
                
                $this->Notifications_Model->insert_notifications($notificationData);

                $this->session->set_flashdata('success', 'BesoinsEnTalent ajouté avec succès et notification envoyée.');
                redirect('besoinsentalent_Controller');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }

        $data['profilrequis'] = $this->ProfilRequis_Model->get_all_profilrequis(); 
        $this->load->view('templates/template_re', $data);
    }
    

    public function edit($id) {
        $data['pagetitle'] = 'Section Besoin En Talent';
        $data['contents']= 'besoinsentalent/edit';
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->BesoinsEnTalent_Model->update_besoinsentalent($id, $data);
                $this->session->set_flashdata('success', 'BesoinsEnTalent mis à jour avec succès.');
                redirect('besoinsentalent_Controller');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['profilrequis'] = $this->ProfilRequis_Model->get_all_profilrequis(); 
        $data['item'] = $this->BesoinsEnTalent_Model->get_besoinsentalent($id);
        $this->load->view('templates/template_re', $data);
    }

    public function delete($id) {
        try {
            $this->BesoinsEnTalent_Model->delete_besoinsentalent($id);
            $this->session->set_flashdata('success', 'BesoinsEnTalent supprimé avec succès.');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        redirect('besoinsentalent_Controller');
    }

}
?>

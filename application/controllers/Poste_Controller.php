<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poste_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Poste_Model');
    }

    public function index() {
        $data['pagetitle'] = 'Section Poste';
        $data['contents']= 'poste/list';
        $data['poste'] = $this->Poste_Model->get_all_poste();
        $this->load->view('templates/template_re', $data);
    }

    public function create() {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Poste_Model->insert_poste($data);
                $this->session->set_flashdata('success', 'Poste ajouté avec succès.');
                redirect('poste_Controller');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['pagetitle'] = 'Section Poste';
        $data['contents']= 'poste/create';
        $data['profiles'] = $this->ProfilRequis_Model->get_all_profilrequis();  
        $data['branches'] = $this->Branche_Model->get_all_branche();
        $this->load->view('templates/template_re', $data);
    }

    public function edit($id) {
        $data['pagetitle'] = 'Section Poste';
        $data['contents']= 'poste/edit';
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Poste_Model->update_poste($id, $data);
                $this->session->set_flashdata('success', 'Poste mis à jour avec succès.');
                redirect('poste_Controller');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['branches'] = $this->Branche_Model->get_all_branche();
        $data['item'] = $this->Poste_Model->get_poste($id);
        $this->load->view('templates/template_re', $data);
    }

    public function delete($id) {
        try {
            $this->Poste_Model->delete_poste($id);
            $this->session->set_flashdata('success', 'Poste supprimé avec succès.');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        redirect('poste_Controller');
    }

}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branche_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Branche_Model');
    }

    public function index() {
        $data['branche'] = $this->Branche_Model->get_all_branche();
        $data['pagetitle'] = 'Section Branche';
        $data['contents']= 'branche/list';
        $this->load->view('templates/template_re', $data);
    }

    public function create() {
        $data['pagetitle'] = 'Section Branche';
        $data['contents']= 'branche/create';
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Branche_Model->insert_branche($data);
                $this->session->set_flashdata('success', 'Branche ajouté avec succès.');
                redirect('branche_Controller');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $this->load->view('templates/template_re', $data);
    }

    public function edit($id) {
        $data['pagetitle'] = 'Add Branche';
        $data['contents']= 'branche/edit';
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Branche_Model->update_branche($id, $data);
                $this->session->set_flashdata('success', 'Branche mis à jour avec succès.');
                redirect('branche_Controller');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['item'] = $this->Branche_Model->get_branche($id);
        $this->load->view('templates/template_re', $data);
    }

    public function delete($id) {
        try {
            $this->Branche_Model->delete_branche($id);
            $this->session->set_flashdata('success', 'Branche supprimé avec succès.');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        redirect('branche_Controller');
    }

}
?>

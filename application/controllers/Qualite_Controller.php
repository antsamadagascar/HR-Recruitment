<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qualite_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Qualite_Model');
    }

    public function index() {
        $data['qualite'] = $this->Qualite_Model->get_all_qualite();
        $this->load->view('admin/crud/qualite/list', $data);
    }

    public function create() {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Qualite_Model->insert_qualite($data);
                $this->session->set_flashdata('success', 'Qualite ajouté avec succès.');
                redirect('Qualite_Controller/create');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $this->load->view('admin/crud/qualite/create');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Qualite_Model->update_qualite($id, $data);
                $this->session->set_flashdata('success', 'Qualite mis à jour avec succès.');
                redirect('Qualite_Controller/list');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['item'] = $this->Qualite_Model->get_qualite($id);
        $this->load->view('admin/crud/qualite/edit', $data);
    }

    public function delete($id) {
        try {
            $this->Qualite_Model->delete_qualite($id);
            $this->session->set_flashdata('success', 'Qualite supprimé avec succès.');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        redirect('Qualite_Controller/list');
    }

}
?>

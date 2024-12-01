<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loisir_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Loisir_Model');
    }

    public function index() {
        $data['loisir'] = $this->Loisir_Model->get_all_loisir();
        $this->load->view('admin/crud/loisir/list', $data);
    }

    public function create() {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Loisir_Model->insert_loisir($data);
                $this->session->set_flashdata('success', 'Loisir ajouté avec succès.');
                redirect('Loisir_Controller/create');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $this->load->view('admin/crud/loisir/create');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Loisir_Model->update_loisir($id, $data);
                $this->session->set_flashdata('success', 'Loisir mis à jour avec succès.');
                redirect('Loisir_Controller/list');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['item'] = $this->Loisir_Model->get_loisir($id);
        $this->load->view('admin/crud/loisir/edit', $data);
    }

    public function delete($id) {
        try {
            $this->Loisir_Model->delete_loisir($id);
            $this->session->set_flashdata('success', 'Loisir supprimé avec succès.');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        redirect('Loisir_Controller/list');
    }

}
?>

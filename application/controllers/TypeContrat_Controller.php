<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TypeContrat_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('TypeContrat_Model');
    }

    public function index() {
        $data['typecontrat'] = $this->TypeContrat_Model->get_all_typecontrat();
        $this->load->view('admin/crud/typecontrat/list', $data);
    }

    public function create() {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->TypeContrat_Model->insert_typecontrat($data);
                $this->session->set_flashdata('success', 'TypeContrat ajouté avec succès.');
                redirect('TypeContrat_Controller/create');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $this->load->view('admin/crud/typecontrat/create');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->TypeContrat_Model->update_typecontrat($id, $data);
                $this->session->set_flashdata('success', 'TypeContrat mis à jour avec succès.');
                redirect('TypeContrat_Controller/list');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['item'] = $this->TypeContrat_Model->get_typecontrat($id);
        $this->load->view('admin/crud/typecontrat/edit', $data);
    }

    public function delete($id) {
        try {
            $this->TypeContrat_Model->delete_typecontrat($id);
            $this->session->set_flashdata('success', 'TypeContrat supprimé avec succès.');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        redirect('TypeContrat_Controller/list');
    }

}
?>

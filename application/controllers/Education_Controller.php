<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Education_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Education_Model');
    }

    public function index() {
        $data['education'] = $this->Education_Model->get_all_education();
        $this->load->view('admin/crud/education/list', $data);
    }

    public function create() {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Education_Model->insert_education($data);
                $this->session->set_flashdata('success', 'Education ajouté avec succès.');
                redirect('Education_Controller/create');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $this->load->view('admin/crud/education/create');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Education_Model->update_education($id, $data);
                $this->session->set_flashdata('success', 'Education mis à jour avec succès.');
                redirect('Education_Controller/list');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['item'] = $this->Education_Model->get_education($id);
        $this->load->view('admin/crud/education/edit', $data);
    }

    public function delete($id) {
        try {
            $this->Education_Model->delete_education($id);
            $this->session->set_flashdata('success', 'Education supprimé avec succès.');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        redirect('Education_Controller/list');
    }

}
?>

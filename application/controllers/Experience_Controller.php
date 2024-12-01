<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Experience_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Experience_Model');
    }

    public function index() {
        $data['experience'] = $this->Experience_Model->get_all_experience();
        $this->load->view('admin/crud/experience/list', $data);
    }

    public function create() {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Experience_Model->insert_experience($data);
                $this->session->set_flashdata('success', 'Experience ajouté avec succès.');
                redirect('Experience_Controller/create');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $this->load->view('admin/crud/experience/create');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->Experience_Model->update_experience($id, $data);
                $this->session->set_flashdata('success', 'Experience mis à jour avec succès.');
                redirect('Experience_Controller/list');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['item'] = $this->Experience_Model->get_experience($id);
        $this->load->view('admin/crud/experience/edit', $data);
    }

    public function delete($id) {
        try {
            $this->Experience_Model->delete_experience($id);
            $this->session->set_flashdata('success', 'Experience supprimé avec succès.');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        redirect('Experience_Controller/list');
    }

}
?>

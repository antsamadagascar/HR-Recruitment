<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annonces_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$utilisateur = $this->session->userdata('utilisateur');
		if (!isset($utilisateur)) {
			$data['title'] = 'Alert';
			$data['pagetitle'] = 'Alert';	
			$data['action'] = 'Connection_Controller';
			$this->load->view("templates/head", $data); 
			$this->load->view('alert_view', $data);
			$this->load->view("templates/footer"); 
		}
	}
    public function index()
{
    $this->load->library('session'); // Charger la bibliothèque de session
    $data['title'] = 'User page';
    $data['pagetitle'] = 'User page';
    $brancheId = $this->input->post('id'); 
    $data['contents'] = 'annonces/annonces_user';

    try {
        if ($brancheId) {
            $data['annonces'] = $this->Annonce_Model->get_annonce($brancheId);
			$this->load->view('templates/template_user', $data);
		} else {
            $data['annonces'] = [];
        }
    } catch (Exception $e) {
        // Stocker le message d'erreur dans la session flashdata
        $this->session->set_flashdata('error_message', $e->getMessage());
        $data['annonces'] = [];
		$this->load->view('templates/template_user', $data);
    }
}

}
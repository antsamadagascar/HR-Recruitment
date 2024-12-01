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
		$data['title'] = 'User page';
		$data['pagetitle'] = 'User page';
		$data['contents'] = 'table/annonces_tables';
		$this->load->view('templates/template_user', $data);
	}
}
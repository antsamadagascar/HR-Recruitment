<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anno_Controller extends CI_Controller {

    public function index()
	{
		$data['title'] = 'Login';
		$data['action'] = 'Connection_Controller/login';
		$this->load->view("templates/head", $data);
		$this->load->view('connection/login_view', $data);
		$this->load->view("templates/footer");
	}
}
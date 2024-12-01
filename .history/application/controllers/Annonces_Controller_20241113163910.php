<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annonces_Controller extends CI_Controller {

    public function index()
	{
		$this->load->view("table/annonces_tables');
	}
}
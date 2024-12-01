<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$utilisateur = $this->session->userdata('utilisateur');
		if (!isset($utilisateur)) {
			$data['title'] = 'Alert';
			$data['pagetitle'] = 'Alert';
			$data['alert'] = 'Vous n\'êtes pas censé entrer directement dans cette page...';
			$data['action'] = 'Connection_Controller';
			$this->load->view("templates/head", $data);
			$this->load->view('alert_view', $data);
			$this->load->view("templates/footer"); 
		}
	}

    public function index() {
        $data['title'] = 'Alert';
		$data['contents'] = 'alert_view';
		$data['alert'] = 'Vous n\'êtes pas censé entrer directement dans cette page...';
		$data['action'] = 'Connection_Controller';
		$this->load->view('templates/template', $data); 
    }

    public function type_centre() {
        // definition des donnees variables du template
		$data['title'] = 'Table de Types de Centre';
		$data['pagetitle'] = 'Table de Types de Centre';
		
        $data['ls_type_centre'] = $this->DBData->getAll('type_centre');

        // on charge la view qui contient le corps de la page
		$data['contents'] = 'table/type_centre_table';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function centre() {
        // definition des donnees variables du template
		$data['title'] = 'Table de Centres';
		$data['pagetitle'] = 'Table de Centres';
		
        $data['ls_centre'] = $this->DBData->getAll('v_centre');

        // on charge la view qui contient le corps de la page
		$data['contents'] = 'table/centre_table';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function unite_oeuvre() {
        // definition des donnees variables du template
		$data['title'] = 'Table d\'Unités d\'Oeuvre';
		$data['pagetitle'] = 'Table d\'Unités d\'Oeuvre';
		
        $data['ls_unite_oeuvre'] = $this->DBData->getAll('unite_oeuvre');

        // on charge la view qui contient le corps de la page
		$data['contents'] = 'table/unite_oeuvre_table';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function categorie_charge() {
        // definition des donnees variables du template
		$data['title'] = 'Table de Catégories de Charge';
		$data['pagetitle'] = 'Table de Catégories de Charge';
		
        $data['ls_categorie_charge'] = $this->DBData->getAll('categorie_charge');

        // on charge la view qui contient le corps de la page
		$data['contents'] = 'table/categorie_charge_table';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function type_charge() {
        // definition des donnees variables du template
		$data['title'] = 'Table de Types de Charge';
		$data['pagetitle'] = 'Table de Types de Charge';
		
        $data['ls_type_charge'] = $this->DBData->getAll('type_charge');

        // on charge la view qui contient le corps de la page
		$data['contents'] = 'table/type_charge_table';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function nature_charge() {
        // definition des donnees variables du template
		$data['title'] = 'Table de Natures de Charge';
		$data['pagetitle'] = 'Table de Natures de Charge';
		
        $data['ls_nature_charge'] = $this->DBData->getAll('nature_charge');

        // on charge la view qui contient le corps de la page
		$data['contents'] = 'table/nature_charge_table';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function rubrique_charge() {
        // definition des donnees variables du template
		$data['title'] = 'Table de Rubriques de Charge';
		$data['pagetitle'] = 'Table de Rubriques de Charge';
		
        $data['ls_rubrique_charge'] = $this->DBData->getAll('v_rubrique_charge');

        // on charge la view qui contient le corps de la page
		$data['contents'] = 'table/rubrique_charge_table';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function charge() {
        // definition des donnees variables du template
		$data['title'] = 'Table de Charges';
		$data['pagetitle'] = 'Table de Charges';
		
        $data['ls_charge'] = $this->DBData->getAll('v_charge');

        // on charge la view qui contient le corps de la page
		$data['contents'] = 'table/charge_table';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function vente() {
        // definition des donnees variables du template
		$data['title'] = 'Table de Ventes';
		$data['pagetitle'] = 'Table de Ventes';
		
        $data['ls_vente'] = $this->DBData->getAll('v_vente');

        // on charge la view qui contient le corps de la page
		$data['contents'] = 'table/vente_table';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function production() {
        // definition des donnees variables du template
		$data['title'] = 'Table de Productions';
		$data['pagetitle'] = 'Table de Productions';
		
        $data['ls_production'] = $this->DBData->getAll('v_production');

        // on charge la view qui contient le corps de la page
		$data['contents'] = 'table/production_table';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

	public function metier() {
        // definition des donnees variables du template
		$data['title'] = 'Table de Métiers';
		$data['pagetitle'] = 'Table de Métiers';
		
        $data['ls_metier'] = $this->DBData->getAll('v_metier');

        // on charge la view qui contient le corps de la page
		$data['contents'] = 'table/metier_table';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

	public function utilisateur() {
        // definition des donnees variables du template
		$data['title'] = 'Table de Utilisateurs';
		$data['pagetitle'] = 'Table de Utilisateurs';
		
        $data['ls_utilisateur'] = $this->DBData->getAll('v_utilisateur');

        // on charge la view qui contient le corps de la page
		$data['contents'] = 'table/utilisateur_table';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

}
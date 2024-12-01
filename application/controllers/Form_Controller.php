<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_Controller extends CI_Controller {

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
        $data['pagetitle'] = 'Alert';
		$data['contents'] = 'alert_view';
		$data['alert'] = 'Vous n\'êtes pas censé entrer directement dans cette page...';
		$data['action'] = 'Connection_Controller';
		$this->load->view('templates/template', $data); 
    }

    public function type_centre() {
        // definition des donnees variables du template
		$data['title'] = 'Formulaire de Type de Centre';
		$data['pagetitle'] = 'Formulaire de Type de Centre';
		$data['action'] = 'Action_Controller/type_centre';

        $data['type_centre'] = new StdClass();
        $data['type_centre']->id_type_centre = -1;
        $data['type_centre']->nom = '';
        if ($this->input->get('id_type_centre') !== null) {
            $data['type_centre'] = $this->DBData->getById($this->input->get('id_type_centre'), 'type_centre');
        }

		// on charge la view qui contient le corps de la page
		$data['contents'] = 'form/type_centre_form';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function centre() {
        // definition des donnees variables du template
		$data['title'] = 'Formulaire Centre';
		$data['pagetitle'] = 'Formulaire Centre';
		$data['action'] = 'Action_Controller/centre';

        $data['centre'] = new StdClass();
        $data['centre']->id_centre = -1;
        $data['centre']->id_type_centre = -1;
        $data['centre']->nom = '';
        if ($this->input->get('id_centre') !== null) {
            $data['centre'] = $this->DBData->getById($this->input->get('id_centre'), 'centre');
        }
        $data['ls_type_centre'] = $this->DBData->getAll('type_centre');

		// on charge la view qui contient le corps de la page
		$data['contents'] = 'form/centre_form';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function unite_oeuvre() {
        // definition des donnees variables du template
		$data['title'] = 'Formulaire Unité d\'Oeuvre';
		$data['pagetitle'] = 'Formulaire Unité d\'Oeuvre';
		$data['action'] = 'Action_Controller/unite_oeuvre';

        $data['unite_oeuvre'] = new StdClass();
        $data['unite_oeuvre']->id_unite_oeuvre = -1;
        $data['unite_oeuvre']->nom = '';
        if ($this->input->get('id_unite_oeuvre') !== null) {
            $data['unite_oeuvre'] = $this->DBData->getById($this->input->get('id_unite_oeuvre'), 'unite_oeuvre');
        }

		// on charge la view qui contient le corps de la page
		$data['contents'] = 'form/unite_oeuvre_form';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function categorie_charge() {
        // definition des donnees variables du template
		$data['title'] = 'Formulaire Catégorie de Charge';
		$data['pagetitle'] = 'Formulaire Catégorie de Charge';
		$data['action'] = 'Action_Controller/categorie_charge';

        $data['categorie_charge'] = new StdClass();
        $data['categorie_charge']->id_categorie_charge = -1;
        $data['categorie_charge']->nom = '';
        if ($this->input->get('id_categorie_charge') !== null) {
            $data['categorie_charge'] = $this->DBData->getById($this->input->get('id_categorie_charge'), 'categorie_charge');
        }

		// on charge la view qui contient le corps de la page
		$data['contents'] = 'form/categorie_charge_form';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function type_charge() {
        // definition des donnees variables du template
		$data['title'] = 'Formulaire Type de Charge';
		$data['pagetitle'] = 'Formulaire Type de Charge';
		$data['action'] = 'Action_Controller/type_charge';

        $data['type_charge'] = new StdClass();
        $data['type_charge']->id_type_charge = -1;
        $data['type_charge']->nom = '';
        if ($this->input->get('id_type_charge') !== null) {
            $data['type_charge'] = $this->DBData->getById($this->input->get('id_type_charge'), 'type_charge');
        }

		// on charge la view qui contient le corps de la page
		$data['contents'] = 'form/type_charge_form';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function nature_charge() {
        // definition des donnees variables du template
		$data['title'] = 'Formulaire Nature de Charge';
		$data['pagetitle'] = 'Formulaire Nature de Charge';
		$data['action'] = 'Action_Controller/nature_charge';

        $data['nature_charge'] = new StdClass();
        $data['nature_charge']->id_nature_charge = -1;
        $data['nature_charge']->nom = '';
        if ($this->input->get('id_nature_charge') !== null) {
            $data['nature_charge'] = $this->DBData->getById($this->input->get('id_nature_charge'), 'nature_charge');
        }

		// on charge la view qui contient le corps de la page
		$data['contents'] = 'form/nature_charge_form';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function rubrique_charge() {
        // definition des donnees variables du template
		$data['title'] = 'Formulaire Rubrique de Charge';
		$data['pagetitle'] = 'Formulaire Rubrique de Charge';
		$data['action'] = 'Action_Controller/rubrique_charge';

        $data['rubrique_charge'] = new StdClass();
        $data['rubrique_charge']->id_rubrique_charge = -1;
        $data['rubrique_charge']->id_categorie_charge = -1;
        $data['rubrique_charge']->id_type_charge = -1;
        $data['rubrique_charge']->id_nature_charge = -1;
        $data['rubrique_charge']->id_unite_oeuvre = -1;
        $data['rubrique_charge']->nom = '';
        if ($this->input->get('id_rubrique_charge') !== null) {
            $data['rubrique_charge'] = $this->DBData->getById($this->input->get('id_rubrique_charge'), 'rubrique_charge');
        }
        $data['ls_categorie_charge'] = $this->DBData->getAll('categorie_charge');
        $data['ls_type_charge'] = $this->DBData->getAll('type_charge');
        $data['ls_nature_charge'] = $this->DBData->getAll('nature_charge');
        $data['ls_unite_oeuvre'] = $this->DBData->getAll('unite_oeuvre');

		// on charge la view qui contient le corps de la page
		$data['contents'] = 'form/rubrique_charge_form';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function charge() {
        // definition des donnees variables du template
		$data['title'] = 'Formulaire Charge';
		$data['pagetitle'] = 'Formulaire Charge';
		$data['action'] = 'Action_Controller/charge';

        $data['charge'] = new StdClass();
        $data['charge']->id_charge = -1;
        $data['charge']->id_rubrique_charge = -1;
        $data['charge']->id_centre = -1;
        $data['charge']->valeur = 0;
        if ($this->input->get('id_charge') !== null) {
            $data['charge'] = $this->DBData->getById($this->input->get('id_charge'), 'charge');
        }
        $data['ls_rubrique_charge'] = $this->DBData->getAll('rubrique_charge');
        $data['ls_centre'] = $this->DBData->getAll('centre');

		// on charge la view qui contient le corps de la page
		$data['contents'] = 'form/charge_form';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function vente() {
        // definition des donnees variables du template
		$data['title'] = 'Formulaire Vente';
		$data['pagetitle'] = 'Formulaire Vente';
		$data['action'] = 'Action_Controller/vente';

        $data['vente'] = new StdClass();
        $data['vente']->id_vente = -1;
        $data['vente']->id_centre = -1;
        $data['vente']->id_unite_oeuvre = -1;
        $data['vente']->quantite = 0;
        $data['vente']->prix_unitaire = 0;
        $data['vente']->libelle = '';
        if ($this->input->get('id_vente') !== null) {
            $data['vente'] = $this->DBData->getById($this->input->get('id_vente'), 'vente');
        }
        $data['ls_centre'] = $this->DBData->getAll('centre');
        $data['ls_unite_oeuvre'] = $this->DBData->getAll('unite_oeuvre');

		// on charge la view qui contient le corps de la page
		$data['contents'] = 'form/vente_form';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function production() {
        // definition des donnees variables du template
		$data['title'] = 'Formulaire Production';
		$data['pagetitle'] = 'Formulaire Production';
		$data['action'] = 'Action_Controller/production';

        $data['production'] = new StdClass();
        $data['production']->id_production = -1;
        $data['production']->id_centre = -1;
        $data['production']->id_unite_oeuvre = -1;
        $data['production']->quantite = 0;
        if ($this->input->get('id_production') !== null) {
            $data['production'] = $this->DBData->getById($this->input->get('id_production'), 'production');
        }
        $data['ls_centre'] = $this->DBData->getAll('centre');
        $data['ls_unite_oeuvre'] = $this->DBData->getAll('unite_oeuvre');

		// on charge la view qui contient le corps de la page
		$data['contents'] = 'form/production_form';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function metier() {
        // definition des donnees variables du template
		$data['title'] = 'Formulaire Métier';
		$data['pagetitle'] = 'Formulaire Métier';
		$data['action'] = 'Action_Controller/metier';

        $data['metier'] = new StdClass();
        $data['metier']->id_metier = -1;
        $data['metier']->id_centre = -1;
        $data['metier']->nom = '';
        $data['metier']->is_vampire = false;
        if ($this->input->get('id_metier') !== null) {
            $data['metier'] = $this->DBData->getById($this->input->get('id_metier'), 'metier');
        }
        $data['ls_centre'] = $this->DBData->getAll('centre');

		// on charge la view qui contient le corps de la page
		$data['contents'] = 'form/metier_form';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

    public function utilisateur() {
        // definition des donnees variables du template
		$data['title'] = 'Formulaire Utilisateur';
		$data['pagetitle'] = 'Formulaire Utilisateur';
		$data['action'] = 'Action_Controller/utilisateur';

        $data['utilisateur'] = new StdClass();
        $data['utilisateur']->id_utilisateur = -1;
        $data['utilisateur']->id_metier = -1;
        $data['utilisateur']->nom = '';
        $data['utilisateur']->email = '';
        $data['utilisateur']->username = '';
        $data['utilisateur']->mot_de_passe = '';
        if ($this->input->get('id_utilisateur') !== null) {
            $data['utilisateur'] = $this->DBData->getById($this->input->get('id_utilisateur'), 'utilisateur');
        }
        $data['ls_metier'] = $this->DBData->getAll('metier');

		// on charge la view qui contient le corps de la page
		$data['contents'] = 'form/utilisateur_form';

		// on charge la page dans le template
		$this->load->view('templates/template', $data);
    }

}
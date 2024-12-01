<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChatQuestion_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function index() {
        $data['title'] = 'ChatBot - Processus de recrutement';
        $data['pagetitle'] = 'Recrutement & Processus';

        // Données de l'entreprise
        $data['entreprise'] = $this->get_entreprise_infos();

        // Données du processus de recrutement
        $data['processus'] = $this->get_processus_recrutement();

        // Données des FAQ
        $data['faq'] = $this->get_faq_recrutement();

        // Charger la vue avec les données
        $this->load->view('chatBot/chatbot_view', $data);
    }

    // Récupérer les informations sur l'entreprise
    private function get_entreprise_infos() {
        return [
            'nom_entreprise' => 'Tech Innovators',
            'mission' => 'Nous aspirons à innover dans le domaine de la technologie pour résoudre les défis de demain.',
            'valeurs' => 'Innovation, Collaboration, Responsabilité, Transparence',
            'culture_entreprise' => 'Notre culture repose sur l\'inclusivité, la diversité des idées et un environnement de travail flexible.'
        ];
    }

    // Récupérer le processus de recrutement
    private function get_processus_recrutement() {
        return [
            ['etape' => 'Candidature', 'description' => 'Le candidat soumet sa candidature via notre site web ou via un jobboard.'],
            ['etape' => 'Entretien téléphonique', 'description' => 'Un entretien téléphonique est effectué pour évaluer la motivation et les compétences du candidat.'],
            ['etape' => 'Entretien en personne', 'description' => 'Un entretien face à face avec le recruteur pour discuter des compétences techniques et culturelles.'],
            ['etape' => 'Tests techniques', 'description' => 'Des tests techniques peuvent être demandés selon le poste pour évaluer les compétences pratiques du candidat.'],
            ['etape' => 'Offre', 'description' => 'Si le candidat est sélectionné, une offre lui est faite pour rejoindre l\'équipe.'],
            ['etape' => 'Intégration', 'description' => 'Après l\'acceptation de l\'offre, le processus d\'intégration dans l\'entreprise commence.']
        ];
    }

    // Récupérer les FAQ de recrutement
    private function get_faq_recrutement() {
        return [
            ['question' => 'Quel est le processus de recrutement chez Tech Innovators ?', 'reponse' => 'Le processus de recrutement chez Tech Innovators comprend la soumission de la candidature, un entretien téléphonique, un entretien en personne, des tests techniques et une offre.'],
            ['question' => 'Quel est le délai pour obtenir une réponse après un entretien ?', 'reponse' => 'Le délai moyen pour une réponse est de 2 à 3 semaines après l\'entretien. Cependant, cela peut varier en fonction des étapes du processus.'],
            ['question' => 'Puis-je postuler à plusieurs postes en même temps ?', 'reponse' => 'Oui, vous pouvez postuler à plusieurs postes, mais nous vous conseillons de vous concentrer sur le poste qui correspond le mieux à vos compétences et à vos aspirations professionnelles.'],
            ['question' => 'Que faire si je ne suis pas sélectionné ?', 'reponse' => 'Si vous n\'êtes pas sélectionné, nous vous encourageons à postuler à nouveau à une future offre qui correspond à votre profil.']
        ];
    }
}

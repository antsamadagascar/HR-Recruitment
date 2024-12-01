
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CandidatTest extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Charger le modèle Candidat_Model pour accéder aux données du candidat
        $this->load->model('Candidat_Model');
    }

    public function index() {
        try {
            // Récupérer les informations de l'utilisateur depuis la session
            $utilisateur = $this->session->userdata('utilisateur');
            
            if (empty($utilisateur) || empty($utilisateur->id)) {
                throw new Exception('Utilisateur non connecté ou ID du candidat manquant.');
            }

            // Récupérer les détails du candidat depuis le modèle
            $candidatId = $utilisateur->id;
            $candidatDetails = $this->Candidat_Model->get_candidate_details($candidatId);
    
            if (!$candidatDetails) {
                throw new Exception('Candidat non trouvé.');
            }

            // Créer un prompt pour l'IA basé sur les informations du candidat
            $prompt = $this->generate_ai_prompt($candidatDetails);

            // Sauvegarder le prompt et initialiser l'index de la question dans la session
            $this->session->set_userdata('prompt', $prompt);
            $this->session->set_userdata('questionIndex', 0);  // Réinitialiser l'index des questions
            $this->session->set_userdata('score', 0);  // Réinitialiser le score
    
            // Passer les données du candidat et le prompt à la vue
            $data['candidat'] = $candidatDetails;
            $data['prompt'] = $prompt;  // Passer le prompt pour l'IA
    
            $this->load->view('chatBot/chatbot_view', $data); // Vue du chatbot
    
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
    

    private function generate_ai_prompt($candidat) {
        // Créer une description complète et détaillée du candidat en une seule variable
        
        $prompt = "Le candidat " . $candidat->candidat_nom . " " . $candidat->candidat_prenom . " (ID: " . $candidat->candidat_id . ") ";
        $prompt .= "a les informations suivantes :\n";
        
        // Informations personnelles
        $prompt .= "Email : " . $candidat->candidat_email . "\n";
        $prompt .= "Téléphone : " . $candidat->candidat_telephone . "\n";
        $prompt .= "Adresse : " . $candidat->candidat_adresse . "\n";
        $prompt .= "Date de naissance : " . date("d-m-Y", strtotime($candidat->candidat_datenaissance)) . "\n";
        $prompt .= "Nationalité : " . $candidat->candidat_nationalite . "\n";
        
        // Compétences
        if (!empty($candidat->competence_description)) {
            $prompt .= "Compétences : " . $candidat->competence_description . " (Niveau : " . $candidat->competence_niveau . ")\n";
        }
        
        // Expérience professionnelle
        if (!empty($candidat->experience_entreprise) && !empty($candidat->experience_poste)) {
            $prompt .= "Expérience professionnelle : " . $candidat->experience_poste . " chez " . $candidat->experience_entreprise;
            if (!empty($candidat->experience_dateDebut) && !empty($candidat->experience_dateFin)) {
                $prompt .= " du " . date("d-m-Y", strtotime($candidat->experience_dateDebut)) . " au " . date("d-m-Y", strtotime($candidat->experience_dateFin)) . "\n";
            }
        }
        
        // Qualités
        if (!empty($candidat->qualite_nomQualite)) {
            $prompt .= "Qualités : " . $candidat->qualite_nomQualite . "\n";
        }
        
        // Poste et Profil requis
        if (!empty($candidat->poste_nomPoste)) {
            $prompt .= "Le poste pour lequel il/elle postule est " . $candidat->poste_nomPoste . ". ";
            $prompt .= "Description du poste : " . $candidat->poste_description . "\n";
        }
        
        // Profil requis
        if (!empty($candidat->profil_nomProfil)) {
            $prompt .= "Profil requis : " . $candidat->profil_nomProfil . ". ";
            $prompt .= "Expérience technique : " . $candidat->profil_experiencetechnique . ". ";
            $prompt .= "Expérience générale : " . $candidat->profil_experiencegenerale . "\n";
        }
        
        // Branche concernée
        if (!empty($candidat->branche_nomBranche)) {
            $prompt .= "Branche : " . $candidat->branche_nomBranche . "\n";
        }
    
        // Demander à l'IA de générer des questions pertinentes basées sur toutes ces informations
        $prompt .= "\nEn fonction des informations des capacite de ses informations du candidats .Faite un test a ce candidat en l'evaluer 
        avec 5 questions .Envoyer un questions d'abord et attender que il repond et ainsi de suite.A la fin de l'evaluation noter le candidat en fonction de ses reponses!";
    
        return $prompt;
    }
    
    
}
?>

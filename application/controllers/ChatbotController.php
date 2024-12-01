<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChatbotController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Candidat_Model');
        $this->load->library('session');
    }

    public function index() {
        $data['title'] = 'Test Entretien';
        $data['pagetitle'] = 'Test Entretien';
 
        $data['contents'] = 'chatBot/chatbot_view';
        try {
            $utilisateur = $this->session->userdata('utilisateur');
            
            if (empty($utilisateur) || empty($utilisateur->id)) {
                throw new Exception('Session utilisateur invalide.');
            }

            $candidatId = $utilisateur->id;
            $candidatDetails = $this->Candidat_Model->get_candidate_details($candidatId);
    
            if (!$candidatDetails) {
                throw new Exception('Informations du candidat non trouvées.');
            }

            // Générer le prompt pour l'IA
            $prompt = $this->generate_ai_prompt($candidatDetails);

            // Sauvegarder les données dans la session
            $this->session->set_userdata([
                'prompt' => $prompt,
                'question_index' => 0,
                'total_score' => 0,
                'start_time' => time()
            ]);
    
            $data['candidat'] = $candidatDetails;
            $data['prompt'] = $prompt;
    
            $this->load->view('templates/template_user', $data);
    
        } catch (Exception $e) {
            // Log l'erreur
            log_message('error', 'Erreur ChatbotController: ' . $e->getMessage());
            
            // Rediriger vers une page d'erreur
            $data['error_message'] = $e->getMessage();
            $this->load->view('error_page', $data);
        }
    }

    private function generate_ai_prompt($candidat) {
        $prompt = "Évaluation du candidat {$candidat->candidat_nom} {$candidat->candidat_prenom}\n\n";
        
        // Informations professionnelles
        $prompt .= "Profil professionnel:\n";
        if (!empty($candidat->experience_poste)) {
            $prompt .= "- Poste actuel/précédent: {$candidat->experience_poste}\n";
        }
        if (!empty($candidat->competence_description)) {
            $prompt .= "- Compétences principales: {$candidat->competence_description}\n";
        }
    
        // Expérience professionnelle
        if (!empty($candidat->experience_entreprise)) {
            $prompt .= "- Expérience chez: {$candidat->experience_entreprise}\n";
            if (!empty($candidat->experience_dateDebut) && !empty($candidat->experience_dateFin)) {
                $prompt .= "  Période: " . date("m/Y", strtotime($candidat->experience_dateDebut)) . 
                          " - " . date("m/Y", strtotime($candidat->experience_dateFin)) . "\n";
            }
        }
    
        // Poste visé et exigences
        $prompt .= "\nPoste postulé:\n";
        if (!empty($candidat->poste_nomPoste)) {
            $prompt .= "- Intitulé: {$candidat->poste_nomPoste}\n";
            $prompt .= "- Description: {$candidat->poste_description}\n";
        }
    
        // Instructions pour l'IA
        $prompt .= "\nInstructions pour l'évaluation:\n";
        $prompt .= "1. Posez des questions techniques et comportementales pertinentes pour le poste de {$candidat->poste_nomposte}. ";
        if (!empty($candidat->competence_description)) {
            $prompt .= "Tenez compte des compétences principales suivantes du candidat : {$candidat->competence_description}. ";
        }
    
        if (!empty($candidat->experience_poste)) {
            $prompt .= "Demandez-lui de détailler son rôle et ses responsabilités dans le poste actuel/précédent de {$candidat->experience_poste}. ";
        }
    
        if (!empty($candidat->experience_entreprise)) {
            $prompt .= "Explorez son expérience chez {$candidat->experience_entreprise}, en mettant l'accent sur les responsabilités et les résultats obtenus. ";
        }
    
        // Adaptation du niveau de difficulté des questions
        $prompt .= "2. Adaptez le niveau de difficulté des questions selon les compétences et l'expérience du candidat. ";
        if (!empty($candidat->experience_poste)) {
            $prompt .= "Pour un candidat ayant occupé un poste en {$candidat->experience_poste}, les questions devraient refléter ce niveau d'expertise. ";
        }
    
        // Évaluation de la pertinence, clarté et profondeur
        $prompt .= "3. Évaluez la pertinence, la clarté et la profondeur des réponses en fonction de l'expérience et des compétences du candidat. ";
    
        // Feedback constructif
        $prompt .= "4. Fournissez un feedback constructif après chaque réponse, en tenant compte des informations fournies par le candidat dans son expérience. ";
    
        // Attribution de la note
        $prompt .= "5. Attribuez une note sur 20 pour chaque réponse selon les critères suivants :\n";
        $prompt .= "   - Pertinence (8 points), Clarté (6 points), Détails (6 points).\n";
    
        // Questions spécifiques en fonction des compétences
        $prompt .= "6. Posez des questions ciblées sur les compétences spécifiques mentionnées dans le CV du candidat, telles que {$candidat->competence_description}. ";
    
        return $prompt;
    }
    

public function complete_test() {
    try {
        if (!$this->input->is_ajax_request()) {
            throw new Exception('Accès non autorisé');
        }

        $candidat_id = $this->session->userdata('utilisateur')->id;
        $total_score = $this->input->post('total_score');  
       // $completion_time = $this->input->post('completion_time');  
        
        $candidat = $this->Candidat_Model->get_candidate_details($candidat_id);
        
        $message = "Bonjour {$candidat->candidat_prenom},\n\n";
        $message .= "Nous vous confirmons que vous avez complété votre test d'évaluation.\n";
        $message .= "Score total obtenu: {$total_score}/100\n";
       // $message .= "Durée du test: " . round($completion_time / 60) . " minutes\n\n";
        $message .= "Nos équipes analyseront vos résultats et vous recontacteront prochainement.\n\n";
        $message .= "Cordialement,\nL'équipe de recrutement";
    
        
        $evaluation_data = [
            'idcandidat' => $candidat_id,  
            'dateevaluation' => date('Y-m-d'),  
            'notes' => $total_score,  
            'commentaire' => $this->input->post('commentaire'), 
            'isevalue' => true  
        ];

        $this->load->model('EvaluationCandidat_Model');
        $this->EvaluationCandidat_Model->insert_evaluationcandidat($evaluation_data);

       
        $notification_data = [
            'idcandidat' => $candidat_id,
            'message' => $message,  
            'datenotification' => date('Y-m-d H:i:s')  
         
        ];
        
        print_r($notification_data);
        $this->Notifications_Model->insert_notifications($notification_data);

        echo json_encode(['success' => true]);

    } catch (Exception $e) {
        log_message('error', 'Erreur complete_test: ' . $e->getMessage());
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

    
}
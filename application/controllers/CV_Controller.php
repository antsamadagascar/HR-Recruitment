<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CV_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CV_Model');

    }

    public function index() {
        $idAnnonce = $this->input->post('idAnnonce');
    
        if (empty($idAnnonce)) {
            echo "Erreur : l'ID de l'annonce est manquant.";
            return;
        }
    
        try {
            $data['profilRequis'] = $this->ProfilRequis_Model->get_all_profilrequis();
            if (!$data['profilRequis']) {
                echo "Erreur : Impossible de récupérer les profils requis.";
                return;
            }
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return;
        }
    
        $data['idAnnonce'] = $idAnnonce;
        $data['pagetitle'] = 'saisies Cv';
        $data['contents'] = 'cv/cv_saisie';
        $this->load->view('templates/template_user', $data);
    }
    

    public function create() {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->CV_Model->insert_cv($data);
                $this->session->set_flashdata('success', 'CV ajouté avec succès.');
                redirect('CV_Controller/create');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $this->load->view('admin/crud/cv/create');
    }

    public function edit($id) {
        if ($this->input->post()) {
            $data = $this->input->post();
            try {
                $this->CV_Model->update_cv($id, $data);
                $this->session->set_flashdata('success', 'CV mis à jour avec succès.');
                redirect('CV_Controller/list');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
            }
        }
        $data['item'] = $this->CV_Model->get_cv($id);
        $this->load->view('admin/crud/cv/edit', $data);
    }

    public function delete($id) {
        try {
            $this->CV_Model->delete_cv($id);
            $this->session->set_flashdata('success', 'CV supprimé avec succès.');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', $e->getMessage());
        }
        redirect('CV_Controller/list');
    }

    public function submit_cv() {
        $user = $this->session->userdata('utilisateur');
        $idAnnonce = $this->input->post('idAnnonce');
        
        $idCandidat = isset($user->id) ? $user->id : null;
    
        if (empty($idCandidat) || empty($idAnnonce)) {
            $this->session->set_flashdata('error', 'Erreur : Utilisateur ou annonce non trouvés.');
            redirect('CV_Controller');
            return;
        }
    
        $data = $this->input->post();

        $cvData = [
            'idcandidat' => $idCandidat,
            'isvalider' => false,
            'datevalidation' => null
        ];
    
        try {

            if ($this->Candidat_Model->checkCount($idCandidat, $idAnnonce)) {
                throw new Exception("Une candidature pour ce candidat et cette annonce existe déjà.");
            }
    
            $this->CV_Model->insert_cv($cvData);
            $idCV = $this->db->insert_id(); 
    
            if (isset($data['competence_description']) && is_array($data['competence_description'])) {
                foreach ($data['competence_description'] as $key => $competence) {
                    $competenceData = [
                        'idcandidat' => $idCandidat,
                        'description' => $competence,
                        'niveau' => $data['competence_niveau'][$key]
                    ];
                    $this->db->insert('competence', $competenceData);
                }
            }
    
            if (isset($data['loisir_description']) && is_array($data['loisir_description'])) {
                foreach ($data['loisir_description'] as $loisir) {
                    $loisirData = [
                        'idcandidat' => $idCandidat,
                        'description' => $loisir
                    ];
                    $this->db->insert('loisir', $loisirData);
                }
            }
    
            if (isset($data['education_institution']) && is_array($data['education_institution'])) {
                foreach ($data['education_institution'] as $key => $institution) {
                    $educationData = [
                        'idcandidat' => $idCandidat,
                        'institution' => $institution,
                        'diplome' => $data['education_diplome'][$key],
                        'anneeObtention' => $data['education_annee'][$key]
                    ];
                    $this->db->insert('education', $educationData);
                }
            }
    
            if (isset($data['qualite_nom'], $data['idprofil']) && is_array($data['qualite_nom']) && is_array($data['idprofil'])) {
                foreach ($data['qualite_nom'] as $key => $qualite) {
                    $qualiteData = [
                        'idprofil' => $data['idprofil'][$key],
                        'idcandidat' =>$idCandidat,
                        'nomqualite' => $qualite,
                        'experiencetechnique' => $data['experience_technique'][$key],
                        'experiencegenerale' => $data['experience_generale'][$key]
                    ];
                    $this->db->insert('qualite', $qualiteData);
                }
            }
    
            $candidatureData = [
                'idcandidat' => $idCandidat,
                'idannonce' => $idAnnonce,
                'idcv' => $idCV,
                'datecandidature' => date('Y-m-d'),
                'statutcandidature' => 'en_attente'
            ];
            $this->Candidature_Model->insert_candidature($candidatureData);
    
            $this->session->unset_userdata('idAnnonce');
            $this->session->set_flashdata('success', 'CV soumis et candidature enregistrée avec succès.');
            
            $this->load->view('cv/cv_message');
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Erreur : ' . $e->getMessage());
            $this->load->view('cv/cv_message');
        }
    }
    
    public function validerCv() {
        // Récupérer les données depuis la requête POST
        $postData = json_decode($this->input->raw_input_stream, true);
        $idCandidat = $postData['candidatId'] ?? null;
        $candidat = $this->session->userdata('utilisateur');

        if (!$idCandidat) {
            echo json_encode(['success' => false, 'message' => "L'ID du candidat est manquant."]);
            return;
        }
    
        // Valider le CV
        $result = $this->CV_Model->updateValidationStatus($idCandidat);
    
        if ($result) {
            // Créer les données pour la notification
            $notificationDataCandidat = [
                'idcandidat' => $idCandidat,
                'message' => "Bonjour Votre CV a été validé avec succees par le RH . Nous vous informons de la date du test d'entretien! Merci",
                'datenotification' => date('Y-m-d H:i:s'),
            ];

               // Créer les données pour la notification
               $notificationDataRC = [
                'idcandidat' => 4, //RC
                'message' => "Le Responsable d'Equipe(RE) a un demande d'envoye message de notification au candidat qui on été valider avec success  leur CV pour MR/MRS: ".  $candidat->nom . $candidat->prenom .  " Le date de Test Sera le 18/11/2024 !.",
                'datenotification' => date('Y-m-d H:i:s'),
            ];
            
            // Insérer la notification dans la table
            $this->Notifications_Model->insert_notifications($notificationDataCandidat);
            $this->Notifications_Model->insert_notifications($notificationDataRC);
    
            echo json_encode(['success' => true, 'message' => "CV validé avec succès."]);
        } else {
            echo json_encode(['success' => false, 'message' => "Une erreur s'est produite lors de la validation."]);
        }
    }
    
    
    public function refuserCv() {
        // Récupérer les données depuis la requête POST
        $postData = json_decode($this->input->raw_input_stream, true);
        $idCandidat = $postData['candidatId'] ?? null;
        $candidat = $this->session->userdata('utilisateur');
    
        if (!$idCandidat) {
            echo json_encode(['success' => false, 'message' => "L'ID du candidat est manquant."]);
            return;
        }
    
        // Mettre à jour le statut du CV comme refusé
        $result = $this->CV_Model->updateStatusRejeter($idCandidat);
    
        if ($result) {
            // Créer les données pour la notification
            $notificationDataCandidat = [
                'idcandidat' => $idCandidat,
                'message' => "Bonjour ".  $candidat->nom . $candidat->prenom .  "Votre CV a été refuser par le RH en raison de selection !.",
                'datenotification' => date('Y-m-d H:i:s'),
            ];
            
            // Insérer la notification dans la table
            $this->Notifications_Model->insert_notifications($notificationDataCandidat);

    
            echo json_encode(['success' => true, 'message' => "CV refusé avec succès."]);
        } else {
            echo json_encode(['success' => false, 'message' => "Une erreur s'est produite lors du refus."]);
        }
    }
    
    
}    
?>

<?php
class FicheDePaie_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('FicheDePaie_Model');
    }

    public function genererFicheDePaie() {
        $idEmploye = $this->input->post('employeId');
        $mois = $this->input->post('mois');
        $annee = $this->input->post('annee');
        
        if ($idEmploye && $mois && $annee) {
            $ficheId = $this->FicheDePaie_Model->genererFicheDePaie($idEmploye, $mois, $annee);

            if ($ficheId) {
                redirect("FicheDePaie_Controller/afficherFicheDePaie/$ficheId");
            } else {
                // Si l'employé ou les données sont incorrectes
                $this->session->set_flashdata('error', 'Erreur lors de la génération de la fiche de paie.');
                redirect('accueil');
            }
        } else {
            $this->session->set_flashdata('error', 'Paramètres manquants.');
            redirect('ficheDePaie_controller');
        }
    }

    public function afficherFicheDePaie($idFiche) {
        $fiche = $this->FicheDePaie_Model->getFicheDePaie($idFiche);
        
        if ($fiche) {
            // Calcul de l'ancienneté
            $dateEmbauche = new DateTime($fiche->dateEmbauche);
            $dateActuelle = new DateTime();
            $anciennete = $dateEmbauche->diff($dateActuelle);
    
            // Calcul du taux journalier et du taux horaire
            $tauxJournalier = $fiche->salaireDeBase / 30;
            $tauxHoraire = $fiche->salaireDeBase / 160;
    
            $data = [
                'fiche' => $fiche,
                'anciennete' => $anciennete->y . ' an(s) et ' . $anciennete->m . ' mois',
                'tauxJournalier' => number_format($tauxJournalier, 2, ',', ' '),
                'tauxHoraire' => number_format($tauxHoraire, 2, ',', ' ')
            ];
            $data['title'] = 'Fiche de Paie';
            $data['pagetitle'] = 'Fiche de Paie';
            $data['contents'] = 'ficheDePaie/fiche_de_paie';
    
            $this->load->view('templates/template_rh', $data);
        } else {
            $this->session->set_flashdata('error', 'Fiche de paie introuvable.');
            redirect('ficheDePaie_controller');
        }
    }
    
}



?>

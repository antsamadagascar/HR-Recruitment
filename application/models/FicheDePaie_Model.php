<?php
class FicheDePaie_Model extends CI_Model
{

    public function genererFicheDePaie($idEmploye, $mois, $annee) {
    // Récupérer les informations de l'employé
    $this->db->select('c.nom, c.prenom, e.salaire, e.datedebut');
    $this->db->from('embauche e');
    $this->db->join('candidat c', 'c.id = e.idcandidat');
    $this->db->where('e.idcandidat', $idEmploye);

    $query = $this->db->get();
    $employeInfo = $query->row();

    if ($employeInfo) {
        $salaireBrut = $employeInfo->salaire;

        // Calcul des cotisations sociales (25% du salaire brut)
        $cotisations = 0.25 * $salaireBrut;

        // Calcul des primes
        $primes = $this->calculerPrimes($employeInfo->datedebut, $salaireBrut);

        // Récupérer les jours d'absence (jours de congé approuvés pour le mois et l'année spécifiés)
        $joursAbsences = $this->db->query("
            SELECT SUM(nombreJours) AS joursAbsences
            FROM DemandeConge
            WHERE idEmploye = ?
            AND statut = 'Approuvé'
            AND EXTRACT(MONTH FROM dateDebut) = ?
            AND EXTRACT(YEAR FROM dateDebut) = ?
        ", [$idEmploye, $mois, $annee])->row()->joursAbsences ?? 0;

        // Calcul du taux journalier
        $tauxJournalier = $salaireBrut / 30;

        // Calcul du salaire brut ajusté (en tenant compte des absences)
        $salaireBrutAjuste = $salaireBrut - ($joursAbsences * $tauxJournalier);

        // Calcul du salaire net en tenant compte des cotisations sociales et primes
        $salaireNet = $salaireBrutAjuste - $cotisations + $primes;

        // Préparer les données à insérer dans la table 'fichedepaie'
        $data = [
            'idemploye' => $idEmploye,
            'annee' => $annee,
            'mois' => $mois,
            'salairebrut' => $salaireBrut,
            'cotisations' => $cotisations,
            'salairenet' => $salaireNet,
            'primes' => $primes,
            'jourscongespayes' => $joursAbsences,  // Jours de congés payés/absences approuvés
            'dategeneration' => date('Y-m-d H:i:s'),
        ];

        // Insérer les données dans la table 'fichedepaie'
        $this->db->insert('fichedepaie', $data);

        // Retourner l'ID de la nouvelle fiche de paie
        return $this->db->insert_id();
    }

    return false;
}


    public function getFicheDePaie($idFiche) {
        $this->db->select('
            fp.*, 
            c.nom, 
            c.prenom, 
            e.datedebut AS dateEmbauche, 
            e.salaire AS salaireDeBase
        ');
        $this->db->from('fichedepaie fp');
        $this->db->join('embauche e', 'e.idcandidat = fp.idemploye', 'left');
        $this->db->join('candidat c', 'c.id = e.idcandidat', 'left');
        $this->db->where('fp.id', $idFiche);
    
        $query = $this->db->get();
        return $query->row(); 
    }
    
    // Calcul des primes en fonction de l'ancienneté
    private function calculerPrimes($dateEmbauche, $salaireBrut) {
        $dateEmbauche = new DateTime($dateEmbauche);
        $dateActuelle = new DateTime();
        $anciennete = $dateEmbauche->diff($dateActuelle)->y;

        if ($anciennete > 5) {
            return 0.05 * $salaireBrut; 
        }
        return 0; // Pas de prime pour moins de 5 ans d'ancienneté
    }
}
?>

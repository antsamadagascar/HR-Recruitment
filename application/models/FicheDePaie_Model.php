<?php
class FicheDePaie_Model extends CI_Model
{

    public function genererFicheDePaie($idEmploye, $mois, $annee) {
        $this->db->select('c.nom, c.prenom, e.salaire, e.datedebut');
        $this->db->from('embauche e');
        $this->db->join('candidat c', 'c.id = e.idcandidat');
        $this->db->where('e.idcandidat', $idEmploye);
    
        $query = $this->db->get();
        $employeInfo = $query->row();
    
        if ($employeInfo) {
            $cotisations = 0.25 * $employeInfo->salaire;
            $salaireNet = $employeInfo->salaire - $cotisations;
            $primes = $this->calculerPrimes($employeInfo->datedebut, $employeInfo->salaire);
    
            $joursCongesPayes = $this->db->query("
                SELECT SUM(nombreJours) AS joursConges
                FROM DemandeConge
                WHERE idEmploye = ?
                AND statut = 'Approuvé'
                AND EXTRACT(MONTH FROM dateDebut) = ?
                AND EXTRACT(YEAR FROM dateDebut) = ?
            ", [$idEmploye, $mois, $annee])->row()->joursConges ?? 0;

            $data = [
                'idemploye' => $idEmploye,
                'annee' => $annee,
                'mois' => $mois,
                'salairebrut' => $employeInfo->salaire,
                'cotisations' => $cotisations,
                'salairenet' => $salaireNet,
                'primes' => $primes,
                'jourscongespayes' => $joursCongesPayes,
                'dategeneration' => date('Y-m-d H:i:s'),
            ];
    
            $this->db->insert('fichedepaie', $data);
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

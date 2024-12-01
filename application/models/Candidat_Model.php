<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidat_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_candidat($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('candidat', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table Candidat : ' . $e->getMessage());
    }
}

public function update_candidat($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('candidat', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table Candidat : ' . $e->getMessage());
    }
}

public function delete_candidat($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('candidat');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table Candidat : ' . $e->getMessage());
    }
}

public function get_candidat($id) {
    try {
        $query = $this->db->get_where('candidat', array('id' => $id));
        if ($query->num_rows() == 0) {
            throw new Exception('Candidat non trouvé.');
        }
        return $query->row();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de Candidat : ' . $e->getMessage());
    }
}

public function get_all_candidat() {
    try {
        $query = $this->db->get('candidat');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table Candidat: ' . $e->getMessage());
    }
}

public function checkCount($idCandidat, $idAnnonce) {
    try {
        if (empty($idCandidat) || empty($idAnnonce)) {
            throw new Exception('Les deux identifiants doivent être fournis.');
        }

        $this->db->select('nombrecandidatures');
        $this->db->from('get_candidature_count_per_candidat_annonce');
        $this->db->where('idcandidat', $idCandidat);
        $this->db->where('idannonce', $idAnnonce);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row()->nombrecandidatures;
        }
        
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la vérification du nombre de candidatures dans la vue : ' . $e->getMessage());
    }
}

public function get_candidate_details($candidatId) {
    try {
        // Vérifier si l'ID du candidat est valide
        if (empty($candidatId)) {
            throw new Exception('L\'ID du candidat ne peut pas être vide.');
        }

        // Exécuter la requête SQL pour récupérer les données depuis la vue candidate_details pour un candidat spécifique
        $query = $this->db->query('SELECT * FROM candidate_details WHERE candidat_id = ?', array($candidatId));

        // Vérifier si des résultats sont trouvés
        if ($query->num_rows() > 0) {
            return $query->row();  // Retourne un seul résultat (détail du candidat)
        } else {
            throw new Exception('Candidat non trouvé.');
        }
    } catch (Exception $e) {
        // Gestion des exceptions avec un message d'erreur
        throw new Exception('Erreur lors de la récupération des détails du candidat : ' . $e->getMessage());
    }
}

// Fonction pour récupérer tous les candidats dont le CV est validé
public function get_all_candidat_validate_cv() {
    // Effectuer la requête SQL
    $this->db->select('*');
    $this->db->from('candidat AS c'); // Table Candidat
    $this->db->join('cv AS cv', 'cv.idcandidat = c.id'); // Jointure avec la table CV
    $this->db->where('cv.isvalider', TRUE); // Filtrer les candidats dont le CV est validé
    $this->db->where('cv.datevalidation IS NOT NULL'); // Filtrer les candidats dont la date de validation n'est pas nulle
    
    // Exécuter la requête et récupérer les résultats
    $query = $this->db->get();

    // Vérifier si des résultats ont été trouvés et les retourner
    if ($query->num_rows() > 0) {
        return $query->result(); // Retourner les résultats sous forme de tableau d'objets
    } else {
        return []; // Retourner un tableau vide si aucun candidat n'a été trouvé
    }
}
// Candidat_Model.php
public function get_test_entretien_termine($idCandidat) {
    $sql = "
        SELECT 
            c.test_entretien_termine
        FROM candidat AS c
        JOIN cv AS cv ON cv.idcandidat = c.id
        WHERE c.id = ? 
          AND c.etat < 0
          AND cv.isvalider IS TRUE 
          AND cv.status = 'valider'
    ";

    $query = $this->db->query($sql, [$idCandidat]);
    $result = $query->row(); // Utiliser row() pour obtenir un objet unique

    // Si un résultat est trouvé, retourner l'objet
    if ($result) {
        return $result;
    }

    return null; // Retourne null si aucun résultat n'est trouvé
}



}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contrat_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_contrat($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('contrat', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table Contrat : ' . $e->getMessage());
    }
}

public function update_contrat($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('Contrat', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table Contrat : ' . $e->getMessage());
    }
}

public function delete_contrat($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('Contrat');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table Contrat : ' . $e->getMessage());
    }
}


public function get_contrat_by_candidatId($idCandidat) {
    try {
        $this->db->select('*');
        $this->db->from('get_all_contrat_after_embauche');
        $this->db->where('idcandidat', $idCandidat); 
        $query = $this->db->get();
        
        /*
        if ($query->num_rows() == 0) {
            throw new Exception('Aucun contrat trouvé pour ce candidat.');
        }
    
        */
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des contrats : ' . $e->getMessage());
    }
}



public function get_all_contrat() {
    try {
        // Filtrer uniquement les contrats où iscontrat est TRUE
        $this->db->where('iscontrat', TRUE);  // Ajouter cette condition

        // Exécuter la requête sur la table (ou vue) appropriée
        $query = $this->db->get('get_all_contrat_after_embauche');

        // Retourner le résultat sous forme de tableau d'objets
        return $query->result();
    } catch (Exception $e) {
        // Gérer l'erreur en cas de problème
        throw new Exception('Erreur lors de la récupération des données dans la table Contrat: ' . $e->getMessage());
    }
}

public function get_contrat() {
    try {
        // Exécuter la requête sur la table (ou vue) appropriée
        $query = $this->db->get('contrat');

        // Retourner le résultat sous forme de tableau d'objets
        return $query->result();
    } catch (Exception $e) {
        // Gérer l'erreur en cas de problème
        throw new Exception('Erreur lors de la récupération des données dans la table Contrat: ' . $e->getMessage());
    }
}


}
?>

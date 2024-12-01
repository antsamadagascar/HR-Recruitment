<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidature_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_candidature($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('candidature', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table Candidature : ' . $e->getMessage());
    }
}

public function update_candidature($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('Candidature', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table Candidature : ' . $e->getMessage());
    }
}

public function delete_candidature($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('Candidature');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table Candidature : ' . $e->getMessage());
    }
}

public function get_candidature($id) {
    try {
        $query = $this->db->get_where('Candidature', array('id' => $id));
        if ($query->num_rows() == 0) {
            throw new Exception('Candidature non trouvé.');
        }
        return $query->row();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de Candidature : ' . $e->getMessage());
    }
}

public function get_all_candidature() {
    try {
        $query = $this->db->get('Candidature');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table Candidature: ' . $e->getMessage());
    }
}

public function updateCandidatStatus($candidatId, $status)
{
    // Vérification du statut pour éviter des valeurs invalides
    if (!in_array($status, ['accepter', 'rejeter'])) {
        return false;
    }

    // Mise à jour du statut dans la table Candidature
    $this->db->set('statutcandidature', $status);
    $this->db->where('idcandidat', $candidatId);

    // Exécution de la requête
    return $this->db->update('candidature');
}
}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfilRequis_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_profilrequis($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('profilrequis', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table ProfilRequis : ' . $e->getMessage());
    }
}

public function update_profilrequis($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('profilrequis', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table ProfilRequis : ' . $e->getMessage());
    }
}

public function delete_profilrequis($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('profilrequis');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table ProfilRequis : ' . $e->getMessage());
    }
}

public function get_profilrequis($id) {
    try {
        $query = $this->db->get_where('profilrequis', array('id' => $id));
        if ($query->num_rows() == 0) {
            throw new Exception('ProfilRequis non trouvé.');
        }
        return $query->row();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de ProfilRequis : ' . $e->getMessage());
    }
}

public function get_all_profilrequis() {
    try {
        $query = $this->db->get('v_profilrequis');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table ProfilRequis: ' . $e->getMessage());
    }
}

// Fonction pour récupérer les données de la vue ProfilRequisEntreprise
public function getProfilRequisEntreprise() {
    $query = $this->db->get('profilrequisentreprise'); // Exemple de requête
    return $query->num_rows() > 0 ? $query->result() : [];
}

// Fonction pour récupérer les données de la vue ProfilCandidats
public function getProfilCandidats() {
    $this->db->select('*');
    $this->db->from('profilcandidats '); 
    $this->db->where('statutcandidature', 'En attente');

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->result(); 
    } else {
        return [];
    }
}


public function getProfilCandidatsValiderParRh() {
    $query = $this->db->get('profil_candidats_valides'); 
    return $query->result(); 
}

}
?>

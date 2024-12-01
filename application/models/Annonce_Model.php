<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Annonce_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_annonce($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('annonce', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table Annonce : ' . $e->getMessage());
    }
}

public function update_annonce($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('annonce', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table Annonce : ' . $e->getMessage());
    }
}

public function delete_annonce($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('annonce');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table Annonce : ' . $e->getMessage());
    }
}
//by idbranche
public function get_annonce($id)
{
    try {
        $query = $this->db->get_where('get_all_annonce_by_id_branche', array('idbranche' => $id));

        if ($query->num_rows() == 0) {
            throw new Exception('Annonce non trouvée pour la branche ID ' . $id . '.');
        }
        return $query->row();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de l\'annonce : ' . $e->getMessage());
    }
}

//by idbranche
public function get_annonce_by_idAnnonce($id)
{
    try {
        $query = $this->db->get_where('annonce', array('id' => $id));

        if ($query->num_rows() == 0) {
            throw new Exception('Annonce non trouvée pour l\'annonce ID ' . $id . '.');
        }
        return $query->row();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de l\'annonce : ' . $e->getMessage());
    }
}

public function get_all_annonce() {
    try {
        $query = $this->db->get('v_annonces');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table Annonce: ' . $e->getMessage());
    }
}

public function get_all_annonce_valider_par_rh() {
    try {
        $query = $this->db->get('vue_besoins_en_talent_valider');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table Annonce: ' . $e->getMessage());
    }
}

}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BesoinsEnTalent_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_besoinsentalent($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('besoinsentalent', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table BesoinsEnTalent : ' . $e->getMessage());
    }
}

public function update_besoinsentalent($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('besoinsentalent', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table BesoinsEnTalent : ' . $e->getMessage());
    }
}

public function delete_besoinsentalent($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('besoinsentalent');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table BesoinsEnTalent : ' . $e->getMessage());
    }
}

public function get_besoinsentalent($id) {
    try {
        $query = $this->db->get_where('besoinsentalent', array('id' => $id));
        if ($query->num_rows() == 0) {
            throw new Exception('BesoinsEnTalent non trouvé.');
        }
        return $query->row();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de BesoinsEnTalent : ' . $e->getMessage());
    }
}

public function get_all_besoinsentalent() {
    try {
        $query = $this->db->get('v_besoinsentalent');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table BesoinsEnTalent: ' . $e->getMessage());
    }
}

public function get_demande_besoin_talent() {
    try {
        $query = $this->db->get('vue_besoins_en_talent');  
        return $query->result();  
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des demandes de besoins en talent : ' . $e->getMessage());
    }
}


}
?>

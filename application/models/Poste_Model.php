<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poste_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_poste($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('poste', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table Poste : ' . $e->getMessage());
    }
}

public function update_poste($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('poste', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table Poste : ' . $e->getMessage());
    }
}

public function delete_poste($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('poste');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table Poste : ' . $e->getMessage());
    }
}

public function get_poste($id) {
    try {
        $query = $this->db->get_where('poste', array('id' => $id));
        if ($query->num_rows() == 0) {
            throw new Exception('Poste non trouvé.');
        }
        return $query->row();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de Poste : ' . $e->getMessage());
    }
}

public function get_all_poste() {
    try {
        $query = $this->db->get('v_poste');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table Poste: ' . $e->getMessage());
    }
}

}
?>

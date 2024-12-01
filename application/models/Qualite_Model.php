<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qualite_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_qualite($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('qualite', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table Qualite : ' . $e->getMessage());
    }
}

public function update_qualite($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('Qualite', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table Qualite : ' . $e->getMessage());
    }
}

public function delete_qualite($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('Qualite');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table Qualite : ' . $e->getMessage());
    }
}

public function get_qualite($id) {
    try {
        $query = $this->db->get_where('Qualite', array('id' => $id));
        if ($query->num_rows() == 0) {
            throw new Exception('Qualite non trouvé.');
        }
        return $query->row();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de Qualite : ' . $e->getMessage());
    }
}

public function get_all_qualite() {
    try {
        $query = $this->db->get('Qualite');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table Qualite: ' . $e->getMessage());
    }
}

}
?>

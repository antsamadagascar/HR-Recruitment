<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loisir_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_loisir($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('Loisir', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table Loisir : ' . $e->getMessage());
    }
}

public function update_loisir($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('Loisir', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table Loisir : ' . $e->getMessage());
    }
}

public function delete_loisir($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('Loisir');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table Loisir : ' . $e->getMessage());
    }
}

public function get_loisir($id) {
    try {
        $query = $this->db->get_where('Loisir', array('id' => $id));
        if ($query->num_rows() == 0) {
            throw new Exception('Loisir non trouvé.');
        }
        return $query->row();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de Loisir : ' . $e->getMessage());
    }
}

public function get_all_loisir() {
    try {
        $query = $this->db->get('Loisir');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table Loisir: ' . $e->getMessage());
    }
}

}
?>

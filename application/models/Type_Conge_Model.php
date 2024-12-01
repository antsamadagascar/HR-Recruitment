<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_Conge_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_type_conge($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('typeconge', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table Type Conge : ' . $e->getMessage());
    }
}

public function update_TypeConge($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('typeconge', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table TypeConge : ' . $e->getMessage());
    }
}

public function delete_TypeConge($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('typeconge');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table TypeConge : ' . $e->getMessage());
    }
}


public function get_all_TypeConge() {
    try {
        $query = $this->db->get('typeconge');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table TypeConge: ' . $e->getMessage());
    }
}


}
?>

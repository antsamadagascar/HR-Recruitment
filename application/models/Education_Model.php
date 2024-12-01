<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Education_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_education($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('Education', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table Education : ' . $e->getMessage());
    }
}

public function update_education($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('Education', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table Education : ' . $e->getMessage());
    }
}

public function delete_education($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('Education');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table Education : ' . $e->getMessage());
    }
}

public function get_education($id) {
    try {
        $query = $this->db->get_where('Education', array('id' => $id));
        if ($query->num_rows() == 0) {
            throw new Exception('Education non trouvé.');
        }
        return $query->row();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de Education : ' . $e->getMessage());
    }
}

public function get_all_education() {
    try {
        $query = $this->db->get('Education');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table Education: ' . $e->getMessage());
    }
}

}
?>

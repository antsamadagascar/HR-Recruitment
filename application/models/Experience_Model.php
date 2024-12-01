<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Experience_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_experience($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('Experience', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table Experience : ' . $e->getMessage());
    }
}

public function update_experience($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('Experience', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table Experience : ' . $e->getMessage());
    }
}

public function delete_experience($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('Experience');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table Experience : ' . $e->getMessage());
    }
}

public function get_experience($id) {
    try {
        $query = $this->db->get_where('Experience', array('id' => $id));
        if ($query->num_rows() == 0) {
            throw new Exception('Experience non trouvé.');
        }
        return $query->row();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de Experience : ' . $e->getMessage());
    }
}

public function get_all_experience() {
    try {
        $query = $this->db->get('Experience');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table Experience: ' . $e->getMessage());
    }
}

}
?>

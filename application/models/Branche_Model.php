<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class branche_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_branche($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('branche', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table branche : ' . $e->getMessage());
    }
}

public function update_branche($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('branche', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table branche : ' . $e->getMessage());
    }
}

public function delete_branche($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('branche');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table branche : ' . $e->getMessage());
    }
}

public function get_branche($id) {
    try {
        $query = $this->db->get_where('branche', array('id' => $id));
        if ($query->num_rows() == 0) {
            throw new Exception('branche non trouvé.');
        }
        return $query->row();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de branche : ' . $e->getMessage());
    }
}

public function get_all_branche() {
    try {
        $query = $this->db->get('branche');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table branche: ' . $e->getMessage());
    }
}

}
?>

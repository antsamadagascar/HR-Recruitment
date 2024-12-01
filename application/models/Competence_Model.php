<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Competence_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_competence($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('Competence', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table Competence : ' . $e->getMessage());
    }
}

public function update_competence($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('Competence', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table Competence : ' . $e->getMessage());
    }
}

public function delete_competence($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('Competence');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table Competence : ' . $e->getMessage());
    }
}

public function get_competence($id) {
    try {
        $query = $this->db->get_where('Competence', array('id' => $id));
        if ($query->num_rows() == 0) {
            throw new Exception('Competence non trouvé.');
        }
        return $query->row();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de Competence : ' . $e->getMessage());
    }
}

public function get_all_competence() {
    try {
        $query = $this->db->get('Competence');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table Competence: ' . $e->getMessage());
    }
}

}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TypeContrat_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_typecontrat($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('TypeContrat', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table TypeContrat : ' . $e->getMessage());
    }
}

public function update_typecontrat($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('TypeContrat', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table TypeContrat : ' . $e->getMessage());
    }
}

public function delete_typecontrat($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('TypeContrat');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table TypeContrat : ' . $e->getMessage());
    }
}

public function get_typecontrat($id) {
    try {
        $query = $this->db->get_where('TypeContrat', array('id' => $id));
        if ($query->num_rows() == 0) {
            throw new Exception('TypeContrat non trouvé.');
        }
        return $query->row();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de TypeContrat : ' . $e->getMessage());
    }
}

public function get_all_typecontrat() {
    try {
        $query = $this->db->get('TypeContrat');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table TypeContrat: ' . $e->getMessage());
    }
}

}
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CV_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_cv($data) {
    try {
  /*
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        print_r($data);
    */
        $this->db->insert('cv', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table CV : ' . $e->getMessage());
        print_r($data);
    }
}

public function update_cv($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('CV', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table CV : ' . $e->getMessage());
    }
}

public function delete_cv($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('CV');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table CV : ' . $e->getMessage());
    }
}

public function get_cv($id) {
    try {
        $query = $this->db->get_where('CV', array('id' => $id));
        if ($query->num_rows() == 0) {
            throw new Exception('CV non trouvé.');
        }
        return $query->row();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de CV : ' . $e->getMessage());
    }
}

public function get_all_cv() {
    try {
        $query = $this->db->get('CV');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table CV: ' . $e->getMessage());
    }
}

public function updateValidationStatus($idCandidat) {
    $data = [
        'isvalider' => true,
        'status' => 'valider',
        'datevalidation' => true ? date('Y-m-d') : null 
    ];

    $this->db->where('idcandidat', $idCandidat);
    $result = $this->db->update('cv', $data);

    return $result;
}

public function updateStatusRejeter($idCandidat) {
    $data = [
        'status' => 'rejeter',
        'isvalider' => null,
        'datevalidation' => null
    ];

    $this->db->where('idcandidat', $idCandidat);
    return $this->db->update('cv', $data);
}

}
?>

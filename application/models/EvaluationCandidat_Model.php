<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EvaluationCandidat_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_evaluationcandidat($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('evaluationcandidat', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table EvaluationCandidat : ' . $e->getMessage());
    }
}

public function update_evaluationcandidat($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('evaluationcandidat', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table EvaluationCandidat : ' . $e->getMessage());
    }
}

public function delete_evaluationcandidat($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('evaluationcandidat');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table EvaluationCandidat : ' . $e->getMessage());
    }
}

public function get_evaluationcandidat($id) {
    try {
        $query = $this->db->get_where('evaluationcandidat', array('id' => $id));
        if ($query->num_rows() == 0) {
            throw new Exception('EvaluationCandidat non trouvé.');
        }
        return $query->row();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de EvaluationCandidat : ' . $e->getMessage());
    }
}

public function get_all_evaluationcandidat() {
    try {
        $query = $this->db->get('vueevaluationcandidats');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table EvaluationCandidat: ' . $e->getMessage());
    }
}

public function update_validation_status($id, $action) {
    $isValide = ($action === 'valid') ? TRUE : FALSE;

    $this->db->where('id', $id);
    $data = array('isvalide' => $isValide);
    return $this->db->update('evaluationcandidat', $data);
}

}
?>

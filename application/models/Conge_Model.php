<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conge_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_demande_conge($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('demandeconge', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table DemandeConge : ' . $e->getMessage());
    }
}

public function delete_conge($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('conge');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table conge : ' . $e->getMessage());
    }
}

public function get_all_Conge() {
    try {
        $query = $this->db->get('conge');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table conge: ' . $e->getMessage());
    }
}
public function get_all_demandes() {
    $query = $this->db->get('v_demande_conge'); 
    return $query->result(); 
}



}
?>

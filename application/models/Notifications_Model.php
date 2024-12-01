<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications_Model extends CI_Model {

    public function insert_notifications($data) {
        try {
            /*
            if (empty($data) || in_array('', $data)) {
                throw new Exception('Tous les champs doivent être remplis.');
            }
            */
            $this->db->insert('notifications', $data);
        } catch (Exception $e) {
            throw new Exception('Erreur lors de l\'insertion dans la table Notifications : ' . $e->getMessage());
        }

    }
    
    public function get_notification($idCandidat) {
        $this->db->where('idcandidat', $idCandidat);
        $this->db->where('islue', false);
        $query = $this->db->get('notifications');
        return $query->result_array(); 

    }


    public function get_count_notifications($idCandidat) {
        $this->db->where('idcandidat', $idCandidat);
        $this->db->where('islue', false);  
        return $this->db->count_all_results('notifications'); 
    }

    public function marquer_tout_comme_lu($idCandidat) {
        $this->db->set('islue', true);
        $this->db->where('idcandidat', $idCandidat);
        $this->db->update('notifications');
    }
    
}

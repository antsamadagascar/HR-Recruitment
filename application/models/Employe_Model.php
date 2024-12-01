<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employe_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function checkIsEmploye($idCandidat) {
        $this->db->select('*');
        $this->db->from('checkisemploye');
        $this->db->where('idcandidat', $idCandidat);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;  
        } else {
            return false; 
        }
    }

    public function checkCvValideEtNonEmbauche($idCandidat) {
        $this->db->select('*');
        $this->db->from('checkcvvalideetnonembauche');
        $this->db->where('idcandidat', $idCandidat);
        $query = $this->db->get();
    
        return $query->num_rows() > 0;
    }

    public function listeEmploye() {
        $this->db->select('*');
        $this->db->from('v_listes_employe');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return []; 
        }
    }

    public function calculerDroitsConges($employeId) {
        $sql = "SELECT calculerDroitsConges(?, NULL) AS droits_conges";
    
        $query = $this->db->query($sql, array($employeId));
  
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->droits_conges;  
        } else {
            throw new Exception('Erreur lors du calcul des droits de congés.');
        }
    }
    
    public function verifierDroitConge($idCandidat) {
        $this->db->select('COUNT(*) AS total_conges');
        $this->db->from('droitconge');
        $this->db->where('idemploye', $idCandidat);
    
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->total_conges > 0;  
        } else {
            return false;
        }
    }
    
    
}
?>

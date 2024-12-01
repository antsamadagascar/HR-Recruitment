<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Embauche_Model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

public function insert_embauche($data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->insert('embauche', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de l\'insertion dans la table Embauche : ' . $e->getMessage());
    }
}

public function update_embauche($id, $data) {
    try {
        if (empty($data) || in_array('', $data)) {
            throw new Exception('Tous les champs doivent être remplis.');
        }
        $this->db->where('id', $id);
        $this->db->update('Embauche', $data);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour dans la table Embauche : ' . $e->getMessage());
    }
}

public function delete_embauche($id) {
    try {
        $this->db->where('id', $id);
        $this->db->delete('Embauche');
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la suppression dans la table Embauche : ' . $e->getMessage());
    }
}

public function get_embauche($id) {
    try {
        $query = $this->db->get_where('Embauche', array('id' => $id));
        if ($query->num_rows() == 0) {
            throw new Exception('Embauche non trouvé.');
        }
        return $query->row();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération de Embauche : ' . $e->getMessage());
    }
}

public function get_all_embauche() {
    try {
        $query = $this->db->get('Embauche');
        return $query->result();
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la récupération des données dans la table Embauche: ' . $e->getMessage());
    }
}

public function get_candidats_valides() {
    $query = $this->db->query("select * from VueCandidatsValidesSansEmbauche");
    return $query->result();
}

public function update_besoins_talent($idProfile) {
    try {
        // Récupérer l'enregistrement du besoin en talent pour le profil requis
        $besoin = $this->db->get_where('besoinsentalent', array('idprofile' => $idProfile, 'isdemande' => true))->row();
        
        if ($besoin) {
            // Vérifier que le nombre de postes est supérieur à 0
            if ($besoin->nombreDePostes > 0) {
                // Décrémenter le nombre de postes disponibles
                $new_nombre_de_postes = $besoin->nombreDePostes - 1;

                // Mettre à jour la table BesoinsEnTalent
                $this->db->update('besoinsentalent', 
                    array('nombredepostes' => $new_nombre_de_postes),
                    array('id' => $besoin->id)
                );
            } else {
                throw new Exception('Aucun poste disponible pour ce profil.');
            }
        } else {
            throw new Exception('Aucun besoin de talent trouvé pour ce profil.');
        }
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour du nombre de postes : ' . $e->getMessage());
    }
}

public function update_contrat($idEmb, $action) {
    // Vérification de l'action
    if ($action == 'valider') {
        $data['iscontrat'] = TRUE; // Valider le contrat
    } elseif ($action == 'refuser') {
        $data['iscontrat'] = FALSE; // Refuser le contrat
    } else {
        return false; // Si l'action est incorrecte, on renvoie false
    }

    // Exécuter l'update
    $this->db->where('id', $idEmb);
    $result = $this->db->update('embauche', $data); // Retourne true si l'update a réussi, sinon false

    // Retourner le résultat de la mise à jour
    return $result;
}


}
?>

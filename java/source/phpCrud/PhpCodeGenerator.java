package phpCrud;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;

public class PhpCodeGenerator {

    public static void main(String[] args) {
        // Exemple de paramètres pour la génération de code
        String[] tableNames = {"Candidat","Branche","CV","Competence","Loisir","Education","Experience"
        ,"TypeContrat","Contrat","Branche","Poste","ProfilRequis","Qualite","BesoinsEnTalent","Annonce","EvaluationCandidat",
    "Embauche","Candidature"
    };
    // String[] tableNames = {"Agence"};
        
        // Définir les répertoires de sortie
        String modelOutputDir = "../../application/models";
        String controllerOutputDir = "../../application/controllers";
        
        // Vérifier la présence des répertoires et les créer si nécessaire
        createDirectoryIfNotExists(modelOutputDir);
        createDirectoryIfNotExists(controllerOutputDir);

        // Générer le code PHP pour chaque modèle et contrôleur
        for (String tableName : tableNames) {
            String className = tableName + "_Model";
            String controllerName = tableName;
            
            generatePhpModel(className, tableName, modelOutputDir + "/" + className + ".php");
            generatePhpController(controllerName, className, tableName, controllerOutputDir + "/" + controllerName + ".php");
        }
    }

    public static void generatePhpModel(String className, String tableName, String outputFile) {
        try (PrintWriter writer = new PrintWriter(new FileWriter(outputFile))) {
            writer.println("<?php");
            writer.println("defined('BASEPATH') OR exit('No direct script access allowed');");
            writer.println();
            writer.printf("class %s extends CI_Model {%n", className);
            writer.println();
            writer.println("    public function __construct() {");
            writer.println("        $this->load->database();");
            writer.println("    }");
            writer.println();
            
            // Générer la méthode d'insertion
            writer.printf("public function insert_%s($data) {%n", tableName.toLowerCase());
            writer.printf("    try {%n");
            writer.printf("        if (empty($data) || in_array('', $data)) {%n");
            writer.printf("            throw new Exception('Tous les champs doivent être remplis.');%n");
            writer.printf("        }%n");
            writer.printf("        $this->db->insert('%s', $data);%n", tableName);
            writer.printf("    } catch (Exception $e) {%n");
            writer.printf("        throw new Exception('Erreur lors de l\\'insertion dans la table %s : ' . $e->getMessage());%n", tableName);
            writer.printf("    }%n");
            writer.printf("}%n");
            writer.println();

            
            // Générer la méthode de mise à jour
            writer.printf("public function update_%s($id, $data) {%n", tableName.toLowerCase());
            writer.printf("    try {%n");
            writer.printf("        if (empty($data) || in_array('', $data)) {%n");
            writer.printf("            throw new Exception('Tous les champs doivent être remplis.');%n");
            writer.printf("        }%n");
            writer.printf("        $this->db->where('id', $id);%n");
            writer.printf("        $this->db->update('%s', $data);%n", tableName);
            writer.printf("    } catch (Exception $e) {%n");
            writer.printf("        throw new Exception('Erreur lors de la mise à jour dans la table %s : ' . $e->getMessage());%n", tableName);
            writer.printf("    }%n");
            writer.printf("}%n");
            writer.println();

            // Générer la méthode de suppression
            writer.printf("public function delete_%s($id) {%n", tableName.toLowerCase());
            writer.printf("    try {%n");
            writer.printf("        $this->db->where('id', $id);%n");
            writer.printf("        $this->db->delete('%s');%n", tableName);
            writer.printf("    } catch (Exception $e) {%n");
            writer.printf("        throw new Exception('Erreur lors de la suppression dans la table %s : ' . $e->getMessage());%n", tableName);
            writer.printf("    }%n");
            writer.printf("}%n");
            writer.println();

            // Générer la méthode de lecture
            writer.printf("public function get_%s($id) {%n", tableName.toLowerCase());
            writer.printf("    try {%n");
            writer.printf("        $query = $this->db->get_where('%s', array('id' => $id));%n", tableName);
            writer.printf("        if ($query->num_rows() == 0) {%n");
            writer.printf("            throw new Exception('%s non trouvé.');%n", tableName);
            writer.printf("        }%n");
            writer.printf("        return $query->row();%n");
            writer.printf("    } catch (Exception $e) {%n");
            writer.printf("        throw new Exception('Erreur lors de la récupération de %s : ' . $e->getMessage());%n", tableName);
            writer.printf("    }%n");
            writer.printf("}%n");
            writer.println();


            // Générer la méthode de lecture de tous les enregistrements
            writer.printf("public function get_all_%s() {%n", tableName.toLowerCase());
            writer.printf("    try {%n");
            writer.printf("        $query = $this->db->get('%s');%n", tableName);
            writer.printf("        return $query->result();%n");
            writer.printf("    } catch (Exception $e) {%n");
            writer.printf("        throw new Exception('Erreur lors de la récupération des données dans la table %s: ' . $e->getMessage());%n", tableName);
            writer.printf("    }%n");
            writer.printf("}%n");
            writer.println();
            
            
            writer.println("}");
            writer.println("?>");
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public static void generatePhpController(String controllerName, String modelName, String tableName, String outputFile) {
        try (PrintWriter writer = new PrintWriter(new FileWriter(outputFile))) {
            writer.println("<?php");
            writer.println("defined('BASEPATH') OR exit('No direct script access allowed');");
            writer.println();
            writer.printf("class %s extends CI_Controller {%n", controllerName);
            writer.println();
            writer.printf("    public function __construct() {%n");
            writer.println("        parent::__construct();");
            writer.printf("        $this->load->model('%s');%n", modelName);
            writer.println("    }");
            writer.println();
            
            // Méthode pour afficher la liste
            writer.printf("    public function index() {%n");
            writer.println("        $data['" + tableName.toLowerCase() + "'] = $this->" + modelName + "->get_all_" + tableName.toLowerCase() + "();");
            writer.println("        $this->load->view('admin/crud/" + tableName.toLowerCase() + "/list', $data);");
            writer.println("    }");
            writer.println();
            
            // Méthode pour afficher un formulaire d'ajout avec gestion des erreurs
            writer.printf("    public function create() {%n");
            writer.println("        if ($this->input->post()) {");
            writer.println("            $data = $this->input->post();");
            writer.println("            try {");
            writer.printf("                $this->%s->insert_%s($data);%n", modelName, tableName.toLowerCase());
            writer.println("                $this->session->set_flashdata('success', '" + tableName + " ajouté avec succès.');");
            writer.println("                redirect('" + controllerName + "/create');");
            writer.println("            } catch (Exception $e) {");
            writer.println("                $this->session->set_flashdata('error', $e->getMessage());");
            writer.println("            }");
            writer.println("        }");
            writer.println("        $this->load->view('admin/crud/" + tableName.toLowerCase() + "/create');");
            writer.println("    }");
            writer.println();
            
            // Méthode pour afficher un formulaire de mise à jour avec gestion des erreurs
            writer.printf("    public function edit($id) {%n");
            writer.println("        if ($this->input->post()) {");
            writer.println("            $data = $this->input->post();");
            writer.println("            try {");
            writer.printf("                $this->%s->update_%s($id, $data);%n", modelName, tableName.toLowerCase());
            writer.println("                $this->session->set_flashdata('success', '" + tableName + " mis à jour avec succès.');");
            writer.println("                redirect('" + controllerName + "/list');");
            writer.println("            } catch (Exception $e) {");
            writer.println("                $this->session->set_flashdata('error', $e->getMessage());");
            writer.println("            }");
            writer.println("        }");
            writer.println("        $data['item'] = $this->" + modelName + "->get_" + tableName.toLowerCase() + "($id);");
            writer.println("        $this->load->view('admin/crud/" + tableName.toLowerCase() + "/edit', $data);");
            writer.println("    }");
            writer.println();
            
            // Méthode pour supprimer un enregistrement avec gestion des erreurs
            writer.printf("    public function delete($id) {%n");
            writer.println("        try {");
            writer.printf("            $this->%s->delete_%s($id);%n", modelName, tableName.toLowerCase());
            writer.println("            $this->session->set_flashdata('success', '" + tableName + " supprimé avec succès.');");
            writer.println("        } catch (Exception $e) {");
            writer.println("            $this->session->set_flashdata('error', $e->getMessage());");
            writer.println("        }");
            writer.println("        redirect('" + controllerName + "/list');");
            writer.println("    }");
            writer.println();
    
            writer.println("}");
            writer.println("?>");
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    

    private static void createDirectoryIfNotExists(String dirPath) {
        File directory = new File(dirPath);
        if (!directory.exists()) {
            if (directory.mkdirs()) {
                System.out.println("Répertoire créé : " + dirPath);
            } else {
                System.out.println("Erreur lors de la création du répertoire : " + dirPath);
            }
        }
    }
}

package phpCrud;

import connection.PostgresConnection;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;
import java.util.LinkedHashSet;
import java.util.Set;

public class PhpGeneratePage {

    public static void main(String[] args) {
        // Définir les paramètres de test
        String[] tables = {"Agence","Adresse","Reseaux_sociaux","Telephone"};
        //String[] tables = {"Agence"};
        String outputDir = "../../application/views/admin/crud/";

        // Vérifier la présence du répertoire et le créer si nécessaire
        File dir = new File(outputDir);
        if (!dir.exists()) {
            dir.mkdirs();
        }

        Connection conn = null;
    try {
        conn = PostgresConnection.getConnection();
        for (String tableName : tables) {
            // Récupérer les colonnes de la table
            String[] columns = getColumns(conn, tableName);
            
            // Afficher les colonnes récupérées
            System.out.println("Colonnes pour la table " + tableName + ":");
            for (String column : columns) {
                System.out.println(column);
            }

        }
    } catch (SQLException e) {
        e.printStackTrace();
    } finally {
        PostgresConnection.closeConnection(conn);
    }

        // Appeler la méthode de génération des vues
        generateViewsForTables(tables, outputDir);

        // Vérifier la création des fichiers
        verifyGeneratedFiles(outputDir, tables);
    }

    public static void generateViewsForTables(String[] tables, String outputDir) {
        Connection conn = null;
        try {
            conn = PostgresConnection.getConnection();
            for (String tableName : tables) {
                String tableDir = outputDir + "/" + tableName.toLowerCase();
                new File(tableDir).mkdirs();

                String[] columns = getColumns(conn, tableName);
                String controllerName = toCamelCase(tableName);
                
                generateViewFile(tableName, columns, "list.php", tableDir, controllerName);
                generateViewFile(tableName, columns, "create.php", tableDir, controllerName);
                generateViewFile(tableName, columns, "edit.php", tableDir, controllerName);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        } finally {
            PostgresConnection.closeConnection(conn);
        }
    }

    private static void generateViewFile(String tableName, String[] columns, String fileName, String outputDir, String controllerName) {
        try (PrintWriter writer = new PrintWriter(new FileWriter(outputDir + "/" + fileName))) {
            writer.println("<!DOCTYPE html>");
            writer.println("<html lang='en'>");
            writer.println("<head>");
            writer.println("    <meta charset='UTF-8'>");
            writer.println("    <meta name='viewport' content='width=device-width, initial-scale=1.0'>");
            writer.println("    <title>" + capitalizeFirstLetter(fileName.replace(".php", "")) + " - " + capitalizeFirstLetter(tableName) + "</title>");
            writer.println("</head>");
            writer.println("<body>");

            if (fileName.equals("list.php")) {
                writer.printf("<h1>Liste des %s</h1>%n", tableName.toLowerCase());
                writer.printf("<?php if ($this->session->flashdata('error')): ?>%n");
                writer.printf("    <div class=\"alert alert-danger\"  style=\"color:red;\" >%n");
                writer.printf("        <?php echo $this->session->flashdata('error'); ?>%n");
                writer.printf("    </div>%n");
                writer.printf("<?php endif; ?>%n");
                writer.printf("%n");
                writer.printf("<?php if ($this->session->flashdata('success')): ?>%n");
                writer.printf("    <div class=\"alert alert-success\" style=\"color:green;\" >%n");
                writer.printf("        <?php echo $this->session->flashdata('success'); ?>%n");
                writer.printf("    </div>%n");
                writer.printf("<?php endif; ?>%n");

                writer.printf("<p><a href='<?php echo site_url(\"" + controllerName.toLowerCase() + "/create/\"); ?>'>Ajouter un nouveau  %s</a></p>%n",tableName.toLowerCase());
                
        
                writer.println("<table border= '1'>");
                writer.println("    <tr>");
                for (String column : columns) {
                    String columnName = column.split(":")[0];
                    writer.printf("        <th>%s</th>%n", capitalizeFirstLetter(columnName));
                }
                writer.println("        <th>Actions</th>");
                writer.println("    </tr>");
                writer.println("    <?php foreach ($" + tableName.toLowerCase() + " as $item): ?>");
                writer.println("    <tr>");
                for (String column : columns) {
                    String columnName = column.split(":")[0];
                    writer.printf("        <td><?php echo $item->%s; ?></td>%n", columnName);
                }
                writer.println("        <td>");
                writer.println("            <a href='<?php echo site_url(\"" + controllerName.toLowerCase() + "/edit/\" . $item->id); ?>'>Edit</a> |");
                writer.println("            <a href='<?php echo site_url(\"" + controllerName.toLowerCase() + "/delete/\" . $item->id); ?>'>Delete</a>");
                writer.println("        </td>");
                writer.println("    </tr>");
                writer.println("    <?php endforeach; ?>");
                
                writer.println("</table>");
             
                writer.println("</body>");
                writer.println("</html>");

            } else if (fileName.equals("create.php")) {
                writer.printf("<h1>Ajouter un %s</h1>%n", tableName.toLowerCase());
                writer.printf("<?php if ($this->session->flashdata('error')): ?>%n");
                writer.printf("    <div class=\"alert alert-danger\"  style=\"color:red;\" >%n");
                writer.printf("        <?php echo $this->session->flashdata('error'); ?>%n");
                writer.printf("    </div>%n");
                writer.printf("<?php endif; ?>%n");
                writer.printf("%n");
                writer.printf("<?php if ($this->session->flashdata('success')): ?>%n");
                writer.printf("    <div class=\"alert alert-success\" style=\"color:green;\" >%n");
                writer.printf("        <?php echo $this->session->flashdata('success'); ?>%n");
                writer.printf("    </div>%n");
                writer.printf("<?php endif; ?>%n");

                writer.println("<form action='<?php echo site_url(\"" + controllerName.toLowerCase() + "/create\"); ?>' method='post'>");
                // Generate inputs for columns except the first one
                for (int i = 1; i < columns.length; i++) {
                    String column = columns[i];
                    String columnName = column.split(":")[0];
                    String columnType = column.split(":")[1];
                    writer.printf("    <label for='%s'>%s:</label>%n", columnName, capitalizeFirstLetter(columnName));
                    writer.printf("    <input type='%s' id='%s' name='%s' required>%n",
                                   getHtmlInputType(columnType), columnName, columnName);
                }
                writer.println("    <button type='submit'>Submit</button>");
                writer.println("</form>");
                writer.printf("<p><a href='<?php echo site_url(\"" + controllerName.toLowerCase() +"\"); ?>'>Retour </p>");
                
                
            } else if (fileName.equals("edit.php")) {
                writer.printf("<h1>Modifier un %s</h1>%n", tableName.toLowerCase());
                writer.printf("<?php if ($this->session->flashdata('error')): ?>%n");
                writer.printf("    <div class=\"alert alert-danger\"  style=\"color:red;\" >%n");
                writer.printf("        <?php echo $this->session->flashdata('error'); ?>%n");
                writer.printf("    </div>%n");
                writer.printf("<?php endif; ?>%n");
                writer.printf("%n");
                writer.printf("<?php if ($this->session->flashdata('success')): ?>%n");
                writer.printf("    <div class=\"alert alert-success\" style=\"color:green;\" >%n");
                writer.printf("        <?php echo $this->session->flashdata('success'); ?>%n");
                writer.printf("    </div>%n");
                writer.printf("<?php endif; ?>%n");

                writer.println("<form action='<?php echo site_url(\"" + controllerName.toLowerCase() + "/edit/\" . $item->id); ?>' method='post'>");
                writer.println("    <input type='hidden' name='id' value='<?php echo $item->id; ?>'>");
                // Generate inputs for columns except the first one
                for (int i = 1; i < columns.length; i++) {
                    String column = columns[i];
                    String columnName = column.split(":")[0];
                    String columnType = column.split(":")[1];
                    writer.printf("    <label for='%s'>%s:</label>%n", columnName, capitalizeFirstLetter(columnName));
                    writer.printf("    <input type='%s' id='%s' name='%s' value='<?php echo $item->%s; ?>' required>%n",
                                   getHtmlInputType(columnType), columnName, columnName, columnName);
                }
                writer.println("    <button type='submit'>Update</button>");
                writer.println("</form>");
                writer.printf("<p><a href='<?php echo site_url(\"" + controllerName.toLowerCase() +"\"); ?>'>Retour </p>");
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private static String getHtmlInputType(String columnType) {
        switch (columnType) {
            case "int":
                return "number";
            case "decimal":
                return "number";
            case "varchar":
                return "text";
            case "text":
                return "text";
            case "date":
                return "date";
            case "time":
                return "time";  
            case "datetime":
            case "datetime-local":
                return "datetime-local";
            default:
                return "text";
        }
    }
    

    private static String capitalizeFirstLetter(String input) {
        return input.substring(0, 1).toUpperCase() + input.substring(1);
    }

    private static void verifyGeneratedFiles(String outputDir, String[] tables) {
        for (String tableName : tables) {
            File dir = new File(outputDir + "/" + tableName.toLowerCase());
            if (!dir.exists() || !dir.isDirectory()) {
                System.out.println("Le répertoire pour " + tableName + " n'a pas été créé correctement.");
                continue;
            }

            String[] expectedFiles = {"list.php", "create.php", "edit.php"};

            for (String fileName : expectedFiles) {
                File file = new File(dir, fileName);
                if (file.exists() && file.isFile()) {
                    System.out.println(fileName + " pour " + tableName + " a été créé avec succès.");
                } else {
                    System.out.println(fileName + " pour " + tableName + " n'a pas été trouvé.");
                }
            }
        }
    }


    private static String[] getColumns(Connection conn, String tableName) throws SQLException {
    ResultSetMetaData rsmd = conn.prepareStatement("SELECT * FROM " + tableName).executeQuery().getMetaData();
    int columnCount = rsmd.getColumnCount();

    // Utilisation d'un Set pour éviter les doublons
    Set<String> columnSet = new LinkedHashSet<>();

    // Parcourir toutes les colonnes et les ajouter au Set
    for (int i = 1; i <= columnCount; i++) {
        String columnName = rsmd.getColumnName(i);
        String columnType = getSimpleColumnType(rsmd.getColumnClassName(i));
        columnSet.add(columnName + ":" + columnType);
    }
    return columnSet.toArray(new String[0]);
}

private static String getSimpleColumnType(String columnClassName) {
    switch (columnClassName) {
        case "java.lang.Integer":
        case "java.lang.Long":
        case "java.math.BigInteger":
            return "int";
        case "java.lang.Float":
        case "java.lang.Double":
        case "java.math.BigDecimal":
            return "decimal";
        case "java.lang.String":
            return "varchar";
        case "java.sql.Timestamp":
            return "datetime";
        case "java.sql.Date":
            return "date";
        case "java.sql.Time":
            return "time";
        case "java.time.LocalDateTime":
            return "datetime-local";
        case "java.time.LocalDate":
            return "date";
        case "java.time.LocalTime":
            return "time";
        default:
            return "text";
    }
}

    private static String toCamelCase(String tableName) {
        String[] parts = tableName.toLowerCase().split("_");
        StringBuilder camelCaseString = new StringBuilder(parts[0]);
        
        for (int i = 1; i < parts.length; i++) {
            camelCaseString.append(parts[i].substring(0, 1).toUpperCase())
                           .append(parts[i].substring(1));
        }
        
        return camelCaseString.toString();
    }
}

package connection;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class PostgresConnection {
    private static final String DB_URL = "jdbc:postgresql://localhost:5432/Recrutements";
    private static final String DB_USER = "postgres";
    private static final String DB_PASSWORD = "smile290705";

    public static Connection getConnection() {
        Connection connection = null;
        try {
            Class.forName("org.postgresql.Driver");
            connection = DriverManager.getConnection(DB_URL, DB_USER, DB_PASSWORD);
            System.out.println("Connexion établie avec succès !");
        } catch (ClassNotFoundException e) {
            System.err.println("Erreur lors du chargement du pilote JDBC : " + e.getMessage());
        } catch (SQLException e) {
            System.err.println("Erreur lors de la connexion à la base de données : " + e.getMessage());
        }

        return connection;
    }

    public static void closeConnection(Connection connection) {
        try {
            if (connection != null) {
                connection.close();
                System.out.println("Connection closed successfully.");
            }
        } catch (SQLException e) {
            System.out.println("Error closing connection: " + e.getMessage());
        }
    }

    public static void main(String[] args) {
        Connection connection = getConnection();
        if (connection != null) {
            try {
                connection.close();
                System.out.println("Connexion fermée avec succès !");
            } catch (SQLException e) {
                System.err.println("Erreur lors de la fermeture de la connexion : " + e.getMessage());
            }
        } else {
            System.out.println("La connexion à la base de données a échoué.");
        }
    }
}

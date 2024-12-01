-- Insérer un utilisateur actif (etat = 1)
INSERT INTO utilisateur (nom, email, username, mot_de_passe, etat)
VALUES ('John Doe', 'john.doe@example.com', 'john_doe', 'motdepasse123', -1);

-- Insérer un utilisateur inactif (etat = 0)
INSERT INTO utilisateur (nom, email, username, mot_de_passe, etat)
VALUES ('Jane Smith', 'jane.smith@example.com', 'jane_smith', '12345', 0);

-- Insérer un utilisateur suspendu (etat = 2)
INSERT INTO utilisateur (nom, email, username, mot_de_passe, etat)
VALUES ('Alex Johnson', 'alex.johnson@example.com', 'alex_johnson', 'alexpass', 2);

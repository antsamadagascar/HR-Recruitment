    -- Insérer un utilisateur actif (etat = 1)
    INSERT INTO utilisateur (nom, email, username, mot_de_passe, etat)
    VALUES ('John Doe', 'ivo@gmail.com', 'ivo', sha1('john_doe'), 1);

    -- Insérer un utilisateur inactif (etat = 0)
    INSERT INTO utilisateur (nom, email, username, mot_de_passe, etat)
    VALUES ('Jane Smith', 'sira@gmail.com', 'jane_smith', sha1('jane_smith'), 0);

    -- Insérer un utilisateur suspendu (etat = 2)
    INSERT INTO utilisateur (nom, email, username, mot_de_passe, etat)
    VALUES ('Alex Johnson', 'RH@gmail.com', 'alex_johnson', sha1('alex_johnson'), -1);

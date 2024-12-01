-- Insérer des données dans la table type_centre
INSERT INTO type_centre (nom) VALUES 
('opérationnel'),
('structurel');

INSERT INTO centre (id_type_centre, nom) VALUES 
(2, 'Centre Administratif'),         
(1, 'Usine de Transformation'),      
(1, 'Plantation de Riz 1'),          
(1, 'Plantation de Riz 2');        


INSERT INTO metier (id_centre, nom, is_vampire) VALUES
(1, 'Agent Administratif', 0),
(2, 'Technicien de Production', 0),
(4, 'Chef de Production', 1),
(3, 'Agent d''Entretien', 0);

INSERT INTO metier VALUES
(-1, 1, 'Administrateur de Base de Donnée', 0);


INSERT INTO utilisateur (nom, email, username, mot_de_passe) VALUES
(1, 'Alice Dupont', 'alice@example.com', 'alice', sha1('password1')),
(2, 'Bob Martin', 'bob@example.com', 'bob', sha1('password2')),
(3, 'Claire Bernard', 'claire@example.com', 'claire', sha1('password3')),
(4, 'David Durand', 'david@example.com', 'david', sha1('password4')),
(-1, 'RAAIVOSON Ny Hoavisoa Misandratra', 'ranaivosonmisandratra18@gmail.com', 'Bombojoky', sha1('analytique'));



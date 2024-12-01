-- Insérer des données dans la table Branche
INSERT INTO Branche (nomBranche) VALUES 
('Informatique'),
('Ressources Humaines'),
('Marketing');

-- Insertions initiales pour les types de congés
INSERT INTO TypeConge (nom, description, dureeMaximale, estPaye) VALUES
('Congé Payé', 'Congés annuels payés', 30, TRUE),
('Congé Maladie', 'Congés pour raisons médicales', 90, TRUE),
('Congé Sans Solde', 'Congés non rémunérés', 180, FALSE),
('Congé Maternité', 'Congé pour naissance', 112, TRUE),
('Congé Paternité', 'Congé pour nouveau père', 25, TRUE);


-- Insérer des données dans la table TypeContrat
INSERT INTO TypeContrat (typeContrat, description) VALUES 
('CDI', 'Contrat à Durée Indéterminée'),
('CDD', 'Contrat à Durée Déterminée');

-- Insérer des données dans la table Contrat
INSERT INTO Contrat (nomContrat, idTypeContrat, duree) VALUES 
('CDI Standard', 1, 1),
('CDD 6 mois', 2, 6);

-- Insérer des données dans la table Candidat
INSERT INTO Candidat (nom, prenom,motDePasse, adresse, dateNaissance, nationalite, email, telephone,etat) VALUES 
('PDG', 'PDG', MD5('1234'), '123 Rue Principale', '1990-05-14', 'Française', 'Pdg@gmail.com', '0385497169',0),
('RH', 'RH', MD5('1234'), '123 Rue Principale', '1990-05-14', 'Française', 'Rh@gmail.com', '0123456789',1),
('RE', 'Randria', MD5('1234'),  '456 Avenue des Champs', '1985-11-23', 'Française', 'RE@gmail.com', '0987654321',3),
('RC', 'RC', MD5('1234'), '123 Rue Principale', '1990-05-14', 'Française', 'RC@gmail.com', '0123456789',2),

INSERT INTO Candidat (nom, prenom, motDePasse, adresse, dateNaissance, nationalite, email, telephone, etat) VALUES 
('RATOVONANDRASANA', 'Aina Ny Antsa', MD5('1234'), '123 Rue Principale', '1990-05-14', 'Française', 'antsamadagascar@gmail.com', '0123456789',-1),
('RABE', 'Ivo kilonga', MD5('1234'),  '456 Avenue des Champs', '1985-11-23', 'Française', 'ivomihary@gmail.com', '0987654321',-1),

('RAKOTO', 'Jean', MD5('1234'), '123 Rue Principale', '1990-05-14', 'Française', 'Jean@gmail.com', '0123456789',-1),
('RABETOKOTANY', 'James', MD5('1234'),  '456 Avenue des Champs', '1985-11-23', 'Française', 'James@gmail.com', '0987654321',-1),
('ANDRIANARIVO', 'Mbola', MD5('1234'), '789 Avenue de la Liberté', '1992-07-30', 'Malagasy', 'mbola.andrianarivo@gmail.com', '0345678901', -1),
('RAZAFINDRABE', 'Liva', MD5('1234'), '101 Boulevard du 13 Mai', '1988-12-10', 'Malagasy', 'liva.razafindrabe@gmail.com', '0345987654', -1),
('RATSIMBA', 'Tahina', MD5('1234'), '15 Rue de l''Indépendance', '1994-02-20', 'Malagasy', 'tahina.ratsimba@gmail.com', '0324598765', -1),
('RAKOTOMALALA', 'Jean Claude', MD5('1234'), '34 Avenue des Fleurs', '1980-09-10', 'Malagasy', 'jeanclaude.rakotomalala@gmail.com', '0332456789', -1),
('RABELO', 'Sariaka', MD5('1234'), '56 Rue de la Mer', '1995-11-05', 'Malagasy', 'sariaka.rabelo@gmail.com', '0326598741', -1),
('RAMAROSON', 'Herizo', MD5('1234'), '78 Rue de la Paix', '1987-03-18', 'Malagasy', 'herizo.ramaroson@gmail.com', '0334589623', -1),
('MAMY', 'Dera', MD5('1234'), '12 Rue du Prince', '1991-04-11', 'Malagasy', 'dera.mamy@gmail.com', '0346798452', -1),
('RAHARAMINA', 'Fidy', MD5('1234'), '45 Boulevard des Nations', '1989-08-25', 'Malagasy', 'fidy.raharamina@gmail.com', '0321597468', -1),
('TANDROSELY', 'Rivo', MD5('1234'), '23 Rue de la Côte', '1993-06-12', 'Malagasy', 'rivo.tandroseley@gmail.com', '0387412365', -1),
('RAVO', 'Joël', MD5('1234'), '9 Rue des Arènes', '1996-01-28', 'Malagasy', 'joel.ravo@gmail.com', '0329745361', -1);


-- Insérer des données dans la table CV
INSERT INTO CV (idCandidat, isValider, dateValidation) VALUES 
(7, TRUE, '2024-01-01'),
(8, FALSE, NULL),
(9, FALSE, NULL),
(10, FALSE, NULL),
(11, FALSE, NULL),
(12, FALSE, NULL),
(13, FALSE, NULL),
(14, FALSE, NULL),
(15, FALSE, NULL),
(16, FALSE, NULL),
(17, FALSE, NULL),
(18, FALSE, NULL),


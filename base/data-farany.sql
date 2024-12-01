-- Insérer des données dans la table Branche
INSERT INTO Branche (nomBranche) VALUES 
('Informatique');

-- Insérer des données dans la table Poste
INSERT INTO Poste (idBranche, nomPoste, description) VALUES 
(1, 'Développeur Web', 'Développement de sites et applications web');

INSERT INTO ProfilRequis (idPoste, nomProfil, description,experienceTechnique,experienceGenerale) VALUES 
(1, 'Développeur Front-end', 'Expérience en HTML, CSS, JavaScript',4,5);


INSERT INTO BesoinsEnTalent (idProfile, dateBesoin, nombreDePostes) VALUES 
(1, '2024-12-02', 2);

INSERT INTO Annonce (idProfile, idBesoinEnTalent, titre, description, dateDebut, dateFin, isAnnonce) VALUES 
(1, 1, 'Recrutement Développeur Front-end', 'Nous recherchons un développeur front-end avec expérience en frameworks modernes.', '2024-01-01', '2024-02-15', false);

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
('RC', 'RC', MD5('1234'), '123 Rue Principale', '1990-05-14', 'Française', 'RC@gmail.com', '0123456789',2);

INSERT INTO Candidat (nom, prenom, motDePasse, adresse, dateNaissance, nationalite, email, telephone, etat) VALUES 
('RATOVONANDRASANA', 'Aina Ny Antsa', MD5('1234'), '123 Rue Principale', '1990-05-14', 'Française', 'antsamadagascar@gmail.com', '0123456789',-1),
('RABE', 'Ivo kilonga', MD5('1234'),  '456 Avenue des Champs', '1985-11-23', 'Française', 'ivomihary@gmail.com', '0987654321',-1),

--test triage ats 
('RAKOTO', 'Jean', MD5('1234'), '123 Rue Principale', '1990-05-14', 'Française', 'Jean@gmail.com', '0123456789',-1),
('RABETOKOTANY', 'James', MD5('1234'),  '456 Avenue des Champs', '1985-11-23', 'Française', 'James@gmail.com', '0987654321',-1),
('ANDRIANARIVO', 'Mbola', MD5('1234'), '789 Avenue de la Liberté', '1992-07-30', 'Malagasy', 'mbola.andrianarivo@gmail.com', '0345678901', -1),
('RAZAFINDRABE', 'Liva', MD5('1234'), '101 Boulevard du 13 Mai', '1988-12-10', 'Malagasy', 'liva.razafindrabe@gmail.com', '0345987654', -1),

('RATSIMBA', 'Tahina', MD5('1234'), '15 Rue de l''Indépendance', '1994-02-20', 'Malagasy', 'tahina.ratsimba@gmail.com', '0324598765', -1),
('RAKOTOMALALA', 'Jean Claude', MD5('1234'), '34 Avenue des Fleurs', '1980-09-10', 'Malagasy', 'jeanclaude.rakotomalala@gmail.com', '0332456789', -1),
('RABELO', 'Sariaka', MD5('1234'), '56 Rue de la Mer', '1995-11-05', 'Malagasy', 'sariaka.rabelo@gmail.com', '0326598741', -1),
('RAMAROSON', 'Herizo', MD5('1234'), '78 Rue de la Paix', '1987-03-18', 'Malagasy', 'herizo.ramaroson@gmail.com', '0334589623', -1),

--test conge employes 
('MAMY', 'Dera', MD5('1234'), '12 Rue du Prince', '1991-04-11', 'Malagasy', 'dera.mamy@gmail.com', '0346798452', -1),
('RAHARAMINA', 'Fidy', MD5('1234'), '45 Boulevard des Nations', '1989-08-25', 'Malagasy', 'fidy.raharamina@gmail.com', '0321597468', -1),
('TANDROSELY', 'Rivo', MD5('1234'), '23 Rue de la Côte', '1993-06-12', 'Malagasy', 'rivo.tandroseley@gmail.com', '0387412365', -1),
('RAVO', 'Joël', MD5('1234'), '9 Rue des Arènes', '1996-01-28', 'Malagasy', 'joel.ravo@gmail.com', '0329745361', -1);


-- Insérer des données dans la table CV
INSERT INTO CV (idCandidat, isValider, dateValidation,status) VALUES 
(7, TRUE, '2024-01-05','valider'),
(8, TRUE, '2024-02-06','valider'),
(9, TRUE, '2024-02-13','valider'),
(10, TRUE, '2024-01-05','valider'),

(11, FALSE, NULL,'en_attente'),
(12, FALSE, NULL,'en_attente'),
(13, FALSE, NULL,'en_attente'),
(14, FALSE, NULL,'en_attente'),

--EMPLOYE VOAARY CV TALOHA
(15, TRUE,'2024-01-01','valider'),
(16, TRUE,'2024-02-01','valider'),
(17, TRUE, '2024-02-11','valider'),
(18, TRUE, '2024-04-21','valider');

--CANDIDATURE    
INSERT INTO Candidature (idCandidat,idAnnonce,idCV,dateCandidature,statutCandidature) VALUES
(7,1,1,'2024-01-05','accepter'),
(8,1,2,'2024-02-06','accepter'),
(9,1,3,'2024-02-13','accepter'),
(10,1,4,'2024-01-05','accepter'),

--candidature en attente
(11,1,5,'2024-02-06','en_attente'),
(12,1,6,'2024-02-13','en_attente'),
(13,1,7,'2024-02-13','en_attente'),
(14,1,8,'2024-02-13','en_attente'),

--candidature efa taloha
(15,1,9,'2024-01-05','accepter'),
(16,1,10,'2024-02-06','accepter'),
(17,1,11,'2024-02-13','accepter'),
(18,1,12,'2024-04-25','accepter');

-- Insertion des compétences
INSERT INTO Competence (idCandidat, description, niveau) VALUES
(11, 'Développement web avec JavaScript, HTML, CSS', 'Avancé'),
(12, 'Conception graphique avec Adobe Photoshop', 'Avancé'),
(13, 'Gestion de projet avec Agile/Scrum', 'Avancé'),
(14, 'Analyse de données avec Python et Pandas', 'Avancé');

-- Insertion des loisirs
INSERT INTO Loisir (idCandidat, description) VALUES
(11, 'Lecture de romans de science-fiction'),
(12, 'Voyages et découvertes culturelles'),
(13, 'Pratique du football en club'),
(14, 'Jardinage et permaculture');

-- Insertion de l'éducation
INSERT INTO Education (idCandidat, institution, diplome, anneeObtention) VALUES
(11, 'Université de Antananarivo', 'Licence en Informatique', 2020),
(11, 'Institut Supérieur de Technologie', 'Master en Développement Web', 2022),
(12, 'École Supérieure des Arts Visuels', 'Licence en Arts Graphiques', 2019),
(13, 'Université de Paris', 'MBA en Management de Projet', 2018),
(14, 'Université de Toulouse', 'Licence en Statistique et Analyse de Données', 2017);


-- Insertion des expériences professionnelles
INSERT INTO Experience (idCandidat, entreprise, poste, dateDebut, dateFin) VALUES
(11, 'Web Innovators', 'Développeur Front-End', '2020-03-01', '2020-12-31'),
(12, 'Creative Studio', 'Graphiste', '2019-06-01', '2021-08-31'),
(13, 'Innovatech Consulting', 'Chef de Projet', '2018-09-01', '2022-12-31'),
(14, 'Insight AI', 'Consultant en Intelligence Artificielle', '2020-02-01', '2023-09-30');


INSERT INTO Qualite(idProfil,idCandidat,nomQualite,experienceTechnique,experienceGenerale) VALUES 
(1,11,'Dynamique et rigorieux',2,3),
(1,12,'Bonne gestions de projet',2,3),
(1,13,'Sociable et curieux',2,5),   
(1,14,'Maitre en html',2,5);


-- Insérer des données dans la table Embauche
INSERT INTO Embauche (idCandidat, idContrat, dateDebut, dateFin, salaire, isEmbaucher,isContrat) VALUES 
(15, 2, '2024-01-05', '2024-06-05', 3000000.00, TRUE,TRUE),
(16, 2, '2024-02-06', '2024-07-01', 5000000.00, TRUE,TRUE),
(17, 2, '2024-02-13', '2024-07-01', 1000000.00, TRUE,TRUE),
(18, 2, '2024-04-25', '2024-10-01', 2000000.00, TRUE,TRUE);

INSERT INTO EvaluationCandidat (idCandidat, dateEvaluation, notes, commentaire, isEvalue) VALUES 
(7, '2024-01-15', 20, null, TRUE),
(8, '2024-01-15', 25,null, TRUE),
(9, '2024-01-15', 25,null, TRUE),
(10, '2024-01-15', 22,null, TRUE);
--(11, '2024-01-15', 26,null, TRUE),
--(12, '2024-01-15', 33,null, TRUE),
--(13, '2024-01-15', 20,null, TRUE),
--(14, '2024-02-01', 28,null, TRUE);

INSERT INTO droitConge (idEmploye,annee,totaljoursconges,joursutilises,joursrestants)
values
(15,2024,30.00,0.00,30.00),
(16,2024,30.00,0.00,30.00),
(17,2024,30.00,0.00,30.00),
(18,2024,30.00,0.00,30.00);
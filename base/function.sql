-- Fonction de calcul des droits de congés
CREATE OR REPLACE FUNCTION calculerDroitsConges(employeId INT, anneeCalcul INT DEFAULT NULL)
RETURNS NUMERIC AS $$
DECLARE 
    droitsConges NUMERIC(5,2);
    anneeEffective INT;
BEGIN
    -- Si l'année n'est pas fournie, utiliser l'année actuelle
    IF anneeCalcul IS NULL THEN
        anneeEffective := EXTRACT(YEAR FROM CURRENT_DATE);
    ELSE
        anneeEffective := anneeCalcul;
    END IF;

    -- Calcul de 2,5 jours par mois sur 12 mois (30 jours/an)
    droitsConges := 2.5 * 12;
    
    -- Insertion ou mise à jour des droits de congés
    INSERT INTO DroitConge (idEmploye, annee, totalJoursConges, joursUtilises, joursRestants)
    VALUES (employeId, anneeEffective, droitsConges, 0, droitsConges)
    ON CONFLICT (idEmploye, annee) 
    DO UPDATE SET 
        totalJoursConges = droitsConges,
        joursRestants = droitsConges - COALESCE(DroitConge.joursUtilises, 0);

    RETURN droitsConges;
END;
$$ LANGUAGE plpgsql;


-- Trigger pour calculer automatiquement les droits de congés en début d'année
CREATE OR REPLACE FUNCTION triggerCalculDroitsConges()
RETURNS TRIGGER AS $$
BEGIN
    PERFORM calculerDroitsConges(NEW.id, EXTRACT(YEAR FROM CURRENT_DATE));
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER nouveauEmployeConges
AFTER INSERT ON Employe
FOR EACH ROW
EXECUTE FUNCTION triggerCalculDroitsConges();

-- Fonction de validation de demande de congé
CREATE OR REPLACE FUNCTION validerDemandeConge(demandeId INT, idApprobateur INT)
RETURNS TEXT AS $$
DECLARE 
    v_idEmploye INT;
    v_nombreJours NUMERIC(5,2);
    v_joursRestants NUMERIC(5,2);
BEGIN
    -- Récupérer les détails de la demande
    SELECT idEmploye, nombreJours INTO v_idEmploye, v_nombreJours
    FROM DemandeConge
    WHERE id = demandeId;
    
    -- Vérifier le solde de congés disponible
    SELECT joursRestants INTO v_joursRestants
    FROM DroitConge
    WHERE idEmploye = v_idEmploye AND annee = EXTRACT(YEAR FROM CURRENT_DATE);
    
    -- Valider si assez de jours disponibles
    IF v_joursRestants >= v_nombreJours THEN
        -- Mettre à jour la demande
        UPDATE DemandeConge 
        SET statut = 'Approuvé', 
            dateApprobation = CURRENT_DATE,
            idApprobateur = $2
        WHERE id = demandeId;
        
        -- Mettre à jour le solde de congés
        UPDATE DroitConge
        SET joursUtilises = joursUtilises + v_nombreJours,
            joursRestants = joursRestants - v_nombreJours
        WHERE idEmploye = v_idEmploye AND annee = EXTRACT(YEAR FROM CURRENT_DATE);
        
        RETURN 'Demande de congé approuvée avec succès.';
    ELSE
        -- Refuser si pas assez de jours
        UPDATE DemandeConge 
        SET statut = 'Refusé'
        WHERE id = demandeId;
        
        RETURN 'Solde de congé insuffisant pour approuver la demande.';
    END IF;
END;
$$ LANGUAGE plpgsql;



DELIMITER $$

CREATE TRIGGER after_insert_annonce
AFTER INSERT ON Annonce
FOR EACH ROW
BEGIN
    
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
END$$

DELIMITER ;

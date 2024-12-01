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
            idApprobateur = idApprobateur
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


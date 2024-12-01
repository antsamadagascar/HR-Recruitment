----
--- FONCTIONNALITES I: ESPACE CANDIDAT 
----

---
-- vue pour recuperer toutes les annonces par branche
---
CREATE OR REPLACE VIEW get_all_annonce_by_id_branche AS
SELECT 
    a.id AS idAnnonce,
    a.titre,
    a.description AS descriptionAnnonce,
    a.dateDebut,
    a.dateFin,
    b.id AS idBranche,
    b.nomBranche,
    p.nomPoste,
    pr.nomProfil,
    pr.description AS descriptionProfil,
    bt.dateBesoin,
    bt.nombreDePostes
FROM 
    Annonce a
LEFT JOIN
    BesoinsEnTalent bt ON a.idbesoinentalent = bt.id
LEFT JOIN
    ProfilRequis pr ON bt.idProfile = pr.id
LEFT JOIN 
    Poste p ON pr.idPoste = p.id
LEFT JOIN
    Branche b ON p.idBranche = b.id
WHERE 
    a.isAnnonce = 'false' and bt.nombredepostes > 0;  -- ou a.isAnnonce = 0 si booléen



---
-- vue pour recuperer les listes des contrats pour un candidat specifique 
---
CREATE OR REPLACE VIEW get_all_contrat_after_embauche AS
SELECT 
    e.id AS idEmbauche,
    e.idCandidat,
    c.nom AS nomCandidat,
    c.prenom AS prenomCandidat,
    ctr.nomContrat,
    tc.typeContrat,
    e.dateDebut AS dateDebutEmbauche,
    e.dateFin AS dateFinEmbauche,
    e.salaire,
    e.isContrat
FROM 
    Embauche e
JOIN 
    Candidat c ON e.idCandidat = c.id
JOIN 
    Contrat ctr ON e.idContrat = ctr.id
JOIN 
    TypeContrat tc ON ctr.idTypeContrat = tc.id;

select * from get_all_contrat_after_embauche where idCandidat =1;
---
-- vue qui retourne les reponse apres un envoye des cv 
--
CREATE OR REPLACE VIEW get_reponse_cv AS
SELECT 
    c.id AS idCandidat,
    c.nom,
    c.prenom,
    c.email,
    cv.isValider,
    cv.dateValidation,
    CASE 
        WHEN cv.isValider AND cv.dateValidation = (
            SELECT MAX(dateValidation) 
            FROM CV 
            WHERE idCandidat = c.id
        ) 
        THEN 'Notification : CV validé'
        ELSE 'Pas de notification'
    END AS notification
FROM 
    Candidat c
LEFT JOIN 
    CV cv ON c.id = cv.idCandidat;


---
-- Vue pour Vérifier les Candidatures en Double
---
CREATE OR REPLACE VIEW get_candidature_count_per_candidat_annonce AS
SELECT 
    idCandidat,
    idAnnonce,
    COUNT(*) AS nombreCandidatures
FROM 
    Candidature
GROUP BY 
    idCandidat, idAnnonce
HAVING 
    COUNT(*) > 0;
---
-- creation fonction get_count_candidature_annonce($idCandidat,idAnnonce)=return count(candidature)
---
SELECT * FROM get_candidature_count_per_candidat_annonce WHERE idCandidat = 1 AND idAnnonce = 2;

----
-- DETAILLES CANDIDAT
---
CREATE OR REPLACE VIEW candidate_details AS
SELECT 
    c.id AS candidat_id,
    c.nom AS candidat_nom,
    c.prenom AS candidat_prenom,
    c.email AS candidat_email,
    c.telephone AS candidat_telephone,
    c.adresse AS candidat_adresse,
    c.dateNaissance AS candidat_dateNaissance,
    c.nationalite AS candidat_nationalite,
    
    -- Compétences du candidat
    comp.id AS competence_id,
    comp.description AS competence_description,
    comp.niveau AS competence_niveau,
    
    -- Expériences professionnelles du candidat
    exp.id AS experience_id,
    exp.entreprise AS experience_entreprise,
    exp.poste AS experience_poste,
    exp.dateDebut AS experience_dateDebut,
    exp.dateFin AS experience_dateFin,
    
    -- Qualités du candidat en fonction du profil
    qual.id AS qualite_id,
    qual.nomQualite AS qualite_nomQualite,
    
    -- Poste et Profil requis
    poste.id AS poste_id,
    poste.nomPoste AS poste_nomPoste,
    poste.description AS poste_description,
    
    -- Profil requis
    profil.nomProfil AS profil_nomProfil,
    profil.experienceTechnique AS profil_experienceTechnique,
    profil.experienceGenerale AS profil_experienceGenerale,

    -- Branche concernée
    branche.nomBranche AS branche_nomBranche

FROM 
    Candidat c

-- Joindre la table des compétences
LEFT JOIN Competence comp ON c.id = comp.idCandidat

-- Joindre la table des expériences professionnelles
LEFT JOIN Experience exp ON c.id = exp.idCandidat

-- Joindre la table des profils requis
LEFT JOIN ProfilRequis profil ON profil.idPoste IS NOT NULL

-- Joindre la table des qualités en fonction du profil
LEFT JOIN Qualite qual ON qual.idProfil = profil.id

-- Joindre la table des postes
LEFT JOIN Poste poste ON poste.id = profil.idPoste

-- Joindre la table des branches
LEFT JOIN Branche branche ON branche.id = poste.idBranche

WHERE c.etat < 0;

----
-- II:=============================================FONCTIONNALITES RH=========================================================
---

--
-- vue besoins en talent en attente de confirmation RH
---
CREATE or replace VIEW vue_besoins_en_talent AS
SELECT
    bt.id AS besoin_id,
    bt.dateBesoin,
    bt.nombreDePostes,
    bt.isdemande,
    bt.status,  -- Ajout du champ 'status'
    pr.nomProfil,
    pr.description AS profil_description,
    pr.experienceTechnique,
    pr.experienceGenerale,
    p.nomPoste,
    p.description AS poste_description,
    b.nomBranche
FROM
    BesoinsEnTalent bt
JOIN ProfilRequis pr ON pr.id = bt.idProfile
JOIN Poste p ON p.id = pr.idPoste
JOIN Branche b ON b.id = p.idBranche
WHERE
    bt.isdemande = FALSE
    AND bt.status = 0;  -- Filtrer uniquement les demandes en attente

---
-- BESOINS EN TALENT VALIDER PAR RH
---
CREATE OR REPLACE VIEW vue_besoins_en_talent_valider AS
SELECT
    bt.id AS besoin_id,
    bt.dateBesoin,
    bt.nombreDePostes,
    bt.isdemande,
    bt.status,
    pr.nomProfil,
    pr.description AS profil_description,
    pr.experienceTechnique,
    pr.experienceGenerale,
    p.nomPoste,
    p.description AS poste_description,
    b.nomBranche
FROM
    BesoinsEnTalent bt
    JOIN ProfilRequis pr ON pr.id = bt.idProfile
    JOIN Poste p ON p.id = pr.idPoste
    JOIN Branche b ON b.id = p.idBranche
    WHERE
        bt.isdemande = true
        AND bt.status = 1
        AND NOT EXISTS (
            SELECT 1
            FROM Annonce a
            WHERE a.idBesoinEnTalent = bt.id -- Exclure si une annonce est liée à ce besoin
        );

---
-- profil requis (ilay tedaviny entreprise)
--- 
CREATE OR REPLACE VIEW ProfilRequisEntreprise AS
SELECT 
    pr.id AS profil_id,
    pr.nomProfil AS profil_requis,
    pr.description AS description_profil,
    pr.experienceTechnique AS experience_technique_requise,
    pr.experienceGenerale AS experience_generale_requise,
    q.nomQualite AS qualite_requise,
    q.experienceTechnique AS qualite_experience_technique,
    q.experienceGenerale AS qualite_experience_generale,
    post.nomPoste AS poste_occupation,
    post.description AS poste_description,
    b.nomBranche AS branche_nom,
    --bt.dateBesoin AS date_besoin_talent,
    bt.nombreDePostes AS nombre_postes
   -- bt.status AS status_besoin
FROM ProfilRequis pr
 JOIN Qualite q ON pr.id = q.idProfil
 JOIN Poste post ON pr.idPoste = post.id
 JOIN Branche b ON post.idBranche = b.id
 JOIN BesoinsEnTalent bt ON pr.id = bt.idProfile
WHERE bt.nombreDePostes >0
;


---
-- profil candidats en cours de validation
---
CREATE OR REPLACE VIEW ProfilCandidats AS
SELECT 
    c.id AS candidat_id,
    c.nom AS nom_candidat,
    c.prenom AS prenom_candidat,
    STRING_AGG(DISTINCT q.nomQualite, ', ') AS qualite_requise,
    MAX(q.experienceTechnique) AS qualite_experience_technique,
    MAX(q.experienceGenerale) AS qualite_experience_generale,
    STRING_AGG(DISTINCT com.description, ', ') AS competence_description,
    STRING_AGG(DISTINCT com.niveau, ', ') AS competence_niveau,
    MAX(pr.nomProfil) AS profil_requis,
    MAX(cand.statutCandidature) AS statutCandidature
FROM Candidat c
LEFT JOIN CV cv ON c.id = cv.idCandidat
LEFT JOIN Competence com ON c.id = com.idCandidat
LEFT JOIN Candidature cand ON c.id = cand.idCandidat
LEFT JOIN Annonce an ON cand.idAnnonce = an.id
LEFT JOIN BesoinsEnTalent bt ON an.idBesoinEnTalent = bt.id
LEFT JOIN ProfilRequis pr ON pr.id = bt.idProfile
LEFT JOIN Qualite q ON q.idProfil = pr.id
WHERE c.etat < 0
GROUP BY 
    c.id,
    c.nom,
    c.prenom;

--CREATE OR REPLACE VIEW ProfilCandidats AS
SELECT 
    c.id AS candidat_id,
    c.nom AS nom_candidat,
    c.prenom AS prenom_candidat,
	cand.statutCandidature,

    -- Agrégation des qualités distinctes pour le candidat
    STRING_AGG(DISTINCT q.nomQualite, ', ') AS qualites_requises,
    
    -- Récupération des niveaux d'expérience maximum en technique et général pour chaque candidat
    COALESCE(MAX(q.experienceTechnique), 0) AS qualite_experience_technique,
    COALESCE(MAX(q.experienceGenerale), 0) AS qualite_experience_generale,
STRING_AGG(DISTINCT com.description, ', ') AS competence_description,
    STRING_AGG(DISTINCT com.niveau, ', ') AS competence_niveau,
    -- Agrégation des compétences du candidat avec leurs niveaux correspondants
    STRING_AGG(DISTINCT com.description || ' (' || com.niveau || ')', ', ') AS competences,

    -- Récupération du profil requis pour le candidat
    MAX(pr.nomProfil) AS profil_requis,

    -- Statut de la candidature
    MAX(cand.statutCandidature) AS statut_candidature

FROM Candidat c
LEFT JOIN CV cv ON c.id = cv.idCandidat
LEFT JOIN Competence com ON c.id = com.idCandidat
LEFT JOIN Candidature cand ON c.id = cand.idCandidat
LEFT JOIN Annonce an ON cand.idAnnonce = an.id
LEFT JOIN BesoinsEnTalent bt ON an.idBesoinEnTalent = bt.id
LEFT JOIN ProfilRequis pr ON pr.id = bt.idProfile
LEFT JOIN Qualite q ON q.idProfil = pr.id AND q.idCandidat = c.id

WHERE c.etat < 0 -- Filtrage des candidats inactifs
GROUP BY 
    c.id,
    c.nom,
    c.prenom,
	cand.statutcandidature;

---
-- cv candidat valider
---
CREATE OR REPLACE VIEW profil_candidats_valides AS
WITH candidats_valides AS (
    SELECT DISTINCT c.id
    FROM Candidat c
    INNER JOIN CV cv ON cv.idCandidat = c.id
    INNER JOIN Candidature cand ON cand.idCandidat = c.id
    WHERE cand.statutCandidature = 'accepter'
      AND cv.isValider = false
      AND cv.dateValidation IS NULL
)
SELECT 
    c.id AS candidat_id,
    c.nom AS nom_candidat,
    c.prenom AS prenom_candidat,
    STRING_AGG(DISTINCT q.nomQualite, ', ') AS qualite_requise,
    MAX(q.experienceTechnique) AS qualite_experience_technique,
    MAX(q.experienceGenerale) AS qualite_experience_generale,
    STRING_AGG(DISTINCT comp.description, ', ') AS competence_description,
    STRING_AGG(DISTINCT comp.niveau, ', ') AS competence_niveau,
    MAX(pr.nomProfil) AS profil_requis,
    MAX(cand.statutCandidature) AS statutcandidature,
    cv.isValider,
    cv.dateValidation
FROM Candidat c
INNER JOIN CV cv ON cv.idCandidat = c.id
LEFT JOIN Competence comp ON comp.idCandidat = c.id
LEFT JOIN Candidature cand ON cand.idCandidat = c.id
LEFT JOIN Annonce an ON cand.idAnnonce = an.id
LEFT JOIN BesoinsEnTalent bt ON an.idBesoinEnTalent = bt.id
LEFT JOIN ProfilRequis pr ON pr.id = bt.idProfile
LEFT JOIN Qualite q ON q.idProfil = pr.id
WHERE c.id IN (SELECT id FROM candidats_valides)
GROUP BY c.id, c.nom, c.prenom, cv.isValider, cv.dateValidation;



---
-- RE TRIAGE NOTE EVALUATION CANDIDAT
---

CREATE OR REPLACE VIEW VueEvaluationCandidats AS
SELECT 
e.id,
e.isvalide,
C.nom, C.prenom, E.dateEvaluation, E.notes
FROM Candidat C
JOIN EvaluationCandidat E ON C.id = E.idCandidat
WHERE E.isEvalue = TRUE and E.isvalide =false
ORDER BY E.notes DESC;


---
-- vue candidats valider apres evaluation candidat en cours d'Embauche
--- 
CREATE OR REPLACE VIEW VueCandidatsValidesSansEmbauche AS
SELECT 
    c.id AS idCandidat,
    c.nom AS NomCandidat,
    c.prenom AS PrenomCandidat
FROM 
    Candidat c
JOIN 
    EvaluationCandidat e ON e.idCandidat = c.id
LEFT JOIN 
    Embauche em ON em.idCandidat = c.id
WHERE 
    e.isValide = TRUE
    AND em.idCandidat IS NULL;


---
-- Liste congees En Attente
---
CREATE OR REPLACE VIEW v_demande_conge AS
SELECT 
    dc.id,
    dc.idemploye,
    c.nom AS nomemploye,
    c.prenom AS prenomemploye,
    dc.idtypeconge,
    tc.nom AS typeconge,
    dc.datedebut,
    dc.datefin,
    dc.nombrejours,
    dc.statut,
    dc.motif,
    dc.datedemande,
    dc.dateapprobation,
    dc.idApprobateur
FROM 
    demandeconge dc
JOIN 
    candidat c ON dc.idemploye = c.id
JOIN 
    typeconge tc ON dc.idtypeconge = tc.id
WHERE statut = 'En attente' 
ORDER BY 
    dc.datedemande DESC;

---
-- Liste suivi congees employes 
---
CREATE OR REPLACE VIEW v_suivi_conge_employes AS
SELECT 
    e.id AS employe_id,
    e.nom AS nom_employe,
    e.prenom AS prenom_employe,
    tc.nom AS type_conge,
    dc.annee,
    dc.totalJoursConges AS total_jours_alloues,
    dc.joursUtilises AS jours_utilises,
   dc.joursRestants AS jours_restants,
    COALESCE(SUM(dem.nombreJours), 0) AS total_jours_pris,
    (dc.totalJoursConges  - COALESCE(SUM(dem.nombreJours), 0)) AS solde_final,
    MAX(dem.dateFin) AS derniere_date_conge 
FROM 
    Candidat e
JOIN 
    DroitConge dc ON e.id = dc.idEmploye
LEFT JOIN 
    DemandeConge dem ON e.id = dem.idEmploye 
    AND dc.annee = EXTRACT(YEAR FROM dem.dateDebut) 
LEFT JOIN 
    TypeConge tc ON dem.idTypeConge = tc.id
WHERE dem.statut = 'Approuvé' AND dem.idApprobateur IS NOT NULL
GROUP BY 
    e.id, e.nom, e.prenom, tc.nom, dc.annee, dc.totalJoursConges, dc.joursUtilises, dc.joursRestants
ORDER BY 
    e.nom, e.prenom, dc.annee DESC;



---
-- check candidat isEmployer
---
CREATE OR REPLACE VIEW CheckIsEmploye AS
SELECT 
    C.id AS idCandidat,
    C.nom,
    C.prenom,
    C.email,
    E.dateDebut,
    E.dateFin,
    TC.typeContrat,
    CO.nomContrat,
    CO.duree
FROM 
    Candidat C
JOIN 
    Embauche E ON C.id = E.idCandidat
JOIN 
    Contrat CO ON E.idContrat = CO.id
JOIN 
    TypeContrat TC ON CO.idTypeContrat = TC.id
WHERE 
    E.isEmbaucher = TRUE;
---
-- check cv valider (valdier,true)
---
CREATE OR REPLACE VIEW CheckCvValideEtNonEmbauche AS
SELECT 
    c.id AS idCandidat,
    c.nom AS nomCandidat,
    cv.isValider,
    COALESCE(e.isEmbaucher, FALSE) AS isEmbaucher
FROM 
    Candidat c
LEFT JOIN 
    CV cv ON c.id = cv.idCandidat
LEFT JOIN 
    Embauche e ON c.id = e.idCandidat
WHERE 
    cv.isValider = TRUE  AND cv.status = 'valider'
    AND (e.isEmbaucher = FALSE OR e.isEmbaucher IS NULL); -- Le candidat n'est pas encore embauché


---
-- Listes employe
---
    CREATE OR REPLACE VIEW V_listes_employe AS
    SELECT 
        C.id AS idCandidat,
        C.nom,
        C.prenom,
        C.email,
        E.dateDebut,
        E.dateFin,
        TC.typeContrat,
        CO.nomContrat,
        CO.duree
    FROM 
        Candidat C
    JOIN 
        Embauche E ON C.id = E.idCandidat
    JOIN 
        Contrat CO ON E.idContrat = CO.id
    JOIN 
        TypeContrat TC ON CO.idTypeContrat = TC.id
    WHERE 
        E.isEmbaucher = TRUE AND ISCONTRAT = TRUE;
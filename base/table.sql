    -- Table des candidats
    CREATE TABLE Candidat (
        id SERIAL PRIMARY KEY,
        nom VARCHAR(50) NOT NULL,
        prenom VARCHAR(50) NOT NULL,
        motDePasse VARCHAR(255),
        adresse TEXT,
        dateNaissance DATE,
        nationalite VARCHAR(50),
        email VARCHAR(100),
        telephone VARCHAR(20),
        etat INT,
        test_entretien_termine BOOLEAN DEFAULT FALSE
    );

    ALTER TABLE candidat ADD COLUMN test_entretien_termine BOOLEAN DEFAULT FALSE;


    -- Table des CVs (résumé de chaque candidat)
    CREATE TABLE CV (
        id SERIAL PRIMARY KEY,
        idCandidat INT REFERENCES Candidat(id) ON DELETE CASCADE,
        isValider BOOLEAN DEFAULT FALSE,
        dateValidation DATE,
        status VARCHAR(10) DEFAULT 'en_attente'
    );

    -- Table des compétences
    CREATE TABLE Competence (
        id SERIAL PRIMARY KEY,
        idCandidat INT REFERENCES Candidat(id) ON DELETE CASCADE,
        description TEXT,
        niveau VARCHAR(50)
    );

    -- Table des loisirs
    CREATE TABLE Loisir (
        id SERIAL PRIMARY KEY,
        idCandidat INT REFERENCES Candidat(id) ON DELETE CASCADE,
        description TEXT
    );

    -- Table de l'éducation
    CREATE TABLE Education (
        id SERIAL PRIMARY KEY,
        idCandidat INT REFERENCES Candidat(id) ON DELETE CASCADE,
        institution VARCHAR(100),
        diplome VARCHAR(100),
        anneeObtention int
    );

    -- Table des expériences professionnelles
    CREATE TABLE Experience (
        id SERIAL PRIMARY KEY,
        idCandidat INT REFERENCES Candidat(id) ON DELETE CASCADE,
        entreprise VARCHAR(100),
        poste VARCHAR(100),
        dateDebut DATE,
        dateFin DATE
    );

    -- Table des types de contrat
    CREATE TABLE TypeContrat (
        id SERIAL PRIMARY KEY,
        typeContrat VARCHAR(50) NOT NULL,
        description TEXT
    );

    -- Table des contrats
    CREATE TABLE Contrat (
        id SERIAL PRIMARY KEY,
        nomContrat VARCHAR(50) NOT NULL,
        idTypeContrat INT REFERENCES TypeContrat(id),
        duree INT CHECK (duree >0) 
    );

    -- Table des branches
    CREATE TABLE Branche (
        id SERIAL PRIMARY KEY,
        nomBranche VARCHAR(50) NOT NULL
    );

    -- Table des postes
    CREATE TABLE Poste (
        id SERIAL PRIMARY KEY,
        idBranche INT REFERENCES Branche(id) ON DELETE SET NULL,
        nomPoste VARCHAR(50) NOT NULL,
        description TEXT
    );

    -- Table des profils requis
    CREATE TABLE ProfilRequis (
        id SERIAL PRIMARY KEY,
        idPoste INT REFERENCES Poste(id) ON DELETE CASCADE,
        nomProfil TYPE VARCHAR(255);
        description TEXT,
        experienceTechnique INT,
        experienceGenerale INT
    );


    -- Table des qualités requises pour chaque profil
    CREATE TABLE Qualite (
        id SERIAL PRIMARY KEY,
        idProfil INT REFERENCES ProfilRequis(id) ON DELETE CASCADE,
        idCandidat INT REFERENCES Candidat(id) ON DELETE CASCADE,
        nomQualite VARCHAR(255),
        experienceTechnique INT,
        experienceGenerale INT
    );

    -- Table des besoins en talents
    CREATE TABLE BesoinsEnTalent (
        id SERIAL PRIMARY KEY,
        idProfile INT REFERENCES ProfilRequis(id) ON DELETE CASCADE,
        dateBesoin DATE NOT NULL,
        nombreDePostes INT DEFAULT 1 CHECK (nombreDePostes >= 0),
        isdemande BOOLEAN DEFAULT FALSE,
        status VARCHAR(20) DEFAULT 'en_attente' 
        );

    -- Table des annonces d'emploi
    CREATE TABLE Annonce (
        id SERIAL PRIMARY KEY,
        idProfile INT REFERENCES ProfilRequis(id) ON DELETE SET NULL,
        idBesoinEnTalent INT REFERENCES BesoinsEnTalent(id) ON DELETE SET NULL,
        titre VARCHAR(100),
        description TEXT,
        dateDebut DATE,
        dateFin DATE,
        isAnnonce BOOLEAN  DEFAULT FALSE
    );

    -- Table d'évaluation des candidats
    CREATE TABLE EvaluationCandidat (
        id SERIAL PRIMARY KEY,
        idCandidat INT REFERENCES Candidat(id) ON DELETE CASCADE,
        dateEvaluation DATE NOT NULL,
        notes NUMERIC(3, 2) CHECK (notes >= 0 AND notes <= 100),
        commentaire TEXT,
        isEvalue BOOLEAN DEFAULT FALSE,
        isValide BOOLEAN DEFAULT FALSE 
    );

    -- Table des embauches
    CREATE TABLE Embauche (
        id SERIAL PRIMARY KEY,
        idCandidat INT REFERENCES Candidat(id) ON DELETE CASCADE,
        idContrat INT REFERENCES Contrat(id) ON DELETE SET NULL,
        dateDebut DATE,
        dateFin DATE,
        salaire NUMERIC(10, 2) CHECK (salaire >= 0),
        isEmbaucher BOOLEAN DEFAULT FALSE,
        isContrat BOOLEAN DEFAULT FALSE 
    );


    CREATE TABLE Candidature (
        id SERIAL PRIMARY KEY,
        idCandidat INT REFERENCES Candidat(id) ON DELETE CASCADE,
        idAnnonce INT REFERENCES Annonce(id) ON DELETE CASCADE,
        idCV INT REFERENCES CV(id) ON DELETE CASCADE,
        dateCandidature DATE NOT NULL DEFAULT CURRENT_DATE,
        statutCandidature VARCHAR(50) DEFAULT 'en_attente',
        UNIQUE (idCandidat, idAnnonce) 
    );
    
    CREATE TABLE Notifications(
        id SERIAL PRIMARY KEY,
        idCandidat INT REFERENCES Candidat(id) ON DELETE CASCADE,
        message TEXT,
        dateNotification TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        isLue BOOLEAN DEFAULT FALSE
    );


    CREATE TABLE TypeConge (
        id SERIAL PRIMARY KEY,
        nom VARCHAR(50) NOT NULL, 
        description TEXT,
        dureeMaximale INT,
        estPaye BOOLEAN DEFAULT TRUE
    );

    CREATE TABLE DroitConge (
        id SERIAL PRIMARY KEY,
        idEmploye INT REFERENCES Candidat(id),
        annee INT,
        totalJoursConges NUMERIC(5,2), -- 2,5 jours/mois
        joursUtilises NUMERIC(5,2),
        joursRestants NUMERIC(5,2),
        dateCalcul DATE DEFAULT CURRENT_DATE
    );

        -- Ajouter une contrainte UNIQUE sur (idEmploye, annee)
    ALTER TABLE DroitConge
    ADD CONSTRAINT unique_droitconge_employe_annee UNIQUE (idEmploye, annee);


    CREATE TABLE DemandeConge (
        id SERIAL PRIMARY KEY,
        idEmploye INT REFERENCES Candidat(id),
        idTypeConge INT REFERENCES TypeConge(id),
        dateDebut DATE,
        dateFin DATE,
        nombreJours NUMERIC(5,2),
        statut VARCHAR(20) DEFAULT 'En attente', 
        motif TEXT,
        datedemande DATE DEFAULT CURRENT_DATE,
        dateApprobation DATE,
        idapprobateur INT 
    );
    
    CREATE TABLE FicheDePaie (
        id SERIAL PRIMARY KEY,
        idEmploye INT REFERENCES Candidat(id) ON DELETE CASCADE,
        annee INT NOT NULL,
        mois INT NOT NULL,
        salaireBrut NUMERIC(10, 2) CHECK (salaireBrut >= 0),
        cotisations NUMERIC(10, 2) CHECK (cotisations >= 0),
        salaireNet NUMERIC(10, 2) CHECK (salaireNet >= 0),
        primes NUMERIC(10, 2) DEFAULT 0,
        heuresSupplementaires NUMERIC(10, 2) DEFAULT 0,
        joursCongesPayes NUMERIC(5, 2) DEFAULT 0,
        dateGeneration TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);


--
--liste besoins en talent
--
create or replace view v_besoinsEnTalent as
select 
bt.id,
p.id as idprofile,
p.nomprofil,
bt.datebesoin,
bt.nombredepostes 
from besoinsEnTalent as bt 
join profilrequis as p on p.id=bt.idprofile

---
--liste poste
--
create or replace view v_poste as
select 
p.id,
b.nombranche,
p.nomposte,
p.description
from poste as p
join branche as b on b.id = p.idbranche

---
--liste profil requis
--
create or replace view  v_profilRequis as
select 
pr.id,pr.idposte,p.nomposte,pr.nomprofil,pr.description,pr.experiencetechnique,
pr.experiencegenerale 
from profilrequis as pr join poste as p
on p.id = pr.idposte;

---
-- liste annonces
---
create or replace view v_annonces as
select 
a.id as annonce_id,
p.nomprofil,
b.id,
a.titre as annonce_titre,
a.description,
a.datedebut as annonce_date_debut,
a.datefin
from annonce as a Left join profilrequis as p on p.id = a.idprofile
Left join besoinsEnTalent as b on b.id=a.idBesoinEnTalent
where a.isAnnonce IS FALSE ;
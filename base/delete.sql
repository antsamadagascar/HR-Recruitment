-- Désactivation des contraintes de clé étrangère
SET session_replication_role = replica;

-- Suppression des données dans les tables
TRUNCATE TABLE Candidature,
 Notifications, 
 Embauche, 
 EvaluationCandidat, 
 Annonce, 
 BesoinsEnTalent, 
 ProfilRequis, 
 Qualite, 
 Poste, 
 Branche, 
 Contrat, 
 TypeContrat, 
 Experience, 
 Education, 
 Loisir, 
 Competence, 
 CV, 
 Candidat ,
 DroitConge,
 DemandeConge

 RESTART IDENTITY CASCADE;

-- Réactivation des contraintes de clé étrangère
SET session_replication_role = DEFAULT;

DROP DATABASE IF EXISTS login;
CREATE DATABASE login;
USE login;

CREATE TABLE utilisateur (
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    email VARCHAR(255),
    username VARCHAR(255),
    mot_de_passe VARCHAR(255)
    role 
);

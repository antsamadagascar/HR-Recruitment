DROP DATABASE IF EXISTS login;
CREATE DATABASE login;
USE login;

CREATE TABLE type_centre(
    id_type_centre int PRIMARY KEY auto_increment,
    nom varchar(255)
);

CREATE TABLE centre(
    id_centre int PRIMARY KEY auto_increment,
    id_type_centre int,
    nom varchar(255),
    FOREIGN KEY(id_type_centre) REFERENCES type_centre(id_type_centre) ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE metier (
    id_metier INT PRIMARY KEY AUTO_INCREMENT,
    id_centre INT,
    nom VARCHAR(255),
    is_vampire BOOLEAN,
    FOREIGN KEY (id_centre) REFERENCES centre (id_centre) ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE utilisateur (
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    email VARCHAR(255),
    username VARCHAR(255),
    mot_de_passe VARCHAR(255),
    
);

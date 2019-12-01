/* Create database */
DROP DATABASE IF EXISTS techstore;

create database techstore;

USE techstore;

/* Create table user*/

DROP TABLE IF EXISTS user;

CREATE TABLE techstore.user (
	id_user INT NOT NULL AUTO_INCREMENT ,
	time_access DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	adress_ip VARCHAR(15) NOT NULL ,
	type_user VARCHAR(11) NOT NULL,
	PRIMARY KEY (id_user)
	);


/* Create table visiteur*/
DROP TABLE IF EXISTS visiteur;

CREATE TABLE techstore.visiteur (
	id_visiteur INT NOT NULL,
	PRIMARY KEY (id_visiteur)
	);

/* Create table annonceur*/
DROP TABLE IF EXISTS annonceur;

CREATE TABLE techstore.annonceur (
	id_annonceur INT NOT NULL,
	login VARCHAR(20) NOT NULL,
	password VARCHAR(30) NOT NULL,
	mail VARCHAR(50) NOT NULL,
	nom VARCHAR(30) NOT NULL,
	prenom VARCHAR(40) NOT NULL,
	ville VARCHAR(80) NOT NULL,
	telephone VARCHAR(10) NOT NULL,
	annonceur_photo BLOB ,
	PRIMARY KEY (id_annonceur)
);

/* Create table produit */
DROP TABLE IF EXISTS produit;

CREATE TABLE techstore.produit (
	id_produit INT NOT NULL  AUTO_INCREMENT,
	marque VARCHAR(50) NOT NULL,
	modele VARCHAR(20) NOT NULL,
	poids DECIMAL(6,2),
	etat VARCHAR(10) NOT NULL,
	categorie VARCHAR(30) NOT NULL,
	PRIMARY KEY(id_produit)
);

/* Create table annonce */
DROP TABLE IF EXISTS annonce;

CREATE TABLE techstore.annonce (
	id_annonce INT NOT NULL AUTO_INCREMENT,
	titre_annonce VARCHAR(80) NOT NULL,
	prix DECIMAL(8,2) NOT NULL,
	ville VARCHAR(80) NOT NULL,
	type_annonce VARCHAR(10) NOT NULL,
	time_pub DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	id_annonceur INT NOT NULL,
	id_produit INT NOT NULL,
	PRIMARY KEY(id_annonce)
);

/* Create table consulter */
DROP TABLE IF EXISTS consulter;

CREATE TABLE techstore.consulter(
	id_user INT NOT NULL,
	id_annonce INT NOT NULL,
	date_consultation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id_user,id_annonce)
);

/* Create table publier */
DROP TABLE IF EXISTS publier;

CREATE TABLE techstore.publier(
	id_annonceur INT NOT NULL,
	id_annonce INT NOT NULL,
	date_publication DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id_annonceur,id_annonce)
);

/* Create table photo*/
DROP TABLE IF EXISTS photo;

CREATE TABLE techstore.photo(
	id_photo INT NOT NULL AUTO_INCREMENT,
	id_annonce INT NOT NULL,
	photo BLOB NOT NULL,
	PRIMARY KEY (id_photo)
);

/* Create table PC */
DROP TABLE IF EXISTS pc;

CREATE TABLE techstore.pc(
	id_produit INT NOT NULL,
	diagonale DECIMAL(3,1) NOT NULL,
	processeur VARCHAR(80) NOT NULL,
	c_g VARCHAR(80) NOT NULL,
	ram INT NOT NULL,
	type_disque VARCHAR(10) NOT NULL,
	taille_disque INT NOT NULL,
	batterie VARCHAR(80),
	PRIMARY KEY (id_produit)
);

/* Create table TV */
DROP TABLE IF EXISTS tv;

CREATE TABLE techstore.tv(
	id_produit INT NOT NULL,
	diagonale DECIMAL(3,1) NOT NULL,
	definition VARCHAR(20),
	tech VARCHAR(20),
	os VARCHAR(20),
	connectique VARCHAR(20),
	PRIMARY KEY (id_produit)
);

/* Create table telephonie*/
DROP TABLE IF EXISTS telephonie;

CREATE TABLE techstore.telephonie(
	id_produit INT NOT NULL,
	diagonale DECIMAL(3,1) NOT NULL,
	processeur VARCHAR(80) NOT NULL,
	ram INT NOT NULL,
	taille_disque INT NOT NULL,
	os VARCHAR(20),
	batterie VARCHAR(80),
	nb_sim INT ,
	type_sim VARCHAR(15),
	res_app_arr DECIMAL(3,1) NOT NULL,
	res_app_av DECIMAL(3,1),
	nfc INT NOT NULL,
	PRIMARY KEY (id_produit)
);


/* Create table app photo*/
DROP TABLE IF EXISTS app_photo;

CREATE TABLE techstore.app_photo(
	id_produit INT NOT NULL,
	resolution DECIMAL(4,1) NOT NULL,
	format_cap VARCHAR(10), 
	definition VARCHAR(20),
	type_memoire VARCHAR(20) NOT NULL,
	type_ecran VARCHAR(20) NOT NULL,
	tech VARCHAR(10),
	PRIMARY KEY (id_produit)
);

/* Create table accesoires */
DROP TABLE IF EXISTS accesoires;

CREATE TABLE techstore.accesoires(
	id_produit INT NOT NULL,
	PRIMARY KEY (id_produit)
	);


/*  
 * Contraintes des clés étrangères	 
 */
ALTER TABLE  accesoires 
  ADD CONSTRAINT  accesoires_fk_produit FOREIGN KEY ( id_produit ) REFERENCES  produit  ( id_produit );

--
-- Contraintes pour la table  annonce 
--
ALTER TABLE  annonce 
  ADD CONSTRAINT  annonce_fk_annonceur  FOREIGN KEY ( id_annonceur ) REFERENCES  annonceur  ( id_annonceur ),
  ADD CONSTRAINT  annonce_fk_produit  FOREIGN KEY ( id_produit ) REFERENCES  produit  ( id_produit );

--
-- Contraintes pour la table  annonceur 
--
ALTER TABLE  annonceur 
  ADD CONSTRAINT  annonceur_fk_user  FOREIGN KEY ( id_annonceur ) REFERENCES  user  ( id_user );

--
-- Contraintes pour la table  app_photo 
--
ALTER TABLE  app_photo 
  ADD CONSTRAINT  app_photo_fk_produit  FOREIGN KEY ( id_produit ) REFERENCES  produit  ( id_produit );

--
-- Contraintes pour la table  consulter 
--
ALTER TABLE  consulter 
  ADD CONSTRAINT  consulter_fk_user  FOREIGN KEY ( id_user ) REFERENCES  user  ( id_user ),
  ADD CONSTRAINT  consulter_fk_annonce  FOREIGN KEY ( id_annonce ) REFERENCES  annonce  ( id_annonce );

--
-- Contraintes pour la table  pc 
--
ALTER TABLE  pc 
  ADD CONSTRAINT  pc_fk_produit  FOREIGN KEY ( id_produit ) REFERENCES  produit  ( id_produit );

--
-- Contraintes pour la table  photo 
--
ALTER TABLE  photo 
  ADD CONSTRAINT  photo_fk_annonce  FOREIGN KEY ( id_annonce ) REFERENCES  annonce  ( id_annonce );

--
-- Contraintes pour la table  publier 
--
ALTER TABLE  publier 
  ADD CONSTRAINT  publier_fk_annonceur  FOREIGN KEY ( id_annonceur ) REFERENCES  annonceur  ( id_annonceur ),
  ADD CONSTRAINT  publier_fk_annonce  FOREIGN KEY ( id_annonce ) REFERENCES  annonce  ( id_annonce );

--
-- Contraintes pour la table  telephonie 
--
ALTER TABLE  telephonie 
  ADD CONSTRAINT  telephonie_fk_produit  FOREIGN KEY ( id_produit ) REFERENCES  produit  ( id_produit );

--
-- Contraintes pour la table  tv 
--
ALTER TABLE  tv 
  ADD CONSTRAINT  tv_fk_produit  FOREIGN KEY ( id_produit ) REFERENCES  produit  ( id_produit );

--
-- Contraintes pour la table  visiteur 
--
ALTER TABLE  visiteur 
  ADD CONSTRAINT  visiteur_fk_user  FOREIGN KEY ( id_visiteur ) REFERENCES  user  ( id_user );




/* Création des views */

/* Create view visiteur*/
DROP VIEW IF EXISTS v_visiteur;

CREATE VIEW v_visiteur AS (
	SELECT id_visiteur, time_access, adress_ip 
    FROM user u , visiteur v
    WHERE u.id_user = v.id_visiteur

);


/* Create view annonceur*/
DROP VIEW IF EXISTS v_annonceur;

CREATE VIEW v_annonceur AS (
	SELECT  id_annonceur,time_access,adress_ip,
			mail,nom,prenom,ville,
			telephone,annonceur_photo
	FROM user u , annonceur a
    WHERE u.id_user = a.id_annonceur
   );

/* Create view  PC*/
DROP VIEW IF EXISTS v_pc;

CREATE VIEW v_pc AS (
	SELECT p.id_produit, marque, modele, poids, etat
    		diagonale,processeur,c_g,ram,type_disque,taille_disque,batterie
    FROM produit p, pc
	WHERE p.id_produit = pc.id_produit
);

/* Create view telephonie */
DROP VIEW IF EXISTS v_telephonie;

CREATE VIEW v_telephonie AS (
	SELECT p.id_produit, marque, modele, poids, etat
    		diagonale,processeur,ram,taille_disque,os,batterie,
    		nb_sim,type_sim,res_app_arr,res_app_av, nfc
    FROM produit p, telephonie t
	WHERE p.id_produit = t.id_produit
);

/* Create view TV*/
DROP VIEW IF EXISTS v_tv;

CREATE VIEW v_tv AS (
	SELECT p.id_produit, marque, modele, poids, etat
    		diagonale,definition,tech,os,connectique
    FROM produit p, tv
	WHERE p.id_produit = tv.id_produit
);

/* Create view  APP PHOTO*/
DROP VIEW IF EXISTS v_app_photo;

CREATE VIEW v_app_photo AS (
	SELECT p.id_produit, marque, modele, poids, etat
    		resolution,format_cap,definition,type_memoire,type_ecran,tech
    FROM produit p, app_photo ap
	WHERE p.id_produit = ap.id_produit
);

/* Create view accesoires */

DROP VIEW IF EXISTS v_acc;

CREATE VIEW v_acc AS (
	SELECT p.id_produit, marque, modele, poids, etat
    FROM produit p, app_photo ap
	WHERE p.id_produit = ap.id_produit
);

/* Gestion des droits */

/* Visiteur */
DROP USER IF EXISTS 'visiteur'@'localhost';

CREATE USER 'visiteur'@'localhost' IDENTIFIED BY 'password';
GRANT SELECT ON  techstore.v_acc TO 'visiteur'@'localhost';
GRANT SELECT ON  techstore.v_annonceur TO 'visiteur'@'localhost';
GRANT SELECT ON  techstore.v_app_photo TO 'visiteur'@'localhost';
GRANT SELECT ON  techstore.v_pc TO 'visiteur'@'localhost';
GRANT SELECT ON  techstore.v_telephonie TO 'visiteur'@'localhost';
GRANT SELECT ON  techstore.v_tv TO 'visiteur'@'localhost';
GRANT SELECT ON  techstore.annonce TO 'visiteur'@'localhost';
GRANT SELECT ON  techstore.photo TO 'visiteur'@'localhost';
GRANT SELECT ON  techstore.publier TO 'visiteur'@'localhost';
GRANT SELECT ON  techstore.consulter TO 'visiteur'@'localhost';
FLUSH PRIVILEGES;

/* Administrateur */
DROP USER IF EXISTS 'admin'@'localhost';

CREATE USER 'admin'@'localhost' IDENTIFIED BY 'password';
GRANT ALL ON  techstore.* TO 'admin'@'localhost';
FLUSH PRIVILEGES;

/* Annonceur */
DROP USER IF EXISTS 'annonceur'@'localhost';

CREATE USER 'annonceur'@'localhost' IDENTIFIED BY 'password';

GRANT SELECT ON  techstore.v_acc TO 'annonceur'@'localhost';
GRANT SELECT ON  techstore.v_annonceur TO 'annonceur'@'localhost';
GRANT SELECT ON  techstore.v_app_photo TO 'annonceur'@'localhost';
GRANT SELECT ON  techstore.v_pc TO 'annonceur'@'localhost';
GRANT SELECT ON  techstore.v_telephonie TO 'annonceur'@'localhost';
GRANT SELECT ON  techstore.v_tv TO 'annonceur'@'localhost';
GRANT SELECT, INSERT,UPDATE ON  techstore.annonce TO 'annonceur'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON  techstore.photo TO 'annonceur'@'localhost';
GRANT SELECT ON  techstore.publier TO 'annonceur'@'localhost';
GRANT SELECT ON  techstore.consulter TO 'annonceur'@'localhost';

FLUSH PRIVILEGES;

/* Insertion */

/* User */
INSERT INTO `user` (`id_user`, `time_access`, `adress_ip`, `type_user`) 
			VALUES (NULL, CURRENT_TIME(), '192.168.1.11', 'Visiteur'),
					(NULL, CURRENT_TIME(), '192.168.1.22', 'Annonceur'),
					(NULL, CURRENT_TIME(), '192.168.1.33', 'Annonceur'),
					(NULL, CURRENT_TIME(), '192.168.1.44', 'Annonceur'),
					(NULL, CURRENT_TIME(), '192.168.1.5', 'Annonceur'),
					(NULL, CURRENT_TIME(), '192.168.1.6', 'Visiteur'),
					(NULL, CURRENT_TIME(), '192.168.1.7', 'Visiteur'),
					(NULL, CURRENT_TIME(), '192.168.1.8', 'Annonceur'),
					(NULL, CURRENT_TIME(), '192.168.1.9', 'Visiteur'),
					(NULL, CURRENT_TIME(), '192.168.1.10', 'Annonceur');

/* Annonceur */
INSERT INTO `annonceur` (`id_annonceur`, `login`, `password`, `mail`,
			`nom`, `prenom`, `ville`, `telephone`, `annonceur_photo`) 
VALUES ('2', 'user2', 'pass2', 'user2@gmail.com', 'Sachin', 'Villegas', 'Paris', '012324565', NULL),
		('4', 'user4', 'pass4', 'user4@gmail.com', 'Raveena', 'Lutz', 'Paris', '076421244', NULL),
		('5', 'user5', 'pass5', 'user5@gmail.com', 'Nabeel', 'Newman', 'Paris', '0667898542', NULL),
		('6', 'user6', 'pass6', 'user6@gmail.com', 'Marley', 'Beil', 'Lyon', '0724576512', NULL),
		('7', 'user7', 'pass7', 'user7@gmail.com', 'Lowery', 'Keira', 'Lyon', '0123456578', NULL),
		('10', 'user10', 'pass10', 'user10@gmail.com', 'Keanan', 'Mccormick', 'Strasbourg', '0213213456', NULL),
		('12', 'user12', 'pass12', 'user12@gmail.com', 'Aisha', 'Khaldi', 'Nantes', '0612547831', NULL);
/* Visiteur */
INSERT INTO `visiteur` (`id_visiteur`) VALUES (1),(3), (8),(9),(11);

/* Produit */
INSERT INTO `produit` (`id_produit`, `marque`, `modele`, `poids`, `etat`, `categorie`) VALUES 
	(NULL, 'Apple', 'Iphone 11', NULL, 'Neuf', 'Téléphonie'),
	(NULL, 'Samsung', 'Galaxy S10', NULL, 'Neuf', 'Téléphonie'),
	(NULL, 'Samsung', 'Galaxy A30', NULL, 'Neuf', 'Téléphonie'),
	(NULL, 'Samsung', 'Galaxy A20', NULL, 'Neuf', 'Téléphonie'),
	(NULL, 'Samsung', 'Galaxy M10', NULL, 'Neuf', 'Téléphonie'),
	(NULL, 'Samsung', 'Galaxy S7', NULL, 'Neuf', 'Téléphonie'),
	(NULL, 'Samsung', 'Galaxy S8', NULL, 'Neuf', 'Téléphonie'),
	(NULL, 'Apple', 'Iphone 10', NULL, 'Neuf', 'Téléphonie'),
	(NULL, 'Apple', 'Iphone 9', NULL, 'Neuf', 'Téléphonie'),
	(NULL, 'Apple', 'Iphone 6s', NULL, 'Neuf', 'Téléphonie'),
	(NULL, 'Huawei', 'P30', NULL, 'Neuf', 'Téléphonie'),
	(NULL, 'Asus', 'C423NA-BV0044', NULL, 'Neuf', 'PC'),
	(NULL, 'Acer', 'Chromebook CB3-431-C64E', NULL, 'Neuf', 'PC'),
	(NULL, 'Apple', 'iMac', NULL, 'Neuf', 'PC'),
	(NULL, 'HP', 'Pavilion x360 ', NULL, 'Neuf', 'PC');

/* Téléphonie */
INSERT INTO `telephonie` (`id_produit`, `diagonale`, `processeur`, `ram`, `taille_disque`, `os`, `batterie`, `nb_sim`, `type_sim`, `res_app_arr`, `res_app_av`, `nfc`) VALUES 
	('1', '6.1', 'Apple A13', '4', '128', 'IOS', '3110', '1', 'Nano SIM', '12', NULL, '1'), 
	('2', '6.1', 'Samsung Exynos 9820', '8', '64', 'Android', '3500', '2', 'Nano SIM', '16', NULL, '1'),
	('8', '5.1', 'Apple A13', '4', '64', 'IOS', '2550', '1', 'Nano SIM', '12.2', NULL, '1'),
	('9', '5.8', 'Apple A11', '4', '16', 'IOS', '1650', '1', 'Nano SIM', '12.1', NULL, '1'),
	('10', '5.4', 'Apple A10', '4', '256', 'IOS', '1500', '1', 'Nano SIM', '12.1', NULL, '1'),
	('3', '7.0', 'Samsung Exynos 9820', '8', '64', 'Android', '3500', '2', 'Nano SIM', '16.1', NULL, '1'),
	('4', '5.8', 'Samsung Exynos 8260', '6', '128', 'Android', '3000', '2', 'Nano SIM', '16.1', NULL, '1'),
	('5', '4.9', 'Samsung Exynos 7861', '4', '16', 'Android', '2550', '1', 'Nano SIM', '16.1', NULL, '1'),
	('6', '6.2', 'Samsung Exynos 6248', '4', '16', 'Android', '2000', '2', 'Nano SIM', '15.8', NULL, '1'),
	('7', '6.4', 'Samsung Exynos 5512', '6', '32', 'Android', '3500', '1', 'Nano SIM', '16.1', NULL, '1'),
	('11', '6.1', 'HiSilicon Kirin 980', '6', '128', 'Android', '4500', '2', 'Nano SIM', '40.2', NULL, '1');

/* PC */
INSERT INTO `pc` (`id_produit`, `diagonale`, `processeur`, `c_g`, `ram`, `type_disque`, `taille_disque`, `batterie`) VALUES 
	('15', '15.1', 'Intel Core i5-8265U', 'Intel UHD 620', '16', 'SSD', '256', NULL),
	('12', '17.2', 'Intel Core i3-87020U', 'GeForce GT840m', '16', 'SSD', '512', NULL),
	('13', '13.1', 'Intel Pentium N4200', 'Intel HD Graphics', '8', 'eMMC', '32', NULL),
	('14', '27', 'Intel Core i5-8265U', 'Radeon Pro 555X', '16', 'SSD', '128', NULL);

/* Annonce */
INSERT INTO `annonce` (`id_annonce`, `titre_annonce`, `prix`, `ville`, `type_annonce`, `time_pub`, `id_annonceur`, `id_produit`) VALUES 
	(NULL, 'Téléphone a vendre', '120', 'Paris', 'Urgent', CURRENT_TIME(), '2', '1'),
	(NULL, 'PC a vendre', '75', 'Lyon', 'Non urgent', CURRENT_TIME(), '4', '15'),
	(NULL, 'Téléphone a vendre', '80', 'Nantes', 'Urgent', CURRENT_TIME(), '7', '8'),
	(NULL, 'Téléphone a vendre', '210', 'Strasbourg', 'Non urgent', CURRENT_TIME(), '12', '9');



/* SELECT */
/* Nombre d'annonces pour chaque ville */
SELECT ville, COUNT(*) FROM annonce
GROUP BY ville

/* Nombre d'annonces par catégorie */
SELECT categorie, COUNT(*)
FROM produit p, annonce a
where p.id_produit = a.id_annonce
GROUP BY categorie

/* Nombre de consultation de chaque annonce*/
SELECT id_annonce, COUNT(*) nbr_consultation
from consulter
GROUP by id_annonce;

/* Nombre de consulation d'un utilisateur donné pour chaque catégorie */
SELECT u.id_user, categorie , COUNT(*) nbr_consultation
FROM  consulter c , user u, annonce a , produit p 
WHERE c.id_user = u.id_user
and c.id_annonce = a.id_annonce
and a.id_produit = p.id_produit
and u.id_user = 12
GROUP by categorie;

/* Nombre de consultation de chaque utilisateur donné pour chaque catégorie */
SELECT u.id_user, categorie , COUNT(*) nbr_consultation
FROM  consulter c , user u, annonce a , produit p 
WHERE c.id_user = u.id_user
and c.id_annonce = a.id_annonce
and a.id_produit = p.id_produit
GROUP by u.id_user,categorie;

/* Toutes les annonces d'une catégorie donné */
SELECT id_annonce 
FROM annonce a , produit p 
WHERE a.id_produit = p.id_produit
and categorie = 'categorie_donnée';

/* Les annonceurs qui n'ont aucune annonce */
SELECT a2.id_annonceur 
FROM annonce a, annonceur a2
WHERE a2.id_annonceur NOT IN (SELECT a3.id_annonceur 
                           FROM publier p , annonceur a3
                          WHERE p.id_annonceur = a3.id_annonceur)

/* Classement des annonceurs par nbr d'annonces et catégorie */


/* L'annonceur qui possede au moins une annonce dans chaque catégorie */





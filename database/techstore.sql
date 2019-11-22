/* Create database */
DROP DATABASE IF EXISTS 'techstore';

create database techstore;

/* Create table user*/

DROP TABLE IF EXISTS 'user';

CREATE TABLE techstore.user (
	id_user INT NOT NULL AUTO_INCREMENT ,
	time_access DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	adress_ip VARCHAR(15) NOT NULL ,
	type_user VARCHAR(11) NOT NULL,
	PRIMARY KEY (id_user)
	);


/* Create table visiteur*/
DROP TABLE IF EXISTS 'visiteur';

CREATE TABLE techstore.visiteur (
	id_visiteur INT NOT NULL,
	PRIMARY KEY (id_visiteur)
	);

/* Create table annonceur*/
DROP TABLE IF EXISTS 'annonceur';

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
DROP TABLE IF EXISTS 'produit';

CREATE TABLE techstore.produit (
	id_produit INT NOT NULL  AUTO_INCREMENT,
	marque VARCHAR(50) NOT NULL,
	modele VARCHAR(20) NOT NULL,
	poids DECIMAL(4,2),
	etat VARCHAR(10) NOT NULL,
	categorie VARCHAR(30) NOT NULL,
	PRIMARY KEY(id_produit)
);

/* Create table annonce */
DROP TABLE IF EXISTS 'annonce';

CREATE TABLE techstore.annonce (
	id_annonce INT NOT NULL AUTO_INCREMENT,
	titre_annonce VARCHAR(80) NOT NULL,
	prix DECIMAL(6,2) NOT NULL,
	ville VARCHAR(80) NOT NULL,
	type_annonce VARCHAR(10) NOT NULL,
	time_pub DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	id_annonceur INT NOT NULL,
	id_produit INT NOT NULL,
	PRIMARY KEY(id_annonce)
);

/* Create table consulter */
DROP TABLE IF EXISTS 'consulter';

CREATE TABLE techstore.consulter(
	id_user INT NOT NULL,
	id_annonce INT NOT NULL,
	date_consultation DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id_user,id_annonce)
);

/* Create table publier */
DROP TABLE IF EXISTS 'publier';

CREATE TABLE techstore.publier(
	id_annonceur INT NOT NULL,
	id_annonce INT NOT NULL,
	date_publication DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id_annonceur,id_annonce)
);

/* Create table photo*/
DROP TABLE IF EXISTS 'photo';

CREATE TABLE techstore.photo(
	id_photo INT NOT NULL AUTO_INCREMENT,
	id_annonce INT NOT NULL,
	photo BLOB NOT NULL,
	PRIMARY KEY (id_photo)
);

/* Create table PC */
DROP TABLE IF EXISTS 'pc';

CREATE TABLE techstore.pc(
	id_produit INT NOT NULL,
	diagonale DECIMAL(2,1) NOT NULL,
	processeur VARCHAR(80) NOT NULL,
	c_g VARCHAR(80) NOT NULL,
	ram INT NOT NULL,
	type_disque VARCHAR(10) NOT NULL,
	taille_disque INT NOT NULL,
	batterie VARCHAR(80),
	PRIMARY KEY (id_produit)
);

/* Create table TV */
DROP TABLE IF EXISTS 'tv';

CREATE TABLE techstore.tv(
	id_produit INT NOT NULL,
	diagonale DECIMAL(2,1) NOT NULL,
	definition VARCHAR(20),
	tech VARCHAR(20),
	os VARCHAR(20),
	connectique VARCHAR(20),
	PRIMARY KEY (id_produit)
);

/* Create table telephonie*/
DROP TABLE IF EXISTS 'telephonie';

CREATE TABLE techstore.telephonie(
	id_produit INT NOT NULL,
	diagonale DECIMAL(2,1) NOT NULL,
	processeur VARCHAR(80) NOT NULL,
	ram INT NOT NULL,
	taille_disque INT NOT NULL,
	os VARCHAR(20),
	batterie VARCHAR(80),
	nb_sim INT ,
	type_sim VARCHAR(15),
	res_app_arr DECIMAL(2,1) NOT NULL,
	res_app_av DECIMAL(2,1),
	nfc INT NOT NULL,
	PRIMARY KEY (id_produit)
);


/* Create table app photo*/
DROP TABLE IF EXISTS 'app_photo';

CREATE TABLE techstore.app_photo(
	id_produit INT NOT NULL,
	resolution DECIMAL(3,1) NOT NULL,
	format_cap VARCHAR(10), 
	definition VARCHAR(20),
	type_memoire VARCHAR(20) NOT NULL,
	type_ecran VARCHAR(20) NOT NULL,
	tech VARCHAR(10),
	PRIMARY KEY (id_produit)
);

/* Create table accesoires */
DROP TABLE IF EXISTS 'accesoires';

CREATE TABLE techstore.accesoires(
	id_produit INT NOT NULL,
	PRIMARY KEY (id_produit)
	);

USE techstore;

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














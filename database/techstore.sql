/* Create database */
create database techstore;

/* Create table user*/

CREATE TABLE techstore.user (
	id_user INT NOT NULL AUTO_INCREMENT ,
	type_user VARCHAR(11) NOT NULL ,
	time_access DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	adress_ip VARCHAR(15) NOT NULL ,
	PRIMARY KEY (id_user)
	);


/* Create table visiteur*/
CREATE TABLE techstore.visiteur (
	id_visiteur INT NOT NULL,
	PRIMARY KEY (id_visiteur),
	FOREIGN KEY (id_visiteur) REFERENCES techstore.user(id_user)
	);

/* Create table annonceur*/
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
	PRIMARY KEY (id_annonceur),
	FOREIGN KEY (id_annonceur) REFERENCES techstore.user(id_user)
);
/* Create table annonce */
CREATE TABLE techstore.annonce (
	id_annonce INT NOT NULL AUTO_INCREMENT,
	titre_annonce VARCHAR(80) NOT NULL,
	prix DOUBLE NOT NULL,
	ville VARCHAR(80) NOT NULL,
	type_annonce VARCHAR(10) NOT NULL,
	time_pub DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	id_annonceur INT NOT NULL,
	id_produit INT NOT NULL,
	PRIMARY KEY(id_annonce),
	FOREIGN KEY (id_annonceur) REFERENCES annonceur(id_annonceur)
	FOREIGN KEY (id_produit) REFERENCES annonceur(id_produit)
);

/* Create table produit */




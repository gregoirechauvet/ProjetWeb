DROP TABLE IF EXISTS Est_au_programme;
DROP TABLE IF EXISTS Oeuvre;
DROP TABLE IF EXISTS Participe;
DROP TABLE IF EXISTS Evenement;
DROP TABLE IF EXISTS Choriste;
DROP TABLE IF EXISTS Inscription;
DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Responsabilite;
DROP SEQUENCE responsabilite_sequence;
DROP SEQUENCE login_sequence;
DROP SEQUENCE inscription_sequence;
DROP SEQUENCE choriste_id_sequence;
DROP SEQUENCE evenement_id_sequence;
DROP SEQUENCE oeuvre_id_sequence;
DROP TYPE typeVoix;
DROP TYPE typeEvent;

CREATE SEQUENCE responsabilite_sequence;
CREATE TABLE Responsabilite (
	titre	INT PRIMARY KEY DEFAULT nextval('responsabilite_sequence'),
	label	VARCHAR(45),
	administrateur INT
);
CREATE SEQUENCE login_sequence;
CREATE TABLE Utilisateur (
	login					INT PRIMARY KEY DEFAULT nextval('login_sequence'),
	identifiant				VARCHAR(45),
	motdepasse				VARCHAR(45),
	responsabilite_titre	INT REFERENCES Responsabilite(titre)
);
CREATE SEQUENCE inscription_sequence;
CREATE TABLE Inscription (
	type	INT PRIMARY KEY DEFAULT nextval('inscription_sequence'),
	montant	INT,
	annee	VARCHAR(4)
);
CREATE SEQUENCE choriste_id_sequence;
CREATE TYPE typeVoix AS ENUM('Soprano', 'Alto', 'Ténor', 'Basse');
CREATE TABLE Choriste (
	idChoriste			INT PRIMARY KEY DEFAULT nextval('choriste_id_sequence'),
	nom					VARCHAR(45),
	prenom				VARCHAR(45),
	voix				typeVoix,
	ville				VARCHAR(45),
	telephone			VARCHAR(10),
	Utilisateur_login	INT REFERENCES Utilisateur(login),
	Inscription_type	INT REFERENCES Inscription(type)
);
CREATE SEQUENCE evenement_id_sequence;
CREATE TYPE typeEvent AS ENUM('Concert', 'Répétition');
CREATE TABLE Evenement (
	idEvenement	INT PRIMARY KEY DEFAULT nextval('evenement_id_sequence'),
	type		typeEvent,
	heureDate	INT,
	lieu		VARCHAR(45),
	nom			VARCHAR(45)
);
CREATE TABLE Participe (
	idChoriste	INT REFERENCES Choriste(idChoriste),
	idEvenement	INT REFERENCES Evenement(idEvenement),
	PRIMARY KEY(idChoriste, idEvenement)
);
CREATE SEQUENCE oeuvre_id_sequence;
CREATE TABLE Oeuvre (
	idOeuvre	INT PRIMARY KEY DEFAULT nextval('oeuvre_id_sequence'),
	titre		VARCHAR(45),
	auteur		VARCHAR(45),
	partition	VARCHAR(45)
);
CREATE TABLE Est_au_programme (
	Evenement_idEvenement	INT REFERENCES Evenement(idEvenement),
	Oeuvre_idOeuvre			INT REFERENCES Oeuvre(idOeuvre),
	PRIMARY KEY (Evenement_idEvenement, Oeuvre_idOeuvre)
);

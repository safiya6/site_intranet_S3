DROP TABLE IF EXISTS directeur CASCADE ;
DROP TABLE IF EXISTS enseignant cascade;
DROP TABLE IF EXISTS secretaire cascade;
DROP TABLE IF EXISTS identifiant cascade;
DROP TABLE IF EXISTS personne cascade ;


CREATE TABLE personne(
   id_personne INT,
   nom VARCHAR(50) NOT NULL,
   prenom VARCHAR(50) NOT NULL,
   email VARCHAR(50),
   PRIMARY KEY(id_personne)
);

CREATE TABLE identifiant(
   ide int,
   mdp VARCHAR(100),
   PRIMARY KEY(ide),
   FOREIGN KEY(ide) REFERENCES personne(id_personne)
);

CREATE TABLE enseignant(
   id_personne INT,
   PRIMARY KEY(id_personne),
   FOREIGN KEY(id_personne) REFERENCES personne(id_personne)
);

CREATE TABLE directeur(
   id_personne INT,
   PRIMARY KEY(id_personne),
   FOREIGN KEY(id_personne) REFERENCES enseignant(id_personne)
);



CREATE TABLE secretaire(
   id_personne INT,
   PRIMARY KEY(id_personne),
   FOREIGN KEY(id_personne) REFERENCES personne(id_personne)
);



/*

CREATE TABLE discipline(
   idDiscipline INT,
   libelleDisc VARCHAR(25) NOT NULL,
   PRIMARY KEY(idDiscipline)
);

CREATE TABLE categorie(
   id_categorie SMALLINT,
   sigleCat VARCHAR(5) NOT NULL,
   libelleCat VARCHAR(50),
   serviceStatutaire SMALLINT NOT NULL,
   serviceComplémentaireReferentiel BYTE,
   ServiceComplémentaireEnseignement SMALLINT,
   PRIMARY KEY(id_categorie)
);

CREATE TABLE annee(
   AA BYTE,
   PRIMARY KEY(AA)
);

CREATE TABLE Diplome(
   idDiplome TEXT,
   libelle VARCHAR(50),
   PRIMARY KEY(idDiplome)
);



CREATE TABLE equipedirection(
   id_personne INT,
   PRIMARY KEY(id_personne),
   FOREIGN KEY(id_personne) REFERENCES enseignant(id_personne)
);

CREATE TABLE semestre(
   AA BYTE,
   S BYTE CHECK IN (1,2),
   PRIMARY KEY(AA, S),
   FOREIGN KEY(AA) REFERENCES annee(AA)
);

CREATE TABLE Niveau(
   idDiplome TEXT,
   id_niveau VARCHAR(50),
   Niveau BYTE,
   PRIMARY KEY(idDiplome, id_niveau),
   FOREIGN KEY(idDiplome) REFERENCES Diplome(idDiplome)
);



CREATE TABLE departement(
   idDepartement INT,
   sigleDept VARCHAR(50) NOT NULL,
   libelleDept VARCHAR(50),
   id_personne INT NOT NULL,
   PRIMARY KEY(idDepartement),
   UNIQUE(id_personne),
   FOREIGN KEY(id_personne) REFERENCES enseignant(id_personne)
);

CREATE TABLE formation(
   idFormation INT,
   nom VARCHAR(50) NOT NULL,
   idDiplome TEXT NOT NULL,
   id_niveau VARCHAR(50) NOT NULL,
   PRIMARY KEY(idFormation),
   FOREIGN KEY(idDiplome, id_niveau) REFERENCES Niveau(idDiplome, id_niveau)
);

CREATE TABLE Besoin(
   AA BYTE,
   S BYTE,
   idFormation INT,
   idDiscipline INT,
   idDepartement INT,
   besoin_heure TIME NOT NULL,
   PRIMARY KEY(AA, S, idFormation, idDiscipline, idDepartement),
   FOREIGN KEY(AA, S) REFERENCES semestre(AA, S),
   FOREIGN KEY(idFormation) REFERENCES formation(idFormation),
   FOREIGN KEY(idDiscipline) REFERENCES discipline(idDiscipline),
   FOREIGN KEY(idDepartement) REFERENCES departement(idDepartement)
);

CREATE TABLE assigner(
   id_personne INT,
   idDepartement INT,
   AA BYTE,
   S BYTE,
   quotite DECIMAL(2,2),
   PRIMARY KEY(id_personne, idDepartement, AA, S),
   FOREIGN KEY(id_personne) REFERENCES personne(id_personne),
   FOREIGN KEY(idDepartement) REFERENCES departement(idDepartement),
   FOREIGN KEY(AA, S) REFERENCES semestre(AA, S)
);

CREATE TABLE propose(
   idDepartement INT,
   idFormation INT,
   PRIMARY KEY(idDepartement, idFormation),
   FOREIGN KEY(idDepartement) REFERENCES departement(idDepartement),
   FOREIGN KEY(idFormation) REFERENCES formation(idFormation)
);

CREATE TABLE connaitAussi(
   id_personne INT,
   idDiscipline INT,
   PRIMARY KEY(id_personne, idDiscipline),
   FOREIGN KEY(id_personne) REFERENCES enseignant(id_personne),
   FOREIGN KEY(idDiscipline) REFERENCES discipline(idDiscipline)
);

CREATE TABLE enseigne(
   id_personne INT,
   idDiscipline INT,
   AA BYTE,
   S BYTE,
   nbHeureEns SMALLINT,
   PRIMARY KEY(id_personne, idDiscipline, AA, S),
   FOREIGN KEY(id_personne) REFERENCES enseignant(id_personne),
   FOREIGN KEY(idDiscipline) REFERENCES discipline(idDiscipline),
   FOREIGN KEY(AA, S) REFERENCES semestre(AA, S)
);

*/

/* rg"t' */


INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010100, 'Dupont', 'Marie', 'marie.dupont@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010101, 'Martin', 'Jean', 'jean.martin@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010102, 'Leroy', 'Sophie', 'sophie.leroy@edu.univ-paris13.fr');
INSERT INTO secretaire (id_personne) VALUES (1010102); 
INSERT INTO enseignant (id_personne) VALUES (1010101);
INSERT INTO enseignant (id_personne) VALUES (1010100);
INSERT INTO directeur (id_personne) VALUES (1010100);

INSERT INTO identifiant (ide, mdp) VALUES (1010100, 'mdp123');
INSERT INTO identifiant (ide, mdp) VALUES (1010101, 'mdp456');
INSERT INTO identifiant (ide, mdp) VALUES (1010102, 'mdp789'); 

DROP TABLE IF EXISTS enseigne CASCADE;
DROP TABLE IF EXISTS connaitAussi CASCADE;
DROP TABLE IF EXISTS propose CASCADE;
DROP TABLE IF EXISTS assigner CASCADE;
DROP TABLE IF EXISTS Besoin CASCADE;
DROP TABLE IF EXISTS formation CASCADE;
DROP TABLE IF EXISTS departement CASCADE;
DROP TABLE IF EXISTS Niveau CASCADE;
DROP TABLE IF EXISTS semestre CASCADE;
DROP TABLE IF EXISTS equipedirection CASCADE;
DROP TABLE IF EXISTS secretaire CASCADE;
DROP TABLE IF EXISTS directeur CASCADE;
DROP TABLE IF EXISTS enseignant CASCADE;
DROP TABLE IF EXISTS Diplome CASCADE;
DROP TABLE IF EXISTS annee CASCADE;
DROP TABLE IF EXISTS categorie CASCADE;
DROP TABLE IF EXISTS discipline CASCADE;
DROP TABLE IF EXISTS identifiant CASCADE;
DROP TABLE IF EXISTS personne CASCADE;



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


CREATE TABLE discipline(
   id_discipline INT,
   libelleDisc VARCHAR(25) NOT NULL,
   PRIMARY KEY(id_discipline)
);

CREATE TABLE secretaire(
   id_personne INT,
   PRIMARY KEY(id_personne),
   FOREIGN KEY(id_personne) REFERENCES personne(id_personne)
);

CREATE TABLE categorie(
   id_categorie SMALLINT,
   sigleCat VARCHAR(5) NOT NULL,
   libelleCat VARCHAR(50),
   serviceStatutaire SMALLINT NOT NULL,
   ServiceComplementaireEnseignement SMALLINT,
   PRIMARY KEY(id_categorie)
);

CREATE TABLE annee(
   AA SMALLINT,
   PRIMARY KEY(AA)
);

CREATE TABLE Diplome(
   id_diplome INT,
   libelle VARCHAR(50),
   PRIMARY KEY(id_diplome)
);

CREATE TABLE enseignant(
   id_personne INT,
   id_discipline INT NOT NULL,
   id_categorie SMALLINT NOT NULL,
   serviceComplementaireReferentiel SMALLINT,
   AA SMALLINT NOT NULL,
   PRIMARY KEY(id_personne),
   FOREIGN KEY(id_personne) REFERENCES personne(id_personne),
   FOREIGN KEY(id_discipline) REFERENCES discipline(id_discipline),
   FOREIGN KEY(id_categorie) REFERENCES categorie(id_categorie),
   FOREIGN KEY(AA) REFERENCES annee(AA)
);

CREATE TABLE equipedirection(
   id_personne INT,
   PRIMARY KEY(id_personne),
   FOREIGN KEY(id_personne) REFERENCES enseignant(id_personne)
);

CREATE TABLE semestre(
   AA SMALLINT,
   S SMALLINT CHECK (S = 1 OR S = 2),
   PRIMARY KEY(AA, S),
   FOREIGN KEY(AA) REFERENCES annee(AA)
);

CREATE TABLE Niveau(
   id_diplome INT,
   id_niveau VARCHAR(50),
   Niveau SMALLINT,
   PRIMARY KEY(id_diplome, id_niveau),
   FOREIGN KEY(id_diplome) REFERENCES Diplome(id_diplome)
);

CREATE TABLE directeur(
   id_personne INT,
   PRIMARY KEY(id_personne),
   FOREIGN KEY(id_personne) REFERENCES enseignant(id_personne)
);

CREATE TABLE departement(
   id_departement INT,
   sigleDept VARCHAR(50) NOT NULL,
   libelleDept VARCHAR(50),
   id_personne INT NOT NULL,
   PRIMARY KEY(id_departement),
   UNIQUE(id_personne),
   FOREIGN KEY(id_personne) REFERENCES enseignant(id_personne)
);

CREATE TABLE formation(
   id_formation INT,
   nom VARCHAR(50) NOT NULL,
   id_diplome INT NOT NULL,
   id_niveau VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_formation),
   FOREIGN KEY(id_diplome, id_niveau) REFERENCES Niveau(id_diplome, id_niveau)
);

CREATE TABLE Besoin(
   AA SMALLINT,
   S SMALLINT,
   id_formation INT,
   id_discipline INT,
   id_departement INT,
   besoin_heure FLOAT NOT NULL,
   PRIMARY KEY(AA, S, id_formation, id_discipline, id_departement),
   FOREIGN KEY(AA, S) REFERENCES semestre(AA, S),
   FOREIGN KEY(id_formation) REFERENCES formation(id_formation),
   FOREIGN KEY(id_discipline) REFERENCES discipline(id_discipline),
   FOREIGN KEY(id_departement) REFERENCES departement(id_departement)
);

CREATE TABLE assigner(
   id_personne INT,
   id_departement INT,
   AA SMALLINT,
   S SMALLINT,
   quotite DECIMAL(2,2),
   PRIMARY KEY(id_personne, id_departement, AA, S),
   FOREIGN KEY(id_personne) REFERENCES personne(id_personne),
   FOREIGN KEY(id_departement) REFERENCES departement(id_departement),
   FOREIGN KEY(AA, S) REFERENCES semestre(AA, S)
);

CREATE TABLE propose(
   id_departement INT,
   id_formation INT,
   PRIMARY KEY(id_departement, id_formation),
   FOREIGN KEY(id_departement) REFERENCES departement(id_departement),
   FOREIGN KEY(id_formation) REFERENCES formation(id_formation)
);

CREATE TABLE connaitAussi(
   id_personne INT,
   id_discipline INT,
   PRIMARY KEY(id_personne, id_discipline),
   FOREIGN KEY(id_personne) REFERENCES enseignant(id_personne),
   FOREIGN KEY(id_discipline) REFERENCES discipline(id_discipline)
);

CREATE TABLE enseigne(
   id_personne INT,
   id_discipline INT,
   AA SMALLINT,
   S SMALLINT,
   nbHeureEns SMALLINT,
   PRIMARY KEY(id_personne, id_discipline, AA, S),
   FOREIGN KEY(id_personne) REFERENCES enseignant(id_personne),
   FOREIGN KEY(id_discipline) REFERENCES discipline(id_discipline),
   FOREIGN KEY(AA, S) REFERENCES semestre(AA, S)
);
 

INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010100, 'Dupont', 'Marie', 'marie.dupont@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010101, 'Martin', 'Jean', 'jean.martin@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010102, 'Leroy', 'Sophie', 'sophie.leroy@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010103, 'Gardner', 'Joe', 'joe.gardner@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010104, 'Sultan ', 'Aladdin', 'Aladdin.sultan@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010105, 'Océane', 'Ariel', 'ariel.oceane@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010106, 'Léon', 'Belle', 'belle.leon@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010107, 'Verrine', 'Cendrillon', 'cendrillon.verrine@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010108, 'Marin', 'Éric', 'eric.marin@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010109, 'Arendelle', 'Elsa', 'elsa.arendelle@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010110, 'Badroulboudour', 'Jasmine', 'jasmine.badroulboudour@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010111, 'Fa', 'Mulan', 'mulan.fa@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010112, 'Lionne', 'Nala', 'nala.lionne@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010113, 'Powhatan', 'Pocahontas', 'pocahontas.powhatan@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010114, 'Corona', 'Raiponce', 'raiponce.corona@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010115, 'Roi', 'Simba', 'simba.roi@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010116, 'Grenouille', 'Tiana', 'tiana.grenouille@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010117, 'Rose', 'Aurore', 'aurore.rose@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010118, 'Fort', 'Gaston', 'gaston.fort@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010119, 'Archer', 'Merinda', 'merinda.archer@edu.univ-paris13.fr');
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010120, 'Rider', 'Flynn', 'flynn.rider@edu.univ-paris13.fr');

INSERT INTO secretaire (id_personne) VALUES (1010102);

INSERT INTO discipline (id_discipline, libelleDisc) VALUES (0, 'MATH');
INSERT INTO discipline (id_discipline, libelleDisc) VALUES (1, 'INFO-PROG');
INSERT INTO discipline (id_discipline, libelleDisc) VALUES (2, 'INFO-INDUSTRIEL');
INSERT INTO discipline (id_discipline, libelleDisc) VALUES (3, 'INFO-RESEAU');
INSERT INTO discipline (id_discipline, libelleDisc) VALUES (4, 'INFO-BUREAUTIQUE');
INSERT INTO discipline (id_discipline, libelleDisc) VALUES (5, 'ECOGESTION');
INSERT INTO discipline (id_discipline, libelleDisc) VALUES (6, 'ELECTRONIQUE');
INSERT INTO discipline (id_discipline, libelleDisc) VALUES (7, 'DROIT');
INSERT INTO discipline (id_discipline, libelleDisc) VALUES (8, 'ANGLAIS');
INSERT INTO discipline (id_discipline, libelleDisc) VALUES (9, 'COMMUNICATION');

INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireEnseignement) VALUES (21, 'PR', 'Professeur des Universités', 192,  30);
INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireEnseignement) VALUES (22, 'MCF', 'Maître de Conférences', 192, 30);
INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireEnseignement) VALUES (23, 'ESAS', 'Enseignant du Secondaire Affecté dans le Supérieur', 192, 0);
INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireEnseignement) VALUES (24, 'PAST', 'Professeur Associé à Temps Partiel', 96, 15);
INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireEnseignement) VALUES (25, 'ATER', 'Attaché Temporaire Enseignement et de Recherche', 192, 0);
INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireEnseignement) VALUES (26, 'VAC', 'Vacataire', 0, 0);
INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireEnseignement) VALUES (27, 'DOC', 'Doctorant', 64, 0);
INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireEnseignement) VALUES (28, 'CDD', 'Contrat à Durée Déterminée', 192, 0);
INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireEnseignement) VALUES (29, 'CDI', 'Contrat à Durée Indéterminée', 192, 0);

INSERT INTO annee (AA) VALUES (2023);
INSERT INTO annee (AA) VALUES (2024);
INSERT INTO annee (AA) VALUES (2025);


INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010100, 0, 21, 20, 2023);


INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010101, 0, 21, 20, 2024);


INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010103, 1, 22, 20, 2025);

INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010104, 1, 22, 20, 2023);


INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010105, 2, 23, 0, 2024);


INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010106, 2, 23, 0, 2025);

INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010107, 3, 24, 10, 2023);

INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010108, 3, 24, 10, 2024);

INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010109, 4, 25, 0, 2025);

INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010110, 4, 25, 0, 2023);

INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010111, 5, 26, 60, 2024);

INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010112, 5, 26, 60, 2025);

INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010113, 6, 27, 0, 2023);

INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010114, 6, 27, 0, 2024);

INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010115, 7, 28, 0, 2025);

INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010116, 7, 28, 0, 2023);


INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010117, 8, 29, 0, 2024);

INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010118, 8, 29, 0, 2025);

INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010119, 9, 21, 20, 2023);

INSERT INTO enseignant (id_personne, id_discipline, id_categorie, serviceComplementaireReferentiel, AA) VALUES (1010120, 9, 21, 20, 2024);


INSERT INTO directeur (id_personne) VALUES (1010100);

INSERT INTO identifiant (ide, mdp) VALUES (1010100, 'mdp123');
INSERT INTO identifiant (ide, mdp) VALUES (1010101, 'mdp456');
INSERT INTO identifiant (ide, mdp) VALUES (1010102, 'mdp789');
INSERT INTO identifiant (ide, mdp) VALUES (1010103, 'mdp321');
INSERT INTO identifiant (ide, mdp) VALUES (1010104, 'mdp654');
INSERT INTO identifiant (ide, mdp) VALUES (1010105, 'mdp987');
INSERT INTO identifiant (ide, mdp) VALUES (1010106, 'mdp147');
INSERT INTO identifiant (ide, mdp) VALUES (1010107, 'mdp258');
INSERT INTO identifiant (ide, mdp) VALUES (1010108, 'mdp369');
INSERT INTO identifiant (ide, mdp) VALUES (1010109, 'mdp741');
INSERT INTO identifiant (ide, mdp) VALUES (1010110, 'mdp852');
INSERT INTO identifiant (ide, mdp) VALUES (1010111, 'mdp963');
INSERT INTO identifiant (ide, mdp) VALUES (1010112, 'mdp753');
INSERT INTO identifiant (ide, mdp) VALUES (1010113, 'mdp951');
INSERT INTO identifiant (ide, mdp) VALUES (1010114, 'mdp357');
INSERT INTO identifiant (ide, mdp) VALUES (1010115, 'mdp159');
INSERT INTO identifiant (ide, mdp) VALUES (1010116, 'mdp248');
INSERT INTO identifiant (ide, mdp) VALUES (1010117, 'mdp268');
INSERT INTO identifiant (ide, mdp) VALUES (1010118, 'mdp157');
INSERT INTO identifiant (ide, mdp) VALUES (1010119, 'mdp359');
INSERT INTO identifiant (ide, mdp) VALUES (1010120, 'mdp153');

INSERT INTO Diplome (id_diplome, libelle) VALUES (50, 'Bachelor Universitaire Technologique');
INSERT INTO Diplome (id_diplome, libelle) VALUES (51, 'Licence Professionnel');

INSERT INTO equipedirection (id_personne) VALUES (1010104);
INSERT INTO equipedirection (id_personne) VALUES (1010105);
INSERT INTO equipedirection (id_personne) VALUES (1010106);

INSERT INTO semestre (AA, S) VALUES (2023, 1); /* semestre 1 */
INSERT INTO semestre (AA, S) VALUES (2023, 2); /* semestre 2 */
INSERT INTO semestre (AA, S) VALUES (2024, 1); /* semestre 3 */
INSERT INTO semestre (AA, S) VALUES (2024, 2); /* semestre 4 */
INSERT INTO semestre (AA, S) VALUES (2025, 1); /* semestre 5 */
INSERT INTO semestre (AA, S) VALUES (2025, 2); /* semestre 6 */


INSERT INTO Niveau (id_diplome, id_niveau, Niveau) VALUES (50, 'BUT 1', 1);
INSERT INTO Niveau (id_diplome, id_niveau, Niveau) VALUES (50, 'BUT 2', 2);
INSERT INTO Niveau (id_diplome, id_niveau, Niveau) VALUES (50, 'BUT 3', 3);
INSERT INTO Niveau (id_diplome, id_niveau, Niveau) VALUES (51, 'Licence 1', 1);
INSERT INTO Niveau (id_diplome, id_niveau, Niveau) VALUES (51, 'Licence 2', 2);
INSERT INTO Niveau (id_diplome, id_niveau, Niveau) VALUES (51, 'Licence 3', 3);

INSERT INTO departement (id_departement, sigleDept, libelleDept, id_personne) VALUES (0, 'IUT', 'Institut Universitaire de Technologie', 1010100);
INSERT INTO departement (id_departement, sigleDept, libelleDept, id_personne) VALUES (1, 'SD', 'Science des Données', 1010106);
INSERT INTO departement (id_departement, sigleDept, libelleDept, id_personne) VALUES (2, 'RT', 'Réseaux et Télécommunications', 1010115);
INSERT INTO departement (id_departement, sigleDept, libelleDept, id_personne) VALUES (3, 'INFO', 'Informatique', 1010116);
INSERT INTO departement (id_departement, sigleDept, libelleDept, id_personne) VALUES (4, 'GEII', 'Génie Électrique et Informatique Industrielle', 1010118);
INSERT INTO departement (id_departement, sigleDept, libelleDept, id_personne) VALUES (5, 'GEA', 'Gestion des Entreprises et des Administrations', 1010119);
INSERT INTO departement (id_departement, sigleDept, libelleDept, id_personne) VALUES (6, 'CJ', 'Carrières Juridiques', 1010120);

INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (60, 'BUT', 50, 'BUT 1');
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (61, 'BUT', 50, 'BUT 2');
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (62, 'BUT', 50, 'BUT 3');
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (63, 'Licence', 51, 'Licence 1');
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (64, 'Licence', 51, 'Licence 2');
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (65, 'Licence', 51, 'Licence 3');

INSERT INTO propose (id_departement, id_formation) VALUES (1, 60);
INSERT INTO propose (id_departement, id_formation) VALUES (1, 61);
INSERT INTO propose (id_departement, id_formation) VALUES (1, 62);
INSERT INTO propose (id_departement, id_formation) VALUES (1, 63);
INSERT INTO propose (id_departement, id_formation) VALUES (1, 64);
INSERT INTO propose (id_departement, id_formation) VALUES (1, 65);
INSERT INTO propose (id_departement, id_formation) VALUES (2, 60);
INSERT INTO propose (id_departement, id_formation) VALUES (2, 61);
INSERT INTO propose (id_departement, id_formation) VALUES (2, 62);
INSERT INTO propose (id_departement, id_formation) VALUES (2, 63);
INSERT INTO propose (id_departement, id_formation) VALUES (2, 64);
INSERT INTO propose (id_departement, id_formation) VALUES (2, 65);
INSERT INTO propose (id_departement, id_formation) VALUES (3, 60);
INSERT INTO propose (id_departement, id_formation) VALUES (3, 61);
INSERT INTO propose (id_departement, id_formation) VALUES (3, 62);
INSERT INTO propose (id_departement, id_formation) VALUES (3, 63);
INSERT INTO propose (id_departement, id_formation) VALUES (3, 64);
INSERT INTO propose (id_departement, id_formation) VALUES (3, 65);
INSERT INTO propose (id_departement, id_formation) VALUES (4, 60);
INSERT INTO propose (id_departement, id_formation) VALUES (4, 61);
INSERT INTO propose (id_departement, id_formation) VALUES (4, 62);
INSERT INTO propose (id_departement, id_formation) VALUES (4, 63);
INSERT INTO propose (id_departement, id_formation) VALUES (4, 64);
INSERT INTO propose (id_departement, id_formation) VALUES (4, 65);
INSERT INTO propose (id_departement, id_formation) VALUES (5, 60);
INSERT INTO propose (id_departement, id_formation) VALUES (5, 61);
INSERT INTO propose (id_departement, id_formation) VALUES (5, 62);
INSERT INTO propose (id_departement, id_formation) VALUES (5, 63);
INSERT INTO propose (id_departement, id_formation) VALUES (5, 64);
INSERT INTO propose (id_departement, id_formation) VALUES (5, 65);
INSERT INTO propose (id_departement, id_formation) VALUES (6, 60);
INSERT INTO propose (id_departement, id_formation) VALUES (6, 61);
INSERT INTO propose (id_departement, id_formation) VALUES (6, 62);
INSERT INTO propose (id_departement, id_formation) VALUES (6, 63);
INSERT INTO propose (id_departement, id_formation) VALUES (6, 64);
INSERT INTO propose (id_departement, id_formation) VALUES (6, 65);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010100, 0, 2023, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010100, 0, 2023, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010100, 0, 2024, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010100, 0, 2024, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010100, 0, 2025, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010100, 0, 2025, 2, 96);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010101, 0, 2023, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010101, 0, 2023, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010101, 0, 2024, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010101, 0, 2024, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010101, 0, 2025, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010101, 0, 2025, 2, 96);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010103, 1, 2023, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010103, 1, 2023, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010103, 1, 2024, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010103, 1, 2024, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010103, 1, 2025, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010103, 1, 2025, 2, 96);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010104, 1, 2023, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010104, 1, 2023, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010104, 1, 2024, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010104, 1, 2024, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010104, 1, 2025, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010104, 1, 2025, 2, 96);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010105, 2, 2023, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010105, 2, 2023, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010105, 2, 2024, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010105, 2, 2024, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010105, 2, 2025, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010105, 2, 2025, 2, 96);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010106, 2, 2023, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010106, 2, 2023, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010106, 2, 2024, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010106, 2, 2024, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010106, 2, 2025, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010106, 2, 2025, 2, 96);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010107, 3, 2023, 1, 48);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010107, 3, 2023, 2, 48);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010107, 3, 2024, 1, 48);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010107, 3, 2024, 2, 48);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010107, 3, 2025, 1, 48);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010107, 3, 2025, 2, 48);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010108, 3, 2023, 1, 48);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010108, 3, 2023, 2, 48);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010108, 3, 2024, 1, 48);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010108, 3, 2024, 2, 48);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010108, 3, 2025, 1, 48);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010108, 3, 2025, 2, 48);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010109, 4, 2023, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010109, 4, 2023, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010109, 4, 2024, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010109, 4, 2024, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010109, 4, 2025, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010109, 4, 2025, 2, 96);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010110, 4, 2023, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010110, 4, 2023, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010110, 4, 2024, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010110, 4, 2024, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010110, 4, 2025, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010110, 4, 2025, 2, 96);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010111, 5, 2023, 1, 30);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010111, 5, 2023, 2, 30);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010111, 5, 2024, 1, 30);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010111, 5, 2024, 2, 30);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010111, 5, 2025, 1, 30);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010111, 5, 2025, 2, 30);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010112, 5, 2023, 1, 30);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010112, 5, 2023, 2, 30);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010112, 5, 2024, 1, 30);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010112, 5, 2024, 2, 30);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010112, 5, 2025, 1, 30);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010112, 5, 2025, 2, 30);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010113, 6, 2023, 1, 32);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010113, 6, 2023, 2, 32);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010113, 6, 2024, 1, 32);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010113, 6, 2024, 2, 32);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010113, 6, 2025, 1, 32);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010113, 6, 2025, 2, 32);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010114, 6, 2023, 1, 32);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010114, 6, 2023, 2, 32);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010114, 6, 2024, 1, 32);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010114, 6, 2024, 2, 32);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010114, 6, 2025, 1, 32);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010114, 6, 2025, 2, 32);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010115, 7, 2023, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010115, 7, 2023, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010115, 7, 2024, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010115, 7, 2024, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010115, 7, 2025, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010115, 7, 2025, 2, 96);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010116, 7, 2023, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010116, 7, 2023, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010116, 7, 2024, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010116, 7, 2024, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010116, 7, 2025, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010116, 7, 2025, 2, 96);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010117, 8, 2023, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010117, 8, 2023, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010117, 8, 2024, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010117, 8, 2024, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010117, 8, 2025, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010117, 8, 2025, 2, 96);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010118, 8, 2023, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010118, 8, 2023, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010118, 8, 2024, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010118, 8, 2024, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010118, 8, 2025, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010118, 8, 2025, 2, 96);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010119, 9, 2023, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010119, 9, 2023, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010119, 9, 2024, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010119, 9, 2024, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010119, 9, 2025, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010119, 9, 2025, 2, 96);

INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010120, 9, 2023, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010120, 9, 2023, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010120, 9, 2024, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010120, 9, 2024, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010120, 9, 2025, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, AA, S, nbHeureEns) VALUES (1010120, 9, 2025, 2, 96);



 
INSERT INTO Besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 1, 60, 0, 3, 36);
INSERT INTO Besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 1, 60, 3, 3, 44);
INSERT INTO Besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 2, 60, 0, 3, 22.30);
INSERT INTO Besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 2, 60, 3, 3, 14.40);

INSERT INTO Besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 1, 61, 0, 3, 44.10);
INSERT INTO Besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 1, 61, 3, 3, 30);
INSERT INTO Besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 2, 61, 0, 3, 10.30);
INSERT INTO Besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 2, 61, 3, 3, 09.15);

INSERT INTO Besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 1, 62, 0, 4, 55);
INSERT INTO Besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 1, 62, 8, 4, 22.40);
INSERT INTO Besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 2, 62, 0, 4, 36.40);
INSERT INTO Besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 2, 62, 8, 4, 22);



INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010100, 0);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010101, 1);


INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010100, 1, 2023, 1, 0.5); -- 50% en Science des Données
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010100, 2, 2023, 1, 0.5); -- 50% en Réseau et télécommunication

-- L'enseignant 1010101 est spécialisé en Informatique
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010101, 3, 2023, 1, 0.6); -- 60% en Informatique
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010101, 4, 2023, 1, 0.4); -- 40% en Génie électrique et informatique industrielle

-- L'enseignant 1010102 est spécialisé en Gestion
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010102, 5, 2023, 1, 0.7); -- 70% en Gestion des Entreprises et des Administrations
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010102, 6, 2023, 1, 0.3); -- 30% en Carrière juridique


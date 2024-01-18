DROP TABLE IF EXISTS enseigne CASCADE;
DROP TABLE IF EXISTS connaitAussi CASCADE;
DROP TABLE IF EXISTS propose CASCADE;
DROP TABLE IF EXISTS assigner CASCADE;
DROP TABLE IF EXISTS besoin CASCADE;
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
   id_personne SERIAL,
   nom VARCHAR(50) NOT NULL,
   prenom VARCHAR(50) NOT NULL,
   email VARCHAR(50),
   PRIMARY KEY(id_personne)
);

CREATE TABLE identifiant(
   ide int,
   mdp VARCHAR(700),
   PRIMARY KEY(ide),
   FOREIGN KEY(ide) REFERENCES personne(id_personne) ON DELETE CASCADE
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
   serviceComplementaireReferentiel SMALLINT,
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
   FOREIGN KEY(id_personne) REFERENCES enseignant(id_personne) ON DELETE CASCADE
);

CREATE TABLE semestre(
   AA SMALLINT,
   S SMALLINT CHECK (S = 1 OR S = 2),
   PRIMARY KEY(AA, S),
   FOREIGN KEY(AA) REFERENCES annee(AA)
);

CREATE TABLE Niveau(
   id_niveau INT,
   id_diplome INT,
   PRIMARY KEY(id_diplome, id_niveau),
   FOREIGN KEY(id_diplome) REFERENCES Diplome(id_diplome)
);

CREATE TABLE directeur(
   id_personne INT,
   PRIMARY KEY(id_personne),
   FOREIGN KEY(id_personne) REFERENCES enseignant(id_personne)
);

CREATE TABLE formation(
   id_formation INT,
   nom VARCHAR(100) NOT NULL,
   id_diplome INT NOT NULL,
   id_niveau INT NOT NULL,
   PRIMARY KEY(id_formation),
   FOREIGN KEY(id_niveau, id_diplome) REFERENCES Niveau(id_niveau, id_diplome)
);

CREATE TABLE departement(
   id_departement INT,
   sigleDept VARCHAR(50) NOT NULL,
   libelleDept VARCHAR(50),
   id_personne INT NOT NULL,
   PRIMARY KEY(id_departement),
   UNIQUE(id_personne),
   FOREIGN KEY(id_personne) REFERENCES enseignant(id_personne) ON DELETE CASCADE
);


CREATE TABLE besoin(
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
   FOREIGN KEY(id_personne) REFERENCES personne(id_personne)ON DELETE CASCADE,
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
   FOREIGN KEY(id_personne) REFERENCES enseignant(id_personne)ON DELETE CASCADE,
   FOREIGN KEY(id_discipline) REFERENCES discipline(id_discipline)
);

CREATE TABLE enseigne(
   id_personne INT,
   id_discipline INT,
   id_formation INT,
   AA SMALLINT,
   S SMALLINT,
   nbHeureEns SMALLINT,
   PRIMARY KEY(id_personne, id_discipline, id_formation, AA, S),
   FOREIGN KEY(id_personne) REFERENCES enseignant(id_personne) ON DELETE CASCADE,
   FOREIGN KEY(id_discipline) REFERENCES discipline(id_discipline),
   FOREIGN KEY(id_formation) REFERENCES formation(id_formation),
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
INSERT INTO personne (id_personne, nom, prenom, email) VALUES (1010121, 'Scarlett', 'Erza', 'erza.scarlett@edu.univ-paris13.fr');


SELECT setval('personne_id_personne_seq', MAX(id_personne)) FROM personne;

INSERT INTO secretaire (id_personne) VALUES (1010102);
INSERT INTO secretaire (id_personne) VALUES (1010121);


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

INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireReferentiel, serviceComplementaireEnseignement) VALUES (21, 'PR', 'Professeur des Universités', 192, 20, 30);
INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireReferentiel, serviceComplementaireEnseignement) VALUES (22, 'MCF', 'Maître de Conférences', 192, 20, 30);
INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireReferentiel, serviceComplementaireEnseignement) VALUES (23, 'ESAS', 'Enseignant du Secondaire Affecté dans le Supérieur', 192, 0, 0);
INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireReferentiel, serviceComplementaireEnseignement) VALUES (24, 'PAST', 'Professeur Associé à Temps Partiel', 96, 10, 15);
INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireReferentiel, serviceComplementaireEnseignement) VALUES (25, 'ATER', 'Attaché Temporaire Enseignement et de Recherche', 192, 0, 0);
INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireReferentiel, serviceComplementaireEnseignement) VALUES (26, 'VAC', 'Vacataire', 0, 60, 0);
INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireReferentiel, serviceComplementaireEnseignement) VALUES (27, 'DOC', 'Doctorant', 64, 0, 0);
INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireReferentiel, serviceComplementaireEnseignement) VALUES (28, 'CDD', 'Contrat à Durée Déterminée', 192, 0, 0);
INSERT INTO categorie (id_categorie, sigleCat, libelleCat, serviceStatutaire, serviceComplementaireReferentiel, serviceComplementaireEnseignement) VALUES (29, 'CDI', 'Contrat à Durée Indéterminée', 192, 20, 0);

INSERT INTO annee (AA) VALUES (2023);
INSERT INTO annee (AA) VALUES (2024);
INSERT INTO annee (AA) VALUES (2025);


INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010100, 0, 21, 2023);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010101, 0, 21, 2024);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010103, 1, 22, 2025);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010104, 1, 22, 2023);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010105, 2, 23, 2024);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010106, 2, 23, 2025);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010107, 3, 24, 2023);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010108, 3, 24, 2024);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010109, 4, 25, 2025);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010110, 4, 25, 2023);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010111, 5, 26, 2024);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010112, 5, 26, 2025);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010113, 6, 27, 2023);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010114, 6, 27, 2024);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010115, 7, 28, 2025);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010116, 7, 28, 2023);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010117, 8, 29, 2024);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010118, 8, 29, 2025);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010119, 9, 21, 2023);
INSERT INTO enseignant (id_personne, id_discipline, id_categorie, AA) VALUES (1010120, 9, 21, 2024);


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

INSERT INTO semestre (AA, S) VALUES (2023, 1);
INSERT INTO semestre (AA, S) VALUES (2023, 2); 
INSERT INTO semestre (AA, S) VALUES (2024, 1); 
INSERT INTO semestre (AA, S) VALUES (2024, 2); 
INSERT INTO semestre (AA, S) VALUES (2025, 1); 
INSERT INTO semestre (AA, S) VALUES (2025, 2); 


INSERT INTO Niveau (id_niveau, id_diplome) VALUES (1, 50);
INSERT INTO Niveau (id_niveau, id_diplome) VALUES (2, 50);
INSERT INTO Niveau (id_niveau, id_diplome) VALUES (3, 50);
INSERT INTO Niveau (id_niveau, id_diplome) VALUES (4, 51);

INSERT INTO departement (id_departement, sigleDept, libelleDept, id_personne) VALUES (0, 'IUT', 'Institut Universitaire de Technologie', 1010100);
INSERT INTO departement (id_departement, sigleDept, libelleDept, id_personne) VALUES (1, 'SD', 'Science des Données', 1010106);
INSERT INTO departement (id_departement, sigleDept, libelleDept, id_personne) VALUES (2, 'RT', 'Réseaux et Télécommunications', 1010115);
INSERT INTO departement (id_departement, sigleDept, libelleDept, id_personne) VALUES (3, 'INFO', 'Informatique', 1010116);
INSERT INTO departement (id_departement, sigleDept, libelleDept, id_personne) VALUES (4, 'GEII', 'Génie Électrique et Informatique Industrielle', 1010118);
INSERT INTO departement (id_departement, sigleDept, libelleDept, id_personne) VALUES (5, 'GEA', 'Gestion des Entreprises et des Administrations', 1010119);
INSERT INTO departement (id_departement, sigleDept, libelleDept, id_personne) VALUES (6, 'CJ', 'Carrières Juridiques', 1010120);

INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (60, 'BUT informatique parcours réalisation d''applications : conception, développement, validation', 50, 1);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (61, 'BUT informatique parcours administration, gestion et exploitation des données', 50, 1);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (62, 'BUT informatique parcours intégration d''applications et management du système d''information', 50, 1);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (63, 'BUT informatique parcours déploiement d''applications communicantes et sécurisées', 50, 1);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (64, 'BUT informatique parcours réalisation d''applications : conception, développement, validation', 50, 2);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (65, 'BUT informatique parcours administration, gestion et exploitation des données', 50, 2);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (66, 'BUT informatique parcours intégration d''applications et management du système d''information', 50, 2);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (67, 'BUT informatique parcours déploiement d''applications communicantes et sécurisées', 50, 2);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (68, 'BUT informatique parcours réalisation d''applications : conception, développement, validation', 50, 3);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (69, 'BUT informatique parcours administration, gestion et exploitation des données', 50, 3);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (70, 'BUT informatique parcours intégration d''applications et management du système d''information', 50, 3);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (71, 'BUT informatique parcours déploiement d''applications communicantes et sécurisées', 50, 3);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (72, 'BUT R&T parcours cybersécurité', 50, 1);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (73, 'BUT R&T parcours développement système et Cloud', 50, 1);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (74, 'BUT R&T parcours cybersécurité', 50, 2);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (75, 'BUT R&T parcours développement système et Cloud', 50, 2);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (76, 'BUT R&T parcours cybersécurité', 50, 3);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (77, 'BUT R&T parcours développement système et Cloud', 50, 3);
INSERT INTO formation (id_formation, nom, id_diplome, id_niveau) VALUES (78, 'Licence', 51, 4);


INSERT INTO propose (id_departement, id_formation) VALUES (2, 60);
INSERT INTO propose (id_departement, id_formation) VALUES (2, 61);
INSERT INTO propose (id_departement, id_formation) VALUES (2, 62);
INSERT INTO propose (id_departement, id_formation) VALUES (2, 63);
INSERT INTO propose (id_departement, id_formation) VALUES (2, 64);
INSERT INTO propose (id_departement, id_formation) VALUES (2, 65);
INSERT INTO propose (id_departement, id_formation) VALUES (2, 66);
INSERT INTO propose (id_departement, id_formation) VALUES (2, 67);
INSERT INTO propose (id_departement, id_formation) VALUES (2, 68);
INSERT INTO propose (id_departement, id_formation) VALUES (2, 69);
INSERT INTO propose (id_departement, id_formation) VALUES (2, 70);
INSERT INTO propose (id_departement, id_formation) VALUES (2, 71);
INSERT INTO propose (id_departement, id_formation) VALUES (3, 72);
INSERT INTO propose (id_departement, id_formation) VALUES (3, 73);
INSERT INTO propose (id_departement, id_formation) VALUES (3, 74);
INSERT INTO propose (id_departement, id_formation) VALUES (3, 75);
INSERT INTO propose (id_departement, id_formation) VALUES (3, 76);
INSERT INTO propose (id_departement, id_formation) VALUES (3, 77);


INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010100, 0, 60, 2023, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010100, 0, 64, 2023, 2, 38);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010100, 0, 68, 2024, 1, 94);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010100, 0, 61, 2024, 2, 75);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010100, 0, 65, 2025, 1, 15);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010100, 0, 69, 2025, 2, 63);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010101, 0, 62, 2023, 1, 17);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010101, 0, 66, 2023, 2, 89);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010101, 0, 70, 2024, 1, 73);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010101, 0, 63, 2024, 2, 16);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010101, 0, 67, 2025, 1, 43);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010101, 0, 71, 2025, 2, 64);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010103, 1, 60, 2023, 1, 83);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010103, 1, 64, 2023, 2, 49);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010103, 1, 68, 2024, 1, 13);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010103, 1, 61, 2024, 2, 95);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010103, 1, 65, 2025, 1, 26);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010103, 1, 69, 2025, 2, 36);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010104, 1, 62, 2023, 1, 49);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010104, 1, 66, 2023, 2, 75);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010104, 1, 70, 2024, 1, 94);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010104, 1, 63, 2024, 2, 67);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010104, 1, 67, 2025, 1, 91);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010104, 1, 71, 2025, 2, 32);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010105, 2, 72, 2023, 1, 76);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010105, 2, 74, 2023, 2, 46);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010105, 2, 76, 2024, 1, 13);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010105, 2, 73, 2024, 2, 46);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010105, 2, 75, 2025, 1, 56);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010105, 2, 77, 2025, 2, 46);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010106, 2, 72, 2023, 1, 76);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010106, 2, 74, 2023, 2, 34);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010106, 2, 76, 2024, 1, 36);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010106, 2, 73, 2024, 2, 89);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010106, 2, 75, 2025, 1, 43);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010106, 2, 77, 2025, 2, 14);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010107, 3, 72, 2023, 1, 48);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010107, 3, 74, 2023, 2, 96);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010107, 3, 76, 2024, 1, 62);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010107, 3, 73, 2024, 2, 76);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010107, 3, 75, 2025, 1, 43);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010107, 3, 77, 2025, 2, 96);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010108, 3, 60, 2023, 1, 15);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010108, 3, 64, 2023, 2, 76);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010108, 3, 68, 2024, 1, 93);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010108, 3, 61, 2024, 2, 87);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010108, 3, 65, 2025, 1, 13);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010108, 3, 69, 2025, 2, 36);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010109, 4, 72, 2023, 1, 42);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010109, 4, 74, 2023, 2, 15);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010109, 4, 76, 2024, 1, 16);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010109, 4, 73, 2024, 2, 48);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010109, 4, 75, 2025, 1, 16);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010109, 4, 78, 2025, 2, 96);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010110, 4, 62, 2023, 1, 31);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010110, 4, 66, 2023, 2, 76);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010110, 4, 70, 2024, 1, 86);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010110, 4, 78, 2024, 2, 94);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010110, 4, 78, 2025, 1, 76);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010110, 4, 69, 2025, 2, 91);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010111, 5, 60, 2023, 1, 18);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010111, 5, 64, 2023, 2, 73);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010111, 5, 68, 2024, 1, 94);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010111, 5, 61, 2024, 2, 78);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010111, 5, 65, 2025, 1, 41);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010111, 5, 78, 2025, 2, 24);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010112, 5, 73, 2023, 1, 18);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010112, 5, 75, 2023, 2, 73);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010112, 5, 77, 2024, 1, 94);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010112, 5, 78, 2024, 2, 30);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010112, 5, 67, 2025, 1, 37);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010112, 5, 78, 2025, 2, 18);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010113, 6, 62, 2023, 1, 31);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010113, 6, 66, 2023, 2, 32);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010113, 6, 70, 2024, 1, 24);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010113, 6, 63, 2024, 2, 86);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010113, 6, 67, 2025, 1, 17);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010113, 6, 71, 2025, 2, 19);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010114, 6, 72, 2023, 1, 16);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010114, 6, 74, 2023, 2, 75);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010114, 6, 76, 2024, 1, 76);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010114, 6, 73, 2024, 2, 83);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010114, 6, 75, 2025, 1, 91);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010114, 6, 78, 2025, 2, 22);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010115, 7, 61, 2023, 1, 17);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010115, 7, 65, 2023, 2, 85);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010115, 7, 69, 2024, 1, 63);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010115, 7, 62, 2024, 2, 64);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010115, 7, 66, 2025, 1, 74);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010115, 7, 70, 2025, 2, 12);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010116, 7, 73, 2023, 1, 15);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010116, 7, 75, 2023, 2, 92);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010116, 7, 78, 2024, 1, 94);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010116, 7, 60, 2024, 2, 94);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010116, 7, 64, 2025, 1, 96);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010116, 7, 68, 2025, 2, 19);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010117, 8, 62, 2023, 1, 60);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010117, 8, 66, 2023, 2, 61);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010117, 8, 70, 2024, 1, 62);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010117, 8, 78, 2024, 2, 63);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010117, 8, 67, 2025, 1, 64);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010117, 8, 78, 2025, 2, 65);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010118, 8, 74, 2023, 1, 18);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010118, 8, 76, 2023, 2, 92);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010118, 8, 77, 2024, 1, 30);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010118, 8, 60, 2024, 2, 40);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010118, 8, 64, 2025, 1, 41);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010118, 8, 68, 2025, 2, 42);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010119, 9, 78, 2023, 1, 15);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010119, 9, 75, 2023, 2, 16);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010119, 9, 77, 2024, 1, 17);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010119, 9, 74, 2024, 2, 18);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010119, 9, 61, 2025, 1, 19);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010119, 9, 65, 2025, 2, 19);

INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010120, 9, 63, 2023, 1, 30);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010120, 9, 66, 2023, 2, 91);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010120, 9, 67, 2024, 1, 92);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010120, 9, 60, 2024, 2, 93);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010120, 9, 64, 2025, 1, 94);
INSERT INTO enseigne (id_personne, id_discipline, id_formation, AA, S, nbHeureEns) VALUES (1010120, 9, 78, 2025, 2, 95);


 
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 1, 60, 0, 1, 36);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 1, 61, 1, 2, 44);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 2, 62, 2, 3, 22.30);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 2, 63, 3, 4, 14.40);

INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 1, 64, 4, 5, 44.10);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 1, 65, 5, 6, 30);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 2, 66, 6, 1, 10.30);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 2, 67, 7, 2, 09.15);

INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 1, 68, 8, 3, 55);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 1, 69, 9, 4, 22.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 2, 70, 0, 5, 36.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 2, 71, 1, 6, 22);

INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 1, 72, 2, 1, 68.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 1, 73, 3, 2, 78.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 2, 74, 4, 3, 41.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 2, 75, 5, 4, 22.35);

INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 1, 76, 6, 5, 78.20);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 1, 77, 7, 6, 29.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 2, 78, 8, 1, 39.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 2, 60, 9, 2, 40);

INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 1, 61, 0, 3, 50);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 1, 62, 1, 4, 64.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 2, 63, 2, 5, 30.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 2, 64, 3, 6, 61.10);

INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 1, 65, 4, 1, 50);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 1, 66, 5, 2, 40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 2, 67, 6, 3, 40.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 2, 68, 7, 4, 22.38);

INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 1, 69, 8, 5, 47.45);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 1, 70, 9, 6, 29.45);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 2, 71, 0, 1, 36.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 2, 72, 1, 2, 80);

INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 1, 73, 2, 3, 44.15);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 1, 74, 3, 4, 22.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 2, 75, 4, 5, 36.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 2, 76, 5, 6, 22);

INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 1, 77, 6, 1, 36);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 1, 78, 7, 2, 78);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 2, 60, 8, 3, 36.25);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 2, 61, 9, 4, 22.30);

INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 1, 62, 0, 5, 25.50);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 1, 63, 1, 6, 61.10);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 2, 64, 2, 1, 74.10);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 2, 65, 3, 2, 59);

INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 1, 66, 4, 3, 31);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 1, 67, 5, 4, 35.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 2, 68, 6, 5, 40.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 2, 69, 7, 6, 20.55);

INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 1, 70, 8, 1, 92.10);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 1, 71, 9, 2, 30);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 2, 72, 0, 3, 45.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 2, 73, 1, 4, 47);

INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 1, 74, 2, 5, 57);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 1, 75, 3, 6, 53.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 2, 76, 4, 1, 41.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 2, 77, 5, 2, 30);

INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 1, 78, 6, 3, 34);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 1, 60, 7, 4, 74.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 2, 61, 8, 5, 14.55);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 2, 62, 9, 6, 42);

INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2023, 1, 63, 0, 1, 41);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2024, 1, 64, 1, 2, 55.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 2, 65, 2, 3, 41.40);
INSERT INTO besoin (AA, S, id_formation, id_discipline, id_departement, besoin_heure) VALUES (2025, 2, 66, 3, 4, 99);


INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010100, 1);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010101, 2);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010103, 3);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010104, 4);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010105, 5);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010106, 6);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010107, 7);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010108, 8);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010109, 9);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010110, 1);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010111, 2);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010112, 3);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010113, 4);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010114, 5);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010115, 6);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010116, 7);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010117, 8);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010118, 9);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010119, 1);
INSERT INTO connaitAussi (id_personne, id_discipline) VALUES (1010120, 2);




INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010100, 1, 2023, 1, 0.5); 
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010100, 2, 2023, 2, 0.5); 


INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010106, 3, 2024, 1, 0.6); 
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010106, 4, 2024, 2, 0.4); 


INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010103, 5, 2025, 1, 0.7);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010103, 6, 2025, 2, 0.3); 


INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010104, 1, 2023, 2, 0.50);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010104, 2, 2023, 2, 0.30);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010104, 3, 2024, 1, 0.20);


INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010107, 4, 2023, 1, 0.10);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010107, 5, 2025, 2, 0.15);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010107, 6, 2025, 1, 0.60);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010107, 1, 2025, 2, 0.15);



INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010108, 2, 2024, 1, 0.30);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010108, 2, 2024, 2, 0.30);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010108, 3, 2025, 1, 0.40);


INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010109, 4, 2024, 1, 0.50);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010109, 4, 2024, 2, 0.50);


INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010110, 5, 2023, 2, 0.70);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010110, 6, 2024, 2, 0.20);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010110, 1, 2025, 1, 0.10);

INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010111, 6, 2025, 2, 0.40);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010111, 6, 2025, 1, 0.40);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010111, 5, 2024, 2, 0.20);


INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010112, 4, 2024, 2, 0.40);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010112, 2, 2024, 1, 0.40);


INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010113, 3, 2023, 1, 0.15);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010113, 3, 2023, 2, 0.35);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010113, 6, 2024, 1, 0.35);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010113, 6, 2024, 2, 0.15);


INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010114, 1, 2023, 2, 0.10);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010114, 2, 2023, 2, 0.10);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010114, 1, 2024, 2, 0.10);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010114, 2, 2024, 2, 0.25);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010114, 3, 2025, 2, 0.45);


INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010115, 4, 2025, 1, 0.80);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010115, 5, 2025, 2, 0.20);


INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010116, 6, 2023, 1, 0.65);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010116, 2, 2024, 2, 0.35);

INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010102, 2, 2023, 1, 0.90);
INSERT INTO assigner (id_personne, id_departement, AA, S, quotite) VALUES (1010121, 1, 2024, 2, 0.90);




DROP TABLE IF EXISTS Films /*,Salles, Seances, Clients, Reservations*/;

-- Table des films
CREATE TABLE Films (
    IDFilm SERIAL PRIMARY KEY,
    Titre VARCHAR(100),
    Genre VARCHAR(50),
    Duree INT,
    AnneeSortie INT,
    Realisateur VARCHAR(100)
);

-- Ajouter des films à la table "Films"
INSERT INTO Films (Titre, Genre, Duree, AnneeSortie, Realisateur)
VALUES ('Le Roi Lion', 'Animation', 90, 1994, 'Roger Allers, Rob Minkoff');

INSERT INTO Films (Titre, Genre, Duree, AnneeSortie, Realisateur)
VALUES ('La Belle et la Bête', 'Animation', 84, 1991, 'Gary Trousdale, Kirk Wise');

INSERT INTO Films (Titre, Genre, Duree, AnneeSortie, Realisateur)
VALUES ('Pirates des Caraïbes : La Malédiction du Black Pearl', 'Action', 143, 2003, 'Gore Verbinski');

/*-- Table des salles
CREATE TABLE Salles (
    IDSalle INT PRIMARY KEY,
    NumeroSalle INT,
    Capacite INT
);

-- Table des séances
CREATE TABLE Seances (
    IDSeance INT PRIMARY KEY,
    IDFilm INT,
    IDSalle INT,
    HeureDebut TIME,
    Jour DATE,
    FOREIGN KEY (IDFilm) REFERENCES Films(IDFilm),
    FOREIGN KEY (IDSalle) REFERENCES Salles(IDSalle)
);

-- Table des clients
CREATE TABLE Clients (
    IDClient INT PRIMARY KEY,
    Nom VARCHAR(50),
    Prenom VARCHAR(50),
    Email VARCHAR(100)
);

-- Table des réservations
CREATE TABLE Reservations (
    IDReservation INT PRIMARY KEY,
    IDClient INT,
    IDSeance INT,
    NombrePlaces INT,
    FOREIGN KEY (IDClient) REFERENCES Clients(IDClient),
    FOREIGN KEY (IDSeance) REFERENCES Seances(IDSeance)
); */

DROP TABLE IF EXISTS Films;


CREATE TABLE Films (
    IDFilm SERIAL PRIMARY KEY,
    Titre VARCHAR(100),
    Genre VARCHAR(50),
    Duree INT,
    AnneeSortie INT,
    Realisateur VARCHAR(100)
);


INSERT INTO Films (Titre, Genre, Duree, AnneeSortie, Realisateur)
VALUES ('Le Roi Lion', 'Animation', 90, 1994, 'Roger Allers, Rob Minkoff');

INSERT INTO Films (Titre, Genre, Duree, AnneeSortie, Realisateur)
VALUES ('La Belle et la Bête', 'Animation', 84, 1991, 'Gary Trousdale, Kirk Wise');

INSERT INTO Films (Titre, Genre, Duree, AnneeSortie, Realisateur)
VALUES ('Pirates des Caraïbes : La Malédiction du Black Pearl', 'Action', 143, 2003, 'Gore Verbinski');
-- Création de la table
CREATE TABLE sondage (
    id SERIAL PRIMARY KEY,
    question TEXT NOT NULL,
    pour INT NOT NULL,
    contre INT NOT NULL
);

-- Insertion des données
INSERT INTO sondage (question, pour, contre) VALUES 
    ('Pour ou contre les souls like ?', 115, 127),
    ('Pour ou contre café ?', 4, 2),
    ('Pour ou contre les cours de M.Finta ?', 155, 5),
    ('Pour ou contre Linux ?', 138, 14),
    ('Pour ou contre le thé ?', 42, 13),
    ('Pour ou contre l ecole le samedi ?', 0, 1200),
    ('Pour ou contre Amazon ?', 10, 6),
    ('Pour ou contre tiktok ?', 7, 101),
    ('Pour ou contre Instagram ?', 38, 10);

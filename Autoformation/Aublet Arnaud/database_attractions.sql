DROP TABLE IF EXISTS attractions;

CREATE TABLE attractions (
    id INT,
    nom VARCHAR(128) NOT NULL,
    taille_min_accompagnee INT,
    taille_min_seul INT NOT NULL,
    categorie VARCHAR(128) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO attractions VALUES (1, 'Les Petites Chaises Volantes', NULL, 80, 'Petit gaulois');
INSERT INTO attractions VALUES (2, 'L Escadrille des As', NULL, 90, 'Petit gaulois');
INSERT INTO attractions VALUES (3, 'Le Mini Carrousel', NULL, 70, 'Petit gaulois');
INSERT INTO attractions VALUES (4, 'Lavomatix', NULL, 80, 'Petit gaulois');
INSERT INTO attractions VALUES (5, 'Enigmatix', NULL, 90, 'Petit gaulois');
INSERT INTO attractions VALUES (6, 'Hydrolix', 80, 100, 'Petit gaulois');
INSERT INTO attractions VALUES (7, 'Etamine', 80, 105, 'Petit gaulois');
INSERT INTO attractions VALUES (8, 'Aérodynamix', 90, 120, 'Petit gaulois');
INSERT INTO attractions VALUES (9, 'Le Petit Train', 50, 100, 'Petit gaulois');
INSERT INTO attractions VALUES (10, 'Les Petits Chars Tamponneurs', NULL, 90, 'Petit gaulois');
INSERT INTO attractions VALUES (11, 'Aire de jeux Viking', NULL, 10, 'Petit gaulois');
INSERT INTO attractions VALUES (12, 'Aire de jeux Panoramix', NULL, 10, 'Petit gaulois');
INSERT INTO attractions VALUES (13, 'Air de jeux du Petit Chêne', NULL, 10, 'Petit gaulois');
INSERT INTO attractions VALUES (14, 'Air de jeux du Sanglier d Or', NULL, 10, 'Petit gaulois');
INSERT INTO attractions VALUES (15, 'Chez Gyrofolix', 105, 120, 'Pour toute la famille');
INSERT INTO attractions VALUES (16, 'SOS Numérobis', 90, 120, 'Pour toute la famille');
INSERT INTO attractions VALUES (17, 'Les Chaudrons', 90, 120, 'Pour toute la famille');
INSERT INTO attractions VALUES (18, 'La Petite Tempête', 90, 120, 'Pour toute la famille');
INSERT INTO attractions VALUES (19, 'Attention Menhir', 80, 110, 'Pour toute la famille');
INSERT INTO attractions VALUES (20, 'Les Espions de César', 90, 130, 'Pour toute la famille');
INSERT INTO attractions VALUES (21, 'Pégase Express', 100, 130, 'Pour toute la famille');
INSERT INTO attractions VALUES (22, 'Le Défi de César', 100, 120, 'Pour toute la famille');
INSERT INTO attractions VALUES (23, 'L Aventure Astérix', NULL, 0, 'Pour toute la famille');
INSERT INTO attractions VALUES (24, 'L Oxygénarium', 100, 130, 'Pour toute la famille');
INSERT INTO attractions VALUES (25, 'Le Vol d Icare', 100, 130, 'Pour toute la famille');
INSERT INTO attractions VALUES (26, 'L Hydre de Lerne', 100, 130, 'Pour toute la famille');
INSERT INTO attractions VALUES (27, 'Epidemaîs Croisière', 50, 120, 'Pour toute la famille');
INSERT INTO attractions VALUES (28, 'La Rivière d Elis', 50, 120, 'Pour toute la famille');
INSERT INTO attractions VALUES (29, 'Les Petits Drakkars', 50, 120, 'Pour toute la famille');
INSERT INTO attractions VALUES (30, 'Les Chevaux du Roy', 50, 120, 'Pour toute la famille');
INSERT INTO attractions VALUES (31, 'Le Carrousel de César', 50, 120, 'Pour toute la famille');
INSERT INTO attractions VALUES (32, 'Discobélix', NULL, 120, 'Pour toute la famille');
INSERT INTO attractions VALUES (34, 'Toutatis', NULL, 130, 205, 'Sensations fortes');
INSERT INTO attractions VALUES (35, 'Tonnerre 2 Zeus', NULL, 120, 'Sensations fortes');
INSERT INTO attractions VALUES (36, 'La Galère', NULL, 120, 'Sensations fortes');
INSERT INTO attractions VALUES (37, 'Les Chaises Volantes', NULL, 120, 'Sensations fortes');
INSERT INTO attractions VALUES (38, 'OzIris', NULL, 130, NULL, 'Sensations fortes');
INSERT INTO attractions VALUES (39, 'La Trace du Hourra', 120, 130, 'Sensations fortes');
INSERT INTO attractions VALUES (40, 'Goudurix', NULL, 140, 'Sensations fortes');
INSERT INTO attractions VALUES (41, 'Le Cheval de Troie', NULL, 140, 'Sensations fortes');

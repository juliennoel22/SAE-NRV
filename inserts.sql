-- Insert test data into `lieu` table
INSERT INTO lieu (lieu_nom, lieu_adresse, lieu_nb_places_assises, lieu_nb_places_debout)
VALUES
('Lieu A', '123 Rue A', 100, 200),
('Lieu B', '456 Rue B', 150, 250),
('Lieu C', '789 Rue C', 200, 300);

-- Insert test data into `soiree` table
INSERT INTO soiree (soiree_nom, soiree_thematique, soiree_date, soiree_horaire_debut, soiree_lieu_id, soiree_tarif)
VALUES
('Soiree A', 'Thematique A', '2023-12-01', '18:00:00', 1, 20.00),
('Soiree B', 'Thematique B', '2023-12-02', '19:00:00', 2, 25.00),
('Soiree C', 'Thematique C', '2023-12-03', '20:00:00', 3, 30.00);

-- Insert test data into `spectacle` table
INSERT INTO spectacle (spectacle_titre, spectacle_description, spectacle_style_musique, spectacle_duree, spectacle_horaire, spectacle_soiree_id)
VALUES
('Spectacle A', 'Description A', 'Rock', '01:30:00', '18:00:00', 1),
('Spectacle B', 'Description B', 'Jazz', '02:00:00', '19:00:00', 2),
('Spectacle C', 'Description C', 'Pop', '01:45:00', '17:30:00', 3);

-- Insert test data into `image` table
INSERT INTO image (image_url, image_spectacle_id, image_soiree_id)
VALUES
('spectacle_1.png', 1, NULL),
('spectacle_2.png', 2, NULL),
('spectacle_1.png', NULL, 1);

-- Insert test data into `video` table
INSERT INTO video (video_url, video_spectacle_id, video_soiree_id)
VALUES
('', 1, NULL),
('', 2, NULL),
('', NULL, 1);

-- Insert test data into `artiste` table
INSERT INTO artiste (artiste_nom, artiste_prenom)
VALUES
('Artiste', 'A'),
('Artiste', 'B'),
('Artiste', 'C');

-- Insert test data into `artiste_to_spectacle` table
INSERT INTO artiste_to_spectacle (artiste_to_spectacle_artiste_id, artiste_to_spectacle_spectacle_id)
VALUES
(1, 1),
(2, 2),
(3, 3);

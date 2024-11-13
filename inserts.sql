-- Table role
INSERT INTO role (role_nom, role_niveau)
VALUES ('Admin', 1),
       ('Utilisateur', 2);

-- Table lieu
INSERT INTO lieu (lieu_nom, lieu_adresse, lieu_nb_places_assises, lieu_nb_places_debout)
VALUES ('Théâtre National', '123 Rue de la Culture', 200, 50),
       ('Salle de Concert Zenith', '456 Avenue de la Musique', 0, 500);

-- Table soiree
INSERT INTO soiree (soiree_nom, soiree_thematique, soiree_date, soiree_horaire_debut, soiree_lieu_id, soiree_tarif)
VALUES ('Soirée Jazz', 'Jazz et improvisation', '2024-12-01', '19:00:00', 1, 15.00),
       ('Rock Night', 'Rock et énergie', '2024-12-05', '20:00:00', 2, 20.00);

-- Table utilisateur
INSERT INTO utilisateur (utilisateur_nom, utilisateur_prenom, utilisateur_email, utilisateur_password, role_id)
VALUES ('Dupont', 'Jean', 'jean.dupont@example.com', 'password123', 2),
       ('Martin', 'Alice', 'alice.martin@example.com', 'password456', 1);


-- Table spectacle
INSERT INTO spectacle (spectacle_titre, spectacle_description, spectacle_style_musique, spectacle_duree,
                       spectacle_horaire, spectacle_soiree_id)
VALUES ('Concert Jazz', 'Concert de jazz avec musiciens renommés', 'Jazz', '01:30:00', '2024-12-01 19:00:00', 1),
       ('Rock Show', 'Spectacle rock énergique', 'Rock', '02:00:00', '2024-12-05 20:00:00', 2);

-- Table artiste
INSERT INTO artiste (artiste_nom, artiste_prenom)
VALUES ('Miles', 'Davis'),
       ('Jim', 'Morrison');

-- Table artiste_to_spectacle
INSERT INTO artiste_to_spectacle (artiste_to_spectacle_artiste_id, artiste_to_spectacle_spectacle_id)
VALUES (1, 1),
       (2, 2);

-- Insertion des images des spectacles 1 et 2
INSERT INTO image (image_id, image_url, image_spectacle_id, image_lieu_id) VALUES (1, 'spectacle_1.png', 1, 1);
INSERT INTO image (image_id, image_url, image_spectacle_id, image_lieu_id) VALUES (2, 'spectacle_2.png', 2, 1);

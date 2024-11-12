DROP DATABASE IF EXISTS `nrv_database`;

CREATE DATABASE IF NOT EXISTS `nrv_database`;

USE `nrv_database`;

CREATE TABLE role
(
    role_id     INT PRIMARY KEY AUTO_INCREMENT,
    role_nom    VARCHAR(255) NOT NULL,
    role_niveau INT          NOT NULL
);

CREATE TABLE utilisateur
(
    utilisateur_id       INT PRIMARY KEY AUTO_INCREMENT,
    utilisateur_nom      VARCHAR(255)        NOT NULL,
    utilisateur_prenom   VARCHAR(255)        NOT NULL,
    utilisateur_email    VARCHAR(255) UNIQUE NOT NULL,
    utilisateur_password VARCHAR(255)        NOT NULL,
    role_id  INT DEFAULT 1
#     FOREIGN KEY (utilisateur_role_id) REFERENCES role (role_id)
);


CREATE TABLE lieu
(
    lieu_id                INT PRIMARY KEY AUTO_INCREMENT,
    lieu_nom               VARCHAR(255) NOT NULL,
    lieu_adresse           VARCHAR(255) NOT NULL,
    lieu_nb_places_assises INT DEFAULT 0,
    lieu_nb_places_debout  INT DEFAULT 0
);

CREATE TABLE soiree
(
    soiree_id            INT PRIMARY KEY AUTO_INCREMENT,
    soiree_nom           VARCHAR(255) NOT NULL,
    soiree_thematique    VARCHAR(255)   DEFAULT NULL,
    soiree_date          DATE         NOT NULL,
    soiree_horaire_debut DATE         NOT NULL,
    soiree_lieu_id       INT          NOT NULL,
    soiree_tarif         DECIMAL(10, 2) DEFAULT 0
#     FOREIGN KEY (soiree_lieu_id) REFERENCES lieu (lieu_id)
);


CREATE TABLE spectacle
(
    spectacle_id            INT PRIMARY KEY AUTO_INCREMENT,
    spectacle_titre         VARCHAR(255) NOT NULL,
    spectacle_description   TEXT,
    spectacle_style_musique VARCHAR(255),
    spectacle_duree         DATE,
    spectacle_horaire       DATE,
    spectacle_soiree_id     INT          NOT NULL
#     FOREIGN KEY (spectacle_soiree_id) REFERENCES soiree (soiree_id)
);


CREATE TABLE image
(
    image_id           INT PRIMARY KEY AUTO_INCREMENT,
    image_url          VARCHAR(255) NOT NULL,
    image_spectacle_id INT,
    image_lieu_id      INT
#     FOREIGN KEY (image_spectacle_id) REFERENCES spectacle (spectacle_id),
#     FOREIGN KEY (image_lieu_id) REFERENCES lieu (lieu_id)
);



CREATE TABLE video
(
    video_id           INT PRIMARY KEY AUTO_INCREMENT,
    video_url          VARCHAR(255) NOT NULL,
    video_spectacle_id INT
#     FOREIGN KEY (video_spectacle_id) REFERENCES spectacle (spectacle_id)
);


CREATE TABLE artiste
(
    artiste_id     INT PRIMARY KEY AUTO_INCREMENT,
    artiste_nom    VARCHAR(255) NOT NULL,
    artiste_prenom VARCHAR(255) NOT NULL
);

CREATE TABLE artiste_to_spectacle
(
    artiste_to_spectacle_artiste_id   INT NOT NULL,
    artiste_to_spectacle_spectacle_id INT NOT NULL,
    PRIMARY KEY (artiste_to_spectacle_artiste_id, artiste_to_spectacle_spectacle_id)
#     FOREIGN KEY (artiste_to_spectacle_artiste_id) REFERENCES artiste (artiste_id),
#     FOREIGN KEY (artiste_to_spectacle_spectacle_id) REFERENCES spectacle (spectacle_id)
);

CREATE TABLE preference
(
    preference_utilisateur_id INT NOT NULL,
    preference_spectacle_id   INT NOT NULL,
    PRIMARY KEY (preference_utilisateur_id, preference_spectacle_id)
#     FOREIGN KEY (preference_utilisateur_id) REFERENCES utilisateur (utilisateur_id),
#     FOREIGN KEY (preference_spectacle_id) REFERENCES spectacle (spectacle_id)
);



ALTER TABLE utilisateur
    ADD FOREIGN KEY (role_id) REFERENCES role (role_id);
ALTER TABLE soiree
    ADD FOREIGN KEY (soiree_lieu_id) REFERENCES lieu (lieu_id);
ALTER TABLE spectacle
    ADD FOREIGN KEY (spectacle_soiree_id) REFERENCES soiree (soiree_id);
ALTER TABLE image
    ADD FOREIGN KEY (image_spectacle_id) REFERENCES spectacle (spectacle_id);
ALTER TABLE image
    ADD FOREIGN KEY (image_lieu_id) REFERENCES lieu (lieu_id);
ALTER TABLE video
    ADD FOREIGN KEY (video_spectacle_id) REFERENCES spectacle (spectacle_id);
ALTER TABLE artiste_to_spectacle
    ADD FOREIGN KEY (artiste_to_spectacle_artiste_id) REFERENCES artiste (artiste_id);
ALTER TABLE artiste_to_spectacle
    ADD FOREIGN KEY (artiste_to_spectacle_spectacle_id) REFERENCES spectacle (spectacle_id);
ALTER TABLE preference
    ADD FOREIGN KEY (preference_utilisateur_id) REFERENCES utilisateur (utilisateur_id);
ALTER TABLE preference
    ADD FOREIGN KEY (preference_spectacle_id) REFERENCES spectacle (spectacle_id);


INSERT INTO role (role_nom, role_niveau) VALUES ('Utilisateur', 100);
INSERT INTO role (role_nom, role_niveau) VALUES ('Administrateur', 100);

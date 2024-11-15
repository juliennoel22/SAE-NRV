<?php

namespace iutnc\NRV\classes\Database;

use Exception;
use PDO;
use PDOException;

class NRVRepository
{
    private static ?PDO $database;

    private static ?NRVRepository $instance = null;

    /**
     * @throws Exception
     */
    private function __construct()
    {
        try {
            self::$database = new PDO($_ENV['DB_CONNECTION'] . ":host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_DATABASE'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"]);
        } catch (PDOException $e) {
            throw new Exception("Echec de la connexion à la base de données: " . $e->getMessage());
        }
    }

    public static function getInstance(): ?NRVRepository
    {
        if (is_null(self::$instance)) {
            self::$instance = new NRVRepository();
        }
        return self::$instance;
    }

    /**
     * @throws Exception
     */
    public function registerUser(string $utilisateur_nom, string $utilisateur_prenom, string $utilisateur_email, string $utilisateur_password_hashed): void
    {
        try {
            $query = "INSERT INTO utilisateur (utilisateur_nom, utilisateur_prenom, utilisateur_email, utilisateur_password) VALUES (:utilisateur_nom, :utilisateur_prenom, :utilisateur_email, :utilisateur_password)";
            $stmt = self::$database->prepare($query);
            $stmt->bindParam(':utilisateur_nom', $utilisateur_nom);
            $stmt->bindParam(':utilisateur_prenom', $utilisateur_prenom);
            $stmt->bindParam(':utilisateur_email', $utilisateur_email);
            $stmt->bindParam(':utilisateur_password', $utilisateur_password_hashed);
            $stmt->execute();
        } catch (PDOException $e) {

            if ($e->errorInfo[1] == 1062) {
                throw new Exception("Cet email est déjà utilisé.");
            }

            throw new Exception("Erreur lors de l'insertion dans la base de données: " . $e->getMessage());
        }
    }

    public function loginUser(string $utilisateur_email, string $utilisateur_password): bool
    {
        $query = "SELECT utilisateur_password FROM utilisateur WHERE utilisateur_email = :utilisateur_email";
        $stmt = self::$database->prepare($query);
        $stmt->bindParam(':utilisateur_email', $utilisateur_email);
//        $stmt->bindParam(':utilisateur_password', $utilisateur_password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && isset($user['utilisateur_password'])) {
            return password_verify($utilisateur_password, $user['utilisateur_password']);
        }
        return false;
    }

    public function getUserByEmail(string $utilisateur_email): array
    {
        $query = "SELECT * FROM utilisateur JOIN role on role.role_id = utilisateur.role_id WHERE utilisateur_email = :utilisateur_email";
        $stmt = self::$database->prepare($query);
        $stmt->bindParam(':utilisateur_email', $utilisateur_email);
        $stmt->execute();
        return $this->returnWithoutPassword($stmt->fetch(PDO::FETCH_ASSOC));

    }

    private function returnWithoutPassword(array $user): array
    {
        if ($user) {
            unset($user['utilisateur_password']);
        }
        return $user;
    }

    public function getAllSpectacles(): bool|array
    {
        $query = "SELECT
                        spectacle.*,
                        soiree.soiree_date AS spectacle_date,
                        spectacle.spectacle_horaire AS spectacle_horaire,
                        image.image_url AS image_spectacle_url
                FROM spectacle
                JOIN soiree ON spectacle.spectacle_soiree_id = soiree.soiree_id
                LEFT JOIN image ON spectacle.spectacle_id = image.image_spectacle_id";
        $stmt = self::$database->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSoireeById(int $soiree_id): array
    {
        $query = "
            SELECT
                soiree.*,
                image.image_url AS image_url,
                video.video_url AS video_url
            FROM
                soiree
            LEFT JOIN
                image ON soiree.soiree_id = image.image_soiree_id
            LEFT JOIN
                video ON soiree.soiree_id = video.video_soiree_id
            WHERE
                soiree.soiree_id = :soiree_id
            ";
        $stmt = self::$database->prepare($query);
        $stmt->bindParam(':soiree_id', $soiree_id);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $soiree = [];
        if (!empty($results)) {
            $soiree = $results[0];
            $soiree['images'] = [];
            $soiree['videos'] = [];

            foreach ($results as $row) {
                if (!empty($row['image_url'])) {
                    $soiree['images'][] = $row['image_url'];
                }
                if (!empty($row['video_url'])) {
                    $soiree['videos'][] = $row['video_url'];
                }
            }
        }

        return $soiree;
    }

    public function addImageToSoiree(int $soiree_id, string $image_url): void
    {
        $query = "INSERT INTO image (image_url, image_soiree_id) VALUES (:image_url, :soiree_id)";
        $stmt = self::$database->prepare($query);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->bindParam(':soiree_id', $soiree_id);
        $stmt->execute();
    }

    public function addVideoToSoiree(int $soiree_id, string $video_url): void
    {
        $query = "INSERT INTO video (video_url, video_soiree_id) VALUES (:video_url, :soiree_id)";
        $stmt = self::$database->prepare($query);
        $stmt->bindParam(':video_url', $video_url);
        $stmt->bindParam(':soiree_id', $soiree_id);
        $stmt->execute();
    }

    public function addSoiree(string $nom, ?string $thematique, string $date, string $horaire_debut, int $lieu_id, float $tarif): void
    {
        $query = "INSERT INTO soiree (soiree_nom, soiree_thematique, soiree_date, soiree_horaire_debut, soiree_lieu_id, soiree_tarif) VALUES (:nom, :thematique, :date, :horaire_debut, :lieu_id, :tarif)";
        $stmt = self::$database->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':thematique', $thematique);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':horaire_debut', $horaire_debut);
        $stmt->bindParam(':lieu_id', $lieu_id);
        $stmt->bindParam(':tarif', $tarif);
        $stmt->execute();
    }

    public function addSpectacle(string $titre, ?string $description, ?string $style_musique, ?string $duree, string $horaire, int $soiree_id): void
    {
        $query = "INSERT INTO spectacle (spectacle_titre, spectacle_description, spectacle_style_musique, spectacle_duree, spectacle_horaire, spectacle_soiree_id) VALUES (:titre, :description, :style_musique, :duree, :horaire, :soiree_id)";
        $stmt = self::$database->prepare($query);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':style_musique', $style_musique);
        $stmt->bindParam(':duree', $duree);
        $stmt->bindParam(':horaire', $horaire);
        $stmt->bindParam(':soiree_id', $soiree_id);
        $stmt->execute();
    }

    public function getAllLieux(): array
    {
        $query = "SELECT DISTINCT lieu_id, lieu_nom FROM lieu";
        $stmt = self::$database->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllStyles(): array
    {
        $query = "SELECT DISTINCT spectacle_style_musique FROM spectacle";
        $stmt = self::$database->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllSoirees(): array
    {
        $query = "SELECT soiree_id, soiree_nom FROM soiree";
        $stmt = self::$database->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addLieu(string $nom, string $adresse, int $nb_places_assises, int $nb_places_debout): void
    {
        $query = "INSERT INTO lieu (lieu_nom, lieu_adresse, lieu_nb_places_assises, lieu_nb_places_debout) VALUES (:nom, :adresse, :nb_places_assises, :nb_places_debout)";
        $stmt = self::$database->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':nb_places_assises', $nb_places_assises);
        $stmt->bindParam(':nb_places_debout', $nb_places_debout);
        $stmt->execute();
    }

    public function addArtiste(string $nom, string $prenom): void
    {
        $query = "INSERT INTO artiste (artiste_nom, artiste_prenom) VALUES (:nom, :prenom)";
        $stmt = self::$database->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->execute();
    }

    public function addArtisteToSpectacle(int $artiste_id, int $spectacle_id): void
    {
        $query = "INSERT INTO artiste_to_spectacle (artiste_to_spectacle_artiste_id, artiste_to_spectacle_spectacle_id) VALUES (:artiste_id, :spectacle_id)";
        $stmt = self::$database->prepare($query);
        $stmt->bindParam(':artiste_id', $artiste_id);
        $stmt->bindParam(':spectacle_id', $spectacle_id);
        $stmt->execute();
    }

    public function getAllArtistes(): array
    {
        $query = "SELECT artiste_id, artiste_nom, artiste_prenom FROM artiste";
        $stmt = self::$database->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function filterSpectacles($date = null, $lieu = null, $style = null): array
    {
        $query = "SELECT spectacle.spectacle_titre AS spectacle_titre, 
                     soiree.soiree_date AS spectacle_date, 
                     spectacle.spectacle_horaire AS spectacle_horaire, 
                     image.image_url AS image_spectacle_url 
              FROM spectacle
              JOIN soiree ON spectacle.spectacle_soiree_id = soiree.soiree_id
              LEFT JOIN image ON spectacle.spectacle_id = image.image_spectacle_id";

        $conditions = []; // Tableau pour stocker les conditions de filtrage

        if ($date) {
            $conditions[] = "soiree.soiree_date = :date";
        }
        if ($lieu) {
            $conditions[] = "soiree.soiree_lieu_id= :lieu";
        }
        if ($style) {
            $conditions[] = "spectacle.spectacle_style_musique = :style";
        }

        // Si on a des conditions, on les ajoute avec WHERE ou AND
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = self::$database->prepare($query);

        // Liaison des paramètres en fonction des filtres disponibles
        if ($date) {
            $stmt->bindParam(':date', $date);
        }
        if ($lieu) {
            $stmt->bindParam(':lieu', $lieu);
        }
        if ($style) {
            $stmt->bindParam(':style', $style);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
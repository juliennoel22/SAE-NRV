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
        $query = "SELECT * FROM utilisateur WHERE utilisateur_email = :utilisateur_email AND utilisateur_password = :utilisateur_password";
        $stmt = self::$database->prepare($query);
        $stmt->bindParam(':utilisateur_email', $utilisateur_email);
        $stmt->bindParam(':utilisateur_password', $utilisateur_password);
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
}
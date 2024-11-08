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

    public function registerUser(string $nom, string $prenom, string $email, string $hashed_password): bool
    {
        $query = "INSERT INTO utilisateur (utilisateur_nom, utilisateur_prenom, utilisateur_email, utilisateur_password) VALUES (:nom, :prenom, :email, :password)";
        $stmt = self::$database->prepare($query);
        $stmt->bindParam(':nom', $name);
        $stmt->bindParam(':prenom', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        return $stmt->execute();
    }

    public function loginUser(string $email, string $password): bool
    {
        $query = "SELECT * FROM utilisateur WHERE utilisateur_email = :email AND utilisateur_password = :password";
        $stmt = self::$database->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && isset($user['utilisateur_password'])) {
            return password_verify($password, $user['utilisateur_password']);
        }
        return false;
    }
}
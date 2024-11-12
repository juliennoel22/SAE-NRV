<?php

namespace iutnc\NRV\classes\Auth;

use Exception;
use iutnc\NRV\classes\Database\NRVRepository;
use iutnc\NRV\classes\Models\User;

class Authn
{
    private NRVRepository $NRVRepository;

    public function __construct()
    {
        $this->NRVRepository = NRVRepository::getInstance();
    }

    public static function isUserLoggedIn(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function getAuthenticatedUser(): ?User
    {
        return Authn::isUserLoggedIn() ? unserialize($_SESSION['user']) : null;
    }

    /**
     * @throws Exception
     */
    public function registerUser(string $utilisateur_nom, string $utilisateur_prenom, string $utilisateur_email, string $hashed_password): bool
    {
        try {
            // étape 1 : Enregistrer l'utilisateur
            $this->NRVRepository->registerUser($utilisateur_nom, $utilisateur_prenom, $utilisateur_email, $hashed_password);
            $user = new User($utilisateur_email);

            // étape 2 : Enregistrer l'utilisateur dans la session
            $_SESSION['user'] = serialize($user);

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function loginUser(string $utilisateur_email, string $utilisateur_password): bool
    {
        try {
            if ($this->NRVRepository->loginUser($utilisateur_email, $utilisateur_password)) {
                $user = new User($utilisateur_email);
                // Enregistrer l'utilisateur dans la session
                $_SESSION['user'] = serialize($user);
                return true;
            }
            throw new Exception('Identifiants incorrects.');

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function logoutUser(): void
    {
        // Détruire la session
        session_start();
        session_unset();
        session_destroy();
    }
}
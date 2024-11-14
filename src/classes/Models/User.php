<?php

namespace iutnc\NRV\classes\Models;

use iutnc\NRV\classes\Database\NRVRepository;

class User
{
    private int $utilisateur_id;
    private string $utilisateur_nom;
    private string $utilisateur_prenom;
    private string $utilisateur_email;
    private Permission $utilisateur_role;

    public function __construct(string $utilisateur_email)
    {
        $utilisateur = NRVRepository::getInstance()->getUserByEmail($utilisateur_email);

        $this->utilisateur_id = $utilisateur['utilisateur_id'];
        $this->utilisateur_nom = $utilisateur['utilisateur_nom'];
        $this->utilisateur_prenom = $utilisateur['utilisateur_prenom'];
        $this->utilisateur_email = $utilisateur_email;
        $this->utilisateur_role = new Permission($utilisateur['role_id'], $utilisateur['role_nom'], $utilisateur['role_niveau']);
    }


    public function getUtilisateurId(): int
    {
        return $this->utilisateur_id;
    }

    public function setUtilisateurId(int $utilisateur_id): void
    {
        $this->utilisateur_id = $utilisateur_id;
    }

    public function getUtilisateurNom(): string
    {
        return $this->utilisateur_nom;
    }

    public function setUtilisateurNom(string $utilisateur_nom): void
    {
        $this->utilisateur_nom = $utilisateur_nom;
    }

    public function getUtilisateurPrenom(): string
    {
        return $this->utilisateur_prenom;
    }

    public function setUtilisateurPrenom(string $utilisateur_prenom): void
    {
        $this->utilisateur_prenom = $utilisateur_prenom;
    }

    public function getUtilisateurEmail(): string
    {
        return $this->utilisateur_email;
    }

    public function setUtilisateurEmail(string $utilisateur_email): void
    {
        $this->utilisateur_email = $utilisateur_email;
    }

    public function getUtilisateurRole(): Permission
    {
        return $this->utilisateur_role;
    }

    public function setUtilisateurRole(Permission $utilisateur_role): void
    {
        $this->utilisateur_role = $utilisateur_role;
    }

    public function hasAccess(int $requiredLevel): bool
    {
        return $this->utilisateur_role->getRoleLevel() >= $requiredLevel;
    }

}
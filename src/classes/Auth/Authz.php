<?php

namespace iutnc\NRV\classes\Auth;

use iutnc\NRV\classes\Models\User;

class Authz
{
    public static function isUserLoggedIn(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function getAuthenticatedUser(): User|null
    {
        if (Authn::isUserLoggedIn()) {
            return unserialize($_SESSION['user']);
        }
        return null;
    }
}
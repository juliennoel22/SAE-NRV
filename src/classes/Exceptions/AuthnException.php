<?php

namespace iutnc\NRV\classes\Exceptions;

class AuthnException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct("Erreur d'authentification : $message");
    }

}
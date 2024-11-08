<?php

namespace iutnc\NRV\classes\Exceptions;

class UnknownActionException extends \Exception
{
    public function __construct(string $action)
    {
        parent::__construct("Action inconnue : $action");
    }
}
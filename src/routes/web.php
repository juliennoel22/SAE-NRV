<?php

// Fichier: src/routes/web.php

use iutnc\NRV\classes\Actions\DefaultAction;
use iutnc\NRV\classes\Actions\LoginAction;
use iutnc\NRV\classes\Actions\LogoutAction;
use iutnc\NRV\classes\Actions\RegisterAction;

use iutnc\NRV\classes\Actions\ListSpectaclesAction;

// Autres actions à inclure selon les besoins...

return [
    'default' => DefaultAction::class,
    'login' => LoginAction::class,
    'register' => RegisterAction::class,
    'logout' => LogoutAction::class,
    // Ajouter d'autres routes ici
    'spectacles' => ListSpectaclesAction::class,
];

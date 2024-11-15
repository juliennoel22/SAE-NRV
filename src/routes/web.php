<?php

// Fichier: src/routes/web.php

use iutnc\NRV\classes\Actions\DefaultAction;
use iutnc\NRV\classes\Actions\LoginAction;
use iutnc\NRV\classes\Actions\LogoutAction;
use iutnc\NRV\classes\Actions\RegisterAction;
use iutnc\NRV\classes\Actions\StaffAction;
use iutnc\NRV\classes\Actions\FilterSpectaclesAction;
use iutnc\NRV\classes\Actions\ListSpectaclesAction;
use iutnc\NRV\classes\Actions\AddPreference;
use iutnc\NRV\classes\Actions\ListPreferences;
use iutnc\NRV\classes\Actions\SpectacleAction;

// Autres actions à inclure selon les besoins...

return [
    'default' => DefaultAction::class,
    'login' => LoginAction::class,
    'register' => RegisterAction::class,
    'logout' => LogoutAction::class,
    // Ajouter d'autres routes ici
    'spectacles' => ListSpectaclesAction::class,
    'spectacle' => SpectacleAction::class,
    'staff' => StaffAction::class,
    'filter' => FilterSpectaclesAction::class,
    'addpref' => AddPreference::class,
    'preferences' => ListPreferences::class,


    // Ajouter d'autres routes ici
];

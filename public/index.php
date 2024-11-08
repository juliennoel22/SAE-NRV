<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use iutnc\NRV\core\Dispatcher;

define('ROOT_PATH', dirname(__DIR__ . '../'));

$dotenv = Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();


try {
    // Instancier le dispatcher et exécuter l'action
    $dispatcher = new Dispatcher();
    $dispatcher->dispatch();
} catch (Exception $e) {
    // En cas d'erreur, définir le code de réponse HTTP à 500 et arrêter l'exécution
//    echo 'Erreur du serveur : ' . $e->getMessage();
    http_response_code(500);
    error_log("Erreur du serveur : " . $e->getMessage()); // Log l'erreur pour le suivi
    exit; // Arrêter l'exécution pour renvoyer la page d'erreur 500 d'Apache
}

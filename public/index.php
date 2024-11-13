<?php
session_set_cookie_params(3600);
session_start();
define('ROOT_PATH', dirname(__DIR__ . '../'));

require_once ROOT_PATH . '/vendor/autoload.php';

use Dotenv\Dotenv;
use iutnc\NRV\core\Dispatcher;

$dotenv = Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();

//if ($_ENV['DEBUG_MODE'] === 'true') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
//}


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

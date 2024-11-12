<?php

namespace iutnc\NRV\core;

use iutnc\NRV\classes\Exceptions\UnknownActionException;

class Dispatcher
{
    protected array $routes;

    public function __construct()
    {
        // Charger les routes définies dans web.php
        $this->routes = require ROOT_PATH . '/src/routes/web.php';
    }

    /**
     * @throws UnknownActionException
     */
    public function dispatch(): void
    {
        // Récupérer l'action demandée via le paramètre GET 'action'
        $actionName = $_GET['action'] ?? 'default';

        // Vérifier si l'action existe dans les routes, sinon rediriger vers l'action par défaut
        $actionClass = $this->routes[$actionName] ?? $this->routes['default'];

        if (!class_exists($actionClass)) {
            // Si la classe d'action n'existe pas, déclencher une exception ou renvoyer une erreur
            throw new UnknownActionException($actionClass);
        }

        // Instancier et exécuter l'action
        $action = new $actionClass();
        try {
            echo $action->execute();
        } catch (\Exception $e) {
            // En cas d'erreur, afficher un message d'erreur
            echo '<div class="error">Error: ' . $e->getMessage() . '</div>';
        }
    }
}

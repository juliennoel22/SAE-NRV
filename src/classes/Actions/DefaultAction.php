<?php

namespace iutnc\NRV\classes\Actions;

class DefaultAction extends Action
{
    public function execute(): string
    {
        // Démarrer la mise en tampon de sortie
        ob_start();

        // Inclure le fichier home.php
        include ROOT_PATH . '/src/views/pages/home.php';

        // Récupérer le contenu mis en tampon
        $content = ob_get_clean();

        // Démarrer la mise en tampon de sortie pour le layout
        ob_start();

        // Inclure le layout et passer le contenu principal
        include ROOT_PATH . '/src/views/layout.php';

        // Récupérer le contenu mis en tampon
        return ob_get_clean();
    }
}
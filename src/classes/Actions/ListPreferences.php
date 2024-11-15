<?php

namespace iutnc\NRV\classes\Actions;

use iutnc\NRV\classes\Database\NRVRepository;
use Exception;

class ListPreferences extends Action
{
    public function execute(): string
    {
        try {
            $favoritesIds = isset($_COOKIE['preferences']) ? json_decode($_COOKIE['preferences'], true) : [];

            if (empty($favoritesIds)) {
                throw new Exception("Aucun spectacle n'est ajouté à vos préférences.");
            }

            $repository = NRVRepository::getInstance();
            $spectacles = $repository->getSpectaclesByIds($favoritesIds);

            if (empty($spectacles)) {
                throw new Exception("Les spectacles en favoris n'ont pas pu être trouvés.");
            }

            ob_start();
            include ROOT_PATH . '/src/views/pages/spectacles.php';
            $content = ob_get_clean();
            ob_start();
            include ROOT_PATH . '/src/views/layout.php';
            return ob_get_clean();

        } catch (Exception $e) {
            return $this->render($e->getMessage());
        }
    }

    private function render(string $errorMessage = ''): string
    {
        ob_start();
        include ROOT_PATH . '/src/views/pages/layout.php';
        return ob_get_clean();
    }
}

<?php

namespace iutnc\NRV\classes\Actions;

use Exception;
use iutnc\NRV\classes\Database\NRVRepository;

class SpectacleAction extends Action
{

//    if ($_GET['action'] === 'showDetails' && isset($_GET['id'])) {
//    $action->showSpectacleDetails((int)$_GET['id']);
//    }

//get id from Spectacle.php
    /**
     * @throws Exception
     */
    public function execute(): string
    {

        try {
            $spectacle_id = $_GET['id'] ?? null;
            try {
                $spectacle_id = intval($spectacle_id);
//                var_dump($spectacle_id);
                if ($spectacle_id === 0) {
                    throw new Exception("L'id du spectacle n'est pas prise en charge.");
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }

            $repository = NRVRepository::getInstance();
            $spectacle = $repository->getSpectacleById($spectacle_id);

//            return var_dump($spectacle);

//            var_dump($spectacle);

            if (is_array($spectacle)) {
                return $this->renderPage($spectacle);
            } else {
                throw new Exception("Le spectacle n'existe pas.");
            }
        } catch (Exception $e) {
            return $this->renderPage([], $e->getMessage());
//            return 'marche pas : ' . $e->getMessage();
        }

//        if (isset($_GET['id']) && !empty($_GET['id'])) {
//            $spectacle_id = $_GET['id'];
//            $repository = NRVRepository::getInstance();
//            $spectacle = $repository->getSpectacleById($spectacle_id);
//            if ($spectacle) {
//                return $this->renderPage($spectacle);
//            } else {
//                return 'Spectacle not found';
//            }
//        } else {
//            return 'Invalid ID';
//        }
    }

    private function renderPage(array $spectacle, string $errorMessage = ''): string
//    private function renderPage(array $spectacle): string
    {
        ob_start();

        include ROOT_PATH . '/src/views/pages/spectacle.php';

        $content = ob_get_clean();

        include ROOT_PATH . '/src/views/layout.php';

        return ob_get_clean();

    }

}

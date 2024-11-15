<?php

namespace iutnc\NRV\classes\Actions;

use Exception;
use iutnc\NRV\classes\Database\NRVRepository;

class soireeAction extends Action
{

//    if ($_GET['action'] === 'showDetails' && isset($_GET['id'])) {
//    $action->showsoireeDetails((int)$_GET['id']);
//    }

//get id from soiree.php
    /**
     * @throws Exception
     */
    public function execute(): string
    {

        try {
            $soiree_id = $_GET['id'] ?? null;
            try {
                $soiree_id = intval($soiree_id);
//                var_dump($soiree_id);
                if ($soiree_id === 0) {
                    throw new Exception("L'id du soiree n'est pas prise en charge.");
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }

            $repository = NRVRepository::getInstance();
            $soiree = $repository->getsoireeById($soiree_id);

//            return var_dump($soiree);

//            var_dump($soiree);

            if (is_array($soiree)) {
                return $this->renderPage($soiree);
            } else {
                throw new Exception("Le soiree n'existe pas.");
            }
        } catch (Exception $e) {
            return $this->renderPage([], $e->getMessage());
//            return 'marche pas : ' . $e->getMessage();
        }

//        if (isset($_GET['id']) && !empty($_GET['id'])) {
//            $soiree_id = $_GET['id'];
//            $repository = NRVRepository::getInstance();
//            $soiree = $repository->getsoireeById($soiree_id);
//            if ($soiree) {
//                return $this->renderPage($soiree);
//            } else {
//                return 'soiree not found';
//            }
//        } else {
//            return 'Invalid ID';
//        }
    }

    private function renderPage(array $soiree, string $errorMessage = ''): string
//    private function renderPage(array $soiree): string
    {
        ob_start();

        include ROOT_PATH . '/src/views/pages/soiree.php';

        $content = ob_get_clean();

        include ROOT_PATH . '/src/views/layout.php';

        return ob_get_clean();

    }

}

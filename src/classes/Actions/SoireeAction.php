<?php

namespace iutnc\NRV\classes\Actions;

use Exception;
use iutnc\NRV\classes\Database\NRVRepository;

class SoireeAction extends Action
{

    /**
     * @throws Exception
     */
    public function execute(): string
    {

        try {
            $soiree_id = $_GET['id'] ?? null;
            try {
                $soiree_id = intval($soiree_id);
                if ($soiree_id === 0) {
                    throw new Exception("L'id de la soiree n'est pas prise en charge.");
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }

            $repository = NRVRepository::getInstance();
            $soiree = $repository->getsoireeById($soiree_id);

            if ($soiree) {
                return $this->renderPage($soiree);
            } else {
                throw new Exception("Le soiree n'existe pas.");
            }
        } catch (Exception $e) {
            return $this->renderPage([], $e->getMessage());
        }

    }

    private function renderPage(array $soiree, string $errorMessage = ''): string
    {
        ob_start();

        include ROOT_PATH . '/src/views/pages/soiree.php';

        $content = ob_get_clean();

        include ROOT_PATH . '/src/views/layout.php';

        return ob_get_clean();

    }

}

<?php

namespace iutnc\NRV\classes\Actions;

use iutnc\NRV\classes\Database\NRVRepository;
use Exception;

class FilterSpectaclesAction extends Action
{
    public function execute(): string
    {
        try {
            $content = $this->http_method == 'POST' ? $this->filterSpectacles() : $this->renderForm();
        } catch (Exception $e) {
            $content = $this->renderForm($e->getMessage());
        }

        ob_start();
        include ROOT_PATH . '/src/views/layout.php';
        return ob_get_clean();
    }



    private function filterSpectacles(): string
    {
        $date = $_POST['date'] ?? null;
        $lieu = $_POST['lieu'] ?? null;
        $style = $_POST['style'] ?? null;

        $repository = NRVRepository::getInstance();
        $spectacles = $repository->filterSpectacles($date, $lieu, $style);

        if (empty($spectacles)) {
            throw new Exception("Aucun spectacle ne correspond à vos critères.");
        }

        ob_start();
        include ROOT_PATH . '/src/views/pages/spectacles.php';
        return ob_get_clean();
    }

    private function renderForm(string $errorMessage = ''): string
    {
        $repository = NRVRepository::getInstance();

        $lieux = $repository->getAllLieux();
        $styles = $repository->getAllStyles();

        ob_start();
        include ROOT_PATH . '/src/views/pages/filter-form.php';
        return ob_get_clean();
    }


}

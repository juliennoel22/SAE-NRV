<?php
namespace iutnc\NRV\classes\Actions;

use iutnc\NRV\classes\Database\NRVRepository;
class ListSpectaclesAction extends Action{

    public function execute(): string
    {
        $repository = NRVRepository::getInstance();
        $spectacles = $repository->getAllSpectacles();
        return $this->renderPage($spectacles); // array ?
    }

    // méthode de rendu ?


    private function renderPage(array $spectacles): string
    {
        ob_start();

        include ROOT_PATH . '/src/views/pages/home.php';

        $content = ob_get_clean();

        ob_start();

        include ROOT_PATH . '/src/views/pages/spectacles.php';

        $content .= ob_get_clean();

        ob_start();

        include ROOT_PATH . '/src/views/layout.php';

        return ob_get_clean();
    }

}

<?php
namespace iutnc\NRV\classes\Actions;

use iutnc\NRV\classes\Database\NRVRepository;
class ListSpectaclesAction extends Action{

    public function execute(): string
    {
        $repository = NRVRepository::getInstance();
        $spectacles = $repository->getAllSpectacles();
//        require __DIR__ . '/../views/spectacles.php';
        return $this->renderPage($spectacles); // array ?

//        // Appel de la vue pour afficher les spectacles
//        include __DIR__ . '/../views/list_spectacles.php';
    }

    // méthode de rendu ?


    private function renderPage(array $spectacles): string
    {
        ob_start();
        include ROOT_PATH . '/src/views/pages/spectacles.php';
        return ob_get_clean();
    }

}

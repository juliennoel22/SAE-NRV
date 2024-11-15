<?php

namespace iutnc\NRV\classes\Actions;

use Exception;

class AddPreference extends Action
{
    public function execute(): string
    {
        try {
            if ($this->http_method === 'POST') {
                $this->addToFavorites();
            }

            header('Location: ?action=spectacles');
            exit();
        } catch (Exception $e) {
            return $this->render($e->getMessage());
        }
    }


    private function addToFavorites(): void
    {
        $spectacleId = $_POST['spectacle_id'] ?? null;

        if ($spectacleId === null) {
            throw new Exception("L'ID du spectacle est manquant.");
        }

        if (isset($_COOKIE['preferences'])) {
            $preferences = json_decode($_COOKIE['preferences'], true);
        } else {
            $preferences = [];
        }

        if (!in_array($spectacleId, $preferences)) {
            $preferences[] = $spectacleId;
        }

        setcookie('preferences', json_encode($preferences), time() + 24 *60 * 60, '/');
    }


    private function render(string $errorMessage = ''): string
    {
        ob_start();
        include ROOT_PATH . '/src/views/pages/spectacles.php';
        return ob_get_clean();
    }
}

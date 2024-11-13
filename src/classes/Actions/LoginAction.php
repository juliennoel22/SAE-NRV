<?php

namespace iutnc\NRV\classes\Actions;

use Exception;
use iutnc\NRV\classes\Auth\Authn;
use iutnc\NRV\classes\Exceptions\AuthnException;

class LoginAction extends Action
{
    /**
     * @throws Exception
     */
    public function execute(): string
    {
        try {
            return $this->http_method == 'POST' ? $this->login() : $this->renderForm();
        } catch (Exception $e) {
            return $this->renderForm($e->getMessage());
        }
    }

    /**
     * @throws AuthnException
     * @throws Exception
     */
    private function login(): string
    {
        if (empty($_POST['utilisateur_email']) || empty($_POST['utilisateur_password'])) {
            throw new AuthnException('Tous les champs sont obligatoires.');
        }

        $utilisateur_email = filter_input(INPUT_POST, 'utilisateur_email', FILTER_SANITIZE_EMAIL);
        $utilisateur_password = $_POST['utilisateur_password'];

        try {
            $authn = new Authn();
            if ($authn->loginUser($utilisateur_email, $utilisateur_password)) {
                return (new DefaultAction())->execute();
            } else {
                throw new AuthnException('Identifiants incorrects.');
            }
        } catch (AuthnException $e) {
            throw new AuthnException($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function renderForm(string $errorMessage = ''): bool|string
    {
        ob_start();
        include ROOT_PATH . '/src/views/pages/login-form.php';
        $content = ob_get_clean();

        ob_start();
        include ROOT_PATH . '/src/views/layout.php';
        return ob_get_clean();
    }
}
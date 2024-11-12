<?php

namespace iutnc\NRV\classes\Actions;

use Exception;
use iutnc\NRV\classes\Auth\Authn;
use iutnc\NRV\classes\Exceptions\AuthnException;

class RegisterAction extends Action
{

    /**
     * @throws Exception
     */
    public function execute(): string
    {
        try {
            return $this->http_method == 'POST' ? $this->register() : $this->renderForm();
        } catch (Exception $e) {
            return $this->renderForm($e->getMessage());
        }
    }

    /**
     * @throws AuthnException
     * @throws Exception
     */
    private function register(): string
    {
//        vérifier si les champs sont remplis et corrects
        if (empty($_POST['utilisateur_nom']) || empty($_POST['utilisateur_prenom']) || empty($_POST['utilisateur_email']) || empty($_POST['utilisateur_password']) || empty($_POST['utilisateur_password_confirm'])) {
            throw new AuthnException('Tous les champs sont obligatoires.');
        }

//        vérifier si l'email est valide
        if (!filter_var($_POST['utilisateur_email'], FILTER_VALIDATE_EMAIL)) {
            throw new AuthnException('Email invalide.');
        }

        $utilisateur_nom = filter_input(INPUT_POST, 'utilisateur_nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $utilisateur_prenom = filter_input(INPUT_POST, 'utilisateur_prenom', FILTER_SANITIZE_SPECIAL_CHARS);
        $utilisateur_email = filter_input(INPUT_POST, 'utilisateur_email', FILTER_SANITIZE_SPECIAL_CHARS);

//        mots de passe mini 8 caractères dont : 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial sinon AuthException

        $utilisateur_password = $_POST['utilisateur_password'];
        $utilisateur_password_confirm = $_POST['utilisateur_password_confirm'];

        if ($utilisateur_password !== $utilisateur_password_confirm) {
            throw new AuthnException('Les mots de passe ne correspondent pas.');
        }

        $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_+.\/'\",]).{8,}$/";

        if (!preg_match($regex, $utilisateur_password)) {
            throw new AuthnException('Le mot de passe doit contenir au moins 8 caractères dont : 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial');
        }

        $utilisateur_password_hashed = password_hash($utilisateur_password, PASSWORD_DEFAULT);

        try {
            $authn = new Authn();
            $authn->registerUser($utilisateur_nom, $utilisateur_prenom, $utilisateur_email, $utilisateur_password_hashed);
        } catch (AuthnException $e) {
            throw new AuthnException($e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return (new DefaultAction())->execute();
    }

    private function renderForm(string $errorMessage = ''): bool|string
    {
        ob_start();
        include ROOT_PATH . '/src/views/pages/register-form.php';
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
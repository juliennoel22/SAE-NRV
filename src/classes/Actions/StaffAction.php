<?php

namespace iutnc\NRV\classes\Actions;

use Exception;
use iutnc\NRV\classes\Auth\Authz;
use iutnc\NRV\classes\Database\NRVRepository;

class StaffAction extends Action
{

    /**
     * @throws Exception
     */
    public function execute(): string
    {

        $user = Authz::getAuthenticatedUser();

        if ($user == null || !isset($user) || !$user->hasAccess(10)) {

            header('Location: ?action=default');
            exit();
        }

        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->handlePostRequest();
            }

            return $this->renderForm();
        } catch (Exception $e) {
            return $this->renderForm($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    private function handlePostRequest(): void
    {
        $repository = NRVRepository::getInstance();

        // Sanitize and validate input data
        $creer_objet = filter_input(INPUT_POST, 'creer_objet', FILTER_SANITIZE_SPECIAL_CHARS);
        $soiree_nom = filter_input(INPUT_POST, 'soiree_nom', FILTER_SANITIZE_SPECIAL_CHARS);
        $soiree_thematique = filter_input(INPUT_POST, 'soiree_thematique', FILTER_SANITIZE_SPECIAL_CHARS);
        $soiree_date = filter_input(INPUT_POST, 'soiree_date', FILTER_SANITIZE_SPECIAL_CHARS);
        $soiree_horaire_debut = filter_input(INPUT_POST, 'soiree_horaire_debut', FILTER_SANITIZE_SPECIAL_CHARS);
        $soiree_lieu_id = filter_input(INPUT_POST, 'soiree_lieu_id', FILTER_VALIDATE_INT);
        $soiree_tarif = filter_input(INPUT_POST, 'soiree_tarif', FILTER_VALIDATE_FLOAT);
        $spectacle_titre = filter_input(INPUT_POST, 'spectacle_titre', FILTER_SANITIZE_SPECIAL_CHARS);
        $spectacle_description = filter_input(INPUT_POST, 'spectacle_description', FILTER_SANITIZE_SPECIAL_CHARS);
        $spectacle_style_musique = filter_input(INPUT_POST, 'spectacle_style_musique', FILTER_SANITIZE_SPECIAL_CHARS);
        $spectacle_duree = filter_input(INPUT_POST, 'spectacle_duree', FILTER_SANITIZE_SPECIAL_CHARS);
        $spectacle_horaire = filter_input(INPUT_POST, 'spectacle_horaire', FILTER_SANITIZE_SPECIAL_CHARS);
        $spectacle_soiree_id = filter_input(INPUT_POST, 'spectacle_soiree_id', FILTER_VALIDATE_INT);

        switch ($creer_objet) {
            case 'soiree':
                if ($soiree_nom && $soiree_date && $soiree_horaire_debut && $soiree_lieu_id && $soiree_tarif !== false) {
                    try {
                        $repository->addSoiree($soiree_nom, $soiree_thematique, $soiree_date, $soiree_horaire_debut, $soiree_lieu_id, $soiree_tarif);
                    } catch (Exception $e) {
                        throw new Exception($e->getMessage());
                    }
                } else {
                    // Handle invalid input
                    throw new Exception('Données invalides.');
                }
                break;
            case 'spectacle':
                if ($spectacle_titre && $spectacle_horaire && $spectacle_soiree_id) {
                    try {
                        $repository->addSpectacle($spectacle_titre, $spectacle_description, $spectacle_style_musique, $spectacle_duree, $spectacle_horaire, $spectacle_soiree_id);
                    } catch (Exception $e) {
                        throw new Exception($e->getMessage());
                    }
                } else {
                    // Handle invalid input
                    throw new Exception('Données invalides.');
                }
                break;
            case 'lieu':
                $lieu_nom = filter_input(INPUT_POST, 'lieu_nom', FILTER_SANITIZE_SPECIAL_CHARS);
                $lieu_adresse = filter_input(INPUT_POST, 'lieu_adresse', FILTER_SANITIZE_SPECIAL_CHARS);
                $lieu_nb_places_assises = filter_input(INPUT_POST, 'lieu_nb_places_assises', FILTER_VALIDATE_INT);
                $lieu_nb_places_debout = filter_input(INPUT_POST, 'lieu_nb_places_debout', FILTER_VALIDATE_INT);

                if ($lieu_nom && $lieu_adresse && $lieu_nb_places_assises !== false && $lieu_nb_places_debout !== false) {
                    $repository->addLieu($lieu_nom, $lieu_adresse, $lieu_nb_places_assises, $lieu_nb_places_debout);
                } else {
                    throw new Exception('Données invalides.');
                }
                break;
            case 'artiste':
                $artiste_nom = filter_input(INPUT_POST, 'artiste_nom', FILTER_SANITIZE_SPECIAL_CHARS);
                $artiste_prenom = filter_input(INPUT_POST, 'artiste_prenom', FILTER_SANITIZE_SPECIAL_CHARS);

                if ($artiste_nom && $artiste_prenom) {
                    $repository->addArtiste($artiste_nom, $artiste_prenom);
                } else {
                    throw new Exception('Données invalides.');
                }
                break;
            case 'artiste_to_spectacle':
                $artiste_id = filter_input(INPUT_POST, 'artiste_id', FILTER_VALIDATE_INT);
                $spectacle_id = filter_input(INPUT_POST, 'spectacle_id', FILTER_VALIDATE_INT);

                if ($artiste_id !== false && $spectacle_id !== false) {
                    $repository->addArtisteToSpectacle($artiste_id, $spectacle_id);
                } else {
                    throw new Exception('Données invalides.');
                }
                break;
            default:
                throw new Exception('Type de données invalides.');
        }
    }

    private function renderForm(string $errorMessage = ''): string
    {
        $repository = NRVRepository::getInstance();
        $lieux = $repository->getAllLieux();
        $soirees = $repository->getAllSoirees();
        $artistes = $repository->getAllArtistes();
        $spectacles = $repository->getAllSpectacles();

        ob_start();
        include ROOT_PATH . '/src/views/pages/staff.php';
        $content = ob_get_clean();

        ob_start();
        include ROOT_PATH . '/src/views/layout.php';
        return ob_get_clean();
    }
}
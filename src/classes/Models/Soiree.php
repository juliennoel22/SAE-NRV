<?php

namespace iutnc\NRV\classes\Models;

use iutnc\NRV\classes\Database\NRVRepository;

class Soiree
{
    private int $soiree_id;
    private string $soiree_nom;
    private ?string $soiree_thematique;
    private string $soiree_date;
    private string $soiree_horaire_debut;
    private int $soiree_lieu_id;
    private float $soiree_tarif;
    private array $images = [];
    private array $videos = [];

    public function __construct(int $soiree_id, ?string $soiree_nom = null, ?string $soiree_thematique = null, ?string $soiree_date = null, ?string $soiree_horaire_debut = null, ?int $soiree_lieu_id = null, ?float $soiree_tarif = null)
    {
        $this->soiree_id = $soiree_id;

        if ($soiree_nom === null || $soiree_thematique === null || $soiree_date === null || $soiree_horaire_debut === null || $soiree_lieu_id === null || $soiree_tarif === null) {
            $this->loadSoireeData();
        } else {
            $this->soiree_nom = $soiree_nom;
            $this->soiree_thematique = $soiree_thematique;
            $this->soiree_date = $soiree_date;
            $this->soiree_horaire_debut = $soiree_horaire_debut;
            $this->soiree_lieu_id = $soiree_lieu_id;
            $this->soiree_tarif = $soiree_tarif;
        }
    }

    private function loadSoireeData(): void
    {
        $soiree = NRVRepository::getInstance()->getSoireeById($this->soiree_id);

        $this->soiree_nom = $soiree['soiree_nom'];
        $this->soiree_thematique = $soiree['soiree_thematique'];
        $this->soiree_date = $soiree['soiree_date'];
        $this->soiree_horaire_debut = $soiree['soiree_horaire_debut'];
        $this->soiree_lieu_id = $soiree['soiree_lieu_id'];
        $this->soiree_tarif = $soiree['soiree_tarif'];
        $this->images = $soiree['images'];
        $this->videos = $soiree['videos'];
    }

    public function getSoireeId(): int
    {
        return $this->soiree_id;
    }

    public function getSoireeNom(): string
    {
        return $this->soiree_nom;
    }

    public function getSoireeThematique(): ?string
    {
        return $this->soiree_thematique;
    }

    public function getSoireeDate(): string
    {
        return $this->soiree_date;
    }

    public function getSoireeHoraireDebut(): string
    {
        return $this->soiree_horaire_debut;
    }

    public function getSoireeLieuId(): int
    {
        return $this->soiree_lieu_id;
    }

    public function getSoireeTarif(): float
    {
        return $this->soiree_tarif;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function getVideos(): array
    {
        return $this->videos;
    }

    public function setSoireeNom(string $soiree_nom): void
    {
        $this->soiree_nom = $soiree_nom;
    }

    public function setSoireeThematique(?string $soiree_thematique): void
    {
        $this->soiree_thematique = $soiree_thematique;
    }

    public function setSoireeDate(string $soiree_date): void
    {
        $this->soiree_date = $soiree_date;
    }

    public function setSoireeHoraireDebut(string $soiree_horaire_debut): void
    {
        $this->soiree_horaire_debut = $soiree_horaire_debut;
    }

    public function setSoireeLieuId(int $soiree_lieu_id): void
    {
        $this->soiree_lieu_id = $soiree_lieu_id;
    }

    public function setSoireeTarif(float $soiree_tarif): void
    {
        $this->soiree_tarif = $soiree_tarif;
    }

    public function setImages(array $images): void
    {
        $this->images = $images;
    }

    public function setVideos(array $videos): void
    {
        $this->videos = $videos;
    }

    public function addImage(string $image_url, bool $insertIntoDatabase = true): void
    {
        $this->images[] = $image_url;
        if ($insertIntoDatabase) {
            NRVRepository::getInstance()->addImageToSoiree($this->soiree_id, $image_url);
        }
    }

    public function addVideo(string $video_url, bool $insertIntoDatabase = true): void
    {
        $this->videos[] = $video_url;
        if ($insertIntoDatabase) {
            NRVRepository::getInstance()->addVideoToSoiree($this->soiree_id, $video_url);
        }
    }
}
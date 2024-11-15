<section id="soiree-details">
    <a href="?action=default" class="back-home">Retour à l'accueil</a>
    <?php if (isset($soiree) && is_array($soiree) && !empty($soiree)): ?>
        <h1 class="soiree-title"><?= htmlspecialchars($soiree['soiree_nom']) ?></h1>
        <div class="soiree-main-info">
            <p class="soiree-thematique"><strong>Thématique :</strong> <?= htmlspecialchars($soiree['soiree_thematique'] ?? 'Non spécifiée') ?></p>
            <p class="soiree-date"><strong>Date :</strong> <?= htmlspecialchars($soiree['soiree_date']) ?></p>
            <p class="soiree-horaire"><strong>Horaire :</strong> <?= htmlspecialchars($soiree['soiree_horaire_debut']) ?></p>
            <p class="soiree-tarif"><strong>Tarif :</strong> <?= htmlspecialchars($soiree['soiree_tarif']) ?> €</p>
        </div>

        <div class="soiree-liste-spectacles">
            <h3 class="spectacles-title">Spectacles</h3>
            <?php if (!empty($soiree['spectacles'])): ?>
                <ul class="spectacles-list">
                    <?php foreach ($soiree['spectacles'] as $spectacle): ?>
                        <li class="spectacle-item">
                            <p class="spectacle-titre"><strong>Titre:</strong> <?= htmlspecialchars($spectacle['spectacle_titre']) ?></p>
                            <p class="spectacle-artistes"><strong>Artistes:</strong> <?= htmlspecialchars($spectacle['spectacle_artistes']) ?></p>
                            <p class="spectacle-description"><strong>Description:</strong> <?= htmlspecialchars($spectacle['spectacle_description']) ?></p>
                            <p class="spectacle-style"><strong>Style de musique:</strong> <?= htmlspecialchars($spectacle['spectacle_style_musique']) ?></p>
                            <p class="spectacle-video-url"><strong>Vidéo:</strong> <?= htmlspecialchars($spectacle['spectacle_video_url']) ?></p>
                            <?php if (!empty($spectacle['spectacle_video_url'])): ?>
                                <?php $video_url = "./videos/spectacles/" . htmlspecialchars($spectacle['spectacle_video_url']); ?>
                                <div class="spectacle-video">
                                    <h3 class="video-title">Regarder un extrait vidéo</h3>
                                    <video controls width="600" class="video-player">
                                        <source src="<?= htmlspecialchars($video_url) ?>" type="video/mp4">
                                        Votre navigateur ne supporte pas l'élément vidéo.
                                    </video>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="no-spectacle">Aucun spectacle prévu pour cette soirée.</p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <p class="no-soiree">Aucune soirée disponible.</p>
    <?php endif; ?>
</section>

<?php include ROOT_PATH . '/src/views/partials/program-list.php'; ?>
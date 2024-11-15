<section id="soiree-details">
    <a href="?action=default">Retour à l'accueil</a>
    <?php if (isset($soiree) && is_array($soiree) && !empty($soiree)): ?>
        <h1><?= htmlspecialchars($soiree['soiree_nom']) ?></h1>
        <div class="soiree-main-info">
            <p><strong>Thématique :</strong> <?= htmlspecialchars($soiree['soiree_thematique'] ?? 'Non spécifiée') ?></p>
            <p><strong>Date :</strong> <?= htmlspecialchars($soiree['soiree_date']) ?></p>
            <p><strong>Horaire :</strong> <?= htmlspecialchars($soiree['soiree_horaire_debut']) ?></p>
            <p><strong>Tarif :</strong> <?= htmlspecialchars($soiree['soiree_tarif']) ?> €</p>
        </div>

        <div class="soiree-liste-spectacles">
            <h3>Spectacles</h3>
            <?php if (!empty($soiree['spectacles'])): ?>
                <ul>
                    <?php foreach ($soiree['spectacles'] as $spectacle): ?>
                        <li><strong>Titre:</strong> <?= htmlspecialchars($spectacle['spectacle_titre']) ?></li>
                        <li><strong>Artistes:</strong> <?= htmlspecialchars($spectacle['spectacle_artistes']) ?></li>
                        <li><strong>Description:</strong> <?= htmlspecialchars($spectacle['spectacle_description']) ?></li>
                        <li><strong>Style de musique:</strong> <?= htmlspecialchars($spectacle['spectacle_style_musique']) ?></li>
                        <li><strong>Vidéo:</strong> <?= htmlspecialchars($spectacle['spectacle_video_url']) ?></li>
                        <?php if (!empty($spectacle['spectacle_video_url'])): ?>
                            <?php $video_url = "./videos/spectacles/" . htmlspecialchars($spectacle['spectacle_video_url']); ?>
                            <div class="spectacle-video">
                                <h3>Regarder un extrait vidéo</h3>
                                <video controls width="600">
                                    <source src="<?= htmlspecialchars($video_url) ?>" type="video/mp4">
                                    Votre navigateur ne supporte pas l'élément vidéo.
                                </video>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucun spectacle prévu pour cette soirée.</p>
            <?php endif; ?>
        </div>

<!--        Pas nécessaire d'afficher les images et les vidéos de la soirée à la fin-->
        <?php if (!empty($soiree['images'])): ?>
            <div class="soiree-images">
                <h3>Images</h3>
                <?php foreach ($soiree['images'] as $image_url): ?>
                    <?php $image_path = "./images/soirees/" . htmlspecialchars($image_url); ?>
                    <img src="<?= htmlspecialchars($image_path) ?>"
                         alt="Image de la soirée <?= htmlspecialchars($soiree['soiree_nom']) ?>"
                         class="soiree-image">
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($soiree['videos'])): ?>
            <div class="soiree-videos">
                <h3>Vidéos</h3>
                <?php foreach ($soiree['videos'] as $video_url): ?>
                    <?php $video_path = "./videos/soirees/" . htmlspecialchars($video_url); ?>
                    <video controls width="600">
                        <source src="<?= htmlspecialchars($video_path) ?>" type="video/mp4">
                        Votre navigateur ne supporte pas l'élément vidéo.
                    </video>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <p class="no-soiree">Aucune soirée disponible.</p>
    <?php endif; ?>
</section>

<?php include ROOT_PATH . '/src/views/partials/program-list.php'; ?>

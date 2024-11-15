<section id="spectacle-details">
    <?php if (isset($spectacle) && is_array($spectacle) && !empty($spectacle)): ?>

            <h1><?= htmlspecialchars($spectacle['spectacle_titre']) ?></h1>

            <?php echo "jean"; ?>

            <div class="spectacle-main-info">
                <p><strong>Artistes :</strong> <?= htmlspecialchars($spectacle['spectacle_artistes']) ?></p>
                <p><strong>Description :</strong> <?= htmlspecialchars($spectacle['spectacle_description']) ?></p>
                <p><strong>Style :</strong> <?= htmlspecialchars($spectacle['spectacle_style_musique']) ?></p>
                <p><strong>Durée :</strong> <?= htmlspecialchars($spectacle['spectacle_duree']) ?> minutes</p>
            </div>

            <?php if (!empty($spectacle['spectacle_image'])): ?>
                <?php foreach (explode(', ', $spectacle['spectacle_image']) as $image_url): ?>
                    <?php $image_url = "./images/spectacles/" . htmlspecialchars($image_url); ?>
                    <img src="<?= htmlspecialchars($image_url) ?>"
                         alt="Image du spectacle <?= htmlspecialchars($spectacle['spectacle_titre']) ?>"
                         class="spectacle-image">
                <?php endforeach; ?>
            <?php endif; ?>

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
<!--    --><?php //else: ?>
<!--        <p class="no-spectacle">Aucun spectacle disponible.</p>-->
    <?php endif; ?>
</section>

<?php include ROOT_PATH . '/src/views/partials/program-list.php'; ?>

<section id="debug-section">
    <?php if ($_ENV['DEBUG_MODE'] === 'true'): ?>
        <h2>Debug</h2>
        <pre><?php var_dump($_SESSION); ?></pre>
    <?php endif; ?>
</section>

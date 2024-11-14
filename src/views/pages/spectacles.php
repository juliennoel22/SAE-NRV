<section id="featured-performances">
    <a href="?action=default">Retour à l'accueil</a>
    <h2>Liste des Spectacles</h2>
    <?php if (!empty($spectacles) && is_array($spectacles)): ?>
        <?php foreach ($spectacles as $spectacle): ?>
            <article class="spectacle-card">
                <div class="spectacle-info">
                    <h3><?= htmlspecialchars($spectacle['spectacle_titre']) ?></h3>
                    <p><strong>Date :</strong> <?= htmlspecialchars($spectacle['spectacle_date']) ?></p>
                    <p><strong>Horaire :</strong> <?= htmlspecialchars($spectacle['spectacle_horaire']) ?></p>
                    <?php
                    $image_url = "./images/spectacles/" . htmlspecialchars($spectacle['image_spectacle_url']);
                    if (!empty($spectacle['image_spectacle_url'])): ?>
                        <img src="<?= $image_url ?>" alt="Image du spectacle <?= htmlspecialchars($spectacle['spectacle_titre']) ?>" class="spectacle-image">
                    <?php else: ?>
                        <p>Aucune image disponible pour ce spectacle.</p>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-spectacle">Aucun spectacle disponible.</p>
    <?php endif; ?>
</section>

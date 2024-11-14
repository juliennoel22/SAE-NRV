<section id="featured-performances">
    <h2>Performances en vedette</h2>
    <?php if (isset($spectacles) && is_array($spectacles)): ?>
        <?php foreach ($spectacles as $spectacle): ?>
            <article class="spectacle-card">
                <div class="spectacle-info">
                    <h3><?= htmlspecialchars($spectacle['spectacle_titre']) ?></h3>
                    <p><strong>Date :</strong> <?= htmlspecialchars($spectacle['spectacle_date']) ?></p>
                    <p><strong>Horaire :</strong> <?= htmlspecialchars($spectacle['spectacle_horaire']) ?></p>
                    <?php $image_url = "./images/spectacles/" . htmlspecialchars($spectacle['image_spectacle_url']); ?>
                    <img src="<?= htmlspecialchars($image_url) ?>"
                         alt="Image du spectacle <?= htmlspecialchars($spectacle['spectacle_titre']) ?>"
                         class="spectacle-image">
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-spectacle">Aucun spectacle disponible.</p>
    <?php endif; ?>
</section>

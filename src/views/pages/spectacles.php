<section id="featured-performances">
    <a href="?action=default">Retour à l'accueil</a>
    <h2>Liste des Spectacles</h2>
    <?php
    $favoritesIds = isset($_COOKIE['preferences']) ? json_decode($_COOKIE['preferences'], true) : [];
    ?>
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

                    <?php if (!in_array($spectacle['spectacle_id'], $favoritesIds)): ?>
                        <form action="?action=addpref" method="POST">
                            <input type="hidden" name="spectacle_id" value="<?= htmlspecialchars($spectacle['spectacle_id']) ?>">
                            <button type="submit">Ajouter à mes préférences</button>
                        </form>
                    <?php else: ?>
                        <p>Ce spectacle est déjà dans vos préférences.</p>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-spectacle">Aucun spectacle disponible.</p>
    <?php endif; ?>
</section>

<?php include __DIR__ . '/../partials/header.php';?>
<section>
    <a href="?action=register">Créer un compte</a>
    <a href="?action=login">Se connecter</a>
    <a href="?action=logout">Se déconnecter</a>
</section>

<section id="about-festival">
    <h2>À propos du festival</h2>
    <p>Le festival Nancy Rock Vibration (NRV) est un événement de deux semaines mettant en vedette une variété de styles de musique rock, y compris le rock classique, le blues rock, le métal et la chanson. Chaque soir, plusieurs lieux accueillent différentes performances, offrant une expérience unique aux amateurs de musique.</p>
</section>

<section id="program">
    <h2>Programme</h2>
    <p>Découvrez le programme complet des performances, filtrez par date, lieu ou style de musique pour trouver vos spectacles préférés.</p>
    <ul>
        <li><a href="?action=showAll" class="program-link">Programme complet</a></li>
        <li><a href="?action=filterByDate" class="program-link">Par date</a></li>
        <li><a href="?action=filterByLieu" class="program-link">Par lieu</a></li>
        <li><a href="?action=filterByStyle" class="program-link">Par style de musique</a></li>
    </ul>
</section>

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
                    <img src="<?= htmlspecialchars($image_url) ?>" alt="Image du spectacle <?= htmlspecialchars($spectacle['spectacle_titre']) ?>" class="spectacle-image">
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-spectacle">Aucun spectacle disponible.</p>
    <?php endif; ?>
</section>

<section id="debug-section">
    <?php
    if ($_ENV['DEBUG_MODE'] === 'true') {
        echo '<h2>Debug</h2>';
        echo '<pre>';
        var_dump($_SESSION);
        echo '</pre>';
    }
    ?>
</section>

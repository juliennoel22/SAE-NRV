<section id="about-festival">
    <h2>À propos du festival</h2>
    <p>Le festival Nancy Rock Vibration (NRV) est un événement de deux semaines mettant en vedette une variété de styles
        de musique rock, y compris le rock classique, le blues rock, le métal et la chanson. Chaque soir, plusieurs
        lieux accueillent différentes performances, offrant une expérience unique aux amateurs de musique.</p>
</section>

<?php include ROOT_PATH . '/src/views/partials/program-list.php'; ?>

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

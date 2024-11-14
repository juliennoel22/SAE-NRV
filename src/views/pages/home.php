<section id="about-festival">
    <h2>À propos du festival</h2>
    <p>Le festival Nancy Rock Vibration (NRV) est un événement de deux semaines mettant en vedette une variété de styles
        de musique rock, y compris le rock classique, le blues rock, le métal et la chanson. Chaque soir, plusieurs
        lieux accueillent différentes performances, offrant une expérience unique aux amateurs de musique.</p>
</section>

<section id="program">
    <h2>Programme</h2>
    <p>Découvrez le programme complet des performances, filtrez par date, lieu ou style de musique pour trouver vos
        spectacles préférés.</p>
    <ul>
        <li><a href="?action=spectacles&filter=all" class="program-link">Programme complet</a></li>
        <li><a href="?action=spectacles&filter=date" class="program-link">Par date</a></li>
        <li><a href="?action=spectacles&filter=lieu" class="program-link">Par lieu</a></li>
        <li><a href="?action=spectacles&filter=music" class="program-link">Par style de musique</a></li>
    </ul>
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


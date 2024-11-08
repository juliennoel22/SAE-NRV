<?php
// Charger le header
include ROOT_PATH . '/src/views/partials/header.php';

// Charger le contenu de la page
$content = $content ?? '';

echo '<main>
 ' . $content . '
 </main>';

// Charger le footer
include ROOT_PATH . '/src/views/partials/footer.php';

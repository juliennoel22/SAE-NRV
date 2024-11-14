<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NRV Application</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
<header>
    <h1>Festival Nancy Rock Vibration</h1>
    <section>
    <?php

    use iutnc\NRV\classes\Auth\Authz;

    $user = Authz::getAuthenticatedUser();

    if ($user !== null && $user->hasAccess(10)): ?>
        <a href="?action=staff">Panel Staff</a>
    <?php endif; ?>

    <?php if ($user !== null): ?>
        <a href="?action=logout">Se déconnecter</a>
    <?php else: ?>
        <a href="?action=register">Créer un compte</a>
        <a href="?action=login">Se connecter</a>
    <?php endif; ?>
    </section>
</header>

<?php if (!empty($errorMessage)): ?>
<div class="error">
    <span><?= htmlspecialchars($errorMessage) ?></span>
    <span class="close">&times;</span>
</div>
<?php endif; ?>
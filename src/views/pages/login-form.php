<a href="?action=default">Retour à l'accueil</a>
<?php if (!empty($errorMessage)): ?>
    <div class="error">
        <span><?= htmlspecialchars($errorMessage) ?></span>
        <span class="close">&times;</span>
    </div>
<?php endif; ?>
<form method="post" action="?action=login" class="form form-action">
    <div class="inputs">
        <div class="input-parent">
            <label for="utilisateur_email">Email</label>
            <input type="email" id="utilisateur_email" name="utilisateur_email" placeholder="Email">
        </div>
        <div class="input-parent">
            <label for="utilisateur_password">Mot de passe</label>
            <input type="password" id="utilisateur_password" name="utilisateur_password" placeholder="Mot de passe">
        </div>
    </div>
    <button type="submit">Se connecter</button>
</form><?php

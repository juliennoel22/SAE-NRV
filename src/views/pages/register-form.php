<form method="post" action="?action=register" class="form form-action">
    <a href="?action=default">Retour à l'accueil</a>
    <div class="inputs">
        <div class="input-parent">
            <label for="utilisateur_nom">Nom d'utilisateur</label>
            <input type="text" id="utilisateur_nom" name="utilisateur_nom" placeholder="Nom de famille">
        </div>
        <div class="input-parent">
            <label for="utilisateur_prenom">Nom d'utilisateur</label>
            <input type="text" id="utilisateur_prenom" name="utilisateur_prenom" placeholder="Prénom">
        </div>
        <div class="input-parent">
            <label for="utilisateur_email">Email</label>
            <input type="email" id="utilisateur_email" name="utilisateur_email" placeholder="Email">
        </div>
        <div class="input-parent">
            <label for="utilisateur_password">Mot de passe</label>
            <input type="password" id="utilisateur_password" name="utilisateur_password" placeholder="Mot de passe">
        </div>
        <div class="input-parent">
            <label for="utilisateur_password_confirm">Confirmer le mot de passe</label>
            <input type="password" id="utilisateur_password_confirm" name="utilisateur_password_confirm" placeholder="Confirmer le mot de passe">
        </div>
    </div>
    <button type="submit">Créer mon compte</button>
</form>
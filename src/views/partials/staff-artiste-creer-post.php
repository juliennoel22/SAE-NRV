<form method="post" action="?action=staff" class="form form-action">
    <input type="hidden" name="creer_objet" value="artiste">
    <div class="inputs">
        <div class="input-parent">
            <label for="artiste_nom">Nom de l'artiste</label>
            <input type="text" id="artiste_nom" name="artiste_nom" required>
        </div>
        <div class="input-parent">
            <label for="artiste_prenom">Prénom de l'artiste</label>
            <input type="text" id="artiste_prenom" name="artiste_prenom" required>
        </div>
    </div>
    <button type="submit">Créer l'artiste</button>
</form>
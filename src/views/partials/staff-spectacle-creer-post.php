<form method="post" action="?action=staff" class="form form-action">
    <input type="hidden" name="creer_objet" value="spectacle">
    <div class="inputs">
        <div class="input-parent">
            <label for="spectacle_titre">Titre du spectacle</label>
            <input type="text" id="spectacle_titre" name="spectacle_titre" required>
        </div>
        <div class="input-parent">
            <label for="spectacle_description">Description</label>
            <textarea id="spectacle_description" name="spectacle_description"></textarea>
        </div>
        <div class="input-parent">
            <label for="spectacle_style_musique">Style de musique</label>
            <input type="text" id="spectacle_style_musique" name="spectacle_style_musique">
        </div>
        <div class="input-parent">
            <label for="spectacle_duree">Durée</label>
            <input type="time" id="spectacle_duree" name="spectacle_duree">
        </div>
        <div class="input-parent">
            <label for="spectacle_horaire">Horaire</label>
            <input type="time" id="spectacle_horaire" name="spectacle_horaire" required>
        </div>
        <div class="input-parent">
            <label for="spectacle_soiree_id">Soirée</label>
            <select id="spectacle_soiree_id" name="spectacle_soiree_id" required>
                <?php foreach ($soirees as $soiree): ?>
                    <option value="<?= htmlspecialchars($soiree['soiree_id']) ?>"><?= htmlspecialchars($soiree['soiree_nom']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <button type="submit">Créer le spectacle</button>
</form>
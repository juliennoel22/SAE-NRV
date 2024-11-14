<form method="post" action="?action=staff" class="form form-action">
    <input type="hidden" name="creer_objet" value="artiste_to_spectacle">
    <div class="inputs">
        <div class="input-parent">
            <label for="artiste_id">Artiste</label>
            <select id="artiste_id" name="artiste_id" required>
                <?php foreach ($artistes as $artiste): ?>
                    <option value="<?= htmlspecialchars($artiste['artiste_id'] ?? '') ?>"><?= htmlspecialchars($artiste['artiste_nom'] . ' ' . $artiste['artiste_prenom'] ?? '') ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input-parent">
            <label for="spectacle_id">Spectacle</label>
            <select id="spectacle_id" name="spectacle_id" required>
                <?php foreach ($spectacles as $spectacle): ?>
                    <option value="<?= htmlspecialchars($spectacle['spectacle_id'] ?? '') ?>"><?= htmlspecialchars($spectacle['spectacle_titre'] ?? '') ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <button type="submit">Ajouter l'artiste au spectacle</button>
</form>
<form method="post" action="?action=staff" class="form form-action">
    <input type="hidden" name="creer_objet" value="soiree">
    <div class="inputs">
        <div class="input-parent">
            <label for="soiree_nom">Nom de la soirée</label>
            <input type="text" id="soiree_nom" name="soiree_nom" required>
        </div>
        <div class="input-parent">
            <label for="soiree_thematique">Thématique</label>
            <input type="text" id="soiree_thematique" name="soiree_thematique">
        </div>
        <div class="input-parent">
            <label for="soiree_date">Date</label>
            <input type="date" id="soiree_date" name="soiree_date" required>
        </div>
        <div class="input-parent">
            <label for="soiree_horaire_debut">Horaire de début</label>
            <input type="time" id="soiree_horaire_debut" name="soiree_horaire_debut" required>
        </div>
        <div class="input-parent">
            <label for="soiree_lieu_id">Lieu</label>
            <select id="soiree_lieu_id" name="soiree_lieu_id" required>
                <?php foreach ($lieux as $lieu): ?>
                    <option value="<?= htmlspecialchars($lieu['lieu_id']) ?>"><?= htmlspecialchars($lieu['lieu_nom']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input-parent">
            <label for="soiree_tarif">Tarif</label>
            <input type="number" step="0.01" id="soiree_tarif" name="soiree_tarif" required>
        </div>
    </div>
    <button type="submit">Créer la soirée</button>
</form>

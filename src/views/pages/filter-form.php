<section id="filter-spectacles">
    <a href="?action=default">Retour à l'accueil</a>
    <h2>Filtrer les spectacles</h2>
    <form method="post" action="?action=filter" class="form form-action">
        <div class="inputs">
            <div class="input-parent">
                <label for="date">Date</label>
                <input type="date" id="date" name="date">
            </div>

            <div class="input-parent">
                <label for="lieu">Lieu</label>
                <select id="lieu" name="lieu">
                    <option value="">Sélectionnez un lieu</option>
                    <?php foreach ($lieux as $lieu): ?>
                        <option value="<?= htmlspecialchars($lieu['lieu_id']) ?>">
                            <?= htmlspecialchars($lieu['lieu_nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-parent">
                <label for="style">Style de musique</label>
                <select id="style" name="style">
                    <option value="">Sélectionnez un style</option>
                    <?php foreach ($styles as $style): ?>
                        <option value="<?= htmlspecialchars($style['spectacle_style_musique']) ?>">
                            <?= htmlspecialchars($style['spectacle_style_musique']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <button type="submit">Filtrer</button>
    </form>
</section>

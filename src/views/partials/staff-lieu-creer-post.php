<form method="post" action="?action=staff" class="form form-action">
    <input type="hidden" name="creer_objet" value="lieu">
    <div class="inputs">
        <div class="input-parent">
            <label for="lieu_nom">Nom du lieu</label>
            <input type="text" id="lieu_nom" name="lieu_nom" required>
        </div>
        <div class="input-parent">
            <label for="lieu_adresse">Adresse</label>
            <input type="text" id="lieu_adresse" name="lieu_adresse" required>
        </div>
        <div class="input-parent">
            <label for="lieu_nb_places_assises">Nombre de places assises</label>
            <input type="number" id="lieu_nb_places_assises" name="lieu_nb_places_assises" required>
        </div>
        <div class="input-parent">
            <label for="lieu_nb_places_debout">Nombre de places debout</label>
            <input type="number" id="lieu_nb_places_debout" name="lieu_nb_places_debout" required>
        </div>
    </div>
    <button type="submit">Créer le lieu</button>
</form>
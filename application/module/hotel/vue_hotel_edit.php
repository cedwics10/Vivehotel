    <form method="post" action="<?= hlien("hotel", "save") ?>">
        <input type="hidden" name="hot_id" id="hot_id" value="<?= $id ?>" />

        <div class='form-group'><br />
            <p><a class="btn btn-secondary" href="<?= hlien('hotel') ?>">Retour</a></p>

            <h1><?= "Modification de l'hôtel $hot_nom" ?></h1>

            <label for="hot_statut">Statut</label>
            <select id="hot_statut" name="hot_statut" class='form-control'>
                <?php
                foreach (Hotel::STATUT as $h_statut) {
                    $sel = ($h_statut == $hot_statut) ? 'selected' : '';
                ?>
                    <option value="<?= $h_statut ?>" <?= $sel ?>><?= mhe($h_statut) ?></option>
                <?php  }  ?>
            </select>

            <div class='form-group'>
                <label for='hot_nom'>Nom</label>
                <input id='hot_nom' name='hot_nom' type='text' size='50' value='<?= mhe($hot_nom) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='hot_adresse'>Adresse</label>
                <input id='hot_adresse' name='hot_adresse' type='text' size='50' value='<?= mhe($hot_adresse) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='hot_departement'>Departement</label>
                <input id='hot_departement' name='hot_departement' type='text' size='50' value='<?= mhe($hot_departement) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='hot_description'>Description</label>
                <textarea id='hot_description' name='hot_description' rows="5" class='form-control'><?= mhe($hot_description) ?></textarea>
            </div>
            <div class='form-group'>
                <label for='hot_longitude'>Longitude</label>
                <input id='hot_longitude' name='hot_longitude' type='number' step='0.01' size='50' value='<?= mhe($hot_longitude) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='hot_latitude'>Latitude</label>
                <input id='hot_latitude' name='hot_latitude' type='number' step='0.01' size='50' value='<?= mhe($hot_latitude) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='hot_hocategorie'>Hocategorie</label>


                <select id='hot_hocategorie' name='hot_hocategorie' class='form-control'>
                    <?= Table::HTMLoptions("select * from hocategorie ", "hoc_id", "hoc_categorie", $hot_hocategorie) ?>
                </select>
            </div>

            <p><input class=" btn btn-success" type="submit" name="btSubmit" value="Enregistrer" /></p>

    </form>
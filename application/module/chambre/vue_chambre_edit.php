<div class='form-group'>
    <h1>
        <label>Modification de la chambre "<?= mhe($cha_numero) ?>" de l'hôtel "<?= mhe($hot_nom) ?>"</label>
    </h1>
    <a class="btn btn-secondary" href="<?= hlien('chambre', 'hotel', 'id', $cha_id) ?>">Liste des chambres</a>
</div>

<form method="post" action="<?= hlien("chambre", "save") ?>">
    <input type="hidden" name="cha_id" id="cha_id" value="<?= mhe($id) ?>" />
    <div class='form-group'>
        <label for='cha_statut'>Statut</label>
        <select id='cha_statut' name='cha_statut' type='text' class='form-control'>
            <?php
            foreach (Chambre::CHA_STATUT as $statut) {
                $s = '';
                if ($statut == $cha_statut) {
                    $s = ' selected ';
                }
                $statut = mhe($statut);
                echo "<option value='" . $statut . "' " . $s . ">" . $statut . "</option>";
            }
            ?>
        </select>
    </div>
    <div class='form-group'>
        <label for='cha_surface'>Surface</label> : <?= mhe($cha_surface) ?>m²
    </div>
    <div class='form-group'>
        <label for='cha_type_lit'>Type lits</label>
        <select id='cha_type_lit' name='cha_type_lit' class='form-control'>
            <?php

            foreach (Chambre::TYPE_LITS as $cle => $type_lit) {
                $sel = ($type_lit == $cha_type_lit) ? 'selected' : ''; ?>
                <option value='<?= mhe($type_lit) ?>' $sel><?= mhe($type_lit) ?></option>
            <?php }
            ?>
        </select>
    </div>

    <div class='form-group'>
        <label for='cha_description'>Description</label><br />
        <textarea id='cha_description' name='cha_description' rows='5' class='form-control'><?= mhe($cha_description) ?></textarea>
    </div>
    <div class='form-group'>
        <?php
        foreach (Chambre::LISTE_OPTIONS as $texte => $champ) { ?>

            <label for='<?= mhe($champ) ?>'><?= mhe($texte) ?></label>
            <select id='<?= mhe($champ) ?>' name='<?= mhe($champ) ?>' type='text' class='form-control'>
                <option value='0' <?= ($$champ ===  0) ? 'selected' : '' ?>>Non</option>
                <option value='1' <?= ($$champ ===  1) ? 'selected' : '' ?>>Oui</option>
            </select>

        <?php } ?>
    </div>

    <div class='form-group'>
        <label for='cha_chcategorie'>Catégorie de la chambre</label>
        <select class="form-control" id="cha_chcategorie" name="cha_chcategorie">
            <option value='1'>Standard</option>
            <option value='2'>Supérieure</option>
            <option value='3'>Luxe</option>
            <option value='4'>Suite</option>
        </select>
    </div>

    <div class='form-group'>
        <label for='cha_description'>Numéro</label><br />
        <input type="text" id='cha_description' name='cha_numero' rows='5' class='form-control' value="<?= mhe($cha_numero) ?>">
    </div>


    <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
</form>
</div>
<hr>
<footer>
    Framework-GUINOT&copy;2021-2022

    <script src="_js/script.js"></script>
</footer>
</div>
</body>

</html>
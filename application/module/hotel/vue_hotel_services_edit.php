    <h1>Modifier le prix du service "<?= mhe($ser_nom) ?>" de l'hôtel "<?= mhe($hot_nom) ?>"</h1>
    <form method="post" action="<?= hlien("hotel", "services_save") ?>">
        <input type="hidden" name="pro_id" id="pro_id" value="<?= $id ?>" />
        <input type="hidden" name="pro_hotel" id="pro_hotel" value="<?= $hot_id ?>" />

        <div class='form-group'>
            <label for='pro_prix'>Prix</label>
            <input id='pro_prix' name='pro_prix' type='text' size='50' value='<?= mhe($pro_prix) ?>' class='form-control' />
        </div>

        <input class="btn btn-success" type="submit" value="Enregistrer" />
        <input type="hidden" name="bt_submit" />
    </form>
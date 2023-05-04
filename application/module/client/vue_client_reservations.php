<h1>Réserver une chambre d'hôtel</h1>

<form method="post" action="<?= hlien("reservation", "save") ?>">
    <div class='form-group'>
        <label for='res_date_debut'>Date de debut</label>
        <input id='res_date_debut' name='res_date_debut' type='date' size='50' value='<?= mhe($res_date_debut) ?>' class='form-control' />
    </div>
    <div class='form-group'>
        <label for='res_date_fin'>Date_fin</label>
        <input id='res_date_fin' name='res_date_fin' type='date' size='50' value='<?= mhe($res_date_fin) ?>' class='form-control' />
    </div>

    <div class='form-group'>
        <label for='res_hotel'>Hotel</label>
        <select id='res_hotel' name='res_hotel' type='text' class='form-control'>
            <?= Hotel::OPTIONhotel($res_hotel); ?>
        </select>
    </div>
    <div class='form-group'>
        <label for='res_chambre'>Chambre</label>
        <select id='res_chambre' name='res_chambre' type='text' class='form-control'>

        </select>
    </div>
    <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
    <br>
</form>
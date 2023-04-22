<h1>Modifier les données du client "<?= mhe($cli_nom) ?>"</h1>
<form method="post" action="<?= hlien("client", "save") ?>">
    <input type="hidden" name="cli_id" id="cli_id" value="<?= $id ?>" />

    <div class='form-group'>
        <label for='cli_nom'>Nom</label>
        <input id='cli_nom' name='cli_nom' type='text' size='50' value='<?= mhe($cli_nom) ?>' class='form-control' />
    </div>
    <div class='form-group'>
        <label for='cli_identifiant'>Identifiant</label>
        <input id='cli_identifiant' name='cli_identifiant' type='text' size='50' value='<?= mhe($cli_identifiant) ?>' class='form-control' />
    </div>
    <!--<div class='form-group'>
                            <label for='cli_mdp'>Mdp</label>
                            <input id='cli_mdp' name='cli_mdp' type='text' size='50' value='//=mhe($cli_mdp)?>'  class='form-control' />
                        </div>-->
    <div class='form-group'>
        <label for='cli_email'>Email</label>
        <input id='cli_email' name='cli_email' type='text' size='50' value='<?= mhe($cli_email) ?>' class='form-control' />
    </div>
    <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
</form>
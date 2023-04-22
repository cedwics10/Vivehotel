    <form method="post" action="<?= hlien("personnel", "save") ?>">
        <input type="hidden" name="per_id" id="per_id" value="<?= $id ?>" />
        <div class='form-group'>
            <label for='per_nom'>Nom</label>
            <input id='per_nom' name='per_nom' type='text' size='50' value='<?= mhe($per_nom) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='per_identifiant'>identifiant</label>
            <input id='per_identifiant' name='per_identifiant' type='text' size='50' value='<?= mhe($per_identifiant) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='per_email'>saisisez le mail</label>
            <input id='per_email' name='per_email' type='text' size='50' value='<?= mhe($per_email) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='per_mdp'>mot de passe</label>
            <input id='per_mdp' name='per_mdp' type='password' size='50' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='per_role'>Role</label>
            <select id='per_role' name='per_role' value='' class='form-control'>
                <?php
                foreach (Personnel::ROLE as $role) {
                    $sel = '';
                    if ($role === $per_role)
                        $sel = 'selected';
                    echo "<option value='$role'>$role</option>";
                }
                ?>
            </select>
        </div>
        <div class='form-group'>
            <label for='per_hotel'>Hotel</label>
            <select id='per_hotel' name='per_hotel' class='form-control'>
                <?= Hotel::OPTIONhotel($per_hotel) ?>
            </select>
        </div>
        <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
    </form>
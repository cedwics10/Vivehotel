        <h2>Connexion du personnel</h2>
        <form method="post">
            <div class='form-group'>
                <label for='per_email'>Email</label>
                <input id='per_email' name='per_email' type='text' size='50' value='<?= mhe($per_email) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='per_mdp'>Mot de passe</label>
                <input id='per_mdp' name='per_mdp' type='password' size='50' value='' class='form-control' />
            </div>
            <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
        </form>
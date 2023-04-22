        <h2>Connexion</h2>
        <form method="post">            
            <div class='form-group'>
                <label for='cli_email'>Email</label>
                <input id='cli_email' name='cli_email' type='text' size='50' value='<?= mhe($cli_email) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='cli_mdp'>Mot de passe</label>
                <input id='cli_mdp' name='cli_mdp' type='password' size='50' value='' class='form-control' />
            </div>            
            <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
        </form>
        <h2>Inscription</h2>
        <form method="post" onsubmit="return verification()">
            <div class='form-group'>
                <label for='cli_nom'>Nom</label>
                <input id='cli_nom' name='cli_nom' type='text' size='50' value='<?= mhe($cli_nom) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='cli_identifiant'>Identifiant</label>
                <input id='cli_identifiant' name='cli_identifiant' type='text' size='50' value='<?= mhe($cli_identifiant) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='cli_email'>Email</label>
                <input id='cli_email' name='cli_email' type='text' size='50' value='<?= mhe($cli_email) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='cli_mdp'>Mot de passe</label>
                <input id='cli_mdp' name='cli_mdp' type='password' size='50' value='' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='cli_mdp2'>Vérification du Mot de passe</label>
                <input id='cli_mdp2' name='cli_mdp2' type='password' size='50' value='' class='form-control' />
            </div>
            
            <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
        </form>
        <script>
            function verification() {
                if (cli_mdp.value==cli_mdp2.value) 
                    return true;
                else {
                    alert("Erreur : vérification du mot de passe incorrecte.");
                    return false;
                }
            }
        </script>
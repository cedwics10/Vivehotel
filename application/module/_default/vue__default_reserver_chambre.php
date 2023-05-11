<h2>Confirmation de la réservation de la chambre "<?= mhe($hot_nom) ?>"</h2>

<form method="post" action="<?= hlien('_default', 'payer_chambre') ?>">
    <table class="table table-striped">
        <thead>
            <tr>
                <td colspan="2">
                    <strong>Hôtel : <?= mhe($hot_nom) ?> dans le <?= mhe($hot_departement) ?></strong>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Adresse</td>
                <td><?= mhe($hot_adresse) ?></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><?= mhe($hot_description) ?></td>
            </tr>
            <tr>
                <td>Catégorie</td>
                <td>(?)</td>
            </tr>
        </tbody>
    </table>

    <h2>En cours de réservation</h2>


    <table class="table table-striped">
        <thead>
            <tr>
                <td colspan="2"><strong>Description de la chambre</strong></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Catégorie</td>
                <td><?= mhe($chc_categorie) ?></td>
            </tr>
            <tr>
                <td>Type de lit</td>
                <td><?= mhe($cha_type_lit) ?></td>
            </tr>

            <tr>
                <td>Description</td>
                <td><?= mhe($cha_description) ?></td>
            </tr>

        </tbody>
    </table>
    <input type="submit" name="btsubmit" value="Page de paiement"><br />
</form>

<br />
<h2>Description de l'hôtel "<?= mhe($data['hot_nom']) ?>"</h2>


<table class="table table-striped">
    <thead>
        <tr>
            <td colspan="2">
                <strong><?= mhe($data['hot_nom']) ?> dans le <?= $data['hot_departement'] ?></strong>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Adresse</td>
            <td><?= mhe($data['hot_adresse']) ?></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><?= mhe($data['hot_description']) ?></td>
        </tr>
        <tr>
            <td>Catégorie</td>
            <td><?= mhe($data['hoc_categorie']) ?></td>
        </tr>
        <tr>
            <td>Statut</td>
            <td><?= mhe($data['hot_statut']) ?></td>
        </tr>
        <tr>
            <td>Nombre de chambres actives</td>
            <td><?= mhe($chambreActif) ?></td>
        </tr>
        <tr>
            <td>Nombre de chambres libres</td>
            <td><?= mhe($chambreLibres) ?></td>
        </tr>
    </tbody>
</table>

<h2>Statistiques de l'hôtel "<?= mhe($data['hot_nom']) ?>"</h2>


<table class="table table-striped">
    <thead>
        <tr>
            <td colspan="2"><strong>Statistiques</strong></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Chiffre d'affaire (hors services)</td>
            <td><?= mhe($chiffreA) ?></td>
        </tr>
        <tr>
            <td>Chiffre d'affaire des services</td>
            <td><?= mhe($caSservices) ?></td>
        </tr>
        <tr>
            <td>
                <b>Chiffre d'affaire total</b>
            </td>
            <td>
                <b><?= mhe($chiffreA + $caSservices) ?></b>
            </td>
        </tr>
    </tbody>
</table>

<a href="<?= hlien('hotel') ?>" class="btn btn-primary" type="button">Liste des hôtels</a>
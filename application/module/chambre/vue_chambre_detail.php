<h2>Description de la chambre "<?= mhe($data['hot_nom']) ?>"</h2>


<table class="table table-striped">
    <thead>
        <tr>
            <td colspan="2">
                <strong><?= mhe($data['cha_nom']) ?> (dans l'hôtel <?= $data['hot_nom'] ?>)</strong>
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
            <td><?= mhe($data['cha_description']) ?></td>
        </tr>
        <tr>
            <td>Catégorie</td>
            <td><?= mhe($data['chc_categorie']) ?></td>
        </tr>
        <tr>
            <td>Statut</td>
            <td><?= mhe($data['cha_statut']) ?></td>
        </tr>
        <tr>
            <td>Nombre de réservations de cette chambre</td>
            <td><?= mhe($chambreActif) ?></td>
        </tr>
        <tr>
            <td>Prendre une réservation</td>
            <td><!-- Coder un tableau de réservation --></td>
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
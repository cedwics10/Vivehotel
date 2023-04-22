<h2>Description de la chambre "<?= mhe($data['hot_nom']) ?>"</h2>


<table class="table table-striped">
    <thead>
        <tr>
            <td colspan="2">
                <strong>Chambre <?= mhe($data['cha_numero']) ?> (de l'hôtel "<?= $data['hot_nom'] ?>")</strong>
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
    </tbody>
</table>

<h2>Statistiques de la chambre "<?= mhe($data['hot_nom']) ?>"</h2>


<table class="table table-striped">
    <thead>
        <tr>
            <td colspan="2"><strong>Statistiques</strong></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Nombre de réservations déjà prises pour cette chambre</td>
            <td>(?)</td>
        </tr>
    </tbody>
</table>

<a href="<?= hlien('chambre') ?>" class="btn btn-primary" type="button">Liste des chambres</a>
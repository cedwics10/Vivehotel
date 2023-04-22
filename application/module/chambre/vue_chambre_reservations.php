    <h2>Réservations de la chambre <?= mhe($_GET['id']); ?></h2>
    <p><a class="btn btn-primary" href="<?= hlien("reservation", "edit", "id", 0) ?>">Nouveau reservation</a></p>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>

                <th>Id</th>
                <th>Date_debut</th>
                <th>Date_fin</th>
                <th>Etat</th>
                <th>Client</th>
                <th>Hotel</th>
                <th>modifier</th>
                <th>supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $row) { ?>
                <tr>

                    <td><?= mhe($row['res_id']) ?></td>
                    <td><?= mhe($row['res_date_debut']) ?></td>
                    <td><?= mhe($row['res_date_fin']) ?></td>
                    <td><?= mhe($row['res_etat']) ?></td>
                    <td><?= mhe($row['cli_nom']) ?></td>
                    <td><?= mhe($row['hot_nom']) ?></td>
                    <td><a class="btn btn-warning" href="<?= hlien("reservation", "edit", "id", $row["res_id"]) ?>">Modifier</a></td>
                    <td><a class="btn btn-danger" href="<?= hlien("reservation", "delete", "id", $row["res_id"]) ?>">Supprimer</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<h2>Vos réservations</h2>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Hotel</th>
            <th>Chambre</th>
            <th>Date debut</th>
            <th>Date fin</th>
            <th>Etat</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($data as $row) { ?>
            <tr>
                <td><?= mhe($row['hot_nom']) ?></td>
                <td><?= mhe($row['cha_numero']) ?></td>
                <td><?= dateFr($row['res_date_debut']) ?></td>
                <td><?= dateFr($row['res_date_fin']) ?></td>
                <td><?= mhe($row['res_etat']) ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
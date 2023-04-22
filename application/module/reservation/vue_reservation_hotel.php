    <h2>Liste des réservations de l'hôtel "<?= mhe($hot_nom) ?>"</h2>

    <p><a class="btn btn-primary" href="<?= hlien("reservation", "edit", "id", 0) ?>">Nouveau reservation</a></p>
    <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>
    			<th>Hotel</th>
    			<th>Chambre</th>
    			<th>Client</th>
    			<!-- <th>Date creation</th> -->
    			<th>Date debut</th>
    			<th>Date fin</th>
    			<th>Etat</th>
    			<th>Services</th>
    			<th>modifier</th>
    			<th>supprimer</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			foreach ($data as $row) { ?>
    			<tr>
    				<td><?= mhe($row['hot_nom']) ?></td>
    				<td><?= mhe($row['cha_numero']) ?></td>
    				<td><?= mhe($row['cli_nom']) ?></td>
    				<!-- <td><?= dateFr($row['res_date_creation']) ?></td> -->
    				<td><?= dateFr($row['res_date_debut']) ?></td>
    				<td><?= dateFr($row['res_date_fin']) ?></td>
    				<td><?= mhe($row['res_etat']) ?></td>

    				<td><a class="btn btn-info" href="<?= hlien("reservation", "services", "id", $row["res_id"]) ?>">Services</a></td>
    				<td><a class="btn btn-warning" href="<?= hlien("reservation", "edit", "id", $row["res_id"]) ?>">Modifier</a></td>
    				<td><a class="btn btn-danger" href="<?= hlien("reservation", "delete", "id", $row["res_id"]) ?>">Supprimer</a></td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>
    <h2>personnel</h2>
    <p><a class="btn btn-primary" href="<?= hlien("personnel", "edit", "id", 0) ?>">Nouveau personnel</a></p>
    <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>

    			<th>Id</th>
    			<th>Réservations</th>
    			<th>Chambres</th>
    			<th>Hotel</th>
    			<th>Statistiques</th>
    			<th>modifier</th>
    			<th>supprimer</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			foreach ($data as $row) { ?>
    			<tr>

    				<td><?= mhe($row['per_id']) ?></td>
    				<td><?= mhe($row['res_id']) ?></td>
    				<td><?= mhe($row['res_chambre']) ?></td>
    				<td><?= mhe($row['res_hotel']) ?></td>
    				<td><?= mhe($row['stistiques']) ?></td>
    				<td><?= mhe($row['hot_nom']) ?></td>
    				<td><a class="btn btn-warning" href="<?= hlien("personnel", "edit", "id", $row["per_id"]) ?>">Modifier</a></td>
    				<td><a class="btn btn-danger" href="<?= hlien("personnel", "delete", "id", $row["per_id"]) ?>">Supprimer</a></td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>
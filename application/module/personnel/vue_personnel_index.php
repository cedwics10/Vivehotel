    <h2>Ensemble du personnel de la compagnie</h2>
    <p><a class="btn btn-primary" href="<?= hlien("personnel", "edit", "id", 0) ?>">Nouveau personnel</a></p>
    <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>
    			<th>Id</th>
    			<th>Nom</th>
    			<th>Identifiant</th>
    			<th>Email</th>
    			<th>Role</th>
    			<th>Hotel</th>
    			<th>modifier</th>
    			<th>supprimer</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			foreach ($data as $row) { ?>
    			<tr>

    				<td><?= mhe($row['per_id']) ?></td>
    				<td><?= mhe($row['per_nom']) ?></td>
    				<td><?= mhe($row['per_identifiant']) ?></td>
    				<td><?= mhe($row['per_email']) ?></td>
    				<td><?= mhe($row['per_role']) ?></td>
    				<td><?= mhe($row['per_hotel']) ?></td>
    				<td><a class="btn btn-warning" href="<?= hlien("personnel", "edit", "id", $row["per_id"]) ?>">Modifier</a></td>
    				<td><a class="btn btn-danger" href="<?= hlien("personnel", "delete", "id", $row["per_id"]) ?>">Supprimer</a></td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>
    <h2>Liste de tous les clients de "Vivehotel"</h2>
    <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>
    			<th>Nom</th>
    			<th>Identifiant</th>
    			<th>Email</th>
    			<th>Réservations</th>
    			<th>modifier</th>
    			<th>supprimer</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			foreach ($data as $row) { ?>
    			<tr>
    				<td><?= mhe($row['cli_nom']) ?></td>
    				<td><?= mhe($row['cli_identifiant']) ?></td>
    				<td><?= mhe($row['cli_email']) ?></td>
    				<td><a class="btn btn-info" href="<?= hlien("reservation", "client", "id", mhe($row["cli_id"])) ?>">Réservation</a></td>
    				<td><a class="btn btn-warning" href="<?= hlien("client", "edit", "id", mhe($row["cli_id"])) ?>">Modifier</a></td>
    				<td><a class="btn btn-danger" href="<?= hlien("client", "delete", "id", mhe($row["cli_id"])) ?>">Supprimer</a></td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>
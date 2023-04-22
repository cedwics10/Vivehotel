    <h2>Liste de tous les hôtels de la compagnie</h2>
    <p><a class="btn btn-primary" href="<?= hlien("hotel", "edit", "id", 0) ?>">Nouveau hotel</a></p>
    <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>
    			<th>Statut</th>
    			<th>Nom</th>
    			<th>Departement</th>
    			<th>Statistiques</th>
    			<th>services</th>
    			<th>modifier</th>
    			<th>Supprimer</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			foreach ($data as $row) { ?>
    			<tr>
    				<td><?= mhe($row['hot_statut']) ?></td>
    				<td><?= mhe($row['hot_nom']) ?></td>
    				<td><?= mhe($row['hot_departement']) ?></td>
    				<td><a class="btn btn btn-dark" href="<?= hlien("hotel", "statistiques", "id", $row["hot_id"]) ?>">Statistiques</a></td>
    				<td><a class="btn btn-info" href="<?= hlien("hotel", "services", "id", $row["hot_id"]) ?>">Services</a></td>
    				<td><a class=<td><a class="btn btn-warning" href="<?= hlien("hotel", "edit", "id", $row["hot_id"]) ?>">Modifier</a></td>
    				<td><a class="btn btn-danger" href="<?= hlien("hotel", "delete", "id", $row["hot_id"]) ?>">Supprimer</a></td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>
<h2>Liste de tous les hôtels de la compagnie</h2>
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>Statut</th>
			<th>Nom</th>
			<th>Departement</th>
			<th>Chambres</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($data as $row) { ?>
			<tr>
				<td><?= mhe($row['hot_statut']) ?></td>
				<td><?= mhe($row['hot_nom']) ?></td>
				<td><?= mhe($row['hot_departement']) ?></td>
				<td><a class="btn btn btn-success" href="<?= hlien("chambre", "hotel_tele", "id", $row["hot_id"]) ?>">Chambres</a></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
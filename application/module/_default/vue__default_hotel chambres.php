<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Departement</th>
			<th>Réserver une chambre</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($data as $row) { ?>
			<tr>
				<td><?= mhe($row['hot_nom']) ?></td>
				<td><?= mhe($row['hot_departement']) ?></td>
				<td><a href="<?= hlien('_default', 'hotel_chambres', 'id', mhe($row['hot_id'])) ?>">Réserver</a></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
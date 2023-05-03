<a class="btn btn btn-dark" href="<?= hlien("hotel", "teleconseiller") ?>">Liste des hôtels</a>

<h2>Liste des chambres de l'hôtel "<?= mhe($hot_nom) ?>"</h2>
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>Numero</th>
			<th>Hôtel</th>
			<th>Statut</th>
			<th>Surface</th>
			<th>Type lits</th>

			<th>Description</th>
			<th>Services</th>
			<th>Chcategorie</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($data as $row) {
			array_map('trim', $row);
		?>
			<tr>
				<td><?= mhe($row['cha_numero']) ?></td>
				<td><?= mhe($row['cha_hotel']) ?></td>
				<td><?= mhe($row['cha_statut']) ?></td>
				<td><?= mhe($row['cha_surface']) ?>m²</td>
				<td><?= mhe($row['cha_type_lit']) ?></td>
				<td><?= $row['cha_description'] ?></td>
				<td>
					<?= ($row['cha_jacuzzi'] === 1 ? 'jaccuzi<br />' : '') ?>
					<?= ($row['cha_balcon'] === 1 ? 'balcon<br />' : '') ?>
					<?= ($row['cha_wifi'] === 1 ? 'wifi<br />' : '') ?>
					<?= ($row['cha_minibar'] === 1 ? 'minibar<br />' : '') ?>
					<?= ($row['cha_coffre'] === 1 ? 'coffre<br />' : '') ?>
					<?= ($row['cha_vue'] === 1 ? 'vue<br />' : '') ?>
				</td>
				<td><?= mhe($row['chc_categorie']) ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
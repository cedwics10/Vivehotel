    <h2>Liste des chambres de la compagnie.</h2>

    <?= FormRecherche('Chambre') ?>

    <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>
    			<th>Numero</th>
    			<th>Statut</th>
    			<th>Surface</th>
    			<th>Type lits</th>

    			<th>Description</th>
    			<th>Services</th>
    			<th>Chcategorie</th>
    			<th>Réservation</th>
    			<th>modifier</th>
    			<th>supprimer</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			foreach ($data as $row) {
				array_map('trim', $row);
			?>
    			<tr>
    				<td><?= mhe($row['cha_numero']) ?></td>
    				<td><?= mhe($row['cha_statut']) ?></td>
    				<td><?= mhe($row['cha_surface']) ?>m²</td>
    				<td><?= mhe($row['cha_typeLit']) ?></td>
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
    				<td><a class="btn btn-info" href="<?= hlien("chambre", "reservations", "id", $row["cha_id"]) ?>">Réservation</td>
    				<td><a class="btn btn-warning" href="<?= hlien("chambre", "edit", "id", $row["cha_id"]) ?>">Modifier</a></td>
    				<td><a class="btn btn-danger" href="<?= hlien("chambre", "delete", "id", $row["cha_id"]) ?>">Supprimer</a></td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>
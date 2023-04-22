    <h2>chcategorie</h2>
    <p><a class="btn btn-primary" href="<?=hlien("chcategorie","edit","id",0)?>">Nouveau chcategorie</a></p>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				
			<th>Id</th>
			<th>Categorie</th>
				<th>modifier</th>
				<th>supprimer</th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ( $data as $row) { ?>
		<tr>
			
			<td><?=mhe($row['chc_id'])?></td>
			<td><?=mhe($row['chc_categorie'])?></td>
			<td><a class="btn btn-warning" href="<?=hlien("chcategorie","edit","id",$row["chc_id"])?>">Modifier</a></td>
			<td><a class="btn btn-danger" href="<?=hlien("chcategorie","delete","id",$row["chc_id"])?>">Supprimer</a></td>
		</tr>
		<?php } ?>
		</tbody>
	</table>
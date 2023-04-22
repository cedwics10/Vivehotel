    <h2>hocategorie</h2>
    <p><a class="btn btn-primary" href="<?=hlien("hocategorie","edit","id",0)?>">Nouveau hocategorie</a></p>
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
			
			<td><?=mhe($row['hoc_id'])?></td>
			<td><?=mhe($row['hoc_categorie'])?></td>
			<td><a class="btn btn-warning" href="<?=hlien("hocategorie","edit","id",$row["hoc_id"])?>">Modifier</a></td>
			<td><a class="btn btn-danger" href="<?=hlien("hocategorie","delete","id",$row["hoc_id"])?>">Supprimer</a></td>
		</tr>
		<?php } ?>
		</tbody>
	</table>
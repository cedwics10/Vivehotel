    <h2>proposer</h2>
    <p><a class="btn btn-primary" href="<?=hlien("proposer","edit","id",0)?>">Nouveau proposer</a></p>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				
			<th>Id</th>
			<th>Prix</th>
			<th>Hotel</th>
			<th>Services</th>
				<th>modifier</th>
				<th>supprimer</th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ( $data as $row) { ?>
		<tr>
			
			<td><?=mhe($row['pro_id'])?></td>
			<td><?=mhe($row['pro_prix'])?></td>
			<td><?=mhe($row['pro_hotel'])?></td>
			<td><?=mhe($row['pro_services'])?></td>
			<td><a class="btn btn-warning" href="<?=hlien("proposer","edit","id",$row["pro_id"])?>">Modifier</a></td>
			<td><a class="btn btn-danger" href="<?=hlien("proposer","delete","id",$row["pro_id"])?>">Supprimer</a></td>
		</tr>
		<?php } ?>
		</tbody>
	</table>
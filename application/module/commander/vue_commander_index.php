    <h2>commander</h2>
    <p><a class="btn btn-primary" href="<?=hlien("commander","edit","id",0)?>">Nouveau commander</a></p>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				
			<th>Id</th>
			<th>Quantite</th>
			<th>Services</th>
			<th>Reservation</th>
				<th>modifier</th>
				<th>supprimer</th>
			</tr>
		</thead>
		<tbody>
		<?php
		foreach ( $data as $row) { ?>
		<tr>
			
			<td><?=mhe($row['com_id'])?></td>
			<td><?=mhe($row['com_quantite'])?></td>
			<td><?=mhe($row['com_services'])?></td>
			<td><?=mhe($row['com_reservation'])?></td>
			<td><a class="btn btn-warning" href="<?=hlien("commander","edit","id",$row["com_id"])?>">Modifier</a></td>
			<td><a class="btn btn-danger" href="<?=hlien("commander","delete","id",$row["com_id"])?>">Supprimer</a></td>
		</tr>
		<?php } ?>
		</tbody>
	</table>
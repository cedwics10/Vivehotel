    <h1>Services de hotel <?= mhe($_GET["id"]) ?></h1>
    <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>
    			<th>Service</th>
    			<th>Prix</th>
    			<th>modifier</th>
    			<th>suprimer</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			foreach ($data as $row) { ?>
    			<tr>
    				<td><?= mhe($row['ser_nom']) ?></td>
    				<td><?= mhe($row['pro_prix']) ?></td>
    				<td><a class="btn btn-warning" href="<?= hlien("hotel", "services_edit", "id", $row["pro_id"]) ?>">Modifier</a></td>
    				<td><a class="btn btn-danger" href="<?= hlien("proposer", "delete", "id", $row["pro_id"]) ?>">Supprimer</a></td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>

    <form method="post" action="<?= hlien('hotel', 'services_save') ?>">
    	<label for="nouv_service">Ajouter un service à l'hôtel courant :</label>
    	<select name="pro_services">
    		<?= Services::optionNotHotel($_GET['id']); ?>
    	</select> Prix : <input type="number" name="pro_prix" size="5" />
    	<input type="hidden" name="pro_hotel" value="<?= mhe($_GET['id']) ?>" />
    	<input type="hidden" name="pro_hotel" value="<?= mhe($_GET['id']) ?>" />
    	<input type="hidden" name="bt_submit" />
    	<input class="btn btn-success" type="submit" value="Envoyer" />
		<br>
		<a class="btn btn-info" href="<?=hlien("hotel","index")?>">Retour</a>
    </form>
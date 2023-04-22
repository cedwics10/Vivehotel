<h1>Liste des services de la réservation <?= mhe($_GET["id"]) ?></h1>
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>Service</th>
			<th>Quantité</th>
			<th>suprimer</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($data as $row) { // lister les services de la réservation mhe($_GET['id'])
		?>
			<tr>
				<td><?= mhe($row['ser_nom']) ?></td>
				<td><?= mhe($row['com_quantite']); ?></td>
				<td><a class="btn btn-danger" href="<?= hlien("reservation", "services_delete", "id", $row['com_id']) ?>">Supprimer</a></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<a class="btn btn-info" href="<?=hlien("reservation","index") ?>">Retour</a>
<!-- 
Créer un formulaire qui permet d'ajouter un service à la réservation
* Faire une liste des services qui n'ont pas été prises par la réservation
* Modifier le formulaire
* Traiter le formulaire dans une action save_ser
-->
<h1>Ajouter un service dans la reservation :</h1>
<form method="post" action="<?= hlien('reservation', 'services_save') ?>">
	<label for="com_services">Service :</label>
	<select name="com_services" class="form-control">
		<?= Services::optionNotServices($_GET['id']); ?>
	</select><br />
	<label for="com_quantite">Quantité de service :</label> <input type="number" name="com_quantite" class="form-control" />
	<br />
	<p><input type="submit" value="Envoyer" /></p>
	<input type="hidden" name="com_id" value="0" />
	<input type="hidden" name="com_reservation" value="<?= mhe($_GET['id']) ?>" />
	<input type="hidden" name="bt_submit" />

</form>
Affiche l'hôtel voulu - numéro <?= mhe($_GET['id']) ?>


<h1>Premier jour de votre réservation ? </h1>
<form method="post">
	<label for="date_debut">Date de début de réservation :</label>
	<input type="date" name="date_debut" />
	</table>
	<h1>Dernier jour de votre réservation ? </h1>
	<label for="date_debut">Date de fin de réservation :</label>
	<input type="date" name="date_fin" />

	<?php if (isset($nombreChambreDispo)) { ?>
		<br />
		Nombre de chambres disponibles : <?= $nombreChambreDispo ?><br />
	<?php } ?>
	<input type="submit" />
	<form>
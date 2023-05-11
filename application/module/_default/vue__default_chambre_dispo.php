<h1>Réserver une chambre dans l'hôtel <?= mhe($hot_nom) ?></h1>
<!-- Placer le calendrier -->


<form method="post">
	<h2>Premier jour de votre réservation</h2>
	<label for="date_debut">Date de début de réservation :</label>
	<input type="date" name="date_debut" />
	</table>
	<h2>Dernier jour de votre réservation</h2>
	<label for="date_debut">Date de fin de réservation :</label>
	<input type="date" name="date_fin" />
	<input type="submit" />
	<hr />
	<?php if (isset($nombreChambreDispo)) { ?>
		<br />
		Nombre de chambres disponibles : <?= mhe($nombreChambreDispo) ?> -
		<?php if ($nombreChambreDispo > 0) { ?>
			<a href="<?= hlien(
							'_default',
							'reserver_chambre',
							'hotel',
							$_GET['id'],
							'debut',
							$dateDebut,
							'fin',
							$dateFin
						) ?>">Prendre une chambre</a>
		<?php } ?> <?php } ?>
	<form>
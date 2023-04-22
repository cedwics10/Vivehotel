<?php

/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
 */
class Ctr_tarifer extends Ctr_controleur implements I_crud
{

	public function __construct($action)
	{
		parent::__construct("tarifer", $action);
		$a = "a_$action";
		$this->$a();
	}

	/**
	 * a_index
	 *
	 * @return void Page listant l'ensemble des tarifs, 
	 * éditables par appel ajax sur des cellules d'un tableau
	 */
	function a_index()
	{
		checkAllow('admin');
		$hoc = new Hocategorie();
		$chc = new Chcategorie();
		$tarifer = new Tarifer();

		$chCategorie = $chc->selectAll();
		$hoCategorie = $hoc->selectAll();

		$arrayTarifs = $tarifer->selectAll();

		$dimArrayTarifs = [
			'D1' => $hoc->countCat(),
			'D2' => $chc->countCat()
		];

		$grilleTarifaire = matriceSqlCD(
			$dimArrayTarifs,
			$tarifer::AXES_TABLEAU_TARIFS,
			$arrayTarifs
		);

		require $this->gabarit;
	}


	/**
	 * a_ajax
	 *
	 * @return void Page qui reçoit le traitement
	 * d'une requête AJAX visant à modifier un tarif spécifique
	 * entré par l'utilisateur dans un élément éditable
	 */
	function a_ajax()
	{
		checkAllow('admin');
		$tarif = new Tarifer();

		// Vérifier si l'utilsiateur est administrateur

		$reponseJSON = file_get_contents('php://input');
		$reponseArray = array_map('trim', json_decode($reponseJSON, true));

		$infosPrix = $tarif->selectPrix(
			$reponseArray['tar_hocategorie'],
			$reponseArray['tar_chcategorie']
		);

		$infosPrix['tar_prix'] = $reponseArray['tar_prix'];
		$tarif->save($infosPrix);
	}

	// Pas d'action de modification des tarifs
	function a_edit()
	{
	}

	// Pas d'action de sauvegarde des tarifs
	function a_save()
	{
	}

	// Pas d'action de suppression de tarifs
	function a_delete()
	{
	}
}

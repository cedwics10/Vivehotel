<?php

/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
 */
class Ctr_chambre extends Ctr_controleur implements I_crud
{
	/**
	 * __construct
	 *
	 * @param string $action nom de l'action appelé dans le constructeur
	 * @return void Lance l'action a_$action en tant que page web
	 */
	public function __construct($action)
	{
		parent::__construct("chambre", $action);
		$a = "a_$action";
		$this->$a();
	}

	/**
	 * a_index
	 *
	 * @return void Charge la page d'index des chambres
	 */
	function a_index()
	{
		checkAllow('admin');
		$chClasse = new Chambre();

		array_map('trim', $_POST);

		if (
			isset($_POST['bt_submit'])
			&& isset($_POST['rech_texte'])
			&& isset($_POST['rech_champ'])
			&& in_array($_POST['rech_champ'], Chambre::CRI_RECHERCHE)
		) {
			$data = $chClasse->chaRecherche($_POST['rech_texte'], $_POST['rech_champ']);
		} else
			$data = $chClasse->selectAll();
		require $this->gabarit;
	}

	/**
	 * a_hotel
	 *
	 * @return void Page de la liste des chambres d'un hôtel
	 */
	function a_hotel()
	{

		if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
			$_SESSION['message'][]  = "Numéro d'hôtel invalide";
			header('Location: ' . hlien('chambre'));
			exit();
		}

		$h = new Hotel();
		$hotData = $h->select($_GET['id']);
		extract($hotData);
		$c = new Chambre();
		$data = $c->chaHotel($_GET['id']);
		require $this->gabarit;
	}

	/**
	 * a_edit
	 *
	 * @return void Page d'édition d'une chambre
	 */
	function a_edit()
	{
		checkAllow('admin');
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u = new Chambre();
		if ($id > 0)
			$row = $u->select($id);
		else
			$row = $u->emptyRecord();

		extract($row);

		$CRI_RECHERCHE = Chambre::CRI_RECHERCHE;

		require $this->gabarit;
	}


	/**
	 * a_save
	 *
	 * @return void Page de sauvegarde d'une chambre en base de données
	 */
	function a_save()
	{
		checkAllow('admin');
		if (isset($_POST["btSubmit"])) {
			if (!in_array($_POST['cha_statut'], Chambre::CHA_STATUT)) {
				$_SESSION["message"][] = "Statut de la chambre non valide.";
				header("location:" . hlien("chambre"));
			}

			$u = new Chambre();

			$u->save($_POST);
			$_SESSION["message"][] = ($_POST["cha_id"] == 0) ?  "Le nouvel enregistrement " .
				"Chambre a bien été créé." :  "L'enregistrement Chambre a bien été mis à jour.";
		}

		header("location:" . hlien("chambre"));
	}




	/**
	 * a_delete
	 *
	 * @return void Page de suppression d'une chambre en base de donnnées
	 */
	function a_delete()
	{
		checkAllow('admin');
		if (isset($_GET["id"])) {
			$u = new Chambre();
			$u->delete($_GET["id"]);
			$_SESSION["message"][] = "L'enregistrement Chambre a bien été supprimé.";
		}
		header("location:" . hlien("chambre"));
	}

	/** 
	 * a_reservations
	 *
	 * @return void Liste des réservations d'une chambre en fonction de la clé id de GET
	 */
	function a_reservations()
	{
		checkAllow('admin');
		if (!is_numeric($_GET['id'])) {
			$_SESSION['message'][] = 'Le lien est invalide';
			header('Location: ' . hlien('chambre', 'index'));
		}
		$cha = new Chambre();
		$dataCha = $cha->select($_GET['id']);
		if ($dataCha === false) {
			$_SESSION['message'][] = 'Le lien est invalide';
			header('Location: ' . hlien('chambre', 'index'));
		}

		$reserv = new Reservation();
		$data = $reserv->reservationsCha($_GET['id']);


		require $this->gabarit;
	}

	function a_detail()
	{
		$ch = new Chambre();
		$data = $ch->select($_GET['id']);

		$res = new Reservation();
		$nbRes = $res->countRes($_GET['id']);
		require $this->gabarit;
	}
}

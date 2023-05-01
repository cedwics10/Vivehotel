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
		checkAllow(['admin']);

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
		checkAllow(['admin', 'gestionnaire']);
		if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
			$_SESSION['message'][]  = "Numéro d'hôtel invalide";
			header('Location: ' . hlien('chambre'));
			exit();
		}

		gestionnaireCheckHotel('id', $_GET, hlien());


		$h = new Hotel();
		$hotData = $h->select($_GET['id']);

		extract($hotData);
		$c = new Chambre();
		$data = $c->chaHotel($_GET['id']);
		require $this->gabarit;
	}

	/**
	 * a_hotel
	 *
	 * @return void Page de la liste des chambres d'un hôtel
	 */
	function a_hotel_tele()
	{
		checkAllow(['teleconseiller']);
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
		checkAllow(['admin', 'gestionnaire']);

		$id = isset($_GET["id"]) ? $_GET["id"] : 0;

		if (
			$id === 0
			and isset($_SESSION['per_profil'])
			and $_SESSION['per_profil'] === 'gestionnaire'
		) {
			hlien();
			exit();
		}

		$u = new Chambre();
		if ($id > 0)
			$row = $u->select($id);
		else
			$row = $u->emptyRecord();

		extract($row);
		gestionnaireCheckHotel('cha_hotel', $row, hlien());

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

		$u = new Chambre();
		checkAllow(['admin', 'gestionnaire']);

		if (!isset($_POST["btSubmit"])) {
			hlien();
			exit();
		}
		$dataRoom = $u->select($_POST['cha_id']);
		gestionnaireCheckHotel('cha_hotel', $dataRoom, hlien());


		if ($dataRoom === false) {
			$_SESSION['message'][] = "La chambre n'existe pas";
			header('Location: ' . hlien('chambre'));
			exit();
		}

		if (Hotel::NumeroIndisponible($_POST['cha_numero'], $dataRoom['cha_hotel'], $_POST['cha_id'])) {
			$_SESSION['message'][] = 'Le numéro de chambre a déjà été pris';
			header('Location: ' . hlien('chambre', 'edit', 'id', $_POST['cha_id']));
			exit();
		}

		$u->save($_POST);
		$_SESSION["message"][] = ($_POST["cha_id"] == 0)
			?  "Le nouvel enregistrement chambre a bien été créé."
			:  "L'enregistrement Chambre a bien été mis à jour.";


		header('Location: ' . hlien('chambre', 'edit', 'id', $_POST['cha_id']));
	}




	/**
	 * a_delete
	 *
	 * @return void Page de suppression d'une chambre en base de donnnées
	 */
	function a_delete()
	{
		checkAllow(['admin', 'gestionnaire']);

		if (!isset($_GET["id"]) or !is_numeric($_GET['id'])) {
			header("location:" . hlien("chambre"));
			exit();
		}

		$u = new Chambre();
		$dataRoom = $u->select($_GET['id']);


		if (count($dataRoom) == 0) {
			header("location:" . hlien("chambre"));
			exit();
		}

		gestionnaireCheckHotel('cha_hotel', $dataRoom, hlien());

		$u->delete($_GET["id"]);
		$_SESSION["message"][] = "L'enregistrement Chambre a bien été supprimé.";

		header("location:" . hlien("chambre"));
	}

	/** 
	 * a_reservations
	 *
	 * @return void Liste des réservations d'une chambre en fonction de la clé id de GET
	 */
	function a_reservations()
	{
		checkAllow(['admin', 'gestionnaire']);
		if (!is_numeric($_GET['id'])) {
			$_SESSION['message'][] = 'Le lien est invalide';
			header('Location: ' . hlien('chambre', 'index'));
		}
		$cha = new Chambre();
		$dataCha = $cha->select($_GET['id']);

		gestionnaireCheckHotel('cha_hotel', $dataCha, hlien());

		if ($dataCha === false) {
			$_SESSION['message'][] = 'Le lien est invalide';
			header('Location: ' . hlien('chambre', 'index'));
		}

		$reserv = new Reservation();
		$data = $reserv->reservationsCha($_GET['id']);


		require $this->gabarit;
	}

	/**
	 * a_detail
	 *
	 * @return void
	 */
	function a_detail()
	{
		checkAllow(['admin', 'gestionnaire']);

		if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
			hlien();
			exit();
		}

		$ch = new Chambre();
		$data = $ch->select($_GET['id']);

		if (count($data) === 0) {
			hlien();
			exit();
		}
		gestionnaireCheckHotel('cha_hotel', $data, hlien());

		$res = new Reservation();
		$nbRes = $res->countRes($_GET['id']);
		require $this->gabarit;
	}
}

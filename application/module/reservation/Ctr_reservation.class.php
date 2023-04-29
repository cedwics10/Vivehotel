<?php

/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
 */
class Ctr_reservation extends Ctr_controleur implements I_crud
{

	public function __construct($action)
	{
		parent::__construct("reservation", $action);
		$a = "a_$action";
		$this->$a();
	}

	/**
	 * a_index
	 *
	 * @return void Page d'index de la liste des réservations d'un hôtel
	 */
	function a_index()
	{
		checkallow('admin');
		$u = new Reservation();
		$data = $u->selectAll();
		require $this->gabarit;
	}

	/**
	 * a_hotel
	 *
	 * @return void Liste les réservation d'un hôtel spécifique
	 */
	function a_hotel()
	{
		checkallow('admin');
		if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
			$_SESSION['message'][]  = "Numéro d'hôtel invalide";
			header('Location: ' . hlien('chambre'));
			exit();
		}

		$h = new Hotel();
		$hotData = $h->select($_GET['id']);
		extract($hotData);

		$u = new Reservation();
		$data = $u->resHotel($_GET['id']);
		require $this->gabarit;
	}



	/**
	 * a_edit
	 *
	 * @return void Page d'édition d'une réservation, en fonction de son identifiant
	 */
	function a_edit()
	{
		checkallow('admin');
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u = new Reservation();
		$res_commandes = [];
		if ($id > 0) {
			$row = $u->select($id);
		} else {
			$row = $u->emptyRecord();
			$res_commandes = [];
		}

		extract($row);
		require $this->gabarit;
	}

	/**
	 * a_save
	 *
	 * @return void Page de sauvegarde d'un enregistreemnt "Réservation"
	 */
	function a_save()
	{
		checkallow('admin');
		if (!isset($_POST["btSubmit"])) exit();

		$u = new Reservation();
		$aDoublons = $u->aDoublons($_POST);

		if ($aDoublons and $_POST['res_etat'] == '') {
			$_SESSION["message"][] = "La chambre n'est pas libre entre ces deux dates : "
				. "la réservation n'a pas été modifiée";
			header("location:" . hlien("reservation", "edit", "id", $_POST['res_id']));
			exit();
		}

		if (strtotime($_POST['res_date_debut']) > strtotime($_POST['res_date_fin'])) {
			$_SESSION["message"][] = "La réservation se serait terminé avant de commencer : pas de mise à jour";
			header("location:" . hlien("reservation", "edit", "id", $_POST['res_id']));
			exit();
		}

		$_POST['res_date_maj'] = $_POST['res_date_creation'] ?? date('Y-m-d', time());

		if ($_POST["res_id"] == 0) {
			$_SESSION["message"][] = "Le nouvel enregistrement Reservation a bien été créé.";
			$_POST['res_date_creation'] = date('Y-m-d', time());
		} else {
			$_SESSION["message"][] = "L'enregistrement Reservation a bien été mise à jour.";
		}
		$u->save($_POST);
		header("location:" . hlien("reservation", "edit", "id", $_POST['res_id']));
	}

	/**
	 * a_delete
	 *
	 * @return void Page de suppression d'une réservation, en fonction de son identifiant
	 */
	function a_delete()
	{
		checkallow('admin');
		if (isset($_GET["id"])) {
			$u = new Reservation();
			$u->delete($_GET["id"]);
			$_SESSION["message"][] = "L'enregistrement Reservation a bien été supprimé.";
		}
		header("location:" . hlien("reservation"));
	}

	/**
	 * a_client
	 *
	 * @return void Page listant les réservations d'un client
	 */
	function a_client()
	{
		checkallow('admin');
		if (!isset($_GET["id"]))
			header('Location: ' . hlien('client'));

		$u = new Reservation();
		$data = $u->reservationsClient($_GET["id"]);

		$cli = new Client();
		$client = $cli->select($_GET['id']);

		require $this->gabarit;
	}

	/**
	 * a_save_res
	 *
	 * @return void Nouvelle page de sauvegarde de réservation : à modifier
	 */
	function a_save_res()
	{
		checkallow('admin');
		if (!isset($_GET["id"]))
			header('Location: ' . hlien('client'));
	}

	/**
	 * a_services
	 *
	 * @return void Liste les services d'une réservaition
	 */
	function a_services()
	{
		checkallow('admin');
		$reservation = new Reservation();

		$data = $reservation->reservationServices($_GET['id']);


		require $this->gabarit;
	}

	/**
	 * a_services_edit
	 *
	 * @return void Editer des attributs d'un service d'une réservation (prix)
	 */
	function a_services_edit()
	{
		checkallow('admin');

		$reservation = new Reservation();

		$res = $reservation->select($_GET['id']);
		$noHotel = $res['res_hotel'];

		$reservation->save($_POST);
		header('Location: ' . hlien('reservation', 'services', 'id', $_GET['id']));
		require $this->gabarit;
	}

	/**
	 * a_services_save
	 *
	 * @return void Sauvegarder un nouveau service pour une réservation
	 */
	function a_services_save()
	{
		checkallow('admin');
		$reservation = new Reservation();

		$commander = new Commander();
		$commander->save($_POST);

		$_SESSION["message"][] =  'Le nouveau service a été commandé pour la réservation.';
		header('Location: ' . hlien('reservation', 'services', 'id', $_POST['com_reservation']));
		exit();
	}

	/**
	 * a_services_delete
	 *
	 * @return void Page de suppresion d'un enregistrement d'un service d'un hôtel
	 */
	function a_services_delete()
	{
		checkallow('admin');

		if (isset($_GET["id"])) {

			$u = new Commander();
			$com = $u->select($_GET['id']);
			$idReservation = $com['com_reservation'];

			$u->delete($_GET["id"]);
			$_SESSION["message"][] = "L'enregistrement Commander a bien été supprimé.";
			header("Location: " . hlien("reservation", "services", "id", $idReservation));
			exit();
		}
		header("location: " . hlien("reservation"));
	}

	function a_ajax_chotel()
	{
		checkAllow('admin');

		$cha = new Chambre();
		$listeChambresHotel = $cha->chaHotel($_GET['hotel']);

		debug($listeChambresHotel);
	}
}

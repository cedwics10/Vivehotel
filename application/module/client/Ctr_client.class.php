<?php

/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
 */
class Ctr_client extends Ctr_controleur implements I_crud
{

	/**
	 * __construct
	 *
	 * @param string $action nom de l'action appelé dans le constructeur
	 * @return void Lance la méthode a_{$action}
	 */
	public function __construct($action)
	{
		parent::__construct("client", $action);
		$a = "a_$action";
		$this->$a();
	}

	/**
	 * a_index
	 *
	 * @return void lance la page d'index de la liste des clients
	 */
	function a_index()
	{
		checkAllow('admin');
		$u = new Client();
		$data = $u->selectAll();
		require $this->gabarit;
	}

	/**
	 * a_index
	 *
	 * @return void lance la page d'édition d'un client ayant pour identifiant $_GET['id']
	 */
	function a_edit()
	{
		checkAllow('admin');
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u = new Client();
		if ($id > 0)
			$row = $u->select($id);
		else
			$row = $u->emptyRecord();

		extract($row);
		require $this->gabarit;
	}


	/**
	 * a_save
	 *
	 * @return void Lance la page de sauvegarde d'un client
	 */
	function a_save()
	{
		checkAllow('admin');
		if (isset($_POST["btSubmit"])) {
			$u = new Client();
			$u->save($_POST);
			if ($_POST["cli_id"] == 0)
				$_SESSION["message"][] = "Le nouvel enregistrement Client a bien été créé.";
			else
				$_SESSION["message"][] = "L'enregistrement Client a bien été mis à jour.";
		}
		header("location:" . hlien("client"));
	}



	/**
	 * a_delete
	 *
	 * @return void Suppression d'un enregistrement de la table client ayant le paramètre $_GET['id']
	 */
	function a_delete()
	{
		checkAllow('admin');
		if (isset($_GET["id"])) {
			$u = new Client();
			$u->delete($_GET["id"]);
			$_SESSION["message"][] = "L'enregistrement Client a bien été supprimé.";
		}
		header("location:" . hlien("client"));
	}

	/**
	 * a_creer_res
	 *
	 * @return void
	 */
	function a_creer_res()
	{
	}

	/**
	 * a_reservations
	 *
	 * @return void
	 */
	function a_reservations()
	{
		checkallow(['client']);

		$u = new Reservation();

		$row = $u->emptyRecord();
		$res_commandes = [];

		extract($row);


		require $this->gabarit;
	}

	/**
	 * a_res_annuler
	 *
	 * @return void
	 */
	function a_res_annuler()
	{
	}
}

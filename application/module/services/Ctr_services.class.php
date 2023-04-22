<?php

/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
 */
class Ctr_services extends Ctr_controleur implements I_crud
{

	public function __construct($action)
	{
		parent::__construct("services", $action);
		$a = "a_$action";
		$this->$a();
	}

	/**
	 * a_index
	 *
	 * @return void Page listant tous les services pouvant être proposés par les hôtels
	 */
	function a_index()
	{
		$u = new Services();
		$data = $u->selectAll();
		require $this->gabarit;
	}


	/**
	 * a_edit
	 *
	 * @return void Page d'édition la propriétés d'un service (nom)
	 */
	function a_edit()
	{
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u = new Services();
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
	 * @return void Page de sauvegarde ou modification d'un service, directement en BDD
	 */
	function a_save()
	{
		if (isset($_POST["btSubmit"])) {
			$u = new Services();
			$u->save($_POST);
			if ($_POST["ser_id"] == 0)
				$_SESSION["message"][] = "Le nouvel enregistrement Services a bien été créé.";
			else
				$_SESSION["message"][] = "L'enregistrement Services a bien été mis à jour.";
		}
		header("location:" . hlien("services"));
	}



	/**
	 * a_delete
	 *
	 * @return void Page de suppression d'un service
	 */
	function a_delete()
	{
		if (isset($_GET["id"])) {
			$u = new Services();
			$u->delete($_GET["id"]);
			$_SESSION["message"][] = "L'enregistrement Services a bien été supprimé.";
		}
		header("location:" . hlien("services"));
	}
}

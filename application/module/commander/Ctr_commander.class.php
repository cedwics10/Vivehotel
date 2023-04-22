<?php

/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
 */
class Ctr_commander extends Ctr_controleur implements I_crud
{
	/**
	 * __construct
	 *
	 * @param string $action nom de l'action appelé dans le constructeur
	 * @return void Lance l'action a_$action en tant que page web
	 */
	public function __construct($action)
	{
		parent::__construct("commander", $action);
		$a = "a_$action";
		$this->$a();
	}


	/**
	 * a_index
	 *
	 * @return void Page de la liste de chaque membre du personnel
	 */
	function a_index()
	{
		$u = new Commander();
		$data = $u->selectAll();
		require $this->gabarit;
	}


	/**
	 * a_edit
	 *
	 * @return void Page d'édition des membres du eprsonnel
	 */
	function a_edit()
	{
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u = new Commander();
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
	 * @return void Page de savuegarde d'un enregistrement ou édition d'un membre
	 * du personnel dans la base de données
	 */
	function a_save()
	{
		if (isset($_POST["btSubmit"])) {
			$u = new Commander();
			$u->save($_POST);
			if ($_POST["com_id"] == 0)
				$_SESSION["message"][] = "Le nouvel enregistrement Commander a bien été créé.";
			else
				$_SESSION["message"][] = "L'enregistrement Commander a bien été mis à jour.";
		}
		header("location:" . hlien("commander"));
	}



	/**
	 * a_delete
	 *
	 * @return void Page de suppression d'un membre du personnel
	 */
	function a_delete()
	{
		if (isset($_GET["id"])) {
			$u = new Commander();
			$u->delete($_GET["id"]);
			$_SESSION["message"][] = "L'enregistrement Commander a bien été supprimé.";
		}
		header("location:" . hlien("commander"));
	}
}

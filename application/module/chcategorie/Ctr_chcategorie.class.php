<?php

/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
 */
class Ctr_chcategorie extends Ctr_controleur implements I_crud
{

	/**
	 * __construct
	 *
	 * @param string $action nom de l'action appelé dans le constructeur
	 * @return void Lance l'action a_$action en tant que page web
	 */
	public function __construct($action)
	{
		parent::__construct("chcategorie", $action);
		$a = "a_$action";
		$this->$a();
	}


	/**
	 * a_index
	 *
	 * @return void
	 */
	function a_index()
	{
		$u = new Chcategorie();
		$data = $u->selectAll();
		require $this->gabarit;
	}


	/**
	 * a_edit
	 *
	 * @return void Page d'édition d'une catégorie de chambre
	 */
	function a_edit()
	{
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u = new Chcategorie();
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
	 * @return void Page de savuegarde d'une catégorie de chambre en base de donnéees
	 */
	function a_save()
	{
		if (isset($_POST["btSubmit"])) {
			$u = new Chcategorie();
			$u->save($_POST);
			if ($_POST["chc_id"] == 0)
				$_SESSION["message"][] = "Le nouvel enregistrement Chcategorie a bien été créé.";
			else
				$_SESSION["message"][] = "L'enregistrement Chcategorie a bien été mis à jour.";
		}
		header("location:" . hlien("chcategorie"));
	}



	/**
	 * a_delete
	 *
	 * @return void Page de suppression d'une catégorie de chambre en base de donnéees
	 */
	function a_delete()
	{
		if (isset($_GET["id"])) {
			$u = new Chcategorie();
			$u->delete($_GET["id"]);
			$_SESSION["message"][] = "L'enregistrement Chcategorie a bien été supprimé.";
		}
		header("location:" . hlien("chcategorie"));
	}
}

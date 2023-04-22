<?php

/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
 */
class Ctr_personnel extends Ctr_controleur implements I_crud
{

	/**
	 * __construct
	 *
	 * @param  mixed $action
	 * @return void 
	 */
	public function __construct($action)
	{
		parent::__construct("personnel", $action);
		$a = "a_$action";
		$this->$a();
	}

	/**
	 * a_index
	 *
	 * @return void Liste de tous les enregistrements des membres du personnel 
	 */
	function a_index()
	{
		checkallow('admin');
		$u = new Personnel();
		$data = $u->selectAll();
		require $this->gabarit;
	}


	/**
	 * a_edit
	 *
	 * @return void Page d'édition d'un membre du personnel
	 */
	function a_edit()
	{
		checkallow('admin');
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u = new Personnel();
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
	 * @return void Page de sauvegarde d'un membre du personnel
	 */
	function a_save()
	{
		checkallow('admin');
		if (isset($_POST["btSubmit"])) {
			$_POST["per_mdp"] = password_hash($_POST["per_mdp"], PASSWORD_DEFAULT);
			$u = new Personnel();
			$u->save($_POST);
			if ($_POST["per_id"] == 0)
				$_SESSION["message"][] = "Le nouvel enregistrement Personnel a bien été créé.";
			else
				$_SESSION["message"][] = "L'enregistrement Personnel a bien été mis à jour.";
		}

		header("location:" . hlien("personnel"));
	}

	/**
	 * a_delete
	 *
	 * @return void Page de suppression d'un membre du personnel
	 */
	function a_delete()
	{
		checkallow('admin');

		if (isset($_GET["id"])) {
			$u = new Personnel();
			$u->delete($_GET["id"]);
			$_SESSION["message"][] = "L'enregistrement Personnel a bien été supprimé.";
		}

		header("location:" . hlien("personnel"));
	}
}

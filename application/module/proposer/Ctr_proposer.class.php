<?php

/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
 */
class Ctr_proposer extends Ctr_controleur implements I_crud
{

	public function __construct($action)
	{
		parent::__construct("proposer", $action);
		$a = "a_$action";
		$this->$a();
	}

	/**
	 * a_index
	 *
	 * @return void Page d'index de la liste des porpositions (page à bloquer)
	 */
	function a_index()
	{
		$u = new Proposer();
		$data = $u->selectAll();
		require $this->gabarit;
	}


	/**
	 * a_edit
	 *
	 * @return void Page d'édition d'un service proposé dans un hôtel (à supprimer)
	 */
	function a_edit()
	{
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u = new Proposer();
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
	 * @return void Action de la page de savuegarde d'un service dans un hôtel (à supprimer)
	 */
	function a_save()
	{
		if (isset($_POST["btSubmit"])) {
			$u = new Proposer();
			$u->save($_POST);
			if ($_POST["pro_id"] == 0)
				$_SESSION["message"][] = "Le nouvel enregistrement Proposer a bien été créé.";
			else
				$_SESSION["message"][] = "L'enregistrement Proposer a bien été mis à jour.";
		}
		header("location:" . hlien("proposer"));
	}



	/**
	 * a_delete
	 *
	 * @return void Action de la page de suppression d'une proposition de service dans un
	 * hôtel
	 */
	function a_delete()
	{
		if (isset($_GET["id"])) {
			$u = new Proposer();
			$data = $u->select($_GET['id']);
			$u->delete($_GET["id"]);
			$_SESSION["message"][] = "L'enregistrement Proposer a bien été supprimé.";
		}
		header("location:" . hlien("hotel", "services", 'id', $data['pro_hotel']));
	}
}

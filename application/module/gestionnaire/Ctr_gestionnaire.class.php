<?php

/**
 * Ctr_gestionnaire
 * Permet de gérer les pages d'un membre du personnel de type gestionnaire
 * N'implémente pas d'intreface I_CRUD
 */
class Ctr_gestionnaire extends Ctr_controleur
{

	public function __construct($action)
	{
		parent::__construct("gestionnaire", $action);
		$a = "a_$action";
		$this->$a();
	}

	public function 
}

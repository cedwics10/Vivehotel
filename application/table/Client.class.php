<?php

/**
Classe créé par le générateur.
 */
class Client extends Table
{
	/**
	 * @return void Instancie un objet constructeur à partir du constructeur parent
	 */
	public function __construct()
	{
		parent::__construct("client", "cli_id");
	}

	/**
	 * @param int $id : identifiant de la catégorie de chambre à sélectionner par défaut
	 * @return string : texte HTML d'une liste déroulante de catégories de chambres
	 */
	static public function OPTIONclients(int $idClient)
	{
		return self::HTMLoptions('SELECT cli_id, cli_nom FROM client', 'cli_id', 'cli_nom', $idClient);
	}
}

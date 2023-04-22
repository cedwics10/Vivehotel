<?php

/**
Classe créé par le générateur.
 */
class Utilisateur extends Table
{
	public function __construct()
	{
		parent::__construct("client", "cli_id");
	}

	static public function estEmailUnique(string $cli_email): bool
	{
		$sql = "select * from client where cli_email=:mail";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":mail", $cli_email);
		$statement->execute();
		if ($statement->rowCount() > 0)
			return false;
		else
			return true;
	}

	static public function selectByEmail(string $cli_email)
	{
		$sql = "SELECT cli_nom, cli_identifiant, cli_email, cli_mdp  FROM client WHERE cli_email=:mail";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":mail", $cli_email);
		$statement->execute();
		return $statement->fetch();
	}










}

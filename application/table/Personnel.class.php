<?php

/**
Classe créé par le générateur.
 */
class Personnel extends Table
{
	const ROLE = [
		'gestionnaire',
		'teleconseiller',
		'personnel'
	];
	public function __construct()
	{
		parent::__construct("personnel", "per_id");
	}

	/**
	 * @param string $per_email : Adresse email au format classique
	 * @return void : Indique si il existe déjà un utilisateur ayant pour mail $per_email
	 */
	static public function estEmailUnique(string $per_email): bool
	{
		$sql = "select * from personnel where per_email=:mail";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":mail", $per_email);
		$statement->execute();
		if ($statement->rowCount() > 0)
			return false;
		else
			return true;
	}

	/**
	 * @param string $per_email : Adresse email au format classique
	 * @return array : Sélectionne le membre du personnel ayant l'adresse mail $per_email 
	 * si existe sinon ne retourne un tableau vide
	 */
	static public function selectByEmail(string $per_email)
	{
		$sql = "SELECT per_id, per_nom, per_identifiant, 
		per_email, per_mdp, per_role
		FROM personnel
		WHERE per_email=:mail";
		// per_hotel=hot_id 
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":mail", $per_email);
		$statement->execute();
		return $statement->fetch();
	}

	/**
	 * @param int $id : Clé primaire d'un erngistrement de la table hôtel
	 * @return array : Retourne l'enregistrement d'un hôtel correspondant à $id 
	 * ou alors retourne un tableau vide
	 */
	static public function selectHotel(int $id)
	{
		$sql = "SELECT hot_id FROM hotel, personnel
		WHERE per_hotel = hot_id
		AND per_id = :id";

		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id", $id);
		$statement->execute();
		$res = $statement->fetch();
		return is_array($res) ? $res['hot_id'] : [];
	}
}

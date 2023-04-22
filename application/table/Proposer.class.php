<?php

/**
Classe créé par le générateur.
 */
class Proposer extends Table
{
	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct("proposer", "pro_id");
	}


	/**
	 * selectHotService
	 *
	 * @param  int $hotel clé primaire de l'hôtel
	 * @param  int $service clé étrangère d'un hôtel
	 * @return array retourne tous les entrées des hôtels ayant un service
	 */
	static public function selectHotService(int $hotel, int $service): array
	{
		$sql = "SELECT hot_nom, ser_nom FROM proposer, services, hotel 
		WHERE pro_services = :services 
		AND pro_services = ser_id
		AND pro_hotel = hot_id
		AND pro_hotel = :hotel";
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(":hotel", $hotel, PDO::PARAM_INT);
		$stmt->bindValue(":services", $service, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	/**
	 * select
	 *
	 * @param int  $id clé primaire d'un enregistrement de la table "proposer"
	 * @return array enregistreemnt correspond à la clé $id ou alors tabmeau vide
	 */
	function select(int $id)
	{
		$sql = "SELECT pro_id, pro_hotel, 
		pro_prix, pro_services, hot_id, ser_nom, hot_nom
		FROM proposer, hotel, services
		WHERE pro_id=:id
		AND hot_id = pro_hotel
		AND ser_id = pro_services
		";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id", $id, PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetch();
	}
}

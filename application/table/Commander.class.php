<?php

/**
Classe créé par le générateur.
 */
class Commander extends Table
{
	/**
	 * @return void Instancie un objet contrôleur à partir du contrôleur parent
	 */
	public function __construct()
	{
		parent::__construct("commander", "com_id");
	}

	/**
	 * @param int $reservation : Numéro de réservation sur laquelle nous souhations récupérer des services
	 * @param int $proposer : Numéro de la liste des commandes des services de la réservation
	 * @return array Liste de tous les proposer d'une résevation
	 */
	static public function selectResServices(int $reservation, int $proposer): array
	{
		$sql = "SELECT res_nom, ser_nom 
		FROM commander, proposer, reservation
		WHERE com_services = :proposer
		AND com_services = ser_id
		AND com_reservation = res_id
		AND com_reservation = :reservation";

		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(":reservation", $reservation, PDO::PARAM_INT);
		$stmt->bindValue(":proposer", $proposer, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}

<?php

/**
Classe créé par le générateur.
 */
class Services extends Table
{
	public function __construct()
	{
		parent::__construct("services", "ser_id");
	}

	public function selectAll(): array
	{
		$sql = 'SELECT ser_id, ser_nom, COUNT(hot_id) `nb_hotel`
		FROM services, proposer, hotel
		WHERE ser_id = pro_services
		AND hot_id = pro_hotel
		GROUP BY ser_id';
		$stmt = Table::$link->query($sql);
		return $stmt->fetchAll();
	}

	static public function Res(int $idRes): array
	{
		/* 
		* Nous cherchons l'ensemble des services d'une réservation
		*/
		$sql = 'SELECT com_services, com_quantite, ser_nom, pro_prix
		FROM commander, services, reservation, proposer
		WHERE  com_services = ser_id
		AND com_reservation = :reservation
		AND com_reservation = res_id
		AND res_hotel = pro_hotel
		AND pro_services = ser_id';

		$stmt = Table::$link->prepare($sql);
		$stmt->bindValue(':reservation', $idRes, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	static public function pasRes(int $idRss, int $resHotel)
	{
		$sql = 'SELECT ser_id,ser_nom, pro_prix FROM proposer, services
		WHERE 
		ser_id = pro_services
		AND pro_hotel = :hotel
		AND pro_id NOT IN(SELECT com_services 
		FROM commander WHERE com_reservation = :reservation)';

		$stmt = self::$link->prepare($sql);

		$stmt->bindValue(':reservation', $idRss, PDO::PARAM_INT);
		$stmt->bindValue(':hotel', $resHotel, PDO::PARAM_INT);

		$stmt->execute();
		$resultat = $stmt->fetchAll();

		$s = "";
		foreach ($resultat as $tab) {
			$s = $s . "<option value='{$tab['ser_id']}'>{$tab['ser_nom']}</option>";
		}
		return $s;
	}

	static public function OPTIONServices(string $selected)
	{
		return Table::HTMLoptions("SELECT * FROM services", "ser_id", "ser_nom", $selected);
	}


	static public function optionNotHotel(int $hot_id)
	{
		$sql = "SELECT ser_id, ser_nom 
		FROM services 
		WHERE ser_id NOT IN (SELECT pro_id
		FROM proposer
		WHERE pro_hotel = $hot_id)";

		return Table::HTMLoptions($sql, 'ser_id', 'ser_nom', '');
	}

	static public function optionNotServices($res_id)
	{
		$sql = "SELECT ser_id, ser_nom 
		FROM services
		WHERE ser_id NOT IN (SELECT com_id
		FROM commander
		WHERE com_reservation = $res_id)";

		return Table::HTMLoptions($sql, "ser_id", "ser_nom", "");
	}
}

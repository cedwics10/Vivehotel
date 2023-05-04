<?php

/**
Classe créé par le générateur.
 */

class Hotel extends Table
{
	const STATUT = ['Actif', 'Supprimé', 'En travaux'];

	public function __construct()
	{
		parent::__construct("hotel", "hot_id");
	}


	/**
	 * @return array Retourne un enregistrement vide de la table hôtel
	 */
	function emptyRecord(): array
	{
		$fields = $this->getFields();
		$row = [];
		foreach ($fields as $name)
			$row[$name] = "";
		$row[$this->pk] = 0;
		return $row;
	}

	/**
	 * @param int $id : Clé primaire d'un enregistrement à sélectionner
	 * @return array Retourne un enregistrement d'hôtel avec les clés étrangères
	 */
	public function select(int $id): array
	{
		$sql = "SELECT * FROM hotel, hocategorie 
		WHERE hot_hocategorie = hoc_id
		AND hot_id = :id";
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

	/**
	 * @return array Retourne l'ensemble des enregistrements d'un hôtel
	 */
	public function selectAll(): array
	{
		$sql = "SELECT * FROM hotel, hocategorie 
		WHERE hot_hocategorie = hoc_id
		ORDER BY hot_id";
		$result = self::$link->query($sql);
		return $result->fetchAll();
	}

	/**
	 * @return array Retourne la nombre d'enregistrements 
	 */
	public function countAll(): int
	{
		$listeHotel = $this->selectAll();
		return count($listeHotel);
	}

	/**
	 * @return array Retourne les hôtels actifs
	 */
	public function selectActifs(): array
	{
		$sql = "SELECT * FROM hotel, hocategorie 
		WHERE hot_hocategorie = hoc_id
		AND hot_statut = 'Actif'
		ORDER BY hot_id";
		$result = self::$link->query($sql);
		return $result->fetchAll();
	}

	/**
	 * @param int $id : clé primaire d'un enregistrement d'un service
	 * @return array Retourne un enregistreemnt du service ayant la clé primaire $id
	 */
	public function selectAllservices($id): array
	{
		$sql = "SELECT ser_id, ser_nom, 
		pro_prix, pro_hotel, pro_id
		FROM proposer, services
		WHERE pro_services=ser_id 
		AND pro_hotel=:id";
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	/**
	 * @return int Retourne le chiffre d'affaires hors services de la compagnie Vivehotel
	 */
	public function chiffreAffTot()
	{
		$sql = 'SELECT SUM(tar_prix* res_duree) `c_affaire` FROM
		(SELECT hot_id, tar_prix, DATEDIFF(res_date_fin, res_date_debut) `res_duree`
		FROM chambre, reservation, tarifer, hotel
		WHERE res_chambre = cha_id
		AND res_hotel = hot_id 
		AND tar_chcategorie = cha_chcategorie 
		AND tar_hocategorie = hot_hocategorie
		AND res_etat != "Annulé"
		)  reservations';
		$stmt = self::$link->query($sql);
		return $stmt->fetch()['c_affaire'];
	}

	/**
	 * @param int $id : clé primaire d'un enregistrement de la table hôtel
	 * @return int Retourne le chiffre d'affaires hors services d'un hôtel de la compagnie Vivehotel
	 */
	public function chiffreAffaire(int $id): int
	{
		$sql = 'SELECT SUM(tar_prix*res_duree) `c_affaire` FROM
		(SELECT hot_id, tar_prix, DATEDIFF(res_date_fin, res_date_debut) `res_duree`
		FROM chambre, reservation, tarifer, hotel
		WHERE res_chambre = cha_id
		AND res_hotel = hot_id 
		AND tar_chcategorie = cha_chcategorie 
		AND tar_hocategorie = hot_hocategorie
		AND hot_id = :id) reservations
		GROUP BY hot_id';
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchColumn();
	}


	/**
	 * @param int $id : clé primaire d'un enregistrement de la table hôtel
	 * @return int Retourne le chiffre d'affaires des services d'un hôtel de la compagnie Vivehotel
	 */
	public function CAservices(int $hot_id): int
	{
		$sql = 'SELECT SUM(pro_prix*com_quantite) `ca_service`
		FROM commander, services, proposer
		WHERE com_services = ser_id 
		AND ser_id = pro_services
		AND pro_hotel = :id
		GROUP BY pro_hotel
		ORDER BY ca_service DESC';
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':id', $hot_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchColumn();
	}

	/**
	 * @param int $id : clé primaire d'un enregistrement de la table "Hôtel"
	 * @return array Retourne l'ensemble des chambres actives de l'hôtel $id
	 */
	public function ChambreActives(int $id): int
	{
		$sql = "SELECT COUNT(DISTINCT(cha_id)) `nb_chambres`
		FROM hotel, reservation, chambre
		WHERE res_hotel = hot_id
		AND res_chambre = cha_id
		AND res_etat = 'Validé'
		AND hot_id = :id
		GROUP BY hot_id
		ORDER BY nb_chambres";

		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchColumn();
	}


	/**
	 * @param int $id : clé primaire d'un enregistrement de la table "Hôtel"
	 * @return array Retourne l'ensemble des chambres actives de l'hôtel $id
	 */
	public function ChambreLibres(int $id): int
	{
		$sql = "SELECT COUNT(DISTINCT(cha_id)) 'nb_chambreLibres'
		FROM hotel, reservation, chambre
		WHERE res_hotel = hot_id
		AND res_chambre = cha_id
		AND res_date_debut > '2021-01-01'
		AND res_date_fin < '2021-03-01'
		AND res_etat = 'En attente'
		AND hot_id = :id
		GROUP BY hot_id";
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchColumn();
	}

	/**
	 * @param string $select : clé étrangère d'un enregistrement de la table "Hôtel"
	 * @return bool : indique si le numéro de chambre n'a pas été déjà pris dans l'hôtel 
	 */
	static public function NumeroIndisponible(string $cha_numero, int $cha_hotel, int $not_cha_id)
	{
		$sql = 'SELECT cha_id FROM chambre
		WHERE cha_numero = :cha_numero
		AND cha_hotel = :id_hotel
		AND cha_id != :notchaid
		';

		$stmt = Table::$link->prepare($sql);
		$stmt->bindValue(':cha_numero', $cha_numero, PDO::PARAM_STR);
		$stmt->bindValue(':id_hotel', $cha_hotel, PDO::PARAM_INT);
		$stmt->bindValue(':notchaid', $not_cha_id, PDO::PARAM_INT);

		$stmt->execute();
		$res = $stmt->fetchAll();
		return (count($res) > 0) ? true : false;
	}


	/**
	 * @param string $select : clé étrangère d'un enregistrement de la table "Hôtel"
	 * @return string $HTML : retourne la liste deéroulante de l'ensemble des hôtels
	 */
	static public function OPTIONhotel(string $selected)
	{
		return Table::HTMLoptions('SELECT * FROM hotel', 'hot_id', 'hot_nom', $selected);
	}

	/**
	 * @param int $id : clé primaire d'un enregistrement de la table hôtel
	 * @return void : Supprime de manière logique l'enregistrement de la table hôtel ayant la clé $id 
	 */
	public function delete($id)
	{
		$sql = 'UPDATE hotel 
		SET hot_statut = "Annulé" 
		WHERE hot_id=:id';
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id", $id, PDO::PARAM_INT);
		$statement->execute();
	}
}

<?php

/**
Classe créé par le générateur.
 */
class Reservation extends Table
{
	const RES_ETAT = [
		'Annnulé',
		'Initialisé',
		'Validé',
		'En attente'
	];

	const LISTE_OPTIONS = [
		'Hôtel' => 'hot_nom',
		'Client' => 'res_client',
		'Etat' => 'res_etat',
	];


	/**
	 * __construct
	 *
	 * @return void construit un modèle de la 
	 * table réservation qui a pour clé primaire "res_id"
	 */
	public function __construct()
	{
		parent::__construct("reservation", "res_id");
	}

	/**
	 * retourne un tableau contenant le nom des champs de la table
	 *
	 * @return array
	 */
	function getFields(): array
	{
		$fields = [];
		$sql = "SELECT column_name 
		FROM `information_schema`.`columns` 
		WHERE `table_schema` = 'vivehotel' and `table_name` in ('hotel', 'chcategorie', 'chambre', 'reservation')";
		$result = self::$link->query($sql);
		foreach ($result as $row)
			$fields[] = $row["column_name"];

		return $fields;
	}


	/**
	 * selectAll
	 *
	 * @return array retourne l'ensemble des enregistrements de la table réservation 
	 * avec des informations supplémentaires
	 */
	public function selectAll(): array
	{
		$sql = 'SELECT res_id, res_date_creation, res_date_debut,
		res_date_fin, res_etat,
		cli_nom, 
		hot_nom, 
		cha_numero
		FROM reservation, client, chambre, hotel
		WHERE res_client = cli_id
		AND res_chambre = cha_id
		AND cha_hotel = hot_id
		ORDER BY res_date_creation DESC
		' . $this->sqlPages();

		$result = self::$link->query($sql);

		return $result->fetchAll();
	}


	/**
	 * select
	 *
	 * @param  mixed $id Clé primaire d'une réservation
	 * @return array retourne l'enregistrement de la table réservation ayant la clé primaire $id
	 */
	public function select(int $id): array
	{
		$sql = 'SELECT * FROM reservation, client, hotel
		WHERE cli_id = res_client
		AND hot_id = res_hotel
		AND res_id = :id';
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		$data = $stmt->fetch();
		return (is_array($data)) ? $data : [];
	}

	/**
	 * reservationsCha
	 *
	 * @param  mixed $idChambre clé primaire de l'enregistremnt d'une chambre en base de données
	 * @return array Récupère tous les enregistrements de réservations de la chambre $idChambre
	 */
	public function reservationsCha(int $idChambre): array
	{
		$sql = 'SELECT res_id, res_date_creation, res_date_debut,
		res_date_maj, res_date_fin, res_etat,
		cli_nom, hot_nom, cha_numero
		FROM hotel, reservation, chambre, client 
		WHERE res_hotel = hot_id
		AND res_chambre = :chambre
		AND res_client = cli_id
		AND res_chambre = cha_id
		ORDER BY res_date_debut DESC';
		// ordonner par date de création de la réservation
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':chambre', $idChambre, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	/**
	 * reservationsClient
	 *
	 * @param int $idChambre clé primaire de l'enregistremnt d'une chambre en base de données
	 * @return array Récupère tous les enregistrements de réservations ddu client $cli_id
	 */
	public function reservationsClient(int $cli_id): array
	{
		$sql = "SELECT * 
		FROM reservation, client, hotel, chambre
		WHERE res_hotel = hot_id
		AND res_chambre = cha_id
		AND res_client = :client
		AND res_client = cli_id
		ORDER BY res_id
		LIMIT 0,100";
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':client', $cli_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}



	/**
	 * resHotel
	 *
	 * @param  int $hot_id Clé primaire d'un enregistrement de la table "hôtel"
	 * @return array Ensemble des enregistrements de réservations faites dans l'hôtel $hot_id
	 */
	public function resHotel(int $hot_id): array
	{
		$sql = "SELECT * 
		FROM reservation, client, hotel, chambre
		WHERE res_hotel = hot_id
		AND res_chambre = cha_id
		AND res_hotel = :hotel
		AND res_client = cli_id
		ORDER BY res_id
		LIMIT 0,100";
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':hotel', $hot_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}


	/**
	 * reservationServices
	 *
	 * @param  int $res_id Clé primaire d'un enregistrement de la table "réservation"
	 * @return array ensemble des enregistrements de services que la réservation a prises
	 */
	public function reservationServices(int $res_id): array
	{
		$sql = "SELECT ser_nom, com_id, com_quantite, com_reservation
		FROM services, commander
		WHERE com_services = ser_id
		AND com_reservation = :id";

		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':id', $res_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	/**
	 * reservationServices
	 *
	 * @param  int $res_id Clé primaire d'un enregistrement de la table "réservation"
	 * @return array ensemble des enregistrements de services que la réservation a prises
	 */
	public function countDoubleSer(int $resId, int $comService): array
	{
		$sql = 'SELECT COUNT(com_id) `nbServices`
		FROM commander
		WHERE com_services = ser_id
		AND com_reservation = :idres
		AND com_service = :comser';

		$stmt = self::$link->prepare($sql);

		$stmt->bindValue(':idres', $resId, PDO::PARAM_INT);
		$stmt->bindValue(':comser', $comService, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetchAll();
	}

	/**
	 * aDoublons
	 *
	 * @param  array $data Tableau associatif qui est l'entrée d'une réservation
	 * @return array Retourne l'ensemble dess réservations qui sont incompatibles avec $data en dates, hôtel 
	 */
	public function aDoublons(array $data)
	{

		// Récupère l'ensemble des id doublons de notre réservation
		// Cherche toutes les réservations qui se superpose à la réservation en édition
		// dans le même hôtel, même chambre et stricteemnt différente de notre réservation
		$sql = "SELECT res_id, res_date_debut, res_date_fin
		FROM reservation
		WHERE ((:res_date_debut > res_date_debut OR :res_date_fin > res_date_debut)
		AND (:res_date_debut < res_date_fin OR :res_date_fin < res_date_fin) )
		AND res_hotel = :res_hotel
		AND res_chambre = :res_chambre
		AND res_id != :res_id
		";

		$stmt = Table::$link->prepare($sql);
		$stmt->bindValue(':res_id', $data['res_id'], PDO::PARAM_INT);

		$stmt->bindValue(':res_chambre', $data['res_chambre'], PDO::PARAM_STR);
		$stmt->bindValue(':res_hotel', $data['res_hotel'], PDO::PARAM_INT);

		$stmt->bindValue(':res_date_debut', $data['res_date_debut'], PDO::PARAM_STR);
		$stmt->bindValue(':res_date_fin', $data['res_date_fin'], PDO::PARAM_STR);

		$stmt->execute();
		$dataRes = $stmt->fetchAll();

		return count($dataRes) > 0 ? true : false;
	}


	/**
	 * countRes
	 *
	 * @param  int $cha_id Primary key of a room
	 * @return int Number of reservation of this room
	 */
	public function countRes(int $cha_iid)
	{
		$sql = 'SELECT COUNT(*) `nbRes` 
		FROM reservation 
		WHERE res_chambre = :cha_id
		AND (res_etat = "Validé")';
		$stmt = Table::$link->prepare($sql);
		$stmt->bindValue(':cha_id', $cha_iid, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchColumn();
	}

	public function chambresDisposDates(int $cha_hotel, string $date_debut, string $date_fin)
	{
		$sql = "SELECT COUNT(cha_id) `chambres_disponibles`
		FROM chambre
		WHERE cha_statut = 'Actif'
		AND cha_hotel = :hotel
		AND cha_id NOT IN (SELECT DISTINCT res_chambre
		FROM reservation
		WHERE res_date_debut >= :date_debut 
		AND res_date_fin <= :date_fin
		AND res_etat != 'Annulé') 
		";

		$stmt = Table::$link->prepare($sql);
		$stmt->bindValue(':hotel', $cha_hotel, PDO::PARAM_INT);

		$stmt->bindValue(':date_debut', $date_debut, PDO::PARAM_STR);
		$stmt->bindValue(':date_fin', $date_fin, PDO::PARAM_STR);

		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
}

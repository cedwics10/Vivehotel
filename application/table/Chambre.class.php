<?php

/**
Classe créé par le générateur.
 */
class Chambre extends Table
{
	const TYPE_LITS = [
		'2 Lits simples',
		'Lit double standard Queen Size',
		'Lit double Confort',
		'Lit double King Size',
		'1 lit double et un lit simple'
	];

	const CHA_STATUT = [
		'Annnulé',
		'Initialisé',
		'Validé',
		'En attente',
		'Supprimé'
	];

	const CRI_RECHERCHE = [
		'Type lits' => 'cha_typeLit',
		'Statut' => 'cha_statut',
		'Description' => 'cha_description',
	];

	const LISTE_OPTIONS = [
		'Jacuzzi' => 'cha_jacuzzi',
		'Balcon' => 'cha_balcon',
		'Wifi' => 'cha_wifi',
		'Mini-bar' => 'cha_minibar',
		'Coffre' => 'cha_coffre',
		'Vue' => 'cha_vue'
	];

	public function __construct()
	{
		parent::__construct("chambre", "cha_id");
	}

	public function selectAll(): array // récupères tous les enregistrements des chambres
	{
		$sql = "SELECT  cha_id, cha_numero, 
		cha_statut, cha_surface, cha_typeLit,  cha_description, cha_jacuzzi,
		cha_balcon, cha_wifi, cha_minibar, cha_coffre,
		cha_vue, chc_categorie, cha_hotel, hot_nom FROM chambre, chcategorie, hotel 
		WHERE cha_chcategorie = chc_id AND cha_hotel = hot_id
		ORDER BY cha_id";

		$result = self::$link->query($sql);
		return $result->fetchAll();
	}

	function select(int $id) // Sélectionne un enregistrement d'une chambre
	{
		$sql = 'SELECT * FROM chambre, hotel 
		WHERE cha_hotel = hot_id
		AND cha_id=:id';
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id", $id, PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetch();
	}

	// Sélectionne tous les enregistrement des chambres d'un hôtel
	function chaHotel(int $id)
	{
		$sql = "SELECT cha_id, cha_numero, 
		cha_statut, cha_surface, cha_typeLit,  cha_description, cha_jacuzzi,
		cha_balcon, cha_wifi, cha_minibar, cha_coffre,
		cha_vue, chc_categorie, cha_hotel 
		FROM chambre, chcategorie, hotel 
		WHERE cha_chcategorie = chc_id 
		AND cha_hotel = hot_id
		AND hot_id = :id
		ORDER BY cha_id";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id", $id, PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetchAll();
	}

	// Retourne des enregistrements de chambres en fonction d'un crtière de recherche
	public function chaRecherche(string $texte, string $champ)
	{
		$sql = "SELECT  cha_id, cha_numero, 
		cha_statut, cha_surface, cha_typeLit,  cha_description, cha_jacuzzi,
		cha_balcon, cha_wifi, cha_minibar, cha_coffre,
		cha_vue, chc_categorie, cha_hotel FROM chambre, chcategorie, hotel 
		WHERE cha_chcategorie = chc_id 
		AND cha_hotel = hot_id
		AND LOWER({$champ}) LIKE :recherche
		ORDER BY {$champ}";

		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(":recherche", '%' . $texte . '%', PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	// Liste déroulante de toutes les chambres de tous les hôtels
	static public function OPTIONChambre(int $idChambre)
	{
		return self::HTMLoptions('SELECT cha_id, cha_numero FROM chambre', 'cha_id', 'cha_numero', $idChambre);
	}

	// Permet de suppirmer un enregistrement ayant un identifiant spécifique
	public function delete($id)
	{
		$sql = 'UPDATE chambre 
		SET cha_statut = "Supprimé" 
		WHERE cha_id=:id';
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id", $id, PDO::PARAM_INT);
		$statement->execute();
	}
}

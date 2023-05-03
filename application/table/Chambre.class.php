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

	const CHA_STATUT = ['Actif', 'Supprimé', 'En travaux'];

	const CRI_RECHERCHE = [
		'Type lits' => 'cha_type_lit',
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
		cha_statut, cha_surface, cha_type_lit,  cha_description, cha_jacuzzi,
		cha_balcon, cha_wifi, cha_minibar, cha_coffre,
		cha_vue, chc_categorie, cha_hotel, hot_nom FROM chambre, chcategorie, hotel 
		WHERE cha_chcategorie = chc_id AND cha_hotel = hot_id
		ORDER BY cha_id";

		$result = self::$link->query($sql);
		return $result->fetchAll();
	}

	/**
	 * select
	 *
	 * @param  mixed $id
	 * @return void
	 */
	function select(int $id): array
	{
		$sql = 'SELECT * FROM chambre, hotel, chcategorie
		WHERE cha_hotel = hot_id
		AND cha_chcategorie = chc_id
		AND cha_id=:id';
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id", $id, PDO::PARAM_INT);
		$statement->execute();
		$data = $statement->fetch();
		return  is_array($data) ? $data : [];
	}

	// Sélectionne tous les enregistrement des chambres d'un hôtel
	function chaHotel(int $id)
	{
		$sql = "SELECT cha_id, cha_numero, cha_hotel, 
		cha_statut, cha_surface, cha_type_lit,  cha_description, cha_jacuzzi,
		cha_balcon, cha_wifi, cha_minibar, cha_coffre,
		cha_vue, chc_categorie, cha_hotel 
		FROM chambre, chcategorie, hotel 
		WHERE cha_chcategorie = chc_id 
		AND cha_hotel = hot_id
		AND cha_hotel = :id
		AND cha_statut = 'Actif'
		ORDER BY CAST(cha_numero AS int) ASC";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id", $id, PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetchAll();
	}

	/**
	 * chaRecherche
	 *
	 * @param  string $texte
	 * @param  string $champ
	 * @return array enregistrements de chambres en fonction d'un crtière de recherche
	 */
	public function chaRecherche(string $texte, string $champ)
	{
		$sql = "SELECT  cha_id, cha_numero, 
		cha_statut, cha_surface, cha_type_lit,  cha_description, cha_jacuzzi,
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
	static public function OPTIONChambre(string $idChambre)
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

<?php

/**
 * Contrôleur des catégories de chambres
 */
class Chcategorie extends Table
{
	/**
	 * @return void Instancie un objet constructeur à partir du constructeur parent
	 */
	public function __construct()
	{
		parent::__construct("chcategorie", "chc_id");
	}

	/**
	 * @return array $chcCats Ensemble des enregistrement de la table utilisateur
	 */
	public function selectAll(): array
	{
		$sql = 'SELECT chc_categorie from chcategorie';
		$resultats = self::$link->query($sql);
		$chcCats = [];

		while ($nomCat = $resultats->fetchColumn()) {
			$chcCats[] = $nomCat;
		}

		return $chcCats;
	}

	/**
	 * @param int $id : identifiant de la catégorie de chambre à sélectionner par défaut
	 * @return string : texte HTML d'une liste déroulante de catégories de chambres
	 */
	static public function OPTIONchcategories($id)
	{
		return self::HTMLoptions('SELECT chc_id, chc_categorie FROM chcategorie', 'chc_id', 'chc_categorie', $id);
	}


	/**
	 * @return int : retourne le nombre de catégories de chambres stockées en base de données
	 */
	public function countCat()
	{
		$sql = "SELECT COUNT(DISTINCT chc_categorie) `nb_chc` FROM chcategorie";
		$result = self::$link->query($sql);
		return $result->fetch()['nb_chc'];
	}
}

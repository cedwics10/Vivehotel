<?php

/**
Classe créé par le générateur.
 */
class Tarifer extends Table
{

	const AXES_TABLEAU_TARIFS = [
		'D1' => 'tar_hocategorie',
		'D2' => 'tar_chcategorie',
		'Y' => 'tar_prix'
	];

	public function __construct()
	{
		parent::__construct("tarifer", "tar_id");
	}

	public function selectAll(): array
	{
		$sql = "SELECT tar_prix, 
		(tar_hocategorie-1) `tar_hocategorie`,
		(tar_chcategorie-1) `tar_chcategorie`
		FROM tarifer";
		$result = self::$link->query($sql);
		return $result->fetchAll();
	}

	public function selectPrix(int $hocCat, $chcCat): array
	{
		$sql = 'SELECT tar_id,  tar_prix
		FROM tarifer
		WHERE tar_chcategorie = :chcat
		AND tar_hocategorie = :hocat';
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':hocat', $hocCat);
		$stmt->bindValue(':chcat', $chcCat);
		$stmt->execute();
		return $stmt->fetch();
	}
}

<?php
$tab = [];
foreach (HOTEL_CATEGORIE as $hoc_nom) {
    $tab[] = "(null,'$hoc_nom')";
}

$sql = "INSERT INTO hocategorie VALUES " . implode(",", $tab);
mysqli_query($link, $sql);

echo '<p>Génération de ' . count(HOTEL_CATEGORIE) . ' catégorie de l\'hôtel</p>';

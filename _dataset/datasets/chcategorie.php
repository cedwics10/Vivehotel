<?php
//génération des catégories de chambre
$tab = [];
foreach (CHA_CATEGORIE as $chc_nom) {
    $tab[] = "(null,'$chc_nom')";
}
$sql = "INSERT INTO chcategorie VALUES " . implode(",", $tab);
mysqli_query($link, $sql);
echo "<p>Génération de " . count(CHA_CATEGORIE) . " catégories de chambres.</p>";

<?php

$tar_id = [];
$tar_prix = [];
$tar_hocategorie = [];
$tar_chcategorie = [];

$tab = [];

$noTarif = 0;
$hoc = 1;
foreach (HOTEL_CATEGORIE as $hocat) {
    $chc = 1;
    foreach (CHA_CATEGORIE as $chcat) {
        $tar_prix = TARIFS_CHAMBRES[$hocat][$chcat];
        /* Si le tarif n'existe pas pour un type de chambre
        pris dans une catégorie d'hôtel, on l'ajoute. */
        if ($tar_prix == NULL) {
            continue;
        }

        $tar_hocategorie = $hoc;
        $tar_chcategorie = $chc;

        $tab[] = "(null,'$tar_prix', '$tar_hocategorie', '$tar_chcategorie')";
        $noTarif++;
        $chc++;
    }
    $hoc++;
}


$sql = "INSERT INTO tarifer VALUES " . implode(",", $tab);
mysqli_query($link, $sql);

echo '<p>génération de ' . ($noTarif) . ' tarifs des chambres. </p>';

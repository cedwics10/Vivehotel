<?php

$data = [];
for ($idHotel = 1; $idHotel <= NOMBRE_HOTEL; $idHotel++) {
    $hot_statut = HOTEL_STATUT[array_rand(HOTEL_STATUT)];

    $hot_nom = "hôtel $idHotel";
    $hot_adresse = 'Rue du ' . $idHotel;
    $hot_departement = mt_rand(1, 95);

    $hot_description = "text $idHotel";

    $hot_longitude = mt_rand(-10, 10);
    $hot_latitude = mt_rand(-10, 10);

    $hot_hocategorie = mt_rand(1, count(HOTEL_CATEGORIE));
    $data[] = "(null,'$hot_statut','$hot_nom','$hot_adresse','$hot_departement','$hot_description','$hot_longitude','$hot_latitude','$hot_hocategorie')";
}
$sql = "INSERT INTO hotel VALUES " . implode(",", $data);
mysqli_query($link, $sql);
echo "<p>Génération de " . NOMBRE_HOTEL . " hôtels</p>";

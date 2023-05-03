<?php
$tab = [];
$nbServicesHotel = [];
$hotelListeSer = [];
$id_services = range(1, count(SERVICES_NOM));

for ($hotel = 1; $hotel <= NOMBRE_HOTEL; $hotel++) {

    $nbServicesHotel[] = mt_rand(2, 4) - 1;
    shuffle($id_services);
    $idServicesHotel = array_slice($id_services, 0, end($nbServicesHotel));

    foreach ($idServicesHotel as $id_service) {
        $pro_services = $id_service;
        $hotelListeSer[$hotel][] = $id_service;

        $pro_hotel = $hotel;
        $pro_prix = mt_rand(0, 100);
        $tab[] = "(NULL,'$pro_prix','$pro_hotel','$pro_services')";
    }
}
$sql = "INSERT INTO proposer VALUES " . implode(",", $tab);
mysqli_query($link, $sql);
echo "<p>Génération de ? propositions.</p>";

<?php
$tab = [];
$noChambreHotels = [];

$texteCha = '';

//Génération des chambres
$idChambre = 1;
for ($cha_hotel = 1; $cha_hotel <= NOMBRE_HOTEL; $cha_hotel++) {
    $noChambreHotels[$cha_hotel] = [];
    for ($cha_numero = 1; $cha_numero <= NB_CHAMBRE_P_HOTEL; $cha_numero++) {

        $noChambreHotels[$cha_hotel][] = $idChambre;

        $cha_chcategorie = mt_rand(1, count(CHA_CATEGORIE));

        $cha_statut = CHAMBRE_STATUTS[array_rand(CHAMBRE_STATUTS)];
        $cha_surface = mt_rand(10, 40);
        $cha_typeLit = TYPE_LITS[array_rand(TYPE_LITS)];

        $cha_description = "Chambre numéro $idChambre dans $idHotel <a href=\'index.php\'>Accueil</a>";
        $cha_jacuzzi = mt_rand(0, 1);
        $cha_balcon = mt_rand(0, 1);
        $cha_wifi = mt_rand(0, 1);
        $cha_minibar = mt_rand(0, 1);
        $cha_coffre = mt_rand(0, 1);
        $cha_vue = mt_rand(0, 1);

        $tab[] = "(null,'$cha_numero','$cha_statut','$cha_surface','$cha_typeLit', 
        '$cha_description','$cha_jacuzzi','$cha_balcon','$cha_wifi',
        '$cha_minibar','$cha_coffre','$cha_vue',
		'$cha_chcategorie','$cha_hotel')";

        print($cha_hotel . ',' . $cha_numero . PHP_EOL);

        $idChambre++;
    }
}
$sql = "INSERT INTO chambre VALUES " . implode(",", $tab);

mysqli_query($link, $sql);


echo "<p>Génération de " . strval(NB_CHAMBRE_P_HOTEL * NOMBRE_HOTEL) . " chambres</p>";

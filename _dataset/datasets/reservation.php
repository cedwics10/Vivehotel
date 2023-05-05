<?php

const ANNEE_RESERVATIONS = 2021;
const HEURE_DEBUT = 15;
const HEURE_FIN = 11;

$idClients = range(1, NOMBRE_DE_CLIENTS);
shuffle($idClients);

$hotel_reservation = [];
$nb_reservations = 1;
$tab = [];

for ($hotel = 1; $hotel <= NOMBRE_HOTEL; $hotel++) // 50 hôtels
{
    $jour = 1;
    while ($jour < 365) { // dates
        shuffle($noChambreHotels[$hotel]);
        $selected_no = array_slice($noChambreHotels[$hotel], 0, 4);

        foreach ($noChambreHotels[$hotel] as $cle_chambre) { //  5 chambres.

            $res_id    = 'NULL';

            $duree_reservation = mt_rand(1, 7);

            $res_timestamp_creation = mktime(HEURE_DEBUT, 0, 0, 1, $jour - 3, ANNEE_RESERVATIONS);
            $res_date_creation    = date('Y-m-d', $res_timestamp_creation);

            $res_timestamp_debut = mktime(HEURE_DEBUT, 0, 0, 1, $jour, ANNEE_RESERVATIONS);
            $res_date_debut    = date('Y-m-d', $res_timestamp_debut);

            $res_timestamp_maj = mktime(HEURE_FIN, 0, 0, 1, $jour + ceil($duree_reservation / 2), ANNEE_RESERVATIONS);
            $res_date_maj = date('Y-m-d H:i:s', $res_timestamp_maj);

            $res_timestamp_fin = mktime(HEURE_FIN, 0, 0, 1, $jour + $duree_reservation, ANNEE_RESERVATIONS);
            $res_date_fin      = date('Y-m-d', $res_timestamp_fin);

            $res_etat    = STATUT_RESERVATION[array_rand(STATUT_RESERVATION)];
            $res_client  = $idClients[$nb_reservations % NOMBRE_DE_CLIENTS];
            $res_hotel   = $hotel;
            $res_chambre = $cle_chambre;

            $hotel_reservation[$nb_reservations] = $hotel;

            $nb_reservations++;
            $tab[] = "(NULL,'$res_date_creation','$res_date_debut','$res_date_maj','$res_date_fin','$res_etat','$res_client','$res_hotel','$res_chambre')";
        }

        $jour += mt_rand(4, 7);
    }
}

$tabs = array_chunk($tab, 100);
foreach ($tabs as $tab) {
    $sql = 'INSERT INTO reservation VALUES ' . implode(',', $tab);
    mysqli_query($link, $sql) or die(mysqli_error($link));
}

echo "Génération de $nb_reservations réservations";

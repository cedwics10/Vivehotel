<?php
// Fichier qui génèrent l'ensemble de la base de donnée

$timestart = microtime(true);

$includes = [
    '../constants.php',
    'connexion.php',
    'client.php',
    'services.php',
    'chcategorie.php',
    'hocategorie.php',
    'hotel.php',
    'personnel.php',
    'chambre.php',
    'tarif.php',
    'proposer.php',
    'reservation.php',
    'commander.php'
];

foreach ($includes as $nomFichier) {
    include('datasets/' . $nomFichier);
}

$timeend = microtime(true);
$time = $timeend - $timestart;

$page_load_time = number_format($time, 3);
echo "<br />Debut du script: " . date("H:i:s", $timestart);
echo "<br>Fin du script: " . date("H:i:s", $timeend);
echo "<br>Script execute en " . $page_load_time . " sec";

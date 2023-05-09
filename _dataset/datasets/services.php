<?php
//génération des servicesNom         
$tab = [];
for ($noService = 0; $noService < count(SERVICES_NOM); $noService++) {
    $tab[] = "(null, " . mres(SERVICES_NOM[$noService]) . ")";
}

$sql = "INSERT INTO services VALUES " . implode(",", $tab);
mysqli_query($link, $sql);
echo "<p>Génération de " . count(SERVICES_NOM) . " services.</p>";

<?php
//génération des servicesNom         
$tab = [];
for ($noService = 0; $noService < count(SERVICES_NOM); $noService++) {
    $tab[] = "(null,'SERVICES_NOM[$noService]')";
}
$sql = "insert into services values " . implode(",", $tab);
mysqli_query($link, $sql);
echo "<p>Génération de " . count($servicesNom) . " services.</p>";

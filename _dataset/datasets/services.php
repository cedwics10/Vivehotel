<?php
//génération des servicesNom         
$tab = [];
for ($noService = 0; $noService < count($servicesNom); $noService++) {
    $tab[] = "(null,'$servicesNom[$noService]')";
}
$sql = "insert into services values " . implode(",", $tab);
mysqli_query($link, $sql);
echo "<p>Génération de " . count($servicesNom) . " services.</p>";

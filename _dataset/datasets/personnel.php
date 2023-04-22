<?php
$tab = [];
for ($i = 1; $i <= NOMBRE_HOTEL; $i++) {
    $per_nom = "gestionnaire  $i";
    $per_identifiant = "gestionnaire$i";
    $per_mdp = password_hash($per_identifiant, PASSWORD_DEFAULT);
    $per_email = "g$i@gestionnaire.fr";
    $per_role = "gestionnaire";
    $per_hotel = $i;
    $tab[] = "(null,'$per_nom','$per_identifiant','$per_mdp','$per_email','$per_role','$per_hotel')";
}

for ($i = 1; $i <= NOMBRE_TELEC; $i++) {

    $per_nom = "teleconseiller $i";
    $per_identifiant = "teleconseiller$i";
    $per_mdp = password_hash($per_identifiant, PASSWORD_DEFAULT);
    $per_email = "t$i@teleconseiller.fr";
    $per_role = "teleconseiller";
    $per_hotel = 'null';
    $tab[] = "(null,'$per_nom','$per_identifiant','$per_mdp','$per_email','$per_role',$per_hotel)";
}

for ($i = 1; $i <= NOMBRE_ADMIN; $i++) {
    $per_nom = "admin $i";
    $per_identifiant = "admin$i";
    $per_mdp = password_hash($per_identifiant, PASSWORD_DEFAULT);
    $per_email = "a$i@admin.fr";
    $per_role = "admin";
    $per_hotel = 'null';
    $tab[] = "(null,'$per_nom','$per_identifiant','$per_mdp','$per_email','$per_role',$per_hotel)";
}

$sql = "INSERT INTO personnel VALUES " . implode(",", $tab);
mysqli_query($link, $sql);

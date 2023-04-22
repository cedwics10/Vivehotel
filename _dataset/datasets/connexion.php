<?php
include('../application/config/config.php');
$connexion = new PDO('mysql:host=localhost', DB_USER, DB_PWD);
$connexion->query('DROP DATABASE IF EXISTS vivehotel ');

$SqlCreationBdd = file_get_contents('vivehotel.sql');
$connexion->query($SqlCreationBdd);

$connexion = NULL;

$link = mysqli_connect("localhost", "root", "", "vivehotel");
mysqli_set_charset($link, "utf8");

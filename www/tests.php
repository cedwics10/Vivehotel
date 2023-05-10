<?php

/**
 ** controleur principal : paramètres  
 * m=module
 * a=action
 */
require "../application/config/config.php";

$r = new Recherche();
$r->creerFormulaire('index.php', 'post');
$r->ajouterInputText('hôtel', 'Le nom de l\'hôtel', '');

$r->htmlForm();

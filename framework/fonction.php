<?php

//fabrique un lien en passant les parametres un par un à savoir :
// module, action, [cle, valeur]...
function hlien()
{
	$args = func_get_args();

	if (count($args) == 0)
		return "index.php";

	if (count($args) == 1)
		return "index.php?m=" . $args[0];

	$nb = count($args) / 2;
	if (!is_int($nb)) {
		throw new Exception("ERREUR : Nombre d'arguments dans l'url incorrect");
	}
	$m = $args[0];
	$a = $args[1];

	if (!isset($args[2]))
		return "index.php?m=$m&a=$a";
	else {
		$para = array();
		for ($i = 1; $i < $nb; $i++)
			$para[] = $args[2 * $i] . "=" . $args[2 * $i + 1];
		$s = implode("&", $para);
		return "index.php?m=$m&a=$a&$s";
	}
}

/**
Autoload : 
- les controleurs sont dans le répertoire "module", le fichier est préfixé par "Ctr_"
- les classes Table sont dans le répertoire "_table"
 */
function monAutoLoad($classname)
{
	if ("Ctr_" == substr($classname, 0, 4)) {
		$rep = str_replace("Ctr_", "", $classname);
		require_once "../application/module/$rep/" . $classname . ".class.php";
	} else {
		if (file_exists("../application/table/" . $classname . ".class.php"))
			require_once "../application/table/" . $classname . ".class.php";
	}
}

function monExceptionHandler($e)
{
	die("Erreur : " . $e->getMessage());
}

/*
Affiche un tableau PHP à 2 cles sous la forme d'une table HTML
*/
function afficheTableHTML($data)
{
	$fin = false;
	echo "<table>";
	foreach ($data as $cleLigne => $ligne) {
		//affiche des entete de colonnes
		if (!$fin) {
			echo "<tr>";
			echo "<th></th>";
			foreach ($ligne as $cle => $valeur) {
				echo "<th>$cle</th>";
			}
			echo "</tr>";
			$fin = true;
		}

		//affichage du tableau
		echo "<tr>";
		echo "<th>$cleLigne</th>";
		foreach ($ligne as $cle => $valeur) {
			echo "<td>$valeur</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}

//si user non authentifié redirection vers index
function checkAuth()
{
	if (!isset($_SESSION["cli_id"]) and !isset($_SESSION['per_role'])) {

		$_SESSION["message"][] = "Vous n'êtes pas connecté.";
		header("location:" . hlien("_default"));
		exit;
	}
}

//si user non authentifié redirection vers index
function checkAllow(string|array $profil)
{
	checkAuth();

	if (is_string($profil)) {
		$profil = [$profil];
	}

	if (
		isset($_SESION['cli_role'])
		and in_array($_SESSION['cli_role'], $profil)
	) {
		return false;
	}

	if (
		isset($_SESSION["per_role"])
		and !in_array($_SESSION['per_role'], $profil)
	) {
		$_SESSION["message"][] = "Cette page n'existe pas.";
		header("location:" . hlien("_default"));
		exit();
	}
}

//anti sql injection : NE PAS UTILISER AVEC DES REQUETES PREPAREES 
function mres($s)
{
	return Table::$link->quote($s);
}

/**
Traitement des chaines anti XSS avant affichage dans une page HTML.
 */
function mhe($x)
{
	return htmlentities($x, ENT_QUOTES, "utf-8");
}

/**
 * DEBUG
 */
function debug($t)
{
	echo "<pre>";
	print_r($t);
	echo "</pre>";
}

// Crée un formulaire HTML pour rechercher les données de la table nommée "$className"
function FormRecherche($className)
{ ?>
	<p>
	<form method='post'>
		<p>
			<label for='rech_texte'>Rechercher <?= mhe(strtolower($className)) ?> :</label> <input type='text' name='rech_texte' value='' />
		</p>
		<label for="rech_champ">Crtière :</label>
		<?php
		foreach ($className::CRI_RECHERCHE as $name => $field) {
			echo mhe($name) . " <input type='radio' name='rech_champ' value='" . mhe($field) . "' /> ";
		}
		?>
		<input class="btn btn-success" type="submit" value="Enregistrer" /><br />
		<input type="hidden" name="bt_submit" />

	</form>
	</p>
<?php
}

/**
 * checkAuto
 * Un gestionnaire n'a le droit de gérer qu'un unique hôtel. Cette fonction
 * vérifie à partir d'un enregistrement SQL si la clé du numéro d'hôtel
 * correspond bien à l'hôtel actuel du gestionnaire. Si les dexu valeurs
 * diffèrent, cela signifie que le gestionnaire tente de lire des données
 * sur lesquelles il n'a aucun rôle.
 * @return bool
 */
function gestionnaireCheckHotel(string $rowKeyToCheck, array $data, string $redirection = '')
{
	$lien = ($redirection == '') ? hlien('gestionnaire', 'hotel') : $redirection;
	if (
		$_SESSION['per_role'] == 'gestionnaire'
		and $_SESSION['per_hotel'] != $data[$rowKeyToCheck]
	) {
		header('Location: ' . $lien);
		exit();
	}
}


// Modifier les dates dans un format en Français
function dateFr($date)
{
	$date = new DateTime($date);
	return $date->format('d/m/Y');
}

/* 
	Crée une tableau à double entrée vide
	de dimension $dimensionX*$dimensionY
	où chaque case stocke la valeur $defaultValue
*/
function tableau2D(int $dimensionX, int $dimensionY, string $defaultValue = 'X')
{
	$mytable = [];
	for ($x = 0; $x < $dimensionX; $x++) {
		for ($y = 0; $y < $dimensionY; $y++) {
			$mytable[$x][$y] = $defaultValue;
		}
	}
	return $mytable;
}

/*
Cette fonction crée un tableau croisé dynamique à partir d’enregistrements de requêtes SQL.

Le premier paramètre de cette fonction est un tableau qui a pour clés X1 et X2. Chaque clé est associée à une valeur qui est un entier naturel strictement positif. 

La fonction « matriceSqlCD » appelle tout d’abord la fonction tableauD2 pour créer un tableau T de dimension D1*D2 où :
* D1 = $dimensionsTab['X1']
* D2 = $dimensionsTab['X2']

A partir du tableau D1*D2 créé par la méthode tableau2D,
cette fonction crée un tableau croisé dynamique avec pour axes :
- X1 : la clé en axe des X
- X2 : la clé en axes des Y
- Y : la valeur dans la case de coordonnées (X1,X2)

Le nom des axes X1,X2 est donné dans le deuxième paramètre de la fonction ($nomAxe)

Le troisième paramètre est un array de résultats SQL à index numériques. Chaque clé est associée à un array contenant un tableau associatif d’un enregistrement d’une requête SQL.

Chaque enregistrement d'un résultat SQL doit être un array de la forme (dans l’ordre ou non) :
[cle1=>val1, cle2=>val2, ... X1=>valX1, X2=>valX2, Y=>valY]

Pour chaque enregistrement itéré, la fonction va remplir une case du tableau T de coordonnées (valX1,valX2) avec la valeur valY.
*/
function matriceSqlCD(array $dimensionsTab, array $nomAxe, array $mysqlRecords): array
{
	// Vérifions que les dimensions soient valides
	if (!isset($nomAxe['D1']) or !isset($nomAxe['D2']))
		return [];

	$D1 = $dimensionsTab['D1'];
	$D2 = $dimensionsTab['D2'];

	$tableauSqlCD = tableau2D($D1, $D2);

	/* 
	Nous plaçons une valeur d'une enregistreent Mysql
	dans le tableau en fonction de la valeur de ses
	champs.
	*/
	foreach ($mysqlRecords as $enregistrement) {
		$cleX1 = $enregistrement[$nomAxe['D1']];
		$cleX2 = $enregistrement[$nomAxe['D2']];
		$valY = $enregistrement[$nomAxe['Y']];

		$tableauSqlCD[$cleX1][$cleX2] = $valY;
	}

	return $tableauSqlCD;
}

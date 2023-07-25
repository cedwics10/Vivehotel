# Vivehotel
Site internet du projet Vivehotel	Site internet du projet Vivehotel

Here is the modus operandi to set up and test the project, using XAMPP

- 1. Clone this project
- 2. Open the file "httpd-xampp.conf" in the folder "C:\xampp\apache\conf\extra"
- 3. Create a new alias on "/vivehotel"
- 4. Restart the Apache server
- 5. Open phpMyAdmin and crete a database called "vivehotel"
- 6. Set the correct connection ids in the file "/application/config/config.php"
- 6. Go to the page "localhost/vivehotel/\_dataset"

Generating the dataset : 
1. Be sure that Xampp and phpMyAdmin are on.
2. Change the target of the alias to the root folder
1. Go to the link "localhost/vivehotel/\_dataset" on your browser
  4 changes: 2 additions & 2 deletions4  
_dataset/index.php
@@ -1,5 +1,5 @@
<?php	<?php
// Fichier qui génèrent l'ensemble de la base de donnée	// Home page of dataset 


$timestart = microtime(true);	$timestart = microtime(true);


@@ -20,7 +20,7 @@
];	];


foreach ($includes as $nomFichier) {	foreach ($includes as $nomFichier) {
    include('datasets/' . $nomFichier);	    include('datasets/' . $nomFichier); // Includes each table dataset
}	}


$timeend = microtime(true);	$timeend = microtime(true);

<?php
session_start();
// CONNEXION À LA BASE DE DONNÉES

$dsn = 'mysql:dbname=robinpayadmin;host=mysql51-100.perso';
$user = 'robinpayadmin';
$password = 'gUFjHp3Q8m9y';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Erreur: ' . $e->getMessage();
}

	if(isset($_POST['statut'])) {
	$id=$_SESSION['ID'];	
	$statut=$_POST['statut'];

			$dbh -> query("UPDATE grabin_user SET statut = '".$statut."' WHERE id='".$id."' " );
			
			
			echo "&#171;".htmlentities(stripslashes($statut), ENT_NOQUOTES,"UTF-8")."&#187;";		
	}
	
?>
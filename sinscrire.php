<?php

		$loginN=mysql_escape_string($_POST['nom']);
		$loginP=mysql_escape_string($_POST['prenom']);
		$mdp=mysql_escape_string($_POST['mdp']);
		$pseudo=mysql_escape_string($_POST['pseudo']);
		$mail=$_POST['email_addr'];
		$niveau=mysql_escape_string($_POST['niveau']);
		
$dsn = 'mysql:dbname=robinpayadmin;host=mysql51-100.perso';
$user = 'robinpayadmin';
$password = 'gUFjHp3Q8m9y';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Erreur: ' . $e->getMessage();
}
// CALCUL DE LA VALEUR DES SPORT PRATIQUES_____________________________________________________
	
if (isset($_POST['check']))
{    
    //recupérer les valeurs des checkbox
    $tabCheckbox = $_POST['check'];
    foreach ($tabCheckbox as $checkbox) {
		$Vsport=$Vsport+$checkbox;
    }	
}

if (isset($_POST['envoie'])) {
$user = $dbh -> query('INSERT INTO grabin_user(name, surname, pseudo, sport, sport_level, email, mdp)VALUES("'.$loginN.'","'.$loginP.'","'.$pseudo.'","'.$Vsport.'","'.$niveau.'","'.$mail.'","'.$mdp.'")');
		
		
						session_start(); 
						$pseudo = $_SESSION['login']; 
						 header('location: profil.php');
						 exit(); 
	
}

?>

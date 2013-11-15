<?php

		$loginN=mysql_escape_string($_POST['nom']);
		$loginP=mysql_escape_string($_POST['prenom']);
		$mdp=mysql_escape_string($_POST['mdp']);
		$pseudo=mysql_escape_string($_POST['pseudo']);
		$mail=$_POST['email_addr'];
		$sport=mysql_escape_string($_POST['sport']);
		$niveau=mysql_escape_string($_POST['niveau']);
		$date_register=date('Y-m-d');


		
$dsn = 'mysql:dbname=robinpayadmin;host=mysql51-100.perso';
$user = 'robinpayadmin';
$password = 'gUFjHp3Q8m9y';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Erreur: ' . $e->getMessage();
	
}
if(isset($_GET['test_pseudo'])){
	$pseudo_test=$_GET['test_pseudo'];
	$exist="Pseudo ok";
	
$user = $dbh -> query("SELECT * FROM grabin_user WHERE pseudo='".$pseudo_test."'")->fetchAll();
	
	foreach ($user as $users):
	if($users['pseudo']==$pseudo_test)
		$exist="Pseudo deja pris";
	endforeach;
	
	echo $exist;

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
$user = $dbh -> query('INSERT INTO grabin_user(name, surname, pseudo, sport, sport_level, email, mdp, date_register)VALUES("'.$loginN.'","'.$loginP.'","'.$pseudo.'","'.$Vsport.'","'.$niveau.'","'.$mail.'","'.$mdp.'","'.$date_register.'")');

	$user = $dbh -> query("SELECT * FROM grabin_user WHERE pseudo='".$pseudo."'")->fetchAll();
	foreach ($user as $users):
		if($users['pseudo']==$pseudo)
			$id = $users['id'];
	endforeach;
		
						session_start(); 
						$_SESSION['login']=$pseudo; 
						$_SESSION['ID']=$id;
						$_SESSION['photo']="MEDIA/avatars/avatar_base.png";
						 header('location: profil.php');
						 exit(); 
	
}

?>

<?php
// CONNEXION À LA BASE DE DONNÉES

require 'config.php';

session_start();


//_________________VISITE PROFIL AMI OU PAS_________________//

	$id_user = $_SESSION['IDprofilVisite'];
	$id_userConnecte = $_SESSION['ID'];
		
	$ami = $dbh -> query("SELECT * FROM amis WHERE ID_accepteur='$id_user' AND ID_demandeur='$id_userConnecte'")->fetchAll();
	
	foreach ($ami as $amis):
$amitie = $amis['etat'];
endforeach;


//_________________RÉCUPÉRATION DES DONNEES USER_________________//

	$user = $dbh -> query("SELECT * FROM grabin_user WHERE id='".$id_user."'")->fetchAll();
	foreach ($user as $users):
$nameV = $users['name'];
$surnameV = $users['surname'];
$pseudoV = $users['pseudo'];
$emailV = $users['email'];
$avatarV = $users['avatar'];
$ageV = $users['age'];
$villeV = $users['ville'];
$sport = $users['sport'];
$sport_levelV = $users['sport_level'];
$scoreV = $users['score'];
$statut = $users['statut'];
$date_registerV = $users['date_register'];
endforeach;

//____ CLASSIFICATION DES SPORTS PRATIQUES _______________________________
if($sport>0){
	if ($sport==1) {
			$sport="Skate";
			}
	if ($sport==2) {
			$sport="Roller";
			}
	if ($sport==3) {
			$sport="Skate et Roller";
			}
	if ($sport==4) {
			$sport="Bike";
			}
	if ($sport==5) {
			$sport="Skate et Bike";
			}
	if ($sport==6) {
			$sport="Roller et Bike";
			}
	if ($sport==7) {
			$sport="Skate, Roller et Bike";
			}
	if ($sport==8) {
			$sport="Trotinette";
			}
	if ($sport==9) {
			$sport="Skate et Trotinette";
			}
	if ($sport==10) {
			$sport="Roller et Trotinette";
			}
	if ($sport==11) {
			$sport="Skate, Roller et Trotinette";
			}
	if ($sport==12) {
			$sport="Bike et Trotinette";
			}
	if ($sport==13) {
			$sport="Skate, Bike et Trotinette";
			}
	if ($sport==14) {
			$sport="Roller, Bike et Trotinette";
			}
	if ($sport==15) {
			$sport="Ultime Rider";
			}
}
else
	$sport="Bisounours! Yeah";
	

	if($amitie!=1)
		$statut="Vous n'êtes pas amis avec ".$_SESSION['profilVisite'];
		
	
	if(isset($_GET["demandeAbonnement"])){
		if($amitie==null)
			$amitie=-1;
			
		echo $amitie;
		
		
	}
	
	// Affichage ou non des photos de l'utilisateur affiché________________________________________________________

if($amitie==1) {
	//_________________RÉCUPÉRATION DES DONNEES MEDIA_________________//

	$media = $dbh -> query("SELECT * FROM media WHERE id_user='".$id_user."'")->fetchAll();
	$url = $dbh -> query("SELECT url,id FROM media WHERE id_user='".$id_user."' AND url!=''")->fetchAll();
	foreach ($media as $medias):
 if (!empty($medias['url_vid'])) {
	$url_vid = $medias['url_vid'];
}
$description = $medias['description'];
$date = $medias['date'];
endforeach;
	
}

?>
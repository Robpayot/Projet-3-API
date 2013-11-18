<?php
// CONNEXION À LA BASE DE DONNÉES

require 'config.php';
require 'function.php';

session_start();
$id_user = $_SESSION['ID'];	
	


//_________________RÉCUPÉRATION DES DONNEES USER_________________//

	$user = $dbh -> query("SELECT * FROM grabin_user WHERE id='".$id_user."'")->fetchAll();
	foreach ($user as $users):
$name = $users['name'];
$surname = $users['surname'];
$pseudo = $users['pseudo'];
$email = $users['email'];
$avatar = $users['avatar'];
$age = $users['age'];
$ville = $users['ville'];
$sport = $users['sport'];
$sport_level = $users['sport_level'];
$score = $users['score'];
$statut = $users['statut'];
$date_register = $users['date_register'];
endforeach;

//_________________RÉCUPÉRATION DES DONNEES MEDIA_________________//

	$media = $dbh -> query("SELECT * FROM media WHERE id_user='".$id_user."'")->fetchAll();
	foreach ($media as $medias):
$url = $medias['url'];
$url_vid = $medias['url_vid'];
$description = $medias['description'];
$date = $medias['date'];
endforeach;

// IF SUBMIT PHOTO_______________________________________________
if(isset($_POST['submit_photo'])) {
// _________________________________________Upload de fichier_________________________________
$dossier = 'MEDIA/photos/';
$fichier = basename($_FILES['url']['name']);
$taille_maxi = 100000000;
$taille = filesize($_FILES['url']['tmp_name']);
$extensions = array('.png', '.PNG', '.gif', '.GIF', '.jpg', '.JPG', '.jpeg', '.JPEG');
$extension = strrchr($_FILES['url']['name'], '.'); 


//Début des vérifications de sécurité...
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
    // $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg...';
}
if($taille>$taille_maxi)
{
    // $erreur = 'Le fichier est trop gros...';
}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
     //On formate le nom du fichier ici...
     $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
	 
	/* //Créer un dossier 'fichiers/1/'
  mkdir('upload/1/', 0777, true);*/
  
//Créer un identifiant difficile à deviner
  //$fichier = md5(uniqid(rand(), true));
  
// $fichier = "{$id_membre}.{$extension_upload}";
/*$resultat = move_uploaded_file($_FILES['icone']['tmp_name'],$nom);
*/

$fichierDbName=$users['id'].$fichier;
    if(move_uploaded_file($_FILES['url']['tmp_name'], $dossier . $fichierDbName)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {

// Recadrage de l'image 
 $image_path = 'MEDIA/photos/' .$fichierDbName;
    $thumb_path = 'MEDIA/photos/thumb_'. $fichierDbName;
     
    imagethumb($image_path, $thumb_path, 190);

	$date=date('Y-m-d H-i-s');
	$description = $_POST['description'];
	$media = $dbh -> query('INSERT INTO media(id_user,url,description,date)VALUES("'.$id_user.'","'.$thumb_path.'","'.$description.'", "'.$date.'")');	
	    echo 'Upload effectué avec succès !';
	$_SESSION['photo']=$thumb_path;

		

     }
     else //Sinon (la fonction renvoie FALSE).
     {
       //   echo 'Echec de l\'upload !';
     }
}
else
{
     echo $erreur;
}
header('location:profil.php');
}

// IF SUBMIT PHOTO_______________________________________________
if(isset($_POST['submit_video'])) {
// _________________________________________Upload de fichier_________________________________
$dossier = 'MEDIA/videos/';
$fichier = basename($_FILES['url']['name']);
$taille_maxi = 100000000;
$taille = filesize($_FILES['url']['tmp_name']);

$extensions = array('.ogg','.mp4','.OGG','.MP4');
$extension = strrchr($_FILES['url']['name'], '.'); 


//Début des vérifications de sécurité...
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
    // $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg...';
}
if($taille>$taille_maxi)
{
    // $erreur = 'Le fichier est trop gros...';
}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
     //On formate le nom du fichier ici...
     $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
	 
	/* //Créer un dossier 'fichiers/1/'
  mkdir('upload/1/', 0777, true);*/
  
//Créer un identifiant difficile à deviner
  //$fichier = md5(uniqid(rand(), true));
  
// $fichier = "{$id_membre}.{$extension_upload}";
/*$resultat = move_uploaded_file($_FILES['icone']['tmp_name'],$nom);
*/

$fichierDbName=$users['id'].$fichier;
    if(move_uploaded_file($_FILES['url']['tmp_name'], $dossier . $fichierDbName)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {


 $video_path = 'MEDIA/videos/' .$fichierDbName;

	$date=date('Y-m-d H-i-s');
	$description = $_POST['description'];
	$media = $dbh -> query('INSERT INTO media(id_user,url_vid,description,date)VALUES("'.$id_user.'","'.$video_path.'","'.$description.'", "'.$date.'")');	
	    echo 'Upload effectué avec succès !';
	$_SESSION['photo']=$thumb_path;

		

     }
     else //Sinon (la fonction renvoie FALSE).
     {
       //   echo 'Echec de l\'upload !';
     }
}
else
{
     echo $erreur;
}
header('location:profil.php');
}

//_________________SUPPRESSION D'UN MEDIA_________________//
	

	foreach ($media as $medias):

	if ( isset($_POST['delete_media'.$medias['id']]) ) 
	{

		//unlink($painting['url_painting']);
		$delete = $dbh -> query("DELETE FROM media WHERE id='".$medias['id']."' " );
		//$deletes = $dbh -> query("SELECT * FROM media WHERE id_user = '".$id_user."'")->fetchAll();
		header('location:profil.php');
	}
	
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
	




?>
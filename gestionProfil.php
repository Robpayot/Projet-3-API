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

//____ CLASSIFICATION DES SPORTS PRATIQUES _______________________________
$iconSports="";
$bmx="<img src='imgs/icons/bmx.png' alt='bmx'>";
$skate="<img src='imgs/icons/skate.png' alt='skate'>";
$trotinette="<img src='imgs/icons/trotinette.png' alt='trotinette'>";
$roller="<img src='imgs/icons/roller.png' alt='roller'>";

if($sport>0){
	if ($sport==1) {
			$iconSports=$skate;
			}
	if ($sport==2) {
			$iconSports=$roller;
			}
	if ($sport==3) {
			$iconSports=$skate."".$roller;
			}
	if ($sport==4) {
			$iconSports=$bmx;
			}
	if ($sport==5) {
			$iconSports=$skate."".$bmx;
			}
	if ($sport==6) {
			$iconSports=$roller."".$bmx;
			}
	if ($sport==7) {
			$iconSports=$skate."".$roller."".$bmx;
			}
	if ($sport==8) {
			$iconSports=$trotinette;
			}
	if ($sport==9) {
			$iconSports=$skate."".$trotinette;
			}
	if ($sport==10) {
			$iconSports=$roller."".$trotinette;
			}
	if ($sport==11) {
			$iconSports=$skate."".$roller.$trotinette;
			}
	if ($sport==12) {
			$iconSports=$bmx."".$trotinette;
			}
	if ($sport==13) {
			$iconSports=$skate."".$bmx.$trotinette;
			}
	if ($sport==14) {
			$iconSports=$roller."".$bmx.$trotinette;
			}
	if ($sport==15) {
			$iconSports=$roller."".$bmx."".$trotinette.$skate;
			}
}


//_________________RÉCUPÉRATION DES DONNEES MEDIA_________________//

	$media = $dbh -> query("SELECT * FROM media WHERE id_user='".$id_user."'")->fetchAll();
	$url = $dbh -> query("SELECT url,id,description FROM media WHERE id_user='".$id_user."' AND url!=''")->fetchAll();



	foreach ($media as $medias):
 if (!empty($medias['url_vid'])) {
	$url_vid = $medias['url_vid'];
}
$description = $medias['description'];
$date = $medias['date'];
endforeach;


// Compte le nombre de photo et de vidéo chargées_______________________________________________________

$nbUrl=count($url);
$nbUrl_vid=count($url_vid);


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
     
    imagethumb($image_path, $thumb_path, 470);

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

//_________________SUPPRESSION D'UN PHOTO_________________//
foreach($url as $urls):	
if (isset($_POST['delete_media'.$urls['id']])) {
	$dbh -> query('DELETE FROM media WHERE id = "'.$urls['id'].'"');
	header('location:profil.php');
}
endforeach;

//_________________SUPPRESSION DE LA VIDEO_________________//

if (isset($_POST['delete_media'.$url_vid])) {
	$dbh -> query('DELETE FROM media WHERE url_vid = "'.$url_vid.'"');
	header('location:profil.php');
}


	




?>
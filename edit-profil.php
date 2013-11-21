<?php 

//____________REQUIRE_____________________


require 'config.php';
			// Modification de toutes les données users
	
	$name_modify = $_POST['name'];
	$surname_modify = $_POST[$users['surname']];
	$pseudo_modify = $_POST['pseudo'];
	$email_modify = $_POST['email'];
	$avatar_modify = $_POST['avatar'];
	$age_modify = $_POST['age'];
	$ville_modify = $_POST['ville'];
	$sport_level_modify = $_POST['sport_level'];


			$success_modify ="modifications faites !";
			
	//______________MODIF DANS LA DATABASE_______________	
		
	if(isset($_POST['name'])) {	
			$dbh -> query("UPDATE grabin_user SET name = '".$name_modify."' WHERE id='".$id_user."' " );		
	}
	if(isset($_POST[$users['surname']])) {	
			$dbh -> query("UPDATE grabin_user SET surname = '".$surname_modify."' WHERE id='".$id_user."'" );		
	}
		if(isset($_POST['pseudo'])) {	
			$dbh -> query("UPDATE grabin_user SET pseudo = '".$pseudo_modify."' WHERE id='".$id_user."' " );		
	}
		if(isset($_POST['email'])) {	
			$dbh -> query("UPDATE grabin_user SET email = '".$email_modify."' WHERE id='".$id_user."' " );		
	}
		if(isset($_POST['avatar'])) {	
			$dbh -> query("UPDATE grabin_user SET avatar = '".$avatar_modify."' WHERE id='".$id_user."' " );		
	}
		if(isset($_POST['age'])) {	
			$dbh -> query("UPDATE grabin_user SET age = '".$age_modify."' WHERE id='".$id_user."' " );		
	}
		if(isset($_POST['ville'])) {	
			$dbh -> query("UPDATE grabin_user SET ville = '".$ville_modify."' WHERE id='".$id_user."' " );		
	}
		
	// MODIF SPORT PRATIQUES_____________________________________________________
	
if (isset($_POST['check']))
{    
    //recupérer les valeurs des checkbox
    $tabCheckbox = $_POST['check'];
    foreach ($tabCheckbox as $checkbox) {
		$Vsport=$Vsport+$checkbox;
    }
	$dbh -> query("UPDATE grabin_user SET sport = '".$Vsport."' WHERE id='".$id_user."' ");

	
}
	// MODIF SPORT LEVEL ___________________________________________________
		if(isset($_POST['sport_level'])) {	
			$dbh -> query("UPDATE grabin_user SET sport_level = '".$sport_level_modify."' WHERE id='".$id_user."'" );		
	}

// _________________________________________Upload de fichier_________________________________
$dossier = 'MEDIA/avatars/';
$fichier = basename($_FILES['avatar']['name']);
$taille_maxi = 100000000;
$taille = filesize($_FILES['avatar']['tmp_name']);
$extensions = array('.png', '.PNG', '.gif', '.GIF', '.jpg', '.JPG', '.jpeg', '.JPEG');
$extension = strrchr($_FILES['avatar']['name'], '.'); 


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
$resultat = move_uploaded_file($_FILES['icone']['tmp_name'],$nom);


$fichierDbName=$users['id'].$fichier;
    if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichierDbName)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {

// Recadrage de l'image 
 $image_path = 'MEDIA/avatars/' .$fichierDbName;
    $thumb_path = 'MEDIA/avatars/thumb_'. $fichierDbName;
     
    imagethumb($image_path, $thumb_path, 160);

		 $dbh -> query("UPDATE grabin_user SET avatar = '".$thumb_path."' WHERE id='".$id_user."'" );		
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

	
			header('location: profil.php');
						 exit(); 
 // FIN DU SUBMIT
?>

<?php 

	//____________REQUIRE_____________________


			// Modification de toutes les données users
	
	$name_modify = $_POST['name'];
	$surname_modify = $_POST['surname'];
	$pseudo_modify = $_POST['pseudo'];
	$email_modify = $_POST['email'];
	$ville_modify = $_POST['ville'];
	$sport_level_modify = $_POST['sport_level'];
    //recupérer les valeurs des checkbox
    $tabCheckbox = $_POST['check'];
    foreach ($tabCheckbox as $checkbox):
		$Vsport=$Vsport+$checkbox;
    endforeach;			
			
	//______________MODIF DANS LA DATABASE_______________	
		

			$user_modify = $dbh -> query("UPDATE grabin_user SET name = '".$name_modify."', surname = '".$surname_modify."', pseudo = '".$pseudo_modify."', email = '".$email_modify."', ville = '".$ville_modify."', sport = '".$Vsport."', sport_level = '".$sport_level_modify."' WHERE id='".$id_user."' " )->fetchAll();		


// _________________________________________Upload de fichier_________________________________
$dossier_a = 'MEDIA/avatars/';
$fichier_a = basename($_FILES['avatar']['name']);
$taille_maxi_a = 100000000;
$taille_a = filesize($_FILES['avatar']['tmp_name']);
$extensions_a = array('.png', '.PNG', '.gif', '.GIF', '.jpg', '.JPG', '.jpeg', '.JPEG');
$extension_a = strrchr($_FILES['avatar']['name'], '.'); 


//Début des vérifications de sécurité...
if(!in_array($extension_a, $extensions_a)) //Si l'extension n'est pas dans le tableau
{
    // $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg...';
}
if($taille_a>$taille_maxi_a)
{
    // $erreur = 'Le fichier est trop gros...';
}
if(!isset($erreur_a)) //S'il n'y a pas d'erreur, on upload
{
     //On formate le nom du fichier ici...
     $fichier_a = strtr($fichier_a, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier_a = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier_a);
	 
	/* //Créer un dossier 'fichiers/1/'
  mkdir('upload/1/', 0777, true);*/
  
//Créer un identifiant difficile à deviner
  //$fichier = md5(uniqid(rand(), true));
  
// $fichier = "{$id_membre}.{$extension_upload}";
$resultat_a = move_uploaded_file($_FILES['icone']['tmp_name'],$nom);


$fichierDbName_a=$users['id'].$fichier_a;
    if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier_a . $fichierDbName_a)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {

// Recadrage de l'image 
 $image_path_a = 'MEDIA/avatars/' .$fichierDbName_a;
    $thumb_path_a = 'MEDIA/avatars/thumb_'. $fichierDbName_a;
     
    imagethumb($image_path_a, $thumb_path_a, 160);

		 $dbh -> query("UPDATE grabin_user SET avatar = '".$thumb_path_a."' WHERE id='".$id_user."'" );		
          echo 'Upload effectué avec succès !';
		$_SESSION['photo']=$thumb_path_a;
     }
     else //Sinon (la fonction renvoie FALSE).
     {
       //   echo 'Echec de l\'upload !';
     }
}
else
{


}
	
		$user = $dbh -> query("SELECT * FROM grabin_user WHERE id='".$id_user."'")->fetchAll();
	foreach ($user as $users):
$name = $users['name'];
$surname = $users['surname'];
$pseudo = $users['pseudo'];
$email = $users['email'];
$avatar = $users['avatar'];
$ville = $users['ville'];
$sport = $users['sport'];
$sport_level = $users['sport_level'];
$score = $users['score'];
$date_register = $users['date_register'];
endforeach;
 // FIN DU SUBMIT
?>

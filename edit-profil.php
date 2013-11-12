<?php 

// CONNEXION À LA BASE DE DONNÉES

$dsn = 'mysql:dbname=robinpayadmin;host=mysql51-100.perso';
$user = 'robinpayadmin';
$password = 'gUFjHp3Q8m9y';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Erreur: ' . $e->getMessage();
}

session_start();
$pseudo_user = $_SESSION['login'];


//_________________RÉCUPÉRATION DES DONNEES USER_________________//

	$user = $dbh -> query("SELECT * FROM grabin_user WHERE pseudo='".$pseudo_user."'")->fetchAll();
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
$date_register = $users['date_register'];
endforeach;

//____ CLASSIFICATION DES SPORTS PRATIQUES _______________________________

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
	
//________________________LORS DU SUBMIT _______________________________	
		
	if(isset($_POST['submit_edit'])) {
				// Modification de toutes les données users
	
	$name_modify = $_POST['name'];
	$surname_modify = $_POST['surname'];
	$pseudo_modify = $_POST['pseudo'];
	$email_modify = $_POST['email'];
	$avatar_modify = $_POST['avatar'];
	$age_modify = $_POST['age'];
	$ville_modify = $_POST['ville'];
	$sport_level_modify = $_POST['sport_level'];
	
			header('location: edit-profil.php');

			$success_modify ="modifications faites !";
			
	//______________MODIF DANS LA DATABASE_______________	
		}
	if(isset($_POST['name'])) {	
			$dbh -> query("UPDATE grabin_user SET name = '".$name_modify."' WHERE pseudo='".$pseudo_user."' " );		
	}
	if(isset($_POST['surname'])) {	
			$dbh -> query("UPDATE grabin_user SET surname = '".$surname_modify."' WHERE pseudo='".$pseudo_user."'" );		
	}
		if(isset($_POST['pseudo'])) {	
			$dbh -> query("UPDATE grabin_user SET pseudo = '".$pseudo_modify."' WHERE pseudo='".$pseudo_user."' " );		
	}
		if(isset($_POST['email'])) {	
			$dbh -> query("UPDATE grabin_user SET email = '".$email_modify."' WHERE pseudo='".$pseudo_user."' " );		
	}
		if(isset($_POST['avatar'])) {	
			$dbh -> query("UPDATE grabin_user SET avatar = '".$avatar_modify."' WHERE pseudo='".$pseudo_user."' " );		
	}
		if(isset($_POST['age'])) {	
			$dbh -> query("UPDATE grabin_user SET age = '".$age_modify."' WHERE pseudo='".$pseudo_user."' " );		
	}
		if(isset($_POST['ville'])) {	
			$dbh -> query("UPDATE grabin_user SET ville = '".$ville_modify."' WHERE pseudo='".$pseudo_user."' " );		
	}
		
	// MODIF SPORT PRATIQUES_____________________________________________________
	
if (isset($_POST['check']))
{    
    //recupérer les valeurs des checkbox
    $tabCheckbox = $_POST['check'];
    foreach ($tabCheckbox as $checkbox) {
		$Vsport=$Vsport+$checkbox;
    }
	$dbh -> query("UPDATE grabin_user SET sport = '".$Vsport."' WHERE pseudo='".$pseudo_user."' ");

	
}
	// MODIF SPORT LEVEL ___________________________________________________
		if(isset($_POST['sport_level'])) {	
			$dbh -> query("UPDATE grabin_user SET sport_level = '".$sport_level_modify."' WHERE pseudo='".$pseudo_user."'" );		
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
/*$resultat = move_uploaded_file($_FILES['icone']['tmp_name'],$nom);
*/
$fichierDbName=$users['id'].$fichier;
    if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichierDbName)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
		 
	
		 $dbh -> query("UPDATE grabin_user SET avatar = 'MEDIA/avatars/".$fichierDbName."' WHERE pseudo='".$pseudo_user."'" );		
          echo 'Upload effectué avec succès !';
		$_SESSION['photo']="MEDIA/avatars/".$fichierDbName;
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

?>
     
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>GRAB-IN</title>
</head>

<body>
<style>
#content {
margin:0 auto;
text-align:center;
font-family: 'Calibri', serif;
}
.monForm {

}

input, label {
		padding:0 .5em;
		line-height: 2em;
		color:grey;
	}
	
#photo {
	margin:0 auto;
width:170px;
	}

</style>

<div id="content">
<a href="profil.php">Retour Profil</a>
 <?php if (isset($success_modify)): ?>
                		<div">
                 			 <h5><?php echo $success_modify; ?></h5>
                		</div>
               			<br />
               			<?php endif; ?> 
<h1>Nom : <?php echo ($name);?></h1>
                        
<form action="edit-profil.php" enctype="multipart/form-data" method="post">
    <input class="monForm" value="<?php echo ($name);?>" name="name" id="name" data-provide="limit" data-counter="#counter" rows="8"></input>
    
		<h2>Prénom : <?php echo ($surname);?></h2>
	<input class="monForm" value="<?php echo ($surname);?>" name="surname" id="surname" data-provide="limit" data-counter="#counter"  rows="8" />
    
	<h2>Pseudo : <?php echo ($pseudo);?></h2>
	<input class="monForm" value="<?php echo ($pseudo);?>" name="pseudo" id="pseudo" data-provide="limit" data-counter="#counter"  rows="8"></input>
    
	<p>Mail : <?php echo ($email);?></p>
	<input class="monForm" value="<?php echo ($email);?>" name="email" id="email" data-provide="limit" data-counter="#counter"  rows="8"></input>
    
	<p>Ton avatar : </p>
    
    <div id="photo"><img alt="image avatar ici" width="100%" height="100%" src="<?php 
echo ($avatar);
	?>"></div>
	<input type="hidden" name="MAX_FILE_SIZE" value="100000000">
     <p>Ajouter une image : <input type="file" name="avatar" id="avatar"></p>
     
	<p>Age : <?php echo ($age);?> ans</p>
	<select class="monForm" value="<?php echo ($age);?>" name="age" id="age" data-provide="limit" data-counter="#counter"  rows="8"><option value="10" <?php if($age == '10'){echo('selected');}?>>10</option><option value="11" <?php if($age == '11'){echo('selected');}?>>11</option><option value="12" <?php if($age == '12'){echo('selected');}?>>12</option><option value="13" <?php if($age == '13'){echo('selected');}?>>13</option><option value="14" <?php if($age == '14'){echo('selected');}?>>14</option><option value="15" <?php if($age == '15'){echo('selected');}?>>15</option><option value="16" <?php if($age == '16'){echo('selected');}?>>16</option><option value="17" <?php if($age == '17'){echo('selected');}?>>17</option><option value="18" <?php if($age == '18'){echo('selected');}?>>18</option><option value="19" <?php if($age == '19'){echo('selected');}?>>19</option><option value="20" <?php if($age == '20'){echo('selected');}?>>20</option><option value="21" <?php if($age == '21'){echo('selected');}?>>21</option><option value="22" <?php if($age == '22'){echo('selected');}?>>22</option><option value="23" <?php if($age == '23'){echo('selected');}?>>23</option><option value="24" <?php if($age == '24'){echo('selected');}?>>24</option><option value="25" <?php if($age == '25'){echo('selected');}?>>25</option><option value="26" <?php if($age == '26'){echo('selected');}?>>26</option><option value="27" <?php if($age == '27'){echo('selected');}?>>27</option></select>
    
	<p>Ville : <?php echo ($ville);?></p>
	<input class="monForm" value="<?php echo ($ville);?>" name="ville" id="ville" data-provide="limit" data-counter="#counter"  rows="8"></input>
    
	<p>Sport pratiqué : <?php echo ($sport);?></p>
  
    <input type="checkbox" name="check[]" value="1" <?php if($users['sport'] == '1' || $users['sport'] == '3' || $users['sport'] == '5' || $users['sport'] == '7' || $users['sport'] == '9' || $users['sport'] == '11' || $users['sport'] == '13' || $users['sport'] == '15'){echo('checked');}?>> Skate<br>
	<input type="checkbox" name="check[]" value="2" <?php if($users['sport'] == '2' || $users['sport'] == '3' || $users['sport'] == '6' || $users['sport'] == '7' || $users['sport'] == '10' || $users['sport'] == '11'|| $users['sport'] == '14'|| $users['sport'] == '15'){echo('checked');}?>> Roller<br>
	<input type="checkbox" name="check[]" value="4" <?php if($users['sport'] == '4' || $users['sport'] == '5' || $users['sport'] == '6' || $users['sport'] == '7' || $users['sport'] == '12' || $users['sport'] == '13' || $users['sport'] == '14' || $users['sport'] == '15'){echo('checked');}?>> Bike<br>
	<input type="checkbox" name="check[]" value="8" <?php if($users['sport'] == '8' || $users['sport'] == '9' || $users['sport'] == '10'|| $users['sport'] == '11'|| $users['sport'] == '12'|| $users['sport'] == '13'|| $users['sport'] == '14'|| $users['sport'] == '15'){echo('checked');}?>> Trotinette<br>

    <p>Ton niveau : <?php echo ($sport_level);?></p>
    <select class="monForm" value="<?php echo ($sport_level);?>" name="sport_level" id="sport_level" data-provide="limit" data-counter="#counter"  rows="8"><option value="noob" <?php if($sport_level == 'noob'){echo('selected');}?>>noob</option><option value="intermediaire" <?php if($sport_level == 'intermediaire'){echo('selected');}?>>intermediaire</option><option value="pro" <?php if($sport_level == 'pro'){echo('selected');}?>>pro</option><option value="star" <?php if($sport_level == 'star'){echo('selected');}?>>star</option></select>
 
	<p>Inscrit le <?php echo ($date_register);?></p>

         				  <button id="submit_edit" name="submit_edit" type="submit">Valider les modifs</button></p>
                        </form>
</div>
</body>
</html>
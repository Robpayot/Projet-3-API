<!doctype html>
<?php
session_start();  
if (!isset($_SESSION['login'])) { 
   header ('Location: index.php'); 
   exit();  
}
else{
	
	
	
}
?>
<html>
<head>
<title>Espace membre</title>
<script type="text/javascript" src="JS/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="JS/search.js"></script>
<script type="text/javascript" src="JS/listeDmd.js"></script>
</head>
 
<body>
Bienvenue <?php echo htmlentities(trim($_SESSION['login'])); ?>!<br />
<img src="<?php echo $_SESSION['photo']?>" alt="photo de profil" width="20%" height="20%"/>
<div class="champR">
 <input type="text" id="recherche" name="recherche" required >
 </div>
 <div class="affichageR" id="resultat">
 </div>
 
 <div class="demandesAmi" id="dmd">

 </div>
 <a href="edit-profil.php">Modifier mon profil</a> <br />

<a href="deconnexion.php">Déconnexion</a>
</body>
</html> 
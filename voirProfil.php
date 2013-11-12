<?php
session_start(); 
$_SESSION['profilVisite']=$_GET["profil"]; 
if (!isset($_SESSION['login'])) { 
   header ('Location: index.php'); 
   exit();  
}  
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Voir profil</title>
<script type="text/javascript" src="JS/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="JS/search.js"></script>
<script type="text/javascript" src="JS/dmdAmi.js"></script>
</head>

<body>
Profil de <?php echo $_GET["profil"] ?>!<br />
<div class="champR">
 <input type="text" id="recherche" name="recherche" required >
 </div>
 <div class="affichageR" id="resultat">
 </div>
 <input type="button" id="dmdAmi" name="dmdAmi" value="suivre" >
  <div class="affichageR" id="ami">
 </div>
<a href="deconnexion.php">Déconnexion</a>
</body>
</html>
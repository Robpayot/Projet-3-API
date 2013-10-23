<!doctype html>
<?php
session_start();  
if (!isset($_SESSION['login'])) { 
   header ('Location: index.php'); 
   exit();  
}  
?>
<html>
<head>
<title>Espace membre</title>
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="js/search.js"></script>
</head>
 
<body>
Bienvenue <?php echo htmlentities(trim($_SESSION['login'])); ?>!<br />
<div class="champR">
 <input type="text" id="recherche" name="recherche" required >
 </div>
 <div class="affichageR" id="resultat">
 </div>

<a href="deconnexion.php">Déconnexion</a>
</body>
</html> 
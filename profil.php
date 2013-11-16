<html lang="fr">
<?php
session_start();  
if (!isset($_SESSION['login'])) { 
   header ('Location: index.php'); 
   exit();  
}
else{
require_once("gestionProfil.php");	
	
	
}
?>
<head>
<meta charset="utf-8"> 
<link rel="stylesheet" href="css/reset.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script src="js/modernizr.js" type="text/javascript"></script>
<script type="text/javascript" src="js/search.js"  charset="UTF-8"></script>
<title>Grab-In</title>
</head>
 
<body>
<div id="topbar">
        <div id="topbar-content">
                <h1>Grab-In</h1>
                <ul>
                		<li><a href="profil.php"><?php echo $_SESSION['login']; ?></a></li>
                        <li><div class="champR">
                             <input type="text" id="recherche" name="recherche" placeholder="chercher" required >
                       		</div>
                          </li>
                        <li>Classement</li>
                        <li> <a href="edit-profil.php">Modifier mon profil</a></li>
                        <li><a href="deconnexion.php">Déconnexion</a></li>
                </ul>
        </div>
</div> <!-- end of topbar -->
<div style="height:50px;" ></div>
 <!-- DEBUT MAP -->
<div class="affichageR" id="resultat"></div>
<div class="demandesAmi" id="dmde"></div>
<div class="Amis" id="AmisT"></div>
<p><input type="button" id="find" onClick="findLocation()" value="check in"> </p>
<p id="statut"></p> <!-- Affichage erreurs -->
<div id="map-canvas" style="height:665px; width:100%; " ></div> <!-- Affichage de la map -->
<!-- FIN MAP -->
<div id="userbar">
        <div id="userbar-content">
                <img src="<?php echo $avatar?>" alt="Bam Margera"/>
                <div id="identity">
                        <h2><?php echo htmlentities($pseudo); ?> <img src="imgs/skate.png" alt="Skate"/></h2>
                        <p><?php echo $age?> ans</p>
                        <p>ville: <?php echo $ville?></p>
                        <p>1234 pts.</p>
                        
                </div>
                <div><p id="status">&#171;<?php echo $statut ?>!&#187;</p></div> 
                <input type="text" id="newStatut" name="newStatut" placeholder="Exprime toi !" required >
				<input type="button" id="envoiStatut" name="envoiStatut" value="POSTER" class="button"/>
                
                <form action="profil.php" enctype="multipart/form-data" method="post">
                <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
     <p>Poster une photo : <input type="file" name="url" id="url"></p>
     		<input name="email" id="email" data-provide="limit" data-counter="#counter"  rows="8"></input>
             <button id="submit_photo" name="submit_photo" type="submit">Valider</button></p>
                </form> 
                <?php foreach ($urls as $url):
?>
                <img alt="image photo ici" src="<?php 
echo $url['url'];
	?>">
    <?php endforeach; ?>
    <?php foreach ($descriptions as $description):
?>

    <p><?php echo $description['description'];?></p>
    
   <?php endforeach; ?>

                <div id="cal">
                        <div id="cal-shadow-1"></div>
                        <div id="cal-shadow-2"></div>
                        <div><img src="imgs/cal.png" alt="Calendrier"/></div>
                </div>
        </div>
</div>







<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL6jbConOc2cMBNepwDNA0l_lqrNOaRPI&sensor=true"></script><!-- API Google Maps-->
<script type="text/javascript" src="js/map.js"></script>
<script type="text/javascript" src="js/classeProfil.js"></script>
<script type="text/javascript" src="js/ProfilUser.js"></script>
</body>
</html> 
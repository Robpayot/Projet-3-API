<html lang="fr">
<?php
session_start();  
if (!isset($_SESSION['login'])) { 
   header ('Location: index.php'); 
   exit();  
}
else{
require_once("gestionProfil.php");	
	
require 'header.php' ;
require 'topbar.php' ;
}
?>
<div style="height:50px;" ></div>
 <!-- DEBUT MAP -->
<div class="affichageR" id="resultat"></div>
<div class="demandesAmi" id="dmde"></div>
<div class="Amis" id="AmisT"></div>
<div id="map-section">
  <p><input type="button" id="find" onClick="findLocation()" value="check in"> <input type="date" max="2015-06-25" min="2013-08-13" value="2013-11-13" id="date" onChange="changeDate()" > <input type="time" id="hour" value="15:00" onChange="changeHour()"> </p>
  <form id="geocoder">
    <input type="text" id="address" name="address" placeholder="Recherche un lieu" />
  </form>
  <p id="statut"></p> <!-- Affichage erreurs -->
  <div id="map-canvas" style="height:665px; width:100%; " ></div> <!-- Affichage de la map -->
</div>
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
                <img alt="image photo ici" src="<?php 
echo ($url);
	?>">
    <p><?php echo ($description);?></p>

                <div id="cal">
                        <div id="cal-shadow-1"></div>
                        <div id="cal-shadow-2"></div>
                        <div><img src="imgs/cal.png" alt="Calendrier"/></div>
                </div>
        </div>
</div>




<?php
require 'footer.php' ;
?> 


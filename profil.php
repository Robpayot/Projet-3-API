<?php
session_start();  
if (!isset($_SESSION['login'])) { 
   header ('Location: index.php'); 
   exit();  
}
else{
require_once("gestionProfil.php");	

}
require 'header.php' ;
require 'topbar.php' ;
?>
<div style="height:50px;" ></div>
 <!-- DEBUT MAP -->
<div class="affichageR" id="resultat"></div>
<div class="demandesAmi" id="liste"></div>
<div class="Amis" id="AmisT"></div>
<div id="map-section">
  <?php if(isset($_SESSION['login'])) {?><p><input type="button" id="find" onClick="findLocation()" value="check in"><?php } ?>
  <input type="date" max="2015-06-25" min="2013-08-13" id="date" onChange="changeDate()" >
  <input type="time" id="hour" onChange="changeHour()"> </p>
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

                <div id="cal">
                        <div id="cal-shadow-1"></div>
                        <div id="cal-shadow-2"></div>
                        <div><img src="imgs/cal.png" alt="Calendrier"/></div>
                </div>
        </div>
</div>


                <input type="text" id="newStatut" name="newStatut" placeholder="Exprime toi !" required >
        <input type="button" id="envoiStatut" name="envoiStatut" value="POSTER" class="button"/>
                
                <form action="profil.php" enctype="multipart/form-data" method="post">
                <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
     <p>Poster une photo : <input type="file" name="url" id="url" required></p>
        <input name="description" id="description" data-provide="limit" data-counter="#counter"  rows="8" required></input>
             <button id="submit_photo" name="submit_photo" type="submit">Valider</button></p>
                </form> 
                <form action="profil.php" enctype="multipart/form-data" method="post">
                <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
    <p> Ou une vidéo : <input type="file" name="url" id="url" required></p>
        <input name="description" id="description" data-provide="limit" data-counter="#counter"  rows="8" required></input>
             <button id="submit_video" name="submit_video" type="submit">Valider</button></p>
                </form> 
                   
<?php foreach ($media as $medias): ?>
                <img alt="<?php echo $medias['description'];?>" src="<?php echo $medias['url'];?>">
                      <p><?php echo $medias['description'];?></p>
                      <form action='profil.php' method="POST">
        <button id="delete_media<?=$medias['id']?>" name="delete_media<?=$medias['id']?>" type="submit">Supprimer la photo</button>
                </form>
<?php endforeach; ?>


<div id="video-section">
  <div id="button" class="pause">
    <span></span>
  </div>
  <video id="video" preload="none">
    <source src="videos/v06-07_ld.mp4" type='video/mp4' >
    <p>Your user agent does not support the HTML5 Video element.</p>
  </video>
  <div id="progressBar">
    <span class="progress"></span>
    <span class="buffer"></span>
  </div>
  <div id="duration"><p>00:00</p></div>
  <div id="current"><p>00:00</p></div>
  <button type="button" id="mute">Mute</button>
  <input type="range" id="volume-bar" min="0" max="1" step="0.1" value="1">
  <button type="button" id="full-screen">Full-Screen</button>
</div>


<?php
require 'footer.php' ;
?> 


<?php
session_start(); 

 
if (!isset($_SESSION['login'])) { 
   header ('Location: index.php'); 
   exit();  
}
else{
$_SESSION['profilVisite']=$_GET["profil"]; 
$_SESSION['IDprofilVisite']=$_GET["key"];
require_once("gestionProfilVisite.php");	
}  
require 'header.php' ;
require 'topbar.php' ;
?>

<div style="height:50px;" ></div>
 <!-- DEBUT MAP -->
<div class="affichageR" id="resultat"></div>
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
                <img src="<?php echo $avatarV?>" alt="<?php echo htmlentities($pseudoV); ?>"/>
                <div id="identity">
                        <h2><?php echo htmlentities($pseudoV); ?> <img src="imgs/skate.png" alt="Skate"/></h2>
                        <?php if($age>0) {?>
                        <p><?php echo $age?> ans</p>
                        <? }?>
                         <?php if($ville!=null) {?>
                        <p>ville: <?php echo $ville?></p>
                        <? }?>
                        <p><?php echo $scoreV."pts"?></p>
                        
                        <div id="subscribe"><input type="button" id="dmdAmi" name="dmdAmi" value="suivre" ></div>
                </div>
                <p id="status"><?php echo "&#171;".utf8_encode($statut)."!&#187;" ?> </p> 

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


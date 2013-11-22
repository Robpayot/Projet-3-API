<?php 
session_start();  
if (isset($_SESSION['login'])) { 
   header ('Location: profil.php'); 
   exit();  
}
require 'header.php' ;
require 'topbar.php' ;
?>



 <!-- DEBUT MAP -->
<div id="map-section">
  <p><input type="date" max="2015-06-25" min="2013-08-13" id="date" onChange="mapObj.changeDate()" >
  <input type="time" id="hour" onChange="mapObj.changeHour()"> </p>
  <form id="geocoder">
    <input type="text" id="address" name="address" placeholder="Recherche un lieu" />
  </form>
  <p id="statut"></p> <!-- Affichage erreurs -->
  <div id="map-canvas" ></div> <!-- Affichage de la map -->
</div>
<!-- FIN MAP -->


<?php
require 'footer.php' ;
?>

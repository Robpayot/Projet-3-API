<?php 
session_start();  
if (isset($_SESSION['login'])) { 
   header ('Location: profil.php'); 
   exit();  
}
require 'header.php' ;
require 'topbar.php' ;
?>

<!-- pop in d'accueil -->
<div id="home-popin">
	<div>
		<img src="imgs/home-logo-white.png" alt="Grab-In!"/>
	</div>
	<div>
		<p class="popin-title">Bienvenue,</p>
		<p>Grab-In! est un site communautaire qui permet aux riders de se rencontrer et de se retrouver sur les meilleurs spots pour partager leur passion.</p>
		<div id="popin-btn" class="transition200io" onclick="getDropDownDown('connexion-dropdown'), getOffDesktop('home-popin')">Let's ride!</div>
	</div>
</div> <!-- end of popin-->


 <!-- DEBUT MAP -->
<div class="home" id="map-section">
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

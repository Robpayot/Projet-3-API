<?php 
require 'header.php' ;
require 'topbar.php' ;
?>



<div style="height:50px;" ></div>
 <!-- DEBUT MAP -->
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



<?php
require 'footer.php' ;
?>

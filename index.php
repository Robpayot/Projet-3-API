<?php 
require 'header.php' ;
require 'topbar.php' ;
?>



<div style="height:50px;" ></div>
 <!-- DEBUT MAP -->
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
		<img src="imgs/bam.png" alt="Bam Margera"/>
		<div id="identity">
			<h2>Bam Margera <img src="imgs/skate.png" alt="Skate"/></h2>
			<p>23 ans</p>
			<p>Paris</p>
			<p>1234 pts.</p>
			<div id="subscribe">s'abonner</div>
		</div>
		<p id="status">&#171;Bon, il faut encore que je travaille mes réceptions, mais je rentre le Backflip !&#187;</p> 
		<div id="cal">
			<div id="cal-shadow-1"></div>
			<div id="cal-shadow-2"></div>
			<div><img src="imgs/cal.png" alt="Calendrier"/></div>
		</div>
	</div>
</div>
<div id="profile-content">
</div>


<?php
require 'footer.php' ;
?>

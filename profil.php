<?php
session_start();  
if (!isset($_SESSION['login'])) { 
   header ('Location: index.php'); 
   exit();  
}
else{
require("gestionProfil.php");	
require_once("meteo.php");	

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
  <p id="map-status"></p> <!-- Affichage erreurs -->
  <div id="map-canvas" ></div> <!-- Affichage de la map -->
</div>
<!-- FIN MAP -->
<div id="userbar">
        <div id="userbar-content">
                <img src="<?php echo $avatar?>" alt="<?php echo htmlentities($pseudo); ?>"/>
                <div id="identity">
                        <h2><?php echo htmlentities($pseudo); ?> <img src="imgs/skate.png" alt="Skate"/></h2>
                        <?php if($age>0) {?>
                        <p><?php echo $age?> ans</p>
                        <? }?>
                         <?php if($ville!=null) {?>
                        <p>ville: <?php echo $ville?></p>
                        <? }?>
                        <p><?php echo $score."pts"?></p>

                        
                </div>
                <div id="statut">
                  <p id="status"><?php echo "&#171;".$statut."!&#187;" ?> </p> 
                  <p><input type="text" id="newStatut" name="newStatut" placeholder="Nouveau statut" required ><br>
                  <input type="button" id="envoiStatut" name="envoiStatut" value="Exprime-toi !" class="button"/></p>
                </div>
                <div id="cal">
                        <div id="cal-shadow-1"></div>
                        <div id="cal-shadow-2"></div>
                        <div id="weather">
                            <span>Météo</span>
                            <span>Paris</span>
                            <span><?php echo $temperature ?></span>
                            <img src="imgs/meteo_grabin/<?php echo $codeImg ?>.png"/>
                        </div>
                </div>
        </div>
</div>
<div id="profile-content">
<p id="checkin-btn"><input type="button" id="find" onClick="findLocation()" value="check in"></p>
  <h3>Tes prochains checkins</h3>

  <div id="list-checkins"></div>

<h3 class="inline-block">Photos et vidéos</h3>

<a href="#" class="poster-media" onclick="return afficher_cacher('poster-photo');">Poster une photo</a>
<a href="#" class="poster-media" onclick="return afficher_cacher('poster-video'); ">Poster une vidéo</a>

<div id="poster-photo" class="upload-media" style="display:none">
  <form action="profil.php" enctype="multipart/form-data" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
    <p><label for="url">Votre photo : </label><input type="file" name="url" id="url" required></p>
    <p><label for="description">Description : </label><input name="description" id="description" data-provide="limit" data-counter="#counter" ></p>
    <button id="submit_photo" name="submit_photo" type="submit">Valider</button></p>
  </form> 
</div>

<div id="poster-video" class="upload-media" style="display:none">
  <form action="profil.php" enctype="multipart/form-data" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
    <p><label for="url">Votre vidéo (fichiers mp4 et ogg) :</label> <input type="file" name="url" id="url" required></p>
    <p><label for="description">Description : </label><input name="description" id="description" data-provide="limit" data-counter="#counter" ></p>
    <p><button id="submit_video" name="submit_video" type="submit">Valider</button></p>
  </form> 
</div>

  <div id="medias">
    <!--// Gallery Markup: A container that the plugin is called upon, and two lists for the images (use images with same aspect ratio) //-->
    <div id="gallery-container">
      <ul class="items--small">
        <?php foreach ($url as $urls): ?>
          <li class="item"><a href="#"><img src="<?php echo $urls['url'];?>" alt="<?php echo $urls['description'];?>" /></a>
          <form action='profil.php' method="POST" >
            <button class="delete_media" name="delete_media<?=$urls['id']?>" type="submit">Supprimer la photo</button>
          </form>
          </li>
        <?php endforeach; ?>
      </ul>
      <ul class="items--big">
        <?php foreach ($url as $urls): ?>
          <li class="item--big">
            <a href="#">
              <figure>
                <img src="<?php echo $urls['url'];?>" alt="" />
                <figcaption class="img-caption">
                  <?php echo $urls['description'];?>
                </figcaption>
              </figure>
              </a>
          </li>
        <?php endforeach; ?>
      </ul>
      <div class="controls">
        <span class="control icon-arrow-left" data-direction="previous"></span> 
        <span class="control icon-arrow-right" data-direction="next"></span> 
        <span class="grid icon-grid"></span>
        <span class="fs-toggle icon-fullscreen"></span>
      </div>
    </div><!-- end #gallery-container-->    
    <div id="video-section">
      <?php if (empty($url_vid)){}else{ ?>
      <div id="button" class="pause">
        <span></span>
      </div>
      <video id="video" preload="none">
        <source src="<?php echo $url_vid; ?>" type='video/mp4' >
        <p>Your user agent does not support the HTML5 Video element.</p>
      </video>
      <div id="progressBar">
        <span class="progress"></span>
        <span class="buffer"></span>
      </div>
      <div id="duration"></div>
      <div id="current"></div>
      <button type="button" id="mute">Mute</button>
      <input type="range" id="volume-bar" min="0" max="1" step="0.1" value="1">
      <button type="button" id="full-screen">Full-Screen</button>
      <?php } ?>
    </div> <!-- end #video-section-->

    <div class="clear-float"></div>
  </div> <!-- end #medias-->




</div> <!-- end #profile-content-->



                
                   




<?php
require 'footer.php' ;
?> 


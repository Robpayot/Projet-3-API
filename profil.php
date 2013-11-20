<?php
session_start();  
if (!isset($_SESSION['login'])) { 
   header ('Location: index.php'); 
   exit();  
}
else{
require_once("gestionProfil.php");	
require_once("meteo.php");	

}
require 'header.php' ;
require 'topbar.php' ;

?>
 <!-- DEBUT MAP -->


<div id="map-section">
  <?php if(isset($_SESSION['login'])) {?><p><input type="button" id="find" onClick="findLocation()" value="check in"><?php } ?>
  <input type="date" max="2015-06-25" min="2013-08-13" id="date" onChange="changeDate()" >
  <input type="time" id="hour" onChange="changeHour()"> </p>
  <form id="geocoder">
    <input type="text" id="address" name="address" placeholder="Recherche un lieu" />
  </form>
  <p id="statut"></p> <!-- Affichage erreurs -->
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
                <div><p id="status">&#171;<?php echo $statut ?>!&#187;</p></div> 

                <div id="cal">
                        <div id="cal-shadow-1"></div>
                        <div id="cal-shadow-2"></div>
                        <div><p>Température:<?php echo $temperature ?></p>
                        	<p>Code Image:<?php echo $codeImg ?></p>
                        </div>
                </div>
        </div>
</div>
<div id="profile-content">


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
    <p> Ou une vidéo (fichiers mp4 et ogg) : <input type="file" name="url" id="url" required></p>
        <input name="description" id="description" data-provide="limit" data-counter="#counter"  rows="8" required></input>
             <button id="submit_video" name="submit_video" type="submit">Valider</button></p>
                </form> 


  <div id="medias">
    <!--// Gallery Markup: A container that the plugin is called upon, and two lists for the images (use images with same aspect ratio) //-->
    <div id="gallery-container">
      <ul class="items--small">
        <?php foreach ($media as $medias): ?>
          <li class="item"><a href="#"><img src="<?php echo $medias['url'];?>" alt="<?php echo $medias['description'];?>" /></a></li>
          <form action='profil.php' method="POST" style="display:none">
            <button id="delete_media<?=$medias['id']?>" name="delete_media<?=$medias['id']?>" type="submit">Supprimer la photo</button>
          </form>
        <?php endforeach; ?>
      </ul>
      <ul class="items--big">
        <?php foreach ($media as $medias): ?>
          <li class="item--big">
            <a href="#">
              <figure>
                <img src="<?php echo $medias['url'];?>" alt="" />
                <figcaption class="img-caption">
                  <?php echo $medias['description'];?>
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
      <?php
        if (empty($medias['url_vid'])){
        }else{
       ?>
      <div id="button" class="pause">
        <span></span>
      </div>
      <video id="video" preload="none">
        <?php foreach ($media as $medias):
          $url_vid = $medias['url_vid'];
          endforeach;  ?>
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


  </div> <!-- end #medias-->
<img src="http://l.yimg.com/a/i/us/we/52/<?php echo $codeImg ?>.gif"/>



</div> <!-- end #profile-content-->



                
                   




<?php
require 'footer.php' ;
?> 


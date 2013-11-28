<?php
session_start();
$_SESSION['profilOuNon']=1;  
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
  <p>
    <input type="date" max="2015-06-25" min="2013-08-13" id="date" onChange="mapObj.changeDate()" >
    <input type="time" id="hour" onChange="mapObj.changeHour()"> 
  </p>
  <form id="geocoder">
    <input type="text" id="address" name="address" placeholder="Rechercher un lieu" />
  </form>
  <p id="map-status"></p> <!-- Affichage erreurs -->
  <div id="map-canvas"></div> <!-- Affichage de la map -->
</div>
<!-- FIN MAP -->
<div id="userbar">
  <div id="userbar-content">
    <img id="profile-picture" src="<?php echo $avatar?>" alt="<?php echo htmlentities($pseudo); ?>"/>
    <div id="identity">
      <h2><?php echo htmlentities($pseudo); ?><span id="iconSports"><?php echo $iconSports; ?></span></h2>
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
      <p>
        <input type="text" id="newStatut" name="newStatut" placeholder="Nouveau statut" required ><br>
        <input type="button" id="envoiStatut" name="envoiStatut" value="Exprime-toi !" class="button pointer"/>
      </p>
    </div>
    <div id="cal" class="desktop-only">
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
  <div id="wax">
    <div id="checkin-btn" class="mobile-only"><a href="#map-section" id="find">Check in !</a></div>
    
    <h3>Tes checkins</h3>

    <div id="list-checkins"></div>
    <div class="clear-float"></div>

    <h3 class="inline-block">Photos et vidéos</h3>

    <a href="#" class="poster-media" onclick="return afficher_cacher('poster-photo');">Poster une photo</a>
    <a href="#" class="poster-media" onclick="return afficher_cacher('poster-video'); ">Poster une vidéo</a>


    <div id="poster-photo" class="upload-media" style="display:none">
        <?php if ($nbUrl<9) { ?>
      <form action="profil.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
        <p><label for="url">Votre photo : </label><input type="file" name="url" id="url" required></p>
        <p><label for="description">Description : </label><input name="description" id="description" data-provide="limit" data-counter="#counter" ></p>
        <button id="submit_photo" name="submit_photo" type="submit" class="pointer">Valider</button></p>
      </form> 
          <?php } else { ?>
    <p>Vous ne pouvez pas poster plus de 9 photos ! Veuillez en supprimer pour en charger de nouvelles</p>
    <?php } ?>
    </div>

	
	

    <div id="poster-video" class="upload-media" style="display:none">
    <?php if($nbUrl_vid<1) { ?>
      <form action="profil.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
        <p><label for="url">Votre vidéo (fichiers mp4 et ogg) :</label> <input type="file" name="url" id="url" required></p>
        <p><label for="description">Description : </label><input name="description" id="description" data-provide="limit" data-counter="#counter" ></p>
        <p><button id="submit_video" name="submit_video" type="submit" class="pointer">Valider</button></p>
      </form> 
      <?php } else { ?>
      <p>Vous ne pouvez pas poster plus d'une vidéo ! Veuillez la supprimer pour en charger une autre</p>
      <?php } ?>
    </div>
     
    
    
    
    <div id="medias">
      <!--// Gallery Markup: A container that the plugin is called upon, and two lists for the images (use images with same aspect ratio) //-->
      <?php if (empty($url)){
      }else {  
        ?>
        <div <?php if (empty($url_vid)){?>style="float:none; width:62%"<?php } ?> id="gallery-container" >
          <ul class="items--small">
            <?php foreach ($url as $urls): ?>
            <li class="item"><a href="#"><img src="<?php echo $urls['url'];?>" alt="<?php echo $urls['description'];?>" /></a>
            </li>
          <?php endforeach; ?>
        </ul>
        <ul class="items--big">
          <?php foreach ($url as $urls): ?>
          <li class="item--big">
              <figure>
                <img src="<?php echo $urls['url'];?>" <?php if (empty($url_vid)){?>style="margin: 0 auto; width:62%"<?php } ?> alt="" />
                <?php if($urls['description']!=""){ ?>
                <figcaption class="img-caption">
                  <?php echo $urls['description'];?>
                </figcaption>
                <?php } ?>
              </figure>
          </li>
        <?php endforeach; ?>
      </ul>
      <div class="controls">
        <span class="control icon-arrow-left" data-direction="previous"></span> 
        <span class="control icon-arrow-right" data-direction="next"></span> 
        <span class="grid icon-grid"></span>
      </div>
    </div><!-- end #gallery-container--> 
    <?php } ?>   
    <?php if (empty($url_vid)){ }else{ 
	?>
    <div <?php if (empty($url)){?>style="float:none; position:absolute; left:25%;"<?php } ?> id="video-section" >

      <div id="button" class="play">
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
      </div> <!-- end #video-section-->
      <?php } ?>

      <div class="clear-float"></div>
    </div> <!-- end #medias-->

    <?php if (empty($url) && empty($url_vid)){}
    else{ ?>
    <div id="edit-media"><!--edit medias-->
      <h4>Gestion de tes médias</h4>
      <?php if (empty($url)){}else { ?>
       <ul>
         <?php foreach ($url as $urls): ?>
         <li><img src="<?php echo $urls['url'];?>" alt="<?php echo $urls['description'];?>" />
           <form action='profil.php' method="POST" >
             <button class="delete_media" name="delete_media<?=$urls['id']?>" type="submit">Supprimer cette photo</button>
           </form>
         </li>
       <?php endforeach; ?>
     </ul>
     <?php }
     if (empty($url_vid)){}else{ ?>
     <form action='profil.php' method="POST" >
       <button class="delete_media" name="delete_media<?=$url_vid?>" type="submit">Supprimer la vidéo</button>
     </form>
     <?php } ?>
   </div><!--end edit medias-->
   <?php } ?>

  </div> <!-- end of wax -->
</div> <!-- end #profile-content-->



 <?php
 require 'footer.php' ;
 ?> 


<?php
session_start(); 
$_SESSION['profilOuNon']=0;
 
if (!isset($_SESSION['login'])) { 
   header ('Location: index.php'); 
   exit();  
}
else{
$_SESSION['profilVisite']=$_GET["profil"]; 
$_SESSION['IDprofilVisite']=$_GET["key"];
require_once("gestionProfilVisite.php");	
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
    <input type="text" id="address" name="address" placeholder="Rechercher un lieu" />
  </form>
  <p id="statut"></p> <!-- Affichage erreurs -->
  <div id="map-canvas"></div> <!-- Affichage de la map -->
</div>
<!-- FIN MAP -->
<div id="userbar">
        <div id="userbar-content">
                <img src="<?php echo $avatarV?>" alt="<?php echo htmlentities($pseudoV); ?>"/>
                <div id="identity">
                        <h2><?php echo htmlentities($pseudoV); ?><span id="iconSports"><?php echo $iconSportsV; ?></span></h2>
                        <?php if($ageV>0) {?>
                        <p><?php echo $ageV?> ans</p>
                        <? }?>
                         <?php if($villeV!=null) {?>
                        <p>ville: <?php echo $villeV?></p>
                        <? }?>
                        <p><?php echo $scoreV."pts"?></p>
                        
                        <div id="subscribe"><input type="button" id="dmdAmi" name="dmdAmi" value="S'abonner" ></div>
                </div>
                <div id="statut">
                  <p id="status"><?php echo "&#171;".$statut."!&#187;" ?> </p> 
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
        </div><!-- end userbar content-->
<?php if($amitie==1) { ?>
        <div id="profile-content">
          	<h3>Les checkins de <?php echo $pseudoV ?></h3>
			 <div id="list-checkins"></div>
        <h3>Les médias de <?php echo $pseudoV ?></h3>
          <div id="medias">
    <!--// Gallery Markup: A container that the plugin is called upon, and two lists for the images (use images with same aspect ratio) //-->
    <div <?php if (empty($url_vid)){?>style="float:none; width:62%"<?php } ?> id="gallery-container">
      <ul class="items--small">
        <?php
		
			 foreach ($url as $urls): ?>
          <li class="item"><a href="#"><img src="<?php echo $urls['url'];?>" alt="<?php echo $urls['description'];?>" /></a>
          </li>
        <?php endforeach; ?>
      </ul>
      <ul class="items--big">
        <?php foreach ($url as $urls): ?>
          <li class="item--big">
            <a href="#">
              <figure>
                <img src="<?php echo $urls['url'];?>" <?php if (empty($url_vid)){?>style="margin: 0 auto; width:62%"<?php } ?> alt="" />
                <?php if($urls['description']!=""){ ?>
                <figcaption class="img-caption">
                  <?php echo $urls['description'];?>
                </figcaption>
                <?php } ?>
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
    <div <?php if (empty($url)){?>style="float:none; position:absolute; left:25%;"<?php } ?> id="video-section">
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
        </div><!-- End of #profile-content-->
<?php } ?>
</div>


<?php
require 'footer.php' ;
?> 


<footer><div id="footer-content">Copyright 2013 Grab-In! ©</div></footer>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL6jbConOc2cMBNepwDNA0l_lqrNOaRPI&sensor=true"></script><!-- API Google Maps-->
<script type="text/javascript" src="js/verifConnexion.js"></script>
<?php if ($_SERVER['REQUEST_URI']=='/GRAB-IN/MASTER/index.php' ) { ?> <script type="text/javascript" src="js/mapObjIndex.js"></script><?php }else{ ?><script type="text/javascript" src="js/mapObj.js"></script><?php } ?>
<script type="text/javascript" src="js/classeFormulaire.js"></script>
<script type="text/javascript" src="js/myForm.js"></script>
<script type="text/javascript" src="js/myMap.js"></script>
<script type="text/javascript" src="js/classeProfil.js"></script>
<script type="text/javascript" src="js/ProfilUser.js"></script>
<script type="text/javascript" src="js/ProfilVisite.js"></script>
<script type="text/javascript" src="js/video.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
    $(document).ready(function(){
     $('#gallery-container').sGallery({
        fullScreenEnabled: true
      });
    });
</script>

</body>
</html>
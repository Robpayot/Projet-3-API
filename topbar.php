<div id="topbar">
	<div id="topbar-content">
		<h1>Grab-In</h1>
		<ul>
      <li><div class="champR">
            <input type="text" id="recherche" name="recherche" placeholder="Chercher des Riders" required >
          </div>
      </li>
			<li><img src="imgs/params.png" alt="Edition du profil"/></li>
			<li class="abos"><img src="imgs/abos.png" alt="Confirmer les nouveaux abonnés"/></li>
			<li><a onclick="getDropDownDown('classement-dropdown');">Classement</a></li>
			<li><a href="profil.php"><?php echo $_SESSION['login']; ?></a></li>
      <?php if(isset($_SESSION['login'])) {?>
      <li> <a href="edit-profil.php">Modifier mon profil</a></li>
      <li><a href="deconnexion.php">Déconnexion</a></li>
      <?php } else {?>
			<li><a href="#" onclick="getDropDownDown('connexion-dropdown')">Connexion</a></li>
      <?php } ?>
      
		</ul>
	</div>
</div> <!-- end of topbar -->
<div id="connexion-dropdown" class="dropdown-up">
  <p class="dropdown-title">Connexion</p>
  <a  href="#" class="close" onclick="getDropDownUp('connexion-dropdown')"><img src="imgs/close.png" alt="close"/></a>
  <form autocomplete="off" method='post' action='connexion.php'>
  <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" required>
  <input type="password" placeholder="Mot de passe" id="mdp" name="mdp" required >
  <div id="btn-connexion"><input class="transition200io" type="submit" value="Let's ride" /></div>
  </form>
  <div id="separation">
    <p>ou</p>
  </div>
  <div id="btn-fbco" class="transition200io"><a href="#">Inscription avec Facebook</a></div>
  <a href="#" class="no-account">Pas encore de compte ?</a>
</div> <!-- end of connexion-dropdown -->
<div id="classement-dropdown" class="dropdown-up">
  <p class="dropdown-title">Classement</p>
  <a  href="#" class="close" onclick="getDropDownUp('classement-dropdown')"><img src="imgs/close.png" alt="close"/></a>
  <ul>
  	<li><div class="categ blue"></div><div class="cup goldcup"></div><a href="http://google.fr" class="rider">Rodney-M</a><p class="score">240 pts.</p></li>
  	<li><div class="categ blue"></div><div class="cup silvercup"></div><p class="rider">BMargera</p><p class="score">240 pts.</p></li>
  	<li><div class="categ red"></div><div class="cup bronzecup"></div><p class="rider">Jean-Valjean</p><p class="score">240 pts.</p></li>
  	<li><div class="categ blue"></div><div class="cup"></div><p class="rider">Antoine</p><p class="score">240 pts.</p></li>
  	<li><div class="categ yellow"></div><div class="cup"></div><p class="rider">Marion</p><p class="score">240 pts.</p></li>
  	<li><div class="categ red"></div><div class="cup"></div><p class="rider">Sophine</p><p class="score">240 pts.</p></li>
  	<li><div class="categ blue"></div><div class="cup"></div><p class="rider">Robinbin</p><p class="score">240 pts.</p></li>
  	<li><div class="categ blue"></div><div class="cup"></div><p class="rider">Rominems</p><p class="score">240 pts.</p></li>
  	<li><div class="categ yellow"></div><div class="cup"></div><p class="rider">Christine-Boutin</p><p class="score">240 pts.</p></li>
  	<li><div class="categ red"></div><div class="cup"></div><p class="rider">Spiderman</p><p class="score">240 pts.</p></li>
  </ul>
</div> <!-- end of classement-dropdown -->



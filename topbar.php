<div id="topbar">
	<div id="topbar-content">
		<h1>Grab-In</h1>
		<ul><?php if(isset($_SESSION['login'])) {?>
      <li><div class="champR">
            <input type="text" id="recherche" name="recherche" placeholder="Chercher des Riders" required >
          </div>
      </li>
      
			<li><a href="edit-profil.php"><img src="imgs/params.png" alt="Edition du profil"/></a></li>
      <li><a href="#" onclick="getDropDownDown('amis-dropdown');"><img src="imgs/friends.png" alt="Liste d'amis"/></a></li>
			<li class="abos"><a href="#" onclick="getDropDownDown('abonnes-dropdown');"><img src="imgs/abos.png" alt="Confirmer les nouveaux abonnés"/></a></li>
			<li><a  href="#" onclick="getDropDownDown('classement-dropdown');">Classement</a></li>
			<li><a href="profil.php"><?php echo $_SESSION['login']; ?></a></li>
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
  <div id="btn-fbco" class="transition200io"><a onclick="getDropDownDown('inscription-fb-dropdown')">Inscription avec Facebook</a></div>
  <a href="inscription.php" class="no-account">Pas encore de compte ?</a>
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
<div id="inscription-fb-dropdown" class="dropdown-up">
  <p class="dropdown-title">Inscription avec Facebook</p>
  <a  href="#" class="close" onclick="getDropDownUp('inscription-fb-dropdown')"><img src="imgs/close.png" alt="close"/></a>
  <ul>
    <li class="l-field"><p class="field-desc">Pseudo</p><input class="l-text-field" type="text" id="pseudo" name="pseudo" required></li>
    <li class="l-field"><p class="field-desc">Mot de passe</p><input class="l-text-field" type="text" id="mdp" name="mdp" required></li>
    <li class="l-field check"><p class="field-desc">Confirm. Mdp</p><input class="l-text-field" type="text" id="conf-mdp" name="conf-mdp" required><img src="imgs/check.png" alt="bon"/></li>
    <li class="xl-field spaced"><p class="field-desc">Sport pratiqué</p>
      <ul class="sports-checkboxes">
        <li><input type="checkbox" name="bmx" value="bmx">BMX</li>
        <li><input type="checkbox" name="longboard" value="longboard">Longboard</li>
        <li><input type="checkbox" name="roller" value="roller">Roller</li>
        <li><input type="checkbox" name="skate" value="skate">Skate</li>
        <li><input type="checkbox" name="trotinette" value="trotinette">Trotinette</li>
      </ul>
    </li>
    <li class="l-field"><p class="field-desc">Niveau</p>
      <FORM id="niveau">
        <SELECT name="niveau" size="1">
          <OPTION>Débutant
          <OPTION>Amateur
          <OPTION>Confirmé
          <OPTION>Expert
          <OPTION>Pro
        </SELECT>
      </FORM>
    </li>
    <li class="l-field spaced send"><a href="#"><p class="field-send">Envoyer</p></a></li>
  </ul>
</div> <!-- end of inscription-fb-dropdown -->
<div id="abonnes-dropdown" class="dropdown-up">
  <p class="dropdown-title">Demandes d'amitié</p>
  <a  href="#" class="close" onclick="getDropDownUp('abonnes-dropdown')"><img src="imgs/close.png" alt="close"/></a>
  <div id="liste-abonnes">
    <!--PHP GOES HERE-->
  </div>
</div> <!-- end of abonnes-dropdown -->
<div id="amis-dropdown" class="dropdown-up">
  <p class="dropdown-title">Amis</p>
  <a  href="#" class="close" onclick="getDropDownUp('amis-dropdown')"><img src="imgs/close.png" alt="close"/></a>
  <div id="liste-amis">
    <!--PHP GOES HERE-->
  </div>
</div> <!-- end of amis-dropdown -->



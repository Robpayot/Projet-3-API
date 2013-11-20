  <?php require'facebook_connect.php'; ?>
<?php //_________________RÉCUPÉRATION DES DONNEES USER_________________//
require 'config.php';
require 'recup.php';


	//________________________LORS DU SUBMIT _______________________________	
		
	if(isset($_POST['submit_edit'])) {
	require 'edit-profil.php';
	}
//_________________SUPPRESSION DU COMPTE_________________//
	
		
	if ( isset($_POST['submit_delete']) ) 
	{
		echo "<script>alert('Voulez-vous vraiment supprimer votre compte Grab\'in ?');</script>"; 
		//unlink($avatar);
		$dbh -> query("DELETE FROM grabin_user WHERE id='".$id_user."'" );
		
		
	}
	
		
		?>
<div id="topbar">
	<div id="topbar-content">
		<h1>Grab-In</h1>
		<ul><?php if(isset($_SESSION['login'])) {?>
      <li>
        <div class="champR">
          <input type="text" id="recherche" name="recherche" onfocus="displayResults()" onblur="hideResults()" placeholder="Chercher des Riders" required>
        </div>
        <div class="affichageR" id="resultat"></div>
      </li>
       
			<li><a href="#" onclick="getDropDownDown('profiledit-dropdown')"><img src="imgs/params.png" alt="Edition du profil"/></a></li>
      <li><a href="#" onclick="getDropDownDown('amis-dropdown');" id="voirAmis"><img src="imgs/friends.png" alt="Liste d'amis"/></a></li>
			<li class="abos"><a href="#" onclick="getDropDownDown('abonnes-dropdown');" id="voirDemandes"><img src="imgs/abos.png" id="imgDmd" alt="Confirmer les nouveaux abonnés"/></a></li>
			<li><a href="#" onclick="getDropDownDown('classement-dropdown');">Classement</a></li>
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
  <input type="text" id="pseudoConnexion" name="pseudo" placeholder="Pseudo" required>
  <input type="password" placeholder="Mot de passe" id="mdpConnexion" name="mdp" required ><img id="imgVerifC" src="imgs/fail.png" alt="Erreur de saisie"/>
  <div id="btn-connexion"><input class="transition200io" type="submit" value="Let's ride" /></div>
  </form>
  <div id="separation">
    <p>ou</p>
  </div>
  <div id="btn-fbco" class="transition200io"><a onclick="getDropDownDown('inscription-fb-dropdown')">Inscription avec Facebook</a></div>
  <a href="#" onclick="getDropDownDown('inscription-dropdown')" class="no-account">Pas encore de compte ?</a>
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
<div id="inscription-dropdown" class="dropdown-up">
  <p class="dropdown-title">Inscription</p>
  <a  href="#" class="close" onclick="getDropDownUp('inscription-dropdown')"><img src="imgs/close.png" alt="close"/></a>
 
  <form autocomplete="off" method='post' action='sinscrire.php'>
  <ul>
    
    <li class="l-field"><p class="field-desc">Prénom</p><input class="l-text-field" type="text" id="prenom" name="prenom" required></li>
    <li class="l-field"><p class="field-desc">Nom</p><input class="l-text-field" type="nom" id="nom" name="nom" required></li>
    <li class="l-field"><p class="field-desc">Pseudo</p><input class="l-text-field" type="pseudo" id="pseudo" name="pseudo" required></li>
    <li class="l-field spaced"><p class="field-desc">Mot de passe</p><input class="l-text-field" type="password" id="mdp" name="mdp" required></li>
    <li class="l-field check"><p class="field-desc">Confirm. Mdp</p><input class="l-text-field" type="password" id="retape_mdp" name="retape_mdp" required><img src="imgs/fail.png" alt="bon" id="imgVerif"/></li>
    <li class="l-field"><p class="field-desc">E-mail</p><input class="l-text-field" type="email" id="email" name="email" required></li>
  <div class="verifMatchMdp" id="verifMatchMdp"></div> 
   <li class="xl-field spaced"><p class="field-desc">Sport pratiqué</p>
      <ul class="sports-checkboxes">
        <li><input type="checkbox" name="check[]" value="1">Skate</li>
        <li><input type="checkbox" name="check[]" value="2">Roller</li>
        <li><input type="checkbox" name="check[]" value="4">BMX</li>
        <li><input type="checkbox" name="check[]" value="8">Trotinette</li>
      </ul>
    </li>
    
    <li class="l-field"><p class="field-desc">Niveau</p>
    
        <SELECT name="niveau" id="niveau" size="1">
          <OPTION value="Débutant">Débutant</OPTION>
          <OPTION value="Amateur">Amateur</OPTION>
          <OPTION value="Confirmé">Confirmé</OPTION>
          <OPTION value="Expert">Expert</OPTION>
          <OPTION value="Pro">Pro</OPTION>
        </SELECT>
      
    </li>
    <li class="l-field spaced send"><p class="field-send"><input type="submit" class="envoie" name="envoie" value="Envoyer"/></p></li>
  </ul>
  </form>
</div> <!-- end of inscription-fb-dropdown -->
<div id="inscription-fb-dropdown" class="dropdown-up">
  <p class="dropdown-title">Inscription avec Facebook</p>

  <div id="fb-root"></div>


  <a  href="#" class="close" onclick="getDropDownUp('inscription-fb-dropdown')"><img src="imgs/close.png" alt="close"/></a>
  <form autocomplete="off" method='post' action='facebook_connect.php'>
  <ul>
    <li class="l-field"><div id="facebook_button"><fb:login-button id="fb_connexion" scope="user_birthday,email" width="200" max-rows="1"></fb:login-button></div>
    <div id="message_co"></div>
     <img id="check_fb" src="" alt="bon"/></li>
    </li>
    <li class="l-field"><p class="field-desc">Pseudo</p><input class="l-text-field" type="text" id="pseudoFb" name="pseudo" required></li>
    <li class="l-field"><p class="field-desc">Mot de passe</p><input class="l-text-field" type="password" id="mdpFb" name="mdp" required></li>
    <li class="l-field check"><p class="field-desc">Confirm. Mdp</p><input class="l-text-field" type="password" id="retape_mdpFb" name="retape_mdp" required>
    <img id="check_fb" src="imgs/check.png" alt="bon"/></li>
  <div class="verifMatchMdp" id="verifMatchMdp"></div> 
   <li class="xl-field spaced"><p class="field-desc">Sport pratiqué</p>
      <ul class="sports-checkboxes">
        <li><input type="checkbox" name="check[]" value="1">Skate</li>
        <li><input type="checkbox" name="check[]" value="2">Roller</li>
        <li><input type="checkbox" name="check[]" value="4">BMX</li>
        <li><input type="checkbox" name="check[]" value="8">Trotinette</li>
      </ul>
    </li>
    
    <li class="l-field"><p class="field-desc">Niveau</p>
    
        <SELECT name="niveau" id="niveau" size="1">
          <OPTION value="Débutant">Débutant</OPTION>
          <OPTION value="Amateur">Amateur</OPTION>
          <OPTION value="Confirmé">Confirmé</OPTION>
          <OPTION value="Expert">Expert</OPTION>
          <OPTION value="Pro">Pro</OPTION>
        </SELECT>
      
    </li>
    <li class="l-field spaced send"><p class="field-send"><input type="submit" class="envoie" name="envoie" value="Envoyer"/></p></li>
  </ul>
  </form>
</div> <!-- end of inscription-fb-dropdown -->
<div id="profiledit-dropdown" class="dropdown-up">
  <p class="dropdown-title">Éditer profil</p>
  <a  href="#" class="close" onclick="getDropDownUp('profiledit-dropdown')"><img src="imgs/close.png" alt="close"/></a>
 
  <form action="profil.php" enctype="multipart/form-data" method="post">
  <img id="pp-profiledit" src="<?php echo $avatar; ?>" alt="Photo de profil"/>
  <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
     <p id="link-pp-profiledit">Ajouter une image : <input class="envoie" type="file" name="avatar" id="avatar_edit"></p>
  <!--<a href="#" id="link-pp-profiledit">Changer ma photo</a>-->

  <ul class="profiledit-right">
    
    <li class="l-field"><p class="field-desc">Prénom</p><input class="l-text-field" type="text" id="surname_edit" name="surname" value="<?php echo ($surname);?>" required></li>
    <li class="l-field"><p class="field-desc">Nom</p><input class="l-text-field" type="nom" id="name_edit" name="name" value="<?php echo ($name);?>" required></li>
    <li class="l-field"><p class="field-desc">Pseudo</p><input class="l-text-field" type="pseudo" id="pseudo_edit" name="pseudo" value="<?php echo ($pseudo);?>" required></li>
    <li class="l-field"><p class="field-desc">E-mail</p><input class="l-text-field" type="email" id="email_edit" name="email"value="<?php echo ($email);?>" required></li>
    <li class="l-field"><p class="field-desc">Ville</p><input class="l-text-field" type="ville" id="ville_edit" name="ville"value="<?php echo ($ville);?>" required></li>
  <div class="verifMatchMdp" id="verifMatchMdp_edit"></div> 
   <li class="xl-field spaced"><p class="field-desc">Sport pratiqué</p>
      <ul class="sports-checkboxes">
        <li><input type="checkbox" name="check[]" value="1" <?php if($users['sport'] == '1' || $users['sport'] == '3' || $users['sport'] == '5' || $users['sport'] == '7' || $users['sport'] == '9' || $users['sport'] == '11' || $users['sport'] == '13' || $users['sport'] == '15'){echo('checked');}?>> Skate</li>
	<li><input type="checkbox" name="check[]" value="2" <?php if($users['sport'] == '2' || $users['sport'] == '3' || $users['sport'] == '6' || $users['sport'] == '7' || $users['sport'] == '10' || $users['sport'] == '11'|| $users['sport'] == '14'|| $users['sport'] == '15'){echo('checked');}?>> Roller</li>
	<li><input type="checkbox" name="check[]" value="4" <?php if($users['sport'] == '4' || $users['sport'] == '5' || $users['sport'] == '6' || $users['sport'] == '7' || $users['sport'] == '12' || $users['sport'] == '13' || $users['sport'] == '14' || $users['sport'] == '15'){echo('checked');}?>> Bike</li>
	<li><input type="checkbox" name="check[]" value="8" <?php if($users['sport'] == '8' || $users['sport'] == '9' || $users['sport'] == '10'|| $users['sport'] == '11'|| $users['sport'] == '12'|| $users['sport'] == '13'|| $users['sport'] == '14'|| $users['sport'] == '15'){echo('checked');}?>> Trotinette</li>
      </ul>
    </li>
    
    <li class="l-field"><p class="field-desc">Niveau</p>
    
        <select value="<?php echo ($sport_level);?>" name="sport_level" id="niveau" data-provide="limit" data-counter="#counter"  rows="1">
          <option value="Débutant" <?php if($sport_level == 'Débutant'){echo('selected');}?>>Débutant</option>
          <option value="Amateur" <?php if($sport_level == 'Amateur'){echo('selected');}?>>Amateur</option>
          <option value="Confirmé" <?php if($sport_level == 'Confirmé'){echo('selected');}?>>Confirmé</option>
          <option value="Expert" <?php if($sport_level == 'Expert'){echo('selected');}?>>Expert</option>
          <OPTION value="Pro" <?php if($sport_level == 'Pro'){echo('selected');}?>>Pro</OPTION>
        </SELECT>
      
    </li>
    
  </ul>
  <div class="l-field send"><p class="field-send"><input type="submit" class="envoie" name="submit_edit" value="Enregistrer les modifications" /></p></div>
  </form>
   <form action='profil.php' method="POST">
           <button class="envoie" name="submit_delete" type="submit">Supprimer mon compte</button></p>
        </form>
  </div> <!-- end of profiledit-dropdown -->
<div id="abonnes-dropdown" class="dropdown-up">
  <p class="dropdown-title">Demandes d'abonnements</p>
  <a  href="#" class="close" onclick="getDropDownUp('abonnes-dropdown')"><img src="imgs/close.png" alt="close"/></a>
  <div id="dmd" class="demandesAmi">
    <!--PHP GOES HERE-->
  </div>
</div> <!-- end of abonnes-dropdown -->
<div id="amis-dropdown" class="dropdown-up">
  <p class="dropdown-title">Abonnements</p>
  <a  href="#" class="close" onclick="getDropDownUp('amis-dropdown')"><img src="imgs/close.png" alt="close"/></a>
  <div id="liste-amis">
    <!--PHP GOES HERE-->
  </div>
</div> <!-- end of amis-dropdown -->



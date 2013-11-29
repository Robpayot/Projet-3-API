  
    <?php //_________________RÉCUPÉRATION DES DONNEES USER_________________//
    require'facebook_connect.php'; 
    require 'config.php';
    require 'recup.php';
    
    
    
    //________________________LORS DU SUBMIT _______________________________	
            
        if(isset($_POST['submit_edit'])) {
            require 'edit-profil.php';
        }
        
        if (isset($_POST['envoiefb'])) {
            require 'sinscrireFb.php';
        }
      
            
            ?>
    <a onclick="getOn('mobile-more-menu')"><img class="mobile-only" id="mobile-more-icon" src="imgs/more.png" alt="Menu"/></a>
    <div id="topbar">
        <div id="topbar-content">
            <h1><a href="profil.php"><img src="imgs/logo.png" alt="Grab-In!"/></a></h1>
        
            <ul id="mobile-more-menu" class="mobile-dspln"><?php if(isset($_SESSION['login'])) {?>
          <a  href="#" class="close" id="mobile-more-close" onclick="getOff('mobile-more-menu')"><img src="imgs/close.png" alt="close"/></a>
          <li>
            <div class="champR">
              <input type="text" id="recherche" name="recherche" onfocus="displayResults()" onblur="hideResults()" placeholder="Chercher des Riders" required>
            </div>
            <div class="affichageR" id="resultat"></div>
          </li>
           
                <li class="touch-icon"><a href="#" onclick="getDropDownDown('profiledit-dropdown')"><img src="imgs/params.png" alt="Edition du profil"/></a></li>
          <li class="touch-icon"><a href="#" onclick="getDropDownDown('amis-dropdown');" id="voirAmis"><img src="imgs/friends.png" alt="Liste d'amis"/></a></li>
                <li class="abos touch-icon"><div id="notif-number" class="dspln"></div><a href="#" onclick="getDropDownDown('abonnes-dropdown');" id="voirDemandes"><img src="imgs/abos.png" id="imgDmd" alt="Confirmer les nouveaux abonnés"/></a></li>
                <li class="touch-icon"><a href="#" onclick="getDropDownDown('classement-dropdown');"><img class="mobile-only" src="imgs/cup.png" alt="Classement"/><p class="desktop-only">Classement</p></a></li>
                <li ><a href="profil.php"><?php echo $_SESSION['login']; ?></a></li>
          <li class="mobile-logout"><a href="deconnexion.php"><img src="imgs/logout.png" class="mobile-only" alt="Deconnexion" /><p class="desktop-only">Déconnexion</p></a></li>
          <?php } else {?>
                <li class="connexion"><a href="#" onclick="getDropDownDown('connexion-dropdown')">Connexion</a></li>
          <?php } ?>
          
              </ul>
        </div>
    </div> <!-- end of topbar -->
    <div id="connexion-dropdown" class="dropdown-up">
      <p class="dropdown-title">Connexion</p>
      <a  href="#" class="close" onclick="getDropDownUp('connexion-dropdown')"><img src="imgs/close.png" alt="close"/></a>
      <form autocomplete="off" method='post' id="formConn">
      <input type="text" id="pseudoConnexion" name="pseudo" placeholder="Pseudo" required><span id="erreurLOGIN"></span>
      <input type="password" placeholder="Mot de passe" id="mdpConnexion" name="mdp" required ><span id="erreurMDP"></span>
      <div id="btn-connexion" ><input class="transition200io blubtn" id="btn" type="submit" value="Let's ride" /></div>
      </form>
      <div id="separation">
        <p>ou</p>
      </div>
      <div id="btn-fbco" class="transition200io"><a onclick="getDropDownDown('inscription-fb-dropdown')">Inscription avec Facebook</a></div>
      <a href="#" onclick="getDropDownDown('inscription-dropdown')" class="no-account" id="btn-co">Pas encore de compte ?</a>
    </div> <!-- end of connexion-dropdown -->
    <div id="classement-dropdown" class="dropdown-up">
      <p class="dropdown-title">Classement</p>
      <a  href="#" class="close" onclick="getDropDownUp('classement-dropdown')"><img src="imgs/close.png" alt="close"/></a>
      <ul>
      </ul>
    </div> <!-- end of classement-dropdown -->
    <div id="inscription-dropdown" class="dropdown-up">
      <p class="dropdown-title">Inscription</p>
      <a  href="#" class="close" onclick="getDropDownUp('inscription-dropdown')"><img src="imgs/close.png" alt="close"/></a>
     
      <form autocomplete="off" method='post' action='sinscrire.php' id="formInsc">
      <ul>
        
        <li class="l-field"><p class="field-desc">Prénom</p><input class="l-text-field" type="text" id="prenom" name="prenom" required></li>
        <li class="l-field"><p class="field-desc">Nom</p><input class="l-text-field" type="text" id="nom" name="nom" required></li>
        <li class="l-field check"><p class="field-desc">Pseudo</p><input class="l-text-field" type="text" id="pseudo" name="pseudo" required><img src="imgs/fail.png" alt="bon" id="imgVerifPseudo"/></li>
        <li class="l-field spaced"><p class="field-desc">Mot de passe</p><input class="l-text-field" type="password" id="mdp" name="mdp" required></li>
        <li class="l-field check"><p class="field-desc">Confirm. Mdp</p><input class="l-text-field" type="password" id="retape_mdp" name="retape_mdp" required><img src="imgs/fail.png" alt="bon" id="imgVerif"/></li>
        <li class="l-field"><p class="field-desc">E-mail</p><input class="l-text-field" type="email" id="email" name="email" required></li>
      <p class="verifMatchMdp" id="verifMatchMdp"></p> 
       <li class="xl-field spaced"><p class="field-desc">Sport pratiqué</p>
          <ul class="sports-checkboxes">
            <li><input type="checkbox" name="check[]" value="1">Skate</li>
            <li><input type="checkbox" name="check[]" value="2">Roller</li>
            <li><input type="checkbox" name="check[]" value="4">BMX</li>
            <li><input type="checkbox" name="check[]" value="8">Trotinette</li>
          </ul>
        </li>
        
        <li class="l-field"><p class="field-desc">Niveau</p>
        
            <SELECT name="niveau" class="niveau" size="1">
              <OPTION value="Débutant">Débutant</OPTION>
              <OPTION value="Amateur">Amateur</OPTION>
              <OPTION value="Confirmé">Confirmé</OPTION>
              <OPTION value="Expert">Expert</OPTION>
              <OPTION value="Pro">Pro</OPTION>
            </SELECT>
          
        </li>
        <li class="l-field spaced send"><p class="field-send"><input type="submit" id="envoie" class="greyenvoie" name="envoie" value="Envoyer"/></p></li>
      </ul>
      </form>
    </div> <!-- end of inscription-dropdown -->
    <div id="inscription-fb-dropdown" class="dropdown-up">
      <p class="dropdown-title">Inscription avec Facebook</p>
    
      <div id="fb-root"></div>
    
    
      <a  href="#" class="close" onclick="getDropDownUp('inscription-fb-dropdown')"><img src="imgs/close.png" alt="close"/></a>
      <form autocomplete="off" method='post' action='facebook_connect.php' id="formInscFb">
      <ul>
        <li class="l-field"><p id="facebook_button"><fb:login-button id="fb_connexion" scope="user_birthday,email" width="200" max-rows="1"></fb:login-button></p>
        <p id="message_co"></p>
         <!--<img id="check_fb" src="" alt="bon"/>--></li>
        <li class="l-field check"><p class="field-desc">Pseudo</p><input class="l-text-field" type="text" id="pseudoFb" name="pseudo" required><img src="imgs/fail.png" alt="bon" id="imgVerifPseudoFb"/></li>
        <li class="l-field"><p class="field-desc">Mot de passe</p><input class="l-text-field" type="password" id="mdpFb" name="mdp" required></li>
        <li class="l-field check"><p class="field-desc">Confirm. Mdp</p><input class="l-text-field" type="password" id="retape_mdpFb" name="retape_mdp" required><img src="imgs/fail.png" alt="bon" id="imgVerifFb"/></li>
      <p class="verifMatchMdp" id="verifMatchMdpFb"></p> 
       <li class="xl-field spaced"><p class="field-desc">Sport pratiqué</p>
          <ul class="sports-checkboxes">
            <li><input type="checkbox" name="check[]" value="1">Skate</li>
            <li><input type="checkbox" name="check[]" value="2">Roller</li>
            <li><input type="checkbox" name="check[]" value="4">BMX</li>
            <li><input type="checkbox" name="check[]" value="8">Trotinette</li>
          </ul>
        </li>
        
        <li class="l-field"><p class="field-desc">Niveau</p>
        
            <SELECT name="niveau" class="niveau" size="1">
              <OPTION value="Débutant">Débutant</OPTION>
              <OPTION value="Amateur">Amateur</OPTION>
              <OPTION value="Confirmé">Confirmé</OPTION>
              <OPTION value="Expert">Expert</OPTION>
              <OPTION value="Pro">Pro</OPTION>
            </SELECT>
          
        </li>
        <li class="l-field spaced send"><p class="field-send"><input type="submit" id="envoieFb" class="greyenvoie" name="envoiefb" value="Envoyer"/></p></li>
      </ul>
      </form>
    </div> <!-- end of inscription-fb-dropdown -->
    <div id="profiledit-dropdown" class="dropdown-up">
      <p class="dropdown-title">Éditer profil</p>
      <a  href="#" class="close" onclick="getDropDownUp('profiledit-dropdown')"><img src="imgs/close.png" alt="close"/></a>
     
      <form action="profil.php" enctype="multipart/form-data" method="post">
      <img id="pp-profiledit" src="<?php echo $avatar; ?>" alt="Photo de profil"/>
      <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
         <p id="link-pp-profiledit"><a onclick="getAvatar()">Changer ma photo</a><input class="envoie dspln" type="file" name="avatar" id="avatar"><a  href="#" id="close-avatar" class="dspln" onclick="getAvatarOff()"><img src="imgs/close.png" alt="close"/></a></p>
      <!--<a href="#" id="link-pp-profiledit">Changer ma photo</a>-->
    
      <ul class="profiledit-right">
        
        <li class="l-field"><p class="field-desc">Prénom</p><input class="l-text-field" type="text" id="surname_edit" name="surname" value="<?php echo ($surname);?>" required></li>
        <li class="l-field"><p class="field-desc">Nom</p><input class="l-text-field" type="text" id="name_edit" name="name" value="<?php echo ($name);?>" required></li>
        <li class="l-field"><p class="field-desc">Pseudo</p><input class="l-text-field" type="text" id="pseudo_edit" name="pseudo" value="<?php echo ($pseudo);?>" required></li>
        <li class="l-field"><p class="field-desc">E-mail</p><input class="l-text-field" type="email" id="email_edit" name="email" value="<?php echo ($email);?>" required></li>
        <li class="l-field"><p class="field-desc">Ville</p><input class="l-text-field" type="text" id="ville_edit" name="ville" value="<?php echo ($ville);?>" required></li>
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
        
            <select id="sport_level" name="sport_level" class="niveau" data-provide="limit" data-counter="#counter" >
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
               <p><button class="envoie-warning"  name="submit_delete" type="submit">Supprimer mon compte</button></p>
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
    
    

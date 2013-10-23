<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Inscription</title>
<script type="text/javascript" src="JS/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="JS/verifmdp.js"></script>
</head>

<body>

<h1> INSCRIPTION</h1>

	<form autocomplete="off" method='post' action='sinscrire.php'>
   <fieldset>
    <input type="text" id="nom" name="nom" placeholder="Nom" required >
    <input type="text" id="prenom" name="prenom" placeholder="Prenom" required >
    <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" required >
    <input type= "password" id="mdp" name="mdp" placeholder="Mot de passe" required >
    <input type="password" id="retape_mdp" name="retape_mdp" placeholder="Retaper mot de passe" required > 
 <div class="verifMatchMdp" id="verifMatchMdp">
 </div>
    <input type="email" id="email_addr" name="email_addr" placeholder="email" required >
    <SELECT name="sport" id="sport" style="width: 141px" size="1" >
        <OPTION value="skate">Skate</OPTION>
        <OPTION value="rollers">Rollers</OPTION>
        <OPTION value="trotinette">Trotinette</OPTION>
        <OPTION selected value="sportif">-- Sport --</OPTION>
    </SELECT>
    <SELECT name="niveau" id="niveau" style="width: 141px" size="1" >
        <OPTION value="debutant">Débutant</OPTION>
        <OPTION value="intermediaire">Intermédiaire</OPTION>
        <OPTION value="confirme">Confirmé</OPTION>
        <OPTION selected value="niveaux" >-- Niveau --</OPTION>
    </SELECT>

    <p> <input type="submit" id="envoie" value="ENVOYER" class="button" disabled/></p>
    </fieldset>
  </form>
  
</body>
</html>

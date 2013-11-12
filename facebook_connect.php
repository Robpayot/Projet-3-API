<?php


require_once("API/facebook.php");

$config = array();
$config['appId'] = '436780426432214';
$config['secret'] = '4e4db92334de6046923cdc345fc79013';

$facebook = new Facebook($config);
$uid = $facebook->getUser();

$fql = "SELECT uid,first_name,last_name,birthday_date,email,music,current_location.city FROM user WHERE uid='".$uid."'";


$params = array(
  'scope' => 'read_stream, friends_likes, email, user_location',
  'redirect_uri' => 'https://www.myapp.com/post_login_page',
  'method' => 'fql.query',
  //'locale' => 'fr_FR',
  'query' => $fql
);
		 
$loginUrl = $facebook->api($params);
//print_r($loginUrl);
foreach ($loginUrl as $loginUrls):
$firstname = $loginUrls['first_name'];
$lastname = $loginUrls['last_name'];
$birthday_date = $loginUrls['birthday_date'];
$email = $loginUrls['email'];
$music = $loginUrls['music'];
$ville = $loginUrls['current_location.city'];
$avatar = $loginUrls['picture'];
endforeach;


		
$dsn = 'mysql:dbname=robinpayadmin;host=mysql51-100.perso';
$user = 'robinpayadmin';
$password = 'gUFjHp3Q8m9y';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Erreur: ' . $e->getMessage();
}

// CREATION DE L'URL DE LA PHOTO DE PROFIL FACEBOOK 

$avatar="https://graph.facebook.com/".$uid."/picture?type=large";

// CALCULE DE L'AGE EN FONCTION DE LA DATE DE NAISSANCE

  //date in mm/dd/yyyy format; or it can be in other formats as well

         //explode the date to get month, day and year
         $birthday_dateTab = explode("/", $birthday_date);
		 $birthday_date = $birthday_dateTab[2].$birthday_dateTab[1].$birthday_dateTab[0]; 
		 
$age = floor( (strtotime(date('Ymd')) - strtotime($birthday_date)) / 31556926);

        

// CALCUL DE LA VALEUR DES SPORT PRATIQUES_____________________________________________________
	
if (isset($_POST['check']))
{    
    //recupérer les valeurs des checkbox
    $tabCheckbox = $_POST['check'];
    foreach ($tabCheckbox as $checkbox) {
		$Vsport=$Vsport+$checkbox;
    }	
}

		$mdp=mysql_escape_string($_POST['mdp']);
		$pseudo=mysql_escape_string($_POST['pseudo']);
		$niveau=mysql_escape_string($_POST['niveau']);
		
if (isset($_POST['envoie'])) {
$user = $dbh -> query('INSERT INTO grabin_user(name, surname, pseudo, sport, sport_level, email, mdp, avatar, age, ville)VALUES("'.$lastname.'","'.$firstname.'","'.$pseudo.'","'.$Vsport.'","'.$niveau.'","'.$email.'","'.$mdp.'","'.$avatar.'","'.$age.'", "'.$ville.'")');
		
		
						session_start(); 
						$pseudo = $_SESSION['login']; 
						 header('location: profil.php');
						 exit(); 
	
}

		
		
				
	


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Facebook connect</title>
<script type="text/javascript" src="JS/verifmdp.js"></script>
</head>

<body>

<h1> Inscription via Facebook </h1>
<div id="fb-root"></div>

<fb:login-button id="fb_connexion" scope="user_birthday,email" show-faces="true" width="200" max-rows="1"></fb:login-button>
<form autocomplete="off" method='post' action='facebook_connect.php'>
   <fieldset>
    <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" required >
    <input type= "password" id="mdp" name="mdp" placeholder="Mot de passe" required >
    <input type="password" id="retape_mdp" name="retape_mdp" placeholder="Retaper mot de passe" required > 
 <div class="verifMatchMdp" id="verifMatchMdp">
 </div>
     <input type="checkbox" name="check[]" value="1"> Skate<br>
	<input type="checkbox" name="check[]" value="2"> Roller<br>
	<input type="checkbox" name="check[]" value="4"> Bike<br>
	<input type="checkbox" name="check[]" value="8"> Trotinette<br>
    <SELECT name="niveau" id="niveau" style="width: 141px" size="1" >
        <option value="noob">noob</option>
        <option value="intermediaire">intermediaire</option>
        <option value="pro">pro</option>
        <option value="star">star</option>
        <OPTION selected value="niveaux" >-- Niveau --</OPTION>
    </SELECT>

    <p> <input type="submit" id="envoie" name="envoie" value="ENVOYER" class="button"/></p>
    </fieldset>
  </form>
<script>
  // Additional JS functions here
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '436780426432214', // App ID
      channelUrl : 'http://robinpayot.com/GRAB-IN/MASTER/facebook_connect.php', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional init code here
	
	 // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
  // for any authentication related change, such as login, logout or session refresh. This means that
  // whenever someone who was previously logged out tries to log in again, the correct case below 
  // will be handled. 
  FB.Event.subscribe('auth.authResponseChange', function(response) {
    // Here we specify what we do with the response anytime this event occurs. 
    if (response.status === 'connected') {
      // The response object is returned with a status field that lets the app know the current
      // login status of the person. In this case, we're handling the situation where they 
      // have logged in to the app.
      testAPI();
	      } else if (response.status === 'not_authorized') {
      // In this case, the person is logged into Facebook, but not into the app, so we call
      // FB.login() to prompt them to do so. 
      // In real-life usage, you wouldn't want to immediately prompt someone to login 
      // like this, for two reasons:
      // (1) JavaScript created popup windows are blocked by most browsers unless they 
      // result from direct interaction from people using the app (such as a mouse click)
      // (2) it is a bad experience to be continually prompted to login upon page load.
      FB.login();
    } else {
      // In this case, the person is not logged into Facebook, so we call the login() 
      // function to prompt them to do so. Note that at this stage there is no indication
      // of whether they are logged into the app. If they aren't then they'll see the Login
      // dialog right after they log in to Facebook. 
      // The same caveats as above apply to the FB.login() call here.
      FB.login();
    }
  });


  };

  // Load the SDK asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
   
    // Here we run a very simple test of the Graph API after login is successful. 
  // This testAPI() function is only called in those cases. 
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Good to see you, ' + response.name + '.');
    });
  }
</script>
</body>
</html>
<?php

//____________________REQUIRE_FACEBOOK_____________________

require_once("API/facebook.php");

$config = array();
$config['appId'] = '436780426432214';
$config['secret'] = '4e4db92334de6046923cdc345fc79013';

$facebook = new Facebook($config);
$uid = $facebook->getUser();

$fql = "SELECT uid,first_name,last_name,birthday_date,email,current_location.city FROM user WHERE uid='".$uid."'";


$params = array(
  'scope' => 'read_stream, friends_likes, email, user_location',
  'redirect_uri' => 'https://www.myapp.com/post_login_page',
  'method' => 'fql.query',
  //'locale' => 'fr_FR',
  'query' => $fql
);
		 





if (isset($_POST['envoiefb'])) {
	
	$loginUrl = $facebook->api($params);
//print_r($loginUrl);
foreach ($loginUrl as $loginUrls):
$firstname = $loginUrls['first_name'];
$lastname = $loginUrls['last_name'];
$birthday_date = $loginUrls['birthday_date'];
$email = $loginUrls['email'];
$ville = $loginUrls['current_location.city'];
$avatar = $loginUrls['picture'];
endforeach;
	
	// CONNEXION BDD_____________________________________

require 'config.php';

	// CREATION DE L'URL DE LA PHOTO DE PROFIL FACEBOOK 

	$avatar="https://graph.facebook.com/".$uid."/picture?width=160&height=160";

// CALCULE DE L'AGE EN FONCTION DE LA DATE DE NAISSANCE

  //date in mm/dd/yyyy format; or it can be in other formats as well

         //explode the date to get month, day and year

         $birthday_date = explode("/", $birthday_date);
		 
		 $age = (date("md", date("U", mktime(0, 0, 0, intval($birthday_date[0]), intval($birthday_date[1]), intval($birthday_date[2])))) > date("md") ? ((date("Y")-intval($birthday_date[2]))-1):(date("Y")-intval($birthday_date[2])));
		

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
		
//Date d'inscription

$date_register=date('Y-m-d');

	

$user = $dbh -> query('INSERT INTO grabin_user(name, surname, pseudo, sport, sport_level, email, mdp, avatar, age, ville, date_register)VALUES("'.$lastname.'","'.$firstname.'","'.$pseudo.'","'.$Vsport.'","'.$niveau.'","'.$email.'","'.$mdp.'","'.$avatar.'","'.$age.'", "'.$ville.'", "'.$date_register.'")');
		
		$user = $dbh -> query("SELECT * FROM grabin_user WHERE pseudo='".$pseudo."'")->fetchAll();
	foreach ($user as $users):
		if($users['pseudo']==$pseudo)
			$id = $users['id'];
	endforeach;
					 
						 
						$_SESSION['login']=$pseudo; 
						$_SESSION['ID']=$id;
						
						 header('location: profil.php');
						 exit(); 
	
}

		
		
				
	


?>
<!--<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>-->
<!--<script type="text/javascript" src="js/verifmdpFb.js"></script>-->


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
	       $("#facebook_button").hide();
		   $("#fb-root").hide();
		   var message_co=document.getElementById("message_co");
			message_co.innerHTML="Connecté à Facebook";
			
			
	      } else if (response.status === 'not_authorized') {
      // In this case, the person is logged into Facebook, but not into the app, so we call
      // FB.login() to prompt them to do so. 
      // In real-life usage, you wouldn't want to immediately prompt someone to login 
      // like this, for two reasons:
      // (1) JavaScript created popup windows are blocked by most browsers unless they 
      // result from direct interaction from people using the app (such as a mouse click)
      // (2) it is a bad experience to be continually prompted to login upon page load.
	    $("#message_co").hide();
      FB.login();
    } else {
      // In this case, the person is not logged into Facebook, so we call the login() 
      // function to prompt them to do so. Note that at this stage there is no indication
      // of whether they are logged into the app. If they aren't then they'll see the Login
      // dialog right after they log in to Facebook. 
      // The same caveats as above apply to the FB.login() call here.
	  $("#message_co").hide();
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
   
    FB.api('/me', function(response) {

    });
  }
</script>

<?php
require_once("API/facebook.php");

$config = array();
$config['appId'] = '436780426432214';
$config['secret'] = '4e4db92334de6046923cdc345fc79013';

$facebook = new Facebook($config);
$uid = $facebook->getUser();

$fql = "SELECT uid,name,birthday,email,music FROM user WHERE uid='".$uid."'";


$params = array(
  'scope' => 'read_stream, friends_likes, email',
  'redirect_uri' => 'https://www.myapp.com/post_login_page',
  'method' => 'fql.query',
  'locale' => 'fr_FR',
  'query' => $fql
);

$loginUrl = $facebook->api($params);
print_r($loginUrl);
foreach ($loginUrl as $loginUrls):
$name = $loginUrls['name'];
$birthday_date = $loginUrls['birthday'];
$email = $loginUrls['email'];
$music = $loginUrls['music'];
endforeach;


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>2Facebook connect</title>
</head>

<body>
<h1> Bonjour </h1>
<div id="fb-root"></div>

<fb:login-button scope="user_birthday,email" show-faces="true" width="200" max-rows="1"></fb:login-button>
  <h1>Tu es <?php echo ($name) ?></h1>
  <h1>Tu es né le <?php echo ($birthday_date) ?></h1>
  <h1>Ton adresse @ : <?php echo ($email) ?></h1> 
  <h1>Tu écoutes <?php echo ($music) ?></h1> 
<script>
  // Additional JS functions here
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '436780426432214', // App ID
      channelUrl : 'http://robinpayot.com/TestApp/connect2.php', // Channel File
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
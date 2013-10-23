<?php

		$login=mysql_escape_string($_POST['nom']);
		$mdp=mysql_escape_string($_POST['mdp']);
		$link=mysql_connect("localhost","root","");
		mysql_select_db("avallera") or die (mysql_error());
		$res1=mysql_query("SELECT * FROM User WHERE surname='$login'")or die (mysql_error());
	
		 if( mysql_num_rows($res1)>=1){
				while ($util=mysql_fetch_assoc($res1)){
					$ok=$util['mdp'];
					if($ok==$mdp){
						 session_start(); 
						 $_SESSION['login'] = $login; 
						 header('Location: profil.php'); 
						 exit(); 
		 					
						}
					else {
		 				echo"<div class='loginI'>Mot de passe incorrect</div>";
		 			}
				
			}
		}
		 
		 else {
		 	echo"<div class='loginI'>Login incorrect</div>";
		 	}

		
		function deco(){
			session_destroy();
			unset($_SESSION['bon']);
			echo "Vous êtes déconnecté(e)";
			
		}
		
		function bouton_deco(){
			echo "<form class='formSeconnecter' method='post' action='index.php'>" ;
			echo "<h1>Bonjour"." ". $_SESSION['bon']."</h1>";
			echo" </br><input type='submit' name='deco' value='déconnexion'></br>
			</form>";
		}
		
?>
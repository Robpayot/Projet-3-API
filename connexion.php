
<?php

		$login=mysql_escape_string($_POST['pseudo']);
		$mdp=mysql_escape_string($_POST['mdp']);
		
		$link=mysql_connect("mysql51-100.perso","robinpayadmin","gUFjHp3Q8m9y");
		mysql_select_db("robinpayadmin") or die (mysql_error());
		$res1=mysql_query("SELECT * FROM grabin_user WHERE pseudo='$login'")or die (mysql_error());
	
		 if( mysql_num_rows($res1)>=1){
				while ($util=mysql_fetch_assoc($res1)){
					$ok=$util['mdp'];
					if($ok==$mdp){
						 session_start(); 
						 $_SESSION['login'] = $login; 
						 $_SESSION['ID']=$util['id'];
						 $_SESSION['photo']=$util['avatar'];
		 					
						}
					else {
						//mdp incorrect
		 				echo 1;
		 			}
				
			}
		}
		 
		 else {
			 //login incorrect
		 	echo 2;
		 	}

		
		function deco(){
			session_destroy();
			unset($_SESSION['ID']);
			unset($_SESSION['avatar']);
			unset($_SESSION['login']);
			unset($_SESSION['ID']);
			unset($_SESSION['IDprofilVisite']);
			echo "Vous êtes déconnecté(e)";
			
		}
		
		function bouton_deco(){
			echo "<form class='formSeconnecter' method='post' action='index.php'>" ;
			echo "<h1>Bonjour"." ". $_SESSION['bon']."</h1>";
			echo" </br><input type='submit' name='deco' value='déconnexion'></br>
			</form>";
		}
		
?>
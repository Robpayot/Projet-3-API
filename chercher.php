<!doctype html>
<?php

session_start();  
if (!isset($_SESSION['login'])) { 
   header ('Location: index.php'); 
   exit();  
}  

else if(isset($_GET['motclef'])){
		$recherche=mysql_escape_string($_GET['motclef']);
			
		$login=mysql_escape_string($_SESSION['login']);
		
		require 'config2.php';
		
		$res1=mysql_query("SELECT * FROM grabin_user WHERE pseudo LIKE '%$recherche%' AND pseudo <> '$login'")or die (mysql_error());
		
		

		 if( mysql_num_rows($res1)>=1){
		 	echo '<ul id="list-results">';
				while ($util=mysql_fetch_assoc($res1)){
					$ok=$util['pseudo'];
					$idProfil=$util['id'];
					$photo=$util['avatar'];
					
					echo "<li><a href="."voirProfil.php?profil=".$ok."&key=".$idProfil."><img src=".$photo." width=40px height=40px alt='photo'>".$ok."</a></li>";
				
			}
			echo "</ul>";
		}
		 
		 else {
		 	echo"<div class='loginI'>Aucun Résultat</div>";
		 	}
			
}
			
?>

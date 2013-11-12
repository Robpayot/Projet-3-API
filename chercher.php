<!doctype html>
<?php

session_start();  
if (!isset($_SESSION['login'])) { 
   header ('Location: index.php'); 
   exit();  
}  

else if(isset($_GET['motclef'])){
		$recherche=mysql_escape_string($_GET['motclef']);
		
		if(isset($_SESSION['profilVisite']))
			$profilVisite=$_SESSION['profilVisite'];
			
		$login=mysql_escape_string($_SESSION['login']);
		
		$link=mysql_connect("mysql51-100.perso","robinpayadmin","gUFjHp3Q8m9y");
		mysql_select_db("robinpayadmin") or die (mysql_error());
		
	if(isset($_SESSION['profilVisite'])){
		$res1=mysql_query("SELECT * FROM grabin_user WHERE pseudo LIKE '$recherche%' AND pseudo <> '$login' AND pseudo <> '$profilVisite'")or die (mysql_error());}
	else{
		$res1=mysql_query("SELECT * FROM grabin_user WHERE pseudo LIKE '$recherche%' AND pseudo <> '$login'")or die (mysql_error());
		}
		

		 if( mysql_num_rows($res1)>=1){
				while ($util=mysql_fetch_assoc($res1)){
					$ok=$util['pseudo'];
					$_SESSION['IDprofilVisite']=$util['id'];
					echo "<a href="."voirProfil.php?profil=".$ok.">".$ok."</a></br>";
				
			}
		}
		 
		 else {
		 	echo"<div class='loginI'>Aucun Résultat</div>";
		 	}
			
}
			
?>
<html>
<head>
<meta charset="utf-8">
<title>Document sans titre</title>
</head>

<body>
</body>
</html>
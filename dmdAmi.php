<?php

session_start();  
if (!isset($_SESSION['login'])) { 
   header ('Location: index.php'); 
   exit();  
}  

		$link=mysql_connect("mysql51-100.perso","robinpayadmin","gUFjHp3Q8m9y");
		mysql_select_db("robinpayadmin") or die (mysql_error());
		
		$login=$_SESSION['login'];
		$ami=$_SESSION['profilVisite'];

		
		$res1=mysql_query("SELECT * FROM grabin_user")or die (mysql_error());
	
		 if( mysql_num_rows($res1)>=1){
				while ($util=mysql_fetch_assoc($res1)){
					if($util['pseudo']==$login)
						$IDd=$util['id'];
					if($util['pseudo']==$ami)
						$IDa=$util['id'];
					}
					
		
					
		$res2=mysql_query("INSERT INTO amis(ID_demandeur,ID_accepteur)VALUES('.$IDd.','.$IDa.')")or die (mysql_error());
		
		echo"demande envoyée";
			}
					
		else{
			echo"Erreur";
		}



?>
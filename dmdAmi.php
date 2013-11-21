<?php

session_start();  

		$link=mysql_connect("mysql51-100.perso","robinpayadmin","gUFjHp3Q8m9y");
		mysql_select_db("robinpayadmin") or die (mysql_error());
		
		$IDd=$_SESSION['ID'];
		$IDa=$_SESSION['IDprofilVisite'];

		
	if($_GET['demandeAbonnement']==2){			
		$res2=mysql_query("INSERT INTO amis(ID_demandeur,ID_accepteur)VALUES('.$IDd.','.$IDa.')")or die (mysql_error());
		
		echo 0;
		}
	else{
		$res2=mysql_query("DELETE FROM amis WHERE ID_demandeur='$IDd' AND ID_accepteur='$IDa'")or die (mysql_error());
		
		echo 25;
		
	}




?>
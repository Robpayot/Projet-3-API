<?php

session_start();  

		require 'config2.php';
		
		$IDd=$_SESSION['ID'];
		$IDa=$_SESSION['IDprofilVisite'];

		
	if($_GET['demandeAbonnement']==2){	
	//abonnement		
		$res2=mysql_query("INSERT INTO amis(ID_demandeur,ID_accepteur)VALUES('.$IDd.','.$IDa.')")or die (mysql_error());
		
		echo 0;
		}
	else{
		//desabonnement
		$res2=mysql_query("DELETE FROM amis WHERE ID_demandeur='$IDd' AND ID_accepteur='$IDa'")or die (mysql_error());
		
		echo 25;
		
	}




?>
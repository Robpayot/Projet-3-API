<?php
session_start();  
  


	$id=$_SESSION['ID'];
	$ami=$_GET['ami'];
	//choix 1 accepter- 2 refuser
	$choix=$_GET['accepte'];
	
		require 'config2.php';
		
		$res4=mysql_query("UPDATE amis SET etat='$choix' WHERE (ID_accepteur='$id' AND ID_demandeur='$ami')")or die (mysql_error());
	
	echo $choix;
	
	




?>


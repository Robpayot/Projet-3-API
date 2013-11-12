<?php
session_start();  
if (!isset($_SESSION['login'])) { 
   header ('Location: index.php'); 
   exit();  
}  

else{
	$id=$_SESSION['ID'];
	$ami=$_GET['ami'];
	$choix=$_GET['accepte'];
	
		$link=mysql_connect("mysql51-100.perso","robinpayadmin","gUFjHp3Q8m9y");
		mysql_select_db("robinpayadmin") or die (mysql_error());
		
		$res4=mysql_query("UPDATE amis SET etat='$choix' WHERE (ID_accepteur='$id' AND ID_demandeur='$ami')")or die (mysql_error());
	
	echo $ami;
	
	
}



?>


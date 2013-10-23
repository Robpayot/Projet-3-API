<?php

		$loginN=mysql_escape_string($_POST['nom']);
		$loginP=mysql_escape_string($_POST['prenom']);
		$mdp=mysql_escape_string($_POST['mdp']);
		$pseudo=mysql_escape_string($_POST['pseudo']);
		$mail=$_POST['email_addr'];
		$sport=mysql_escape_string($_POST['sport']);
		$niveau=mysql_escape_string($_POST['niveau']);
		
		$link=mysql_connect("localhost","root","");
		mysql_select_db("avallera") or die (mysql_error());
		
		$res1=mysql_query('INSERT INTO User(name, surname, sport, sport_level, email, mdp)VALUES("'.$loginN.'","'.$loginP.'","'.$sport.'","'.$niveau.'","'.$mail.'","'.$mdp.'")')or die (mysql_error());
	


?>

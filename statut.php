<?php
session_start();
// CONNEXION À LA BASE DE DONNÉES

require 'config.php';

	if(isset($_POST['statut'])) {
	$id=$_SESSION['ID'];	
	$statut=$_POST['statut'];

			$dbh -> query("UPDATE grabin_user SET statut = '".$statut."' WHERE id='".$id."' " );
			
			
			echo "&#171;".htmlentities(stripslashes($statut), ENT_NOQUOTES,"UTF-8")."&#187;";		
	}
	
?>
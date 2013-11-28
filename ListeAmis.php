<?php
session_start();
//_________________RÉCUPÉRATION DES AMIS USER_________________//
$demandeA;
$amisTab=array();
$id_user = $_SESSION['ID'];	

require 'config2.php';	

if($_GET['demandeA']==1){
	//Affichage liste d'amis
$res2=mysql_query("SELECT DISTINCT ID_accepteur FROM amis WHERE etat=1 AND ID_demandeur='$id_user'")or die (mysql_error());
		
		if( mysql_num_rows($res2)>=1){
				echo "<ul>";
				while ($util=mysql_fetch_assoc($res2)){
					
					$ID=$util['ID_accepteur'];
					//array_push($amisTab,$util['ID_demandeur']);
					
					
					$res3=mysql_query("SELECT * FROM grabin_user WHERE id='$ID'")or die (mysql_error());
					if( mysql_num_rows($res3)>=1){
						
						while ($util2=mysql_fetch_assoc($res3)){
							$pseudoA=$util2['pseudo'];
							$avatarA=$util2['avatar'];

					$affichage="<li><a href="."voirProfil.php?profil=".$pseudoA."&key=".$ID."><img src=".$avatarA." width='40px' height='40px' alt='photo'>".$pseudoA."</a></li>";
					echo $affichage;
						}
					}	
				}
				echo "</ul>";	
		}

	else echo "Pas d'abonnements acceptés";	
		

}


else if($_GET['demandeA']==2){
	//Liste d'amis en tableau JSON
	$nbAmi=0;
	$amiId=array();
	$amisTab=array();
	$amisTabFinal=array();
	
	$res2=mysql_query("SELECT DISTINCT ID_accepteur FROM amis WHERE etat=1 AND ID_demandeur='$id_user'")or die (mysql_error());
		
		if( mysql_num_rows($res2)>=1){
			
				while ($util=mysql_fetch_assoc($res2)){
					$amiId=array("ami".$nbAmi=>$util['ID_accepteur']);
					$amisTab=array_merge((array)$amisTab,(array)$amiId);
					$nbAmi++;
				}
		}
	echo json_encode($amisTab);
}

else if(isset($_GET['iduser_checkin'])){
	//Determine la couleur du point checkin: si ami>1>bleu, si sois même>2>rose sinon gris
	$id_ami=$_GET['iduser_checkin'];
	
	$res2=mysql_query("SELECT DISTINCT * FROM amis WHERE etat=1 AND ID_demandeur='$id_user' AND ID_accepteur='$id_ami'")or die (mysql_error());
		if($id_user==$id_ami)
			echo 2;
		else if( mysql_num_rows($res2)>=1){
			echo 1;
		}
		else
			echo 0;
}

?>
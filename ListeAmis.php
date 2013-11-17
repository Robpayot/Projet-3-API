<?php
session_start();
//_________________RÉCUPÉRATION DES AMIS USER_________________//
$demandeA;
$amisTab=array();
$id_user = $_SESSION['ID'];	

$link=mysql_connect("mysql51-100.perso","robinpayadmin","gUFjHp3Q8m9y");
mysql_select_db("robinpayadmin") or die (mysql_error());	

if($_GET['demandeA']==1){
	
$res2=mysql_query("SELECT DISTINCT ID_demandeur FROM amis WHERE etat=1 AND ID_accepteur='$id_user'")or die (mysql_error());
		
		if( mysql_num_rows($res2)>=1){
				echo "<ul><h2> Amis:</h2>";
				while ($util=mysql_fetch_assoc($res2)){
					
					$ID=$util['ID_demandeur'];
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
				else "Pas d'amis";	
				}
				
		}
	echo "</ul>";	
		

}


else if($_GET['demandeA']==2){
	$nbAmi=0;
	$amiId=array();
	$amisTab=array();
	$amisTabFinal=array();
	
	$res2=mysql_query("SELECT DISTINCT ID_demandeur FROM amis WHERE etat=1 AND ID_accepteur='$id_user'")or die (mysql_error());
		
		if( mysql_num_rows($res2)>=1){
			
				while ($util=mysql_fetch_assoc($res2)){
					$amiId=array("ami".$nbAmi=>$util['ID_demandeur']);
					$amisTab=array_merge((array)$amisTab,(array)$amiId);
					$nbAmi++;
				}
		}
	echo json_encode($amisTab);
}

?>
<?php

session_start();  
if (!isset($_SESSION['login'])) { 
   header ('Location: index.php'); 
   exit();  
} 

else{
		$IDa=$_SESSION['ID'];
		
		$link=mysql_connect("mysql51-100.perso","robinpayadmin","gUFjHp3Q8m9y");
		mysql_select_db("robinpayadmin") or die (mysql_error());
		
		/*$res1=mysql_query("SELECT id FROM grabin_user WHERE pseudo='$login'")or die (mysql_error());
		 if( mysql_num_rows($res1)>=1){
			 $util3=mysql_fetch_assoc($res1);
						$IDa=$util3['idUser'];
						
					}
		else "ID multiple";*/
		
		
$res2=mysql_query("SELECT DISTINCT id_demandeur FROM amis WHERE id_accepteur='$IDa' AND etat=0")or die (mysql_error());
		
		if( mysql_num_rows($res2)>=1){
				$nb=0;
				while ($util=mysql_fetch_assoc($res2)){
					
					$IDd=$util['id_demandeur'];
					
					
					
					$res3=mysql_query("SELECT pseudo FROM grabin_user WHERE id=".$IDd."")or die (mysql_error());
					if( mysql_num_rows($res3)>=1){
						while ($util2=mysql_fetch_assoc($res3)){
						$pseudod=$util2['pseudo'];
						
					$classeA="amitie".$nb;
					$classeR="refus".$nb;
					
					$bouton="<a href='voirProfil.php?profil=".$pseudod."'>".$pseudod."</a> demande à vous suivre <input type='button' value='Accepter' class=".$classeA." data-accepte=1 data-ami='".$IDd."' > <input type='button' value='Refuser' class=".$classeR." data-accepte=2 data-ami='".$IDd."' ></br>";
					$nb++;
					echo $bouton;
						}
					}
				}
				
		}
		
		else "Pas de demandes";	
}






?>
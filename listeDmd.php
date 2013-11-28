<?php

session_start();  

		$IDa=$_SESSION['ID'];
		
		require 'config2.php';
		
		/*$res1=mysql_query("SELECT id FROM grabin_user WHERE pseudo='$login'")or die (mysql_error());
		 if( mysql_num_rows($res1)>=1){
			 $util3=mysql_fetch_assoc($res1);
						$IDa=$util3['idUser'];
						
					}
		else "ID multiple";*/
		
		
$res2=mysql_query("SELECT DISTINCT * FROM amis WHERE ID_accepteur='$IDa' AND etat=0 AND ID_demandeur<>0")or die (mysql_error());
		
		if( mysql_num_rows($res2)>=1){
				$nb=0;
				echo "<ul id='ul_dmd'>";
				while ($util=mysql_fetch_assoc($res2)){
					
					$IDd=$util['ID_demandeur'];
					
					
					
					$res3=mysql_query("SELECT pseudo FROM grabin_user WHERE id='$IDd'")or die (mysql_error());
					if( mysql_num_rows($res3)>=1){
						
						while ($util2=mysql_fetch_assoc($res3)){
						$pseudod=$util2['pseudo'];
						
					$classeA="amitie".$nb;
					$classeR="refus".$nb;
					
					$bouton="<li class='pointer'><a href="."voirProfil.php?profil=".$pseudod."&key=".$IDd.">".$pseudod."</a> demande à vous suivre <img src='imgs/check.png' class=".$classeA." data-accepte=1 data-ami='".$IDd."' > <img src='imgs/fail.png' class=".$classeR." data-accepte=2 data-ami='".$IDd."' ></li>";
					$nb++;
					echo $bouton;
						}
								
					}
					
				}
			echo "</ul>";	
		}
		else
			echo "Aucune demande";

		







?>
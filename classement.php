<?php
session_start();  
  
$i=0;
$scoreAvant=0;
$id_user=$_SESSION['ID'];
	
		$link=mysql_connect("mysql51-100.perso","robinpayadmin","gUFjHp3Q8m9y");
		mysql_select_db("robinpayadmin") or die (mysql_error());
		
		$res4=mysql_query("SELECT * FROM grabin_user WHERE score<>0 ORDER BY score DESC ")or die (mysql_error());
				if( mysql_num_rows($res4)>=1){
					while ($util2=mysql_fetch_assoc($res4)){
						$id=$util2['id'];
						$pseudo=$util2['pseudo'];
						$score=$util2['score'];
							
						if($i==0)
							$div="<div class='categ yellow'></div><div class='cup goldcup'>";
						else if($i==1)
							$div="<div class='categ yellow'></div><div class='cup silvercup'>";
						else if($i==2)
							$div="<div class='categ yellow'></div><div class='cup bronzecup'>";
						else{
							
							if($score!=$scoreAvant)
								$changeCouleur=!$changeCouleur;
							if($changeCouleur)
								$div="<div class='categ blue'></div><div class='cup'>";
							else
								$div="<div class='categ red'></div><div class='cup'>";
						}
						
						if($score!=$scoreAvant)
							$i++;
					if($id==$id_user){	
						$affichage="<li>".$div."</div><a href='#' class='rider'>".$pseudo."</a><p class='score'>".$score." pts</p></li>";}
					else{	
						$affichage="<li>".$div."</div><a href="."voirProfil.php?profil=".$pseudo."&key=".$id." class='rider'>".$pseudo."</a><p class='score'>".$score." pts</p></li>";}
						
						echo $affichage;
						
						$scoreAvant=$score;
					
				}
				}
	
	




?>


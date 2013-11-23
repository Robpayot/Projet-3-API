<?php
session_start();
$nbEvent=0;
//_________________RÉCUPÉRATION DES AMIS USER_________________//
if($_SESSION['profilOuNon']==1){
	$id_user=$_SESSION['ID'];
	$supprimer=1;
}
else if ($_SESSION['profilOuNon']==0) {
	$id_user=$_SESSION['IDprofilVisite'];
	$supprimer=0;
}
	
$link=mysql_connect("mysql51-100.perso","robinpayadmin","gUFjHp3Q8m9y");
mysql_select_db("robinpayadmin") or die (mysql_error());

if(!isset($_GET['supprimer'])){
	$res2=mysql_query("SELECT * FROM checkIn WHERE id_user='$id_user' AND date_end>now() ORDER BY date_begin")or die (mysql_error());
		
			if( mysql_num_rows($res2)>=1){
				while ($util2=mysql_fetch_assoc($res2)){
					$evenement=array("evenement".$nbEvent=>array("date"=>$util2['date_begin'],"lat"=>$util2['lat'],"lng"=>$util2['lng'],"id_check"=>$util2['id'],"comment"=>$util2['comment'],"supp"=>$supprimer));
					$evenementAvenir=array_merge((array)$evenementAvenir,(array)$evenement);
					$nbEvent++;
				}
				echo json_encode($evenementAvenir);
			}
			else 
				echo "Aucun checkin à venir";
				}
				
else{
$idC=$_GET['supprimer'];
$idCheck=$_GET['idCheck'];

	$res2=mysql_query("DELETE FROM checkIn WHERE id='$idCheck' AND id_user='$id_user'")or die (mysql_error());
	echo "supp";
	
}
			
				

?>
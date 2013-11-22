<?php 
session_start();
require 'config.php';

$id_user=$_SESSION['ID'];
$pseudo=$_SESSION['login'];
date_default_timezone_set('CET');

function unix_timestamp($date)
{
	$date = str_replace(array(' ', ':'), '-', $date);
	$c    = explode('-', $date);
	$c    = array_pad($c, 6, 0);
	array_walk($c, 'intval');
 
	return mktime($c[3], $c[4], $c[5], $c[1], $c[2], $c[0]);
}

// lancement de la requete
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$comment = $_GET['comm'];
$start = date("Y-m-d H:i");
$startTS = unix_timestamp($start);
$endTS = $startTS+10800;
$end = date("Y-m-d H:i", $endTS);
$score;
//echo $lat.", ".$lng."<br>";
//echo "start: ".$start.", end: ".$end."<br>";
$dbh->exec("INSERT INTO checkIn(json,id_user, pseudo, lat, lng, comment, date_begin, date_end) VALUES('json','$id_user', '$pseudo', '$lat', '$lng', '$comment', '$start', '$end')"); 


		$link=mysql_connect("mysql51-100.perso","robinpayadmin","gUFjHp3Q8m9y");
		mysql_select_db("robinpayadmin") or die (mysql_error());
		$res1=mysql_query("SELECT * FROM grabin_user WHERE id='$id_user'")or die (mysql_error());
	
		 if( mysql_num_rows($res1)>=1){
				while ($util=mysql_fetch_assoc($res1)){
					$score=$util['score']+10;
				}
				
		 }
		 
		 $res1=mysql_query("UPDATE grabin_user SET score='$score' WHERE id='$id_user'")or die (mysql_error());
/*$dbh -> exec("SELECT * FROM grabin_user WHERE id='$id_user'")->fetchAll();

foreach ($user as $users):
$score=$users['score']+10;

endforeach;

$dbh -> exec("UPDATE grabin_user SET score='$score' WHERE id='$id_user'");*/
       
?>
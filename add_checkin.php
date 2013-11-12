<?php 
try
{
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=test_map', 'root', '');
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}


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
//echo $lat.", ".$lng."<br>";
//echo "start: ".$start.", end: ".$end."<br>";
$bdd->exec("INSERT INTO checkin(json, lat, lng, comment, date_debut, date_fin) VALUES('json', '$lat', '$lng', '$comment', '$start', '$end')"); 
       
?>
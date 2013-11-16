<?php 

require 'config.php';

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
$day = $_GET['day'];
$comment = $_GET['c'];
$time = $_GET['time'];
echo $day." ".$time;
$start = date($day." ".$time);
var_dump($start);
$startTS = unix_timestamp($start);
$endTS = $startTS+10800;
$end = date("Y-m-d H:i", $endTS);
//echo "start: ".$start.", end: ".$end."<br>";
$dbh->exec("INSERT INTO checkIn(json, lat, lng, comment, date_begin, date_end) VALUES('json', '$lat', '$lng', '$comment', '$start', '$end')"); 
       
?>
<?php
session_start();
$id_user=$_SESSION['ID'];

$user = $dbh -> query("SELECT * FROM grabin_user WHERE id='".$id_user."'")->fetchAll();
	foreach ($user as $users):
$name = $users['name'];
$surname = $users['surname'];
$pseudo = $users['pseudo'];
$email = $users['email'];
$avatar = $users['avatar'];
$ville = $users['ville'];
$sport = $users['sport'];
$sport_level = $users['sport_level'];
$score = $users['score'];
$date_register = $users['date_register'];
endforeach;


//____ CLASSIFICATION DES SPORTS PRATIQUES _______________________________

if ($sport==1) {
		$sport="Skate";
		}
if ($sport==2) {
		$sport="Roller";
		}
if ($sport==3) {
		$sport="Skate et Roller";
		}
if ($sport==4) {
		$sport="Bike";
		}
if ($sport==5) {
		$sport="Skate et Bike";
		}
if ($sport==6) {
		$sport="Roller et Bike";
		}
if ($sport==7) {
		$sport="Skate, Roller et Bike";
		}
if ($sport==8) {
		$sport="Trotinette";
		}
if ($sport==9) {
		$sport="Skate et Trotinette";
		}
if ($sport==10) {
		$sport="Roller et Trotinette";
		}
if ($sport==11) {
		$sport="Skate, Roller et Trotinette";
		}
if ($sport==12) {
		$sport="Bike et Trotinette";
		}
if ($sport==13) {
		$sport="Skate, Bike et Trotinette";
		}
if ($sport==14) {
		$sport="Roller, Bike et Trotinette";
		}
if ($sport==15) {
		$sport="Ultime Rider";
		}
		
 ?>
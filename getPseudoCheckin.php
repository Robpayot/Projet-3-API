<?php

//____________REQUIRE_____________________

require 'function.php';
require 'config.php';
session_start();
$id_user = $_GET['idCheck'];



//_________________RÉCUPÉRATION DES DONNEES USER_________________//

	$user = $dbh -> query("SELECT * FROM grabin_user WHERE id='".$id_user."'")->fetchAll();
	foreach ($user as $users):
$pseudo = $users['pseudo'];
		endforeach;
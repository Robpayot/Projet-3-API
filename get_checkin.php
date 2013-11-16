<?php 
require 'config.php';


// lancement de la requete
$sth = $dbh->prepare("SELECT json, pseudo, id, lat, lng, comment, date_debut, date_fin FROM checkin");
$sth->execute();
$data=$sth->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_GROUP);
echo json_encode($data);



?>
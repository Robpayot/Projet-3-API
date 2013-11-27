<?php 
require 'config.php';

// lancement de la requete
$sth = $dbh->prepare("SELECT json, id, id_user, pseudo, lat, lng, comment, date_begin, date_end FROM checkIn");
$sth->execute();
$data=$sth->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_GROUP);
echo json_encode($data);

?>
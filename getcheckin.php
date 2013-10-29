<?php 
try
{
    // On se connecte à MySQL
    $dbh = new PDO('mysql:host=localhost;dbname=test_map', 'root', '');
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}


// lancement de la requete
$sth = $dbh->prepare("SELECT json, pseudo, id, lat, lng, comment, date_debut, date_fin FROM checkin");
$sth->execute();
$data=$sth->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_GROUP);
echo json_encode($data);



?>
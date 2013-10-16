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


// lancement de la requete
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$comment = $_GET['comm'];
echo $lat.", ".$lng;
$bdd->exec("INSERT INTO checkin(lat, lng, comment, date_debut) VALUES('$lat', '$lng', '$comment', NOW())"); 
       
?>
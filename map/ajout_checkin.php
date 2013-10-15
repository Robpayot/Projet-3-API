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
echo $lat.", ".$lng;
$bdd->exec("INSERT INTO checkin(lat, lng, date_debut) VALUES('$lat', '$lng', NOW())"); 
 
// on insere le tuple (mysql_query) et au cas où, on écrira un petit message d'erreur si la requête ne se passe pas bien (or die)
//mysql_query ($bdd) or die ('Erreur SQL !'.$bdd.'<br />'.mysql_error());  
 
// on ferme la connexion à la base
//mysql_close();         
?>
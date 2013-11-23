<?php // CONNEXION À LA BASE DE DONNÉES
 
 $dsn = 'mysql:dbname=robinpayadmin;host=localhost';
 $user = 'root';
 $password = '';
 
 try {
     $dbh = new PDO($dsn, $user, $password);
 } catch (PDOException $e) {
     echo 'Erreur: ' . $e->getMessage();
 } ?>
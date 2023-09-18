<?php
try {
    // Je définis des variable que j'utiliserais pour les valeurs necessaires à la connexion dans ma base de données
    $serveur = "localhost";
    $dbname = "passion";
    $user = "root";
    $pass = "";

    //On se connecte à la BDD
    $pdo = new PDO("mysql:host=$serveur;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    //Constante qui permet de renvoyer les exeptions d'erreurs
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    //Permet de récupérer les informations sous formes d'objets (compte utilisateur)
} catch (PDOException $e) {
    exit('Erreur : ' . $e->getMessage());
}


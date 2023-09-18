<?php

$user_id = $_GET['id']; // Je récupère l'id' passé par l'url
$token = $_GET['token'];// Je récupère aussi le token

require_once '../elements/db.php'; // J'appel ma connexion à la base de données

// Je selectionne l'ensemble des éléments de mon utilisateur lié à l'id passé en paramètre (ce qui me permettra entre autre de stocker toute ces données dans une variable $user)
$req = $pdo->prepare('SELECT * FROM utilisateurs WHERE user = ?'); //Je stock la requête dans une variable

// J'exécute avec l'id de mon utilisateur en paramètre
$req->execute([$user_id]);

// Je récupère les information
$user = $req->fetch();

session_start();

// Si mon utilisateur et le token de l'utilisateur correspondent aux paramètres de l'url, alors :
if ($user && $user->token == $token) {

    // Je prépare ma requête pour modifier ma table utilisateur en effaçant le token de validation en mettant la date et l'heure de validation
    // J'exécute via l'id de mon utilisateur
    $pdo->prepare('UPDATE utilisateurs SET token = NULL, confirm_at = NOW() WHERE user = ?')->execute([$user_id]);

    // Je stock un message de validation dans la variable $_SESSION que j'appellerai 'flash'avec un index qui correspont à Twitter Bootstrap (Success) pour un message de couleure verte
    $_SESSION['flash']['success'] = "Merci, votre compte a bien été validé !";

    // Je stock mon utilisateur dans l'index 'auth' (authentification) via la super variable $_SESSION
    $_SESSION['auth'] = $user;
    // Je redirige vers la page du profil utilisateur
    header('Location: account.php');
} else {
    // Si le token ne fonctionne pas, je stock un message d'erreur avec l'index danger pour un message écrit en rouge
    $_SESSION['flash']['danger'] = "Vous avez déjà validé votre compte ou le token n'est plus valide";
    // Je redirige vers la page connexion
    header('Location: login.php');
}

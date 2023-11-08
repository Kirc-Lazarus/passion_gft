<?php
require '../elements/bootstrap.php';
$db = App::getDatabase();

// Si mon utilisateur et le token de l'utilisateur correspondent aux paramètres de l'url, alors :
if (App::getAuth()->confirm($db, $_GET['id'], $_GET['token'], Session::getInstance())) {

    // Je prépare ma requête pour modifier ma table utilisateur en effaçant le token de validation en mettant la date et l'heure de validation
    // J'exécute via l'id de mon utilisateur
    $db->query('UPDATE utilisateurs SET token = NULL, confirm_at = NOW() WHERE user = ?', [$user_id]);

    // Je stock un message de validation dans la variable $_SESSION que j'appellerai 'flash'avec un index qui correspont à Twitter Bootstrap (Success) pour un message de couleure verte
    Session::getInstance()->setFlash('success', "Merci, votre compte a bien été validé !");

    // Je redirige vers la page du profil utilisateur
    App::redirect('account.php');
} else {
    // Si le token ne fonctionne pas, je stock un message d'erreur avec l'index danger pour un message écrit en rouge
    Session::getInstance()->setFlash('danger', "Vous avez déjà validé votre compte ou le token n'est plus valide");

    // Je redirige vers la page connexion
    App::redirect('login.php');
}

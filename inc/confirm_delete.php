<?php
require_once '../elements/functions.php';
logged_only(); // Accessible si l'utilisateur est connecté

// Récupérer et valider les paramètres de l'URL
if (isset($_GET['id']) && isset($_GET['token'])) {
    $user_id = $_GET['id'];
    $token = $_GET['token'];

    require_once '../elements/db.php'; // Inclure la connexion à la base de données

    // Sélectionner l'utilisateur correspondant aux paramètres
    $req = $pdo->prepare('SELECT * FROM utilisateurs WHERE user = ? AND delete_token = ?');
    $req->execute([$user_id, $token]);
    $user = $req->fetch();

    if ($user) {
        // Supprimer le compte de l'utilisateur de la base de données
        $deleteQuery = $pdo->prepare('DELETE FROM utilisateurs WHERE user = ?');
        if ($deleteQuery->execute([$user_id])) {

            // Message de confirmation
            $_SESSION['flash']['warning'] = 'Votre compte a été supprimé avec succès.';

            // Rediriger vers la page d'accueil ou une autre page appropriée
            header('Location: logout.php');
            exit();
        } else {
            // Erreur lors de la suppression
            $_SESSION['flash']['danger'] = 'Erreur lors de la suppression du compte.';
        }
    } else {
        // Les paramètres ne correspondent pas à un utilisateur valide
        $_SESSION['flash']['danger'] = 'Il y a un problème avec ce lien.';
    }
} else {
    // Paramètres manquants dans l'URL, rediriger vers une page d'erreur
    $_SESSION['flash']['danger'] = 'Un problème est survenu.';
    exit();
}

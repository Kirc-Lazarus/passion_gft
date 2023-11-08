<?php
function debug($variable) //Fonction pour retourner une valeur et vérifier si mes condition fonctionnent
{
    echo '<pre>' . print_r($variable, true) . '</pre>';
}


function logged_only() // Fonction pour controler la connection de l'utilisateur
{
    if (session_status() == PHP_SESSION_NONE) { // Par prudence je m'assure qu'une session est démarré
        session_start();
    }
    // Si aucune connection détecté, 
    if (!isset($_SESSION['auth'])) {
        // Message erreur
        $_SESSION['flash']['danger'] = "Vous ne pouvez pas visionner cette page, veuillez vous connecter !";
        // Redirection
        header('Location: ../inc/login.php');
        exit(); // J'empêche la suite de l'exécution du script
    }
}

function reconnect_cokkie()
{  // Je lance une session si ce n'est pas déjà fait
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // Est-ce que j'ai un cookie 'remember' et un utilisateur connecté
    if (isset($_COOKIE['remember']) && !isset($_SESSION['auth'])) {
        // Si oui je me connecte à la BDD
        require_once 'db.php';
        // Si la variable n'est pas accessible
        if (!isset($pdo)) {
            // Je La charge depuis le name space global
            global $pdo;
        }
        // Je mets mon cookie dans une variable
        $remember_token = $_COOKIE['remember'];
        // Dans une variable je l'explose par "==" via ma variable 'remember_token'
        $parts = explode('==', $remember_token);
        // Je récupères l'id de mon utilisateur qui sera la première partie
        $user_id = $parts[0];
        // je selectionne tout dans utilisateurs où l'id correspond à l'utilisateur
        $req = $pdo->prepare('SELECT * FROM utilisateurs WHERE user = ?');
        // j'exécute en passant user_id
        $req->execute([$user_id]);
        // Je récupère les données liées
        $user = $req->fetch();
        // Si j'ai une information
        if ($user) {
            // Je vérifie que le token correspond je met dans une variable
            $expected = $user_id . '==' . $user->remember_token . sha1($user_id . 'member');
            // Si la variable est égale au remember_token
            if ($expected == $remember_token) {
                // Alors J'active la session
                session_start();
                // Je connecte l'utilisateur automatiquement
                $_SESSION['auth'] = $user;
                // Et j'actualise la période de mon cookie
                setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
                // Si les clés ne correspondent pas
            } else {
                // Je détruit le cookie
                setcookie('remember', NULL, -1);
            }
            // Si l'utilisateur ne correspond pas
        } else {
            // Je détruis le cookie
            setcookie('remember', NULL, -1);
        }
    }
}

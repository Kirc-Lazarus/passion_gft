<?php
session_start(); // On démarre la session

setcookie('remember', NULL, -1); // Premier paramètre la clé, deuxième NULL et troisième moins un jour pour qu'il disparaisse immédiatement

unset($_SESSION['auth']); // On supprime la partie authentification
$_SESSION['flash']['success'] = "Vous êtes déconnecté !"; // On stock un message succés

header('Location: ../index.php'); // On redirige

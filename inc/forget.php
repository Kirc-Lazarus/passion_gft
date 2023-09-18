<?php
// Si des données ont été postées et que l'email n'est pas vide
if (!empty($_POST) && !empty($_POST['email'])) {
    require_once '../elements/db.php'; // J'inclus une connexion BDD
    require_once '../elements/functions.php'; // J'inclus mes fonctions
    // Requête préparé en selectionnant l'email et vérifiant que le compte est validé via la date
    $req = $pdo->prepare('SELECT * FROM utilisateurs WHERE email = ? AND confirm_at IS NOT NULL');
    //  j'exécute avec le paramètre email
    $req->execute([$_POST['email']]);
    // Je récupère l'enregistrement
    $user = $req->fetch();

    // Si l'utilisateur correspond
    if ($user) {
        // Je démarres une session
        session_start();
        // Je prépares un token dans une variable reset (nouveau)
        $reset_token = str_random(60); // Généré avec ma fonction str_random
        // Je prépare ma requête pour intégrer mon reset_token et indiquer la date dans reset_at puis j'exécute avec paramètre reset_token et user correspondant à l'id (clé primaire)
        $pdo->prepare('UPDATE utilisateurs SET reset_token = ?, reset_at = NOW() WHERE user = ?')->execute([$reset_token, $user->user]);
        // Message pour indiquer qu'un mail a été envoyé
        $_SESSION['flash']['success'] = "Vous allez recevoir un email d'instruction";
        // Envoi de l'email d'instruction
        mail($_POST['email'], 'Réinitialisation de votre compte', "Afin de réinitialiser votre compte merci de cliquer sur ce lien \n\nhttp://passion_gft2.0.test/inc/reset.php?id={$user->user}&token=$reset_token");
        // redirection vers la page de connexion
        header('Location: login.php');
        exit(); // On stop l'exécution du script
    } else {
        // Affichez un message d'erreur personnalisé à l'utilisateur
        session_start();
        $_SESSION['flash']['danger'] = 'Aucun compte lié à cette adresse mail';
        header('Location: forget.php'); // Redirigez l'utilisateur vers la page de connexion
        exit();
    }
}

require_once("../elements/header_ins_co.php");
?>
<div class="cadre opacity">
    <!-- Début du conteneur avec la classe CSS "cadre opacity" -->
    <div class="contener-form">
        <!-- Un sous-conteneur avec la classe CSS "contener-form" -->
        <form class="form-detail" action="" method="post">
            <!-- Début d'un formulaire avec la classe CSS "form-detail", action vide (à spécifier) et méthode POST -->
            <h2>Mot de passe oublié</h2>
            <!-- Un titre "Mot de passe oublié" de niveau 2 -->
            <div class="form-row">
                <!-- Début d'une ligne de formulaire -->
                <label for="full-name">Email</label>
                <!-- Une étiquette (label) pour le champ de saisie -->
                <input type="email" name="email" class="input-text mb-2" placeholder="Entrez votre email" required>
                <!-- Champ de saisie de type "email" avec un nom "email", des classes CSS et un texte de placeholder -->
            </div>
            <!-- Fin de la ligne de formulaire -->
            <div class="form-row-last">
                <!-- Début d'une autre ligne de formulaire -->
                <input type="submit" name="register" class="register" value="Envoyer">
                <!-- Bouton de soumission du formulaire avec un nom "register", une classe CSS et une valeur "Envoyer" -->
            </div>
            <!-- Fin de la ligne de formulaire -->
        </form>
        <!-- Fin du formulaire -->
    </div>
    <!-- Fin du sous-conteneur "contener-form" -->
</div>
<!-- Fin du conteneur principal "cadre opacity" -->

<?php
require_once("../elements/footer.php");
?>
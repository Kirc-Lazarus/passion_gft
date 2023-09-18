<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../elements/functions.php';

// Si des données sont postées et si les champs pseudo et password contiennent des informations
if (!empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['password'])) {
    // Inclure le fichier de connexion à la base de données
    require_once '../elements/db.php';

    // Préparer la requête
    $req = $pdo->prepare('SELECT * FROM utilisateurs WHERE (pseudo = :pseudo OR email = :pseudo) AND confirm_at IS NOT NULL');
    $req->execute(['pseudo' => $_POST['pseudo']]);
    $user = $req->fetch();

    if ($user !== false && password_verify($_POST['password'], $user->password)) {
        // Générer un token
        $token = str_random(60);

        // Mettre à jour la base de données avec le token
        $req = $pdo->prepare("UPDATE utilisateurs SET delete_token = :token WHERE user = :user_id");
        $req->execute(['token' => $token, 'user_id' => $user->user]);

        // Envoyer l'e-mail de confirmation de suppression à l'utilisateur
        $to = $user->email; // Adresse e-mail de l'utilisateur
        $subject = 'Lien de suppression de votre compte';
        $message = "Afin d'exécuter la suppression de votre compte, merci de cliquer sur ce lien ATTENTION ACTION IRREVERSIBLE : \n\nhttp://passion_gft2.0.test/inc/confirm_delete.php?id={$user->user}&token=$token";
        
        // Assurez-vous que l'adresse e-mail de l'utilisateur est correcte
        if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
            mail($to, $subject, $message);
            header('Location: ../index.php');
            // Stocker un message de succès dans votre session
            $_SESSION['flash']['warning'] = "Un email de suppression vous a été envoyé, veuillez consulter votre boîte mail ! <h3>Attention si vous cliquez sur le lien envoyé, votre compte sera supprimé définitivement.</h3>";
            exit();
        } else {
            // Gérer l'erreur si l'adresse e-mail n'est pas valide
            $_SESSION['flash']['danger'] = "Erreur lors de l'envoi de l'e-mail de suppression. Veuillez contacter l'administrateur.";
        }

        // Indiquer que le script s'arrête à cet endroit
        exit();
    } else {
        // Afficher une erreur à l'utilisateur
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';
    }
}


require_once('../elements/header_ins_co.php')
?>

<div class="cadre opacity">
    <div class="contener-form bg-img">
        <!-- Début du formulaire -->
        <form class="form-detail" action="" method="post">
            <h2>Supprimer mon compte</h2> <!-- Titre du formulaire -->

            <!-- Champ pour le pseudo ou l'e-mail -->
            <div class="form-row">
                <label>Pseudo ou email</label> <!-- Étiquette du champ -->
                <input type="text" name="pseudo" id="pseudo" class="input-text" placeholder="Votre pseudo ou votre email" pattern="^(?![_-])(?!.*[_-]{2,})([A-Za-z0-9_-]{3,}|[A-Za-z0-9._%+-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,4})$(?<![_-])$" required>
                <!-- Champ de saisie de texte avec des attributs tels que le nom, l'ID, la classe, le placeholder (texte de l'exemple) et une expression régulière (pattern) pour la validation -->
            </div>

            <!-- Champ pour le mot de passe avec un lien "Mot de passe oublié" -->
            <div class="form-row">
                <label>Mot de passe</label>
                <!-- Étiquette du champ avec un lien pour réinitialiser le mot de passe -->
                <input type="password" name="password" id="password" class="input-text" placeholder="Votre mot de passe" pattern="^(?=.*[A-Z])(?=.*\d).{8,}$" required>
                <!-- Champ de saisie de mot de passe avec des attributs similaires au champ précédent -->
            </div>

            <!-- Bouton de soumission et lien vers la page d'inscription -->
            <div class="form-row-last">
                <input type="submit" name="register" class="register" value="Supprimer">
                <button class="btn btn-secondary"><a class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="account.php">Retour au profil</a></button>
            </div>
        </form>
        <!-- Fin du formulaire -->
    </div>
</div>
<?php require_once('../elements/footer.php'); ?>
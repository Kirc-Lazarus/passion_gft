<?php
// Est-ce que il y a id et token dans l'url
if (isset($_GET['id']) && isset($_GET['token'])) {
    // Connexion à la base de données
    require_once '../elements/db.php';
    // Appel des fonctions
    require_once '../elements/functions.php';
    //  Je selectionne l'ensemble du tableau utilisateurs où l'id et le reset_token correspondent, je rajoute une condition (is not null) pour renforcer la sécurité et la date du reset doit être supérieur à la date du jour 
    $req = $pdo->prepare('SELECT * FROM utilisateurs WHERE user = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
    // j'exécute avec l'id et le token
    $req->execute([$_GET['id'], $_GET['token']]);
    // Je récupères les résultat
    $user = $req->fetch();
    // Si j'ai un utilisateur
    if($user){
        // Si j'ai des données
        if(!empty($_POST)) {
            // Si ces données correspondent
            if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']) {
                // Je met dans une varible mon mot de passe crypté
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                // Je modifie ma base de données au niveau du password, je vide la date de modification et je vide mon token de réinitialisation
                $pdo->prepare('UPDATE utilisateurs SET password = ?, reset_at = NULL, reset_token = NULL')->execute([$password]); // J'exécute
                session_start(); // je démarre ma session pour utiliser ma superglobale
                // Message succés avec ma superglobale
                $_SESSION['flash']['success'] = "Votre mot de passe à bien été modifié";
                // Je connecte mon utilisateur
                $_SESSION['auth'] = $user;
                // Et je le redirige
                header('Location: account.php');
                exit(); // Stop de l'exécution du script pour éviter d'unset le 'flash' avec le reste du script
            }
        }

    }else { // Sinon
        session_start();
        // Message d'erreur
        $_SESSION['flash']['danger'] = "Le lien n'est plus valide";
        // Redirection
        header('Location: login.php');
        exit(); // Stop de l'exécution du script
    }

} else {
    header('Location: login.php');
    exit();
}
?>
<?php require_once("../elements/header_ins_co.php"); ?>
<div class="cadre opacity">
    <div class="contener-form bg-img">
        <form class="form-detail" action="" method="post">
            <h2>Réinitialiser mon mot de passe</h2>
            <div class="form-row">
                <label>Mot de passe</label>
                <input type="password" name="password" class="input-text" placeholder="Votre mot de passe" required>
            </div>
            <div class="form-row">
                <label>Confirmation du mot de passe</label>
                <input type="password" name="password_confirm" class="input-text" placeholder="Votre mot de passe" required>
            </div>
            <div class="form-row-last">
                <button type="submit" class="btn btn-primary">Réinitialiser votre mot de passe</a></button>
            </div>
        </form>
    </div>
</div>
<?php
require_once("../elements/footer.php");
?>
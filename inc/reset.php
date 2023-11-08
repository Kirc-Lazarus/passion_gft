<?php
require '../elements/bootstrap.php';
// Est-ce que il y a id et token dans l'url
if (isset($_GET['id']) && isset($_GET['token'])) {
    $auth = App::getAuth();
    $db = App::getDatabase();
    $user = $auth->resetToken($db, $_GET['id'], $_GET['token']);
    // Si j'ai un utilisateur
    if ($user) {
        // Si j'ai des données
        if (!empty($_POST)) {
            $validator = new Validator($_POST);
            $validator->isPassword('password');
            if ($validator->isValid()) {

                // Je met dans une varible mon mot de passe crypté
                $password = $auth->hashPassword($_POST['password']);
                // Je modifie ma base de données au niveau du password, je vide la date de modification et je vide mon token de réinitialisation
                $db->query('UPDATE utilisateurs SET password = ?, reset_at = NULL, reset_token = NULL WHERE user = ?', [$password, $_GET['id']]); // J'exécute
                // Message d'erreur
                Session::getInstance()->setFlash('success', "Le mot de passe a été modifié.");
                $auth->connect($user);
                // Redirection
                App::redirect('account.php');
            }
        }
    } else { // Sinon
        // Message d'erreur
        Session::getInstance()->setFlash('danger', "Le lien n'est plus valide");
        // Redirection
        App::redirect('login.php');
    }
} else {
    App::redirect('login.php');
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
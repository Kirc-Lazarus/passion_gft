<?php
require '../elements/bootstrap.php';
$auth = App::getAuth();
$db = App::getDatabase();
$auth->reconnectCokkies($db);

// Si utilisateur connecté
if ($auth->user()) {
    App::redirect('account.php');
}
// Si des données sont postées et si les champs pseudo et password contiennent des informations
if (!empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['password'])) {

    $user = $auth->login($db, $_POST['pseudo'], $_POST['password'], isset($_POST['remember']));
    $session = Session::getInstance();
    if ($user) {

        $session->setFlash('success', "Vous êtes bien connecté"); // On indique une connexion réussie
        App::redirect('account.php'); // On redirige vers sa page profil
        exit();
    } else {
        $session->setFlash('danger', "identifiant ou mot de passe incorrecte");
    }
}
?>
<?php require_once("../elements/header_ins_co.php"); ?>

<div class="cadre opacity">
    <div class="contener-form bg-img">
        <!-- Début du formulaire -->
        <form class="form-detail" action="" method="post">
            <h2>S'identifier</h2> <!-- Titre du formulaire -->

            <!-- Champ pour le pseudo ou l'e-mail -->
            <div class="form-row">
                <label>Pseudo ou email</label> <!-- Étiquette du champ -->
                <input type="text" name="pseudo" id="pseudo" class="input-text" placeholder="Votre pseudo ou email" pattern="^(?![_-])(?!.*[_-]{2,})([A-Za-z0-9_-]{3,}|[A-Za-z0-9._%+-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,4})$(?<![_-])$" required>
                <!-- Champ de saisie de texte avec des attributs tels que le nom, l'ID, la classe, le placeholder (texte de l'exemple) et une expression régulière (pattern) pour la validation -->
            </div>

            <!-- Champ pour le mot de passe avec un lien "Mot de passe oublié" -->
            <div class="form-row">
                <label>Mot de passe <a href="forget.php">(Mot de passe oublié)</a></label>
                <!-- Étiquette du champ avec un lien pour réinitialiser le mot de passe -->
                <input type="password" name="password" id="password" class="input-text" placeholder="Votre mot de passe" pattern="^(?=.*[A-Z])(?=.*\d).{8,}$" required>
                <!-- Champ de saisie de mot de passe avec des attributs similaires au champ précédent -->
            </div>

            <!-- Case à cocher pour "Se souvenir de moi" -->
            <div class="form-row">
                <label>
                    <input type="checkbox" name="remember" value="1"> Se souvenir de moi <!-- name='remember' Pour récupérer l'info avec $_POST -->
                    <!-- Case à cocher avec le texte "Se souvenir de moi" -->
                </label>
            </div>

            <!-- Bouton de soumission et lien vers la page d'inscription -->
            <div class="form-row-last">
                <input type="submit" name="register" class="register" value="Se connecter">
                <!-- Bouton pour soumettre le formulaire -->
                <button class="btn btn-secondary"><a class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="register.php">Inscription</a></button>
                <!-- Bouton de lien vers la page d'inscription -->
            </div>
        </form>
        <!-- Fin du formulaire -->
    </div>
</div>

<?php
require_once("../elements/footer.php");
?>